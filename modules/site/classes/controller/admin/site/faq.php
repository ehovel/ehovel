<?php defined('SYSPATH') OR die('No direct script access allowed.');

/**
 * 站点Faq
 *
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package Site
 * @category  Controller  
 * @since 2011-11-25
 * @author dongxiaoyu
 * @version   $Id$
 */
I18n::package('site');
class Controller_Admin_Site_Faq extends Controller_Admin_Base_Site {
    /**
     * faq列表页面
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
        try{
            $site_faqs = EHOVEL::model('Site_Faq')->find_all();
            $faq_categories = array();
            foreach($site_faqs as $site_faq)
            {
                $faq_category = EHOVEL::model('Site_Faq_Category',$site_faq->category_id);
                array_push($faq_categories,$faq_category->name);
            }
            
            $this->template = EHOVEL::view('site/faq/index');
            $this->template->site_faqs = $site_faqs; 
            $this->template->faq_categories = $faq_categories; 
        } catch (Kohana_Exception $ex) {
            Remind::factory($ex)
                ->send();
        }
    }
    /**
     * 添加faq的逻辑
     */
    public function action_add()
    {
        // 初始化返回结构体
        $return_struct = array(
            'status'  => 0,
            'code'    => 501,
            'msg'     => 'Not Implemented',
            'content' => array(),
        );
        try {
            if (!empty($_POST)) 
            {
                $faq_category = EHOVEL::model('Site_Faq_Category', $this->request->post('category_id'));
                if(!$faq_category->loaded())
                {
                    throw new Kohana_Exception(__('Loading failed, try again'));
                }
                $faq= EHOVEL::model('Site_Faq');
                $faq->category_id = $this->request->post('category_id');
                $faq->title = trim($this->request->post('title'));
                $faq->content = trim($this->request->post('content'));
                $faq->reply = trim($this->request->post('reply'));
                $faq->status = trim($this->request->post('status'));
                $faq->date_upd = date('Y-m-d H:i:s');
                $faq->date_add  = date('Y-m-d H:i:s', time());
                $faq->save();
                if ($faq->saved()) 
                {
                    Remind::factory ( Remind::TYPE_SUCCESS )
                            ->message ( __ ( 'Added Successfully' ) )
                            ->redirect ( EHOVEL::url ( 'site_faq' ) )
                            ->send ();
                } 
                else 
                {
                    Remind::factory ( Remind::TYPE_ERROR )
                            ->message ( $faq->validation()->errors() )
                            ->redirect ( EHOVEL::url ( 'site_faq/add' ) )
                            ->send ();
                }
            }
            $faq_categories = EHOVEL::model('Site_Faq_Category')->find_all();
            if(count($faq_categories)==0)
            {
                Remind::factory ( Remind::TYPE_ERROR )
                        ->message ( __ ('Please add faq category first!' ) )
                        ->redirect ( EHOVEL::url ( 'site_faq' ) )
                        ->send ();
            }
            $this->template = EHOVEL::view('site/faq/form');
            $this->template->faq_categories = $faq_categories; 
        } catch (Kohana_Exception $ex) {
            Remind::factory($ex)
                ->send();
        }
    }

    /**
     * 编辑faq的逻辑
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
            $faq = EHOVEL::model('Site_Faq',$this->request->query('id'));
            if(!$faq->loaded())
            {
                throw new Kohana_Exception(__('Loading failed, try again'));
            }
            if (!empty($_POST)) 
            {
                $faq_category = EHOVEL::model('Site_Faq_Category', $this->request->post('category_id'));
                if(!$faq_category->loaded())
                {
                    throw new Kohana_Exception(__('Loading failed, try again'));
                }
                $faq->category_id = $this->request->post('category_id');
                $faq->title = trim($this->request->post('title'));
                $faq->content = trim($this->request->post('content'));
                $faq->reply = trim($this->request->post('reply'));
                $faq->status = trim($this->request->post('status'));
                $faq->date_upd = date('Y-m-d H:i:s');
                //print_r($faq->as_array());exit;
                $faq->save();
                if ($faq->saved()) 
                {
                    Remind::factory ( Remind::TYPE_SUCCESS )
                            ->message ( __ ( 'Edited Successfully' ) )
                            ->redirect ( EHOVEL::url ( 'site_faq' ) )
                            ->send ();
                } 
                else 
                {
                    Remind::factory ( Remind::TYPE_ERROR )
                            ->message ( $faq->validation()->errors() )
                            ->redirect ( EHOVEL::url ( 'site_faq' , array('id' => $this->request->query('id'))))
                            ->send ();
                }
            } 
            $faq_categories = EHOVEL::model('Site_Faq_Category')->find_all();
            
            if(count($faq_categories)==0)
            {
                Remind::factory ( Remind::TYPE_ERROR )
                        ->message ( __ ('Please add faq category first!' ) )
                        ->redirect ( EHOVEL::url ( 'site_faq/add' ) )
                        ->send ();
            }
            $this->template = EHOVEL::view('site/faq/form');
            $this->template->faq_categories = $faq_categories;
            $this->template->faq = $faq;
        } catch (Kohana_Exception $ex) {
            Remind::factory($ex)
                ->redirect(EHOVEL::url('site_faq/edit' , array('id' => $this->request->query('id'))))
                ->send();
        }
    }

    /**
     * 删除faq的逻辑
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
            $faq = EHOVEL::model('Site_Faq',$this->request->query('id'));
            
            if(!$faq->loaded()){
                throw new Kohana_Exception(__('Loading failed, try again'));
            }
            $faq->delete();
            Remind::factory ( Remind::TYPE_SUCCESS )
                    ->message ( __ ( 'Delete Successfully!' ) )
                    ->redirect ( EHOVEL::url ( 'site_faq' ) )
                    ->send ();
        } catch (Kohana_Exception $ex) {
            Remind::factory($ex)
                ->send();
        }
    }
}
