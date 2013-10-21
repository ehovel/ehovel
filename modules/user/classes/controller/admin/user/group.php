<?php defined('SYSPATH') or die('No direct script access.');
// $Id$
/**
 * 会员组管理控制器
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package user
 * @category Controller
 * @since 2011-12-06
 * @author fanchongyuan
 * @version $Id$
 */
class Controller_Admin_User_Group extends Controller_Admin_Base_Site
{
    /**
     * 会员组列表
     * @access public
     * @return void
     * @author fanchongyuan
     * @example 
     */
    public function action_index()
    {
        try {
            $groups = BES::model('user_group')->find_all();
            $this->template = BES::view('user/group/index',array('groups' => $groups));
        } catch (Exception_BES $ex) {
            Remind::factory($ex)->send();
        }
    }

    /**
     * 会员组数据增加
     * @access public
     * @return void
     * @throws Exception_BES
     * @author fanchongyuan
     * @example 
     */
    public function action_add()
    {
        try {
            $group_model = BES::model('user_group');
            if (!empty($_POST)) {
                $group_model->name = $this->request->post('name');
                $group_model->name_demo = $group_model->name_demo ? $group_model->name_demo : $this->request->post('name');
                $group_model->score = $this->request->post('score');
                $group_model->is_default = $this->request->post('is_default');
                $group_model->is_special = $this->request->post('is_special');
                if('' == $this->request->post('active')){
                    $group_model->active = 'Y';
                }else{
                    $group_model->active = $this->request->post('active');
                }
                /* 判断会员组名称重复 */
                $result = $group_model->where('name','=',$group_model->name)->count_all();
                if($result)
                {
                    throw new Exception_BES(__('The name already exists, please rewrite!'));
                }
                /* 判断积分 */
                if($group_model->is_special == 'N')
                {
                    $result = BES::model('user_group')->where('score','=',$group_model->score)->and_where('is_special','=','N')->count_all();
                    if($result)
                    {
                        throw new Exception_BES(__('The score already exists, please rewrite!'));
                    }
                } else {
                    $group_model->score = 0;
                }
                /* 默认会员组不能禁用 */
                if($group_model->is_default == 'Y' && $group_model->active == 'N')
                {
                    Remind::factory(Remind::TYPE_ERROR)->message(__('The default grade cannot be disabled!'))->redirect(BES::url('user_group/add'))->send();
                }
                /* 默认会员组数据处理 */
                $default_groups = $group_model->where('is_default','=','Y')->find_all();
                if($group_model->is_default == 'Y' && !empty($default_groups))
                {
                    foreach($default_groups as $group)
                    {
                        $group->is_default = 'N';
                        $group->save();
                    }
                }
                $group_model->save();
                Remind::factory(Remind::TYPE_SUCCESS)->message(__('Saved successfully!'))->redirect(BES::url('user_group/index'))->send();
            }
            $this->template = BES::view('user/group/add');
        } catch (Exception_BES $ex) {
            Remind::factory($ex)->send();
        } catch (ORM_Validation_Exception $e) {
            Remind::factory($e)->message($group_model->validation()->errors())->redirect(BES::url('user_group/index'))->send();
        }
    }

    /**
     * 会员组编辑
     * @access public
     * @return void
     * @throws Exception_BES
     * @author fanchongyuan
     * @example 
     */
    public function action_edit()
    {
        try {
            $id = $this->request->query('id');
            $group_model = BES::model('user_group',$id);
            if(!$group_model->loaded())
            {
                Remind::factory(Remind::TYPE_ERROR)->message(__('Invalid Request'))->redirect(BES::url('user_group/index'))->send();
            }
            if (!empty($_POST)) {
                $old_name = $group_model->name;
                $old_score = $group_model->score;
                $group_model->name = $this->request->post('name');
                $group_model->name_demo = $group_model->name_demo ? $group_model->name_demo : $this->request->post('name');
                $group_model->score = $this->request->post('score');
                $group_model->discount = $this->request->post('discount');
                $is_default_old = $group_model->is_default;
                $group_model->is_default = $this->request->post('is_default');
                $group_model->is_special = $this->request->post('is_special');
                if('' == $this->request->post('active')){
                    $group_model->active = 'Y';
                }else{
                    $group_model->active = $this->request->post('active');
                }
                /* 判断会员组名称重复 */
                if($group_model->name != $old_name)
                {
                    $result = $group_model->where('name','=',$group_model->name)->count_all();
                    if($result)
                    {
                        throw new Exception_BES(__('Name is exist.'));
                    }
                }
                /* 判断积分 */
                if($group_model->is_special == 'N')
                {
                    if($group_model->score != $old_score)
                    {
                        $result = BES::model('user_group')->where('score','=',$group_model->score)->count_all();
                        if($result)
                        {
                            throw new Exception_BES(__('The score already exists, please rewrite!'));
                        }
                    }
                } else {
                    $group_model->score = 0;
                }
                /* 默认会员组不能禁用 */
                if($group_model->is_default == 'Y' && $group_model->active == 'N')
                {
                    Remind::factory(Remind::TYPE_ERROR)->message(__('The default grade cannot be disabled!'))->redirect(BES::url('user_group/edit').'?id='.$id)->send();
                }
                /* 默认会员组数据处理 */
                if($is_default_old != $group_model->is_default)
                {
                    $default_groups = BES::model('user_group')->where('is_default','=','Y')->find_all();
                    if($group_model->is_default == 'N' && count($default_groups) <= 1)
                    {
                        Remind::factory(Remind::TYPE_ERROR)->message(__('The default grade cannot be disabled!'))->redirect(BES::url('user_group/edit').'?id='.$id)->send();
                    }
                    if($group_model->is_default == 'Y' && !empty($default_groups))
                    {
                        foreach($default_groups as $group)
                        {
                            $group->is_default = 'N';
                            $group->save();
                        }
                    }
                }
                $group_model->save();
                Remind::factory(Remind::TYPE_SUCCESS)->message(__('Edited successfully!'))->redirect(BES::url('user_group/index'))->send();
            }
            $this->template = BES::view('user/group/edit',array('group' => $group_model));
        } catch (Exception_BES $ex) {
            Remind::factory($ex)->send();
        } catch (ORM_Validation_Exception $e) {
            Remind::factory($e)->message($group_model->validation()->errors())->redirect(BES::url('user_group/edit').'?id='.$id)->send();
        }
    }

    /**
     * 会员组删除
     * @access public
     * @return void
     * @throws Exception_Kapp
     * @author fanchongyuan
     * @example 
     */
    public function action_delete()
    {
        try {
            $id = $this->request->query('id');
            $group_model = BES::model('user_group',$id);
            if(!$group_model->loaded())
            {
                Remind::factory(Remind::TYPE_ERROR)->message(__('Invalid Request'))->redirect(BES::url('user_group/index'))->send();
            }
            $users = BES::model('user')->where('group_id','=',$group_model->id)->count_all();
            if(!empty($users))
            {
                Remind::factory(Remind::TYPE_ERROR)->message(__('This group has member,can\'t be deleted.'))->redirect(BES::url('user_group/index'))->send();
            }
            if($group_model->is_default == 'Y')
            {
                Remind::factory(Remind::TYPE_ERROR)->message(__('The default grade cannot be deleted!'))->redirect(BES::url('user_group/index'))->send();
            }
            $disabled = $group_model->disable();
            Remind::factory(Remind::TYPE_SUCCESS)->message(__('Deleted successfully!'))->redirect(BES::url('user_group/index'))->send();
            
        } catch (Exception_BES $ex) {
            Remind::factory($ex)->redirect(BES::url('user_group/index'))->send();
        } 
    }

    public function action_check()
    {
        try {
            $key = $this->request->query('key');
            $group_model = BES::model('user_group');
            switch($key)
            {
                case 'name':
                    header("Content-Language: charset=utf-8");
                    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
                    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
                    header("Cache-Control: no-cache, must-revalidate");
                    header("Pragma: no-cache");
                    $val = urldecode($this->request->query('name'));
                    $old_val = urldecode($this->request->query('old_name'));
                    if($val != $old_val)
                    {
                        $result = $group_model->where('name','=',$val)->count_all();
                        if(!empty($result))
                        {
                            exit('false');
                        } else {
                            exit('true');
                        }
                    } else {
                        exit('true');
                    }
                    break;
            }
        } catch (Exception_BES $ex) {
            Remind::factory($ex)->send();
        }
    }
}
