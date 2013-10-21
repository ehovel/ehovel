<?php defined('SYSPATH') or die('No Access Direct Script');
// $Id$
/**
 * 栏目站点关联模型
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package column
 * @category Model
 * @since 2011-12-05
 * @author fanchongyuan
 * @version $Id$
 */
class Model_User_Groups_Site_Relation extends ORM
{
    protected $table_name = 'user_groups_site_relations';
    protected $_updated_column = NULL;
    protected $_created_column = NULL;
    /**
     * BELONGS TO 关联
     * 
     * @var array
     */
    protected $_belongs_to = array(
        'user_group' => array(
            'model' => 'User_Group',
            'foreign_key' => 'user_group_id',
        ),
        'site' => array(
            'model' => 'Site',
            'foreign_key' => 'site_id',
        ),
    );
    
}
