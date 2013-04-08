<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Support for image manipulation using [Imagick](http://php.net/Imagick).
 *
 * @package    Kohana/Image
 * @category   Drivers
 * @author     Tamas Mihalik tamas.mihalik@gmail.com
 * @copyright  (c) 2009-2012 Kohana Team
 * @license    http://kohanaphp.com/license.html
 */
class Kohana_Uploader_FILESYS extends Uploader {

	/**
	 * 上传文件的主处理方法
	 * @param $base64
	 * @return mixed
	 */
	protected function _do_upFile( $file )
	{
		$this->fullName = $this->getFolder() . '/' . $this->getName();
		if ( $this->stateInfo == $this->stateMap[ 0 ] ) {
			if ( !move_uploaded_file( $file[ "tmp_name" ] , $this->fullName ) ) {
				$this->stateInfo = $this->getStateInfo( "MOVE" );
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
} 