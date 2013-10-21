<?php defined('SYSPATH') OR die('No direct script access allowed.');
// $Id$
/**
 * 会员模型
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package user
 * @category Model
 * @since 2011-12-05
 * @author fanchongyuan
 * @version $Id$
 */
class Model_User extends ORM
{
    protected $_belongs_to = array(
        'group' => array(
            'model'=>'User_Group',
            'foreign_key'=>'group_id',
        )
    );
    protected $_has_many = array(
        'comment' => array(
            'model' => 'Product_Comment',
        ),
        'address' => array(
            'model' => 'User_Address',
        ),
        'wishlist' => array(
            'model' => 'User_Wishlist',
        ),
        'order'=>array(
            'model' => 'Order',
        ),
        'token' => array(
            'model' => 'User_Token',
        ),
        'coupon' => array(
            'model' => 'User_Coupon',
        ),
        'tecfaq_comment'=> array(
            'model' => 'Site_Tecfaq_Comment',
        ),
        'tecfaq'=> array(
        	'model' => 'Site_Tecfaq',
        )
        
    );
    /* 指定软删除字段 */
    protected $_disabled_column = 'disabled';

    /**
     * 验证规则
     * @return array
     */
    public function rules ()
    {
        return array(
            'email' => array(
                array('email'),
            ),
            'group_id' => array(
                array('digit'),
            ),
        );
    }

    /**
     * 更新会员的积分
     * @access public
     * @param int $score 更新的会员积分
     * @param string $type 更新类型，add|reduce|update
     * @return boolen
     * @throws Exception_BES 
     * @author fanchongyuan
     */
    public function update_score($score,$type) 
    {
        switch ($type) {
        case 'add':
            $this->score = $this->score + $score;
            break;
        case 'reduce':
            $this->score = $this->score - $score;
            break;
        case 'update':
            $this->score = $score;
            break;
        default:
            throw new Exception_BES(__('bad request.'), 500);
        }
        if($this->score < 0)
        {
            throw new Exception_BES(__('score update error.'), 500);
        }
        //更新会员等级
        if($this->score >= 0)
        {
            $user_group = BES::model('User_Group')->where('is_special','=','N')->and_where('active','=','Y')->and_where('score','<=',$this->score)->order_by('score','DESC')->find();
            if($user_group->loaded() && $user_group->id != $this->group_id)
            {
                $this->group_id = $user_group->id;
            }
        }
        $this->save();
        return $this->saved();
    }

    /**
     * 更新会员的购买金额
     * @access public
     * @param int $amount 更新的会员购买金额
     * @param string $type 更新类型，add|reduce|update
     * @return boolen
     * @throws Exception_BES 
     * @author 朱彬
     */
    public function update_shopping_total($amount,$type) 
    {
        switch ($type) {
        case 'add':
            $this->shopping_total = $this->shopping_total + $amount;
            break;
        case 'reduce':
            $this->shopping_total = $this->shopping_total - $amount;
            break;
        case 'update':
            $this->shopping_total = $amount;
            break;
        default:
            throw new Exception_BES(__('bad request.'), 500);
        }
        if($this->score < 0)
        {
            throw new Exception_BES(__('score update error.'), 500);
        }
        $this->save();
        return $this->saved();
    }

    /**
     * 检验邮箱
     * @access public
     * @param string $email 需检验email
     * @return boolen
     * @author fanchongyuan
     * @example 
     */
    public function check_email($email)
    {
        $result = $this->where('email','=',$email)->count_all();
        return $result ? false : true;
    }

    /**
     * 根据邮箱获取会员模型对象
     * @access public
     * @param string $email
     * @return Model_User obj || boolen
     * @author fanchongyuan
     * @example 
     */
    public function get_user_by_email($email)
    {
        $user = $this->where('email','=',$email)->find();
        if($user->loaded())
        {
            return $user;
        } else {
            return false;
        }
    }

    /**
     * 获取会员默认地址
     * @access public
     * @return Model_User_Address object 默认地址对象
     * @author fanchongyuan
     * @example 
     */
    public function get_default_address()
    {
        $result = $this->address->where('is_default','=','Y')->find();
        return $result;
    }

    /** 
     * 前台登录处理
     * @access public
     * @param string $email 登录邮箱
     * @param string $password 登录密码
     * @return array 会员数据数组
     * @author fanchongyuan
     * @example 
     */
    public function login($email,$password)
    {
        $return_array = array();
        $user = $this->where('email','=',$email)->and_where('password','=',md5($password))->find();
        if($user->loaded())
        {
            $return_array = $user->login_session();
        }
        return $return_array;
    }

    /**
     * 直接登录邮箱（无需密码）
     * @access public
     * @param string $email
     * @return array
     * @author fanchongyuan
     * @example 
     */
    public function login_no_pwd($email)
    {
        $return_array = array();
        $user = $this->where('email','=',$email)->find();
        if($user->loaded())
        {
            $return_array = $user->login_session();
        }
        return $return_array;
    }

    /** 
     * 注册登录session
     * @access public
     * @return void
     * @throws Exception_BES
     * @author fanchongyuan
     * @example 
     */
    public function login_session()
    {
        $return_array = array();
        if($this->active == 'N')
        {
            throw new Exception_BES(__('User has be stopped, please contact administrator.'));
        }
        $this->lastlogin = date('Y-m-d H:i:s',time());
        $this->save();

        $return_array = $this->as_array();
        unset($return_array['password']);
        unset($return_array['lastlogin']);
        $session = Session::instance();
        $session->set('user',$return_array);
        return $return_array;
    }

    /**
     * 前台登出处理
     * @return void
     * @author fanchongyuan
     * @example 
     */
    public function logout()
    {
        $session = Session::instance();
        $session->delete('user',NULL);
    }

    /** 
     * 生成用户token并保存
     * @access public
     * @return string | boolen
     * @author fanchongyuan
     * @example 
     */
    public function gen_token()
    {
        $token = $this->token->find();
        $token->user_id = $this->pk();
        $token->token = sha1(uniqid(mt_rand()));
        $token->date_add = date('Y-m-d H:i:s');
        $token->save();
        if($token->saved())
        {
            return $token->token;
        }
        return false;
    }
	/** 
     * 重发邮件时更新用户token
     * @access public
     * @return string | boolen
     * @author fanchongyuan
     * @example 
     */
    public function update_token()
    {
        $token = $this->token->where('user_id','=',$this->pk())->find();
    	if($token->loaded())
        {
            $tokentime = strtotime($token->date_add);
            $time_limit = BES::config('user_findpwd.expire');
            if(time() > $tokentime && (time() - $tokentime) <= $time_limit) 
            {
                return $token->token;
            }else{
            	$token->token = sha1(uniqid(mt_rand()));
		        $token->date_add = date('Y-m-d H:i:s');
		        $token->save();
		        return $token->token;
            }
        }
        return false;
    }

    /**
     * 检查token的有效性
     * @access public
     * @param string $token
     * @return boolen|Model_User_Token
     * @author fanchongyuan
     * @example 
     */
    public function check_token($token)
    {
        $token = BES::model('user_token')->where('user_id','=',$this->pk())->where('token','=',$token)->find();
        if($token->loaded())
        {
            $tokentime = strtotime($token->date_add);
            $time_limit = BES::config('user_findpwd.expire');
            if(time() > $tokentime && (time() - $tokentime) <= $time_limit) 
            {
                return $token;
            }
        }
        return false;
    }

    /**
     * 添加用户地址接口
     * @access public
     * @param Model_User_Address $address 用户地址数据模型
     * @return boolen
     * @throw Exception_BES
     * @author fanchongyuan
     * @example 
     */
    public function add_address(Model_User_Address $address)
    {
        try {
            if ($this->address->count_all() >= 5) {
                throw new Exception_BES(__('More than the largest number.'));
            }
            $address->user_id = $this->pk();
            if(!empty($address->s_area_id))
            {
                $area = BES::model('area',$address->s_area_id);
                if(!$area->loaded())
                {
                    throw new Exception_BES(__('Area Error.'));
                }
                $address->s_country = $area->name;
            }
            /* 默认地址数据处理 */
            $default_address = $this->address->where('is_default', '=', 'Y')->find();
            
            if ($default_address->loaded()) 
            {
                if($address->is_default == 'Y')
                {
                    $default_address->is_default = 'N';
                    $default_address->save();
                }
            } else { 
                $address->is_default = 'Y';
            }
            $address->save();
        } catch (ORM_Validation_Exception $ex) {
            throw new Exception_BES($address->validation()->errors_string());
        }
        return true;
    }

    /**
     * 根据订单添加用户地址信息
     * @param Model_Order $order_model
     * @return void
     */
    public function add_address_by_order(Model_Order $order_model)
    {
        if($this->loaded())
        {
            $address = BES::model('user_address');
            $address->s_area_id = $order_model->s_area_id;
            $address->b_area_id = $order_model->b_area_id;
            $address->s_firstname = $order_model->shipping_firstname;
            $address->s_lastname = $order_model->shipping_lastname;
            $address->s_country = $order_model->shipping_country;
            $address->s_state = $order_model->shipping_province;
            $address->s_city = $order_model->shipping_city;
            $address->s_zip = $order_model->shipping_zip;
            $address->s_address = $order_model->shipping_address;
            $address->s_phone = $order_model->shipping_phone;
            $address->s_phone1 = $order_model->shipping_mobile;

            $address->b_firstname = $order_model->billing_firstname;
            $address->b_lastname = $order_model->billing_lastname;
            $address->b_country = $order_model->billing_country;
            $address->b_state = $order_model->billing_province;
            $address->b_city = $order_model->billing_city;
            $address->b_zip = $order_model->billing_zip;
            $address->b_address = $order_model->billing_address;
            $address->b_phone = $order_model->billing_phone;
            $address->b_phone1 = $order_model->billing_mobile;
            $this->add_address($address);
        }
    }


    /**
     * 更新用户地址接口
     * @access public
     * @param Model_User_Address $address 需更新的用户地址数据模型
     * @return boolen
     * @throw Exception_BES
     * @author fanchongyuan
     * @example 
     */
    public function edit_address(Model_User_Address $address)
    {
        try {
            if(!$address->loaded())
            {
                throw new Exception_BES(__('Address Model Error.'));
            }
            if(!empty($address->s_area_id))
            {
                $area = BES::model('area',$address->s_area_id);
                if(!$area->loaded())
                {
                    throw new Exception_BES(__('Area Error.'));
                }
                $address->s_country = $area->name;
            }
            /* 默认地址数据处理 */
            $default_address = $this->address->where('is_default', '=', 'Y')->find();
            if($default_address->loaded())
            {
                if ($address->is_default == 'Y') 
                {
                    if($default_address->pk() != $address->pk())
                    {
                        $default_address->is_default = 'N';
                        $default_address->save();
                    }
                } else {
                    if($default_address->pk() == $address->pk())
                    {
                        $address->is_default = 'Y';
                    }
                }
            } else {
                $address->is_default = 'Y';
            }
            $address->save();
        } catch (ORM_Validation_Exception $ex) {
            throw new Exception_BES($address->validation()->errors_string());
        }
        return true;
    }

    /**
     * 是否已经购买该产品
     * @access public
     * @param Model_Product $product
     * @return boolen
     */
    public function is_buy_product(Model_Product $product)
    {
        if($this->loaded() && $product->loaded()){
            return BES::model('Order_Product')
                ->where('product_id', '=', $product->pk())
                ->where('user_id', '=', $this->pk())
                ->count_all() > 0;
        }
        return false;
    }
}
