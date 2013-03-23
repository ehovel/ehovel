<?php defined('SYSPATH') OR die('No direct script access allowed.');

header('Cache-Control: no-store, no-cache, must-revalidate');     // HTTP/1.1
header('Cache-Control: pre-check=0, post-check=0, max-age=0');    // HTTP/1.1
header ("Pragma: no-cache"); 
/**
 * 后台控制器基类
 *
 * @copyright Copyright (c) 2013, ehovel inc.
 * @package Core
 * @category Controller
 * @since 2013-03-06 13:38
 * @author dpx
 * @version   $Id$
 */
class Controller_Admin_Base extends Controller {
    /**
     * 是否自动显示视图
     * 
     * @var bool
     */
    public $auto_render = TRUE;
    
    /**
     * 视图对象
     * 
     * @var object
     */
    public $template = NULL;
    
    /**
     * 要发送的 header 头信息
     * 
     * @var array
     */
    public $headers = array();
    
    public $_redirect = '';
    
    public $toolBar = '';
    
    /**
     * 当期控制器所属APP对象
     * 
     * @var App
     */
    public $app = NULL;
    
    public function __construct(Request $request, Response $response)
    {
    	Helper_Auth::add_config(Kohana::$config->load('core_node'));
        parent::__construct($request, $response);
    }
    
    /**
     * 操作前置回调，在操作运行前执行
     */
    public function before()
    {
        parent::before();
        $this->_redirect = URL::referrer();
    }
    
    /**
     * 操作后置回调，在操作运行后执行
     */
    public function after()
    {
        View::set_global('toolbar', $this->toolBar);
    	View::set_global_layout(View::factory('layout/default', array(
    	'header' => View::factory('header')->render(NULL, FALSE),
    	'footer' => View::factory('footer')->render(NULL, FALSE),
    	)));
    	if ($this->auto_render) {
    		if (!empty($this->headers)) {
    			foreach ($this->headers as $header) {
    				header($header);
    			}
    		}
    		echo $this->template;
			echo View::factory('profiler/stats')->render(null,false);
    	}
        parent::after();
    }
    
    /**
     * 发送 Header
     * 
     * @param string $header 
     */
    public function header($header)
    {
        $this->headers[] = $header;
    }
    
    /**
     * 获取 jqGrid 列表中 SELECT 检索项数据
     */
    public function action_searchoptions()
    {	
        try {
            $key = $this->request->query('key');
            if (!empty($key)) {
                $method = '_searchoptions_' . $key;
                if (method_exists($this, $method)) {
                    if ($this->request->is_ajax()) {
                    	exit(json_encode(array(
				                'status'   => 1,
				                'content'  => $this->$method(),
				            )));
                    } else {
                    	echo $this->$method();exit;
                    }
                } else {
                    throw new Kohana_Exception(__('Method ' . $method . ' not found'));
                }
            } else {
                throw new Kohana_Exception(__('Bad Request'));
            }
        } catch (Kohana_Exception $ex) {
           Message::set(Message::ERROR,$ex->getMessage());
        }
    }
    
    /**
     * 构造orm对象数据
     * @param object $model
     */
    protected function _prepareData(ORM &$model) {
		$modelColumns = $model->list_columns();
		if (!empty($modelColumns)) {
			foreach(array_keys($modelColumns) as $columnName) {
				$eformData = $this->request->post('eform');
				if (!isset($eformData[$columnName])) {
					continue;
				}
				if (!is_array($eformData[$columnName]) && $columnValue = trim($eformData[$columnName])) {
					$model->$columnName = $columnValue;
				}
			}
		}
    }
    
    /**
     * 执行跳转，默认当前控制器默认action
     * @param sring $redirect
     */
    protected function go($redirect = NULL) {
    	if (!is_null($redirect)) {
    		$this->_redirect = $redirect;
    	}
    	$this->redirect($this->_redirect);
    }
}
