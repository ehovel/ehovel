<?php defined('SYSPATH') or die('No direct script access.');
// $Id$
/**
 * 多站点ORM模型基类
 * @copyright Copyright (c) 2012, Ketai inc.
 * @package model
 * @category model
 * @since 2012-05-22
 * @author fanchongyuan
 * @version $Id$
 */
class ORM_Site extends ORM {
    /** 
     * 是否要跳过prematch
     * @access protected
     * @author zhubin
     */
    protected $_is_skip_prematch = false;
    /** 
     * 跳过prematch方法
     * @access public
     * @return obj
     * @author zhubin
     */
    public function skip_prematch(){
        $this->_is_skip_prematch = true;
        return $this;
    }

    /** 
     * 自动根据站点ID加入筛选条件
     * @access public
     * @return obj
     * @author fanchongyuan
     * @example 
     */
    protected function prematch()
    {
        $site_id = 1;//EHOVEL::get_site();
        if($site_id)
        {
            //$this->where('site_id','=',$site_id);
        }
        return $this;
    }

    /** 
     * 自动根据站点ID保存站点属性
     * @access public
     * @return obj
     * @author fanchongyuan
     * @example 
     */
    protected function before_save()
    {
        if(!isset($this->site_id))
        {
            $site_id = EHOVEL::get_site();
            if($site_id)
            {
                $this->site_id = $site_id;
            }
        }
        return $this;
    }
}
