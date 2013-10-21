<?php defined('SYSPATH') or die('No direct script access.');
// $Id$
/**
 * 用户控制器
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package User
 * @category Controller
 * @since 2011-12-27
 * @author zhubin
 * @version $Id$
 */
class Controller_User extends Controller_Base
{
    /**
     * 编辑用户信息
     */
    public function action_profile()
    {
        try {
            if(empty($this->user)){
                throw new Exception_BES(__('Welcome, Please login!'));
            }
            $user = BES::model('User', $this->user['id']);
            if(!$user->loaded()){
                throw new Exception_BES(__('Invalid Request'));
            }
            if($_POST){
            	if($this->request->query('type')=='company'){
            	$user->company_name = $this->request->post('company_name');
                $user->company_address = $this->request->post('company_address');
                $user->company_phone = $this->request->post('company_phone');
				$user->contact_person = $this->request->post('contact_person');
                 if(!empty($_FILES['certificate_image']) || (Upload::valid($_FILES['certificate_image']) AND Upload::not_empty($_FILES['certificate_image']))){
                 		$upfile = $_FILES['certificate_image'];
                 	if(!Upload::type($upfile,array('jpg','jpeg','png','gif'))){
						Remind::factory(Remind::TYPE_ERROR)
                        ->message(__('Image Type Incorrent'))
                        ->redirect(BES::url('user/profile'))
                        ->send();
					}
                 if(!Upload::size($upfile,2097152)){
						Remind::factory(Remind::TYPE_ERROR)
                        ->message(__('Image Size Out Range'))
                        ->redirect(BES::url('user/profile'))
                        ->send();
					}
				$save_path = DOCROOT . 'public/certificate/'; 
				$save_url = 'certificate/'; 
				do{
                    $name = uniqid().'.'.pathinfo($upfile['name'], PATHINFO_EXTENSION);
                }while(file_exists($save_path . $name));
				if(!$image = Upload::save($upfile, $name, $save_path)){
                		Remind::factory(Remind::TYPE_ERROR)
                        ->message(__('Image Upload Failed'))
                        ->redirect(BES::url('user/profile'))
                        ->send();
                
				}
				
				$file_url = $save_url.$name;
				$user -> certificate_image = $file_url;
                }
                $user->save();
                $user->login_session();
                	Remind::factory(Remind::TYPE_SUCCESS)
                        ->message(__('Update Successfully.'))
                        ->redirect(BES::url('user/profile'))
                        ->send();
                
            	}else{
                $user->firstname = $this->request->post('firstname');
                $user->lastname = $this->request->post('lastname');
                $user->birthday = $this->request->post('birthday');
                $user->sex = $this->request->post('sex');
                $validate = $user->validation()
                    ->rules('firstname',array(array('not_empty'),array('min_length', array(':value', 1)),array('max_length', array(':value', 50))))
                    ->rules('lastname',array(array('not_empty'),array('min_length', array(':value', 1)),array('max_length', array(':value', 50))));
                if($validate->check())
                {
                    $user->save();
                    $user->login_session();
                    Remind::factory(Remind::TYPE_SUCCESS)
                        ->message(__('Update Successfully.'))
                        ->redirect(BES::url('user/profile'))
                        ->send();
                } else {
                    Remind::factory(Remind::TYPE_ERROR)
                        ->message($validate->errors())
                        ->redirect(BES::url('user/profile'))
                        ->send();
                }
            	}
            }
            $navigation[] = array('name' => 'My Profile', 'href'=>'');
            $this->template = BES::view('user_layout',array(
               'user_left' => BES::view('user_left',array('current_url'=>BES::url('user/profile')))->render(NULL,FALSE),
               'user_content' => BES::view('user_profile')->render(NULL,FALSE),
               'navigation'   => $navigation,
            ));
        } catch(Exception_BES $ex) {
            Remind::factory(Remind::TYPE_ERROR)
                ->message($ex->getMessage())
                ->redirect(BES::url('user/login'))
                ->send();
        }
    }
    /**
     * 跟新用户信息
     */
    public function action_change_pwd()
    {
        try {
            if(empty($this->user)){
                throw new Exception_BES(__('Welcome, Please login!'));
            }
            $user = BES::model('User', $this->user['id']);
            if(!$user->loaded()){
                throw new Exception_BES(__('Invalid Request'));
            }
            if($_POST){
                if($user->password != md5($this->request->post('current_password'))){
                    Remind::factory(Remind::TYPE_ERROR)
                        ->message(__('Current Password Error.'))
                        ->redirect(BES::url('user/change_pwd'))
                        ->send();
                }
                if($this->request->post('password') != $this->request->post('password_confirm')){
                    Remind::factory(Remind::TYPE_ERROR)
                        ->message(__('Please make sure both your password entries match.'))
                        ->redirect(BES::url('user/change_pwd'))
                        ->send();
                }
                $user->password = $this->request->post('password');
                $validate = $user->validation()
                    ->rules('password',array(array('not_empty'),array('min_length', array(':value', 1)),array('max_length', array(':value', 30))));
                if($validate->check())
                {
                    $user->password = md5($user->password);
                    $user->save();
                    $user->logout();
                    Remind::factory(Remind::TYPE_SUCCESS)
                        ->message(__('Update Password Successfully.'))
                        ->redirect(BES::url('user/login'))
                        ->send();
                } else {
                    Remind::factory(Remind::TYPE_ERROR)
                        ->message($validate->errors())
                        ->redirect(BES::url('user/change_pwd'))
                        ->send();
                }
            }
            $navigation[] = array('name' => 'Change Password', 'href'=>'');
            $this->template = BES::view('user_layout',array(
                'navigation' => $navigation,
                'user_left' => BES::view('user_left',array('current_url'=>BES::url('user/change_pwd')))->render(NULL,FALSE),
                'user_content' => BES::view('user_change_pwd')->render(NULL,FALSE),
            ));
        } catch (Exception_BES $ex) {
            Remind::factory(Remind::TYPE_ERROR)
                ->message($ex->getMessage())
                ->redirect(BES::url('user/login'))
                ->send();
        }
    }
    /**
     * 用户账号
     */
    public function action_account()
    {
        try {
            if(empty($this->user)){
                throw new Exception_BES(__('Welcome, Please login!'));
            }
            $user = BES::model('User', $this->user['id']);
            if(!$user->loaded()){
                throw new Exception_BES(__('Invalid Request'));
            }
            $navigation[] = array('name' => 'My Account', 'href'=>'');
            $this->template = BES::view('my_account',array(
                'navigation'=> $navigation,
            ));
        } catch (Exception_BES $ex) {
            Remind::factory(Remind::TYPE_ERROR)
                ->message($ex->getMessage())
                ->redirect(BES::url('user/login'))
                ->send();
        }
    }
    /**
     * 找回密码
     */
    public function action_find_pwd()
    {
        try {
            if($_POST){
                $email = trim($this->request->post('email'));
                $user = BES::model('User')->get_user_by_email($email);
                if(empty($user) || !$user->loaded()){
                    Remind::factory(Remind::TYPE_ERROR)
                        ->message(__('This E-mail address entered does not exist, please amend!'))
                        ->redirect(BES::url('user/find_pwd'))
                        ->send();
                }
                if($token = $user->gen_token())
                {
                    $getpwd_url = Helper_Site::site_config('domain').BES::url('user/get_pwd', array(
                        'u' => $user->id,
                        't' => $token,
                    ));
                    $getpwd_link = '<a href="'.$getpwd_url.'" target="_blank">'.$getpwd_url.'</a>';
                    $param = array(
                        '{firstname}' => $user->firstname,
                        '{email}' => $user->email,
                        '{reset_link}' => $getpwd_link,
                    );
                    Mail::instance()->content('forget',$param)->send($user->email);
                    Remind::factory(Remind::TYPE_SUCCESS)
                        ->message(__('Please check your email to find your password.'))
                        ->redirect(BES::url('user/find_pwd'))
                        ->send();
                }
            }
            $navigation[] = array('name' => 'Find Password', 'href'=>'');
            $this->template = BES::view('find_password',array(
                'navigation'=> $navigation,
            ));
        } catch (Exception_BES $ex) {
            Remind::factory(Remind::TYPE_ERROR)
                ->message($ex->getMessage())
                ->redirect(BES::url('user/login'))
                ->send();
        }
    }

    /**
     * 找回密码
     */
    public function action_get_pwd()
    {
        try {
            $user_id = $this->request->query('u');
            $token = $this->request->query('t');
            $user_model = BES::model('User',intval($user_id));
            $user_token = null;
            if(!$user_model->loaded() || !($user_token=$user_model->check_token($token))){
                Remind::factory(Remind::TYPE_SUCCESS)
                    ->message(__('Welcome, Please login!'))
                    ->redirect(BES::url('user/login'))
                    ->send();
            }
            if($_POST){
                $password = $this->request->post('password');
                $confirm_pwd = $this->request->post('password_confirm');
                if($password != $confirm_pwd){
                    Remind::factory(Remind::TYPE_ERROR)
                        ->message(__('The password you input twice is not match!'))
                        ->redirect(url::current(true))
                        ->send();
                }
                $user_model->password = md5($password);
                $user_model->save();
                //密码修改成功删除token
                $user_token->delete();
                Remind::factory(Remind::TYPE_SUCCESS)
                    ->message(__('Change password success, please login!'))
                    ->redirect(BES::url('user/login'))
                    ->send();
            }
            //面包屑
            $navigation = array();
            $navigation[] = array('name' => 'Get Password','href' => '');
            $this->template = BES::view('get_password',array(
                'navigation'=> $navigation,
            ));
        } catch (Exception_BES $ex) {
            Remind::factory(Remind::TYPE_ERROR)
                ->message($ex->getMessage())
                ->redirect(BES::url('user/login'))
                ->send();
        }
    }
    /**
     * 用户地址列表
     */
    public function action_address()
    {
        try {
            if(empty($this->user)){
                throw new Exception_BES(__('Welcome, Please login!'));
            }
            $user = BES::model('User', $this->user['id']);
            if(!$user->loaded()){
                throw new Exception_BES(__('Invalid Request'));
            }
            $user_addresses = $user->address->find_all();
            $navigation[] = array('name' => 'Address Book', 'href'=>'');
            $this->template = BES::view('user_layout',array(
                'navigation'=> $navigation,
                'user_left' => BES::view('user_left',array('current_url'=>BES::url('user/address')))->render(NULL,FALSE),
                'user_content' => BES::view('user_address',array('user_addresses'=>$user_addresses))->render(NULL,FALSE),
            ));
        } catch (Exception_BES $ex) {
            Remind::factory(Remind::TYPE_ERROR)
                ->message($ex->getMessage())
                ->redirect(BES::url('user/login'))
                ->send();
        }
    }
    /**
     * 用户wishlist
     */
    public function action_wishlist()
    {
        try {
            if(empty($this->user)){
                throw new Exception_BES(__('Welcome, Please login!'));
            }
            $user = BES::model('User', $this->user['id']);
            if(!$user->loaded()){
                throw new Exception_BES(__('Invalid Request'));
            }
            $total = $user->wishlist->count_all();
            $pagination = Pagination::factory(array(
                'total_items' => $total,
                'items_per_page' => 10,
            ));
            $wishlists_tmp = $user->wishlist
                ->offset($pagination->offset)
                ->limit($pagination->items_per_page)
                ->order_by('date_add','DESC')->find_all();
            $wishlists = array();
            foreach($wishlists_tmp as $key=>$wishlist){
                $wishlists[$key] = $wishlist->as_array();
                $wishlists[$key]['url'] = Helper_Product::get_url_by_product_id($wishlist->product_id);
                $wishlists[$key]['attribute_style'] = 
                !empty($wishlists[$key]['attribute_style']) ? json_decode($wishlists[$key]['attribute_style'], true):array();
                $wishlists[$key]['type'] = BES::model('Product',$wishlist->product_id)->type;
            }
            $navigation[] = array('name' => 'Wish list', 'href'=>'');
            $this->template = BES::view('user_layout',array(
                'navigation' => $navigation,
                'user_left' => BES::view('user_left',array('current_url'=>BES::url('user/wishlist')))->render(NULL,FALSE),
                'user_content' => BES::view('user_wishlist',array(
                    'wishlists' => $wishlists,
                    'pagination' => $pagination,
                ))->render(NULL,FALSE),
            ));
        } catch (Exception_BES $ex) {
            Remind::factory(Remind::TYPE_ERROR)
                ->message($ex->getMessage())
                ->redirect(BES::url('user/login'))
                ->send();
        }
    }
    /**
     * 删除用户wishlist
     */
    public function action_delete_wishlist()
    {
        try {
            if(empty($this->user)){
                throw new Exception_BES(__('Welcome, Please login!'));
            }
            $user = BES::model('User', $this->user['id']);
            if(!$user->loaded()){
                throw new Exception_BES(__('Invalid Request'));
            }
            $wishlist = $user->wishlist->where('id','=',$this->request->query('id'))->find();
            if($wishlist->loaded()){
                $wishlist->delete();
                Remind::factory(Remind::TYPE_SUCCESS)
                    ->message(__('Delete wishlist successfully!'))
                    ->redirect(BES::url('user/wishlist'))
                    ->send();
            }else{
                Remind::factory(Remind::TYPE_ERROR)
                    ->message(__('Invalid Request!'))
                    ->redirect(BES::url('user/wishlist'))
                    ->send();
            }
        } catch (Exception_BES $ex) {
            Remind::factory(Remind::TYPE_ERROR)
                ->message($ex->getMessage())
                ->redirect(BES::url('user/login'))
                ->send();
        }
    }
    /**
     * 添加用户wishlist
     */
    public function action_add_wishlist()
    {
        try {
            $product = BES::model('Product', $this->request->query('product_id'));
                        
            if(!$product->loaded()){
                if($this->request->is_ajax()){
                    exit(json_encode(array(
                        'status' => 0,
                        'code' => 400,
                        'msg' =>__('Add failed,Product not exists!'),
                        'content' =>array()
                    )));
                } else{
                    Remind::factory(Remind::TYPE_SUCCESS)
                        ->message(__('Add failed,Product not exists!'))
                        ->redirect(BES::url('user/wishlist'))
                        ->send();
                }
            }
            if(empty($this->user)){
                throw new Exception_BES(__('Haven\'t logined in, please login first.'));
            }
            $user = BES::model('User', $this->user['id']);
            if(!$user->loaded()){
                throw new Exception_BES(__('Invalid Request'));
            }

            $wishlist_model = $user->wishlist
                ->where('user_id', '=', $user->id)
                ->where('product_id', '=', $product->id)
                ->find();
            $wishlist_model->user_id = $user->id;
            $wishlist_model->product_name = $product->name;
            $wishlist_model->product_id = $product->id;
            $wishlist_model->price = $product->price;
            //TODO  促销完成后修改
            $wishlist_model->discount_price = $product->price;
            $wishlist_model->sku = $product->sku;
            $wishlist_model->currency = $this->currency->cur_code;
            $wishlist_model->currency_sign = $this->currency->cur_sign;
            $wishlist_model->photo = $product->image;
            $wishlist_model->attribute_style = json_encode(Helper_Product::attrnames($product->type_model->attributes));
            $wishlist_model->save();
            if($this->request->is_ajax()){
                exit(json_encode(array(
                    'status' => 1,
                    'code' => 200,
                    'msg' =>__('Add successfully!'),
                    'content' =>array()
                )));
            } else {
            Remind::factory(Remind::TYPE_SUCCESS)
                ->message(__('Add successfully!'))
                ->redirect(BES::url('user/wishlist'))
                ->send();
            }
        } catch (Exception_BES $ex) {
            if($this->request->is_ajax()){
                exit(json_encode(array(
                    'status' => 0,
                    'code' => 400,
                    'msg' =>$ex->getMessage(),
                    'content' =>array(),
                    'redirect'=>  BES::url('user/login', array('redirect'=>$product->url))
                )));
            }else{
                Remind::factory(Remind::TYPE_ERROR)
                    ->message($ex->getMessage())
                    ->redirect(BES::url('user/login'))
                    ->send();
            }
        }
    }
    /**
     * 用户的优惠券
     */
    public function action_coupon()
    {
        try {
            if(empty($this->user)){
                throw new Exception_BES(__('Welcome, Please login!'));
            }
            $user = BES::model('User', $this->user['id']);
            if(!$user->loaded()){
                throw new Exception_BES(__('Invalid Request'));
            }
            $total = $user->coupon->count_all();
            $pagination = Pagination::factory(array(
                'total_items' => $total,
                'items_per_page' => 10,
            ));
            $coupons_tmp = $user->coupon
                ->offset($pagination->offset)
                ->limit($pagination->items_per_page)
                ->order_by('date_add','DESC')->find_all();
            $coupons = array();
            foreach($coupons_tmp as $key=>$coupon){
                $coupons[$key] = $coupon->as_array();
                $coupon_rule = BES::model('Sale_Coupon', $coupon->coupon_id);
                $coupons[$key]['name'] = $coupon_rule->cpn_name;
                $coupons[$key]['expiration_date'] = $coupon_rule->time_end;
                $coupons[$key]['status'] = $coupon_rule->loaded() && $coupon_rule->time_end > date('Y-m-d H:i:s') ? 'Available' : 'Expired';
                if(BES::model('Sale_Coupon')->is_coupon_used($coupon->coupon_code)){
                    $coupons[$key]['status'] = 'Used';
                }
            }
            $navigation[] = array('name' => 'Coupons', 'href'=>'');
            $this->template = BES::view('user_layout',array(
               'navigation' => $navigation,
               'user_left' => BES::view('user_left',array('current_url'=>BES::url('user/coupon')))->render(NULL,FALSE),
               'user_content' => BES::view('user_coupon',array(
                    'coupons' => $coupons,
                    'pagination' => $pagination,
                ))->render(NULL,FALSE),
            ));
        } catch (Exception_BES $ex) {
            Remind::factory(Remind::TYPE_ERROR)
                ->message($ex->getMessage())
                ->redirect(BES::url('user/login'))
                ->send();
        }
    }
    /**
     * 添加编辑用户地址
     */
    public function action_edit_address()
    {
        try {
            if(empty($this->user)){
                throw new Exception_BES(__('Welcome, Please login!'));
            }
            $user = BES::model('User', $this->user['id']);
            if(!$user->loaded()){
                throw new Exception_BES(__('Invalid Request'));
            }
            $address = $user->address->where('id','=', $this->request->query('address_id'))->find();
            if($_POST){
                $address->s_firstname = $this->request->post('firstname');
                $address->s_lastname = $this->request->post('lastname');
                $address->s_address = $this->request->post('address');
                $address->s_city = $this->request->post('city');
                $address->s_state = $this->request->post('state');
                $address->s_area_id = $this->request->post('country');
                $address->s_zip = $this->request->post('zip');
                $address->s_phone = $this->request->post('phone');
                $address->s_company = $this->request->post('company');
                $address->s_fax = $this->request->post('fax');
                $address->is_default = ($default = $this->request->post('is_default'))?$default:'N';
               
                try{
                    if($this->request->query('address_id')){
                        $user->edit_address($address);
                        $message = __('Update Address Successfully!');
                    }else{
                        $user->add_address($address);
                        $message = __('Add Address Successfully!');
                    }
                }catch(Exception_BES $ex){
                    Remind::factory(Remind::TYPE_ERROR)
                        ->message($ex->getMessage())
                        ->redirect(BES::url('user/address'))
                        ->send();
                }
                Remind::factory(Remind::TYPE_SUCCESS)
                    ->message($message)
                    ->redirect(BES::url('user/address'))
                    ->send();
            }
            $navigation[] = array('name' => 'Address Book', 'href'=>BES::url('user/address'));
            $navigation[] = array('name' => $address->loaded()?'Edit Address':'Add Address', 'href'=>'');
            $areas_tmp = BES::model('area')->get_areas(1);
            $areas = array();
            foreach($areas_tmp as $key=>$area){
                if($area->active == 'Y'){
                    $areas[] = $area;
                }
            }
            $this->template = BES::view('user_layout',array(
                'navigation' => $navigation,
                'user_left' => BES::view('user_left',array('current_url'=>BES::url('user/address')))->render(NULL,FALSE),
                'user_content' => BES::view('user_edit_address',array('user_address'=>$address,'areas'=>$areas))->render(NULL,FALSE),
            ));
        } catch (Exception_BES $ex) {
            Remind::factory(Remind::TYPE_ERROR)
                ->message($ex->getMessage())
                ->redirect(BES::url('user/login'))
                ->send();
        }
    }
    /**
     * 删除地址
     */
    public function action_delete_address()
    {
        try {
            if(empty($this->user)){
                throw new Exception_BES(__('Welcome, Please login!'));
            }
            $user = BES::model('User', $this->user['id']);
            if(!$user->loaded()){
                throw new Exception_BES(__('Invalid Request'));
            }
            $address = $user->address->where('id', '=', $this->request->query('address_id'))->find();
            if(!$address->loaded()){
                Remind::factory(Remind::TYPE_ERROR)
                    ->message(__('Invalid Request'))
                    ->redirect(BES::url('user/login'))
                    ->send();
            }
            if($address->is_default=='Y'){
                Remind::factory(Remind::TYPE_ERROR)
                    ->message('Can not delete the default address!')
                    ->redirect(BES::url('user/address'))
                    ->send();
            }
            $address->delete();
            Remind::factory(Remind::TYPE_SUCCESS)
                ->message(__('Deleted successfully!'))
                ->redirect(BES::url('user/address'))
                ->send();
        } catch (Exception_BES $ex) {
            Remind::factory(Remind::TYPE_ERROR)
                ->message($ex->getMessage())
                ->redirect(BES::url('user/login'))
                ->send();
        }
    }
    /**
     * 设置默认地址
     */
    public function action_set_default_address()
    {
        try {
            if(empty($this->user)){
                throw new Exception_BES(__('Welcome, Please login!'));
            }
            $user = BES::model('User', $this->user['id']);
            if(!$user->loaded()){
                throw new Exception_BES(__('Invalid Request'));
            }
            $address = $user->address->where('id', '=', $this->request->query('address_id'))->find();
            if(!$address->loaded()){
                throw new Exception_BES(__('Invalid Request'));
            }
            $address->is_default = 'Y';
            $user->edit_address($address);
            Remind::factory(Remind::TYPE_SUCCESS)
                ->message(__('Update successfully!'))
                ->redirect(BES::url('user/address'))
                ->send();
        } catch (Exception_BES $ex) {
            Remind::factory(Remind::TYPE_ERROR)
                ->message($ex->getMessage())
                ->redirect(BES::url('user/login'))
                ->send();
        }
    }
    /**
     * 用户订单列表
     */
    public function action_orders()
    {
        try {
            if(empty($this->user)){
                throw new Exception_BES(__('Welcome, Please login!'));
            }
            $user = BES::model('User', $this->user['id']);
            if(!$user->loaded()){
                throw new Exception_BES(__('Invalid Request'));
            }
            $total = $user->order->count_all();
            $pagination = Pagination::factory(array(
                'total_items' => $total,
                'items_per_page' => 10,
            ));

            $orders_tmp = $user->order->where('parent_id','=','0')
                ->offset($pagination->offset)
                ->limit($pagination->items_per_page)
                ->order_by('date_add','DESC')->find_all();
            $orders = array();
            $status_config = Model_Order_Status_Config::factory(BES::config('order.front'),'front');
            foreach($orders_tmp as $order){
                $allowed_actions = $order->set_status_config($status_config)->get_allow_actions();
                $order_tmp = $order->as_array();
                $order_tmp['pay_status'] = $order->load_status()->get_to_show('pay_status');
                $order_tmp['ship_status'] = $order->load_status()->get_to_show('ship_status');
                $order_tmp['allowed_actions'] = $allowed_actions;
                $orders[] = $order_tmp;
            }
            $navigation[] = array('name'=>'My Orders', 'href'=>'');
            $this->template = BES::view('user_layout',array(
               'navigation' => $navigation,
               'user_left' => BES::view('user_left',array('current_url'=>BES::url('user/orders')))->render(NULL,FALSE),
               'user_content' => BES::view('user_orders',array(
                   'actions_config' => BES::config('order.front.actions_config'),
                   'orders' => $orders,
                   'pagination' => $pagination,
               ))->render(NULL,FALSE),
            ));
        } catch (Exception_BES $ex) {
            Remind::factory(Remind::TYPE_ERROR)
                ->message($ex->getMessage())
                ->redirect(BES::url('user/login'))
                ->send();
        }
    }
    
    /*
     * 我的提问
     */
	public function action_questions()
    {
        try {
            if(empty($this->user)){
                throw new Exception_BES(__('Welcome, Please login!'));
            }
            $user = BES::model('User', $this->user['id']);
            if(!$user->loaded()){
                throw new Exception_BES(__('Invalid Request'));
            }
            $total = $user->tecfaq->count_all();
            $pagination = Pagination::factory(array(
                'total_items' => $total,
                'items_per_page' => 10,
            ));

            $tecfaq_tmp = $user->tecfaq->where('user_id','=',$this->user['id'])
                ->offset($pagination->offset)
                ->limit($pagination->items_per_page)
                ->order_by('date_add','DESC')->find_all();
            $tecfaq = array();
            foreach($tecfaq_tmp as $tecfaq_val){
                $tecfaq_tmp = $tecfaq_val->as_array();
                $tecfaq_tmp['category'] = $tecfaq_val->faq_category->name;
                $tecfaq[] = $tecfaq_tmp;
            }
            $navigation[] = array('name'=>__('My Question'), 'href'=>'');
            $this->template = BES::view('user_layout',array(
               'navigation' => $navigation,
               'user_left' => BES::view('user_left',array('current_url'=>BES::url('user/questions')))->render(NULL,FALSE),
               'user_content' => BES::view('user_questions',array(
                   'actions_config' => BES::config('order.front.actions_config'),
                   'tecfaq' => $tecfaq,
                   'pagination' => $pagination,
               ))->render(NULL,FALSE),
            ));
        } catch (Exception_BES $ex) {
            Remind::factory(Remind::TYPE_ERROR)
                ->message($ex->getMessage())
                ->redirect(BES::url('user/login'))
                ->send();
        }
    }

    /**
     * 会员退出
     */
    public function action_logout()
    {
        try {
            BES::model('User')->logout();
            //清空购物车
            Model_Cart::instance()->clear();

            Remind::factory(Remind::TYPE_SUCCESS)
                ->message(__('Logout Successfully!'))
                ->redirect(BES::url('user/login'))
                ->send();
        } catch (Exception_BES $ex) {
            Remind::factory(Remind::TYPE_ERROR)
                ->message($ex->getMessage())
                ->redirect(BES::url('user/login'))
                ->send();
        }
    }
    /**
     * 支付时登录
     */
    public function action_login()
    {
        try {
        	$ip_address = $this->request->ip_address();
            $redirect = $this->request->query('redirect');
            $redirect = !empty($redirect) ? $redirect : BES::url('index');
            if(!empty($this->user)){
                Remind::factory(Remind::TYPE_SUCCESS)
                    ->message(__('Has logged in, do not need to log in again.'))
                    ->redirect($redirect)
                    ->send();
            }
			$session = Session::instance();
			//$session->delete('secode_user');$session->delete ( 'login_name' );$session->delete ( 'login_error_count' );$session->delete ( 'login_location' );
            Helper_secoder::$seKey = 'opococ.secoder';
		    //用户名和密码输入错误三次后就需要输入验证码
			$login_error_count = $session->get ( 'login_error_count' );
			if (! $login_error_count) {
			     Session::instance ()->set ( 'login_error_count', 1 );
			     $login_error_count = 1;
			}
			//登录地区异常会记录
			$login_location = $session->get ( 'login_location' );
			$login_name = $session->get ( 'login_name' );
            if($_POST){
		        //如果session中获取到待验证用户,只做验证码验证
		        if ($secode_user = $session->get ( 'secode_user' )){
		        	$secode = $this->request->post('secode');
		        	if (BES::helper('secoder')->check ( $secode )){
		        		$session->set('user',$secode_user);
		        		$session->delete('secode_user');
		        		$session->delete ( 'login_name' );
		        		$session->delete ( 'login_error_count' );
		        		$session->delete ( 'login_location' );
		        		$user = BES::model('User',$secode_user['id']);
		        		$user->lastlogin_location = $login_location;
		        		$user->lastlogin_ip = $ip_address;
		        		$user->save();
		        		$user->login_session();
		        		Remind::factory(Remind::TYPE_SUCCESS)
                        ->message(__('Login Successfully!'))
                        ->redirect($redirect)
                        ->send();
		        	}else{
		        		Remind::factory(Remind::TYPE_ERROR)
                            ->message(__('Please check the code.'))
                            ->redirect(BES::url('user/login',array('redirect'=>$redirect,'login_type'=>$this->request->query('login_type'))))
                            ->send();
		        	}
		        }
		        //end secode;
                if($this->request->post('is_login')){
		        	$secode = $this->request->post ( 'secode' );
                    $email = trim($this->request->post('email'));
                    $password = trim($this->request->post('password'));
                    
	                //验证验证码
		            if (($login_error_count > 3  || $login_location) && ! BES::helper('secoder')->check ( $secode )) {
		                Remind::factory(Remind::TYPE_ERROR)
                            ->message(__('Please check the code.'))
                            ->redirect(BES::url('user/login',array('redirect'=>$redirect,'login_type'=>$this->request->query('login_type'))))
                            ->send();
		            }
                    $user = BES::model('User')
                        ->or_where_open()
                        ->where('email','=',$email)
                        ->or_where('nicename','=',$email)
                        ->or_where_close()
                        ->where('password','=',md5($password))
                        ->find();
                    $message = __('Login Successfully!');
                    $type = Remind::TYPE_SUCCESS;
                    if(!$user->loaded()){
                    	$login_error_count ++;
                    	Session::instance ()->set ( 'login_error_count', $login_error_count );
                        $message = __('Please check your email or password.');
                        $type = Remind::TYPE_ERROR;
                        $redirect = url::current(TRUE);
                    }else if($user->active=='N'){
                        $message = __('This account can not be used.');
                        $type = Remind::TYPE_ERROR;
                        $redirect = BES::url('user/active_remind',array('user_id'=>$user->id));
                    }else if($user->status=='inactive'){
                        $message = __('This account is inactive.');
                        $type = Remind::TYPE_ERROR;
                        $redirect = url::current(TRUE);
                    }else{
                    	if (!$login_location){
                    		//检查登录地区
	                    	$info_key = BES::config('site.ipinfodbcom_key');
							$login_location = ip2location::factory($info_key)->getCity($ip_address);
							$login_location = $login_location['countryName'].'-'.$login_location['regionName'].'-'.$login_location['cityName'];
							
		                    if ($user->lastlogin_location != $login_location){
		                    	Session::instance()->set('login_location',$login_location);
		                    	Session::instance()->set('login_name',$email);
		                    	$secode_user = $user->as_array();
		                    	Session::instance()->set('secode_user',$secode_user);
		                    	Remind::factory(Remind::TYPE_ERROR)
	                            ->message(__('Your login location are not the same as last login location,please enter the verification code.'))
	                            ->redirect(BES::url('user/login',array('redirect'=>$redirect,'login_type'=>$this->request->query('login_type'))))
	                            ->send();
		                    }
                    	}
                    	
                    	$user->lastlogin_location = $login_location;
                    	
                   		Session::instance()->delete('login_location');
		                $user->lastlogin_ip = $ip_address;
		                $user->save();
		               	$user->login_session();
                    }
                    Remind::factory($type)
                        ->message($message)
                        ->redirect($redirect)
                        ->send();
                } else {
                    $firstname = trim($this->request->post('firstname'));
                    $lastname = trim($this->request->post('lastname'));
                    $email = trim($this->request->post('reg_email'));
                    $password = $this->request->post('password');
                    $confirm_pwd = $this->request->post('password_confirm');
                    $email_sign_up  = $this->request->post('email_sign_up');
                    if($password != $confirm_pwd || strlen($password) > 30){
                        Remind::factory(Remind::TYPE_ERROR)
                            ->message(__('Please make sure both your password entries match.'))
                            ->redirect(BES::url('user/login',array('redirect'=>$redirect,'login_type'=>$this->request->query('login_type'))))
                            ->send();
                    }
                    if(!BES::model('User')->check_email($email)){
                        Remind::factory(Remind::TYPE_ERROR)
                            ->message(__('Email has exist.'))
                            ->redirect(BES::url('user/login',array('redirect'=>$redirect,'login_type'=>$this->request->query('login_type'))))
                            ->send();
                    }

                    $default_group = BES::model('User_Group')->get_default_group();
                    $user = BES::model('User');
                    $user->group_id = $default_group->id;
                    $user->score = $default_group->score;
                    $user->firstname = $firstname;
                    $user->lastname = $lastname;
                    $user->password = $password;
                    $user->email = $email;
                    $user->ip = $ip_address;
                    $validate = $user->validation()
                    ->rules('firstname',array(array('not_empty'),array('min_length', array(':value', 1)),array('max_length', array(':value', 50))))
                    ->rules('lastname',array(array('not_empty'),array('min_length', array(':value', 1)),array('max_length', array(':value', 50))))
                    ->rules('password',array(array('not_empty'),array('min_length', array(':value', 1)),array('max_length', array(':value', 30))))
                    ->rules('email',array(array('not_empty')));
                    if(!$validate->check()){
                        Remind::factory(Remind::TYPE_ERROR)
                            ->message($validate->errors())
                            ->redirect(BES::url('user/login',array('redirect'=>$redirect,'login_type'=>$this->request->query('login_type'))))
                            ->send();
                    }
                    $user->password = md5($user->password);
                    $user->save();
                    if($email_sign_up){
                        $email_sign_up_model = BES::model('User_EmailSignUp');
                        if(!$email_sign_up_model->email_is_exist($user->email))
                        {
                            $email_sign_up_model->email_sign_up($user->email);
                        }
                    }
                   
                    $getpwd_link = '';
                    if($token = $user->gen_token())
                    {
                        $getpwd_url = Helper_Site::site_config('domain').BES::url('user/get_pwd', array(
                            'u' => $user->id,
                            't' => $token,
                        ));
                        $getpwd_link = '<a href="'.$getpwd_url.'" target="_blank">'.$getpwd_url.'</a>';
                    }
					//生成激活链接
                    $vc = md5(md5($user->id + 'muyang-bes')+ 'muyang-bes');
    				$active_url = Helper_Site::site_config('domain').BES::url('user/active_account', array(
                            'user_id' => $user->id,
                            'vc' => $vc,
                        ));
    				$active_link = '<a href="'.$active_url.'" target="_blank">'.$active_url.'</a>';
                    $param = array(
                        '{firstname}' => $user->firstname,
                        '{email}' => $user->email,
                        '{password}'=>$password,
                        '{password_omit}'=>substr($password,0,3).'***',
                        '{reset_link}' => $getpwd_link,
                    	'{active_link}' => $active_link,
                    );
                    Mail::instance()->content('reg',$param)->send($user->email);
                    //记录邮件发送时间，重发时判断
                    $file_cache = Cache::instance('file');
                    $file_cache->set('rsend_active_mail_time_'.$user->id, time(),86400);
					//注册后不登陆，需要激活
                    //$user->login_session();
                    Remind::factory(Remind::TYPE_SUCCESS)
                        ->message(__('We send a email to {email},please check it to complete register!',array('{email}'=>$user->email)))
                        ->redirect(BES::url('user/active_remind',array('redirect'=>$redirect,'user_id'=>$user->id)))
                        ->send();
                }
            }else{
                $view = $this->request->query('login_type')=='checkout' ? 'checkout_login' : 'login';
                $this->template = BES::view($view, array(
                    'redirect' => $this->request->query('redirect'),
                	'login_error_count'=>$login_error_count,
                	'login_location' => $login_location,
                	'login_name' => $login_name,
                ));
            }
        } catch (Exception_BES $ex) {
            Remind::factory(Remind::TYPE_ERROR)
                ->message($ex->getMessage())
                ->redirect(url::current(TRUE))
                ->send();
        }
    }
    
    /*
     * 提醒邮箱激活
     */
    public function action_active_remind(){
    	try {
    		$user_id = $this->request->query('user_id');
    		//检查此用户是否待激活
    		$token_check = BES::model('User_Token')->where('user_id','=',$user_id)->find();
    		if (!$token_check->id){
    			 Remind::factory(Remind::TYPE_ERROR)
		            ->message(__('Bad request.'))
	                ->redirect(BES::url('index/index'))
	                ->send();
    		}
    		//检查用户
    		$user = BES::model('User',$user_id);
    		if (!$user){
    			Remind::factory(Remind::TYPE_ERROR)
		            ->message(__('Bad request.'))
	                ->redirect(BES::url('index/index'))
	                ->send();
    		}
    		$this->template = BES::view('user_active_remind', array(
    				'user' => $user->as_array(),
                ));
    	} catch (Exception_BES $ex) {
            	Remind::factory($ex)
                	->redirect(BES::url('user/login'))
               	 	->send();
        }
    }
    /*
     * 重发激活邮件
     */
    public function action_rsend_active_mail(){
    	try {
    		$user_id = $this->request->query('user_id');
    		$redirect = $this->request->query('redirect');
        	$file_cache = Cache::instance('file');
        	//记录该用户邮箱重发次数，超过3次提示
        	$send_count = $file_cache->get('rsend_active_mail_count_'.$user_id);
        	if ($send_count>=3){
        		Remind::factory(Remind::TYPE_ERROR)
		            ->message(__('Send too many times.'))
	                ->redirect(BES::url('index'))
	                ->send();
        	}
        	//记录重发时间，60秒内不得重发
        	$send_time = $file_cache->get('rsend_active_mail_time_'.$user_id);
        	if (time()-$send_time<60){
        		Remind::factory(Remind::TYPE_ERROR)
		            ->message(__('Send after 60 seconds.'))
	                ->redirect(BES::url('user/active_remind',array('user_id'=>$user_id,'r_key'=>uniqid())))
	                ->send();
        	}
    		//检查用户
    		$user = BES::model('User',$user_id);
    		if (!$user || 'Y'==$user->active){
    			Remind::factory(Remind::TYPE_ERROR)
		            ->message(__('Bad request.'))
	                ->redirect(BES::url('index/index'))
	                ->send();
    		}
    		//检查此用户重置密码token并更新
    		$getpwd_link = '';
            if($token = $user->update_token())
                    {
                        $getpwd_url = Helper_Site::site_config('domain').BES::url('user/get_pwd', array(
                            'u' => $user->id,
                            't' => $token,
                        ));
                        $getpwd_link = '<a href="'.$getpwd_url.'" target="_blank">'.$getpwd_url.'</a>';
                    }
			//生成激活链接
            $vc = md5(md5($user->id + 'muyang-bes')+ 'muyang-bes');
    		$active_url = Helper_Site::site_config('domain').BES::url('user/active_account', array(
                            'user_id' => $user->id,
                            'vc' => $vc,
                        ));
    		$active_link = '<a href="'.$active_url.'" target="_blank">'.$active_url.'</a>';
    		$param = array(
                   '{firstname}' => $user->firstname,
                   '{email}' => $user->email,
                   '{reset_link}' => $getpwd_link,
                   '{active_link}' => $active_link,
            );
        	Mail::instance()->content('reg',$param)->send($user->email);
        	$send_count ++;
        	//重设发送次数和时间
        	$file_cache->set('rsend_active_mail_count_'.$user_id, $send_count,86400);
        	$file_cache->set('rsend_active_mail_time_'.$user_id, time(),86400);
        	
        	Remind::factory(Remind::TYPE_SUCCESS)
                        ->message(__('We send a email to {email},please check it to complete register!',array('{email}'=>$user->email)))
                        ->redirect(BES::url('user/active_remind',array('redirect'=>$redirect,'user_id'=>$user->id)))
                        ->send();
    	} catch (Exception_BES $ex) {
            	Remind::factory($ex)
                	->redirect(BES::url('user/login'))
               	 	->send();
        }
    
    }
    /*
     * 邮箱激活账号
     * dpx
     */
    public function action_active_account(){
    	try {
    		$user_id = $this->request->query('user_id');
    		$token = $this->request->query('vc');
    		$redirect = $this->request->query('redirect');
	    	if(empty($user_id) || empty($token) || md5(md5($user_id + 'muyang-bes') + 'muyang-bes')!= $token)
	        {
	             Remind::factory(Remind::TYPE_ERROR)
	            ->message(__('Bad request.'))
                ->redirect(BES::url('index/index'))
                ->send();
	        }
	        $user = BES::model('User')->where('id','=',$user_id)->find();
	        if ('Y'==$user->active){
	        	Remind::factory(Remind::TYPE_WARNING)
	        	->message(__('Already actived.'))
                ->redirect(BES::url('user/login'))
                ->send();
	        }
	        $user->active = 'Y';
	        $user->save();
	        Remind::factory(Remind::TYPE_SUCCESS)
	        	->message(__('Actived Successfully!'))
                ->redirect(BES::url('user/login',array('redirect'=>$redirect)))
                ->send();
	        
    		} catch (Exception_BES $ex) {
            	Remind::factory($ex)
                	->redirect(BES::url('user/login'))
               	 	->send();
        	}
    }
    /**
     * Tell A Friend
     */
    public function action_tellfriend()
    {
        try {
            $product_id = $this->request->query('product_id');
            $product = BES::model('Product', intval($this->request->query('product_id')));
            if ($product->loaded()) {
                if (!empty($_POST)) {
                    $friend_email = trim($this->request->post('friendemail'));
                    $friend_name  = trim($this->request->post('friendname'));
                    $your_email   = trim($this->request->post('youremail'));
                    $your_name    = trim($this->request->post('yourname'));
                    if($friend_email == $your_email)
                    {
                        Remind::factory(Remind::TYPE_ERROR)
                        ->message(__('Your email address should be different from friend\'s email address.'))
                        ->redirect(url::current(TRUE))
                        ->send();
                    }
                    $params = array(
                        '{friend_email}'      => $friend_email,
                        '{friend_name}'       => $friend_name,
                        '{your_email}'        => $your_email,
                        '{your_name}'         => $your_name,
                        '{message}'           => $this->request->post('textarea'),
                        '{product_view_link}' => 
                        '<a href="'.Helper_Site::Site_Config('domain').$product->url.'">'.Helper_Site::Site_Config('domain').$product->url.'</a>',
                    );
                    Mail::instance()
                        ->content('tell_friend', $params)
                        ->send($friend_email, $your_email);
                    Remind::factory(Remind::TYPE_SUCCESS)
                        ->message(__('Congratulations! Your email has been sent Successfully!'))
                        ->redirect($product->url)
                        ->send();
                } else {
                    $this->template = BES::view('tellfriend', array(
                        'product' => $product->as_array(array('url')),
                        'user'    => $this->user,
                    ));
                    $this->template = $this->template->render(NULL);
                }
            } else {
                throw new Exception_BES(__('Loading failed, try again'));
            }
        } catch (Exception_BES $ex) {
            Remind::factory($ex)
                ->redirect(BES::url('index/index'))
                ->send();
        }
    }
    
	/**
     * 用户产品评论
     */
    public function action_commentlist()
    {
        try {
            if(empty($this->user)){
                throw new Exception_BES(__('Welcome, Please login!'));
            }
            $user = BES::model('User', $this->user['id']);
            if(!$user->loaded()){
                throw new Exception_BES(__('Invalid Request'));
            }
            $comment_model = BES::model('Product_Comment')->where('user_id','=',$user->id);
            $clone_model = clone $comment_model;
            $total = $clone_model->count_all();
            $pagination = Pagination::factory(array(
                'total_items' => $total,
                'items_per_page' => 10,
            ));
            $comments = $comment_model
                ->offset($pagination->offset)
                ->limit($pagination->items_per_page)
                ->order_by('date_add','DESC')->find_all();
            $product_comments =array();
            foreach($comments as $key=>$comment){
                $product_comments[$key] = $comment->as_array();
                $product_comments[$key]['url'] = BES::model('product', $comment->product_id)->url;
               	$product_comments[$key]['name'] = BES::model('product', $comment->product_id)->name;
            }
            $navigation[] = array('name' => 'My Reviews', 'href'=>'');
            $this->template = BES::view('user_layout',array(
                'navigation' => $navigation,
                'user_left' => BES::view('user_left',array('current_url'=>BES::url('user/commentlist')))->render(NULL,FALSE),
                'user_content' => BES::view('user_commentlist',array(
                    'comments' => $product_comments,
                    'pagination' => $pagination,
                ))->render(NULL,FALSE),
            ));
        } catch (Exception_BES $ex) {
            Remind::factory(Remind::TYPE_ERROR)
                ->message($ex->getMessage())
                ->redirect(BES::url('user/login'))
                ->send();
        }
    }
    
	/**
     * 用户询盘评论
     */
    public function action_inquirylist()
    {
        try {
            if(empty($this->user)){
                throw new Exception_BES(__('Welcome, Please login!'));
            }
            $user = BES::model('User', $this->user['id']);
            if(!$user->loaded()){
                throw new Exception_BES(__('Invalid Request'));
            }
            $inquiry_model = BES::model('Inquiry')->where('user_id','=',$user->id);
            $clone_model = clone $inquiry_model;
            $total = $clone_model->count_all();
            $pagination = Pagination::factory(array(
                'total_items' => $total,
                'items_per_page' => 2,
            ));
            $inquiries = $inquiry_model
                ->offset($pagination->offset)
                ->limit($pagination->items_per_page)
                ->order_by('date_add','DESC')->find_all();
            $user_inquiries =array();
            foreach($inquiries as $key=>$inquiry){
                $user_inquiries[$key] = $inquiry->as_array();
                $inquiry_products = $inquiry->inquiry_products->find_all();
                foreach($inquiry_products as $k => $inquiry_product){
                //$user_inquiries[$key]['products'][$k] = $inquiry_product->as_array();
                $product_model = BES::model('product',$inquiry_product->product_id);
				$user_inquiries[$key]['products'][$k] = $product_model->as_array();
				$user_inquiries[$key]['products'][$k]['url'] = $product_model->url;
				$user_inquiries[$key]['products'][$k]['attr'] = Helper_Product::attrnames($product_model->type_model->attributes);
                }
            }
            $navigation[] = array('name' => 'My Enquiries', 'href'=>'');
            $this->template = BES::view('user_layout',array(
                'navigation' => $navigation,
                'user_left' => BES::view('user_left',array('current_url'=>BES::url('user/inquirylist')))->render(NULL,FALSE),
                'user_content' => BES::view('user_inquirylist',array(
                    'inquiries' => $user_inquiries,
                    'pagination' => $pagination,
                ))->render(NULL,FALSE),
            ));
        } catch (Exception_BES $ex) {
            Remind::factory(Remind::TYPE_ERROR)
                ->message($ex->getMessage())
                ->redirect(BES::url('user/login'))
                ->send();
        }
    }
    
    
	/**
     * show secode
     */
    function action_secoder() {
    	Helper_Secoder::$seKey = 'opococ.secoder';
        BES::helper('Secoder')->entry ();
    }
    
}
