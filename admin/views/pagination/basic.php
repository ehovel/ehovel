<div class="pagination">

	<?php if ($first_page !== FALSE): ?>
		<a href="<?php echo HTML::chars($page->url($first_page)) ?>" rel="first"><?php echo __('First Page') ?></a>
	<?php else: ?>
		<a href="#"><?php echo __('First Page') ?></a>
	<?php endif ?>

	<?php if ($previous_page !== FALSE): ?>
		<a href="<?php echo HTML::chars($page->url($previous_page)) ?>" rel="prev"><?php echo __('Previous Page') ?></a>
	<?php else: ?>
		<a href="#"><?php echo __('Previous Page') ?></a>
	<?php endif ?>

	<?php for ($i = 1; $i <= $total_pages; $i++): ?>

		<?php if ($i == $current_page): ?>
			<a href="#" class="current"><?php echo $i ?></a>
		<?php else: ?>
			<a href="<?php echo HTML::chars($page->url($i)) ?>"><?php echo $i ?></a>
		<?php endif ?>

	<?php endfor ?>

	<?php if ($next_page !== FALSE): ?>
		<a href="<?php echo HTML::chars($page->url($next_page)) ?>" rel="next"><?php echo __('Next Page') ?></a>
	<?php else: ?>
		<a href="#"><?php echo __('Next Page') ?></a>
	<?php endif ?>

	<?php if ($last_page !== FALSE): ?>
		<a href="<?php echo HTML::chars($page->url($last_page)) ?>" rel="last"><?php echo __('Last Page') ?></a>
	<?php else: ?>
		<a href="#"><?php echo __('Last Page') ?></a>
	<?php endif ?>

</div><!-- .pagination -->
