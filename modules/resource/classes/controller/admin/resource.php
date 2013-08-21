<?php defined('SYSPATH') or die('No direct script access.');
/**
 * 资源控制器
 * 图片可以加入资源，也可以不加入，加入资源的图片可以增加描述信息等内容
 */
class Controller_Admin_Resource extends Controller_Admin_Base
{
    /**
     * @access public
     * @var int 站点id
     */
    public $site_id;

	public function before()
	{
		parent::before();
	}

    /**
     * 初始化资源标签列表数据
     */
    public function action_index()
    {
        //收集请求数据
        $catalog_id = intval($this->request->query('catalog'));
        $name = trim($this->request->query('name'));
        
        //分类
        $catalog = ORM::factory('resource_catalog')->order_by('date_add', 'DESC')->find_all();
        $catalog = ORM::factory('resource_catalog')->tree($catalog);
        
		$resourceObject = ORM::factory('resource');
		if(!empty($catalog_id)) {
		    $resourceObject = $resourceObject->where('catalog_id', '=', $catalog_id);
		}
		if(!empty($name)) {
		    $resourceObject = $resourceObject->where('name', 'LIKE', "%$name%");
		}
		$resourceObjectClone = clone $resourceObject;
		$count = $resourceObjectClone->count_all();
		$pagination = Pagination::factory(
			array(
				'total_items' => $count,
				'items_per_page' => 12,
				'view' => 'pagination/floating',
			)
		);
		$page = $this->request->query('page');
		$page = $page?$page:1;
		$resourceObject->order_by('date_add','DESC');
		$resourceObject->offset(($page - 1) * 12);
		$resourceObject->limit(12);
		$resources = $resourceObject->find_all()->as_array();
		
		$toolBarhelper = Helper_Toolbar::getInstance();
		$toolBarhelper->appendButton('plus','新建','resource.add');
		$toolBarhelper->appendButton('remove','批量删除','resource.delete');
		$this->toolBar =  $toolBarhelper->render();
		
		$this->template = view::factory('resource_list', array(
		    'catalog' => $catalog,
		    'catalog_id' => $catalog_id,
		    'name' => $name,
			'resources' => $resources,
			'pagination'=>$pagination
		));
            
    }

    /**
     * ueditor 上传资源
     * 添加一个资源.添加到资源表
     */
    public function action_ueupload()
    {
    	header("Content-Type: text/html; charset=utf-8");
    	error_reporting(E_ERROR | E_WARNING);
    	//上传图片框中的描述表单名称，
    	$title = htmlspecialchars($_POST['pictitle'], ENT_QUOTES);
    	//分类目录
    	$path = htmlspecialchars($_POST['dir'], ENT_QUOTES);
    	//上传配置
    	$config = array(
    			"savePath" => ($path == "1" ? "upload/" : "upload1/"),
    			"maxSize" => 1000, //单位KB
    			"allowFiles" => array(".gif", ".png", ".jpg", ".jpeg", ".bmp")
    	);
    	$up = Uploader::factory("upfile", $config);
    	
    	 /**
	     * 得到上传文件所对应的各个参数,数组结构
	     * array(
	     *     "originalName" => "",   //原始文件名
	     *     "name" => "",           //新文件名
	     *     "url" => "",            //返回的地址
	     *     "size" => "",           //文件大小
	     *     "type" => "" ,          //文件类型
	     *     "state" => ""           //上传状态，上传成功时必须返回"SUCCESS"
	     * )
	     */
	    $info = $up->getFileInfo();
	
	    /**
	     * 向浏览器返回数据json数据
	     * {
	     *   'url'      :'a.jpg',   //保存后的文件路径
	     *   'title'    :'hello',   //文件描述，对图片来说在前端会添加到title属性上
	     *   'original' :'b.jpg',   //原始文件名
	     *   'state'    :'SUCCESS'  //上传状态，成功时返回SUCCESS,其他任何值将原样返回至图片上传框中
	     * }
	     */
	    $info = $up->getFileInfo();
		if ($info['url']) {
			$ossNameExt = explode('.', $info['url']);
			$ossName = $ossNameExt[0];
			$ossExt = $ossNameExt[1];
			$resourceData = array(
					'name' => $info['name'],
					'postfix' => $ossExt,
					'catalog_id'=>1,
					'attach_id'=>$ossName,
					);
			$this->_do_add($resourceData);
		}
	    echo "{'url':'" . $info["url"] . "','title':'" . $title . "','original':'" . $info["originalName"] . "','state':'" . $info["state"] . "'}";

	    exit;
    }
    
    /**
     * ueditor 资源管理 TODO 资源分页,搜索
     * 添加一个资源.添加到资源表
     */
    public function action_ueimagemanage() {
    	$query = DB::select('attach_id','postfix')->from('resources')->where('site_id','=','0');
    	$pagination_query = clone $query;
    	$count = $pagination_query->select(DB::expr('COUNT(1) AS mycount'))->execute()->get('mycount');
    	$pagination = Pagination::factory(array(
    			'total_items' => $count,
    			'current_page'   => array('source' => 'route', 'key' => 'page'),
    			'items_per_page' => 200,
    			'view'           => 'pagination/basic',
    			'auto_hide'      => TRUE,
    	));
    	$query->order_by('date_add', 'desc')
    			->limit($pagination->items_per_page)
    			->offset($pagination->offset);
    	$results = $query->execute()->as_array('attach_id');
		$files = array();$str = "";
		foreach ( $results as $value ) {
			$str .= $value['attach_id'].'-120x120.'.$value['postfix'] . "ue_separate_ue";
		}
		print_r($str);exit;
    }
    
    /**
     * TODO资源ajax搜索
     */
    public function action_search()
    {
        $return_struct = array (
                'status' => 0,
                'code' => 501,
                'msg' => 'Not Implemented',
                'content' => array ()
        );
        try {
            //收集请求数据
            $id = trim($this->request->query('id'));
            $catalog_id = intval($this->request->query('catalog'));
            $name = trim($this->request->query('name'));
            $postfixs = $this->_get_postfixs();
            $multi = intval($this->request->query('multi'));
    
            //文件夹
            $catalog = BES::model('resource_catalog')->order_by('date_add', 'DESC')->find_all();
            $catalog = BES::model('resource_catalog')->tree($catalog);
    
            //资源
            $model_upload = BES::model('upload');
            if(!empty($catalog_id)) {
                $model_upload = $model_upload->where('catalog_id', '=', $catalog_id);
            }
            if(!empty($name)) {
                $model_upload = $model_upload->where('name', 'LIKE', "%$name%");
            }
            if(!empty($postfixs)) {
                $model_upload = $model_upload->where('extension', 'IN', $postfixs);
            }
            $model = clone $model_upload;
            $count = $model_upload->count_all();
    
            //分页
            $this->pagination = new PaginationAdmin(array(
                    'total_items'    => $count,
                    'items_per_page' => $this->per_page,
                    'first_page_in_url' => $id
            ));
    
            //列表
            $data = $model->order_by('date_add', 'DESC')->offset($this->pagination->offset)->limit($this->per_page)->find_all();
            $this->pagination = $this->pagination->render('resource_search_page');
    
            //模板
            $result = BES::view('resource_search', array('id' => $id, 'count' => $count, 'data' => $data, 'pagination' => $this->pagination, 'catalog' => $catalog, 'catalog_id' => $catalog_id, 'name' => $name, 'multi' => $multi))->render(NULL,FALSE);
            exit(json_encode(array(
                    'status' => 1,
                    'code' => 200,
                    'content'=> array(
                            'catalog_id' => $catalog_id,
                            'name' => $name,
                            'data' => (string)$result
                    ),
            )));
        } catch ( Exception_BES $ex ) {
            $this->_ex($ex, $return_struct);
        }
    }
    
    /**
     * 资源弹出窗的资源库列表
     */
    public function action_uploadlist($return = FALSE) {
        $resourceObject = ORM::factory('resource');
		$resourceObjectClone = clone $resourceObject;
		$count = $resourceObjectClone->count_all();
		$pagination = Pagination::factory(
			array(
				'total_items' => $count,
				'items_per_page' => 12,
				'view' => 'pagination/floating',
			)
		);
		$page = $this->request->query('page');
		$page = $page?$page:1;
		$resourceObject->order_by('date_add','DESC');
		$resourceObject->offset(($page - 1) * 12);
		$resourceObject->limit(12);
		$resources = $resourceObject->find_all()->as_array();
        
		$result = view::factory('resource_listdialog', array(
                'resources' => $resources,
                'pagination'=>$pagination
        ))->render(NULL,false);
        if($return) {
            return $result;
        } else {
            echo $result; 
        }
        exit;
    }
    /**
     * 资源弹出窗的上传处理
     */
    public function action_uploaddialog() {
    	if ($_POST) {
    		$verifyToken = md5('unique_salt' . $_POST['timestamp']);
    		if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
    			//客户端对应的文件对象的名称
    			$fileName = (isset($_POST['customFileName']) && $_POST['customFileName']) ? $_POST['customFileName'] : $_POST['Filename'];
    			$catalogId = (isset($_POST['catalogId']) && $_POST['catalogId']) ? $_POST['catalogId'] : 0;
    			//待保存数据
    			$up = Uploader::factory("upload");
    			$info = $up->getFileInfo();
    			if ($info['url']) {
    				$ossNameExt = explode('.', $info['url']);
    				$ossName = $ossNameExt[0];
    				$ossExt = $ossNameExt[1];
    				$resourceData = array(
    						'name' => $fileName,
    						'postfix' => $ossExt,
    						'catalog_id'=>$catalogId,
    						'attach_id'=>$ossName,
    						);
    				$resourceId = $this->_do_add($resourceData);
    				if ($resourceId) {
    				    $info['resource_id'] = $resourceId;
    				    $info['url'] = Helper_Resource::getLinkByResourceId($resourceId);
    				}
    				echo json_encode($info);exit;
    			} else {
    				echo '上传错误';
    			}
    			exit;
    		}
    	} else {
    	    $resourceList = $this->action_uploadlist(TRUE);
    		echo View::factory('resource_uploaddialog',array('resourceList'=>$resourceList))
    		->render(null,false);exit;
    	}
    }

    public function action_add() {
        echo 'TODO：添加资源页面';
    }
    /**
     * 编辑一个资源
     */
    public function action_edit()
    {
    	$this->profileShow = false;
    	$resource = EHOVEL::model('resource', intval($this->request->param('id')));
    	if ($resource->loaded())
    	{
	    	if (!empty($_POST))
	    	{
	    		$this->_prepareData($resource);
	    		$resource->save();
	    		if ($resource->saved()) {
	    			Message::set(Message::SUCCESS, __('Save successed'));
	    		} else {
	    			Message::set(Message::ERROR, $resource->validation()->errors());
	    		}
	    	}
    		echo View::factory('resource_form')
    			->set('resource',$resource->as_array())
    			->render(null,false);
    	} else {
    	    echo 'Load failed';
    	}
    	exit;
    }


    /**
     * 删除资源
     */
    public function action_delete()
    {
            //收集请求参数
            $request_ids = $this->request->query('ids');
            //权限及数据验证
            if ($this->site_id == 0) {
                
            }
            if (empty($request_ids)) {
                
            }
            $error_sign = 0;
            $resource_ids = explode('-', $request_ids);
            foreach ($resource_ids as $resource_id)
            {
            	$error_sign = $this->_do_disabled($resource_id);
            	if (!$error_sign) {
            		Message::set(Message::ERROR, 'Delete failed'.'-id-'.$resource_id);
            	}
            }
            Message::set(Message::SUCCESS,__('Delete Success'));
            $this->go();
    }

    /**
     * AJAX调用为资源打上标签
     */
    public function ajax_tag_do()
    {
        
    }

    /**
     * AJAX调用资源取消标签
     */
    public function ajax_tag_cancel()
    {
        
    }

    /**
     * ajax上传调用
     *
     * @access public
     * @param null
     * @return void
     * @throws MyRuntimeException
     * @exception MyRuntimeException
     * @author fanchongyuan
     */
    public function ajax_upload()
    {
        $return_struct = array(
            'status' => 0,
            'code' => 501,
            'msg' => 'Not Implemented',
            'content' => array(),
        );
        try {
            //初始化分类
            bm('resource_catalog')->init($this->site_id);
            //初始化返回数据
            $return_data = array();
            $catalog_list = array();

            //权限验证
            if ($this->site_id == 0) {
                $session = Session::instance();
                $session->set_flash('remind_type', 'error');
                $session->set_flash('remind_error', Kohana::lang('o_global.select_site'));
                die('false');
            }
        

            //默认允许上传的文件类型
            $default_file_type = '*.jpg;*.jpeg;*.gif;*.png;*.bmp;*.doc;*.docx;*.xls;*.xlsx;*.ppt;*.pptx;*.pdf;*.rar;*.zip;*.txt;';
            $file_type = $this->input->post('file_type');
            if (empty($file_type)) {
                $file_type = $default_file_type;
            }
            // 执行业务逻辑
            $query_struct = array(
                'where' => array(
                    'site_id' => $this->site_id
                ),
                'orderby' => array(
                    'date_upd' => 'DESC'
                ),
            );
            $catalog_list = bm('resource_catalog')->index($query_struct);
            if (isset($catalog_list) && !empty($catalog_list) && count($catalog_list)) {
                foreach ($catalog_list as $key => $value)
                {
                    $catalog_list[$key]['pid'] = $value['parent_id'];
                }
            }
            $tags = bm('resource_tag')->index($query_struct);
            //补充&修改返回结构体
            $return_struct['status'] = 1;
            $return_struct['code'] = 200;
            $return_struct['msg'] = '';
            $return_struct['content'] = $return_data;
            //请求类型
            $this->template = new View('layout/empty_html');
            $this->template->content = new View('resource_call');
            $this->template->content->return_struct = $return_struct;
            $this->template->content->catalog_list = $catalog_list;
            $this->template->content->tags = $tags;
            $this->template->content->file_type = $file_type;
        } catch (MyRuntimeException $ex) {
            exit($ex->getMessage());
        }
    }

    /**
     * ajax加载资源库
     *
     * @access public
     * @param null
     * @return void
     * @throws MyRuntimeException
     * @exception MyRuntimeException
     * @author fanchongyuan
     */
    public function ajax_load_index()
    {
        try {
            //判断请求类型
            if (!$this->is_ajax_request()) {
                throw new MyRuntimeException(Kohana::lang('o_global.bad_request'), 404);
            }
            $request_data = $this->input->get();
            $params = array();
            
            // 初始化默认查询条件
            $query_struct = array(
                'where' => array(
                    'site_id' => $this->site_id,
                ),
                'orderby' => array(),
                'limit' => array(
                    0 => 9,
                    1 => 0,
                )
            );
            
            //商品图片时显示图片
            $file_type = trim( $this->input->get('file_type') );
            if ($file_type == '*.jpg;*.gif;*.png;') {
            	$query_struct['where']['postfix'] = array('jpg', 'png', 'gif', 'jpeg');
            }
            
            /* 排序功能*/
            $orderby = $this->input->get('orderby');
            if (isset($orderby) && !empty($orderby)) {
                switch ($orderby)
                {
                    case 'name':
                        $query_struct['orderby'] = array('name' => 'ASC');
                        break;
                    case 'postfix':
                        $query_struct['orderby'] = array('postfix' => 'ASC');
                        break;
                    case 'byte':
                        $query_struct['orderby'] = array('byte' => 'ASC');
                        break;
                    case 'date_upd':
                        $query_struct['orderby'] = array('date_upd' => 'DESC');
                        break;
                }
                $params['orderby'] = $orderby;
            }
            else
            {
                $orderby = 'date_upd';
                $query_struct['orderby'] = array('date_upd' => 'DESC');
            }

            /* 搜索功能 */
            $search_value = trim($this->input->get('search_value'));
            if ($search_value || $search_value == '0') {
                if (!empty($search_value) || $search_value == '0') {
                    $query_struct['where']['name like'] = $search_value;
                }
                $params['search_value'] = $search_value;
            }

            /* 资源目录过滤*/
            $resource_catalog_id = $this->input->get('catalog');
            if (isset($resource_catalog_id) && !empty($resource_catalog_id)) {
                $query_struct['where']['catalog_id'] = $resource_catalog_id;
                $params['catalog'] = $resource_catalog_id;
            }

            /* 资源标签过滤*/
            $resource_tag_id = $this->input->get('tag_id');
            if (isset($resource_tag_id) && !empty($resource_tag_id)) {
                $resource_ids = array();
                $query = array(
                    'where' => array(
                        'site_id' => $this->site_id,
                        'tag_id' => $resource_tag_id
                    ),
                );
                $resource_tag_relation = bm('resource_tag_relation')->index($query);
                if (!empty($resource_tag_relation)) {
                    foreach ($resource_tag_relation as $relation)
                    {
                        $resource_ids[] = $relation['resource_id'];
                    }
                }
                if (!empty($resource_ids)) {
                    $query_struct['where']['id in'] = $resource_ids;
                }
                else
                {
                    $query_struct['where']['id'] = 0;
                }
                $params['tag_id'] = $resource_tag_id;
            }
            /* 得到资源总数、默认每页显示多少条并输出分页 */
            $count = bm('resource')->count($query_struct);
            $per_page = 9;
            $this->pagination = new Pagination(array(
                                                    'total_items' => $count,
                                                    'items_per_page' => $per_page
                                               ));
            $query_struct['limit'][0] = $per_page;
            $query_struct['limit'][1] = $this->pagination->sql_offset;

            //资源列表详细数据
            $resource_list = bm('resource')->index($query_struct);
            if (!empty($resource_list)) {
                foreach ($resource_list as $key => $value)
                {
                    $manager = Mymanager::instance($value['manager_id'])->get();
                    $resource_list[$key]['manager_name'] = $manager['username'];
                }
            }
            //图片类型
            $resource_config = Kohana::config('resource.resourceAttach');
            $image_type = $resource_config['image_type'];

            /* 调用列表 */
            $this->template = new View('layout/empty_html');
            $this->template->content = new View("resource_call_list");
            $this->template->content->request_data = $request_data;
            $this->template->content->resource_list = $resource_list;
            $this->template->content->count = $count;
            $this->template->content->image_type = $image_type;
            $this->template->content->orderby = $orderby;
            $this->template->content->params = $params;
        } catch (MyRuntimeException $ex) {
            exit($ex->getMessage());
        }
    }

    /**
     * 本地上传请求
     *
     * @access public
     * @param null
     * @return void
     * @throws MyRuntimeException
     * @exception MyRuntimeException
     * @author zhangbai
     */
    public function ajax_upload_submit()
    {
        try {
            //判断请求类型
            if (!$this->is_ajax_request()) {
                throw new MyRuntimeException(Kohana::lang('o_global.bad_request'), 404);
            }
            $return_struct = array(
                'status' => 0,
                'code' => 501,
                'msg' => 'Not Implemented',
                'content' => array()
            );
            $request_data = $this->input->post();
            //初始化返回数据
            $return_data = array();
            if (empty($request_data['resource'])) {
                throw new MyRuntimeException(Kohana::lang('o_global.bad_request'), 404);
            }
            if (!empty($request_data['resource']) && is_array($request_data['resource'])) {
                $attach_configure = Kohana::config('resource.resourceAttach');
                foreach ($request_data['resource'] as $key => $value)
                {
                    if (!empty($request_data['catalog_id'])) {
                        $set_data = array('catalog_id' => $request_data['catalog_id']);
                        bm('resource')->set($value, $set_data);
                    }
                    $resource_data_tmp = bm('resource')->get($value);
                    if (!empty($resource_data_tmp)) {
                        if (in_array($resource_data_tmp['postfix'], $attach_configure['image_type'])) {
                            $resource_data_tmp['type'] = 'image';
                        } else {
                            if (empty($resource_data_tmp['postfix']) && !empty($resource_data_tmp['link'])) {
                                $resource_data_tmp['type'] = 'network';
                            } else {
                                $resource_data_tmp['type'] = 'attachment';
                            }
                        }
                        //附件链接地址
                        $resource_data_tmp['url'] = bm('resource')->get_attach_link($resource_data_tmp['id']);
                        $resource_data_tmp['link'] = bm('resource')->get_attach_link($resource_data_tmp['id']);
                        //附件展示图
                        $resource_data_tmp['img'] = bm('resource')->get_attach_img($resource_data_tmp['id']);
                        $return_data[$value] = $resource_data_tmp;
                    }
                }
            }
            //补充&修改返回结构体
            $return_struct['status'] = 1;
            $return_struct['code'] = 200;
            $return_struct['msg'] = '';
            $return_struct['content'] = $return_data;
            exit(json_encode($return_struct));
        } catch (MyRuntimeException $ex) {
            //补充&修改返回结构体
            $return_struct['status'] = 0;
            $return_struct['code'] = 400;
            $return_struct['msg'] = $ex->getMessage();
            $return_struct['content'] = array();
            exit(json_encode($return_struct));
        }
    }

    /**
     * 从资源库列表选择后提交的资源ids获取到资源的信息
     */
    public function action_ajax_upload_list_submit()
    {
        try {
            //判断请求类型
            if (!$this->request->is_ajax()) {
                throw new Exception(Kohana::lang('o_global.bad_request'), 404);
            }
            $return_struct = array(
                'status' => 0,
                'code' => 501,
                'msg' => 'Not Implemented',
                'content' => array()
            );
            $request_data = $this->request->post();
            //初始化返回数据
            $return_data = array();
            if (empty($request_data['resource'])) {
                throw new Exception(Kohana::lang('o_global.bad_request'), 404);
            }
            if (!empty($request_data['resource']) && is_array($request_data['resource'])) {
                $attach_configure = Kohana::$config->load('resource.resourceConfig.resourceAttach');
                foreach ($request_data['resource'] as $key => $value)
                {
                    $resource_data_tmp = ORM::factory('resource')->where('id', '=', $value)->find()->as_array();
                    if (!empty($resource_data_tmp)) {
                        if (in_array($resource_data_tmp['postfix'], $attach_configure['image_type'])) {
                            $resource_data_tmp['type'] = 'image';
                        } else {
                            if (empty($resource_data_tmp['postfix']) && !empty($resource_data_tmp['link'])) {
                                $resource_data_tmp['type'] = 'network';
                            } else {
                                $resource_data_tmp['type'] = 'attachment';
                            }
                        }
                        //附件链接地址   TODO 助手函数生成
                        $resource_data_tmp['url'] = '/attach/'.$resource_data_tmp['attach_id'].'.'.$resource_data_tmp['postfix'];
                        //TODO 附件展示图 
                        $resource_data_tmp['img'] = '/attach/'.$resource_data_tmp['attach_id'].'.'.$resource_data_tmp['postfix'];
                        //网络资源无attach_id用link代替
                        if (empty($resource_data_tmp['attach_id'])) {
                            $resource_data_tmp['attach_id'] = $resource_data_tmp['link'];
                        }
                        $return_data[$value] = $resource_data_tmp;
                    }
                }
            }
            //补充&修改返回结构体
            $return_struct['status'] = 1;
            $return_struct['code'] = 200;
            $return_struct['msg'] = '';
            $return_struct['content'] = $return_data;
            exit(json_encode($return_struct));
        } catch (Exception $ex) {
            //补充&修改返回结构体
            $return_struct['status'] = 0;
            $return_struct['code'] = 400;
            $return_struct['msg'] = $ex->getMessage();
            $return_struct['content'] = array();
            exit(json_encode($return_struct));
        }
    }

    /**
     * 更新指定站点的容量
     */
    public function action_updatesize()
    {
    	//TODO site_id
        Message::set('更新容量成功.',request::referrer(),'success');
    }

    /**
     * 处理列表型的表单提交的添加请求
     */
    protected function _do_list_form_add() {
        $this->action_add();
    }
    /**
     * 处理列表型的表单提交的删除请求
     */
    protected function _do_list_form_delete() {
    	$formData = $this->request->post('eform');
    	$ids = $formData['ids'];
    	foreach ($ids as $id) {
    		$delResult = $this->_do_disabled($id);
    		if (!$delResult) {
    			Message::set(Message::ERROR,'Delete failed'.'-id-'.$id);
    		}
    	}
    	Message::set(Message::SUCCESS,__('Delete Success'));
        $this->go();
    }
    /**
     * 执行添加操作，添加到文件系统，添加到resource表
     */
    private function _hander_updata_resource($resourceData)
    {
        $resourceModel =  EHOVEL::model('resource');
        $resourceModel->name = $resourceData['name'];
        $resourceModel->postfix = $resourceData['postfix'];
        $resourceModel->catalog_id = $resourceData['catalog_id'];
        $resourceModel->attach_id = $resourceData['attach_id'];
        $resourceModel->is_storage = 1;
        $resourceModel->save();
        return $resourceModel->saved();
    }
    
    private function _do_add($resourceData) {
    	$resourceModel =  EHOVEL::model('resource');
    	$resourceModel->name = $resourceData['name'];
    	$resourceModel->postfix = $resourceData['postfix'];
    	$resourceModel->catalog_id = $resourceData['catalog_id'];
    	$resourceModel->attach_id = $resourceData['attach_id'];
    	$resourceModel->is_storage = 1;
    	$resourceModel->save();
    	if ($resourceModel->saved()){
    	    return $resourceModel->id;
    	} else {
    	    return false;
    	}
    }
    private function _do_disabled($resource_id) {
    	$resource_data = EHOVEL::model('resource',$resource_id);
    	return $resource_data->disable();
    }
    
}
