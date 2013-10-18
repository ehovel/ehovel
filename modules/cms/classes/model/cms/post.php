<?php defined('SYSPATH') or die('No direct script access.');

class Model_Cms_Post extends ORM
{
    protected $_table_name = 'cms_posts';
    /** 指定软删除字段 */
    protected $_disabled_column = 'disabled';
    
    protected $_belongs_to = array(
    		'category' => array(
	            'model' => 'Cms_Category',
	            'foreign_key'=>'category_id',
	        ),
    );
    
    protected $_has_many = array(
    		'comments' => array(
    				'model' => 'Cms_Post_Comment',
    				'foreign_key' => 'post_id',
    		),
    );
    
    /**
     * 验证规则
     * @return array
     */
    public function rules ()
    {
        return array(
            'title' => array(
                array('not_empty'),
                array('min_length', array(':value', 1)),
                array('max_length', array(':value', 255)),
            ),
        );
    }
    
	
}
