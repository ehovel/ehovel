<div class="new_count_tab">
	<ul>
		<li class="main"></li>
		<li <?php if (isset($userstat)){ echo "class=\"current\""; } ?>><a href="/userstat/userstat">会员排行</a></li>
		<li class="main">会员分布</li>
		<li <?php if (isset($user_spread)){ echo "class=\"current\""; } ?>><a href="/userstat/userspreadstat">会员分布</a></li>  
		<li class="main">会员增长</li>
		<li <?php if (isset($user_day_grow)){ echo "class=\"current\""; } ?>><a href="/userstat/usergrowstat/index">自定义时间报表</a></li>
		<li <?php if (isset($user_month_grow)){ echo "class=\"current\""; } ?>><a href="/userstat/usergrowstat/month">按月查看报表</a></li>
		<li <?php if (isset($user_year_grow)){ echo "class=\"current\""; } ?>><a href="/userstat/usergrowstat/year">按年查看报表</a></li>
	</ul>
</div>