<?php defined('SYSPATH') OR die('No direct script access allowed.');

/**
 * jqGrid 服务端
 *
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package Core
 * @category BES
 * @since 2011-6-15 下午2:38
 * @author wang.hao
 * @version   $Id$
 */
class Grid {
    
    /**
     * ORM 实例
     * 
     * @var ORM
     */
    protected $_model = NULL;
    
    /**
     * 总记录数
     * 
     * @var int
     */
    protected $_records = NULL;
    
    /**
     * 创建 Grid 实例
     * 
     * @param ORM $model
     * @return Grid
     */
    static public function factory(ORM $model)
    {
        return new Grid($model);
    }
    
    /**
     * 构造函数
     * 
     * @param ORM $model 
     */
    protected function __construct(ORM $model)
    {
        $this->_model = $model;
        $this->filters = Arr::get($_GET, 'filters', '');
    }
    
    /**
     * 获取当期页号
     * 
     * @return int
     */
    public function page()
    {
        return Arr::get($_GET, 'page', 1);
    }
    
    /**
     * 获取每页显示数量
     * 
     * @return int
     */
    public function rows()
    {
        return Arr::get($_GET, 'rows', 20);
    }
    
    /**
     * 获取总分页数
     * 
     * @return int
     */
    public function total()
    {
        return ceil($this->records() / $this->rows());
    }
    
    /**
     * 获取总记录数
     * 
     * @return int
     */
    public function records()
    {
        if (is_null($this->_records)) {
            $model = clone $this->_model;
            $this->_records = $model->count_all();
        }
        return $this->_records;
    }
    
    /**
     * 获取排序字段名称
     * 
     * @return string
     */
    public function sidx()
    {
        return Arr::get($_GET, 'sidx', 'id');
    }
    
    /**
     * 获取排序方式
     * 
     * @return string
     */
    public function sord()
    {
        return Arr::get($_GET, 'sord', 'DESC');
    }
    
    /**
     * 将结果集转换为数组
     * 
     * @param array $related
     * @return array
     */
    public function to_array(array $related = array())
    {
        $model = clone $this->_model;
        //高级检索
        if(!empty($this->filters))
        {
            $this->filters($model);
        }
        $model->limit($this->rows());
        if ($this->page() > 1) {
            $model->offset(($this->page() - 1) * $this->rows());
        }
        
        $model->order_by($this->sidx(), $this->sord());
        
        $rows = array();
        foreach ($model->find_all() as $row) {
            $rows[] = $row->as_array($related);
        }
        
        return array(
            'total'   => $this->total(),
            'page'    => $this->page(),
            'records' => $this->records(),
            'rows'    => $rows,
        );
    }
    
    /**
     * 将结果集转换为 JSON
     * 
     * array('detail')
     * 
     * @return JSON
     */
    public function to_json(array $related = array())
    {
        return json_encode($this->to_array($related));
    }

    /**
     * 高级检索功能
     * @access public
     * @param ORM $model
     * @return ORM object
     * @author fanchongyuan
     * @example 
     */
    public function filters(ORM $model)
    {
        if(!empty($this->filters))
        {
            $filters = json_decode($this->filters,true);
            if(!empty($filters) && is_array($filters))
            {
                $search_rules = !empty($filters['rules']) ? $filters['rules'] : null;
                $group_op = !empty($filters['groupOp']) ? strtoupper($filters['groupOp']) : 'AND';
                if($group_op == 'OR')
                {
                    $where_op = 'or_where';
                } else {
                    $where_op = 'and_where';
                }
                if(!empty($search_rules))
                {
                    $i = 1;
                    foreach($search_rules as $rule)
                    {
                        $where = $i == 1 ? 'where' : $where_op;
                        if(!empty($rule['field']) && !empty($rule['op']) && !empty($rule['data']))
                        {
                        	if($rule['field'] == 'type')
                        	{
                        		$rule['data'] = EHOVEL::model('User_MessageType')->where('name','like','%'.$rule['data'].'%')->find()->id;	
                        	}
                        	
                        	if($rule['field'] == 'date_add' || $rule['field'] == 'date_pay')
                        	{
                        		$rule['data'] = date('Y-m-d H:i:s',strtotime($rule['data']));
                        	}
                        	
                            switch(strtolower($rule['op']))
                            {
                                case 'ne':
                                    $model->$where($rule['field'],'!=',$rule['data']);
                                    break;
                                case 'bw':
                                    $model->$where($rule['field'],'like',$rule['data'].'%');
                                    break;
                                case 'bn':
                                    $model->$where($rule['field'],'not like',$rule['data'].'%');
                                    break;
                                case 'ew':
                                    $model->$where($rule['field'],'like','%'.$rule['data']);
                                    break;
                                case 'en':
                                    $model->$where($rule['field'],'not like','%'.$rule['data']);
                                    break;
                                case 'cn':
                                    $model->$where($rule['field'],'like','%'.$rule['data'].'%');
                                    break;
                                case 'nc':
                                    $model->$where($rule['field'],'not like','%'.$rule['data'].'%');
                                    break;
                                case 'lt':
                                    $model->$where($rule['field'],'<',$rule['data']);
                                    break;
                                case 'le':
                                    $model->$where($rule['field'],'<=',$rule['data']);
                                    break;
                                case 'gt':
                                    $model->$where($rule['field'],'>',$rule['data']);
                                    break;
                                case 'ge':
                                    $model->$where($rule['field'],'>=',$rule['data']);
                                    break;
                                default:
                                    $model->$where($rule['field'],'=',$rule['data']);
                                    break;
                            }
                        }
                        $i++;
                    }
                }
            }
        }
        return $model;
    }
}
