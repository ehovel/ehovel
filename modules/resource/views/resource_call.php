<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php $select_catalog_list = tree::get_tree($catalog_list, '<option value={$id} {$selected}>{$spacer}{$name}</option>'); ?>
<link href="<?php echo url::base(); ?>css/swfupload.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo url::base(); ?>js/swfupload/swfupload.js"></script>
<script type="text/javascript" src="<?php echo url::base(); ?>js/fileprogress.js"></script>
<script type="text/javascript" src="<?php echo url::base(); ?>js/handlers.js"></script>
<!-- 横向 tab模块 开始-->
<div class="tabs">
    <ul class="tabs_handler clearfix">
        <li class="item current"><a href="#resource_tab1">本地上传</a></li>
        <li class="item" mvalue="1"><a href="#resource_tab2">从资源库选择</a></li>
        <li class="item"><a href="#resource_tab3">互联网上的文件</a></li>
    </ul>

    <div class="tabs_content">
        <!--本地上传-->
        <div id="resource_tab1" class="tabs_panel" style="display:block;">
            <h1 class="heading">从本地计算机上传资源</h1>
            <input type="hidden" name="tag_id" value="<?php echo isset($resource_tag['id']) ? $resource_tag['id'] : 0; ?>"/>
            <dl class="forms clearfix">
                <dt class="label"><label class="forms_label">资源库目录</label></dt>
                <dd class="fields">
                    <select name="catalog_id" id="catalog_list" class="input_text medium">
                        <?php echo $select_catalog_list; ?>
                    </select>
                </dd>
                <dt class="label"><label class="forms_label">选择上传文件</label></dt>
                <dd class="fields">
                    <div class="resource_select">
                        <span id="select_file">选择文件</span>
                    </div>
                    <div class="upload_tips">
                        <small class="under_forms_tip">上传文件最大尺寸：2M，批量上传一次最多10个</small>
                        <small class="under_forms_tip">支持的上传格式为：<?php echo $file_type; ?></small>
                    </div>
                    <div class="upload_files" id="UploadProgress"></div>
                </dd>
                <dt class="label"></dt>
                <dd class="fields">
                    <button class="btn_common button" type="button" id="btnSubmit1">确定</button>
                    <button class="btn_common button gray_button" type="button" id="btnCancel1">取消</button>
                </dd>
            </dl>
        </div>
        <!--资源列表-->
        <div id="resource_tab2" class="tabs_panel">
            <h1 class="heading">
                资源库列表（图片）
            </h1>
            <!--standard table-->
            <div class="nav_container clearfix">
                <div class="tree_nav">
                    <!--tree nav-->
                    <div id="Js_treeNav" class="clearfix">
                        <ul class="tree_navlist">
                            <li class="tree_navitem">
                                <a class="target_title folder" href="javascript:void(0)" id="0"><s class="file_tag"></s>全部资源</a>
                                <ul class="tree_navlist">
                                    <?php
                                    $tree = tree::get_tree_array($catalog_list);
                                    $begin = false;
                                    $lvl_begin = false;
                                    $lvl = 1;
                                    foreach ($tree as $key => $item) {
                                        if ($begin == false) {
                                            echo '<li class="tree_navitem"><i class="minus_icon"></i><a class="folder target_title" href="javascript:void(0)" id="' . $item['id'] . '"><s class="file_tag"></s>' . $item['name'] . '</a>';
                                            $begin = true;
                                            continue;
                                        }
                                        if ($lvl == $item['level_depth']) {
                                            echo '</li><li class="tree_navitem"><i class="minus_icon"></i><a class="folder target_title" href="javascript:void(0)" id="' . $item['id'] . '"><s class="file_tag"></s>' . $item['name'] . '</a>';
                                        }
                                        if ($lvl < $item['level_depth']) {
                                            echo '<ul class="tree_navlist"><li class="tree_navitem"><i class="minus_icon"></i><a class="folder target_title" href="javascript:void(0)" id="' . $item['id'] . '"><s class="file_tag"></s>' . $item['name'] . '</a>';
                                        }
                                        if ($lvl > $item['level_depth']) {
                                            echo '</li></ul><li class="tree_navitem"><i class="minus_icon"></i><a class="folder target_title" href="javascript:void(0)" id="' . $item['id'] . '"><s class="file_tag"></s>' . $item['name'] . '</a>';
                                        }
                                        $lvl = $item['level_depth'];
                                    }
                                    ?>
                            </li>
                        </ul>
                    </div>
                    <!--aside tag list-->
                    <div class="aside_tag">
                        <dl>
                            <dt>标签：</dt>
                            <dd>
                                <?php if (isset($tags) && !empty($tags)): ?>
                                    <?php foreach ($tags as $tag): ?>
                                        <a href="javascript:void(0);" value="<?php echo $tag['id']; ?>" class="tag item tag_href"><?php echo $tag['name']; ?></a>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </dd>
                        </dl>
                    </div>
                </div>
                <!--tree content-->
                <div class="nav_content resource_list" id="resource_list">
                    <!--资源库主体内容-->
                </div>
            </div>
            <div class="resource_btn_wrap" style="text-align:center;">
                <button class="btn_common button" type="button" id="btnSubmit2">确定</button>
                <button class="btn_common button gray_button" type="button" id="btnCancel2">取消</button>
            </div>
        </div>
        <!--互联网图片-->
        <div id="resource_tab3" class="tabs_panel">
            <div class="message message_tip">
                <i class="icon_message">
                </i>
                <p class="info"><strong>小贴士:</strong>网络资源不会做大小和类型判断，请添加时注意类型！
                </p>
            </div>
            
            <h1 class="heading">网络资源链接</h1>

            <!-- <div class="page_mod_box">
                <div class="page_mod_bd">
                    <dl class="forms clearfix">
                        <dt class="label"></dt>
                        <dd class="fields">
                            <a href="javascript:void(0);" class="add_btn">
                                <span class="icon_item"><span class="icon_wrap"><i class="icon_05"></i></span><span class="link_wrap">添加资源</span></span>
                            </a>
                            <small class="under_forms_tip">点击"+"，增加输入框，可一次添加多个</small>
                        </dd>
                    </dl>
                </div>
            </div>
             -->
            <div class="page_mod_box net_resource_box">
                <div class="page_mod_bd">
                    <dl class="forms clearfix net_resource">
                        <dt class="label"><label class="forms_label">名称</label></dt>
                        <dd class="fields">
                            <input class="input_text medium net_resource_name" type="text" name="resource_1_name" />
                            <input type="hidden" name="resource_id_1" value="1"/>
                        </dd>
                        <dt class="label"><label class="forms_label">地址<span class="fields_state">*</span></label></dt>
                        <dd class="fields">
                            <input class="input_text big net_resource_address" type="text" name="resource_1_link" value="http://"/>
                        </dd>
                        <dt class="label"></dt>
<!--                        <dd class="fields">-->
<!--                            <a href="javascript:void(0);" class="JS_delete">删除</a>-->
<!--                        </dd>-->
                    </dl>
                </div>
            </div>
            <dl class="forms clearfix btnSubmit3">
                <dt class="label"></dt>
                <dd class="fields">
                    <button class="btn_common button" type="submit" id="btnSubmit3">确定</button>
                    <button class="btn_common button gray_button" type="button" id="btnCancel3">取消</button>
                </dd>
            </dl>
        </div>
    </div>
</div>
<script type="text/javascript">
    var resource_list_loaded = false;
    $(function(){
        //载入服务器资源列表
        $("ul.tabs_handler li").each(function(i){
            var _this = $(this);
            _this.click(function(){
                var mvalue = $(this).attr('mvalue');
                //console.log(mvalue);
                if(mvalue=='1' && resource_list_loaded == false){
                    $("div.#resource_list").load('<?php echo url::base(); ?>resource/ajax_load_index?file_type=<?php echo $file_type ?>');
                    resource_list_loaded = true;
                }
            });
        });
        //目录选择
        $('.folder').click(function(){
            var catalog_id = $(this).attr('id');
            if(catalog_id == '0'){
                $("div.#resource_list").load('<?php echo url::base(); ?>resource/ajax_load_index');
            } else {
                $("div.#resource_list").load('<?php echo url::base(); ?>resource/ajax_load_index?catalog='+catalog_id);
            }
        });

        $('.tag_href').click(function(){
            v = $(this).attr('value');
            $("div.#resource_list").load('<?php echo url::base(); ?>resource/ajax_load_index' + create_query_string('tag_id',v));
            return false;
        });
        
        $('#catalog_list').change(function(){
            swfupload.setUploadURL(upload_url_base + '?session_id='+$('#session_id').val() + '&catelog_id=' + $('#catalog_list').val());
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('a.JS_delete').each(function(){
            var _this = $(this);
            _this.click(function(){
                $(this).parents("div.net_resource_box").remove();
                return false;
            });
        });

        var add_num = 1;
        $('.add_btn').click(function(){
            add_num ++;
            html = '';
            html += '<div class="page_mod_box net_resource_box">';
            html += '<div class="page_mod_bd">';
            html += '<dl class="forms clearfix net_resource">';
            html += '<dt class="label"><label class="forms_label">名称</label></dt>';
            html += '<dd class="fields">';
            html += '<input class="input_text medium net_resource_name" type="text" name="resource_' + add_num + '_name" />';
            html += '<input type="hidden" name="resource_id_' + add_num + '" value="' + add_num + '"/>';
            html += '</dd>';
            html += '<dt class="label"><label class="forms_label">地址<span class="fields_state">*</span></label></dt>';
            html += '<dd class="fields">';
            html += '<input class="input_text big net_resource_address" type="text" name="resource_' + add_num + '_link" value="http://"/>';
            html += '</dd>';
            html += '<dt class="label"></dt>';
            html += '<dd class="fields">';
            html += '<a href="javascript:void(0);" class="JS_delete">删除</a>';
            html += '</dd>';
            html += '</dl>';
            html += '</div>';
            html += '</div>';
            $(".btnSubmit3").before(html);
            $('.net_resource_box:last a.JS_delete').live('click',function(){
                var _this = $(this);
                $(this).parents("div.net_resource_box").remove();
            });
        });
    });
</script>