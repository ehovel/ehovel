<?php defined('SYSPATH') OR die('No direct script access allowed.');
function init_user_route_after()
{
    I18n::package('user');
    if(BES::app()->loaded('auth'))
    {
        Helper_Auth::add_config(BES::config('user_node'));
    }
	//Event::add_handler('user.create_after', 'Helper_Event_User::create_after');
}
