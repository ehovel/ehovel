<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * 库存
 *
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package Site
 * @category  Model  
 * @since 2011-11-25
 * @author dong.xiaoyu
 * @version   $Id$
 */
class Model_Site_Store extends ORM {
    /**
     * 软删除字段的名字
     *
     * @var string
     */
    protected $_disabled_column = 'disabled';
    /**
     * HAS MANY关联
     * 
     * @var array
     */
    protected $_has_many = array(
        'products' => array(
            'model' => 'Product_Store',
            'foreign_key' => 'store_id',
        ),
    );
    
/**
     * 判断名称是否重复
     *
     * @param string $name
     * @return boolean
     * <pre>
     *     true:存在
     *     false:不存在
     * </pre>
     */
    public function name_exist($name = '',$id = '')
    {
	    if(!empty($id))
		    {
		        $store_info = EHOVEL::model ( 'Site_Store' )->where('id','=',$id)->find();
		        if($name == $store_info->name)
		        {
		            return FALSE;
		        }
		    }
			$store_info = EHOVEL::model ( 'Site_Store' )->find_all();
			$old_store_info = array();
			foreach($store_info as $storeInfo)
			{
			    array_push($old_store_info,$storeInfo->name);
			}
			if (in_array($name,$old_store_info))
			{
			    return TRUE;
			}
			else
			{
			    return FALSE;
			}
    }
    
}
