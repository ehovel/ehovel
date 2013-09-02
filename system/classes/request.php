<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * 重写了请求流,增加了
 * @author E
 *
 */
class Request extends Kohana_Request {

    static protected $_init = FALSE;
    
    /**
     *
     *
     * @param string $uri
     * @param Cache $cache
     * @param array $injected_routes
     */
    public function __construct($uri, $client_params = array(), $allow_external = TRUE, $injected_routes = array())
    {
        if (Request::$_init === FALSE) {
            foreach (Kohana::modules() as $name => $path) {
                if (function_exists('init_' . $name . '_route_before')) {
                    call_user_func('init_' . $name . '_route_before');
                }
            }
        }
        parent::__construct($uri, $client_params, $allow_external, $injected_routes);
        if (Request::$_init === FALSE) {
            if (defined('LANGUAGE_ACCESSOR')) {
                if (!empty($_GET[LANGUAGE_ACCESSOR])) {
                    I18n::lang($_GET[LANGUAGE_ACCESSOR]);
                } else {
                    I18n::lang(LANGUAGE_DEFAULT);
                }
            }
    
            foreach (Kohana::modules() as $name => $path) {
                if (function_exists('init_' . $name . '_route_after')) {
                    call_user_func('init_' . $name . '_route_after');
                }
            }
        }
        Request::$_init = TRUE;
    }
    
    /**
     *
     * @access public
     * @return string
     * @author fanchongyuan
     * @example
     */
    public function ip_address()
    {
        if (($comma = strrpos(self::$client_ip, ',')) !== FALSE)
        {
            self::$client_ip = trim(substr(self::$client_ip, $comma + 1));
        }
        
        if (!valid::ip(self::$client_ip))
        {
            self::$client_ip = '0.0.0.0';
        }
    
        return self::$client_ip;
    }
    
}
