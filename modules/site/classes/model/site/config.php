<?php defined('SYSPATH') or die('No direct script access.');
// $Id$
/**
 * 站点配置模型
 *
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package Site
 * @category  Model  
 * @since 2011-11-25
 * @author dongxiaoyu
 * @version   $Id$
 */
class Model_Site_Config extends ORM_Site
{

    //过滤函数
    protected $_filters = array(TRUE => array('trim' => NULL));
    
    protected $_configs = NULL;
    
    /**
     * 验证规则
     * @return array
     */
    public function rules()
    {
        return array();
    }
    
    public function getc($key)
    {
        if (is_null($this->_configs)) {
            $this->_configs = EHOVEL::model('Site_Config')->find_all()->as_array('name', 'value');
        }
        return isset($this->_configs[$key])
                ? $this->_configs[$key]
                : NULL;
    }
    
    /**
     * 站点配置信息设置
     *
     * @param string $key,$value
     * @return boolean
     * <pre>
     *     true:存在
     *     false:不存在
     * </pre>
     */
    public function setc($key, $value)
    {
        $record = EHOVEL::model('Site_Config')
            ->where('name', '=', $key)
            ->find();
            
        if (!$record->loaded()) {
            $record = EHOVEL::model('Site_Config');
        }
        
        $record->name  = $key;
        $record->value = $value;
        
        $record->save();
        
        if ($record->saved()) {
            $this->_configs = NULL;
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
