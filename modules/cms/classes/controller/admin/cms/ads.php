 <?php
defined ( 'SYSPATH' ) or die ( 'No direct script access.' );
/**
 * 站点广告控制器
 */

class Controller_Admin_Cms_Ads extends Controller_Admin_Base 
{
    /**
     * 站点广告列表页
     * @return void
     */
    protected $types = array(
                    '1'=>'html',
                    '2'=>'代码',
                    '3'=>'图片轮转',
                );

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
            $adsObj = EHOVEL::model('ads');
            $ads = $adsObj->find_all();
            
            $this->template = EHOVEL::view ( 'ads/index' , array(
                            'ads' => $ads,
                            'types' => $this->types,
                                        )               
                            );
        }catch ( Exception $ex ){
            Message::set($ex);
        }
    }
    
    /**
     * 添加站点广告
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
            $spaceid = intval ( $this->request->query ( 'spaceid' ) );
            $space_info = BES::model ( 'Site_Poster_Space' )->where('id','=',$spaceid)->find();
            $type =  $this->request->query ( 'type' ) ;
            $ads_info = BES::config ( 'site_ads' );
            $ads_detail = BES::model ( 'Site_Poster' );
            $isHide = $type;
            
            if($_POST)
            {
                $ads_type = $this->request->post ( 'ads_type' );
                if(!empty($ads_type))
                {
                    foreach ($ads_info as $key=>$ads_name)
                    {
                        foreach($ads_name['type'] as $key=>$ad_name)
                        {
                            if($ad_name == $ads_type)
                            {
                                $ads_type = $key;
                            }
                        }
                    }
                }

                $ads_detail->spaceid = $spaceid;
                $ads_detail->name = $this->request->post ( 'ads_title' );
                $ads_detail->type = $ads_type;
                $ads_detail->linkurl = $this->request->post ( 'link_address' );
                $ads_detail->imageurl = $this->request->post ( 'image' );
                $ads_detail->alt = $this->request->post ( 'alt_tip' );
                $ads_detail->title = $this->request->post ( 'text_content' );
                $ads_detail->date_upd = date('Y-m-d H:i:s');
                
                if($this->public_check_ads($this->request->post ( 'ads_title' )) == FALSE)
                {
                    Remind::factory ( Remind::TYPE_ERROR )
                                ->message ( __ ('Name cannot be repeated' ) )
                                ->redirect ( BES::url ( 'site_ads/add',array('type' => $space_info->type,'spaceid' => $spaceid ) ) )
                                ->send ();
                }
                
                $ads_detail->save();
                Remind::factory ( Remind::TYPE_SUCCESS )
                            ->message ( __ ( 'Added Successfully!' ) )
                            ->redirect ( BES::url ( 'site_ads',array('type' => $type,'spaceid'=>$spaceid) ) )
                            ->send ();
            }
            
            $space_info = BES::model ( 'Site_Poster_Space', intval ( $spaceid ) );
            
            $this->template = BES::view ( 'site/ads/add' , array('type' => $ads_info[$type]['type'],
                                                           'spaceid' => $spaceid,
                                                           'space_info'=>$space_info,
                                                           'ads_info'=>$ads_info,
                                                            'isHide'=>$isHide,
            ));
        }catch ( Exception_BES $ex ){
            Remind::factory($ex)
                ->send();
        }
    }
    
    /**
     * 编辑站点广告
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
            $id = intval ($this->request->param('id'));
            $ads_detail = EHOVEL::model ( 'ads', intval ( $id ) );
            if (!$ads_detail->loaded()) {
                echo 'Load Failed';
                exit;
            }
            if($_POST)
            {
                $ads_detail->type = $this->request->post ( 'ads_type' );
                $ads_detail->modified = date('Y-m-d H:i:s');
				$resource_ids = $this->request->post('resource_ids');
                foreach ($resource_ids as $id) {
                    $ads_content[] = array('banner'=>$id,'bannerurl'=>Helper_Resource::getLinkByResourceId($id));
                }
                $ads_detail->content = serialize($ads_content);
                $ads_detail->save();
                Message::set ( Message::SUCCESS,__ ( 'Edited Successfully!' ) );
                $this->redirect ( EHOVEL::url ( 'cms_ads',array('id'=>$ads_detail->id)) );
            }
            $ads_detail->content = unserialize($ads_detail->content);
            $this->template = EHOVEL::view ( 'ads/edit' , array(
                                                            'types'=>$this->types,
                                                            'id' => $id,
                                                            'ads_detail'=>$ads_detail,
            ));
        }catch (Exception $ex ){
            Message::set($ex);
        }
    }
    
    /**
     * 删除站点广告
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
            $spaceid = intval ( $this->request->query ( 'spaceid' ) );
            $type =  $this->request->query ( 'type' ) ;
            $id = $this->request->query ('id');
            $ads_info = Kohana::load('site_ads');
            $ads_detail = BES::model ( 'Site_Poster', intval ( $id ) );
            if (! $ads_detail->loaded ()) 
            {
                Remind::factory ( Remind::TYPE_ERROR )
                        ->message ( __ ('Loading failed, try again' ) )
                        ->redirect ( BES::url ( 'site_ads' ) )
                        ->send ();
            } 
            else 
            {
                $ads_detail->date_upd = DATE::get();
                $ads_detail->save();
                $ads_detail->disable ();
                Remind::factory ( Remind::TYPE_SUCCESS )
                        ->message ( __ ( 'Deleted Successfully!' ) )
                        ->redirect ( BES::url ( 'site_ads',array('spaceid'=>$spaceid,'type'=>$type) ) )
                        ->send ();
            }
            
        }catch ( Exception_BES $ex ){
            Remind::factory($ex)
                ->send();
        }
    }
    
/**
	 * 检测广告名称是否存在
	 */
	public function public_check_ads($name,$id='') {
	    if(isset($id))
	    {
	        $ads_info = BES::model ( 'Site_Poster' )->where('id','=',$id)->find();
	        if($name == $ads_info->name)
	        {
	            return TRUE;
	        }
	    }
		$ads_info = BES::model ( 'Site_Poster' )->find_all();
		$old_ads_name = array();
		foreach($ads_info as $ad_info)
		{
		    array_push($old_ads_name,$ad_info->name);
		}
		if (in_array($name,$old_ads_name))
		{
		    return FALSE;
		}
		else
		{
		    return TRUE;
		}
	}
	
	/**
	 * 更新js
	 */
	public function action_create_js() 
	{
	    $type =  $this->request->query ( 'type' ) ;
	    $spaceid =  $this->request->query ( 'spaceid' ) ;
	    $adsInfo = BES::model('Site_Poster')->where('spaceid','=',$spaceid)->order_by('date_upd', 'desc')->find();
	    Helper_Createjs::instance()->create_js($type,$spaceid,$adsInfo->id);
	}
	
	public function action_show_poster() {
	    $type =  $this->request->query ( 'type' ) ;
	    $spaceid =  $this->request->query ( 'spaceid' ) ;
	    $adsInfo = BES::model('Site_Poster')->where('spaceid','=',$spaceid)->order_by('date_upd', 'desc')->find();
	    $id = $adsInfo->id;
		/**需要求变量 根据 $id,$spaceid 
        */
        $spaceInfo = BES::model ( 'Site_Poster_Space' )->where('id','=',$spaceid)->find();
        $upload_url =  (array)BES::config('upload.base_url');
        if(!empty($spaceInfo))
        {
            isset($spaceInfo->type) ? $type = $spaceInfo->type : $type='';
            isset($spaceInfo->name) ? $name = $spaceInfo->name : $name='';
            isset($spaceInfo->siteid) ? $siteid = $spaceInfo->siteid : $siteid=1;
            isset($spaceInfo->scroll) ? $scroll = $spaceInfo->scroll : $scroll='';
            isset($spaceInfo->align) ? $align = $spaceInfo->align : $align='';
            isset($spaceInfo->paddleft) ? $paddleft = $spaceInfo->paddleft : $paddleft='';
            isset($spaceInfo->paddtop) ? $paddtop = $spaceInfo->paddtop : $paddtop='';
            isset($spaceInfo->width) ? $width = $spaceInfo->width : $width='';
            isset($spaceInfo->height) ? $height = $spaceInfo->height : $height='';
        }
        $app_path = isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '');
            
        if($type == 'imagechange' || $type == 'imagelist' || $type == 'text')
        {
            $adsInfo = BES::model ( 'Site_Poster' )->where('spaceid','=',$spaceid)->find_all();
            $linkurl=$imageurl=$alt=$ads_type=$flashurl=$title='';
        }
        else
        {
            $adsInfo = BES::model ( 'Site_Poster' )->where('id','=',$id)->find();
            if(!empty($adsInfo))
            {
                isset($adsInfo->linkurl) ? $linkurl = $adsInfo->linkurl : $linkurl='';
                isset($adsInfo->imageurl) ? $imageurl = $adsInfo->imageurl : $imageurl='';
                isset($adsInfo->alt) ? $alt = $adsInfo->alt : $alt='';
                isset($adsInfo->type) ? $ads_type = $adsInfo->type : $ads_type='';
                isset($adsInfo->flashurl) ? $flashurl = $adsInfo->flashurl : $flashurl='';
                isset($adsInfo->title) ? $title = $adsInfo->title : $title='';
                $adsInfo->linkurl == 'http://' ? $linkurl = '' : $linkurl = $adsInfo->linkurl;
            }
        }
            $view = BES::view('site/advjs/'.$type, array('app_path'=>$app_path,'spaceid' => $spaceid,
                    'id'=>$id,'type'=>$ads_type,'name'=>$name,'linkurl'=>$linkurl,'imageurl'=>$upload_url[0].$imageurl,'alt'=>$alt,'flashurl'=>$upload_url[0].$flashurl,
                    'siteid'=>$siteid,'width'=>$width,'height'=>$height,'scroll'=>$scroll,'align'=>$align,'paddleft'=>$paddleft,'paddtop'=>$paddtop,'title'=>$title,
                    'pinfo'=>$adsInfo,'spaceInfo'=>$spaceInfo,'upload_url'=>$upload_url,
                    ))->render(NULL,false);
        echo $view;
	}
	
	public function action_call_js()
	{
	    $type =  $this->request->query ( 'type' ) ;
	    $spaceid =  $this->request->query ( 'spaceid' ) ;
	    $adsInfo = BES::model('Site_Poster')->order_by('date_upd', 'desc')->find();
	    $space_info = BES::model ( 'Site_Poster_Space' )->where('id','=',$spaceid)->find();
	    $view = BES::view ( 'site/ads/call_js' , array('space_info'=>$space_info,'spaceid'=>$spaceid,'type'=>$type,'id'=>$adsInfo->id))->render(NULL,false);
	    echo $view;
	    
	}
}
 

