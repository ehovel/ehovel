<?php defined('SYSPATH') or die('No direct script access.'); ?>
<?php echo EHOVEL::js('ehovel_template');?>
<?php echo EHOVEL::css('ehovel_modules');?>
<script type="text/javascript">
	//实例化编辑器
	window.UEDITOR_HOME_URL = "/statics/js/ueditor125/";
</script>
<?php echo EHOVEL::js('ueditor125/editor_config');?>
<?php echo EHOVEL::js('ueditor125/editor_config');?>
<?php echo EHOVEL::js('ueditor125/editor_all');?>
<script type="text/javascript">
	//实例化编辑器
	var ue = UE.getEditor('content');
</script>
<section class="container_12 clearfix">
    <?php Message::render();?>
		<h1>编辑</h1>

		<form class="uniform" id="myForm" action="<?php echo URL::current(true); ?>" method="post">
			<div class="row-fluid">
				<div class="span10 form-horizontal">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#general" data-toggle="tab"><?php echo __('文章详情');?></a></li>
						<li><a href="#publishing" data-toggle="tab"><?php echo __('发布信息');?></a></li>
						<li><a href="#piclist" data-toggle="tab"><?php echo __('图片信息');?></a></li>
						<li><a href="#metadata" data-toggle="tab"><?php echo __('SEO相关');?></a></li>
					</ul>
					<div class="tab-content">
						<!-- Begin Tabs -->
						<div class="tab-pane active" id="general">
							<fieldset class="adminform">
								<div class="control-group form-inline"></div>
								<div class="control-group form-inline">
									<label id="eform_title-lbl" for="eform_title" class="hasTip required" title="标题::标题">标题<span class="star">&#160;*</span></label>
									<input type="text" name="eform[title]" id="eform_title" value="<?php echo $content->title;?>" class="input-xlarge required" size="30" /> 
									<label id="eform_catid-lbl" for="eform_catid" class="hasTip required" title="分类::被分配给这个条目的分类。">分类<span class="star">&#160;*</span></label>
									<select id="eform_catid" name="eform[catid]" class="inputbox required">
										<?php foreach ($categories as $category) {?>
										<option value="<?php echo $category->id?>">- <?php echo $category->name;?></option>
										<?php }?>
									</select>
								</div>
								<script name="eform[content]" type="text/plain" id="content">
									<?php echo $content->content;?>
								</script>
								<div class="clearfix"></div>
							</fieldset>
							<div class="row-fluid">
								<div class="span6">
										<legend><?php echo __('Basic Info');?></legend>
										<div class="control-group">
											<label id="eform_images_image_intro_alt-lbl" for="eform_images_image_intro_alt" class="hasTip control-label" title="显示类型::你可以选择不显示网站头尾内容，一般用于特殊页面，公告页面等"><?php echo __('Show head');?></label>
											<div class="controls">
												<select name="eform[show_type]" id="show_type" class="small">
													<option value="DEFAULT"
														<?php echo (!empty($content) && 'DEFAULT' == $content->show_type) ? 'selected="selected"'
						                                    : '';?>><?php echo __('Show default');?></option>
													<option value="All"
														<?php echo (!empty($content) && 'CONTENT' == $content->show_type) ? 'selected="selected"'
						                                    : '';?>><?php echo __('Show content');?></option>
												</select>
											</div>
										</div>
										<div class="control-group">
											<label id="eform_images_image_intro_caption-lbl"
												for="eform_images_image_intro_caption"
												class="hasTip control-label" title="标题::图片的标题"><?php echo __('Position');?></label>
											<div class="controls">
												<input type="text" name="eform[position]" id="position" class="tiny digits" maxlength="255" value="<?php echo !empty($content) ? $content->position : 0;?>" />
											</div>
										</div>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="publishing">
							<div class="row-fluid">
								<div class="span6">
									<div class="control-group">
										<label id="eform_alias-lbl" for="eform_alias" class="hasTip control-label" title="别名::别名将被用于搜索引擎友好链接（SEF URL）。">别名</label>
										<div class="controls">
											<input type="text" name="eform[alias]" id="eform_alias" value="<?php echo $content->alias;?>" class="inputbox" size="45" />
										</div>
									</div>
									<div class="control-group">
										<div class="control-label">
											<label id="eform_id-lbl" for="eform_id" class="hasTip"
												title="ID::在数据库中的记录编号">ID</label>
										</div>
										<div class="controls">
											<input type="text" name="eform[id]" id="eform_id" value="<?php echo $content->id?>"
												class="readonly" size="10" readonly="readonly" disabled="disabled"/>
										</div>
									</div>
									<div class="control-group">
										<label id="eform_created_by-lbl" for="eform_created_by"
											class="hasTip control-label" title="作者::改变创建文章的用户。">作者</label>
										<div class="controls">
											<div class="input-append">
												<input class="input-medium" type="text"
													id="eform_created_by_name" value="Super User"
													disabled="disabled" /> <a
													class="btn btn-primary modal_eform_created_by" title="选择用户"
													href="index.php?option=com_users&amp;view=users&amp;layout=modal&amp;tmpl=component&amp;field=eform_created_by">&nbsp;<i
													class="icon-user"></i></a>
											</div>
											<input type="hidden" id="eform_created_by_id"
												name="eform[created_by]" value="478" />
										</div>
									</div>
									<div class="control-group">
										<label id="eform_created-lbl" for="eform_created"
											class="hasTip control-label" title="创建时间::创建时间">创建时间</label>
										<div class="controls">
											<div class="input-append">
												<input type="text" title="2011-01-01 10:01"
													name="eform[created]" id="eform_created"
													value="<?php echo $content->date_add;?>" size="22" class="inputbox" />
												<button class="btn" id="eform_created_img">
													&nbsp;<i class="icon-calendar"></i>
												</button>
											</div>
										</div>
									</div>
								</div>
								<div class="span6">
									<div class="control-group">
										<label id="eform_publish_up-lbl" for="eform_publish_up"
											class="hasTip control-label" title="开始发布::可选。文章开始发布日期。">开始发布</label>
										<div class="controls">
											<div class="input-append">
												<input type="text" title="2012-09-23 10:01"
													name="eform[publish_up]" id="eform_publish_up"
													value="2012-09-23 10:01:10" size="22" class="inputbox" />
												<button class="btn" id="eform_publish_up_img">
													&nbsp;<i class="icon-calendar"></i>
												</button>
											</div>
										</div>
									</div>
									<div class="control-group">
										<label id="eform_publish_down-lbl" for="eform_publish_down"
											class="hasTip control-label" title="结束发布::可选。文章结束发布日期。">结束发布</label>
										<div class="controls">
											<div class="input-append">
												<input type="text" title="" name="eform[publish_down]"
													id="eform_publish_down" value="0000-00-00 00:00:00"
													size="22" class="inputbox" />
												<button class="btn" id="eform_publish_down_img">
													&nbsp;<i class="icon-calendar"></i>
												</button>
											</div>
										</div>
									</div>
									<div class="control-group">
										<label id="eform_modified_by-lbl" for="eform_modified_by"
											class=" control-label">修改者</label>
										<div class="controls">
											<div class="input-append">
												<input class="input-medium" type="text"
													id="eform_modified_by_name" value="Super User"
													disabled="disabled" class="readonly" />
											</div>
											<input type="hidden" id="eform_modified_by_id"
												name="eform[modified_by]" value="478" />
										</div>
									</div>
									<div class="control-group">
										<label id="eform_modified-lbl" for="eform_modified"
											class="hasTip control-label" title="修改时间::文章的最后修改日期及时间。">修改时间</label>
										<div class="controls">
											<input type="text" title="2013-03-12 08:39"
												value="2013-03-12 08:39:51" size="22" class="readonly"
												readonly="readonly" /><input type="hidden"
												name="eform[modified]" id="eform_modified"
												value="2013-03-12 08:39:51" />
										</div>
									</div>
	
									<div class="control-group">
										<label id="eform_version-lbl" for="eform_version"
											class="hasTip control-label" title="修订次数::该文章被修改的次数。">修订次数</label>
										<div class="controls">
											<input type="text" name="eform[version]" id="eform_version"
												value="5" class="readonly" size="6" readonly="readonly" />
										</div>
									</div>
	
									<div class="control-group">
										<div class="control-label">
											<label id="eform_hits-lbl" for="eform_hits" class="hasTip"
												title="点击::该文章的点击次数">点击</label>
										</div>
										<div class="controls">
											<input type="text" name="eform[hits]" id="eform_hits"
												value="211" class="readonly" size="6" readonly="readonly" />
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane clearfix" id="piclist">
							<div class="control-group">
								<a class="btn btn-primary" id="upload_pictures" onclick="showresourcedialog()">
									<i class="icon-picture"></i>选择图片
								</a>
							</div>
							<?php foreach ($content->images as $imgId) {?>
							<div class="choose_pics">
		                        <div class="pic">
		                            <div class="pic">
		                                <div class="pic_inner img120">
		                                    <img alt="" src="<?php echo Helper_Resource::getLinkByResourceId($imgId)?>" id="upload_pic" style="max-height:120px; max-width:120px">
		                                </div>
		                            </div>
		                            <ul class="inline">
									  <li><a onclick="removepic(this)" href="javascript:;"><i class="icon-remove"></i></a></li>
									</ul>
	                            </div>
	                            <input type="hidden" name="eform[resource_ids][]" value="<?php echo $imgId?>" />
	                        </div>
	                        <?php }?>
						</div>
	
						<div class="tab-pane" id="metadata">
						        <div class="control-group">
									<label id="eform_metadesc-lbl" for="eform_metadesc" class="hasTip control-label" title="title">T</label>
									<div class="controls">
										<input type="text" name="eform[seo_title]" id="eform_metadesc" value="<?php echo $content->seo_title?>" class="inputbox input-xxlarge" />
									</div>
								</div>
								<div class="control-group">
									<label id="eform_metadesc-lbl" for="eform_metadesc" class="hasTip control-label" title="keywords">K</label>
									<div class="controls">
										<textarea name="eform[seo_keywords]" id="eform_metadesc" cols="30" rows="3" class="inputbox input-xxlarge"><?php echo $content->seo_keywords?></textarea>
									</div>
								</div>
								<div class="control-group">
									<label id="eform_metakey-lbl" for="eform_metakey" class="hasTip control-label" title="关键词::可选。逗号分隔的关键词、短语用于HTML输出。">D</label>
									<div class="controls">
										<textarea name="eform[seo_description]" id="eform_metakey" cols="30" rows="3" class="inputbox input-xxlarge"><?php echo $content->seo_description?></textarea>
									</div>
								</div>
								<div class="control-group">
									<label id="eform_metadata_robots-lbl"
										for="eform_metadata_robots" class="hasTip control-label"
										title="机器人::机器人说明">机器人</label>
									<div class="controls">
										<select id="eform_metadata_robots" name="eform[metadata][robots]">
											<option value="" selected="selected">使用全局设置</option>
											<option value="index, follow">Index,Follow</option>
											<option value="noindex, follow">No index,follow</option>
											<option value="index, nofollow">Index,No follow</option>
											<option value="noindex, nofollow">No index,no follow</option>
										</select>
									</div>
								</div>
								<div class="control-group">
									<label id="eform_metadata_author-lbl"
										for="eform_metadata_author" class="hasTip control-label"
										title="作者::这个内容的作者">作者</label>
									<div class="controls">
										<input type="text" name="eform[metadata][author]"
											id="eform_metadata_author" value="" size="20" />
									</div>
								</div>
								<div class="control-group">
									<label id="eform_metadata_rights-lbl"
										for="eform_metadata_rights" class="hasTip control-label"
										title="内容版权::描述其他人以什么样的权利使用此内容。">内容版权</label>
									<div class="controls">
										<textarea name="eform[metadata][rights]"
											id="eform_metadata_rights" cols="30" rows="2"></textarea>
									</div>
								</div>
								<div class="control-group">
									<label id="eform_metadata_xreference-lbl"
										for="eform_metadata_xreference" class="hasTip control-label"
										title="外部参考::可选。链接到外部数据源的引用参考。">外部参考</label>
									<div class="controls">
										<input type="text" name="eform[metadata][xreference]"
											id="eform_metadata_xreference" value="" class="inputbox"
											size="20" />
									</div>
								</div>
						</div>
						<!-- End Tabs -->
					</div>
				</div>
			</div>
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="return" value="" />
		</form>
</section>
<div id="upload"><p class="upload" id="uploaddialog"></p></div>
<?php echo EHOVEL::js('ehovel_upload');?>
<script type="text/javascript">
function showresourcedialog() {
	$('#upload_pictures').Upload({
		title: '图片上传',
		file_size_limit: '1 MB',
		file_types: '*.jpg;*.gif;*.png;',
		file_upload_limit: 10,
		session_id: '<?php echo Session::instance()->id();?>',
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
				h += '<input type="hidden" value="'+ server_data[i]['id'] +'" name="eform[resource_ids][]"></div></div>';
				h = $(h);
				$('#piclist').append(h);
			}
		}
		});
}
function removepic(obj){
	$(obj).parents(".choose_pics").remove();
}
Ehovel.submitbutton = function(task) {
	if(ue.hasContents()){ //此处以非空为例
	    ue.sync();       //同步内容
	    Ehovel.submitform(task, document.getElementById('myForm'));
	}
}
</script> 