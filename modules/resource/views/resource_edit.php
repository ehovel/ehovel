<?php
defined('SYSPATH') OR die('No direct access allowed.');
$resource = $return_struct['content'];
$relation_tags = isset($resource['relation_tags']) ? $resource['relation_tags'] : '';
$tags = isset($resource['tags']) ? $resource['tags'] : array();
$catalog_list = isset($resource['catalog_list']) ? $resource['catalog_list'] : '';
?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#add_form").validate();
    });
</script>
<h1 class="heading">编辑资源信息</h1>

<form id="add_form" name="add_form" method="post" action="<?php echo url::base()?>resource/do_edit">
    <dl class="forms clearfix">
        <dt class="label"></dt>
        <dd class="fields">
            <input type="hidden" name="resource_id" value="<?php echo isset($resource['id']) ? $resource['id'] : 0; ?>"/>
            <img src="<?php echo resource::get_img($resource['attach_id']); ?>" alt=""/>
            <div>作者：<?php echo isset($resource['manager_name']) ? $resource['manager_name'] : ''; ?></div>
            <div>时间：<?php echo isset($resource['date_add']) ? $resource['date_add'] : ''; ?></div>
            <div>大小：<?php echo isset($resource['byte']) ? $resource['byte'] : ''; ?></div>
        </dd>
        <dt class="label"><label class="forms_label">文件名<span class="fields_state">*</span></label></dt>
        <dd class="fields">
            <input name="name" type="text" class="input_text small required" maxlength="255" value="<?php echo isset($resource['name']) ? $resource['name'] : ''; ?>"/>
            <?php echo isset($resource['postfix']) ? ('. ' . $resource['postfix']) : ''; ?>
        </dd>
        <dt class="label"><label class="forms_label">标签</label></dt>
        <dd class="fields">
            <input name="tag" type="text" class="input_text medium" value="<?php echo $relation_tags; ?>"/>&nbsp;<span class="input_tips">多个标签以逗号分隔</span>
            <div class="often_tags fixfloat">
                <div class="often_tags_title">常用标签：</div>
                <div class="often_tags_content">
                    <?php foreach ($tags as $tag): ?>
                        <a href="javascript:void(0);" class="item tag"  id ="<?php echo $tag['id']; ?>"><?php echo $tag['name']; ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
        </dd>
        <dt class="label"><label class="forms_label">标题</label></dt>
        <dd class="fields">
            <input name="title" type="text" class="input_text medium" maxlength="255" value="<?php echo isset($resource['title']) ? $resource['title'] : ''; ?>"/>
        </dd>
        <dt class="label"><label class="forms_label">替代文本</label></dt>
        <dd class="fields">
            <input name="alter" type="text" class="input_text medium" maxlength="1024" value="<?php echo isset($resource['alter']) ? $resource['alter'] : ''; ?>"/>
        </dd>
        <dt class="label"><label class="forms_label">说明</label></dt>
        <dd class="fields">
            <input name="introduction" type="text" class="input_text big" style="" maxlength="1024" value="<?php echo isset($resource['introduction']) ? $resource['introduction'] : ''; ?>"/>
        </dd>
        <dt class="label"><label class="forms_label">描述</label></dt>
        <dd class="fields">
            <textarea class="textarea big" name="description"><?php echo isset($resource['description']) ? $resource['description'] : ''; ?></textarea>
        </dd>
        <dt class="label"><label class="forms_label">资源库目录</label></dt>
        <dd class="fields">
            <select name="catalog_id" id="catalog_id" class="input_text medium required">
                <?php echo $catalog_list; ?>
            </select>
        </dd>
        <dt class="label"></dt>
        <dd class="fields">
            <input type="submit" id="submit_button" name="button" class="button" value="保存"/>
            <button class="button gray_button" type="button" onclick="location.href='/resource'">取消</button>
        </dd>
    </dl>
</form>
<script type="text/javascript">
    var url_base = '<?php echo url::base();?>';
    $(document).ready(function(){
        /* 按钮风格 */
        $(".ui-button-small,.ui-button").button();

        $("#add_form").validate({
            submitHandler:function(form){
                form.submit();
                parent.ajax_block.open();
            }
        });

        $('#submit_button').click(function(){
            $('#add_form').submit();
        });

        $('.tag').each(function(){
            $(this).unbind().bind('click keyup', function(){
                id = $(this).attr('id');
                $.ajax({
                    url: url_base + 'resource/ajax_tag_add?id=' + id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(retdat, status) {
                        if(retdat['code'] == 200 && retdat['status'] == 1)
                        {
                            t = $('input[name="tag"]').val();
                            v = retdat['content']['tag']['name'] + ',';
                            $('input[name="tag"]').val(t + v);
                        }
                        else
                        {
                            alert('操作失败');
                        }
                    },
                    error: function() {
                        alert('请求错误');
                    }
                });
            });
        });
    });
</script>

