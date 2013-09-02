<?php
defined ( 'SYSPATH' ) or die ( 'No direct script access.' );
/**
 * 币种控制器
 *
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package Site
 * @category  Controller  
 * @since 2011-11-25
 * @author dongxiaoyu
 * @version   $Id$
 */
I18n::package ( 'site' );
class Controller_Admin_Site_Currency extends Controller_Admin_Base_Site 
{
    /**
     * 当前控制器对应的主模型(表名)
     * @var string
     */
    protected $_model = 'Site_Currency';
    /**
     * 存储
     * @var string
     */
    protected $_store = 'site_link';
    
    /**
     * 当前币种列表
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
            $currencies = EHOVEL::model ( $this->_model )->order_by ( 'id', 'DESC' )->find_all ();
            $this->template = EHOVEL::view ( 'site/currency/index', array ('currencies' => $currencies ) );
        } catch ( Kohana_Exception $ex ) {
           Remind::factory($ex)
                ->send();
        }
    }
    
    /**
     * 添加币种
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
            $currency = EHOVEL::model ( $this->_model );
            if ($_POST) 
            {
                $cur_name = $this->request->post ( 'cur_name' );
                $cur_code = $this->request->post ( 'cur_code' );
                $cur_rate = $this->request->post ( 'cur_rate' );
                $image    = trim($this->request->post('image'));
                if ($cur_rate < 0) 
                {
                    Remind::factory ( Remind::TYPE_ERROR )
                            ->message ( __ ('The rate must be positive.' ) )
                            ->redirect ( EHOVEL::url ( 'site_currency/add' ) )
                            ->send ();
                }
                
                if (empty ( $cur_name ) || EHOVEL::model ( $this->_model )->name_exist ( $cur_name )) 
                {
                    Remind::factory ( Remind::TYPE_ERROR )
                            ->message ( __ ('Name cannot be repeated.' ) )
                            ->redirect ( EHOVEL::url ( 'site_currency/index' ) )
                            ->send ();
                }
                
                if (empty ( $cur_code ) || EHOVEL::model ( $this->_model )->code_exist ( $cur_code )) 
                {
                    Remind::factory ( Remind::TYPE_ERROR )
                            ->message ( __ ('Code exist.' ) )
                            ->redirect ( EHOVEL::url ( 'site_currency/add' ) )
                            ->send ();
                
                }
                
                $is_default = $this->request->post ( 'is_default' );
                //保存数据
                $currency = EHOVEL::model ( $this->_model );
                //如果当前无币种的话则自动默认
                $currency_count = EHOVEL::model ( $this->_model )->count_all ();
                if ($currency_count <= 0) 
                {
                    $_POST ['is_default'] = 'Y';
                } 
                else 
                {
                    //如果当前已经有默认币种，要把原来的默认设定为非默认
                    if ($is_default == 'Y') {
                        $current_default_currency = EHOVEL::model ( $this->_model )->where ( 'is_default', '=', 'Y' )->find ();
                        if ($current_default_currency->loaded ()) 
                        {
                            $current_default_currency->is_default = 'N';
                            $current_default_currency->save ();
                        }
                    }
                }
                //默认币种的汇率只能为1
                if (! empty ( $_POST ['is_default'] ) && ($_POST ['is_default'] == 'Y')) 
                {
                    $_POST ['cur_rate'] = 1;
                }
                $currency->values ( $_POST );
                $currency->save ( $currency->validation () );
                Remind::factory ( Remind::TYPE_SUCCESS )
                        ->message ( __ ( 'Added Successfully' ) )
                        ->redirect ( EHOVEL::url ( 'site_currency' ) )
                        ->send ();
            }
            //获取币种CODE的列表
            $cur_codes = EHOVEL::config ( 'site_currency.code' );
            $cur_currenies = EHOVEL::model ( $this->_model )->find_all ();
            foreach ( $cur_currenies as $key => $item ) 
            {
                if (isset ( $cur_codes [$item->cur_code] )) 
                {
                    unset ( $cur_codes [$item->cur_code] );
                }
            }
            if (count ( $cur_codes ) <= 0) 
            {
                Remind::factory ( Remind::TYPE_ERROR )
                        ->message ( __ ('Currently no available currency to add, please check whether all the currency to add.' ) )
                        ->redirect ( EHOVEL::url ( 'site_currency' ) )
                        ->send ();
            }
            $current_default_currency = EHOVEL::model ( $this->_model )->where ( 'is_default', '=', 'Y' )->find();
            $this->template = EHOVEL::view ( 'site/currency/add', array ('cur_codes' => $cur_codes,
                                                                'currency' => $currency,
            													'default_currency'=> $current_default_currency,
                                                            ) );
        } catch ( Kohana_Exception $ex ) {
            Remind::factory($ex)
                ->send();
        } catch ( ORM_Validation_Exception $e ) {
            //数据验证错误处理
            Remind::factory ( Remind::TYPE_ERROR )
                    ->message ( __ ('Currently no available currency to add, please check whether all the currency to add.' ) )
                    ->redirect ( EHOVEL::url ( 'site_currency/add' ) )
                    ->send ();
        }
    }
    
    /**
     * 编辑
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
        try {
            $id = intval ( $this->request->query ( 'id' ) );
            if ($id <= 0) 
            {
                throw new Kohana_Exception ( __ ( 'Invalid Request' ), 10000 );
            }
            $currency = EHOVEL::model ( $this->_model, $id );
            if ($currency->loaded ()) 
            {
                if ($_POST) 
                {
                    $cur_rate = $this->request->post ( 'cur_rate' );
                    $cur_name = $this->request->post ( 'cur_name' );
                    $image    = trim($this->request->post('image'));
                    
                    if (empty ( $cur_name ) || $currency->name_exist ( $cur_name )) 
                    {
                        Remind::factory ( Remind::TYPE_ERROR )
                                ->message ( __ ('Name cannot be repeated' ) )
                                ->redirect ( EHOVEL::url ( 'site_currency/edit',array('id' => $id) ) )
                                ->send ();
                    }
                    if ($cur_rate < 0) 
                    {
                        Remind::factory ( Remind::TYPE_ERROR )
                                ->message ( __ ('The rate must be positive.' ) )
                                ->redirect ( EHOVEL::url ( 'site_currency/edit',array('id' => $id) ) )
                                ->send ();
                    }
                    
                    $is_default = $this->request->post ( 'is_default' );
                    if ($currency->is_default != $is_default) 
                    {
                        if ($is_default == 'Y') {
                            $current_default_currency = EHOVEL::model ( $this->_model )->where ( 'is_default', '=', 'Y' )->find ();
                            if ($current_default_currency->loaded ()) {
                                $current_default_currency->is_default = 'N';
                                $current_default_currency->save ();
                            }
                        } 
                        else 
                        {
                            $current_default_currency_count = EHOVEL::model ( $this->_model )->where ( 'is_default', '=', 'Y' )->where ( 'id', '<>', $currency->id )->count_all ();
                            if ($current_default_currency_count <= 0) 
                            {
                                Remind::factory ( Remind::TYPE_ERROR )
                                        ->message ( __ ('Keep one for the default currency.' ) )
                                        ->redirect ( EHOVEL::url ( 'site_currency/edit',array('id' => $id) ) )
                                        ->send ();
                            }
                        }
                    }
                    
                    //默认币种的汇率只能为1
                    if (! empty ( $_POST ['is_default'] ) && ($_POST ['is_default'] == 'Y')) 
                    {
                        $_POST ['cur_rate'] = 1;
                    }
                    
                    $currency->values ( $_POST );
                    
                    $currency->save ( $currency->validation () );
                    Remind::factory ( Remind::TYPE_SUCCESS )
                            ->message ( __ ( 'Edited Successfully!' ) )
                            ->redirect ( EHOVEL::url ( 'site_currency' ) )
                            ->send ();
                }
                //获取币种CODE的列表
                $cur_codes = EHOVEL::config ( 'site_currency.code' );
                $cur_currenies = EHOVEL::model ( $this->_model )->where ( 'id', '<>', $id )->find_all ();
                foreach ( $cur_currenies as $key => $item ) 
                {
                    if (isset ( $cur_codes [$item->cur_code] )) 
                    {
                        unset ( $cur_codes [$item->cur_code] );
                    }
                }
                $this->template = EHOVEL::view ( 'site/currency/edit', array ('data' => $currency, 'cur_codes' => $cur_codes, 'id' => $id ) );
            } 
            else 
            {
                Remind::factory ( Remind::TYPE_ERROR )
                        ->message ( __ ('Loading failed, try again' ) )
                        ->redirect ( EHOVEL::url ( 'site_currency/edit',array('id' => $id) ) )
                        ->send ();
            }
        } catch ( Kohana_Exception $ex ) {
            Remind::factory($ex)
                ->redirect(EHOVEL::url('site_currency/edit' , array('id' => $id)))
                ->send();
        } catch ( ORM_Validation_Exception $e ) {
            Remind::factory ( Remind::TYPE_ERROR )
                    ->message ( $currency->validation ()->errors () )
                    ->redirect ( EHOVEL::url ( 'site_currency/edit',array('id' => $id) ) )
                    ->send ();
        }
    }
    
    /**
     * 删除
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
            $id = intval ( $this->request->query ( 'id' ) );
            
            if (empty ( $id )) 
            {
                throw new Kohana_Exception ( __ ( 'Invalid Request' ), 10000 );
            }
            
            $currency = EHOVEL::model ( $this->_model, intval ( $id ) );
            if (! $currency->loaded ()) 
            {
                Remind::factory ( Remind::TYPE_ERROR )
                        ->message ( __ ('Loading failed, try again' ) )
                        ->redirect ( EHOVEL::url ( 'site_currency' ) )
                        ->send ();
            } 
            else 
            {
                if ($currency->is_default == 'Y') 
                {
                    Remind::factory ( Remind::TYPE_ERROR )
                            ->message ( __ ('The default currency can not be deleted!' ) )
                            ->redirect ( EHOVEL::url ( 'site_currency' ) )
                            ->send ();
                }
                
                $currency->disable ();
                $return_struct ['status'] = 1;
                Remind::factory ( Remind::TYPE_SUCCESS )
                        ->message ( __ ( 'Deleted Successfully!' ) )
                        ->redirect ( EHOVEL::url ( 'site_currency' ) )
                        ->send ();
            }
        } catch ( Kohana_Exception $ex ) {
            Remind::factory($ex)
                ->send();
        }
    }
    /**
     * AJAX取得汇率
     * @return mixed
     */
    public function action_get_rate() {
        // 初始化返回结构体
        $return_struct = array(
            'status' => 0,
            'code' => 501,
            'msg' => 'Not Implemented',
            'content' => array(),
        );
        try {
        		$ch = curl_init();
				// 设置URL和相应的选项
				$default_currency = EHOVEL::model('Site_Currency')->get_default();
				$default_currency_code = $default_currency->loaded() ? $default_currency->cur_code : 'USD';
				$url = 'http://www.google.com/ig/calculator?hl=en&q=1'.$this->request->query('code').'=?'.$default_currency_code;
				ob_start();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_HEADER, 'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8');
				// 抓取URL并把它传递给浏览器
				curl_exec($ch);
				curl_close($ch);
				$result = ob_get_clean();
				ob_end_clean();
				$result = explode(',',$result);
				$result = explode(':',$result[1]);
				$result = trim($result[1]);
				exit($result);
            } catch ( Kohana_Exception $ex ) {
            Remind::factory($ex)
                ->send();
        }
    }
    
    /**
     * AJAX判断名称是否重复
     * @return mixed
     */
    public function action_name_exist() {
        // 初始化返回结构体
        $return_struct = array(
            'status' => 0,
            'code' => 501,
            'msg' => 'Not Implemented',
            'content' => array(),
        );
        try {
            $name = $this->request->query ( 'cur_name' );
            $id = intval ( $this->request->query ( 'id' ) );
            if (empty ( $name )) 
            {
                throw new Kohana_Exception ( __ ( 'Request error, try again' ), 500 );
            }
            if ($this->request->is_ajax ()) {
                //如果是编辑刚判断重重复不能加本身进行判断
                if ($id > 0) 
                {
                    $result = EHOVEL::model ( $this->_model, $id )->name_exist ( $name );
                } 
                else 
                {
                    $result = EHOVEL::model ( $this->_model )->name_exist ( $name );
                }
                if ($result) 
                {
                    exit ( 'false' );
                } 
                else 
                {
                    exit ( 'true' );
                }
            } 
            else 
            {
                throw new Kohana_Exception ( __ ( 'Request error, try again' ), 500 );
            }
        } catch ( Kohana_Exception $ex ) {
            Remind::factory($ex)
                ->send();
        }
    }
}