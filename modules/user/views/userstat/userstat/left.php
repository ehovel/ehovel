<aside id="sidebar" class="grid_3 pull_9">
    <div class="box menu">
        <h2><?php echo __('Customer Statistic Analysis');?></h2>
        <section>
            <ul>
                <li><?php echo __('Customer Analysis');?>
                    <ul>
                        <li<?php if (isset($userstat)){ echo " class=\"current\""; } ?>><a href="/admin/userstat_userstat"><?php echo __('Customer Ranking');?></a></li>
                    </ul>
                </li>
                <li><?php echo __('Customer Distribution');?>
                    <ul>
                        <li<?php if (isset($user_spread)){ echo " class=\"current\""; } ?>><a href="/admin/userstat_userspreadstat"><?php echo __('Customer Distribution');?></a></li>
                    </ul>
                </li>
                <li><?php echo __('Customer Growth');?>
                    <ul>
                        <li<?php if (isset($user_day_grow)){ echo " class=\"current\""; } ?>><a href="/admin/userstat_usergrowstat/index"><?php echo __('Custom Time Reports');?></a></li>
                        <li<?php if (isset($user_month_grow)){ echo " class=\"current\""; } ?>><a href="/admin/userstat_usergrowstat/month"><?php echo __('Month Reports');?></a></li>
                        <li<?php if (isset($user_year_grow)){ echo " class=\"current\""; } ?>><a href="/admin/userstat_usergrowstat/year"><?php echo __('Year Reports');?></a></li>
                    </ul>
                </li>
            </ul>
        </section>
    </div>
</aside>
