<?php defined('SYSPATH') or die('No Direct Script Access.');
// $Id$
/**
 * 菜单模型
 *
 * @package core
 * @category Model
 * @author zhubin
 * @version $Id$
 * @copyright Ketai, 2011
 * @since 2011-12-09
 */
class Model_Menu extends ORM{

    /**
     * 取得系所有的菜单 
     * @param int $pid
     * @return array
     */
	public function get_menus($pid=0)
    {
        static $all_menus = array();
        empty($all_menus) && $all_menus = ORM::factory('Menu')->where('is_show','=','Y')->order_by('position', 'DESC')->find_all()->as_array();
        $return_menu = array();
        foreach($all_menus as $menu){
            if($menu->pid == $pid){
                $return_menu[$menu->id] = $menu->as_array();
                $return_menu[$menu->id]['children'] = $this->get_menus($menu->id);
            }
        }
        return $return_menu;
    }
    
    /**
     * 取得系所有的有效菜单 
     * @param int $pid
     * @return array
     */
    public function get_all_menus($pid=0)
    {
        static $all_menus = array();
        empty($all_menus) && $all_menus = EHOVEL::model('Menu')->order_by('position', 'DESC')->find_all()->as_array();
        $return_menu = array();
        foreach($all_menus as $menu){
            if($menu->pid == $pid){
                $return_menu[$menu->id] = $menu->as_array();
                $return_menu[$menu->id]['children'] = $this->get_all_menus($menu->id);
            }
        }
        return $return_menu;  
    }
    /**
     * 判断是否有子菜单
     * @return boolean
     */
    public function has_children()
    {
        if($this->loaded()){
            return EHOVEL::model('Menu')->where('pid', '=', $this->id)->count_all() > 0;
        }
        return false;
    }
}

