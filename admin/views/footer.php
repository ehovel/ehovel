<?php defined('SYSPATH') OR die('No direct script access allowed.'); ?>
<hr>
<footer id="bottom">
	<div class="navbar navbar-fixed-bottom hidden-phone" id="status">
		<div class="btn-toolbar">
			<div class="btn-group pull-right">
				<p>Copyright &copy; <?php echo date('Y',time())?> <a href="http://www.ehovel.com">ehovel.com</a></p>
			</div>
			<div class="btn-group viewsite">
				<a target="_blank" href="http://www.joomla-local-1.com/"><i class="icon-share-alt"></i> 浏览网站</a>
			</div>
			<div class="btn-group divider"></div>
			<div class="btn-group loggedin-users">无用户登录前台</div>
			<div class="btn-group divider"></div>
			<div class="btn-group backloggedin-users">
				<span class="label">1</span> 位管理员登录后台
			</div>
			<div class="btn-group divider"></div>
			<div class="btn-group no-unread-messages">
				<a href="/administrator/index.php?option=com_messages"><i class="icon-envelope"></i> 无消息<span class="label label-success hidden-phone">9</span></a>
			</div>
			<div class="btn-group divider"></div>
			<div class="btn-group no-unread-messages">
				<a href="#"><i class="icon-warning-sign"></i><span class="hidden-phone hidden-tablet"> 通知</span> <span class="label label-important hidden-phone">2</span> <span class="label label-success hidden-phone">11</span></a>
			</div>
			<div class="btn-group divider"></div>
			<div class="btn-group logout">
				<a href="/administrator/index.php?option=com_login&amp;task=logout&amp;d623866c18f7814c4bf24a8afd8f90e8=1"><i class="icon-minus-sign"></i> 退出</a>
			</div>
		</div>
	</div>
</footer>
<div class="panel retracted">
    <div class="panel-content filler">
        <div class="panel-logo"></div>
        <div class="panel-header">
            <h1><small>Input Fields</small></h1>
            <button class="btn btn-mini" type="submit"><i class="icon-photon move_alt2"></i> Add New</button>
        </div>
        <div class="panel-search container-fluid">
            <form action="javascript:;" class="form-horizontal">
                <input type="text" name="panelSearch" placeholder="Search" id="panelSearch" class="ui-autocomplete-input" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
                <button class="btn btn-search"></button>
            </form>
        </div>
        <div class="sidebarMenuHolder mCustomScrollbar _mCS_1" style="height: 283px;"><div class="Jstree_shadow_top"></div><div style="position:relative; height:100%; overflow:hidden; max-width:100%;" id="mCSB_1" class="mCustomScrollBox">
        	<div style="position:relative; top:0;" class="mCSB_container mCS_no_scrollbar"></div>
    		<div style="position: absolute; display: none;" class="mCSB_scrollTools"><a style="display:block; position:relative;" class="mCSB_buttonUp"></a>
    		<div style="position:relative;" class="mCSB_draggerContainer"><div style="position: absolute; top: 0px; height: 137px;" class="mCSB_dragger ui-draggable"><div style="position: relative; line-height: 137px;" class="mCSB_dragger_bar"></div></div><div class="mCSB_draggerRail"></div></div><a style="display:block; position:relative;" class="mCSB_buttonDown"></a></div></div><div class="Jstree_shadow_bottom"></div>
    	</div>    
    </div>
    <div class="panel-slider">
        <div class="panel-slider-center">
            <div class="panel-slider-arrow"></div>
        </div>
    </div>
</div>
<?php //ProfilerToolbar::render(true); ?>