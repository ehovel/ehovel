<?php defined('SYSPATH') or die('No direct script access.'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo STATICS_BASE_URL;?>css/demo_table_jui.css">
<script type="text/javascript" src="<?php echo STATICS_BASE_URL?>js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo STATICS_BASE_URL;?>js/jqgrid/ui.multiselect.js"></script>
<script type="text/javascript" src="<?php echo STATICS_BASE_URL;?>js/jqgrid/i18n/grid.locale-cn.js"></script>
<script type="text/javascript" src="<?php echo STATICS_BASE_URL;?>js/jqgrid/jquery.jqGrid.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo STATICS_BASE_URL;?>js/jqgrid/css/ui.jqgrid.css" />
<link rel="stylesheet" type="text/css" href="<?php echo STATICS_BASE_URL;?>js/jqgrid/css/ui.multiselect.css" />

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
            <h2><?php echo __('Faq List');?></h2>

            <div class="tabcontent">
                <div id="tabs-1">
                    <div class="tableheader clearfix">
                        <div class="actions">
                            <ul class="tabletoolbar">
                                <li>
                                    <?php echo HTML::add_anchor(EHOVEL::url('site_tecfaq/add'));?>
                                </li>
                                <li>
                                	<a href="<?php echo EHOVEL::url('site_tecfaq_category/index');?>" class="invite"><?php echo __('Faq Category List');?></a>
                            	</li>
                            </ul>
                        </div>
                    </div>
                    <table cellpadding="0" cellspacing="0" border="0" class="display" id="datatable">
                        <thead>
                        <tr>
                            <th width="80"><?php echo __('Action');?></th>
                            <th width="400"><?php echo __('Faq category name');?></th>
                            <th width="400"><?php echo __('Title');?></th>
                            <th><?php echo __('Date Add');?></th>
                            <th width="80"><?php echo __('is_Active');?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if ($site_faqs) { ?>
                            <?php foreach ($site_faqs as $key=>$site_faq) { ?>
                            <tr class="odd gradeU">
                                <td>
                                    <?php echo HTML::edit_anchor(EHOVEL::url('site_tecfaq/edit') . '?id=' . $site_faq->id);?>
                                    &nbsp;&nbsp;
                                    <?php echo HTML::delete_anchor(EHOVEL::url('site_tecfaq/delete') . '?id=' . $site_faq->id);?>
                                </td>
                                <td><?php echo $faq_categories[$key];?></td>
                                <td><?php echo $site_faq->title;?></td>
                                <td><?php echo $site_faq->date_add;?></td>
                                <td><?php echo $site_faq->status=='UNCHECKED'?'不可用':'可用';?></td>
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
            jQuery.kMsg.warning('<?php echo __('Sure to delete the faq?'); ?>', function() {
                location.href = href;
            });
            return false;
        });
    });
</script>
