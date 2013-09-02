<?php defined('SYSPATH') or die('No direct script access.');
/**
 * 站点地图控制器
 *
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package Site
 * @category  Controller  
 * @since 2011-11-25
 * @author dongxiaoyu
 * @version   $Id$
 */

I18n::package('site');

class Controller_Admin_Site_Sitemap extends Controller_Admin_Base_Site
{
    /**
     * 功能链接
     *
     * @var string
     */
    protected $admin_link = '';

    /**
     * 操作前置
     * 在用户访问的操作执行前运行
     *
     * @return void
     */
    public function before()
    {
        parent::before();
        $this->admin_link = EHOVEL::url('site_sitemap');
    }

    /**
     * 网站地图
     *
     * @return void
     */
    public function action_index()
    {
        // 初始化返回结构体
        $return_struct = array(
            'status'  => 0,
            'code'    => 501,
            'msg'     => 'Not Implemented',
            'content' => array(),
        );
        try {
            $priority_arr = EHOVEL::config('site.sitemap');
            $select = array();
            //域名
            $site_config = EHOVEL::model('Site_Config');
            $domain_model = $site_config->where('name','=', 'domain')->find();
            if($domain_model->loaded())
            {
                $domain = $domain_model->value;
            }
            $site_sitemap_log = EHOVEL::model('Site_Sitemap_log')->find();
            if (!empty($_POST)) 
            {
                $xmlContent = '';
                $index     = $this->request->post('index');
                $category  = $this->request->post('category');
                $product   = $this->request->post('product');
                $doc       = $this->request->post('doc');
                $on_sale   = $this->request->post('on_sale');
                $exclude_category   = $this->request->post('exclude_category');
                $exclude_product    = $this->request->post('exclude_product');
                
                $xmlContent .= Sitemap::header();  
                //首页
                if(!empty($index) && is_numeric($index))
                {
                    $index = number_format($index, 1);
                    $site_sitemap_log->index     = $index;
                    $xmlContent .= Sitemap::render('http://'.$domain, 0, 'always', $index); 
                }
                else 
                {
                    Remind::factory ( Remind::TYPE_ERROR )
                        ->message ( __ ('Invalid Request' ) )
                        ->redirect ( EHOVEL::url ( 'site_sitemap' ) )
                        ->send ();
                }
                
                //添加分类页面
                if(!empty($category) && is_numeric($category))
                {
                    $category = number_format($category, 1);
                    $categories = EHOVEL::model('Product_Category')->where('active', '=', 'Y')->find_all();
                    if(!empty($categories))
                    {
                        foreach($categories as $item)
                        {
                            if(empty($exclude_category) || (!empty($exclude_category) && !in_array($item->id, $exclude_category)))
                            {
                                //TODO 路由
                                $xmlContent .= Sitemap::render($domain.$item->get_url(), 0, 'weekly', $category);
                            }
                        }
                    }
                    
                    $site_sitemap_log->category = $category;
                    if(!empty($exclude_category))
                    {
                        $site_sitemap_log->exclude_category     = implode(',', $exclude_category);
                    }
                    else
                    {
                        $site_sitemap_log->exclude_category     = '';
                    }   
                }
                else 
                {
                    Remind::factory ( Remind::TYPE_ERROR )
                        ->message ( __ ('Invalid Request' ) )
                        ->redirect ( EHOVEL::url ( 'site_sitemap' ) )
                        ->send ();
                }
                
                //添加商品页面
                if(!empty($product) && is_numeric($product))
                {
                    $product = number_format($product, 1);
                    $product_model = EHOVEL::model('Product');
                    if($on_sale == 'Y')
                    {
                        $product_model->where('on_sale', '=', $on_sale);
                    }
                    if(!empty($exclude_product))
                    {
                        if(preg_match('/^([a-zA-Z0-9_]+,)*[a-zA-Z0-9_]+$/i', $exclude_product))
                        {
                            $site_sitemap_log->exclude_product     = $exclude_product;
                            $exclude_product = explode(',', $exclude_product);
                        }
                        else
                        {
                            Remind::factory ( Remind::TYPE_ERROR )
                                ->message ( __ ('SKU filling form is wrong, please fill in again!' ) )
                                ->redirect ( EHOVEL::url ( 'site_sitemap' ) )
                                ->send ();
                        }
                    }
                    else 
                    {
                        $site_sitemap_log->exclude_product     = '';
                    }
                    $products = $product_model->where('active', '!=', 'INVISIBLED')->find_all();
                    if(!empty($products))
                    {
                        foreach($products as $item)
                        {
                            if(empty($exclude_product))
                            {
                                $xmlContent .= Sitemap::render($domain.$item->get_url(), $item->date_upd, 'weekly', $product);
                            }
                            elseif(!empty($exclude_product) && !in_array($product['sku'], $exclude_product))
                            {
                                $xmlContent .= Sitemap::render($domain.$item->get_url(), $item->date_upd, 'weekly', $product);
                            }
                        }
                    }
                    $site_sitemap_log->on_sale     = $on_sale;
                    $site_sitemap_log->product     = $product;
                }
                else 
                {
                    Remind::factory ( Remind::TYPE_ERROR )
                            ->message ( __ ('Invalid Request' ) )
                            ->redirect ( EHOVEL::url ( 'site_sitemap' ) )
                            ->send ();
                }
                
                //添加文案页面
                if(!empty($doc) && is_numeric($doc))
                {
                	$doc_model_record = EHOVEL::model('Cms_Model')->set("name", "Docs")->find();
		            $docs = EHOVEL::model('CMS_Model')
		                ->get_model($doc_model_record->id)
		                ->find_all();
                    foreach($docs as $item)
                    {
                        $xmlContent .= Sitemap::render($domain.'/doc/doc-'.$item->id, time(), 'weekly', $doc);
                    }
                    $site_sitemap_log->doc     = $doc;
                }
                else 
                {
                    Remind::factory ( Remind::TYPE_ERROR )
                            ->message ( __ ('Invalid Request' ) )
                            ->redirect ( EHOVEL::url ( 'site_sitemap' ) )
                            ->send ();
                }
                
                $xmlContent .= '</urlset>';

                $site_config = EHOVEL::model('Site_Config')->where('name','=', 'sitemap')->find();
                if($site_config->loaded())
                {
                    $site_config->value     = $xmlContent;
                    $site_config->save();
                }
                else 
                {
                    $site_config->name      = 'sitemap';
                    $site_config->value     = $xmlContent;
                    $site_config->save();
                } 
                
                $site_sitemap_log->content     = $xmlContent;
                $site_sitemap_log->save();
                
                if ($site_sitemap_log->saved()) 
                {
                    Remind::factory ( Remind::TYPE_SUCCESS )
                        ->message ( __ ( 'Edited Successfully!' ) )
                        ->redirect ( EHOVEL::url ( 'site_sitemap' ) )
                        ->send ();
                } 
                else 
                {
                    Remind::factory ( Remind::TYPE_ERROR )
                        ->message ( $site_sitemap_log->validation()->errors() )
                        ->redirect ( EHOVEL::url ( 'site_sitemap' ) )
                        ->send ();
                }
            }
            else 
            {
                if($site_sitemap_log->loaded())
                {
                    $select = explode(',',$site_sitemap_log->exclude_category);
                }
            }
            $exclude_categories = $site_sitemap_log->exclude_category;
            $exclude_category = explode(',',$exclude_categories);
            
            $this->template = EHOVEL::view('site/sitemap/check');
            $this->template->category_tree = Widget::factory('Category_SelTree', array(
                                                        'id' => 'exclude_category',
                                                        'name' => 'exclude_category[]',
                                                        'attributes' => array(
                                                					'multiple' => 'multiple',
                                                        ),
                                                        'selected' => $select,
                                                        'space_line' => NULL,
                                                    ));
            $this->template->site_map_log = $site_sitemap_log;
            $this->template->priority     = $priority_arr;
            $this->template->categories   = EHOVEL::model('Product_Category')->tree();
            $this->template->exclude_category = $exclude_category;
            $this->template->product      = EHOVEL::model('Product');
        } catch (Kohana_Exception $ex) {
            Remind::factory($ex)
                ->send();
        }
    }
}
