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
class Controller_Admin_Base_Site_Column extends Controller_Admin_Base_Site {
    
    public $column_id = 0;

    public function __construct(Request $request, Response $response)
    {
        parent::__construct($request, $response);
        $this->column_id = BES::get_column();
        if(empty($this->column_id) && !$request->is_ajax())
        {
            Remind::factory(Remind::TYPE_ERROR)
                ->message(__('Please choose column!'))
                ->redirect($this->request->referrer())
                ->send();
        }
    }
    
}
