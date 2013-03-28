<?php defined('SYSPATH') OR die('No direct access allowed.');?>
<link rel="stylesheet" type="text/css" href="/statics/css/fancybox/jquery.fancybox-1.3.4.css" />
<section id="main">
	<fieldset>
		<legend><?php echo __('资源列表');?></legend>
		<!--操作模块-->
		<div class="operate_mod clearfix">
		    <blockquote class="pull-right">
		    	<div class="progress_box row">
			        <!--progress-->
			        <div class="progress progress-striped span3">
			        	已使用容量
			    		<div class="bar" style="width: 20%;"></div>
			    	</div>
			    </div>
		    </blockquote>
		</div>
	</fieldset>
</section>

<!--standard table-->
<div class="nav_container clearfix">
    <!--tree content-->
    <div class="nav_content">

        <!--table operate-->

        <!--standard table-->
        <div class="table_wrap">
            <div class="standard_table">
                <form action="" method="">
                    <table class="table">
                        <tr>
                            <th width="50px" class="no_leftbor"><input class="input_c" type="checkbox" id="check_all"/></th>
                            <th width="100px" >操作</th>
                            <th>名称</th>
                            <th>文件</th>
                            <th width="200px">更新时间</th>
                        </tr>
                        <?php if (empty($resources)) { ?>
                            <tr class="no_data_tr">
                                <!--colspan-->
                                <td colspan="5">
                                    <div class="no_data_box">
                                        没有数据
                                    </div>
                                </td>
                            </tr>
                        <?php } else { ?>
                            <?php foreach ($resources as $resource): ?>
                                <?php
                                $resource = $resource->as_array();
                                if (empty($resource['attach_id'])) {
                                    $resource['attach_id'] = $resource['link'];
                                }
                                ?>
                                <tr>
                                    <td><input class="input_c sel" type="checkbox" name="resource" value="<?php echo $resource['id']; ?>"/></td>
                                    <td>
                                        <a href="<?php echo EHOVEL::admin_base_url(); ?>resource/edit/<?php echo $resource['id']; ?>" class="edit_item">
                                        	<i class="icon-edit"></i>编辑</a>
                                    </td>
                                    <td>
                                    	<span class="file_name"><?php echo $resource['title'] ? $resource['title'] : $resource['name']; ?></span>
                                    </td>
                                    <td>
                                        <span class="file_pic">
                                            <img style="max-height:120px; max-width:120px" src="<?php echo Helper_Resource::get_img($resource['attach_id']); ?>" alt="<?php echo $resource['name']; ?>" />
                                        </span> 
                                    </td>
                                    <td class="td_center"><?php echo $resource['modified'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php } ?>
                    </table> 
                </form>
            </div> 
        </div>
        <?php if (!empty($resources)) { ?>
        <!--pagination div-->
        <div class="pagination_wrap">
            <div class="tablefooter clearfix">
                <?php echo $pagination->render(); ?>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<div id="add_catalog_ifm" class="ui-dialog-content ui-widget-content" style="width:auto;">
    <iframe style="border:0px;width:100%;height:95%;" frameborder="0" src="" scrolling="auto"></iframe>
</div>
<div id="upload_ifm" class="ui-dialog-content ui-widget-content" style="width:auto;">
    <iframe style="border:0px;width:100%;height:100%;" frameborder="0" src=""></iframe>
</div>
<div id="add_tag_ifm" class="ui-dialog-content ui-widget-content" style="width:auto;">
    <iframe style="border:0px;width:100%;height:95%;" frameborder="0" src="" scrolling="auto"></iframe>
</div>
<script type="text/javascript" src="/statics/js/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript">
    function facyboxclose() {
    	$.fancybox.close();
    }
    $(document).ready(function(){
    	$(".edit_item").fancybox({
        	'padding':'30',
    		'autoScale' : false,
	   		 'transitionIn' : 'elastic',
			 'transitionOut' : 'elastic',
    		});
		
        $('#check_all').click(function(){
            if($(this).attr('checked')){
                $('.sel').each(function(){
                    $(this).attr('checked',true);
                });
            }
            else
            {
                $('.sel').each(function(){
                    $(this).attr('checked',false);
                });
            }
        });
    });
</script>
