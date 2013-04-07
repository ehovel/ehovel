<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<h1 class="heading">标签列表</h1>
<!--table operate-->
<div class="operate_mod clearfix">
    <div class="mange_wrap clearfix">
        <a href="javascript:void(0)" class="mod_link icon_link" title="添加新标签" id="add_tag">
            <span class="icon_item">
                <span class="icon_wrap"><i class="icon_05"></i></span>
                <span class="link_wrap">添加新标签</span>
            </span>
        </a>
    </div>
</div>
<div class="datatable_wrapper">
    <div id="datatable_wrapper" class="datatables_wrapper clearfix">
        <table class="display" id="datatable">
            <thead>
                <tr>
                    <th width="100">操作</th>
                    <th>名称</th>
                    <th width="100">资源数量</th>
                    <th width="150">更新时间</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list as $key => $val): ?>
                    <tr>
                        <td>
                            <a href="javascript:void(0);" class="act_doedit edit" title="编辑">编辑</a>
                            <a href="javascript:void(0);" class="act_dodelete delete" title="删除">删除</a>
                        </td>
                        <td><?php echo $val['name']; ?></td>
                        <td><a href="<?php echo url::base(); ?>resource?tag_id=<?php echo $val['id']; ?>"><?php echo $val['resource_num']; ?></a></td>
                        <td><?php echo $val['date_upd']; ?></td>
                <input type="hidden" name="id" value="<?php echo $val['id']; ?>"/>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<div id="add_tag_ifm" class="ui-dialog-content ui-widget-content" style="width:auto;">
    <iframe style="border:0px;width:100%;height:95%;" frameborder="0" src="" scrolling="auto"></iframe>
</div>
<div id="edit_tag_ifm" class="ui-dialog-content ui-widget-content" style="width:auto;">
    <iframe style="border:0px;width:100%;height:95%;" frameborder="0" src="" scrolling="auto"></iframe>
</div>
<script type="text/javascript" src="<?php echo url::base(); ?>js/jquery.validate.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var url_base = '<?php echo url::base(); ?>';

        $("#list_form").validate({
            errorClass:'error1',
            errorPlacement: function(error, element) {
                alert(error.html());
            }
        });

        $('#add_tag_ifm').dialog({
            title: '添加标签',
            modal: true,
            autoOpen: false,
            height: 250,
            width: 600
        });

        $('#edit_tag_ifm').dialog({
            title: '编辑标签',
            modal: true,
            autoOpen: false,
            height: 250,
            width: 600
        });

        $('#add_tag').click(function(){
            var ifm = $('#add_tag_ifm');
            ifm.find('iframe').attr('src', url_base + 'resource_tag/add');
            ifm.dialog('open');
        });

        $('.act_doedit').each(function(){
            $(this).unbind().bind('click keyup',function(){
                var o = $(this).parent().parent();
                var id = o.find('input').val();
                var edit_ifm = $('#edit_tag_ifm');
                edit_ifm.find('iframe').attr('src', url_base + 'resource_tag/edit?id=' + id);
                edit_ifm.dialog('open');
            });
        });

        $('.act_dodelete').each(function(){
            $(this).unbind().bind('click keyup',function(e){
                var obj = $(this);
                var o = $(this).parent().parent();
                var id = o.find('input').val();
                if(confirm('确定要删除该标签吗?'))
                {
                    location.href = obj.attr('href',url_base + 'resource_tag/delete?id=' + id);
                }
            });
        });
    });
</script>