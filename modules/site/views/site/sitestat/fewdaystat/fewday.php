<?php defined('SYSPATH') OR die('No direct access allowed.');?>
<section id="content">
	<section class="container_12 clearfix">
		<section id="main" class="grid_9 push_3">
			<article>
				<h1><?php echo __('Time Analysis')?><?php if(isset($isrecent7days)) echo " | ".__('Last 7 Days');  if(isset($isthismonth)) echo " | ".__('This Month Statistics');  if(isset($isrecent30days)) echo " | ".__('Last 30 Days'); ?> （<?php echo $data['date_from'] ?> —— <?php echo $data['date_to']; ?>）</h1>
				<div class="warning msg">
                    <span class="fB"><?php echo __('Tips')?>：</span> 	<?php echo __('Time for you provide the corresponding analysis web site in the time flow changes. Can point DuoRi flow and query, choose according to need.')?>
				</div>
                <div class="date">
                	<span style="float:left">
                		<a href="/site_sitestat_fewdaystat/recent7days" <?php if(isset($isrecent7days)) echo "class=\"current\""; ?>><?php echo __('Last 7 Days')?></a> | 
                		<a href="/site_sitestat_onedaystat"><?php echo __('Today')?></a> | 
                		<a href="/site_sitestat_onedaystat/yesterday"><?php echo __('Yesterday')?></a> | 
                		<a href="/site_sitestat_fewdaystat" <?php if(isset($isthismonth)) echo "class=\"current\""; ?>><?php echo __('Current Month')?></a> | 
                		<a href="/site_sitestat_fewdaystat/recent30days" <?php if(isset($isrecent30days)) echo "class=\"current\""; ?>><?php echo __('Last 30 Days')?></a> 
                		[<a href="/site_sitestat_onedaystat/oneday?date=<?php echo date('Y-m-d',strtotime($data['date_from'])-86400) ?>"><?php echo __('Previous Day')?></a>] 
                		[<a href="/site_sitestat_onedaystat/oneday?date=<?php echo date('Y-m-d',strtotime($data['date_to'])+86400) ?>"><?php echo __('Next Day')?></a>]
                		&nbsp;&nbsp;&nbsp;&nbsp;
                	</span>
					
          <form method="POST" action="/site_sitestat_fewdaystat/fewdays">
					<?php echo __('From')?><input type="text" name="time_from" id="time_from" value="<?php echo $data['date_from'] ?>" readonly style="vertical-align:top;">
					<?php echo __('To')?><input type="text" name="time_to" id="time_to" value="<?php echo $data['date_to'] ?>" readonly style="vertical-align:top;"><input type="submit" value="<?php echo __('Search')?>">&nbsp;&nbsp;
					<script type="text/javascript">
					$(document).ready(function(){
						$(function() {
							$("#time_from").datepicker({dateFormat: 'yy-mm-dd'});
						});
						$(function() {
							$("#time_to").datepicker({dateFormat: 'yy-mm-dd'});
						});
					});
					</script>
					</form>
                </div>
                <div>
                    <div style="float:left;padding-left:10px;line-height:30px;"><h2><?php echo __('Date Period Of Distribution')?></h2></div>
                    <div style="float:right;line-height:50px;"><a id="link_src1" class="piccurrent" href="javascript:" onclick="exchangepic('img_src1','link_src1')"><?php echo __('Line Graph')?></a> | <a id="link_src2" href="javascript:" onclick="exchangepic('img_src2','link_src2')"><?php echo __('Bar Graph')?></a></div>
                    <div class="clear"></div>
                </div>
                <div class="tab_title_box fixfloat">
                <script type="text/javascript">
                function exchangepic(id1, id2){
                    $('#img_src1').hide();
                    $('#link_src1').removeClass('piccurrent');
                    $('#img_src2').hide();
                    $('#link_src2').removeClass('piccurrent');
                    $('#'+id1).show();
                    $('#'+id2).addClass('piccurrent');
                }
                </script>
                <style>
                .piccurrent { background:none repeat scroll 0 0 #5C7AA0;color:#FFFFFF;padding:2px 4px;text-decoration:none; }
                </style>
                    <div>
                        <?php echo $data['flash1'] ?>
                        <?php echo $data['flash2'] ?>
                        <script language="JavaScript">
                         <!-- Author By dbcweb.cn
                          function killErrors() {
                           return true;
                           }
                          window.onerror = killErrors;
                          // -->
                          </script>
                    </div>
                </div>
                    <div class="tab_content_box" style="border-top:1px solid #98AED0;">
                       <table cellspacing="0" cellpadding="0" class="gtable detailtable">
						<tr>
						<th><?php echo __('Date')?></th><th>pv</th><th>IP</th><th><?php echo __('Browse Number Per Capita')?></th><th><?php echo __('Accounts For More Than')?>（<?php echo __('Everyday PV')?>/<?php echo __('Total PV')?>）</th>
						</tr>
						<?php
						for ($i=0; $i<count($data['dates']); $i++){
							echo "
							<tr>
							<td>{$data['dates'][$i]['date']}</td><td>{$data['dates'][$i]['pv']}</td><td>{$data['dates'][$i]['ip']}</td><td>{$data['dates'][$i]['pv_ip']}</td><td><img width=\"{$data['dates'][$i]['pv_length']}\" height=\"10\" border=\"0\" src=\"/images/bar1.gif\">{$data['dates'][$i]['pv_rate']}</td>
							</tr>
							";
						}
						?>
						</table>
                    </div>
			</article>
		</section>
		<aside id="sidebar" class="grid_3 pull_9">
    <div class="box menu">
        <h2><?php echo __('Access Statistics Analysis')?></h2>
        <section>
            <ul>
                <li><?php echo __('Online')?>
                    <ul>
                        <li<?php if (isset($overview)){ echo " class=\"current\""; } ?>><a href="/site_sitestat_overview"><?php echo __('Statistics Overview')?></a></li>
                    </ul>
                </li>
                <li><?php echo __('Time Analysis')?>
                    <ul>
                        <li<?php if (isset($fewdaystat_recent7days)){ echo " class=\"current\""; } ?>><a href="/site_sitestat_fewdaystat/recent7days"><?php echo __('Last 7 Days')?></a></li>
                        <li<?php if (isset($onedaystat)){ echo " class=\"current\""; } ?>><a href="/site_sitestat_onedaystat"><?php echo __('Today Statistics')?></a></li>
                        <li<?php if (isset($onedaystat_yesterday)){ echo " class=\"current\""; } ?>><a href="/site_sitestat_onedaystat/yesterday"><?php echo __('Yesterday Statistics')?></a></li>
                        <li<?php if (isset($fewdaystat)){ echo " class=\"current\""; } ?>><a href="/site_sitestat_fewdaystat"><?php echo __('This Month Statistics')?></a></li>
                        <li<?php if (isset($fewdaystat_recent30days)){ echo " class=\"current\""; } ?>><a href="/site_sitestat_fewdaystat/recent30days"><?php echo __('Last 30 Days')?></a></li>
                    </ul>
                </li>
            </ul>
        </section>
    </div>
</aside>
	</section>
</section>
