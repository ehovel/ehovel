<?php defined('SYSPATH') OR die('No direct script access allowed.');

/**
 * 后台文件上传管理
 *
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package Core
 * @category Controller
 * @since 2011-11-30 下午2:38
 * @author wang.hao
 * @version   $Id$
 */
class Controller_Admin_Upload extends Controller_Admin_Base {
    
    /**
     * 文件上传列表页
     */
    public function action_index()
    {
        
    }
    
    /**
     * 提交上传文件
     */
    public function action_submit()
    {
        $return_struct = array(
            'status'  => 0,
            'code'    => 0,
            'msg'     => '',
            'content' => array(),
        );
        try {
            $id       = trim($this->request->query('id'));
            $type     = strtolower(trim($this->request->query('type')));
            $url_size = trim($this->request->query('url_size'));
            $max_size = $this->_get_max_size();
            $postfixs = $this->_get_postfixs();
            $catalog_id = intval($this->request->post('catalog_id'));
            
            if (!empty($_FILES)) {
                $uploads = array();
                $errors  = array();
                foreach ($_FILES as $index => $upload) {
                    if (!is_array($upload) OR $upload['error'] != UPLOAD_ERR_OK) {
                        $errors[$index] = '<font color = "red">'.__('Upload failed').'</font>'; continue;
                    }
                    if (!is_uploaded_file($upload['tmp_name'])) {
                        $errors[$index] = '<font color = "red">'.__('Upload failed').'</font>'; continue;
                    }
                    if ($max_size > 0 AND $upload['size'] > $max_size) {
                        $errors[$index] = '<font color = "red">'.__('File is too big').'</font>'; continue;
                    }
                    $postfix = strtolower(pathinfo($upload['name'], PATHINFO_EXTENSION));
                    if (!empty($postfixs) AND !in_array($postfix, $postfixs)) {
                        $errors[$index] = '<font color = "red">'.__('File format error').'</font>'; continue;
                    }
                    $uploads[] = array(
                        'name'        => $upload['name'],
                        'mime_type'   => File::mime_by_ext($postfix),
                        'extension'   => $postfix,
                        'size'        => $upload['size'],
                        'tmp_name'    => $upload['tmp_name'],
                        'description' => trim($this->request->post('upload_description_' . $id . '_' . substr($index, strrpos($index, '_') + 1))),
                    );
                }
                
                if (empty($errors)) {
                    $subcat = $type . DIRECTORY_SEPARATOR . strtr(date('Y-m-d-H', time()), '-', DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
                    $direct = BES::config('upload.direct');
                    if (!is_dir($direct . $subcat) AND !@mkdir($direct . $subcat, 0777, TRUE)) {
                        throw new Exception_BES(__('Fail to establish upload directory'));
                    }
                    foreach ($uploads as $upload) {
                        $destination = $subcat . uniqid() . '.' . $upload['extension'];
                        $destination = str_replace(DIRECTORY_SEPARATOR, '/', $destination);
                        if (@move_uploaded_file($upload['tmp_name'], $direct . $destination)) {
                            $model = BES::model('Upload');
                            $model->name        = $upload['name'];
                            $model->uri         = $destination;
                            $model->type        = $type;
                            $model->mime_type   = $upload['mime_type'];
                            $model->extension   = $upload['extension'];
                            $model->size        = $upload['size'];
                            $model->description = $upload['description'];
                            $model->catalog_id = $catalog_id;
                            $model->save();
                            if ($model->saved()) {
                                $content = array(
                                    'id'          => $model->pk(),
                                    'name'        => $upload['name'],
                                    'uri'         => $destination,
                                    'url'         => BES::upload_url($destination),
                                    'mime_type'   => $upload['mime_type'],
                                    'extension'   => $upload['extension'],
                                    'size'        => $upload['size'],
                                    'description' => $upload['description'],
                                );
                                if (!empty($url_size)) {
                                    foreach (explode('|', $url_size) as $size) {
                                        $size = trim($size);
                                        if (!empty($size)) {
                                            $content['url_' . $size] = BES::upload_url($destination, $size);
                                        }
                                    }
                                }
                                array_push($return_struct['content'], $content);
                            }
                        }
                    }
                    $return_struct['status'] = 1;
                } else {
                    $return_struct['msg'] = $errors;
                }
            } else {
                throw new Exception_BES(__('Upload failed'));
            }
        } catch (Exception_BES $ex) {
            $return_struct['msg'] = $ex->getMessage();
        }
        
        // 当上传失败时，清理临时文件
        if (isset($uploads) AND $return_struct['status'] == 0) {
            foreach ($uploads as $upload) {
                @unlink($upload['tmp_name']);
            }
        }
        
        echo '<script type="text/javascript">';
        echo 'if(typeof parent.submitUploadResult_' . $id.' == "function"){';
        echo '    parent.submitUploadResult_' . $id . '(' . json_encode($return_struct) . ');';
        echo '}';
        echo 'if(typeof parent.submitUploadResult == "function"){';
        echo '    parent.submitUploadResult('. json_encode($return_struct) . ');';
        echo '}';
        echo '</script>';
    }
    
    /**
     * 获取允许上传的文件扩展名
     * 
     * @return int
     */
    protected function _get_postfixs()
    {
        $postfixs = strtolower(trim($this->request->query('postfixs')));
        if (!empty($postfixs)) {
            return explode('|', $postfixs);
        } else {
            return array();
        }
    }
    
    /**
     * 获取最大上传文件体积
     * 
     * @return int
     */
    protected function _get_max_size()
    {
        $max_size = strtolower(trim($this->request->query('max_size')));
        
        if (!empty($max_size)) {
            switch ($max_size{strlen($max_size) - 1}) {
                case 'm':
                    $max_size = intval($max_size) * 1024 * 1024;
                    break;
                case 'k':
                    $max_size = intval($max_size) * 1024;
                    break;
                default:
                    $max_size = intval($max_size);
            }
        } else {
            $max_size = 0;
        }
        
        return $max_size;
    }
}
