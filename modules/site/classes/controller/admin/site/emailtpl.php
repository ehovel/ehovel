<?php defined('SYSPATH') OR die('No direct script access allowed.');
/**
 * 站点邮件模板
 *
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package Site
 * @category  Controller  
 * @since 2011-11-25
 * @author dongxiaoyu
 * @version   $Id$
 */

I18n::package('site');
class Controller_Admin_Site_EmailTpl extends Controller_Admin_Base_Site 
{
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
            $this->template = EHOVEL::view('site/emailtpl/index', array(
                'tpls' => EHOVEL::model('Site_EmailTpl')->find_all(),
            ));
        } catch (Kohana_Exception $ex) {
            Remind::factory($ex)
                ->send();
        }
    }
    public function action_edit()
    {
        // 初始化返回结构体
        $return_struct = array(
            'status'  => 0,
            'code'    => 501,
            'msg'     => 'Not Implemented',
            'content' => array(),
        );
        try {
            $tpl = EHOVEL::model('Site_EmailTpl', intval($this->request->query('id')));
            if ($tpl->loaded()) 
            {
                if (!empty($_POST)) 
                {
                    $tpl->title    = trim($this->request->post('title'));
                    $tpl->content  = $this->request->post('content');
                    $tpl->date_upd = date('Y-m-d H:i:s', time());
                    $tpl->save();
                    if ($tpl->saved()) 
                    {
                        Remind::factory ( Remind::TYPE_SUCCESS )
                                ->message ( __ ( 'Edited Successfully!' ) )
                                ->redirect ( EHOVEL::url ( 'site_emailtpl' ) )
                                ->send ();
                    } 
                    else 
                    {
                        Remind::factory ( Remind::TYPE_ERROR )
                                ->message ( $tpl->validation()->errors() )
                                ->redirect ( EHOVEL::url ( 'site_emailtpl/edit',array('id' => $tpl->pk()) ) )
                                ->send ();
                    }
                }

                $this->template = EHOVEL::view('site/emailtpl/form', array(
                    'tpl' => $tpl,
                ));
            } 
            else 
            {
                throw new Kohana_Exception(__('Loading failed, try again'));
            }
        } catch (Kohana_Exception $ex) {
            Remind::factory($ex)
                ->send();
        }
    }
}