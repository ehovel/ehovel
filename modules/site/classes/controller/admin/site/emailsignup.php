<?php
defined ( 'SYSPATH' ) or die ( 'No direct script access.' );
/**
 * 邮件订阅
 *
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package Site
 * @category  Controller  
 * @since 2012-01-04
 * @author zhubin 
 * @version   $Id$
 */
class Controller_Admin_Site_EmailSignUp extends Controller_Admin_Base 
{
    /**
     * 邮件订阅列表
     * @return void
     */
    public function action_index() 
    {
        try {
            if($this->request->is_ajax())
            {
                $model = EHOVEL::model('Site_EmailSignUp')->order_by('date_add', 'DESC');
                $json = Grid::factory($model);
                exit($json->to_json());
            }else{
                $this->template = EHOVEL::view('site/email_sign_up/index');
            }
            
        } catch ( Kohana_Exception $ex ) {
            Remind::factory($ex)
                ->send();
        }
    }
    
    /**
     * 删除订阅邮件
     * @return void
     */
    public function action_delete() 
    {
        try {
            $email_sign_up_model = EHOVEL::model('Site_EmailSignUp', $this->request->query('id'));
            if(!$email_sign_up_model->loaded()){
                Remind::factory ( Remind::TYPE_ERROR )
                    ->message ( __ ('Loading failed, try again' ) )
                    ->redirect ( EHOVEL::url ( 'site_emailsignup' ) )
                    ->send ();
            }else{
                $email_sign_up_model->delete();
                Remind::factory ( Remind::TYPE_SUCCESS)
                    ->message ( __ ( 'Deleted Successfully!' ) )
                    ->redirect ( EHOVEL::url ( 'site_emailsignup' ) )
                    ->send ();
            }
        } catch ( Kohana_Exception $ex ) {
            Remind::factory($ex)
                ->send();
        }
    }
    /**
     * 删除订单
     */
    public function action_batch_delete()
    {
        try{
            if(!Helper_Auth::check('site_emailsignup/delete')){
                $return_struct['status'] = 0;
                $return_struct['code'] = 200;
                $return_struct['msg'] = __('You do not have the permission to do this action!');
                $return_struct['content'] = array();
                $return_struct['jumpurl'] = EHOVEL::url('order/index');
                exit(json_encode($return_struct));
            }
            $ids = explode(',', $this->request->post('id'));
            foreach($ids as $id){
                $model = EHOVEL::model('Site_EmailSignUp', $id);
                if($model->loaded()){
                    $model->delete();
                }
            }
            $return_struct['status'] = 1;
            $return_struct['code'] = 200;
            $return_struct['msg'] = __('Delete Successfully!');
            $return_struct['content'] = array();
            $return_struct['jumpurl'] = EHOVEL::url('site_emailsignup/index');
            exit(json_encode($return_struct));
        }catch(Kohana_Exception $ex){
            Remind::factory($ex)
                ->send();
        }
    }
}
