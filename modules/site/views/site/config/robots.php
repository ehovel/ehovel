<?php defined('SYSPATH') or die('No direct script access.'); ?>
<?php echo EHOVEL::js('jquery.validate'); ?>
<section class="container_12 clearfix">
    <?php remind::render_current();?>
    <article>
        <h1><?php echo __('Configure robots.txt Information');?></h1>

        <form class="uniform" id="add_form" action="<?php echo url::current(true);?>" method="post">
            <dl>
                <dt><label for="robots"><?php echo __('Robots Contents');?></label><span class="require">*</span></dt>
                <dd><textarea id="robots" name="robots" class="big required" type="textarea" ><?php echo $robots;?></textarea></dd>
            </dl>
            <p>
                <button type="submit" class="button big"><?php echo __('Save');?></button>
            </p>
        </form>
    </article>
</section>
<script type="text/javascript" src="<?php echo STATICS_BASE_URL;?>js/jquery.validate.js"></script> 
<script type="text/javascript">
    $(document).ready(function(){
    	$("#add_form").validate({
            onkeyup:false
    	});
    });
</script>