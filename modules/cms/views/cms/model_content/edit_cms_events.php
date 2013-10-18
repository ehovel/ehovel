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
            'textarea[name="subject"]', 
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

		$('#date_from').datepicker({dateFormat:"yy-mm-dd"});
		$('#date_to').datepicker({dateFormat:"yy-mm-dd"});
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

                    <dt><label for="subject"><?php echo __('Subject');?><span class="require">*</span></label></dt>
                    <dd>
                        <textarea name="subject" id="subject" class="kind required"
                                  maxlength="65536"><?php echo !empty($model_content->individual_data) ? $model_content->individual_data->subject : '';?></textarea>
                    </dd>

                    <dt>
	                    <label for="location_country">
	                        <?php echo __('Location Country'); ?>/
	                        <?php echo __('Location City'); ?>
	                        <span class="require">*</span>
	                    </label>
                    </dt>
                    <dd>
                    	<?php $areas = EHOVEL::model('area')->where('level','=', 1)->where('active','=','Y')->find_all(); ?>
                        <select name="location_country" id="location_country" class="required">
                            <?php if (isset($areas)) foreach($areas as $area):?>
                            	<option value="<?php echo $area->name;?>" <?php echo (isset($event["location_country"]) && $event["location_country"]==$area->name)?'selected':''?>>
                            		<?php echo $area->prefix_string().$area->name;?>
                            	</option>
                            <?php endforeach;?>
                        </select>/
                        <input type="text" id="location_city" name="location_city" class="small" size="50" value="<?php isset($event["location_city"]) && print($event["location_city"]);?>"/>
                    </dd>

					<dt><label for="date_from"><?php echo __('Date From');?><span class="require">*</span></label></dt>
					<dd>
						<input type="text" id="date_from" name="date_from"
							value="<?php echo !empty($model_content->individual_data)?substr($model_content->individual_data->date_from, 0, 10):date('Y-m-d', time());?>"
							size="10" class="required text"
							style="background-color:#f1f1f1" readonly="true"/>
					</dd>

					<dt><label for="date_to"><?php echo __('Date To');?></label></dt>
					<dd>
						<input type="text" id="date_to" name="date_to"
							value="<?php echo !empty($model_content->individual_data)?substr($model_content->individual_data->date_to, 0, 10):date('Y-m-d', time()+86400);?>"
							size="10" class="text"
							style="background-color:#f1f1f1" readonly="true"/>
					</dd>
                    
                    <dt><label for="website"><?php echo __('Website'); ?></label></dt>
                    <dd>
                        <input type="text" id="website" name="website" class="big" size="255"
                        	value="<?php echo !empty($model_content->individual_data)?$model_content->individual_data->website:"";?>"/>
                    </dd>
                    
                    <dt><label for="contact"><?php echo __('Contact'); ?><span class="require">*</span></label></dt>
                    <dd>
                        <input type="text" id="contact" name="contact" class="big" size="255"
                        	value="<?php echo !empty($model_content->individual_data)?$model_content->individual_data->contact:"";?>"/>
                    </dd>
                    
                    <dt><label for="email"><?php echo __('Email'); ?></label></dt>
                    <dd>
                        <input type="text" id="email" name="email" class="big" size="255"
                        	value="<?php echo !empty($model_content->individual_data)?$model_content->individual_data->email:""; ?>"/>
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
