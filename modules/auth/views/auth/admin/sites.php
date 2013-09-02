<h2><?php echo __('Site');?></h2>
<section>
    <ul>
    <li><?php echo __('No select means all.');?></li>
    <?php if(!empty($sites)):?>
    <?php foreach ($sites as $site) { ?>
    <li><input type="checkbox" value="<?php echo $site->id;?>" name="site_ids[]"/> <?php echo $site->name;?></li>
    <?php }?>
    <?php endif;?>
    </ul>
</section>
