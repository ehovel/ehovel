<?php defined('SYSPATH') or die('No direct script access.'); ?>

<script type="text/javascript" src="<?php echo STATICS_BASE_URL;?>js/jquery.wysiwyg.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo STATICS_BASE_URL;?>css/jquery.wysiwyg.css">
<script type="text/javascript" src="<?php echo STATICS_BASE_URL;?>js/jquery.validate.js"></script>  
<script type="text/javascript" src="<?php echo STATICS_BASE_URL;?>js/jquery.validate.js"></script>
<?php echo EHOVEL::js('jquery.validate'); ?>
<?php echo EHOVEL::js('kindediter/kindeditor');?>
<?php echo EHOVEL::js('kindediter/lang/zh_CN');?>
<?php echo EHOVEL::js('kindediter/plugins/code/prettify');?>
<link rel="stylesheet" href="<?php echo STATICS_BASE_URL;?>/js/kindediter/themes/default/default.css" />
<link rel="stylesheet" href="<?php echo STATICS_BASE_URL;?>/js/kindediter/plugins/code/prettify.css" />
<script type="text/javascript">
    KindEditor.ready(function(K) {
        var editor = K.create('#aboutus', {
            cssPath: "<?php echo STATICS_BASE_URL;?>/js/kindediter/plugins/code/prettify.css",
            uploadJson: "<?php echo EHOVEL::url('kindediter/upload', array('type' => 'product')); ?>",
            fileManagerJson: "'<?php echo EHOVEL::url('kindediter/filemanager'); ?>",
            allowFileManager: "1"
        });
        prettyPrint();
        $('label[for="aboutus"]').parent().next().mouseover(function(){
            editor.sync();
        });
    });
</script>
<script type="text/javascript">
    jQuery(function($) {
        $('#myForm').validate({
            onkeyup: false,
            rules: {
            	aboutus: {
                    required: true,
                    maxlength: 65565
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
        <h1><?php echo __('About Us');?></h1>

        <form class="uniform" id="myForm" action="<?php echo url::current(true);?>" method="post" enctype="multipart/form-data">
             <dl class="inline">
             	<dt><label for="logo"><?php echo __('Logo');?></label></dt>
                <dd>
                    <div id="image"<?php if (empty($image)) { ?> style="display:none"<?php } ?>>
                        <img src="<?php if(isset($image)){echo EHOVEL::upload_url($image, '180x180');} ?>"/>
                        <input type="hidden" name="image" value="<?php if(isset($image)){echo htmlspecialchars($image);} ?>"/>
                    </div>
                <button id="upload_image" type="button" class="button tiny"><?php echo __('Upload'); ?></button>
                </dd>
                <dt><label for="aboutus"><?php echo __('Site Description');?><span class="require">*</span></label></dt>
                <dd><textarea id="aboutus" name="aboutus" class="big required" type="textarea" ><?php isset($aboutus) && print(htmlspecialchars($aboutus)); ?></textarea></dd>
                
            </dl>
            <div class="buttons">
                <button type="submit" class="button big"><?php echo __('Save');?></button>
            </div>
        </form>
    </article>
</section>

<?php
    echo EHOVEL::upload(array(
        'id'           => 'image',
        'type'         => 'site_config',
        'postfixs'     => 'jpg|jpeg|gif|png',
        'url_size'     => '180x180',
        'multi'        => FALSE,
        'bind'         => '#upload_image',
        'save_handler' => 'uploadImage',
    ));
?>
