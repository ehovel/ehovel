<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * 配合ueditor的图片/文件上传类
 * 默认上传文件到ALIOSS,可选上传到文件系统
 */
abstract class Kohana_Uploader extends Kohana_Upload {
	
	protected $fileField;            //文件域名
	protected $file;                 //文件上传对象
	protected $config;               //配置信息
	protected $oriName;              //原始文件名
	protected $fileName;             //新文件名
	protected $fullName;             //完整文件名,即从当前配置目录开始的URL
	protected $fileSize;             //文件大小
	protected $fileType;             //文件类型
	protected $stateInfo;            //上传状态信息,
	protected $url; //图片上传后的地址
	protected $stateMap = array(    //上传状态映射表，国际化用户需考虑此处数据的国际化
			"SUCCESS" ,                //上传成功标记，在UEditor中内不可改变，否则flash判断会出错
			"文件大小超出 upload_max_filesize 限制" ,
			"文件大小超出 MAX_FILE_SIZE 限制" ,
			"文件未被完整上传" ,
			"没有文件被上传" ,
			"上传文件为空" ,
			"POST" => "文件大小超出 post_max_size 限制" ,
			"SIZE" => "文件大小超出网站限制" ,
			"TYPE" => "不允许的文件类型" ,
			"DIR" => "目录创建失败" ,
			"IO" => "输入输出错误" ,
			"UNKNOWN" => "未知错误" ,
			"MOVE" => "文件保存时出错"
	);
	public static $default_driver = 'ALIOSS'; //ALIOSS OR FILESYS
	
	public static function factory($file , $config , $base64 = false, $driver = NULL)
	{
		if ($driver === NULL)
		{
			// Use the default driver
			$driver = Uploader::$default_driver;
		}
	
		// Set the class name
		$class = 'Kohana_Uploader_'.$driver;
	
		return new $class($file , $config , $base64 = false);
	}
	/**
	 * 构造函数
	 * @param string $fileField 表单名称
	 * @param array $config  配置项
	 * @param bool $base64  是否解析base64编码，可省略。若开启，则$fileField代表的是base64编码的字符串表单名
	*/
	public function __construct( $fileField , $config , $base64 = false )
	{
		$this->fileField = $fileField;
		$this->config = $config;
		$this->stateInfo = $this->stateMap[ 0 ];
		$this->_upFile( $base64 );
	}
	
	protected function _upFile($base64){
		//处理base64上传
		if ( "base64" == $base64 ) {
			$content = $_POST[ $this->fileField ];
			$this->base64ToImage( $content );
			return;
		}
	
		//处理普通上传
		$file = $this->file = $_FILES[ $this->fileField ];
		if ( !$file ) {
			$this->stateInfo = $this->getStateInfo( 'POST' );
			return;
		}
		if ( $this->file[ 'error' ] ) {
			$this->stateInfo = $this->getStateInfo( $file[ 'error' ] );
			return;
		}
		if ( !is_uploaded_file( $file[ 'tmp_name' ] ) ) {
			$this->stateInfo = $this->getStateInfo( "UNKNOWN" );
			return;
		}
	
		$this->oriName = $file[ 'name' ];
		$this->fileSize = $file[ 'size' ];
		$this->fileType = $this->getFileExt();
	
		if ( !$this->checkSize() ) {
			$this->stateInfo = $this->getStateInfo( "SIZE" );
			return;
		}
		if ( !$this->checkType() ) {
			$this->stateInfo = $this->getStateInfo( "TYPE" );
			return;
		}
		$this->_do_upFile($file);
	}
	/**
	 * 上传文件抽象方法
	 */
	abstract protected function _do_upFile($file);
	
	/**
	 * 处理base64编码的图片上传
	 * @param $base64Data
	 * @return mixed
	 */
	private function base64ToImage( $base64Data )
	{
		$img = base64_decode( $base64Data );
		$this->fileName = time() . rand( 1 , 10000 ) . ".png";
		$this->fullName = $this->getFolder() . '/' . $this->fileName;
		if ( !file_put_contents( $this->fullName , $img ) ) {
			$this->stateInfo = $this->getStateInfo( "IO" );
			return;
		}
		$this->oriName = "";
		$this->fileSize = strlen( $img );
		$this->fileType = ".png";
	}
	
	/**
	 * 获取当前上传成功文件的各项信息
	 * @return array
	 */
	public function getFileInfo()
	{
		return array(
				"originalName" => $this->oriName ,
				"name" => $this->fileName ,
				"url" => $this->url,
				"size" => $this->fileSize ,
				"type" => $this->fileType ,
				"state" => $this->stateInfo
		);
	}
	
	/**
	 * 上传错误检查
	 * @param $errCode
	 * @return string
	 */
	protected function getStateInfo( $errCode )
	{
		return !$this->stateMap[ $errCode ] ? $this->stateMap[ "UNKNOWN" ] : $this->stateMap[ $errCode ];
	}
	
	/**
	 * 文件类型检测
	 * @return bool
	 */
	protected function checkType()
	{
		return in_array( $this->getFileExt() , $this->config[ "allowFiles" ] );
	}
	
	/**
	 * 文件大小检测
	 * @return bool
	 */
	protected function  checkSize()
	{
		return $this->fileSize <= ( $this->config[ "maxSize" ] * 1024 );
	}
	
	/**
	 * 获取文件扩展名
	 * @return string
	 */
	protected function getFileExt()
	{
		return strtolower( strrchr( $this->file[ "name" ] , '.' ) );
	}
	
	/**
	 * 按照日期自动创建存储文件夹
	 * @return string
	 */
	protected function getFolder()
	{
		$pathStr = $this->config[ "savePath" ];
		if ( strrchr( $pathStr , "/" ) != "/" ) {
			$pathStr .= "/";
		}
		$pathStr .= date( "Ymd" );
		if ( !file_exists( $pathStr ) ) {
			if ( !mkdir( $pathStr , 0777 , true ) ) {
				return false;
			}
		}
		return $pathStr;
	}
} // End Image
