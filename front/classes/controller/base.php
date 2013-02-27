<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Base extends Controller {
	
	public $auto_render = TRUE;
	public $template = '';

	public function before() {
		parent::before();
		
		View::set_global('statics_url', url::base() . 'themes/' . THEME . '/');
		
		$view_header_data = array();
		$view_footer_data = array();
		$layout = View::factory('layout',array(
						'header' => View::factory('header',$view_header_data)->render(NULL,FALSE),
						'footer' => View::factory('footer', $view_footer_data)->render(NULL, FALSE),
					)
				);
		View::set_global_layout($layout);
	}
	
	public function after() {
		if ($this->auto_render === TRUE) {
			$this->response->body($this->template);
		}
		parent::after();
	}

}
