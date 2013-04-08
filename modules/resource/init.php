<?php defined('SYSPATH') or die('No direct script access.');
// Catch-all route for Codebench classes to run
Route::set('attach', 'attach/<id>.<postfix>')
	->defaults(array(
		'controller' => 'attachment',
		'action' => 'view',
		)
	);

