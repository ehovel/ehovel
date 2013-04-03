<?php defined('SYSPATH') or die('No direct script access.'); ?>
<?php echo EHOVEL::js('joomla_template');?>
<script type="text/javascript">
	//实例化编辑器
	window.UEDITOR_HOME_URL = "/statics/js/ueditor125/";
</script>
<?php echo EHOVEL::js('ueditor125/editor_config');?>
<?php echo EHOVEL::js('ueditor125/editor_all');?>
<script type="text/javascript">
	//实例化编辑器
	var ue = UE.getEditor('introtext');
</script>
<section class="container_12 clearfix">
    <?php Message::render();?>
		<h1>编辑</h1>

		<form class="uniform" id="myForm" action="<?php echo URL::current(true); ?>"
			method="post">
			<div class="row-fluid">
				<div class="span10 form-horizontal">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#general" data-toggle="tab"><?php echo __('文章详情');?></a></li>
						<li><a href="#publishing" data-toggle="tab"><?php echo __('发布信息');?></a></li>
						<li><a href="#attrib-basic" data-toggle="tab"><?php echo __('文章选项');?></a></li>
						<li><a href="#metadata" data-toggle="tab"><?php echo __('SEO相关');?></a></li>
					</ul>
					<div class="tab-content">
						<!-- Begin Tabs -->
						<div class="tab-pane active" id="general">
							<fieldset class="adminform">
								<div class="control-group form-inline">
									<label id="eform_title-lbl" for="eform_title" class="hasTip required" title="标题::标题">标题<span class="star">&#160;*</span></label>
									<input type="text" name="eform[title]" id="eform_title" value="<?php echo $content->title;?>" class="input-xlarge required" size="30" /> 
									<label id="eform_catid-lbl" for="eform_catid" class="hasTip required" title="分类::被分配给这个条目的分类。">分类<span class="star">&#160;*</span></label>
									<select id="eform_catid" name="eform[catid]" class="inputbox required">
										<?php foreach ($categories as $category) {?>
										<option value="<?php echo $category->id?>">- <?php echo $category->title;?></option>
										<?php }?>
									</select>
								</div>
								<script name="eform[introtext]" type="text/plain" id="introtext">
									<?php echo $content->introtext;?>
								</script>
	
								<div id="editor-xtd-buttons" class="btn-toolbar pull-left">
	
									<div class="btn-toolbar">
										<a class="modal-button btn" title="文章" class="btn"
											href="http://www.joomla-local-1.com/administrator/index.php?option=com_content&amp;view=articles&amp;layout=modal&amp;tmpl=component&amp;4792734d839562526027b22222001655=1"
											onclick="IeCursorFix(); return false;"
											rel="{handler: 'iframe', size: {x: 800, y: 500}}"><i
											class="icon-file-add"></i> 文章</a> <a class="modal-button btn"
											title="图片" class="btn"
											href="http://www.joomla-local-1.com/administrator/index.php?option=com_media&amp;view=images&amp;tmpl=component&amp;e_name=eform_articletext&amp;asset=35&amp;author=478"
											onclick="IeCursorFix(); return false;"
											rel="{handler: 'iframe', size: {x: 800, y: 500}}"><i
											class="icon-picture"></i> 图片</a> <a class="modal-button btn"
											title="分页符" class="btn"
											href="http://www.joomla-local-1.com/administrator/index.php?option=com_content&amp;view=article&amp;layout=pagebreak&amp;tmpl=component&amp;e_name=eform_articletext"
											onclick="IeCursorFix(); return false;"
											rel="{handler: 'iframe', size: {x: 500, y: 300}}"><i
											class="icon-copy"></i> 分页符</a> <a title="阅读更多" class="btn"
											href="http://www.joomla-local-1.com/administrator/#"
											onclick="insertReadmore('eform_articletext');return false;"
											rel=""><i class="icon-arrow-down"></i> 阅读更多</a>
									</div>
								</div>
	
								<div class="toggle-editor btn-toolbar pull-right">
									<div class="btn-group">
										<a class="btn" href="#"
											onclick="tinyMCE.execCommand('mceToggleEditor', false, 'eform_articletext');return false;"
											title="切换编辑器"><i class="icon-eye"></i> 切换编辑器</a>
									</div>
								</div>
								<div class="clearfix"></div>
							</fieldset>
							<div class="row-fluid">
								<div class="span6">
									<legend><?php echo __('图片和链接');?></legend>
									<div class="control-group">
										<div class="controls"></div>
									</div>
									<div class="control-group">
										<label id="eform_images_image_intro-lbl"
											for="eform_images_image_intro" class="hasTip control-label"
											title="引言图片::博客式排版时显示的引言使用的图片">引言图片</label>
										<div class="controls">
											<div class="input-prepend input-append">
												<div class="media-preview add-on">
												<span title="" class="hasTipPreview"><i class="icon-eye"></i></span>
												</div>
													<input type="text" readonly="readonly" value="" id="eform_images_image_intro" name="eform[images][image_intro]" class="input-small">
												<a rel="{handler: 'iframe', size: {x: 800, y: 500}}" href="index.php?option=com_media&amp;view=images&amp;tmpl=component&amp;asset=35&amp;author=478&amp;fieldid=eform_images_image_intro&amp;folder=" title="选择" class="btn">
												选择</a><a onclick="
												jInsertFieldValue('', 'eform_images_image_intro');
												return false;
												" href="#" class="btn hasTooltip" data-original-title="清除">&nbsp;<i class="icon-remove"></i></a>
											</div>									
										</div>
									</div>
									<div class="control-group">
										<label id="eform_images_float_intro-lbl"
											for="eform_images_float_intro" class="hasTip control-label"
											title="图片浮动::控制图片的位置安排">图片浮动</label>
										<div class="controls">
											<select id="eform_images_float_intro"
												name="eform[images][float_intro]">
												<option value="" selected="selected">使用全局设置</option>
												<option value="right">右浮动</option>
												<option value="left">左浮动</option>
												<option value="none">无</option>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label id="eform_images_image_intro_alt-lbl"
											for="eform_images_image_intro_alt"
											class="hasTip control-label"
											title="文字替身::未访问到图片的访客将看到的替换性的文本。将以标题文本代替图片。">文字替身</label>
										<div class="controls">
											<input type="text" name="eform[images][image_intro_alt]"
												id="eform_images_image_intro_alt" value="" class="inputbox"
												size="20" />
										</div>
									</div>
									<div class="control-group">
										<label id="eform_images_image_intro_caption-lbl"
											for="eform_images_image_intro_caption"
											class="hasTip control-label" title="标题::图片的标题">标题</label>
										<div class="controls">
											<input type="text" name="eform[images][image_intro_caption]"
												id="eform_images_image_intro_caption" value=""
												class="inputbox" size="20" />
										</div>
									</div>
								</div>
								<div class="span6">
										<legend><?php echo __('Basic Info');?></legend>
										<div class="control-group">
											<label id="eform_images_image_intro_alt-lbl" for="eform_images_image_intro_alt" class="hasTip control-label" title="文字替身::未访问到图片的访客将看到的替换性的文本。将以标题文本代替图片。"><?php echo __('Show type');?></label>
											<div class="controls">
												<select name="eform[show_type]" id="show_type" class="small">
													<option value="DEFAULT"
														<?php echo (!empty($model_content) && 'DEFAULT' == $model_content->show_type) ? 'selected="selected"'
						                                    : '';?>><?php echo __('show Default');?></option>
													<option value="All"
														<?php echo (!empty($model_content) && 'ALL' == $model_content->show_type) ? 'selected="selected"'
						                                    : '';?>><?php echo __('show all content');?></option>
													<option value="HEAD"
														<?php echo (!empty($model_content) && 'HEAD' == $model_content->show_type) ? 'selected="selected"'
						                                    : '';?>><?php echo __('show head');?></option>
												</select>
											</div>
										</div>
										<div class="control-group">
											<label id="eform_images_image_intro_caption-lbl"
												for="eform_images_image_intro_caption"
												class="hasTip control-label" title="标题::图片的标题"><?php echo __('Position');?></label>
											<div class="controls">
												<input type="text" name="eform[position]" id="position"
													class="tiny digits" maxlength="255"
													value="<?php echo !empty($content) ? $content->ordering : 0;?>" />
											</div>
										</div>
										<div class="control-group">
											<label id="eform_attribs_alternative_readmore-lbl"
												for="eform_attribs_alternative_readmore"
												class="hasTip control-label"
												title="替代“阅读更多”的说法::添加自定义文字用于替代'阅读更多'的说法">替代“阅读更多”的说法</label>
											<div class="controls">
												<input type="text" name="eform[attribs][alternative_readmore]"
													id="eform_attribs_alternative_readmore" value=""
													class="inputbox" size="25" />
											</div>
										</div>
										<div class="control-group">
											<label id="eform_attribs_article_layout-lbl"
												for="eform_attribs_article_layout" class="hasTip control-label"
												title="备用布局::使用由组件或模板提供的不同的布局。">备用布局</label>
											<div class="controls">
												<select id="eform_attribs_article_layout"
													name="eform[attribs][article_layout]">
													<optgroup label="---从全局设置---">
														<option value="" selected="selected">使用全局设置</option>
													</optgroup>
													<optgroup id="eform_attribs_article_layout__" label="---从组件---">
														<option value="_:default">默认</option>
													</optgroup>
												</select>
											</div>
										</div>
								</div>
							</div>
						</div>
	
						<div class="tab-pane" id="publishing">
							<div class="row-fluid">
								<div class="span6">
									<div class="control-group">
										<label id="eform_alias-lbl" for="eform_alias"
											class="hasTip control-label"
											title="别名::别名将被用于搜索引擎友好链接（SEF URL）。留空则从根据标题中填写一个默认值，此值将取决于搜索引擎优化设置（全局设置-&gt;网站）。 &lt;br /&gt;使用Unicode别名将产生 UTF-8 的链接。 您也可以手动输入任何UTF-8字符。空格和一些被禁止使用的字符将被更改为连字符（-）。&lt;br /&gt;在使用默认直译的时候，生成的小写字母组成的别名，并且空格将会被小写的连字符（-）代替。您可以手动输入别名，使用小写字母和连字符（-）。 不允许使用空格和下划线（ _ ）。如果标题输入的是非拉丁字母时，默认值由发表日期和时间组成。">别名</label>
										<div class="controls">
											<input type="text" name="eform[alias]" id="eform_alias"
												value="<?php echo $content->alias;?>" class="inputbox" size="45" />
										</div>
									</div>
									<div class="control-group">
										<div class="control-label">
											<label id="eform_id-lbl" for="eform_id" class="hasTip"
												title="ID::在数据库中的记录编号">ID</label>
										</div>
										<div class="controls">
											<input type="text" name="eform[id]" id="eform_id" value="3"
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
													href="index.php?option=com_users&amp;view=users&amp;layout=modal&amp;tmpl=component&amp;field=eform_created_by"
													rel="{handler: 'iframe', size: {x: 800, y: 500}}">&nbsp;<i
													class="icon-user"></i></a>
											</div>
											<input type="hidden" id="eform_created_by_id"
												name="eform[created_by]" value="478" />
										</div>
									</div>
									<div class="control-group">
										<label id="eform_created_by_alias-lbl"
											for="eform_created_by_alias" class="hasTip control-label"
											title="作者笔名::输入别名。可以在前台显示时取代创建者的用户姓名。（笔名）">作者笔名</label>
										<div class="controls">
											<input type="text" name="eform[created_by_alias]"
												id="eform_created_by_alias" value="<?php echo $content->created_by_alias;?>" class="inputbox"
												size="20" />
										</div>
									</div>
									<div class="control-group">
										<label id="eform_created-lbl" for="eform_created"
											class="hasTip control-label" title="创建时间::创建时间">创建时间</label>
										<div class="controls">
											<div class="input-append">
												<input type="text" title="2011-01-01 10:01"
													name="eform[created]" id="eform_created"
													value="<?php echo $content->created;?>" size="22" class="inputbox" />
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
						<div class="tab-pane" id="attrib-basic">
							<div class="control-group">
								<label id="eform_attribs_show_title-lbl"
									for="eform_attribs_show_title" class="hasTip control-label"
									title="显示标题::如果设置为显示，文章的标题将显示。">显示标题</label>
								<div class="controls">
									<fieldset id="eform_attribs_show_title" class="radio btn-group">
										<input type="radio" id="eform_attribs_show_title0"
											name="eform[attribs][show_title]" value="" checked="checked" /><label
											for="eform_attribs_show_title0">使用全局设置</label><input
											type="radio" id="eform_attribs_show_title1"
											name="eform[attribs][show_title]" value="0" /><label
											for="eform_attribs_show_title1">隐藏</label><input type="radio"
											id="eform_attribs_show_title2"
											name="eform[attribs][show_title]" value="1" /><label
											for="eform_attribs_show_title2">显示</label>
									</fieldset>
								</div>
							</div>
							<div class="control-group">
								<label id="eform_attribs_show_create_date-lbl"
									for="eform_attribs_show_create_date"
									class="hasTip control-label"
									title="显示创建日期::如果设置为显示，则文章的创建日期和时间会被显示。这是全局设置，但是可被分类，菜单和文章设置更改。">显示创建日期</label>
								<div class="controls">
									<fieldset id="eform_attribs_show_create_date"
										class="radio btn-group">
										<input type="radio" id="eform_attribs_show_create_date0"
											name="eform[attribs][show_create_date]" value=""
											checked="checked" /><label
											for="eform_attribs_show_create_date0">使用全局设置</label><input
											type="radio" id="eform_attribs_show_create_date1"
											name="eform[attribs][show_create_date]" value="0" /><label
											for="eform_attribs_show_create_date1">隐藏</label><input
											type="radio" id="eform_attribs_show_create_date2"
											name="eform[attribs][show_create_date]" value="1" /><label
											for="eform_attribs_show_create_date2">显示</label>
									</fieldset>
								</div>
							</div>
							<div class="control-group">
								<label id="eform_attribs_show_modify_date-lbl"
									for="eform_attribs_show_modify_date"
									class="hasTip control-label"
									title="显示修改时间::如果设置为显示，文章的最后修改日期和时间将被显示。这是全局设置，但是可以被分类，菜单和文章设置更改。">显示修改时间</label>
								<div class="controls">
									<fieldset id="eform_attribs_show_modify_date"
										class="radio btn-group">
										<input type="radio" id="eform_attribs_show_modify_date0"
											name="eform[attribs][show_modify_date]" value=""
											checked="checked" /><label
											for="eform_attribs_show_modify_date0">使用全局设置</label><input
											type="radio" id="eform_attribs_show_modify_date1"
											name="eform[attribs][show_modify_date]" value="0" /><label
											for="eform_attribs_show_modify_date1">隐藏</label><input
											type="radio" id="eform_attribs_show_modify_date2"
											name="eform[attribs][show_modify_date]" value="1" /><label
											for="eform_attribs_show_modify_date2">显示</label>
									</fieldset>
								</div>
							</div>
							<div class="control-group">
								<label id="eform_attribs_show_hits-lbl"
									for="eform_attribs_show_hits" class="hasTip control-label"
									title="显示浏览量::如果设置为显示，个别的文章的浏览量将被显示。这是全局设置，但是可被分类，菜单和文章设置更改。">显示浏览量</label>
								<div class="controls">
									<fieldset id="eform_attribs_show_hits" class="radio btn-group">
										<input type="radio" id="eform_attribs_show_hits0"
											name="eform[attribs][show_hits]" value="" checked="checked" /><label
											for="eform_attribs_show_hits0">使用全局设置</label><input
											type="radio" id="eform_attribs_show_hits1"
											name="eform[attribs][show_hits]" value="0" /><label
											for="eform_attribs_show_hits1">隐藏</label><input type="radio"
											id="eform_attribs_show_hits2" name="eform[attribs][show_hits]"
											value="1" /><label for="eform_attribs_show_hits2">显示</label>
									</fieldset>
								</div>
							</div>
							<div class="control-group">
								<label id="eform_attribs_show_noauth-lbl"
									for="eform_attribs_show_noauth" class="hasTip control-label"
									title="显示未经许可链接::如果设置为是，在没有登陆的情况下，需已注册用户访问的内容，将会显示一个链接。您需要登陆才能浏览全文。">显示未经许可链接</label>
								<div class="controls">
									<fieldset id="eform_attribs_show_noauth" class="radio btn-group">
										<input type="radio" id="eform_attribs_show_noauth0"
											name="eform[attribs][show_noauth]" value="" checked="checked" /><label
											for="eform_attribs_show_noauth0">使用全局设置</label><input
											type="radio" id="eform_attribs_show_noauth1"
											name="eform[attribs][show_noauth]" value="0" /><label
											for="eform_attribs_show_noauth1">否</label><input type="radio"
											id="eform_attribs_show_noauth2"
											name="eform[attribs][show_noauth]" value="1" /><label
											for="eform_attribs_show_noauth2">是</label>
									</fieldset>
								</div>
							</div>
							<div class="control-group">
								<label id="eform_attribs_urls_position-lbl"
									for="eform_attribs_urls_position" class="hasTip control-label"
									title="链接的位置::将链接显示于内容之上还是之下">链接的位置</label>
								<div class="controls">
									<fieldset id="eform_attribs_urls_position"
										class="radio btn-group">
										<input type="radio" id="eform_attribs_urls_position0"
											name="eform[attribs][urls_position]" value=""
											checked="checked" /><label for="eform_attribs_urls_position0">使用全局设置</label><input
											type="radio" id="eform_attribs_urls_position1"
											name="eform[attribs][urls_position]" value="0" /><label
											for="eform_attribs_urls_position1">内容之上</label><input
											type="radio" id="eform_attribs_urls_position2"
											name="eform[attribs][urls_position]" value="1" /><label
											for="eform_attribs_urls_position2">内容之下</label>
									</fieldset>
								</div>
							</div>
							<div class="control-group">
								<span class="spacer"><span class="before"></span><span class=""><hr
											class="" /></span><span class="after"></span></span>
								<div class="controls"></div>
							</div>
						</div>
						<div class="tab-pane" id="attrib-editorConfig"></div>
						<div class="tab-pane" id="attrib-basic-limited"></div>
						<div class="tab-pane" id="editor">
							<div class="control-group">
								<label id="eform_attribs_show_publishing_options-lbl"
									for="eform_attribs_show_publishing_options"
									class="hasTip control-label"
									title="显示发布选项::在文章编辑视图里显示或隐藏发布选项滑块。这些选项允许根据指定的日期和作者而变化。">显示发布选项</label>
								<div class="controls">
									<fieldset id="eform_attribs_show_publishing_options"
										class="radio btn-group">
										<input type="radio" id="eform_attribs_show_publishing_options0"
											name="eform[attribs][show_publishing_options]" value=""
											checked="checked" /><label
											for="eform_attribs_show_publishing_options0">使用全局设置</label><input
											type="radio" id="eform_attribs_show_publishing_options1"
											name="eform[attribs][show_publishing_options]" value="0" /><label
											for="eform_attribs_show_publishing_options1">否</label><input
											type="radio" id="eform_attribs_show_publishing_options2"
											name="eform[attribs][show_publishing_options]" value="1" /><label
											for="eform_attribs_show_publishing_options2">是</label>
									</fieldset>
								</div>
							</div>
							<div class="control-group">
								<label id="eform_attribs_show_article_options-lbl"
									for="eform_attribs_show_article_options"
									class="hasTip control-label"
									title="显示文章选项::在管理后台的文章编辑视图里显示或隐藏文章选项滑块。这些选项允许覆盖全局设置里的相应设置。">显示文章选项</label>
								<div class="controls">
									<fieldset id="eform_attribs_show_article_options"
										class="radio btn-group">
										<input type="radio" id="eform_attribs_show_article_options0"
											name="eform[attribs][show_article_options]" value=""
											checked="checked" /><label
											for="eform_attribs_show_article_options0">使用全局设置</label><input
											type="radio" id="eform_attribs_show_article_options1"
											name="eform[attribs][show_article_options]" value="0" /><label
											for="eform_attribs_show_article_options1">否</label><input
											type="radio" id="eform_attribs_show_article_options2"
											name="eform[attribs][show_article_options]" value="1" /><label
											for="eform_attribs_show_article_options2">是</label>
									</fieldset>
								</div>
							</div>
							<div class="control-group">
								<label id="eform_attribs_show_urls_images_backend-lbl"
									for="eform_attribs_show_urls_images_backend"
									class="hasTip control-label"
									title="管理后台编辑的图片和链接::在管理后台显示或隐藏插入标准化的图片和链接的区域">管理后台编辑的图片和链接</label>
								<div class="controls">
									<fieldset id="eform_attribs_show_urls_images_backend"
										class="radio btn-group">
										<input type="radio"
											id="eform_attribs_show_urls_images_backend0"
											name="eform[attribs][show_urls_images_backend]" value=""
											checked="checked" /><label
											for="eform_attribs_show_urls_images_backend0">使用全局设置</label><input
											type="radio" id="eform_attribs_show_urls_images_backend1"
											name="eform[attribs][show_urls_images_backend]" value="0" /><label
											for="eform_attribs_show_urls_images_backend1">否</label><input
											type="radio" id="eform_attribs_show_urls_images_backend2"
											name="eform[attribs][show_urls_images_backend]" value="1" /><label
											for="eform_attribs_show_urls_images_backend2">是</label>
									</fieldset>
								</div>
							</div>
							<div class="control-group">
								<label id="eform_attribs_show_urls_images_frontend-lbl"
									for="eform_attribs_show_urls_images_frontend"
									class="hasTip control-label"
									title="前台编辑的图片和链接::显示或隐藏前台编辑时的插入标准化的图片和链接的区域">前台编辑的图片和链接</label>
								<div class="controls">
									<fieldset id="eform_attribs_show_urls_images_frontend"
										class="radio btn-group">
										<input type="radio"
											id="eform_attribs_show_urls_images_frontend0"
											name="eform[attribs][show_urls_images_frontend]" value=""
											checked="checked" /><label
											for="eform_attribs_show_urls_images_frontend0">使用全局设置</label><input
											type="radio" id="eform_attribs_show_urls_images_frontend1"
											name="eform[attribs][show_urls_images_frontend]" value="0" /><label
											for="eform_attribs_show_urls_images_frontend1">否</label><input
											type="radio" id="eform_attribs_show_urls_images_frontend2"
											name="eform[attribs][show_urls_images_frontend]" value="1" /><label
											for="eform_attribs_show_urls_images_frontend2">是</label>
									</fieldset>
								</div>
							</div>
						</div>
	
						<div class="tab-pane" id="metadata">
								<div class="control-group">
									<label id="eform_metadesc-lbl" for="eform_metadesc"
										class="hasTip control-label"
										title="简介::可选。该段文字用于在页面HTML中的description标签。description标签常常被搜索引擎用于搜索结果中。">简介</label>
									<div class="controls">
										<textarea name="eform[metadesc]" id="eform_metadesc" cols="30"
											rows="3" class="inputbox"></textarea>
									</div>
								</div>
								<div class="control-group">
									<label id="eform_metakey-lbl" for="eform_metakey"
										class="hasTip control-label"
										title="关键词::可选。逗号分隔的关键词、短语用于HTML输出。">关键词</label>
									<div class="controls">
										<textarea name="eform[metakey]" id="eform_metakey" cols="30"
											rows="3" class="inputbox"></textarea>
									</div>
								</div>
								<div class="control-group">
									<label id="eform_metadata_robots-lbl"
										for="eform_metadata_robots" class="hasTip control-label"
										title="机器人::机器人说明">机器人</label>
									<div class="controls">
										<select id="eform_metadata_robots"
											name="eform[metadata][robots]">
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
	
						<div class="tab-pane" id="permissions">
							<fieldset>
								<p class="rule-desc">管理此用户组的权限设置。</p>
								<div id="permissions-sliders" class="tabbable tabs-left">
									<ul class="nav nav-tabs">
										<li class="active"><a href="#permission-1" data-toggle="tab">
												Public </a></li>
										<li class=""><a href="#permission-9" data-toggle="tab"> <span
												class="level">&ndash;</i> Guest </a></li>
										<li class=""><a href="#permission-6" data-toggle="tab"> <span
												class="level">&ndash;</i> Manager </a></li>
										<li class=""><a href="#permission-7" data-toggle="tab"> <span
												class="level">&ndash;</i> <span class="level">&ndash;</i>
														Administrator </a></li>
										<li class=""><a href="#permission-2" data-toggle="tab"> <span
												class="level">&ndash;</i> Registered </a></li>
										<li class=""><a href="#permission-3" data-toggle="tab"> <span
												class="level">&ndash;</i> <span class="level">&ndash;</i>
														Author </a></li>
										<li class=""><a href="#permission-4" data-toggle="tab"> <span
												class="level">&ndash;</i> <span class="level">&ndash;</i> <span
														class="level">&ndash;</i> Editor </a></li>
										<li class=""><a href="#permission-5" data-toggle="tab"> <span
												class="level">&ndash;</i> <span class="level">&ndash;</i> <span
														class="level">&ndash;</i> <span class="level">&ndash;</i>
																Publisher </a></li>
										<li class=""><a href="#permission-8" data-toggle="tab"> <span
												class="level">&ndash;</i> Super Users </a></li>
									</ul>
									<div class="tab-content">
										<div class="tab-pane active" id="permission-1">
											<table class="table table-striped">
												<thead>
													<tr>
														<th class="actions" id="actions-th1"><span
															class="acl-action">操作</span></th>
														<th class="settings" id="settings-th1"><span
															class="acl-action">选择新设置<sup>1</sup></span></th>
														<th id="aclactionth1"><span class="acl-action">计算出的实际设置<sup>2</sup></span>
														</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td headers="actions-th1"><label class="tip"
															for="eform_rules_core.delete_1"
															title="删除任何内容 该文章的&lt;strong&gt;删除功能&lt;/strong&gt;的权限设置和基于父级分类和用户组权限计算出来的权限。">
																删除任何内容 </label></td>
														<td headers="settings-th1"><select class="input-small"
															name="eform[rules][core.delete][1]"
															id="eform_rules_core.delete_1"
															title="允许或拒绝删除任何内容，对于 Public 用户组里的用户">
																<option value="" selected="selected">继承</option>
																<option value="1">允许</option>
																<option value="0">拒绝</option>
														</select>&#160;</td>
														<td headers="aclactionth1"><span
															class="label label-important">不允许</span></td>
													</tr>
													<tr>
														<td headers="actions-th1"><label class="tip"
															for="eform_rules_core.edit_1"
															title="编辑任何内容 该文章的&lt;strong&gt;编辑功能&lt;/strong&gt;的权限设置和基于父级分类和用户组权限计算出来的权限。">
																编辑任何内容 </label></td>
														<td headers="settings-th1"><select class="input-small"
															name="eform[rules][core.edit][1]"
															id="eform_rules_core.edit_1"
															title="允许或拒绝编辑任何内容，对于 Public 用户组里的用户">
																<option value="" selected="selected">继承</option>
																<option value="1">允许</option>
																<option value="0">拒绝</option>
														</select>&#160;</td>
														<td headers="aclactionth1"><span
															class="label label-important">不允许</span></td>
													</tr>
													<tr>
														<td headers="actions-th1"><label class="tip"
															for="eform_rules_core.edit.state_1"
															title="修改任何内容的状态 该文章的&lt;strong&gt;修改状态&lt;/strong&gt;的权限设置和基于父级分类和用户组权限计算出来的权限。">
																修改任何内容的状态 </label></td>
														<td headers="settings-th1"><select class="input-small"
															name="eform[rules][core.edit.state][1]"
															id="eform_rules_core.edit.state_1"
															title="允许或拒绝修改任何内容的状态，对于 Public 用户组里的用户">
																<option value="" selected="selected">继承</option>
																<option value="1">允许</option>
																<option value="0">拒绝</option>
														</select>&#160;</td>
														<td headers="aclactionth1"><span
															class="label label-important">不允许</span></td>
													</tr>
												</tbody>
											</table>
										</div>
										<div class="tab-pane" id="permission-9">
											<table class="table table-striped">
												<thead>
													<tr>
														<th class="actions" id="actions-th9"><span
															class="acl-action">操作</span></th>
														<th class="settings" id="settings-th9"><span
															class="acl-action">选择新设置<sup>1</sup></span></th>
														<th id="aclactionth9"><span class="acl-action">计算出的实际设置<sup>2</sup></span>
														</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td headers="actions-th9"><label class="tip"
															for="eform_rules_core.delete_9"
															title="删除任何内容 该文章的&lt;strong&gt;删除功能&lt;/strong&gt;的权限设置和基于父级分类和用户组权限计算出来的权限。">
																删除任何内容 </label></td>
														<td headers="settings-th9"><select class="input-small"
															name="eform[rules][core.delete][9]"
															id="eform_rules_core.delete_9"
															title="允许或拒绝删除任何内容，对于 Guest 用户组里的用户">
																<option value="" selected="selected">继承</option>
																<option value="1">允许</option>
																<option value="0">拒绝</option>
														</select>&#160;</td>
														<td headers="aclactionth9"><span
															class="label label-important">不允许</span></td>
													</tr>
													<tr>
														<td headers="actions-th9"><label class="tip"
															for="eform_rules_core.edit_9"
															title="编辑任何内容 该文章的&lt;strong&gt;编辑功能&lt;/strong&gt;的权限设置和基于父级分类和用户组权限计算出来的权限。">
																编辑任何内容 </label></td>
														<td headers="settings-th9"><select class="input-small"
															name="eform[rules][core.edit][9]"
															id="eform_rules_core.edit_9"
															title="允许或拒绝编辑任何内容，对于 Guest 用户组里的用户">
																<option value="" selected="selected">继承</option>
																<option value="1">允许</option>
																<option value="0">拒绝</option>
														</select>&#160;</td>
														<td headers="aclactionth9"><span
															class="label label-important">不允许</span></td>
													</tr>
													<tr>
														<td headers="actions-th9"><label class="tip"
															for="eform_rules_core.edit.state_9"
															title="修改任何内容的状态 该文章的&lt;strong&gt;修改状态&lt;/strong&gt;的权限设置和基于父级分类和用户组权限计算出来的权限。">
																修改任何内容的状态 </label></td>
														<td headers="settings-th9"><select class="input-small"
															name="eform[rules][core.edit.state][9]"
															id="eform_rules_core.edit.state_9"
															title="允许或拒绝修改任何内容的状态，对于 Guest 用户组里的用户">
																<option value="" selected="selected">继承</option>
																<option value="1">允许</option>
																<option value="0">拒绝</option>
														</select>&#160;</td>
														<td headers="aclactionth9"><span
															class="label label-important">不允许</span></td>
													</tr>
												</tbody>
											</table>
										</div>
										<div class="tab-pane" id="permission-6">
											<table class="table table-striped">
												<thead>
													<tr>
														<th class="actions" id="actions-th6"><span
															class="acl-action">操作</span></th>
														<th class="settings" id="settings-th6"><span
															class="acl-action">选择新设置<sup>1</sup></span></th>
														<th id="aclactionth6"><span class="acl-action">计算出的实际设置<sup>2</sup></span>
														</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td headers="actions-th6"><label class="tip"
															for="eform_rules_core.delete_6"
															title="删除任何内容 该文章的&lt;strong&gt;删除功能&lt;/strong&gt;的权限设置和基于父级分类和用户组权限计算出来的权限。">
																删除任何内容 </label></td>
														<td headers="settings-th6"><select class="input-small"
															name="eform[rules][core.delete][6]"
															id="eform_rules_core.delete_6"
															title="允许或拒绝删除任何内容，对于 Manager 用户组里的用户">
																<option value="">继承</option>
																<option value="1" selected="selected">允许</option>
																<option value="0">拒绝</option>
														</select>&#160;</td>
														<td headers="aclactionth6"><span
															class="label label-success">允许</span></td>
													</tr>
													<tr>
														<td headers="actions-th6"><label class="tip"
															for="eform_rules_core.edit_6"
															title="编辑任何内容 该文章的&lt;strong&gt;编辑功能&lt;/strong&gt;的权限设置和基于父级分类和用户组权限计算出来的权限。">
																编辑任何内容 </label></td>
														<td headers="settings-th6"><select class="input-small"
															name="eform[rules][core.edit][6]"
															id="eform_rules_core.edit_6"
															title="允许或拒绝编辑任何内容，对于 Manager 用户组里的用户">
																<option value="">继承</option>
																<option value="1" selected="selected">允许</option>
																<option value="0">拒绝</option>
														</select>&#160;</td>
														<td headers="aclactionth6"><span
															class="label label-success">允许</span></td>
													</tr>
													<tr>
														<td headers="actions-th6"><label class="tip"
															for="eform_rules_core.edit.state_6"
															title="修改任何内容的状态 该文章的&lt;strong&gt;修改状态&lt;/strong&gt;的权限设置和基于父级分类和用户组权限计算出来的权限。">
																修改任何内容的状态 </label></td>
														<td headers="settings-th6"><select class="input-small"
															name="eform[rules][core.edit.state][6]"
															id="eform_rules_core.edit.state_6"
															title="允许或拒绝修改任何内容的状态，对于 Manager 用户组里的用户">
																<option value="">继承</option>
																<option value="1" selected="selected">允许</option>
																<option value="0">拒绝</option>
														</select>&#160;</td>
														<td headers="aclactionth6"><span
															class="label label-success">允许</span></td>
													</tr>
												</tbody>
											</table>
										</div>
										<div class="tab-pane" id="permission-7">
											<table class="table table-striped">
												<thead>
													<tr>
														<th class="actions" id="actions-th7"><span
															class="acl-action">操作</span></th>
														<th class="settings" id="settings-th7"><span
															class="acl-action">选择新设置<sup>1</sup></span></th>
														<th id="aclactionth7"><span class="acl-action">计算出的实际设置<sup>2</sup></span>
														</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td headers="actions-th7"><label class="tip"
															for="eform_rules_core.delete_7"
															title="删除任何内容 该文章的&lt;strong&gt;删除功能&lt;/strong&gt;的权限设置和基于父级分类和用户组权限计算出来的权限。">
																删除任何内容 </label></td>
														<td headers="settings-th7"><select class="input-small"
															name="eform[rules][core.delete][7]"
															id="eform_rules_core.delete_7"
															title="允许或拒绝删除任何内容，对于 Administrator 用户组里的用户">
																<option value="" selected="selected">继承</option>
																<option value="1">允许</option>
																<option value="0">拒绝</option>
														</select>&#160;</td>
														<td headers="aclactionth7"><span
															class="label label-success">允许</span></td>
													</tr>
													<tr>
														<td headers="actions-th7"><label class="tip"
															for="eform_rules_core.edit_7"
															title="编辑任何内容 该文章的&lt;strong&gt;编辑功能&lt;/strong&gt;的权限设置和基于父级分类和用户组权限计算出来的权限。">
																编辑任何内容 </label></td>
														<td headers="settings-th7"><select class="input-small"
															name="eform[rules][core.edit][7]"
															id="eform_rules_core.edit_7"
															title="允许或拒绝编辑任何内容，对于 Administrator 用户组里的用户">
																<option value="" selected="selected">继承</option>
																<option value="1">允许</option>
																<option value="0">拒绝</option>
														</select>&#160;</td>
														<td headers="aclactionth7"><span
															class="label label-success">允许</span></td>
													</tr>
													<tr>
														<td headers="actions-th7"><label class="tip"
															for="eform_rules_core.edit.state_7"
															title="修改任何内容的状态 该文章的&lt;strong&gt;修改状态&lt;/strong&gt;的权限设置和基于父级分类和用户组权限计算出来的权限。">
																修改任何内容的状态 </label></td>
														<td headers="settings-th7"><select class="input-small"
															name="eform[rules][core.edit.state][7]"
															id="eform_rules_core.edit.state_7"
															title="允许或拒绝修改任何内容的状态，对于 Administrator 用户组里的用户">
																<option value="" selected="selected">继承</option>
																<option value="1">允许</option>
																<option value="0">拒绝</option>
														</select>&#160;</td>
														<td headers="aclactionth7"><span
															class="label label-success">允许</span></td>
													</tr>
												</tbody>
											</table>
										</div>
										<div class="tab-pane" id="permission-2">
											<table class="table table-striped">
												<thead>
													<tr>
														<th class="actions" id="actions-th2"><span
															class="acl-action">操作</span></th>
														<th class="settings" id="settings-th2"><span
															class="acl-action">选择新设置<sup>1</sup></span></th>
														<th id="aclactionth2"><span class="acl-action">计算出的实际设置<sup>2</sup></span>
														</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td headers="actions-th2"><label class="tip"
															for="eform_rules_core.delete_2"
															title="删除任何内容 该文章的&lt;strong&gt;删除功能&lt;/strong&gt;的权限设置和基于父级分类和用户组权限计算出来的权限。">
																删除任何内容 </label></td>
														<td headers="settings-th2"><select class="input-small"
															name="eform[rules][core.delete][2]"
															id="eform_rules_core.delete_2"
															title="允许或拒绝删除任何内容，对于 Registered 用户组里的用户">
																<option value="" selected="selected">继承</option>
																<option value="1">允许</option>
																<option value="0">拒绝</option>
														</select>&#160;</td>
														<td headers="aclactionth2"><span
															class="label label-important">不允许</span></td>
													</tr>
													<tr>
														<td headers="actions-th2"><label class="tip"
															for="eform_rules_core.edit_2"
															title="编辑任何内容 该文章的&lt;strong&gt;编辑功能&lt;/strong&gt;的权限设置和基于父级分类和用户组权限计算出来的权限。">
																编辑任何内容 </label></td>
														<td headers="settings-th2"><select class="input-small"
															name="eform[rules][core.edit][2]"
															id="eform_rules_core.edit_2"
															title="允许或拒绝编辑任何内容，对于 Registered 用户组里的用户">
																<option value="" selected="selected">继承</option>
																<option value="1">允许</option>
																<option value="0">拒绝</option>
														</select>&#160;</td>
														<td headers="aclactionth2"><span
															class="label label-important">不允许</span></td>
													</tr>
													<tr>
														<td headers="actions-th2"><label class="tip"
															for="eform_rules_core.edit.state_2"
															title="修改任何内容的状态 该文章的&lt;strong&gt;修改状态&lt;/strong&gt;的权限设置和基于父级分类和用户组权限计算出来的权限。">
																修改任何内容的状态 </label></td>
														<td headers="settings-th2"><select class="input-small"
															name="eform[rules][core.edit.state][2]"
															id="eform_rules_core.edit.state_2"
															title="允许或拒绝修改任何内容的状态，对于 Registered 用户组里的用户">
																<option value="" selected="selected">继承</option>
																<option value="1">允许</option>
																<option value="0">拒绝</option>
														</select>&#160;</td>
														<td headers="aclactionth2"><span
															class="label label-important">不允许</span></td>
													</tr>
												</tbody>
											</table>
										</div>
										<div class="tab-pane" id="permission-3">
											<table class="table table-striped">
												<thead>
													<tr>
														<th class="actions" id="actions-th3"><span
															class="acl-action">操作</span></th>
														<th class="settings" id="settings-th3"><span
															class="acl-action">选择新设置<sup>1</sup></span></th>
														<th id="aclactionth3"><span class="acl-action">计算出的实际设置<sup>2</sup></span>
														</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td headers="actions-th3"><label class="tip"
															for="eform_rules_core.delete_3"
															title="删除任何内容 该文章的&lt;strong&gt;删除功能&lt;/strong&gt;的权限设置和基于父级分类和用户组权限计算出来的权限。">
																删除任何内容 </label></td>
														<td headers="settings-th3"><select class="input-small"
															name="eform[rules][core.delete][3]"
															id="eform_rules_core.delete_3"
															title="允许或拒绝删除任何内容，对于 Author 用户组里的用户">
																<option value="" selected="selected">继承</option>
																<option value="1">允许</option>
																<option value="0">拒绝</option>
														</select>&#160;</td>
														<td headers="aclactionth3"><span
															class="label label-important">不允许</span></td>
													</tr>
													<tr>
														<td headers="actions-th3"><label class="tip"
															for="eform_rules_core.edit_3"
															title="编辑任何内容 该文章的&lt;strong&gt;编辑功能&lt;/strong&gt;的权限设置和基于父级分类和用户组权限计算出来的权限。">
																编辑任何内容 </label></td>
														<td headers="settings-th3"><select class="input-small"
															name="eform[rules][core.edit][3]"
															id="eform_rules_core.edit_3"
															title="允许或拒绝编辑任何内容，对于 Author 用户组里的用户">
																<option value="" selected="selected">继承</option>
																<option value="1">允许</option>
																<option value="0">拒绝</option>
														</select>&#160;</td>
														<td headers="aclactionth3"><span
															class="label label-important">不允许</span></td>
													</tr>
													<tr>
														<td headers="actions-th3"><label class="tip"
															for="eform_rules_core.edit.state_3"
															title="修改任何内容的状态 该文章的&lt;strong&gt;修改状态&lt;/strong&gt;的权限设置和基于父级分类和用户组权限计算出来的权限。">
																修改任何内容的状态 </label></td>
														<td headers="settings-th3"><select class="input-small"
															name="eform[rules][core.edit.state][3]"
															id="eform_rules_core.edit.state_3"
															title="允许或拒绝修改任何内容的状态，对于 Author 用户组里的用户">
																<option value="" selected="selected">继承</option>
																<option value="1">允许</option>
																<option value="0">拒绝</option>
														</select>&#160;</td>
														<td headers="aclactionth3"><span
															class="label label-important">不允许</span></td>
													</tr>
												</tbody>
											</table>
										</div>
										<div class="tab-pane" id="permission-4">
											<table class="table table-striped">
												<thead>
													<tr>
														<th class="actions" id="actions-th4"><span
															class="acl-action">操作</span></th>
														<th class="settings" id="settings-th4"><span
															class="acl-action">选择新设置<sup>1</sup></span></th>
														<th id="aclactionth4"><span class="acl-action">计算出的实际设置<sup>2</sup></span>
														</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td headers="actions-th4"><label class="tip"
															for="eform_rules_core.delete_4"
															title="删除任何内容 该文章的&lt;strong&gt;删除功能&lt;/strong&gt;的权限设置和基于父级分类和用户组权限计算出来的权限。">
																删除任何内容 </label></td>
														<td headers="settings-th4"><select class="input-small"
															name="eform[rules][core.delete][4]"
															id="eform_rules_core.delete_4"
															title="允许或拒绝删除任何内容，对于 Editor 用户组里的用户">
																<option value="" selected="selected">继承</option>
																<option value="1">允许</option>
																<option value="0">拒绝</option>
														</select>&#160;</td>
														<td headers="aclactionth4"><span
															class="label label-important">不允许</span></td>
													</tr>
													<tr>
														<td headers="actions-th4"><label class="tip"
															for="eform_rules_core.edit_4"
															title="编辑任何内容 该文章的&lt;strong&gt;编辑功能&lt;/strong&gt;的权限设置和基于父级分类和用户组权限计算出来的权限。">
																编辑任何内容 </label></td>
														<td headers="settings-th4"><select class="input-small"
															name="eform[rules][core.edit][4]"
															id="eform_rules_core.edit_4"
															title="允许或拒绝编辑任何内容，对于 Editor 用户组里的用户">
																<option value="">继承</option>
																<option value="1" selected="selected">允许</option>
																<option value="0">拒绝</option>
														</select>&#160;</td>
														<td headers="aclactionth4"><span
															class="label label-success">允许</span></td>
													</tr>
													<tr>
														<td headers="actions-th4"><label class="tip"
															for="eform_rules_core.edit.state_4"
															title="修改任何内容的状态 该文章的&lt;strong&gt;修改状态&lt;/strong&gt;的权限设置和基于父级分类和用户组权限计算出来的权限。">
																修改任何内容的状态 </label></td>
														<td headers="settings-th4"><select class="input-small"
															name="eform[rules][core.edit.state][4]"
															id="eform_rules_core.edit.state_4"
															title="允许或拒绝修改任何内容的状态，对于 Editor 用户组里的用户">
																<option value="" selected="selected">继承</option>
																<option value="1">允许</option>
																<option value="0">拒绝</option>
														</select>&#160;</td>
														<td headers="aclactionth4"><span
															class="label label-important">不允许</span></td>
													</tr>
												</tbody>
											</table>
										</div>
										<div class="tab-pane" id="permission-5">
											<table class="table table-striped">
												<thead>
													<tr>
														<th class="actions" id="actions-th5"><span
															class="acl-action">操作</span></th>
														<th class="settings" id="settings-th5"><span
															class="acl-action">选择新设置<sup>1</sup></span></th>
														<th id="aclactionth5"><span class="acl-action">计算出的实际设置<sup>2</sup></span>
														</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td headers="actions-th5"><label class="tip"
															for="eform_rules_core.delete_5"
															title="删除任何内容 该文章的&lt;strong&gt;删除功能&lt;/strong&gt;的权限设置和基于父级分类和用户组权限计算出来的权限。">
																删除任何内容 </label></td>
														<td headers="settings-th5"><select class="input-small"
															name="eform[rules][core.delete][5]"
															id="eform_rules_core.delete_5"
															title="允许或拒绝删除任何内容，对于 Publisher 用户组里的用户">
																<option value="" selected="selected">继承</option>
																<option value="1">允许</option>
																<option value="0">拒绝</option>
														</select>&#160;</td>
														<td headers="aclactionth5"><span
															class="label label-important">不允许</span></td>
													</tr>
													<tr>
														<td headers="actions-th5"><label class="tip"
															for="eform_rules_core.edit_5"
															title="编辑任何内容 该文章的&lt;strong&gt;编辑功能&lt;/strong&gt;的权限设置和基于父级分类和用户组权限计算出来的权限。">
																编辑任何内容 </label></td>
														<td headers="settings-th5"><select class="input-small"
															name="eform[rules][core.edit][5]"
															id="eform_rules_core.edit_5"
															title="允许或拒绝编辑任何内容，对于 Publisher 用户组里的用户">
																<option value="" selected="selected">继承</option>
																<option value="1">允许</option>
																<option value="0">拒绝</option>
														</select>&#160;</td>
														<td headers="aclactionth5"><span
															class="label label-success">允许</span></td>
													</tr>
													<tr>
														<td headers="actions-th5"><label class="tip"
															for="eform_rules_core.edit.state_5"
															title="修改任何内容的状态 该文章的&lt;strong&gt;修改状态&lt;/strong&gt;的权限设置和基于父级分类和用户组权限计算出来的权限。">
																修改任何内容的状态 </label></td>
														<td headers="settings-th5"><select class="input-small"
															name="eform[rules][core.edit.state][5]"
															id="eform_rules_core.edit.state_5"
															title="允许或拒绝修改任何内容的状态，对于 Publisher 用户组里的用户">
																<option value="">继承</option>
																<option value="1" selected="selected">允许</option>
																<option value="0">拒绝</option>
														</select>&#160;</td>
														<td headers="aclactionth5"><span
															class="label label-success">允许</span></td>
													</tr>
												</tbody>
											</table>
										</div>
										<div class="tab-pane" id="permission-8">
											<table class="table table-striped">
												<thead>
													<tr>
														<th class="actions" id="actions-th8"><span
															class="acl-action">操作</span></th>
														<th class="settings" id="settings-th8"><span
															class="acl-action">选择新设置<sup>1</sup></span></th>
														<th id="aclactionth8"><span class="acl-action">计算出的实际设置<sup>2</sup></span>
														</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td headers="actions-th8"><label class="tip"
															for="eform_rules_core.delete_8"
															title="删除任何内容 该文章的&lt;strong&gt;删除功能&lt;/strong&gt;的权限设置和基于父级分类和用户组权限计算出来的权限。">
																删除任何内容 </label></td>
														<td headers="settings-th8"><select class="input-small"
															name="eform[rules][core.delete][8]"
															id="eform_rules_core.delete_8"
															title="允许或拒绝删除任何内容，对于 Super Users 用户组里的用户">
																<option value="" selected="selected">继承</option>
																<option value="1">允许</option>
																<option value="0">拒绝</option>
														</select>&#160;</td>
														<td headers="aclactionth8"><span
															class="label label-success"><i
																class="icon-lock icon-white"></i> 允许（超级管理）</span></td>
													</tr>
													<tr>
														<td headers="actions-th8"><label class="tip"
															for="eform_rules_core.edit_8"
															title="编辑任何内容 该文章的&lt;strong&gt;编辑功能&lt;/strong&gt;的权限设置和基于父级分类和用户组权限计算出来的权限。">
																编辑任何内容 </label></td>
														<td headers="settings-th8"><select class="input-small"
															name="eform[rules][core.edit][8]"
															id="eform_rules_core.edit_8"
															title="允许或拒绝编辑任何内容，对于 Super Users 用户组里的用户">
																<option value="" selected="selected">继承</option>
																<option value="1">允许</option>
																<option value="0">拒绝</option>
														</select>&#160;</td>
														<td headers="aclactionth8"><span
															class="label label-success"><i
																class="icon-lock icon-white"></i> 允许（超级管理）</span></td>
													</tr>
													<tr>
														<td headers="actions-th8"><label class="tip"
															for="eform_rules_core.edit.state_8"
															title="修改任何内容的状态 该文章的&lt;strong&gt;修改状态&lt;/strong&gt;的权限设置和基于父级分类和用户组权限计算出来的权限。">
																修改任何内容的状态 </label></td>
														<td headers="settings-th8"><select class="input-small"
															name="eform[rules][core.edit.state][8]"
															id="eform_rules_core.edit.state_8"
															title="允许或拒绝修改任何内容的状态，对于 Super Users 用户组里的用户">
																<option value="" selected="selected">继承</option>
																<option value="1">允许</option>
																<option value="0">拒绝</option>
														</select>&#160;</td>
														<td headers="aclactionth8"><span
															class="label label-success"><i
																class="icon-lock icon-white"></i> 允许（超级管理）</span></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<div class="alert">
									如果你改变了设置，它将应用于这篇文章。注意：<br />
									<strong>继承</strong>的意思是将会使用从全局设置、上级用户组和分类继承来的权限。<br />
									<strong>拒绝</strong>的意思是不管全局设置、上级用户组或分类的设置，正在编辑的用户组不能操作这篇文章。<br />
									<strong>允许</strong>的意思是正在编辑的用户组可以操作这篇文章（如果这与全局设置、上级用户组或分类冲突，它不会有任何影响；冲突将会根据计算出来的设置被标记为“不允许（锁定）”）。<br />2、如果你选择一个新的设置，点击<strong>保存</strong>以刷新设置。
								</div>
							</fieldset>
						</div>
						<!-- End Tabs -->
					</div>
				</div>
			</div>
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="return" value="" />
		</form>
</section>
<script type="text/javascript">
Joomla.submitbutton = function(task) {
	if(ue.hasContents()){ //此处以非空为例
	    ue.sync();       //同步内容
	    Joomla.submitform(task, document.getElementById('myForm'));
	}
}
</script> 