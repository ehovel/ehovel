<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php
/* 返回的主体数据 */
$return_data = $return_struct['content'];
$catalog_list = isset($return_data['catalog_list']) ? $return_data['catalog_list'] : '';
?>
<form id="add_form" name="add_form" method="post" action="<?php echo url::base() ?>resource_catalog/do_add">
    <dl class="forms clearfix">
        <dt class="label"><label class="forms_label">文件夹名称<span class="fields_state">*</span></label></dt>
        <dd class="fields">
            <input type="text" id="name" name="name" class="input_text medium required" maxlength="255"/>
        </dd>
        <dt class="label"><label class="forms_label">上级</label></dt>
        <dd class="fields">
            <select name="parent_id" id="parent_id" class="input_text small">
                <?php echo $catalog_list; ?>
            </select>
        </dd>
        <dt class="label"></dt>
        <dd class="fields">
            <input type="submit" id="submit_button" name="button" class="button" value="保存"/>
            <button class="btn_common button" type="button" id="btnCancel">取消</button>
        </dd>
    </dl>
</form>
<script type="text/javascript" src="<?php echo url::base(); ?>js/jquery.validate.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#add_form").validate();
        $('#btnCancel').click(function(){
            window.parent.$('#add_catalog_ifm').dialog('close');
        });
    });
</script>

