<?php defined('SYSPATH') or die('No direct script access.');
/**
 * 生成oss图片地址
 * 从oss生成缩略图
 * @author daipengxiang
 *
 */
class Helper_Oss
{
    /**
     * 根据attach的url得到缩略图的URL（attach_id:/attachment/view/3919.jpg->/attachment/view/3919_120x120.jpg）
     * @static
     * @param $url
     * @return string
     */
    public static function get_thumbnail_by_attach_url($url = '/attachment/view/3919.jpg', $preset = 'o')
    {
        $attach_configure = Kohana::config('resource.resourceAttach');

        $position = strrpos($url, '.'); //21
        $postfix = substr($url, $position); //.jpg
        $perfix = substr($url, 0, $position); ///attachment/view/3919
        $current_preset_string = !empty($attach_configure['thumbPresets'][$preset])
                ? '_' . $attach_configure['thumbPresets'][$preset] : '';
        $url = $perfix . $current_preset_string . $postfix;
        return $url;
    }

    /**
     * 根据attach_id获取图标(如果是图片要生成缩略图，如果是附件要生成附件的图标)
     *
     * @param $attach_id
     * @param string $ex 后缀
     * @return string
     * @version V1.0 2011-11-03
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

    public static function generateThumb($object,$width,$height) {
    	$tmp = self::get_tmp_img($object);
    	$img = Image::factory($tmp);
    	$newFileName = substr($object,0,strrpos($object,'.')).'_'.$width.'x'.$height.substr($object,strrpos($object,'.'));
    	$fileName = DOCROOT.'attach'.DIRECTORY_SEPARATOR.$newFileName;
    	//以中点裁剪
    	$img->crop($width, $height)
    		->save($fileName);
	    unlink($tmp);
    }
}
