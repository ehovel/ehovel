<?php defined('SYSPATH') or die('No Direct Access');
// $Id$
// 不要用name和mark作为键值
// type 不写默认Model_Auth_Node::CONTROLLER_NODE
// default_role 不写默认Model_Auth_Node::ROLE_ROOT
return array(
    'name'=>__('Auth Model'),
    'mark'=>'auth',
    'default_role' => Model_Auth_Node::ROLE_ROOT,
    'children'=>array(
        'auth_admin' => array(
            'name' => __('Account Manage'),
            'mark' => 'auth_admin',
            'type' => Model_Auth_Node::GROUP_NODE,
            'children' =>    
            array(
                'auth_admin/login'=>array(
                    'mark' => 'auth_admin/login',
                    'name' => __('User Login'),
                    'default_role' => Model_Auth_Node::ROLE_GUEST,
                ),
                'auth_admin/index'=>array(
                    'mark' => 'auth_admin/index',
                    'name' => __('Account List'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'auth_admin/add'=>array(
                    'mark' => 'auth_admin/add',
                    'name' => __('Account Add'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'auth_admin/edit'=>array(
                    'mark' => 'auth_admin/edit',
                    'name' => __('Account Edit'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'auth_admin/delete'=>array(
                    'mark' => 'auth_admin/delete',
                    'name' => __('Account Delete'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'auth_admin/logout'=>array(
                    'mark' => 'auth_admin/logout',
                    'name' => __('User Logout'),
                    'default_role' => Model_Auth_Node::ROLE_GUEST,
                ),
                'auth_admin/info'=>array(
                    'mark' => 'auth_admin/info',
                    'name' => __('Change Password'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
            )
        ),
        'auth_role' => array(
            'name' => __('Role Manage'),
            'mark' => 'auth_role',
            'type' => Model_Auth_Node::GROUP_NODE,
            'children' =>    
            array(
                'auth_role/index'=>array(
                    'mark' => 'auth_role/index',
                    'name' => __('Role List'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'auth_role/add'=>array(
                    'mark' => 'auth_role/add',
                    'name' => __('Role Add'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                 'auth_role/edit'=>array(
                    'mark' => 'auth_role/edit',
                    'name' => __('Role Edit'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                 'auth_role/delete'=>array(
                    'mark' => 'auth_role/delete',
                    'name' => __('Role Delete'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
            )
        ),
    )
);
