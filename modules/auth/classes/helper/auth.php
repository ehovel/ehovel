<?php defined('SYSPATH') or die('No direct access script');
// $Id$
/**
 * 权限Helper类
 * @package Auth
 * @category    Helper
 * @author zhubin
 * @since 2011-11-23
 * @copyright Copyright(c) 2011, Ketai inc
 * @version $Id
 */

class Helper_Auth{
    private static $_nodes = array();
    /**
     * 添加权限配置文件
     * @param array $config
     * @return Model_Auth_Node
     */
    public static function analize_config($config)
    {
        if(isset($config['name']) && isset($config['mark']))
        {
            $type = !empty($config['children']) ? Model_Auth_Node::GROUP_NODE : Model_Auth_Node::DATA_NODE;
            $default_role = !empty($config['default_role']) ? $config['default_role'] : Model_Auth_Node::ROLE_ROOT;
            $node = Model_Auth_Node::factory($config['mark'], $config['name'], $type, $default_role);
            if(!empty($node) && isset($config['children']) && is_array($config['children'])){
                foreach($config['children'] as $child){
                    $child_node = self::analize_config($child);
                    !empty($child_node) and $node->add_child($child_node);
                }
            }
            return $node;
        }
        return null;
    }
    /**
     * 检查请求是否有权限
     * @param string $mark
     * @param Auth_Admin $user
     * @return boolean
     * @example <?php if(Helper_Auth::check('menu/add')):?> <a href="/menu/add">添加</a><?php endif;?>
     */
    public static function check($mark, $user=NULL)
    {
        $node = self::get_node_by_mark($mark);
        if(empty($node) || self::check_is_ignore_login($mark)){
            return true;
        }
        empty($user) AND $user = Model_Auth_Admin::get_current_user();
        if(!empty($user) && $user->loaded()){
            if($user->super == 'Y'){
                return true;
            }
            $role = $user->role;
            return !empty($role->nodes_json) && in_array($mark, json_decode($role->nodes_json));
        }
        return false;
    }
    /**
     * 检查请求是否可以不用登录
     * @param string $mark
     * @return boolean
     */
    public static function check_is_ignore_login($mark)
    {
        $node = self::get_node_by_mark($mark);
        return !empty($node) && $node->get_default_role()==Model_Auth_Node::ROLE_GUEST;
    }
    /**
     * 取出标记对应的权限节点
     * @param String $mark 
     * @param array $nodes
     * @return Model_Auth_Node
     */
    public static function get_node_by_mark($mark, $nodes=array())
    {
        empty($nodes) and $nodes = Helper_Auth::get();
        foreach($nodes as $node){
            if($node->get_mark()==$mark){
                return $node;
            }
            $children = $node->get_child();
            if(!empty($children) && is_array($children)){
                $node = self::get_node_by_mark($mark, $children);
                if(!empty($node)){
                    return $node;
                }
            }
        }
        return null;
    }
    /**
     * 取出标记对应的权限节点
     * @param String $mark 
     * @param array $nodes
     * @return Model_Auth_Node
     */
    private static function & get_node_by_mark_to_edit($mark, $nodes=array())
    {
        empty($nodes) and $nodes = Helper_Auth::get();
        foreach($nodes as $key=>$node){
            if($node->get_mark()==$mark){
                return $nodes[$key];
            }
            $children = $node->get_child();
            if(!empty($children) && is_array($children)){
                $node = &self::get_node_by_mark($mark, $children);
                if(!empty($node)){
                    return $node;
                }
            }
        }
        $return_data = null;
        return $return_data;
    }
    /**
     * 向系统添加权限节点
     * @param Model_Auth_Node $node
     * @return void
     */
    public static function add(Model_Auth_Node $node){
        self::$_nodes[$node->get_mark()] = $node;
    }
    /**
     * 取出系统权限节点
     * @return void
     */
    public static function get(){
        return self::$_nodes;
    }
    /**
     * 取出当前用户的所有权限节点
     * @param Model_Auth_Admin $user
     * @return array
     */
    public static function get_current($user=null){
        empty($user) AND $user = Model_Auth_Admin::get_current_user();
        $nodes = self::get();
        if($user->super == 'Y'){
            return $nodes;
        }
        return self::get_nodes_by_role($user->role);
    }
    /**
     * 取出角色可以使用的所有权限
     * @param array $nodes
     * $param Model_Auth_Role $role
     * @return array
     */
    public static function get_nodes_by_role($role, $nodes=array())
    {
        empty($nodes) and $nodes = Helper_Auth::get();
        $marks = !empty($role->nodes_json) ? json_decode($role->nodes_json) : array();
        foreach($nodes as $key=>$node){
            if(!in_array($node->get_mark(), $marks))
            {
                unset($nodes[$key]);
            }
            $children = $node->get_child();
            if(!empty($children) && is_array($children))
            {
                $children = self::get_nodes_by_role($role, $children);
                if(!empty($children))
                {
                    $node->reset_child($children);
                    $nodes[$key] = $node;
                }
            }
        }
        return $nodes;
    }
    /**
     * 向系统添加权限节点
     * @param array $config
     * @return void
     */
    public static function add_config($config){
        $node = self::analize_config($config);
        !empty($node) and self::add($node);
    }
    /**
     * 向系统添加权限节点
     * @param  string $parent_mark
     * @param string $mark
     * @param string $name
     * @param string $default_role
     * @param string $type
     * @return void
     */
    public static function add_node($parent_mark, $mark, $name, $default_role=Model_Auth_Node::ROLE_ROOT, $type=Model_Auth_Node::GROUP_NODE)
    {
        $node = Model_Auth_Node::factory($mark, $name, $type, $default_role);
        self::add_after_parent($parent_mark, $node);
    }
    /**
     * 向系统添加权限节点
     * @param string $parent_mark
     * @param Model_Auth_Node $node
     * @return void
     */
    public static function add_after_parent($parent_mark, $node)
    {
        $node_to_edit = &self::get_node_by_mark_to_edit($parent_mark);
        if(!empty($node_to_edit)) {
            $node_to_edit->add_child($node);
        }else{
            self::add($node);
        }
    }
    /**
     * 将权限组装成列表
     * @param array $nodes
     * @param int $level
     * @return string
     */
    public static  function get_auth_list($nodes, $role_node=array(), $level=1){
        $return_str = '';
        if(is_array($nodes)){
            $return_str .= '<ul>';
            foreach($nodes as $node){
                $children = $node->get_child();
                if(!empty($children) && is_array($children) && $node->get_type()==Model_Auth_Node::GROUP_NODE){
                    $group_is_checked = true;
                    foreach($children as $child){
                        $group_is_checked = $group_is_checked && in_array($child->get_mark(), $role_node);
                    }
                }
                if($node->get_default_role() != Model_Auth_Node::ROLE_GUEST)
                {
                    $return_str .= '<li>
                        <input rev="'.$level.'" class="level'.$level.'" name="nodes[]" type="checkbox" '.(in_array($node->get_mark(), $role_node) || !empty($group_is_checked)?'checked="true"':'').'value="'.$node->get_mark().'">'.$node->get_name();
                    if(count($children)>0 && is_array($children)){
                        $return_str .= self::get_auth_list($children, $role_node, $level+1);
                    }
                    $return_str .= '</li>';
                }
            }
            $return_str .= '</ul>';
        }
        return $return_str;
    }

    /**
     * 取得当前用户可以分配的角色
     * @param array $roles
     * @param Model_Auth_Admin $user
     * @return string
     */
    public static function filter_available_role($roles, $user=null)
    {
        $return_arr = array();
        empty($user) AND $user = Model_Auth_Admin::get_current_user();
        if($user->super=='Y'){
            $tmp = array();
            foreach($roles as $role){
                $tmp[$role->id] = $role;
            }
            $return_arr = $tmp;
        }else{
            $current_role = $user->role;
            if($current_role->loaded() && !empty($current_role->nodes_json)){
                $current_marks = json_decode($current_role->nodes_json);
                foreach($roles as $role){
                    if(empty($role->nodes_json)){
                        $return_arr[$role->id] = $role;
                    }else{
                        $available = true;
                        foreach(json_decode($role->nodes_json) as $mark){
                            $available = $available && in_array($mark, $current_marks);
                            if(!$available) break;
                        }
                        if($available){
                            $return_arr[$role->id] = $role;
                        }
                    }
                }
            }
        }
        if(isset($return_arr[$user->role->id]))
        {
            unset($return_arr[$user->role->id]);
        }
        return $return_arr;
    }
}
