<?php defined('SYSPATH') OR die('No direct access allowed.');?>
<section id="content">
	<section class="container_12 clearfix">
		<section id="main" class="grid_9 push_3">
			<article>
				<h1><?php echo __('Time Analysis')?><?php if(isset($istoday)) echo " | ".__('Today Statistics'); if(isset($isyesterday)) echo " | ".__('Yesterday Statistics'); ?>（<?php echo $data['date']; ?> —— <?php echo $data['date']; ?>）</h1>
				<div class="warning msg">
                    <span class="fB"><?php echo __('Tips')?>：</span> 	<?php echo __('Time for you provide the corresponding analysis web site in the time flow changes. Can point DuoRi flow and query, choose according to need.')?>
				</div>
                <div class="date">
                	<span style="float:left">
                		<a href="/site_sitestat_fewdaystat/recent7days"><?php echo __('Last 7 Days')?></a> | 
                		<a href="/site_sitestat_onedaystat" <?php if(isset($istoday)) echo "class=\"current\""; ?>><?php echo __('Today')?></a> | 
                		<a href="/site_sitestat_onedaystat/yesterday" <?php if(isset($isyesterday)) echo "class=\"current\""; ?>><?php echo __('Yesterday')?></a> | 
                		<a href="/site_sitestat_fewdaystat"><?php echo __('Current Month')?></a> | 
                		<a href="/site_sitestat_fewdaystat/recent30days"><?php echo __('Last 30 Days')?></a> 
                		[<a href="/site_sitestat_onedaystat/oneday?date=<?php echo date('Y-m-d', strtotime($data['date'])-86400) ?>"><?php echo __('Previous Day')?></a>] 
                		[<a href="/site_sitestat_onedaystat/oneday?date=<?php echo date('Y-m-d', strtotime($data['date'])+86400) ?>"><?php echo __('Next Day')?></a>]
                		&nbsp;&nbsp;&nbsp;&nbsp;
                	</span>
          
					<form method="POST" action="/site_sitestat_fewdaystat/fewdays">
					<?php echo __('From')?><input type="text" name="time_from" id="time_from" value="<?php echo $data['date']; ?>" readonly style="vertical-align:top;">
					<?php echo __('To')?><input type="text" name="time_to" id="time_to" value="<?php echo $data['date']; ?>" readonly style="vertical-align:top;"><input type="submit" value="<?php echo __('Search')?>">&nbsp;&nbsp;
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
                <div class="out_box">
                    <table cellspacing="0" cellpadding="0" class="gtable detailtable">
                        <thead>
                            <tr>
                                <th colspan="6"><span class="left fB f14px"><?php echo __('Th Traffic Distribution')?></span></th>
                            </tr>
                            <tr class="headings">
                                <th width="18%"><?php echo __('Date')?></th>
                                <th width="11%">PV</th>
                                <th width="11%">IP</th>
                                <th width="13%"><?php echo __('Browse Number Per Capita')?></th>
                                <th width="36%"><?php echo __('Accounts For More Than')?>（<?php echo __('Everyday PV')?>/<?php echo __('Total PV')?>）</th>
                            </tr>	
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $data['date']; ?></td>
                                <td><?php echo $data['date_pv']?></td>
                                <td><?php echo $data['date_ip']?></td>
                                <td><?php echo $data['date_pv_ip'] ?></td>
                                <td><img width="200" height="10" border="0" src="/images/bar1.gif"> 100%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <div style="float:left;padding-left:10px;line-height:30px;"><h2><?php echo __('Hour Period Distribution')?></h2></div>
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
						    <th><?php echo __('Hour Period')?></th><th>pv</th><th>IP</th><th><?php echo __('Browse Number Per Capita')?></th><th><?php echo __('Accounts For More Than')?>（<?php echo __('Per Hour PV')?>/<?php echo __('Total PV')?>）</th>
						</tr>
						<?php
						for ($i=0; $i<count($data['hours']); $i++){
							$i_1 = $i+1;
							echo "
							<tr>
							<td>{$i}:00—{$i_1}:00</td><td>{$data['hours'][$i]['pv']}</td><td>{$data['hours'][$i]['ip']}</td><td>{$data['hours'][$i]['pv_ip']}</td><td><img width=\"{$data['hours'][$i]['pv_length']}\" height=\"10\" border=\"0\" src=\"/images/bar1.gif\">{$data['hours'][$i]['pv_rate']}</td>
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
