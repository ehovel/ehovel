<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2013-04-12 17:37:42 --- CRITICAL: ErrorException [ 8 ]: Undefined property: Controller_Admin_Resource::$input ~ MODPATH\resource\classes\controller\admin\resource.php [ 201 ] in D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php:201
2013-04-12 17:37:42 --- DEBUG: #0 D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php(201): Kohana_Core::error_handler(8, 'Undefined prope...', 'D:\web\ehovel\s...', 201, Array)
#1 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Resource->action_delete()
#2 [internal function]: Kohana_Controller->execute()
#3 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#4 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#6 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#7 {main} in D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php:201
2013-04-12 17:41:02 --- CRITICAL: ErrorException [ 1 ]: Call to undefined method Kohana::lang() ~ MODPATH\resource\classes\controller\admin\resource.php [ 217 ] in :
2013-04-12 17:41:02 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-04-12 17:41:39 --- CRITICAL: ErrorException [ 1 ]: Call to undefined method Kohana::lang() ~ MODPATH\resource\classes\controller\admin\resource.php [ 217 ] in :
2013-04-12 17:41:39 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-04-12 18:01:20 --- CRITICAL: ErrorException [ 1 ]: Call to undefined method Kohana::lang() ~ MODPATH\resource\classes\controller\admin\resource.php [ 217 ] in :
2013-04-12 18:01:20 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-04-12 18:48:11 --- CRITICAL: ErrorException [ 1 ]: Call to undefined method Kohana::lang() ~ MODPATH\resource\classes\controller\admin\resource.php [ 223 ] in :
2013-04-12 18:48:11 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-04-12 18:48:42 --- CRITICAL: ErrorException [ 1 ]: Call to undefined method Kohana::lang() ~ MODPATH\resource\classes\controller\admin\resource.php [ 223 ] in :
2013-04-12 18:48:42 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :