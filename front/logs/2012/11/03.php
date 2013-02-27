<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2012-11-03 05:33:22 --- ERROR: ErrorException [ 1 ]: Call to undefined function  mysql_connect() ~ MODPATH\database\classes\kohana\database\mysql.php [ 59 ]
2012-11-03 05:33:22 --- STRACE: ErrorException [ 1 ]: Call to undefined function  mysql_connect() ~ MODPATH\database\classes\kohana\database\mysql.php [ 59 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2012-11-03 05:33:36 --- ERROR: ErrorException [ 1 ]: Call to undefined function  mysql_connect() ~ MODPATH\database\classes\kohana\database\mysql.php [ 59 ]
2012-11-03 05:33:36 --- STRACE: ErrorException [ 1 ]: Call to undefined function  mysql_connect() ~ MODPATH\database\classes\kohana\database\mysql.php [ 59 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2012-11-03 05:33:45 --- ERROR: ErrorException [ 1 ]: Call to undefined function  mysql_connect() ~ MODPATH\database\classes\kohana\database\mysql.php [ 59 ]
2012-11-03 05:33:45 --- STRACE: ErrorException [ 1 ]: Call to undefined function  mysql_connect() ~ MODPATH\database\classes\kohana\database\mysql.php [ 59 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2012-11-03 05:33:45 --- ERROR: ErrorException [ 1 ]: Call to undefined function  mysql_connect() ~ MODPATH\database\classes\kohana\database\mysql.php [ 59 ]
2012-11-03 05:33:45 --- STRACE: ErrorException [ 1 ]: Call to undefined function  mysql_connect() ~ MODPATH\database\classes\kohana\database\mysql.php [ 59 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2012-11-03 05:44:04 --- ERROR: Database_Exception [ 1049 ]: Unknown database 'ehovel' ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
2012-11-03 05:44:04 --- STRACE: Database_Exception [ 1049 ]: Unknown database 'ehovel' ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
--
#0 F:\web\ehovel\source\modules\database\classes\kohana\database\mysql.php(75): Kohana_Database_MySQL->_select_db('ehovel')
#1 F:\web\ehovel\source\modules\database\classes\kohana\database\mysql.php(171): Kohana_Database_MySQL->connect()
#2 F:\web\ehovel\source\modules\database\classes\kohana\database\mysql.php(358): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#3 F:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1538): Kohana_Database_MySQL->list_columns('tests')
#4 F:\web\ehovel\source\modules\orm\classes\kohana\orm.php(392): Kohana_ORM->list_columns()
#5 F:\web\ehovel\source\modules\orm\classes\kohana\orm.php(337): Kohana_ORM->reload_columns()
#6 F:\web\ehovel\source\modules\orm\classes\kohana\orm.php(246): Kohana_ORM->_initialize()
#7 F:\web\ehovel\source\modules\orm\classes\kohana\orm.php(37): Kohana_ORM->__construct(NULL)
#8 F:\web\ehovel\source\front\classes\controller\welcome.php(7): Kohana_ORM::factory('test')
#9 [internal function]: Controller_Welcome->action_index()
#10 F:\web\ehovel\source\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Welcome))
#11 F:\web\ehovel\source\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#12 F:\web\ehovel\source\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#13 F:\web\ehovel\source\index.php(106): Kohana_Request->execute()
#14 {main}
2012-11-03 05:44:49 --- ERROR: Database_Exception [ 1146 ]: Table 'ehovel.tests' doesn't exist [ SHOW FULL COLUMNS FROM `tests` ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2012-11-03 05:44:49 --- STRACE: Database_Exception [ 1146 ]: Table 'ehovel.tests' doesn't exist [ SHOW FULL COLUMNS FROM `tests` ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 F:\web\ehovel\source\modules\database\classes\kohana\database\mysql.php(358): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#1 F:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1538): Kohana_Database_MySQL->list_columns('tests')
#2 F:\web\ehovel\source\modules\orm\classes\kohana\orm.php(392): Kohana_ORM->list_columns()
#3 F:\web\ehovel\source\modules\orm\classes\kohana\orm.php(337): Kohana_ORM->reload_columns()
#4 F:\web\ehovel\source\modules\orm\classes\kohana\orm.php(246): Kohana_ORM->_initialize()
#5 F:\web\ehovel\source\modules\orm\classes\kohana\orm.php(37): Kohana_ORM->__construct(NULL)
#6 F:\web\ehovel\source\front\classes\controller\welcome.php(7): Kohana_ORM::factory('test')
#7 [internal function]: Controller_Welcome->action_index()
#8 F:\web\ehovel\source\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Welcome))
#9 F:\web\ehovel\source\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#10 F:\web\ehovel\source\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#11 F:\web\ehovel\source\index.php(106): Kohana_Request->execute()
#12 {main}
2012-11-03 05:44:50 --- ERROR: Database_Exception [ 1146 ]: Table 'ehovel.tests' doesn't exist [ SHOW FULL COLUMNS FROM `tests` ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2012-11-03 05:44:50 --- STRACE: Database_Exception [ 1146 ]: Table 'ehovel.tests' doesn't exist [ SHOW FULL COLUMNS FROM `tests` ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 F:\web\ehovel\source\modules\database\classes\kohana\database\mysql.php(358): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#1 F:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1538): Kohana_Database_MySQL->list_columns('tests')
#2 F:\web\ehovel\source\modules\orm\classes\kohana\orm.php(392): Kohana_ORM->list_columns()
#3 F:\web\ehovel\source\modules\orm\classes\kohana\orm.php(337): Kohana_ORM->reload_columns()
#4 F:\web\ehovel\source\modules\orm\classes\kohana\orm.php(246): Kohana_ORM->_initialize()
#5 F:\web\ehovel\source\modules\orm\classes\kohana\orm.php(37): Kohana_ORM->__construct(NULL)
#6 F:\web\ehovel\source\front\classes\controller\welcome.php(7): Kohana_ORM::factory('test')
#7 [internal function]: Controller_Welcome->action_index()
#8 F:\web\ehovel\source\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Welcome))
#9 F:\web\ehovel\source\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#10 F:\web\ehovel\source\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#11 F:\web\ehovel\source\index.php(106): Kohana_Request->execute()
#12 {main}
2012-11-03 05:44:51 --- ERROR: Database_Exception [ 1146 ]: Table 'ehovel.tests' doesn't exist [ SHOW FULL COLUMNS FROM `tests` ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2012-11-03 05:44:51 --- STRACE: Database_Exception [ 1146 ]: Table 'ehovel.tests' doesn't exist [ SHOW FULL COLUMNS FROM `tests` ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 F:\web\ehovel\source\modules\database\classes\kohana\database\mysql.php(358): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#1 F:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1538): Kohana_Database_MySQL->list_columns('tests')
#2 F:\web\ehovel\source\modules\orm\classes\kohana\orm.php(392): Kohana_ORM->list_columns()
#3 F:\web\ehovel\source\modules\orm\classes\kohana\orm.php(337): Kohana_ORM->reload_columns()
#4 F:\web\ehovel\source\modules\orm\classes\kohana\orm.php(246): Kohana_ORM->_initialize()
#5 F:\web\ehovel\source\modules\orm\classes\kohana\orm.php(37): Kohana_ORM->__construct(NULL)
#6 F:\web\ehovel\source\front\classes\controller\welcome.php(7): Kohana_ORM::factory('test')
#7 [internal function]: Controller_Welcome->action_index()
#8 F:\web\ehovel\source\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Welcome))
#9 F:\web\ehovel\source\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#10 F:\web\ehovel\source\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#11 F:\web\ehovel\source\index.php(106): Kohana_Request->execute()
#12 {main}
2012-11-03 05:44:51 --- ERROR: Database_Exception [ 1146 ]: Table 'ehovel.tests' doesn't exist [ SHOW FULL COLUMNS FROM `tests` ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2012-11-03 05:44:51 --- STRACE: Database_Exception [ 1146 ]: Table 'ehovel.tests' doesn't exist [ SHOW FULL COLUMNS FROM `tests` ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 F:\web\ehovel\source\modules\database\classes\kohana\database\mysql.php(358): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#1 F:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1538): Kohana_Database_MySQL->list_columns('tests')
#2 F:\web\ehovel\source\modules\orm\classes\kohana\orm.php(392): Kohana_ORM->list_columns()
#3 F:\web\ehovel\source\modules\orm\classes\kohana\orm.php(337): Kohana_ORM->reload_columns()
#4 F:\web\ehovel\source\modules\orm\classes\kohana\orm.php(246): Kohana_ORM->_initialize()
#5 F:\web\ehovel\source\modules\orm\classes\kohana\orm.php(37): Kohana_ORM->__construct(NULL)
#6 F:\web\ehovel\source\front\classes\controller\welcome.php(7): Kohana_ORM::factory('test')
#7 [internal function]: Controller_Welcome->action_index()
#8 F:\web\ehovel\source\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Welcome))
#9 F:\web\ehovel\source\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#10 F:\web\ehovel\source\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#11 F:\web\ehovel\source\index.php(106): Kohana_Request->execute()
#12 {main}
2012-11-03 05:44:52 --- ERROR: Database_Exception [ 1146 ]: Table 'ehovel.tests' doesn't exist [ SHOW FULL COLUMNS FROM `tests` ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2012-11-03 05:44:52 --- STRACE: Database_Exception [ 1146 ]: Table 'ehovel.tests' doesn't exist [ SHOW FULL COLUMNS FROM `tests` ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 F:\web\ehovel\source\modules\database\classes\kohana\database\mysql.php(358): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#1 F:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1538): Kohana_Database_MySQL->list_columns('tests')
#2 F:\web\ehovel\source\modules\orm\classes\kohana\orm.php(392): Kohana_ORM->list_columns()
#3 F:\web\ehovel\source\modules\orm\classes\kohana\orm.php(337): Kohana_ORM->reload_columns()
#4 F:\web\ehovel\source\modules\orm\classes\kohana\orm.php(246): Kohana_ORM->_initialize()
#5 F:\web\ehovel\source\modules\orm\classes\kohana\orm.php(37): Kohana_ORM->__construct(NULL)
#6 F:\web\ehovel\source\front\classes\controller\welcome.php(7): Kohana_ORM::factory('test')
#7 [internal function]: Controller_Welcome->action_index()
#8 F:\web\ehovel\source\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Welcome))
#9 F:\web\ehovel\source\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#10 F:\web\ehovel\source\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#11 F:\web\ehovel\source\index.php(106): Kohana_Request->execute()
#12 {main}
2012-11-03 05:44:52 --- ERROR: Database_Exception [ 1146 ]: Table 'ehovel.tests' doesn't exist [ SHOW FULL COLUMNS FROM `tests` ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2012-11-03 05:44:52 --- STRACE: Database_Exception [ 1146 ]: Table 'ehovel.tests' doesn't exist [ SHOW FULL COLUMNS FROM `tests` ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 F:\web\ehovel\source\modules\database\classes\kohana\database\mysql.php(358): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#1 F:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1538): Kohana_Database_MySQL->list_columns('tests')
#2 F:\web\ehovel\source\modules\orm\classes\kohana\orm.php(392): Kohana_ORM->list_columns()
#3 F:\web\ehovel\source\modules\orm\classes\kohana\orm.php(337): Kohana_ORM->reload_columns()
#4 F:\web\ehovel\source\modules\orm\classes\kohana\orm.php(246): Kohana_ORM->_initialize()
#5 F:\web\ehovel\source\modules\orm\classes\kohana\orm.php(37): Kohana_ORM->__construct(NULL)
#6 F:\web\ehovel\source\front\classes\controller\welcome.php(7): Kohana_ORM::factory('test')
#7 [internal function]: Controller_Welcome->action_index()
#8 F:\web\ehovel\source\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Welcome))
#9 F:\web\ehovel\source\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#10 F:\web\ehovel\source\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#11 F:\web\ehovel\source\index.php(106): Kohana_Request->execute()
#12 {main}
2012-11-03 05:44:53 --- ERROR: Database_Exception [ 1146 ]: Table 'ehovel.tests' doesn't exist [ SHOW FULL COLUMNS FROM `tests` ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2012-11-03 05:44:53 --- STRACE: Database_Exception [ 1146 ]: Table 'ehovel.tests' doesn't exist [ SHOW FULL COLUMNS FROM `tests` ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 F:\web\ehovel\source\modules\database\classes\kohana\database\mysql.php(358): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#1 F:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1538): Kohana_Database_MySQL->list_columns('tests')
#2 F:\web\ehovel\source\modules\orm\classes\kohana\orm.php(392): Kohana_ORM->list_columns()
#3 F:\web\ehovel\source\modules\orm\classes\kohana\orm.php(337): Kohana_ORM->reload_columns()
#4 F:\web\ehovel\source\modules\orm\classes\kohana\orm.php(246): Kohana_ORM->_initialize()
#5 F:\web\ehovel\source\modules\orm\classes\kohana\orm.php(37): Kohana_ORM->__construct(NULL)
#6 F:\web\ehovel\source\front\classes\controller\welcome.php(7): Kohana_ORM::factory('test')
#7 [internal function]: Controller_Welcome->action_index()
#8 F:\web\ehovel\source\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Welcome))
#9 F:\web\ehovel\source\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#10 F:\web\ehovel\source\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#11 F:\web\ehovel\source\index.php(106): Kohana_Request->execute()
#12 {main}
2012-11-03 05:45:54 --- ERROR: ErrorException [ 1 ]: Call to a member function where() on a non-object ~ APPPATH\classes\controller\welcome.php [ 10 ]
2012-11-03 05:45:54 --- STRACE: ErrorException [ 1 ]: Call to a member function where() on a non-object ~ APPPATH\classes\controller\welcome.php [ 10 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2012-11-03 05:45:56 --- ERROR: ErrorException [ 1 ]: Call to a member function where() on a non-object ~ APPPATH\classes\controller\welcome.php [ 10 ]
2012-11-03 05:45:56 --- STRACE: ErrorException [ 1 ]: Call to a member function where() on a non-object ~ APPPATH\classes\controller\welcome.php [ 10 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}