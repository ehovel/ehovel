<?php defined('SYSPATH') or die('No direct script access.'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo STATICS_BASE_URL;?>css/demo_table_jui.css">
<script type="text/javascript" src="<?php echo STATICS_BASE_URL;?>js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
    jQuery(function($) {
        $('#datatable').dataTable({
            'bJQueryUI': true,
            "bPaginate": false,
            "aaSorting": [],
            "oLanguage": {
                "sUrl": "<?php echo STATICS_BASE_URL;?>js/datatables/i18n/<?php echo I18n::default_lang();?>.txt"
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
            <h2><?php echo __('Currency List');?></h2>

            <div class="tabcontent">
                <div id="tabs-1">
                    <div class="tableheader clearfix">
                        <div class="actions">
                            <ul class="tabletoolbar">
                                <li>
                                    <?php echo html::add_anchor(EHOVEL::url('site_currency/add')); ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <table cellpadding="0" cellspacing="0" border="0" class="display" id="datatable">
                        <thead>
                            <tr>
                                <th width="50"><?php echo __('ID');?></th>
                                <th width="100"><?php echo __('Action');?></th>
                                <th><?php echo __('Name');?></th>
                                <th><?php echo __('Code');?></th>
                                <th><?php echo __('Sign');?></th>
                                <th><?php echo __('Rate');?></th>
                                <th><?php echo __('Default');?></th>
                                <th><?php echo __('Adding Time');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($currencies) { ?>
                                <?php foreach ($currencies as $key => $item) { ?>
                            <tr class="odd gradeU">
                                <td><?php echo $item->id;?></td>
                                <td>
                                            <?php echo HTML::edit_anchor(EHOVEL::url('site_currency/edit') . '?id=' . $item->id);?>
                                    &nbsp;&nbsp;            
                                            <?php echo HTML::delete_anchor(EHOVEL::url('site_currency/delete') . '?id=' . $item->id);?>
                                            
                                </td>
                                <td><?php echo $item->cur_name;?></td>
                                <td><?php echo $item->cur_code;?></td>
                                <td><?php echo $item->cur_sign;?></td>
                                <td><?php echo $item->cur_rate;?></td>
                                <td><?php echo $item->is_default;?></td>
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
