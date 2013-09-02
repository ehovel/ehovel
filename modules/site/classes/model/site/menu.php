<?php defined('SYSPATH') or die('No direct script access.');
/**
 * 站点菜单
 *
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package Site
 * @category Model
 * @since 2012-01-04 
 * @author zhubin
 * @version   $Id$
 */
class Model_Site_Menu extends MPTT_Site
{
    //过滤函数
    protected $_filters = array(TRUE => array('trim' => NULL));

    /**
     * 验证规则
     * @return array
     */
    public function rules()
    {
        return array(
            'key' => array(
                array('min_length', array(':value', 1)),
                array('max_length', array(':value', 255))
            ),
            'name' => array(
                array('not_empty'),
                array('min_length', array(':value', 1)),
                array('max_length', array(':value', 255))
            ),
            'name' => array(
                array('min_length', array(':value', 1)),
                array('max_length', array(':value', 255))
            ),
            'type' => array(
                array('min_length', array(':value', 1)),
                array('max_length', array(':value', 255)),
            )
        );
    }

    /**
     * 判断Key是否重复
     *
     * @param string $key
     * @return boolean
     * <pre>
     *     true:存在
     *     false:不存在
     * </pre>
     */
    public function key_exist($key = '')
    {
        if ($this->loaded()) {
            $menu = EHOVEL::model($this->_object_name)->where('key', '=', $key)
                    ->where('id', '<>', $this->id)
                    ->find();
            if ($menu->loaded()) {
                return true;
            }
        } else {
            $this->where('key', '=', $key)->find();
            if ($this->loaded()) {
                return true;
            }
        }
        return false;
    }

    /**
     * 判断指定范围内名称是否重复
     *
     * @param string $key
     * @return boolean
     * <pre>
     *     true:存在
     *     false:不存在
     * </pre>
     */
    public function name_exist($scope = 1, $name = '')
    {
        if ($this->loaded()) {
            $menu = EHOVEL::model($this->_object_name)
                    ->where('name', '=', $name)
                    ->where('scope', '=', $scope)
                    ->where('id', '<>', $this->id)
                    ->find();
            if ($menu->loaded()) {
                return true;
            }
        } else {
            $this->where('name', '=', $name)
                    ->where('scope', '=', $scope)
                    ->find();
            if ($this->loaded()) {
                return true;
            }
        }
        return false;
    }
    /**
     * 根据导航的key取得其下所有的导航
     * @param string $key
     * @return array
     */
    public function get_menus_by_key($key, $pid=-1)
    {
        static $all_menus = array();
        static $root = array();
        !isset($root[$key]) && $root[$key] = EHOVEL::model('Site_Menu')->where('key', '=', $key)->find();
        !isset($all_menus[$key]) && $all_menus[$key] = $root[$key]->descendants()->as_array();
        $pid = $pid<0 ? $root[$key]->id : $pid;
        $return_menu = array();
        foreach($all_menus[$key] as $menu){
            if($menu->pid == $pid){
                $return_menu[$menu->id] = $menu->as_array();
                $return_menu[$menu->id]['href'] = $menu->get_uri();
                $return_menu[$menu->id]['children'] = $this->get_menus_by_key($key, $menu->id);
            }
        }
        return $return_menu;  
    }
    /**
     * 取得导航对应的链接地址
     * @return array
     */
    public function get_uri()
    {
        $return_str = '';
        if($this->loaded()){
            switch($this->type){
            case 'DOC':
                $return_str = EHOVEL::url('site/doc',array('id'=>$this->relate_id,'type'=>$this->name));
                break;
            case 'CATEGORY':
                $return_str = EHOVEL::model('Product_Category',array('id'=>$this->relate_id))->url;
                break;
            case 'LINK':
                $return_str = $this->href;
                break;
            }
        }
        return $return_str;
    }
}
