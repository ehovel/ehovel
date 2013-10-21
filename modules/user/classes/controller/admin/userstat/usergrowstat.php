<?php defined('SYSPATH') OR die('No direct access allowed.');
class Controller_Admin_Userstat_Usergrowstat extends Controller_Admin_Base
{

    /**
     * 每页的记录数
     *
     * @var int
     */
    public $perpage = 20;

    /**
     * 自定义时间会员增长
     * 默认时间为最近七天
     */
    public function action_index()
    {
        $return_struct = array (
            'status' => 0, 
            'code' => 501, 
            'msg' => 'Not Implemented', 
            'content' => array () 
        );
        try {
            //得到时间区间
            if( isset($_POST['date_from']) && !empty($_POST['date_from']))
            {
                $request_date_from = $_POST['date_from'];
            } else {
                $request_date_from = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d')-6, date('Y')));
            }
            if( isset($_POST['date_to']) && !empty($_POST['date_to']))
            {
                $request_date_to = $_POST['date_to'];
            } else {
                $request_date_to = date('Y-m-d');
            }
            if($request_date_from > $request_date_to)
            {
                $temp = $request_date_from;
                $request_date_from = $request_date_to;
                $request_date_to = $temp;
                unset($temp);
            }
            strtotime($request_date_from) > time() && $request_date_from = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d')-7, date('Y')));
            strtotime($request_date_to) > time() && $request_date_to = date('Y-m-d');

            $data = Model_Userstat::get_user_grow($request_date_from, $request_date_to);
            
            $this->template = BES::view('userstat/usergrowstat/index');

            //得到图形参数
            $data['chart'] = $this->get_pic_src($data['day_data']);
            

            $data['date_from'] = $request_date_from;
            $data['date_to'] = $request_date_to;
            $data['site_name'] = '';

            $this->template->data = $data;
            $this->template->user_day_grow = 1;

        } catch ( Exception_BES $ex ) {
            $this->_ex($ex, $return_struct);
        }
    }

    /*
     * 月度报表
     * 默认为当月
     */
    public function action_month()
    {
        $return_struct = array (
            'status' => 0, 
            'code' => 501, 
            'msg' => 'Not Implemented', 
            'content' => array () 
        );
        try {
            //时间，默认为本年本月
            isset($_POST['year']) ? $request_year = intval($_POST['year']) : $request_year = date('Y');
            isset($_POST['month']) ? $request_month = intval($_POST['month']) : $request_month = date('m');

            if(mktime(0, 0, 0, $request_month, 1, $request_year) > time())
            {
                $request_year = date('Y');
                $request_month = date('m');
            }

            $data = Model_Userstat::get_month_user_grow($request_year, $request_month);
            $this->template = BES::view('userstat/usergrowstat/month');


            //得到图形参数
            $data['chart'] = $this->get_pic_src($data['day_data']);

            $data['year'] = $request_year;
            $data['month'] = $request_month;
            $data['site_name'] = '';

            $this->template->data = $data;
            $this->template->user_month_grow = 1;

        } catch ( Exception_BES $ex ) {
            $this->_ex($ex, $return_struct);
        }
    }

	/*
     * 年度报表
     * 默认为本年
     */
    public function action_year()
    {
        $return_struct = array (
            'status' => 0, 
            'code' => 501, 
            'msg' => 'Not Implemented', 
            'content' => array () 
        );
        try {
            //时间，默认为本年
            isset($_POST['year']) ? $request_year = intval($_POST['year']) : $request_year = date('Y');

            $request_year > date('Y') && $request_year = date('Y');

            $data = Model_Userstat::get_year_user_grow($request_year);

            $this->template = BES::view('userstat/usergrowstat/year');

            //得到图形参数
            $data['chart'] = $this->get_pic_src($data['month_data']);

            $data['year'] = $request_year;
            $data['site_name'] = '';

            $this->template->data = $data;
            $this->template->user_year_grow = 1;

        } catch ( Exception_BES $ex ) {
            $this->_ex($ex, $return_struct);
        }
    }
    public function export_year()
    {
        $return_struct = array (
            'status' => 0, 
            'code' => 501, 
            'msg' => 'Not Implemented', 
            'content' => array () 
        );
        try {
            if (empty($this->site_ids)) 
            {
                throw new MyRuntimeException(Kohana::lang('o_global.access_denied'), 403);
            }
            if ( $this->site_id <= 0 && !in_array($this->site_id, $this->site_ids)) 
            {
                throw new MyRuntimeException(Kohana::lang('o_global.select_site'), 400);
            }
            //时间，默认为本年
            isset($_GET['year']) ? $request_year = intval($_GET['year']) : $request_year = date('Y');
            $request_year > date('Y') && $request_year = date('Y');

            $data = Mystat_user_stat::instance()->get_year_user_grow($this->site_id, $request_year);
            $csv_data = $data['month_data'];
            $total_data = $data['total'];
            $title = array(
                '0' => Kohana::lang('o_stat_usergrow.time'),
                '1' => Kohana::lang('o_stat_usergrow.count'),
            );
            array_unshift($csv_data, $title, $total_data);
            $csv = array();
            foreach($csv_data as $key_c_d => $_csv_data)
            {
                $csv_temp = array();
                foreach($_csv_data as $_s_d)                
                {
                    $csv_temp[] = $_s_d;
                }
                $csv[] = $csv_temp;
            }

            $csv = csv::encode($csv);
            $csv = iconv('UTF-8', 'GBK//IGNORE', $csv);

            if (!$this->is_ajax_request())
            {
                @header('Cache-control: private');
                @header('Content-Disposition: attachment; filename='.'user-grow-export-'.date('Ymd', time()).'.csv');
                @header('Content-type: text/csv; charset=GBK');
                echo $csv;
                exit;
            } else {
                $fid = uniqid().time();
                $dir = BES::config('stat.export_tmp_dir');
                $dir = rtrim(trim($dir), '/');
                if(!is_dir($dir) && !@mkdir($dir, 0777, TRUE))
                {
                    throw new MyRuntimeException(Kohana::lang('o_stat.export_crt_tmpdir_failed'));
                }
                $filename = $dir.'/'.$fid.'.csv';
                if(!@file_put_contents($filename, $csv))
                {
                    throw new MyRuntimeException(Kohana::lang('o_stat.export_wrt_tmp_failed'));
                }
            }

            $return_struct['status'] = 1;
            $return_struct['code'] = 200;
            $return_struct['msg'] = '';
            $return_struct['content'] = BES::url('userstat/usergrowstat/download',array('fid'=>$fid));
            if($this->is_ajax_request())
            {
                $this->template = $return_struct;
            }

        }catch(MyRuntimeException $ex){
            $return_struct['status'] = 0;
            $return_struct['code'] = $ex->getCode();
            $return_struct['msg'] = $ex->getMessage();
            //TODO 异常处理
            //throw $ex;
            if($this->is_ajax_request()){
                $this->template = $return_struct;
            }else{
                $this->template->return_struct = $return_struct;
                $this->template = BES::view('info');
                //* 返回结构体绑定 */
                $this->template->return_struct = $return_struct;
            }
        }
    }

    public function export()
    {
        $return_struct = array (
            'status' => 0, 
            'code' => 501, 
            'msg' => 'Not Implemented', 
            'content' => array () 
        );
        try {
            if (empty($this->site_ids)) 
            {
                throw new MyRuntimeException(Kohana::lang('o_global.access_denied'), 403);
            }
            if ( $this->site_id <= 0 && !in_array($this->site_id, $this->site_ids)) 
            {
                throw new MyRuntimeException(Kohana::lang('o_global.select_site'), 400);
            }
            //得到时间区间
            $request_date_from = isset($_GET['date_from']) ? $_GET['date_from'] : date('Y-m-d', mktime(0, 0, 0, date('m'), date('d')-6, date('Y')));
            $request_date_to = isset($_GET['date_to']) ? $_GET['date_to'] : date('Y-m-d');
            if($request_date_from > $request_date_to)
            {
                $temp = $request_date_from;
                $request_date_from = $request_date_to;
                $request_date_to = $temp;
                unset($temp);
            }
            strtotime($request_date_from) > time() && $request_date_from = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d')-7, date('Y')));
            strtotime($request_date_to) > time() && $request_date_to = date('Y-m-d');

            $data = Mystat_user_stat::instance()->get_user_grow($this->site_id, $request_date_from, $request_date_to);
            $csv_data = $data['day_data'];
            $total_data = $data['total'];
            $title = array(
                '0' => Kohana::lang('o_stat_usergrow.time'),
                '1' => Kohana::lang('o_stat_usergrow.count'),
            );
            array_unshift($csv_data, $title, $total_data);
            $csv = array();
            foreach($csv_data as $key_c_d => $_csv_data)
            {
                $csv_temp = array();
                foreach($_csv_data as $_s_d)                
                {
                    $csv_temp[] = $_s_d;
                }
                $csv[] = $csv_temp;
            }

            $csv = csv::encode($csv);
            $csv = iconv('UTF-8', 'GBK//IGNORE', $csv);

            if (!$this->is_ajax_request())
            {
                @header('Cache-control: private');
                @header('Content-Disposition: attachment; filename='.'user-grow-export-'.date('Ymd', time()).'.csv');
                @header('Content-type: text/csv; charset=GBK');
                echo $csv;
                exit;
            } else {
                $fid = uniqid().time();
                $dir = BES::config('stat.export_tmp_dir');
                $dir = rtrim(trim($dir), '/');
                if(!is_dir($dir) && !@mkdir($dir, 0777, TRUE))
                {
                    throw new MyRuntimeException(Kohana::lang('o_stat.export_crt_tmpdir_failed'));
                }
                $filename = $dir.'/'.$fid.'.csv';
                if(!@file_put_contents($filename, $csv))
                {
                    throw new MyRuntimeException(Kohana::lang('o_stat.export_wrt_tmp_failed'));
                }
            }

            $return_struct['status'] = 1;
            $return_struct['code'] = 200;
            $return_struct['msg'] = '';
            $return_struct['content'] = BES::url('userstat/usergrowstat/download',array('fid'=>$fid));
            if($this->is_ajax_request())
            {
                $this->template = $return_struct;
            }

        }catch(MyRuntimeException $ex){
            $return_struct['status'] = 0;
            $return_struct['code'] = $ex->getCode();
            $return_struct['msg'] = $ex->getMessage();
            //TODO 异常处理
            //throw $ex;
            if($this->is_ajax_request()){
                $this->template = $return_struct;
            }else{
                $this->template->return_struct = $return_struct;
                $this->template = BES::view('info');
                //* 返回结构体绑定 */
                $this->template->return_struct = $return_struct;
            }
        }
    }
    public function download()
    {
        $return_struct = array(
            'status' => 0,
            'code' => 501,
            'msg' => 'Not Implemented',
            'content' => array()
        );
        try{
            //* 权限验证 */
            if (empty($this->site_ids)) 
            {
                throw new MyRuntimeException(Kohana::lang('o_global.access_denied'), 403);
            }
            if ( $this->site_id <= 0 && !in_array($this->site_id, $this->site_ids)) 
            {
                throw new MyRuntimeException(Kohana::lang('o_global.select_site'), 400);
            }

            if (!isset($_GET['fid']))
            {
                throw new MyRuntimeException(Kohana::lang('o_stat.export_dwn_tmp_failed').$_GET['fid'], 400);
            }

            $fid = $_GET['fid'];
            $dir = BES::config('stat.export_tmp_dir');
            $dir = rtrim(trim($dir), '/');
            $filename = $dir.'/'.$fid.'.csv';
            if (!file_exists($filename) && is_readable($filename))
            {
                throw new MyRuntimeException(Kohana::lang('o_stat.export_dwn_tmp_failed').'2', 400);
            }

            $fp = @fopen($filename, 'rb');
            if ($fp)
            {
                @header('Cache-control: private');
                @header('Content-Disposition: attachment; filename='.'user-grow-export-'.date('Ymd', time()).'.csv');
                @header('Content-type: text/csv; charset=GBK');
                while (!feof($fp))
                {
                    echo fread($fp, 8192);
                }
            } else {
                throw new MyRuntimeException(Kohana::lang('o_stat.export_dwn_tmp_failed'.'3'), 400);
            }
            //@unlink($filename);

            exit;

            //* 补充&修改返回结构体 */
            $return_struct['status'] = 1;
            $return_struct['code'] = 200;
            $return_struct['msg'] = '';
            $return_struct['content'] = $fid;

            //* 请求类型 */
            if($this->is_ajax_request()){
                // ajax 请求
                // json 输出
                exit('Not Implemented');
                $this->template = $return_struct;
            }else{
                // html 输出
                //* 模板输出 */
                $content = new View($this->package . '/' . $this->class_name . '/' . __FUNCTION__);
                //* 变量绑定 */
                $this->template->title = BES::config('site.name');
                $this->template = $content;
                //* 返回结构体绑定 */
                $this->template->return_struct = $return_struct;
                //:: 当前应用专用数据
                $this->template->site_id = $site_id;
                $this->template->sites   = $sites;
                $this->template->classifies_html = $html;
            } // end of request type determine
        }catch(MyRuntimeException $ex){
            $return_struct['status'] = 0;
            $return_struct['code'] = $ex->getCode();
            $return_struct['msg'] = $ex->getMessage();
            //TODO 异常处理
            //throw $ex;
            if($this->is_ajax_request()){
                exit('Not Implemented');
                $this->template = $return_struct;
            }else{
                $this->template->return_struct = $return_struct;
                $this->template = BES::view('info');
                //* 返回结构体绑定 */
                $this->template->return_struct = $return_struct;
            }
        }
    }

    private function get_pic_src($data)
    {
        $ps1 = $ct = $chart_data = '';
        $user_max  = $user_min = 0;
        $count = 0;
        $chart_data = '';
        foreach ($data as $key_data => $_data)
        {
            $ct == '' ? $ct.= $_data['time'] : $ct.=','.$_data['time'];
            $ps1 == '' ? $ps1.=$_data['count'] : $ps1.=','.$_data['count'];

            $key_data == 0 && $sale_order_min = $_data['count'];
            ($_data['count'] > $user_max) && $user_max = $_data['count'];
            ($_data['count'] < $user_min) && $user_min = $_data['count'];

            $chart_data .= "{$_data['time']};{$_data['count']}\n";
            $count++;
            if($count >= 31)
                break;
        }
        $chart_data = urlencode($chart_data);
        $src2 = "/sitestat/chart?type=bg&w=800&h=300&ma=$user_max&mi=$user_min&r=10&t=会员增长&ct=$ct&sp=30&g=1&ps1=$ps1&clr1=255,0,0";
        $src1 = "/sitestat/chart?type=lc&w=800&h=300&ma=$user_max&mi=$user_min&r=10&t=会员增长&ct=$ct&sp=30&g=1&ps1=$ps1&clr1=255,0,0";
        $flash2 = "<embed wmode=\"transparent\" width=\"95%\" height=\"400\" flashvars=\"path=/statics/amline/&settings_file=/statics/amline/chart_settings/stat/stat_user".($this->getUrl() !='zh' ? '_en' : '').".xml?v=999&chart_data=$chart_data&preloader_color=#999999\" quality=\"high\" bgcolor=\"#FFFFFF\" name=\"img_src2\" id=\"img_src2\" style=\"display:none\" src=\"/statics/amline/amcolumn.swf\" type=\"application/x-shockwave-flash\">";
        $flash1 = "<embed  width=\"95%\" height=\"400\" flashvars=\"path=/statics/amline/&settings_file=/statics/amline/chart_settings/stat/stat_user".($this->getUrl() !='zh' ? '_en' : '').".xml?v=999&chart_data=$chart_data\" wmode=\"transparent\" quality=\"high\" bgcolor=\"#FFFFFF\" name=\"img_src1\" id=\"img_src1\" style=\"\" src=\"/statics/amline/amline.swf\" type=\"application/x-shockwave-flash\">";

        return array('src1' => $src1, 'src2' => $src2, 'flash1' => $flash1, 'flash2' => $flash2);
    }

	/**
     * 
     * 判断当前页面语言
     */
	public function getUrl()
    {
    	$url = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
    	$lang = '';
    	if(strpos($url,"/en/")==''){$lang = 'zh';}
    	return $lang;
    }
}
