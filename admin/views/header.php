<?php defined('SYSPATH') OR die('No direct script access allowed.'); ?>
<div class="navbar">
	<div class="navbar-inner-custom navbar-inner">
		<div class="container-fluid">
			<a data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse" data-toggle="collapse" class="btn btn-navbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a href="index.html" class="brand-custom"> <img width="70" src="/statics/img/logo.png" alt="Optimus Dashboard"> <span>Optimus Dashboard</span></a>
							
			<!-- start: Header Menu -->
			<div class="btn-group pull-right">
				<a href="#" class="btn">
					<i class="icon-wrench"></i><span class="hidden-phone hidden-tablet"> settings</span>
				</a>
				<!-- start: User Dropdown -->
				<a href="#" data-toggle="dropdown" class="btn dropdown-toggle">
					<i class="icon-user"></i><span class="hidden-phone hidden-tablet"> admin</span>
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><a href="#">Profile</a></li>
					<li class="divider"></li>
					<li><a href="login.html">Logout</a></li>
				</ul>
				<!-- end: User Dropdown -->
			</div>
			<!-- end: Header Menu -->
			
		</div>
	</div>
	<nav id="topmenu">
				<div class="navbar-inner">
		         		<?php echo Helper_Menu::generate_menu();?>
		    	</div>
			</nav>
	<div class="subhead-collapse">
		<div class="subhead">
			
			<div class="container-fluid">
				<div class="container-collapse" id="container-collapse"></div>
				<div class="row-fluid">
					<div class="span12">
						<?php echo isset($toolbar) ? $toolbar : '';?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="jCrumbs" class="breadCrumb module" style="display:none;">
    <ul>
        <li>
            <a href="#"><i class="icon-home"></i></a>
        </li>
        <li>
            <a href="#">Sports & Toys</a>
        </li>
        <li>
            <a href="#">Toys & Hobbies</a>
        </li>
        <li>
            <a href="#">Learning & Educational</a>
        </li>
        <li>
            <a href="#">Astronomy & Telescopes</a>
        </li>
        <li>
            Telescope 3735SX 
        </li>
    </ul>
</div>

