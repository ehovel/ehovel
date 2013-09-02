<?php defined('SYSPATH') or die('No direct script access.');
/**
 * SEO模型
 *
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package Site
 * @category  Model  
 * @since 2011-11-25
 * @author dongxiaoyu
 * @version   $Id$
 */
class Model_Site_Poster extends ORM_Site
{
    /**
     * 软删除字段的名字
     *
     * @var string
     */
    protected $_disabled_column = 'disabled';
    
    protected $_table_name = 'site_poster';
	
    protected $_filters = array(TRUE => array('trim' => NULL)); 
    
}
