<?php defined('SYSPATH') or die('No Direct Script Access.');
// $Id$
/**
 * 角色模型类
 *
 * @package Auth
 * @category Model
 * @author zhubin
 * @version $Id$
 * @copyright Ketai, 2011
 * @since 2011-11-22
 */
class Model_Auth_Log extends ORM {
	protected $_updated_column = NULL;
    protected $_created_column = NULL;
    /**
     * has many关系
     */
    protected $_belongs_to = array(
        'admins' => array(
            'model' => 'Auth_Admin',
            'foreign_key' => 'admin_id'
        ),
    );
    
}
