<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2013-04-13 14:41:02 --- CRITICAL: ErrorException [ 8 ]: Undefined offset: 1 ~ APPPATH\classes\controller\admin\base.php [ 154 ] in D:\web\ehovel\source\admin\classes\controller\admin\base.php:154
2013-04-13 14:41:02 --- DEBUG: #0 D:\web\ehovel\source\admin\classes\controller\admin\base.php(154): Kohana_Core::error_handler(8, 'Undefined offse...', 'D:\web\ehovel\s...', 154, Array)
#1 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Base->action_processform()
#2 [internal function]: Kohana_Controller->execute()
#3 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#4 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#6 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#7 {main} in D:\web\ehovel\source\admin\classes\controller\admin\base.php:154
2013-04-13 14:50:23 --- CRITICAL: ErrorException [ 1 ]: Call to undefined method Controller_Admin_Resource::_do_delete() ~ APPPATH\classes\controller\admin\base.php [ 156 ] in :
2013-04-13 14:50:23 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-04-13 14:51:46 --- CRITICAL: ErrorException [ 1 ]: Call to private method Controller_Admin_Resource::_do_list_form_delete() from context 'Controller_Admin_Base' ~ APPPATH\classes\controller\admin\base.php [ 156 ] in :
2013-04-13 14:51:46 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-04-13 15:14:37 --- CRITICAL: ErrorException [ 8 ]: Undefined index: ids ~ MODPATH\resource\classes\controller\admin\resource.php [ 808 ] in D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php:808
2013-04-13 15:14:37 --- DEBUG: #0 D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php(808): Kohana_Core::error_handler(8, 'Undefined index...', 'D:\web\ehovel\s...', 808, Array)
#1 D:\web\ehovel\source\admin\classes\controller\admin\base.php(156): Controller_Admin_Resource->_do_list_form_delete()
#2 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Base->action_processlistform()
#3 [internal function]: Kohana_Controller->execute()
#4 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#5 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#7 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#8 {main} in D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php:808