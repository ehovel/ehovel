<?php defined('SYSPATH') or die('No direct script access.'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo STATICS_BASE_URL;?>css/demo_table_jui.css">
<?php echo EHOVEL::js('jquery.dataTables.min'); ?>
<script type="text/javascript">
    jQuery(function($) {
        $('#datatable').dataTable({
            "iDisplayLength": 20,
            'bJQueryUI': true,
            'sPaginationType': 'full_numbers',
            "aaSorting": [],
            "aLengthMenu": [
                [20, 50, 100, -1],
                [20, 50, 100, "<?php echo __('All'); ?>"]
            ],
            "oLanguage": {
                "sUrl": "<?php echo STATICS_BASE_URL;?>js/datatables/i18n/<?php echo $language;?>.txt"
            }
        });
        $('.delete').unbind().bind('click',function(){
            var url = $(this).attr('href');
            $.kMsg.warning('<?php echo __('Sure to delete this account?')?>', function(){
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
            <h2><?php echo __('Account List');?></h2>
            <div class="tabcontent">
                <div id="tabs-1">
                    <div class="tableheader clearfix">
                        <div class="actions">
                            <ul class="tabletoolbar">
                                <li>
                                    <a class="add" href="<?php echo EHOVEL::url('auth_admin/add')?>"><?php echo __('Add Account');?></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <table cellpadding="0" cellspacing="0" border="0" class="display" id="datatable">
                        <thead>
                        <tr>
                            <th width="50"><?php echo __('ID');?></th>
                            <th width="100"><?php echo __('Action');?></th>
                            <th><?php echo __('username');?></th>
                            <th width="200"><?php echo __('Email');?></th>
                            <th width="200"><?php echo __('Parent');?></th>
                            <th width="200"><?php echo __('Column');?></th>
                            <th width="200"><?php echo __('Role');?></th>
                            <th width="150"><?php echo __('Adding Time');?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if ($admins) { ?>
                            <?php foreach ($admins as $key => $item) { ?>
                            <tr class="gradeU">
                                <td><?php echo $item->id;?></td>
                                <td>
                                    <?php echo HTML::edit_anchor(EHOVEL::url('auth_admin/edit', array('id'=>$item->id)));?>
                                    &nbsp;&nbsp;
                                    <?php echo HTML::delete_anchor(EHOVEL::url('auth_admin/delete', array('id'=>$item->id)));?>
                                </td>
                                <td><?php echo str_repeat('&nbsp;', ($item->lvl - 1) * 6) . $item->username; ?></td>
                                <td><?php echo $item->email;?></td>
                                <td><?php echo $item->parent->username;?></td>
                                <td><?php echo isset($item->column->name) ? $item->column->name : '';?></td>
                                <td><?php echo $item->role->name;?></td>
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
