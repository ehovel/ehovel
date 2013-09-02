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
class Model_Site_Tecfaq_Comment extends ORM_Site
{
    /**
     * 定义ORM关系
     * @access protected
     * @var array
     */
    protected $_belongs_to = array(
        'faq'=>array(
            'model'=>'Site_Tecfaq',
            'foreign_key' => 'tecfaq_id',
        ),
        'user'=>array(
            'model'=>'User',
            'foreign_key' => 'user_id',
        ),
    );
    
    protected $_disabled_key='disabled';
    protected $_disabled_column = 'disabled';
    public function rules(){
        return array(
            'content'=>array(
                array('not_empty'),
                array('max_length', array(':value', 6556)),
            ),
        );
    }
    /**
     * 判断当前是否还能添加faq分类
     */
    public function can_add_faq_category()
    {
        if($this->loaded()){
            return EHOVEL::model('Site_Tecfaq_Category')->count_all()>6;
        }else{
            return $this->count_all()<6;
        }
    }
} // END class Model_Faq_Category extends ORM
