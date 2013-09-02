<?php defined('SYSPATH') or die('No direct script access.'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo STATICS_BASE_URL;?>css/demo_table_jui.css">
<?php echo EHOVEL::js('jquery.dataTables.min'); ?>
<script type="text/javascript">
    jQuery(function($) {
        $('#datatable').dataTable({
            "iDisplayLength": 20,
            'bJQueryUI': true,
            "aaSorting": [],
            'sPaginationType': 'full_numbers',
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
            $.kMsg.warning('<?php echo __('Sure to delete the role?')?>', function(){
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
            <h2><?php echo __('Role List');?></h2>

            <div class="tabcontent">
                <div id="tabs-1">
                    <div class="tableheader clearfix">
                        <div class="actions">
                            <ul class="tabletoolbar">
                                <li>
                                    <?php if(Helper_Auth::check('auth_role/add')):?>
                                    <a class="add" href="<?php echo EHOVEL::url('auth_role/add')?>"><?php echo __('Add Role');?></a>
                                    <?php endif;?>
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
                            <th><?php echo __('Remark');?></th>
                            <th><?php echo __('Adding Time');?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if ($roles) { ?>
                            <?php foreach ($roles as $key => $role) { ?>
                            <tr class="odd gradeU">
                                <td><?php echo $role->id;?></td>
                                <td>
                                    <?php echo HTML::edit_anchor(EHOVEL::url('auth_role/edit') . '?id=' . $role->id);?>
                                    &nbsp;&nbsp;
                                    <?php echo HTML::delete_anchor(EHOVEL::url('auth_role/delete') . '?id=' . $role->id);?>
                                </td>
                                <td><?php echo $role->name;?></td>
                                <td><?php echo $role->description;?></td>
                                <td><?php echo $role->date_add;?></td>
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
