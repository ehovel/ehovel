<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2013-04-09 09:32:25 --- CRITICAL: Database_Exception [ 1054 ]: Unknown column 'COUNT(1) AS mycount' in 'field list' [ SELECT `attach_id`, `COUNT(1) AS mycount` FROM `resources` WHERE `site_id` = '0' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ] in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-04-09 09:32:25 --- DEBUG: #0 D:\web\ehovel\source\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'SELECT `attach_...', false, Array)
#1 D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php(99): Kohana_Database_Query->execute()
#2 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Resource->action_ueimagemanage()
#3 [internal function]: Kohana_Controller->execute()
#4 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#5 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#7 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#8 {main} in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-04-09 09:33:30 --- CRITICAL: Database_Exception [ 1054 ]: Unknown column 'COUNT(1) AS mycount' in 'field list' [ SELECT `COUNT(1) AS mycount` FROM `resources` WHERE `site_id` = '0' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ] in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-04-09 09:33:30 --- DEBUG: #0 D:\web\ehovel\source\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'SELECT `COUNT(1...', false, Array)
#1 D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php(99): Kohana_Database_Query->execute()
#2 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Resource->action_ueimagemanage()
#3 [internal function]: Kohana_Controller->execute()
#4 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#5 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#7 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#8 {main} in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-04-09 09:44:58 --- CRITICAL: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ') AS mycount FROM `resources` WHERE `site_id` = '0'' at line 1 [ SELECT COUNT(*)) AS mycount FROM `resources` WHERE `site_id` = '0' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ] in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-04-09 09:44:58 --- DEBUG: #0 D:\web\ehovel\source\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'SELECT COUNT(*)...', false, Array)
#1 D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php(99): Kohana_Database_Query->execute()
#2 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Resource->action_ueimagemanage()
#3 [internal function]: Kohana_Controller->execute()
#4 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#5 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#7 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#8 {main} in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-04-09 10:41:18 --- CRITICAL: ErrorException [ 4 ]: syntax error, unexpected '}', expecting T_VARIABLE or '$' ~ MODPATH\resource\classes\controller\admin\resource.php [ 114 ] in :
2013-04-09 10:41:18 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-04-09 10:42:16 --- CRITICAL: Database_Exception [ 1054 ]: Unknown column 'attach_id,postfix' in 'field list' [ SELECT `attach_id,postfix`, COUNT(1) AS mycount FROM `resources` WHERE `site_id` = '62' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ] in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-04-09 10:42:16 --- DEBUG: #0 D:\web\ehovel\source\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'SELECT `attach_...', false, Array)
#1 D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php(99): Kohana_Database_Query->execute()
#2 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Resource->action_ueimagemanage()
#3 [internal function]: Kohana_Controller->execute()
#4 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#5 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#7 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#8 {main} in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251