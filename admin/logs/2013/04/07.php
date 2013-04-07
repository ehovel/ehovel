<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2013-04-07 14:03:23 --- CRITICAL: ErrorException [ 1 ]: Class 'OSS_Exception' not found ~ MODPATH\alioss\init.php [ 26 ] in :
2013-04-07 14:03:23 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-04-07 14:08:53 --- CRITICAL: ErrorException [ 1 ]: Class 'ALIOSS' not found ~ MODPATH\resource\classes\controller\admin\resource.php [ 50 ] in :
2013-04-07 14:08:53 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-04-07 14:28:18 --- CRITICAL: ErrorException [ 1 ]: Class 'ALIOSS' not found ~ MODPATH\resource\classes\controller\admin\resource.php [ 50 ] in :
2013-04-07 14:28:18 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-04-07 14:31:45 --- CRITICAL: ErrorException [ 1 ]: Class 'OSS_Exception' not found ~ MODPATH\alioss\classes\kohana\alioss.php [ 236 ] in :
2013-04-07 14:31:45 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-04-07 14:33:39 --- CRITICAL: ErrorException [ 1 ]: Class 'OSS_Exception' not found ~ MODPATH\alioss\classes\kohana\alioss.php [ 236 ] in :
2013-04-07 14:33:39 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-04-07 14:33:41 --- CRITICAL: ErrorException [ 1 ]: Class 'OSS_Exception' not found ~ MODPATH\alioss\classes\kohana\alioss.php [ 236 ] in :
2013-04-07 14:33:41 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-04-07 14:35:19 --- CRITICAL: OSSException [ 0 ]: ACCESS ID或ACCESS KEY为空 ~ MODPATH\alioss\classes\kohana\alioss.php [ 236 ] in D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php:50
2013-04-07 14:35:19 --- DEBUG: #0 D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php(50): Kohana_ALIOSS->__construct()
#1 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Resource->action_upload()
#2 [internal function]: Kohana_Controller->execute()
#3 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#4 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#6 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#7 {main} in D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php:50
2013-04-07 14:37:33 --- CRITICAL: ErrorException [ 8 ]: Undefined index: test ~ MODPATH\resource\classes\controller\admin\resource.php [ 51 ] in D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php:51
2013-04-07 14:37:33 --- DEBUG: #0 D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php(51): Kohana_Core::error_handler(8, 'Undefined index...', 'D:\web\ehovel\s...', 51, Array)
#1 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Resource->action_upload()
#2 [internal function]: Kohana_Controller->execute()
#3 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#4 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#6 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#7 {main} in D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php:51
2013-04-07 15:01:12 --- CRITICAL: ErrorException [ 8 ]: Undefined index: name ~ MODPATH\resource\classes\controller\admin\resource.php [ 52 ] in D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php:52
2013-04-07 15:01:12 --- DEBUG: #0 D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php(52): Kohana_Core::error_handler(8, 'Undefined index...', 'D:\web\ehovel\s...', 52, Array)
#1 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Resource->action_upload()
#2 [internal function]: Kohana_Controller->execute()
#3 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#4 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#6 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#7 {main} in D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php:52
2013-04-07 15:02:02 --- CRITICAL: OSSException [ 0 ]: 日志路径不存在 ~ MODPATH\alioss\classes\kohana\alioss.php [ 1932 ] in D:\web\ehovel\source\modules\alioss\classes\kohana\alioss.php:580
2013-04-07 15:02:02 --- DEBUG: #0 D:\web\ehovel\source\modules\alioss\classes\kohana\alioss.php(580): Kohana_ALIOSS->log('---LOG START---...')
#1 D:\web\ehovel\source\modules\alioss\classes\kohana\alioss.php(863): Kohana_ALIOSS->auth(Array)
#2 D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php(67): Kohana_ALIOSS->upload_file_by_content('ehovel', '{6E0D90C3-0BA3-...', Array)
#3 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Resource->action_upload()
#4 [internal function]: Kohana_Controller->execute()
#5 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#6 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#8 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#9 {main} in D:\web\ehovel\source\modules\alioss\classes\kohana\alioss.php:580
2013-04-07 15:06:02 --- CRITICAL: OSSException [ 0 ]: D:\web\ehovel\source\modules\alioss\config\logs日志路径不存在 ~ MODPATH\alioss\classes\kohana\alioss.php [ 1924 ] in D:\web\ehovel\source\modules\alioss\classes\kohana\alioss.php:580
2013-04-07 15:06:02 --- DEBUG: #0 D:\web\ehovel\source\modules\alioss\classes\kohana\alioss.php(580): Kohana_ALIOSS->log('---LOG START---...')
#1 D:\web\ehovel\source\modules\alioss\classes\kohana\alioss.php(863): Kohana_ALIOSS->auth(Array)
#2 D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php(67): Kohana_ALIOSS->upload_file_by_content('ehovel', '{6E0D90C3-0BA3-...', Array)
#3 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Resource->action_upload()
#4 [internal function]: Kohana_Controller->execute()
#5 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#6 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#8 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#9 {main} in D:\web\ehovel\source\modules\alioss\classes\kohana\alioss.php:580
2013-04-07 15:06:11 --- CRITICAL: OSSException [ 0 ]: D:\web\ehovel\source\modules\alioss\config\./logs日志路径不存在 ~ MODPATH\alioss\classes\kohana\alioss.php [ 1924 ] in D:\web\ehovel\source\modules\alioss\classes\kohana\alioss.php:580
2013-04-07 15:06:11 --- DEBUG: #0 D:\web\ehovel\source\modules\alioss\classes\kohana\alioss.php(580): Kohana_ALIOSS->log('---LOG START---...')
#1 D:\web\ehovel\source\modules\alioss\classes\kohana\alioss.php(863): Kohana_ALIOSS->auth(Array)
#2 D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php(67): Kohana_ALIOSS->upload_file_by_content('ehovel', '{6E0D90C3-0BA3-...', Array)
#3 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Resource->action_upload()
#4 [internal function]: Kohana_Controller->execute()
#5 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#6 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#8 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#9 {main} in D:\web\ehovel\source\modules\alioss\classes\kohana\alioss.php:580
2013-04-07 15:23:49 --- CRITICAL: ErrorException [ 1 ]: Cannot use object of type ResponseCore as array ~ MODPATH\resource\classes\controller\admin\resource.php [ 51 ] in :
2013-04-07 15:23:49 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-04-07 17:51:29 --- CRITICAL: ErrorException [ 8 ]: iconv() [function.iconv]: Detected an illegal character in input string ~ MODPATH\alioss\classes\kohana\alioss.php [ 349 ] in :
2013-04-07 17:51:29 --- DEBUG: #0 [internal function]: Kohana_Core::error_handler(8, 'iconv() [<a hre...', 'D:\web\ehovel\s...', 349, Array)
#1 D:\web\ehovel\source\modules\alioss\classes\kohana\alioss.php(349): iconv('GB2312', 'UTF-8', '???')
#2 D:\web\ehovel\source\modules\alioss\classes\kohana\alioss.php(1131): Kohana_ALIOSS->auth(Array)
#3 D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php(51): Kohana_ALIOSS->get_object('ehovel', '???')
#4 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Resource->action_upload()
#5 [internal function]: Kohana_Controller->execute()
#6 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#7 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#8 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#9 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#10 {main} in :
2013-04-07 17:51:31 --- CRITICAL: ErrorException [ 8 ]: iconv() [function.iconv]: Detected an illegal character in input string ~ MODPATH\alioss\classes\kohana\alioss.php [ 349 ] in :
2013-04-07 17:51:31 --- DEBUG: #0 [internal function]: Kohana_Core::error_handler(8, 'iconv() [<a hre...', 'D:\web\ehovel\s...', 349, Array)
#1 D:\web\ehovel\source\modules\alioss\classes\kohana\alioss.php(349): iconv('GB2312', 'UTF-8', '???')
#2 D:\web\ehovel\source\modules\alioss\classes\kohana\alioss.php(1131): Kohana_ALIOSS->auth(Array)
#3 D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php(51): Kohana_ALIOSS->get_object('ehovel', '???')
#4 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Resource->action_upload()
#5 [internal function]: Kohana_Controller->execute()
#6 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#7 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#8 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#9 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#10 {main} in :
2013-04-07 17:51:45 --- CRITICAL: ErrorException [ 8 ]: iconv() [function.iconv]: Detected an illegal character in input string ~ MODPATH\alioss\classes\kohana\alioss.php [ 349 ] in :
2013-04-07 17:51:45 --- DEBUG: #0 [internal function]: Kohana_Core::error_handler(8, 'iconv() [<a hre...', 'D:\web\ehovel\s...', 349, Array)
#1 D:\web\ehovel\source\modules\alioss\classes\kohana\alioss.php(349): iconv('GB2312', 'UTF-8', '???')
#2 D:\web\ehovel\source\modules\alioss\classes\kohana\alioss.php(1131): Kohana_ALIOSS->auth(Array)
#3 D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php(51): Kohana_ALIOSS->get_object('ehovel', '???')
#4 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Resource->action_upload()
#5 [internal function]: Kohana_Controller->execute()
#6 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#7 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#8 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#9 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#10 {main} in :
2013-04-07 18:19:57 --- CRITICAL: ErrorException [ 2 ]: getimagesize() expects parameter 1 to be string, resource given ~ MODPATH\resource\classes\controller\admin\resource.php [ 55 ] in :
2013-04-07 18:19:57 --- DEBUG: #0 [internal function]: Kohana_Core::error_handler(2, 'getimagesize() ...', 'D:\web\ehovel\s...', 55, Array)
#1 D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php(55): getimagesize(Resource id #77)
#2 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Resource->action_upload()
#3 [internal function]: Kohana_Controller->execute()
#4 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#5 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#7 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#8 {main} in :
2013-04-07 18:20:37 --- CRITICAL: ErrorException [ 2 ]: realpath() expects parameter 1 to be string, resource given ~ MODPATH\resource\classes\controller\admin\resource.php [ 55 ] in :
2013-04-07 18:20:37 --- DEBUG: #0 [internal function]: Kohana_Core::error_handler(2, 'realpath() expe...', 'D:\web\ehovel\s...', 55, Array)
#1 D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php(55): realpath(Resource id #77)
#2 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Resource->action_upload()
#3 [internal function]: Kohana_Controller->execute()
#4 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#5 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#7 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#8 {main} in :
2013-04-07 18:24:31 --- CRITICAL: ErrorException [ 2 ]: tempnam() expects exactly 2 parameters, 0 given ~ MODPATH\resource\classes\controller\admin\resource.php [ 48 ] in :
2013-04-07 18:24:31 --- DEBUG: #0 [internal function]: Kohana_Core::error_handler(2, 'tempnam() expec...', 'D:\web\ehovel\s...', 48, Array)
#1 D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php(48): tempnam()
#2 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Resource->action_upload()
#3 [internal function]: Kohana_Controller->execute()
#4 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#5 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#7 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#8 {main} in :
2013-04-07 18:25:06 --- CRITICAL: ErrorException [ 2 ]: tempnam() expects exactly 2 parameters, 1 given ~ MODPATH\resource\classes\controller\admin\resource.php [ 48 ] in :
2013-04-07 18:25:06 --- DEBUG: #0 [internal function]: Kohana_Core::error_handler(2, 'tempnam() expec...', 'D:\web\ehovel\s...', 48, Array)
#1 D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php(48): tempnam('tmp')
#2 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Resource->action_upload()
#3 [internal function]: Kohana_Controller->execute()
#4 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#5 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#7 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#8 {main} in :
2013-04-07 18:30:09 --- CRITICAL: ErrorException [ 8 ]: Undefined variable: temp ~ MODPATH\resource\classes\controller\admin\resource.php [ 49 ] in D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php:49
2013-04-07 18:30:09 --- DEBUG: #0 D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php(49): Kohana_Core::error_handler(8, 'Undefined varia...', 'D:\web\ehovel\s...', 49, Array)
#1 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Resource->action_upload()
#2 [internal function]: Kohana_Controller->execute()
#3 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#4 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#6 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#7 {main} in D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php:49
2013-04-07 18:30:31 --- CRITICAL: ErrorException [ 2 ]: fwrite() expects parameter 1 to be resource, string given ~ MODPATH\resource\classes\controller\admin\resource.php [ 49 ] in :
2013-04-07 18:30:31 --- DEBUG: #0 [internal function]: Kohana_Core::error_handler(2, 'fwrite() expect...', 'D:\web\ehovel\s...', 49, Array)
#1 D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php(49): fwrite('C:\Windows\temp...', 'ddddd')
#2 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Resource->action_upload()
#3 [internal function]: Kohana_Controller->execute()
#4 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#5 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#7 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#8 {main} in :
2013-04-07 18:34:54 --- CRITICAL: ErrorException [ 1 ]: Call to undefined function getimagesizefromstring() ~ MODPATH\resource\classes\controller\admin\resource.php [ 57 ] in :
2013-04-07 18:34:54 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-04-07 18:36:49 --- CRITICAL: ErrorException [ 8 ]: Undefined property: Controller_Admin_Resource::$imgStream ~ MODPATH\resource\classes\controller\admin\resource.php [ 51 ] in D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php:51
2013-04-07 18:36:49 --- DEBUG: #0 D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php(51): Kohana_Core::error_handler(8, 'Undefined prope...', 'D:\web\ehovel\s...', 51, Array)
#1 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Resource->action_upload()
#2 [internal function]: Kohana_Controller->execute()
#3 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#4 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#6 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#7 {main} in D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php:51
2013-04-07 18:38:24 --- CRITICAL: ErrorException [ 2 ]: getimagesize(GIF89a) [function.getimagesize]: failed to open stream: Invalid argument ~ MODPATH\resource\classes\controller\admin\resource.php [ 57 ] in :
2013-04-07 18:38:24 --- DEBUG: #0 [internal function]: Kohana_Core::error_handler(2, 'getimagesize(GI...', 'D:\web\ehovel\s...', 57, Array)
#1 D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php(57): getimagesize('GIF89a?????????...')
#2 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Resource->action_upload()
#3 [internal function]: Kohana_Controller->execute()
#4 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#5 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#7 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#8 {main} in :
2013-04-07 19:37:09 --- CRITICAL: ErrorException [ 1 ]: Using $this when not in object context ~ MODPATH\alioss\classes\helper\oss.php [ 55 ] in :
2013-04-07 19:37:09 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-04-07 19:37:30 --- CRITICAL: Kohana_Exception [ 0 ]: Directory must be writable:  ~ MODPATH\image\classes\kohana\image.php [ 631 ] in D:\web\ehovel\source\modules\alioss\classes\helper\oss.php:61
2013-04-07 19:37:30 --- DEBUG: #0 D:\web\ehovel\source\modules\alioss\classes\helper\oss.php(61): Kohana_Image->save('D:\web\ehovel\s...')
#1 D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php(49): Helper_Oss::generateThumb('???.gif', 10, 10)
#2 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Resource->action_upload()
#3 [internal function]: Kohana_Controller->execute()
#4 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#5 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#7 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#8 {main} in D:\web\ehovel\source\modules\alioss\classes\helper\oss.php:61
2013-04-07 19:43:06 --- CRITICAL: Kohana_Exception [ 0 ]: Directory must be writable:  ~ MODPATH\image\classes\kohana\image.php [ 631 ] in D:\web\ehovel\source\modules\alioss\classes\helper\oss.php:61
2013-04-07 19:43:06 --- DEBUG: #0 D:\web\ehovel\source\modules\alioss\classes\helper\oss.php(61): Kohana_Image->save('D:\web\ehovel\a...')
#1 D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php(49): Helper_Oss::generateThumb('???.gif', 10, 10)
#2 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Resource->action_upload()
#3 [internal function]: Kohana_Controller->execute()
#4 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#5 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#7 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#8 {main} in D:\web\ehovel\source\modules\alioss\classes\helper\oss.php:61
2013-04-07 19:49:31 --- CRITICAL: Kohana_Exception [ 0 ]: Installed GD does not support bmp images ~ MODPATH\image\classes\kohana\image\gd.php [ 109 ] in D:\web\ehovel\source\modules\image\classes\kohana\image.php:54
2013-04-07 19:49:31 --- DEBUG: #0 D:\web\ehovel\source\modules\image\classes\kohana\image.php(54): Kohana_Image_GD->__construct('C:\Windows\temp...')
#1 D:\web\ehovel\source\modules\alioss\classes\helper\oss.php(56): Kohana_Image::factory('C:\Windows\temp...')
#2 D:\web\ehovel\source\modules\resource\classes\controller\admin\resource.php(49): Helper_Oss::generateThumb('headimg.png', 30, 30)
#3 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Admin_Resource->action_upload()
#4 [internal function]: Kohana_Controller->execute()
#5 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Resource))
#6 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#8 D:\web\ehovel\source\admin.php(102): Kohana_Request->execute()
#9 {main} in D:\web\ehovel\source\modules\image\classes\kohana\image.php:54