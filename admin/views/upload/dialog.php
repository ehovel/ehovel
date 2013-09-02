<?php defined('SYSPATH') OR die('No direct script access allowed.'); ?>
<div id="dialog_<?php echo $id; ?>" title="<?php echo __('Upload File'); ?>" style="display:none;">
    <ul class="tabs">
        <li class="selected"><a href="javascript:;" id="upload_tab_local_<?php echo $id; ?>"><?php echo __('Upload Local');?></a></li>
        <?php if($resource_open) {?>
        <li><a href="javascript:;" id="upload_tab_resource_<?php echo $id; ?>"><?php echo __('Upload Resource');?></a></li>
        <?php }?>
    </ul>
    <br/>
    <form class="uniform" id="upload_form_<?php echo $id; ?>" action="<?php echo $submit_url; ?>" method="post" enctype="multipart/form-data" target="upload_submit_<?php echo $id; ?>">
        <div style="margin-left:145px;margin-bottom:10px;">
            <b><?php echo __('Catalog');?></b>
            <select name="catalog_id" id="catalog_id">
                <option value="0"><?php echo __('Resource All');?></option>
                <?php foreach ($catalog as $val) { ?>
                    <option value="<?php echo $val->id;?>"><?php echo str_repeat('&nbsp;', $val->level_depth * 4) . htmlspecialchars($val->name);?></option>
                <?php } ?>
            </select>
        </div>
        <?php if ($multi == FALSE) { ?>
            <fieldset>
                <dl class="inline">
                    <dt><label for="image"><?php echo __('Select File');?><span class="require">*</span></label></dt>
                    <dd>
                        <input type="file" name="upload_file_<?php echo $id; ?>_0" class="tiny"/>
                        <label class="error" for="upload_file_<?php echo $id; ?>_0" generated="true" style="display:none"></label>
                        <small><?php echo $notice; ?></small>
                    </dd>
                    <dt><label for="description"><?php echo __('Description');?></label></dt>
                    <dd><input type="text" name="upload_description_<?php echo $id; ?>_0" class="medium" maxlength="255" value=""/></dd>
                </dl>
            </fieldset>
        <?php } else { ?>
            <dl class="inline">
                <?php for ($i = 0; $i < $count; $i ++) { ?> 
                    <dt><label for="image"><?php echo __('File'); ?> #<?php echo $i + 1;?><span class="require">*</span></label></dt>
                    <dd>
                        <input type="file" name="upload_file_<?php echo $id; ?>_<?php echo $i; ?>" class="tiny"/>
                        <a href="#"><img src="<?php echo STATICS_BASE_URL; ?>images/icons/cross.png"/></a>
                        <label class="error" for="upload_file_<?php echo $id; ?>_<?php echo $i; ?>" generated="true" style="display:none"></label>
                        <small><?php echo $notice; ?></small>
                    </dd>
                <?php } ?>
            </dl>
        <?php } ?>
    </form>
    <iframe name="upload_submit_<?php echo $id; ?>" src="#" style="display:none"></iframe>
    <form class="uniform" id="upload_form_resource_<?php echo $id; ?>" action="<?php echo $resource_submit_url;?>" method="post" enctype="multipart/form-data" target="upload_submit_<?php echo $id; ?>" style="display:none;">
        <input id="resource_search_catalog_<?php echo $id; ?>" type="hidden" value="0"/>
        <input id="resource_search_name_<?php echo $id; ?>" type="hidden" value=""/>
        <input id="resource_search_postfixs_<?php echo $id; ?>" type="hidden" value="<?php echo $postfixs;?>"/>
        <input id="resource_search_multi_<?php echo $id; ?>" type="hidden" value="<?php echo $multi;?>"/>
        <section>
            <section class="container_12 clearfix">
                <span id="search_resource_list_<?php echo $id; ?>"></span>
            </section>
    </section>
    </form>
</div>
<script type="text/javascript">
    function submitUploadResult_<?php echo $id; ?>(rethat) {
        var id          = <?php echo json_encode($id); ?>;
        var multi       = <?php echo json_encode($multi); ?>;
        var saveHandler = <?php echo $save_handler; ?>;
        if (rethat['status'] == 1) {
            if (multi) {
                saveHandler(rethat['content']);
            } else {
                saveHandler(rethat['content'].shift());
            }
            $('#dialog_' + id).dialog('close');
        } else {
            if (typeof rethat['msg'] == 'string') {
                setRemind(REMIND_TYPE_ERROR, rethat['msg']);
            } else {
                $('#upload_form_' + id).find('input[name^="upload_file_"]').each(function(idx, item){
                    $(item).removeClass('error').parent().next().empty().hide();
                });
                for (var k in rethat['msg']) {
                    $('input[name="' + k + '"]').addClass('error').parent().next().show().html(rethat['msg'][k]);
                }
            }
        }
    }
    $(document).ready(function(){
        var i        = <?php echo $count; ?>;
        var id       = <?php echo json_encode($id); ?>;
        var bind     = <?php echo json_encode($bind); ?>;
        var multi    = <?php echo json_encode($multi); ?>;
        var fileRule = <?php echo json_encode($file_rule); ?>;
        var rules    = <?php echo json_encode($rules); ?>;
        var notice   = <?php echo json_encode($notice); ?>;
        var form     = $('#upload_form_' + id);
        var dialog   = $('#dialog_' + id);
        var width    = multi ? 900 : 900;
        var height   = multi ? 500 : 460;
        var addUploadFile = function() {
            var file = $('<dt><label for="image"><?php echo __('File');?> #' + (i + 1) + '<span class="require">*</span></label></dt>'
                + '<dd>'
                + '    <input type="file" name="upload_file_' + id + '_' + i + '" class="tiny"/>'
                + '    <a href="#"><img src="<?php echo STATICS_BASE_URL; ?>images/icons/cross.png"/></a>'
                + '    <label class="error" for="upload_file_' + id + '_' + i + '" generated="true" style="display:none"></label>'
                + '    <small>' + notice + '</small>'
                + '</dd>');

            form.find('dl').append(file);
            
            var input = file.find('input[type="file"]');
            input.rules('add', fileRule);
            input.uniform();
            
            i ++;
        }
        
        form.validate({
            onkeyup: false,
            rules: rules,
            messages: {}
        });
        
        form.find('a').live('click', function(){
            var t = $(this);
            if (form.find('input[name^="upload_file_"]').length > 1) {
                $.kMsg.warning('<?php echo __('Sure to delete?'); ?>', function(){
                    t.parent().prev().remove();
                    t.parent().remove();
                });
            } else {
                $.kMsg.warning('<?php echo __('The last one cannot be cancelled'); ?>');
            }
            return false;
        });
        
        buttons = {};
        buttons['<?php echo __('Save'); ?>'] = function() {
            $('#dialog_<?php echo $id; ?> form').filter(function(){
                return $(this).css('display') != 'none';
            }).submit();
        }
        if (multi) {
            buttons['<?php echo __('Add New'); ?>'] = function() {
                addUploadFile();
            }
        }
        buttons['<?php echo __('Cancel'); ?>'] = function() {
            dialog.dialog('close');
        }
        
        dialog.dialog({
            modal: true,
            autoOpen: false,
            width: width,
            height: height,
            buttons: buttons,
            open: function(){
                if (multi) {
                    i = 0;
                    form.find('dl').empty();
                    addUploadFile();
                }else{
                    form.find('input[type="file"]').val('');
                    form.find('.filename').html('<?php echo __('No file selected')?>');
                    form.find('.error').html('');
                }
            }
        });
        
        if (bind) {
            $(bind).bind('click', function(){
                dialog.dialog('open');
                return false;
            });
        }

        $("#upload_tab_local_<?php echo $id; ?>").bind('click', function(){
            $("#upload_form_<?php echo $id; ?>").show();
            $("#upload_form_resource_<?php echo $id; ?>").hide();
            $('#dialog_<?php echo $id; ?>').parent().children().last().find("button").each(function(i){
                if(i == 1) {
                    $(this).show();
                }
            });
        });
        $("#upload_tab_resource_<?php echo $id; ?>").bind('click', function(){ 
            $("#upload_form_resource_<?php echo $id; ?>").show();
            $("#upload_form_<?php echo $id; ?>").hide();
            var add_button_exist = false;
            $('#dialog_<?php echo $id; ?>').parent().children().last().find("button").each(function(i){
                if(i == 2) {
                    add_button_exist = true;
                }
            });
            if(add_button_exist) {
                $('#dialog_<?php echo $id; ?>').parent().children().last().find("button").each(function(i){
                    if(i == 1) {
                        $(this).hide();
                    }
                });
            }
            search_resource('<?php echo $id; ?>');
        });
    });
    
    function search_resource(id, page) {
        if(!arguments[1]) {
            page = 0;
        }
        var name = $("#resource_search_name_"+id).val();
        var catalog = $("#resource_search_catalog_"+id).val();
        var postfixs = $("#resource_search_postfixs_"+id).val();
        var multi = $("#resource_search_multi_"+id).val();
        $.ajax({
            type: "GET",
            dataType:'json',
            url: "<?php echo EHOVEL::url('resource/search');?>?id="+id+"&postfixs="+postfixs+"&catalog="+catalog+"&name="+name+"&page="+page+"&multi="+multi,
            cache:false,
            success: function(data) {
                if(data.status == '1') {
                    $("#search_resource_list_"+id).html(data.content.data);
                }
            },
            error:function() {
            }
        });
    }
</script>
