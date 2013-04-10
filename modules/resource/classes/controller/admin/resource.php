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
		$resourceObject = ORM::factory('resource');
		$count = $resourceObject->count_all();
		$pagination = new Pagination(
			array(
				'total_items' => $count,
				'items_per_page' => 12,
				'view' => 'pagination/floating',
			)
		);
		$page = $this->request->query('page');
		$page = $page?$page:1;
		$resourceObject->offset(($page - 1) * 12);
		$resourceObject->limit(12);
		$resources = $resourceObject->find_all()->as_array();
		$this->template = view::factory('resource_list', array(
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
	    echo "{'url':'" . $info["url"] . "','title':'" . $title . "','original':'" . $info["originalName"] . "','state':'" . $info["state"] . "'}";

	    exit;
    }
    
    /**
     * ueditor 上传资源
     * 添加一个资源.添加到资源表
     */
    public function action_ueimagemanage() {
    	$query = DB::select('attach_id','postfix')->from('resources')->where('site_id','=','62');
//     	$query = DB::select('attach_id','postfix')->from('resources');
    	$pagination_query = clone $query;
    	$count = $pagination_query->select(DB::expr('COUNT(1) AS mycount'))->execute()->get('mycount');
    	$pagination = Pagination::factory(array(
    			'total_items' => $count,
    			'current_page'   => array('source' => 'route', 'key' => 'page'),
    			'items_per_page' => 200,
    			'view'           => 'pagination/pretty',
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
     * 执行添加操作，添加到文件系统，添加到kv表
     */
    public function upload_put()
    {
        $return_struct = array(
            'status' => 0,
            'code' => 501,
            'msg' => 'Not Implemented',
            'content' => array()
        );
        try {
            //* 初始化返回数据 */
            $return_data = array();
            /* 获取站点域名 */
            $site_domain = Mysite::instance($this->site_id)->get('domain');
            $ip = $this->input->ip_address();
            $catalog_id = intval($this->input->get('catelog_id'));
            $attach_meta = array(
                'siteId' => $this->site_id,
                'siteDomain' => $site_domain
            );
            // 附件应用类型
            $attach_app_type = 'resourceAttach';
            $attach_field = 'Filedata';
            // 如果有上传请求
            if (!page::issetFile($attach_field)) {
                throw new MyRuntimeException(Kohana::lang('o_global.bad_request'), 400);
            }

            //读取当前应用配置
            $attach_setup = Kohana::config('resource.' . $attach_app_type);
            $mime_type2postfix = Kohana::config('mimemap.type2postfix');
            $mime_postfix2type = Kohana::config('mimemap.postfix2type');

            // 上传文件meta信息
            $file_meta_data = array();
            // 验证并采集上传信息,如果上传标志成功
            if ((int)$_FILES[$attach_field]['error'] === UPLOAD_ERR_OK) {
                if (!is_uploaded_file($_FILES[$attach_field]['tmp_name'])) {
                    throw new MyRuntimeException(Kohana::lang('o_resource.resource_upload_error'), 401);
                }
                $file_size_current = filesize($_FILES[$attach_field]['tmp_name']);
                if ($attach_setup['fileSizePreLimit'] > 0 && $file_size_current > $attach_setup['fileSizePreLimit']) {
                    throw new MyRuntimeException(Kohana::lang('o_resource.resource_file_too_big'), 402);
                }
                $file_type_current = page::getPostfix($attach_field); //通过后缀截取
                foreach ($attach_setup['file_type'] as $idx => $item) {
                    $attach_setup['file_type'][$idx] = strtolower($item);
                }
                if (!empty($attach_setup['file_type']) && !in_array(strtolower($file_type_current), $attach_setup['file_type'])) {
                    throw new MyRuntimeException(Kohana::lang('o_resource.resource_type_error'), 403);
                }
                // 当前文件mime类型
                $file_mime_current = isset($_FILES[$attach_field]['type']) ? $_FILES[$attach_field]['type'] : '';
                // 检测规整mime类型
                if (array_key_exists($file_type_current, $mime_postfix2type)) {
                    $file_mime_current = $mime_postfix2type[$file_type_current];
                } else {
                    $file_mime_current = 'application/octet-stream';
                }
                //存储文件meta信息
                $file_meta_data = array(
                    'name' => strip_tags(trim($_FILES[$attach_field]['name'])),
                    'size' => $file_size_current,
                    'type' => $file_type_current,
                    'mime' => $file_mime_current,
                    'tmpfile' => $_FILES[$attach_field]['tmp_name'],
                );
                $data['file_meta'] = $file_meta_data;
                $data['ip'] = $ip;
                $data['attach_meta'] = json_encode($attach_meta);
                $data['site_id'] = $this->site_id;
                $data['manager_id'] = $this->manager_id;
                $data['catalog_id'] = $catalog_id;
                $resource_id = bm('resource')->add($data);
                $return_data['id'] = $resource_id;
                $return_data['data'] = $data;
                //* 补充&修改返回结构体 */
                $return_struct['status'] = 1;
                $return_struct['code'] = 200;
                $return_struct['msg'] = 'Success';
                $return_struct['content'] = $return_data;
                exit(json_encode($return_struct));
            } else {
                throw new MyRuntimeException(Kohana::lang('o_resource.resource_upload_error'), 400);
            }
        } catch (MyRuntimeException $ex) {
            //* 补充&修改返回结构体 */
            $return_struct['status'] = 0;
            $return_struct['code'] = 400;
            $return_struct['msg'] = $ex->getMessage();
            $return_struct['content'] = array();
            exit(json_encode($return_struct));
        }
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
    	}
    	echo 'Load failed';
    	exit;
    }

    /**
     * 执行编辑操作
     *
     * @access public
     * @param null
     * @return void
     * @throws MyRuntimeException
     * @exception MyRuntimeException
     * @author 张白
     */
    public function do_edit()
    {
        try {
            $request_data = $this->input->post();
            //权限验证
            if ($this->site_id == 0) {
                throw new MyRuntimeException(Kohana::lang('o_global.select_site'), 400);
            }

            if (bm('resource')->set($request_data['resource_id'], $request_data)) {
                remind::set(Kohana::lang('o_resource.resource_update_success'), 'resource', 'success');
            }
            else
            {
                remind::set(Kohana::lang('o_global.update_error'), 'resource', 'error');
            }
        } catch (MyRuntimeException $ex) {
            remind::set($ex->getMessage(), 'resource', 'error');
        }
    }

    /**
     * 删除资源
     *
     * @access public
     * @param null
     * @return void
     * @throws MyRuntimeException
     * @exception MyRuntimeException
     * @author 张白
     */
    public function delete()
    {
        try {
            //收集请求参数
            $request_data = $this->input->get();
            //权限及数据验证
            if ($this->site_id == 0) {
                throw new MyRuntimeException(Kohana::lang('o_global.select_site'), 400);
            }
            if (empty($request_data['resource_ids'])) {
                throw new MyRuntimeException(Kohana::lang('o_global.bad_request'), 400);
            }
            // 删除tag与resource关联表中的数据
            $used_num = 0;
            $error_sign = 0;
            $used_resource_name = '';
            $resource_ids = explode('-', $request_data['resource_ids']);
            foreach ($resource_ids as $resource_id)
            {
                $resource_data = bm('resource')->get($resource_id);
                if (!empty($resource_data)) {
                    if ($resource_data['used_num'] > 0) {
                        $used_num++;
                        $used_resource_name .= empty($used_resource_name) ? $resource_data['name']
                                : (',' . $resource_data['name']);
                    } else {
                        if (bm('resource')->remove($resource_id)) {
                            $query_struct = array(
                                'where' => array(
                                    'site_id' => $this->site_id,
                                    'resource_id' => $resource_id
                                )
                            );
                            bm('resource_tag_relation')->delete($query_struct);
                        } else {
                            $error_sign++;
                        }
                    }
                }
            }
            if ($error_sign) {
                remind::set(Kohana::lang('o_resource.delete_error'), 'resource', 'error');
            }
            if ($used_num) {
                remind::set(Kohana::lang('o_resource.delete_part') . $used_resource_name . Kohana::lang('o_resource.delete_part_success'), 'resource', 'success');
            } else {
                remind::set(Kohana::lang('o_resource.delete_success'), 'resource', 'success');
            }
        } catch (MyRuntimeException $ex) {
            remind::set($ex->getMessage(), request::referrer(), 'error');
        }
    }

    /**
     * AJAX调用获取resource_tag信息
     *
     * @access public
     * @param null
     * @return void
     * @throws MyRuntimeException
     * @exception MyRuntimeException
     * @author 张白
     */
    public function ajax_tag_add()
    {
        try {
            //初始化返回结构体
            $return_struct = array(
                'status' => 0,
                'code' => 501,
                'msg' => 'Not Implemented',
                'content' => array()
            );
            if (request::is_ajax()) {
                //收集请求参数
                $request_data = $this->input->get();
                //权限及数据验证
                if ($this->site_id == 0) {
                    throw new MyRuntimeException(Kohana::lang('o_global.select_site'), 400);
                }
                if (empty($request_data['id'])) {
                    throw new MyRuntimeException(Kohana::lang('o_global.bad_request'), 400);
                }
                //执行业务逻辑
                $return_data['tag'] = bm('resource_tag')->get($request_data['id']);
                //补充&修改返回结构体
                $return_struct['status'] = 1;
                $return_struct['code'] = 200;
                $return_struct['msg'] = '';
                $return_struct['content'] = $return_data;
                exit(json_encode($return_struct));
            }
        } catch (MyRuntimeException $ex) {
            remind::set($ex->getMessage(), request::referrer(), 'error');
        }
    }

    /**
     * AJAX调用为资源打上标签
     *
     * @access public
     * @param null
     * @return void
     * @throws MyRuntimeException
     * @exception MyRuntimeException
     * @author 张白
     */
    public function ajax_tag_do()
    {
        try {
            //初始化返回结构体
            $return_struct = array(
                'status' => 0,
                'code' => 501,
                'msg' => 'Not Implemented',
                'content' => array()
            );
            if (request::is_ajax()) {
                //收集请求参数
                $request_data = $this->input->get();
                //权限及数据验证
                if ($this->site_id == 0) {
                    throw new MyRuntimeException(Kohana::lang('o_global.select_site'), 400);
                }
                if (empty($request_data['tag_ids']) || empty($request_data['resource_ids'])) {
                    throw new MyRuntimeException(Kohana::lang('o_global.bad_request'), 400);
                }
                //执行业务逻辑
                $tag_ids = explode('-', $request_data['tag_ids']);
                $resource_ids = explode('-', $request_data['resource_ids']);
                foreach ($tag_ids as $tag_id)
                {
                    foreach ($resource_ids as $resource_id)
                    {
                        $query_struct = array(
                            'where' => array(
                                'site_id' => $this->site_id,
                                'resource_id' => $resource_id,
                                'tag_id' => $tag_id
                            ),
                        );
                        $count = bm('resource_tag_relation')->count($query_struct);
                        if (!$count) {
                            bm('resource')->set_tag_id($this->site_id, $resource_id, $tag_id);
                        }
                    }
                }
                //补充&修改返回结构体
                $return_struct['status'] = 1;
                $return_struct['code'] = 200;
                $return_struct['msg'] = '';
                $return_struct['content'] = array();
                exit(json_encode($return_struct));
            }
        } catch (MyRuntimeException $ex) {
            remind::set($ex->getMessage(), request::referrer(), 'error');
        }
    }

    /**
     * AJAX调用资源取消标签
     *
     * @access public
     * @param null
     * @return void
     * @throws MyRuntimeException
     * @exception MyRuntimeException
     * @author 张白
     */
    public function ajax_tag_cancel()
    {
        try {
            //初始化返回结构体
            $return_struct = array(
                'status' => 0,
                'code' => 501,
                'msg' => 'Not Implemented',
                'content' => array()
            );
            if (request::is_ajax()) {
                //收集请求参数
                $request_data = $this->input->get();
                //权限及数据验证
                if ($this->site_id == 0) {
                    throw new MyRuntimeException(Kohana::lang('o_global.select_site'), 400);
                }
                if (empty($request_data['tag_ids']) || empty($request_data['resource_ids'])) {
                    throw new MyRuntimeException(Kohana::lang('o_global.bad_request'), 400);
                }
                //执行业务逻辑
                $tag_ids = explode('-', $request_data['tag_ids']);
                $resource_ids = explode('-', $request_data['resource_ids']);
                foreach ($tag_ids as $tag_id)
                {
                    foreach ($resource_ids as $resource_id)
                    {
                        $query_struct = array(
                            'where' => array(
                                'site_id' => $this->site_id,
                                'resource_id' => $resource_id,
                                'tag_id' => $tag_id
                            ),
                        );
                        $count = bm('resource_tag_relation')->count($query_struct);
                        if ($count) {
                            bm('resource')->cancel_tag_id($this->site_id, $resource_id, $tag_id);
                        }
                    }
                }
                //补充&修改返回结构体
                $return_struct['status'] = 1;
                $return_struct['code'] = 200;
                $return_struct['msg'] = '';
                $return_struct['content'] = array();
                exit(json_encode($return_struct));
            }
        } catch (MyRuntimeException $ex) {
            remind::set($ex->getMessage(), request::referrer(), 'error');
        }
    }

    /**
     * 批量保存上传数据
     *
     * @access public
     * @param null
     * @return void
     * @throws MyRuntimeException
     * @exception MyRuntimeException
     * @author 张白
     */
    public function upload_form_submit()
    {
        try {
            //收集请求数据
            $request_data = $this->input->post();
            if (isset($request_data['resources']) && !empty($request_data['resources']) && count($request_data['resources'])) {
                $catalog_id = 0;
                if (!empty($request_data['catalog_id'])) {
                    $catalog_id = $request_data['catalog_id'];
                }
                foreach ($request_data['resources'] as $key => $value)
                {
                    $value['catalog_id'] = $catalog_id;
                    unset($value['name']);
                    bm('resource')->set($key, $value);
                }
                $session = Session::instance();
                $session->set_flash('remind_type', 'success');
                $session->set_flash('remind_error', Kohana::lang('o_resource.resource_upload_success'));
            }
            else {
            	print_r($request_data);
                //throw new MyRuntimeException('资源不能为空', 500);
            }
            echo "<script>
                 window.parent.$('#upload_ifm').dialog('close');
                 parent.location.href = parent.location.href;
                 </script>";
            die();
        } catch (MyRuntimeException $ex) {
            $session = Session::instance();
            $session->set_flash('remind_type', 'error');
            $session->set_flash('remind_error', $ex->getMessage());
            echo "<script>
                 window.parent.$('#upload_ifm').dialog('close');
                 parent.location.href = parent.location.href;
                 </script>";
            die();
        }
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
     * 资源库选择请求
     *
     * @access public
     * @param null
     * @return void
     * @throws MyRuntimeException
     * @exception MyRuntimeException
     * @author fanchongyuan
     */
    public function ajax_upload_list_submit()
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
     * 更新指定站点的容量
     *
     * @access public
     * @param null
     * @return void
     * @throws MyRuntimeException
     * @exception MyRuntimeException
     * @author Bin 2011-11-08
     */
    public function update_size()
    {
        $return_struct = array(
            'status' => 0,
            'code' => 501,
            'msg' => 'Not Implemented',
            'content' => array(),
        );
        try {
            bm('resource')->update_size($this->site_id);
            remind::set('更新容量成功.',request::referrer(),'success');
        } catch (MyRuntimeException $ex) {
            $this->_ex($ex, $return_struct);
        }
    }
    /**
     * 互联网文件选择请求
     *
     * @access public
     * @param null
     * @return void
     * @throws MyRuntimeException
     * @exception MyRuntimeException
     * @author fanchongyuan
     * @mofify Bin (去除接口，网络资源不加入资源库)
     */
    /*
    public function ajax_upload_link_submit()
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
                    $resource_data = array();
                    $resource_data['site_id'] = $this->site_id;
                    $resource_data['manager_id'] = $this->manager_id;
                    $resource_data['catalog_id'] = $value['catalog_id'];
                    $resource_data['name'] = $value['name'];
                    $resource_data['link'] = $value['link'];
                    $resource_data['tag'] = $value['tag'];
                    $resource_data['title'] = $value['title'];
                    $resource_data['alter'] = $value['alter'];
                    $resource_data['introduction'] = $value['introduction'];
                    $resource_data['description'] = $value['description'];
                    $resource_id = bm('resource')->add($resource_data);
                    $resource_data_tmp = bm('resource')->get($resource_id);
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
                        $resource_data_tmp['url'] = $value['link'];
                        $return_data[$resource_id] = $resource_data_tmp;
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
    */
}
