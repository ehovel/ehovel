<?php defined('SYSPATH') or die('No direct script access.');
// $Id$
/**
 * 站点控制器
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package Site
 * @category Controller
 * @since 2011-01-04
 * @author zhubin
 * @version $Id$
 */
class Controller_Site extends Controller_Base
{
    /**
     * 设置当前币种
     */
    public function action_set_current_currency()
    {
        try {
            $currency = EHOVEL::model('site_currency')->where('cur_code', '=', $this->request->query('cur_code'))->find();
            EHOVEL::model('site_currency')->set_current_currency($currency);
            $redirect = urldecode($this->request->query('redirect'));
            $redirect = empty($redirect) ? EHOVEL::url('index') : urldecode($redirect);
            $this->request->redirect($redirect);
        } catch (Kohana_Exception $ex) {
            Remind::factory($ex)
                ->redirect(EHOVEL::url('index'))
                ->send();
        }
    }
    /**
     * 用户邮件订阅
     */
    public function action_email_sign_up()
    {
        try {
            if($_POST) {
                $redirect = $this->request->query('redirect');
                $redirect = !empty($redirect) ? urldecode($redirect) : URL::referrer();
                $email = $this->request->post('email');
                $model = EHOVEL::model('Site_EmailSignUp');
                if($model->email_is_exist($email))
                {
                    throw new Kohana_Exception(__('Email has exist.'));
                }
                $model->email_sign_up($email);
                Remind::factory(Remind::TYPE_SUCCESS)
                    ->message(__('Congratulations,you will receive our email about exclusive offers and the latest styles!'))
                    ->redirect($redirect)
                    ->send();
            } else {
                $navigation[] = array('name' => 'Email Sign Up', 'href'=>'');
                $this->template = EHOVEL::view('email_sign_up',array(
                    'navigation' => $navigation,
                ));
            }
        } catch (Kohana_Exception $ex) {
            Remind::factory($ex)
                ->redirect($redirect)
                ->send();
        } catch (ORM_Validation_Exception $ex) {
            Remind::factory($ex)
                ->message('Please enter a valid email address.')
                ->redirect($redirect)
                ->send();
        }
    }
	/**
     * 推荐给朋友
     */
    public function action_email_friend()
    {
        try {
        	$product_id = intval($this->request->query('id'));
         	$product = EHOVEL::model('Product')->skip_prematch()->where('id','=',$product_id)->find();
            if(!$product->loaded())
            {
                throw new Kohana_Exception(__('Invaild Request'));
            }
            $product_link = $product->get_url();
            if($_POST) {
            	$redirect = $this->request->query('redirect');
                $redirect = !empty($redirect) ? urldecode($redirect) : EHOVEL::url('site/email_friend?id='.$product_id);
                
            	$friend_email = $this->request->post('friend_email');
                $friend_name = $this->request->post('friend_name');
                $your_email = $this->request->post('your_email');
                $your_name = $this->request->post('your_name');
                $message = $this->request->post('message');
                
                $site_config = EHOVEL::config('site');
                $param = array(
                    '{friend_email}' => $friend_email,
                    '{friend_name}' => $friend_name,
                    '{your_email}' => $your_email,
                    '{your_name}' => $your_name,
                    '{message}' => $message,
                    '{product_view_link}' => 'http://'.$site_config['domain'].$product_link,
                	'{site_link}'=>'http://'.$site_config['domain'],
                );
                Mail::instance()->content('tell_friend',$param)->send($friend_email,$your_email);
                Mail::instance()->content('tell_me',$param)->send($your_email,$site_config['email']);
                Remind::factory(Remind::TYPE_SUCCESS)
                    ->message(__('Congratulations! Your email has been sent!'))
                    ->redirect($redirect)
                    ->send();
            } 
                $navigation[] = array('name' => 'Email Friend', 'href'=>'');
                $this->template = EHOVEL::view('email_friend',array(
                    'navigation' => $navigation,
                	'product_link' => $product_link
                ));
            
        } catch (Kohana_Exception $ex) {
            Remind::factory($ex)
            	->redirect(EHOVEL::url('index'))
                ->send();
        } 
    }
    /**
     * 文案内容页
     */
    public function action_doc()
    {
        try {
            $doc_id = intval($this->request->query('id'));
            $type = $this->request->query('type');
            $doc_model_record = EHOVEL::model('Cms_Model')->where("name","=", $type)->find();
            $doc_model = EHOVEL::model('CMS_Model')
                ->get_model($doc_model_record->id)
                ->where('cms_posts.id', '=', $doc_id)
                ->skip_prematch()
                ->find();

            $comments =$doc_model->comments->where('status','=','CHECKED')->find_all();
            if(!$doc_model->loaded()){
                Remind::factory(Remind::TYPE_ERROR)
                    ->message(__('Invalid Request!'))
                    ->redirect(EHOVEL::url('index'))
                    ->send();
            }
          	if($_POST) {
          		$new_comment= $doc_model->comments;
          		$new_comment->site_id = $doc_model->site_id;
          		$new_comment->column_id = $doc_model->column_id;
          		$new_comment->post_id = $doc_id;
          		$new_comment->title = '';
            	$new_comment->user_id = $this->request->post('user_id');
                $new_comment->content = trim($this->request->post('user_message'));
                $new_comment->date_upd = date('Y-m-d H:i:s');
                $new_comment->date_add  = date('Y-m-d H:i:s', time());
                
                $new_comment->save();
               	if($new_comment->saved()){
                Remind::factory(Remind::TYPE_SUCCESS)
                    ->message(__('Thank you for submitting your review.We will process your review and then post them!'))
                    ->redirect(url::current(true))
                    ->send();
               	}
            }
            $navigation[] = array('name'=>$this->request->query('type'),'href'=>'');
            $this->template = EHOVEL::view('doc_layout',array(
                'navigation' => $navigation,
                'doc_left' => EHOVEL::view('doc_left')->render(NULL,FALSE),
                //'doc_right'=> $doc_model->content,
                'doc_right'=> EHOVEL::view('doc_content',array(
                'type'=>$type,
                'doc'=>$doc_model,
            	'comments'=>$comments)
            	)->render(NULL,FALSE),
            ));
        } catch (Kohana_Exception $ex) {
            Remind::factory($ex)
                ->redirect(EHOVEL::url('index'))
                ->send();
        }
    }
	/**
     * 文案列表页
     */
    public function action_doc_list()
    {
        try {
            $type = $this->request->query('type');
            $doc_model_record = EHOVEL::model('Cms_Model')->where("name","=", $type)->find();
            $doc_model = EHOVEL::model('CMS_Model')
                ->get_model($doc_model_record->id)
                ->skip_prematch();
          	$clone_model = clone $doc_model;
            $total = $clone_model->count_all();
          	
            $pagination = Pagination::factory(array(
                'total_items' => $total,
                'items_per_page' => 10,
            ));
           	$docs = $doc_model
                ->offset($pagination->offset)
                ->limit($pagination->items_per_page)
                ->find_all();
           
           	$navigation[] = array('name'=>$this->request->query('type').' list','href'=>'');
           	$this->template = EHOVEL::view('doc_list',array(
                'navigation' => $navigation,
                'doc_left' => EHOVEL::view('doc_left')->render(NULL,FALSE),
                //'doc_right'=> $doc_model->content,
                'docs'=> $docs,
             	'type'=> $type,
            	'pagination'=>$pagination
            	));
        } catch (Kohana_Exception $ex) {
            Remind::factory($ex)
                ->redirect(EHOVEL::url('index'))
                ->send();
        }
    }
    /**
     * 文案分类页面
     */
    public function action_doc_category()
    {
        try {
            $category_id = intval($this->request->query('id'));
            $doc_category_model = EHOVEL::model('Cms_Category', $category_id);
            if(!$doc_category_model->loaded()){
                Remind::factory(Remind::TYPE_ERROR)
                    ->message(__('Invalid Request!'))
                    ->redirect(EHOVEL::url('index'))
                    ->send();
            }
            $doc_model = EHOVEL::model('CMS_Model', $doc_category_model->model_id)
                ->get_model()
                ->where('category_id', '=', $category_id);
            $total = $doc_model->count_all();
            $pagination = Pagination::factory(array(
                'total_items' => $total,
                'items_per_page' => 10,
            ));
            $docs = $doc_model
                ->offset($pagination->offset)
                ->limit($pagination->items_per_page)
                ->find_all();
            $navigation[] = array('name'=>$this->request->query('type'),'href'=>'');
            $this->template = EHOVEL::view('doc_layout',array(
                'navigation' => $navigation,
                'doc_left' => EHOVEL::view('doc_left')->render(NULL,FALSE),
                'doc_right'=> EHOVEL::view('doc_category', array(
                    'pagination' => $pagination,
                    'doc_category' => $doc_category_model,
                    'docs' => $docs,
                ))->render(NULL,FALSE),
            ));
        } catch (Kohana_Exception $ex) {
            Remind::factory($ex)
                ->redirect(EHOVEL::url('index'))
                ->send();
        }
    }
    /**
     * 联系我们控制器
     */
    public function action_contact_us()
    {
        try {
 //           'contus  发往  customerservice@aimer.com.cn
 //           wholesale 发往   wholesale@aimer.com.cn';
            if($_POST){
                $validate = Validation::factory($_POST)
                    ->rules('lastname', array(array('not_empty'),array('max_length', array(':value', 50))))
                    ->rules('email', array(array('not_empty'),array('email')))
                    ->rules('phone', array(array('max_length', array(':value', 20))))
                    ->rules('order_num', array(array('max_length', array(':value', 20))))
                    ->rules('message', array(array('not_empty'),array('max_length', array(':value', 1024))));
                if(!$validate->check()){
                    Remind::factory(Remind::TYPE_ERROR)
                        ->message(__('Information entered error,please re-enter!'))
                        ->redirect(url::current(true))
                        ->send();
                }
                $content = 'First Name: '.$this->request->post('firstname').'<br/>';
                $content .= 'Last Name: '.$this->request->post('lastname').'<br/>';
                $content .= 'Email Address: '.$this->request->post('email').'<br/>';
                $content .= 'Contact Number: '.$this->request->post('phone').'<br/>';
                if(!empty($_POST['order_num'])){
                    $content .= 'Order Number: '.$this->request->post('order_num').'<br/>';
                }
                $content .= 'Comments: '.$this->request->post('message');
                //记录
                $user_message = EHOVEL::model('user_message');
                $user_message->user_id = ($user = $this->user)?$user['id']:0;
                $user_message->email = $this->request->post('email');
                $user_message->title = $this->request->post('title');
                $user_message->content = $this->request->post('message');
                $user_message->save();
                //发送邮件
                $mail_service = Mail::instance();
                $mail_service->mail_title = 'Contact Us';
                $mail_service->mail_content = $content;
                Mail::instance()->send(EHOVEL::config('email'));
                Remind::factory(Remind::TYPE_SUCCESS)
                    ->message(__('We will contact you as soon as possible.'))
                    ->redirect(url::current(true))
                    ->send();
            }
            $navigation[] = array('name'=>'Contact Us','href'=>'');
            $this->template = EHOVEL::view('doc_layout',array(
                'navigation' => $navigation,
                'doc_left' => EHOVEL::view('doc_left')->render(NULL,FALSE),
                'doc_right'=> EHOVEL::view('contact_us')->render(NULL,FALSE),
            ));
        } catch (Kohana_Exception $ex) {
            Remind::factory($ex)
                ->redirect(EHOVEL::url('index'))
                ->send();
        }
    }
    /**
     * 联系我们控制器
     */
    public function action_wholesale()
    {
        try {
            if($_POST){
                $validate = Validation::factory($_POST)
                    ->rules('title', array(array('not_empty'),array('max_length', array(':value', 50))))
                    ->rules('firstname', array(array('not_empty'),array('max_length', array(':value', 50))))
                    ->rules('lastname', array(array('not_empty'),array('max_length', array(':value', 50))))
                    ->rules('email', array(array('not_empty'),array('email')))
                    ->rules('phone', array(array('not_empty'),array('max_length', array(':value', 20))))
                    ->rules('message', array(array('not_empty'),array('max_length', array(':value', 1024))));
                if(!$validate->check()){
                    Remind::factory(Remind::TYPE_ERROR)
                        ->message(__('Information entered error,please re-enter!'))
                        ->redirect(url::current(true))
                        ->send();
                }
                $content = 'Title: '.$this->request->post('title').'<br/>';
                $content .= 'First Name: '.$this->request->post('firstname').'<br/>';
                $content .= 'Last Name: '.$this->request->post('lastname').'<br/>';
                $content .= 'Email Address: '.$this->request->post('email').'<br/>';
                $content .= 'Telephone: '.$this->request->post('phone').'<br/>';
                $content .= 'Message: '.$this->request->post('message');
                //发送邮件
                $mail_service = Mail::instance();
                $mail_service->mail_title = 'Contact Us';
                $mail_service->mail_content = $content;
                Mail::instance()->send('wholesale@aimer.com.cn');
                Remind::factory(Remind::TYPE_SUCCESS)
                    ->message(__('We will contact you as soon as possible.'))
                    ->redirect(url::current(true))
                    ->send();
            }
            $navigation[] = array('name'=>'Wholesale','href'=>'');
            $this->template = EHOVEL::view('doc_layout',array(
                'navigation' => $navigation,
                'doc_left' => EHOVEL::view('doc_left')->render(NULL,FALSE),
                'doc_right'=> EHOVEL::view('wholesale')->render(NULL,FALSE),
            ));
        } catch (Kohana_Exception $ex) {
            Remind::factory($ex)
                ->redirect(EHOVEL::url('index'))
                ->send();
        }
    }
    
    public function action_faq(){
    	try {
            $faq_model = EHOVEL::model('Site_Faq');
            $faq_category_model = EHOVEL::model('Site_Faq_Category');
            $keywords = $this->request->query('keywords');
            $category_id = $this->request->query('category');
            if($_POST){
            	//令牌验证
            	$token = $this->request->post('csrf_token');
	            if(empty($token) || !EHOVEL::helper('formtoken')->is_token($token)){
	                Remind::factory(Remind::TYPE_ERROR)
                        ->message(__('Information entered error,please re-enter!'))
                        ->redirect(url::current(true))
                        ->send();
	            }
                $user = !empty($this->user)?$this->user:'';
                if (empty($user)){
	                $validate = Validation::factory($_POST)
	                    ->rules('user_message', array(array('not_empty'),array('max_length', array(':value', 1024))))
	                    ->rules('user_email', array(array('not_empty'),array('max_length', array(':value', 255))));
	                if(!$validate->check()){
	                    Remind::factory(Remind::TYPE_ERROR)
	                        ->message(__('Information entered error,please re-enter!'))
	                        ->redirect(url::current(true))
	                        ->send();
	                }
                }
                $title = $this->request->post('title');
                $content = $this->request->post('user_message');
                $first_name = $this->request->post('firstname');
                $last_name = $this->request->post('last_name');
                $user_email = $this->request->post('user_email');
                $category_id = $this->request->post('category');
                $faq_model->title = $title?$title:substr($content, 0,20);
                $faq_model->content = $content;
                $faq_model->user_id = !empty($user)?$user['id']:0;
                $faq_model->user_name = !empty($user)?$user['firstname'].' '.$user['lastname']:$first_name.' '.$last_name;
                $faq_model->user_email = !empty($user)?$user['email']:$user_email;
                $faq_model->category_id = $category_id?$category_id:0;
                $faq_model->save();
                
                Remind::factory(Remind::TYPE_SUCCESS)
	                ->message(__('We will reply to you as soon as possible.'))
	                ->redirect(url::current(true))
	                ->send();
            }
            
            if ($keywords){
            	$faq_model = $faq_model->or_where_open() -> where('title','like','%'.$keywords.'%')->or_where('reply','like','%'.$keywords.'%')->or_where('content','like','%'.$keywords.'%')->or_where_close();
            }
            if ($category_id>0 && is_numeric($category_id)){
            	$faq_model = $faq_model->where('category_id','=',$category_id);
            }
            
            $faq_model = $faq_model->where('status','=','CHECKED');
            $clone_faq_model = clone $faq_model;
            $total = $faq_model->count_all();
            $pagination = Pagination::factory(array(
                'total_items' => $total,
                'items_per_page' => 12,
            ));
            $faqs = $clone_faq_model
            	->where('status','=','CHECKED')
                ->offset($pagination->offset)
                ->limit($pagination->items_per_page)
                ->find_all();
            $faq_categories = $faq_category_model -> find_all();
            
            $navigation[] = array('name'=>'FAQ','href'=>'');
            
            $this->template = EHOVEL::view('doc_layout',array(
                'navigation' => $navigation,
                'doc_left' => EHOVEL::view('doc_left')->render(NULL,FALSE),
                'doc_right'=> EHOVEL::view('faq',array(
            			'pagination' => $pagination,
	                    'faq_categories' => $faq_categories,
	                    'faqs' => $faqs,
            			'keywords'=>$keywords,
            		))->render(NULL,FALSE),
            	));
        } catch (Kohana_Exception $ex) {
            Remind::factory($ex)
                ->redirect(EHOVEL::url('index'))
                ->send();
        }
    }
    
	public function action_tecfaq(){
    	try {
            $faq_model = EHOVEL::model('Site_Tecfaq');
            $faq_category_model = EHOVEL::model('Site_Tecfaq_Category');
            $keywords = $this->request->query('keywords');
            $category_id = $this->request->query('category');
            $type = $this->request->query('type');
            $id = $this->request->query('id');
            
            if ($keywords){
            	$faq_model = $faq_model->or_where_open() -> where('title','like','%'.$keywords.'%')->or_where('reply','like','%'.$keywords.'%')->or_where('content','like','%'.$keywords.'%')->or_where_close();
            }
            if ($category_id>0 && is_numeric($category_id)){
            	$faq_model = $faq_model->where('category_id','=',$category_id);
            }
            $faq_categories = $faq_category_model -> find_all();
	            
	        $navigation[] = array('name'=>$this->request->query('type'),'href'=>'');
	            
	        $navigation[] = array('name'=>'Faq','href'=>'');
            if ($type=='ask'){//提问页
            	if (empty($this->user)){
            			Remind::factory(Remind::TYPE_ERROR)
	            			->message(__('Welcome, Please login!'))
		                    ->redirect(EHOVEL::url('user/login',array('redirect'=>URL::current(true))))
		                    ->send();
            	}
	            if($_POST){
	            	//令牌验证
	            	$token = $this->request->post('csrf_token');
		            if(empty($token) || !EHOVEL::helper('formtoken')->is_token($token)){
		                Remind::factory(Remind::TYPE_ERROR)
	                        ->message(__('Information entered error,please re-enter!'))
	                        ->redirect(url::current(true))
	                        ->send();
		            }
	                $user = !empty($this->user)?$this->user:'';
	                if (empty($user)){
		                if(!$validate->check()){
		                    Remind::factory(Remind::TYPE_ERROR)
		                        ->message(__('Please login first!'))
		                        ->redirect(url::current(true))
		                        ->send();
		                }
	                }
	                $title = $this->request->post('title');
	                $content = $this->request->post('user_message');
	                $first_name = $this->request->post('firstname');
	                $last_name = $this->request->post('last_name');
	                $user_email = $this->request->post('user_email');
	                $category_id = $this->request->post('category');
	                $faq_model->title = $title?$title:substr($content, 0,20);
	                $faq_model->content = $content;
	                $faq_model->user_id = !empty($user)?$user['id']:0;
	                $faq_model->user_name = !empty($user)?$user['firstname'].' '.$user['lastname']:$first_name.' '.$last_name;
	                $faq_model->user_email = !empty($user)?$user['email']:$user_email;
	                $faq_model->category_id = $category_id?$category_id:0;
	                $faq_model->save();
	                
	                Remind::factory(Remind::TYPE_SUCCESS)
		                ->message(__('We will reply to you as soon as possible.'))
		                ->redirect(url::current(true))
		                ->send();
	            }
            	$this->template = EHOVEL::view('doc_layout',array(
	            	'navigation' => $navigation,
	                'doc_left' => EHOVEL::view('doc_left')->render(NULL,FALSE),
	                'doc_right'=> EHOVEL::view('tecfaq_ask',array(
		                    'faq_categories' => $faq_categories,
	            		))->render(NULL,FALSE),
	            	));
            }elseif ($id>0 && is_numeric($id)){//详细页
            	$faq_model = $faq_model->where('id','=',$id);
            	$faq_model = $faq_model->where('status','=','CHECKED');
            	$faq = $faq_model->find();
            	$comments = $faq->comment;
            	if ($_POST){
            		if (empty($this->user)){
            			Remind::factory(Remind::TYPE_ERROR)
	            			->message(__('Welcome, Please login!'))
		                    ->redirect(EHOVEL::url('user/login',array('redirect'=>URL::current(true))))
		                    ->send();
            		}
            		$new_comment = EHOVEL::model('site_tecfaq_comment');
            		$new_comment->user_id = $this->user['id'];
            		$new_comment->tecfaq_id = $id;
            		$new_comment->content = trim($this->request->post('content'));
            		$new_comment->save();
	                Remind::factory(Remind::TYPE_SUCCESS)
		                ->message(__('We will check your answer as soon as possible.'))
		                ->redirect(url::current(true))
		                ->send();
            	}
            	$total = $comments->where('status','=','CHECKED')->count_all();
	            $pagination = Pagination::factory(array(
	                'total_items' => $total,
	                'items_per_page' => 12,
	            ));
                $comments = $faq->comment
                	->where('status','=','CHECKED')
	                ->offset($pagination->offset)
	                ->limit($pagination->items_per_page)
	                ->find_all();
            	$this->template = EHOVEL::view('doc_layout',array(
	                'navigation' => $navigation,
	                'doc_left' => EHOVEL::view('doc_left')->render(NULL,FALSE),
	                'doc_right'=> EHOVEL::view('tecfaq_detail',array(
	            			'pagination' => $pagination,
		                    'faq_categories' => $faq_categories,
		                    'faq' => $faq,
            				'comments'=>$comments,
	            		))->render(NULL,FALSE),
	            	));
            }else{//列表页
	            $faq_model = $faq_model->where('status','=','CHECKED');
	            $total = $faq_model->count_all();
	            $pagination = Pagination::factory(array(
	                'total_items' => $total,
	                'items_per_page' => 12,
	            ));
	    		if ($keywords){
	            	$faq_model = $faq_model->or_where_open() -> where('title','like','%'.$keywords.'%')->or_where('reply','like','%'.$keywords.'%')->or_where('content','like','%'.$keywords.'%')->or_where_close();
	            }
	            $faqs = $faq_model
	            	->where('status','=','CHECKED')
	                ->offset($pagination->offset)
	                ->limit($pagination->items_per_page)
	                ->find_all();
	            $this->template = EHOVEL::view('doc_layout',array(
	                'navigation' => $navigation,
	                'doc_left' => EHOVEL::view('doc_left')->render(NULL,FALSE),
	                'doc_right'=> EHOVEL::view('tecfaq',array(
	            			'pagination' => $pagination,
		                    'faq_categories' => $faq_categories,
		                    'faqs' => $faqs,
            				'keywords'=>$keywords,
	            		))->render(NULL,FALSE),
	            	));
            }
        } catch (Kohana_Exception $ex) {
            Remind::factory($ex)
                ->redirect(EHOVEL::url('index'))
                ->send();
        }
    }
    
	/**
     * sitemap
     */
    public function action_sitemap()
    {
        header('Content-Type: text/xml; charset=UTF-8'); 
        $sitemap_config = EHOVEL::model('Site_Sitemap_log')->find();
        $sitemap = $sitemap_config->content;
        if(!empty($sitemap)){
            echo $sitemap;
            die();
        }else{
            url::redirect('error404');
        }
    }
    
    /**
     * 设置排版
     */
    public function action_set_composition(){
    	$type = $this->request->query('type');
    	if ($type==1){
    		Session::instance()->set('list_composition','1');
    	}else{
    		Session::instance()->delete('list_composition');
    	}
    	Session::instance()->set('no-cache','1');
    	$this->request->redirect(URL::referrer());
    }
    
    /**
     * about us
     */
    
	public function action_aboutus()
    {
        try {
           	$aboutus = '';
            $site_config = EHOVEL::model ( 'Site_Config' );
            $item = $site_config->getc ( 'aboutus' );
            $image = $site_config->getc ('aboutus_img');
         	if ($item) 
                {
                    $aboutus = $item;
                }else{
                	 Remind::factory(Remind::TYPE_ERROR)
                    ->message(__('Invalid Request!'))
                    ->redirect(EHOVEL::url('index'))
                    ->send();
                }
            
            $navigation[] = array('name'=>'About Us','href'=>'');
            $this->template = EHOVEL::view('doc_layout',array(
                'navigation' => $navigation,
                'doc_left' => EHOVEL::view('doc_left')->render(NULL,FALSE),
                //'doc_right'=> $doc_model->content,
                'doc_right'=> EHOVEL::view('about_us',array(
                'about_us'=>$aboutus)
            	)->render(NULL,FALSE),
            ));
        } catch (Kohana_Exception $ex) {
            Remind::factory($ex)
                ->redirect(EHOVEL::url('index'))
                ->send();
        }
    }
    /**
     * 站点转换
     */
	public function action_set_transfer()
    {
        try {
            if($this->request->query('site')){
                $site = EHOVEL::model('Site', $this->request->query('site'));
                if($site->loaded()){
                    if(!empty($_SERVER['HTTP_HOST'])){
                        $url_array = parse_url($_SERVER['HTTP_HOST']);
                    }
                    $domain = rtrim($site->domain,'/').(!empty($url_array['port']) ? ':'.$url_array['port']:'');
                    if(!empty($this->user)){
                        $key = EHOVEL::helper('site')->set_transfer($this->user['id']);
                        $this->request->redirect('http://'.$domain.EHOVEL::url('site/transfer', array('key'=>$key)));
                    }else{
                        $this->request->redirect('http://'.$domain);
                    }
                }
            }
            $this->request->redirect(URL::referrer());
        } catch (Kohana_Exception $ex) {
            Remind::factory($ex)
                ->redirect(EHOVEL::url('index'))
                ->send();
        }
    }
    public function action_transfer()
    {
        try {
            if(empty($this->user)){
                EHOVEL::helper('site')->transfer($this->request->query('key'));
            }
            $site = EHOVEL::model('Site',$this->site_id);
            $this->request->redirect(EHOVEL::url('index'));
        } catch (Kohana_Exception $ex) {
            Remind::factory($ex)
                ->redirect(EHOVEL::url('index'))
                ->send();
        }
    }
}
