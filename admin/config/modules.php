<?php defined('SYSPATH') or die('No direct script access.');

return array(
    'modules' => array(
    	'auth'       	=> MODPATH.'auth',       // Basic authentication
    	'site'       	=> MODPATH.'site',
    	'uuid'       	=> MODPATH.'uuid',       // uuid|guid
    	'message'       => MODPATH.'message',       // remind message
    	// 'cache'      => MODPATH.'cache',      // Caching with multiple backends
    	// 'codebench'  => MODPATH.'codebench',  // Benchmarking tool
    	'database'   	=> MODPATH.'database',   // Database access
    	'image'      	=> MODPATH.'image',      // Image manipulation
    	'orm'        	=> MODPATH.'orm',        // Object Relationship Mapping
    	'ormmptt'        	=> MODPATH.'ormmptt',        // Object Relationship Mapping
    	'cms'        	=> MODPATH.'cms',        // Object Relationship Mapping
    	'pagination' 	=> MODPATH.'pagination',        // Object Relationship Mapping
    	// 'unittest'   => MODPATH.'unittest',   // Unit testing
    	'userguide'  	=> MODPATH.'userguide',  // User guide and API documentation
    	'resource'  	=> MODPATH.'resource',  // User guide and API documentation
    	'alioss'  	=> MODPATH.'alioss',  // User guide and API documentation
    	//'profilertoolbar'  => MODPATH.'profilertoolbar',  // User guide and API documentation
	),
);
