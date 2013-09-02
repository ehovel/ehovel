<?php defined('SYSPATH') or die('No direct access script');
// $Id$
/**
 * 与站点有关的Helper类
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package Site
 * @category  Helper
 * @since 2011-11-25
 * @author dongxiaoyu
 * @version   $Id$
 */

class Helper_Site{
    
    /**
     * 取得站点的域名
     * @param string $name
     * @return string
     */
    public static function site_config($name)
    {
        static $site_config = null;
        if($site_config === null){
            foreach(EHOVEL::model('Site_Config')->find_all() as $config){
                $site_config[$config->name] = $config->value;
            }
        }
        return isset($site_config[$name]) ? $site_config[$name] : '';
    }
    /**
     * 生成前台菜单列表
     * @param string $key
     * @param array $css
     * @param array $menus
     * @param int $level
     * @return string
     */
    public static function generate_menu($key, $css, $menus=null, $level=1)
    {
        static $all_menus = NULL;
        $all_menus === NULL AND $all_menus = EHOVEL::model('Site_Menu')->get_menus_by_key($key);
        $menus = $menus===NULL ? $all_menus : $menus;
        $current_level_css = isset($css[$level]) ? $css[$level] : array();
        $return_str = '';
        if(!empty($current_level_css) && !empty($menus))
        {
            $return_str .= '<ul id="'.(isset($current_level_css['ul']['id']) ? $current_level_css['ul']['id'] : '').'" class="'.(isset($current_level_css['ul']['class']) ? $current_level_css['ul']['class'] : '').'">';
            foreach($menus as $menu){
        		$class = $menu['href']==URL::current() ? ' nav_item_current':'';
                $return_str .= '<li class="'.(isset($current_level_css['li']['class']) ? $current_level_css['li']['class'] : '').''.$class.'">';
                $return_str .= '<a class="'.(isset($current_level_css['a']) ? $current_level_css['a'] : '').'" href="'.(!empty($menu['href']) ? $menu['href'] : 'javascript:void(0);').'" '.($menu['target_blank']=='Y' ? 'target="_blank"' : '').'><span>'.$menu['name'].'</span></a>';
                $return_str .= self::generate_menu($key, $css, $menu['children'], $level+1);
                $return_str .= '</li>';
            }
            $return_str .= '</ul>'; 
        }
        return $return_str;
    }
    /**
     * 生成前台底部菜单(只显示一级菜单)
     * @param string $key
     * @return string
     */
    public static function generate_menu_footer($key)
    {
        $all_menus = EHOVEL::model('Site_Menu')->get_menus_by_key($key);
        $return_str = '';
        foreach($all_menus as $menu)
        {
        	$return_str .= '<dl class="footer_list">';
        	$return_str .= '<dt>'.$menu['name'].'</dt>';
        	foreach ($menu['children'] as $sub_menu){
        		$class = $menu['href']==URL::current() ? ' nav_item_current':'';
            	$return_str .= '<dd class="'.$class.'"><a href="'.(!empty($sub_menu['href']) ? $sub_menu['href'] : 'javascript:void(0);').'" '.($menu['target_blank']=='Y' ? 'target="_blank"' : '').'>'.$sub_menu['name'].'</a></dd>';
        	}
        	$return_str .= '</dl>';
        }
        return $return_str;
    }
    /**
     * 生成前台文案左侧导航(只显示一级菜单)
     * @param string $key
     * @return string
     */
    public static function generate_doc_menu($key)
    {
        $all_menus = EHOVEL::model('Site_Menu')->get_menus_by_key($key);
        $current_url_arr = array();
        $type = isset($_GET['type']) ? $_GET['type'] : '';
        $return_str = '<ul class="service_nav">';
        foreach($all_menus as $menu)
        {
            $class = ($menu['href']==str_replace(stristr(URL::current(true), '?'), '', URL::current(true))) ? 'class="selected"':'';
            $return_str .= '<li '.$class.'><a '.($menu['target_blank']=="Y"?"target=\"_blank\"":"").' href="'.(!empty($menu['href']) ? $menu['href'] : 'javascript:void(0);').'">'.$menu['name'].'</a></li>';
        }
        $return_str .= '</ul>';
        return $return_str;
    }

    /*
     * 获取前台banner(友链)
     */
	public function link($name=NULL)
    {
        $return = array();
        $site_link = EHOVEL::model('site_link');
        if (is_null($name))
        	$link_data = $site_link->find_all();
        else
        	$link_data = $site_link->where('key','=',$name)->find_all();	
        if($link_data)
        {
        	foreach($link_data as $link){
            	$return[] = $link->as_array();
        	}
        }
        return $return;
    }
    public function sites()
    {
    	$site_model = EHOVEL::model('site');
    	$sites = $site_model->get_sites();
    	return $sites;
    }
    
    public function get_username($user_id){
    	$user_model = EHOVEL::model('User',$user_id);
    	return $user_model->firstname.' '.$user_model->lastname;
    	
    }
    
    /**
     * 获取文案信息
     * Enter description here ...
     */
    public function docs($type,$num){
    	
    }
    
    /**
     * ads
     */
    public function ads($id,$type,$spaceid){
    	
    }
    

   /**
    * 列表页排版类型
    * 默认false
    */
   public function composition(){
   		$composition = Session::instance()->get('list_composition');
   		if ($composition)
   			return TRUE;
   		return FALSE;
   }
   /**
    * 设置站点信息共享
    */
    public static function set_transfer($user_id){
        $Cache = Cache::instance('file');
        $key = uniqid();
        $Cache->set('user_transfer_'.$key, $user_id, 60);
        return $key;
    }
   /**
    * 站点信息共享(用户)
    */
    public static function transfer($key){
        $Cache = Cache::instance('file');
        if($user_id = $Cache->get('user_transfer_'.$key)){
            $user = EHOVEL::model('User', $user_id);
            if($user->loaded()){
                $user->login_session();
                $Cache->delete('user_transfer_'.$key);
            }
        }
    }
}
