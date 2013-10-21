<?php defined('SYSPATH') or die('No direct script access.');
// $Id$
/**
 * 会员管理控制器
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package user
 * @category Controller
 * @since 2011-12-06
 * @author fanchongyuan
 * @version $Id$
 */
class Controller_Admin_User extends Controller_Admin_Base_Site
{
    /**
     * 会员列表
     * @access public
     * @return void
     * @author fanchongyuan
     * @example
     */
    public function action_index()
    {
        try {
            if ($this->request->is_ajax()) {
                $search = $this->request->query("_search");
                $user_model = BES::model('user');
                if ($search) {
                    //对用户组搜索，暂时将其转化为其用户组名称对应的group_id，再通过group_id机型搜索
                    $group_name = $this->request->query('group_name');
                    if (!empty($group_name)) {
                        $user_model->where('group_id', '=', $group_name);
                    }
                    $email = $this->request->query('email');
                    if (!empty($email)) {
                        $user_model->where('email', 'like', '%' . $email . '%');
                    }
                    $score = $this->request->query('score');
                    if (!empty($score)) {
                        $user_model->where('score', '=', $score);
                    }
                    $date_add = $this->request->query('date_add');
                    if (!empty($date_add)) {
                        $user_model->where('date_add', 'BETWEEN', BES::helper('tool')->make_one_day_array($date_add));
                    }
                    $lastlogin = $this->request->query('lastlogin');
                    if (!empty($lastlogin)) {
                        $user_model->where('lastlogin', 'BETWEEN', BES::helper('tool')->make_one_day_array($lastlogin));
                    }
                	$lastlogin_ip = $this->request->query('lastlogin_ip');
                    if (!empty($lastlogin_ip)) {
                        $user_model->where('lastlogin_ip', 'like',  '%' . $lastlogin_ip . '%');
                    }
                    $active = $this->request->query('active');
                    if (!empty($active)) {
                        $user_model->where('active', '=', $active);
                    }
                }
                $grid = Grid::factory($user_model);
                exit($grid->to_json(array('group')));
            } else {
                $this->template = BES::view('user/index');
            }
        } catch (Exception_BES $ex) {
            Remind::factory($ex)->send();
        }
    }

    /**
     * 会员数据增加
     * @access public
     * @return void
     * @throw Exception_BES
     * @author fanchongyuan
     * @example
     */
    public function action_add()
    {
        try {
            $user_model = BES::model('user');
            if (!empty($_POST)) {
                $user_model->group_id = $this->request->post('group');
                $user_model->email = $this->request->post('email');
                $user_model->password = md5($this->request->post('password'));
                $user_model->score = $this->request->post('score');
                $user_model->status = $this->request->post('status');
                $user_model->ip = $this->request->ip_address();
                $user_model->active = $this->request->post('active');
                $user_model->firstname = $this->request->post('firstname');
                $user_model->lastname = $this->request->post('lastname');
                $user_model->sex = $this->request->post('sex');
                $user_model->company_name = $this->request->post('company_name');
                $user_model->company_address = $this->request->post('company_address');
                $user_model->company_phone = $this->request->post('company_phone');
                $user_model->contact_person = $this->request->post('contact_person');
                $user_model->certificate_image = $this->request->post('certificate_image');
                $validation = $user_model->validation();
                $validation->rules('sex',array(array('not_empty'),array('min_length', array(':value', 1)),array('max_length', array(':value', 50))));
                $validation->rules('firstname',array(array('not_empty'),array('min_length', array(':value', 1)),array('max_length', array(':value', 50))));
                $validation->rules('lastname',array(array('not_empty'),array('min_length', array(':value', 1)),array('max_length', array(':value', 50))));
                if (!$user_model->check_email($user_model->email)) {
                    throw new Exception_BES(__('The email already exists, please rewrite!'));
                }
                if($validation->check())
                {
                    $user_model->save();
                    Remind::factory(Remind::TYPE_SUCCESS)->message(__('Saved successfully!'))->redirect(BES::url('user/index'))->send();
                } else {
                    Remind::factory(Remind::TYPE_ERROR)->message($validation->errors())->redirect(BES::url('user/add'))->send();
                }
            }
            /* 获取会员组数据 */
            $groups = BES::model('user_group')
                ->where('active', '=', 'Y')
                ->find_all();

            $this->template = BES::view('user/add', array('groups' => $groups));
        } catch (Exception_BES $ex) {
            Remind::factory($ex)->send();
        } catch (ORM_Validation_Exception $e) {
            Remind::factory($e)->message($user_model->validation()->errors())->redirect(BES::url('user/add'))->send();
        }
    }

    /**
     * 会员数据编辑
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
            $user_model = BES::model('user', $id);
            if (!$user_model->loaded()) {
                Remind::factory(Remind::TYPE_ERROR)->message(__('Invalid Request'))->redirect(BES::url('user/index'))->send();
            }
            if (!empty($_POST)) {
                $old_email = $user_model->email;
                $user_model->group_id = $this->request->post('group');
                $user_model->email = $this->request->post('email');
                $user_model->status = $this->request->post('status');
                $user_model->active = $this->request->post('active');
                $user_model->sex = $this->request->post('sex');
                $user_model->firstname = $this->request->post('firstname');
                $user_model->lastname = $this->request->post('lastname');
                $user_model->company_name = $this->request->post('company_name');
                $user_model->company_address = $this->request->post('company_address');
                $user_model->company_phone = $this->request->post('company_phone');
                $user_model->contact_person = $this->request->post('contact_person');
                $user_model->certificate_image = $this->request->post('certificate_image');
                $validation = $user_model->validation();
                $validation->rules('sex',array(array('not_empty'),array('min_length', array(':value', 1)),array('max_length', array(':value', 50))));
                $validation->rules('firstname',array(array('not_empty'),array('min_length', array(':value', 1)),array('max_length', array(':value', 50))));
                $validation->rules('lastname',array(array('not_empty'),array('min_length', array(':value', 1)),array('max_length', array(':value', 50))));
                $password = trim($this->request->post('password'));
                /* 修改密码 */
                if (!empty($password)) {
                    $user_model->password = md5($password);
                }
                if ($old_email != $user_model->email && !$user_model->check_email($user_model->email)) {
                    throw new Exception_BES(__('The email already exists, please rewrite'));
                }
                if($validation->check())
                {
                    $user_model->save();
                    Remind::factory(Remind::TYPE_SUCCESS)->message(__('Edited successfully!'))->redirect(BES::url('user/index'))->send();
                } else {
                    Remind::factory(Remind::TYPE_ERROR)->message($validation->errors())->redirect(BES::url('user/edit').'?id='.$id)->send();
                }
            }
            /* 获取会员组数据 */
            $groups = BES::model('user_group')
                ->where('active', '=', 'Y')
                ->find_all();
            /* 获取当前会员地址数据 */
            $addresses = $user_model->address->order_by('id', 'DESC')->find_all();

            $this->template = BES::view('user/edit', array('user' => $user_model, 'groups' => $groups, 'addresses' => $addresses));
        } catch (Exception_BES $ex) {
            Remind::factory($ex)->send();
        } catch (ORM_Validation_Exception $e) {
            Remind::factory(Remind::TYPE_ERROR)->message($user_model->validation()->errors())->redirect(BES::url('user/edit').'?id='.$id)->send();
        }
    }

    /**
     * 会员删除
     * @access public
     * @return void
     * @throw Exception_BES
     * @author fanchongyuan
     * @example
     */
    public function action_delete()
    {
        try {
            $id = $this->request->query('id');
            $user_model = BES::model('user', $id);
            if (!$user_model->loaded()) {
                Remind::factory(Remind::TYPE_ERROR)->message(__('Invalid Request'))->redirect(BES::url('user/index'))->send();
            }
            $user_model->disable();
            Remind::factory(Remind::TYPE_SUCCESS)->message(__('Deleted successfully!'))->redirect(BES::url('user/index'))->send();
        } catch (Exception_BES $ex) {
            Remind::factory($ex)->send();
        }
    }

    /**
     * 会员批量删除
     * @access public
     * @return void
     * @throw Exception_BES
     * @author fanchongyuan
     * @example
     */
    public function action_batch_delete()
    {
        try {
            $oper = $this->request->post('oper');
            $id = $this->request->post('id');
            if ($oper != 'del') {
                throw new Exception_BES(__('Invalid Request'));
            }
            $ids = explode(',', $id);
            if (!empty($ids)) {
                foreach ($ids as $id)
                {
                    $user_model = BES::model('user', $id);
                    if (!$user_model->loaded()) {
                        throw new Exception_BES(__('Invalid Request'));
                    }
                    $disabled = $user_model->disable();
                    if (!$disabled) {
                        throw new Exception_BES(__('#:id delete failed.', array(':id' => $user_model->id)));
                    }
                }
            } else {
                throw new Exception_BES(__('Invalid Request'));
            }
        } catch (Exception_BES $ex) {
            exit($ex->getMessage);
        }
    }

    /**
     * ajax检查数据接口
     * @access public
     * @return void
     * @author fanchongyuan
     * @example 
     */
    public function action_check()
    {
        try {
            $key = $this->request->query('key');
            $user_model = BES::model('user');
            switch ($key)
            {
            case 'email':
                $val = $this->request->query('email');
                $old_val = $this->request->query('old_email');
                if ($val != $old_val && !$user_model->check_email($val)) {
                    exit('false');
                } else {
                    exit('true');
                }
                break;
            }
        } catch (Exception_BES $ex) {
            Remind::factory($ex)->send();
        }
    }

    /**
     * 会员导出功能
     * @access public
     * @return void
     * @throw Exception_BES
     * @author fanchongyuan
     * @example
     */
    public function action_do_export()
    {
        try {
            $user_ids = $this->request->query('user_ids');
            $export_field = array(
                'email',
                'group_name',
                'score',
                'status',
                'lastlogin',
                'date_add',
                'ip',
                'active');

            if (empty($user_ids)) {
                throw new Exception_BES(__('Please select the member first!'));
            }

            $output = iconv('UTF-8', 'gb2312//TRANSLIT', __('Email')). " ,";
            $output .= iconv('UTF-8', 'gb2312//TRANSLIT', __('Member Grade')) . " ,";
            $output .= iconv('UTF-8', 'gb2312//TRANSLIT', __('score')) . " ,";
            $output .= iconv('UTF-8', 'gb2312//TRANSLIT', __('status')) . " ,";
            $output .= iconv('UTF-8', 'gb2312//TRANSLIT', __('Last Login Time')) . " ,";
            $output .= iconv('UTF-8', 'gb2312//TRANSLIT', __('Adding Time')) . " ,";
            $output .= iconv('UTF-8', 'gb2312//TRANSLIT', __('ip')) . " ,";
            $output .= iconv('UTF-8', 'gb2312//TRANSLIT', __('Activate or not')) . "\r\n";
            $user_ids = explode(',', $user_ids);
            foreach ($user_ids as $user_id) {
                $user = BES::model('user', $user_id);
                if ($user->loaded()) {
                    $data = $user->as_array();
                    $data['group_name'] = $user->group->name;
                    foreach ($export_field as $field)
                    {
                        if (isset($data[$field])) {
                            $value = @iconv('UTF-8', 'gb2312//TRANSLIT', $data[$field]);
                            $output .= $value . " ,";
                        }
                    }
                    $output .= "\r\n";
                }
            }
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Content-Type: application/force-download");
            header("Content-Type: application/octet-stream");
            header("Content-Type: application/download");
            header("Content-Disposition: attachment;filename=user_list.csv");
            header("Content-Transfer-Encoding: binary ");
            header("Charset=UTF-8");
            echo $output;
            exit;

        } catch (Exception_BES $ex) {
            Remind::factory($ex)->send();
        }

    }

    /**
     * 获取会员等级的检索列表
     * @return string
     */
    public function action_group_search_data()
    {
        try {
            $content = array();
            $groups = BES::model('user_group')->find_all();
            if ($groups) {
                foreach ($groups as $key => $item) {
                    $content[] = array(
                        'key' => $item->id,
                        'name' => $item->name
                    );
                }
            }
            if ($this->request->is_ajax()) {
                $return_struct['status'] = 1;
                $return_struct['code'] = 200;
                $return_struct['content'] = $content;
                exit(json_encode($return_struct));
            } else {
                throw new Exception_BES(__('Invalid Request'));
            }
        }
        catch (Exception_BES $ex) {
            Remind::factory($ex)->send();
        }
    }

    /**
     * 获取激活状态的检索列表
     * @return string
     */
    public function action_get_search_data()
    {
        try {
            $type = $this->request->query('type');
            $content = array();
            switch ($type) {
            case 'user_active':
                $active_status = BES::config('user.active_status');
                if(!empty($active_status))
                {
                    foreach ($active_status as $key => $value) {
                        $content[] = array(
                            'key' => $key,
                            'name' => $value
                        );
                    }
                }
                break;
            default:
                return;
            }
            $return_struct['status'] = 1;
            $return_struct['code'] = 200;
            $return_struct['content'] = $content;
            exit(json_encode($return_struct));
        }
        catch (Exception_BES $ex) {
            Remind::factory($ex)->send();
        }
    }
}
