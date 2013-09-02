<?php defined('SYSPATH') OR die('No direct script access allowed.');

function init_site_route_before()
{
    Route::set('site/doc', 'doc/<type>-<id>'.EXT_URL, array(
			'type' => '[\w\d\s\.,]+',
            'id' => '\d+',
        ))
        ->defaults(array(
            'controller' => 'site',
            'action'     => 'doc',
        ));
        
   Route::set('site/doc_list', 'doc_list/<type>'.EXT_URL, array(
			'type' => '[\w\d\s\.,]+'
        ))
        ->defaults(array(
            'controller' => 'site',
            'action'     => 'doc_list',
        ));
   Route::set('site/news', '<type>(/page_<page>)<ext_url>', array(
   			'page' => '\d+',
			'type' => 'news',
   			'ext_url'=> EXT_URL
        ))
        ->defaults(array(
            'controller' => 'site',
            'action'     => 'doc_list',
        ));
   Route::set('site/news_view', 'news/view/<id>(<ext_url>)', array(
   			'id' => '\d+',
   			'ext_url'=> EXT_URL
        ))
        ->defaults(array(
            'controller' => 'site',
            'action'     => 'doc',
        ));
}
function init_site_route_after()
{
    I18n::package('site');
    if(EHOVEL::app()->loaded('auth'))
    {
        Helper_Auth::add_config(EHOVEL::config('site_node'));
    }
}
