<?php defined('SYSPATH') or die('No Access Direct Script');
// $Id$
/**
 * 会员地址模型
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package user
 * @category Model
 * @since 2011-12-07
 * @author fanchongyuan
 * @version $Id$
 */
class Model_User_Address extends ORM
{
    /**
     * 验证规则
     * @return array
     */
    public function rules ()
    {
        return array(
            's_area_id' => array(
                array('not_empty'),
                array('digit'),
            ),
            's_firstname' => array(
                array('not_empty'),
                array('min_length', array(':value', 1)),
                array('max_length', array(':value', 255)),
            ),
            's_lastname' => array(
                array('not_empty'),
                array('min_length', array(':value', 1)),
                array('max_length', array(':value', 255)),
            ),
            's_country' => array(
                array('not_empty'),
                array('min_length', array(':value', 1)),
                array('max_length', array(':value', 255)),
            ),
            's_state' => array(
               // array('not_empty'),
               // array('min_length', array(':value', 1)),
                array('max_length', array(':value', 255)),
            ),
            's_city' => array(
                array('not_empty'),
                array('min_length', array(':value', 1)),
                array('max_length', array(':value', 255)),
            ),
            's_zip' => array(
                array('not_empty'),
               // array('digit'),
                array('min_length', array(':value', 1)),
                array('max_length', array(':value', 255)),
            ),
            's_address' => array(
                array('not_empty'),
                array('min_length', array(':value', 1)),
                array('max_length', array(':value', 255)),
            ),
            's_address1' => array(
                array('min_length', array(':value', 1)),
                array('max_length', array(':value', 255)),
            ),
            's_phone' => array(
                array('min_length', array(':value', 1)),
                array('max_length', array(':value', 255)),
            ),
            's_phone1' => array(
                array('min_length', array(':value', 1)),
                array('max_length', array(':value', 255)),
            ),
        );
    }
}
