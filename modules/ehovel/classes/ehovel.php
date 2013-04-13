<?php defined('SYSPATH') OR die('No direct script access allowed.');

class EHOVEL {

	private static $_helpers = array();

    private static $_app = NULL;

    private static $_registry = array();

    /**
     * 获取 APP 实例
     * 
     * @param string $app_name
     * @return App
     */
    public static function app($app_name = NULL)
    {
        if($app_name == NULL)
        {
            $app_name = APPNAME;
        }
        if(self::$_app === NULL)
        {
            self::$_app = App::instance($app_name);
        }
        return self::$_app;
    }
    
    /**
     * 获取配置信息
     * 
     * @param string $group
     * @return mixed
     */
    public static function config($group)
    {
        if(self::app()->loaded('site'))
        {
            $value = BES::model('Site_Config')->getc($group);
        }
        if (!empty($value)) {
            return $value;
        } else {
            return Kohana::config($group);
        }
    }
    
    /**
     * 获取模型对象
     * 
     * @param string $model
     * @param int $id
     * @return Model 
     */
    public static function model($model, $id = NULL)
    {
        $model_instance = ORM::factory($model, $id);
        return $model_instance;
    }

    /** 
     * 获取单例实例
     * @access public
     * @param $model string
     * @return obj
     * @author fanchongyuan
     * @example 
     */
    public static function getSingleton($model='')
    {
        //TODO 单例类的构造方法如果需要有初始化的参数，此方法不适用。需要引入系统基础类，所有单例类继承此基础类
        $registryKey = '_singleton/'.$modelClass;
        if (!self::registry($registryKey)) {
            self::register($registryKey, self::model($modelClass));
        }
        return self::registry($registryKey);
    }
    
    /**
     * 获取视图对象
     * 
     * @param string $file
     * @param array $data
     * @return View
     */
    public static function view($file, array $data = array())
    {
        return View::factory($file, $data);
    }
    
    /**
     * 创建 URL
     * 
     * @param string $uri
     * @param array $params
     * @return string
     */
    public static function url($uri, $params = array(),$route_rule = 'default')
    {
        if (defined('LANGUAGE_ACCESSOR')) {
            if (empty($params[LANGUAGE_ACCESSOR]) AND !empty($_GET[LANGUAGE_ACCESSOR]) AND $_GET[LANGUAGE_ACCESSOR] !== LANGUAGE_DEFAULT) {
                $params[LANGUAGE_ACCESSOR] = $_GET[LANGUAGE_ACCESSOR];
            } elseif (empty($params[LANGUAGE_ACCESSOR]) OR $params[LANGUAGE_ACCESSOR] === LANGUAGE_DEFAULT) {
                unset($params[LANGUAGE_ACCESSOR]);
            }
        }
        
        if (Route::is_set($uri)) {
            return Route::url($uri, $params);
        } else {
            $params['controller']  = NULL;
            $params['action']      = NULL;
            
            $explode = explode('/', $uri);
            if (isset($explode[0]) AND strtolower($explode[0]) !== 'index') {
                $params['controller'] = $explode[0];
            }
            if (isset($explode[1]) AND strtolower($explode[1]) !== 'index') {
                $params['action'] = $explode[1];
            }
            
            return Route::url($route_rule, $params);
        }
    }
    
    /**
     * 引入 css 文件
     * 
     * @param string $css
     * @return HTML 
     */
    public static function css($css)
    {
        $html = '';
        foreach (explode('#', $css) as $css) {
            $html .= '<link rel="stylesheet" type="text/css" href="/statics/css/' . trim($css) . '.css">' . PHP_EOL;
        }
        return $html;
    }
    
    /**
     * 引入 JS 文件
     * 
     * @param string $js
     * @return HTML
     */
    public static function js($js)
    {
        $html = '';
        foreach (explode('#', $js) as $js) {
            $html .= '<script type="text/javascript" src="/statics/js/' . trim($js) . '.js"></script>' . PHP_EOL;
        }
        return $html;
    }
    
    /**
     * 启动上传功能
     * 
     * @param array $params
     * @return string
     */
    public static function upload(array $params)
    {
        return Uploader::factory($params);
    }
    
    /**
     * 获取上传文件URL
     * 
     * @param string $uri
     * @param string $size
     * @return string
     */
    public static function upload_url($uri, $size = NULL)
    {
        // 支持设置多个URL前缀
        static $base_url = NULL;
        static $rand_max = NULL;
        if ($base_url === NULL) {
            $base_url = (array)BES::config('upload.base_url');
            $rand_max = count($base_url) - 1;
        }
        //默认图片
        if(empty($uri))
        {
            $uri = BES::config('product.product_image_default');
        }
        
        if (!empty($uri)) {
            // $size 参数格式必须为 
            if (preg_match('/^\d+x\d+$/i', $size)) {
                $size .= '/';
            } else {
                $size = NULL;
            }
            // 仅有图片允许 $size 参数
            if (!in_array(strtolower(pathinfo($uri, PATHINFO_EXTENSION)), BES::config('upload.image_formats'))) {
                $size = NULL;
            }
            
            return $base_url[rand(0, $rand_max)] . $size . ltrim($uri, '/');
        } else {
            return '';
        }
    }
    
/**
     * 调用系统的Helper类
     * @static
     * @param  Helper 名称 $alias
     * @return mixed
     * @example
     * <pre>
     * Kapp::helper('grid')->render();
     * </pre>
     */
    public static function helper ($alias, $params = NULL)
    {
        // 获取完整的 Helper 类名称
        $class_name = 'Helper_' . $alias;

        // 获取该类在属性 $_helpers 中的索引
        $key = strtolower($class_name);
        if (!is_null($params))
            $key .= '_' . md5(serialize($params));

        // 当类未实例化时，实例化类
        if (!isset(self::$_helpers[$key]))
            self::$_helpers[$key] = new $class_name($params);

        return self::$_helpers[$key];
    }

    /**
     * 记录日志
     * @static
     * @return void
     */
    public static function log ($message)
    {
        Kohana::$log->add(Log::ERROR, $message)->write();
    }

    /**
     * 注册全局变量，在业务逻辑中尽量不用，全局变量会带来代码业务逻辑上的混乱，除非希望使用单例或者初始化全局资源
     * @access public
     * @param $key mix
     * @param $value mix 
     * @throw Exception_BES
     * @author fanchongyuan
     * @example 
     */
    public static function register($key, $value)
    {
        if (isset(self::$_registry[$key])) 
        {
            //不允许重复注册全局变量及修改值
            throw new Exception_BES(__('registry key "'.$key.'" already exists'));
        }
        self::$_registry[$key] = $value;
    }

    /**
     * 释放全局变量
     * @access public
     * @param $key mix
     * @author fanchongyuan
     * @example 
     */
    public static function unregister($key)
    {
        if (isset(self::$_registry[$key])) {
            if (is_object(self::$_registry[$key]) && (method_exists(self::$_registry[$key], '__destruct'))) {
                self::$_registry[$key]->__destruct();
            }
            unset(self::$_registry[$key]);
        }
    }

    /**
     * 获取全局变量的值
     * @access public
     * @param $key mix
     * @return mix
     * @author fanchongyuan
     * @example 
     */
    public static function registry($key)
    {
        if (isset(self::$_registry[$key])) {
            return self::$_registry[$key];
        }
        return null;
    }

    /**
     * 获取应用的站点ID
     * @access public
     * @return int
     * @author fanchongyuan
     * @example 
     */
    public static function get_site()
    {
        return self::app()->get_site();
    }
    /**
     * 获取当前的站点
     * @access public
     * @return int
     * @author 朱彬
     * @example 
     */
    public static function get_current_site()
    {
        return self::app()->get_current_site();
    }

    /**
     * 获取应用的语言ID
     * @access public
     * @return int
     * @author fanchongyuan
     * @example 
     */
    public static function get_lang()
    {
        //此项目多站点与多语言一样
        return self::app()->get_site();
    }

    /**
     * 简单模型配置，目前只支持配置出多站点模型与多语言模型，以后可以将引入更多的配置
     * @access public
     * @param $model string 模型名称
     * @return string
     * @author fanchongyuan
     * @example 
     */
    public static function get_config($model)
    {
        return self::app()->get_config($model);
    }

    /**
     * 获取应用的栏目ID
     * @access public
     * @return int
     * @author fanchongyuan
     * @example 
     */
    public static function get_column()
    {
        return self::app()->get_column();
    }
	
	/**
     * 管理后台根链接
     * @static
     * @return string
     */
    public static function admin_base_url ()
    {
        return url::base() . 'admin/';
    }
    /**
     * 前台根链接
     * @static 
     * @return string
     */
    public static function front_base_url (){
        return url::base();
    }
    
    public static function get_user() {
    	$auth = Auth::instance();
    	$auth->get_user();
    	return 1;
    }
}
