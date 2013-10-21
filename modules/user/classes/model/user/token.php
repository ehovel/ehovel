<?php defined('SYSPATH') or die('No Access Direct Script');
// $Id$
/**
 * 会员token模型
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package User
 * @category Model
 * @since 2012-01-06
 * @author zhubin
 * @version $Id$
 */
class Model_User_Token extends ORM
{
    /**
     * 更新时间字段配置，当无更新时间字段时，将此项设置为NULL
     * 
     * @var array
     */
    protected $_updated_column = NULL;
}
