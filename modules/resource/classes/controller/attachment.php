<?php defined('SYSPATH') or die('No direct script access.');
/**
 * 显示图片
 */
class Controller_Attachment extends Controller_Base
{
	public function before()
	{
		parent::before();
	}

    /**
     * 查看资源
     * OSS的资源先判断attachments表是否有记录，没有记录直接返回默认图片
     * OSS资源再请求alioss判断是否存在，不存在同上一步响应
     */
    public function action_view()
    {
    	$name = $this->request->param('id');
    	$postfix = $this->request->param('postfix');
    	$pos = strpos($name, '-');
    	$width = $height = 0;
    	if ($pos) {
    		$wh = substr($name, $pos+1);
    		list($width,$height) = explode('x', $wh);
    		$ossname = substr($name,0, $pos);
    		$object = $ossname.'.'.$postfix;
    	} elseif (is_numeric($name)) {
    		$ossname = $name;
    		$object = $name.'.'.$postfix;
    	}
    	//if exist
    		$objectInfo = Helper_Oss::checkObject($object);
    	if (!$objectInfo) {
    		header('content-type:image/png');
    		$thumbDefault = DOCROOT.'attach'.DIRECTORY_SEPARATOR.'no_file.png';
    		echo file_get_contents($thumbDefault);exit;
    	} else {
    		header('content-type:'.$objectInfo->header['content-type']);
    		header('content-length:'.$objectInfo->header['content-length']);
    		header('date:'.$objectInfo->header['date']);
    		header('etag:'.$objectInfo->header['etag']);
    		header('last-modified:'.$objectInfo->header['last-modified']);
    		if ((isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) >= $objectInfo->header['last-modified']) ||
    				(isset($_SERVER['HTTP_IF_UNMODIFIED_SINCE']) && strtotime($_SERVER['HTTP_IF_UNMODIFIED_SINCE']) < $objectInfo->header['last-modified'])
    		) {
    			header('HTTP/1.0 304 Not Modified');
    			exit;
    		}
    		if($objectInfo && ($thumbResult = Helper_Oss::generateThumb($object, $width, $height))) {
    			if (!is_bool($thumbResult)) {//返回数据流直接输出
    				echo $thumbResult;exit;
    			}
    			$thumbPath = DOCROOT.'attach'.DIRECTORY_SEPARATOR.$name.'.'.$postfix;
//     			echo $thumbPath;exit;
    			echo file_get_contents($thumbPath);exit;
    		}
    	}
    	//default img
    	header('content-type:image/png');
    	$thumbDefault = DOCROOT.'attach'.DIRECTORY_SEPARATOR.'no_image.png';
    	echo file_get_contents($thumbDefault);exit;
    }

    
}
