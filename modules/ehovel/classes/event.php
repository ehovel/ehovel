<?php defined('SYSPATH') OR die('No direct script access allowed.');

/**
 * 事件机制
 *
 */
class Event {
    /**
     * 事件处理器
     * 
     * @var array
     */
    static protected $_handlers = array();
    
    /**
     * 触发事件
     * 
     * @param string $key
     */
    static public function run($key)
    {
        $key = strtolower($key);
        if (isset(Event::$_handlers[$key])) {
            $params = array_slice(func_get_args(), 1);
            foreach (Event::$_handlers[$key] as $handler) {
                call_user_func_array($handler, $params);
            }
        }
    }
    
    /**
     * 添加事件处理器
     * 
     * @param string $key
     * @param string,array $handler
     * @return int  已设置事件处理器的数量
     */
    static public function add_handler($key, $handler)
    {
        $key = strtolower($key);
        if (!isset(Event::$_handlers[$key])) {
            Event::$_handlers[$key] = array();
        }
        return array_push(Event::$_handlers[$key], $handler);
    }
    
    /**
     * 判断是否已设置事件处理器
     * 
     * @param string $key
     * @return int  事件处理器的数量
     */
    static public function has_handler($key)
    {
        return isset(Event::$_handlers[strtolower($key)]) ? count(Event::$_handlers[strtolower($key)]) : 0;
    }
}