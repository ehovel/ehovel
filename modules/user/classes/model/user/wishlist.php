<?php defined('SYSPATH') or die('No Access Direct Script');
// $Id$
/**
 * 用户收藏商品模型
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package User
 * @category Model
 * @since 2011-12-29
 * @author 朱彬
 * @version $Id$
 */
class Model_User_Wishlist extends ORM_Site
{
    /**
     * 更新时间字段
     * 
     * @var string
     */
    protected $_updated_column = null;
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
