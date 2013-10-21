<?php defined('SYSPATH') OR die('No direct access allowed.');?>
<section id="content">
    <section class="container_12 clearfix">
        <section id="main" class="grid_9 push_3">
            <article>
                <h1><?php echo __('Month Report');?>（<?php echo $data['year'].__('Year').$data['month'].__('Month')?>）</h1>
                <div class="box search">
                    <div style="float:left;padding-left:10px;line-height:30px;"><?php echo __('Total User Growth');?>:<span><?php echo $data['total']['count'];?></span></div>
                    <div style="float:left; margin-left:20px; padding-left:20px;border-left:1px solid #D5D3E8">
                    <form  method="POST" action="<?php echo url::current();?>">
              <select name="year" id="year" class="text" style="vertical-align:middle">
                <?php for($i = 2006; $i <= date('Y') ; $i++){?>
                <option value="<?php echo $i?>" <?php if (isset($data['year']) && $data['year'] == $i) {?>selected="selected"<?php }?>><?php echo $i?></option>
                <?php }?>
              </select>
              <?php echo __('Year');?>
              <select name="month" id="month" class="text" style="vertical-align:middle">
                <?php for($i = 1; $i <= 12; $i++){?>
                <option value="<?php echo $i?>" <?php if (isset($data['month']) && $data['month'] == $i) {?>selected="selected"<?php }?>><?php echo $i?></option>
                <?php }?>
              </select>
              <?php echo __('Month');?>
              <input name="button" class="ui-button ui-widget ui-state-default ui-corner-all" type="submit" value="<?php echo __('Search');?>">
            </form>
                    </div>
                    <div style="float:right;line-height:30px;"><a id="link_src1" class="linePic current" href="javascript:" onclick="exchangepic('img_src1','link_src1')"><?php echo __('Line Graph');?></a> | <a id="link_src2" href="javascript:" class="colPic" onclick="exchangepic('img_src2','link_src2')"><?php echo __('Bar Graph');?></a></div>           
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
                  <div> <?php echo $data['chart']['flash1'] ?> <?php echo $data['chart']['flash2'] ?>
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
                <table id="table2" class="gtable detailtable">
                    <thead>
                        <tr>
                          <th><?php echo __('Date');?></th>
                          <th><?php echo __('User Growth Number');?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo __('Total');?></td>
                            <td><?php echo $data['total']['count'];?></td>                          
                        </tr>
                        <?php $i = 1;?>
                        <?php foreach ($data['day_data'] as $key_day_data => $_day_data):?>
                        <tr<?php echo $i%2==0?' class="even"':' class="odd"';?>>
                            <td><?php echo $_day_data['time'];?></td>
                            <td><?php echo $_day_data['count'];?></td>
                        </tr>
                        <?php $i++;endforeach;?>
                    </tbody>
                </table>

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
