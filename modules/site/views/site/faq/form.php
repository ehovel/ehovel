<?php defined('SYSPATH') OR die('No direct script access.'); ?>
<script type="text/javascript" src="<?php echo STATICS_BASE_URL;?>js/jquery.validate.js"></script>
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
        <h1><?php echo !empty($faq) ? __('Edit') : __('Add'); ?></h1>

        <form class="uniform" id="myForm" action="<?php echo url::current(true);?>" method="post">
            <dl class="inline">
                <dt><label for="category_id"><?php echo __('Faq Category');?></label></dt>
                <dd>
                    <select name="category_id" id="category_id" class="required">
                        <?php foreach($faq_categories as  $faq_category):?>
                        <option value="<?php echo $faq_category->id;?>" <?php if(!empty($faq) && $faq->category_id == $faq_category->id) echo 'selected="selected"';?>><?php echo $faq_category->name?></option>
                        <?php endforeach;?>
                    </select>
                </dd>
            </dl>
            <dl class="inline">
                <dt><label for="title"><?php echo __('Title');?><span style="color:#D40707 !important">*</span></label></dt>
                <dd>
                <input type="text" name="title" id="title" class="medium required" maxlength="256" value="<?php echo !empty($faq)?$faq->title: '';?>"/>
                </dd>
            </dl>
            <dl class="inline">
                <dt><label for="title"><?php echo __('Content');?><span class="require">*</span></label></dt>
                    <dd>
                        <textarea name="content" id="content" class="kind required"
                                  maxlength="65536"><?php echo !empty($faq)? htmlspecialchars($faq->content) : '';?></textarea>
                    </dd>
            </dl>
            <dl class="inline">
                <dt><label for="reply"><?php echo __('Reply');?><span class="require">*</span></label></dt>
                    <dd>
                        <textarea name="reply" id="reply" class="kind required ke-container" 
                        	maxlength="65536"><?php echo !empty($faq)? htmlspecialchars($faq->reply) : '';?></textarea>
                    </dd>
            </dl>
            <dl class="inline">
            	<dt><label for="status"><?php echo __('is_Active');?><span class="require">*</span></label></dt>
            	<dd>
                    <div class="radio"><span class="checked"><input type="radio"<?php if (isset($faq->status) AND $faq->status == 'CHECKED') { ?> checked="checked"<?php } ?> value="CHECKED" name="status" style="opacity: 0;"></span></div>&nbsp;审核通过 &nbsp;&nbsp;&nbsp;&nbsp;
                    <div class="radio"><span><input type="radio"<?php if (!isset($faq->status) || $faq->status == 'UNCHECKED') { ?> checked="checked"<?php } ?> value="UNCHECKED" name="status" style="opacity: 0;"></span></div>&nbsp;未审核</dd>
            </dl>
            <div class="buttons">
                <button type="submit" class="button big"><?php echo __('Save');?></button>
                <?php echo html::cancel_anchor(EHOVEL::url('site_faq')); ?>
            </div>
        </form>
    </article>
</section>
