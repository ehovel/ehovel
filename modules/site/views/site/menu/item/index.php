<?php defined('SYSPATH') or die('No direct script access.'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo STATICS_BASE_URL;?>js/ztree/css/zTreeStyle.css">
<link rel="stylesheet" type="text/css" href="<?php echo STATICS_BASE_URL;?>js/ztree/css/demo.css">
<link rel="stylesheet" type="text/css" href="<?php echo STATICS_BASE_URL;?>js/ztree/css/zTreeIcons.css">
<?php echo EHOVEL::js('ztree/demoData')?>
<?php echo EHOVEL::js('ztree/jquery.ztree-2.6.min')?>
<?php echo EHOVEL::js('jquery.validate')?>
<script type="text/javascript">
function clone(jsonObj, newName) {
    var buf;
    if (jsonObj instanceof Array) {
        buf = [];
        var i = jsonObj.length;
        while (i--) {
            buf[i] = clone(jsonObj[i], newName);
        }
        return buf;
    } else if (typeof jsonObj == "function") {
        return jsonObj;
    } else if (jsonObj instanceof Object) {
        buf = {};
        for (var k in jsonObj) {
            if (k != "parentNode") {
                buf[k] = clone(jsonObj[k], newName);
                if (newName && k == "name") buf[k] += newName;
            }
        }
        return buf;
    } else {
        return jsonObj;
    }
}
var zTree1;
var simpleNodes = <?php echo $data;?>;
var setting = {
    showLine: true,
    treeNodeKey: "id",
    treeNodeParentKey:"pid",
    isSimpleData : true,
    dragCopy :false,
    dragMove : true,
    editable : true,
    edit_renameBtn : false,
    showIcon:false,
    callback :
    {
        beforeDrop: zTreeBeforeDrop,
        beforeRemove: zTreeBeforeRemove,
        click: zTreeOnClick,
        dblclick :zTreeOnDblclick
    }
};
/**
 * 删除节点
 * @param treeId
 * @param treeNode
 */
function zTreeBeforeRemove(treeId, treeNode) {
    if (confirm('<?php echo __('Sure to delete the site menu?');?>')) {
        $.ajax({
            type: "GET",
            dataType:'json',
            url: "<?php echo EHOVEL::url('site_menu/delete');?>",
            data: 'id=' + treeNode.id,
            cache:false,
            success: function(nodedate) {
                if (nodedate.status == '0') {
                    alert(nodedate.msg);
                } else {
                    if (treeNode.id == $('#target').val()) {
                        $('#target').val($('#root').val());
                    }
                    zTree1.removeNode(treeNode);
                }
            },
            error:function() {
                alert('<?php echo __('Deleted failed!');?>');
            }
        });
        return false;
    } else {
        return false;
    }
}
/**
 * 移动节点
 * @param treeId
 * @param treeNode
 * @param targetNode
 * @param moveType
 */
function zTreeBeforeDrop(treeId, treeNode, targetNode, moveType) {
    $.ajax({
        type: "GET",
        dataType:'json',
        url: "<?php echo EHOVEL::url('site_menu/move');?>",
        data: 'id=' + treeNode.id + '&type=' + moveType + '&target=' + targetNode.id,
        success: function(nodedate) {
            if (nodedate.status == '0') {
                alert(nodedate.msg);
            }
        },
        error:function() {
            alert('<?php echo __('Editing failed, try again');?>');
        }
    });
}
/**
 * 载入已有节点编辑
 * @param event
 * @param treeId
 * @param treeNode
 */
function zTreeOnDblclick(event, treeId, treeNode) {
    $('#is_root').attr('checked', false).parent().removeClass('checked');
    open_block();
    $('#submit_button').html("<?php echo __('Edit');?>");
    $.ajax({
        type: "POST",
        dataType:'json',
        url: "<?php echo EHOVEL::url('site_menu/get');?>",
        data: 'id=' + treeNode.id,
        success: function(nodedate) {
            close_block();
            if ((nodedate.status == 1) && (nodedate.code == 200)) {
                var content = nodedate.content;
                $('#name').val(content.name);
                $('#type').val(content.type);
                $('#href').val(content.href);
                $('#title').val(content.title);
                $('#target_blank').val(content.target_blank);
                $('#current_id').val(content.id);
//                $('#name').rules('add', {
//                    remote:'<?php echo EHOVEL::url('site_menu/name_exist',array('r_id' => $id));?>' + '&id=' + $('#current_id').val(),
//                    messages:{
//                        remote: '<?php echo __('Name cannot be repeated');?>'
//                    }
//                });
                initType();
            } else {
                alert(nodedate.msg);
            }
            //console.log(nodedate);
        },
        error:function() {
            close_block();
            alert('<?php echo __('Loading failed, try again');?>');
        }
    });
}
/**
 * 选择节点
 * @param event
 * @param treeId
 * @param treeNode
 */
function zTreeOnClick(event, treeId, treeNode) {
    $('#is_root').attr('checked', false).parent().removeClass('checked');
    $('#submit_button').html("<?php echo __('Add');?>");
    var target = treeNode.id;
    $("#target").val(target);
    $("#current_id").val(0);
}

var zNodes1 = clone(simpleNodes);
$(document).ready(function() {
    $("#myForm").validate({
        rules: {
            href: {
                required: function() {
                    return $('#type').val() == 'LINK'
                }
            },
            title: {
                required: function() {
                    return $('#type').val() == 'LINK'
                }
            },
//            name:{
//                remote:'<?php echo EHOVEL::url('site_menu/name_exist', array('r_id' => $id));?>'
//            }
        },
        messages: {
            name:{
                remote:'<?php echo __('Name cannot be repeated');?>'
            }
        },
        submitHandler:function(form) {
            open_block();
            var param_date = $('#myForm').serialize();
            $.ajax({
                type: "POST",
                dataType:'json',
                url: "<?php echo EHOVEL::url('site_menu/item', array('id' => $id));?>",
                data: param_date,
                success: function(nodedata) {
                    close_block();
                    var content = nodedata.content;
                    var selectedNode = zTree1.getSelectedNode();
                    var newNode = [
                        {name:content.name,id:content.id}
                    ];
                    if ((nodedata.status == 1) && (nodedata.code == 200)) {
                        zTree1.addNodes(selectedNode, newNode);
                        clearForm();
                    } else if ((nodedata.status == 2) && (nodedata.code == 200)) {
                        selectedNode.name = content.name;
                        zTree1.updateNode(selectedNode, true);
                        //zTree1.cancelSelectedNode();
                        $('#submit_button').html("<?php echo __('Add');?>");
                        $("#current_id").val(0);
                        clearForm();
                    } else {
                        alert(nodedata.msg);
                    }
                },
                error:function() {
                    close_block();
                    alert('<?php echo __('Saved failed, try again');?>');
                }
            });
        }
    });
    zTree1 = $("#treeDemo").zTree(setting, zNodes1);
    zTree1.expandAll(true);
    $('#type').change(function() {
        initType();
    });
    $('#is_root').click(function() {
        if ($(this).attr("checked") == true) {
            zTree1.cancelSelectedNode();
            $("#target").val($('#root').val());
        }

    });
});
function clearForm() {
    $('#name').val('');
    $('#href').val('');
    $('#title').val('');
}
function initType() {
    var type = $('#type').val();
    $('.menu_type').hide();
    $('.' + type).show();
}
</script>
<section class="line">
    <?php remind::render_current();?>
    <aside id="sidebar" class="unit size3of5">
        <div class="box">
            <h2><?php echo __('Add Menu Item');?></h2>

            <form class="uniform" id="myForm" action="<?php echo url::current(true);?>" method="post">
                <input type="hidden" name="target" id="target" value="<?php echo $id;?>"/>
                <input type="hidden" name="root" id="root" value="<?php echo $id;?>"/>
                <input type="hidden" name="current_id" id="current_id" value="0"/>
                <section>
                    <dl>
                        <dt><label for="name"><?php echo __('Name');?><span class="require">*</span></label></dt>
                        <dd><input type="text" name="name" id="name" class="medium required" maxlength="255"/></dd>

                        <dt><label for="type"><?php echo __('Type');?></label></dt>
                        <dd>
                            <select name="type" id="type" class="medium">
                                <option value="LINK"><?php echo __('Custom links');?></option>
                                <option value="CATEGORY"><?php echo __('Product Category');?></option>
                                <option value="DOC"><?php echo __('DOC');?></option>
                            </select>
                        </dd>

                        <dt><label for="target_blank"><?php echo __('Target Blank');?><span
                                class="require">*</span></label></dt>
                        <dd>
                            <select name="target_blank" id="target_blank" class="small">
                                <option value="Y"><?php echo __('Yes');?></option>
                                <option value="N"><?php echo __('No');?></option>
                            </select>
                        </dd>
                    </dl>
                    <dl class="CATEGORY menu_type" style="display: none;">
                        <dt><label for="category"><?php echo __('Product Category');?><span
                                class="require">*</span></label></dt>
                        <dd>
                            <select name="category" id="category">
                                <?php foreach ($product_categories as $key => $value) { ?>
                                <option value="<?php echo $key;?>"><?php echo $value;?></option>
                                <?php }?>
                            </select>
                        </dd>
                    </dl>
                    <dl class="DOC menu_type" style="display: none;">
                        <dt><label for="doc"><?php echo __('Doc');?><span class="require">*</span></label></dt>
                        <dd>
                            <select name="doc" id="doc">
                                <?php foreach ($docs as $key => $item) { ?>
                                <option value="<?php echo $item->id;?>"><?php echo $item->title;?></option>
                                <?php }?>
                            </select>
                        </dd>
                    </dl>
                    <dl class="DOCCATEGORY menu_type" style="display: none;">
                        <dt><label for="doc_category"><?php echo __('Doc Category');?><span
                                class="require">*</span></label></dt>
                        <dd>
                            <select name="doc_category" id="doc_category">
                                <?php foreach ($doc_categories as $key => $value) { ?>
                                <option value="<?php echo $key;?>"><?php echo $value;?></option>
                                <?php }?>
                            </select>
                        </dd>
                    </dl>
                    <dl class="LINK menu_type">
                        <dt><label for="href"><?php echo __('URL');?><span class="require">*</span></label></dt>
                        <dd><input type="text" name="href" id="href" class="medium" maxlength="255"/></dd>

                        <dt><label for="title"><?php echo __('Title');?><span class="require">*</span></label></dt>
                        <dd><input type="text" name="title" id="title" class="medium" maxlength="255"/>
                        </dd>
                    </dl>
                    <dl>
                        <dt><label for="title"><?php echo __('Add Root');?><span class="require">*</span></label></dt>
                        <dd>
                            <input type="checkbox" name="is_root" id="is_root" checked="checked"
                                   value="<?php echo $id;?>"/>
                        </dd>
                    </dl>
                    <p>
                        <button type="submit" id="submit_button" class="button big"><?php echo __('Add');?></button>
                        <?php echo HTML::cancel_anchor(EHOVEL::url('site_menu/index'));?>
                    </p>

                </section>
            </form>
        </div>
    </aside>
    <section id="main" class="unit lastUnit">
        <article>
            <div class="accordion">
                <h3><?php echo __('Menu Items');?></h3>

                <div>
                    <ul id="treeDemo" class="tree"></ul>
                </div>
            </div>
        </article>
    </section>
</section>
