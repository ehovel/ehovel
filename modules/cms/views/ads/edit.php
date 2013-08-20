<?php defined('SYSPATH') or die('No direct script access.'); ?>
<link rel="stylesheet" type="text/css"
	href="/statics/css/fancybox/jquery.fancybox-1.3.4.css" />
<?php echo EHOVEL::js('jquery.fancybox-1.3.4');?>
<?php echo EHOVEL::css('ehovel_modules');?>
<section class="container_12 clearfix">
	<article>
		<h1><?php echo __('Edit Ads');?></h1>
		<form class="form-horizontal" id="myForm" action="<?php echo url::current(true);?>" method="post" enctype="multipart/form-data">
			<div class="control-group">
				<label id="eform_alias-lbl" for="eform_alias" class="hasTip control-label" title="广告位名称"><?php echo __('名称');?></label>
				<div class="controls">
				    <input type="text" name="ads_title" id="ads_title" class="inputbox medium required" maxlength="20" value="<?php if(!empty($ads_detail->title)){echo $ads_detail->title;}?>" />
				</div>
			</div>
			<div class="control-group">
				<label id="eform_alias-lbl" for="eform_alias" class="hasTip control-label" title="广告位名称"><?php echo __('类型');?></label>
				<div class="controls">
				    <input type="text" name="ads_type" id="ads_type" class="inputbox medium required" maxlength="20" value="<?php if(!empty($ads_detail->type)){echo $ads_detail->type;}?>" />
				</div>
			</div>
			<div class="control-group">
				<label id="eform_alias-lbl" for="eform_alias" class="hasTip control-label" title="广告位名称"><?php echo __('图片');?></label>
				<div class="controls" id="piclist">
				    <?php foreach ($ads_detail->content as $pics) {?>
				    <div class="choose_pics">
                        <div class="pic">
                            <div class="pic_inner img120">
                                <?php //TODO 附件地址使用助手函数生成?>
                                <img alt="" src="<?php echo Helper_Resource::getLinkByResourceId($pics['banner']);?>" style="max-height:120px; max-width:120px">
                            </div>
                            <ul class="inline">
        					  <li><a onclick="removepic(this)" href="javascript:;"><i class="icon-remove"></i></a></li>
        					</ul>
                            <input type="hidden" value="<?php echo $pics['banner']?>" name="resource_ids[]"> 
                        </div> 
                    </div>
                    <?php }?>
				</div>
			</div>
			<div class="control-group">
				<a class="btn btn-primary" id="upload_pictures" onclick="showresourcedialog()">
					<i class="icon-picture"></i>选择图片
				</a>
			</div>
			<div class="buttons">
				<button type="submit" class="btn btn-info big"><?php echo __('Save');?></button>
                <?php echo html::cancel_anchor(EHOVEL::url('cms_ads/index')); ?>
            </div>
		</form>
	</article>
</section>
<div id="upload"><p class="upload"></p></div>
<?php echo EHOVEL::js('ehovel_upload');?>
<script type="text/javascript">
function showresourcedialog() {
	$('#upload_pictures').Upload({
		title: '图片上传',
		file_size_limit: '1 MB',
		file_types: '*.jpg;*.gif;*.png;',
		file_upload_limit: 10,
		session_id: $('#session_id').val(),
		base_url: '/',
		before_upload:function(){
		    return true;
		},
		upload_success: function(server_data){
			for (var i in server_data) {
				var h = '';
				h += '<div class="choose_pics"><div class="pic"><div class="pic_inner img120">';
				h += '<img alt="" src="'+ server_data[i]['url'] +'" style="max-height:120px; max-width:120px">';
				h += '</div>';
				h += '<ul class="inline"><li><a onclick="removepic(this)" href="javascript:;"><i class="icon-remove"></i></a></li></ul>';
				h += '<input type="hidden" value="'+ server_data[i]['id'] +'" name="resource_ids[]"></div></div>';
				h = $(h);
				$('#piclist').append(h);
			}
		}
		});
}
function removepic(obj){
	$(obj).parents(".choose_pics").remove();
}
</script>
