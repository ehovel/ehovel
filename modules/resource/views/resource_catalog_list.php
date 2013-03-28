<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php $tree = tree::get_tree_array($list); ?>
<h1 class="heading">文件夹列表</h1>

<div class="operate_mod clearfix">
    <div class="mange_wrap clearfix">
        <a href="javascript:void(0)" class="mod_link icon_link add_pro" id="add_catalog">
            <span class="icon_item">
                <span class="icon_wrap"><i class="icon_05"></i></span>
                <span class="link_wrap">添加新文件夹</span>
            </span>
        </a>
        <a href="/resource" class="mod_link icon_link">
            <span class="icon_item">
                <span class="icon_wrap"><i class="icon_01"></i></span>
                <span class="link_wrap">资源库</span>
            </span>
        </a>
    </div>
</div>

<div class="table_wrap table_wrap_top">
    <div class="standard_table_s">
        <?php if (is_array($tree) && count($tree)) { ?>
            <form id="list_form" name="list_form" method="post" action="<?php echo url::base() . url::current(); ?>">
                <table class="JS_showHide">
                    <tr>
                        <th width="100px">操作</th>
                        <th>名称</th>
                        <th>类型</th>
                        <th width="200px">更新时间</th>
                    </tr>
                    <!--uint-->
                    <?php foreach ($tree as $value) : ?>
                        <tr id="<?php echo $value['level_depth']; ?>" name="<?php echo $value['id']; ?>" deep="<?php echo $value['level_depth'] - 1; ?>">
                            <td>
                                <a title="编辑" class="edit act_doedit" href="javascript:void(0);">编辑</a>
                                <a title="删除" class="delete act_dodelete" href="javascript:void(0);"> 删除</a>
                                <input type="hidden" name='id' value="<?php echo $value['id'];?>"/>
                            </td>
                            <td <?php echo ($value['level_depth'] > 1) ? 'class="title"' : ''; ?>>
                                <span>
                                    <i class="minus_link"></i>
                                    <span class="word_link"><?php echo $value['name']; ?></span>
                                </span>
                            </td>                          
                            <td><?php echo $value['type']; ?></td>
                            <td><?php echo $value['date_upd']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </form>
        <?php } ?>
    </div>
</div>
<!--END FOOTER-->
<div id="add_catalog_ifm" class="ui-dialog-content ui-widget-content" style="width:auto;">
    <iframe style="border:0px;width:100%;height:95%;" frameborder="0" src="" scrolling="auto"></iframe>
</div>
<div id="edit_catalog_ifm" class="ui-dialog-content ui-widget-content" style="width:auto;">
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

        $('#add_catalog_ifm').dialog({
            title: '添加文件夹',
            modal: true,
            autoOpen: false,
            height: 250,
            width: 600
        });

        $('#edit_catalog_ifm').dialog({
            title: '编辑文件夹',
            modal: true,
            autoOpen: false,
            height: 250,
            width: 600
        });

        $('#add_catalog').click(function(){
            var ifm = $('#add_catalog_ifm');
            ifm.find('iframe').attr('src', url_base + 'resource_catalog/add');
            ifm.dialog('open');
        });

        $('.act_doedit').each(function(){
            $(this).unbind().bind('click keyup',function(){
                var o = $(this).parent().parent();
                var id = o.find('input').val();
                var edit_ifm = $('#edit_catalog_ifm');
                edit_ifm.find('iframe').attr('src', url_base + 'resource_catalog/edit?id=' + id);
                edit_ifm.dialog('open');
            });
        });

        $('a.act_dodelete').each(function(){
            $(this).unbind().bind('click keyup',function(e){
                var obj = $(this);
                var o = $(this).parent().parent();
                var id = o.find('input').val();
                if(confirm('确定要删除该文件夹（包含所有子文件夹）吗?'))
                {
                    //ajax_block.open();
                    location.href = obj.attr('href',url_base + 'resource_catalog/delete?id=' + id);
                }
            });
        });
    });
</script>
<script type="text/javascript">
    function fold(id){
        var obj = $('#top_div_'+id);
        var img = obj.find('img.icon_dot');
        if(img.attr('src') == '/images/icon_dot2.gif'){
            img.attr('src','/images/icon_dot1.gif');
            foldchild(id,1);
        }else if(img.attr('src') == '/images/icon_dot1.gif'){
            img.attr('src','/images/icon_dot2.gif');
            foldchild(id,2);
        }
    }

    function foldchild(id,type){
        if($('tr[pid="'+id+'"]').length > 0){
            $('tr[pid="'+id+'"]').each(function(){
                if(type == 1){
                    $(this).find('img.icon_dot').attr('src','/images/icon_dot1.gif');
                    $(this).hide();
                }else if(type == 2){
                    $(this).find('img.icon_dot').attr('src','/images/icon_dot2.gif');
                    $(this).show();
                } 
                foldchild($(this).find('input[name="id"]').val(),type);
            });
        }
    }
</script>
