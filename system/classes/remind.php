<?php defined('SYSPATH') OR die('No direct script access allowed.');

/**
 * 提醒信息管理
 *
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package Core
 * @category BES
 * @since 2011-12-05 下午2:38
 * @author wang.hao
 * @version   $Id$
 */
class Remind {
    
    /**
     * 提醒类型：错误
     * 
     * @var int
     */
    const TYPE_ERROR   = 0;
    /**
     * 提醒类型：成功
     * 
     * @var int
     */
    const TYPE_SUCCESS = 1;
    /**
     * 提醒类型：警告
     * 
     * @var int
     */
    const TYPE_WARNING = 2;
    
    /**
     * CSS 类
     * 
     * @var array
     */
    static protected $_classes = array(
        0 => 'error',
        1 => 'success',
        2 => 'warning',
    );
    
    /**
     * 提醒ID在URL当中的参数名称
     * 
     * @var string
     */
    const KEY_ACCESSOR = 'r_key';
    
    /**
     * 当前请求对象
     * 
     * @var object
     */
    protected $_request = NULL;
    
    /**
     * 提醒类型
     * 
     * @var int
     */
    protected $_type     = 0;
    /**
     * 提醒代码
     * 
     * @var int
     */
    protected $_code     = 0;
    /**
     * 提醒内容
     * 
     * @var string
     */
    protected $_message  = '';
    /**
     * 跳转页面地址
     * 
     * @var string
     */
    protected $_redirect = '';
    /**
     * 提醒内容
     * 
     * @var array
     */
    protected $_content  = array();
    
    /**
     *
     * @param int,object $type
     * @return Remind
     */
    static public function factory($type)
    {
        return new Remind($type);
    }
    
    /**
     * 根据提醒 KEY 获取提醒信息
     * 
     * @param string $key
     * @return array
     */
    static public function get($key)
    {
        return Session::instance()->get_once('remind_' . $key);
    }
    
    /**
     * 获取当前页面的提醒信息
     * 
     * @return array
     */
    static public function current()
    {
        return Remind::get(Arr::get($_GET, Remind::KEY_ACCESSOR, ''));
    }
    /**
     * 前台渲染提醒
     * 
     * @param array $remind 
     */
    static public function render_front()
    {
        $remind = Remind::current();
        $classes = array(
            0 => 'remind_error',
            1 => 'remind_success',
            2 => 'remind_notice',
            3 => 'remind_note',
        );
        if (is_array($remind)) {
            $class = isset($classes[$remind['type']]) ? $classes[$remind['type']] : '';
            $message = '';
            if (!empty($remind['message'])) {
                if (is_array($remind['message'])) {
                    foreach($remind['message'] as $mes){
                        $message .= '<p>'.$mes.'</p>';
                    }
                }else{
                    $message = '<p>'.$remind['message'].'</p>';
                }
            }
            echo '<div class="remind '. $class .' msg">' . $message . ' <span class="remind_close">close</span></div>';
        }
    }
    
    /**
     * 渲染提醒
     * 
     * @param array $remind 
     */
    static public function render($remind)
    {
        if (is_array($remind)) {
            $class = '';
            if (isset($remind['type']) AND isset(Remind::$_classes[$remind['type']])) {
                $class = Remind::$_classes[$remind['type']];
            }
            
            $message = '';
            if (!empty($remind['message'])) {
                $message = $remind['message'];
                if (is_array($message)) {
                    $message = implode('<br/>', $message);
                }
            }
            
            echo '<div class="'. $class .' msg">' . $message . '</div>';
        }
    }
    
    /**
     * 渲染当前提醒
     */
    static public function render_current()
    {
        Remind::render(Remind::current());
    }
    
    /**
     * 对象初始化
     * 
     * @param string,object $type
     */
    protected function __construct($type)
    {
        $this->_request  = Request::current();
        $redirect = $this->_request->post('redirect');
        if(!empty($redirect))
        {
            $this->_redirect = $redirect;
        } else {
            $this->_redirect = BES::url($this->_request->controller());
        }
        switch (TRUE) {
            case $type instanceof Exception:
                $this->type(Remind::TYPE_ERROR);
                $this->code($type->getCode());
                $this->message($type->getMessage());
                break;
            case $type == Remind::TYPE_ERROR:
                $this->type(Remind::TYPE_ERROR);
                break;
            case $type == Remind::TYPE_SUCCESS:
                $this->type(Remind::TYPE_SUCCESS);
                break;
            default:
                exit('Remind Type Error.');
        }
    }
    
    /**
     * 设置提醒类型
     * 
     * @param int $type
     * @return Remind 
     */
    public function type($type)
    {
        $this->_type = $type;
        return $this;
    }
    
    /**
     * 设置提醒代码
     *
     * @param int $code
     * @return Remind 
     */
    public function code($code)
    {
        $this->_code = $code;
        return $this;
    }
    
    /**
     * 设置提醒提醒
     * 
     * @param string $message
     * @return Remind 
     */
    public function message($message)
    {
        $this->_message = $message;
        return $this;
    }
    
    /**
     * 设置提醒重定向页面
     * 
     * @param string $redirect
     * @return Remind 
     */
    public function redirect($redirect)
    {
        $this->_redirect = $redirect;
        return $this;
    }
    
    /**
     * 设置提醒内容
     * 
     * @param array $content
     * @return Remind 
     */
    public function content($content)
    {
        $this->_content = $content;
        return $this;
    }
    
    /**
     * 发送提醒
     */
    public function send($ajax = FALSE)
    {
        if ($ajax == TRUE OR $this->_request->is_ajax()) {
            exit(json_encode(array(
                'status'   => $this->_type,
                'code'     => $this->_code,
                'msg'      => $this->_message,
                'content'  => $this->_content,
                'redirect' => $this->_redirect,
            )));
        } else {
            $key = uniqid();
            Session::instance()->set('remind_' . $key, array(
                'type'    => $this->_type,
                'code'    => $this->_code,
                'message' => $this->_message,
                'content' => $this->_content,
            ));
            if (strpos($this->_redirect, '?') === FALSE) {
                $redirect = $this->_redirect . '?' . Remind::KEY_ACCESSOR . '=' . $key;
            } else {
                $redirect = $this->_redirect . '&' . Remind::KEY_ACCESSOR . '=' . $key;
            }
            $this->_request->redirect($redirect, 200);
        }
    }
}
