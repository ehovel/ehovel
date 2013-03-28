<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php $return_data = $return_struct['content']; ?>
<link href="<?php echo url::base(); ?>css/swfupload.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo url::base(); ?>js/swfupload/swfupload.js"></script>
<script type="text/javascript" src="<?php echo url::base(); ?>js/fileprogress.js"></script>
<script type="text/javascript" src="<?php echo url::base(); ?>js/handlers.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        
        var _upload_url = '<?php echo url::base(); ?>resource/upload_put?session_id=<?php echo urlencode(Session::instance()->id()); ?>';
        var swfu;
        var settings = {
            flash_url: '<?php echo url::base(); ?>js/swfupload/Flash/swfupload.swf',
            upload_url: _upload_url + '&catelog_id=' + $('#catalog_list').val(),
            file_size_limit: '2 MB',
            file_types: '<?php echo $return_data['file_type']; ?>',
            file_types_description: '支持格式',
            file_upload_limit: 10,
            custom_settings: {
                progressTarget: "UploadProgress",
                cancelButtonId: "btnCancel"
            },
            debug: false,

            button_image_url: '<?php echo url::base(); ?>images/uppdtcsv.png',
            button_width: "120",
            button_height: "29",
            button_placeholder_id: "select_file",
            button_text: '<span style="cursor:pointer;">选择文件</span>',
            button_text_style: ".theFont { font-size: 16; }",
            button_text_left_padding: 25,
            button_text_top_padding: 3,
            button_cursor: SWFUpload.CURSOR.HAND,

            file_queued_handler : fileQueued,
            file_queue_error_handler : fileQueueError,
            file_dialog_complete_handler : fileDialogComplete,
            upload_start_handler : uploadStart,
            upload_progress_handler : uploadProgress,
            upload_error_handler : uploadError,
            upload_success_handler : uploadSuccess,
            upload_complete_handler : uploadComplete,
            queue_complete_handler : queueComplete
        };

        swfu = new SWFUpload(settings);
        $('#btnSubmit').click(function(){
            $('#upload_form').submit();
        });
        //修改分类后更改上传链接
        $('#catalog_list').change(function(){
            swfu.setUploadURL(_upload_url + '&catelog_id=' + $('#catalog_list').val());
        });
        $('#btnCancel').click(function(){
            window.parent.$('#upload_ifm').dialog('close');
        });
    });
</script>
<form id="upload_form" action="<?php echo url::base(); ?>resource/upload_form_submit" method="post">
    <dl class="forms clearfix">
        <dt class="label"><label class="forms_label">资源库目录</label></dt>
        <dd class="fields">
            <select name="catalog_id" id="catalog_list" class="input_text medium">
                <?php echo $return_data['catalog_list']; ?>
            </select>
        </dd>
        <dt class="label"><label class="forms_label">选择上传文件</label></dt>
        <dd class="fields">
            <span id="select_file">选择文件</span>
            <small class="under_forms_tip">上传文件最大尺寸：2M，批量上传一次最多10个</small>
            <small class="under_forms_tip">支持的上传格式为：.jpg/.jpeg/.gif/.png/.bmp/.doc/.docx/.xls/.xlsx/.ppt/<br/>.pptx/.pdf/.rar/.zip/.txt</small>
        </dd>
        <dt class="label"></dt>
        <dd class="fields">
            <div class="upload_files" id="UploadProgress"></div>
            <div id="divStatus"></div>
        </dd>
        <dt class="label"></dt>
        <dd class="fields">
            <button class="btn_common button" type="button" id="btnSubmit">保存</button>
            <button class="btn_common button gray_button" type="button" id="btnCancel">取消</button>
        </dd>
    </dl>
</form>