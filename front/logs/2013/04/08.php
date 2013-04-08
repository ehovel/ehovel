<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2013-04-08 11:37:56 --- CRITICAL: ErrorException [ 4096 ]: Object of class ResponseCore could not be converted to string ~ MODPATH\resource\classes\controller\attachment.php [ 19 ] in D:\web\ehovel\source\modules\resource\classes\controller\attachment.php:19
2013-04-08 11:37:56 --- DEBUG: #0 D:\web\ehovel\source\modules\resource\classes\controller\attachment.php(19): Kohana_Core::error_handler(4096, 'Object of class...', 'D:\web\ehovel\s...', 19, Array)
#1 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Attachment->action_view()
#2 [internal function]: Kohana_Controller->execute()
#3 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Attachment))
#4 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#6 D:\web\ehovel\source\index.php(108): Kohana_Request->execute()
#7 {main} in D:\web\ehovel\source\modules\resource\classes\controller\attachment.php:19
2013-04-08 11:38:19 --- CRITICAL: ErrorException [ 4096 ]: Object of class ResponseCore could not be converted to string ~ MODPATH\resource\classes\controller\attachment.php [ 19 ] in D:\web\ehovel\source\modules\resource\classes\controller\attachment.php:19
2013-04-08 11:38:19 --- DEBUG: #0 D:\web\ehovel\source\modules\resource\classes\controller\attachment.php(19): Kohana_Core::error_handler(4096, 'Object of class...', 'D:\web\ehovel\s...', 19, Array)
#1 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Attachment->action_view()
#2 [internal function]: Kohana_Controller->execute()
#3 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Attachment))
#4 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#6 D:\web\ehovel\source\index.php(108): Kohana_Request->execute()
#7 {main} in D:\web\ehovel\source\modules\resource\classes\controller\attachment.php:19
2013-04-08 11:40:10 --- CRITICAL: ErrorException [ 1 ]: Cannot use object of type ResponseCore as array ~ MODPATH\alioss\classes\helper\oss.php [ 13 ] in :
2013-04-08 11:40:10 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-04-08 11:41:08 --- CRITICAL: ErrorException [ 4 ]: syntax error, unexpected T_STRING ~ MODPATH\resource\classes\controller\attachment.php [ 19 ] in :
2013-04-08 11:41:08 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-04-08 12:16:15 --- CRITICAL: ErrorException [ 2 ]: file_get_contents(D:\web\ehovel\source\attach\2-10x10\png) [function.file-get-contents]: failed to open stream: No such file or directory ~ MODPATH\resource\classes\controller\attachment.php [ 31 ] in :
2013-04-08 12:16:15 --- DEBUG: #0 [internal function]: Kohana_Core::error_handler(2, 'file_get_conten...', 'D:\web\ehovel\s...', 31, Array)
#1 D:\web\ehovel\source\modules\resource\classes\controller\attachment.php(31): file_get_contents('D:\web\ehovel\s...')
#2 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Attachment->action_view()
#3 [internal function]: Kohana_Controller->execute()
#4 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Attachment))
#5 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#7 D:\web\ehovel\source\index.php(108): Kohana_Request->execute()
#8 {main} in :
2013-04-08 12:16:33 --- CRITICAL: ErrorException [ 2 ]: file_get_contents(D:\web\ehovel\source\attach\2-40x40\png) [function.file-get-contents]: failed to open stream: No such file or directory ~ MODPATH\resource\classes\controller\attachment.php [ 31 ] in :
2013-04-08 12:16:33 --- DEBUG: #0 [internal function]: Kohana_Core::error_handler(2, 'file_get_conten...', 'D:\web\ehovel\s...', 31, Array)
#1 D:\web\ehovel\source\modules\resource\classes\controller\attachment.php(31): file_get_contents('D:\web\ehovel\s...')
#2 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Attachment->action_view()
#3 [internal function]: Kohana_Controller->execute()
#4 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Attachment))
#5 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#7 D:\web\ehovel\source\index.php(108): Kohana_Request->execute()
#8 {main} in :
2013-04-08 12:52:37 --- CRITICAL: ErrorException [ 2 ]: file_get_contents(D:\web\ehovel\source\attach\2-40x40\png) [function.file-get-contents]: failed to open stream: No such file or directory ~ MODPATH\resource\classes\controller\attachment.php [ 31 ] in :
2013-04-08 12:52:37 --- DEBUG: #0 [internal function]: Kohana_Core::error_handler(2, 'file_get_conten...', 'D:\web\ehovel\s...', 31, Array)
#1 D:\web\ehovel\source\modules\resource\classes\controller\attachment.php(31): file_get_contents('D:\web\ehovel\s...')
#2 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Attachment->action_view()
#3 [internal function]: Kohana_Controller->execute()
#4 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Attachment))
#5 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#7 D:\web\ehovel\source\index.php(108): Kohana_Request->execute()
#8 {main} in :
2013-04-08 12:55:19 --- CRITICAL: ErrorException [ 2 ]: file_get_contents(D:\web\ehovel\source\attach\2-40x40\png) [function.file-get-contents]: failed to open stream: No such file or directory ~ MODPATH\resource\classes\controller\attachment.php [ 31 ] in :
2013-04-08 12:55:19 --- DEBUG: #0 [internal function]: Kohana_Core::error_handler(2, 'file_get_conten...', 'D:\web\ehovel\s...', 31, Array)
#1 D:\web\ehovel\source\modules\resource\classes\controller\attachment.php(31): file_get_contents('D:\web\ehovel\s...')
#2 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Attachment->action_view()
#3 [internal function]: Kohana_Controller->execute()
#4 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Attachment))
#5 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#7 D:\web\ehovel\source\index.php(108): Kohana_Request->execute()
#8 {main} in :
2013-04-08 12:55:32 --- CRITICAL: ErrorException [ 2 ]: file_get_contents(D:\web\ehovel\source\attach\2-40x40.png) [function.file-get-contents]: failed to open stream: No such file or directory ~ MODPATH\resource\classes\controller\attachment.php [ 31 ] in :
2013-04-08 12:55:32 --- DEBUG: #0 [internal function]: Kohana_Core::error_handler(2, 'file_get_conten...', 'D:\web\ehovel\s...', 31, Array)
#1 D:\web\ehovel\source\modules\resource\classes\controller\attachment.php(31): file_get_contents('D:\web\ehovel\s...')
#2 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Attachment->action_view()
#3 [internal function]: Kohana_Controller->execute()
#4 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Attachment))
#5 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#7 D:\web\ehovel\source\index.php(108): Kohana_Request->execute()
#8 {main} in :
2013-04-08 12:55:44 --- CRITICAL: ErrorException [ 2 ]: file_get_contents(D:\web\ehovel\source\attach\2-40x40.png) [function.file-get-contents]: failed to open stream: No such file or directory ~ MODPATH\resource\classes\controller\attachment.php [ 31 ] in :
2013-04-08 12:55:44 --- DEBUG: #0 [internal function]: Kohana_Core::error_handler(2, 'file_get_conten...', 'D:\web\ehovel\s...', 31, Array)
#1 D:\web\ehovel\source\modules\resource\classes\controller\attachment.php(31): file_get_contents('D:\web\ehovel\s...')
#2 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Attachment->action_view()
#3 [internal function]: Kohana_Controller->execute()
#4 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Attachment))
#5 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#7 D:\web\ehovel\source\index.php(108): Kohana_Request->execute()
#8 {main} in :
2013-04-08 13:47:52 --- CRITICAL: Kohana_Exception [ 0 ]: Installed GD does not support bmp images ~ MODPATH\image\classes\kohana\image\gd.php [ 109 ] in D:\web\ehovel\source\modules\image\classes\kohana\image.php:54
2013-04-08 13:47:52 --- DEBUG: #0 D:\web\ehovel\source\modules\image\classes\kohana\image.php(54): Kohana_Image_GD->__construct('C:\Windows\temp...')
#1 D:\web\ehovel\source\modules\alioss\classes\helper\oss.php(71): Kohana_Image::factory('C:\Windows\temp...')
#2 D:\web\ehovel\source\modules\resource\classes\controller\attachment.php(27): Helper_Oss::generateThumb('2.png', '120', '120')
#3 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Attachment->action_view()
#4 [internal function]: Kohana_Controller->execute()
#5 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Attachment))
#6 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#8 D:\web\ehovel\source\index.php(108): Kohana_Request->execute()
#9 {main} in D:\web\ehovel\source\modules\image\classes\kohana\image.php:54
2013-04-08 13:47:55 --- CRITICAL: Kohana_Exception [ 0 ]: Installed GD does not support bmp images ~ MODPATH\image\classes\kohana\image\gd.php [ 109 ] in D:\web\ehovel\source\modules\image\classes\kohana\image.php:54
2013-04-08 13:47:55 --- DEBUG: #0 D:\web\ehovel\source\modules\image\classes\kohana\image.php(54): Kohana_Image_GD->__construct('C:\Windows\temp...')
#1 D:\web\ehovel\source\modules\alioss\classes\helper\oss.php(71): Kohana_Image::factory('C:\Windows\temp...')
#2 D:\web\ehovel\source\modules\resource\classes\controller\attachment.php(27): Helper_Oss::generateThumb('2.png', '120', '120')
#3 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Attachment->action_view()
#4 [internal function]: Kohana_Controller->execute()
#5 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Attachment))
#6 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#8 D:\web\ehovel\source\index.php(108): Kohana_Request->execute()
#9 {main} in D:\web\ehovel\source\modules\image\classes\kohana\image.php:54
2013-04-08 13:47:58 --- CRITICAL: Kohana_Exception [ 0 ]: Installed GD does not support bmp images ~ MODPATH\image\classes\kohana\image\gd.php [ 109 ] in D:\web\ehovel\source\modules\image\classes\kohana\image.php:54
2013-04-08 13:47:58 --- DEBUG: #0 D:\web\ehovel\source\modules\image\classes\kohana\image.php(54): Kohana_Image_GD->__construct('C:\Windows\temp...')
#1 D:\web\ehovel\source\modules\alioss\classes\helper\oss.php(71): Kohana_Image::factory('C:\Windows\temp...')
#2 D:\web\ehovel\source\modules\resource\classes\controller\attachment.php(27): Helper_Oss::generateThumb('2.png', '120', '120')
#3 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Attachment->action_view()
#4 [internal function]: Kohana_Controller->execute()
#5 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Attachment))
#6 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#8 D:\web\ehovel\source\index.php(108): Kohana_Request->execute()
#9 {main} in D:\web\ehovel\source\modules\image\classes\kohana\image.php:54
2013-04-08 13:51:36 --- CRITICAL: ErrorException [ 8 ]: Undefined variable: thumbPath ~ MODPATH\resource\classes\controller\attachment.php [ 41 ] in D:\web\ehovel\source\modules\resource\classes\controller\attachment.php:41
2013-04-08 13:51:36 --- DEBUG: #0 D:\web\ehovel\source\modules\resource\classes\controller\attachment.php(41): Kohana_Core::error_handler(8, 'Undefined varia...', 'D:\web\ehovel\s...', 41, Array)
#1 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Attachment->action_view()
#2 [internal function]: Kohana_Controller->execute()
#3 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Attachment))
#4 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#6 D:\web\ehovel\source\index.php(108): Kohana_Request->execute()
#7 {main} in D:\web\ehovel\source\modules\resource\classes\controller\attachment.php:41
2013-04-08 13:51:37 --- CRITICAL: ErrorException [ 8 ]: Undefined variable: thumbPath ~ MODPATH\resource\classes\controller\attachment.php [ 41 ] in D:\web\ehovel\source\modules\resource\classes\controller\attachment.php:41
2013-04-08 13:51:37 --- DEBUG: #0 D:\web\ehovel\source\modules\resource\classes\controller\attachment.php(41): Kohana_Core::error_handler(8, 'Undefined varia...', 'D:\web\ehovel\s...', 41, Array)
#1 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Attachment->action_view()
#2 [internal function]: Kohana_Controller->execute()
#3 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Attachment))
#4 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#6 D:\web\ehovel\source\index.php(108): Kohana_Request->execute()
#7 {main} in D:\web\ehovel\source\modules\resource\classes\controller\attachment.php:41
2013-04-08 13:51:37 --- CRITICAL: ErrorException [ 8 ]: Undefined variable: thumbPath ~ MODPATH\resource\classes\controller\attachment.php [ 41 ] in D:\web\ehovel\source\modules\resource\classes\controller\attachment.php:41
2013-04-08 13:51:37 --- DEBUG: #0 D:\web\ehovel\source\modules\resource\classes\controller\attachment.php(41): Kohana_Core::error_handler(8, 'Undefined varia...', 'D:\web\ehovel\s...', 41, Array)
#1 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Attachment->action_view()
#2 [internal function]: Kohana_Controller->execute()
#3 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Attachment))
#4 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#6 D:\web\ehovel\source\index.php(108): Kohana_Request->execute()
#7 {main} in D:\web\ehovel\source\modules\resource\classes\controller\attachment.php:41
2013-04-08 13:51:50 --- CRITICAL: ErrorException [ 8 ]: Undefined variable: thumbPath ~ MODPATH\resource\classes\controller\attachment.php [ 41 ] in D:\web\ehovel\source\modules\resource\classes\controller\attachment.php:41
2013-04-08 13:51:50 --- DEBUG: #0 D:\web\ehovel\source\modules\resource\classes\controller\attachment.php(41): Kohana_Core::error_handler(8, 'Undefined varia...', 'D:\web\ehovel\s...', 41, Array)
#1 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Attachment->action_view()
#2 [internal function]: Kohana_Controller->execute()
#3 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Attachment))
#4 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#6 D:\web\ehovel\source\index.php(108): Kohana_Request->execute()
#7 {main} in D:\web\ehovel\source\modules\resource\classes\controller\attachment.php:41
2013-04-08 13:51:52 --- CRITICAL: ErrorException [ 8 ]: Undefined variable: thumbPath ~ MODPATH\resource\classes\controller\attachment.php [ 41 ] in D:\web\ehovel\source\modules\resource\classes\controller\attachment.php:41
2013-04-08 13:51:52 --- DEBUG: #0 D:\web\ehovel\source\modules\resource\classes\controller\attachment.php(41): Kohana_Core::error_handler(8, 'Undefined varia...', 'D:\web\ehovel\s...', 41, Array)
#1 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Attachment->action_view()
#2 [internal function]: Kohana_Controller->execute()
#3 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Attachment))
#4 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#6 D:\web\ehovel\source\index.php(108): Kohana_Request->execute()
#7 {main} in D:\web\ehovel\source\modules\resource\classes\controller\attachment.php:41
2013-04-08 14:30:24 --- CRITICAL: ErrorException [ 1 ]: Class 'Yii' not found ~ MODPATH\resource\classes\controller\attachment.php [ 45 ] in :
2013-04-08 14:30:24 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-04-08 14:48:26 --- CRITICAL: ErrorException [ 4 ]: syntax error, unexpected T_STRING ~ MODPATH\resource\classes\controller\attachment.php [ 35 ] in :
2013-04-08 14:48:26 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-04-08 14:51:14 --- CRITICAL: ErrorException [ 8 ]: iconv() [function.iconv]: Detected an illegal character in input string ~ MODPATH\resource\classes\controller\attachment.php [ 38 ] in :
2013-04-08 14:51:14 --- DEBUG: #0 [internal function]: Kohana_Core::error_handler(8, 'iconv() [<a hre...', 'D:\web\ehovel\s...', 38, Array)
#1 D:\web\ehovel\source\modules\resource\classes\controller\attachment.php(38): iconv('gbk', 'utf-8', '????????????PHP...')
#2 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Attachment->action_view()
#3 [internal function]: Kohana_Controller->execute()
#4 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Attachment))
#5 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#7 D:\web\ehovel\source\index.php(108): Kohana_Request->execute()
#8 {main} in :
2013-04-08 14:51:35 --- CRITICAL: ErrorException [ 8 ]: iconv() [function.iconv]: Detected an illegal character in input string ~ MODPATH\resource\classes\controller\attachment.php [ 38 ] in :
2013-04-08 14:51:35 --- DEBUG: #0 [internal function]: Kohana_Core::error_handler(8, 'iconv() [<a hre...', 'D:\web\ehovel\s...', 38, Array)
#1 D:\web\ehovel\source\modules\resource\classes\controller\attachment.php(38): iconv('gbk', 'utf-8', '????????????PHP...')
#2 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Attachment->action_view()
#3 [internal function]: Kohana_Controller->execute()
#4 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Attachment))
#5 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#7 D:\web\ehovel\source\index.php(108): Kohana_Request->execute()
#8 {main} in :
2013-04-08 14:54:19 --- CRITICAL: ErrorException [ 8 ]: iconv() [function.iconv]: Detected an illegal character in input string ~ MODPATH\resource\classes\controller\attachment.php [ 38 ] in :
2013-04-08 14:54:19 --- DEBUG: #0 [internal function]: Kohana_Core::error_handler(8, 'iconv() [<a hre...', 'D:\web\ehovel\s...', 38, Array)
#1 D:\web\ehovel\source\modules\resource\classes\controller\attachment.php(38): iconv('gb2312', 'utf-8', '????????????PHP...')
#2 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Attachment->action_view()
#3 [internal function]: Kohana_Controller->execute()
#4 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Attachment))
#5 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#7 D:\web\ehovel\source\index.php(108): Kohana_Request->execute()
#8 {main} in :
2013-04-08 15:03:36 --- CRITICAL: ErrorException [ 8 ]: iconv() [function.iconv]: Detected an illegal character in input string ~ MODPATH\resource\classes\controller\attachment.php [ 38 ] in :
2013-04-08 15:03:36 --- DEBUG: #0 [internal function]: Kohana_Core::error_handler(8, 'iconv() [<a hre...', 'D:\web\ehovel\s...', 38, Array)
#1 D:\web\ehovel\source\modules\resource\classes\controller\attachment.php(38): iconv('gb2312', 'utf-8', '??????')
#2 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Attachment->action_view()
#3 [internal function]: Kohana_Controller->execute()
#4 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Attachment))
#5 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#7 D:\web\ehovel\source\index.php(108): Kohana_Request->execute()
#8 {main} in :
2013-04-08 15:04:19 --- CRITICAL: ErrorException [ 8 ]: iconv() [function.iconv]: Detected an illegal character in input string ~ MODPATH\resource\classes\controller\attachment.php [ 38 ] in :
2013-04-08 15:04:19 --- DEBUG: #0 [internal function]: Kohana_Core::error_handler(8, 'iconv() [<a hre...', 'D:\web\ehovel\s...', 38, Array)
#1 D:\web\ehovel\source\modules\resource\classes\controller\attachment.php(38): iconv('gb2312', 'ISO-8859-1', '??????')
#2 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Attachment->action_view()
#3 [internal function]: Kohana_Controller->execute()
#4 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Attachment))
#5 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#7 D:\web\ehovel\source\index.php(108): Kohana_Request->execute()
#8 {main} in :
2013-04-08 15:04:57 --- CRITICAL: ErrorException [ 8 ]: iconv() [function.iconv]: Detected an illegal character in input string ~ MODPATH\resource\classes\controller\attachment.php [ 38 ] in :
2013-04-08 15:04:57 --- DEBUG: #0 [internal function]: Kohana_Core::error_handler(8, 'iconv() [<a hre...', 'D:\web\ehovel\s...', 38, Array)
#1 D:\web\ehovel\source\modules\resource\classes\controller\attachment.php(38): iconv('gb2312', 'UTF-8', '???????????????')
#2 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Attachment->action_view()
#3 [internal function]: Kohana_Controller->execute()
#4 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Attachment))
#5 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#7 D:\web\ehovel\source\index.php(108): Kohana_Request->execute()
#8 {main} in :
2013-04-08 15:04:59 --- CRITICAL: ErrorException [ 8 ]: iconv() [function.iconv]: Detected an illegal character in input string ~ MODPATH\resource\classes\controller\attachment.php [ 38 ] in :
2013-04-08 15:04:59 --- DEBUG: #0 [internal function]: Kohana_Core::error_handler(8, 'iconv() [<a hre...', 'D:\web\ehovel\s...', 38, Array)
#1 D:\web\ehovel\source\modules\resource\classes\controller\attachment.php(38): iconv('gb2312', 'UTF-8', '???????????????')
#2 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Attachment->action_view()
#3 [internal function]: Kohana_Controller->execute()
#4 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Attachment))
#5 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#7 D:\web\ehovel\source\index.php(108): Kohana_Request->execute()
#8 {main} in :
2013-04-08 15:07:42 --- CRITICAL: ErrorException [ 8 ]: iconv() [function.iconv]: Detected an illegal character in input string ~ MODPATH\resource\classes\controller\attachment.php [ 38 ] in :
2013-04-08 15:07:42 --- DEBUG: #0 [internal function]: Kohana_Core::error_handler(8, 'iconv() [<a hre...', 'D:\web\ehovel\s...', 38, Array)
#1 D:\web\ehovel\source\modules\resource\classes\controller\attachment.php(38): iconv('GBK', 'UTF-8', '???????????????')
#2 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Attachment->action_view()
#3 [internal function]: Kohana_Controller->execute()
#4 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Attachment))
#5 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#7 D:\web\ehovel\source\index.php(108): Kohana_Request->execute()
#8 {main} in :
2013-04-08 15:07:43 --- CRITICAL: ErrorException [ 8 ]: iconv() [function.iconv]: Detected an illegal character in input string ~ MODPATH\resource\classes\controller\attachment.php [ 38 ] in :
2013-04-08 15:07:43 --- DEBUG: #0 [internal function]: Kohana_Core::error_handler(8, 'iconv() [<a hre...', 'D:\web\ehovel\s...', 38, Array)
#1 D:\web\ehovel\source\modules\resource\classes\controller\attachment.php(38): iconv('GBK', 'UTF-8', '???????????????')
#2 D:\web\ehovel\source\system\classes\kohana\controller.php(84): Controller_Attachment->action_view()
#3 [internal function]: Kohana_Controller->execute()
#4 D:\web\ehovel\source\system\classes\kohana\request\client\internal.php(97): ReflectionMethod->invoke(Object(Controller_Attachment))
#5 D:\web\ehovel\source\system\classes\kohana\request\client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 D:\web\ehovel\source\system\classes\kohana\request.php(990): Kohana_Request_Client->execute(Object(Request))
#7 D:\web\ehovel\source\index.php(108): Kohana_Request->execute()
#8 {main} in :