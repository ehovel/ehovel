<?php defined('SYSPATH') or die('No direct script access.');
/**
 * 重写view,增加全局布局，即网站公用的头尾
 * 
 */
class View extends Kohana_View {
	
	/**
	 * 默认全局布局
	 * @var object
	 */
	static protected $_global_layout = NULL;
    
    /**
     * 布局
     * 
     * @var object
     */
    protected $_layout = NULL;
    
    /**
     * 获取全局数据
     * 
     * @param string $key
     * @return mixed
     */
    static public function get_global($key)
    {
        return isset(View::$_global_data[$key]) ? View::$_global_data : NULL;
    }
    
    /**
     * 设置全局数据
     * 重写
     * @param mixed $key
     * @param mixed $value
     * @param bool $merge 
     */
    static public function set_global($key, $value = NULL, $merge = FALSE)
    {
        if ($merge == FALSE) {
            parent::set_global($key, $value);
        } elseif (is_array($value)) {
            if (!isset(View::$_global_data[$key]) OR !is_array(View::$_global_data[$key])) {
                View::$_global_data[$key] = array();
            }
            View::$_global_data[$key] = array_merge(View::$_global_data[$key], $value);
        }
    }
    
    /**
     * 设置全局布局
     * 
     * @param View $layout
     */
    static public function set_global_layout(View $layout)
    {
        View::$_global_layout = $layout;
    }
    
    /**
     * 设置布局
     * 
     * @param View $layout 
     */
    public function set_layout(View $layout)
    {
        $this->_layout = $layout;
    }
    
    /**
     * 获取布局
     * 
     * @return View
     */
    public function get_layout()
    {
        return !is_null($this->_layout) ? $this->_layout : View::$_global_layout;
    }
    
    /**
     * 重写render，增加是否输出布局
     * @param string $file
     * @param bool $with_layout
     * @return string
     */
    public function render($file = NULL, $with_layout = TRUE)
    {
        if ($with_layout) {
            $layout = $this->get_layout();
            if (!empty($layout)) {
                $layout->content = parent::render($file);
                return $layout->render(NULL, FALSE);
            }
        }
        return parent::render($file);
    }
    
    /**
     * 重写，更改模板文件位置
     *
     * $view->set_filename($file);
     *
     * @param   string  view filename
     * @return  View
     * @throws  Kohana_View_Exception
     */
    public function set_filename($file)
    {
        if(defined('THEME'))
        {
            $path = DOCROOT.'themes'.DIRECTORY_SEPARATOR.THEME.DIRECTORY_SEPARATOR.$file.EXT;
            if (!is_file($path))
            {
            	if (($path = Kohana::find_file('views', $file)) === FALSE)
            	{
            		throw new View_Exception('The requested view :file could not be found', array(
            				':file' => $file,
            		));
            	}
            }
            $this->_file = $path;
            return $this;
        }
        return parent::set_filename($file);
    }
}
