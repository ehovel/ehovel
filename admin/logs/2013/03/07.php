<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2013-03-07 08:43:44 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '}' ~ APPPATH\classes\controller\admin\base.php [ 60 ]
2013-03-07 08:43:44 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected '}' ~ APPPATH\classes\controller\admin\base.php [ 60 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2013-03-07 08:43:45 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '}' ~ APPPATH\classes\controller\admin\base.php [ 60 ]
2013-03-07 08:43:45 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected '}' ~ APPPATH\classes\controller\admin\base.php [ 60 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2013-03-07 08:43:46 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '}' ~ APPPATH\classes\controller\admin\base.php [ 60 ]
2013-03-07 08:43:46 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected '}' ~ APPPATH\classes\controller\admin\base.php [ 60 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2013-03-07 08:43:46 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '}' ~ APPPATH\classes\controller\admin\base.php [ 60 ]
2013-03-07 08:43:46 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected '}' ~ APPPATH\classes\controller\admin\base.php [ 60 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2013-03-07 08:43:46 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '}' ~ APPPATH\classes\controller\admin\base.php [ 60 ]
2013-03-07 08:43:46 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected '}' ~ APPPATH\classes\controller\admin\base.php [ 60 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2013-03-07 08:43:47 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '}' ~ APPPATH\classes\controller\admin\base.php [ 60 ]
2013-03-07 08:43:47 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected '}' ~ APPPATH\classes\controller\admin\base.php [ 60 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2013-03-07 08:43:47 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '}' ~ APPPATH\classes\controller\admin\base.php [ 60 ]
2013-03-07 08:43:47 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected '}' ~ APPPATH\classes\controller\admin\base.php [ 60 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2013-03-07 08:43:47 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '}' ~ APPPATH\classes\controller\admin\base.php [ 60 ]
2013-03-07 08:43:47 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected '}' ~ APPPATH\classes\controller\admin\base.php [ 60 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2013-03-07 08:43:47 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '}' ~ APPPATH\classes\controller\admin\base.php [ 60 ]
2013-03-07 08:43:47 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected '}' ~ APPPATH\classes\controller\admin\base.php [ 60 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2013-03-07 23:54:52 --- CRITICAL: ErrorException [ 8 ]: Use of undefined constant LANGUAGE_ACCESSOR - assumed 'LANGUAGE_ACCESSOR' ~ APPPATH\classes\helper\menu.php [ 22 ] in D:\web\ehovel\source\admin\classes\helper\menu.php:22
2013-03-07 23:54:52 --- DEBUG: #0 D:\web\ehovel\source\admin\classes\helper\menu.php(22): Kohana_Core::error_handler(8, 'Use of undefine...', 'D:\web\ehovel\s...', 22, Array)
#1 D:\web\ehovel\source\admin\views\header.php(45): Helper_Menu::generate_menu()
#2 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#3 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#4 D:\web\ehovel\source\system\classes\view.php(96): Kohana_View->render(NULL)
#5 D:\web\ehovel\source\admin\classes\controller\admin\base.php(58): View->render(NULL, false)
#6 D:\web\ehovel\source\system\classes\kohana\controller.php(69): Controller_Admin_Base->before()
#7 [internal function]: Kohana_Controller->execute()
#8 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Index))
#9 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#10 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#11 D:\web\ehovel\source\admin\index.php(103): Kohana_Request->execute()
#12 {main} in D:\web\ehovel\source\admin\classes\helper\menu.php:22
2013-03-07 23:55:08 --- CRITICAL: ErrorException [ 1 ]: Class 'ORM' not found ~ APPPATH\classes\helper\menu.php [ 23 ] in :
2013-03-07 23:55:08 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-07 23:55:09 --- CRITICAL: ErrorException [ 1 ]: Class 'ORM' not found ~ APPPATH\classes\helper\menu.php [ 23 ] in :
2013-03-07 23:55:09 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-07 23:55:39 --- CRITICAL: ErrorException [ 1 ]: Class 'Database' not found ~ MODPATH\orm\classes\kohana\orm.php [ 317 ] in :
2013-03-07 23:55:39 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-07 23:56:51 --- CRITICAL: ErrorException [ 1 ]: Class 'Database' not found ~ MODPATH\orm\classes\kohana\orm.php [ 317 ] in :
2013-03-07 23:56:51 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-07 23:56:52 --- CRITICAL: ErrorException [ 1 ]: Class 'Database' not found ~ MODPATH\orm\classes\kohana\orm.php [ 317 ] in :
2013-03-07 23:56:52 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-07 23:56:52 --- CRITICAL: ErrorException [ 1 ]: Class 'Database' not found ~ MODPATH\orm\classes\kohana\orm.php [ 317 ] in :
2013-03-07 23:56:52 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-07 23:56:53 --- CRITICAL: ErrorException [ 1 ]: Class 'Database' not found ~ MODPATH\orm\classes\kohana\orm.php [ 317 ] in :
2013-03-07 23:56:53 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-07 23:56:53 --- CRITICAL: ErrorException [ 1 ]: Class 'Database' not found ~ MODPATH\orm\classes\kohana\orm.php [ 317 ] in :
2013-03-07 23:56:53 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-07 23:56:54 --- CRITICAL: ErrorException [ 1 ]: Class 'Database' not found ~ MODPATH\orm\classes\kohana\orm.php [ 317 ] in :
2013-03-07 23:56:54 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-07 23:58:48 --- CRITICAL: ErrorException [ 1 ]: Class 'Database' not found ~ MODPATH\orm\classes\kohana\orm.php [ 317 ] in :
2013-03-07 23:58:48 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-07 23:58:48 --- CRITICAL: ErrorException [ 1 ]: Class 'Database' not found ~ MODPATH\orm\classes\kohana\orm.php [ 317 ] in :
2013-03-07 23:58:48 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :