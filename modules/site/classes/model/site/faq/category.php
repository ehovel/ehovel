<?php
// $Id$
defined('SYSPATH') or die('No Access Direct Script');
/**
 * Faq类模型
 *
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package Site
 * @category  Model  
 * @since 2011-11-25
 * @author dongxiaoyu
 * @version   $Id$
 */
class Model_Site_Faq_Category extends ORM_Site
{
    /**
     * 定义ORM关系
     * @access protected
     * @var array
     */
    protected $_has_many = array(
        'faq'=>array(
            'model'=>'Site_Faq',
            'foreign_key' => 'category_id',
        ),
    );
    protected $_disabled_key='disabled';
    protected $_disabled_column = 'disabled';
    public function rules(){
        return array(
            'name'=>array(
                array('not_empty'),
                array('max_length', array(':value', 32)),
            ),
        );
    }
    /**
     * 判断当前是否还能添加faq分类
     */
    public function can_add_faq_category()
    {
        if($this->loaded()){
            return EHOVEL::model('Site_Faq_Category')->count_all()>20;
        }else{
            return $this->count_all()<20;
        }
    }
} // END class Model_Faq_Category extends ORM
