<h2><?php echo __('Role');?></h2>
<section>
    <ul>
    <li><input type="radio" value="0" name="role" checked="true" /><?php echo __('Select role later.');?></li>
<?php if(!empty($roles)):?>
<?php foreach ($roles as $key => $item) { ?>
    <li><input type="radio" value="<?php echo $item->id;?>" name="role"/> <?php echo $item->name;?></li>
<?php }?>
<?php endif;?>
    </ul>
</section>
