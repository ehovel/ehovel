<?php defined('SYSPATH') or die('No Direct Access');
// $Id$
// 不要用name和mark作为键值
// type 不写默认Model_Auth_Node::CONTROLLER_NODE
// default_role 不写默认Model_Auth_Node::ROLE_ROOT
return array(
    'name'=>__('System Model'),
    'mark'=>'core',
    'type' => Model_Auth_Node::GROUP_NODE,
    'children'=>array(
        'menu' => array(
            'name' => __('System Menu Manage'),
            'mark' => 'menu',
            'type' => Model_Auth_Node::GROUP_NODE,
            'children' =>    
            array(
                'menu/index'=>array(
                    'mark' => 'menu/index',
                    'name' => __('System Menu List'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'menu/add'=>array(
                    'mark' => 'menu/add',
                    'name' => __('System Menu Add'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'menu/edit'=>array(
                    'mark' => 'menu/edit',
                    'name' => __('System Menu Edit'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'menu/delete'=>array(
                    'mark' => 'menu/delete',
                    'name' => __('System Menu Delete'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
            )
        ),
    )
);
