<?php defined('SYSPATH') OR die('No direct script access allowed.'); ?>
<div class="row">
	you should create your custom  
	<span style="color:red;">
	<?php $path=__FILE__;$array = explode(DIRECTORY_SEPARATOR,$path);$name=array_pop($array);echo $name;?>
	</span>
	view file;
</div>