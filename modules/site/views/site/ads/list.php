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
                "sUrl": "<?php echo STATICS_BASE_URL;?>js/datatables/i18n/<?php echo I18n::default_lang();?>.txt"
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
        <?php remind::render_current();?>
        <article>
            <h2><?php echo __('Ads List');?></h2>

            <div class="tabcontent">
                <div id="tabs-1">
                    <div class="tableheader clearfix">
                        <div class="actions">
                            <ul class="tabletoolbar">
                                <li>
                                    <?php echo html::add_anchor(EHOVEL::url('site_ads/add',array('spaceid'=>$spaceid,'type'=>$type))); ?>
                                </li>
                                	<?php if(count($infos)>0) :?>
                                <li>
                                	<a href="<?php echo EHOVEL::url('site_ads/create_js',array('spaceid'=>$spaceid,'type'=>$type));?>" class="invite"><?php echo __('Create Poster JS');?></a>
                            	</li>
                            	<li>
                    				<a href="javascript:void(0);" id="call_js" class="invite"><?php echo __('Call JS');?></a>
                        		</li>
                        			<?php endif;?>
                            </ul>
                        </div>
                    </div>
                    <table cellpadding="0" cellspacing="0" border="0" class="display" id="datatable">
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
                                if ($infos) { ?>
                                <?php foreach($infos as $info) { ?>
                            <tr class="odd gradeU">
                                <td><?php echo $info->id;?></td>
                                <td>
                                            <?php echo HTML::edit_anchor(EHOVEL::url('site_ads/edit') . '?id=' . $info->id.'&type='.$type .'&spaceid='.$spaceid);?>
                                    &nbsp;&nbsp;            
                                            <?php echo HTML::delete_anchor(EHOVEL::url('site_ads/delete') . '?id=' . $info->id.'&type='.$type .'&spaceid='.$spaceid);?>
                                </td>
                                <td><?php echo $info->name;?></td>
                                <td><?php if(isset($ads_info[$type]['type'][$info->type])){echo $ads_info[$type]['type'][$info->type];}?></td>
                                <td><?php echo $space_info->name;?></td>
                                <td><?php if($info->disabled==0){echo __('start');}else{echo __('stop');}?></td>
                                <td><?php echo $info->date_add?></td>
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
<div id="dialog" style="display:none;"></div>
<script type="text/javascript">
    $(function($) {
        $("#dialog").dialog({
            autoOpen:false,
            height:400,
            width:900,
            modal:true,
            close:function() {
                $("#dialog").empty();
            }
        });
        $("#call_js").click(function() {
            $("#dialog").dialog('option', 'title', '<?php echo __('Call JS');?>');
            $("#dialog").load("<?php echo EHOVEL::url('site_ads/call_js');?>?type=<?php echo $type;?>&spaceid=<?php echo $spaceid?>");
            $("#dialog").dialog("open");
            return false;
        });
    });

</script>