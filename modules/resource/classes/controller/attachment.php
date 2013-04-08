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
    	if ($pos) {
    		$wh = substr($name, $pos+1);
    		list($width,$height) = explode('x', $wh);
    		$object = substr($name,0, $pos).'.'.$postfix;
    		//if exist
    		$query = DB::query(Database::SELECT, 'SELECT count(1) as num FROM attachments WHERE attachid = :attachid AND del_flag = 0');
			$query->param(':attachid', $object);
			$result = $query->execute()->get('num');
			if (!$result) {
				header('content-type:image/png');
				$thumbDefault = DOCROOT.'attach'.DIRECTORY_SEPARATOR.'no_file.png';
				echo file_get_contents($thumbDefault);exit;
			}
    		$objectInfo = Helper_Oss::checkObject($object);
    		if($width && $height && $objectInfo && Helper_Oss::generateThumb($object, $width, $height)) {
    			header('content-type:'.$objectInfo->header['content-type']);
    			header('content-length:'.$objectInfo->header['content-length']);
    			header('date:'.$objectInfo->header['date']);
    			header('etag:'.$objectInfo->header['etag']);
    			header('last-modified:'.$objectInfo->header['last-modified']);
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
