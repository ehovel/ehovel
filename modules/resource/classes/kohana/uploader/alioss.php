<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Support for image manipulation using [GD](http://php.net/GD).
 *
 * @package    Kohana/Image
 * @category   Drivers
 * @author     Kohana Team
 * @copyright  (c) 2008-2009 Kohana Team
 * @license    http://kohanaphp.com/license.html
 */
class Kohana_Uploader_ALIOSS extends Uploader {
	
	/**
	 * 上传文件的主处理方法
	 * @param $base64
	 * @return mixed
	 */
	protected function _do_upFile( $file )
	{
		$bucket = 'publicattach';
		$this->fileName = $this->getName();
		$this->fullName = $bucket.'/'.$this->fileName;
		$ali_oss_server = new ALIOSS();
		$fp = fopen($file["tmp_name"],'r');
		$content = '';$length = 0;
		if($fp)
		{
			$f = fstat($fp);
			$length = $f['size'];
			while(!feof($fp))
			{
				$content .= fgets($fp);
			}
		}
		$upload_file_options = array('content' => $content, 'length' => $length);
		if ( $this->stateInfo == $this->stateMap[ 0 ] ) {
			$upload_file_by_content = $ali_oss_server->upload_file_by_content($bucket,$this->fileName, $upload_file_options);
			if ($upload_file_by_content->status == 200) {
				$this->url = $this->fileName;
			} else {
				$this->stateInfo = "ALIOSS status:".$upload_file_by_content->status;
			}
		}
	}
	
	/**
	 * 重命名文件
	 * @return string
	 */
	private function getName()
	{
		$uuid_sn = substr(date('Y'),2).//2
		date('md').//4
		substr(time(),-2).//2
		substr(microtime(),2,2).//2
		sprintf('%02d',rand(0,99));//2
		return $uuid_sn.$this->getFileExt();
	}
} // End Image_GD
