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
                            <th width="100"><?php echo __('Name');?></th>
                            <th><?php echo __('Uri');?></th>
                            <th width="200"><?php echo __('Method');?></th>
                            <th width="200"><?php echo __('Ip');?></th>
                            <th width="150"><?php echo __('Adding Time');?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if ($logs) { ?>
                            <?php foreach ($logs as $key => $item) {
								$method_content = json_decode($item->method,true);
								$uri = $method_content['uri']?$method_content['uri']:'';
								$method = $method_content['method']? $method_content['method']:'';
                            	?>
                            <tr class="gradeU">
                                <td><?php echo $item->id;?></td>
                                <td>
                                    <?php echo HTML::icon_anchor('javascript:show_log('.$item->id.')',NULL,'splashyIcons/zoom.png');?>
                                    &nbsp;&nbsp;
                                    <?php echo HTML::delete_anchor(EHOVEL::url('auth_log/delete', array('id'=>$item->id)));?>
                                </td>
                                <td><?php echo $item->admins->username?></td>
                                <td><?php echo $uri;?></td>
                                <td><?php echo $method;?></td>
                                <td><?php echo $item->ip;?></td>
                                <td><?php echo $item->time;?></td>
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
<div id="dialog" style="display: none;"></div>
<script>
//显示日志
$(function() {
    $("#dialog").dialog({
        autoOpen:false,
        height:400,
        width:600,
        modal:true,
        close:function() {
            $("#dialog").empty();
        }
    });
});
function show_log(id) {
	$("#dialog").dialog('option', 'title', '<?php echo __('View Log');?>');
	$.ajax({
	url: admin_base_url + '/auth_log/edit?id=' + id,
	type: 'GET',
	success: function(data) {
	$('#dialog').html(data);
	},
	error: function() {
	}
	});
	$("#dialog").dialog("open");
	//return false;
} 
</script>
