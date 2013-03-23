<?php foreach ($messages as $message) { ?>
<div class="alert alert-<?php echo $message->type ?>">
	<button data-dismiss="alert" class="close" type="button">×</button>
	<strong><?php echo __($message->type) ?>!</strong> <?php echo $message->text ?>
</div>
<?php }?>