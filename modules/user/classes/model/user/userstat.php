<?php
// $Id$
/**
 * 会员统计模型
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package 
 * @since 2011-10-24
 * @author fanchongyuan
 * @version $Id$
 */
class Model_Userstat
{
	/**
	 * 得到站点的会员总数
	 * @param array $active 会员状态
	 * @param String $date_from 开始时间
	 * @param String $date_to 结构时间
	 * 
	 * @return int
	 */
    public static function count($active_arr = array('Y'), $date_to='')
    {
		try{
			$user_count = 0;
			$user_model = Kapp::model('user');
			
			/* 时间验证 */
            if(!empty($date_to))
            {
                $user_model = $user_model->where('date_add','<=',$date_to);
			}
            if(!empty($active_arr))
            {
                $user_model = $user_model->where('active','in',$active_arr);
            }
			
            $user_count = $user_model->count_all();
			return $user_count;
		} catch (Exception_Kapp $ex) {
			throw $ex;
		}
	} 

    /**
     * 依据sql得到用户个数
     *
     * @param String $sql
     * @return Int
     * @author luolei
     */
    public static function get_user_count($sql)
    {
        $db = Database::instance();
        $query = $db->query(Database::SELECT,$sql,true)->current();
        $count = 0;
        if($query->count)
        {
            $count = $query->count;
        }
        return $count;
    }

    /**
     * 依据sql得到会员排行报表
     *
     * @param String $sql
     *
     * @return Array
     * @author luolei
     */
    public static function get_user_stat ($sql, $rank_begin = 0)
    {
        $result = array();
        $db = Database::instance();
        $query = $db->query(Database::SELECT,$sql)->as_array();
        foreach($query as $key_q => $_query)
        {
            $query[$key_q]['rank'] = $key_q + $rank_begin + 1;
        }
        return $query;
    }

    /**
     * 更新user表中country_name
     *
     * @return Array
     * @author luolei
     */
    public static function update_country_name()
    {
        $user_list = Kapp::model('user')->where('country_name','=','NULL')->order_by('ip','ASC')->limit(500)->offset(0)->find_all();
        foreach($user_list as $key_user => $_user)
        {
            $_user = $_user->as_array();
            $country_name = '';
            $ip = $_user['ip'];
            if ( !preg_match( "/^\\d{1,3}\\.\\d{1,3}\\.\\d{1,3}\\.\\d{1,3}\$/", $ip ) )
            {
                $country_name = 'IANA';
            } else {
                $ip_inf = @file_get_contents('http://api.ipinfodb.com/v3/ip-city/?key=8700aa98c8761dd96f1b10728e1b36739aa2e31f18795d69f874b27176e43819&ip='.$ip);
                if ($ip_inf) {
                    list(
                        $status_code,
                        $status_message,
                        $ip_address,
                        $country_code,
                        $country_name,
                        $region_name,
                        $city_name,
                        $zip_code,
                        $latitude,
                        $longitude,
                        $timezone
                    ) = explode(';', $ip_inf);
                }
                $country_name == ':' && $country_name = 'IANA';
            }
            $user_model = Kapp::model('user',$_user['id']);
            if($user_model->loaded())
            {
                $user_model->country_name = $country_name;
            }
            $user_model->save();
        }
    } 

    /**
     * 依据sql得到国家个数
     *
     * @param String $sql
     * @return Int
     * @author luolei
     */
    public static function get_country_count( $sql )
    {
        $db = Database::instance();
        $query = $db->query(Database::SELECT,$sql,true)->current();
        $count = 0;
        if($query->count)
        {
            $count = $query->count;
        }
        return $count;
    }

    /**
     * 依据sql得到会员分布报表
     *
     * @param String $sql
     *
     * @return Array
     * @author luolei
     */
    public static function get_userspread_stat ( $sql, $rank_begin = 0 )
    {
        $result = array();
        $db = Database::instance();
        $query = $db->query(Database::SELECT,$sql)->as_array();
        foreach($query as $key_q => $_query)
        {
            $query[$key_q]['rank'] = $key_q + $rank_begin + 1;
        }
        return $query;
    }

    /** 
     * 自定义时间会员增长数据
     *
     * @param String $date_from 
     * @param String $date_to
     *
     * @return Array
     * @author
     */ 
    public static function get_user_grow($date_from, $date_to) 
    { 
        $result = array(); 
        $time_begin = strtotime($date_from); 
        $time_end = strtotime($date_to) + 86400; 
        $day_data = array(); 
        $total = array( 
            'time'          => '', 
            'count'         => 0, 
        ); 
        for($time_temp = $time_begin; $time_temp <= $time_end - 1; $time_temp += 86400) 
        { 
            $data_temp = array( 
                'time'          => '', 
                'count'         => 0, 
            ); 
            $day_begin = date('Y-m-d H:i:s', $time_temp); 
            $day_end = date('Y-m-d H:i:s', $time_temp + 86400); 
            $data_temp['time'] = date('Y-m-d', $time_temp); 
            $data_temp['count'] = Kapp::model('user')->where('date_add','>=',$day_begin)->and_where('date_add','<=',$day_end)->count_all();
 
            $total['count'] += $data_temp['count']; 
            $day_data[] = $data_temp; 
        } 
        $result['total'] = $total; 
        $result['day_data'] = $day_data; 
        return $result; 
    }

    /** 
     * 月度会员增长
     *
     * @param Int $year
     * @param Int $month
     *
     * @return Array
     * @author
     */ 
    public static function get_month_user_grow($year, $month) 
    { 
        $result = array(); 
        $date_begin = $year.'-'.$month.'-'.'01'; 
        $date_end = ''; 
        if($month < 12) 
        { 
            $month += 1; 
            $date_end = $year.'-'.$month.'-'.'01'; 
        }else{ 
            $year += 1; 
            $date_end = $year.'-01-01'; 
        } 
        $time_begin = strtotime($date_begin); 
        $time_end = strtotime($date_end); 
        $time_end > time() && $time_end = time(); 
        $day_data = array(); 
        $total = array( 
            'time'          => '', 
            'count'         => 0, 
        ); 
        for($time_temp = $time_begin; $time_temp <= $time_end - 1; $time_temp += 86400) 
        { 
            $data_temp = array( 
                'time'          => '',
                'count'         => 0, 
            ); 
            $day_begin = date('Y-m-d H:i:s', $time_temp); 
            $day_end = date('Y-m-d H:i:s', $time_temp + 86400); 
            $data_temp['time'] = date('Y-m-d', $time_temp); 
            $data_temp['count'] = Kapp::model('user')->where('date_add','>=',$day_begin)->and_where('date_add','<=',$day_end)->count_all();
            $total['count'] += $data_temp['count']; 
            $day_data[] = $data_temp; 
        } 
        $result['total'] = $total; 
        $result['day_data'] = $day_data; 
        return $result; 
    }

    /** 
     * 年度会员增长
     *
     * @param Int $year
     *
     * @return Array
     * @author
     */ 
    public function get_year_user_grow($year) 
    { 
        $result = array(); 
        $month_data = array(); 
        $total = array( 
            'time'          => '', 
            'count'         => 0, 
        ); 
        for($i = 1; $i <= 12; ) 
        { 
            $data_temp = array( 
                'time'          => ' ', 
                'count'         => 0, 
            ); 
            $month_begin = $year.'-'.$i.'-01 00:00:00'; 
            $time_begin = strtotime($month_begin); 
            $data_temp['time'] = date('Y-m', $time_begin); 
            $i++; 
            if(13 == $i) 
            { 
                $year++; 
                $month_end = $year.'-01-01 00:00:00'; 
            }else{ 
                $month_end = $year.'-'.$i.'-01 00:00:00'; 
            } 
            $time_end = strtotime($month_end); 
            $month_begin = date('Y-m-d H:i:s', $time_begin); 
            $month_end = date('Y-m-d H:i:s', $time_end); 

            $data_temp['count'] = Kapp::model('user')->where('date_add','>=',$month_begin)->and_where('date_add','<=',$month_end)->count_all();
 
            $total['count'] += $data_temp['count']; 
            $month_data[] = $data_temp; 
            if($time_end > time()) 
            { 
                break; 
            } 
        } 
        $result['total'] = $total; 
        $result['month_data'] = $month_data; 
        return $result; 
    }  
}
