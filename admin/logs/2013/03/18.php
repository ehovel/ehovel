<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2013-03-18 22:54:20 --- CRITICAL: ErrorException [ 1 ]: Class 'Exception_BES' not found ~ MODPATH\cms\classes\controller\admin\cms\content.php [ 127 ] in :
2013-03-18 22:54:20 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-18 23:00:49 --- CRITICAL: ErrorException [ 8 ]: Use of undefined constant STATICS_BASE_URL - assumed 'STATICS_BASE_URL' ~ MODPATH\cms\views\content\edit.php [ 10 ] in D:\web\ehovel\source\modules\cms\views\content\edit.php:10
2013-03-18 23:00:49 --- DEBUG: #0 D:\web\ehovel\source\modules\cms\views\content\edit.php(10): Kohana_Core::error_handler(8, 'Use of undefine...', 'D:\web\ehovel\s...', 10, Array)
#1 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#2 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#3 D:\web\ehovel\source\system\classes\view.php(92): Kohana_View->render(NULL)
#4 D:\web\ehovel\source\system\classes\kohana\view.php(228): View->render()
#5 D:\web\ehovel\source\admin\classes\controller\admin\base.php(74): Kohana_View->__toString()
#6 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(151): Controller_Admin_Base->after()
#7 D:\web\ehovel\source\system\classes\kohana\controller.php(87): Controller_Admin_Cms_Content->after()
#8 [internal function]: Kohana_Controller->execute()
#9 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#10 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#11 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#12 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#13 {main} in D:\web\ehovel\source\modules\cms\views\content\edit.php:10
2013-03-18 23:01:24 --- CRITICAL: ErrorException [ 1 ]: Call to undefined method URL::current() ~ MODPATH\cms\views\content\edit.php [ 14 ] in :
2013-03-18 23:01:24 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-18 23:02:04 --- CRITICAL: ErrorException [ 8 ]: Undefined variable: all_categories ~ MODPATH\cms\views\content\edit.php [ 21 ] in D:\web\ehovel\source\modules\cms\views\content\edit.php:21
2013-03-18 23:02:04 --- DEBUG: #0 D:\web\ehovel\source\modules\cms\views\content\edit.php(21): Kohana_Core::error_handler(8, 'Undefined varia...', 'D:\web\ehovel\s...', 21, Array)
#1 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#2 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#3 D:\web\ehovel\source\system\classes\view.php(92): Kohana_View->render(NULL)
#4 D:\web\ehovel\source\system\classes\kohana\view.php(228): View->render()
#5 D:\web\ehovel\source\admin\classes\controller\admin\base.php(74): Kohana_View->__toString()
#6 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(151): Controller_Admin_Base->after()
#7 D:\web\ehovel\source\system\classes\kohana\controller.php(87): Controller_Admin_Cms_Content->after()
#8 [internal function]: Kohana_Controller->execute()
#9 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#10 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#11 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#12 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#13 {main} in D:\web\ehovel\source\modules\cms\views\content\edit.php:21
2013-03-18 23:02:17 --- CRITICAL: ErrorException [ 1 ]: Call to undefined method HTML::cancel_anchor() ~ MODPATH\cms\views\content\edit.php [ 71 ] in :
2013-03-18 23:02:17 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-18 23:04:35 --- CRITICAL: ErrorException [ 1 ]: Class 'JText' not found ~ MODPATH\cms\views\content\edit.php [ 18 ] in :
2013-03-18 23:04:35 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-18 23:04:53 --- CRITICAL: ErrorException [ 1 ]: Using $this when not in object context ~ MODPATH\cms\views\content\edit.php [ 27 ] in :
2013-03-18 23:04:53 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-18 23:07:59 --- CRITICAL: ErrorException [ 1 ]: Class 'JText' not found ~ MODPATH\cms\views\content\edit.php [ 20 ] in :
2013-03-18 23:07:59 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :