<?php defined('SYSPATH') or die('No direct script access.'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo STATICS_BASE_URL;?>css/demo_table_jui.css">
<script type="text/javascript" src="<?php echo STATICS_BASE_URL;?>js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo STATICS_BASE_URL;?>js/banner/3.js"></script>

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
            <h2><?php echo __('Space List');?></h2>

            <div class="tabcontent">
                <div id="tabs-1">
                    <div class="tableheader clearfix">
                        <div class="actions">
                            <ul class="tabletoolbar">
                                <li>
                                    <?php echo html::add_anchor(EHOVEL::url('site_space/add')); ?>
                                </li>
                            	<li>
                                	<a href="<?php echo EHOVEL::url('site_space/space_setting');?>" class="invite"><?php echo __('Ads Space Info');?></a>
                            	</li>
                            </ul>
                        </div>
                    </div>
                    <table cellpadding="0" cellspacing="0" border="0" class="display" id="datatable">
                        <thead>
                            <tr>
                            	<th width="50"><?php echo __('ID');?></th>
                                <th width="100"><?php echo __('Action');?></th>
                                <th><?php echo __('Spacename');?></th>
                                <th width="110"><?php echo __('Ads Manage');?></th>
                                <th><?php echo __('Spacetype');?></th>
                                <th><?php echo __('Size Format');?></th>
                                <th><?php echo __('Ads Num');?></th>
                                <th><?php echo __('Space Description');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if ($infos) { ?>
                                <?php foreach($infos as $info) { ?>
                            <tr class="odd gradeU">
                                <td><?php echo $info->id;?></td>
                                <td>
                                            <?php echo HTML::edit_anchor(EHOVEL::url('site_space/edit') . '?id=' . $info->id);?>
                                    &nbsp;&nbsp;            
                                            <?php echo HTML::delete_anchor(EHOVEL::url('site_space/delete') . '?id=' . $info->id);?>
                                </td>
                                <td><?php echo $info->name;?></td>
                                <td><a href="<?php echo EHOVEL::url('site_ads/index') . '?spaceid=' . $info->id .'&type=' . $info->type;?>"><font color="blue"><U><?php echo __('Ads List');?></U></font></a></td>
                                <td>
                                	<?php 
                                    	foreach($ads_info as $key=>$ad_info)
                            	        {
                                    	    if($info->type == $key)
                                    	    {
                                    	        echo $ad_info['name'];
                                    	    }
                                    	}
                                	?>
                                </td>
                                <td><?php echo $info->width;?>*<?php echo $info->height?></td>
                                <td><?php
                                    	$infos = EHOVEL::model ( 'Site_Poster' )->where('spaceid','=',$info->id)->order_by('id','ASC')->find_all();
                                        echo count($infos);
                                    ?>
                                </td>
                                <td><?php echo $info->description?></td>
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