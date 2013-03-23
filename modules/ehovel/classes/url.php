<?php defined('SYSPATH') OR die('No direct script access allowed.');
/**
 * URL管理
 *
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package Core
 * @category BES
 * @since 2011-12-05 下午1:34
 * @author wang.hao
 * @version   $Id$
 */
class URL extends Kohana_URL
{
	/*
	 * 获取前台地址
	 * @static
     * @param  $controller
     * @param string $action
     * @param array $param
     * @return string
     *
     * @example URL::admin('manage_role','edit',array('id'=>1));
	 */
	public static function front($controller, $action = 'index', $param = array()){
        if ($controller == '#') {
            return 'javascript:;';
        } elseif (substr($controller, 0, 7) == 'http://') {
            return $controller;
        } else {
            if (empty($action)) {
                $action = 'index';
            }
            $name = $controller.'/'.$action;
            if (Route::is_set($name)) {//print_r(Route::url($name, $param));exit;
                return Route::url($name, $param);
            } else {
                $url = BES::front_base_url() . $name;
                $param_str = '';
                if (is_array($param)) {
                    if (count($param) > 0) {
                        $param_arr = array();
                        foreach ($param as $key => $item) {
                            $param_arr[] = $key . '=' . urlencode($item);
                        }
                        if (count($param_arr) > 0) {
                            $param_str = implode('&', $param_arr);
                        }
                    }
                } else {
                    $param_str = $param;
                }
                if (!empty($param_str)) {
                    $url = $url . '?' . $param_str;
                } else {
                    $url = $url;
                }
                return $url;
            }
        }
    }
    /**
     * 获取当前页面的URL
     * @static
     * @param bool $_get
     * @return string
     */
    public static function current($_get = TRUE)
    {
        return EHOVEL::url(Request::current()->controller() . '/' . Request::current()->action(), $_get ? $_GET : array());
    }

    /**
     * 获取来源页面
     * @access public
     * @return string
     * @throws MyRuntimeException
     * @author fanchongyuan
     * @example 
     */
    public static function referrer()
    {
        $referrer = Request::current()->referrer();
        if(empty($referrer))
        {
            $referrer = url::base();
        }
        return $referrer;
    }
}
