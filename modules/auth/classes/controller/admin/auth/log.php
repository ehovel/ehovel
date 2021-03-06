<?php defined('SYSPATH') OR die('No direct script access allowed.');
// $Id$
/**
 * 帐号管理
 * @copyright Copyright (c) 2012, Ketai inc.
 * @package auth
 * @category Controller
 * @since 2012-06-01
 * @author fanchongyuan
 * @version $Id$
 */
class Controller_Admin_Auth_Log extends Controller_Admin_Base{
    /**
     * 管理员列表
     */
    public function action_index()
    {
        try{
            //取出当前用户的子账号
            $logs = EHOVEL::model('Auth_Log')->find_all();
            
            $this->template = EHOVEL::view('auth/log/index',array(
                'logs' => $logs,
            ));
        }catch(Kohana_Exception $ex){
            Remind::factory($ex)->send();
        }
    }
    /**
     * 编辑账号
     */
    public function action_edit()
    {
        try {
            $log_id= $this->request->query('id');
            $log_model = EHOVEL::model('Auth_Log', $log_id);
            if(!$log_model->loaded()){
                Remind::factory(Remind::TYPE_ERROR)
                    ->message(__('Bad Request!'))
                    ->redirect(EHOVEL::url('auth_log/index'))
                    ->send();
            }
            $this->template = EHOVEL::view('auth/log/edit', array(
                'data' => $log_model,
            ))->render(NULL,FALSE);
        } catch(Kohana_Exception $ex){
            Remind::factory($ex)
                ->send();
        }
    }

    /**
     * 删除账号
     */
    public function action_delete()
    {
        try{
            $log_id= $this->request->query('id');
            $log_model = EHOVEL::model('Auth_Log', $log_id);
            if($log_model->loaded()){
                $log_model->delete();
                Remind::factory(Remind::TYPE_SUCCESS)
                    ->message(__('Delete Successfully!'))
                    ->redirect(EHOVEL::url('auth_log/index'))
                    ->send();
            }else{
                Remind::factory(Remind::TYPE_ERROR)
                    ->message(__('Bad Request!'))
                    ->redirect(EHOVEL::url('auth_log/index'))
                    ->send();
            }
        } catch(Kohana_Exception $ex){
            Remind::factory($ex)
                ->send();
        }
    }
}
