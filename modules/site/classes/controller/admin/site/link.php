<?php defined('SYSPATH') or die('No direct script access.');
/**
 * 站点友情链接控制器
 *
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package Site
 * @category  Controller  
 * @since 2011-11-25
 * @author dongxiaoyu
 * @version   $Id$
 */
I18n::package('site');
class Controller_Admin_Site_Link extends Controller_Admin_Base_Site
{
    /**
     * 当前控制器对应的主模型(表名)
     * @var string
     */
    protected $_model = 'Site_Link';
    /**
     * 存储
     * @var string
     */
    protected $_store = 'site_link';

    /**
     * 列表
     * @return void
     */
    public function action_index()
    {
        // 初始化返回结构体
        $return_struct = array(
            'status' => 0,
            'code' => 501,
            'msg' => 'Not Implemented',
            'content' => array(),
        );
        try {
            $items = EHOVEL::model($this->_model)
                    ->order_by('id', 'DESC')
                    ->find_all();
            $this->template = EHOVEL::view('site/link/index',array('items' => $items));
        } catch (Kohana_Exception $ex) {
            Remind::factory($ex)
                ->send();
        }
    }

    /**
     * 添加新权限节点
     * @return void
     */
    public function action_add()
    {
        // 初始化返回结构体
        $return_struct = array(
            'status' => 0,
            'code' => 501,
            'msg' => 'Not Implemented',
            'content' => array(),
        );
        try {
            $link = EHOVEL::model($this->_model);
            if ($_POST) 
            {
                $name = $this->request->post('name');
                $title = $this->request->post('title');
                $href = $this->request->post('href');
                $key = $this->request->post('key');
                $image = trim($this->request->post('image'));
                $position = $this->request->post('position');

                //保存数据
                $link->name = $name;
                $link->title = $title;
                $link->href = $href;
                $link->key = $key;
                $link->image = $image;
                $link->position = $position;
                $link->save($link->validation());
                Remind::factory ( Remind::TYPE_SUCCESS )
                        ->message ( __ ( 'Saved Successfully!' ) )
                        ->redirect ( EHOVEL::url ( 'site_link' ) )
                        ->send ();
            }
            $this->template = EHOVEL::view('site/link/add',array('link' => $link));
        } catch (Kohana_Exception $ex) {
            Remind::factory($ex)
                ->send();
        } catch (ORM_Validation_Exception $e) {
            //数据验证错误处理
            Remind::factory ( Remind::TYPE_ERROR )
                    ->message ( $link->validation()->errors() )
                    ->redirect ( EHOVEL::url ( 'site_link/add' ) )
                    ->send ();
        }
    }

    /**
     * 编辑权限节点
     * @return void
     */
    public function action_edit()
    {
        // 初始化返回结构体
        $return_struct = array(
            'status' => 0,
            'code' => 501,
            'msg' => 'Not Implemented',
            'content' => array(),
        );
        $postfixs = array('jpg', 'jpeg', 'png', 'gif');
        try {
            $id = intval($this->request->query('id'));
            if ($id <= 0) 
            {
                throw new Kohana_Exception(__('Invalid Request'), 10000);
            }

            $link = EHOVEL::model($this->_model, $id);
            if ($link->loaded()) 
            {
                if ($_POST) 
                {
                    $name = $this->request->post('name');
                    $title = $this->request->post('title');
                    $href = $this->request->post('href');
                    $image = trim($this->request->post('image'));
                    $position = $this->request->post('position');

                    //保存数据
                    $link->name = $name;
                    $link->title = $title;
                    $link->href = $href;
                    $link->image = $image;
                    $link->position = $position;
                    $link->save($link->validation());
                    Remind::factory ( Remind::TYPE_SUCCESS )
                            ->message ( __ ( 'Edited Successfully!' ) )
                            ->redirect ( EHOVEL::url ( 'site_link' ) )
                            ->send ();
                }

                $this->template = EHOVEL::view('site/link/edit',array('data' => $link,
                                                              'id' => $id,                
                                                        ));
            } 
            else 
            {
                Remind::factory ( Remind::TYPE_ERROR )
                        ->message ( __ ('Loading failed, try again' ) )
                        ->redirect ( EHOVEL::url ( $this->_model ) )
                        ->send ();
            }
        } catch (Kohana_Exception $ex) {
            Remind::factory($ex)
                ->redirect(EHOVEL::url('site_link/edit' , array('id' => $id)))
                ->send();
        } catch (ORM_Validation_Exception $e) {
            Remind::factory ( Remind::TYPE_ERROR )
                    ->message ( $link->validation()->errors() )
                    ->redirect ( EHOVEL::url ( 'site_link/edit',array('id' => $id) ) )
                    ->send ();
        }
    }

    /**
     * 删除权限
     * @return void
     */
    public function action_delete()
    {
        // 初始化返回结构体
        $return_struct = array(
            'status' => 0,
            'code' => 501,
            'msg' => 'Not Implemented',
            'content' => array(),
        );
        try {
            $id = intval($this->request->query('id'));
            if (empty($id)) 
            {
                throw new Kohana_Exception(__('Invalid Request'), 10000);
            }

            $link = EHOVEL::model($this->_model, intval($id));
            if (!$link->loaded()) 
            {
                Remind::factory ( Remind::TYPE_ERROR )
                        ->message ( __ ('Loading failed, try again' ) )
                        ->redirect ( EHOVEL::url ( $this->_model ) )
                        ->send ();
            } 
            else 
            {
                $link->date_upd = DATE::get();
                $link->save();
                $link->disable();
                Remind::factory ( Remind::TYPE_SUCCESS )
                        ->message ( __ ( 'Deleted Successfully!' ) )
                        ->redirect ( EHOVEL::url ( $this->_model ) )
                        ->send ();
            }
        } catch (Kohana_Exception $ex) {
            Remind::factory($ex)
                ->send();
        }
    }
    /**
     * AJAX判断名称是否重复
     * @return mixed
     */
    public function action_name_exist()
    {
        // 初始化返回结构体
        $return_struct = array(
            'status' => 0,
            'code' => 501,
            'msg' => 'Not Implemented',
            'content' => array(),
        );
        try {
            $name = $this->request->query('name');
            $id = intval($this->request->query('id'));
            if (empty($name)) 
            {
                throw new Kohana_Exception(__('Invalid Request'), 500);
            }

            if ($this->request->is_ajax()) 
            {
                //如果是编辑刚判断重重复不能加本身进行判断
                if ($id > 0) 
                {
                    $result = EHOVEL::model($this->_model, $id)->name_exist($name);
                } 
                else 
                {
                    $result = EHOVEL::model($this->_model)->name_exist($name);
                }
                if ($result) 
                {
                    exit('false');
                } 
                else 
                {
                    exit('true');
                }
            } 
            else 
            {
                throw new Kohana_Exception(__('Request error, try again'), 500);
            }
        } catch (Kohana_Exception $ex) {
            Remind::factory($ex)
                ->send();
        }
    }
}
