<?php defined('SYSPATH') or die('No direct script access.'); ?>
<?php echo EHOVEL::css('demo_table_jui');?>
<?php echo EHOVEL::js('jquery.dataTables.min');?>
<script type="text/javascript">
    jQuery(function($) {
        $('#datatable').dataTable({
            'bJQueryUI': true,
            "bPaginate": false,
            "aaSorting": [],
            "aoColumnDefs": [
                { "bSortable": false, "aTargets": [ 0,1,2,3,4,5,6,7 ] }
            ],
            "oLanguage": {
                "sUrl": "<?php echo STATICS_BASE_URL;?>js/datatables/i18n/zh.txt"
            }
        });

        $('.delete').unbind().bind('click',function(){
            var url = $(this).attr('href');
            $.kMsg.warning('<?php echo __('Sure to delete this menu?')?>', function(){
                window.location.href = url;
            });
            return false;
        });
    });
</script>
<section class="container_12 clearfix">
    <section id="main">
        <article>
            <h2><?php echo __('System Menu List');?></h2>

            <div class="tableheader clearfix">
                <div class="actions">
                    <ul class="tabletoolbar">
                        <li>
                            <?php echo HTML::add_anchor(EHOVEL::url('menu/add'), __('Add System Menu'));?>
                        </li>
                    </ul>
                </div>
            </div>
            <form class="uniform" id="adminForm" action="<?php echo url::current(true);?>" method="post" />
                <table cellpadding="0" cellspacing="0" border="0" class="display" id="datatable">
                    <thead>
                    <tr>
                        <th width="45"><?php echo __('ID');?></th>
                        <th width="60"><?php echo __('Action');?></th>
                        <th><?php echo __('Name');?></th>
                        <th><?php echo __('English name');?></th>
                        <th><?php echo __('Uri');?></th>
                        <th><?php echo __('Position');?></th>
                        <th><?php echo __('Adding Time');?></th>
                        <th><?php echo __('Updating Time');?></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php echo Helper_Menu::generate_menu_list($menus)?>
                    </tbody>
                </table>
            </form>
        </article>
    </section>
</section>
