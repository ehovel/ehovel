<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2013-03-10 20:02:39 --- CRITICAL: Kohana_Exception [ 0 ]: A valid cookie salt is required. Please set Cookie::$salt. ~ SYSPATH\classes\kohana\cookie.php [ 152 ] in D:\web\ehovel\source\system\classes\kohana\cookie.php:67
2013-03-10 20:02:39 --- DEBUG: #0 D:\web\ehovel\source\system\classes\kohana\cookie.php(67): Kohana_Cookie::salt('session', NULL)
#1 D:\web\ehovel\source\system\classes\kohana\request.php(155): Kohana_Cookie::get('session')
#2 D:\web\ehovel\source\index.php(106): Kohana_Request::factory()
#3 {main} in D:\web\ehovel\source\system\classes\kohana\cookie.php:67
2013-03-10 20:02:39 --- CRITICAL: Kohana_Exception [ 0 ]: A valid cookie salt is required. Please set Cookie::$salt. ~ SYSPATH\classes\kohana\cookie.php [ 152 ] in D:\web\ehovel\source\system\classes\kohana\cookie.php:67
2013-03-10 20:02:39 --- DEBUG: #0 D:\web\ehovel\source\system\classes\kohana\cookie.php(67): Kohana_Cookie::salt('session', NULL)
#1 D:\web\ehovel\source\system\classes\kohana\request.php(155): Kohana_Cookie::get('session')
#2 D:\web\ehovel\source\index.php(106): Kohana_Request::factory()
#3 {main} in D:\web\ehovel\source\system\classes\kohana\cookie.php:67