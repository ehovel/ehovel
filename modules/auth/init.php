<?php defined('SYSPATH') OR die('No direct script access allowed.');
function init_auth_route_after()
{
    I18n::package('auth');
    Helper_Auth::add_config(EHOVEL::config('auth_node'));
}
