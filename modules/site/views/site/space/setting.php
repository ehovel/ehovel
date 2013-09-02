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
            $.kMsg.warning('<?php echo __('Sure to delete the boardtype?')?>', function(){
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
            <h2><?php echo __('Ads Space Info');?></h2>

            <div class="tabcontent">
                <div id="tabs-1">
                    <table cellpadding="0" cellspacing="0" border="0" class="display" id="datatable">
                        <thead>
                            <tr>
                                <th width="100"><?php echo __('Action');?></th>
                                <th><?php echo __('Spacename');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if ($ads_info) { ?>
                                <?php foreach($ads_info as $key=>$ad_info) { ?>
                            <tr class="odd gradeU">
                            	<td>
                                            <a href="<?php echo EHOVEL::url('site_space/setting_edit')?>?key=<?php echo $key;?>"><img alt="<?php echo __('View'); ?>" title="<?php echo __('View'); ?>" src="/statics/images/icons/splashyIcons/view_list.png" /></a>
                                </td>
                            	<td><a href="<?php echo EHOVEL::url('site_space/setting_edit')?>?key=<?php echo $key;?>"><?php echo $ad_info['name'];?></a></td>
                            </tr>
                            <?php }?>
                                <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </article>
    </section>
</section>