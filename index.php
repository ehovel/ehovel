<?php
//xhprof_enable(XHPROF_FLAGS_CPU + XHPROF_FLAGS_MEMORY);
// xhprof_enable();
/**
 * The directory in which your application specific resources are located.
 * The application directory must contain the bootstrap.php file.
 *
 * @link http://kohanaframework.org/guide/about.install#application
 */
$application = 'front';

/**
 * The directory in which your modules are located.
 *
 * @link http://kohanaframework.org/guide/about.install#modules
 */
$modules = 'modules';

/**
 * The directory in which the Kohana resources are located. The system
 * directory must contain the classes/kohana.php file.
 *
 * @link http://kohanaframework.org/guide/about.install#system
 */
$system = 'system';

/**
 * The default extension of resource files. If you change this, all resources
 * must be renamed to use the new extension.
 *
 * @link http://kohanaframework.org/guide/about.install#ext
 */
define('URL_SUFFIX', '.html');
define('EXT', '.php');

/**
 * Set the PHP error reporting level. If you set this in php.ini, you remove this.
 * @link http://www.php.net/manual/errorfunc.configuration#ini.error-reporting
 *
 * When developing your application, it is highly recommended to enable notices
 * and strict warnings. Enable them by using: E_ALL | E_STRICT
 *
 * In a production environment, it is safe to ignore notices and strict warnings.
 * Disable them by using: E_ALL ^ E_NOTICE
 *
 * When using a legacy application with PHP >= 5.3, it is recommended to disable
 * deprecated notices. Disable with: E_ALL & ~E_DEPRECATED
 */
error_reporting(E_ALL | E_STRICT);

/**
 * End of standard configuration! Changing any of the code below should only be
 * attempted by those with a working knowledge of Kohana internals.
 *
 * @link http://kohanaframework.org/guide/using.configuration
 */

// Set the full path to the docroot
define('DOCROOT', realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR);

// Make the application relative to the docroot, for symlink'd index.php
if ( ! is_dir($application) AND is_dir(DOCROOT.$application))
	$application = DOCROOT.$application;

// Make the modules relative to the docroot, for symlink'd index.php
if ( ! is_dir($modules) AND is_dir(DOCROOT.$modules))
	$modules = DOCROOT.$modules;

// Make the system relative to the docroot, for symlink'd index.php
if ( ! is_dir($system) AND is_dir(DOCROOT.$system))
	$system = DOCROOT.$system;

// Define the absolute paths for configured directories
define('APPPATH', realpath($application).DIRECTORY_SEPARATOR);
define('MODPATH', realpath($modules).DIRECTORY_SEPARATOR);
define('SYSPATH', realpath($system).DIRECTORY_SEPARATOR);

// 前台主题模板
define('THEME', 'dblog');

// Clean up the configuration vars
unset($application, $modules, $system);

/**
 * Define the start time of the application, used for profiling.
 */
if ( ! defined('KOHANA_START_TIME'))
{
	define('KOHANA_START_TIME', microtime(TRUE));
}

/**
 * Define the memory usage at the start of the application, used for profiling.
 */
if ( ! defined('KOHANA_START_MEMORY'))
{
	define('KOHANA_START_MEMORY', memory_get_usage());
}

// Bootstrap the application
require APPPATH.'bootstrap'.EXT;

/**
 * Execute the main request. A source of the URI can be passed, eg: $_SERVER['PATH_INFO'].
 * If no source is specified, the URI will be automatically detected.
 */
echo Request::factory()
	->execute()
	->send_headers(TRUE)
	->body();
// start profiling

register_shutdown_function('myshutdown_hxm');
function myshutdown_hxm(){

	$data = xhprof_disable();
	$xhprof_root = 'D:/Program Files/xampp/htdocs/xhprof';
	include_once $xhprof_root.'/xhprof_lib/utils/xhprof_lib.php';
	include_once $xhprof_root.'/xhprof_lib/utils/xhprof_runs.php';
	$objXhprofRun = new XHProfRuns_Default();
	$run_id = $objXhprofRun->save_run($data, "xhprof");

	$url = "<br /> \n <a target='blank' href='http://localhost/xhprof/xhprof_html/index.php?run={$run_id}".
			"&source=xhprof&all=1'>{$_SERVER['REQUEST_URI']}_{$run_id} time:".date('Y-m-d H:i:s')."</a>";
	$arr = array('run_id'=>$run_id,
			'html'=>'xhprof/xhprof_html/index.php',
			'graph'=>'xhprof/xhprof_html/callgraph.php',
			'uri'=>$_SERVER['REQUEST_URI'],
			'time' => microtime(1),
			'request_date'=> $_REQUEST,
			'ip'=>$_SERVER['REMOTE_ADDR'],
			//'cookie' => $_COOKIE,
	);
	//    $url .= "\n<textarea cols='150' rows='5'>".print_r($arr, 1).'</textarea>';
	//    $url .= "\n<textarea id='json_encode' cols='150' rows='5'>".json_encode($arr).'</textarea>';


	$dir = 'D:/Program Files/xampp/htdocs/xhprof';
	$check = $dir.'xhprof.html';
	$a = file_put_contents($check, $url, FILE_APPEND);
	echo $url;
}