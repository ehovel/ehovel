<?php defined('SYSPATH') or die('No direct script access.');
// $Id$
/**
 * 站点模型
 * @copyright Copyright (c) 2012, Ketai inc.
 * @package model 
 * @category  model
 * @since 2012-05-23
 * @author fanchongyuan
 * @version $Id$
 */
class Model_Site extends ORM
{
    /* 指定软删除字段 */
    protected $_disabled_column = 'disabled';

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
            'domain' => array(
                array('not_empty'),
                array('min_length', array(':value', 1)),
                array('max_length', array(':value', 255)),
            ),
            'language' => array(
                array('not_empty'),
                array('min_length', array(':value', 1)),
                array('max_length', array(':value', 255)),
            ),
        );
    }

    public function get_sites()
    {
    	$sites = EHOVEL::registry('sites');
       	if(empty($sites))
        {
            $sites = EHOVEL::model('site')->where('active','=','Y')->find_all();
            EHOVEL::registry('sites',$sites);
        }
        return $sites;
    }
}
