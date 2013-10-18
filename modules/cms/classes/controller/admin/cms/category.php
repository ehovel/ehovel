<?php defined('SYSPATH') OR die('No direct script access allowed.');
// $Id$
/**
 * 后台内容管理分类管理控制器
 *
 */
class Controller_Admin_Cms_Category extends Controller_Admin_Base {
    
     /**
     * 当前控制器对应的主模型
     * @var string
     */
    protected $_model = 'Cms_Category';
    
    // 当前的模型ID
    protected $curr_model_id;
    
    /**
     * do something before action
     * @see Controller_Admin_Base::before()
     */
    public function before()
    {
        parent::before();
        $session = Session::instance();
        if ($set_model_id = $this->request->query("set_model_id")) {
            $set_model_id = intval($set_model_id);
            $session->set('default_model_id', $set_model_id);
    
            $params = $this->request->query();
            unset($params["language"]);
            unset($params["set_model_id"]);
    
            $this->redirect(URL::current(FALSE) . URL::query($params, FALSE));
        }
    
        $default_model_id = $session->get('default_model_id');
        if (!$default_model_id) {
            $first_model = EHOVEL::model('Cms_Model')->find();
            if ($first_model->loaded()) {
                $default_model_id = $first_model->id;
                $session->set('default_model_id', $default_model_id);
            }
        }
    
        if ($default_model_id <= 0) {
            $ex = new Exception(__("default_model_id missing"));
    
            Message::set($ex);
        }
    
        $this->curr_model_id = $default_model_id;
    }
    
    /**
     * 模型分类列表
     */
    public function action_index()
    {
        $all_models = ORM::factory('Cms_Model')->find_all()->as_array();
        $model = EHOVEL::model('Cms_Model', $this->curr_model_id);
        $cms_categories = EHOVEL::model($this->_model, 1)->descendants();
        
        $this->template = EHOVEL::view('cms/category/index', array(
            'all_models' => $all_models,
            'model' => $model,
            'cms_categories' => $cms_categories,
        ));
    }
    
    /**
     * 添加模型分类
     */
    public function action_add()
    {
        try {
            $model = EHOVEL::model('Cms_Model', $this->curr_model_id);
            if (! $model->loaded()) {
                throw new Exception_BES(__('Bad Request!'));
            }
            
            if ($_POST) {
                $name = $this->request->post('name');
                $description = $this->request->post('description');
                $pid= $this->request->post('pid');
                //用户名不重复
                if (empty($name) || !$this->_available_name($name)) {
                    Remind::factory(Remind::TYPE_ERROR)
                        ->message(__('Name cannot be repeated!'))
                        ->redirect(EHOVEL::url('cms_category/add'))
                        ->send();
                }
                $parent = EHOVEL::model($this->_model, $pid);
                if(!$parent->loaded()){
                    $root = EHOVEL::model($this->_model);
                    $root->name = 'Root';
                    $parent = $root->insert_as_new_root();
                }
                if ($parent->loaded()) {
                    $category_model = EHOVEL::model($this->_model);
                    $category_model->name = $name;
                    $category_model->description = $description;
                    $category_model->model_id = $model->id;
                    $category_model->insert_as_last_child($parent);

                    if ($category_model->saved()) {
                        Remind::factory(Remind::TYPE_SUCCESS)
                            ->message(__('Saved Successfully!'))
                            ->redirect(EHOVEL::url('cms_category/index'))
                            ->send();
                    } else {
                        Remind::factory(Remind::TYPE_ERROR)
                            ->message($category_model->validation()->errors())
                            ->redirect(EHOVEL::url('cms_category/add'))
                            ->send();
                    }
                } else {
                    Remind::factory(Remind::TYPE_ERROR)
                        ->message(__('Parent item Loading failed.'))
                        ->redirect(EHOVEL::url('cms_category/add'))
                        ->send();
                }
            }
            
            $cms_categories = EHOVEL::model($this->_model, 1)->descendants();

            $this->template = EHOVEL::view('cms/category/edit', array(
                'model' => $model,
                'cms_categories' => $cms_categories,
            ));
        } catch (Exception_BES $e) {
            Remind::factory($e)
                ->send();
        }
    }
    
    /**
     * 编辑模型分类
     */
    public function action_edit()
    {
        try {
            $model = EHOVEL::model('Cms_Model', $this->curr_model_id);
            
            $id = $this->request->query('id');
            $category_model = EHOVEL::model($this->_model, $id);
            if(!$category_model->loaded()){
                Remind::factory(Remind::TYPE_ERROR)
                    ->message(__('Bad Request!'))
                    ->redirect(EHOVEL::url('cms_category/index'))
                    ->send();
            }
            
            if ($_POST) {
                $name = $this->request->post('name');
                $description = $this->request->post('description');
                $pid = $this->request->post('pid');
                //用户名不重复
                if (empty($name) || !$this->_available_name($name, $id)) {
                    Remind::factory(Remind::TYPE_ERROR)
                        ->message(__('Name cannot be repeated!'))
                        ->redirect(EHOVEL::url('cms_category/edit',array('id'=>$id)))
                        ->send();
                }
                $parent = EHOVEL::model($this->_model, $pid);
                if($parent->loaded()){
                    if($parent->is_descendant($category_model)){
                        throw new Exception_BES(__('Request error, try again'));
                    }
                    $current_parent = $category_model->parent();
                    if ($current_parent->id != $parent->id) {
                        $category_model->pid = $parent->id;
                        $category_model->move_to_last_child($parent);
                        $category_model->reload();
                    }
                    $category_model->name = $name;
                    $category_model->description = $description;
                    $category_model->model_id = $model->id;
                    $category_model->save();
                    if($category_model->saved()){
                        Remind::factory(Remind::TYPE_SUCCESS)
                            ->message(__('Edit Successfully!'))
                            ->redirect(EHOVEL::url('cms_category/index'))
                            ->send();
                    }else{
                        Remind::factory(Remind::TYPE_ERROR)
                            ->message($category_model->validation()->errors())
                            ->redirect(EHOVEL::url('cms_category/edit', array('id'=>$id)))
                            ->send();
                    }
                }else{
                    Remind::factory(Remind::TYPE_ERROR)
                        ->message(__('Parent item Loading failed.'))
                        ->redirect(EHOVEL::url('cms_category/edit', array('id'=>$id)))
                        ->send();
                }
            }
            $cms_categories = EHOVEL::model($this->_model, 1)->descendants()->as_array('id');
            unset($cms_categories[$category_model->id]);

            $this->template = EHOVEL::view('cms/category/edit', array(
                'model' => $model,
                'cms_categories' => $cms_categories,
                'category' => $category_model,
            ));
        } catch(Exception_BES $e){
            Remind::factory($e)
                ->send();
        }
    }
    
    /**
     * 删除模型分类
     */
    public function action_delete()
    {
        try {
            $id = $this->request->query('id');
            $category_model = EHOVEL::model($this->_model, $id);
            if ($category_model->loaded()) {
                //该分类下有内容不能删除
                if ($category_model->count_content()>0) {
                    Remind::factory(Remind::TYPE_ERROR)
                        ->message(__('Deleting failed, this category has content!'))
                        ->redirect(EHOVEL::url('cms_category/index'))
                        ->send();
                } else if ($category_model->has_children()) {
                    //该分类下有子分类不能删除
                    Remind::factory(Remind::TYPE_ERROR)
                        ->message(__('Deleting failed with child nodes!'))
                        ->redirect(EHOVEL::url('cms_category/index'))
                        ->send();
                } else {
                    $category_model->delete();
                    Remind::factory(Remind::TYPE_SUCCESS)
                        ->message(__('Delete Successfully!'))
                        ->redirect(EHOVEL::url('cms_category/index'))
                        ->send();
                }
            } else {
                Remind::factory(Remind::TYPE_ERROR)
                    ->message(__('Bad Request!'))
                    ->redirect(EHOVEL::url('cms_category/index'))
                    ->send();
            }
        } catch (Exception_BES $e) {
            Remind::factory($e)
                ->send();
        }
    }

    /**
     * 验证分类名是否存在
     * @param string $name
     * @return bool
     */
    protected function _available_name($name, $id=0)
    {
        $category_model = EHOVEL::model($this->_model);
        $category_model->where('name', '=', $name);
        if($id){
            $category_model->where('id', '!=', $id);
        }
        return $category_model->count_all()==0;
    }
    
    

    /**
     * do something after action
     * @see Controller_Admin_Base::before()
     */
    public function after()
    {
        parent::after();
    }
}
