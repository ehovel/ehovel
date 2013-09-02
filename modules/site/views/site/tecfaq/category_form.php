<?php defined('SYSPATH') OR die('No direct script access.'); ?>
<script type="text/javascript" src="<?php echo STATICS_BASE_URL;?>js/jquery.validate.js"></script>
<script type="text/javascript">
    jQuery(function($) {
        $('#myForm').validate({
            onkeyup: false
        });
    });
</script>
<section class="container_12 clearfix">
    <?php remind::render_current();?>
    <article>
        <h1><?php echo !empty($faq_category) ? __('Edit Category') : __('Add New Category'); ?></h1>

        <form class="uniform" id="myForm" action="<?php echo url::current(true);?>" method="post">
            <dl class="inline">
                <dt><label for="name"><?php echo __('Faq category name');?><span style="color:#D40707 !important">*</span></label></dt>
                <dd>
                <input type="text" name="name" id="name" class="medium required" maxlength="32" value="<?php echo !empty($faq_category)?$faq_category->name : '';?>"/>
                </dd>
            </dl>
            <div class="buttons">
                <button type="submit" class="button big"><?php echo __('Save');?></button>
                <?php echo html::cancel_anchor(EHOVEL::url('site_faq_category')); ?>
            </div>
        </form>
    </article>
</section>
