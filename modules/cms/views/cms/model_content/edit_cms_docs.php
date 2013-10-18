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
            uploadJson: "<?php echo EHOVEL::url('kindediter/upload', array('type'=>'cms'))?>",
            fileManagerJson: "<?php echo EHOVEL::url('kindediter/filemanager')?>",
            allowFileManager: "1"
        });
        prettyPrint();
        $(".button").mouseover(function() {
            editor.sync();
        });
    });
    jQuery(function($) {
        $('#myForm').validate();
    });
</script>
<section class="container_12 clearfix">
    <?php remind::render_current();?>
    <article>
        <h1><?php echo empty($model_content) ? 
        		str_ireplace("{1}", __($model->name), __('Add Doc'))
        		:
        		str_ireplace("{1}", __($model->name), __('Edit Doc'));?></h1>

        <form class="uniform" id="myForm" action="<?php echo url::current(true);?>" method="post">
            <fieldset>
                <legend><?php echo __('Basic Info');?></legend>
                <dl class="inline">
                    <dt><label for="category_id"><?php echo __('Category');?></label></dt>
                    <dd>
                        <select name="category_id" id='category_id' class="medium">
                        	<option value="1"><?php echo __('Select a parent category');?></option>
                            <?php foreach ($all_categories as $key => $value) { ?>
                            <?php if(isset($current_categories[$key])) :?>
                            <option value="<?php echo $key;?>" <?php echo (!empty($model_content) && $key == $model_content->category_id)
                                    ? 'selected="selected"' : '';?>><?php echo $value;?></option>
                            <?php endif;?>
                            <?php }?>
                        </select>
                    </dd>
                    <dt><label for="title"><?php echo __('Title');?><span class="require">*</span></label></dt>
                    <dd><input type="text" name="title" id="title" class="big required" maxlength="255"
                               value="<?php echo !empty($model_content) ? $model_content->title : '';?>"/></dd>

                    <dt><label for="content"><?php echo __('Content');?><span class="require">*</span></label></dt>
                    <dd>
                        <textarea name="content" id="content" class="kind required"
                                  maxlength="65536"><?php echo !empty($model_content) ? $model_content->content : '';?></textarea>
                    </dd>

                    <dt><label for="show_type"><?php echo __('Show type');?><span class="require">*</span></label></dt>
                    <dd>
                        <select name="show_type" id="show_type" class="small">
                            <option value="DEFAULT" <?php echo (!empty($model_content) && 'DEFAULT' == $model_content->show_type) ? 'selected="selected"'
                                    : '';?>><?php echo __('show Default');?></option>
                            <option value="All" <?php echo (!empty($model_content) && 'ALL' == $model_content->show_type) ? 'selected="selected"'
                                    : '';?>><?php echo __('show all content');?></option>
                            <option value="HEAD" <?php echo (!empty($model_content) && 'HEAD' == $model_content->show_type) ? 'selected="selected"'
                                    : '';?>><?php echo __('show head');?></option>
                        </select>
                    </dd>

                    <dt><label for="position"><?php echo __('Position');?></label></dt>
                    <dd><input type="text" name="position" id="position" class="tiny digits" maxlength="255"
                               value="<?php echo !empty($model_content) ? $model_content->position : 0;?>"/></dd>
                </dl>
            </fieldset>
            <fieldset>
                <legend><?php echo __('SEO');?></legend>
                <dl class="inline">
                    <dt><label for="seo_title"><?php echo __('Meta Title');?></label></dt>
                    <dd>
                        <input type="text" name="seo_title" id="seo_title" class="medium" maxlength="255" value="<?php echo !empty($model_content) ? $model_content->seo_title : '';?>"/>
                    </dd>

                    <dt><label for="seo_keywords"><?php echo __('Meta Keywords');?></label></dt>
                    <dd><input type="text" name="seo_keywords" id="seo_keywords" class="big" maxlength="255" value="<?php echo !empty($model_content) ? $model_content->seo_keywords : '';?>"/></dd>

                    <dt><label for="seo_description"><?php echo __('Meta Description');?></label></dt>
                    <dd>
                        <textarea type="text" name="seo_description" id="seo_description" class="big"
                                  maxlength="1024"><?php echo !empty($model_content) ? $model_content->seo_description : '';?></textarea>
                    </dd>
                </dl>
            </fieldset>
            <div class="buttons">
                <button type="submit" class="button big"><?php echo __('Save');?></button>
                <?php echo HTML::cancel_anchor(EHOVEL::url('cms_model/model_content_list'));?>
            </div>
        </form>
    </article>
</section>
