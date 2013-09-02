<?php defined('SYSPATH') or die('No direct script access.');
// $Id$
/**
 * 前台站点导航管理控制器
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package Site
 * @category  Controller  
 * @since 2011-12-19
 * @author zhubin
 * @version   $Id$
 */
class Controller_Admin_Site_Menu extends Controller_Admin_Base_Site
{
    private $_model = 'Site_Menu';

    /**
     * 导航列表
     */
    public function action_index()
    {
        try{
            $items = EHOVEL::model($this->_model)
                ->order_by('id', 'desc')
                ->where('lvl', '=', '0')
                ->find_all();
            $this->template = EHOVEL::view('site/menu/index', array(
                'items' => $items,
            ));
        } catch ( Kohana_Exception $ex ) {
            Remind::factory($ex)
                ->send();
        }
    }
    /**
     * 导航添加
     */
    public function action_add()
    {
        try{
            if($_POST){
                //key不能重复
                $key = $this->request->post('key');
                if (empty($key) || EHOVEL::model($this->_model)->key_exist($key)) {
                    Remind::factory(Remind::TYPE_ERROR)
                        ->message(__('Key cannot be repeated'))
                        ->redirect(EHOVEL::url('site_menu/add'))
                        ->send();
                }

                //保存数据
                $menu = EHOVEL::model($this->_model);
                $menu->values($_POST);
                $scope = $menu->generate_scope();
                $menu->insert_as_new_root($scope);
                
                if ($menu->saved()) {
                    Remind::factory(Remind::TYPE_SUCCESS)
                        ->message(__('Saved Successfully, keep adding menu item'))
                        ->redirect(EHOVEL::url('site_menu/item', array('id' => $menu->id)))
                        ->send();
                } else {
                    Remind::factory(Remind::TYPE_ERROR)
                        ->message(__('Saved failed.'))
                        ->redirect(EHOVEL::url('site_menu/add'))
                        ->send();
                }
/*
                $pid = $this->request->post('parent_id');
                if($pid != 0){
                    $parent_menu = EHOVEL::model($this->_model, $pid);
                    if(!$parent_menu->loaded()){
                        throw new Kohana_Exception(__('Parent item Loading failed.'));
                    }
                }
                $menu_model = EHOVEL::model($this->_model);
                $menu_model->parent_id = $pid;
                $menu_model->name = trim($this->request->post('name'));
                $menu_model->name_manage = trim($this->request->post('name_manage'));
                $menu_model->href = trim($this->request->post('href'));
                $menu_model->target_blank = trim($this->request->post('target_blank'));
                $menu_model->position= $this->request->post('position');
                $menu_model->date_add = date('Y-m-d H:i:s');
                $menu_model->date_upd = date('Y-m-d H:i:s');
                $menu_model->save($menu_model->validation());
                if($menu_model->saved()){
                    Remind::factory(Remind::TYPE_SUCCESS)
                        ->message(__('Saved Successfully!'))
                        ->redirect(EHOVEL::url('site_menu/index'))
                        ->send();
                }else{
                    Remind::factory(Remind::TYPE_ERROR)
                        ->message($menu_model->validation()->errors())
                        ->redirect(EHOVEL::url('site_menu/add'))
                        ->send();
                }

 */
            }
            $this->template = EHOVEL::view('site/menu/edit');
        }catch(Kohana_Exception $e){
            Remind::factory($e)
                ->redirect(EHOVEL::url('site_menu/index'))
                ->send();
        }
    }
    /**
     * 导航编辑
     */
    public function action_edit()
    {
        try{
            $id = intval($this->request->query('id'));
            $menu = EHOVEL::model($this->_model,$id);
            if(!$menu->loaded()){
                Remind::factory(Remind::TYPE_ERROR)
                    ->message(__('Bad Request!'))
                    ->redirect(EHOVEL::url('site_menu/index'))
                    ->send();
            }
            if($_POST){
                $menu->values($_POST);
                $menu->save();
                Remind::factory(Remind::TYPE_SUCCESS)
                    ->message(__('Saved Successfully, keep editing menu item'))
                    ->redirect(EHOVEL::url('site_menu/item', array('id' => $menu->id)))
                    ->send();
                    /*
                   $pid = $this->request->post('parent_id');
                if($pid != 0){
                    $parent_menu = EHOVEL::model($this->_model, $pid);
                    if(!$parent_menu->loaded()){
                        throw new Kohana_Exception(__('Parent item Loading failed.'));
                    }
                }
                $current_menu->parent_id = $pid;
                $current_menu->name = trim($this->request->post('name'));
                $current_menu->name_manage = trim($this->request->post('name_manage'));
                $current_menu->href = trim($this->request->post('href'));
                $current_menu->target_blank = trim($this->request->post('target_blank'));
                $current_menu->position= trim($this->request->post('position'));
                $menu_model->date_upd = date('Y-m-d H:i:s');
                $current_menu->save($current_menu->validation());
                if($current_menu->saved()){
                    Remind::factory(Remind::TYPE_SUCCESS)
                        ->message(__('Edited Successfully!'))
                        ->redirect(EHOVEL::url('site_menu/index'))
                        ->send();
                }else{
                    Remind::factory(Remind::TYPE_ERROR)
                        ->message($current_menu->validation()->errors())
                        ->redirect(EHOVEL::url('site_menu/edit', array('id'=>$id)))
                        ->send();
                } 
                     */
            }
            $this->template = EHOVEL::view('site/menu/edit',array(
                'data' => $menu,
            ));
        }catch(Kohana_Exception $e){
            Remind::factory($e)
                ->redirect(EHOVEL::url('site_menu/index'))
                ->send();
        }
    }

    /**
     * 获取菜单详情
     * @return void
     */
    public function action_get()
    {
        $return_struct = array(
            'status' => 0,
            'code' => 501,
            'msg' => '',
            'content' => array(),
        );
        try {
            if ($this->request->is_ajax()) {
                $id = intval($this->request->post('id'));
                $menu = EHOVEL::model($this->_model, $id);
                if (!$menu->loaded()) {
                    throw new Kohana_Exception(__('Invalid Request'));
                }
                $return_struct['content'] = $menu->as_array();
                $return_struct['status'] = 1;
                $return_struct['code'] = 200;
                exit(json_encode($return_struct));
            } else {
                Remind::factory(Remind::TYPE_ERROR)
                    ->message(__('Request error, try again'))
                    ->redirect(EHOVEL::url('site_menu/index'))
                    ->send();
            }
        }catch(Kohana_Exception $ex){
            $return_struct['msg'] = $ex->getMessage();
            exit(json_encode($return_struct));
        }
    }
    /**
     * 菜单项
     * @return void
     */
    public function action_item()
    {
        try {
            $id = intval($this->request->query('id'));
            $menu_model = EHOVEL::model($this->_model, $id);
            if (!$menu_model->loaded()) {
                Remind::factory(Remind::TYPE_ERROR)
                    ->message(__('Invalid Request'))
                    ->redirect(EHOVEL::url('site_menu/index'))
                    ->send();
            }
            
            if ($this->request->is_ajax()) {
                $target = $this->request->post('target');
                $type = $this->request->post('type');
                $name = $this->request->post('name');

                $current_id = $this->request->post('current_id');
                if ($target < 1) {
                    $target = $id;
                }
                $target = EHOVEL::model($this->_model, $target);
                if (!$target->loaded()) {
                    Remind::factory(Remind::TYPE_ERROR)
                        ->message(__('Loading failed, try again'))
                        ->redirect(EHOVEL::url('site_menu/index'))
                        ->send();
                }

                if ($current_id > 0) {
                    $menu = EHOVEL::model($this->_model, $current_id);
                } else {
                    $menu = EHOVEL::model($this->_model);
                }
//                if ($menu->name_exist($target->scope, $name)) {
//                    Remind::factory(Remind::TYPE_ERROR)
//                        ->message(__('Name cannot be repeated'))
//                        ->redirect(EHOVEL::url('site_menu/index'))
//                        ->send();
//                }

                if ($type == 'DOC') {
                    $_POST['relate_id'] = intval($this->request->post('doc'));
                } elseif ($type == 'DOCCATEGORY') {
                    $_POST['relate_id'] = intval($this->request->post('doc_category'));
                } elseif ($type == 'CATEGORY') {
                    $_POST['relate_id'] = intval($this->request->post('category'));
                }

                $menu->values($_POST);
                $menu->site_id = $this->site_id;
                if ($current_id > 0) {
                    $menu->save();
                } else {
                    $menu->insert_as_last_child($target);
                }

                $menu_arr = $menu->as_array();
                $return_struct = array(
                    'status' => 0,
                    'code' => 501,
                    'msg' => '',
                    'content' => array(),
                );
                if ($menu->saved()) {
                    $return_struct['content'] = $menu->as_array();
                    if ($current_id > 0) {
                        $return_struct['status'] = 2;
                    } else {
                        $return_struct['status'] = 1;
                    }
                    $return_struct['code'] = 200;
                    exit(json_encode($return_struct));
                } else {
                    $return_struct['msg'] = __('Editing failed, try again');
                    exit(json_encode($return_struct));
                }
            } else {
                $items = $menu_model->descendants();
                $items_arr = array();
                foreach ($items as $key => $item) {
                    $items_arr[] = $item->as_array();
                }
                
                //文案列表
                $doc_model = EHOVEL::model('Cms_Model')->set("name", "Docs")->find();
                
                $docs = EHOVEL::model('Cms_Model')->get_posts($doc_model->id);
                //文案分类
                $doc_categories = EHOVEL::model('Cms_Category')
                    ->where('pid', '=', $doc_model->id)
                    ->find()
                    ->select_list();
                
                //商品分类
                $product_categories = EHOVEL::model('product_category')
                    ->where('pid','=','1')
                    ->find()
                    ->select_list();
                
                $this->template = EHOVEL::view('site/menu/item/index',array(
                    'items' => $items,
                    'id'    => $id,
                    'data'  => json_encode($items_arr),
                    'docs'  => $docs,
                    'product_categories' => $product_categories,
                    'doc_categories'     => $doc_categories,
                ));
/*
                $this->template->content = View::factory('admin/site/menu/item/index');
                $this->template->content->items = $items;
                $this->template->content->id = $id;
                $this->template->content->data = json_encode($items_arr);

                $this->template->content->product_categories = $product_categories;
                $this->template->content->doc_categories = $doc_categories;
                $this->template->content->docs = $docs;
 */
            }
        }catch(Kohana_Exception $ex){
            Remind::factory($ex)
                ->send();
        }
    }
    /**
     * 移动节点
     * @return void
     */
    public function action_move()
    {
        // 初始化返回结构体
        $return_struct = array(
            'status' => 0,
            'code' => 501,
            'msg' => 'Not Implemented',
            'content' => array(),
        );
        try {
            $id = intval($this->request->query('id'));
            $target = intval($this->request->query('target'));
            $type = $this->request->query('type');
            $menu = EHOVEL::model($this->_model, $id);
            if (!$menu->loaded() || empty($target)) {
                throw new Kohana_Exception(__('Invalid Request'));
            }
            if ($type == 'before') {
                $menu->move_to_prev_sibling($target);
            } elseif ($type == 'after') {
                $menu->move_to_next_sibling($target);
            } elseif ($type == 'inner') {
                $menu->move_to_first_child($target);
            }
            if ($this->request->is_ajax()) {
                $return_struct['status'] = 1;
                $return_struct['code'] = 200;
                $return_struct['msg'] = __('Edited Successfully!');
                exit(json_encode($return_struct));
            }
        } catch (Kohana_Exception $ex) {
            $return_struct['msg'] = $ex->getMessage();
            exit(json_encode($return_struct));
        }
    }

    /**
     * 删除
     * @return void
     */
    public function action_delete()
    {
        // 初始化返回结构体
        $return_struct = array(
            'status' => 0,
            'code' => 501,
            'msg' => 'Not Implemented',
            'content' => array(),
        );
        try {
            $id = intval($this->request->query('id'));
            $menu = EHOVEL::model($this->_model, $id);
            if (!$menu->loaded()) {
                throw new Kohana_Exception(__('Invalid Request'));
            }
            if ($menu->has_children()) {
                $children = $menu->descendants();
                if ($children) {
                    foreach ($children as $key => $child) {
                        $child->delete();
                    }
                }
            }
            $menu->delete();
            if ($this->request->is_ajax()) {
                $return_struct['status'] = 1;
                $return_struct['code'] = 200;
                exit(json_encode($return_struct));
            } else {
                Remind::factory(Remind::TYPE_SUCCESS)
                    ->message(__('Deleted Successfully!'))
                    ->redirect(EHOVEL::url('site_menu/index'))
                    ->send();
            }
        } catch (Kohana_Exception $ex) {
            Remind::factory($ex)
                ->redirect(EHOVEL::url('site_menu/index'))
                ->send();
        }
    }

    /**
     * AJAX判断邮箱是否重复
     * @return mixed
     */
    public function action_name_exist()
    {
        try {
            $name = $this->request->query('name');
            $r_id = intval($this->request->query('r_id'));
            $id = intval($this->request->query('id'));
            $root = EHOVEL::model($this->_model, $r_id);
            if (!$root->loaded()) {
                throw new Kohana_Exception(__('Loading failed, try again'));
            }
            $scope = $root->scope;
            if ($this->request->is_ajax()) {
                //如果是编辑刚判断重重复不能加本身进行判断
                if ($id > 0) {
                    $result = EHOVEL::model($this->_model, $id)->name_exist($scope, $name);
                } else {
                    $result = EHOVEL::model($this->_model)->name_exist($scope, $name);
                }
                if ($result) {
                    exit('false');
                } else {
                    exit('true');
                }
            } else {
                Remind::factory(Remind::TYPE_ERROR)
                    ->message(__('Request error, try again'))
                    ->redirect(EHOVEL::url('site_menu/index'))
                    ->send();
            }
        } catch (Kohana_Exception $ex) {
            if($this->request->is_ajax){
                exit('false');
            }else{
                Remind::factory($ex)
                    ->redirect(EHOVEL::url('site_menu/index'))
                    ->send();
            }
        }
    }
}
