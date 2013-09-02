<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Sitemap xml内容组织
 *
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package Site
 * @category  Model  
 * @since 2011-11-25
 * @author dongxiaoyu
 * @version   $Id$
 */
class Sitemap {
	
    /**
     * 获取报头
     * 
     * @access public
     * @return string
     */
	public static function header()
	{
		$xmlContent = '';
        $xmlContent .= '<?xml version="1.0" encoding="UTF-8"?>';
        $xmlContent .= '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        
        return $xmlContent;
	}
	
	public static function render($url,$lastMod,$changeFreq,$priority)
    {
        $r = "";
        $r .= "\t<url>\n";
        $r .= "\t\t<loc>" . self::EscapeXML($url) . "</loc>\n";
        if($lastMod > 0)
            $r .= "\t\t<lastmod>" . $lastMod . "</lastmod>\n";
        if(!empty($changeFreq))
            $r .= "\t\t<changefreq>" . $changeFreq . "</changefreq>\n";
        if($priority !== false && $priority !== "")
            $r .= "\t\t<priority>" . $priority . "</priority>\n";
        $r .= "\t</url>\n";
        return $r;
    }
    
    public static function EscapeXML($string)
    {
        return str_replace(array (
            '&', 
            '"', 
            "'", 
            '<', 
            '>' 
        ), array (
            '&amp;', 
            '&quot;', 
            '&apos;', 
            '&lt;', 
            '&gt;' 
        ), $string);
    }
}
