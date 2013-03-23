<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2013-03-20 03:00:52 --- CRITICAL: ErrorException [ 1 ]: Access to undeclared static property: Helper_Toolbar::$instances ~ APPPATH\classes\helper\toolbar.php [ 32 ] in :
2013-03-20 03:00:52 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-20 03:01:24 --- CRITICAL: ErrorException [ 1 ]: Access to undeclared static property: Helper_Toolbar::$instances ~ APPPATH\classes\helper\toolbar.php [ 32 ] in :
2013-03-20 03:01:24 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-20 03:01:50 --- CRITICAL: ErrorException [ 1 ]: Access to undeclared static property: Helper_Toolbar::$instances ~ APPPATH\classes\helper\toolbar.php [ 32 ] in :
2013-03-20 03:01:50 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-20 03:02:06 --- CRITICAL: ErrorException [ 8 ]: Undefined index: name ~ APPPATH\classes\helper\toolbar.php [ 79 ] in D:\web\ehovel\source\admin\classes\helper\toolbar.php:79
2013-03-20 03:02:06 --- DEBUG: #0 D:\web\ehovel\source\admin\classes\helper\toolbar.php(79): Kohana_Core::error_handler(8, 'Undefined index...', 'D:\web\ehovel\s...', 79, Array)
#1 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(76): Helper_Toolbar->render()
#2 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Cms_Content->action_edit()
#3 [internal function]: Kohana_Controller->execute()
#4 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#5 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#7 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#8 {main} in D:\web\ehovel\source\admin\classes\helper\toolbar.php:79
2013-03-20 03:12:06 --- CRITICAL: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH\views\header.php [ 45 ] in :
2013-03-20 03:12:06 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-20 03:12:21 --- CRITICAL: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH\views\header.php [ 45 ] in :
2013-03-20 03:12:21 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-20 03:12:23 --- CRITICAL: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH\views\header.php [ 45 ] in :
2013-03-20 03:12:23 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-20 03:14:02 --- CRITICAL: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH\views\header.php [ 45 ] in :
2013-03-20 03:14:02 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-20 03:14:03 --- CRITICAL: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH\views\header.php [ 45 ] in :
2013-03-20 03:14:03 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-20 03:18:29 --- CRITICAL: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH\views\header.php [ 45 ] in :
2013-03-20 03:18:29 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-20 03:18:30 --- CRITICAL: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH\views\header.php [ 45 ] in :
2013-03-20 03:18:30 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-20 03:18:33 --- CRITICAL: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH\views\header.php [ 45 ] in :
2013-03-20 03:18:33 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-20 03:18:36 --- CRITICAL: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH\views\header.php [ 45 ] in :
2013-03-20 03:18:36 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-20 03:20:59 --- CRITICAL: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH\views\header.php [ 45 ] in :
2013-03-20 03:20:59 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-20 03:21:00 --- CRITICAL: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH\views\header.php [ 45 ] in :
2013-03-20 03:21:00 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-20 03:21:21 --- CRITICAL: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH\views\header.php [ 45 ] in :
2013-03-20 03:21:21 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-20 03:21:43 --- CRITICAL: ErrorException [ 8 ]: Undefined variable: toolbar ~ MODPATH\cms\classes\controller\admin\cms\content.php [ 78 ] in D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php:78
2013-03-20 03:21:43 --- DEBUG: #0 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(78): Kohana_Core::error_handler(8, 'Undefined varia...', 'D:\web\ehovel\s...', 78, Array)
#1 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Cms_Content->action_edit()
#2 [internal function]: Kohana_Controller->execute()
#3 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#4 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#6 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#7 {main} in D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php:78
2013-03-20 03:22:05 --- CRITICAL: ErrorException [ 8 ]: Trying to get property of non-object ~ MODPATH\cms\classes\controller\admin\cms\content.php [ 78 ] in D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php:78
2013-03-20 03:22:05 --- DEBUG: #0 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(78): Kohana_Core::error_handler(8, 'Trying to get p...', 'D:\web\ehovel\s...', 78, Array)
#1 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Cms_Content->action_edit()
#2 [internal function]: Kohana_Controller->execute()
#3 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#4 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#6 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#7 {main} in D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php:78
2013-03-20 03:27:44 --- CRITICAL: ErrorException [ 8 ]: Trying to get property of non-object ~ MODPATH\cms\classes\controller\admin\cms\content.php [ 78 ] in D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php:78
2013-03-20 03:27:44 --- DEBUG: #0 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(78): Kohana_Core::error_handler(8, 'Trying to get p...', 'D:\web\ehovel\s...', 78, Array)
#1 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Cms_Content->action_edit()
#2 [internal function]: Kohana_Controller->execute()
#3 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#4 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#6 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#7 {main} in D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php:78
2013-03-20 04:30:42 --- CRITICAL: ErrorException [ 8 ]: Undefined variable: toolbar ~ APPPATH\views\header.php [ 45 ] in D:\web\ehovel\source\admin\views\header.php:45
2013-03-20 04:30:42 --- DEBUG: #0 D:\web\ehovel\source\admin\views\header.php(45): Kohana_Core::error_handler(8, 'Undefined varia...', 'D:\web\ehovel\s...', 45, Array)
#1 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#2 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#3 D:\web\ehovel\source\system\classes\view.php(96): Kohana_View->render(NULL)
#4 D:\web\ehovel\source\admin\classes\controller\admin\base.php(61): View->render(NULL, false)
#5 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(7): Controller_Admin_Base->before()
#6 D:\web\ehovel\source\system\classes\kohana\controller.php(69): Controller_Admin_Cms_Content->before()
#7 [internal function]: Kohana_Controller->execute()
#8 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#9 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#10 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#11 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#12 {main} in D:\web\ehovel\source\admin\views\header.php:45
2013-03-20 04:47:41 --- CRITICAL: ErrorException [ 8 ]: Undefined variable: toolbar ~ MODPATH\cms\classes\controller\admin\cms\content.php [ 98 ] in D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php:98
2013-03-20 04:47:41 --- DEBUG: #0 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(98): Kohana_Core::error_handler(8, 'Undefined varia...', 'D:\web\ehovel\s...', 98, Array)
#1 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Cms_Content->action_edit()
#2 [internal function]: Kohana_Controller->execute()
#3 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#4 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#6 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#7 {main} in D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php:98
2013-03-20 04:47:47 --- CRITICAL: ErrorException [ 8 ]: Undefined variable: toolbar ~ MODPATH\cms\classes\controller\admin\cms\content.php [ 98 ] in D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php:98
2013-03-20 04:47:47 --- DEBUG: #0 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(98): Kohana_Core::error_handler(8, 'Undefined varia...', 'D:\web\ehovel\s...', 98, Array)
#1 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Cms_Content->action_edit()
#2 [internal function]: Kohana_Controller->execute()
#3 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#4 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#6 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#7 {main} in D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php:98
2013-03-20 04:48:03 --- CRITICAL: ErrorException [ 1 ]: Call to a member function render() on a non-object ~ APPPATH\classes\controller\admin\base.php [ 77 ] in :
2013-03-20 04:48:03 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-20 04:52:33 --- CRITICAL: ErrorException [ 8 ]: Undefined variable: toolbar ~ APPPATH\views\header.php [ 45 ] in D:\web\ehovel\source\admin\views\header.php:45
2013-03-20 04:52:33 --- DEBUG: #0 D:\web\ehovel\source\admin\views\header.php(45): Kohana_Core::error_handler(8, 'Undefined varia...', 'D:\web\ehovel\s...', 45, Array)
#1 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#2 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#3 D:\web\ehovel\source\system\classes\view.php(96): Kohana_View->render(NULL)
#4 D:\web\ehovel\source\admin\classes\controller\admin\base.php(61): View->render(NULL, false)
#5 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(7): Controller_Admin_Base->before()
#6 D:\web\ehovel\source\system\classes\kohana\controller.php(69): Controller_Admin_Cms_Content->before()
#7 [internal function]: Kohana_Controller->execute()
#8 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#9 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#10 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#11 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#12 {main} in D:\web\ehovel\source\admin\views\header.php:45
2013-03-20 04:54:53 --- CRITICAL: ErrorException [ 8 ]: Undefined variable: toolbar ~ APPPATH\views\header.php [ 45 ] in D:\web\ehovel\source\admin\views\header.php:45
2013-03-20 04:54:53 --- DEBUG: #0 D:\web\ehovel\source\admin\views\header.php(45): Kohana_Core::error_handler(8, 'Undefined varia...', 'D:\web\ehovel\s...', 45, Array)
#1 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#2 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#3 D:\web\ehovel\source\system\classes\view.php(96): Kohana_View->render(NULL)
#4 D:\web\ehovel\source\admin\classes\controller\admin\base.php(61): View->render(NULL, false)
#5 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(7): Controller_Admin_Base->before()
#6 D:\web\ehovel\source\system\classes\kohana\controller.php(69): Controller_Admin_Cms_Content->before()
#7 [internal function]: Kohana_Controller->execute()
#8 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#9 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#10 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#11 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#12 {main} in D:\web\ehovel\source\admin\views\header.php:45
2013-03-20 04:54:54 --- CRITICAL: ErrorException [ 8 ]: Undefined variable: toolbar ~ APPPATH\views\header.php [ 45 ] in D:\web\ehovel\source\admin\views\header.php:45
2013-03-20 04:54:54 --- DEBUG: #0 D:\web\ehovel\source\admin\views\header.php(45): Kohana_Core::error_handler(8, 'Undefined varia...', 'D:\web\ehovel\s...', 45, Array)
#1 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#2 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#3 D:\web\ehovel\source\system\classes\view.php(96): Kohana_View->render(NULL)
#4 D:\web\ehovel\source\admin\classes\controller\admin\base.php(61): View->render(NULL, false)
#5 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(7): Controller_Admin_Base->before()
#6 D:\web\ehovel\source\system\classes\kohana\controller.php(69): Controller_Admin_Cms_Content->before()
#7 [internal function]: Kohana_Controller->execute()
#8 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#9 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#10 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#11 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#12 {main} in D:\web\ehovel\source\admin\views\header.php:45