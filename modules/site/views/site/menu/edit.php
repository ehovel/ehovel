<?php defined('SYSPATH') or die('No direct script access.'); ?>
<?php echo EHOVEL::js('jquery.validate')?>
<script type="text/javascript">
    jQuery(function($) {
        $('#myForm').validate();
    });
    jQuery.validator.addMethod("checkKey", function(value, element) {
        var myreg = /^([a-zA-Z0-9]+[_|\_|\.|-]?)*([a-zA-Z0-9]+[_|\_|\.|-]?)$/;
        if (value != '') {
            if (!myreg.test(value)) {
                return false;
            }
        }
        ;
        return true;
    }, '<?php echo __('Can contain only alphanumeric and "-" and "_", can not use spaces');?>');
</script>
<section class="container_12 clearfix">
    <?php remind::render_current();?>
    <article>
        <h1><?php echo !empty($data) ? __('Edit Site Menu') : __('Add Site Menu');?></h1>

        <form class="uniform" id="myForm" action="<?php echo url::current(true);?>" method="post">
            <dl class="inline">
                <dt><label for="key"><?php echo __('Key');?><span class="require">*</span></label></dt>
                <dd>
                <input type="text" name="key" id="key" <?php if(!empty($data)):?> disabled="disabled" <?php endif;?>class="medium checkKey required" maxlength="255"
                           value="<?php echo !empty($data) ? $data->key : '';?>"/>
                    <small><?php echo __('Can contain only alphanumeric and "-" and "_", can not use spaces');?></small>
                </dd>

                <dt><label for="name"><?php echo __('Name');?><span class="require">*</span></label></dt>
                <dd><input type="text" name="name" id="name" class="medium required" maxlength="255"
                           value="<?php echo !empty($data) ? $data->name : '';?>"/></dd>
            </dl>
            <div class="buttons">
                <button type="submit" class="button big"><?php echo __('Next');?></button>
                <?php echo HTML::cancel_anchor(EHOVEL::url('site_menu/index'));?>
            </div>
        </form>
    </article>
</section>
