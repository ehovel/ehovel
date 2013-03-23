<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2013-03-08 00:02:44 --- CRITICAL: ErrorException [ 1 ]: Class 'Database' not found ~ MODPATH\orm\classes\kohana\orm.php [ 317 ] in :
2013-03-08 00:02:44 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-08 00:02:44 --- CRITICAL: ErrorException [ 1 ]: Class 'Database' not found ~ MODPATH\orm\classes\kohana\orm.php [ 317 ] in :
2013-03-08 00:02:44 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-08 00:02:44 --- CRITICAL: ErrorException [ 1 ]: Class 'Database' not found ~ MODPATH\orm\classes\kohana\orm.php [ 317 ] in :
2013-03-08 00:02:44 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-08 00:02:45 --- CRITICAL: ErrorException [ 1 ]: Class 'Database' not found ~ MODPATH\orm\classes\kohana\orm.php [ 317 ] in :
2013-03-08 00:02:45 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-08 00:02:45 --- CRITICAL: ErrorException [ 1 ]: Class 'Database' not found ~ MODPATH\orm\classes\kohana\orm.php [ 317 ] in :
2013-03-08 00:02:45 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-08 00:02:45 --- CRITICAL: ErrorException [ 1 ]: Class 'Database' not found ~ MODPATH\orm\classes\kohana\orm.php [ 317 ] in :
2013-03-08 00:02:45 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-08 00:02:45 --- CRITICAL: ErrorException [ 1 ]: Class 'Database' not found ~ MODPATH\orm\classes\kohana\orm.php [ 317 ] in :
2013-03-08 00:02:45 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-08 00:02:46 --- CRITICAL: ErrorException [ 1 ]: Class 'Database' not found ~ MODPATH\orm\classes\kohana\orm.php [ 317 ] in :
2013-03-08 00:02:46 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-08 00:02:46 --- CRITICAL: ErrorException [ 1 ]: Class 'Database' not found ~ MODPATH\orm\classes\kohana\orm.php [ 317 ] in :
2013-03-08 00:02:46 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-08 00:02:46 --- CRITICAL: ErrorException [ 1 ]: Class 'Database' not found ~ MODPATH\orm\classes\kohana\orm.php [ 317 ] in :
2013-03-08 00:02:46 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-08 00:03:12 --- CRITICAL: ErrorException [ 1 ]: Class 'BES' not found ~ APPPATH\classes\model\menu.php [ 23 ] in :
2013-03-08 00:03:12 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-08 00:03:13 --- CRITICAL: ErrorException [ 1 ]: Class 'BES' not found ~ APPPATH\classes\model\menu.php [ 23 ] in :
2013-03-08 00:03:13 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-08 00:03:34 --- CRITICAL: ErrorException [ 1 ]: Class 'Helper_Auth' not found ~ APPPATH\classes\helper\menu.php [ 56 ] in :
2013-03-08 00:03:34 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-08 01:44:59 --- CRITICAL: ErrorException [ 2 ]: Missing argument 2 for Helper_Menu::generate_menu(), called in D:\web\ehovel\source\admin\views\header.php on line 45 and defined ~ APPPATH\classes\helper\menu.php [ 19 ] in D:\web\ehovel\source\admin\classes\helper\menu.php:19
2013-03-08 01:44:59 --- DEBUG: #0 D:\web\ehovel\source\admin\classes\helper\menu.php(19): Kohana_Core::error_handler(2, 'Missing argumen...', 'D:\web\ehovel\s...', 19, Array)
#1 D:\web\ehovel\source\admin\views\header.php(45): Helper_Menu::generate_menu()
#2 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#3 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#4 D:\web\ehovel\source\system\classes\view.php(96): Kohana_View->render(NULL)
#5 D:\web\ehovel\source\admin\classes\controller\admin\base.php(59): View->render(NULL, false)
#6 D:\web\ehovel\source\system\classes\kohana\controller.php(69): Controller_Admin_Base->before()
#7 [internal function]: Kohana_Controller->execute()
#8 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Index))
#9 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#10 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#11 D:\web\ehovel\source\admin\index.php(103): Kohana_Request->execute()
#12 {main} in D:\web\ehovel\source\admin\classes\helper\menu.php:19
2013-03-08 02:00:31 --- CRITICAL: ErrorException [ 8 ]: Undefined variable: mark ~ APPPATH\classes\helper\menu.php [ 26 ] in D:\web\ehovel\source\admin\classes\helper\menu.php:26
2013-03-08 02:00:31 --- DEBUG: #0 D:\web\ehovel\source\admin\classes\helper\menu.php(26): Kohana_Core::error_handler(8, 'Undefined varia...', 'D:\web\ehovel\s...', 26, Array)
#1 D:\web\ehovel\source\admin\classes\helper\menu.php(57): Helper_Menu::generate_menu(Array, 1)
#2 D:\web\ehovel\source\admin\views\header.php(45): Helper_Menu::generate_menu()
#3 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#4 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#5 D:\web\ehovel\source\system\classes\view.php(96): Kohana_View->render(NULL)
#6 D:\web\ehovel\source\admin\classes\controller\admin\base.php(59): View->render(NULL, false)
#7 D:\web\ehovel\source\system\classes\kohana\controller.php(69): Controller_Admin_Base->before()
#8 [internal function]: Kohana_Controller->execute()
#9 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Index))
#10 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#11 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#12 D:\web\ehovel\source\admin\index.php(103): Kohana_Request->execute()
#13 {main} in D:\web\ehovel\source\admin\classes\helper\menu.php:26
2013-03-08 02:00:33 --- CRITICAL: ErrorException [ 8 ]: Undefined variable: mark ~ APPPATH\classes\helper\menu.php [ 26 ] in D:\web\ehovel\source\admin\classes\helper\menu.php:26
2013-03-08 02:00:33 --- DEBUG: #0 D:\web\ehovel\source\admin\classes\helper\menu.php(26): Kohana_Core::error_handler(8, 'Undefined varia...', 'D:\web\ehovel\s...', 26, Array)
#1 D:\web\ehovel\source\admin\classes\helper\menu.php(57): Helper_Menu::generate_menu(Array, 1)
#2 D:\web\ehovel\source\admin\views\header.php(45): Helper_Menu::generate_menu()
#3 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#4 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#5 D:\web\ehovel\source\system\classes\view.php(96): Kohana_View->render(NULL)
#6 D:\web\ehovel\source\admin\classes\controller\admin\base.php(59): View->render(NULL, false)
#7 D:\web\ehovel\source\system\classes\kohana\controller.php(69): Controller_Admin_Base->before()
#8 [internal function]: Kohana_Controller->execute()
#9 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Index))
#10 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#11 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#12 D:\web\ehovel\source\admin\index.php(103): Kohana_Request->execute()
#13 {main} in D:\web\ehovel\source\admin\classes\helper\menu.php:26