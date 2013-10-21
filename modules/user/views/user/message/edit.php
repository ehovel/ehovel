<?php defined('SYSPATH') OR die('No direct script access.'); ?>
<script type="text/javascript" src="<?php echo STATICS_BASE_URL;?>js/jquery.validate.js"></script>
<script type="text/javascript">
    $(function($) {
        $('#myForm').validate();
    });
</script>
<section class="container_12 clearfix">
    <?php Remind::render_current();?>
    <article>
        <h1><?php echo __('Reply Member Message');?></h1>

        <form class="uniform" id="myForm" action="<?php echo url::current(true);?>" method="post">
            <dl class="inline">
                <dt><label for="name"><?php echo __('Email');?> : </label></dt>
                <dd><?php echo $message->email;?></dd>
            </dl>
            <dl class="inline">
                <dt><label for="content"><?php echo __('Content');?> : </label></dt>
                <dd><?php echo $message->content;?></dd>
                <dt><label for="reply"><?php echo __('Reply');?><span class="require">*</span> : </label></dt>
                <dd><textarea name="reply" class="required" rows="10" cols="60" maxlength="1024"><?php echo $message->reply;?></textarea></dd>
                <!--<dt><label for="type"><?php echo __('Show or not');?></label></dt>
                <dd>
                    <label><input type="radio" value="Y" name="active"<?php echo $message->active == 'Y'?' checked="checked"':'';?> /><?php echo __('Yes');?></label>
                    <label><input type="radio" value="N" name="active"<?php echo $message->active == 'N'?' checked="checked"':'';?> /><?php echo __('No');?></label>
                    <?php echo __('choose "yes", the message will show on this page; choose "no", the message will not show');?> 
                </dd>
            --></dl>
            <div class="buttons">
                <button type="submit" class="button big"><?php echo __('Save');?></button>
                <?php echo html::cancel_anchor('/admin/user_message/index'); ?>
            </div>
        </form>
    </article>
</section>
