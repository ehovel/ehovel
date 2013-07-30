<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * 资源标签的控制器
 *
 * @copyright Copyright (c) 2011, Ketai inc.
 * @category Controller
 * @since 2011-05-12
 * @author 张白
 * @version  $Id$
 * @modify Bin 2011-11-08
 */
class Resource_tag_Controller extends Template_Controller
{
    /**
     * @access public
     * @var string 站点id
     */
    public $site_id;

    /**
     * 构造函数
     * @access public
     * @param null
     * @return void
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
     * 初始化资源标签列表数据
     * @access public
     * @param null
     * @return void
     * @throws MyRuntimeException
     * @exception MyRuntimeException
     * @author 张白
     */
    public function index()
    {
        try {
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

            $resource_tags = bm('resource_tag')->index($query_struct);
            if (!empty($resource_tags)) {
                foreach ($resource_tags as $key => $value)
                {
                    $resource_tags[$key]['date_add'] = tool::convert_date($value['date_add']);
                    $resource_tags[$key]['date_upd'] = tool::convert_date($value['date_upd']);
                }
            }
            //调用列表
            $this->template->content = new View("resource_tag_list");
            $this->template->content->list = $resource_tags;
            $this->template->content->site_id = $this->site_id;
        } catch (MyRuntimeException $ex) {
            remind::set($ex->getMessage(), request::referrer(), 'error');
        }
    }

    /**
     * 添加一个资源标签
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
            //补充&修改返回结构体
            $return_struct['status'] = 1;
            $return_struct['code'] = 200;
            $return_struct['msg'] = '';
            $return_struct['content'] = array();
            //请求类型
            if ($this->is_ajax_request()) {
                $this->template->content = $return_struct;
            } else {
                $this->template = new View('layout/commonfix_html');
                $this->template->content = new View('resource_tag_add');
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
                    window.parent.$('#add_tag_ifm').dialog('close');
                    parent.location.href = parent.location.href;
                    </script>";
                die();
            }
            if (bm('resource_tag')->add($request_data)) {
                $session = Session::instance();
                $session->set_flash('remind_type', 'success');
                $session->set_flash('remind_error', Kohana::lang('o_resource.tag_add_success'));
                echo "<script>
                    window.parent.$('#add_tag_ifm').dialog('close');
                    parent.location.reload();
                    </script>";
                die();
            }
            else
            {
                $session = Session::instance();
                $session->set_flash('remind_type', 'error');
                $session->set_flash('remind_error', Kohana::lang('o_global.add_error'));
                echo "<script>
                    window.parent.$('#add_tag_ifm').dialog('close');
                    parent.location.reload();
                    </script>";
                die();
            }
        } catch (MyRuntimeException $ex) {
            remind::set($ex->getMessage(), 'resource_tag/add', 'error');
        }
    }

    /**
     * 编辑一个资源标签
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
            $resource_tag = bm('resource_tag')->get($request_data['id']);
            //补充&修改返回结构体
            $return_struct['status'] = 1;
            $return_struct['code'] = 200;
            $return_struct['msg'] = '';
            $return_struct['content'] = array();
            if ($this->is_ajax_request()) {
                $this->template->content = $return_struct;
            } else {
                $this->template = new View('layout/commonfix_html');
                $this->template->content = new View('resource_tag_edit');
                $this->template->content->return_struct = $return_struct;
                $this->template->content->resource_tag = $resource_tag;
            }
        } catch (MyRuntimeException $ex) {
            remind::set($ex->getMessage(), 'resource_tag/edit', 'error');
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
                    window.parent.$('#edit_tag_ifm').dialog('close');
                    parent.location.href = parent.location.href;
                    </script>";
                die();
            }
            if (bm('resource_tag')->set($request_data['tag_id'], $request_data)) {
                $session = Session::instance();
                $session->set_flash('remind_type', 'success');
                $session->set_flash('remind_error', Kohana::lang('o_resource.tag_update_success'));
                echo "<script>
                    window.parent.$('#edit_tag_ifm').dialog('close');
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
                    window.parent.$('#edit_tag_ifm').dialog('close');
                    parent.location.href = parent.location.href;
                    </script>";
                die();
            }
        } catch (MyRuntimeException $ex) {
            remind::set($ex->getMessage(), 'resource_tag/edit', 'error');
        }
    }

    /**
     * 删除一个资源标签
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
            // 删除tag与resource关联表中的数据
            if (bm('resource_tag')->delete($request_data['id'])) {
                remind::set(Kohana::lang('o_resource.delete_tag_success'), request::referrer(), 'success');
            }
            else
            {
                remind::set(Kohana::lang('o_global.delete_error'), request::referrer(), 'error');
            }
        } catch (MyRuntimeException $ex) {
            remind::set($ex->getMessage(), request::referrer(), 'error');
        }
    }
}

?>
