<?php defined('SYSPATH') or die('No direct script access.');
// $Id$
/**
 * Kindediter
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package Core
 * @category Controller
 * @version $Id$
 */
class Controller_Admin_Kindediter extends Controller_Admin_Base
{
    /**
     * 存储
     * @var string
     */
    protected $_store = 'kindediter';
    protected $_save_path = '';
    protected $_save_url = '';
    protected $_max_size = 1000000;
    protected $_ext_arr = array(
            'images' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
            'flash' => array('swf', 'flv'),
            'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
            'file' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2'),
        );

    public function __construct(Request $request, Response $response){
        parent::__construct($request, $response);
        $this->_save_path = DOCROOT . 'public' . DIRECTORY_SEPARATOR;
        $this->_save_url = url::base() . 'public/';
    }
    /**
     * 上传
     * @return void
     */
    public function action_upload()
    {
        //文件保存目录路径
        $save_path = $this->_save_path;
        //文件保存目录URL
        $save_url = $this->_save_url;
        //定义允许上传的文件扩展名
        $ext_arr = $this->_ext_arr;
        //最大文件大小
        $max_size = $this->_max_size;
        //检查目录名
        $dir_name = Arr::get($_GET, 'dir', 'file');
        if($dir_name == 'image'){
            $dir_name = 'images';
        }
        $postfixs = $ext_arr[$dir_name];
        $save_path = realpath($save_path) . '/' . $dir_name . '/';
        $save_url = $save_url . $dir_name . '/';
        $type = Arr::get($_GET, 'type', '');
        if(!empty($type)){
            $dir_name .= '/'.$type;
            $save_path .= $type.'/';
            $save_url .= $type.'/';
        }
        
        //有上传文件时
        if (!empty($_FILES['imgFile']) || (Upload::valid($_FILES['imgFile']) AND Upload::not_empty($_FILES['imgFile']))) {
            $upfile = $_FILES['imgFile'];
            if (!empty($upfile['name'])) {
                //获取系统配置可上传的文件大小
                if ($upfile['size'] > $max_size) {
                    $this->_alert(__('The max file size is 1M.'));
                }
                if (!empty($postfixs) AND !Upload::type($upfile, $postfixs)) {
                    $this->_alert(sprintf(__('Upload file type only %s'), implode(',', $postfixs)));
                }
                
                do{
                    $name = uniqid().'.'.pathinfo($upfile['name'], PATHINFO_EXTENSION);
                }while(file_exists($save_path . $name));
                $image = Store::instance($this->_store,$dir_name)->save($upfile['tmp_name'], $name);
                $file_url = $save_url . $image;

                echo json_encode(array('error' => 0, 'url' => $file_url));
                exit;
            }
        }
        $this->_alert(__('Invalid Request'));
    }

    /**
     * 文件列表
     * @return void
     */
    public function action_filemanager()
    {
        //根目录路径，可以指定绝对路径，比如 /var/www/attached/
        $root_path = $this->_save_path;
        //根目录URL，可以指定绝对路径，比如 http://www.yoursite.com/attached/
        $root_url = $this->_save_url;
        //扩展名
        $ext_arr = $this->_ext_arr;
        //目录名
        $dir_name = empty($_GET['dir']) ? 'file' : trim($_GET['dir']);
        if($dir_name == 'image'){
            $dir_name = 'images';
        }
        if (!in_array($dir_name, array('images', 'flash', 'media', 'file'))) {
            echo "Invalid Directory name.";
            exit;
        }
        $ext_arr = $ext_arr[$dir_name];
        
        if ($dir_name !== '') {
            $root_path .= $dir_name . "/";
            $root_url .= $dir_name . "/";
            if (!file_exists($root_path)) {
                mkdir($root_path);
            }
        }

        //根据path参数，设置各路径和URL
        if (empty($_GET['path'])) {
            $current_path = realpath($root_path) . '/';
            $current_url = $root_url;
            $current_dir_path = '';
            $moveup_dir_path = '';
        } else {
            $current_path = realpath($root_path) . '/' . $_GET['path'];
            $current_url = $root_url . $_GET['path'];
            $current_dir_path = $_GET['path'];
            $moveup_dir_path = preg_replace('/(.*?)[^\/]+\/$/', '$1', $current_dir_path);
        }
        //echo realpath($root_path);
        //排序形式，name or size or type
        $order = empty($_GET['order']) ? 'name' : strtolower($_GET['order']);

        //不允许使用..移动到上一级目录
        if (preg_match('/\.\./', $current_path)) {
            echo 'Access is not allowed.';
            exit;
        }
        //最后一个字符不是/
        if (!preg_match('/\/$/', $current_path)) {
            echo 'Parameter is not valid.';
            exit;
        }
        //目录不存在或不是目录
        if (!file_exists($current_path) || !is_dir($current_path)) {
            echo 'Directory does not exist.';
            exit;
        }
        //var_dump($current_path);exit;
        //遍历目录取得文件信息
        $file_list = array();
        if ($handle = opendir($current_path)) {
            $i = 0;
            while (false !== ($filename = readdir($handle))) {
                if ($filename{0} == '.') continue;
                $file = $current_path . $filename;
                if (is_dir($file)) {
                    $file_list[$i]['is_dir'] = true; //是否文件夹
                    $file_list[$i]['has_file'] = (count(scandir($file)) > 2); //文件夹是否包含文件
                    $file_list[$i]['filesize'] = 0; //文件大小
                    $file_list[$i]['is_photo'] = false; //是否图片
                    $file_list[$i]['filetype'] = ''; //文件类别，用扩展名判断
                } else {
                    $file_list[$i]['is_dir'] = false;
                    $file_list[$i]['has_file'] = false;
                    $file_list[$i]['filesize'] = filesize($file);
                    $file_list[$i]['dir_path'] = '';
                    $file_ext = strtolower(array_pop(explode('.', trim($file))));
                    $file_list[$i]['is_photo'] = in_array($file_ext, $ext_arr);
                    $file_list[$i]['filetype'] = $file_ext;
                }
                $file_list[$i]['filename'] = $filename; //文件名，包含扩展名
                $file_list[$i]['datetime'] = date('Y-m-d H:i:s', filemtime($file)); //文件最后修改时间
                $i++;
            }
            closedir($handle);
        }

//        usort($file_list, array(__CLASS__, 'cmp_func'));

        $result = array();
        //相对于根目录的上一级目录
        $result['moveup_dir_path'] = $moveup_dir_path;
        //相对于根目录的当前目录
        $result['current_dir_path'] = $current_dir_path;
        //当前目录的URL
        $result['current_url'] = $current_url;
        //文件数
        $result['total_count'] = count($file_list);
        //文件列表数组
        $result['file_list'] = $file_list;
        //if ($render) {
            //输出JSON字符串
            header('Content-type: application/json; charset=UTF-8');
            exit(json_encode($result));
//        } else {
//            return $result;
//        }

    }

    /**
     * 上传问题返回的错误消息
     *
     * @param string $msg
     * @return void
     */
    private function _alert($msg)
    {
        echo json_encode(array('error' => 1, 'message' => $msg));
        exit;
    }
}
