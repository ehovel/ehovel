<?php defined('SYSPATH') or die('No direct script access.'); ?>
<?php echo EHOVEL::js('jquery.validate');?>
<script type="text/javascript">
    jQuery(function($) {
        $('#myForm').validate({
            rules: {
                password: {
                    equalTo: "#current_password"
                }
            }
        });
    });
</script>
<section class="container_12 clearfix">
        <?php remind::render_current();?>
        <section id="main">
            <article>
                <h1><?php echo __('Change Password');?></h1>
    <form class="uniform" id="myForm" action="<?php echo url::current(true);?>" method="post">
                <dl class="inline">
                    <dt><label for="email"><?php echo __('Email');?></label></dt>
                    <dd><input type="text" name="email" id="email" disabled="disabled" class="medium required email" maxlength="255" value="<?php echo $data->email;?>"/>
                    </dd>

                    <dt><label for="old_password"><?php echo __('Old Password');?><span class="require">*</span></label></dt>
                    <dd><input type="password" name="old_password" id="old_password" class="medium required" minlength='6' maxlength="30"/>
                    </dd>

                    <dt><label for="current_password"><?php echo __('Password');?><span class="require">*</span></label></dt>
                    <dd><input type="password" name="current_password" id="current_password" class="medium required" minlength="6" maxlength="30"/>
                        <small><?php echo __('Password length greater than 6 less than 30.');?></small>
                    </dd>

                    <dt><label for="password"><?php echo __('Confirm Password');?><span class="require">*</span></label></dt>
                    <dd><input type="password" name="password" id="password" class="medium required" minlength="6" maxlength="30"/>
                    </dd>
                </dl>
                <div class="buttons">
                    <button type="submit" class="button big"><?php echo __('Save');?></button>
                    <?php echo HTML::cancel_anchor(EHOVEL::url('auth_admin/index'));?>
                </div>
    </form>
            </article>
        </section>
</section>
