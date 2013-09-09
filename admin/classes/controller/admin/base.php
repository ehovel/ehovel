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
    public $profileShow = false;
    
    protected $_accessCheck = true;
    
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
        $session_id = NULL;
        if ($this->request->query('session_id')) {
            $session_id = $this->request->query('session_id');
        }
        //判断请求是否要验证登录
        $user = Model_Auth_Admin::get_current_user($session_id);
        if(empty($user) && !Helper_Auth::check_is_ignore_login($this->request->controller().'/'.$this->request->action())){
            if (!($redirect=$this->request->query('redirect'))){
                $redirect = Request::$current->url();
            }
            Message::set(Message::ERROR,__('Please login'));
            $this->redirect(EHOVEL::url('auth_admin/login', array('redirect' => $redirect)));
        }
        
        if(!empty($user))
        {
            //验证站点
            if(!$user->check_site())
            {
                Message::set(Message::ERROR,__('Account without permission, please contact the administrator assigned.'));
                $this->redirect(EHOVEL::url('index'));
            }
        
            //验证权限
            if(!Helper_Auth::check($this->request->controller().'/'.$this->request->action())){
                Message::set(Message::ERROR,__('Account without permission, please contact the administrator assigned.'));
                $this->redirect(EHOVEL::url('index'));
            }
        }
        $this->user = $user;
        
        parent::before();
        $urlReferrer = $this->request->referrer();
        $this->_redirect = $urlReferrer=='/' ? EHOVEL::admin_base_url() : $urlReferrer;
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
    		if ($this->profileShow) {
				echo View::factory('profiler/stats')->render(null,false);
    		}
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
		return $eformData;
    }
    
    /**
     * 统一处理表单提交的内容，分发给各控制器内相应方法处理
     */
    public function action_processlistform() {
    	$task = $this->request->post('task');
    	list($controller,$action) = explode('.', $task);
    	$processAction = '_do_list_form_'.$action;
    	$this->$processAction();
    	//TODO access controller
    	//$this->authorise($controller,$action);
    }
    
    /**
     * 验证权限 ....TODO
     * @param string $task 操作
     * @param string $taskId 操作的资源
     * @return boolean
     */
    public function authorise($task,$tastId = NULL)
    { 
    	return true;
    	// Only do access check if the aco section is set
    	if ($this->_accessCheck)
    	{
    		$user = EHOVEL::get_user();
    		return $user->authorise($user->id,$task, $tastId);
    	}
    	else
    	{
    		// Nothing set, nothing to check... so obviously it's ok :)
    		return true;
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
