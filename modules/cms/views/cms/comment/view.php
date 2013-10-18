<?php defined('SYSPATH') OR die('No direct script access.'); ?>
<section class="container_12 clearfix">
    <?php remind::render_current(); ?>
    <article>
        <h1><?php echo __('Comment')?></h1>
        <form id="myForm" class="uniform" method="POST">
        <dl class="inline">
            <dt> <label><?php echo __('Title');?></label></dt>
            <dd> <?php echo $comment->title?></dd>
            <dt> <label><?php echo __('User');?></label></dt>
            <dd> <?php echo $user->firstname.' '.$user->lastname;?>&nbsp;</dd>
            <dt> <label><?php echo __('Content');?></label></dt>
            <dd> <?php echo $comment->content?>&nbsp; </dd>
        </dl>
        <div class="buttons">&nbsp;
        </div>
        </form>
    </article>
</section>
