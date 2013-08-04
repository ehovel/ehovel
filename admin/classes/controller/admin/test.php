<?php defined('SYSPATH') or die('No direct script access.');
// $Id$
/**
 * 测试控制器
 * @copyright Copyright (c) 2012, Ketai inc.
 * @package admin
 * @category Controller
 * @since 2012-06-04
 * @author fanchongyuan
 * @version $Id$
 */
class Controller_Admin_Test extends Controller_Admin_Base
{
    /**
     * 主面板页面
     * @return void
     */
    public function action_index ()
    {
        try{
            $model = BES::model('test')->root();
            if($model->loaded())
            {
                $childrens = $model->descendants();
                foreach($childrens as $val)
                {
                    echo  str_repeat('...',($val->lvl-1)).$val->name.'<br>';
                }
            }
        }catch(Exception_BES $ex){
            print_r($ex->getMessage());exit;
        }
    }
    
    public function action_add()
    {
        $pid = $this->request->query('pid');
        if(empty($pid))
        {
            $model = BES::model('test')->root();
            if(!$model->loaded())
            {
                $root = BES::model('test');
                $root->insert_as_new_root();
                $pid = $root->pk();
            } else {
                $pid = $model->pk();
            }
        }
        $parent = BES::model('test',$pid);
        if(!$parent->loaded())
        {
            throw new Exception_BES(__('Parent error'));
        }
        $add = BES::model('test');
        $add->name = 'test1';
        $add->insert_as_last_child($parent);
    }
    
    public function action_log(){
    	print_r($this->request->user_agent(array('browser', 'version', 'robot', 'mobile', 'platform')));echo '<br>';
    	echo $uri = $this->request->uri();echo '<br>';
    	echo $action = $this->request->controller();echo '<br>';
    	echo $action = $this->request->action();echo '<br>';
    	echo $method = $this->request->method();echo '<br>';
    	echo $ip = $this->request->ip_address();echo '<br>';
    	echo $date = date('Y-m-d H:i:s');echo '<br>';
    }
    
    public function action_aliupload() {
        if ($_FILES) {
            $res = Uploader::factory("upload");
            print_r($res->getFileInfo());exit;
        }
        echo '<form action="/admin/test/aliupload" method="post" enctype="multipart/form-data"><input type="file" name="upload" /><input type="submit" /></form>';
    }
}
