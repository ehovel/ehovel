<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Category extends Controller_Base {

	public function action_index()
	{
		$left = View::factory('left')->render(NULL,false);
		$this->template = View::factory('category',array(
					'left' => $left,
					)
				);
	}

} // End Welcome
