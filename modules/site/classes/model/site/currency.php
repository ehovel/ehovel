<?php defined('SYSPATH') or die('No direct script access.');
/**
 * 币种模型
 *
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package Site
 * @category  Model  
 * @since 2011-11-25
 * @author dongxiaoyu
 * @version   $Id$
 */
class Model_Site_Currency extends ORM_Site
{

    /**
     * 软删除字段的名字
     *
     * @var string
     */
    protected $_disabled_column = 'disabled';

    //过滤函数
    protected $_filters = array(TRUE => array('trim' => NULL));

    /**
     * 验证规则
     * @return array
     */
    public function rules()
    {
        return array(
            'cur_code' => array(
                array('not_empty'),
                array('min_length', array(':value', 1)),
                array('max_length', array(':value', 8))
            ),
            'cur_name' => array(
                array('not_empty'),
                array('min_length', array(':value', 1)),
                array('max_length', array(':value', 20)),
            ),
            'cur_sign' => array(
                array('not_empty'),
                array('min_length', array(':value', 1)),
                array('max_length', array(':value', 5)),
            ),
            'cur_rate' => array(
                array('not_empty'),
                array('numeric')
            )
        );
    }

    /**
     * 获取当前网站的默认币种
     * @return
     */
    public function get_default()
    {
        $currency = EHOVEL::model($this->_object_name)->where('is_default', '=', 'Y')->find();
        if ($currency->loaded()) {
            return $currency;
        } else {
            //如果无默认币种则自动随机设定一个
            $currencies = EHOVEL::model($this->_object_name)->find();
            if($currencies->loaded())
            {
                $currencies->is_default = 'Y';
                $currencies->cur_rate = '1';
                $currencies->save();
            } else {
                return $this->_init_currency();
            }
        }
        return false;
    }

    /**
     * 设置前台当前的币种
     * @author 朱彬
     * @param Model_Site_Currency $currency
     * @return void
     */
    public function set_current_currency(Model_Site_Currency $currency)
    {
        Session::instance()->set('currency', $currency);
    }
    /**
     * 取得前台当前的币种
     * @author 朱彬
     * @return Model_Site_Currency
     */
    public function get_current_currency()
    {
        $currency = Session::instance()->get('currency');
        if(!($currency instanceof ORM) || !$currency->loaded()){
            $currency = EHOVEL::model('Site_Currency')->get_default();
        }
        return $currency;
    }

    /**
     * 判断名称是否重复
     *
     * @param string $name
     * @return boolean
     * <pre>
     *     true:存在
     *     false:不存在
     * </pre>
     */
    public function name_exist($name = '')
    {
        if ($this->loaded()) {
            $admin = EHOVEL::model($this->_object_name)->where('cur_name', '=', $name)
                    ->where('id', '<>', $this->id)
                    ->find();
            if ($admin->loaded()) {
                return true;
            }
        } else {
            EHOVEL::model($this->_object_name)->where('cur_name', '=', $name)->find();
            if ($this->loaded()) {
                return true;
            }
        }
        return false;
    }

    /**
     * 判断Code是否重复
     *
     * @param string $code
     * @return boolean
     * <pre>
     *     true:存在
     *     false:不存在
     * </pre>
     */
    public function code_exist($code = '')
    {
        if ($this->loaded()) {
            $admin = EHOVEL::model($this->_object_name)->where('cur_code', '=', $code)
                    ->where('id', '<>', $this->id)
                    ->find();
            if ($admin->loaded()) {
                return true;
            }
        } else {
            EHOVEL::model($this->_object_name)->where('cur_code', '=', $code)->find();
            if ($this->loaded()) {
                return true;
            }
        }
        return false;
    }

    /**
     * 获取当前币种
     * @access public
     * @return obj || boolean
     * @throws Kohana_Exception
     * @author fanchongyuan
     * @example 
     */
    public function get_current()
    {
        $session_data = Session::instance()->get('currency');
        if(!empty($session_data))
        {
            $currency = EHOVEL::model('Site_Currency',$session_data->id);
            if ($currency->loaded()) {
                return $currency;
            }
        }
        return $this->get_default();
    }
    /**
     * 获取所有币种的集合 
     * @access public
     * @return object || boolean
     * @throws Kohana_Exception
     * @author Lorry Chan
     */
    public function get_all()
    {
        $result = EHOVEL::model('Site_Currency')->find_all();
        $return = array();
        foreach($result as $value){
            $return[] = $value->as_array();
        }
        return $return;
    }

    /**
     * 初始化币种，即自动添加一个默认币种
     * @return ORM
     */
    private  function _init_currency(){
        $currency = EHOVEL::model($this->_object_name);
        $currency->cur_code = 'USD';
        $currency->cur_name = 'USD';
        $currency->cur_sign = 'USD';
        $currency->cur_rate = '1.00';
        $currency->is_default = 'Y';
        $currency->save();
        return $currency;
    }

    /**
     * 价格切换接口
     * @access public
     * @param number $price
     * @param string $from_currency_code  留空时，默认为基准币种代码
     * @param string $to_currency_code    留空时，默认为当前币种代码
     * @return number
     * @throws Kohana_Exception
     * @author fanchongyuan
     * @example 
     */
    public function get_price($price, $from_currency_code = NULL, $to_currency_code = NULL)
    {
        // 获取转换前币种汇率
        $from_rate = 0;
        if(empty($from_currency_code))
        {
            $from_currency = $this->get_default();
        } else {
            $from_currency = EHOVEL::model('Site_Currency')->where('cur_code','=',$from_currency_code)->find();
        }
        if(!empty($from_currency))
        {
            $from_rate = $from_currency->cur_rate;
        }
        
        // 获取转换后币种汇率和小数点位数
        $to_rate     = 0;
        $to_decimals = 2;
        if(empty($to_currency_code))
        {
            $to_currency = $this->get_current();
        } else {
            $to_currency = EHOVEL::model($this->_object_name)->where('cur_code','=',$to_currency_code)->find();
        }
        if(!empty($to_currency))
        {
            $to_rate = $to_currency->cur_rate;
        }
        
        return $this->get_price_by_rate($price, $from_rate, $to_rate, $to_decimals);
    }
    
    /** 
     * 根据汇率计算价格
     * @access public
     * @param number $price
     * @param number $from_rate
     * @param number $to_rate
     * @param integer $to_decimals  转换后小数位数
     * @return number
     * @throws Kohana_Exception
     * @author fanchongyuan
     * @example 
     */
    public function get_price_by_rate($price, $from_rate, $to_rate, $to_decimals = 2)
    {
        $to_decimals = intval($to_decimals);
        
        // 计算价格，当转换前汇率与转换后汇率有任何一个为 0 时，不进行计算
        if($from_rate > 0 && $to_rate > 0)
        {
            $price = $price * ($from_rate / $to_rate);
            $price = round($price, $to_decimals);
        }
        
        return number_format($price, $to_decimals, '.', '');
    }
    public function get_sign_from_code($code = 'USD'){
        EHOVEL::model($this->_object_name)->where('cur_code','=',$code)->find();
        if($this->loaded()){
            return $this->cur_sign;
        }else{
            return EHOVEL::config('site_currency.unknown_currency');
        }
    }
}
