<?php defined('SYSPATH') OR die('No direct script access allowed.');
// $Id$
/**
 * 后台内容管理分类管理控制器
 *
 */
class Controller_Admin_Cms_Category extends Controller_Admin_Base {
    
    /**
     * 商品分类列表页
     */
    public function action_index()
    {
        try {
            $categories = EHOVEL::model('Product_Category')->tree();
            $attributesets = array();
            if ($categories->count() > 0) {
                $attributesets = EHOVEL::model('Product_AttributeSet')
                    ->where('id', 'in', $categories->as_array('attributeset_id', 'attributeset_id'))
                    ->find_all()
                    ->as_array('id', 'name');
            }
            $this->template = EHOVEL::view('product/category/index', array(
                'categories'    => $categories,
                'attributesets' => $attributesets,
            ));
        } catch (Kohana_Exception $ex) {
            Remind::factory($ex)
                ->redirect(EHOVEL::url('index/index'))
                ->send();
        }
    }
    
    /**
     * 添加商品分类
     */
    public function action_add()
    {
        try {
            $category = EHOVEL::model('Product_Category');
            if (!empty($_POST)) {
                $category->name             = trim($this->request->post('name'));
                $category->attributeset_id  = trim($this->request->post('attributeset_id'));
                $category->url_key          = trim($this->request->post('url_key'));
                $category->active           = trim($this->request->post('active')) === 'Y' ? 'Y' : 'N';
                $category->image            = trim($this->request->post('image'));
                $category->description      = $this->request->post('description');
                $category->meta_title       = trim($this->request->post('meta_title'));
                $category->meta_keywords    = trim($this->request->post('meta_keywords'));
                $category->meta_description = trim($this->request->post('meta_description'));
                
                if($this->request->post('pid') == 1){
                    $parent = EHOVEL::model('Product_Category')->root();
                }else{
                    $parent = EHOVEL::model('Product_Category', intval($this->request->post('pid')));
                }
                if ($parent->loaded()) {
                    $category->insert_as_last_child($parent);
                    if ($category->saved()) {
                        Remind::factory(Remind::TYPE_SUCCESS)
                        ->message(__('Added Successfully'))
                        ->send();
                    } else {
                        Remind::factory(Remind::TYPE_ERROR)
                        ->message($category->validation()->errors())
                        ->redirect(EHOVEL::url('product_category/add'))
                        ->send();
                    }
                } else {
                    Remind::factory(Remind::TYPE_ERROR)
                        ->message(__('Parent error'))
                        ->redirect(EHOVEL::url('product_category/add'))
                        ->send();
                }
            } else {
                $categories    = EHOVEL::model('Product_Category')->tree(true);
                $attributesets = EHOVEL::model('Product_AttributeSet')
                    ->find_all()
                    ->as_array('id', 'name');
                $this->template = EHOVEL::view('product/category/form', array(
                    'category'      => $category,
                    'categories'    => $categories,
                    'attributesets' => $attributesets,
                ));
            }
        } catch (Kohana_Exception $ex) {
            Remind::factory($ex)
                ->send();
        }
    }
    
    /**
     * 编辑商品分类
     */
    public function action_edit()
    {
        try {
            $category = EHOVEL::model('Product_Category', intval($this->request->query('id')));
            if (!empty($_POST)) {
                if($this->request->post('pid') == 1){
                    $parent = EHOVEL::model('Product_Category')->root();
                }else{
                    $parent = EHOVEL::model('Product_Category', intval($this->request->post('pid')));
                }
                if (!$parent->loaded() OR $parent->pk() == $category->pk() OR $parent->is_descendant($category)) {
                    Remind::factory(Remind::TYPE_ERROR)
                        ->message(__('Parent error'))
                        ->redirect(EHOVEL::url('product_category/edit', array('id' => $category->pk())))
                        ->send();
                }
                if ($category->pid != $parent->pk()) {
                    $category->pid = $parent->pk();
                    $category->move_to_last_child($parent);
                    $category->reload();
                }
                
                $category->name             = trim($this->request->post('name'));
                $category->attributeset_id  = trim($this->request->post('attributeset_id'));
                $category->url_key          = trim($this->request->post('url_key'));
                $category->active           = trim($this->request->post('active')) === 'Y' ? 'Y' : 'N';
                $category->image            = trim($this->request->post('image'));
                $category->description      = $this->request->post('description');
                $category->meta_title       = trim($this->request->post('meta_title'));
                $category->meta_keywords    = trim($this->request->post('meta_keywords'));
                $category->meta_description = trim($this->request->post('meta_description'));
                $category->save();
                if ($category->saved()) {
                    Remind::factory(Remind::TYPE_SUCCESS)
                    ->message(__('Edited Successfully'))
                    ->send();
                } else {
                    Remind::factory(Remind::TYPE_ERROR)
                    ->message($category->validation()->errors())
                    ->redirect(EHOVEL::url('product_category/edit', array('id' => $category->pk())))
                    ->send();
                }
            } else {
                $categories    = EHOVEL::model('Product_Category')->tree(true);
                $attributesets = EHOVEL::model('Product_AttributeSet')
                    ->find_all()
                    ->as_array('id', 'name');
                $this->template = EHOVEL::view('product/category/form', array(
                    'category'      => $category,
                    'categories'    => $categories,
                    'attributesets' => $attributesets,
                ));
            }
        } catch (Kohana_Exception $ex) {
            Remind::factory($ex)
                ->send();
        }
    }
    
    /**
     * 删除商品分类
     */
    public function action_delete()
    {
        try {
            $category = EHOVEL::model('Product_Category', intval($this->request->query('id')));
            if ($category->loaded()) {
                $category->delete();
                Remind::factory(Remind::TYPE_SUCCESS)
                    ->message(__('Deleted Successfully'))
                    ->send();
            } else {
                throw new Kohana_Exception(__('Loading failed, try again'));
            }
            
        } catch (Kohana_Exception $ex) {
            Remind::factory($ex)
                ->send();
        }
    }
    
    /**
     * 检查分类名称是否重复
     * 
     * @param string $name
     * @param int $id
     * @return bool
     */
    protected function _available_name($name, $id)
    {
        $model = EHOVEL::model('Product_Category')
            ->where('name', '=', $name);
        if (!empty($id)) {
            $model->where('id', '!=', $id);
        }
        if(EHOVEL::get_site()){
            $model->where('site_id', '=', EHOVEL::get_site());
        }
        return $model->count_all() > 0 ? FALSE : TRUE;
    }
    
    /**
     * 检查分类 URL 关键字是否重复
     * 
     * @param string $url_key
     * @param int $id
     * @return bool
     */
    protected function _available_url_key($url_key, $id)
    {
        $model = EHOVEL::model('Product_Category')
            ->where('url_key', '=', $url_key);
        if (!empty($id)) {
            $model->where('id', '!=', $id);
        }
        if(EHOVEL::get_site()){
            $model->where('site_id', '=', EHOVEL::get_site());
        }
        return $model->count_all() > 0 ? FALSE : TRUE;
    }
}
