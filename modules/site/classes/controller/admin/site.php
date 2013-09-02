<?php
defined ( 'SYSPATH' ) or die ( 'No direct script access.' );
// $Id$
/**
 * 站点管理
 * @copyright Copyright (c) 2012, Ketai inc.
 * @package site
 * @category controller
 * @since 2012-05-23
 * @author fanchongyuan
 * @version $Id$
 */
I18n::package ( 'site' );

class Controller_Admin_Site extends Controller_Admin_Base {

    /**
     * 站点列表
     * @access public
     * @author fanchongyuan
     * @example 
     */
    public function action_index() 
    {
        try {
            $sites = EHOVEL::model('site')->find_all();
            $this->template = EHOVEL::view('site/index', array(
                'sites'       => $sites,
            ));
        } catch ( Kohana_Exception $ex ) {
            Remind::factory($ex)->send();
        }
    }

    /**
     * 站点添加
     * @access public
     * @author fanchongyuan
     * @example 
     */
    public function action_add()
    {
        try {
            if (!empty($_POST)) {
                $site_model = EHOVEL::model('site');
                $site_model->name = $this->request->post('name');
                $site_model->domain = $this->request->post('domain');
                $site_model->language = $this->request->post('language');
                $site_model->active = $this->request->post('active');
                $site_model->is_default = $this->request->post('is_default');
                /* 默认站点处理 */
                if($site_model->is_default == 'Y')
                {
                    $default_sites = $site_model->where('is_default','=','Y')->find_all();
                    foreach($default_sites as $site)
                    {
                        $site->is_default = 'N';
                        $site->save();
                    }
                }
                $site_model->save();
                Remind::factory(Remind::TYPE_SUCCESS)->message(__('Saved successfully!'))->redirect(EHOVEL::url('site/index'))->send();
            }
            $this->template = EHOVEL::view('site/add');
        } catch (Kohana_Exception $ex) {
            Remind::factory($ex)->send();
        } catch (ORM_Validation_Exception $ex) {
            Remind::factory(Remind::TYPE_ERROR)->message($ex->errors())->redirect(EHOVEL::url('site/add'))->send();
        }
    }
    
    /** 
     * 站点编辑
     * @access public
     * @author fanchongyuan
     * @example 
     */
    public function action_edit()
    {
        try {
            $id = $this->request->query('id');
            $site_model = EHOVEL::model('site', $id);
            if (!$site_model->loaded()) {
                Remind::factory(Remind::TYPE_ERROR)->message(__('Invalid Request'))->redirect(EHOVEL::url('site/index'))->send();
            }
            if (!empty($_POST)) {
                $is_default = $site_model->is_default;
                $site_model->name = $this->request->post('name');
                $site_model->domain = $this->request->post('domain');
                $site_model->language = $this->request->post('language');
                $site_model->active = $this->request->post('active');
                $site_model->is_default = $this->request->post('is_default');
                /* 默认站点处理 */
                if($is_default == 'Y' && $site_model->is_default != $is_default)
                {
                    Remind::factory(Remind::TYPE_ERROR)->message(__('Default site can not be edit.'))->redirect(EHOVEL::url('site/index'))->send();
                }
                if($site_model->is_default == 'Y')
                {
                    $default_sites = EHOVEL::model('site')->where('is_default','=','Y')->find_all();
                    foreach($default_sites as $site)
                    {
                        $site->is_default = 'N';
                        $site->save();
                    }
                }
                $site_model->save();
                Remind::factory(Remind::TYPE_SUCCESS)->message(__('Edited successfully!'))->redirect(EHOVEL::url('site/index'))->send();
            }
            $this->template = EHOVEL::view('site/edit', array('site' => $site_model));
        } catch (Kohana_Exception $ex) {
            Remind::factory($ex)->send();
        } catch (ORM_Validation_Exception $ex) {
            Remind::factory(Remind::TYPE_ERROR)->message($ex->errors())->redirect(EHOVEL::url('site/edit').'?id='.$id)->send();
        }
    }

    /**
     * 站点删除
     * @access public
     * @author fanchongyuan
     * @example
     */
    public function action_delete()
    {
        try {
            $id = $this->request->query('id');
            $site_model = EHOVEL::model('site', $id);
            if(!$site_model->loaded()) 
            {
                Remind::factory(Remind::TYPE_ERROR)->message(__('Invalid Request'))->redirect(EHOVEL::url('site/index'))->send();
            }
            if($site_model->is_default == 'Y')
            {
                Remind::factory(Remind::TYPE_ERROR)->message(__('Default site can not be delete.'))->redirect(EHOVEL::url('site/index'))->send();
            }
            $site_model->disable();
            Remind::factory(Remind::TYPE_SUCCESS)->message(__('Deleted successfully!'))->redirect(EHOVEL::url('site/index'))->send();
        } catch (Kohana_Exception $ex) {
            Remind::factory($ex)->send();
        }
    }

    /**
     * 站点切换
     * @access public
     * @author fanchongyuan
     * @example 
     */
    public function action_change()
    {
        try {
            $site_id = $this->request->query('id');
            $g_site_ids = EHOVEL::registry('Global/site_ids');
            if(!empty($site_id) && !empty($g_site_ids) && !in_array($site_id, $g_site_ids))
            {
                Remind::factory(Remind::TYPE_ERROR)
                    ->message(__('Account without permission, please contact the administrator assigned.'))
                    ->redirect(EHOVEL::url('index'))
                    ->send();
            }
            $site_model = EHOVEL::model('site', $site_id);
            if(!$site_model->loaded()) 
            {
                Remind::factory(Remind::TYPE_ERROR)->message(__('Invalid Request'))->redirect($this->request->referrer())->send();
            }
            EHOVEL::app()->set_site($site_id);
            Session::instance()->set('no-cache','1');
            Remind::factory(Remind::TYPE_SUCCESS)->message(__('Change site successfully!'))->redirect($this->request->referrer())->send();
        } catch (Kohana_Exception $ex) {
            Remind::factory($ex)->send();
        }
    }
}
