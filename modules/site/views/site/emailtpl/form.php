<?php defined('SYSPATH') or die('No direct script access.'); ?>
<?php echo EHOVEL::js('jquery.validate');?>
<?php echo EHOVEL::js('kindediter/kindeditor');?>
<?php echo EHOVEL::js('kindediter/lang/zh_CN');?>
<?php echo EHOVEL::js('kindediter/plugins/code/prettify');?>
<link rel="stylesheet" href="<?php echo STATICS_BASE_URL;?>/js/kindediter/themes/default/default.css" />
<link rel="stylesheet" href="<?php echo STATICS_BASE_URL;?>/js/kindediter/plugins/code/prettify.css" />
<script type="text/javascript">
    KindEditor.ready(function(K) {
        var editor = K.create(
            'textarea[name="content"]', 
            {cssPath: "<?php echo STATICS_BASE_URL;?>/js/kindediter/plugins/code/prettify.css",
            uploadJson: "/admin/kindediter/upload",
            fileManagerJson: "/admin/kindediter/filemanager",
            allowFileManager: "1"
            });
        prettyPrint();
        $(".button").mouseover(function() {
            editor.sync();
        });
    });
    jQuery(function($) {
        $('#myForm').validate({
            onkeyup: false
        });
    });
</script>
<section class="container_12 clearfix">
    <?php remind::render_current();?>
    <article>
        <h1><?php echo !empty($tpl) ? __('Edit Email Template') : __('Add New Email Template'); ?></h1>

        <form class="uniform" id="myForm" action="<?php echo url::current(true);?>" method="post">
            <dl class="inline">
                <dt><label for="name"><?php echo __('Name');?></label></dt>
                <dd><?php echo htmlspecialchars($tpl->name); ?></dd>
                <dt><label for="title"><?php echo __('Subject');?><span class="require">*</span></label></dt>
                <dd><input type="text" name="title" id="title" class="medium required" maxlength="255" value="<?php echo !empty($tpl) ? htmlspecialchars($tpl->title) : ''; ?>"/></dd>
                
                <dt><label for="title"><?php echo __('Content');?><span class="require">*</span></label></dt>
                    <dd>
                        <textarea name="content" id="content" class="kind required"
                                  maxlength="65536"><?php echo !empty($tpl) ? htmlspecialchars($tpl->content) : ''; ?></textarea>
                    </dd>
                
            </dl>
            <div class="buttons">
                <button type="submit" class="button big"><?php echo __('Save');?></button>
                <?php echo html::cancel_anchor(EHOVEL::url('site_emailtpl')); ?>
            </div>
        </form>
    </article>
</section>