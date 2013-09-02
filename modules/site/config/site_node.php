<?php defined('SYSPATH') or die('No Direct Access');
// $Id$
// 不要用name和mark作为键值
// type 不写默认Model_Auth_Node::CONTROLLER_NODE
// default_role 不写默认Model_Auth_Node::ROLE_ROOT
return array(
    'name' => __('Site Model'),
    'mark' => 'site',
    'type' => Model_Auth_Node::GROUP_NODE,
    'children'=>array(
        'site' => array(
            'name' => __('Site Manage'),
            'mark' => 'site/index',
            'type' => Model_Auth_Node::ROLE_ROOT,
        ),
        'site_config' => array(
            'name' => __('Site Config'),
            'mark' => 'site_config',
            'type' => Model_Auth_Node::GROUP_NODE,
            'children' => array(
                'site_config/index'=>array(
                    'mark' => 'site_config/index',
                    'name' => __('Site Config'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'site_config/robots'=>array(
                    'mark' => 'site_config/robots',
                    'name' => __('Configure robots.txt Information'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'site_config/aboutus'=>array(
                    'mark' => 'site_config/aboutus',
                    'name' => __('About Company'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
            )
        ),
         'site_space' => array(
            'name' => __('Site Space'),
            'mark' => 'site_space',
            'type' => Model_Auth_Node::GROUP_NODE,
            'children' => array(
                'site_space/index'=>array(
                    'mark' => 'site_space/index',
                    'name' => __('Space List'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'site_space/add'=>array(
                    'mark' => 'site_space/add',
                    'name' => __('Add Space'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'site_space/edit'=>array(
                    'mark' => 'site_space/edit',
                    'name' => __('Edit Space'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'site_space/delete'=>array(
                    'mark' => 'site_space/delete',
                    'name' => __('Delete Space'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
            )
        ),
        'site_ads' => array(
            'name' => __('Site Ads'),
            'mark' => 'site_ads',
            'type' => Model_Auth_Node::GROUP_NODE,
            'children' => array(
                'site_ads/index'=>array(
                    'mark' => 'site_ads/index',
                    'name' => __('Ads List'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'site_ads/add'=>array(
                    'mark' => 'site_ads/add',
                    'name' => __('Add Ads'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'site_ads/edit'=>array(
                    'mark' => 'site_ads/edit',
                    'name' => __('Edit Ads'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'site_ads/delete'=>array(
                    'mark' => 'site_ads/delete',
                    'name' => __('Delete Ads'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
            )
        ),
        'site_faq' => array(
            'name' => __('Faq Manage'),
            'mark' => 'site_faq',
            'type' => Model_Auth_Node::GROUP_NODE,
            'children' => array(
                'site_faq/index'=>array(
                    'mark' => 'site_faq/index',
                    'name' => __('Faq List'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'site_faq/edit'=>array(
                    'mark' => 'site_faq/add',
                    'name' => __('Add Faq'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'site_faq/add'=>array(
                    'mark' => 'site_faq/edit',
                    'name' => __('Edit Faq'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'site_faq/delete'=>array(
                    'mark' => 'site_faq/delete',
                    'name' => __('Delete Faq'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
            )
        ),
        'site_faq_category' => array(
            'name' => __('Faq Category Manage'),
            'mark' => 'site_faq_category',
            'type' => Model_Auth_Node::GROUP_NODE,
            'children' => array(
                'site_faq_category/index'=>array(
                    'mark' => 'site_faq_category/index',
                    'name' => __('Faq Category List'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'site_faq_category/add'=>array(
                    'mark' => 'site_faq_category/add',
                    'name' => __('Add New Category'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'site_faq_category/edit'=>array(
                    'mark' => 'site_faq_category/edit',
                    'name' => __('Edit Category'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'site_faq_category/delete'=>array(
                    'mark' => 'site_faq_category/delete',
                    'name' => __('Delete Faq Category'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
            )
        ),
        //技术问答
        'site_tecfaq' => array(
            'name' => __('Tec Faq Manage'),
            'mark' => 'site_tecfaq',
            'type' => Model_Auth_Node::GROUP_NODE,
            'children' => array(
                'site_tecfaq/index'=>array(
                    'mark' => 'site_tecfaq/index',
                    'name' => __('Faq List'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'site_tecfaq/edit'=>array(
                    'mark' => 'site_tecfaq/add',
                    'name' => __('Add Faq'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'site_tecfaq/add'=>array(
                    'mark' => 'site_tecfaq/edit',
                    'name' => __('Edit Faq'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'site_tecfaq/delete'=>array(
                    'mark' => 'site_tecfaq/delete',
                    'name' => __('Delete Faq'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
            )
        ),
        'site_tecfaq_category' => array(
            'name' => __('Tec Faq Category Manage'),
            'mark' => 'site_tecfaq_category',
            'type' => Model_Auth_Node::GROUP_NODE,
            'children' => array(
                'site_tecfaq_category/index'=>array(
                    'mark' => 'site_tecfaq_category/index',
                    'name' => __('Faq Category List'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'site_tecfaq_category/add'=>array(
                    'mark' => 'site_tecfaq_category/add',
                    'name' => __('Add New Category'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'site_tecfaq_category/edit'=>array(
                    'mark' => 'site_tecfaq_category/edit',
                    'name' => __('Edit Category'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'site_tecfaq_category/delete'=>array(
                    'mark' => 'site_tecfaq_category/delete',
                    'name' => __('Delete Faq Category'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
            )
        ),
        'site_currency' => array(
            'name' => __('Currency Manage'),
            'mark' => 'site_currency',
            'type' => Model_Auth_Node::GROUP_NODE,
            'children' => array(
                'site_currency/index'=>array(
                    'mark' => 'site_currency/index',
                    'name' => __('Currency List'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'site_currency/add'=>array(
                    'mark' => 'site_currency/add',
                    'name' => __('Add Currency'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'site_currency/edit'=>array(
                    'mark' => 'site_currency/edit',
                    'name' => __('Edit Currency'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'site_currency/delete'=>array(
                    'mark' => 'site_currency/delete',
                    'name' => __('Delete Currency'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
            )
        ),
        'site_emailtpl' => array(
            'name' => __('Emailtpl Manage'),
            'mark' => 'site_emailtpl',
            'type' => Model_Auth_Node::GROUP_NODE,
            'children' => array(
                'site_emailtpl/index'=>array(
                    'mark' => 'site_emailtpl/index',
                    'name' => __('Email Template List'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'site_emailtpl/edit'=>array(
                    'mark' => 'site_emailtpl/edit',
                    'name' => __('Edit Email Template'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
            )
        ),
        'site_emailsignup' => array(
            'name' => __('Email Sign Up Manage'),
            'mark' => 'site_emailsignup',
            'type' => Model_Auth_Node::GROUP_NODE,
            'children' => array(
                'site_emailsignup/index'=>array(
                    'mark' => 'site_emailsignup/index',
                    'name' => __('Email Sign Up List'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'site_emailsignup/delete'=>array(
                    'mark' => 'site_emailsignup/delete',
                    'name' => __('Email Sign Up Delete'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
            )
        ),
        'site_link' => array(
            'name' => __('Link Manage'),
            'mark' => 'site_link',
            'type' => Model_Auth_Node::GROUP_NODE,
            'children' => array(
                'site_link/index'=>array(
                    'mark' => 'site_link/index',
                    'name' => __('Site Link List'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'site_link/add'=>array(
                    'mark' => 'site_link/add',
                    'name' => __('Add Site Link'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'site_link/edit'=>array(
                    'mark' => 'site_link/edit',
                    'name' => __('Edit Site Link'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'site_link/delete'=>array(
                    'mark' => 'site_link/delete',
                    'name' => __('Delete Site Link'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
            )
        ),
        'site_seo' => array(
            'name' => __('Seo Manage'),
            'mark' => 'site_seo',
            'type' => Model_Auth_Node::GROUP_NODE,
            'children' => array(
                'site_seo/index'=>array(
                    'mark' => 'site_seo/index',
                    'name' => __('SEO Default Configuration'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'site_seo/home'=>array(
                    'mark' => 'site_seo/home',
                    'name' => __('SEO Configuration for Home'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'site_seo/product'=>array(
                    'mark' => 'site_seo/product',
                    'name' => __('SEO Configuration for Products'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'site_seo/product_child'=>array(
                    'mark' => 'site_seo/product_child',
                    'name' => __('Contain subclassification or not?'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'site_seo/category'=>array(
                    'mark' => 'site_seo/category',
                    'name' => __('SEO Configuration for Categories'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'site_seo/category_child'=>array(
                    'mark' => 'site_seo/category_child',
                    'name' => __('Update all the subclassifications of this classification'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
            )
        ),
        'site_sitemap' => array(
            'name' => __('Sitemap Manage'),
            'mark' => 'site_sitemap',
            'type' => Model_Auth_Node::GROUP_NODE,
            'children' => array(
                'site_sitemap/index'=>array(
                    'mark' => 'site_sitemap/index',
                    'name' => __('Sitemap Manage'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
            )
        ),
        'site_menu' => array(
            'name' => __('Site Menu Manage'),
            'mark' => 'site_menu',
            'type' => Model_Auth_Node::GROUP_NODE,
            'children' => array(
                'site_menu/index'=>array(
                    'mark' => 'site_menu/index',
                    'name' => __('Site Menu List'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'site_menu/add'=>array(
                    'mark' => 'site_menu/add',
                    'name' => __('Site Menu Add'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'site_menu/edit'=>array(
                    'mark' => 'site_menu/edit',
                    'name' => __('Site Menu Edit'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'site_menu/delete'=>array(
                    'mark' => 'site_menu/delete',
                    'name' => __('Site Menu Delete'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
            )
        ),
        'site_sitestat_overview' => array(
            'name' => __('Access Statistics Manage'),
            'mark' => 'site_sitestat_overview',
            'type' => Model_Auth_Node::GROUP_NODE,
            'children' => array(
                'site_sitestat_overview/index'=>array(
                    'mark' => 'site_sitestat_overview/index',
                    'name' => __('Statistics Overview'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
            )
        ),
        'site_sitestat_onedaystat' => array(
            'name' => __('Today Statistics Manage'),
            'mark' => 'site_sitestat_onedaystat',
            'type' => Model_Auth_Node::GROUP_NODE,
            'children' => array(
                'site_sitestat_onedaystat/index'=>array(
                    'mark' => 'site_sitestat_onedaystat/index',
                    'name' => __('Today Statistics'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'site_sitestat_onedaystat/yesterday'=>array(
                    'mark' => 'site_sitestat_onedaystat/yesterday',
                    'name' => __('Yesterday Statistics'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'site_sitestat_onedaystat/oneday'=>array(
                    'mark' => 'site_sitestat_onedaystat/oneday',
                    'name' => __('Hour Period Distribution'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
            )
        ),
        'site_sitestat_fewdaystat' => array(
            'name' => __('Month Statistics Manage'),
            'mark' => 'site_sitestat_fewdaystat',
            'type' => Model_Auth_Node::GROUP_NODE,
            'children' => array(
                'site_sitestat_fewdaystat/index'=>array(
                    'mark' => 'site_sitestat_fewdaystat/index',
                    'name' => __('This Month Statistics'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'site_sitestat_fewdaystat/recent7days'=>array(
                    'mark' => 'site_sitestat_fewdaystat/recent7days',
                    'name' => __('Last 7 Days'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'site_sitestat_fewdaystat/recent30days'=>array(
                    'mark' => 'site_sitestat_fewdaystat/recent30days',
                    'name' => __('Last 30 Days'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
                'site_sitestat_fewdaystat/fewdays'=>array(
                    'mark' => 'site_sitestat_fewdaystat/fewdays',
                    'name' => __('Date Period Of Distribution'),
                    'default_role' => Model_Auth_Node::ROLE_ROOT,
                ),
            )
        ),
        'site_store' => array(
            'name' => __('Site Store Manage'),
            'mark' => 'site_store',
            'type' => Model_Auth_Node::GROUP_NODE,
        ),
    )
);
