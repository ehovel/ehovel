<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller {

	public function action_index()
	{ 	echo UUID::v3(UUID::NIL,'aa').'<br>';
	 	echo UUID::v5(UUID::NIL,'aa');exit;
		$uuid = new Kohana_UUIDTest();
		print_r($uuid->test_v4_random());
		$this->response->body('hello, ADMIN!');
	}

} // End Welcome
