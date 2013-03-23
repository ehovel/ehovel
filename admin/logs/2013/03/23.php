<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2013-03-23 02:30:05 --- CRITICAL: ErrorException [ 1 ]: Class 'BES' not found ~ MODPATH\ehovel\classes\url.php [ 69 ] in :
2013-03-23 02:30:05 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-23 02:32:15 --- CRITICAL: ErrorException [ 4 ]: syntax error, unexpected ',' ~ MODPATH\ehovel\classes\url.php [ 68 ] in :
2013-03-23 02:32:15 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-23 02:32:17 --- CRITICAL: ErrorException [ 4 ]: syntax error, unexpected ',' ~ MODPATH\ehovel\classes\url.php [ 68 ] in :
2013-03-23 02:32:17 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-23 03:05:19 --- CRITICAL: ErrorException [ 1 ]: Function name must be a string ~ APPPATH\classes\controller\admin\base.php [ 134 ] in :
2013-03-23 03:05:19 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-23 03:05:39 --- CRITICAL: ErrorException [ 8 ]: Undefined index: asset_id ~ APPPATH\classes\controller\admin\base.php [ 134 ] in D:\web\ehovel\source\admin\classes\controller\admin\base.php:134
2013-03-23 03:05:39 --- DEBUG: #0 D:\web\ehovel\source\admin\classes\controller\admin\base.php(134): Kohana_Core::error_handler(8, 'Undefined index...', 'D:\web\ehovel\s...', 134, Array)
#1 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(86): Controller_Admin_Base->_prepareData(Object(Model_Content))
#2 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Cms_Content->action_edit()
#3 [internal function]: Kohana_Controller->execute()
#4 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#5 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#7 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#8 {main} in D:\web\ehovel\source\admin\classes\controller\admin\base.php:134
2013-03-23 03:06:23 --- CRITICAL: ErrorException [ 2 ]: trim() expects parameter 1 to be string, array given ~ APPPATH\classes\controller\admin\base.php [ 134 ] in :
2013-03-23 03:06:23 --- DEBUG: #0 [internal function]: Kohana_Core::error_handler(2, 'trim() expects ...', 'D:\web\ehovel\s...', 134, Array)
#1 D:\web\ehovel\source\admin\classes\controller\admin\base.php(134): trim(Array)
#2 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(86): Controller_Admin_Base->_prepareData(Object(Model_Content))
#3 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Cms_Content->action_edit()
#4 [internal function]: Kohana_Controller->execute()
#5 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#6 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#8 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#9 {main} in :
2013-03-23 03:07:10 --- CRITICAL: ErrorException [ 2 ]: trim() expects parameter 1 to be string, array given ~ APPPATH\classes\controller\admin\base.php [ 135 ] in :
2013-03-23 03:07:10 --- DEBUG: #0 [internal function]: Kohana_Core::error_handler(2, 'trim() expects ...', 'D:\web\ehovel\s...', 135, Array)
#1 D:\web\ehovel\source\admin\classes\controller\admin\base.php(135): trim(Array)
#2 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(86): Controller_Admin_Base->_prepareData(Object(Model_Content))
#3 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Cms_Content->action_edit()
#4 [internal function]: Kohana_Controller->execute()
#5 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#6 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#8 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#9 {main} in :
2013-03-23 03:07:19 --- CRITICAL: ErrorException [ 2 ]: trim() expects parameter 1 to be string, array given ~ APPPATH\classes\controller\admin\base.php [ 137 ] in :
2013-03-23 03:07:19 --- DEBUG: #0 [internal function]: Kohana_Core::error_handler(2, 'trim() expects ...', 'D:\web\ehovel\s...', 137, Array)
#1 D:\web\ehovel\source\admin\classes\controller\admin\base.php(137): trim(Array)
#2 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(86): Controller_Admin_Base->_prepareData(Object(Model_Content))
#3 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Cms_Content->action_edit()
#4 [internal function]: Kohana_Controller->execute()
#5 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#6 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#8 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#9 {main} in :
2013-03-23 03:09:07 --- CRITICAL: ErrorException [ 2 ]: trim() expects parameter 1 to be string, array given ~ APPPATH\classes\controller\admin\base.php [ 137 ] in :
2013-03-23 03:09:07 --- DEBUG: #0 [internal function]: Kohana_Core::error_handler(2, 'trim() expects ...', 'D:\web\ehovel\s...', 137, Array)
#1 D:\web\ehovel\source\admin\classes\controller\admin\base.php(137): trim(Array)
#2 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(86): Controller_Admin_Base->_prepareData(Object(Model_Content))
#3 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Cms_Content->action_edit()
#4 [internal function]: Kohana_Controller->execute()
#5 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#6 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#8 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#9 {main} in :
2013-03-23 04:27:49 --- CRITICAL: ErrorException [ 1 ]: Class 'HTTP_Exception_200' not found ~ SYSPATH\classes\kohana\http\exception.php [ 17 ] in :
2013-03-23 04:27:49 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-23 04:30:47 --- CRITICAL: ErrorException [ 1 ]: Class 'HTTP_Exception_200' not found ~ SYSPATH\classes\kohana\http\exception.php [ 17 ] in :
2013-03-23 04:30:47 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-23 05:16:51 --- CRITICAL: ErrorException [ 1 ]: Call to undefined method Request::redirect() ~ APPPATH\classes\controller\admin\base.php [ 152 ] in :
2013-03-23 05:16:51 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :