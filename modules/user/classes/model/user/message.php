<?php defined('SYSPATH') or die('No Access Direct Script');
// $Id$
/**
 * 会员留言模型
 *
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package 
 * @since 2011-06-30
 * @author fanchongyuan
 * @version $Id$
 */
class Model_User_Message extends ORM_Site
{
    /* 指定软删除字段 */
    protected $_disabled_column = 'disabled';

    protected $_belongs_to = array(
        'user' => array(
            'model'=>'User',
            'foreign_key'=>'user_id',
        )
    );

    /**
     * 验证规则
     * @return array
     */
    public function rules()
    {
        return array(
            'email'   => array(
                array('not_empty'),
                array('max_length', array(':value', 255)),
            ),
            'content' => array(
                array('not_empty'),
                array('min_length', array(':value', 1)),
                array('max_length', array(':value', 1024)),
            ),
            /*'reply' => array(
                array('min_length', array(':value', 0)),
                array('max_length', array(':value', 1024)),
            ),*/
        );
    }
}
