<?php
// $Id$
defined('SYSPATH') or die('No Direct Script Access');
I18n::package('site');

/**
 * Faq分类控制器
 *
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package Site
 * @category  Controller  
 * @since 2011-11-25
 * @author dongxiaoyu
 * @version   $Id$
 */
class Controller_Admin_Site_Tecfaq_Category extends Controller_Admin_Base
{
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
                $site_faq_categories = EHOVEL::model('Site_Tecfaq_Category')->find_all();
                $this->template = EHOVEL::view('site/tecfaq/category_index',array('site_faq_categories'=>$site_faq_categories));
        } catch (Kohana_Exception $ex) {
            Remind::factory($ex)
                ->send();
        }
    }
    
    /**
     * 添加faq分类的逻辑
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
            if(!EHOVEL::model('Site_Tecfaq_Category')->can_add_faq_category())
            {
                Remind::factory ( Remind::TYPE_ERROR )
                    ->message ( __ ('Faq category number can not more than 20!' ) )
                    ->redirect ( EHOVEL::url ( 'site_faq_category' ) )
                    ->send ();
            }
            if (!empty($_POST)) 
            {
                $faq_category = EHOVEL::model('Site_Tecfaq_Category');
             	if ($faq_category->where('name','=',trim($this->request->post('name')))->count_all()){
                	Remind::factory( Remind::TYPE_ERROR )
                    ->message ( __ ('Name cannot be repeated' ) )
                    ->redirect ( EHOVEL::url ( 'site_tecfaq_category/add' ) )
                    ->send ();
                }
                $faq_category->name = trim($this->request->post('name'));
                $faq_category->date_add  = date('Y-m-d H:i:s', time());
                $faq_category->save();
                if ($faq_category->saved()) 
                {
                    Remind::factory ( Remind::TYPE_SUCCESS )
                        ->message ( __ ( 'Added Successfully!' ) )
                        ->redirect ( EHOVEL::url ( 'site_tecfaq_category' ) )
                        ->send ();
                } 
                else 
                {
                    Remind::factory ( Remind::TYPE_ERROR )
                        ->message ( $faq_category->validation()->errors() )
                        ->redirect ( EHOVEL::url ( 'site_tecfaq_category/add' ) )
                        ->send ();
                }
            } 
            $this->template = EHOVEL::view('site/tecfaq/category_form');
        } catch (Kohana_Exception $ex) {
            Remind::factory($ex)
                ->send();
        }
    }

    /**
     * 编辑faq分类的逻辑
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
            $faq_category = EHOVEL::model('Site_Tecfaq_Category',$this->request->query('id'));
            if(!$faq_category->loaded())
            {
                throw new Kohana_Exception(__('Loading failed, try again'));
            }
            if (!empty($_POST)) 
            {
            	if (EHOVEL::model('Site_Tecfaq_Category')->where('name','=',trim($this->request->post('name')))->where('id','!=',$this->request->query('id'))->count_all()){
                	Remind::factory( Remind::TYPE_ERROR )
                    ->message ( __ ('Name cannot be repeated' ) )
                    ->redirect ( EHOVEL::url ( 'site_tecfaq_category' ) )
                    ->send ();
                }
                $faq_category->name = trim($this->request->post('name'));
                $faq_category->save();
                if ($faq_category->saved()) 
                {
                    Remind::factory ( Remind::TYPE_SUCCESS )
                        ->message ( __ ( 'Edited Successfully!' ) )
                        ->redirect ( EHOVEL::url ( 'site_tecfaq_category' ) )
                        ->send ();
                } 
                else 
                {
                    Remind::factory ( Remind::TYPE_ERROR )
                        ->message ( $faq_category->validation()->errors() )
                        ->redirect ( EHOVEL::url ( 'site_tecfaq_category/edit' , array('id' => $this->request->query('id'))) )
                        ->send ();
                }
            } 
            $this->template = EHOVEL::view('site/tecfaq/category_form',array('faq_category'=>$faq_category));
        } catch (Kohana_Exception $ex) {
            Remind::factory($ex)
                ->redirect(EHOVEL::url('site_tecfaq_category/edit',array('id' => $this->request->query('id'))))
                ->send();
        }
    }

    /**
     * 删除faq分类的逻辑
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
            $faq_category = EHOVEL::model('Site_Tecfaq_Category',$this->request->query('id'));
            if(!$faq_category->loaded())
            {
                throw new Kohana_Exception(__('Loading failed, try again'));
            }
            $site_faqs = EHOVEL::model('Site_Tecfaq')->find_all();
            $faq_category_id = EHOVEL::model('Site_Tecfaq')->find_all()->as_array(NULL, 'id');
            if(in_array($this->request->query('id'),$faq_category_id))
            {
                Remind::factory ( Remind::TYPE_ERROR )
                        ->message ( __ ( 'Related to the faq, category cannot be deleted' ) )
                        ->redirect ( EHOVEL::url ( 'site_faq_category' ) )
                        ->send ();
            }
            
            if(is_array($faq_category->faq))
            {
                foreach($faq_category->faq as $faq)
                {
                    if($faq->loaded())
                    {
                        $faq->disable();
                    }
                }
            }
            $faq_category->disable();
            Remind::factory ( Remind::TYPE_SUCCESS )
                ->message ( __ ( 'Delete Successfully!' ) )
                ->redirect ( EHOVEL::url ( 'site_tecfaq_category' ) )
                ->send ();
        } catch (Kohana_Exception $ex) {
            Remind::factory($ex)
                ->send();
        }
    }

}
