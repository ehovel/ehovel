<?php defined('SYSPATH') OR die('No direct script access.'); ?>
<script type="text/javascript" src="<?php echo STATICS_BASE_URL;?>js/jquery.validate.js"></script>
<?php echo EHOVEL::js('jquery.validate');?>
<?php echo EHOVEL::js('kindediter/kindeditor');?>
<?php echo EHOVEL::js('kindediter/lang/zh_CN');?>
<?php echo EHOVEL::js('kindediter/plugins/code/prettify');?>
<link rel="stylesheet" href="<?php echo STATICS_BASE_URL;?>/js/kindediter/themes/default/default.css" />
<link rel="stylesheet" href="<?php echo STATICS_BASE_URL;?>/js/kindediter/plugins/code/prettify.css" />
<script type="text/javascript">
    KindEditor.ready(function(K) {
        var editor = K.create(
            'textarea[name="content"]', 
            {cssPath: "<?php echo STATICS_BASE_URL;?>/js/kindediter/plugins/code/prettify.css",
            uploadJson: "/admin/kindediter/upload",
            fileManagerJson: "/admin/kindediter/filemanager",
            allowFileManager: "1"
            });
        prettyPrint();
        $(".button").mouseover(function() {
            editor.sync();
        });
    });
    jQuery(function($) {
        $('#myForm').validate({
            onkeyup: false
        });
    });
</script>
<section class="container_12 clearfix">
      <aside id="sidebar" class="grid_3 pull_9" style="width:100%;left:0;clear:both;">
		    <div class="box menu">
		        <h2><?php echo !empty($faq) ? __('Edit') : __('Add'); ?></h2>
		        <form class="uniform" id="myForm" action="<?php echo url::current(true);?>" method="post">
				            <dl class="inline">
				                <dt><label for="category_id"><?php echo __('Faq Category');?></label></dt>
				                <dd>
				                    <select name="category_id" id="category_id" class="required">
				                        <?php foreach($faq_categories as  $faq_category):?>
				                        <option value="<?php echo $faq_category->id;?>" <?php if(!empty($faq) && $faq->category_id == $faq_category->id) echo 'selected="selected"';?>><?php echo $faq_category->name?></option>
				                        <?php endforeach;?>
				                    </select>
				                </dd>
				            </dl>
				            <dl class="inline">
				                <dt><label for="title"><?php echo __('Title');?><span style="color:#D40707 !important">*</span></label></dt>
				                <dd>
				                <input type="text" name="title" id="title" class="medium required" maxlength="256" value="<?php echo !empty($faq)?$faq->title: '';?>"/>
				                </dd>
				            </dl>
				            <dl class="inline">
				                <dt><label for="title"><?php echo __('Content');?><span class="require">*</span></label></dt>
				                    <dd>
				                        <textarea name="content" id="content" class="kind required"
				                                  maxlength="65536"><?php echo !empty($faq)? htmlspecialchars($faq->content) : '';?></textarea>
				                    </dd>
				            </dl>
				            <dl class="inline">
				                <dt><label for="reply"><?php echo __('Reply');?><span class="require">*</span></label></dt>
				                    <dd>
				                        <textarea name="reply" id="reply" class="kind required ke-container" 
				                        	maxlength="65536"><?php echo !empty($faq)? htmlspecialchars($faq->reply) : '';?></textarea>
				                    </dd>
				            </dl>
				            <dl class="inline">
				            	<dt><label for="status"><?php echo __('is_Active');?><span class="require">*</span></label></dt>
				            	<dd>
				                    <div class="radio"><span class="checked"><input type="radio"<?php if (isset($faq->status) AND $faq->status == 'CHECKED') { ?> checked="checked"<?php } ?> value="CHECKED" name="status" style="opacity: 0;"></span></div>&nbsp;审核通过 &nbsp;&nbsp;&nbsp;&nbsp;
				                    <div class="radio"><span><input type="radio"<?php if (!isset($faq->status) || $faq->status == 'UNCHECKED') { ?> checked="checked"<?php } ?> value="UNCHECKED" name="status" style="opacity: 0;"></span></div>&nbsp;未审核</dd>
				            </dl>
				            <div class="buttons">
				                <button type="submit" class="button big"><?php echo __('Save');?></button>
				                <?php echo html::cancel_anchor(EHOVEL::url('site_faq')); ?>
				            </div>
				        </form>
		    </div>
		</aside>
		<?php if (!empty($faq)){?>
		<aside id="sidebar" class="grid_3 pull_9" style="width:100%;left:0;clear:both;">
		    <div class="box menu">
		        <h2><?php echo __('Comment List');?></h2>
		        <div class="newgrid" style="position:static">
                    <table id="datatable" class="gtable detailtable">
                        <thead>
                            <tr>
                              <th width="5%"><?php echo __('Action');?></th>
                              <th width="15%"><?php echo __('User Name');?></th>
                              <th width="20%"><?php echo __('User Email');?></th>
                              <th><?php echo __('Comment Message');?></th>
                              <th width="10%"><?php echo __('Status');?></th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php foreach ($comments as $comment){?>
                            <tr class="even">
                            	<td>
                            		<?php echo HTML::delete_anchor(EHOVEL::url('site_tecfaq/delete_comment') . '?id=' . $comment->id.'&tecfaq_id='.$faq->id);?>
                                </td>	
                                <td><?php echo $comment->user->firstname.' '.$comment->user->lastname;?></td>
                                <td><?php echo $comment->user->email;?></td>
                                <td><?php echo $comment->content;?></td>
                                <td>
                                	<?php if ($comment->status != 'CHECKED'){?>
                                	<a class="" title="点击审核通过" href="<?php echo EHOVEL::url('site_tecfaq/verify_comment',array('id'=>$comment->id,'status'=>'CHECKED','tecfaq_id'=>$faq->id));?>"><img alt="点击审核通过" src="/statics/images/icons/cross.png"></a>
                                	<?php }else{?>
                                	<a class="" title="点击取消审核通过" href="<?php echo EHOVEL::url('site_tecfaq/verify_comment',array('id'=>$comment->id,'status'=>'UNCHECKED','tecfaq_id'=>$faq->id));?>"><img alt="点击取消审核通过" src="/statics/images/icons/tick.png"></a>
                                	<?php }?>
                                </td>							
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                    <div class="tablefooter clearfix">
                    <?php //echo $pagination;?>
                    </div>
                </div>
		    </div>
		</aside>
		<?php }?>
	</section>
</section>
<section id="layout_content">
<script type="text/javascript">
jQuery(document).ready(function() {
jQuery('.delete').unbind().bind('click', function() {
var href = jQuery(this).attr('href');
jQuery.kMsg.warning('确定删除该用户回复？', function() {
	location.href = href;
});
return false;
});
});
</script>