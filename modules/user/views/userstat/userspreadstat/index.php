<?php defined('SYSPATH') OR die('No direct access allowed.');?>
<section id="content">
	<section class="container_12 clearfix">
		<section id="main" class="grid_9 push_3">
			<article>
				<h1><?php echo __('Customer Distribution Reports');?>（<?php if(isset($request_data['date_from'])){ echo $request_data['date_from'];}else{
		  echo __('The first member of time');} ?> —— <?php echo $request_data['date_to']; ?>）</h1>
                <div class="box search">
                    <div style="float:left;padding-left:10px;line-height:30px;"><?php echo __('Total Users');?>:<span><?php echo $user_total?></span></div>
                    <div style="float:left; margin-left:20px; padding-left:20px;border-left:1px solid #D5D3E8">
                        <form name="search_form" id="search_form" method="GET" action="<?php echo url::current(); ?>">
                        <div style="float:right" >
                          <?php echo __('Date');?> <?php echo __('From');?>:
                          <input name="date_from" id="date_from" size="30" class="text required dateISO" value="<?php  if(isset($request_data['date_from'])){ echo $request_data['date_from'];} ?>" readonly="">
                          <?php echo __('To');?>:
                          <input name="date_to" id="date_to" size="30" class="text required dateISO" value="<?php echo $request_data['date_to']; ?>" readonly="">
                          <input name="button" class="ui-button ui-widget ui-state-default ui-corner-all" type="submit" value="<?php echo __('Search');?>">
                          </div>
                        </form>
                    </div>
                    <div class="clear"></div>
                </div>
				<h2><?php echo __('Members Of The Distribution Area');?></h2>
                <div>
                <?php
                if ($src_data['flash1'] == 'none') {
                    echo __('You have not been members of the date query data distribution!');
                }else {
                    echo $src_data['flash1'];
                }
                ?>
                <script language="JavaScript">
                     <!-- Author By dbcweb.cn
                      function killErrors() {
                       return true;
                       }
                      window.onerror = killErrors;
                      // -->
                      </script>
                </div>
			   <?php if(count($data)):?>
                <table id="table2" class="gtable detailtable">
					<thead>
						<tr>
                          <th><?php echo __('Ranking');?></th>
                          <th><?php echo __('Area Name');?></th>
                          <th><?php echo __('Total Users');?></th>
                          <th><?php echo __('User Percentage');?></th>
						</tr>
					</thead>
					<tbody>
                        <?php $i = 1;?>
                        <?php foreach ($data as $key_data => $_data):?>
                        <tr<?php echo $i%2==0?' class="even"':' class="odd"';?>>
                            <td><?php echo $_data['rank'];?></td>
                            <td><?php echo $_data['country_name'];?></td>
                            <td><?php echo $_data['user_count'];?></td>
                            <td><?php echo $_data['percentage'];?></td>
						</tr>
                        <?php $i++;endforeach;?>
					</tbody>
				</table>
                <?php endif;?>
			</article>
		</section>
      <?php echo $userspreadstat_left ?>
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
