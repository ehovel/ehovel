<?php defined('SYSPATH') or die('No direct script access.');
// $Id$
/**
 * 会员地址管理控制器
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package user
 * @category Controller
 * @since 2011-12-07
 * @author fanchongyuan
 * @version $Id$
 */
class Controller_Admin_User_Address extends Controller_Admin_Base
{
    /**
     * 添加会员地址
     * @access public
     * @return void
     * @throw Exception_BES
     * @author fanchongyuan
     * @example
     */
    public function action_add()
    {
        try {
            $user_id = $this->request->query('user_id');
            $user_model = BES::model('user', $user_id);
            if (!$user_model->loaded()) {
                Remind::factory(Remind::TYPE_ERROR)->message(__('Invalid Request'))->redirect(BES::url('user/index'))->send();
            }
            
            if ($_POST) {
                $address_model = BES::model('user_address');
                $address_model->s_area_id = $this->request->post('s_area_id');
                $address_model->s_firstname = $this->request->post('s_firstname');
                $address_model->s_lastname = $this->request->post('s_lastname');
                $address_model->s_address = $this->request->post('s_address');
                $address_model->s_address1 = $this->request->post('s_address1');
                $address_model->s_zip = $this->request->post('s_zip');
                $address_model->s_phone = $this->request->post('s_phone');
                $address_model->s_phone1 = $this->request->post('s_phone1');
                $address_model->is_default = $this->request->post('is_default');
                $address_model->s_city = $this->request->post('s_city');
                $address_model->s_state = $this->request->post('s_state');
                $address_model->s_company = $this->request->post('s_company');
                $address_model->s_fax = $this->request->post('s_fax');
                if($user_model->add_address($address_model))
                {
                    Remind::factory(Remind::TYPE_SUCCESS)->message(__('Add address successfully.'))->redirect(BES::url('user/edit').'?id='.$user_id)->send();
                }
            }
            $areas = BES::model('area')->get_areas(1);
            if ($this->request->is_ajax()) 
            {
                $this->template = BES::view('user/address/add', array('user' => $user_model,'areas' => $areas))->render(NULL,false);
            } else {
                $this->template = BES::view('user/address/add', array('user' => $user_model,'areas' => $areas));
            }
        } catch (Exception_BES $ex) {
            Remind::factory($ex)->redirect(BES::url('user/edit').'?id='.$user_id)->send();
        }
    }

    /**
     * 编辑会员地址
     * @access public
     * @return void
     * @throw Exception_BES
     * @author fanchongyuan
     * @example
     */
    public function action_edit()
    {
        try {
            $id = $this->request->query('id');
            $address_model = BES::model('user_address', $id);
            if (!$address_model->loaded()) {
                Remind::factory(Remind::TYPE_ERROR)->message(__('Invalid Request'))->redirect(BES::url('user/index'))->send();
            }
            $user_model = BES::model('user',$address_model->user_id);
            if(!$user_model->loaded())
            {
                Remind::factory(Remind::TYPE_ERROR)->message(__('Invalid Request'))->redirect(BES::url('user/index'))->send();
            }
            if ($_POST) {
                /* 收货地址 */
                $address_model->s_firstname = $this->request->post('s_firstname');
                $address_model->s_lastname = $this->request->post('s_lastname');
                $address_model->s_address = $this->request->post('s_address');
                $address_model->s_address1 = $this->request->post('s_address1');
                $address_model->s_zip = $this->request->post('s_zip');
                $address_model->s_phone = $this->request->post('s_phone');
                $address_model->s_phone1 = $this->request->post('s_phone1');
                $address_model->s_area_id = $this->request->post('s_area_id');
                $address_model->s_city = $this->request->post('s_city');
                $address_model->s_state = $this->request->post('s_state');
                $address_model->s_company = $this->request->post('s_company');
                $address_model->s_fax = $this->request->post('s_fax');
                $address_model->is_default = $this->request->post('is_default');
                $user_model->edit_address($address_model);
                Remind::factory(Remind::TYPE_SUCCESS)->message(__('Edited successfully!'))->redirect(BES::url('user/edit').'?id='.$address_model->user_id)->send();
            }
            $areas = BES::model('area')->get_areas(1);
            if ($this->request->is_ajax()) {
                $this->template = BES::view('user/address/edit', array('address' => $address_model,'areas' => $areas))->render(NULL,false);
            } else {
                $this->template = BES::view('user/address/edit', array('address' => $address_model,'areas' => $areas));
            }
        } catch (Exception_BES $ex) {
            Remind::factory($ex)->redirect(BES::url('user/edit').'?id='.$address_model->user_id)->send();
        }
    }

    /**
     * 删除会员地址
     * @access public
     * @return json
     * @throw Exception_BES
     * @author fanchongyuan
     * @example
     */
    public function action_delete()
    {
        try {
            $id = $this->request->query('id');
            $address_model = BES::model('user_address', $id);
            if (!$address_model->loaded()) {
                throw new Exception_BES(__('Invalid Request'));
            }
            $user_id = $address_model->user_id;
            if ($address_model->is_default == 'Y') {
                Remind::factory(Remind::TYPE_ERROR)->message(__('can not delete default address'))->redirect(BES::url('user/edit'.'?id='.$user_id))->send();
            } else {
                $address_model->delete();
                Remind::factory(Remind::TYPE_SUCCESS)->message(__('Deleted successfully!'))->redirect(BES::url('user/edit'.'?id='.$user_id))->send();
            }
        } catch (Exception_BES $ex) {
            Remind::factory($ex)->send();
        }
    }

}
