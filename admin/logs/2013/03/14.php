<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2013-03-14 00:52:54 --- CRITICAL: Database_Exception [ 1052 ]: Column 'title' in order clause is ambiguous [ SELECT `id` AS `title`, `content`.`id` AS `id`, `content`.`asset_id` AS `asset_id`, `content`.`title` AS `title`, `content`.`alias` AS `alias`, `content`.`introtext` AS `introtext`, `content`.`fulltext` AS `fulltext`, `content`.`state` AS `state`, `content`.`catid` AS `catid`, `content`.`created` AS `created`, `content`.`created_by` AS `created_by`, `content`.`created_by_alias` AS `created_by_alias`, `content`.`modified` AS `modified`, `content`.`modified_by` AS `modified_by`, `content`.`checked_out` AS `checked_out`, `content`.`checked_out_time` AS `checked_out_time`, `content`.`publish_up` AS `publish_up`, `content`.`publish_down` AS `publish_down`, `content`.`images` AS `images`, `content`.`urls` AS `urls`, `content`.`attribs` AS `attribs`, `content`.`version` AS `version`, `content`.`ordering` AS `ordering`, `content`.`metakey` AS `metakey`, `content`.`metadesc` AS `metadesc`, `content`.`access` AS `access`, `content`.`hits` AS `hits`, `content`.`metadata` AS `metadata`, `content`.`featured` AS `featured`, `content`.`language` AS `language`, `content`.`xreference` AS `xreference` FROM `contents` AS `content` ORDER BY `title` ASC LIMIT 20 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ] in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-03-14 00:52:54 --- DEBUG: #0 D:\web\ehovel\source\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'SELECT `id` AS ...', 'Model_Content', Array)
#1 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1060): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1001): Kohana_ORM->_load_result(true)
#3 D:\web\ehovel\source\admin\classes\grid.php(137): Kohana_ORM->find_all()
#4 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(15): Grid->to_array()
#5 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Cms_Content->action_index()
#6 [internal function]: Kohana_Controller->execute()
#7 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#8 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#9 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#10 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#11 {main} in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-03-14 00:52:55 --- CRITICAL: Database_Exception [ 1052 ]: Column 'title' in order clause is ambiguous [ SELECT `id` AS `title`, `content`.`id` AS `id`, `content`.`asset_id` AS `asset_id`, `content`.`title` AS `title`, `content`.`alias` AS `alias`, `content`.`introtext` AS `introtext`, `content`.`fulltext` AS `fulltext`, `content`.`state` AS `state`, `content`.`catid` AS `catid`, `content`.`created` AS `created`, `content`.`created_by` AS `created_by`, `content`.`created_by_alias` AS `created_by_alias`, `content`.`modified` AS `modified`, `content`.`modified_by` AS `modified_by`, `content`.`checked_out` AS `checked_out`, `content`.`checked_out_time` AS `checked_out_time`, `content`.`publish_up` AS `publish_up`, `content`.`publish_down` AS `publish_down`, `content`.`images` AS `images`, `content`.`urls` AS `urls`, `content`.`attribs` AS `attribs`, `content`.`version` AS `version`, `content`.`ordering` AS `ordering`, `content`.`metakey` AS `metakey`, `content`.`metadesc` AS `metadesc`, `content`.`access` AS `access`, `content`.`hits` AS `hits`, `content`.`metadata` AS `metadata`, `content`.`featured` AS `featured`, `content`.`language` AS `language`, `content`.`xreference` AS `xreference` FROM `contents` AS `content` ORDER BY `title` DESC LIMIT 20 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ] in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-03-14 00:52:55 --- DEBUG: #0 D:\web\ehovel\source\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'SELECT `id` AS ...', 'Model_Content', Array)
#1 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1060): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1001): Kohana_ORM->_load_result(true)
#3 D:\web\ehovel\source\admin\classes\grid.php(137): Kohana_ORM->find_all()
#4 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(15): Grid->to_array()
#5 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Cms_Content->action_index()
#6 [internal function]: Kohana_Controller->execute()
#7 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#8 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#9 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#10 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#11 {main} in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-03-14 00:52:56 --- CRITICAL: Database_Exception [ 1052 ]: Column 'title' in order clause is ambiguous [ SELECT `id` AS `title`, `content`.`id` AS `id`, `content`.`asset_id` AS `asset_id`, `content`.`title` AS `title`, `content`.`alias` AS `alias`, `content`.`introtext` AS `introtext`, `content`.`fulltext` AS `fulltext`, `content`.`state` AS `state`, `content`.`catid` AS `catid`, `content`.`created` AS `created`, `content`.`created_by` AS `created_by`, `content`.`created_by_alias` AS `created_by_alias`, `content`.`modified` AS `modified`, `content`.`modified_by` AS `modified_by`, `content`.`checked_out` AS `checked_out`, `content`.`checked_out_time` AS `checked_out_time`, `content`.`publish_up` AS `publish_up`, `content`.`publish_down` AS `publish_down`, `content`.`images` AS `images`, `content`.`urls` AS `urls`, `content`.`attribs` AS `attribs`, `content`.`version` AS `version`, `content`.`ordering` AS `ordering`, `content`.`metakey` AS `metakey`, `content`.`metadesc` AS `metadesc`, `content`.`access` AS `access`, `content`.`hits` AS `hits`, `content`.`metadata` AS `metadata`, `content`.`featured` AS `featured`, `content`.`language` AS `language`, `content`.`xreference` AS `xreference` FROM `contents` AS `content` ORDER BY `title` ASC LIMIT 20 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ] in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-03-14 00:52:56 --- DEBUG: #0 D:\web\ehovel\source\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'SELECT `id` AS ...', 'Model_Content', Array)
#1 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1060): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1001): Kohana_ORM->_load_result(true)
#3 D:\web\ehovel\source\admin\classes\grid.php(137): Kohana_ORM->find_all()
#4 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(15): Grid->to_array()
#5 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Cms_Content->action_index()
#6 [internal function]: Kohana_Controller->execute()
#7 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#8 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#9 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#10 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#11 {main} in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-03-14 00:52:56 --- CRITICAL: Database_Exception [ 1052 ]: Column 'title' in order clause is ambiguous [ SELECT `id` AS `title`, `content`.`id` AS `id`, `content`.`asset_id` AS `asset_id`, `content`.`title` AS `title`, `content`.`alias` AS `alias`, `content`.`introtext` AS `introtext`, `content`.`fulltext` AS `fulltext`, `content`.`state` AS `state`, `content`.`catid` AS `catid`, `content`.`created` AS `created`, `content`.`created_by` AS `created_by`, `content`.`created_by_alias` AS `created_by_alias`, `content`.`modified` AS `modified`, `content`.`modified_by` AS `modified_by`, `content`.`checked_out` AS `checked_out`, `content`.`checked_out_time` AS `checked_out_time`, `content`.`publish_up` AS `publish_up`, `content`.`publish_down` AS `publish_down`, `content`.`images` AS `images`, `content`.`urls` AS `urls`, `content`.`attribs` AS `attribs`, `content`.`version` AS `version`, `content`.`ordering` AS `ordering`, `content`.`metakey` AS `metakey`, `content`.`metadesc` AS `metadesc`, `content`.`access` AS `access`, `content`.`hits` AS `hits`, `content`.`metadata` AS `metadata`, `content`.`featured` AS `featured`, `content`.`language` AS `language`, `content`.`xreference` AS `xreference` FROM `contents` AS `content` ORDER BY `title` DESC LIMIT 20 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ] in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-03-14 00:52:56 --- DEBUG: #0 D:\web\ehovel\source\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'SELECT `id` AS ...', 'Model_Content', Array)
#1 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1060): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1001): Kohana_ORM->_load_result(true)
#3 D:\web\ehovel\source\admin\classes\grid.php(137): Kohana_ORM->find_all()
#4 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(15): Grid->to_array()
#5 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Cms_Content->action_index()
#6 [internal function]: Kohana_Controller->execute()
#7 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#8 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#9 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#10 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#11 {main} in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-03-14 00:53:01 --- CRITICAL: Database_Exception [ 1052 ]: Column 'title' in order clause is ambiguous [ SELECT `id` AS `title`, `content`.`id` AS `id`, `content`.`asset_id` AS `asset_id`, `content`.`title` AS `title`, `content`.`alias` AS `alias`, `content`.`introtext` AS `introtext`, `content`.`fulltext` AS `fulltext`, `content`.`state` AS `state`, `content`.`catid` AS `catid`, `content`.`created` AS `created`, `content`.`created_by` AS `created_by`, `content`.`created_by_alias` AS `created_by_alias`, `content`.`modified` AS `modified`, `content`.`modified_by` AS `modified_by`, `content`.`checked_out` AS `checked_out`, `content`.`checked_out_time` AS `checked_out_time`, `content`.`publish_up` AS `publish_up`, `content`.`publish_down` AS `publish_down`, `content`.`images` AS `images`, `content`.`urls` AS `urls`, `content`.`attribs` AS `attribs`, `content`.`version` AS `version`, `content`.`ordering` AS `ordering`, `content`.`metakey` AS `metakey`, `content`.`metadesc` AS `metadesc`, `content`.`access` AS `access`, `content`.`hits` AS `hits`, `content`.`metadata` AS `metadata`, `content`.`featured` AS `featured`, `content`.`language` AS `language`, `content`.`xreference` AS `xreference` FROM `contents` AS `content` ORDER BY `title` ASC LIMIT 20 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ] in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-03-14 00:53:01 --- DEBUG: #0 D:\web\ehovel\source\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'SELECT `id` AS ...', 'Model_Content', Array)
#1 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1060): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1001): Kohana_ORM->_load_result(true)
#3 D:\web\ehovel\source\admin\classes\grid.php(137): Kohana_ORM->find_all()
#4 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(15): Grid->to_array()
#5 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Cms_Content->action_index()
#6 [internal function]: Kohana_Controller->execute()
#7 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#8 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#9 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#10 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#11 {main} in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-03-14 00:53:02 --- CRITICAL: Database_Exception [ 1052 ]: Column 'title' in order clause is ambiguous [ SELECT `id` AS `title`, `content`.`id` AS `id`, `content`.`asset_id` AS `asset_id`, `content`.`title` AS `title`, `content`.`alias` AS `alias`, `content`.`introtext` AS `introtext`, `content`.`fulltext` AS `fulltext`, `content`.`state` AS `state`, `content`.`catid` AS `catid`, `content`.`created` AS `created`, `content`.`created_by` AS `created_by`, `content`.`created_by_alias` AS `created_by_alias`, `content`.`modified` AS `modified`, `content`.`modified_by` AS `modified_by`, `content`.`checked_out` AS `checked_out`, `content`.`checked_out_time` AS `checked_out_time`, `content`.`publish_up` AS `publish_up`, `content`.`publish_down` AS `publish_down`, `content`.`images` AS `images`, `content`.`urls` AS `urls`, `content`.`attribs` AS `attribs`, `content`.`version` AS `version`, `content`.`ordering` AS `ordering`, `content`.`metakey` AS `metakey`, `content`.`metadesc` AS `metadesc`, `content`.`access` AS `access`, `content`.`hits` AS `hits`, `content`.`metadata` AS `metadata`, `content`.`featured` AS `featured`, `content`.`language` AS `language`, `content`.`xreference` AS `xreference` FROM `contents` AS `content` ORDER BY `title` DESC LIMIT 20 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ] in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-03-14 00:53:02 --- DEBUG: #0 D:\web\ehovel\source\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'SELECT `id` AS ...', 'Model_Content', Array)
#1 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1060): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1001): Kohana_ORM->_load_result(true)
#3 D:\web\ehovel\source\admin\classes\grid.php(137): Kohana_ORM->find_all()
#4 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(15): Grid->to_array()
#5 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Cms_Content->action_index()
#6 [internal function]: Kohana_Controller->execute()
#7 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#8 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#9 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#10 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#11 {main} in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-03-14 01:48:01 --- CRITICAL: ErrorException [ 8 ]: Undefined property: Controller_Admin_Cms_Content::$_request ~ APPPATH\classes\controller\admin\base.php [ 99 ] in D:\web\ehovel\source\admin\classes\controller\admin\base.php:99
2013-03-14 01:48:01 --- DEBUG: #0 D:\web\ehovel\source\admin\classes\controller\admin\base.php(99): Kohana_Core::error_handler(8, 'Undefined prope...', 'D:\web\ehovel\s...', 99, Array)
#1 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Base->action_searchoptions()
#2 [internal function]: Kohana_Controller->execute()
#3 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#4 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#6 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#7 {main} in D:\web\ehovel\source\admin\classes\controller\admin\base.php:99
2013-03-14 02:01:01 --- CRITICAL: ErrorException [ 1 ]: Using $this when not in object context ~ MODPATH\message\classes\kohana\message.php [ 42 ] in :
2013-03-14 02:01:01 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-14 02:01:02 --- CRITICAL: ErrorException [ 1 ]: Using $this when not in object context ~ MODPATH\message\classes\kohana\message.php [ 42 ] in :
2013-03-14 02:01:02 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-14 02:04:34 --- CRITICAL: Database_Exception [ 1052 ]: Column 'title' in order clause is ambiguous [ SELECT `id` AS `title`, `content`.`id` AS `id`, `content`.`asset_id` AS `asset_id`, `content`.`title` AS `title`, `content`.`alias` AS `alias`, `content`.`introtext` AS `introtext`, `content`.`fulltext` AS `fulltext`, `content`.`state` AS `state`, `content`.`catid` AS `catid`, `content`.`created` AS `created`, `content`.`created_by` AS `created_by`, `content`.`created_by_alias` AS `created_by_alias`, `content`.`modified` AS `modified`, `content`.`modified_by` AS `modified_by`, `content`.`checked_out` AS `checked_out`, `content`.`checked_out_time` AS `checked_out_time`, `content`.`publish_up` AS `publish_up`, `content`.`publish_down` AS `publish_down`, `content`.`images` AS `images`, `content`.`urls` AS `urls`, `content`.`attribs` AS `attribs`, `content`.`version` AS `version`, `content`.`ordering` AS `ordering`, `content`.`metakey` AS `metakey`, `content`.`metadesc` AS `metadesc`, `content`.`access` AS `access`, `content`.`hits` AS `hits`, `content`.`metadata` AS `metadata`, `content`.`featured` AS `featured`, `content`.`language` AS `language`, `content`.`xreference` AS `xreference` FROM `contents` AS `content` ORDER BY `title` ASC LIMIT 20 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ] in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-03-14 02:04:34 --- DEBUG: #0 D:\web\ehovel\source\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'SELECT `id` AS ...', 'Model_Content', Array)
#1 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1060): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1001): Kohana_ORM->_load_result(true)
#3 D:\web\ehovel\source\admin\classes\grid.php(137): Kohana_ORM->find_all()
#4 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(15): Grid->to_array()
#5 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Cms_Content->action_index()
#6 [internal function]: Kohana_Controller->execute()
#7 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#8 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#9 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#10 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#11 {main} in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-03-14 02:38:24 --- CRITICAL: Kohana_Exception [ 0 ]: The admin property does not exist in the Model_Content class ~ MODPATH\orm\classes\kohana\orm.php [ 684 ] in D:\web\ehovel\source\modules\orm\classes\kohana\orm.php:600
2013-03-14 02:38:24 --- DEBUG: #0 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(600): Kohana_ORM->get('admin')
#1 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(12): Kohana_ORM->__get('admin')
#2 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Cms_Content->action_index()
#3 [internal function]: Kohana_Controller->execute()
#4 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#5 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#7 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#8 {main} in D:\web\ehovel\source\modules\orm\classes\kohana\orm.php:600
2013-03-14 02:38:31 --- CRITICAL: ErrorException [ 1 ]: Class 'MPTT' not found ~ MODPATH\auth\classes\model\auth\admin.php [ 13 ] in :
2013-03-14 02:38:31 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-14 02:53:34 --- CRITICAL: Database_Exception [ 1054 ]: Unknown column 'auth_admin.lft' in 'order clause' [ SELECT `auth_admin`.`id` AS `id`, `auth_admin`.`name` AS `name`, `auth_admin`.`username` AS `username`, `auth_admin`.`email` AS `email`, `auth_admin`.`password` AS `password`, `auth_admin`.`last_login_date` AS `last_login_date`, `auth_admin`.`last_login_ip` AS `last_login_ip`, `auth_admin`.`super` AS `super`, `auth_admin`.`date_add` AS `date_add`, `auth_admin`.`date_upd` AS `date_upd`, `auth_admin`.`disabled` AS `disabled` FROM `auth_admins` AS `auth_admin` WHERE `auth_admin`.`id` = '1' ORDER BY `auth_admin`.`lft` ASC LIMIT 1 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ] in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-03-14 02:53:34 --- DEBUG: #0 D:\web\ehovel\source\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'SELECT `auth_ad...', false, Array)
#1 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1069): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(976): Kohana_ORM->_load_result(false)
#3 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(637): Kohana_ORM->find()
#4 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(600): Kohana_ORM->get('admin')
#5 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(12): Kohana_ORM->__get('admin')
#6 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Cms_Content->action_index()
#7 [internal function]: Kohana_Controller->execute()
#8 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#9 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#10 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#11 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#12 {main} in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-03-14 03:54:54 --- CRITICAL: Database_Exception [ 1054 ]: Unknown column 'admin.name' in 'field list' [ SELECT `admin`.`name`, `content`.`id` AS `id`, `content`.`asset_id` AS `asset_id`, `content`.`title` AS `title`, `content`.`alias` AS `alias`, `content`.`introtext` AS `introtext`, `content`.`fulltext` AS `fulltext`, `content`.`state` AS `state`, `content`.`catid` AS `catid`, `content`.`created` AS `created`, `content`.`created_by` AS `created_by`, `content`.`created_by_alias` AS `created_by_alias`, `content`.`modified` AS `modified`, `content`.`modified_by` AS `modified_by`, `content`.`checked_out` AS `checked_out`, `content`.`checked_out_time` AS `checked_out_time`, `content`.`publish_up` AS `publish_up`, `content`.`publish_down` AS `publish_down`, `content`.`images` AS `images`, `content`.`urls` AS `urls`, `content`.`attribs` AS `attribs`, `content`.`version` AS `version`, `content`.`ordering` AS `ordering`, `content`.`metakey` AS `metakey`, `content`.`metadesc` AS `metadesc`, `content`.`access` AS `access`, `content`.`hits` AS `hits`, `content`.`metadata` AS `metadata`, `content`.`featured` AS `featured`, `content`.`language` AS `language`, `content`.`xreference` AS `xreference` FROM `contents` AS `content` ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ] in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-03-14 03:54:54 --- DEBUG: #0 D:\web\ehovel\source\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'SELECT `admin`....', 'Model_Content', Array)
#1 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1060): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1001): Kohana_ORM->_load_result(true)
#3 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(14): Kohana_ORM->find_all()
#4 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Cms_Content->action_index()
#5 [internal function]: Kohana_Controller->execute()
#6 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#7 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#8 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#9 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#10 {main} in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-03-14 03:55:39 --- CRITICAL: ErrorException [ 1 ]: Call to undefined method Database_MySQL_Result::last_query() ~ MODPATH\cms\classes\controller\admin\cms\content.php [ 14 ] in :
2013-03-14 03:55:39 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-14 04:01:39 --- CRITICAL: ErrorException [ 1 ]: Call to undefined method Database_MySQL_Result::last_query() ~ MODPATH\cms\classes\controller\admin\cms\content.php [ 14 ] in :
2013-03-14 04:01:39 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-14 04:01:57 --- CRITICAL: ErrorException [ 1 ]: Call to undefined method Database_MySQL_Result::last_query() ~ MODPATH\cms\classes\controller\admin\cms\content.php [ 14 ] in :
2013-03-14 04:01:57 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-14 04:02:01 --- CRITICAL: ErrorException [ 1 ]: Call to undefined method Database_MySQL_Result::last_query() ~ MODPATH\cms\classes\controller\admin\cms\content.php [ 14 ] in :
2013-03-14 04:02:01 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-14 04:05:48 --- CRITICAL: ErrorException [ 1 ]: Call to undefined method Database_MySQL_Result::last_query() ~ MODPATH\cms\classes\controller\admin\cms\content.php [ 14 ] in :
2013-03-14 04:05:48 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-14 04:08:48 --- CRITICAL: ErrorException [ 1 ]: Call to undefined method Database_MySQL_Result::last_query() ~ MODPATH\cms\classes\controller\admin\cms\content.php [ 14 ] in :
2013-03-14 04:08:48 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-14 04:09:23 --- CRITICAL: ErrorException [ 1 ]: Call to undefined method Database_MySQL_Result::last_query() ~ MODPATH\cms\classes\controller\admin\cms\content.php [ 14 ] in :
2013-03-14 04:09:23 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-14 04:09:26 --- CRITICAL: ErrorException [ 1 ]: Call to undefined method Database_MySQL_Result::last_query() ~ MODPATH\cms\classes\controller\admin\cms\content.php [ 14 ] in :
2013-03-14 04:09:26 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-14 04:11:13 --- CRITICAL: ErrorException [ 1 ]: Call to undefined method Database_MySQL_Result::last_query() ~ MODPATH\cms\classes\controller\admin\cms\content.php [ 14 ] in :
2013-03-14 04:11:13 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-14 04:12:07 --- CRITICAL: ErrorException [ 1 ]: Call to undefined method Database_MySQL_Result::last_query() ~ MODPATH\cms\classes\controller\admin\cms\content.php [ 14 ] in :
2013-03-14 04:12:07 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-14 04:12:42 --- CRITICAL: ErrorException [ 1 ]: Call to undefined method Database_MySQL_Result::last_query() ~ MODPATH\cms\classes\controller\admin\cms\content.php [ 12 ] in :
2013-03-14 04:12:42 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-14 04:13:05 --- CRITICAL: ErrorException [ 1 ]: Call to undefined method Database_MySQL_Result::last_query() ~ MODPATH\cms\classes\controller\admin\cms\content.php [ 12 ] in :
2013-03-14 04:13:05 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-14 04:13:20 --- CRITICAL: ErrorException [ 4096 ]: Object of class Database_MySQL_Result could not be converted to string ~ MODPATH\cms\classes\controller\admin\cms\content.php [ 12 ] in D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php:12
2013-03-14 04:13:20 --- DEBUG: #0 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(12): Kohana_Core::error_handler(4096, 'Object of class...', 'D:\web\ehovel\s...', 12, Array)
#1 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Cms_Content->action_index()
#2 [internal function]: Kohana_Controller->execute()
#3 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#4 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#6 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#7 {main} in D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php:12
2013-03-14 04:13:22 --- CRITICAL: ErrorException [ 4096 ]: Object of class Database_MySQL_Result could not be converted to string ~ MODPATH\cms\classes\controller\admin\cms\content.php [ 12 ] in D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php:12
2013-03-14 04:13:22 --- DEBUG: #0 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(12): Kohana_Core::error_handler(4096, 'Object of class...', 'D:\web\ehovel\s...', 12, Array)
#1 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Cms_Content->action_index()
#2 [internal function]: Kohana_Controller->execute()
#3 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#4 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#6 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#7 {main} in D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php:12
2013-03-14 04:15:02 --- CRITICAL: ErrorException [ 1 ]: Class 'ProfilerToolbar' not found ~ APPPATH\views\footer.php [ 58 ] in :
2013-03-14 04:15:02 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-14 04:15:26 --- CRITICAL: ErrorException [ 1 ]: Call to undefined method Database_MySQL_Result::last_query() ~ MODPATH\cms\classes\controller\admin\cms\content.php [ 15 ] in :
2013-03-14 04:15:26 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-14 05:14:40 --- CRITICAL: ErrorException [ 4096 ]: Argument 1 passed to Grid::to_array() must be an array, string given, called in D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php on line 20 and defined ~ APPPATH\classes\grid.php [ 121 ] in D:\web\ehovel\source\admin\classes\grid.php:121
2013-03-14 05:14:40 --- DEBUG: #0 D:\web\ehovel\source\admin\classes\grid.php(121): Kohana_Core::error_handler(4096, 'Argument 1 pass...', 'D:\web\ehovel\s...', 121, Array)
#1 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(20): Grid->to_array('username')
#2 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Cms_Content->action_index()
#3 [internal function]: Kohana_Controller->execute()
#4 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#5 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#7 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#8 {main} in D:\web\ehovel\source\admin\classes\grid.php:121
2013-03-14 05:28:20 --- CRITICAL: ErrorException [ 2048 ]: Declaration of ORM::save() should be compatible with that of Kohana_ORM::save() ~ MODPATH\orm\classes\orm.php [ 3 ] in D:\web\ehovel\source\modules\orm\classes\orm.php:3
2013-03-14 05:28:20 --- DEBUG: #0 D:\web\ehovel\source\modules\orm\classes\orm.php(3): Kohana_Core::error_handler(2048, 'Declaration of ...', 'D:\web\ehovel\s...', 3, Array)
#1 D:\web\ehovel\source\system\classes\kohana\core.php(511): require('D:\web\ehovel\s...')
#2 [internal function]: Kohana_Core::auto_load('ORM')
#3 D:\web\ehovel\source\admin\classes\helper\menu.php(23): spl_autoload_call('ORM')
#4 D:\web\ehovel\source\admin\views\header.php(35): Helper_Menu::generate_menu()
#5 D:\web\ehovel\source\system\classes\kohana\view.php(61): include('D:\web\ehovel\s...')
#6 D:\web\ehovel\source\system\classes\kohana\view.php(348): Kohana_View::capture('D:\web\ehovel\s...', Array)
#7 D:\web\ehovel\source\system\classes\view.php(96): Kohana_View->render(NULL)
#8 D:\web\ehovel\source\admin\classes\controller\admin\base.php(58): View->render(NULL, false)
#9 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(7): Controller_Admin_Base->before()
#10 D:\web\ehovel\source\system\classes\kohana\controller.php(69): Controller_Admin_Cms_Content->before()
#11 [internal function]: Kohana_Controller->execute()
#12 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#13 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#14 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#15 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#16 {main} in D:\web\ehovel\source\modules\orm\classes\orm.php:3
2013-03-14 05:29:05 --- CRITICAL: Database_Exception [ 1054 ]: Unknown column 'contents.disabled' in 'where clause' [ SELECT `content`.`id` AS `id`, `content`.`asset_id` AS `asset_id`, `content`.`title` AS `title`, `content`.`alias` AS `alias`, `content`.`introtext` AS `introtext`, `content`.`fulltext` AS `fulltext`, `content`.`state` AS `state`, `content`.`catid` AS `catid`, `content`.`created` AS `created`, `content`.`created_by` AS `created_by`, `content`.`created_by_alias` AS `created_by_alias`, `content`.`modified` AS `modified`, `content`.`modified_by` AS `modified_by`, `content`.`checked_out` AS `checked_out`, `content`.`checked_out_time` AS `checked_out_time`, `content`.`publish_up` AS `publish_up`, `content`.`publish_down` AS `publish_down`, `content`.`images` AS `images`, `content`.`urls` AS `urls`, `content`.`attribs` AS `attribs`, `content`.`version` AS `version`, `content`.`ordering` AS `ordering`, `content`.`metakey` AS `metakey`, `content`.`metadesc` AS `metadesc`, `content`.`access` AS `access`, `content`.`hits` AS `hits`, `content`.`metadata` AS `metadata`, `content`.`featured` AS `featured`, `content`.`language` AS `language`, `content`.`xreference` AS `xreference` FROM `contents` AS `content` WHERE `contents`.`disabled` = 'N' ORDER BY `id` ASC LIMIT 20 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ] in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-03-14 05:29:05 --- DEBUG: #0 D:\web\ehovel\source\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'SELECT `content...', 'Model_Content', Array)
#1 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1060): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1001): Kohana_ORM->_load_result(true)
#3 D:\web\ehovel\source\modules\orm\classes\orm.php(157): Kohana_ORM->find_all()
#4 D:\web\ehovel\source\admin\classes\grid.php(137): ORM->find_all()
#5 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(20): Grid->to_array()
#6 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Cms_Content->action_index()
#7 [internal function]: Kohana_Controller->execute()
#8 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#9 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#10 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#11 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#12 {main} in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-03-14 05:31:48 --- CRITICAL: Database_Exception [ 1054 ]: Unknown column 'contents.disabled' in 'where clause' [ SELECT `content`.`id` AS `id`, `content`.`asset_id` AS `asset_id`, `content`.`title` AS `title`, `content`.`alias` AS `alias`, `content`.`introtext` AS `introtext`, `content`.`fulltext` AS `fulltext`, `content`.`state` AS `state`, `content`.`catid` AS `catid`, `content`.`created` AS `created`, `content`.`created_by` AS `created_by`, `content`.`created_by_alias` AS `created_by_alias`, `content`.`modified` AS `modified`, `content`.`modified_by` AS `modified_by`, `content`.`checked_out` AS `checked_out`, `content`.`checked_out_time` AS `checked_out_time`, `content`.`publish_up` AS `publish_up`, `content`.`publish_down` AS `publish_down`, `content`.`images` AS `images`, `content`.`urls` AS `urls`, `content`.`attribs` AS `attribs`, `content`.`version` AS `version`, `content`.`ordering` AS `ordering`, `content`.`metakey` AS `metakey`, `content`.`metadesc` AS `metadesc`, `content`.`access` AS `access`, `content`.`hits` AS `hits`, `content`.`metadata` AS `metadata`, `content`.`featured` AS `featured`, `content`.`language` AS `language`, `content`.`xreference` AS `xreference`, `content`.`disabled` AS `disabled` FROM `contents` AS `content` WHERE `contents`.`disabled` = 'N' ORDER BY `id` ASC LIMIT 20 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ] in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-03-14 05:31:48 --- DEBUG: #0 D:\web\ehovel\source\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'SELECT `content...', 'Model_Content', Array)
#1 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1060): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1001): Kohana_ORM->_load_result(true)
#3 D:\web\ehovel\source\modules\orm\classes\orm.php(157): Kohana_ORM->find_all()
#4 D:\web\ehovel\source\admin\classes\grid.php(137): ORM->find_all()
#5 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(20): Grid->to_array()
#6 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Cms_Content->action_index()
#7 [internal function]: Kohana_Controller->execute()
#8 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#9 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#10 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#11 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#12 {main} in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-03-14 05:32:11 --- CRITICAL: Database_Exception [ 1054 ]: Unknown column 'contents.disabled' in 'where clause' [ SELECT `content`.`id` AS `id`, `content`.`asset_id` AS `asset_id`, `content`.`title` AS `title`, `content`.`alias` AS `alias`, `content`.`introtext` AS `introtext`, `content`.`fulltext` AS `fulltext`, `content`.`state` AS `state`, `content`.`catid` AS `catid`, `content`.`created` AS `created`, `content`.`created_by` AS `created_by`, `content`.`created_by_alias` AS `created_by_alias`, `content`.`modified` AS `modified`, `content`.`modified_by` AS `modified_by`, `content`.`checked_out` AS `checked_out`, `content`.`checked_out_time` AS `checked_out_time`, `content`.`publish_up` AS `publish_up`, `content`.`publish_down` AS `publish_down`, `content`.`images` AS `images`, `content`.`urls` AS `urls`, `content`.`attribs` AS `attribs`, `content`.`version` AS `version`, `content`.`ordering` AS `ordering`, `content`.`metakey` AS `metakey`, `content`.`metadesc` AS `metadesc`, `content`.`access` AS `access`, `content`.`hits` AS `hits`, `content`.`metadata` AS `metadata`, `content`.`featured` AS `featured`, `content`.`language` AS `language`, `content`.`xreference` AS `xreference`, `content`.`disabled` AS `disabled` FROM `contents` AS `content` WHERE `contents`.`disabled` = 'N' ORDER BY `id` ASC LIMIT 20 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ] in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-03-14 05:32:11 --- DEBUG: #0 D:\web\ehovel\source\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'SELECT `content...', 'Model_Content', Array)
#1 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1060): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1001): Kohana_ORM->_load_result(true)
#3 D:\web\ehovel\source\modules\orm\classes\orm.php(157): Kohana_ORM->find_all()
#4 D:\web\ehovel\source\admin\classes\grid.php(137): ORM->find_all()
#5 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(20): Grid->to_array()
#6 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Cms_Content->action_index()
#7 [internal function]: Kohana_Controller->execute()
#8 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#9 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#10 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#11 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#12 {main} in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-03-14 05:33:08 --- CRITICAL: Database_Exception [ 1054 ]: Unknown column 'contents.disabled' in 'where clause' [ SELECT `content`.`id` AS `id`, `content`.`asset_id` AS `asset_id`, `content`.`title` AS `title`, `content`.`alias` AS `alias`, `content`.`introtext` AS `introtext`, `content`.`fulltext` AS `fulltext`, `content`.`state` AS `state`, `content`.`catid` AS `catid`, `content`.`created` AS `created`, `content`.`created_by` AS `created_by`, `content`.`created_by_alias` AS `created_by_alias`, `content`.`modified` AS `modified`, `content`.`modified_by` AS `modified_by`, `content`.`checked_out` AS `checked_out`, `content`.`checked_out_time` AS `checked_out_time`, `content`.`publish_up` AS `publish_up`, `content`.`publish_down` AS `publish_down`, `content`.`images` AS `images`, `content`.`urls` AS `urls`, `content`.`attribs` AS `attribs`, `content`.`version` AS `version`, `content`.`ordering` AS `ordering`, `content`.`metakey` AS `metakey`, `content`.`metadesc` AS `metadesc`, `content`.`access` AS `access`, `content`.`hits` AS `hits`, `content`.`metadata` AS `metadata`, `content`.`featured` AS `featured`, `content`.`language` AS `language`, `content`.`xreference` AS `xreference`, `content`.`disabled` AS `disabled` FROM `contents` AS `content` WHERE `contents`.`disabled` = 'N' ORDER BY `id` ASC LIMIT 20 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ] in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-03-14 05:33:08 --- DEBUG: #0 D:\web\ehovel\source\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'SELECT `content...', 'Model_Content', Array)
#1 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1060): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1001): Kohana_ORM->_load_result(true)
#3 D:\web\ehovel\source\modules\orm\classes\orm.php(157): Kohana_ORM->find_all()
#4 D:\web\ehovel\source\admin\classes\grid.php(137): ORM->find_all()
#5 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(20): Grid->to_array()
#6 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Cms_Content->action_index()
#7 [internal function]: Kohana_Controller->execute()
#8 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#9 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#10 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#11 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#12 {main} in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-03-14 05:35:05 --- CRITICAL: Database_Exception [ 1054 ]: Unknown column 'contents.disabled' in 'where clause' [ SELECT `content`.`id` AS `id`, `content`.`asset_id` AS `asset_id`, `content`.`title` AS `title`, `content`.`alias` AS `alias`, `content`.`introtext` AS `introtext`, `content`.`fulltext` AS `fulltext`, `content`.`state` AS `state`, `content`.`catid` AS `catid`, `content`.`created` AS `created`, `content`.`created_by` AS `created_by`, `content`.`created_by_alias` AS `created_by_alias`, `content`.`modified` AS `modified`, `content`.`modified_by` AS `modified_by`, `content`.`checked_out` AS `checked_out`, `content`.`checked_out_time` AS `checked_out_time`, `content`.`publish_up` AS `publish_up`, `content`.`publish_down` AS `publish_down`, `content`.`images` AS `images`, `content`.`urls` AS `urls`, `content`.`attribs` AS `attribs`, `content`.`version` AS `version`, `content`.`ordering` AS `ordering`, `content`.`metakey` AS `metakey`, `content`.`metadesc` AS `metadesc`, `content`.`access` AS `access`, `content`.`hits` AS `hits`, `content`.`metadata` AS `metadata`, `content`.`featured` AS `featured`, `content`.`language` AS `language`, `content`.`xreference` AS `xreference`, `content`.`disabled` AS `disabled` FROM `contents` AS `content` WHERE `contents`.`disabled` = 'N' ORDER BY `id` ASC LIMIT 20 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ] in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-03-14 05:35:05 --- DEBUG: #0 D:\web\ehovel\source\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'SELECT `content...', 'Model_Content', Array)
#1 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1060): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1001): Kohana_ORM->_load_result(true)
#3 D:\web\ehovel\source\modules\orm\classes\orm.php(157): Kohana_ORM->find_all()
#4 D:\web\ehovel\source\admin\classes\grid.php(137): ORM->find_all()
#5 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(20): Grid->to_array()
#6 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Cms_Content->action_index()
#7 [internal function]: Kohana_Controller->execute()
#8 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#9 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#10 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#11 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#12 {main} in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-03-14 05:38:56 --- CRITICAL: Database_Exception [ 1054 ]: Unknown column 'contents.disabled' in 'where clause' [ SELECT `content`.`id` AS `id`, `content`.`asset_id` AS `asset_id`, `content`.`title` AS `title`, `content`.`alias` AS `alias`, `content`.`introtext` AS `introtext`, `content`.`fulltext` AS `fulltext`, `content`.`state` AS `state`, `content`.`catid` AS `catid`, `content`.`created` AS `created`, `content`.`created_by` AS `created_by`, `content`.`created_by_alias` AS `created_by_alias`, `content`.`modified` AS `modified`, `content`.`modified_by` AS `modified_by`, `content`.`checked_out` AS `checked_out`, `content`.`checked_out_time` AS `checked_out_time`, `content`.`publish_up` AS `publish_up`, `content`.`publish_down` AS `publish_down`, `content`.`images` AS `images`, `content`.`urls` AS `urls`, `content`.`attribs` AS `attribs`, `content`.`version` AS `version`, `content`.`ordering` AS `ordering`, `content`.`metakey` AS `metakey`, `content`.`metadesc` AS `metadesc`, `content`.`access` AS `access`, `content`.`hits` AS `hits`, `content`.`metadata` AS `metadata`, `content`.`featured` AS `featured`, `content`.`language` AS `language`, `content`.`xreference` AS `xreference`, `content`.`disabled` AS `disabled` FROM `contents` AS `content` WHERE `contents`.`disabled` = 'N' ORDER BY `id` ASC LIMIT 20 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ] in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-03-14 05:38:56 --- DEBUG: #0 D:\web\ehovel\source\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'SELECT `content...', 'Model_Content', Array)
#1 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1060): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1001): Kohana_ORM->_load_result(true)
#3 D:\web\ehovel\source\modules\orm\classes\orm.php(157): Kohana_ORM->find_all()
#4 D:\web\ehovel\source\admin\classes\grid.php(137): ORM->find_all()
#5 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(20): Grid->to_array()
#6 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Cms_Content->action_index()
#7 [internal function]: Kohana_Controller->execute()
#8 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#9 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#10 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#11 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#12 {main} in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-03-14 05:39:01 --- CRITICAL: Database_Exception [ 1054 ]: Unknown column 'contents.disabled' in 'where clause' [ SELECT `content`.`id` AS `id`, `content`.`asset_id` AS `asset_id`, `content`.`title` AS `title`, `content`.`alias` AS `alias`, `content`.`introtext` AS `introtext`, `content`.`fulltext` AS `fulltext`, `content`.`state` AS `state`, `content`.`catid` AS `catid`, `content`.`created` AS `created`, `content`.`created_by` AS `created_by`, `content`.`created_by_alias` AS `created_by_alias`, `content`.`modified` AS `modified`, `content`.`modified_by` AS `modified_by`, `content`.`checked_out` AS `checked_out`, `content`.`checked_out_time` AS `checked_out_time`, `content`.`publish_up` AS `publish_up`, `content`.`publish_down` AS `publish_down`, `content`.`images` AS `images`, `content`.`urls` AS `urls`, `content`.`attribs` AS `attribs`, `content`.`version` AS `version`, `content`.`ordering` AS `ordering`, `content`.`metakey` AS `metakey`, `content`.`metadesc` AS `metadesc`, `content`.`access` AS `access`, `content`.`hits` AS `hits`, `content`.`metadata` AS `metadata`, `content`.`featured` AS `featured`, `content`.`language` AS `language`, `content`.`xreference` AS `xreference`, `content`.`disabled` AS `disabled` FROM `contents` AS `content` WHERE `contents`.`disabled` = 'N' ORDER BY `id` ASC LIMIT 20 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ] in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-03-14 05:39:01 --- DEBUG: #0 D:\web\ehovel\source\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'SELECT `content...', 'Model_Content', Array)
#1 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1060): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1001): Kohana_ORM->_load_result(true)
#3 D:\web\ehovel\source\modules\orm\classes\orm.php(157): Kohana_ORM->find_all()
#4 D:\web\ehovel\source\admin\classes\grid.php(137): ORM->find_all()
#5 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(20): Grid->to_array()
#6 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Cms_Content->action_index()
#7 [internal function]: Kohana_Controller->execute()
#8 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#9 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#10 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#11 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#12 {main} in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-03-14 20:04:38 --- CRITICAL: Database_Exception [ 1054 ]: Unknown column 'contents.disabled' in 'where clause' [ SELECT `content`.`id` AS `id`, `content`.`asset_id` AS `asset_id`, `content`.`title` AS `title`, `content`.`alias` AS `alias`, `content`.`introtext` AS `introtext`, `content`.`fulltext` AS `fulltext`, `content`.`state` AS `state`, `content`.`catid` AS `catid`, `content`.`created` AS `created`, `content`.`created_by` AS `created_by`, `content`.`created_by_alias` AS `created_by_alias`, `content`.`modified` AS `modified`, `content`.`modified_by` AS `modified_by`, `content`.`checked_out` AS `checked_out`, `content`.`checked_out_time` AS `checked_out_time`, `content`.`publish_up` AS `publish_up`, `content`.`publish_down` AS `publish_down`, `content`.`images` AS `images`, `content`.`urls` AS `urls`, `content`.`attribs` AS `attribs`, `content`.`version` AS `version`, `content`.`ordering` AS `ordering`, `content`.`metakey` AS `metakey`, `content`.`metadesc` AS `metadesc`, `content`.`access` AS `access`, `content`.`hits` AS `hits`, `content`.`metadata` AS `metadata`, `content`.`featured` AS `featured`, `content`.`language` AS `language`, `content`.`xreference` AS `xreference`, `content`.`disabled` AS `disabled` FROM `contents` AS `content` WHERE `contents`.`disabled` = 'N' ORDER BY `id` ASC LIMIT 20 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ] in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251
2013-03-14 20:04:38 --- DEBUG: #0 D:\web\ehovel\source\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'SELECT `content...', 'Model_Content', Array)
#1 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1060): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 D:\web\ehovel\source\modules\orm\classes\kohana\orm.php(1001): Kohana_ORM->_load_result(true)
#3 D:\web\ehovel\source\modules\orm\classes\orm.php(157): Kohana_ORM->find_all()
#4 D:\web\ehovel\source\admin\classes\grid.php(137): ORM->find_all()
#5 D:\web\ehovel\source\modules\cms\classes\controller\admin\cms\content.php(20): Grid->to_array()
#6 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Cms_Content->action_index()
#7 [internal function]: Kohana_Controller->execute()
#8 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Cms_Content))
#9 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#10 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#11 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#12 {main} in D:\web\ehovel\source\modules\database\classes\kohana\database\query.php:251