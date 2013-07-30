<?php defined('SYSPATH') OR die('No direct access allowed.');?>
<div class="row">
	<div class="span6">
		<form id="add_form" name="add_form" method="post" action="<?php echo EHOVEL::admin_base_url()?>resource/edit/<?php echo $resource['id'];?>" class="form-horizontal">
			<input type="hidden" name="resource_id" value="<?php echo isset($resource['id']) ? $resource['id'] : 0; ?>"/>
			<fieldset>
				<legend><?php echo __('编辑资源信息');?></legend>
			<div class="control-group">
				<label class="control-label" for="inputEmail"><img src="<?php echo $resource['is_storage']?Helper_Resource::get_img(array($resource['attach_id'],$resource['postfix'])):$resource['link']; ?>" style="max-height:120px; max-width:120px"/></label>
				<div class="controls">
					<div>作者：<?php echo isset($resource['manager_name']) ? $resource['manager_name'] : ''; ?></div>
		            <div>时间：<?php echo isset($resource['date_add']) ? $resource['date_add'] : ''; ?></div>
		            <div>大小：<?php echo isset($resource['byte']) ? $resource['byte'] : ''; ?></div>
				</div>
			</div>
			</fieldset>
			<div class="control-group">
				<label class="control-label" for="inputEmail">标题</label>
				<div class="controls">
					<input name="eform[title]" type="text" class="input_text medium" maxlength="255" value="<?php echo isset($resource['title']) ? $resource['title'] : ''; ?>"/>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="inputEmail">替代文本</label>
				<div class="controls">
					<input name="eform[alter]" type="text" class="input_text medium" maxlength="1024" value="<?php echo isset($resource['alter']) ? $resource['alter'] : ''; ?>"/>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="inputEmail">说明</label>
				<div class="controls">
					<input name="eform[introduction]" type="text" class="input_text big" style="" maxlength="1024" value="<?php echo isset($resource['introduction']) ? $resource['introduction'] : ''; ?>"/>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="inputEmail">描述</label>
				<div class="controls">
					<textarea class="textarea big" name="eform[description]"><?php echo isset($resource['description']) ? $resource['description'] : ''; ?></textarea>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="inputEmail">&nbsp;</label>
				<div class="controls">
<<<<<<< Updated upstream
					<input type="submit" id="submit_button" name="button" class="btn btn-primary" value="保存"/>
=======
					<input type="submit" id="submit_button" name="button" class="btn btn-success" value="保存"/>
>>>>>>> Stashed changes
		            <input class="btn" type="button" onclick="facyboxclose()" value="取消"/>
				</div>
			</div>
		</form>
</div>
</div>