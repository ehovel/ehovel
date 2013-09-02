<?php defined('SYSPATH') OR die('No direct script access allowed.');
// $Id$
/**
 * 前台应用对象
 * @copyright Copyright (c) 2012, Ketai inc.
 * @package App
 * @category App
 * @since 2012-04-25
 * @author fanchongyuan
 * @version $Id$
 */
class App_Front extends App {
    
    /** 
     * 获取前台应用站点ID
     * @access public
     * @return int
     * @author fanchongyuan
     * @example 
     */
    public function get_site()
    {
        $site_id = 1;//EHOVEL::registry('site_id');
        if(empty($site_id))
        {
            $domain_url = isset($_SERVER['HTTP_X_FORWARDED_HOST']) ?
                $_SERVER['HTTP_X_FORWARDED_HOST'] :
                (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '');
            $domain = explode(':', $domain_url);
            $domain = $domain[0];
            if ($domain)
            	$site_model = EHOVEL::model('site')->where('domain','=',$domain)->find();
            if (!$site_model || !$site_model->id)
            	$site_model = EHOVEL::model('site')->where('is_default','=','Y')->find();
            
            EHOVEL::register('site_id',$site_model->id);
        }
        return $site_id;
    }
    /** 
     * 获取前台应用站点ID
     * @access public
     * @return int
     * @author fanchongyuan
     * @example 
     */
    public function get_current_site()
    {
        $site_id = EHOVEL::registry('site_id');
        if(empty($site_id)){
            $site_id = $this->get_site();
        }
        return EHOVEL::model('Site', $site_id);
    }

    /** 
     * 获取栏目ID
     * @access public
     * @return int
     * @author fanchongyuan
     * @example 
     */
    public function get_column()
    {
      //$column_id = Session::instance()->get('current_column_id');
      //if(empty($column_id))
      //{
      return 0;
      //}
      //return $column_id;
    }
}
