<?php defined('SYSPATH') or die('No Access Direct Script');
// $Id$
/**
 * 会员组模型
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package user
 * @category Model
 * @since 2011-12-06
 * @author fanchongyuan
 * @version $Id$
 */
class Model_User_Group extends ORM_Lang
{
    /* 指定软删除字段 */
    protected $_disabled_column = 'disabled';
    protected $_lang_relation = array(
        'model' => 'User_Groups_Site_Relation',
        'foreign_key' => 'user_group_id',
    );

    protected $_has_many = array(
        'user'=>array(
            'model'=>'User',
        ),
    );

    /**
     * 验证规则
     * @return array
     */
    public function rules ()
    {
        return array(
            'name' => array(
                array('not_empty'),
                array('min_length', array(':value', 1)),
                array('max_length', array(':value', 255)),
            ),
            'score' => array(
                array('digit'),
                array('range', array(':value', 0, 999999999)),
            ),
            'discount' => array(
                array('decimal'),
                array('range',array(':value',0,1)),
            ),
        );
    }

    /**
     * 获取默认会员组对象
     * @access public
     * @return Model_User_Group object 会员组对象 | boolen
     * @author fanchongyuan
     * @example 
     */
    public function get_default_group()
    {
        $result = $this->where('is_default','=','Y')->find();
        if($result->loaded())
        {
            return $result;
        } else {
            return false;
        }
    }

    /**
     * 根据站点取得用户组信息
     * @access public
     * @param int $site_id
     * @return array
     */
    public function get_user_groups_by_site_id($site_id){
        return array_map(create_function('$item','return $item->as_array();'),BES::model('User_Group')->find_all()->as_array());
    }
    
}
