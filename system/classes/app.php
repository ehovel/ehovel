<?php defined('SYSPATH') OR die('No direct script access allowed.');
// $Id$
/**
 * 应用对象
 * @copyright Copyright (c) 2012, Ketai inc.
 * @package App
 * @category App
 * @since 2012-04-25
 * @author fanchongyuan
 * @version $Id$
 */
class App {

    static protected $_instances = array();

    static protected $_model_config = array();

    private $_init = FALSE;

    private $_name = NULL; //应用的名称

    public $modules = NULL; //应用的模块列表

    /**
     * 获取应用实例
     * 
     * @param string $app_name
     * @return App
     */
    static public function instance($app_name)
    {
        if(empty($app_name))
        {
            throw new Exception(__('App instantiation failed.'));
        }
        $lwrname = strtolower($app_name);
        if (!isset(self::$_instances[$lwrname])) {
            $app_class = 'App_'.ucfirst($lwrname);
            self::$_instances[$lwrname] = new $app_class();
            self::$_instances[$lwrname]->_name = $lwrname;
        }
        return self::$_instances[$lwrname];
    }

    
    /**
     * 屏蔽构造函数
     */
    private function __construct()
    {
    }
    
    /**
     * 初始化类
     * @access public
     * @return Object App
     * @author fanchongyuan
     * @example 
     */
    public function init() 
    {
        if(!$this->_init)
        {
            $this->load_modules();
        }
        return $this;
    }

    /** 
     * 加载APP模块
     * @access public
     * @return Object app
     * @author fanchongyuan
     * @example 
     */
    public function load_modules()
    {
        $modules = Kohana::$config->load('modules.modules');
        if(!empty($modules) && is_array($modules))
        {
            $this->modules = Kohana::modules($modules);
        }
        return $this;
    }

    /**
     * 判断模块是否加载
     * @access public
     * @param string $module_name
     * @return bool
     * @throw Kohana_Exception
     * @author fanchongyuan
     * @example 
     */
    public function loaded($module_name)
    {
        if(!empty($this->modules) && isset($this->modules[$module_name]))
        {
            return TRUE;
        }
        return FALSE;
    }


    /**
     * 简单模型配置，目前只支持配置出多站点模型与多语言模型，以后可以将引入更多的配置
     * @access public
     * @param $model string 模型名称
     * @return string
     * @author fanchongyuan
     * @example 
     */
    public function get_config($model)
    {
        $model_config = self::$_model_config;
        $model = strtolower($model);
        if(isset($model_config[$model]))
        {
            return $model_config[$model];
        }
        return NULL;
    }
    
    public function add_config(Config_Reader $config)
    {
        $model_config = self::$_model_config;
        $config_array = $config->as_array();
        if(!empty($config_array))
        {
            foreach($config_array as $model => $type)
            {
                $model = strtolower($model);
                $model_config[$model] = $type;
            }
        }
        self::$_model_config = $model_config;
        return self::$_model_config;
    }
}
