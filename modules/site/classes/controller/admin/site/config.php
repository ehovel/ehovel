<?php
defined ( 'SYSPATH' ) or die ( 'No direct script access.' );
/**
 * 站点配置控制器
 *
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package Site
 * @category  Controller  
 * @since 2011-11-25
 * @author dongxiaoyu
 * @version   $Id$
 */

I18n::package ( 'site' );
class Controller_Admin_Site_Config extends Controller_Admin_Base_Site
{
    /**
     * 站点配置
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
            $site_configs = EHOVEL::config ( 'site.config' );
            if (! empty ( $_POST )) 
            {
                foreach ( $_POST as $key => $value ) 
                {
                    if (in_array ( $key, $site_configs )) 
                    {
                        if ($key === 'domain') 
                        {
                            if (! valid::url ( $value )) 
                            {
                                Remind::factory ( Remind::TYPE_ERROR )
                                        ->message ( __ ('Valid url' ) )
                                        ->redirect ( EHOVEL::url ( 'site_config' ) )
                                        ->send ();
                            }
                            if (!empty($value) AND $value{strlen($value) - 1} === '/') {
                                $value = substr($value, 0, -1);
                            }
                        }
                        EHOVEL::model ( 'Site_Config' )->setc ( $key, $value );
                    }
                }
                Remind::factory ( Remind::TYPE_SUCCESS )
                        ->message ( __ ( 'Edited Successfully!' ) )
                        ->redirect ( EHOVEL::url ( 'site_config' ) )
                        ->send ();
            } 
            else 
            {
                $this->template = EHOVEL::view ( 'site/config/index' );
                if (!empty($site_configs)) 
                {
                    foreach (EHOVEL::model('Site_Config')->where('name', 'in', $site_configs)->find_all() as $config) 
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
     * robots信息设置
     * @return void
     */
    public function action_robots() 
    {
        // 初始化返回结构体
        $return_struct = array(
            'status' => 0,
            'code' => 501,
            'msg' => 'Not Implemented',
            'content' => array(),
        );
        try {
            $robots = '';
            $site_config = EHOVEL::model ( 'Site_Config' );
            $item = $site_config->where ( 'name', '=', 'robots' )->find ();
            if (! empty ( $_POST )) 
            {
                if ($item->loaded ()) 
                {
                    $item->value = $this->request->post ( 'robots' );
                    $item->save ();
                    if ($item->saved ()) 
                    {
                        Remind::factory ( Remind::TYPE_SUCCESS )
                                ->message ( __ ( 'Edited Successfully!' ) )
                                ->redirect ( EHOVEL::url ( 'site_config/robots' ) )
                                ->send ();
                    } 
                    else 
                    {
                        Remind::factory ( Remind::TYPE_ERROR )
                                ->message ( $site_config->validation ()->errors () )
                                ->redirect ( EHOVEL::url ( 'site_config/robots' ) )
                                ->send ();
                    }
                } 
                else 
                {
                    $site_config->name = 'robots';
                    $site_config->value = $this->request->post ( 'robots' );
                    $site_config->save ();
                    if ($site_config->saved ()) 
                    {
                        Remind::factory ( Remind::TYPE_SUCCESS )
                                ->message ( __ ( 'Added Successfully!' ) )
                                ->redirect ( EHOVEL::url ( 'site_config/robots' ) )
                                ->send ();
                    } 
                    else 
                    {
                        Remind::factory ( Remind::TYPE_ERROR )
                                ->message ( $site_config->validation ()->errors () )
                                ->redirect ( EHOVEL::url ( 'site_config/robots' ) )
                                ->send ();
                    }
                }
            } 
            else 
            {
                if ($item->loaded ()) 
                {
                    $robots = $item->value;
                }
            }
            
            $this->template = EHOVEL::view ( 'site/config/robots',array('robots'=>$robots) );
        } catch ( Kohana_Exception $ex ) {
            Remind::factory($ex)
                ->send();
        }
    }
    
	/**
     * robots信息设置
     * @return void
     */
    public function action_aboutus() 
    {
        // 初始化返回结构体
        $return_struct = array(
            'status' => 0,
            'code' => 501,
            'msg' => 'Not Implemented',
            'content' => array(),
        );
        try {
            $aboutus = '';
            $site_config = EHOVEL::model ( 'Site_Config' );
            $item = $site_config->getc ( 'aboutus' );
            $image = $site_config->getc ('aboutus_img');
            if (! empty ( $_POST )) 
            {
                if ($item) 
                {
                    $a = EHOVEL::model ( 'Site_Config' )->setc ( 'aboutus', $this->request->post ( 'aboutus' ) );
                	$b = EHOVEL::model ( 'Site_Config' )->setc ( 'aboutus_img', $this->request->post ( 'image' ) );
                    if ($a && $b) 
                    {
                        Remind::factory ( Remind::TYPE_SUCCESS )
                                ->message ( __ ( 'Edited Successfully!' ) )
                                ->redirect ( EHOVEL::url ( 'site_config/aboutus' ) )
                                ->send ();
                    } 
                    else 
                    {
                        Remind::factory ( Remind::TYPE_ERROR )
                                ->message ( $site_config->validation ()->errors () )
                                ->redirect ( EHOVEL::url ( 'site_config/aboutus' ) )
                                ->send ();
                    }
                }
                else 
                {
                	$a = EHOVEL::model ( 'Site_Config' )->setc ( 'aboutus', $this->request->post ( 'aboutus' ) );
                	$b = EHOVEL::model ( 'Site_Config' )->setc ( 'aboutus_img', $this->request->post ( 'image' ) );
                   
                    if ($a && $b) 
                    {
                        Remind::factory ( Remind::TYPE_SUCCESS )
                                ->message ( __ ( 'Added Successfully!' ) )
                                ->redirect ( EHOVEL::url ( 'site_config/aboutus' ) )
                                ->send ();
                    } 
                    else 
                    {
                        Remind::factory ( Remind::TYPE_ERROR )
                                ->message ( $site_config->validation ()->errors () )
                                ->redirect ( EHOVEL::url ( 'site_config/aboutus' ) )
                                ->send ();
                    }
                }
            } 
            else 
            {
                if ($item) 
                {
                    $aboutus = $item;
                }
            }
            
            $this->template = EHOVEL::view ( 'site/config/aboutus',array('aboutus'=>$aboutus,'image'=>$image) );
        } catch ( Kohana_Exception $ex ) {
            Remind::factory($ex)
                ->send();
        }
    }
}
