<?php defined('SYSPATH') or die('No Direct Script Access.');
// $Id$
/**
 * 内容发布模型分类模型
 */
class Model_Content_Category extends Model_Category{
    
	protected $_table_name = 'categories';
	
    /**
     * 取得该分类下内容的个数
     * @return int
     */
    public function count_content()
    {
        if($this->loaded()){
            $model = $this->model->get_model();
            $count_all = $model instanceof ORM ? $model->where('category_id', '=', $this->id)->count_all() : 0;
            return $count_all;
        }else{
            return -1;
        }
    }
}

