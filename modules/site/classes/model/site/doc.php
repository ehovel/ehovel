<?php defined('SYSPATH') or die('No direct script access.');
/**
 * 站点文案
 *
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package Site
 * @category  Model  
 * @since 2011-11-25
 * @author dongxiaoyu
 * @version   $Id$
 */
class Model_Site_Doc extends ORM_Site
{
    /**
     * 软删除字段的名字
     *
     * @var string
     */
    protected $_disabled_column = 'disabled';
    
    /**
     * ORM 关系
     * @var array
     */
    protected $_belongs_to = array(
        'site_doc_category' => array(
            'model' => 'site_doc_category'
        ),
    );
    
    //过滤函数
    protected $_filters = array(TRUE => array('trim' => NULL));

    /**
     * 验证规则
     * @return array
     */
    public function rules()
    {
        return array(
            'key' => array(
                array('not_empty'),
                array('min_length', array(':value', 1)),
                array('max_length', array(':value', 50))
            ),
            'uri' => array(
                array('min_length', array(':value', 0)),
                array('max_length', array(':value', 255))
            ),
            'title' => array(
                array('not_empty'),
                array('min_length', array(':value', 1)),
                array('max_length', array(':value', 255)),
            ),
            'content' => array(
                array('not_empty'),
                array('min_length', array(':value', 1)),
                array('max_length', array(':value', 65536)),
            ),
            'seo_title' => array(
                array('min_length', array(':value', 0)),
                array('max_length', array(':value', 255)),
            ),
            'seo_keywords' => array(
                array('min_length', array(':value', 0)),
                array('max_length', array(':value', 255)),
            ),
            'seo_description' => array(
                array('min_length', array(':value', 0)),
                array('max_length', array(':value', 1024)),
            ),
            'url_key' => array(
                array('not_empty'),
                array('min_length', array(':value', 0)),
                array('max_length', array(':value', 255)),
            ),
            'position' => array(
                array('digit'),
            ),
        );
    }

    /**
     * 判断Key是否重复
     *
     * @param string $email
     * @return boolean
     * <pre>
     *     true:存在
     *     false:不存在
     * </pre>
     */
    public function key_exist($key = '')
    {
        if ($this->loaded()) {
            $admin = EHOVEL::model($this->_object_name)->where('key', '=', $key)
                    ->where('id', '<>', $this->id)
                    ->find();
            if ($admin->loaded()) {
                return true;
            }
        } else {
            EHOVEL::model($this->_object_name)->where('key', '=', $key)->find();
            if ($this->loaded()) {
                return true;
            }
        }
        return false;
    }
    
    /**
     * 判断URL Key是否重复
     *
     * @param string $email
     * @return boolean
     * <pre>
     *     true:存在
     *     false:不存在
     * </pre>
     */
    public function url_key_exist($key = '')
    {
        if ($this->loaded()) {
            $admin = EHOVEL::model($this->_object_name)->where('url_key', '=', $key)
                    ->where('id', '<>', $this->id)
                    ->find();
            if ($admin->loaded()) {
                return true;
            }
        } else {
            EHOVEL::model($this->_object_name)->where('url_key', '=', $key)->find();
            if ($this->loaded()) {
                return true;
            }
        }
        return false;
    }
    /**
     * 获取页面的链接
     * 
     * @return string
     */
    public function get_url($id = null)
    {
        if (!empty($id)) {
            switch (EHOVEL::config('route.type.doc')) {
                case 'url_key':
                    $doc = EHOVEL::model('Site_Doc', $id);
                    if ($doc->loaded()) {
                        return URL::front('doc', 'index', array(
                            'url_key' => $doc->url_key,
                        ));
                    }
                case 'id':
                    return URL::front('doc', 'index', array(
                        'id' => $id,
                    ));
                default:
            }
        } else {
            if ($this->loaded()) {
                $params = array();
                switch (EHOVEL::config('route.type.doc')) {
                    case 'url_key':
                        $params['url_key'] = $this->url_key;
                        break;
                    case 'id':
                        $params['id'] = $this->pk();
                        break;
                    default:
                }
                return URL::front('doc', 'index', $params);
            }
        }
        
        return '';
    }
}