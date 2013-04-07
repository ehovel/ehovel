<?php defined('SYSPATH') OR die('No direct access allowed.');?>
<form id="add_form" name="add_form" method="post" action="<?php echo url::base()?>resource_tag/do_add">
    <dl class="forms clearfix">
        <dt class="label"><label class="forms_label">标签名称<span class="fields_state">*</span></label></dt>
        <dd class="fields">
            <input type="text" id="name" name="name" class="input_text medium required" maxlength="20"/>
        </dd>
        <dt class="label"></dt>
        <dd class="fields">
            <input type="submit" id="submit_button" name="button" class="button" value="保存"/>
            <button class="btn_common button gray_button" type="button" id="btnCancel">取消</button>
        </dd>
    </dl>
</form>
<script type="text/javascript" src="<?php echo url::base(); ?>js/jquery.validate.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#add_form").validate();
        $('#btnCancel').click(function(){
            window.parent.$('#add_tag_ifm').dialog('close');
        });
    });
</script>
