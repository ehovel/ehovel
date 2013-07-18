<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2013-07-18 11:41:04 --- CRITICAL: Kohana_Exception [ 0 ]: The requested route does not exist: cms_content/index ~ SYSPATH\classes\kohana\route.php [ 106 ] in D:\web\ehovel\source\system\classes\kohana\route.php:212
2013-07-18 11:41:04 --- DEBUG: #0 D:\web\ehovel\source\system\classes\kohana\route.php(212): Kohana_Route::get('cms_content/ind...')
#1 D:\web\ehovel\source\admin\classes\helper\menu.php(55): Kohana_Route::url('cms_content/ind...')
#2 D:\web\ehovel\source\admin\classes\helper\menu.php(61): Helper_Menu::generate_menu(Array, 1)
#3 D:\web\ehovel\source\admin\views\header.php(35): Helper_Menu::generate_menu()
#4 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#5 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#6 D:\web\ehovel\source\system\classes\view.php(96): Kohana_View->render(NULL)
#7 D:\web\ehovel\source\admin\classes\controller\admin\base.php(75): View->render(NULL, false)
#8 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(118): Controller_Admin_Base->after()
#9 D:\web\ehovel\source\system\classes\kohana\controller.php(87): Controller_Admin_Cms_Content->after()
#10 [internal function]: Kohana_Controller->execute()
#11 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#12 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#13 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#14 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#15 {main} in D:\web\ehovel\source\system\classes\kohana\route.php:212
2013-07-18 11:47:54 --- CRITICAL: Kohana_Exception [ 0 ]: The requested route does not exist: admin/cms_content/index ~ SYSPATH\classes\kohana\route.php [ 106 ] in D:\web\ehovel\source\system\classes\kohana\route.php:212
2013-07-18 11:47:54 --- DEBUG: #0 D:\web\ehovel\source\system\classes\kohana\route.php(212): Kohana_Route::get('admin/cms_conte...')
#1 D:\web\ehovel\source\admin\classes\helper\menu.php(55): Kohana_Route::url('admin/cms_conte...')
#2 D:\web\ehovel\source\admin\classes\helper\menu.php(61): Helper_Menu::generate_menu(Array, 1)
#3 D:\web\ehovel\source\admin\views\header.php(35): Helper_Menu::generate_menu()
#4 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#5 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#6 D:\web\ehovel\source\system\classes\view.php(96): Kohana_View->render(NULL)
#7 D:\web\ehovel\source\admin\classes\controller\admin\base.php(75): View->render(NULL, false)
#8 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(118): Controller_Admin_Base->after()
#9 D:\web\ehovel\source\system\classes\kohana\controller.php(87): Controller_Admin_Cms_Content->after()
#10 [internal function]: Kohana_Controller->execute()
#11 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#12 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#13 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#14 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#15 {main} in D:\web\ehovel\source\system\classes\kohana\route.php:212
2013-07-18 11:47:55 --- CRITICAL: Kohana_Exception [ 0 ]: The requested route does not exist: admin/cms_content/index ~ SYSPATH\classes\kohana\route.php [ 106 ] in D:\web\ehovel\source\system\classes\kohana\route.php:212
2013-07-18 11:47:55 --- DEBUG: #0 D:\web\ehovel\source\system\classes\kohana\route.php(212): Kohana_Route::get('admin/cms_conte...')
#1 D:\web\ehovel\source\admin\classes\helper\menu.php(55): Kohana_Route::url('admin/cms_conte...')
#2 D:\web\ehovel\source\admin\classes\helper\menu.php(61): Helper_Menu::generate_menu(Array, 1)
#3 D:\web\ehovel\source\admin\views\header.php(35): Helper_Menu::generate_menu()
#4 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#5 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#6 D:\web\ehovel\source\system\classes\view.php(96): Kohana_View->render(NULL)
#7 D:\web\ehovel\source\admin\classes\controller\admin\base.php(75): View->render(NULL, false)
#8 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(118): Controller_Admin_Base->after()
#9 D:\web\ehovel\source\system\classes\kohana\controller.php(87): Controller_Admin_Cms_Content->after()
#10 [internal function]: Kohana_Controller->execute()
#11 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#12 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#13 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#14 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#15 {main} in D:\web\ehovel\source\system\classes\kohana\route.php:212
2013-07-18 11:47:55 --- CRITICAL: Kohana_Exception [ 0 ]: The requested route does not exist: admin/cms_content/index ~ SYSPATH\classes\kohana\route.php [ 106 ] in D:\web\ehovel\source\system\classes\kohana\route.php:212
2013-07-18 11:47:55 --- DEBUG: #0 D:\web\ehovel\source\system\classes\kohana\route.php(212): Kohana_Route::get('admin/cms_conte...')
#1 D:\web\ehovel\source\admin\classes\helper\menu.php(55): Kohana_Route::url('admin/cms_conte...')
#2 D:\web\ehovel\source\admin\classes\helper\menu.php(61): Helper_Menu::generate_menu(Array, 1)
#3 D:\web\ehovel\source\admin\views\header.php(35): Helper_Menu::generate_menu()
#4 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#5 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#6 D:\web\ehovel\source\system\classes\view.php(96): Kohana_View->render(NULL)
#7 D:\web\ehovel\source\admin\classes\controller\admin\base.php(75): View->render(NULL, false)
#8 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(118): Controller_Admin_Base->after()
#9 D:\web\ehovel\source\system\classes\kohana\controller.php(87): Controller_Admin_Cms_Content->after()
#10 [internal function]: Kohana_Controller->execute()
#11 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#12 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#13 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#14 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#15 {main} in D:\web\ehovel\source\system\classes\kohana\route.php:212
2013-07-18 11:47:56 --- CRITICAL: Kohana_Exception [ 0 ]: The requested route does not exist: admin/cms_content/index ~ SYSPATH\classes\kohana\route.php [ 106 ] in D:\web\ehovel\source\system\classes\kohana\route.php:212
2013-07-18 11:47:56 --- DEBUG: #0 D:\web\ehovel\source\system\classes\kohana\route.php(212): Kohana_Route::get('admin/cms_conte...')
#1 D:\web\ehovel\source\admin\classes\helper\menu.php(55): Kohana_Route::url('admin/cms_conte...')
#2 D:\web\ehovel\source\admin\classes\helper\menu.php(61): Helper_Menu::generate_menu(Array, 1)
#3 D:\web\ehovel\source\admin\views\header.php(35): Helper_Menu::generate_menu()
#4 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#5 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#6 D:\web\ehovel\source\system\classes\view.php(96): Kohana_View->render(NULL)
#7 D:\web\ehovel\source\admin\classes\controller\admin\base.php(75): View->render(NULL, false)
#8 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(118): Controller_Admin_Base->after()
#9 D:\web\ehovel\source\system\classes\kohana\controller.php(87): Controller_Admin_Cms_Content->after()
#10 [internal function]: Kohana_Controller->execute()
#11 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#12 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#13 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#14 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#15 {main} in D:\web\ehovel\source\system\classes\kohana\route.php:212
2013-07-18 11:47:56 --- CRITICAL: Kohana_Exception [ 0 ]: The requested route does not exist: admin/cms_content/index ~ SYSPATH\classes\kohana\route.php [ 106 ] in D:\web\ehovel\source\system\classes\kohana\route.php:212
2013-07-18 11:47:56 --- DEBUG: #0 D:\web\ehovel\source\system\classes\kohana\route.php(212): Kohana_Route::get('admin/cms_conte...')
#1 D:\web\ehovel\source\admin\classes\helper\menu.php(55): Kohana_Route::url('admin/cms_conte...')
#2 D:\web\ehovel\source\admin\classes\helper\menu.php(61): Helper_Menu::generate_menu(Array, 1)
#3 D:\web\ehovel\source\admin\views\header.php(35): Helper_Menu::generate_menu()
#4 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#5 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#6 D:\web\ehovel\source\system\classes\view.php(96): Kohana_View->render(NULL)
#7 D:\web\ehovel\source\admin\classes\controller\admin\base.php(75): View->render(NULL, false)
#8 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(118): Controller_Admin_Base->after()
#9 D:\web\ehovel\source\system\classes\kohana\controller.php(87): Controller_Admin_Cms_Content->after()
#10 [internal function]: Kohana_Controller->execute()
#11 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#12 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#13 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#14 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#15 {main} in D:\web\ehovel\source\system\classes\kohana\route.php:212
2013-07-18 11:47:56 --- CRITICAL: Kohana_Exception [ 0 ]: The requested route does not exist: admin/cms_content/index ~ SYSPATH\classes\kohana\route.php [ 106 ] in D:\web\ehovel\source\system\classes\kohana\route.php:212
2013-07-18 11:47:56 --- DEBUG: #0 D:\web\ehovel\source\system\classes\kohana\route.php(212): Kohana_Route::get('admin/cms_conte...')
#1 D:\web\ehovel\source\admin\classes\helper\menu.php(55): Kohana_Route::url('admin/cms_conte...')
#2 D:\web\ehovel\source\admin\classes\helper\menu.php(61): Helper_Menu::generate_menu(Array, 1)
#3 D:\web\ehovel\source\admin\views\header.php(35): Helper_Menu::generate_menu()
#4 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#5 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#6 D:\web\ehovel\source\system\classes\view.php(96): Kohana_View->render(NULL)
#7 D:\web\ehovel\source\admin\classes\controller\admin\base.php(75): View->render(NULL, false)
#8 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(118): Controller_Admin_Base->after()
#9 D:\web\ehovel\source\system\classes\kohana\controller.php(87): Controller_Admin_Cms_Content->after()
#10 [internal function]: Kohana_Controller->execute()
#11 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#12 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#13 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#14 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#15 {main} in D:\web\ehovel\source\system\classes\kohana\route.php:212
2013-07-18 11:47:57 --- CRITICAL: Kohana_Exception [ 0 ]: The requested route does not exist: admin/cms_content/index ~ SYSPATH\classes\kohana\route.php [ 106 ] in D:\web\ehovel\source\system\classes\kohana\route.php:212
2013-07-18 11:47:57 --- DEBUG: #0 D:\web\ehovel\source\system\classes\kohana\route.php(212): Kohana_Route::get('admin/cms_conte...')
#1 D:\web\ehovel\source\admin\classes\helper\menu.php(55): Kohana_Route::url('admin/cms_conte...')
#2 D:\web\ehovel\source\admin\classes\helper\menu.php(61): Helper_Menu::generate_menu(Array, 1)
#3 D:\web\ehovel\source\admin\views\header.php(35): Helper_Menu::generate_menu()
#4 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#5 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#6 D:\web\ehovel\source\system\classes\view.php(96): Kohana_View->render(NULL)
#7 D:\web\ehovel\source\admin\classes\controller\admin\base.php(75): View->render(NULL, false)
#8 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(118): Controller_Admin_Base->after()
#9 D:\web\ehovel\source\system\classes\kohana\controller.php(87): Controller_Admin_Cms_Content->after()
#10 [internal function]: Kohana_Controller->execute()
#11 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#12 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#13 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#14 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#15 {main} in D:\web\ehovel\source\system\classes\kohana\route.php:212
2013-07-18 11:47:57 --- CRITICAL: Kohana_Exception [ 0 ]: The requested route does not exist: admin/cms_content/index ~ SYSPATH\classes\kohana\route.php [ 106 ] in D:\web\ehovel\source\system\classes\kohana\route.php:212
2013-07-18 11:47:57 --- DEBUG: #0 D:\web\ehovel\source\system\classes\kohana\route.php(212): Kohana_Route::get('admin/cms_conte...')
#1 D:\web\ehovel\source\admin\classes\helper\menu.php(55): Kohana_Route::url('admin/cms_conte...')
#2 D:\web\ehovel\source\admin\classes\helper\menu.php(61): Helper_Menu::generate_menu(Array, 1)
#3 D:\web\ehovel\source\admin\views\header.php(35): Helper_Menu::generate_menu()
#4 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#5 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#6 D:\web\ehovel\source\system\classes\view.php(96): Kohana_View->render(NULL)
#7 D:\web\ehovel\source\admin\classes\controller\admin\base.php(75): View->render(NULL, false)
#8 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(118): Controller_Admin_Base->after()
#9 D:\web\ehovel\source\system\classes\kohana\controller.php(87): Controller_Admin_Cms_Content->after()
#10 [internal function]: Kohana_Controller->execute()
#11 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#12 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#13 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#14 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#15 {main} in D:\web\ehovel\source\system\classes\kohana\route.php:212
2013-07-18 11:48:12 --- CRITICAL: Kohana_Exception [ 0 ]: The requested route does not exist: admin/cms_content ~ SYSPATH\classes\kohana\route.php [ 106 ] in D:\web\ehovel\source\system\classes\kohana\route.php:212
2013-07-18 11:48:12 --- DEBUG: #0 D:\web\ehovel\source\system\classes\kohana\route.php(212): Kohana_Route::get('admin/cms_conte...')
#1 D:\web\ehovel\source\admin\classes\helper\menu.php(55): Kohana_Route::url('admin/cms_conte...')
#2 D:\web\ehovel\source\admin\classes\helper\menu.php(61): Helper_Menu::generate_menu(Array, 1)
#3 D:\web\ehovel\source\admin\views\header.php(35): Helper_Menu::generate_menu()
#4 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#5 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#6 D:\web\ehovel\source\system\classes\view.php(96): Kohana_View->render(NULL)
#7 D:\web\ehovel\source\admin\classes\controller\admin\base.php(75): View->render(NULL, false)
#8 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(118): Controller_Admin_Base->after()
#9 D:\web\ehovel\source\system\classes\kohana\controller.php(87): Controller_Admin_Cms_Content->after()
#10 [internal function]: Kohana_Controller->execute()
#11 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#12 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#13 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#14 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#15 {main} in D:\web\ehovel\source\system\classes\kohana\route.php:212
2013-07-18 11:48:13 --- CRITICAL: Kohana_Exception [ 0 ]: The requested route does not exist: admin/cms_content ~ SYSPATH\classes\kohana\route.php [ 106 ] in D:\web\ehovel\source\system\classes\kohana\route.php:212
2013-07-18 11:48:13 --- DEBUG: #0 D:\web\ehovel\source\system\classes\kohana\route.php(212): Kohana_Route::get('admin/cms_conte...')
#1 D:\web\ehovel\source\admin\classes\helper\menu.php(55): Kohana_Route::url('admin/cms_conte...')
#2 D:\web\ehovel\source\admin\classes\helper\menu.php(61): Helper_Menu::generate_menu(Array, 1)
#3 D:\web\ehovel\source\admin\views\header.php(35): Helper_Menu::generate_menu()
#4 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#5 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#6 D:\web\ehovel\source\system\classes\view.php(96): Kohana_View->render(NULL)
#7 D:\web\ehovel\source\admin\classes\controller\admin\base.php(75): View->render(NULL, false)
#8 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(118): Controller_Admin_Base->after()
#9 D:\web\ehovel\source\system\classes\kohana\controller.php(87): Controller_Admin_Cms_Content->after()
#10 [internal function]: Kohana_Controller->execute()
#11 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#12 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#13 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#14 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#15 {main} in D:\web\ehovel\source\system\classes\kohana\route.php:212
2013-07-18 11:49:23 --- CRITICAL: Kohana_Exception [ 0 ]: The requested route does not exist: admin/cms_content ~ SYSPATH\classes\kohana\route.php [ 106 ] in D:\web\ehovel\source\system\classes\kohana\route.php:212
2013-07-18 11:49:23 --- DEBUG: #0 D:\web\ehovel\source\system\classes\kohana\route.php(212): Kohana_Route::get('admin/cms_conte...')
#1 D:\web\ehovel\source\admin\classes\helper\menu.php(55): Kohana_Route::url('admin/cms_conte...')
#2 D:\web\ehovel\source\admin\classes\helper\menu.php(61): Helper_Menu::generate_menu(Array, 1)
#3 D:\web\ehovel\source\admin\views\header.php(35): Helper_Menu::generate_menu()
#4 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#5 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#6 D:\web\ehovel\source\system\classes\view.php(96): Kohana_View->render(NULL)
#7 D:\web\ehovel\source\admin\classes\controller\admin\base.php(75): View->render(NULL, false)
#8 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(118): Controller_Admin_Base->after()
#9 D:\web\ehovel\source\system\classes\kohana\controller.php(87): Controller_Admin_Cms_Content->after()
#10 [internal function]: Kohana_Controller->execute()
#11 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#12 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#13 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#14 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#15 {main} in D:\web\ehovel\source\system\classes\kohana\route.php:212
2013-07-18 12:59:30 --- CRITICAL: Kohana_Exception [ 0 ]: Required route parameter not passed: type ~ SYSPATH\classes\route.php [ 97 ] in D:\web\ehovel\source\system\classes\kohana\route.php:219
2013-07-18 12:59:30 --- DEBUG: #0 D:\web\ehovel\source\system\classes\kohana\route.php(219): Route->uri(NULL)
#1 D:\web\ehovel\source\admin\classes\helper\menu.php(21): Kohana_Route::url('cms/doc_view')
#2 D:\web\ehovel\source\admin\views\header.php(35): Helper_Menu::generate_menu()
#3 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#4 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#5 D:\web\ehovel\source\system\classes\view.php(96): Kohana_View->render(NULL)
#6 D:\web\ehovel\source\admin\classes\controller\admin\base.php(75): View->render(NULL, false)
#7 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(118): Controller_Admin_Base->after()
#8 D:\web\ehovel\source\system\classes\kohana\controller.php(87): Controller_Admin_Cms_Content->after()
#9 [internal function]: Kohana_Controller->execute()
#10 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#11 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#12 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#13 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#14 {main} in D:\web\ehovel\source\system\classes\kohana\route.php:219
2013-07-18 01:54:55 --- CRITICAL: ErrorException [ 4 ]: syntax error, unexpected T_ISSET, expecting T_STRING or T_VARIABLE or '$' ~ SYSPATH\classes\route.php [ 12 ] in :
2013-07-18 01:54:55 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-07-18 15:47:49 --- CRITICAL: Database_Exception [ 1054 ]: Unknown column 'cat_name' in 'order clause' [ SELECT `content`.`id` AS `id`, `content`.`asset_id` AS `asset_id`, `content`.`title` AS `title`, `content`.`alias` AS `alias`, `content`.`introtext` AS `introtext`, `content`.`fulltext` AS `fulltext`, `content`.`state` AS `state`, `content`.`catid` AS `catid`, `content`.`created` AS `created`, `content`.`created_by` AS `created_by`, `content`.`created_by_alias` AS `created_by_alias`, `content`.`modified` AS `modified`, `content`.`modified_by` AS `modified_by`, `content`.`checked_out` AS `checked_out`, `content`.`checked_out_time` AS `checked_out_time`, `content`.`publish_up` AS `publish_up`, `content`.`publish_down` AS `publish_down`, `content`.`show_type` AS `show_type`, `content`.`images` AS `images`, `content`.`urls` AS `urls`, `content`.`attribs` AS `attribs`, `content`.`version` AS `version`, `content`.`ordering` AS `ordering`, `content`.`metakey` AS `metakey`, `content`.`metadesc` AS `metadesc`, `content`.`access` AS `access`, `content`.`hits` AS `hits`, `content`.`metadata` AS `metadata`, `content`.`featured` AS `featured`, `content`.`language` AS `language`, `content`.`xreference` AS `xreference`, `content`.`disabled` AS `disabled` FROM `contents` AS `content` WHERE `disabled` = '0' ORDER BY `cat_name` ASC LIMIT 20 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ] in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-07-18 15:47:49 --- DEBUG: #0 D:\web\ehovel\source\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'SELECT `content...', 'Model_Content', Array)
#1 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1060): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1001): Kohana_ORM->_load_result(true)
#3 D:\web\ehovel\source\modules\orm\classes\orm.php(157): Kohana_ORM->find_all()
#4 D:\web\ehovel\source\admin\classes\grid.php(137): ORM->find_all()
#5 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(23): Grid->to_array()
#6 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Cms_Content->action_index()
#7 [internal function]: Kohana_Controller->execute()
#8 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#9 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#10 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#11 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#12 {main} in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-07-18 07:24:54 --- CRITICAL: ErrorException [ 2048 ]: Declaration of Route::url() should be compatible with that of Kohana_Route::url() ~ SYSPATH\classes\route.php [ 3 ] in D:\web\ehovel\source\system\classes\route.php:3
2013-07-18 07:24:54 --- DEBUG: #0 D:\web\ehovel\source\system\classes\route.php(3): Kohana_Core::error_handler(2048, 'Declaration of ...', 'D:\web\ehovel\s...', 3, Array)
#1 D:\web\ehovel\source\system\classes\kohana\core.php(511): require('D:\web\ehovel\s...')
#2 [internal function]: Kohana_Core::auto_load('Route')
#3 D:\web\ehovel\source\modules\cms\init.php(3): spl_autoload_call('Route')
#4 D:\web\ehovel\source\system\classes\kohana\core.php(602): require_once('D:\web\ehovel\s...')
#5 D:\web\ehovel\source\admin\bootstrap.php(122): Kohana_Core::modules(Array)
#6 D:\web\ehovel\source\admin.php(95): require('D:\web\ehovel\s...')
#7 {main} in D:\web\ehovel\source\system\classes\route.php:3
2013-07-18 07:24:55 --- CRITICAL: ErrorException [ 2048 ]: Declaration of Route::url() should be compatible with that of Kohana_Route::url() ~ SYSPATH\classes\route.php [ 3 ] in D:\web\ehovel\source\system\classes\route.php:3
2013-07-18 07:24:55 --- DEBUG: #0 D:\web\ehovel\source\system\classes\route.php(3): Kohana_Core::error_handler(2048, 'Declaration of ...', 'D:\web\ehovel\s...', 3, Array)
#1 D:\web\ehovel\source\system\classes\kohana\core.php(511): require('D:\web\ehovel\s...')
#2 [internal function]: Kohana_Core::auto_load('Route')
#3 D:\web\ehovel\source\modules\cms\init.php(3): spl_autoload_call('Route')
#4 D:\web\ehovel\source\system\classes\kohana\core.php(602): require_once('D:\web\ehovel\s...')
#5 D:\web\ehovel\source\admin\bootstrap.php(122): Kohana_Core::modules(Array)
#6 D:\web\ehovel\source\admin.php(95): require('D:\web\ehovel\s...')
#7 {main} in D:\web\ehovel\source\system\classes\route.php:3
2013-07-18 07:25:52 --- CRITICAL: ErrorException [ 2048 ]: Declaration of Route::url() should be compatible with that of Kohana_Route::url() ~ SYSPATH\classes\route.php [ 3 ] in D:\web\ehovel\source\system\classes\route.php:3
2013-07-18 07:25:52 --- DEBUG: #0 D:\web\ehovel\source\system\classes\route.php(3): Kohana_Core::error_handler(2048, 'Declaration of ...', 'D:\web\ehovel\s...', 3, Array)
#1 D:\web\ehovel\source\system\classes\kohana\core.php(511): require('D:\web\ehovel\s...')
#2 [internal function]: Kohana_Core::auto_load('Route')
#3 D:\web\ehovel\source\modules\cms\init.php(3): spl_autoload_call('Route')
#4 D:\web\ehovel\source\system\classes\kohana\core.php(602): require_once('D:\web\ehovel\s...')
#5 D:\web\ehovel\source\admin\bootstrap.php(122): Kohana_Core::modules(Array)
#6 D:\web\ehovel\source\admin.php(95): require('D:\web\ehovel\s...')
#7 {main} in D:\web\ehovel\source\system\classes\route.php:3
2013-07-18 07:25:53 --- CRITICAL: ErrorException [ 2048 ]: Declaration of Route::url() should be compatible with that of Kohana_Route::url() ~ SYSPATH\classes\route.php [ 3 ] in D:\web\ehovel\source\system\classes\route.php:3
2013-07-18 07:25:53 --- DEBUG: #0 D:\web\ehovel\source\system\classes\route.php(3): Kohana_Core::error_handler(2048, 'Declaration of ...', 'D:\web\ehovel\s...', 3, Array)
#1 D:\web\ehovel\source\system\classes\kohana\core.php(511): require('D:\web\ehovel\s...')
#2 [internal function]: Kohana_Core::auto_load('Route')
#3 D:\web\ehovel\source\modules\cms\init.php(3): spl_autoload_call('Route')
#4 D:\web\ehovel\source\system\classes\kohana\core.php(602): require_once('D:\web\ehovel\s...')
#5 D:\web\ehovel\source\admin\bootstrap.php(122): Kohana_Core::modules(Array)
#6 D:\web\ehovel\source\admin.php(95): require('D:\web\ehovel\s...')
#7 {main} in D:\web\ehovel\source\system\classes\route.php:3
2013-07-18 20:26:32 --- CRITICAL: ErrorException [ 8 ]: Use of undefined constant LANGUAGE_ACCESSOR - assumed 'LANGUAGE_ACCESSOR' ~ SYSPATH\classes\route.php [ 18 ] in D:\web\ehovel\source\system\classes\route.php:18
2013-07-18 20:26:32 --- DEBUG: #0 D:\web\ehovel\source\system\classes\route.php(18): Kohana_Core::error_handler(8, 'Use of undefine...', 'D:\web\ehovel\s...', 18, Array)
#1 D:\web\ehovel\source\admin\classes\helper\menu.php(55): Route::url('cms_content/ind...')
#2 D:\web\ehovel\source\admin\classes\helper\menu.php(61): Helper_Menu::generate_menu(Array, 1)
#3 D:\web\ehovel\source\admin\views\header.php(35): Helper_Menu::generate_menu()
#4 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#5 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#6 D:\web\ehovel\source\system\classes\view.php(96): Kohana_View->render(NULL)
#7 D:\web\ehovel\source\admin\classes\controller\admin\base.php(75): View->render(NULL, false)
#8 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(121): Controller_Admin_Base->after()
#9 D:\web\ehovel\source\system\classes\kohana\controller.php(87): Controller_Admin_Cms_Content->after()
#10 [internal function]: Kohana_Controller->execute()
#11 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#12 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#13 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#14 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#15 {main} in D:\web\ehovel\source\system\classes\route.php:18
2013-07-18 20:26:33 --- CRITICAL: ErrorException [ 8 ]: Use of undefined constant LANGUAGE_ACCESSOR - assumed 'LANGUAGE_ACCESSOR' ~ SYSPATH\classes\route.php [ 18 ] in D:\web\ehovel\source\system\classes\route.php:18
2013-07-18 20:26:33 --- DEBUG: #0 D:\web\ehovel\source\system\classes\route.php(18): Kohana_Core::error_handler(8, 'Use of undefine...', 'D:\web\ehovel\s...', 18, Array)
#1 D:\web\ehovel\source\admin\classes\helper\menu.php(55): Route::url('cms_content/ind...')
#2 D:\web\ehovel\source\admin\classes\helper\menu.php(61): Helper_Menu::generate_menu(Array, 1)
#3 D:\web\ehovel\source\admin\views\header.php(35): Helper_Menu::generate_menu()
#4 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#5 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#6 D:\web\ehovel\source\system\classes\view.php(96): Kohana_View->render(NULL)
#7 D:\web\ehovel\source\admin\classes\controller\admin\base.php(75): View->render(NULL, false)
#8 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(121): Controller_Admin_Base->after()
#9 D:\web\ehovel\source\system\classes\kohana\controller.php(87): Controller_Admin_Cms_Content->after()
#10 [internal function]: Kohana_Controller->execute()
#11 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#12 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#13 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#14 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#15 {main} in D:\web\ehovel\source\system\classes\route.php:18
2013-07-18 20:26:40 --- CRITICAL: ErrorException [ 8 ]: Use of undefined constant LANGUAGE_ACCESSOR - assumed 'LANGUAGE_ACCESSOR' ~ SYSPATH\classes\route.php [ 29 ] in D:\web\ehovel\source\system\classes\route.php:29
2013-07-18 20:26:40 --- DEBUG: #0 D:\web\ehovel\source\system\classes\route.php(29): Kohana_Core::error_handler(8, 'Use of undefine...', 'D:\web\ehovel\s...', 29, Array)
#1 D:\web\ehovel\source\admin\classes\helper\menu.php(55): Route::url('cms_content/ind...')
#2 D:\web\ehovel\source\admin\classes\helper\menu.php(61): Helper_Menu::generate_menu(Array, 1)
#3 D:\web\ehovel\source\admin\views\header.php(35): Helper_Menu::generate_menu()
#4 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#5 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#6 D:\web\ehovel\source\system\classes\view.php(96): Kohana_View->render(NULL)
#7 D:\web\ehovel\source\admin\classes\controller\admin\base.php(75): View->render(NULL, false)
#8 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(121): Controller_Admin_Base->after()
#9 D:\web\ehovel\source\system\classes\kohana\controller.php(87): Controller_Admin_Cms_Content->after()
#10 [internal function]: Kohana_Controller->execute()
#11 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#12 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#13 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#14 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#15 {main} in D:\web\ehovel\source\system\classes\route.php:29
2013-07-18 20:27:07 --- CRITICAL: ErrorException [ 8 ]: Use of undefined constant explode - assumed 'explode' ~ SYSPATH\classes\route.php [ 33 ] in D:\web\ehovel\source\system\classes\route.php:33
2013-07-18 20:27:07 --- DEBUG: #0 D:\web\ehovel\source\system\classes\route.php(33): Kohana_Core::error_handler(8, 'Use of undefine...', 'D:\web\ehovel\s...', 33, Array)
#1 D:\web\ehovel\source\admin\classes\helper\menu.php(55): Route::url('cms_content/ind...')
#2 D:\web\ehovel\source\admin\classes\helper\menu.php(61): Helper_Menu::generate_menu(Array, 1)
#3 D:\web\ehovel\source\admin\views\header.php(35): Helper_Menu::generate_menu()
#4 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#5 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#6 D:\web\ehovel\source\system\classes\view.php(96): Kohana_View->render(NULL)
#7 D:\web\ehovel\source\admin\classes\controller\admin\base.php(75): View->render(NULL, false)
#8 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(121): Controller_Admin_Base->after()
#9 D:\web\ehovel\source\system\classes\kohana\controller.php(87): Controller_Admin_Cms_Content->after()
#10 [internal function]: Kohana_Controller->execute()
#11 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#12 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#13 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#14 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#15 {main} in D:\web\ehovel\source\system\classes\route.php:33
2013-07-18 20:36:27 --- CRITICAL: ErrorException [ 1 ]: Class 'BES' not found ~ APPPATH\classes\controller\admin\menu.php [ 25 ] in :
2013-07-18 20:36:27 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-07-18 20:36:49 --- CRITICAL: ErrorException [ 1 ]: Class 'BES' not found ~ APPPATH\classes\controller\admin\menu.php [ 25 ] in :
2013-07-18 20:36:49 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-07-18 20:37:01 --- CRITICAL: ErrorException [ 1 ]: Class 'BES' not found ~ APPPATH\classes\model\menu.php [ 42 ] in :
2013-07-18 20:37:01 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-07-18 20:40:00 --- CRITICAL: ErrorException [ 1 ]: Class 'BES' not found ~ APPPATH\classes\model\menu.php [ 42 ] in :
2013-07-18 20:40:00 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-07-18 20:40:01 --- CRITICAL: ErrorException [ 1 ]: Class 'BES' not found ~ APPPATH\classes\model\menu.php [ 42 ] in :
2013-07-18 20:40:01 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-07-18 20:40:01 --- CRITICAL: ErrorException [ 1 ]: Class 'BES' not found ~ APPPATH\classes\model\menu.php [ 42 ] in :
2013-07-18 20:40:01 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-07-18 20:40:01 --- CRITICAL: ErrorException [ 1 ]: Class 'BES' not found ~ APPPATH\classes\model\menu.php [ 42 ] in :
2013-07-18 20:40:01 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-07-18 20:40:02 --- CRITICAL: ErrorException [ 1 ]: Class 'BES' not found ~ APPPATH\classes\model\menu.php [ 42 ] in :
2013-07-18 20:40:02 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-07-18 20:40:02 --- CRITICAL: ErrorException [ 1 ]: Class 'BES' not found ~ APPPATH\classes\model\menu.php [ 42 ] in :
2013-07-18 20:40:02 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-07-18 20:40:02 --- CRITICAL: ErrorException [ 1 ]: Class 'BES' not found ~ APPPATH\classes\model\menu.php [ 42 ] in :
2013-07-18 20:40:02 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-07-18 20:40:02 --- CRITICAL: ErrorException [ 1 ]: Class 'BES' not found ~ APPPATH\classes\model\menu.php [ 42 ] in :
2013-07-18 20:40:02 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-07-18 20:40:03 --- CRITICAL: ErrorException [ 1 ]: Class 'BES' not found ~ APPPATH\classes\model\menu.php [ 42 ] in :
2013-07-18 20:40:03 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-07-18 20:40:03 --- CRITICAL: ErrorException [ 1 ]: Class 'BES' not found ~ APPPATH\classes\model\menu.php [ 42 ] in :
2013-07-18 20:40:03 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-07-18 20:40:03 --- CRITICAL: ErrorException [ 1 ]: Class 'BES' not found ~ APPPATH\classes\model\menu.php [ 42 ] in :
2013-07-18 20:40:03 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-07-18 20:40:38 --- CRITICAL: ErrorException [ 1 ]: Class 'BES' not found ~ APPPATH\views\menu\index.php [ 2 ] in :
2013-07-18 20:40:38 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-07-18 20:40:53 --- CRITICAL: ErrorException [ 8 ]: Use of undefined constant STATICS_BASE_URL - assumed 'STATICS_BASE_URL' ~ APPPATH\views\menu\index.php [ 14 ] in D:\web\ehovel\source\admin\views\menu\index.php:14
2013-07-18 20:40:53 --- DEBUG: #0 D:\web\ehovel\source\admin\views\menu\index.php(14): Kohana_Core::error_handler(8, 'Use of undefine...', 'D:\web\ehovel\s...', 14, Array)
#1 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#2 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#3 D:\web\ehovel\source\system\classes\view.php(92): Kohana_View->render(NULL)
#4 D:\web\ehovel\source\system\classes\kohana\view.php(228): View->render()
#5 D:\web\ehovel\source\admin\classes\controller\admin\base.php(84): Kohana_View->__toString()
#6 D:\web\ehovel\source\system\classes\kohana\controller.php(87): Controller_Admin_Base->after()
#7 [internal function]: Kohana_Controller->execute()
#8 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Menu))
#9 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#10 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#11 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#12 {main} in D:\web\ehovel\source\admin\views\menu\index.php:14
2013-07-18 20:42:19 --- CRITICAL: ErrorException [ 8 ]: Undefined variable: language ~ APPPATH\views\menu\index.php [ 14 ] in D:\web\ehovel\source\admin\views\menu\index.php:14
2013-07-18 20:42:19 --- DEBUG: #0 D:\web\ehovel\source\admin\views\menu\index.php(14): Kohana_Core::error_handler(8, 'Undefined varia...', 'D:\web\ehovel\s...', 14, Array)
#1 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#2 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#3 D:\web\ehovel\source\system\classes\view.php(92): Kohana_View->render(NULL)
#4 D:\web\ehovel\source\system\classes\kohana\view.php(228): View->render()
#5 D:\web\ehovel\source\admin\classes\controller\admin\base.php(84): Kohana_View->__toString()
#6 D:\web\ehovel\source\system\classes\kohana\controller.php(87): Controller_Admin_Base->after()
#7 [internal function]: Kohana_Controller->execute()
#8 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Menu))
#9 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#10 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#11 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#12 {main} in D:\web\ehovel\source\admin\views\menu\index.php:14
2013-07-18 20:42:27 --- CRITICAL: ErrorException [ 8 ]: Undefined variable: language ~ APPPATH\views\menu\index.php [ 14 ] in D:\web\ehovel\source\admin\views\menu\index.php:14
2013-07-18 20:42:27 --- DEBUG: #0 D:\web\ehovel\source\admin\views\menu\index.php(14): Kohana_Core::error_handler(8, 'Undefined varia...', 'D:\web\ehovel\s...', 14, Array)
#1 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#2 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#3 D:\web\ehovel\source\system\classes\view.php(92): Kohana_View->render(NULL)
#4 D:\web\ehovel\source\system\classes\kohana\view.php(228): View->render()
#5 D:\web\ehovel\source\admin\classes\controller\admin\base.php(84): Kohana_View->__toString()
#6 D:\web\ehovel\source\system\classes\kohana\controller.php(87): Controller_Admin_Base->after()
#7 [internal function]: Kohana_Controller->execute()
#8 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Menu))
#9 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#10 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#11 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#12 {main} in D:\web\ehovel\source\admin\views\menu\index.php:14
2013-07-18 20:43:21 --- CRITICAL: ErrorException [ 1 ]: Class 'remind' not found ~ APPPATH\views\menu\index.php [ 29 ] in :
2013-07-18 20:43:21 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-07-18 20:43:51 --- CRITICAL: ErrorException [ 1 ]: Call to undefined method HTML::add_anchor() ~ APPPATH\views\menu\index.php [ 36 ] in :
2013-07-18 20:43:51 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-07-18 20:46:35 --- CRITICAL: ErrorException [ 1 ]: Call to undefined method HTML::edit_anchor() ~ APPPATH\classes\helper\menu.php [ 98 ] in :
2013-07-18 20:46:35 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-07-18 20:47:35 --- CRITICAL: ErrorException [ 1 ]: Call to undefined method HTML::edit_anchor() ~ APPPATH\classes\helper\menu.php [ 98 ] in :
2013-07-18 20:47:35 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-07-18 20:47:58 --- CRITICAL: ErrorException [ 1 ]: Call to undefined method HTML::edit_anchor() ~ APPPATH\classes\helper\menu.php [ 98 ] in :
2013-07-18 20:47:58 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-07-18 20:48:06 --- CRITICAL: ErrorException [ 1 ]: Class 'BES' not found ~ APPPATH\classes\helper\menu.php [ 98 ] in :
2013-07-18 20:48:06 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-07-18 20:48:21 --- CRITICAL: ErrorException [ 8 ]: Undefined index: name_en ~ APPPATH\classes\helper\menu.php [ 101 ] in D:\web\ehovel\source\admin\classes\helper\menu.php:101
2013-07-18 20:48:21 --- DEBUG: #0 D:\web\ehovel\source\admin\classes\helper\menu.php(101): Kohana_Core::error_handler(8, 'Undefined index...', 'D:\web\ehovel\s...', 101, Array)
#1 D:\web\ehovel\source\admin\views\menu\index.php(56): Helper_Menu::generate_menu_list(Array)
#2 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#3 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#4 D:\web\ehovel\source\system\classes\view.php(92): Kohana_View->render(NULL)
#5 D:\web\ehovel\source\system\classes\kohana\view.php(228): View->render()
#6 D:\web\ehovel\source\admin\classes\controller\admin\base.php(84): Kohana_View->__toString()
#7 D:\web\ehovel\source\system\classes\kohana\controller.php(87): Controller_Admin_Base->after()
#8 [internal function]: Kohana_Controller->execute()
#9 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Menu))
#10 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#11 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#12 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#13 {main} in D:\web\ehovel\source\admin\classes\helper\menu.php:101
2013-07-18 20:51:32 --- CRITICAL: ErrorException [ 1 ]: Class 'BES' not found ~ APPPATH\classes\helper\menu.php [ 98 ] in :
2013-07-18 20:51:32 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-07-18 20:57:25 --- CRITICAL: ErrorException [ 1 ]: Class 'Remind' not found ~ APPPATH\classes\controller\admin\menu.php [ 90 ] in :
2013-07-18 20:57:25 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-07-18 20:58:34 --- CRITICAL: ErrorException [ 1 ]: Class 'Model_Admin_auth' not found ~ MODPATH\orm\classes\orm.php [ 70 ] in :
2013-07-18 20:58:34 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-07-18 21:01:14 --- CRITICAL: ErrorException [ 1 ]: Class 'Model_Admin_auth' not found ~ MODPATH\orm\classes\orm.php [ 70 ] in :
2013-07-18 21:01:14 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-07-18 21:01:15 --- CRITICAL: ErrorException [ 1 ]: Class 'Model_Admin_auth' not found ~ MODPATH\orm\classes\orm.php [ 70 ] in :
2013-07-18 21:01:15 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-07-18 21:01:26 --- CRITICAL: ErrorException [ 1 ]: Class 'Model_Admin_auth' not found ~ MODPATH\orm\classes\orm.php [ 70 ] in :
2013-07-18 21:01:26 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-07-18 21:02:12 --- CRITICAL: ErrorException [ 1 ]: Class 'Tool' not found ~ MODPATH\auth\classes\model\auth\admin.php [ 58 ] in :
2013-07-18 21:02:12 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-07-18 21:02:51 --- CRITICAL: ErrorException [ 1 ]: Class 'Tool' not found ~ MODPATH\auth\classes\model\auth\admin.php [ 58 ] in :
2013-07-18 21:02:51 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-07-18 21:02:52 --- CRITICAL: ErrorException [ 1 ]: Class 'Tool' not found ~ MODPATH\auth\classes\model\auth\admin.php [ 58 ] in :
2013-07-18 21:02:52 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-07-18 21:03:43 --- CRITICAL: ErrorException [ 8 ]: Trying to get property of non-object ~ MODPATH\auth\classes\helper\auth.php [ 140 ] in D:\web\ehovel\source\modules\auth\classes\helper\auth.php:140
2013-07-18 21:03:43 --- DEBUG: #0 D:\web\ehovel\source\modules\auth\classes\helper\auth.php(140): Kohana_Core::error_handler(8, 'Trying to get p...', 'D:\web\ehovel\s...', 140, Array)
#1 D:\web\ehovel\source\admin\classes\controller\admin\menu.php(124): Helper_Auth::get_current()
#2 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Menu->action_edit()
#3 [internal function]: Kohana_Controller->execute()
#4 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Menu))
#5 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#7 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#8 {main} in D:\web\ehovel\source\modules\auth\classes\helper\auth.php:140
2013-07-18 21:10:13 --- CRITICAL: ErrorException [ 1 ]: Class 'BES' not found ~ APPPATH\views\menu\edit.php [ 2 ] in :
2013-07-18 21:10:13 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-07-18 21:10:31 --- CRITICAL: ErrorException [ 1 ]: Class 'remind' not found ~ APPPATH\views\menu\edit.php [ 28 ] in :
2013-07-18 21:10:31 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-07-18 21:10:39 --- CRITICAL: Kohana_Exception [ 0 ]: The name_en property does not exist in the Model_Menu class ~ MODPATH\orm\classes\kohana\orm.php [ 684 ] in D:\web\ehovel\source\modules\orm\classes\kohana\orm.php:600
2013-07-18 21:10:39 --- DEBUG: #0 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(600): Kohana_ORM->get('name_en')
#1 D:\web\ehovel\source\modules\orm\classes\orm.php(207): Kohana_ORM->__get('name_en')
#2 D:\web\ehovel\source\admin\views\menu\edit.php(38): ORM->__get('name_en')
#3 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#4 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#5 D:\web\ehovel\source\system\classes\view.php(92): Kohana_View->render(NULL)
#6 D:\web\ehovel\source\system\classes\kohana\view.php(228): View->render()
#7 D:\web\ehovel\source\admin\classes\controller\admin\base.php(84): Kohana_View->__toString()
#8 D:\web\ehovel\source\system\classes\kohana\controller.php(87): Controller_Admin_Base->after()
#9 [internal function]: Kohana_Controller->execute()
#10 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Menu))
#11 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#12 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#13 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#14 {main} in D:\web\ehovel\source\modules\orm\classes\kohana\orm.php:600
2013-07-18 21:17:07 --- CRITICAL: ErrorException [ 2 ]: stripos() expects at least 2 parameters, 1 given ~ MODPATH\ehovel\classes\ehovel.php [ 117 ] in :
2013-07-18 21:17:07 --- DEBUG: #0 [internal function]: Kohana_Core::error_handler(2, 'stripos() expec...', 'D:\web\ehovel\s...', 117, Array)
#1 D:\web\ehovel\source\modules\ehovel\classes\ehovel.php(117): stripos('cms_content')
#2 D:\web\ehovel\source\admin\classes\helper\menu.php(55): EHOVEL::url('cms_content/ind...')
#3 D:\web\ehovel\source\admin\classes\helper\menu.php(61): Helper_Menu::generate_menu(Array, 1)
#4 D:\web\ehovel\source\admin\views\header.php(35): Helper_Menu::generate_menu()
#5 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#6 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#7 D:\web\ehovel\source\system\classes\view.php(96): Kohana_View->render(NULL)
#8 D:\web\ehovel\source\admin\classes\controller\admin\base.php(75): View->render(NULL, false)
#9 D:\web\ehovel\source\system\classes\kohana\controller.php(87): Controller_Admin_Base->after()
#10 [internal function]: Kohana_Controller->execute()
#11 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Menu))
#12 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#13 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#14 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#15 {main} in :