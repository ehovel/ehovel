<?php defined('SYSPATH') or die('No direct access allowed.');
//用户权限资源配置
return array(
    'name'=>__('User Model'),
    'mark'=>'user',
    'type' => Model_Auth_Node::GROUP_NODE,
    'default_role' => Model_Auth_Node::ROLE_ROOT,
    'children'=>array(
        'user_group_manage' => array(
            'name' => __('User Group Manage'),
            'mark' => 'user_group_manage',
            'type' => Model_Auth_Node::GROUP_NODE,
            'children' =>    
            array(
                'user_group/index'=>array(
                    'mark' => 'user_group/index',
                    'name' => __('User Group List'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'user_group/add'=>array(
                    'mark' => 'user_group/add',
                    'name' => __('Add User Group'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'user_group/edit'=>array(
                    'mark' => 'user_group/edit',
                    'name' => __('Edit User Group'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'user_group/delete'=>array(
                    'mark' => 'user_group/delete',
                    'name' => __('Delete User Group'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
            )
        ),
        'user_manage' => array(
            'name' => __('User Manage'),
            'mark' => 'user_manage',
            'type' => Model_Auth_Node::GROUP_NODE,
            'children' =>    
            array(
                'user/index'=>array(
                    'mark' => 'user/index',
                    'name' => __('Member List'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'user/add'=>array(
                    'mark' => 'user/add',
                    'name' => __('Add New Member'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'user/edit'=>array(
                    'mark' => 'user/edit',
                    'name' => __('Edit Member'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'user/delete'=>array(
                    'mark' => 'user/delete',
                    'name' => __('Delete Member'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
            )
        ),
        'user_address_manage' => array(
            'name' => __('Members Address Manage'),
            'mark' => 'user_address_manage',
            'type' => Model_Auth_Node::GROUP_NODE,
            'children' =>    
            array(
                'user_address/add'=>array(
                    'mark' => 'user_address/add',
                    'name' => __('Add Members Address'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'user_address/edit'=>array(
                    'mark' => 'user_address/edit',
                    'name' => __('Edit Members Address'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'user_address/delete'=>array(
                    'mark' => 'user_address/delete',
                    'name' => __('Delete Members Address'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
            )
        ),
        'userstat_manage' => array(
            'name' => __('User Statistics'),
            'mark' => 'userstat_userstat',
            'type' => Model_Auth_Node::GROUP_NODE,
        ),
    )
);
