<?php defined('SYSPATH') or die('No direct script access.');
// $Id$
/**
 * 会员留言管理控制器
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package 
 * @since 2011-06-24
 * @author fanchongyuan
 * @version $Id$
 */
I18n::package('user');
class Controller_Admin_User_Message extends Controller_Admin_Base
{
    /**
     * 列表页
     * @access public
     * @return void
     * @throws Exception_Kapp
     * @author fanchongyuan
     * @example 
     */
    public function action_index()
    {
         // 初始化返回结构体
        $return_struct = array(
            'status'  => 0,
            'code'    => 501,
            'msg'     => 'Not Implemented',
            'content' => array(),
        );
        try {
            if ($this->request->is_ajax()) {
                $search = $this->request->query("_search");
                $model = BES::model('user_message');
                if($search)
                {
                    $content = $this->request->query('content');
                    if(!empty($content)){
                        $model->where('content','like','%'.$content.'%');
                    }
                    $email = $this->request->query('email');
                    if(!empty($email))
                    {
                        $model->where('email','like','%'.$email.'%');
                    }
                    $date_add = $this->request->query('date_add');
                    if(!empty($date_add))
                    {
                        $model->where('date_add','<=',$date_add);
                    }
                    $ip = $this->request->query('ip');
                    if(!empty($ip))
                    {
                        $model->where('ip','=',$ip);
                    }
                }
                $grid = Grid::factory($model);
                exit($grid->to_json(array('user')));
            } else {
                $this->template = BES::view('user/message/index');
            }
        } catch ( Exception_BES $ex ) {
            $this->_ex($ex, $return_struct);
        }
    }

    /**
     * 编辑用户留言状态同时回复留言
     * @access public
     * @return void
     * @throws Exception_Kapp
     * @author fanchongyuan
     * @example 
     */
    public function action_edit()
    {
         // 初始化返回结构体
        $return_struct = array(
            'status'  => 0,
            'code'    => 501,
            'msg'     => 'Not Implemented',
            'content' => array(),
        );
        try {
            $id = $this->request->query('id');
            $model = BES::model('user_message',$id);
            if(!$model->loaded())
            {
            	Remind::factory(Remind::TYPE_ERROR)->message(__('Invalid Request!'))->redirect(BES::url('user_message/index'))->send();
            }
            $message = $model->content;
            if (!empty($_POST)) {
                $model->reply = $this->request->post('reply');
                if(!empty($model->reply))
                {
                    $model->is_reply = 'Y';
                }
                $model->active = $this->request->post('active');
                $model->save();
                $site_config = BES::config('site');
            	$your_email = $site_config['email'];
            	
            	$param = array(
                    '{site}' => $site_config['domain'],
                    '{site_link}' => 'http://'.$site_config['domain'],
            		'{reply}'=> $this->request->post('reply'),
                    '{message}' => $message,
                    '{site_name}' => $site_config['name'],
                	'{server_email}'=> $your_email,
                );
                Mail::instance()->content('recontactus',$param)->send($model->email,$your_email);
                Remind::factory(Remind::TYPE_SUCCESS)->message(__('Edited successfully!'))->redirect(BES::url('user_message/index'))->send();
            }
            $this->template = BES::view('user/message/edit', array('message' => $model));
        } catch (Exception_BES $ex) {
            Remind::factory($ex)->send();
        } catch ( ORM_Validation_Exception $e ) {
            Remind::factory(Remind::TYPE_ERROR)->message($user_model->validation()->errors())->redirect(BES::url('user_message/edit').'?id='.$id)->send();
        }
    }

    /**
     * 留言删除
     * @access public
     * @return void
     * @throws Exception_Kapp
     * @author fanchongyuan
     * @example 
     */
    public function action_delete()
    {
          // 初始化返回结构体
        $return_struct = array(
            'status'  => 0,
            'code'    => 501,
            'msg'     => 'Not Implemented',
            'content' => array(),
        );
        try {
            $id = $this->request->query('id');
            $model = BES::model('user_message',$id);
            if(!$model->loaded())
            {
                Remind::factory(Remind::TYPE_ERROR)->message(__('Invalid Request!'))->redirect(BES::url('user_message/index'))->send();
            }
            $model->disable();
            if($model->disabled)
            {
                Remind::factory(Remind::TYPE_SUCCESS)->message(__('Deleted successfully!'))->redirect(BES::url('user_message/index'))->send();
            } else {
                Remind::factory(Remind::TYPE_ERROR)->message(__('Delete Error.'))->redirect(BES::url('user_message/index'))->send();
            }
        } catch (Exception_BES $ex) {
            Remind::factory($ex)->send();
        }
    }

    /**
     * 留言批量删除
     * @access public
     * @return void
     * @throws Exception_Kapp
     * @author fanchongyuan
     * @example 
     */
    public function action_batch_delete()
    {
          // 初始化返回结构体
        $return_struct = array(
            'status'  => 0,
            'code'    => 501,
            'msg'     => 'Not Implemented',
            'content' => array(),
        );
        try {
            $oper = $this->request->post('oper');
            $id = $this->request->post('id');
            if($oper != 'del')
            {
                throw new Exception_BES(__('Invalid Request'));
            }
            $ids = explode(',',$id);
            if(!empty($ids))
            {
                foreach($ids as $id)
                {
                    $model = BES::model('user_message',$id);
                    if(!$model->loaded())
                    {
                        throw new Exception_BES(__('Invalid Request'));
                    }
                    if(!$model->delete())
                    {
                        throw new Exception_BES(__('#:id delete failed.',array(':id'=>$model->id)));
                    }
                }
            } else {
                throw new Exception_BES(__('Invalid Request'));
            }
            $return_struct['status'] = 1;
            $return_struct['code'] = 200;
            $return_struct['msg'] = __('Deleted successfully!');
            $return_struct['content'] = array();
            $return_struct['jumpurl'] = URL::current();
            Remind::factory(Remind::TYPE_SUCCESS)
                ->message(__('Deleted Successfully'))
                ->send();
        } catch (Exception_BES $ex) {
            Remind::factory($ex)->send();
        }
    }

}
