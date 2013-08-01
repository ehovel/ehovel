<?php defined('SYSPATH') or die('No direct script access.'); ?>
<script type="text/javascript" src="<?php echo STATICS_BASE_URL;?>js/jquery.validate.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo STATICS_BASE_URL;?>css/demo_table_jui.css">
<script type="text/javascript" src="<?php echo STATICS_BASE_URL;?>js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
    jQuery(function($) {
        $('#datatable').dataTable({
            'bJQueryUI': true,
            "bPaginate": false,
            "aaSorting": [],
            "oLanguage": {
                "sUrl": "<?php echo STATICS_BASE_URL;?>js/datatables/i18n/zh.txt"
            }
        });
        $('.delete').unbind().bind('click',function(){
            var url = $(this).attr('href');
            $.kMsg.warning('<?php echo __('Sure to delete the ads?')?>', function(){
                window.location.href = url;
            });
            return false;
        });
    });
</script>

<section class="container_12 clearfix">
    <section id="main">
        <article>
            <h2><?php echo __('Ads List');?></h2>

            <div class="tabcontent">
                <div id="tabs-1">
                    <div class="tableheader clearfix">
                        <div class="actions">
                            <ul class="tabletoolbar">
                                <li>
                                    <?php echo html::add_anchor(EHOVEL::url('cms_ads/add')); ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <table cellpadding="0" cellspacing="0" border="0" class="display table" id="datatable">
                        <thead>
                            <tr>
                                <th width="50"><?php echo __('ID');?></th>
                                <th width="100"><?php echo __('Action');?></th>
                                <th><?php echo __('Ads Title');?></th>
                                <th><?php echo __('Ads Type');?></th>
                                <th><?php echo __('Ads Module');?></th>
                                <th><?php echo __('Ads State');?></th>
                                <th><?php echo __('Adding Time');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if ($ads) { ?>
                                <?php foreach($ads as $info) { ?>
                            <tr class="odd gradeU">
                                <td><?php echo $info->id;?></td>
                                <td>
                                            <?php echo HTML::edit_anchor(EHOVEL::url('cms_ads/edit') . '?id=' . $info->id);?>
                                    &nbsp;&nbsp;            
                                            <?php echo HTML::delete_anchor(EHOVEL::url('cms_ads/delete') . '?id=' . $info->id);?>
                                </td>
                                <td><?php echo $info->title;?></td>
                                <td><?php if(isset($types[$info->type])){echo $types[$info->type];}?></td>
                                <td><?php echo $info->title;?></td>
                                <td><?php if($info->disabled==0){echo __('start');}else{echo __('stop');}?></td>
                                <td><?php echo $info->created?></td>
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