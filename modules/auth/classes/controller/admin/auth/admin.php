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
class Controller_Admin_Auth_Admin extends Controller_Admin_Base{
    /**
     * 管理员列表
     */
    public function action_index()
    {
        try{
            //取出当前用户的子账号
            $admins = EHOVEL::model('Auth_Admin',$this->user->id)->descendants(); 
            $this->template = EHOVEL::view('auth/admin/index',array(
                'admins' => $admins,
            ));
        }catch(Kohana_Exception $ex){
            Message::set($ex)->send();
        }
    }

    /**
     * 添加自己的子账号
     */
    public function action_add()
    {
        try {
            if ($_POST) {
                $role = $this->request->post('role');
                $username = $this->request->post('username');
                $password = $this->request->post('password');
                $email = $this->request->post('email');
                $site_ids = $this->request->post('site_ids');
                //用户名不重复
                if (empty($username) || !$this->_available_username($username)) {
                    Remind::factory(Remind::TYPE_ERROR)
                        ->message(__('Username cannot be repeated!'))
                        ->redirect(EHOVEL::url('auth_admin/add'))
                        ->send();
                }
                //邮箱不能重复
                if (empty($email) || !$this->_available_email($email)) {
                    Remind::factory(Remind::TYPE_ERROR)
                        ->message(__('Email cannot be repeated!'))
                        ->redirect(EHOVEL::url('auth_admin/add'))
                        ->send();
                }
                $admin_model = EHOVEL::model('Auth_Admin');
                //站点管理员，为空表示所有站点
                if(!empty($site_ids))
                {
                    if(!$admin_model->check_site_ids($site_ids))
                    {
                        Remind::factory(Remind::TYPE_ERROR)
                            ->message(__('Some site have no permission!'))
                            ->redirect(EHOVEL::url('auth_admin/add'))
                            ->send();
                    }
                }
                //栏目管理员
                if($this->user->column_id)
                {
                    $admin_model->column_id = $this->user->column_id;
                } else {
                    $admin_model->column_id = $this->request->post('column_id');
                }
                $admin_model->username = $username;
                $admin_model->email = $email;
                $admin_model->password = md5($password);
                !empty($role) && $admin_model->role_id = $role;
                $parent = EHOVEL::model('auth_admin', intval($this->user->id));
                if ($parent->loaded()) {
                    $admin_model->insert_as_last_child($parent);
                    //添加管理员管理站点
                    if(!empty($site_ids))
                    {
                        foreach($site_ids as $site_id)
                        {
                            $admin_site_relation = EHOVEL::model('auth_admin_site_relation');
                            $admin_site_relation->admin_id = $admin_model->pk();
                            $admin_site_relation->site_id = $site_id;
                            $admin_site_relation->save();
                        }
                    }
                    Remind::factory(Remind::TYPE_SUCCESS)
                        ->message(__('Saved Successfully!'))
                        ->redirect(EHOVEL::url('auth_admin/index'))
                        ->send();
                } else {
                    Remind::factory(Remind::TYPE_ERROR)
                        ->message(__('Parent error'))
                        ->redirect(EHOVEL::url('auth_admin/add'))
                        ->send();
                }
            }
            $roles = EHOVEL::model('Auth_Role')->where('owner_id','=',$this->user->id)->order_by('id','desc')->find_all();
            $parent_sites = EHOVEL::model('auth_admin')->get_sites();
            $this->template = EHOVEL::view('auth/admin/edit', array(
                'roles' => $roles,
                'parent_sites' => $parent_sites,
            ));
            if(!$this->user->column_id)
            {
                $this->template->columns = EHOVEL::model('column')->find_all();
            }
        } catch(Kohana_Exception $ex){
            Remind::factory($ex)
                ->send();
        }
    }

    /**
     * 编辑账号
     */
    public function action_edit()
    {
        try {
            $id = $this->request->query('id');
            $admin_model = EHOVEL::model('Auth_Admin', $id);
            if(!$admin_model->loaded()){
                Remind::factory(Remind::TYPE_ERROR)
                    ->message(__('Bad Request!'))
                    ->redirect(EHOVEL::url('auth_admin/index'))
                    ->send();
            }
            $current_admin_model = EHOVEL::model('auth_admin',$this->user->id);
            if(!$admin_model->is_descendant($current_admin_model))
            {
                Remind::factory(Remind::TYPE_ERROR)
                    ->message(__('Your do not have permission to edit this account!'))
                    ->redirect(EHOVEL::url('auth_admin/index'))
                    ->send();
            }

            if ($_POST) {
                $role = $this->request->post('role');
                $username = $this->request->post('username');
                $password = $this->request->post('password');
                $email = $this->request->post('email');
                $site_ids = $this->request->post('site_ids');
                $pid = $this->request->post('pid');
                //用户名不重复
                if (empty($username) || !$this->_available_username($username)) {
                    Remind::factory(Remind::TYPE_ERROR)
                        ->message(__('Username cannot be repeated!'))
                        ->redirect(EHOVEL::url('auth_admin/edit').'?id='.$id)
                        ->send();
                }
                //邮箱不能重复
                if (empty($email) || !$this->_available_email($email)) {
                    Remind::factory(Remind::TYPE_ERROR)
                        ->message(__('Email cannot be repeated!'))
                        ->redirect(EHOVEL::url('auth_admin/edit').'?id='.$id)
                        ->send();
                }
                $parent = EHOVEL::model('auth_admin', intval($pid));
                if (!$parent->loaded() OR $parent->pk() == $admin_model->pk() OR $parent->is_descendant($admin_model)) {
                    Remind::factory(Remind::TYPE_ERROR)->message(__('Parent Error.'))->redirect(EHOVEL::url('auth_admin/edit').'?id='.$id)->send();
                }
                if($parent->pk() != $current_admin_model->pk() && !$parent->is_descendant($current_admin_model))
                {
                    Remind::factory(Remind::TYPE_ERROR)->message(__('Parent Error.'))->redirect(EHOVEL::url('auth_admin/edit').'?id='.$id)->send();
                }
                //站点验证
                if(!empty($site_ids))
                {
                    if(!$parent->check_site_ids($site_ids))
                    {
                        Remind::factory(Remind::TYPE_ERROR)
                            ->message(__('Some site have no permission!'))
                            ->redirect(EHOVEL::url('auth_admin/edit').'?id='.$id)
                            ->send();
                    }
                }
                //栏目管理员
                if($parent->column_id)
                {
                    $admin_model->column_id = $parent->column_id;
                } else {
                    $admin_model->column_id = $this->request->post('column_id');
                }
                $admin_model->username = $username;
                $admin_model->email = $email;
                $admin_model->password = md5($password);
                !empty($role) && $admin_model->role_id = $role;
                if ($admin_model->pid != $parent->pk()) {
                    $admin_model->pid = $parent->pk();
                    $admin_model->move_to_last_child($parent);
                    $admin_model->reload();
                }
                $admin_model->save();
                //变更管理员管理站点
                if(empty($site_ids))
                {
                    $site_ids = array();
                }
                $old_sites = EHOVEL::model('auth_admin_site_relation')->where('admin_id','=',$admin_model->id)->find_all();
                $old_site_ids = array();
                foreach($old_sites as $old_site)
                {
                    $old_site_ids[] = $old_site->site_id;
                    if(!in_array($old_site->site_id, $site_ids))
                    {
                        $old_site->delete();
                    }
                }
                foreach($site_ids as $site_id)
                {
                    if(!in_array($site_id,$old_site_ids))
                    {
                        $admin_site_relation = EHOVEL::model('auth_admin_site_relation');
                        $admin_site_relation->admin_id = $admin_model->pk();
                        $admin_site_relation->site_id = $site_id;
                        $admin_site_relation->save();
                    }
                }
                Remind::factory(Remind::TYPE_SUCCESS)
                    ->message(__('Edit Successfully!'))
                    ->redirect(EHOVEL::url('auth_admin/index'))
                    ->send();
            }
            $roles = EHOVEL::model('auth_role')->where('owner_id','=',$admin_model->pid)->order_by('id','desc')->find_all();
            $parent_model = EHOVEL::model('auth_admin',$admin_model->pid);
            $parent_sites = $parent_model->get_sites();
            $site_ids = $admin_model->get_site_ids();
            $childs = $current_admin_model->descendants(TRUE);
            $this->template = EHOVEL::view('auth/admin/edit', array(
                'roles' => $roles,
                'auth_admin' => $admin_model,
                'parent_sites' => $parent_sites,
                'site_ids' => $site_ids,
                'childs' => $childs,
                'parent' => $parent_model,
            ));
            if(!$parent_model->column_id)
            {
                $this->template->columns = EHOVEL::model('column')->find_all();
            }

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
            $admin_id= $this->request->query('id');
            $admin_model = EHOVEL::model('Auth_Admin', $admin_id);
            if($admin_model->loaded()){
                if($this->user->super != 'Y')
                {
                    if(!$admin_model->is_descendant($this->user))
                    {
                        Remind::factory(Remind::TYPE_ERROR)
                            ->message(__('Your do not have permission to delete this account!'))
                            ->redirect(EHOVEL::url('auth_admin/index'))
                            ->send();
                    }
                }
                if($admin_model->has_children())
                {
                    Remind::factory(Remind::TYPE_ERROR)
                        ->message(__('The administrator have children account!'))
                        ->redirect(EHOVEL::url('auth_admin/index'))
                        ->send();
                }
                $admin_model->delete();
                Remind::factory(Remind::TYPE_SUCCESS)
                    ->message(__('Delete Successfully!'))
                    ->redirect(EHOVEL::url('auth_admin/index'))
                    ->send();
            }else{
                Remind::factory(Remind::TYPE_ERROR)
                    ->message(__('Bad Request!'))
                    ->redirect(EHOVEL::url('auth_admin/index'))
                    ->send();
            }
        } catch(Kohana_Exception $ex){
            Remind::factory($ex)
                ->send();
        }
    }

    /**
     * 管理员登录
     */
    public function action_login()
    {
        $this->request->headers('Cache-Control', 'no-cache');
        $this->request->headers('Expires', '0');
        if ($_POST) {
            $username = $this->request->post('username');
            $password = $this->request->post('adminpassword');
            $remember = $this->request->post('remember');
            $redirect = urldecode($this->request->query('redirect'));
            if ($remember == 1) {
                Cookie::set('remember', $remember);
            }
            if (Security::check($this->request->post('formhash'))) {
                $user = EHOVEL::model('Auth_Admin')
                        ->login($username, $password, $remember);
                
                if ($user->loaded()) {
                    if (empty($redirect)) {
                        $redirect = EHOVEL::url('index');
                    }
                    Message::set(Message::SUCCESS,__('Login Successfully!'));
                    $this->redirect($redirect);
                }
            } else {
                Message::set(Message::ERROR,__('Invalid Request'));
                $this->redirect(EHOVEL::url('auth_admin/login'));
            }
        } else {
            $formtoken = Security::token();
            $remember = Cookie::get('remember');
            if ($remember == 1) {
                $username = Cookie::get('username');
            } else {
                $username = '';
            }
            $this->template = View::factory('auth/admin/login', array(
                'formtoken' => $formtoken,
                'remember'  => $remember,
                'username'  => $username,
            ))->render(null,false);
        }
    }
    /**
     * 退出
     */
    public function action_logout()
    {
        try {
            $this->request->headers('Cache-Control', 'no-cache');
            EHOVEL::model('Auth_Admin')->logout();
            EHOVEL::app()->clear_site();
            Message::set(Message::SUCCESS,__('Logout Successfully!'));
            $this->redirect(EHOVEL::url('auth_admin/login'));
        } catch (Kohana_Exception $ex) {
            Message::set($ex);
            $this->redirect(EHOVEL::url('auth_admin/login'));
        }
    }
    /**
     * 更改密码
     */
    public function action_info()
    {
        try {
            $user = $this->user;
            if ($_POST) {
                $email = $this->request->post('email');
                $password = $this->request->post('password');
                $password_again = $this->request->post('current_password');
                $old_password = $this->request->post('old_password');
                if ($password == $password_again) {
                    if ($user->password <> md5($old_password)) {
                        Remind::factory(Remind::TYPE_ERROR)
                            ->message(__('Original password input error, please try again!'))
                            ->redirect(EHOVEL::url('auth_admin/info'))
                            ->send();
                    }
                    $user->password = md5($password);
                    $user->save();
                    if ($user->saved()) {
                        $user->login_set($user);
                        Remind::factory(Remind::TYPE_SUCCESS)
                            ->message(__('Edit Successfully!'))
                            ->redirect(EHOVEL::url('auth_admin/login'))
                            ->send();
                    } else {
                        Remind::factory(Remind::TYPE_ERROR)
                            ->message($user->validation()->errors())
                            ->redirect(EHOVEL::url('auth_admin/login'))
                            ->send();
                    }
                } else {
                    Remind::factory(Remind::TYPE_ERROR)
                        ->message(__('The passwords do not match'))
                        ->redirect(EHOVEL::url('auth_admin/info'))
                        ->send();
                }
            } else {
                $this->template= EHOVEL::view('auth/admin/info',array('data'=>$user));
            }
        } catch (Kohana_Exception $ex) {
            Remind::factory($ex)
                ->send();
        }
    }

    /**
     * 验证邮箱是否存在
     * @param string $email
     * @return bool
     */
    protected function _available_email($email)
    {
        $id = $this->request->query('id');
        $admin_model = EHOVEL::model('Auth_Admin');
        $admin_model->where('email', '=', $email);
        if($id){
            $admin_model->where('id', '!=', $id);
        }
        return $admin_model->count_all()==0;
    }

    /**
     * 验证用户名是否存在
     * @param string $username
     * @return bool
     */
    protected function _available_username($username)
    {
        $id = $this->request->query('id');
        $admin_model = EHOVEL::model('Auth_Admin');
        $admin_model->where('username', '=', $username);
        if($id){
            $admin_model->where('id', '!=', $id);
        }
        return $admin_model->count_all()==0;
    }

    protected function action_get_sites()
    {
        try {
            if(!$this->request->is_ajax())
            {
                Remind::factory(Remind::TYPE_ERROR)->message(__('Invalid Request'))->send();
            }
            $user_id = $this->request->query('id');
            $admin_model = EHOVEL::model('Auth_Admin',$user_id);
            if(!$admin_model->loaded())
            {
                Remind::factory(Remind::TYPE_ERROR)->message(__('Loading failed.'))->send();
            }
            $sites = $admin_model->get_sites();
            $this->template = EHOVEL::view('auth/admin/sites',array('sites' => $sites))->render(NULL, FALSE);
        } catch (Kohana_Exception $ex) {
            Remind::factory($ex)->send();
        }
    }

    protected function action_get_roles()
    {
        try {
            if(!$this->request->is_ajax())
            {
                Remind::factory(Remind::TYPE_ERROR)->message(__('Invalid Request'))->send();
            }
            $user_id = $this->request->query('id');
            $admin_model = EHOVEL::model('Auth_Admin',$user_id);
            if(!$admin_model->loaded())
            {
                Remind::factory(Remind::TYPE_ERROR)->message(__('Loading failed.'))->send();
            }
            $roles = EHOVEL::model('role')->where('owner_id','=',$admin_model->id)->find_all();
            $this->template = EHOVEL::view('auth/admin/roles',array('roles' => $roles))->render(NULL, FALSE);
        } catch (Kohana_Exception $ex) {
            Remind::factory($ex)->send();
        }
    }

    protected function action_get_columns()
    {
        try {
            if(!$this->request->is_ajax())
            {
                Remind::factory(Remind::TYPE_ERROR)->message(__('Invalid Request'))->send();
            }
            $user_id = $this->request->query('id');
            $admin_model = EHOVEL::model('Auth_Admin',$user_id);
            if(!$admin_model->loaded())
            {
                Remind::factory(Remind::TYPE_ERROR)->message(__('Loading failed.'))->send();
            }
            if(!$admin_model->column_id)
            {
                $columns = EHOVEL::model('column')->find_all();
                $this->template = EHOVEL::view('auth/admin/columns',array('columns' => $columns))->render(NULL, FALSE);
            } else {
                exit;
            }
        } catch (Kohana_Exception $ex) {
            Remind::factory($ex)->send();
        }
    }
}
