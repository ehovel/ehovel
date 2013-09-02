<?php defined('SYSPATH') or die('No direct script access.'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo STATICS_BASE_URL;?>css/demo_table_jui.css">
<script type="text/javascript" src="<?php echo STATICS_BASE_URL;?>js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    jQuery(function($) {
        $('#datatable').dataTable({
            "iDisplayLength": 20,
            "aaSorting": [],
            "aoColumnDefs": [
                { "bSortable": false, "aTargets": [ 0,1,2,3,5 ] }
            ],
            'bJQueryUI': true,
            'sPaginationType': 'full_numbers',
            "aLengthMenu": [
                [20, 50, 100, -1],
                [20, 50, 100, "<?php echo __('All'); ?>"]
            ],
            "oLanguage": {
                "sUrl": "<?php echo STATICS_BASE_URL;?>js/datatables/i18n/<?php echo I18n::default_lang();?>.txt"
            }
        });
        $('.delete').unbind().bind('click',function(){
            var url = $(this).attr('href');
            $.kMsg.warning('<?php echo __('Sure to delete the site link?')?>', function(){
                window.location.href = url;
            });
            return false;
        });
    });
</script>
<section class="container_12 clearfix">
    <section id="main">
        <?php remind::render_current();?>
        <article>
            <h2><?php echo __('Site Link List');?></h2>

            <div class="tabcontent">
                <div id="tabs-1">
                    <div class="tableheader clearfix">
                        <div class="tableheader clearfix">
                            <div class="actions">
                                <ul class="tabletoolbar">
                                    <li>
                                        <?php echo HTML::add_anchor(EHOVEL::url('site_link/add'),__('Add Site Link'));?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <table cellpadding="0" cellspacing="0" border="0" class="display" id="datatable">
                        <thead>
                        <tr>
                            <th width="50"><?php echo __('ID');?></th>
                            <th width="100"><?php echo __('Action');?></th>
                            <th><?php echo __('Name');?></th>
                            <th><?php echo __('URL');?></th>
                            <th><?php echo __('Position');?></th>
                            <th><?php echo __('Adding Time');?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if ($items) { ?>
                            <?php foreach ($items as $key => $item) { ?>
                            <tr class="odd gradeU">
                                <td><?php echo $item->id;?></td>
                                <td>
                                    <?php echo HTML::edit_anchor(EHOVEL::url('site_link/edit') . '?id=' . $item->id);?>
                                    &nbsp;&nbsp;
                                    <?php echo HTML::delete_anchor(EHOVEL::url('site_link/delete') . '?id=' . $item->id);?>
                                </td>
                                <td><?php echo $item->name;?></td>
                                <td><?php echo $item->href;?></td>
                                <td><?php echo $item->position;?></td>
                                <td><?php echo $item->date_add;?></td>
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