<h2><?php echo __('Column');?></h2>
<section>
    <ul>
    <li><input type="radio" value="0" name="column_id" checked="true" /><?php echo __('No select column.');?></li>
    <?php if(!empty($columns)):?>
    <?php foreach ($columns as $column) { ?>
    <li><input type="radio" value="<?php echo $column->id;?>" name="column_id"/> <?php echo $column->name;?></li>
    <?php }?>
    <?php endif;?>
    </ul>
</section>
