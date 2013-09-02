<?php defined('SYSPATH') OR die('No direct script access.'); ?>
<script type="text/javascript" src="<?php echo STATICS_BASE_URL;?>js/jquery.validate.js"></script>
<script type="text/javascript">
    jQuery(function($) {
        $('#myForm').validate();
    });
</script>
<section class="container_12 clearfix">
    <?php remind::render_current();?>
    <article>
        <h1><?php echo __('Edit Payment');?></h1>

        <form class="uniform" id="myForm" action="<?php echo url::current(true);?>" method="post">
            <dl>
                <dt><label for="name"><?php echo __('Name');?><span class="require"> *</span></label></dt>
                <dd><input type="text" name="name" id="name" class="required" maxlength="255" value="<?php echo $site->name;?>"/></dd>
                <dt><label for="domain"><?php echo __('Domain');?><span class="require"> *</span></label></dt>
                <dd><input type="text" name="domain" id="domain" class="required" maxlength="255" value="<?php echo $site->domain;?>"/></dd>
                <dt><label for="language"><?php echo __('Language');?><span class="require"> *</span></label></dt>
                <dd><input type="text" name="language" id="language" class="required" maxlength="255" value="<?php echo $site->language;?>"/></dd>
            </dl>
            <dl>
                <dt><label for="default"><?php echo __('Default');?></label></dt>
                <dd>
                    <label><input type="radio" value="Y" name="is_default" <?php echo $site->is_default=='Y'?'checked="checked"':'';?>/><?php echo __('Yes');?></label>
                    <label><input type="radio" value="N" name="is_default" <?php echo $site->is_default=='N'?'checked="checked"':'';?>/><?php echo __('No');?></label>
                </dd>
            </dl>
            <dl>
                <dt><label for="active"><?php echo __('Active');?></label></dt>
                <dd>
                    <label><input type="radio" value="Y" name="active" <?php echo $site->active=='Y'?'checked="checked"':'';?>/><?php echo __('Yes');?></label>
                    <label><input type="radio" value="N" name="active" <?php echo $site->active=='N'?'checked="checked"':'';?>/><?php echo __('No');?></label>
                </dd>
            </dl>
            <p>
                <button type="submit" class="button big"><?php echo __('Save');?></button>
                <?php echo html::cancel_anchor(EHOVEL::url('site/index')); ?>
            </p>
        </form>
    </article>
</section>
