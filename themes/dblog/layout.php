<?php defined('SYSPATH') OR die('No direct script access allowed.'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="<?php echo $statics_url; ?>css/bootstrap.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo $statics_url; ?>css/core.css" type="text/css" />
    </head>
    <body>
    	<!--header bar-->
		<div class="navbar navbar-inverse navbar-fixed-top">
	      <div class="navbar-inner">
	        <div class="container">
	          <a href="/" class="brand">DPX</a>
	          <div class="nav-collapse collapse">
	            <ul class="nav">
	              <li class="">
	                <a href="./index.html">Home</a>
	              </li>
	              <li class="active">
	                <a href="/category">Category</a>
	              </li>
	              <li class="active">
	                <a href="/article">Article</a>
	              </li>
	            </ul>
	          </div>
	        </div>
	      </div>
	    </div>
	    <div class="content container">
		<!--header-->
		<?php echo !empty($header) ? $header : ''; ?>
	    <div class="container">
	    	<?php echo !empty($content) ? $content : ''; ?>
        </div>
        <?php echo !empty($footer) ? $footer : ''; ?>
        </div>
        <script src="<?php echo $statics_url; ?>js/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo $statics_url; ?>js/bootstrap.js" type="text/javascript"></script>
    </body>
</html>
