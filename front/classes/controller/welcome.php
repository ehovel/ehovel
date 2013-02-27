<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller_Base {

	public function action_index()
	{
		//$test = ORM::factory('test');
		$test = array();
		$data = $test;
// 		->where('id','=','1')
// 		->find()
// 		->as_array();
		$left = View::factory('left')->render(NULL,false);
		$this->template = View::factory('index',array(
					'data' => $data,
					'left' => $left,
					)
				);
	}

} // End Welcome
