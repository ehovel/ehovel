<?php defined('SYSPATH') OR die('No direct access allowed.');?>
<section id="content">
	<section class="container_12 clearfix">
		<section id="main" class="grid_9 push_3">
			<article>
				<h1><?php echo __('Statistics Overview')?>（<?php echo date('Y-m-d') ?>）</h1>
				<div class="warning msg">
                    <span class="fB"><?php echo __('Tips')?>：</span> 	<?php echo __('Statistical survey to provide you with the basic situation of the current web site.')?>
				</div>
                <table id="table2" class="gtable detailtable">
					<thead>
						<tr>
                            <th colspan="5"><span class="left fB f14px"><?php echo __('Traffic Overview')?></span></th>
						</tr>
                        <tr class="headings">
                            <th width="18%"></th>
                            <th width="11%">PV</th>
                            <th width="11%">IP</th>
                            <th width="10%"><?php echo __('Add IP')?></th>
                            <th width="13%"><?php echo __('Browse Number Per Capita')?></th>
                        </tr>	
					</thead>
                    <tbody>
                        <tr class="odd">
                            <td><?php echo __('Today')?>：</td>
                            <td><?php echo $today_pv_ip['pv'] ?></td>
                            <td><?php echo $today_pv_ip['ip_count'] ?></td>
                            <td><?php echo $today_pv_ip['ip_new'] ?></td>
                            <td><?php echo $today_pv_ip['ip_count'] == 0 ? 0 : substr($today_pv_ip['pv']/$today_pv_ip['ip_count'],0,5) ?></td>
                        </tr>
                        <tr class="odd">
                            <td><?php echo __('Yesterday')?>：</td>
                            <td><?php echo $yesterday_pv_ip['pv'] ?></td>
                            <td><?php echo $yesterday_pv_ip['ip_count'] ?></td>
                            <td><?php echo $yesterday_pv_ip['ip_new'] ?></td>
                            <td><?php echo $yesterday_pv_ip['ip_count'] == 0 ? 0 : substr($yesterday_pv_ip['pv']/$yesterday_pv_ip['ip_count'],0,5) ?></td>
                        </tr>
                        <tr class="even">
                            <td><?php echo __('Daily Average')?>：</td>
                            <td><?php echo $average['pv'] ?></td>
                            <td><?php echo $average['ip_count'] ?></td>
                            <td></td><td></td>
                        </tr>
                        <tr class="even">
                            <td><?php echo __('Historical Highest')?>：</td>
                            <td><?php echo $highest['pv'] ?></td>
                            <td><?php echo $highest['ip_count'] ?></td>
                            <td></td><td></td>
                        </tr>
                        <tr class="even">
                            <td><?php echo __('Historical Cumulative')?>：</td>
                            <td><?php echo $total['pv'] ?></td>
                            <td><?php echo $total['ip_count'] ?></td>
                            <td></td><td></td>
                        </tr>
                    </tbody>
				</table>
                <div>
                    <div style="float:left;padding-left:10px;line-height:30px;"><h2><?php echo __('Recent 24 Hours Flow Trend')?></h2></div>
                    <div style="float:right;line-height:50px;"><a id="link_src1" class="piccurrent" href="javascript:" onclick="exchangepic('img_src1','link_src1')"><?php echo __('Line Graph')?></a> | <a id="link_src2" href="javascript:" onclick="exchangepic('img_src2','link_src2')"><?php echo __('Bar Graph')?></a></div>
                    <div class="clear"></div>
                </div>
                <div class="tab_title_box fixfloat">
                  <script type="text/javascript">
                        function exchangepic(id1, id2){
                            $('#img_src1').hide();
                            $('#link_src1').removeClass('current');
                            $('#img_src2').hide();
                            $('#link_src2').removeClass('current');
                            $('#'+id1).show();
                            $('#'+id2).addClass('current');
                        }
                        </script>
                  
                  <div> 
                                    <?php echo $flash1 ?>
                        			<?php echo $flash2 ?>
                    <script language="JavaScript">
                                // <!-- Author By dbcweb.cn
                                  function killErrors() {
                                   return true;
                                   }
                                  window.onerror = killErrors;
                                  // -->
                                  </script>
                  </div>
                </div>
                <div class="out_box fixfloat">
                    <table cellspacing="0" cellpadding="0" style="width: 48%;float:left;" class="gtable detailtable">
                        <thead>
                            <tr>
                                <th><span class="left fB f14px"><?php echo __('Last 7 Days Domain Name')?></span></th><th></th>
                            </tr>
                            <tr class="headings">
                                <th><?php echo __('Domain Name URL')?></th>
                                <th><?php echo __('Visit Number')?></th>
                            </tr>	
                        </thead>

                        <tbody>
                        	<?php 
							for ($i=0; $i<count($domains); $i++){
								echo "
								<tr>
								<td>{$domains[$i]['site']}</td>
                                <td class=\"all_right\">{$domains[$i]['pv']}</td>
                                <tr>
                                ";
							}
							?>
                        </tbody>
                    </table>
                    <table cellspacing="0" cellpadding="0" style="width: 48%;float:right;" class="gtable detailtable">
                        <thead>
                            <tr>
                                <th><span class="left fB f14px"><?php echo __('Last 7 Days Page Said')?></span></th><th></th>
                            </tr>
                            <tr class="headings">
                                <th><?php echo __('Page Questioned URL')?></th>
                                <th><?php echo __('Times Surveyed')?></th>
                            </tr>	
                        </thead>

                        <tbody>
                        	<?php 
							for ($i=0; $i<count($pages); $i++){
								echo "
								<tr>
								<td>{$pages[$i]['url']}</td>
                                <td class=\"all_right\">{$pages[$i]['pv']}</td>
                                <tr>
                                ";
							}
							?>
                        </tbody>
                    </table>
                    <div class="clear"></div>
                </div>
                <div class="out_box" style="margin-top:20px;">
                   <table cellspacing="0" cellpadding="0" class="gtable detailtable">
                        <thead>
                            <tr>
                                <th><span class="left fB f14px"><?php echo __('Last 7 Distribution Of Heaven And Earth')?></span></th><th width="20%"></th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td><?php echo $flash3 ?></td>
                            </tr>
                        </tbody>
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
