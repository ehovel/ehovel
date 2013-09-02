<?php defined('SYSPATH') or die('No direct script access.'); ?>
<script type="text/javascript" src="<?php echo STATICS_BASE_URL;?>js/jquery.validate.js"></script>
<script type="text/javascript">
    jQuery(function($) {
        $('#myForm').validate({
            rules: {
                name:{
                    remote:'<?php echo EHOVEL::url('site_link/name_exist');?>'
                }
            },
            messages: {
                name:{
                    remote:'<?php echo __('Name cannot be repeated');?>'
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
        <h1><?php echo __('Add Site Link');?></h1>

        <form class="uniform" id="myForm" action="<?php echo url::current(true);?>" method="post" enctype="multipart/form-data">
            <dl class="inline">
                <dt><label for="name"><?php echo __('Name');?><span class="require">*</span></label></dt>
                <dd><input type="text" name="name" id="name" class="medium required" maxlength="255"/></dd>
				
				<dt><label for="name"><?php echo __('Title');?></label></dt>
                <dd><input type="text" name="title" id="title" class="medium" maxlength="255"/></dd>
                
				<dt><label for="name"><?php echo __('key');?></label></dt>
                <dd><input type="text" name="key" id="key" class="medium" maxlength="255" value=""></dd>

                <dt><label for="href"><?php echo __('URL');?></label></dt>
                <dd><input type="text" name="href" id="href" class="medium" maxlength="255" value="http://"/></dd>

                <!--<dt><label for="image"><?php echo __('Icon');?></label></dt>
                <dd>
                    <div id="image"<?php if (empty($link->image)) { ?> style="display:none"<?php } ?>>
                        <img src="<?php echo EHOVEL::upload_url($link->image, '180x180'); ?>"/>
                        <input type="hidden" name="image" value="<?php echo htmlspecialchars($link->image); ?>"/>
                    </div>
                    <button id="upload_image" type="button" class="button tiny"><?php echo __('Upload'); ?></button>
                    <small><?php echo __('Extension available:gif, png, jpg, jpeg');?></small>
                </dd>

                --><dt><label for="position"><?php echo __('Position');?></label></dt>
                <dd><input type="text" name="position" id="position" class="small digits" maxlength="255"/></dd>
            </dl>
            <div class="buttons">
                <button type="submit" class="button big"><?php echo __('Save');?></button>
                <?php echo html::cancel_anchor(EHOVEL::url('site_link')); ?>
            </div>
        </form>
    </article>
</section>

<?php
    echo EHOVEL::upload(array(
        'id'           => 'image',
        'type'         => 'link',
        'postfixs'     => 'jpg|jpeg|gif|png',
        'url_size'     => '180x180',
        'multi'        => FALSE,
        'bind'         => '#upload_image',
        'save_handler' => 'uploadImage',
    ));
?>
