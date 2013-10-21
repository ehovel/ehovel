<?php defined('SYSPATH') or die('No direct script access.'); ?>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('.delete').unbind().bind('click', function() {
            var href = jQuery(this).attr('href');
            jQuery.kMsg.warning('<?php echo __('Sure to delete the user group?'); ?>', function() {
                location.href = href;
            });
            return false;
        });
    });
</script>
<section class="container_12 clearfix">
    <section id="main">
        <?php remind::render_current();?>
        <article>
            <h2><?php echo __('Member Grade List');?></h2>

            <div class="tabcontent">
                <div id="tabs-1">
                    <div class="tableheader clearfix">
                        <div class="tableheader clearfix">
                            <div class="actions">
                                <ul class="tabletoolbar">
                                    <li>
                                        <?php echo HTML::add_anchor(BES::url('user_group/add'));?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <table id="table2" class="gtable detailtable">
                        <thead>
                        <tr>
                            <th><?php echo __('Operate');?></th>
                            <th><?php echo __('Name');?></th>
                            <th><?php echo __('Required Score');?></th>
                            <th><?php echo __('Discount Rate');?></th>
                            <th><?php echo __('Default or not');?></th>
                            <th><?php echo __('Special or not');?></th>
                            <th><?php echo __('Available or not');?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($groups as $group):?>
                        <tr>
                            <td>
                            <?php echo HTML::edit_anchor(BES::url('user_group/edit').'?id='.$group->id); ?> &nbsp;&nbsp;<?php echo HTML::delete_anchor(BES::url('user_group/delete').'?id='.$group->id); ?>
                            </td>
                            <td><?php echo $group->name;?></td>
                            <td><?php echo $group->score;?></td>
                            <td><?php echo $group->discount;?></td>
                            <td><img src="<?php echo STATICS_BASE_URL.'images/icons/'.($group->is_default == 'Y' ? 'tick.png' : 'cross.png');?>"/></td>
                            <td><img src="<?php echo STATICS_BASE_URL.'images/icons/'.($group->is_special == 'Y' ? 'tick.png' : 'cross.png');?>"/></td>
                            <td><img src="<?php echo STATICS_BASE_URL.'images/icons/'.($group->active == 'Y' ? 'tick.png' : 'cross.png');?>"/></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                    </table>
                </div>
            </div>
        </article>
    </section>
</section>
