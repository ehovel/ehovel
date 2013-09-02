<?php defined('SYSPATH') or die('No direct access script');
// $Id$
/**
 * 工具Helper
 *
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package Kshop
 * @since 11-7-8 上午11:20
 * @author Vicente
 * @version   $Id$
 */
class Helper_Tool{

    /**
     * 生成前台的面包屑
     * 
     * @param array $navigation
     * @return string
     */
    public static function generate_navigation($navigation)
    {
        $return_str = '<a href="'.EHOVEL::url('index').'">Home</a><span class="split">>></span>';
        if(is_array($navigation)){
            $count = count($navigation);
            $i = 0;
            foreach($navigation as $nav){
                if(!empty($nav['href'])){
                    $return_str .= '<a href="'.$nav['href'].'">'.$nav['name'].'</a>';
                }else{
                    $return_str .= $nav['name'];
                }
                $i++;
                if($i<$count){
                    $return_str .= '<span class="split">>></span>';
                }
            }
        }
        return $return_str;
    }

    /**
     * 将数组按标识符分割成字符串
     * 
     * @param array $ids
     * @param char $encloser
     */
    public function enclose_ids($ids, $encloser = ',') 
    {
        $enclosed_ids = '';
        foreach ( $ids as $id ) 
        {
            if ($enclosed_ids != '')
            {
                $enclosed_ids .= $encloser;
            }
            $enclosed_ids .=  $id;  
        }

        return $enclosed_ids;
    }

    /**
     * 字符串截断用...代替显示
     */
    public function my_substr($str,$num)
    {
        if(strlen($str)>($num+2))
        {
            $str = substr($str,0,$num).'...';
        }
        return $str;
    }
    /**
     * 获取客户端IP地址
     *
     * @return String
     */
    public static function get_client_ip(){
        if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
            $ip = getenv("HTTP_CLIENT_IP");
        else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
            $ip = getenv("REMOTE_ADDR");
        else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
            $ip = $_SERVER['REMOTE_ADDR'];
        else
            $ip = "unknown";
        return($ip);
    }
    
    public function prefix_string($level, $sign = '--')
    {
        $return_string = '';
        for($i=1;$i<$level;$i++)
        {
            $return_string .= $sign;
        }
        
        return $return_string;
    }
    public function make_one_day_array($date='1970-01-01'){
        $date_max = date('Y-m-d H:i:s',strtotime($date)+24 * 60 * 60 -1);
        return array($date,$date_max);
    }

    /*
     * 根据GET请求数组生成GET请求字符串
     * @param array $request GET请求数组
     * @param string $key 需改变的GET请求数组KEY
     * @param string $value 改变后的值
     * @return string 生成的GET请求字符串
     */
    public static function create_query_string($request = array(), $key, $value)
    {
        $query_string = '';
        $request[$key] = $value;
        if(!empty($request)){
            foreach($request as $key=>$val){
                $query_string .= '&' . $key . '=' . $val;
            }
            $query_string = preg_replace('/^&/','?',$query_string);
        }
        return $query_string;
    }
}
