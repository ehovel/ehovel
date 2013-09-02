<?php defined('SYSPATH') or die('No direct script access.'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo STATICS_BASE_URL;?>css/demo_table_jui.css">
<script type="text/javascript" src="<?php echo STATICS_BASE_URL?>js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    jQuery(function($) {
        $('#datatable').dataTable({
            'bJQueryUI': true,
            'sPaginationType': 'full_numbers',
            "aLengthMenu": [
                [20, 50, 100, -1],
                [20, 50, 100, "<?php echo __('All'); ?>"]
            ],
            aoColumnDefs:[
                {
                    bSortable:false,
                    aTargets:[0,1]
                }
            ],
            iDisplayLength:20,
            "oLanguage": {
                "sUrl": "<?php echo STATICS_BASE_URL?>js/datatables/i18n/<?php echo $language;?>.txt"
            }
        });
    });
</script>
<section class="container_12 clearfix">
    <section id="main">
        <?php remind::render_current();?>
        <article>
            <h2><?php echo __('Site List');?></h2>

            <div class="tabcontent">
                <div id="tabs-1">
                    <div class="tableheader clearfix">
                        <div class="actions">
                            <ul class="tabletoolbar">
                                <li>
                                    <?php echo HTML::add_anchor(EHOVEL::url('site/add'));?>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <table cellpadding="0" cellspacing="0" border="0" class="display" id="datatable">
                        <thead>
                        <tr>
                            <th width="80"><?php echo __('Action');?></th>
                            <th><?php echo __('domain');?></th>
                            <th width="200"><?php echo __('name');?></th>
                            <th width="200"><?php echo __('language');?></th>
                            <th width="100"><?php echo __('is default');?></th>
                            <th width="150"><?php echo __('Available or not');?></th>
                            <th width="200"><?php echo __('Date Add');?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if ($sites) { ?>
                            <?php foreach ($sites as $site) { ?>
                            <tr class="odd gradeU">
                                <td>
                                    <?php echo HTML::edit_anchor(EHOVEL::url('site/edit') . '?id=' . $site->id);?>
                                    &nbsp;&nbsp;
                                    <?php echo HTML::delete_anchor(EHOVEL::url('site/delete') . '?id=' . $site->id);?>
                                </td>
                                <td><?php echo $site->domain;?></td>
                                <td><?php echo $site->name;?></td>
                                <td><?php echo $site->language;?></td>
                                <td><?php echo $site->is_default;?></td>
                                <td><?php echo $site->active;?></td>
                                <td><?php echo $site->date_add;?></td>
                            </tr>
                                <?php } ?>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
        </article>
    </section>
</section>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('.delete').unbind().bind('click', function() {
            var href = jQuery(this).attr('href');
            jQuery.kMsg.warning('<?php echo __('Sure to delete the data?This site data may be lose efficacy!'); ?>', function() {
                location.href = href;
            });
            return false;
        });
    });
</script>
