<?php
defined ( 'SYSPATH' ) or die ( 'No direct script access.' );
/**
 * 站点广告版位控制器
 *
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package Site
 * @category  Controller  
 * @since 2012-02-15
 * @author dongxiaoyu
 * @version   $Id$
 */

I18n::package ( 'site' );

class Controller_Admin_Site_Space extends Controller_Admin_Base_Site
{
    /**
     * 广告版位列表页
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
            $ads_info = EHOVEL::config ( 'site_ads' );
            $infos = EHOVEL::model ( 'Site_Poster_Space' )->find_all();
            $this->template = EHOVEL::view ( 'site/space/list' , array('infos'=>$infos , 'ads_info'=>$ads_info));
        } catch ( Kohana_Exception $ex ) {
            Remind::factory($ex)
                ->send();
        }
    }
    
    /**
     * 编辑广告版位
     * @return void
     */
    public function action_edit() 
    {
        // 初始化返回结构体
        $return_struct = array(
            'status' => 0,
            'code' => 501,
            'msg' => 'Not Implemented',
            'content' => array(),
        );
        try {
            $ads_info = EHOVEL::config ( 'site_ads' );
            $id = intval ( $this->request->query ( 'id' ) );
            $space_info = EHOVEL::model ( 'Site_Poster_Space' )->where('id','=',$id)->find();
            if($space_info->loaded())
            {
                if($_POST)
                {
                    $space_type = $this->request->post ( 'space_type' );
                    if(!empty($space_type))
                    {
                        foreach ($ads_info as $key=>$ads_name)
                        {
                            if($space_type == $ads_name['name'])
                            {
                                $space_type = $key;
                            }
                        }
                    }
                    
                    $space_info->type = $space_type;
                    $space_info->name = $this->request->post ( 'space_name' );
                    $space_info->description = trim($this->request->post ( 'space_description' ));
                    $space_info->width = $this->request->post ( 'space_witdh' );
                    $space_info->height = $this->request->post ( 'space_height' );
                    $space_info->paddleft = $this->request->post ( 'padd_left' );
                    $space_info->paddtop = $this->request->post ( 'padd_top' );
                    if($this->public_check_space($this->request->post ( 'space_name' ),$id) == FALSE)
                    {
                        Remind::factory ( Remind::TYPE_ERROR )
                                ->message ( __ ('Name cannot be repeated' ) )
                                ->redirect ( EHOVEL::url ( 'site_space/edit',array('id' => $id) ) )
                                ->send ();
                    }

                    if($space_type == 'fixure')
                    {
                        $space_info->align = $this->request->post ( 'isAlign' );
                        $space_info->scroll = 0;
                    }
                    elseif($space_type == 'couplet')
                    {
                        $space_info->scroll = $this->request->post ( 'isScroll' );
                        $space_info->align = 0;
                    }
                
                    $space_info->save();
                    Remind::factory ( Remind::TYPE_SUCCESS )
                            ->message ( __ ( 'Edited Successfully!' ) )
                            ->redirect ( EHOVEL::url ( 'site_space' ) )
                            ->send ();
                }
            }
            $this->template = EHOVEL::view ( 'site/space/edit' , array('ads_info'=>$ads_info , 'space_info'=>$space_info) );
        } catch ( Kohana_Exception $ex ) {
            Remind::factory($ex)
                ->send();
        }
    }
    
    /**
     * 添加广告版位
     * @return void
     */
    public function action_add() 
    {
        // 初始化返回结构体
        $return_struct = array(
            'status' => 0,
            'code' => 501,
            'msg' => 'Not Implemented',
            'content' => array(),
        );
        try {
            $space_info = EHOVEL::model ( 'Site_Poster_Space' );
            $ads_info = EHOVEL::config ( 'site_ads' );
            if($_POST)
            {
                $space_type = $this->request->post ( 'space_type' );
                if(!empty($space_type))
                {
                    foreach ($ads_info as $key=>$ads_name)
                    {
                        if($space_type == $ads_name['name'])
                        {
                            $space_type = $key;
                        }
                    }
                }
                
                $space_info->type = $space_type;
                $space_info->name = $this->request->post ( 'space_name' );
                $space_info->description = $this->request->post ( 'space_description' );
                $space_info->width = $this->request->post ( 'space_witdh' );
                $space_info->height = $this->request->post ( 'space_height' );
                $space_info->paddleft = $this->request->post ( 'padd_left' );
                $space_info->paddtop = $this->request->post ( 'padd_top' );

                if($this->public_check_space($this->request->post ( 'space_name' )) == FALSE)
                {
                    Remind::factory ( Remind::TYPE_ERROR )
                            ->message ( __ ('Name cannot be repeated' ) )
                            ->redirect ( EHOVEL::url ( 'site_space/add' ) )
                            ->send ();
                }
                    
                if($space_type == 'fixure')
                {
                    $space_info->align = $this->request->post ( 'isAlign' );
                    $space_info->scroll = 0;
                }
                elseif($space_type == 'couplet')
                {
                    $space_info->scroll = $this->request->post ( 'isScroll' );
                    $space_info->align = 0;
                }
                
                $space_info->save();
                Remind::factory ( Remind::TYPE_SUCCESS )
                        ->message ( __ ( 'Added Successfully!' ) )
                        ->redirect ( EHOVEL::url ( 'site_space' ) )
                        ->send ();
            }
            $ads_info = EHOVEL::config ( 'site_ads' );
            $this->template = EHOVEL::view ( 'site/space/add' , array('ads_info'=>$ads_info));
        } catch ( Kohana_Exception $ex ) {
            Remind::factory($ex)
                ->send();
        }
    }
    
    /**
     * 删除广告版位
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
            $id = intval ( $this->request->query ( 'id' ) );
            if ($id <= 0) 
            {
                throw new Kohana_Exception ( __ ( 'Invalid Request' ), 10000 );
            }
            $space_info = EHOVEL::model ( 'Site_Poster_Space', intval ( $id ) );
            if (! $space_info->loaded ()) 
            {
                Remind::factory ( Remind::TYPE_ERROR )
                        ->message ( __ ('Loading failed, try again' ) )
                        ->redirect ( EHOVEL::url ( 'site_space' ) )
                        ->send ();
            } 
            else 
            {
//                $space_info->date_upd = DATE::get();
//                $space_info->save();
                $space_info->disable ();
                $return_struct ['status'] = 1;
                Remind::factory ( Remind::TYPE_SUCCESS )
                        ->message ( __ ( 'Deleted Successfully!' ) )
                        ->redirect ( EHOVEL::url ( 'site_space' ) )
                        ->send ();
            }
        } catch ( Kohana_Exception $ex ) {
            Remind::factory($ex)
                ->send();
        }
    }
    
    /**
	 * 广告模板设置
	 */
    public function action_space_setting() 
    {
        // 初始化返回结构体
        $return_struct = array(
            'status' => 0,
            'code' => 501,
            'msg' => 'Not Implemented',
            'content' => array(),
        );
        try {
            $ads_info = EHOVEL::config ( 'site_ads' );
            
            $this->template = EHOVEL::view ( 'site/space/setting' , array('ads_info' => $ads_info));
        } catch ( Kohana_Exception $ex ) {
            Remind::factory($ex)
                ->send();
        }
    }
    
    public function action_setting_edit() 
    {
        // 初始化返回结构体
        $return_struct = array(
            'status' => 0,
            'code' => 501,
            'msg' => 'Not Implemented',
            'content' => array(),
        );
        try {
            $getKey =  $this->request->query ( 'key' ) ;
            $ads_info = EHOVEL::config ( 'site_ads' );
            $set_detail = array();
            foreach($ads_info as $key=>$ad_info)
            {
                if($key == $getKey)
                {
                    $set_detail = $ad_info;
                }    
            }
            $this->template = EHOVEL::view ( 'site/space/setting_edit' , array('set_detail' => $set_detail,'key'=>$getKey));
        } catch ( Kohana_Exception $ex ) {
            Remind::factory($ex)
                ->send();
        }
    }
    
	/**
	 * 检测版位名称是否存在
	 */
	public function public_check_space($name,$id='') {
	    if(isset($id))
	    {
	        $space_info = EHOVEL::model ( 'Site_Poster_Space' )->where('id','=',$id)->find();
	        if($name == $space_info->name)
	        {
	            return TRUE;
	        }
	    }
		$space_info = EHOVEL::model ( 'Site_Poster_Space' )->find_all();
		$old_space_name = array();
		foreach($space_info as $spaceDetail)
		{
		    array_push($old_space_name,$spaceDetail->name);
		}
		if (in_array($name,$old_space_name))
		{
		    return FALSE;
		}
		else
		{
		    return TRUE;
		}
	}
}
?>


