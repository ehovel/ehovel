<?php defined('SYSPATH') or die('No direct script access.');
/**
 * 站点地图模型
 *
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package Site
 * @category  Model  
 * @since 2011-11-25
 * @author dongxiaoyu
 * @version   $Id$
 */
class Model_Site_Sitemap_log extends ORM
{

	protected $_table_name = 'site_map_logs';
    /**
     * 验证规则
     * @return array
     */
    public function aa_rules ()
    {
        return array(
            'index' => array(
                array('not_empty'),
                array('numeric')
            ),
            'category' => array(
                array('not_empty'),
                array('numeric')
            ),
            'product' => array(
                array('not_empty'),
                array('numeric')
            ),
            'index' => array(
                array('not_empty'),
                array('numeric')
            ),
            'promotion' => array(
                array('not_empty'),
                array('numeric')
            ),
            'doc' => array(
                array('not_empty'),
                array('numeric')
            ),
            'on_sale' => array(
                array('not_empty'),
                array('digit')
            ),
            'exclude_category' => array(
                array('min_length', array(':value', 1)),
                array('max_length', array(':value', 65535))
            ),
            'exclude_product' => array(
                array('min_length', array(':value', 1)),
                array('max_length', array(':value', 65535))
            )
        );
    }

    protected $_filters = array(TRUE => array('trim' => NULL));
    
}