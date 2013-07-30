<?php defined('SYSPATH') or die('No direct script access.');
/**
 * OSS(Open Storage Services) PHP SDK v1.1.5
 */
//设置默认时区
date_default_timezone_set('Asia/Shanghai');

//检测API路径
if(!defined('OSS_API_PATH'))
	define('OSS_API_PATH', dirname(__FILE__));


//加载conf.inc.php文件
require_once OSS_API_PATH.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'oss.php';

//加载RequestCore
require_once OSS_API_PATH.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.'requestcore.class.php';

//加载MimeTypes
require_once OSS_API_PATH.DIRECTORY_SEPARATOR.'util'.DIRECTORY_SEPARATOR.'mimetypes.class.php';

//检测语言包
if(file_exists(OSS_API_PATH.DIRECTORY_SEPARATOR.'i18n'.DIRECTORY_SEPARATOR.ALI_LANG.DIRECTORY_SEPARATOR.'oss.php')){
	require_once OSS_API_PATH.DIRECTORY_SEPARATOR.'i18n'.DIRECTORY_SEPARATOR.ALI_LANG.DIRECTORY_SEPARATOR.'oss.php';
}else{
	throw new OSSException(OSS_LANG_FILE_NOT_EXIST);
}

//定义软件名称，版本号等信息
define('OSS_NAME','oss-sdk-php');
define('OSS_VERSION','1.1.5');
define('OSS_BUILD','201210121010245');
define('OSS_AUTHOR', 'xiaobing.meng@alibaba-inc.com');

