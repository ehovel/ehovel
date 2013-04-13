<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Cms_Content extends Controller_Admin_Base {

	public function before()
	{
		parent::before();
	}
	
	public function action_index()
	{
		if ($this->request->is_ajax()) {
			$contents       = ORM::factory('content');
			
			$state = trim($this->request->query('state'));
			if (is_numeric($state)) {
				$contents->where('state', '=', $state);
			}
			
			$return_struct = Grid::factory($contents)->to_array();
			
			if (!empty($return_struct['rows'])) {
				foreach ($return_struct['rows'] as $index => $row) {
	                $modifier_ids[$row['modified_by']] = $row['modified_by'];
	                $creater_ids[$row['created_by']] = $row['modified_by'];
	                $cateogry_ids[$row['catid']] = $row['catid'];
	                $indexs[$row['id']] = $index;
            	}
			}
			$modifiers = $cateogries = array();
			if (!empty($modifier_ids)) {
				$modifiers = ORM::factory('Auth_Admin')
				->where('id', 'in', $modifier_ids)
				->find_all()
				->as_array('id', 'name');
			}
			if (!empty($cateogry_ids)) {
				$cateogries = ORM::factory('Content_Category')
				->where('id', 'in', $cateogry_ids)
				->find_all()
				->as_array('id', 'title');
			}
			
			foreach ($return_struct['rows'] as $index => $row) {
				if (isset($modifiers[$row['modified_by']])) {
					$return_struct['rows'][$index]['modified_by'] = $modifiers[$row['modified_by']];
				} else {
					$return_struct['rows'][$index]['modified_by'] = '';
				}
				if (isset($cateogries[$row['catid']])) {
					$return_struct['rows'][$index]['cat_name'] = $cateogries[$row['catid']];
				} else {
					$return_struct['rows'][$index]['cat_name'] = '';
				}
			}
		
			exit(json_encode($return_struct));
		} else {
			$this->title = 'Hello Post!';
			$categories = array();
			$this->template = view::factory('content/index', array(
					'categories' => $categories,
			));
		}
	}

	public function action_edit()
	{
		$content = EHOVEL::model('content', intval($this->request->param('id')));
        $categoriesModel = EHOVEL::model('content_category');
        $categories = $categoriesModel->where('extension','=','com_content')->find_all()->as_array();
        if ($content->loaded()) {
            if (!empty($_POST)) {
                	$this->_prepareData($content);
                	$content->save();
                    if ($content->saved()) {
                        Message::set(Message::SUCCESS, __('Edited Successfully'));
                    } else {
                    	Message::set(Message::ERROR, $content->validation()->errors());
                    }
                    $this->go();
            } else {
                $toolBarhelper = Helper_Toolbar::getInstance();
            	$toolBarhelper->appendButton('edit','保存','content.edit');
             	$toolBarhelper->appendButton('ok','保存并关闭','content.save');
                $toolBarhelper->appendButton('plus','保存并新建','content.save2new');
                $toolBarhelper->appendButton('copy','保存为副本','content.save2copy');
                $toolBarhelper->appendButton('undo','取消','content.cancel');
                $this->toolBar =  $toolBarhelper->render();
                
                $this->template = EHOVEL::view('content/editform', array(
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
            '1' => __('Published'),
            '0' => __('Unpublished'),
            '-1' => __('Deleted'),
        );
    }

    public function after() {
    	//ProfilerToolbar::firebug();
    	parent::after();
    }
} // End Post