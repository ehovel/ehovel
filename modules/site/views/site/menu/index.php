<?php defined('SYSPATH') or die('No direct script access.'); ?>
<?php echo EHOVEL::css('demo_table_jui')?>
<?php echo EHOVEL::js('jquery.dataTables.min')?>
<script type="text/javascript">
    jQuery(function($) {
        $('#datatable').dataTable({
            'bJQueryUI': true,
            "bPaginate": false,
            "aaSorting": [],
            "aoColumnDefs": [
                { "bSortable": false, "aTargets": [ 0,1,2,3,4 ] }
            ],
            "oLanguage": {
                "sUrl": "<?php echo STATICS_BASE_URL;?>js/datatables/i18n/<?php echo $language;?>.txt"
            }
        });
        $('.delete').unbind().bind('click',function(){
            var url = $(this).attr('href');
            $.kMsg.warning('<?php echo __('Sure to delete the currency?')?>', function(){
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
            <h2><?php echo __('Site Menu List');?></h2>

            <div class="tabcontent">
                <div id="tabs-1">
                    <div class="tableheader clearfix">
                        <div class="tableheader clearfix">
                            <div class="actions">
                                <ul class="tabletoolbar">
                                    <li>
                                        <?php echo HTML::add_anchor(EHOVEL::url('site_menu/add'), __('Add Site Menu'));?>
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
                            <th><?php echo __('Code');?></th>
                            <th><?php echo __('Adding Time');?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if ($items) { ?>
                            <?php foreach ($items as $key => $item) { ?>
                            <tr class="odd gradeU">
                                <td><?php echo $item->id;?></td>
                                <td>
                                    <?php echo HTML::edit_anchor(EHOVEL::url('site_menu/edit', array('id'=>$item->id)));?>
                                    &nbsp;&nbsp;
                                    <?php echo HTML::delete_anchor(EHOVEL::url('site_menu/delete', array('id'=>$item->id)));?>
                                </td>
                                <td><?php echo $item->name;?></td>
                                <td><?php echo $item->key;?></td>
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
