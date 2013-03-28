<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2013-03-28 01:15:49 --- CRITICAL: ErrorException [ 4096 ]: Argument 1 passed to Controller_Admin_Base::__construct() must be an instance of Request, none given, called in D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php on line 15 and defined ~ APPPATH\classes\controller\admin\base.php [ 49 ] in D:\web\ehovel\source\admin\classes\controller\admin\base.php:49
2013-03-28 01:15:49 --- DEBUG: #0 D:\web\ehovel\source\admin\classes\controller\admin\base.php(49): Kohana_Core::error_handler(4096, 'Argument 1 pass...', 'D:\web\ehovel\s...', 49, Array)
#1 D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php(15): Controller_Admin_Base->__construct()
#2 [internal function]: Controller_Admin_Resource->__construct(Object(Request), Object(Response))
#3 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(94): ReflectionClass->newInstance(Object(Request), Object(Response))
#4 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#6 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#7 {main} in D:\web\ehovel\source\admin\classes\controller\admin\base.php:49
2013-03-28 01:19:53 --- CRITICAL: ErrorException [ 1 ]: Class 'Model_Resource' not found ~ MODPATH\orm\classes\orm.php [ 70 ] in :
2013-03-28 01:19:53 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-28 01:20:08 --- CRITICAL: ErrorException [ 1 ]: Class 'Model_Resource' not found ~ MODPATH\orm\classes\orm.php [ 70 ] in :
2013-03-28 01:20:08 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-28 01:20:16 --- CRITICAL: ErrorException [ 1 ]: Class 'Model_Resource' not found ~ MODPATH\orm\classes\orm.php [ 70 ] in :
2013-03-28 01:20:16 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-28 01:20:29 --- CRITICAL: ErrorException [ 1 ]: Call to undefined method Kohana::config() ~ MODPATH\pagination\classes\kohana\pagination.php [ 92 ] in :
2013-03-28 01:20:29 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-28 04:07:23 --- CRITICAL: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'OFFSET 0' at line 1 [ SELECT `resource`.`id` AS `id`, `resource`.`site_id` AS `site_id`, `resource`.`catalog_id` AS `catalog_id`, `resource`.`manager_id` AS `manager_id`, `resource`.`name` AS `name`, `resource`.`postfix` AS `postfix`, `resource`.`byte` AS `byte`, `resource`.`is_storage` AS `is_storage`, `resource`.`attach_id` AS `attach_id`, `resource`.`link` AS `link`, `resource`.`title` AS `title`, `resource`.`alter` AS `alter`, `resource`.`introduction` AS `introduction`, `resource`.`description` AS `description`, `resource`.`used_num` AS `used_num`, `resource`.`date_add` AS `date_add`, `resource`.`date_upd` AS `date_upd`, `resource`.`old_id` AS `old_id` FROM `resources` AS `resource` OFFSET 0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ] in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-03-28 04:07:23 --- DEBUG: #0 D:\web\ehovel\source\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'SELECT `resourc...', 'Model_Resource', Array)
#1 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1060): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1001): Kohana_ORM->_load_result(true)
#3 D:\web\ehovel\source\modules\orm\classes\orm.php(157): Kohana_ORM->find_all()
#4 D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php(33): ORM->find_all()
#5 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Resource->action_index()
#6 [internal function]: Kohana_Controller->execute()
#7 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#8 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#9 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#10 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#11 {main} in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-03-28 04:10:03 --- CRITICAL: ErrorException [ 1 ]: Class 'role' not found ~ MODPATH\resource\views\resource_list.php [ 12 ] in :
2013-03-28 04:10:03 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-28 04:10:40 --- CRITICAL: ErrorException [ 8 ]: Undefined variable: probability ~ MODPATH\resource\views\resource_list.php [ 41 ] in D:\web\ehovel\source\modules\resource\views\resource_list.php:41
2013-03-28 04:10:40 --- DEBUG: #0 D:\web\ehovel\source\modules\resource\views\resource_list.php(41): Kohana_Core::error_handler(8, 'Undefined varia...', 'D:\web\ehovel\s...', 41, Array)
#1 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#2 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#3 D:\web\ehovel\source\system\classes\view.php(92): Kohana_View->render(NULL)
#4 D:\web\ehovel\source\system\classes\kohana\view.php(228): View->render()
#5 D:\web\ehovel\source\admin\classes\controller\admin\base.php(80): Kohana_View->__toString()
#6 D:\web\ehovel\source\system\classes\kohana\controller.php(87): Controller_Admin_Base->after()
#7 [internal function]: Kohana_Controller->execute()
#8 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#9 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#10 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#11 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#12 {main} in D:\web\ehovel\source\modules\resource\views\resource_list.php:41
2013-03-28 04:11:01 --- CRITICAL: ErrorException [ 1 ]: Class 'tree' not found ~ MODPATH\resource\views\resource_list.php [ 60 ] in :
2013-03-28 04:11:01 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-28 04:11:50 --- CRITICAL: ErrorException [ 1 ]: Class 'role' not found ~ MODPATH\resource\views\resource_list.php [ 131 ] in :
2013-03-28 04:11:50 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-28 04:12:01 --- CRITICAL: ErrorException [ 8 ]: Undefined variable: orderby ~ MODPATH\resource\views\resource_list.php [ 155 ] in D:\web\ehovel\source\modules\resource\views\resource_list.php:155
2013-03-28 04:12:01 --- DEBUG: #0 D:\web\ehovel\source\modules\resource\views\resource_list.php(155): Kohana_Core::error_handler(8, 'Undefined varia...', 'D:\web\ehovel\s...', 155, Array)
#1 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#2 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#3 D:\web\ehovel\source\system\classes\view.php(92): Kohana_View->render(NULL)
#4 D:\web\ehovel\source\system\classes\kohana\view.php(228): View->render()
#5 D:\web\ehovel\source\admin\classes\controller\admin\base.php(80): Kohana_View->__toString()
#6 D:\web\ehovel\source\system\classes\kohana\controller.php(87): Controller_Admin_Base->after()
#7 [internal function]: Kohana_Controller->execute()
#8 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#9 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#10 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#11 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#12 {main} in D:\web\ehovel\source\modules\resource\views\resource_list.php:155
2013-03-28 04:13:14 --- CRITICAL: ErrorException [ 8 ]: Undefined variable: search_value ~ MODPATH\resource\views\resource_list.php [ 166 ] in D:\web\ehovel\source\modules\resource\views\resource_list.php:166
2013-03-28 04:13:14 --- DEBUG: #0 D:\web\ehovel\source\modules\resource\views\resource_list.php(166): Kohana_Core::error_handler(8, 'Undefined varia...', 'D:\web\ehovel\s...', 166, Array)
#1 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#2 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#3 D:\web\ehovel\source\system\classes\view.php(92): Kohana_View->render(NULL)
#4 D:\web\ehovel\source\system\classes\kohana\view.php(228): View->render()
#5 D:\web\ehovel\source\admin\classes\controller\admin\base.php(80): Kohana_View->__toString()
#6 D:\web\ehovel\source\system\classes\kohana\controller.php(87): Controller_Admin_Base->after()
#7 [internal function]: Kohana_Controller->execute()
#8 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#9 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#10 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#11 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#12 {main} in D:\web\ehovel\source\modules\resource\views\resource_list.php:166
2013-03-28 04:13:57 --- CRITICAL: ErrorException [ 1 ]: Class 'resource' not found ~ MODPATH\resource\views\resource_list.php [ 199 ] in :
2013-03-28 04:13:57 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-28 04:16:54 --- CRITICAL: ErrorException [ 1 ]: Class 'resource' not found ~ MODPATH\resource\views\resource_list.php [ 199 ] in :
2013-03-28 04:16:54 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-28 04:17:08 --- CRITICAL: ErrorException [ 1 ]: Class 'Helper_resource' not found ~ MODPATH\resource\views\resource_list.php [ 199 ] in :
2013-03-28 04:17:08 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-28 04:17:26 --- CRITICAL: ErrorException [ 1 ]: Class 'Helper_Resource' not found ~ MODPATH\resource\views\resource_list.php [ 199 ] in :
2013-03-28 04:17:26 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-28 04:17:35 --- CRITICAL: ErrorException [ 1 ]: Call to undefined function bm() ~ MODPATH\resource\classes\helper\resource.php [ 86 ] in :
2013-03-28 04:17:35 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-28 04:18:32 --- CRITICAL: ErrorException [ 8 ]: Undefined variable: params ~ MODPATH\resource\views\resource_list.php [ 448 ] in D:\web\ehovel\source\modules\resource\views\resource_list.php:448
2013-03-28 04:18:32 --- DEBUG: #0 D:\web\ehovel\source\modules\resource\views\resource_list.php(448): Kohana_Core::error_handler(8, 'Undefined varia...', 'D:\web\ehovel\s...', 448, Array)
#1 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#2 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#3 D:\web\ehovel\source\system\classes\view.php(92): Kohana_View->render(NULL)
#4 D:\web\ehovel\source\system\classes\kohana\view.php(228): View->render()
#5 D:\web\ehovel\source\admin\classes\controller\admin\base.php(80): Kohana_View->__toString()
#6 D:\web\ehovel\source\system\classes\kohana\controller.php(87): Controller_Admin_Base->after()
#7 [internal function]: Kohana_Controller->execute()
#8 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#9 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#10 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#11 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#12 {main} in D:\web\ehovel\source\modules\resource\views\resource_list.php:448
2013-03-28 04:59:18 --- CRITICAL: ErrorException [ 1 ]: Class 'per_page' not found ~ MODPATH\resource\views\resource_list.php [ 77 ] in :
2013-03-28 04:59:18 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-28 04:59:31 --- CRITICAL: ErrorException [ 1 ]: Using $this when not in object context ~ MODPATH\resource\views\resource_list.php [ 77 ] in :
2013-03-28 04:59:31 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-28 04:59:56 --- CRITICAL: View_Exception [ 0 ]: The requested view bizark could not be found ~ SYSPATH\classes\kohana\view.php [ 257 ] in D:\web\ehovel\source\system\classes\view.php:125
2013-03-28 04:59:56 --- DEBUG: #0 D:\web\ehovel\source\system\classes\view.php(125): Kohana_View->set_filename('bizark')
#1 D:\web\ehovel\source\system\classes\kohana\view.php(137): View->set_filename('bizark')
#2 D:\web\ehovel\source\system\classes\kohana\view.php(30): Kohana_View->__construct('bizark', NULL)
#3 D:\web\ehovel\source\modules\pagination\classes\Kohana\Pagination.php(274): Kohana_View::factory('bizark')
#4 D:\web\ehovel\source\modules\resource\views\resource_list.php(77): Kohana_Pagination->render('bizark')
#5 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#6 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#7 D:\web\ehovel\source\system\classes\view.php(92): Kohana_View->render(NULL)
#8 D:\web\ehovel\source\system\classes\kohana\view.php(228): View->render()
#9 D:\web\ehovel\source\admin\classes\controller\admin\base.php(80): Kohana_View->__toString()
#10 D:\web\ehovel\source\system\classes\kohana\controller.php(87): Controller_Admin_Base->after()
#11 [internal function]: Kohana_Controller->execute()
#12 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#13 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#14 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#15 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#16 {main} in D:\web\ehovel\source\system\classes\view.php:125
2013-03-28 05:08:43 --- CRITICAL: ErrorException [ 4 ]: syntax error, unexpected T_EXIT, expecting T_FUNCTION ~ MODPATH\pagination\classes\Pagination.php [ 3 ] in :
2013-03-28 05:08:43 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-28 05:08:52 --- CRITICAL: ErrorException [ 4 ]: syntax error, unexpected T_EXIT, expecting T_FUNCTION ~ MODPATH\pagination\classes\Kohana\Pagination.php [ 12 ] in :
2013-03-28 05:08:52 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-28 05:10:14 --- CRITICAL: ErrorException [ 8 ]: Undefined variable: first_page ~ APPPATH\views\pagination\basic.php [ 3 ] in D:\web\ehovel\source\admin\views\pagination\basic.php:3
2013-03-28 05:10:14 --- DEBUG: #0 D:\web\ehovel\source\admin\views\pagination\basic.php(3): Kohana_Core::error_handler(8, 'Undefined varia...', 'D:\web\ehovel\s...', 3, Array)
#1 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#2 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#3 D:\web\ehovel\source\system\classes\view.php(92): Kohana_View->render(NULL)
#4 D:\web\ehovel\source\system\classes\kohana\view.php(228): View->render()
#5 D:\web\ehovel\source\modules\pagination\classes\Kohana\Pagination.php(276): Kohana_View->__toString()
#6 D:\web\ehovel\source\modules\resource\views\resource_list.php(77): Kohana_Pagination->render()
#7 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#8 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#9 D:\web\ehovel\source\system\classes\view.php(92): Kohana_View->render(NULL)
#10 D:\web\ehovel\source\system\classes\kohana\view.php(228): View->render()
#11 D:\web\ehovel\source\admin\classes\controller\admin\base.php(80): Kohana_View->__toString()
#12 D:\web\ehovel\source\system\classes\kohana\controller.php(87): Controller_Admin_Base->after()
#13 [internal function]: Kohana_Controller->execute()
#14 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#15 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#16 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#17 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#18 {main} in D:\web\ehovel\source\admin\views\pagination\basic.php:3
2013-03-28 05:10:26 --- CRITICAL: ErrorException [ 8 ]: Undefined variable: first_page ~ APPPATH\views\pagination\basic.php [ 3 ] in D:\web\ehovel\source\admin\views\pagination\basic.php:3
2013-03-28 05:10:26 --- DEBUG: #0 D:\web\ehovel\source\admin\views\pagination\basic.php(3): Kohana_Core::error_handler(8, 'Undefined varia...', 'D:\web\ehovel\s...', 3, Array)
#1 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#2 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#3 D:\web\ehovel\source\system\classes\view.php(92): Kohana_View->render(NULL)
#4 D:\web\ehovel\source\system\classes\kohana\view.php(228): View->render()
#5 D:\web\ehovel\source\modules\pagination\classes\Kohana\Pagination.php(276): Kohana_View->__toString()
#6 D:\web\ehovel\source\modules\resource\views\resource_list.php(77): Kohana_Pagination->render()
#7 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#8 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#9 D:\web\ehovel\source\system\classes\view.php(92): Kohana_View->render(NULL)
#10 D:\web\ehovel\source\system\classes\kohana\view.php(228): View->render()
#11 D:\web\ehovel\source\admin\classes\controller\admin\base.php(80): Kohana_View->__toString()
#12 D:\web\ehovel\source\system\classes\kohana\controller.php(87): Controller_Admin_Base->after()
#13 [internal function]: Kohana_Controller->execute()
#14 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#15 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#16 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#17 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#18 {main} in D:\web\ehovel\source\admin\views\pagination\basic.php:3
2013-03-28 06:06:44 --- CRITICAL: ErrorException [ 1 ]: Class 'resource' not found ~ MODPATH\resource\views\resource_form.php [ 10 ] in :
2013-03-28 06:06:44 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-28 06:07:44 --- CRITICAL: ErrorException [ 1 ]: Class 'resource' not found ~ MODPATH\resource\views\resource_form.php [ 10 ] in :
2013-03-28 06:07:44 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-28 06:08:02 --- CRITICAL: ErrorException [ 8 ]: Undefined variable: relation_tags ~ MODPATH\resource\views\resource_form.php [ 22 ] in D:\web\ehovel\source\modules\resource\views\resource_form.php:22
2013-03-28 06:08:02 --- DEBUG: #0 D:\web\ehovel\source\modules\resource\views\resource_form.php(22): Kohana_Core::error_handler(8, 'Undefined varia...', 'D:\web\ehovel\s...', 22, Array)
#1 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#2 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#3 D:\web\ehovel\source\system\classes\view.php(96): Kohana_View->render(NULL)
#4 D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php(212): View->render(NULL, false)
#5 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Resource->action_edit()
#6 [internal function]: Kohana_Controller->execute()
#7 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#8 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#9 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#10 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#11 {main} in D:\web\ehovel\source\modules\resource\views\resource_form.php:22
2013-03-28 06:08:21 --- CRITICAL: ErrorException [ 8 ]: Undefined variable: relation_tags ~ MODPATH\resource\views\resource_form.php [ 22 ] in D:\web\ehovel\source\modules\resource\views\resource_form.php:22
2013-03-28 06:08:21 --- DEBUG: #0 D:\web\ehovel\source\modules\resource\views\resource_form.php(22): Kohana_Core::error_handler(8, 'Undefined varia...', 'D:\web\ehovel\s...', 22, Array)
#1 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#2 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#3 D:\web\ehovel\source\system\classes\view.php(96): Kohana_View->render(NULL)
#4 D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php(212): View->render(NULL, false)
#5 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Resource->action_edit()
#6 [internal function]: Kohana_Controller->execute()
#7 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#8 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#9 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#10 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#11 {main} in D:\web\ehovel\source\modules\resource\views\resource_form.php:22
2013-03-28 06:08:32 --- CRITICAL: ErrorException [ 8 ]: Undefined variable: catalog_list ~ MODPATH\resource\views\resource_form.php [ 39 ] in D:\web\ehovel\source\modules\resource\views\resource_form.php:39
2013-03-28 06:08:32 --- DEBUG: #0 D:\web\ehovel\source\modules\resource\views\resource_form.php(39): Kohana_Core::error_handler(8, 'Undefined varia...', 'D:\web\ehovel\s...', 39, Array)
#1 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#2 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#3 D:\web\ehovel\source\system\classes\view.php(96): Kohana_View->render(NULL)
#4 D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php(212): View->render(NULL, false)
#5 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Resource->action_edit()
#6 [internal function]: Kohana_Controller->execute()
#7 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#8 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#9 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#10 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#11 {main} in D:\web\ehovel\source\modules\resource\views\resource_form.php:39
2013-03-28 06:57:50 --- CRITICAL: Database_Exception [ 1054 ]: Unknown column 'modified' in 'field list' [ UPDATE `resources` SET `title` = '11111', `modified` = '2013-03-28 06:57:49' WHERE `id` = '3' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ] in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-03-28 06:57:50 --- DEBUG: #0 D:\web\ehovel\source\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(3, 'UPDATE `resourc...', false, Array)
#1 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1391): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1418): Kohana_ORM->update(NULL)
#3 D:\web\ehovel\source\modules\orm\classes\orm.php(247): Kohana_ORM->save(NULL)
#4 D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php(216): ORM->save()
#5 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Resource->action_edit()
#6 [internal function]: Kohana_Controller->execute()
#7 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#8 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#9 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#10 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#11 {main} in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-03-28 06:59:46 --- CRITICAL: ErrorException [ 8 ]: Undefined index: date_upd ~ MODPATH\resource\views\resource_list.php [ 71 ] in D:\web\ehovel\source\modules\resource\views\resource_list.php:71
2013-03-28 06:59:46 --- DEBUG: #0 D:\web\ehovel\source\modules\resource\views\resource_list.php(71): Kohana_Core::error_handler(8, 'Undefined index...', 'D:\web\ehovel\s...', 71, Array)
#1 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#2 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#3 D:\web\ehovel\source\system\classes\view.php(92): Kohana_View->render(NULL)
#4 D:\web\ehovel\source\system\classes\kohana\view.php(228): View->render()
#5 D:\web\ehovel\source\admin\classes\controller\admin\base.php(81): Kohana_View->__toString()
#6 D:\web\ehovel\source\system\classes\kohana\controller.php(87): Controller_Admin_Base->after()
#7 [internal function]: Kohana_Controller->execute()
#8 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#9 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#10 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#11 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#12 {main} in D:\web\ehovel\source\modules\resource\views\resource_list.php:71
2013-03-28 06:59:49 --- CRITICAL: ErrorException [ 8 ]: Undefined index: date_upd ~ MODPATH\resource\views\resource_list.php [ 71 ] in D:\web\ehovel\source\modules\resource\views\resource_list.php:71
2013-03-28 06:59:49 --- DEBUG: #0 D:\web\ehovel\source\modules\resource\views\resource_list.php(71): Kohana_Core::error_handler(8, 'Undefined index...', 'D:\web\ehovel\s...', 71, Array)
#1 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#2 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#3 D:\web\ehovel\source\system\classes\view.php(92): Kohana_View->render(NULL)
#4 D:\web\ehovel\source\system\classes\kohana\view.php(228): View->render()
#5 D:\web\ehovel\source\admin\classes\controller\admin\base.php(81): Kohana_View->__toString()
#6 D:\web\ehovel\source\system\classes\kohana\controller.php(87): Controller_Admin_Base->after()
#7 [internal function]: Kohana_Controller->execute()
#8 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#9 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#10 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#11 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#12 {main} in D:\web\ehovel\source\modules\resource\views\resource_list.php:71
2013-03-28 06:59:51 --- CRITICAL: ErrorException [ 8 ]: Undefined index: date_upd ~ MODPATH\resource\views\resource_list.php [ 71 ] in D:\web\ehovel\source\modules\resource\views\resource_list.php:71
2013-03-28 06:59:51 --- DEBUG: #0 D:\web\ehovel\source\modules\resource\views\resource_list.php(71): Kohana_Core::error_handler(8, 'Undefined index...', 'D:\web\ehovel\s...', 71, Array)
#1 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#2 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#3 D:\web\ehovel\source\system\classes\view.php(92): Kohana_View->render(NULL)
#4 D:\web\ehovel\source\system\classes\kohana\view.php(228): View->render()
#5 D:\web\ehovel\source\admin\classes\controller\admin\base.php(81): Kohana_View->__toString()
#6 D:\web\ehovel\source\system\classes\kohana\controller.php(87): Controller_Admin_Base->after()
#7 [internal function]: Kohana_Controller->execute()
#8 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#9 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#10 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#11 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#12 {main} in D:\web\ehovel\source\modules\resource\views\resource_list.php:71
2013-03-28 07:18:35 --- CRITICAL: ErrorException [ 4096 ]: Object of class Route could not be converted to string ~ MODPATH\pagination\classes\Kohana\Pagination.php [ 96 ] in D:\web\ehovel\source\modules\pagination\classes\Kohana\Pagination.php:96
2013-03-28 07:18:35 --- DEBUG: #0 D:\web\ehovel\source\modules\pagination\classes\Kohana\Pagination.php(96): Kohana_Core::error_handler(4096, 'Object of class...', 'D:\web\ehovel\s...', 96, Array)
#1 D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php(31): Kohana_Pagination->__construct(Array)
#2 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Resource->action_index()
#3 [internal function]: Kohana_Controller->execute()
#4 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#5 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#7 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#8 {main} in D:\web\ehovel\source\modules\pagination\classes\Kohana\Pagination.php:96
2013-03-28 07:18:41 --- CRITICAL: ErrorException [ 4096 ]: Object of class Route could not be converted to string ~ MODPATH\pagination\classes\Kohana\Pagination.php [ 96 ] in D:\web\ehovel\source\modules\pagination\classes\Kohana\Pagination.php:96
2013-03-28 07:18:41 --- DEBUG: #0 D:\web\ehovel\source\modules\pagination\classes\Kohana\Pagination.php(96): Kohana_Core::error_handler(4096, 'Object of class...', 'D:\web\ehovel\s...', 96, Array)
#1 D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php(31): Kohana_Pagination->__construct(Array)
#2 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Resource->action_index()
#3 [internal function]: Kohana_Controller->execute()
#4 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#5 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#7 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#8 {main} in D:\web\ehovel\source\modules\pagination\classes\Kohana\Pagination.php:96
2013-03-28 07:18:49 --- CRITICAL: ErrorException [ 4096 ]: Object of class Route could not be converted to string ~ MODPATH\pagination\classes\Kohana\Pagination.php [ 96 ] in D:\web\ehovel\source\modules\pagination\classes\Kohana\Pagination.php:96
2013-03-28 07:18:49 --- DEBUG: #0 D:\web\ehovel\source\modules\pagination\classes\Kohana\Pagination.php(96): Kohana_Core::error_handler(4096, 'Object of class...', 'D:\web\ehovel\s...', 96, Array)
#1 D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php(31): Kohana_Pagination->__construct(Array)
#2 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Resource->action_index()
#3 [internal function]: Kohana_Controller->execute()
#4 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#5 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#7 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#8 {main} in D:\web\ehovel\source\modules\pagination\classes\Kohana\Pagination.php:96
2013-03-28 07:19:33 --- CRITICAL: ErrorException [ 8 ]: Undefined property: Route::$uri ~ MODPATH\pagination\classes\Kohana\Pagination.php [ 96 ] in D:\web\ehovel\source\modules\pagination\classes\Kohana\Pagination.php:96
2013-03-28 07:19:33 --- DEBUG: #0 D:\web\ehovel\source\modules\pagination\classes\Kohana\Pagination.php(96): Kohana_Core::error_handler(8, 'Undefined prope...', 'D:\web\ehovel\s...', 96, Array)
#1 D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php(31): Kohana_Pagination->__construct(Array)
#2 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Resource->action_index()
#3 [internal function]: Kohana_Controller->execute()
#4 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#5 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#7 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#8 {main} in D:\web\ehovel\source\modules\pagination\classes\Kohana\Pagination.php:96
2013-03-28 07:29:54 --- CRITICAL: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '-12' at line 1 [ SELECT `resource`.`id` AS `id`, `resource`.`site_id` AS `site_id`, `resource`.`catalog_id` AS `catalog_id`, `resource`.`manager_id` AS `manager_id`, `resource`.`name` AS `name`, `resource`.`postfix` AS `postfix`, `resource`.`byte` AS `byte`, `resource`.`is_storage` AS `is_storage`, `resource`.`attach_id` AS `attach_id`, `resource`.`link` AS `link`, `resource`.`title` AS `title`, `resource`.`alter` AS `alter`, `resource`.`introduction` AS `introduction`, `resource`.`description` AS `description`, `resource`.`used_num` AS `used_num`, `resource`.`date_add` AS `date_add`, `resource`.`modified` AS `modified`, `resource`.`old_id` AS `old_id` FROM `resources` AS `resource` LIMIT 12 OFFSET -12 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ] in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-03-28 07:29:54 --- DEBUG: #0 D:\web\ehovel\source\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'SELECT `resourc...', 'Model_Resource', Array)
#1 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1060): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1001): Kohana_ORM->_load_result(true)
#3 D:\web\ehovel\source\modules\orm\classes\orm.php(157): Kohana_ORM->find_all()
#4 D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php(35): ORM->find_all()
#5 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Resource->action_index()
#6 [internal function]: Kohana_Controller->execute()
#7 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#8 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#9 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#10 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#11 {main} in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-03-28 07:30:03 --- CRITICAL: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '-12' at line 1 [ SELECT `resource`.`id` AS `id`, `resource`.`site_id` AS `site_id`, `resource`.`catalog_id` AS `catalog_id`, `resource`.`manager_id` AS `manager_id`, `resource`.`name` AS `name`, `resource`.`postfix` AS `postfix`, `resource`.`byte` AS `byte`, `resource`.`is_storage` AS `is_storage`, `resource`.`attach_id` AS `attach_id`, `resource`.`link` AS `link`, `resource`.`title` AS `title`, `resource`.`alter` AS `alter`, `resource`.`introduction` AS `introduction`, `resource`.`description` AS `description`, `resource`.`used_num` AS `used_num`, `resource`.`date_add` AS `date_add`, `resource`.`modified` AS `modified`, `resource`.`old_id` AS `old_id` FROM `resources` AS `resource` LIMIT 12 OFFSET -12 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ] in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-03-28 07:30:03 --- DEBUG: #0 D:\web\ehovel\source\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'SELECT `resourc...', 'Model_Resource', Array)
#1 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1060): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1001): Kohana_ORM->_load_result(true)
#3 D:\web\ehovel\source\modules\orm\classes\orm.php(157): Kohana_ORM->find_all()
#4 D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php(35): ORM->find_all()
#5 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Resource->action_index()
#6 [internal function]: Kohana_Controller->execute()
#7 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#8 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#9 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#10 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#11 {main} in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-03-28 07:30:04 --- CRITICAL: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '-12' at line 1 [ SELECT `resource`.`id` AS `id`, `resource`.`site_id` AS `site_id`, `resource`.`catalog_id` AS `catalog_id`, `resource`.`manager_id` AS `manager_id`, `resource`.`name` AS `name`, `resource`.`postfix` AS `postfix`, `resource`.`byte` AS `byte`, `resource`.`is_storage` AS `is_storage`, `resource`.`attach_id` AS `attach_id`, `resource`.`link` AS `link`, `resource`.`title` AS `title`, `resource`.`alter` AS `alter`, `resource`.`introduction` AS `introduction`, `resource`.`description` AS `description`, `resource`.`used_num` AS `used_num`, `resource`.`date_add` AS `date_add`, `resource`.`modified` AS `modified`, `resource`.`old_id` AS `old_id` FROM `resources` AS `resource` LIMIT 12 OFFSET -12 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ] in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-03-28 07:30:04 --- DEBUG: #0 D:\web\ehovel\source\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'SELECT `resourc...', 'Model_Resource', Array)
#1 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1060): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1001): Kohana_ORM->_load_result(true)
#3 D:\web\ehovel\source\modules\orm\classes\orm.php(157): Kohana_ORM->find_all()
#4 D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php(35): ORM->find_all()
#5 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Resource->action_index()
#6 [internal function]: Kohana_Controller->execute()
#7 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#8 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#9 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#10 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#11 {main} in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251