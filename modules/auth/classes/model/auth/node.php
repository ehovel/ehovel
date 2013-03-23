<?php defined('SYSPATH') or die('No Direct Script Access.');
// $Id$
/**
 * 权限资源模型类
 *
 * @package Auth
 * @category Model
 * @author zhubin
 * @version $Id$
 * @copyright Ketai, 2011
 * @since 2011-11-22
 */
class Model_Auth_Node {

    const ROLE_GUEST = 'ROLE_GUEST';
    CONST ROLE_ROOT = 'ROLE_ROOT';
    const DATA_NODE = 'DATA_NODE';//数据节点（该节点不做控制点的验证，可在需要的地方验证）
    const GROUP_NODE = 'GROUP_NODE';//分组节点（该节点不做权限的控制，用于节点的分组）
    /**  
     * 权限节点
     */
    private $_nodes = array();
    /**  
     * 节点标识
     */
    private $_mark = null;
    /**  
     * 节点名称
     */
    private $_name = null;
    /**  
     * 节点类型
     */
    private $_type = null;
    /**  
     * 节点默认权限
     */
    private $_default_role= null;
    /**
     * 资源工厂函数
     * @param string $mark 资源标识（默认为控制器链接譬如order/add）
     * @param string $name 资源显示名称
     * $param string $type 资源的类型（控制器节点还是数据节点）
     * @return Model_Auth_Node
     */
    public static function factory($mark, $name, $type=self::DATA_NODE, $default_role=self::ROLE_ROOT)
    {
        static $instances = array();
        if(empty($instances[$mark])){
            $instances[$mark] = new Model_Auth_Node($mark, $name, $default_role, $type);
        }else{
            exit('权限资源标识'.$mark.'重复');
        }
        return $instances[$mark];
    }
    /**
     * 资源构造函数
     * @param string $mark 资源标识（默认为控制器链接譬如order/add）
     * @param string $name 资源显示名称
     * @param string $default_role 资源默认角色
     * $param string $type 资源的类型（控制器节点还是数据节点）
     * @return array
     */
    private function __construct($mark, $name, $default_role=self::ROLE_ROOT, $type=self::DATA_NODE)
    {
        $this->_mark = $mark;
        $this->_name = $name;
        $this->_default_role = $default_role==self::ROLE_GUEST || $default_role==self::ROLE_ROOT ? $default_role : self::ROLE_ROOT;
        $this->_type = in_array($type ,array(self::DATA_NODE, self::GROUP_NODE)) ? $type : self::DATA_NODE;
    }

    /**
     * 添加子节点
     * @param Model_Auth_Node $node 资源节点
     * @return void
     */
    public function add_child(Model_Auth_Node $node){
        $this->_nodes[$node->get_mark()] = $node;
    }
    /**
     * 重置所有子节点
     * @param array $nodes 
     * @return void
     */
    public function reset_child($nodes){
        $this->_nodes = $nodes;
    }
    /**
     * 获取子节点
     * @return array
     */
    public function get_child()
    {
        return $this->_nodes;
    }
    /**
     * 获取资源标识
     * @return string
     */
    public function get_mark()
    {
        return $this->_mark;
    }
    /**
     * 获取资源类型
     * @return string
     */
    public function get_type()
    {
        return $this->_type;
    }
    /**
     * 获取资源名称
     * @return string
     */
    public function get_name()
    {
        return $this->_name;
    }

    /**
     * 获取资源名称
     * @return string
     */
    public function get_default_role()
    {
        return $this->_default_role;
    }

















    
    /**
     * 获取数据验证规则
     * @return array
     */
    public function rules()
    {
        return array(
            'name' => array(
                array('not_empty'),
                array('min_length',array(':value',1)),
                array('max_length',array(':value',32)),
            ),
            'resource' => array(
                array('not_empty'),
                array('min_length',array(':value',1)),
                array('max_length',array(':value',65535)),
            ),
            
        );
    }

    /**
     * 是否存在该名字
     * @param string $name_exist
     * @param int $uid
     * @return boolean
     */
    public function name_exist($name, $uid=0)
    {
        if(!empty($uid)){ 
            return $this->where('id', '!=', $uid)->where('name', '=', $name)->count_all()>0;
        }
        return $this->where('name', '=', $name)->count_all()>0;
    }
    /**
     * 将资源数组转成字符串
     * @param array $resources
     * @return string
     */
    public function convert_resources_to_string($resources)
    {
        if(is_array($resources)){
            return implode('|', $resources);
        }else{
            return '';
        }
    }
    /**
     * 将资源字符串转成数组
     * @param string $resource_str
     * @return array
     */
    public function convert_string_to_resources($resource_str)
    {
        return explode('|', $resource_str);
    }
    /**
     * 根据配置文件取得现有资源的信息
     * @param string $resource_str
     * @return array
     */
    public function get_resources($resource_str)
    {
        $target_data = array();
        $node_atoms = BES::config('node_atom')->as_array();
        $resources = $this->convert_string_to_resources($resource_str);
        foreach($resources as $resource){
            $controller = substr($resource, strrpos($resource,'/')+1);
            $class = substr($resource, 0, strrpos($resource,'/'));
            if(isset($node_atoms[$class]) AND isset($node_atoms[$class]['controller'][$controller])){
                $target_data[$class]['controller'][$controller] = $node_atoms[$class]['controller'][$controller];
                isset($node_atoms[$class]['name']) && $target_data[$class]['name'] = $node_atoms[$class]['name'];
                unset($node_atoms[$class]['controller'][$controller]);
            }
        }
        foreach($node_atoms as $class_name=>$class_info){
            if(empty($class_info['controller'])){
                unset($node_atoms[$class_name]);
            }
        }

        return array('target_data'=>$target_data,'source_data'=>$node_atoms);
    }
}
