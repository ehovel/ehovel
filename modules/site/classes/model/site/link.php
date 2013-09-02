<?php
/**
 * 友情链接模型
 *
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package Site
 * @category  Model  
 * @since 2011-11-25
 * @author dongxiaoyu
 * @version   $Id$
 */
class Model_Site_link extends ORM_Site
{
    /**
     * 软删除字段的名字
     *
     * @var string
     */
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
            'href' => array(
                array('min_length', array(':value', 1)),
                array('max_length', array(':value', 255)),
            )
        );
    }
    
    /**
     * 判断指定范围内名称是否重复
     *
     * @param string $key
     * @return boolean
     * <pre>
     *     true:存在
     *     false:不存在
     * </pre>
     */
    public function name_exist($name = '')
    {
        if ($this->loaded()) {
            $menu = EHOVEL::model($this->_object_name)
                    ->where('name', '=', $name)
                    ->where('id', '<>', $this->id)
                    ->find();
            if ($menu->loaded()) {
                return true;
            }
        } else {
            EHOVEL::model($this->_object_name)->where('name', '=', $name)
                    ->find();
            if ($this->loaded()) {
                return true;
            }
        }
        return false;
    }
}