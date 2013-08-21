<?php defined('SYSPATH') OR die('No direct script access allowed.');

if (!Route::cache()) {
	init_site_route_before();
}
function init_site_route_before()
{
    Route::set('cms/doc_view', 'cms/<type>-<id>', array(
			'type' => '[\w\d\s\.,]+',
            'id' => '\d+',
        ))
        ->defaults(array(
			'directory'  => 'admin',
            'controller' => 'content',
            'action'     => 'index',
        ));

   Route::set('cms/news_view', 'news/view/<id>', array(
   			'id' => '\d+',
        ))
        ->defaults(array(
        	'directory'  => 'admin',
            'controller' => 'content',
            'action'     => 'view',
        ));
}
function init_site_route_after()
{
    I18n::package('zh');
}
