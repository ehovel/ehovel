<?php defined('SYSPATH') or die('No direct script access.'); ?>
<link rel="stylesheet" type="text/css" href="/statics/css/fancybox/jquery.fancybox-1.3.4.css" />
<?php echo EHOVEL::js('jquery.fancybox-1.3.4');?>
<script type="text/javascript">
    window.onload=function()
    {
       change();
    }
    function uploadImage(image) {
        $('#image').show();
        $('#image').find('img').attr('src', image['url_180x180']);
        $('#image').find('input').val(image['uri']);
    }
    
    function change()
    {
        var t1 = document.getElementById('t1');
        var t2 = document.getElementById('t2');
        var ads_type = document.getElementById('ads_type');
        if(ads_type.value=="images")
        {
            t1.style.display = "";
            t2.style.display = "none";
        }
        else if(ads_type.value=="flash")
        {
            t1.style.display = "none";
            t2.style.display = "";
        }
        else if(ads_type.value=="code")
        {
        	t1.style.display = "";
            t2.style.display = "";
        }
    }
</script>

<section class="container_12 clearfix">
	<article>
		<h1><?php echo __('Edit Ads');?></h1>
		<form class="form-horizontal" id="myForm" action="<?php echo url::current(true);?>" method="post" enctype="multipart/form-data">
			<div class="control-group">
				<label id="eform_alias-lbl" for="eform_alias" class="hasTip control-label" title="广告位名称"><?php echo __('名称');?></label>
				<div class="controls">
				    <input type="text" name="ads_title" class="inputbox medium required" maxlength="20" value="<?php if(!empty($ads_detail->title)){echo $ads_detail->title;}?>" />
				</div>
			</div>
			<div class="control-group">
				<label id="eform_alias-lbl" for="eform_alias" class="hasTip control-label" title="广告位类型"><?php echo __('类型');?></label>
				<div class="controls">
				    <input type="text" name="ads_type" id="ads_type" class="inputbox medium required" maxlength="20" value="<?php if(!empty($ads_detail->type)){echo $ads_detail->type;}?>" />
				</div>
			</div>
			<div class="control-group">
				<label id="eform_alias-lbl" for="eform_alias" class="hasTip control-label" title="广告位名称"><?php echo __('图片');?></label>
				<div class="controls">
				    <div id="photo_container">
    				    <?php foreach ($ads_detail->content as $pics) {?>
    				    <div class="choose_pics">
                            <div class="pic">
                                <div class="pic">
                                    <div class="pic_inner img120">
                                        <img alt="" src="/attach/<?php echo $pics['banner']?>.jpg" id="upload_pic" style="max-height:120px; max-width:120px">
                                    </div>
                                </div>
                                <ul class="inline">
            					  <li><a onclick="removepic(this)" href="javascript:;"><i class="icon-remove"></i></a></li>
            					</ul>
                                <input type="hidden" value="/attachment/view/130415617306.jpg" name="attachs[]"> 
                            </div> 
                        </div>
                        <?php }?>
                    </div>
				</div>
			</div>
			<div class="control-group">
				<a class="btn btn-primary" onclick="showresourcedialog(this,'/admin/resource/uploaddialog')">
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
<script type="text/javascript">
function facyboxclose() {
	$.fancybox.close();
}
function showresourcedialog(obj,url) {
	$.fancybox({
		'href':url,
		'padding':'30',
		'title':'选择图片',
		'titlePosition':'inside'
		});
}
function removepic(obj){
	$(obj).parents(".choose_pics").remove();
}
</script>
