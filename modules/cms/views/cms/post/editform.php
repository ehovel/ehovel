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
						<li><a href="#permissions" data-toggle="tab"><?php echo __('权限设置');?></a></li>
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
												<input type="text" name="eform[position]" id="position"
													class="tiny digits" maxlength="255"
													value="<?php echo !empty($content) ? $content->position : 0;?>" />
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
							<div class="choose_pics">
		                        <div class="pic">
		                            <div class="pic">
		                                <div class="pic_inner img120">
		                                    <img alt="" src="/statics/img/no_image_available.png" id="upload_pic" style="max-height:120px; max-width:120px">
		                                </div>
		                            </div>
		                            <ul class="inline">
									  <li><a onclick="removepic(this)" href="javascript:;"><i class="icon-remove"></i></a></li>
									</ul>
		                            <input type="hidden" value="5467" name="eform[attachs][]"> 
	                            </div> 
	                        </div>
						</div>
	
						<div class="tab-pane" id="metadata">
								<div class="control-group">
									<label id="eform_metadesc-lbl" for="eform_metadesc" class="hasTip control-label" title="简介::可选。该段文字用于在页面HTML中的description标签。description标签常常被搜索引擎用于搜索结果中。">简介</label>
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
				h += '<input type="hidden" value="'+ server_data[i]['id'] +'" name="eform[\'resource_ids\'][]"></div></div>';
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