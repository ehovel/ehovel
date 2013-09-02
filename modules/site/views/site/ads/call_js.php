<?php 
$domain = isset($_SERVER['HTTP_X_FORWARDED_HOST']) ?
            $_SERVER['HTTP_X_FORWARDED_HOST'] :
            (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '');
$direct = EHOVEL::config('site_js.direct');
?>

<li><B><?php echo __('Call JS Explain');?></B></br>
<font color="gray">
<?php echo __('1、Call a server environment means no special requirements, but consumption server resources, access speed is slow, does not support Google and JS code of advertising;');?></br>
<?php echo __('2、Call way two on the server environment no special requirements, consume less server resources, access speed, but not to be automatic judgment advertising validity, want to often update js. Don\'t support Google and JS code of advertising;');?></br>
<?php echo __('3、Call Google and baidu code such as advertising, can use only one way. When a website is the use of a static page, modify the AD code please update advertising in the static page;');?></br>
<?php echo __('4、Choose according to oneself circumstance a call way, and then copy paste the calling code to display advertising templates to update the pages can.');?></br>

</font>
</li>
</br>

<li><B><?php echo __('Call JS Fst Method');?></B></br>
<?php echo __('JS Call Code');?><?php echo __('(PHP Method)');?></br>
<div>	
	<input type="text" style="width:800px;height:20px" name="link_address" id="link_address_2" class="medium" maxlength="255" value="<<?php echo "script language="?>&quot;<?php echo "javascript"?>&quot; <?php echo "src="?>&quot;<?php echo 'http://'.$domain.EHOVEL::url('ads/show_poster',array('id'=>$id,'type'=>$type,'spaceid'=>$spaceid),'default_front');?>&quot;></<?php echo "script";?>>">
</div>
</li>
</br> 

<li><B><?php echo __('Call JS Sec Method');?></B>(<font color="red"><?php echo __('Recommend');?></font>)</br>
<?php echo __('JS Call Code')?><?php echo __('(JS Method)');?></br>
<div>	
	<input type="text" style="width:800px;height:20px" name="link_address" id="link_address_1" class="medium" maxlength="255" value="<<?php echo "script language="?>&quot;<?php echo "javascript"?>&quot; <?php echo "src="?>&quot;<?php echo 'http://'.$domain.EHOVEL::config('site_js.path');if(!empty($space_info->path)){echo $space_info->path;}?>&quot;></<?php echo "script";?>>">
</div>
</li>