<?php defined('SYSPATH') or die('No direct script access.');
// $Id$
/**
 * 订单促销模型
 *
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package Product
 * @category Model
 * @since 2011-12-05 下午2:38
 * @author dongxiaoyu
 * @version   $Id$
 */
class Model_Site_Sale_Order extends ORM
{
	/* 指定软删除字段 */
    protected $_disabled_key = 'disabled';
    
	public function rules(){
        return array(
        	'title' => array(
                array('not_empty'),
                array('min_length', array(':value', 1)),
                array('max_length', array(':value', 255)),
            ),
            'description' => array(
                array('min_length', array(':value', 1)),
                array('max_length', array(':value', 65535)),
            )
        );
    }
    
     /**
     * 根据提交的数据和模板得到存储格式的条件数据
     * 
     * @access public
     * @param array $request_data 数组
     * @param array $scheme 模板
     * @return array
     * @author dongxiaoyu
     * @example 
     */
    public function handle_conditions($request_data, $scheme)
    {
    	$condition_struct = array(
            'set' => 'all', 
            'set_value' => 1, 
            'conditions' => array()
        );
        
        //由页面隐藏域设置的条件得到需要解析的条件
        if(isset($request_data['condition']) && !empty($request_data['condition']))
        {
            foreach($request_data['condition'] as $condition)
            {
                $operator = array();
                $values = array();
                $used_data = array();

                //考虑全场条件freetotalorders情况，页面上的condition定义为cartquantity
                if(!in_array($condition, $scheme['conditions']) && !in_array($condition, array('orderquantity')))
                {
                	throw new Kohana_Exception(__('Loading failed, try again'), 500);
                }
                
                switch($condition)
                {
                    case 'orderprice':
                    //价格区间
                    if(isset($request_data[$condition]) && isset($request_data[$condition]))
                    {
                        //$key是大于，小于等运算符
                        foreach($request_data[$condition] as $key=>$value)
                        {
                            if(!preg_match('/^\d{1,12}(\.\d{0,2})?$/',$value) || $value <0)
                            {
                            	throw new Kohana_Exception(__('Buy money error'), 500);
                            }
    
                            //比较提交的数据的大小
                            if(!isset($used_data[$condition]))
                            {
                                $used_data[$condition] = $value;
                            }
                            else
                            {
                                if($value <= $used_data[$condition] || $value == 0)
                                {
                                	throw new Kohana_Exception(__('Buy money error'), 500);
                                }
                            }
                            $operator[$key] = $key;
                            $values[$key] = sprintf('%.2f', $value);
                        }
                        $condition_struct['conditions'][] = array(
                            'condition' => $condition, 
                            'operator' => $operator,
                            'value' => $values
                        );
                    }
                    break;
                    case 'orderquantity':
                    if(isset($request_data[$condition]) && isset($request_data[$condition]))
                    {
                        //$key是大于，小于等运算符
                        foreach($request_data[$condition] as $key=>$value)
                        {
                            if(!preg_match('/^\d+$/',$value) || $value <0)
                            {
                            	throw new Kohana_Exception(__('Quantity set illegal'), 500);
                            }
    
                            //比较提交的数据的大小
                            if(!isset($used_data[$condition]))
                            {
                                $used_data[$condition] = $value;
                            }
                            else
                            {
                                if($value < $used_data[$condition])
                                {
                                	throw new Kohana_Exception(__('Quantity set illegal'), 500);
                                }
                            }
                            $operator[$key] = $key;
                            $values[$key] = $value;
                        }
                        
                        $condition_struct['conditions'][] = array(
                            'condition' => $condition, 
                            'operator' => $operator,
                            'value' => $values
                        );

                    }
                    break;
                    case 'products':
                    //相关商品
                    if(isset($request_data['product_ids']) && !empty($request_data['product_ids']))
                    {
                        $condition_struct['conditions'][] = array(
                            'condition' => $condition,
                            'operator' => array('in' => 'in'),
                            'value' => array('in' => EHOVEL::helper('tool')->enclose_ids($request_data['product_ids']))
                        );
                    }
                    else
                    {
                    	throw new Kohana_Exception(__('Select Products'), 500);
                    }
                    break;
                }
            }
        }
        
        return $condition_struct;
    }
    
     /**
     * 根据提交的数据和模板得到存储格式的结果数据
     * 
     * @access public
     * @param array $request_data 数组
     * @param array $scheme 模板
     * @return array
     * @author vicente
     * @example 
     */
    public function handle_bonuses($request_data, $scheme)
    {
    	$bonuses = array();
        foreach($request_data['bonuses'] as $key=>$val)
        {
            //特殊处理配置文件里面为freedelivery的情况，页面上的condition数据为deliverydiscount
            if(!in_array($val, $scheme['bonuses']) && !in_array($val, array('deliverydiscount')))
            {
            	throw new Kohana_Exception(__('Loading failed, try again'), 500);
            }
            
        	if(!preg_match('/^\d{1,12}(\.\d{0,2})?$/', $request_data['discount_value'][$key]) || $request_data['discount_value'][$key] < 0)
            {
            	throw new Kohana_Exception(__('Discount value error'), 500);
            }
            
        	if(($request_data['discount_type'][$key]== 'to_percent' || $request_data['discount_type'][$key]== 'by_percent') && $request_data['discount_value'][$key]>100)
            {
                throw new Kohana_Exception(__('Discount value error'), 500);
            }

            $bonuses[] = array(
            	'bonus' => $val, 
            	'discount_type' => $request_data['discount_type'][$key],
            	'discount_value' => sprintf('%.2f', $request_data['discount_value'][$key])
            );
        }

        return $bonuses;
    }
    
    /**
     * 模板的信息结合现有模型返回正确的页面数据
     * 
     * @access public
     * @param array $scheme 模板
     * @return array
     * @author vicente
     * @example 
     */
    public function compile($scheme)
    {
    	$conditions = array();
    	$return_data = array(
    		'conditions'  => array(),
    		'bonuses'     => array()
    	);
    	
    	$sale_conditions = unserialize($this->conditions);
    	
    	//得到条件类型   	
    	$this->compile_condition($sale_conditions, $conditions);
        if(empty($conditions))
    	{
    		throw new Kohana_Exception(__('Loading failed, try again'), 500);
    	}
    	foreach($conditions as $key=>$val)
	    {
	        if(in_array($key, $scheme['conditions']) || in_array($key, array('orderquantity')))
	    	{
		    	switch($key)
				{
					case 'products' :
						$return_data['conditions']['product'] = explode(',', $val['value']['in']);
					break;
					case 'orderprice':
					case 'orderquantity':
						$return_data['conditions'][$key] = $val;
					break;
				}
	    	}
	    }
	    $bonuses = unserialize($this->bonuses);
	    
	    foreach($bonuses as $k=>$v)
	    {
	    	if(in_array($v['bonus'], $scheme['bonuses']) || in_array($v['bonus'], array('deliverydiscount')))
	        {
	        	$type = substr($v['bonus'], 0, strpos($v['bonus'], 'discount'));
	        	$return_data['bonuses'][$type] = $v;
	        }
	    }

		return $return_data;
    }
    
     /**
     * 返回条件的数据
     * 
     * @param array 规则里面的条件
     * @param array 返回条件的数据
     * return boolean
     */
    public function compile_condition($condition_hash, & $data)
    {
		if (!empty($condition_hash['conditions'])) 
		{
			foreach($condition_hash['conditions'] as $key=>$cond)
			{
				if(!empty($cond['conditions']) && is_array($cond['conditions']))
				{
					$this->compile_condition($cond, $data);
				}
				else
				{
					$data[$cond['condition']] = $cond;
				}
			}
		}

    	return true;
    }	
    
	/**
     * 判断title是否重复
     *
     * @param string $title
     * @return boolean
     * <pre>
     *     true:存在
     *     false:不存在
     * </pre>
     */
    public function title_exist($title = '')
    {
        if ($this->loaded()) {
            $model = EHOVEL::model('site_sale_order')->where('title', '=', $title)
                    ->where('id', '<>', $this->id)
                    ->find();
            if ($model->loaded()) {
                return true;
            }
        } else {
            $this->where('title', '=', $title)->find();
            if ($this->loaded()) {
                return true;
            }
        }
        
        return false;
    }
}