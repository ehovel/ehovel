<?php defined('SYSPATH') OR die('No direct script access allowed.');

/**
 * 站点Faq模型
 *
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package Site
 * @category  Model  
 * @since 2011-11-25
 * @author dongxiaoyu
 * @version   $Id$
 */
class Model_Site_Faq extends ORM_Site {
    protected $_belongs_to = array(
        'faq_category' => array(
            'model'       => 'Site_Faq_Category',
            'foreign_key' => 'category_id',
        ),
    );
    
    /**
     * 软删除字段的名字
     *
     * @var string
     */
    protected $_disabled_column = NULL;
    
    /**
     * 验证规则
     * @return array
     */
    public function rules(){
        return array(
            'title'=>array(
                array('not_empty'),
                array('max_length', array(':value', 256)),
            ),
            'content'=>array(
                array('not_empty'),
                array('max_length', array(':value', 2048)),
            ),
            'reply'=>array(
                array('max_length', array(':value', 65536)),
            ),
        );
    }
}
