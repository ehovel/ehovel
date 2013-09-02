<?php defined('SYSPATH') or die('No direct script access.'); ?>
<script type="text/javascript" src="<?php echo STATICS_BASE_URL;?>js/jquery.validate.js"></script>
<?php echo EHOVEL::js('jquery.validate'); ?>
<script type="text/javascript">
    jQuery(function($) {
        $('#myForm').validate({
            onkeyup: false,
            rules: {
                name: {
                    required: true,
                    maxlength: 255,
                    remote: '<?php echo EHOVEL::url('currency/name_exist'); ?>'
                },
                domain:{
                    maxlength: 255
                },
                description: {
                    maxlength: 255
                }
            },
            messages: {
                name: {
                    remote: '<?php echo __('Name can not be repeated'); ?>'
                }
            }
        });
    });
        function uploadImage(image) {
            $('#image').show();
            $('#image').find('img').attr('src', image['url_180x180']);
            $('#image').find('input').val(image['uri']);
        }
</script>

<section class="container_12 clearfix">
    <?php remind::render_current();?>
    <article>
        <h1><?php echo __('Add Store Address');?></h1>

        <form class="uniform" id="myForm" action="<?php echo url::current(true);?>" method="post"
              enctype="multipart/form-data">
            <dl class="inline">
                <dt><label for="store_name"><?php echo __('Name');?><span class="require">*</span></label></dt>
                <dd><input type="text" name="store_name" id="store_name" class="medium required" maxlength="20"/></dd>

                <dt><label for="is_default"><?php echo __('is_Default');?></label></dt>
                <dd>
                    <select name="is_default" id="is_default">
                        <option value="Y"><?php echo __('Yes');?></option>
                        <option value="N" selected="selected"><?php echo __('No');?></option>
                    </select>
                </dd>
                
                <dt><label for="is_active"><?php echo __('is_Active');?></label></dt>
                <dd>
                    <select name="is_active" id="is_active">
                        <option value="Y" selected="selected"><?php echo __('Yes');?></option>
                        <option value="N"><?php echo __('No');?></option>
                    </select>
                </dd>
                
                <dt><label for="is_active"><?php echo __('Store Warning Num');?></label></dt>
                <dd>
                    <input type="text" name="store_warning" id="store_warning" class="small required digits" maxlength="20"/>
                </dd>
                
            </dl>
            <div class="buttons">
                <button type="submit" class="button big"><?php echo __('Save');?></button>
                <?php echo html::cancel_anchor(EHOVEL::url('site_currency')); ?>
            </div>
        </form>
    </article>
</section>

<?php
    echo EHOVEL::upload(array(
        'id'           => 'image',
        'type'         => 'currency',
        'postfixs'     => 'jpg|jpeg|gif|png',
        'url_size'     => '180x180',
        'multi'        => FALSE,
        'bind'         => '#upload_image',
        'save_handler' => 'uploadImage',
    ));
?>