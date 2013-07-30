<?php defined('SYSPATH') OR die('No direct script access allowed.');

/**
 * 菜单控制器
 *
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package Core
 * @category Controller
 * @since 2011-12-09 
 * @author zhubin 
 * @version   $Id$
 */
class Controller_Admin_Menu extends Controller_Admin_Base {
    /**
     * 当前控制器对应的主模型
     * @var string
     */
    protected $_model = 'Menu';
    /**
     * 菜单列表
     */
    public function action_index()
    {
        try{
            $menus = EHOVEL::model($this->_model)->get_all_menus();
            $this->template = EHOVEL::view('menu/index',array(
                'menus' => $menus,
            ));
        }catch(Exception_BES $ex){
            Remind::factory($ex)
                ->send();
        }
    }
    /**
     * 菜单添加
     */
    public function action_add()
    {
        try{
            if($_POST){
                $pid = $this->request->post('pid');
                if($pid != 0){
                    $parent_menu = EHOVEL::model($this->_model, $pid);
                    if(!$parent_menu->loaded()){
                        throw new Exception_BES(__('Parent item Loading failed.'));
                    }
                }
                $menu_model = EHOVEL::model($this->_model);
                $menu_model->pid = $pid;
                $menu_model->name = trim($this->request->post('name'));
                $menu_model->name_en = trim($this->request->post('name_en'));
                $menu_model->uri= trim($this->request->post('uri'));
                $menu_model->position= trim($this->request->post('position'));
                $menu_model->is_show = trim($this->request->post('is_show'));
                $menu_model->date_add = date('Y-m-d H:i:s');
                $menu_model->date_upd = date('Y-m-d H:i:s');
                $menu_model->save($menu_model->validation());
                if($menu_model->saved()){
                    Remind::factory(Remind::TYPE_SUCCESS)
                        ->message(__('Saved Successfully!'))
                        ->redirect(EHOVEL::url('menu/index'))
                        ->send();
                }else{
                    Remind::factory(Remind::TYPE_ERROR)
                        ->message($menu_model->validation()->errors())
                        ->redirect(EHOVEL::url('menu/add'))
                        ->send();
                }
            }
            $menus = EHOVEL::model($this->_model)->get_all_menus();
            $this->template = EHOVEL::view('menu/edit',array(
                'menus' => $menus,
                'nodes' => Helper_Auth::get_current(),
            ));
        }catch(Exception_BES $ex){
            Remind::factory($ex)
                ->send();
        }
    }

    /**
     * 菜单编辑
     */
    public function action_edit()
    {
        try{
            $id = $this->request->param('id');
            $current_menu = EHOVEL::model($this->_model, $id);
            if(!$current_menu->loaded()){
                Message::set(Message::SUCCESS, __('test测试提示信息'));
                
            }
            if($_POST){
                $pid = $this->request->post('pid');
                if($pid != 0){
                    $parent_menu = EHOVEL::model($this->_model, $pid);
                    if(!$parent_menu->loaded()){
                        throw new Exception_BES(__('Parent item Loading failed.'));
                    }
                }
                $current_menu->pid = $pid;
                $current_menu->name = trim($this->request->post('name'));
                $current_menu->title = trim($this->request->post('title'));
                $current_menu->uri= trim($this->request->post('uri'));
                $current_menu->position= trim($this->request->post('position'));
                $current_menu->is_show = trim($this->request->post('is_show'));
                $current_menu->save($current_menu->validation());
                if($current_menu->saved()){
                    Message::set(Message::SUCCESS,__('Edited Successfully!'));
                    $this->redirect(EHOVEL::url('menu/index'));
                }else{
                    Message::set(Message::ERROR,json_encode($current_menu->validation()->errors()));
                    $this->redirect(EHOVEL::url('menu/edit', array('id'=>$id)));
                }
            }
            $menus = EHOVEL::model($this->_model)->get_all_menus();
            $this->template = EHOVEL::view('menu/edit',array(
                'menus' => $menus,
                'current_menu' => $current_menu,
                'nodes' => Helper_Auth::get_current(),
            ));
        }catch(Exception_BES $ex){
            Message::set($ex);
        }
    }
    /**
     * 菜单删除
     */
    public function action_delete()
    {
        try{
            $id = $this->request->query('id');
            $current_menu = EHOVEL::model($this->_model, $id);
            if(!$current_menu->loaded()){
                Remind::factory(Remind::TYPE_ERROR)
                    ->message(__('Bad Request!'))
                    ->redirect(EHOVEL::url('menu/index'))
                    ->send();
            }
            if($current_menu->has_children()){
                Remind::factory(Remind::TYPE_ERROR)
                    ->message(__('Delete failed, this menu has children!'))
                    ->redirect(EHOVEL::url('menu/index'))
                    ->send();
            }
            $current_menu->delete();
            Remind::factory(Remind::TYPE_SUCCESS)
                ->message(__('Delete Successfully!'))
                ->redirect(EHOVEL::url('menu/index'))
                ->send();
        }catch(Exception_BES $ex){
            Remind::factory($ex)
                ->send();
        }
    }
}
