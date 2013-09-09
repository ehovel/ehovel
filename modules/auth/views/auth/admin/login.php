<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Admin</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="expires" content="0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <?php echo EHOVEL::js('jquery-1.7.2.min');?>
    <?php echo EHOVEL::js('bootstrap');?>
    <?php echo EHOVEL::css('bootstrap');?>
    <?php echo EHOVEL::css('login');?>
    <?php echo EHOVEL::css('font-awesome');?>
</head>
<body>

<div id="login" class="box">
        <form id="myForm" method="post" action="<?php echo URL::current();?>">
            <input type="hidden" value="<?php echo $formtoken;?>" name="formhash">
            <!-- Login Widget -->
              <div class="login-widget login-login">
                <header class="login-header">
                  <a href="#">
                    <img src="/statics/img/acura-logo.png" alt="">
                  </a>
                </header>
                <?php Message::render();?>
                <h4 class="typo login-title">Login </h4>
                <form action="index.html">
                  <div class="form-separator form-field">
                    <div class="field-icon field-icon-left">
                      <div class="input-prepend">
                          <span class="add-on"><i class="icon-user"></i></span>
                          <input type="text" class="form form-full" placeholder="username" name="username" value="<?php echo $username;?>" />
                      </div>
                    </div>
                  </div>
                  <div class="form-separator form-field">
                    <div class="field-icon field-icon-left">
                      <div class="input-prepend">
                          <span class="add-on"><i class="icon-lock"></i></span>
                          <input type="password" class="form form-full" placeholder="Password" name="adminpassword" />
                      </div>
                    </div>
                  </div>
                  <div class="login-submit">
                    <input class="checkbox" type="checkbox" name="remember" value="1"/> <?php echo __('Remember username');?>
                    <input value="Login" type="submit" class="btn btn-info">
                  </div>
                </form>
                <footer class="login-footer">
                  Copyright © 2012-2013 Mahieddine Abdelkader.
                </footer>
              </div>

        </form>
</div>

</body>
</html>
