<?php defined('SYSPATH') or die('No direct access script');
// $Id$
/**
 * 与站点有关的Helper类
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package Site
 * @category  Helper
 * @since 2011-11-25
 * @author dongxiaoyu
 * @version   $Id$
 */

class Helper_Createjs{

    private static $instance;
     
    public static function &instance()
    {
        if (!isset(self::$instance))
        {
            $class = __CLASS__;
            self::$instance = new $class();
        }
        return self::$instance;
    }
    
   /**
     * 生成banner js
     * @param string $spaceid 
     * @param string $id //广告id
     */
    public function create_js($type,$spaceid,$id){
        /**需要求变量 根据 $id,$spaceid 
        */
        $spaceInfo = EHOVEL::model ( 'Site_Poster_Space' )->where('id','=',$spaceid)->find();
        $upload_url =  (array)EHOVEL::config('upload.base_url');
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
            $adsInfo = EHOVEL::model ( 'Site_Poster' )->where('spaceid','=',$spaceid)->find_all();
            $linkurl=$imageurl=$alt=$ads_type=$flashurl=$title='';
        }
        else
        {
            $adsInfo = EHOVEL::model ( 'Site_Poster' )->where('id','=',$id)->find();
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
            ob_start();
            $view = EHOVEL::view('site/advjs/'.$type, array('app_path'=>$app_path,'spaceid' => $spaceid,
                    'id'=>$id,'type'=>$ads_type,'name'=>$name,'linkurl'=>$linkurl,'imageurl'=>$upload_url[0].$imageurl,'alt'=>$alt,'flashurl'=>$upload_url[0].$flashurl,
                    'siteid'=>$siteid,'width'=>$width,'height'=>$height,'scroll'=>$scroll,'align'=>$align,'paddleft'=>$paddleft,'paddtop'=>$paddtop,'title'=>$title,
                    'pinfo'=>$adsInfo,'spaceInfo'=>$spaceInfo,'upload_url'=>$upload_url,
                    ))->render(NULL,false);
                    
            echo $view;
            $data = ob_get_contents();
    		ob_end_clean();
    		
            $this->storte($type,$spaceid,$data);
            Remind::factory ( Remind::TYPE_SUCCESS )
                        ->message ( __ ( 'Create JS Successfully!' ) )
                        ->redirect ( EHOVEL::url ( 'site_ads' ,array('spaceid'=>$spaceid,'type'=>$type) ) )
                        ->send ();
    }
    
    /**
     * 存储js 代码文件
     * @param string $type //板块类型
     * @param string $name //文件名称
     * @param string $content //js内容
     * @return string 
     */
    public function storte($type,$spaceid,$content){
        $name = $spaceid.'.js';
        $subcat = 'caches'.DIRECTORY_SEPARATOR.'poster_js'.DIRECTORY_SEPARATOR;
        $direct = EHOVEL::config('site_js.direct');
        if (!is_dir($direct . $subcat) AND !@mkdir($direct . $subcat, 0777, TRUE)) {
            throw new Kohana_Exception(__('Fail to establish upload directory'));
        }
        $subcat = str_replace(DIRECTORY_SEPARATOR, '/', $subcat);
        file_put_contents($direct.$subcat.$name,$content); 
        $space_info = EHOVEL::model ( 'Site_Poster_Space', intval ( $spaceid ) );
        $space_info->path = $subcat.$name;
        $space_info->save();
        return  $subcat.$name;
    }
}
