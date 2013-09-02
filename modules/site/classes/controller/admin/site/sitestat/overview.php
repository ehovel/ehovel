<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 *  访问量统计
 *
 * @copyright Copyright (c) 2011, Ketai inc.
 * @package Site
 * @category  Controller  
 * @since 2011-12-19
 * @author dongxiaoyu
 * @version   $Id$
 */

class Controller_Admin_Site_Sitestat_Overview extends Controller_Admin_Base 
{
	
	public $phprpc_server = '';
	public $time_offset = ' 00:00:00';
	
    public function before()
    {
        parent::before();
    	$TimeZone = "+0";
    	function_exists('date_default_timezone_set') && date_default_timezone_set('Etc/GMT'.$TimeZone.'');
    	
        $this->phprpc_server = EHOVEL::config('site_phprpc.remote.statking.host');
    }
    
    public function action_index()
    {
		$return_struct = array (
            'status' => 0,
            'code' => 501,
            'msg' => 'Not Implemented', 
            'content' => array () 
        );
        try {
        	$request_data = $this->request->query();
			$statking_id = EHOVEL::config('site_stat.statking_id');;
			$site_name = '';
			
			
            require_once DOCROOT.'lib/phprpc/phprpc_client.php';
			$client = new PHPRPC_Client($this->phprpc_server);
			$date_today = date('Y-m-d');
			
			//今日数据
			$phprpc_statking_key = EHOVEL::config('site_phprpc.remote.statking.api_key');
	        $args = array($statking_id, strtotime($date_today . $this->time_offset));
	        $sign = md5(json_encode($args).$phprpc_statking_key);
	        
			$today = $client->get_data_pv_ip_by_time($statking_id,strtotime($date_today . $this->time_offset), $sign );
			
			//昨日数据
			$phprpc_statking_key = EHOVEL::config('site_phprpc.remote.statking.api_key');
	        $args = array($statking_id, strtotime( date('Y-m-d', time()-86400) . $this->time_offset) );
	        $sign = md5(json_encode($args).$phprpc_statking_key);
			
			$yesterday = $client->get_data_pv_ip_by_time($statking_id,strtotime(date('Y-m-d', time()-86400) . $this->time_offset), $sign );
			//24小时流量
			$now_hour = intval(date('H'));
			$hours = array();
			$ps1 = $ps2 = $ct = $chart_data = '';
			$pv_max = $ip_min = 0;
			for ($i=$now_hour+1; $i<=23; $i++){
				$hours[]['h'] = $i;
				$hours[]['v'] = $yesterday['hours'][$i];
				$ct == '' ? $ct.=$i : $ct.=','.$i;
				$ps1 == '' ? $ps1.=$yesterday['hours'][$i]['pv'] : $ps1.=','.$yesterday['hours'][$i]['pv'];
				$ps2 == '' ? $ps2.=$yesterday['hours'][$i]['ip_count'] : $ps2.=','.$yesterday['hours'][$i]['ip_count'];
				$chart_data .= "{$i};{$yesterday['hours'][$i]['pv']};{$yesterday['hours'][$i]['ip_count']}\n";
				if ($yesterday['hours'][$i]['pv'] > $pv_max) {
					$pv_max = $yesterday['hours'][$i]['pv'];
				}
				$ip_min == 0 ? $ip_min = $yesterday['hours'][$i]['ip_count'] : '';
				if ($yesterday['hours'][$i]['ip_count'] < $ip_min) {
					$ip_min = $yesterday['hours'][$i]['ip_count'];
				}
			}
			for ($i=0; $i<= $now_hour; $i++){
				$hours[]['h'] = $i;
				$hours[]['v'] = $today['hours'][$i];
				$ct == '' ? $ct.=$i : $ct.=','.$i;
				$ps1 == '' ? $ps1.=$today['hours'][$i]['pv'] : $ps1.=','.$today['hours'][$i]['pv'];
				$ps2 == '' ? $ps2.=$today['hours'][$i]['ip_count'] : $ps2.=','.$today['hours'][$i]['ip_count'];
				$chart_data .= "{$i};{$today['hours'][$i]['pv']};{$today['hours'][$i]['ip_count']}\n";
				if ($today['hours'][$i]['pv'] > $pv_max) {
					$pv_max = $today['hours'][$i]['pv'];
				}
				$ip_min == 0 ? $ip_min = $today['hours'][$i]['ip_count'] : '';
				if ($today['hours'][$i]['ip_count'] < $ip_min) {
					$ip_min = $today['hours'][$i]['ip_count'];
				}
			}
			if ($pv_max == $ip_min) {
				$pv_max = $ip_min+10;
			}
			$src1 = "site/sitestat/chart?type=lc&w=800&h=300&ma=$pv_max&mi=$ip_min&r=10&t=pv-ip&ct=$ct&sp=30&g=2&ps1=$ps1&ps2=$ps2&clr1=255,0,0&clr2=0,255,0";
			$src2 = "site/sitestat/chart?type=bg&w=800&h=300&ma=$pv_max&mi=$ip_min&r=10&t=pv-ip&ct=$ct&sp=30&g=2&ps1=$ps1&ps2=$ps2&clr1=255,0,0&clr2=0,255,0";
			$flash1 = "<embed width=\"95%\" height=\"400\" flashvars=\"path=/statics/amline/&settings_file=/statics/amline/chart_settings/pv_ip.xml&chart_data=$chart_data\" wmode=\"transparent\" quality=\"high\" bgcolor=\"#FFFFFF\" name=\"img_src1\" id=\"img_src1\" style=\"\" src=\"/statics/amline/amline.swf\" type=\"application/x-shockwave-flash\">";
			$flash2 = "<embed wmode=\"transparent\" width=\"95%\" height=\"400\" flashvars=\"path=/statics/amline/&settings_file=/statics/amline/chart_settings/pv_ip.xml&chart_data=$chart_data&preloader_color=#999999\" quality=\"high\" bgcolor=\"#FFFFFF\" name=\"img_src2\" id=\"img_src2\" style=\"display:none\" src=\"/statics/amline/amcolumn.swf\" type=\"application/x-shockwave-flash\">";
			
			//站点概况
			$phprpc_statking_key = EHOVEL::config('site_phprpc.remote.statking.api_key');
	        $args = array($statking_id);
	        $sign = md5(json_encode($args).$phprpc_statking_key);
	        
			$overview = $client->get_data_pv_ip_by_one_site($statking_id, $sign);
			
			//来路域名
			$phprpc_statking_key = EHOVEL::config('site_phprpc.remote.statking.api_key');
	        $args = array( $statking_id, strtotime($date_today . $this->time_offset)-86400*7, strtotime($date_today . $this->time_offset)-86400 );
	        $sign = md5(json_encode($args).$phprpc_statking_key);
	        
			$domains_all = $client->get_data_domain_by_time_range($statking_id, strtotime($date_today . $this->time_offset)-86400*7, strtotime($date_today . $this->time_offset)-86400, 0, 1, 10, $sign);
			$domains = $domains_all['data'];
			
			//受访页面
			$phprpc_statking_key = EHOVEL::config('site_phprpc.remote.statking.api_key');
	        $args = array( $statking_id, strtotime($date_today . $this->time_offset)-86400*7, strtotime($date_today . $this->time_offset)-86400 );
	        $sign = md5(json_encode($args).$phprpc_statking_key);
	        
			$pages_all = $client->get_data_page_by_time_range($statking_id, strtotime($date_today . $this->time_offset)-86400*7, strtotime($date_today . $this->time_offset)-86400, 0, 1, 10, $sign);
			$pages = $pages_all['data'];
			
			//地区分布
			$phprpc_statking_key = EHOVEL::config('site_phprpc.remote.statking.api_key');
	        $args = array( $statking_id, strtotime($date_today . $this->time_offset)-86400*7, strtotime($date_today . $this->time_offset)-86400 );
	        $sign = md5(json_encode($args).$phprpc_statking_key);
	        
			$areas_all = $client->get_data_country_by_time_range($statking_id, strtotime($date_today . $this->time_offset)-86400*7, strtotime($date_today . $this->time_offset)-86400, 0, 1, 10, $sign);
			$areas = $areas_all['data'];
			
			$ps = $pts = '';
			$chart_data = "[title];[value]\n";
			for ($i=0; $i<count($areas); $i++){
				$ps .= ($ps == '') ? $areas[$i]['pv'] : ','.$areas[$i]['pv'];
				$pts .= ($pts == '') ? $areas[$i]['name'] : ','.$areas[$i]['name'];
				$chart_data .= "{$areas[$i]['name']};{$areas[$i]['pv']}\n";
			}
			$chart_data = urlencode($chart_data);
			$src3 = "site/site_sitestat/chart?type=pc&w=400&h=200&ps=$ps&pts=$pts";
			$flash3 = "<embed wmode=\"transparent\" width=\"95%\" height=\"400\" flashvars=\"path=/statics/amline/&settings_file=/statics/amline/chart_settings/pie.xml&chart_data=$chart_data\" quality=\"high\" bgcolor=\"#FFFFFF\" name=\"amline\" id=\"amline\" style=\"\" src=\"/statics/amline/ampie.swf\" type=\"application/x-shockwave-flash\">";
			
			$this->template = EHOVEL::view('site/sitestat/overview/index');
			$this->template->site_name = $site_name;
			$this->template->overview = 1;
			$this->template->today_pv_ip     = $today['day'];
			$this->template->yesterday_pv_ip = $yesterday['day'];
			$this->template->average         = $overview['average'];
			$this->template->highest         = $overview['highest'];
			$this->template->total           = $overview['total'];
			$this->template->src1            = $src1;
			$this->template->src2            = $src2;
			$this->template->src3            = $src3;
			$this->template->flash1          = $flash1;
			$this->template->flash2          = $flash2;
			$this->template->flash3          = $flash3;
			$this->template->domains         = $domains;
			$this->template->pages           = $pages;
				
        } catch ( Kohana_Exception $ex ) {
            Remind::factory($ex)
                ->send();
        }
		
	}
}
