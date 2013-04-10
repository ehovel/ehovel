<?php defined('SYSPATH') or die('No direct script access.');
/**
 * 生成oss图片地址
 * 从oss生成缩略图
 * @author daipengxiang
 *
 */
class Helper_Oss
{
	public static function checkObject($object) {
		$oss_service = new ALIOSS();
		$reponse = $oss_service->is_object_exist('publicattach', $object);
		return $reponse->status==404 ? false : $reponse;
	}
	
	/**
     * 根据OSS的object获取临时文件，用于生成缩略图
     *
     * @param str $object
     * @return string $tmp file path
     * @version V1.0 2013-04-08
     */
    public static function get_tmp_img($object)
    {
    	$bucket = 'publicattach';
    	$oss_sdk_service = new ALIOSS();
    	$file = $oss_sdk_service->get_object($bucket, $object);
    	if (substr($file->header['content-type'],0,5)!='image'){
    		throw new OSSException('not a image!');
    		die;
    	} else {
	    	$tmp = tempnam(SYSPATH.DIRECTORY_SEPARATOR.'tmp','osstmp');
	    	$fp = fopen($tmp, 'w+');
	    	fwrite($fp, $file->body);
	    	fclose($fp);
	    	return $tmp;
    	}
    }
    /**
     * 从数据流生成临时文件
     * @param unknown_type $objectStr
     * @throws OSSException
     * @return string
     */
    public static function get_tmp_img_from_string($object)
    {
    	$file = self::getFileFromOss($object);
    	if (substr($file->header['content-type'],0,5)!='image'){
    		throw new OSSException('not a image!');
    		die;
    	} else {
    		$tmp = tempnam(SYSPATH.DIRECTORY_SEPARATOR.'tmp','osstmp');
    		$fp = fopen($tmp, 'w+');
    		fwrite($fp, $file->body);
    		fclose($fp);
    		return $tmp;
    	}
    }
    /**
     * 直接获取文件流
     * @param unknown_type $object
     */
    public static function getFileFromOss($object) {
    	$bucket = 'publicattach';
    	$oss_sdk_service = new ALIOSS();
    	$file = $oss_sdk_service->get_object($bucket, $object);
    	return $file;
    }
    /**
     * xxx一般为纯数字
     * xxx.jpg to xxx-100x100.jpg
     * @param unknown_type $object
     * @param unknown_type $width
     * @param unknown_type $height
     */
    public static function generateThumb($object,$width,$height) {
    	if ($width && $height) {
    		$tmp = self::getFileFromOss($object);
    		$img = Image::factory($tmp->body,NULL,true);
    		$newFileName = substr($object,0,strrpos($object,'.')).'-'.$width.'x'.$height.substr($object,strrpos($object,'.'));
    		$fileName = DOCROOT.'attach'.DIRECTORY_SEPARATOR.$newFileName;
    		$saved = $img->crop($width, $height)
    		->save($fileName);
    	} else {
    		$fileName = DOCROOT.'attach'.DIRECTORY_SEPARATOR.$object;
    		$file = self::getFileFromOss($object);
    		$fp = fopen($fileName, 'w+');
    		fwrite($fp, $file->body);
    		return $file->body;
    	}
	    return $saved;
    }
    
}
