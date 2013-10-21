<?php defined('SYSPATH') or die('No Access Direct Script');
// $Id$
/**
 * 用户优惠券
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package User
 * @category Model
 * @since 2012-03-08
 * @author 朱彬
 * @version $Id$
 */
class Model_User_Coupon extends ORM
{
    /**
     * 更新时间字段配置，当无更新时间字段时，将此项设置为NULL
     * 
     * @var array
     */
    protected $_updated_column = NULL;
    /**
     * BELONGS TO 关联
     * 
     * @var array
     */
    protected $_belongs_to = array(
        'user' => array(
            'model' => 'User',
            'foreign_key' => 'user_id',
        ),
    );
}
