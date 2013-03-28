<?php defined('SYSPATH') OR die('No direct access allowed.');
/* 系统默认资源文件夹*/
$config['default_catalog'] = array(
    '1' => array(
        'name' => '资源库',
        'parent' => 0,
        'level_depth' => 1
    ),
    '2' => array(
        'name' => '企业资源',
        'parent' => 1,
        'level_depth' => 2
    ),
    '3' => array(
        'name' => '商品资源',
        'parent' => 1,
        'level_depth' => 2
    )
);

/* 站点文件上传配置*/
$config['resourceAttach'] = array();
$config['resourceAttach']['file_type'] = array(
    'jpg', 'jpeg', 'gif', 'png', 'bmp', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'pdf', 'rar', 'zip', 'txt'
);
$config['resourceAttach']['image_type'] = array(
    'jpg', 'jpeg', 'gif', 'png', 'bmp' 
);
$config['resourceAttach']['thumbPresets'] = array(
    'o'=>'',            // 原图
    'ti'  => '40x40',   // 微图
	'sq'  => '60x60',   // 方图
	't'   => '120x120', // 缩略图
	's'   => '160x160', // 小图
	'm'   => '180x180', // 中图
    'l'   => '300x300', // 大图
);
$config['resourceAttach']['fileCountLimit'] = 10; // 10 attachement file
$config['resourceAttach']['fileSizePreLimit'] = 2097152; // 1048576*2 (2M)
