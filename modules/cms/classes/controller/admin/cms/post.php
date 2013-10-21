<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Cms_Post extends Controller_Admin_Base {
    public $task = '';//提交的类型,edit,save,save2new,save2copy,cancel
    public $type = '';//提交的类型
    
    
	public function before()
	{
	    $taskinfo = $this->request->post('task');
	    if ($taskinfo && strpos($taskinfo, '.') !== false)
		{
			// Explode the controller.task command.
			list ($this->type, $this->task) = explode('.', $taskinfo);
		}
		parent::before();
	}
	
	public function action_index()
	{
		$toolBarhelper = Helper_Toolbar::getInstance();
		$toolBarhelper->appendButton('new','新建','content.add');
		$this->toolBar =  $toolBarhelper->render();
		if ($this->request->is_ajax()) {
			$contents       = ORM::factory('Cms_Post');
			$state = trim($this->request->query('state'));
			if ($state) {
				$contents->where('state', '=', $state);
			}
			
			$return_struct = Grid::factory($contents)->to_array();
			
			if (!empty($return_struct['rows'])) {
				foreach ($return_struct['rows'] as $index => $row) {
	                $cateogry_ids[$row['category_id']] = $row['category_id'];
            	}
			}
			$cateogries = array();
			if (!empty($cateogry_ids)) {
				$cateogries = ORM::factory('Content_Category')
				->where('id', 'in', $cateogry_ids)
				->find_all()
				->as_array('id', 'title');
			}
			
			foreach ($return_struct['rows'] as $index => $row) {
				if (isset($cateogries[$row['category_id']])) {
					$return_struct['rows'][$index]['cat_name'] = $cateogries[$row['category_id']];
				} else {
					$return_struct['rows'][$index]['cat_name'] = '';
				}
			}
			exit(json_encode($return_struct));
		} else {
			$this->title = 'Hello Post!';
			$categories = array();
			$this->template = view::factory('cms/post/index', array(
					'categories' => $categories,
			));
		}
	}

	public function action_edit()
	{
		$content = EHOVEL::model('Cms_Post', intval($this->request->param('id')));
        $categoriesModel = EHOVEL::model('Cms_Category');
        $categories = $categoriesModel->descendants();
        if ($content->loaded()) {
            if (!empty($_POST)) {
                if ($this->task=='cancel') {
                    $this->redirect(EHOVEL::url('Cms_Post'));
                }
            	$eformData = $this->_prepareData($content);
            	//图片信息
            	$resourceIds = isset($eformData['resource_ids']) ? $eformData['resource_ids'] : '';
            	if ($resourceIds) {
            	     $attachs_str = implode(',', $resourceIds);
                     $content->images = $attachs_str;
            	}
            	$metaData = isset($eformData['metadata']) ? $eformData['metadata'] : '';
            	if ($metaData) {
            	    $content->seo_metadata = serialize($metaData);
            	}
            	$content->save();
                if ($content->saved()) {
                    Message::set(Message::SUCCESS, __('Edited Successfully'));
                } else {
                	Message::set(Message::ERROR, $content->validation()->errors());
                }
                if ($this->task == 'edit') {
                    $this->go();
                } elseif ($this->task == 'save') {
                    $this->redirect(EHOVEL::url('cms_post/index'));
                }
                
            } else {
                $toolBarhelper = Helper_Toolbar::getInstance();
            	$toolBarhelper->appendButton('edit','保存','content.edit');
             	$toolBarhelper->appendButton('ok','保存并关闭','content.save');
                $toolBarhelper->appendButton('plus','保存并新建','content.save2new');
                $toolBarhelper->appendButton('copy','保存为副本','content.save2copy');
                $toolBarhelper->appendButton('undo','取消','content.cancel');
                $this->toolBar =  $toolBarhelper->render();
                $content->images = explode(',', $content->images);
                
                
                $this->template = EHOVEL::view('cms/post/editform', array(
                	    'content'       => $content
                    	,'categories'=>$categories
                ));
            }
        } else {
            Message::set(Message::ERROR,__('Loading failed, try again'));
            $this->go();
        }
	}
	
	/**
     * 获取文章状态
     * 
     * @return array
     */
    protected function _searchoptions_state()
    {
        return array(
            'published' => __('Published'),
            'saved' => __('Saved'),
            'trashed' => __('Trashed'),
        );
    }

    public function after() {
    	//ProfilerToolbar::firebug();
    	parent::after();
    }
} // End Post