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
            $.kMsg.warning('<?php echo __('Sure to delete the store_address?')?>', function(){
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
            <h2><?php echo __('Store Address List');?></h2>

            <div class="tabcontent">
                <div id="tabs-1">
                	<div class="tableheader clearfix">
                        <div class="actions">
                            <ul class="tabletoolbar">
                                <li>
                                    <?php echo html::add_anchor(EHOVEL::url('site_store/add')); ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <table cellpadding="0" cellspacing="0" border="0" class="display" id="datatable">
                        <thead>
                            <tr>
                            	<th width="50"><?php echo __('ID');?></th>
                                <th width="100"><?php echo __('Action');?></th>
                                <th width="500"><?php echo __('Store Address');?></th>
                                <th><?php echo __('Store Warning Num');?></th>
                                <th><?php echo __('is_Default');?></th>
                                <th><?php echo __('is_Active');?></th>
                                <th width="200"><?php echo __('Add Date');?></th>
                                <th width="200"><?php echo __('Edit Date');?></th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php foreach($store_addresses as $store_addresse) :?>
	                            <tr class="odd gradeU">
	                                <td><?php echo $store_addresse->id;?></td>
	                                <td>
	                                            <?php echo HTML::edit_anchor(EHOVEL::url('site_store/edit',array('id'=>$store_addresse->id)));?>
	                                    &nbsp;&nbsp;            
	                                            <?php echo HTML::delete_anchor(EHOVEL::url('site_store/delete',array('id'=>$store_addresse->id)));?>
	                                </td>
	                                <td><?php echo $store_addresse->name;?></td>
	                                <td><?php echo $store_addresse->store_warning;?></td>
	                                <td><?php echo $store_addresse->is_default;?></td>
	                                <td><?php echo $store_addresse->active;?></td>
	                                <td><?php echo $store_addresse->date_add;?></td>
	                                <td><?php echo $store_addresse->date_upd;?></td>
	                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </article>
    </section>
</section>