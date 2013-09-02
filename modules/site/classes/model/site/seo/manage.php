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
class Model_Site_Seo_Manage extends ORM
{
	protected $_table_name = 'site_seo_manages';
	
    protected $_filters = array(TRUE => array('trim' => NULL)); 
    
    public function get_seo_manage($id)
    {
    	
    }
    
}
