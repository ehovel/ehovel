<?php defined('SYSPATH') OR die('No direct access allowed.');
class Controller_Admin_Userstat_Userstat extends Controller_Admin_Base
{
    /**
     * 每页的记录数
     *
     * @var int
     */
    public $per_page = 20;

    /**
     * 会员排行表
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
            $request_data = array();

            $user_count_sql = "SELECT count(DISTINCT `email`) as count FROM `orders` WHERE 1=1 ";
            $user_sql = "SELECT count(*) as order_count, `email`, sum(total) as user_total FROM `orders` WHERE 1=1 ";

            //时间，默认为到现在为止一年的时间
            $request_data['date_from'] = isset($_GET['date_from']) ? $_GET['date_from'] : date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + 1, date('Y') - 1));
            $request_data['date_to'] = isset($_GET['date_to']) ? $_GET['date_to'] : date('Y-m-d');
            if( $request_data['date_from'] > $request_data['date_to']  )
            {
                $temp = $request_data['date_from'];
                $request_data['date_from'] = $request_data['date_to'];
                $request_data['date_to'] = $temp;
                unset($temp);
            }

            strtotime($request_data['date_from']) > time() && $request_data['date_from'] = date('Y-m-d');
            $user_count_sql .= " AND `date_add` >= '".$request_data['date_from']." 00:00:00' " ;
            $user_sql .= " AND `date_add` >= '".$request_data['date_from']." 00:00:00' " ;

            strtotime($request_data['date_to']) > time() && $request_data['date_to'] = date('Y-m-d');
            $user_count_sql .= " AND `date_add` <= '".$request_data['date_to']." 23:59:59' " ;
            $user_sql .= " AND `date_add` <= '".$request_data['date_to']." 23:59:59' " ;

            //其他条件
            $request_field = array('pay_status', 'order_status', 'ship_status');
            foreach($request_field as $key_status => $_status)
            {
                if(isset($_GET[$_status]) && !empty($_GET[$_status]))
                {
                    $request_data[$_status] = $_GET[$_status];
                    //$query_struct['where'][$_status] = $request_data[$_status];
                    $user_count_sql .= " AND `".$_status."` = '".$request_data[$_status]."' " ;
                    $user_sql .= " AND `".$_status."` = '".$request_data[$_status]."' " ;
                }
            }

            // 订单状态，支付状态，物流状态 
            $order_status = BES::config('userstat.order_status');
            $pay_status   = BES::config('userstat.pay_status');
            $ship_status  = BES::config('userstat.ship_status');

            //排序
            $orderby_arr = array(
                '0'     => 'user_total DESC',
                '1'     => 'user_total ASC',
                '2'     => 'order_count DESC',
                '3'     => 'order_count ASC',
            );
            if(isset($_GET['orderby']) && !empty($_GET['orderby']) && isset($orderby_arr[$_GET['orderby']]))
            {
                $request_data['orderby'] = $_GET['orderby'];
                $orderby_string = $orderby_arr[$_GET['orderby']];
            } else {
                $orderby_string = $orderby_arr[0];
            }
            $user_sql .= " GROUP BY `email` ORDER BY ".$orderby_string.", `email` ASC";

            $this->template = BES::view('userstat/userstat/index');

            $count = Model_Userstat::get_user_count($user_count_sql);
            
            //得到一个站点的基准币种
            $base_currency_sign = '';
            $default_currency = BES::model('site_currency')->get_default();
            if(!empty($default_currency))
            {
                $base_currency_sign = $default_currency->cur_sign;
            }

            /* 调用分页 */
            $this->pagination = new PaginationAdmin(array(
                'total_items'    => $count,
                'items_per_page' => $this->per_page,
            ));
            $user_sql .= "  LIMIT ".$this->pagination->offset." , ".$this->per_page;

            $data = Model_Userstat::get_user_stat($user_sql, $this->pagination->offset);

            $this->template->data = $data;
            $this->template->request_data = $request_data;
            $this->template->count = $count;
            $this->template->base_currency_sign = $base_currency_sign;
            $this->template->pay_status = $pay_status;
            $this->template->order_status = $order_status;
            $this->template->ship_status = $ship_status;
            $this->template->pagination = $this->pagination;
            $this->template->site_name = '';
            $this->template->userstat = 1;

        } catch ( Exception_BES $ex ) {
            $this->_ex($ex, $return_struct);
        }
    }

}
