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

ini_set('display_errors',0);

class Controller_Chart extends Controller {
	
	
	public function action_index(){
		$chart_dir = dirname(__FILE__).'/chart/';
		if ($_GET['type'] == 'lc') {
			require_once($chart_dir.'drawLineChart.php');
		}elseif ($_GET['type'] == 'bg'){
			require_once($chart_dir.'drawBarGraph.php');
		}elseif ($_GET['type'] == 'pc'){
			require_once($chart_dir.'drawPieChart.php');
		}
	}
	
	public function action_description(){
		$chart_dir = dirname(__FILE__).'/chart/';
		echo file_get_contents($chart_dir.'chart.html');
	}
}
