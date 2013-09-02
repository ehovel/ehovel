<?php defined('SYSPATH') OR die('No direct script access allowed.');
// $Id$
/**
 * 后台必须进入站点才能访问的控制器
 * @copyright Copyright (c) 2012, Ketai inc.
 * @package base
 * @category Controller
 * @since 2012-05-24
 * @author fanchongyuan
 * @version $Id$
 */
class Controller_Admin_Base_Site extends Controller_Admin_Base {
    
    public $site_id = 0;

    public function __construct(Request $request, Response $response)
    {
        parent::__construct($request, $response);
        $this->site_id = EHOVEL::get_site();
        if(empty($this->site_id))
        {
            Message::set(Message::ERROR,__('Please select site.'));
            $this->redirect($this->request->referrer());
        }
    }
    
}
