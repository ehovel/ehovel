<?php defined('SYSPATH') OR die('No direct script access.');

class Model_User_Emailsignup extends ORM 
{

    /**
     * 表名称
     *
     * @var string
     */
    protected $_table_name = 'email_sign_ups';
    protected $_updated_column = NULL;
    /**
     * 软删除字段名称
     *
     * @var string
     */
    protected $_disabled_key = 'disabled';

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
     * @access public
     * @param string $email 需检验email
     * @return boolen
     * @author fanchongyuan
     * @example 
     */
    public function email_is_exist($email)
    {
        $result = $this->where('email','=',$email)->count_all();
        return $result ? true : false;
    }
    /**
     * 登记邮件
     * @param string $email_sign_up
     * @return Model_User_EmailSignUp
     */
    public function email_sign_up($email)
    {
        $this->email = $email;
        $this->ip = Request::factory()->ip_address();
        $this->save();
        return $this;
    }
}
