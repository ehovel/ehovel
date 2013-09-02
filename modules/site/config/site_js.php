<?php defined('SYSPATH') OR die('No direct script access allowed.');

return array(
    /**
     * js 文件存储目录
     */
    'direct'   => DOCROOT . 'front\statics' . DIRECTORY_SEPARATOR,
    'path' => '/statics/',
    
    /**
     * 文件基础 URL
     */
    'base_url' => array(url::base() . 'public/'),
    
);