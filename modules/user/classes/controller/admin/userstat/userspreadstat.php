<?php defined('SYSPATH') OR die('No direct access allowed.');
class Controller_Admin_Userstat_Userspreadstat extends Controller_Admin_Base
{

    /**
     * 每页的记录数
     *
     * @var int
     */
    public $per_page = 10;

    /**
     * 会员分布表
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
			//更新用户表的国家名字
            Model_Userstat::update_country_name();   

            $request_data = array();

            $count_sql = "SELECT count(DISTINCT `country_name`) as count FROM `users` WHERE 1=1 ";
            $user_total_sql = "SELECT count(*) as count FROM `users` WHERE 1=1 ";
            $user_sql = "SELECT count(*) as user_count, `country_name` FROM `users` WHERE 1=1 ";

            //时间，默认为到现在为止的时间
            $request_data['date_from'] = isset($_GET['date_from']) ? $_GET['date_from'] : date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + 1, date('Y') - 1));
            $request_data['date_to'] = isset($_GET['date_to']) ? $_GET['date_to'] : date('Y-m-d');
            if( isset($request_data['date_from']) && $request_data['date_from'] > $request_data['date_to']  )
            {
                $temp = $request_data['date_from'];
                $request_data['date_from'] = $request_data['date_to'];
                $request_data['date_to'] = $temp;
                unset($temp);
            }

            if( isset($request_data['date_from']) )
            {
                strtotime($request_data['date_from']) > time() && $request_data['date_from'] = date('Y-m-d');
                $count_sql .= " AND `date_add` >= '".$request_data['date_from']." 00:00:00' " ;
                $user_total_sql .= " AND `date_add` >= '".$request_data['date_from']." 00:00:00' " ;
                $user_sql .= " AND `date_add` >= '".$request_data['date_from']." 00:00:00' " ;
            }

            strtotime($request_data['date_to']) > time() && $request_data['date_to'] = date('Y-m-d');
            $count_sql .= " AND `date_add` <= '".$request_data['date_to']." 23:59:59' " ;
            $user_total_sql .= " AND `date_add` <= '".$request_data['date_to']." 23:59:59' " ;
            $user_sql .= " AND `date_add` <= '".$request_data['date_to']." 23:59:59' " ;

            //排序
            $orderby_arr = array(
                '0'     => 'user_count DESC',
                '1'     => 'user_count ASC',
                '2'     => 'country_name DESC',
                '3'     => 'country_name ASC',
            );
            if(isset($_GET['orderby']) && !empty($_GET['orderby']) && isset($orderby_arr[$_GET['orderby']]))
            {
                $request_data['orderby'] = $_GET['orderby'];
                $orderby_string = $orderby_arr[$_GET['orderby']];
            } else {
                $orderby_string = $orderby_arr[0];
            }
            $user_sql .= " GROUP BY `country_name` ORDER BY ".$orderby_string.", `id` ASC";

            $this->template = BES::view('userstat/userspreadstat/index');

            $count = Model_Userstat::get_country_count( $count_sql );
            $user_total = Model_Userstat::get_user_count($user_total_sql);

            /* 调用分页 */
            $this->pagination = new Pagination(array(
                'total_items'    => $count,
                'items_per_page' => $this->per_page,
            ));
            $user_sql .= "  LIMIT ".$this->pagination->offset." , ".$this->per_page;

            $data = Model_Userstat::get_userspread_stat($user_sql, $this->pagination->offset);
            foreach($data as $key_d =>$_data)
            {
                if($_data['user_count'] == 0 || $user_total == 0)
                {
                    $data[$key_d]['percentage'] = '0%';
                }else{
                    $data[$key_d]['percentage'] = number_format($_data['user_count']/$user_total*100, 2).'%';
                }
            }

            //得到图形参数
            $src_data = array();
            $src = $this->get_pic_src($data);
            if ($src == 'none') {
                $src_data['src1'] = $src;
                $src_data['flash1'] = $src;
            }else {
                $src_data['src1'] = $src['src1'];
                $src_data['flash1'] = $src['flash1'];
            }


            $this->template->data = $data;
            $this->template->src_data = $src_data;
            $this->template->request_data = $request_data;
            $this->template->user_total = $user_total;
            $this->template->pagination = $this->pagination;
            $this->template->site_name = '';
            $this->template->user_spread = 1;

        } catch ( Exception_BES $ex ) {
            $this->_ex($ex, $return_struct);
        }
    }

    private function get_pic_src($data)
    {
        if (empty($data)) {
            return 'none';
        }
        $ps = $pts = '';
        $chart_data = "[country_name];[user_count]\n";
        for ($i=0; $i<count($data); $i++){
            $ps .= ($ps == '') ? $data[$i]['user_count'] : ','.$data[$i]['user_count'];
            $pts .= ($pts == '') ? $data[$i]['country_name'] : ','.$data[$i]['country_name'];
            $chart_data .= "{$data[$i]['country_name']};{$data[$i]['user_count']}\n";
        }
        $chart_data = urlencode($chart_data);
        $src1 = "/sitestat/chart?type=pc&w=1000&h=250&ps=$ps&pts=$pts";
        $flash1 = "<embed wmode=\"transparent\" width=\"95%\" height=\"400\" flashvars=\"path=/statics/amline/&settings_file=/statics/amline/chart_settings/stat/userpie.xml&chart_data=$chart_data\" quality=\"high\" bgcolor=\"#FFFFFF\" name=\"amline\" id=\"amline\" style=\"\" src=\"/statics/amline/ampie.swf\" type=\"application/x-shockwave-flash\">";
        return array('src1'=>$src1, 'flash1'=>$flash1);

    }

}
