<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * 资源文件夹的控制器
 *
 * @copyright Copyright (c) 2011, Ketai inc.
 *
 * @category Controller
 *
 * @since 2011-05-12
 *
 * @author 张白
 *
 * @version  $Id$
 *
 */
class Resource_catalog_Controller extends Template_Controller
{
    /**
     * @access public
     * @var int 站点id
     */
    public $site_id;

    /**
     * 构造函数
     *
     * @access public
     *
     * @param null
     *
     * @return void
     *
     * @author 张白
     */
    public function __construct()
    {
        parent::__construct();
        $this->site_id = site::id();
        /* 验证是否进入公司 */
        if ($this->site_id < 1) {
            remind::set(Kohana::lang('o_global.select_site'), 'manage/site', 'error');
        }
    }

    /**
     * 初始化资源文件夹列表数据
     *
     * @access public
     *
     * @param null
     *
     * @return void
     *
     * @throws MyRuntimeException
     *
     * @exception MyRuntimeException
     *
     * @author 张白
     */
    public function index()
    {
        try {
            //初始化分类
            bm('resource_catalog')->init($this->site_id);
            $request_data = $this->input->get();

            //初始化请求结构体
            $query_struct = array(
                'where' => array(
                    'site_id' => $this->site_id,
                ),
                'like' => array(),
                'orderby' => array(
                    'date_upd' => 'DESC'
                ),
                'limit' => array()
            );

            // 列表排序
            $orderby_arr = array
            (
                0 => array('id' => 'DESC'),
                1 => array('id' => 'ASC'),
                2 => array('date_upd' => 'DESC'),
                3 => array('date_upd' => 'ASC'),
            );
            $orderby = controller_tool::orderby($orderby_arr);
            if (isset($orderby) && !empty($orderby)) {
                $query_struct['orderby'] = $orderby;
            }

            $resource_catalogs = bm('resource_catalog')->index($query_struct);
            if (!empty($resource_catalogs)) {
                foreach ($resource_catalogs as $key => $value)
                {
                    $resource_catalogs[$key]['date_add'] = tool::convert_date($value['date_add']);
                    $resource_catalogs[$key]['date_upd'] = tool::convert_date($value['date_upd']);
                    //设置文件夹类型
                    if ($value['is_default'] == 1) {
                        $resource_catalogs[$key]['type'] = '系统默认';
                    }
                    else
                    {
                        $resource_catalogs[$key]['type'] = '自定义';
                    }
                }
            }
            //调用列表
            $this->template->content = new View("resource_catalog_list");
            $this->template->content->list = $resource_catalogs;
        } catch (MyRuntimeException $ex) {
            remind::set($ex->getMessage(), request::referrer(), 'error');
        }
    }

    /**
     * 添加一个资源文件夹
     *
     * @access public
     *
     * @param null
     *
     * @return void
     *
     * @throws MyRuntimeException
     *
     * @exception MyRuntimeException
     *
     * @author 张白
     */
    public function add()
    {
        try {
            $return_struct = array(
                'status' => 0,
                'code' => 501,
                'msg' => 'Not Implemented',
                'content' => array()
            );
            //初始化返回数据
            $return_data = array();
            //权限验证
            if ($this->site_id == 0) {
                throw new MyRuntimeException(Kohana::lang('o_global.select_site'), 400);
            }
            // 执行业务逻辑
            $query_struct = array(
                'where' => array(
                    'site_id' => $this->site_id
                ),
                'orderby' => array(
                    'date_upd' => 'DESC'
                ),
            );
            $cata_list = bm('resource_catalog')->index($query_struct);
            if (isset($cata_list) && !empty($cata_list) && count($cata_list)) {
                foreach ($cata_list as $key => $value)
                {
                    $cata_list[$key]['pid'] = $value['parent_id'];
                }
                $return_data['catalog_list'] = tree::get_tree($cata_list, '<option value={$id} {$selected}>{$spacer}{$name}</option>');
            }
            //补充&修改返回结构体
            $return_struct['status'] = 1;
            $return_struct['code'] = 200;
            $return_struct['msg'] = '';
            $return_struct['content'] = $return_data;
            //请求类型
            if ($this->is_ajax_request()) {
                $this->template->content = $return_struct;
            } else {
                $this->template = new View('layout/commonfix_html');
                $this->template->content = new View('resource_catalog_add');
                $this->template->content->return_struct = $return_struct;
            }
        } catch (MyRuntimeException $ex) {
            remind::set($ex->getMessage(), request::referrer(), 'error');
        }
    }

    /**
     * 执行添加操作
     *
     * @access public
     *
     * @param null
     *
     * @return void
     *
     * @throws MyRuntimeException
     *
     * @exception MyRuntimeException
     *
     * @author 张白
     */
    public function do_add()
    {
        try {
            $request_data = $this->input->post();
            //权限验证
            if ($this->site_id == 0) {
                $session = Session::instance();
                $session->set_flash('remind_type', 'error');
                $session->set_flash('remind_error', Kohana::lang('o_global.select_site'));
                echo "<script>
                    window.parent.$('#add_catalog_ifm').dialog('close');
                    parent.location.href = parent.location.href;
                    </script>";
                die();
            }
            if (bm('resource_catalog')->add($request_data)) {
                $session = Session::instance();
                $session->set_flash('remind_type', 'success');
                $session->set_flash('remind_error', Kohana::lang('o_resource.catalog_add_success'));
                echo "<script>
                    window.parent.$('#add_catalog_ifm').dialog('close');
                    parent.location.href = parent.location.href;
                    </script>";
                die();
            }
            else
            {
                $session = Session::instance();
                $session->set_flash('remind_type', 'error');
                $session->set_flash('remind_error', Kohana::lang('o_global.add_error'));
                echo "<script>
                    window.parent.$('#add_catalog_ifm').dialog('close');
                    parent.location.href = parent.location.href;
                    </script>";
                die();
            }
        } catch (MyRuntimeException $ex) {
            remind::set($ex->getMessage(), 'resource_catalog/add', 'error');
        }
    }

    /**
     * 编辑一个资源文件夹
     *
     * @access public
     *
     * @param null
     *
     * @return void
     *
     * @throws MyRuntimeException
     *
     * @exception MyRuntimeException
     *
     * @author 张白
     */
    public function edit()
    {
        try {
            $return_struct = array(
                'status' => 0,
                'code' => 501,
                'msg' => 'Not Implemented',
                'content' => array()
            );
            //初始化数据
            $request_data = $this->input->get();
            //权限验证
            if ($this->site_id == 0) {
                throw new MyRuntimeException(Kohana::lang('o_global.select_site'), 400);
            }
            if (empty($request_data['id'])) {
                throw new MyRuntimeException(Kohana::lang('o_global.bad_request'), 400);
            }
            // 执行业务逻辑
            $query_struct = array(
                'where' => array(
                    'site_id' => $this->site_id
                ),
                'orderby' => array(
                    'date_upd' => 'DESC'
                ),
            );
            $resource_catalog = bm('resource_catalog')->get($request_data['id']);
            $child_ids = empty($resource_catalog['child_ids']) ? array() : explode(',', $resource_catalog['child_ids']);
            $cata_list = bm('resource_catalog')->index($query_struct);
            if (isset($cata_list) && !empty($cata_list) && count($cata_list)) {
                foreach ($cata_list as $key => $value)
                {
                    //去掉子分类和自己
                    if (in_array($value['id'], $child_ids) || $value['id'] == $resource_catalog['id']) {
                        unset($cata_list[$key]);
                        continue;
                    }
                    $cata_list[$key]['pid'] = $value['parent_id'];
                }
                $return_data['catalog_list'] = tree::get_tree($cata_list, '<option value={$id} {$selected}>{$spacer}{$name}</option>', 0, $resource_catalog['parent_id']);
            }
            //补充&修改返回结构体
            $return_struct['status'] = 1;
            $return_struct['code'] = 200;
            $return_struct['msg'] = '';
            $return_struct['content'] = $return_data;
            if ($this->is_ajax_request()) {
                $this->template->content = $return_struct;
            } else {
                $this->template = new View('layout/commonfix_html');
                $this->template->content = new View('resource_catalog_edit');
                $this->template->content->return_struct = $return_struct;
                $this->template->content->resource_catalog = $resource_catalog;
                $this->template->content->cata_list = $cata_list;
            }
        } catch (MyRuntimeException $ex) {
            remind::set($ex->getMessage(), 'resource_catalog/edit', 'error');
        }
    }

    /**
     * 执行编辑操作
     *
     * @access public
     *
     * @param null
     *
     * @return void
     *
     * @throws MyRuntimeException
     *
     * @exception MyRuntimeException
     *
     * @author 张白
     */
    public function do_edit()
    {
        try {
            $request_data = $this->input->post();
            //权限验证
            if ($this->site_id == 0) {
                $session = Session::instance();
                $session->set_flash('remind_type', 'error');
                $session->set_flash('remind_error', Kohana::lang('o_global.select_site'));
                echo "<script>
                    window.parent.$('#edit_catalog_ifm').dialog('close');
                    parent.location.href = parent.location.href;
                    </script>";
                die();
            }
            if (bm('resource_catalog')->set($request_data['resource_id'], $request_data)) {
                $session = Session::instance();
                $session->set_flash('remind_type', 'success');
                $session->set_flash('remind_error', Kohana::lang('o_resource.catalog_update_success'));
                echo "<script>
                    window.parent.$('#edit_catalog_ifm').dialog('close');
                    parent.location.href = parent.location.href;
                    </script>";
                die();
            }
            else
            {
                $session = Session::instance();
                $session->set_flash('remind_type', 'error');
                $session->set_flash('remind_error', Kohana::lang('o_global.update_error'));
                echo "<script>
                    window.parent.$('#edit_catalog_ifm').dialog('close');
                    parent.location.href = parent.location.href;
                    </script>";
                die();
            }
        } catch (MyRuntimeException $ex) {
            remind::set($ex->getMessage(), 'resource_catalog/edit', 'error');
        }
    }

    /**
     * 删除一个资源文件夹
     *
     * @access public
     *
     * @param null
     *
     * @return void
     *
     * @throws MyRuntimeException
     *
     * @exception MyRuntimeException
     *
     * @author 张白
     */
    public function delete()
    {
        try {
            //初始化返回数据
            $request_data = $this->input->get();
            //权限验证
            if ($this->site_id == 0) {
                throw new MyRuntimeException(Kohana::lang('o_global.select_site'), 400);
            }
            if (empty($request_data['id'])) {
                throw new MyRuntimeException(Kohana::lang('o_global.bad_request'), 400);
            }
            // 查找删除文件夹和其子文件夹下有无资源
            $query_struct = array(
                'where' => array(
                    'site_id' => $this->site_id,
                )
            );
            $child_ids = bm('resource_catalog')->get_child_ids_from_db($request_data['id']);
            $child_ids[] = $request_data['id'];
            if (!empty($child_ids) && count($child_ids)) {
                foreach ($child_ids as $child_id)
                {
                    $query_struct['where']['catalog_id'] = $child_id;
                    $resources = bm('resource')->index($query_struct);
                    if (!empty($resources) && count($resources)) {
                        remind::set(Kohana::lang('o_resource.has_catalog_error'), request::referrer(), 'error');
                    }
                }
                foreach ($child_ids as $id)
                {
                    bm('resource_catalog')->delete($id);
                }
            }
            echo "<script>ajax_block.close();</script>";
            remind::set(Kohana::lang('o_resource.delete_catalog_success'), request::referrer(), 'success');
        } catch (MyRuntimeException $ex) {
            remind::set($ex->getMessage(), request::referrer(), 'error');
        }
    }
}

?>
