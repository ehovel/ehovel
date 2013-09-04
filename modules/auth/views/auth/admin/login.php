<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Admin</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="expires" content="0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <?php echo EHOVEL::css('style-min');?>
    <?php echo EHOVEL::css('font-awesome');?>
    <script type="text/javascript">
        jQuery(function($) {
            $('#myForm').validate({errorPlacement: function(error, element) {  
                error.appendTo(element.parent());  
            }});
        });
    </script>
    <script type="text/javascript">
        $(function() {
            Cufon.replace('#site-title');
            $('.msg').click(function() {
                $(this).fadeTo('slow', 0);
                $(this).slideUp(341);
            });
        });
    </script>
</head>
<body>

<div id="login" class="box">
        <?php Message::render();?>
        <form id="myForm" method="post" action="<?php echo URL::current();?>">
            <input type="hidden" value="<?php echo $formtoken;?>" name="formhash">
            <!-- Login Widget -->
              <div class="login-widget login-login">
                <header class="login-header">
                  <a href="#">
                    <img src="/statics/img/acura-logo.png" alt="">
                  </a>
                </header>
                <h4 class="typo login-title">Login </h4>
                <form action="index.html">
                  <div class="form-separator form-field">
                    <div class="field-icon field-icon-left">
                      <i class="i">&#xf007;</i>
                      <input type="text" class="form form-full" placeholder="username" name="username" value="<?php echo $username;?>">
                    </div>
                  </div>
                  <div class="form-separator form-field">
                    <div class="field-icon field-icon-left">
                      <i class="i">&#xf023;</i>
                      <input type="password" class="form form-full" placeholder="Password" name="adminpassword">
                    </div>
                  </div>
                  <div class="login-submit">
                    <input type="checkbox" name="remember" value="1"/><?php echo __('Remember username');?>
                    <input value="Login" type="submit" class="btn btn-submit">
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
