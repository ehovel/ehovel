<?php defined('SYSPATH') or die('No direct access script');
// $Id$
/**
 * 系统菜单
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package core
 * @category  Helper
 * @since 2011-12-09
 * @author zhubin
 * @version   $Id$
 */

class Helper_Menu{
    /**
     * 生成菜单
     * @param array $menus
     * @return string
     */
    public static function generate_menu($menus=array(),$mark=0)
    {
        $name_field = 'name';
        $ulClass = $liClass = '';
        empty($menus) AND $menus = ORM::factory('Menu')->get_menus() AND $mark=0;
        switch ($mark) {
        	case 0:
        		$ulClass = ' id="mainmenu" class="nav" ';
        		$liClass = ' class="dropdown" ';
        		break;
        	case 1:
        		$ulClass = ' class="dropdown-menu"';
        		$liClass = ' class="dropdown-submenu" ';
        		break;
        	case 2:
        		$ulClass = ' class="dropdown-menu menu-component"';
        		$liClass = '';
        		break;
        	case 3:
        		$ulClass = '';
        		$liClass = '';
        		break;
        }
        $mark ++;
        $return_menu = '<ul '.$ulClass.' mark="'.$mark.'">';
        if(is_array($menus)){
            foreach($menus as $menu){
                if(empty($menu['controller']) || '#'==$menu['controller']){
                    if(empty($menu['children']) || !is_array($menu['children']) || !self::have_permission_menu($menu['children'])){
                        continue;
                    }
                }
                if(Helper_Auth::check($menu['uri'])){
                    $return_menu .= '<li'.(!empty($menu['children']) ? $liClass : '').'>';
                    $dataToggle = !empty($menu['children'])? ' data-toggle="dropdown" class="dropdown-toggle" ':'';
                    $return_menu .= '<a href="'.(!empty($menu['uri']) ? Route::url($menu['uri']) : 'javascript:void(0);').'" '.$dataToggle.'>'.$menu[$name_field];
                    if (!empty($menu['children'])) {
                    	$return_menu .= $mark>1?'<span class="caret-right"></span>':'<span class="caret"></span>';
                    }
                    $return_menu .= '</a>';
                    if(!empty($menu['children']) && is_array($menu['children'])){
                        $return_menu .= self::generate_menu($menu['children'],$mark);
                    }
                    $return_menu .= '</li>';
                }
            }
        }
        $return_menu .= '</ul>';
        return $return_menu;
    }
    /**
     * 判断是否有有权限的菜单（参数中的一级菜单）
     * @param array $menus
     * @return string
     */
    public static function have_permission_menu($menus)
    {
        if(!empty($menus) && is_array($menus)){
            foreach($menus as $menu){
                if(Helper_Auth::check($menu['uri'])){
                    return true;
                }
            }
        }
        return false;
    }
    /**
     * 生成菜单列表
     * @param array $menus
     * @return string
     */
    public static function generate_menu_list($menus,$level=0)
    {
        $return_str = '';      
        if(is_array($menus)){
            foreach($menus as $menu){
                $return_str .= '<tr class="odd gradeU">';
                $return_str .= '<td>'.$menu['id'].'</td>';
                $return_str .= '<td>'.HTML::edit_anchor(BES::url('menu/edit', array('id' => $menu['id'])))."&nbsp;&nbsp;"
                    . HTML::delete_anchor(BES::url('menu/delete', array('id'=>$menu['id']))) . '</td>';
                $return_str .= '<td>'.str_pad('', $level*2, '-').$menu['name'].'</td>';
                $return_str .= '<td>'.str_pad('', $level*2, '-').$menu['name_en'].'</td>';
                $return_str .= '<td>'.$menu['uri'].'</td>';
                $return_str .= '<td>'.$menu['position'].'</td>';
                $return_str .= '<td>'.$menu['date_add'].'</td>';
                $return_str .= '<td>'.$menu['date_upd'].'</td>';
                $return_str .= '</tr>';
                if(isset($menu['children']) && !empty($menu['children'])){
                    $return_str .= self::generate_menu_list($menu['children'], $level+1);
                }
            }
        }
        return $return_str;
    }
    /**
     * 生成菜单select下拉框
     * @param array $menus
     * @param Model_Menu $current_menu
     * @return string
     */
    public static function generate_menu_option($menus, $name_field,$current_menu=null, $level=1)
    {
        $return_str = '';      
        if(is_array($menus)){
            foreach($menus as $menu){
                if(empty($current_menu) || $current_menu->id != $menu['id']){
                    $return_str .= '<option value="'.$menu['id'].'" '.(!empty($current_menu) && $current_menu->pid==$menu['id'] ? 'selected="selected"' : '').'>'.str_pad('', $level*2, '-').(isset($menu[$name_field]) ? $menu[$name_field] : '').'</option>';
                    if(isset($menu['children']) && !empty($menu['children'])){
                        $return_str .= self::generate_menu_option($menu['children'],$name_field,$current_menu, $level+1);
                    }
                }
            }
        }
        return $return_str;
    }
}

