<?php defined('SYSPATH') OR die('No direct access allowed.');?>
<section id="content">
	<section class="container_12 clearfix">
		<section id="main" class="grid_9 push_3">
			<article>
				<h1><?php echo __('Customer Ranking');?>（<?php echo $request_data['date_from']; ?> —— <?php echo $request_data['date_to']; ?>）</h1>
                <div class="box search">
                    <div style="padding-left:10px;">
                        <form name="search_form" method="GET" action="<?php echo url::current();?>"> 
                         <div><?php echo __('PayStatus');?>:<select name="pay_status">
                                                <option value=""> - <?php echo __('All');?> - </option>
                                                <?php foreach($pay_status as $key=>$value):?>
                                                <option value="<?php echo $key;?>" <?php if (isset($request_data['pay_status']) && $request_data['pay_status'] == $key) {?>selected="selected"<?php }?>><?php echo $value;?></option>
                                                <?php endforeach;?>
                                            </select>
                                <?php echo __('ShipStatus');?>:<select name="ship_status">
                                                <option value=""> - <?php echo __('All');?> - </option>
                                                <?php foreach($ship_status as $key=>$value):?>
                                                <option value="<?php echo $key;?>"<?php if (isset($request_data['ship_status']) && $request_data['ship_status'] == $key) {?>selected="selected"<?php }?>><?php echo $value;?></option>
                                                <?php endforeach;?>
                                            </select>
                                <?php echo __('OrderStatus');?>:<select name="order_status">
                                                <option value=""> - <?php echo __('All');?> - </option>
                                                <?php foreach($order_status as $key=>$value):?>
                                                <option value="<?php echo $key;?>"<?php if (isset($request_data['order_status']) && $request_data['order_status'] == $key) {?>selected="selected"<?php }?>><?php echo $value;?></option>
                                                <?php endforeach;?>
                                            </select>
                                            <?php echo __('Date');?> <?php echo __('From');?>:
                                  <input name="date_from" id="date_from" size="10" class="text required dateISO" value="<?php echo $request_data['date_from'] ?>" readonly="">
                                  <?php echo __('To');?>:
                                  <input name="date_to" id="date_to" size="10" class="text required dateISO" value="<?php echo $request_data['date_to']; ?>" readonly="">
                                  <input name="button" class="ui-button ui-widget ui-state-default ui-corner-all" type="submit" value="<?php echo __('Search');?>">
                              </div>    
                        </form>
                    </div>
                </div>
                <div class="newgrid" style="position:static">
                <?php if(count($data)):?>
                    <table id="datatable" class="gtable detailtable">
                        <thead>
                            <tr>
                              <th><?php echo __('Ranking');?></th>
                              <th><?php echo __('User Email');?></th>
                              <th><?php echo __('Order Numbers');?></th>				   
                              <th><?php echo __('Renting Amount');?>(<?php echo $base_currency_sign;?>)</th>
                              <th><?php echo __('Operate');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;?>
                            <?php foreach ($data as $key_data => $_data):?>
                            <tr<?php echo $i%2==0?' class="even"':' class="odd"';?>>
                                <td><?php echo $_data['rank'];?></td>
                                <td><?php echo $_data['email'];?></td>
                                <td><?php echo $_data['order_count'];?></td>
                                <td><?php echo $_data['user_total'];?></td>	
                                <td><a href="<?php echo BES::url('sale_salestat_saledetailstat/index')?>?date_from=<?php echo $request_data['date_from'];?>&date_to=<?php echo $request_data['date_to'];echo isset($request_data['pay_status'])?'&pay_status='.$request_data['pay_status']:'';echo isset($request_data['ship_status'])?'&ship_status='.$request_data['ship_status']:'';echo isset($request_data['order_status'])?'&order_status='.$request_data['order_status']:'';?>&email=<?php echo $_data['email'];?>"><?php echo __('Renting Detail');?></a></td>							
                            </tr>
                            <?php $i++;endforeach;?>
                        </tbody>
                    </table>
                    <div class="tablefooter clearfix">
                    <?php echo $pagination;?>
                    </div>
                    <?php endif;?>
                </div>

			</article>
		</section>
      <aside id="sidebar" class="grid_3 pull_9">
		    <div class="box menu">
		        <h2><?php echo __('Customer Statistic Analysis');?></h2>
		        <section>
		            <ul>
		                <li><?php echo __('Customer Analysis');?>
		                    <ul>
		                        <li<?php if (isset($userstat)){ echo " class=\"current\""; } ?>><a href="/userstat_userstat"><?php echo __('Customer Ranking');?></a></li>
		                    </ul>
		                </li>
		                <li><?php echo __('Customer Growth');?>
		                    <ul>
		                        <li<?php if (isset($user_day_grow)){ echo " class=\"current\""; } ?>><a href="/userstat_usergrowstat/index"><?php echo __('Custom Time Reports');?></a></li>
		                        <li<?php if (isset($user_month_grow)){ echo " class=\"current\""; } ?>><a href="/userstat_usergrowstat/month"><?php echo __('Month Reports');?></a></li>
		                        <li<?php if (isset($user_year_grow)){ echo " class=\"current\""; } ?>><a href="/userstat_usergrowstat/year"><?php echo __('Year Reports');?></a></li>
		                    </ul>
		                </li>
		            </ul>
		        </section>
		    </div>
		</aside>
	</section>
</section>
<script type="text/javascript">
    $(function() {
        $("#date_from").datepicker({
            prevText:"",
            nextText:"",
            dateFormat:"yy-mm-dd"});
    });

    $(function() {
        $("#date_to").datepicker({
            prevText:"",
            nextText:"",
            dateFormat:"yy-mm-dd"});
    });
</script>
