<?php defined('SYSPATH') or die('No Direct Script Access.');
// $Id$
/**
 * 账号模型类
 *
 * @package Auth
 * @category Model
 * @author zhubin
 * @version $Id$
 * @copyright Ketai, 2011
 * @since 2011-11-22
 */
class Model_Auth_Admin extends ORM {

    /**
     * HAS MANY关联
     * 
     * @var array
     */
    protected $_has_many = array(
        'site_relation' => array(
            'model' => 'auth_admin_site_relation',
            'foreign_key' => 'admin_id',
        ),
    );

    /**
     * belongs to关系
     */
    protected $_belongs_to = array(
        'role' => array(
            'model' => 'auth_role',
            'foreign_key' => 'id'
        ),
        'parent' => array(
            'model' => 'auth_admin',
            'foreign_key' => 'pid'
        ),
    );

    /**
     * 当前用户
     */
    private static $_current_user = null;

    /**
     * 取得当前的用户
     * @param string $session_id
     * @return Model_Auth_Admin
     */
    public static function get_current_user($session_id=null)
    {$user = ORM::factory('Admin_auth',1);print_r($user);exit;return $user;
        if(empty(self::$_current_user))
        {
            $session = Session::instance(NULL, $session_id);
            $user = $session->get('EH_admin');
            $secure = $session->get('EH_admin_secure');
            $ip = Tool::get_client_ip();
            if(!empty($user) && $user->loaded())
            {
                $cur_secure = md5($user->id . $user->username . $ip);
                if ($cur_secure == $secure) 
                {
                    self::$_current_user = $user;
                }
            }
        }
        return self::$_current_user;
    }

    /**
     * 管理员登录
     * @param $username
     * @param $password
     * @return void
     * @throw Exception_BES
     */
    public function login($username, $password, $remember = 0)
    {
        $user = BES::model('Auth_Admin')->where('username', '=', $username)->find();

        if ($user->loaded()) {
            if ($user->password == md5($password)) {
                //更新最后登录时间和最后登录IP
                $ip = Tool::get_client_ip();
                $last_login_date = date('Y-m-d H:i:s', time());
                $user->last_login_ip = $ip;
                $user->last_login_date = $last_login_date;
                $user->save();
                $this->login_set($user, $remember);

                return $user;
            } else {
                throw new Exception_BES(__('User or password error.'));
            }
        } else {
            throw new Exception_BES(__('The user does not exist.'));
        }
    }

    /**
     * 设定指定用户登录状态
     *
     * @param $user
     * @return void
     */
    public function login_set($user, $remember = 0)
    {
        $expiration = 0;
        $expiration = Cookie::get('expiration');
        if ($expiration <= 0) {
            $expiration = 3600 * 24 * 7;
        }

        Cookie::set('uid', ($user->id), $expiration);
        Cookie::set('username', ($user->username), $expiration);
        Cookie::set('adminname', $user->username, $expiration);
        Cookie::set('expiration', $expiration, $expiration);
        Cookie::set('remember', $remember, $expiration);
        $ip = Tool::get_client_ip();
        $session = Session::instance();
        $session->set('BES_admin', $user);
        $session->set('BES_admin_secure', md5($user->id . $user->username . $ip));
    }

    /**
     * 管理员登出
     *
     * @return void
     */
    public function logout()
    {
        Cookie::delete('uid');
        $session = Session::instance();
        $session->delete('BES_admin');
        $session->delete('BES_admin_secure');
        return true;
    }

    public function get_site_ids()
    {
        $site_ids = array();
        if($this->loaded())
        {
            $sites = $this->site_relation->find_all();
            foreach($sites as $site)
            {
                $site_ids[] = $site->site_id;
            }
        } else {
            $site_ids = BES::registry('Global/site_ids');
        }
        return $site_ids;
    }

    public function get_sites()
    {
        $sites = NULL;
        if($this->loaded())
        {
            $admin_site_ids = $this->get_site_ids();
            if(!empty($admin_site_ids))
            {
                $sites = BES::model('site')->where('id','in',$admin_site_ids)->where('active','=','Y')->find_all();
            } else {
                $sites = BES::model('site')->where('active','=','Y')->find_all();
            }
        } else {
            $sites = BES::registry('Global/sites');
        }
        return $sites;
    }

    /** 
     * 检查管理员对当前站点的权限
     * @access public
     * @author fanchongyuan
     * @example 
     */
    public function check_site()
    {
        //当前站点全局数据
        $site_id = BES::get_site();
        $g_site = BES::model('site',$site_id);
        if($g_site->loaded())
        {
            BES::register('Global/site', $g_site);
        }

        //当前用户可管理站点全局数据
        $admin_site_ids = $this->get_site_ids();
        BES::register('Global/site_ids', $admin_site_ids);
        
        $g_sites = $this->get_sites();
        BES::register('Global/sites', $g_sites);

        //当前栏目全局数据
        $column_id = BES::get_column();
        $g_column = BES::model('column',$column_id);
        if($g_column->loaded())
        {
            BES::register('Global/column', $g_column);
        }

        //所有栏目全局数据
        $g_columns = BES::model('column')->find_all();
        BES::register('Global/columns', $g_columns);

        //验证当前站点是否在可管理站点中
        if(!empty($site_id) && !empty($admin_site_ids) && !in_array($site_id, $admin_site_ids))
        {
            BES::app()->clear_site();
            return FALSE;
        }
        return TRUE;
    }

    /** 
     * 检查管理员对指定站点的权限
     * @access public
     * @param array|int  $site
     * @return bool
     * @author fanchongyuan
     * @example 
     */
    public function check_site_ids($site = array())
    {
        $admin_site_ids = $this->get_site_ids();
        if(!empty($admin_site_ids))
        {
            if(is_array($site))
            {
                foreach($site as $site_id)
                {
                    if(!in_array($site_id, $admin_site_ids))
                    {
                        return FALSE;
                    }
                }
            } else {
                $site_id = intval($site);
                if(!in_array($site_id, $admin_site_ids))
                {
                    return FALSE;
                }
            }
        }
        return TRUE;
    }
}
