<?php defined('SYSPATH') or die('No direct script access.'); ?>
<?php echo EHOVEL::js('jquery.validate');?>
<script type="text/javascript">
    jQuery(function($) {
        $('#myForm').validate({
            rules: {
                name:{
                    remote:'<?php echo EHOVEL::url('cms_category/available', array('cb_key' => 'name', 'id'=>!empty($category)?$category->id : 0)); ?>'
                }
            },
            messages: {
                name:{
                    remote:'<?php echo __('Name cannot be repeated');?>'
                }
            }
        });
    });
</script>
<section class="container_12 clearfix">
    <article>
        <h1><?php echo empty($category)
        	? str_ireplace("{1}", __($model->name), __('Add Doc Category'))
        	: str_ireplace("{1}", __($model->name), __('Edit Doc Category'));?></h1>

        <form class="uniform" id="myForm" action="<?php echo url::current(true);?>" method="post">
            <dl class="inline">
                <dt><label for="name"><?php echo __('Name');?><span class="require">*</span></label></dt>
                <dd><input type="text" name="name" id="name" class="medium required" maxlength="255"
                           value="<?php echo !empty($category) ? $category->name : '';?>"/></dd>

                <dt><label for="pid"><?php echo __('Parent');?></label></dt>
                <dd>
                    <select name="pid" id='pid' class="medium">
                    	<option value="1"><?php echo __('Select a parent category');?></option>
                        <?php foreach ($cms_categories as $key => $value) {
                        		if ($value->model_id == $model->id) { ?>
	                        <option value="<?php echo $value->id;?>" <?php echo (!empty($category) && $value->model_id == $category->pid) ? 'selected="selected"'
	                                : '';?>>
                        		<?php //echo $value->name; ?>
                        		<?php
                                        for ($i = 1; $i < $value->level; $i++)
                                        	echo '--';
                                    	echo $value->name;
                                ?>
	                        </option>
                        <?php }}?>
                    </select>
                </dd>

                <dt><label for="description"><?php echo __('Description');?></label></dt>
                <dd>
                    <textarea type="text" name="description" id="description" class="big" maxlength="65536"
                              rows="3"><?php echo !empty($category) ? $category->description : '';?></textarea>
                </dd>
            </dl>
            <div class="buttons">
                <button type="submit" class="btn btn-info"><?php echo __('Save');?></button>
                <?php echo HTML::cancel_anchor(EHOVEL::url('cms_category/index'));?>
            </div>
        </form>
    </article>
</section>
