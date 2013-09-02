<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Admin</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="expires" content="0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <?php echo EHOVEL::css('style');?>
    <!--[if lte IE 8]>
    <?php echo EHOVEL::js('html5');?>
    <![endif]-->
    <?php echo EHOVEL::js('jquery-1.4.4.min');?>
    <?php echo EHOVEL::js('cufon-yui');?>
    <?php echo EHOVEL::js('Delicious_500.font');?>
    <?php echo EHOVEL::js('jquery.validate');?>
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

<header id="top">
    <div class="container_12 clearfix">
        <div id="logo" class="grid_12">
            <!-- replace with your website title or logo -->
            <a id="site-title" href="<?php echo EHOVEL::url('index');?>" title="Bizark E-commerce System"><span>BES</span></a>
            <a id="view-site" href="/" target="_blank"><?php echo __('View Site');?></a>
        </div>
    </div>
</header>

<div id="login" class="box">
    <h2><?php echo __('Login');?></h2>
    <section>
        <?php Message::render();?>
        <form id="myForm" method="post" action="<?php echo Request::$current->url();?>">
            <input type="hidden" value="<?php echo $formtoken;?>" name="formhash">
            <dl>
                <dt><label for="username"><?php echo __('Username');?></label></dt>
                <dd><input class="required" maxlength="40" id="username" name="username" type="text" value="<?php echo $username;?>"/></dd>

                <dt><label for="adminpassword"><?php echo __('Password');?></label></dt>
                <dd><input class="required" id="adminpassword" minlength="6" maxlength="30" name="adminpassword" type="password"/></dd>
            </dl>
            <label><input type="checkbox" name="remember" value="1"/><?php echo __('Remember username');?></label>

            <p>
                <button type="submit" class="button gray" id="loginbtn"><?php echo __('Login');?></button>
                <!--<a id="forgot" href="#">Forgot Password?</a>-->
            </p>
        </form>
    </section>
</div>

</body>
</html>
<script type="text/javascript">
if(typeof jQuery.validator != 'undefined')
{
    jQuery.extend(jQuery.validator.messages, {
        required: "<?php echo __('This field is required.')?>",
        username: "<?php echo __('Please enter no more than {0} characters.');?>",
        date: "<?php echo __('Please enter a valid date.');?>",
        number: "<?php echo __('Please enter a valid number.');?>",
        digits: "<?php echo __('Please enter only digits.');?>",
        url:"<?php echo __('Please enter a valid URL.');?>",
        maxlength: jQuery.validator.format("<?php echo __('Please enter no more than {0} characters.');?>"),
        minlength: jQuery.validator.format("<?php echo __('Please enter at least {0} characters.');?>"),
        rangelength: jQuery.validator.format("<?php echo __('Please enter a value between {0} and {1} characters long.');?>"),
        range: jQuery.validator.format("<?php echo __('Please enter a value between {0} and {1}.');?>"),
        max: jQuery.validator.format("<?php echo __('Please enter a value less than or equal to {0}.');?>"),
        min: jQuery.validator.format("<?php echo __('Please enter a value greater than or equal to {0}.');?>")
    });
}
</script>
