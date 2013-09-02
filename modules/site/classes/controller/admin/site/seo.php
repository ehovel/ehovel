<?php
defined ( 'SYSPATH' ) or die ( 'No direct script access.' );
/**
 * 站点SEO控制器
 *
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package Site
 * @category  Controller  
 * @since 2011-11-25
 * @author dongxiaoyu
 * @version   $Id$
 */

I18n::package ( 'site' );
class Controller_Admin_Site_Seo extends Controller_Admin_Base_Site 
{
    
    protected $seo_product_type = 0;
    protected $seo_category_type = 1;
    protected $is_children = 1;
    
    /**
     * SEO默认信息设置
     * @return void
     */
    public function action_index() 
    {
        // 初始化返回结构体
        $return_struct = array(
            'status' => 0,
            'code' => 501,
            'msg' => 'Not Implemented',
            'content' => array(),
        );
        try {
            if (! empty ( $_POST )) 
            {
                foreach ( $_POST as $key => $value ) 
                {
                    $site_config = EHOVEL::model ( 'Site_Config' );
                    $item = $site_config->where ( 'name', '=', $key )->find ();
                    if ($item->loaded ()) 
                    {
                        $item->value = $value;
                        $item->save ();
                    } 
                    else 
                    {
                        $site_config->name = $key;
                        $site_config->value = $value;
                        $site_config->save ();
                    }
                }
                Remind::factory ( Remind::TYPE_SUCCESS )
                        ->message ( __ ( 'Saved Successfully!' ) )
                        ->redirect ( EHOVEL::url ( 'site_seo' ) )
                        ->send ();
            } 
            else 
            {
                $seo_configs = EHOVEL::config ( 'site.seo' );
                $site_config = EHOVEL::model ( 'Site_Config' );
                
                //商品SEO
                $seo_data = EHOVEL::model ( 'Site_Seo_Manage' )->where ( 'category_id', '=', 0 )->where ( 'type', '=', $this->seo_product_type )->find ();
                
                //分类SEO
                $seo_category_data = EHOVEL::model ( 'Site_Seo_Manage' )->where ( 'category_id', '=', 1 )->where ( 'type', '=', $this->seo_category_type )->find ();

                $sign = $this->request->query ( 'sign' );
                $product = EHOVEL::model('Product');
                
                $this->template = EHOVEL::view ( 'site/seo/index', array ('sign' => $sign, 
                                                                'seo_data' => $seo_data,
                                                                'seo_category_data' => $seo_category_data,
                                                                'categories'    => EHOVEL::model('Product_Category')->tree(),
                                                                'product'       => $product,
                                                            ) );
                if (!empty($seo_configs)) 
                {
                    foreach (EHOVEL::model('Site_Config')->where('name', 'in', $seo_configs)->find_all() as $config) 
                    {
                       $this->template->{$config->name} = $config->value;
                    }
                }
            }
        } catch ( Kohana_Exception $ex ) {
            Remind::factory($ex)
                ->send();
        }
    }
    
    /**
     * 首页SEO信息设置
     * @return void
     */
    public function action_home() {
        // 初始化返回结构体
        $return_struct = array(
            'status' => 0,
            'code' => 501,
            'msg' => 'Not Implemented',
            'content' => array(),
        );
        try {
            if (! empty ( $_POST )) 
            {
                foreach ( $_POST as $key => $value ) 
                {
                    $site_config = EHOVEL::model ( 'Site_Config' );
                    $item = $site_config->where ( 'name', '=', $key )->find ();
                    if ($item->loaded ()) 
                    {
                        $item->value = $value;
                        $item->save ();
                    } 
                    else 
                    {
                        $site_config->name = $key;
                        $site_config->value = $value;
                        $site_config->save ();
                    }
                }
                Remind::factory ( Remind::TYPE_SUCCESS )
                        ->message ( __ ( 'Saved Successfully!' ) )
                        ->redirect ( EHOVEL::url ( 'site_seo/index' ,array('sign'=>'home') ) )
                        ->send ();
            }
        } catch ( Kohana_Exception $ex ) {
            Remind::factory($ex)
                ->send();
        }
    }
    
    /**
     * 商品SEO
     * @return void
     */
    public function action_product() {
        // 初始化返回结构体
        $return_struct = array(
            'status' => 0,
            'code' => 501,
            'msg' => 'Not Implemented',
            'content' => array(),
        );
        try {
            $site_seo_manage = EHOVEL::model ( 'Site_Seo_Manage' );
            if (! empty ( $_POST )) 
            {
                $site_seo_manage->values ( $_POST );
                if ($site_seo_manage->validation ()->check ()) 
                {
                    $category_ids = array ();
                    $category_names = array ();
                    $category_id = ( int ) $this->request->post ( 'category_id' );
                    $is_children = $this->request->post ( 'is_children' );
                    if($is_children == '')
                    {
                        $is_children = 0;
                    }
                    $meta_title = $this->request->post ( 'meta_title' );
                    $meta_keywords = $this->request->post ( 'meta_keywords' );
                    $meta_description = $this->request->post ( 'meta_description' );
                    if ($category_id > 0) 
                    {
                        $product_category = EHOVEL::model ( 'Product_Category', $category_id );
                        if (! $product_category->loaded ()) 
                        {
                            Remind::factory ( Remind::TYPE_ERROR )
                                    ->message ( __ ('Loading failed, try again' ) )
                                    ->redirect ( EHOVEL::url ( 'site_seo/index',array('sign'=>'products') ) )
                                    ->send ();
                        }
                        $item = $site_seo_manage->where ( 'category_id', '=', $category_id )->where ( 'type', '=', $this->seo_product_type )->find ();
                        if ($item->loaded ()) 
                        {
                            $item->is_children = $is_children;
                            $item->meta_title = $meta_title;
                            $item->meta_keywords = $meta_keywords;
                            $item->meta_description = $meta_description;
                            $item->date_upd = date ( 'Y-m-d H:i:s', time () );
                            $item->save ();
                        } 
                        else 
                        {
                            $site_seo_manage->category_id = $category_id;
                            $site_seo_manage->is_children = $is_children;
                            $site_seo_manage->meta_title = $meta_title;
                            $site_seo_manage->meta_keywords = $meta_keywords;
                            $site_seo_manage->meta_description = $meta_description;
                            $site_seo_manage->type = $this->seo_product_type;
                            $site_seo_manage->date_add = date ( 'Y-m-d H:i:s', time () );
                            $site_seo_manage->date_upd = date ( 'Y-m-d H:i:s', time () );
                            $site_seo_manage->save ();
                        }
                        if ($site_seo_manage->saved () || $item->saved ()) 
                        {
                            if ($is_children == 1) 
                            {
                                //得到分类下的子分类
                                $categories = $product_category->descendant_ids ();
                                foreach ( $categories as $id ) 
                                {
                                    $category = EHOVEL::model ( 'Product_Category', $id );
                                    $category_ids [] = $id;
                                    $category_names [$id] = $category->name;
                                    //查看分类SEO信息
                                    $result = EHOVEL::model ( 'Site_Seo_Manage' )->where ( 'category_id', '=', $id )->where ( 'type', '=', $this->seo_product_type )->find ();
                                    if ($result->loaded ()) 
                                    {
                                        $result->meta_title = $meta_title;
                                        $result->meta_description = $meta_description;
                                        $result->meta_keywords = $meta_keywords;
                                        $result->date_upd = date ( 'Y-m-d H:i:s', time () );
                                        $result->save ();
                                    } 
                                    else 
                                    {
                                        $seo_manage_model = EHOVEL::model ( 'Site_Seo_Manage' );
                                        $seo_manage_model->category_id = $id;
                                        $seo_manage_model->is_children = $this->is_children;
                                        $seo_manage_model->meta_title = $meta_title;
                                        $seo_manage_model->meta_keywords = $meta_keywords;
                                        $seo_manage_model->meta_description = $meta_description;
                                        $seo_manage_model->type = $this->seo_product_type;
                                        $seo_manage_model->date_add = date ( 'Y-m-d H:i:s', time () );
                                        $seo_manage_model->date_upd = date ( 'Y-m-d H:i:s', time () );
                                        $seo_manage_model->save ();
                                    }
                                }
                            }
                            
                            $category_ids [] = $category_id;
                            $category_names [$category_id] = $product_category->name;
                        } 
                        else 
                        {
                            Remind::factory ( Remind::TYPE_ERROR )
                                    ->message ( $site_seo_manage->validation ()->errors () )
                                    ->redirect ( EHOVEL::url ( 'site_seo/index',array('sign'=>'products') ) )
                                    ->send ();
                        }
                    } 
                    else 
                    {
                        //没有选择分类，默认更新全部分类
                        $item = EHOVEL::model ( 'Site_Seo_Manage' )->where ( 'category_id', '=', $category_id )->where ( 'type', '=', $this->seo_product_type )->find ();
                        if ($item->loaded ()) 
                        {
                            $item->meta_title = $meta_title;
                            $item->meta_keywords = $meta_keywords;
                            $item->meta_description = $meta_description;
                            $item->date_upd = date ( 'Y-m-d H:i:s', time () );
                            $item->save ();
                        } 
                        else 
                        {
                            $seo_manage_model = EHOVEL::model ( 'Site_Seo_Manage' );
                            $seo_manage_model->category_id = $category_id;
                            $seo_manage_model->is_children = $this->is_children;
                            $seo_manage_model->meta_title = $meta_title;
                            $seo_manage_model->meta_keywords = $meta_keywords;
                            $seo_manage_model->meta_description = $meta_description;
                            $seo_manage_model->type = $this->seo_product_type;
                            $seo_manage_model->date_add = date ( 'Y-m-d H:i:s', time () );
                            $seo_manage_model->date_upd = date ( 'Y-m-d H:i:s', time () );
                            $seo_manage_model->save ();
                        }
                        
                        //得到站点所有分类
                        $categories = EHOVEL::model ( 'Product_Category' )->find_all ();
                        foreach ( $categories as $category ) 
                        {
                            $category_ids [] = $category->id;
                            $category_names [$category->id] = $category->name;
                            //查看分类SEO信息
                            $result = EHOVEL::model ( 'Site_Seo_Manage' )->where ( 'category_id', '=', $category->id )->where ( 'type', '=', $this->seo_product_type )->find ();
                            if ($result->loaded ()) 
                            {
                                $result->meta_title = $meta_title;
                                $result->meta_keywords = $meta_keywords;
                                $result->meta_description = $meta_description;
                                $result->date_upd = date ( 'Y-m-d H:i:s', time () );
                                $result->save ();
                            } 
                            else 
                            {
                                $seo_manage_model = EHOVEL::model ( 'Site_Seo_Manage' );
                                $seo_manage_model->category_id = $category->id;
                                $seo_manage_model->is_children = $this->is_children;
                                $seo_manage_model->meta_title = $meta_title;
                                $seo_manage_model->meta_keywords = $meta_keywords;
                                $seo_manage_model->meta_description = $meta_description;
                                $seo_manage_model->type = $this->seo_product_type;
                                $seo_manage_model->date_add = date ( 'Y-m-d H:i:s', time () );
                                $seo_manage_model->date_upd = date ( 'Y-m-d H:i:s', time () );
                                $seo_manage_model->save ();
                            }
                        }
                    }
                    
                    $count = EHOVEL::model ( 'Product' )->where ( 'category_id', 'in', $category_ids )->count_all ();
                    if ($count < 10000) 
                    {
                        $products = EHOVEL::model ( 'Product' )->where ( 'category_id', 'in', $category_ids )->find_all ();
                        foreach ( $products as $product ) 
                        {
                            $product_name = $product->name;
                            $category_name = isset ( $category_names [$product->category_id] ) ? $category_names [$product->category_id] : '';
                            $price = $product->price;
                            
                            $title = str_replace ( '{product_name}', $product_name, $meta_title );
                            $keywords = str_replace ( '{product_name}', $product_name, $meta_keywords );
                            $description = str_replace ( '{product_name}', $product_name, $meta_description );
                            
                            $title = str_replace ( '{category_name}', $category_name, $title );
                            $keywords = str_replace ( '{category_name}', $category_name, $keywords );
                            $description = str_replace ( '{category_name}', $category_name, $description );
                            
                            $title = str_replace ( '{price}', $price, $title );
                            $keywords = str_replace ( '{price}', $price, $keywords );
                            $description = str_replace ( '{price}', $price, $description );
                            
                            $product->detail->meta_title = $title;
                            $product->detail->meta_keywords = $keywords;
                            $product->detail->meta_description = $description;
                            $product->detail->save ();
                        }
                    }
                    
                    Remind::factory ( Remind::TYPE_SUCCESS )
                            ->message ( __ ( 'Saved Successfully!' ) )
                            ->redirect ( EHOVEL::url ( 'site_seo/index',array('sign'=>'products') ) )
                            ->send ();
                } 
                else 
                {
                    Remind::factory ( Remind::TYPE_ERROR )
                            ->message ( $site_seo_manage->validation ()->errors () )
                            ->redirect ( EHOVEL::url ( 'site_seo/index',array('sign'=>'products') ) )
                            ->send ();
                }
            }
        } catch ( Kohana_Exception $ex ) {
            Remind::factory($ex)
                ->send();
        }
    }
    
    /**
     * 查看分类是否有子分类
     * @return void
     */
    public function action_product_child() {
        $return_struct = array(
            'status' => 0,
            'code' => 501,
            'msg' => 'Not Implemented',
            'content' => array(),
        );
        try {
            $category_id = $this->request->query ( 'category_id' );
            if ($category_id > 0) 
            {
                $product_category_model = EHOVEL::model ( 'Product_Category', $category_id );
                
                if (! $product_category_model->loaded ()) 
                {
                    throw Kohana_Exception ( __ ( 'Loading failed, try again' ), 500 );
                }
                $childrens = $product_category_model->children_ids ();
                if (! empty ( $childrens )) 
                {
                    $is_contain_child = 1;
                } 
                else 
                {
                    $is_contain_child = 0;
                }
            } 
            else 
            {
                $category_id = 0;
                $is_contain_child = 0;
            }
            
            $seo_manage_model = EHOVEL::model ( 'Site_Seo_Manage' )->where ( 'category_id', '=', $category_id )->where ( 'type', '=', $this->seo_product_type )->find ();
            $count = EHOVEL::model ( 'Site_Seo_Manage' )->where ( 'category_id', '=', $category_id )->where ( 'type', '=', $this->seo_product_type )->count_all ();
            $return_struct ['is_contain_child'] = $is_contain_child;
            if ($count > 0) 
            {
                $return_struct ['status'] = 1;
                $return_struct ['code'] = 200;
                $return_struct ['content'] = $seo_manage_model->as_array ();
            }
            
            header ( 'Content-Type: text/javascript; charset=UTF-8' );
            exit ( json_encode ( $return_struct ) );
        } catch ( Kohana_Exception $ex ) {
            Remind::factory($ex)
                ->send();
        }
    }
    
    /**
     * 分类SEO
     * @return void
     */
    public function action_category() {
        // 初始化返回结构体
        $return_struct = array(
            'status' => 0,
            'code' => 501,
            'msg' => 'Not Implemented',
            'content' => array(),
        );
        try {
            $robots = '';
            $site_seo_manage = EHOVEL::model ( 'Site_Seo_Manage' );
            if (! empty ( $_POST )) 
            {
                $site_seo_manage->values ( $_POST );
                if ($site_seo_manage->validation ()->check ()) 
                {
                    $category_id = ( int ) $this->request->post ( 'category_id' );
                    $is_children = $this->request->post ( 'is_children' );
                    if($is_children == '')
                    {
                        $is_children = 0;
                    }
                    $meta_title = $this->request->post ( 'meta_title' );
                    $meta_keywords = $this->request->post ( 'meta_keywords' );
                    $meta_description = $this->request->post ( 'meta_description' );
                    if ($category_id > 0) 
                    {
                        $product_category = EHOVEL::model ( 'Product_Category', $category_id );
                        if (! $product_category->loaded ()) 
                        {
                            Remind::factory ( Remind::TYPE_ERROR )
                                    ->message ( __ ('Loading failed, try again' ) )
                                    ->redirect ( EHOVEL::url ( 'site_seo/index',array('sign'=>'categories') ) )
                                    ->send ();
                        }
                        //查看分类SEO信息
                        $result = EHOVEL::model ( 'Site_Seo_Manage' )->where ( 'category_id', '=', $category_id )->where ( 'type', '=', $this->seo_category_type )->find ();
                        
                        if ($result->loaded ()) 
                        {
                            $result->meta_title = $meta_title;
                            $result->meta_keywords = $meta_keywords;
                            $result->meta_description = $meta_description;
                            $result->date_upd = date ( 'Y-m-d H:i:s', time () );
                            $result->save ();
                        } 
                        else 
                        {
                            $seo_manage_model = EHOVEL::model ( 'Site_Seo_Manage' );
                            $seo_manage_model->category_id = $category_id;
                            $seo_manage_model->is_children = $is_children;
                            $seo_manage_model->meta_title = $meta_title;
                            $seo_manage_model->meta_keywords = $meta_keywords;
                            $seo_manage_model->meta_description = $meta_description;
                            $seo_manage_model->type = $this->seo_category_type;
                            $seo_manage_model->date_add = date ( 'Y-m-d H:i:s', time () );
                            $seo_manage_model->date_upd = date ( 'Y-m-d H:i:s', time () );
                            $seo_manage_model->save ();
                        }
                        if ($is_children == 1) 
                        {
                            $categories = $product_category->descendant_ids ();
                            
                            foreach ( $categories as $id ) 
                            {
                                $result = EHOVEL::model ( 'Site_Seo_Manage' )->where ( 'category_id', '=', $id )->where ( 'type', '=', $this->seo_category_type )->find ();
                                //如果此分类有seo信息，更新seo分类数据；
                                if ($result->loaded ()) 
                                {
                                    $result->meta_title = $meta_title;
                                    $result->meta_keywords = $meta_keywords;
                                    $result->meta_description = $meta_description;
                                    $result->is_children = $is_children;
                                    $result->date_upd = date ( 'Y-m-d H:i:s', time () );
                                    $result->save ();
                                }
                                //更新分类的seo信息
                                $category = EHOVEL::model ( 'Product_Category', $id );
                                
                                $title = str_replace ( '{category_name}', $category->name, $meta_title );
                                $keywords = str_replace ( '{category_name}', $category->name, $meta_keywords );
                                $description = str_replace ( '{category_name}', $category->name, $meta_description );
                                
                                $title = str_replace ( '{parent_category_name}', $product_category->name, $title );
                                $keywords = str_replace ( '{parent_category_name}', $product_category->name, $keywords );
                                $description = str_replace ( '{parent_category_name}', $product_category->name, $description );
                                
                                $category->meta_title = $title;
                                $category->meta_keywords = $keywords;
                                $category->meta_description = $description;
                                $category->save ();
                            }
                        } 
                        else 
                        {
                            $categories = $product_category->children_ids ();
                            
                            foreach ( $categories as $id ) 
                            {
                                $category = EHOVEL::model ( 'Product_Category', $id );
                                
                                $title = str_replace ( '{category_name}', $category->name, $meta_title );
                                $keywords = str_replace ( '{category_name}', $category->name, $meta_keywords );
                                $description = str_replace ( '{category_name}', $category->name, $meta_description );
                                
                                $title = str_replace ( '{parent_category_name}', $product_category->name, $title );
                                $keywords = str_replace ( '{parent_category_name}', $product_category->name, $keywords );
                                $description = str_replace ( '{parent_category_name}', $product_category->name, $description );
                                
                                $category->meta_title = $title;
                                $category->meta_keywords = $keywords;
                                $category->meta_description = $description;
                                $category->save ();
                            }
                        }
                        
                        Remind::factory ( Remind::TYPE_SUCCESS )
                                ->message ( __ ( 'Saved Successfully!' ) )
                                ->redirect ( EHOVEL::url ( 'site_seo/index',array('sign'=>'categories') ) )
                                ->send ();
                    } 
                    else 
                    {
                        //查看分类SEO信息
                        $result = EHOVEL::model ( 'Site_Seo_Manage' )->where ( 'category_id', '=', $category_id )->where ( 'type', '=', $this->seo_category_type )->find ();
                        if ($result->loaded ()) 
                        {
                            $result->is_children = $is_children;
                            $result->meta_title = $meta_title;
                            $result->meta_keywords = $meta_keywords;
                            $result->meta_description = $meta_description;
                            $result->date_upd = date ( 'Y-m-d H:i:s', time () );
                            $result->save ();
                        } 
                        else 
                        {
                            $seo_manage_model = EHOVEL::model ( 'Site_Seo_Manage' );
                            $seo_manage_model->category_id = $category_id;
                            $seo_manage_model->is_children = $is_children;
                            $seo_manage_model->meta_title = $meta_title;
                            $seo_manage_model->meta_keywords = $meta_keywords;
                            $seo_manage_model->meta_description = $meta_description;
                            $seo_manage_model->type = $this->seo_category_type;
                            $seo_manage_model->date_add = date ( 'Y-m-d H:i:s', time () );
                            $seo_manage_model->date_upd = date ( 'Y-m-d H:i:s', time () );
                            $seo_manage_model->save ();
                        }
                        
                        Remind::factory ( Remind::TYPE_SUCCESS )
                                ->message ( __ ( 'Saved Successfully!' ) )
                                ->redirect ( EHOVEL::url ( 'site_seo/index',array('sign'=>'categories') ) )
                                ->send ();
                    }
                } 
                else 
                {
                    Remind::factory ( Remind::TYPE_ERROR )
                            ->message ( $site_seo_manage->validation ()->errors () )
                            ->redirect ( EHOVEL::url ( 'site_seo/index',array('sign'=>'categories') ) )
                            ->send ();
                }
            }
        } catch ( Kohana_Exception $ex ) {
            Remind::factory($ex)
                ->send();
        }
    }
    
    /**
     * 查看分类SEO的信息
     * @return void
     */
    public function action_category_child() {
        $return_struct = array(
            'status' => 0,
            'code' => 501,
            'msg' => 'Not Implemented',
            'content' => array(),
        );
        try {
            $return_data = array ();
            $category_id = $this->request->query ( 'category_id' );
            if ($category_id > 0) 
            {
                $product_category_model = EHOVEL::model ( 'Product_Category', $category_id );
                
                if (! $product_category_model->loaded ()) 
                {
                    throw Kohana_Exception ( __ ( 'Loading failed, try again' ), 500 );
                }
                $count = EHOVEL::model ( 'Site_Seo_Manage' )->where ( 'category_id', '=', $product_category_model->id )->where ( 'type', '=', $this->seo_category_type )->count_all ();
                if ($count > 0) 
                {
                    $seo_manage_model = EHOVEL::model ( 'Site_Seo_Manage' )->where ( 'category_id', '=', $product_category_model->id )->where ( 'type', '=', $this->seo_category_type )->find ();
                    $return_struct ['status'] = 1;
                    $return_struct ['code'] = 200;
                    $return_struct ['content'] = $seo_manage_model->as_array ();
                } 
                else 
                {
                    $parent_category = $product_category_model->parents ( true , 'desc' );
                    if (! empty ( $parent_category )) 
                    {
                        foreach ( $parent_category as $category ) 
                        {
                            $parent_ids [] = $category->id;
                        }
                        $parent_seo = EHOVEL::model ( 'Site_Seo_Manage' )->where ( 'category_id', 'in', $parent_ids )->where ( 'type', '=', $this->seo_category_type )->find_all ();
                        
                        foreach ( $parent_seo as $seo ) 
                        {
                            if ($seo->category_id == $product_category_model->pid) 
                            {
                                $return_data = $seo->as_array ();
                                break;
                            } 
                            else 
                            {
                                if ($seo->is_children == 1) 
                                {
                                    $return_data = $seo->as_array ();
                                    break;
                                } 
                                else
                                {
                                    break;
                                }
                            }
                        }
                        //查看父分类的seo信息
                        if (! empty ( $return_data )) 
                        {
                            $return_struct ['status'] = 1;
                            $return_struct ['code'] = 200;
                            $return_struct ['content'] = $return_data;
                        }
                    }
                }
            } 
            else 
            {
                $site_seo_manage = EHOVEL::model ( 'Site_Seo_Manage' );
                $seo_data = $site_seo_manage->where ( 'category_id', '=', 0 )->where ( 'type', '=', $this->seo_category_type )->find ();
                
                $return_struct ['status'] = 1;
                $return_struct ['code'] = 200;
                $return_struct ['content'] = $seo_data->as_array ();
            }
            
            header ( 'Content-Type: text/javascript; charset=UTF-8' );
            exit ( json_encode ( $return_struct ) );
        } catch ( Kohana_Exception $ex ) {
            Remind::factory($ex)
                ->send();
        }
    }
}
