<?php defined('SYSPATH') or die('No direct script access.');
// $Id$
/**
 * 邮件订阅模型
 *
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package Site
 * @category  Model  
 * @since 2012-01-04
 * @author zhubin
 * @version   $Id$
 */
class Model_Site_EmailSignUp extends ORM
{
    /**
     * 更新时间字段配置，当无更新时间字段时，将此项设置为NULL
     * 
     * @var array
     */
    protected $_updated_column = NULL;

    /**
     * 模型对应的表名
     * 
     * @var string
     */
    protected $_table_name = 'email_sign_ups';
    /**
     * 验证规则
     * @return array
     */
    public function rules ()
    {
        return array(
            'email' => array(
                array('not_empty'),
                array('email'),
            )
        );
    }
    /**
     * 检验邮箱是否已经存在
     * @author zhubin
     * @access public
     * @param string $email 需检验email
     * @return boolen
     */
    public function email_is_exist($email)
    {
        $result = $this->where('email','=',$email)->count_all();
        return $result ? true : false;
    }
    /**
     * 登记订阅邮箱
     * @author zhubin
     * @access public
     * @param string $email 需检验email
     * @return Model_Site_EmailSignUp
     */
    public function email_sign_up($email)
    {
        $this->email = $email;
        $this->ip = Request::factory()->ip_address();
        $this->save();
        return $this;
    }
}
