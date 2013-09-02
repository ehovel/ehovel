<?php defined('SYSPATH') OR die('No direct script access allowed.');
// $Id$
/**
 * 角色管理
 * @copyright Copyright (c) 2012, Ketai inc.
 * @package auth
 * @category Controller
 * @since 2012-06-01
 * @author fanchongyuan
 * @version $Id$
 */
class Controller_Admin_Auth_Role extends Controller_Admin_Base {

    /**
     * 角色列表
     */
    public function action_index()
    {
        try{
            //获取当前账户的子角色
            $roles = EHOVEL::model('Auth_Role')->where('owner_id','=',$this->user->id)->order_by('id', 'desc')->find_all();
            $this->template = EHOVEL::view('auth/role/index',array(
                'roles' => $roles,
            ));
        }catch(Kohana_Exception $ex){
            Remind::factory($ex)
                ->send();
        }
    }

    /**
     * 添加新角色
     */
    public function action_add()
    {
        try {
            if ($_POST) {
                $name = $this->request->post('name');
                $description = $this->request->post('description');
                $nodes = $this->request->post('nodes');
                $owner_id = $this->user->id;
                if(empty($name)){
                    throw new Kohana_Exception(__('Please enter name!'));
                }
                if (EHOVEL::model('Auth_Role')->name_exist($name, $owner_id)) {
                    Remind::factory(Remind::TYPE_ERROR)
                        ->message(__('Name cannot be repeated!'))
                        ->redirect(EHOVEL::url('auth_role/add'))
                        ->send();
                }
                $role = EHOVEL::model('Auth_Role');

                $role->owner_id = $owner_id;
                $role->name = $name;
                $role->description = $description;
                !empty($nodes) and $role->nodes_json = json_encode($nodes);
                //保存数据
                $role->save($role->validation());
                Remind::factory(Remind::TYPE_SUCCESS)
                    ->message(__('Saved Successfully!'))
                    ->redirect(EHOVEL::url('auth_role/index'))
                    ->send();
            }
            //权限列表
            $nodes = Helper_Auth::get_current();
            $this->template = EHOVEL::view('auth/role/edit',array(
                'nodes' => $nodes,
            ));
        } catch(Kohana_Exception $ex){
            Remind::factory($ex)
                ->send();
        }
    }

    /**
     * 编辑角色
     */
    public function action_edit()
    {
        try {
            $id = $this->request->query('id');
            $role = EHOVEL::model('Auth_Role', $id);
            if(!$role->loaded()){
                Remind::factory(Remind::TYPE_ERROR)
                    ->message(__('Bad Request!'))
                    ->redirect(EHOVEL::url('auth_role/index'))
                    ->send();
            }
            if($role->owner_id != $this->user->id){
                Remind::factory(Remind::TYPE_ERROR)
                    ->message(__('Your do not have permission to edit this role!'))
                    ->redirect(EHOVEL::url('auth_role/index'))
                    ->send();
            }
            if ($_POST) {
                $name = $this->request->post('name');
                $description = $this->request->post('description');
                $nodes = $this->request->post('nodes');
                if(empty($name)){
                    throw new Kohana_Exception(__('Please enter name!'));
                }
                if ($role->name_exist($name)) {
                    Remind::factory(Remind::TYPE_ERROR)
                        ->message(__('Name cannot be repeated!'))
                        ->redirect(EHOVEL::url('auth_role/edit',array('id'=>$role->id)))
                        ->send();
                }
                //保存数据
                $role->name = $name;
                $role->description = $description;
                $role->nodes_json = !empty($nodes) ? json_encode($nodes) : '';
                $role->save($role->validation());
                Remind::factory(Remind::TYPE_SUCCESS)
                    ->message(__('Edit Successfully!'))
                    ->redirect(EHOVEL::url('auth_role/index'))
                    ->send();
            }
            //权限列表
            $role->nodes_json = !empty($role->nodes_json)?json_decode($role->nodes_json) : array();
            $this->template = EHOVEL::view('auth/role/edit',array(
                'role' => $role,
                'nodes' => Helper_Auth::get_current(),
            ));
        } catch(Kohana_Exception $ex){
            Remind::factory($ex)
                ->send();
        }
    }

    /**
     * 删除角色
     */
    public function action_delete()
    {
        try{
            $role_id = $this->request->query('id');
            $role = EHOVEL::model('Auth_Role', $role_id);
            if($role->loaded()){
                if($role->owner_id != $this->user->id)
                {
                    Remind::factory(Remind::TYPE_ERROR)
                        ->message(__('Your do not have permission to delete this role!'))
                        ->redirect(EHOVEL::url('auth_role/index'))
                        ->send();
                }
                if($role->admins->count_all()>0){
                    Remind::factory(Remind::TYPE_ERROR)
                        ->message(__('Delete failed, they are many admins under this role!'))
                        ->redirect(EHOVEL::url('auth_role/index'))
                        ->send();
                }
                $role->delete();
                Remind::factory(Remind::TYPE_SUCCESS)
                    ->message(__('Delete Successfully!'))
                    ->redirect(EHOVEL::url('auth_role/index'))
                    ->send();
            }else{
                Remind::factory(Remind::TYPE_ERROR)
                    ->message(__('Bad Request!'))
                    ->redirect(EHOVEL::url('auth_role/index'))
                    ->send();
            }
        } catch(Kohana_Exception $ex){
            Remind::factory($ex)
                ->send();
        }
    }

}
