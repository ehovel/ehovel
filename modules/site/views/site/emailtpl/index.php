<?php defined('SYSPATH') OR die('No direct script access allowed.'); ?>
<section class="container_12 clearfix">
    <section id="main">
        <?php remind::render_current();?>
        <article>
            <h2><?php echo __('Email Template List');?></h2>

            <div class="tabcontent">
                <div id="tabs-1">
                    <div class="tableheader clearfix">
                        <div class="actions"></div>
                    </div>
                    <table cellpadding="0" cellspacing="0" border="0" class="gtable detailtable" id="table2">
                        <thead>
                        <tr>
                            <th width="80"><?php echo __('Operate');?></th>
                            <th><?php echo __('ID'); ?></th>
                            <th><?php echo __('Name');?></th>
                            <th><?php echo __('Subject'); ?></th>
                            <th><?php echo __('Edit Date');?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($tpls)) { ?>
                            <?php foreach ($tpls as $tpl) { ?>
                            <tr class="odd gradeU">
                                <td><?php echo HTML::edit_anchor(EHOVEL::url('site_emailtpl/edit')  . '?id=' . $tpl->pk());?></td>
                                <td><?php echo $tpl->id;?></td>
                                <td><?php echo htmlspecialchars($tpl->name); ?></td>
                                <td><?php echo htmlspecialchars($tpl->title); ?></td>
                                <td><?php echo $tpl->date_upd;?></td>
                            </tr>
                                <?php } ?>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </article>
    </section>
</section>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('.remove').bind('click', function() {
            var href = jQuery(this).attr('href');
            jQuery.kMsg.warning('<?php echo __('Sure to delete?'); ?>', function() {
                location.href = href;
            });
            return false;
        });
    });
</script>