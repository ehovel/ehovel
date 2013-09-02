<?php defined('SYSPATH') OR die('No direct script access allowed.');
// $Id$
/**
 * 后台应用对象
 * @copyright Copyright (c) 2012, Ketai inc.
 * @package App
 * @category App
 * @since 2012-04-25
 * @author fanchongyuan
 * @version $Id$
 */
class App_Admin extends App {
    
    /** 
     * 获取后台应用站点ID
     * @access public
     * @return int
     * @author fanchongyuan
     * @example 
     */
    public function get_site()
    {
        $site_id = EHOVEL::registry('site_id');
        if(empty($site_id))
        {
            $session = Session::instance();
            $site_id = $session->get('site_id');
            EHOVEL::register('site_id',$site_id);
        }
        return $site_id;
    }
    
    public function set_site($site_id)
    {
        if(!empty($site_id) && is_numeric($site_id) && $site_id >0)
        {
            $session = Session::instance();
            $session->set('site_id', $site_id);
        }
    }

    public function clear_site()
    {
        $session = Session::instance();
        $session->delete('site_id');
    }

}
