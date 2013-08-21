<?php defined('SYSPATH') OR die('No direct access allowed.');?>
<?php echo EHOVEL::js('ehovel_template');?>
<link rel="stylesheet" type="text/css" href="/statics/css/fancybox/jquery.fancybox-1.3.4.css" />
<section id="main">
	<fieldset>
		<legend><?php echo __('资源列表');?></legend>
		<div class="box search">
                    <div style="padding-left:10px;">
                        <form name="search_form" method="GET" action="<?php echo url::current();?>" class="form-horizontal"> 
                             <div class="control-group">
                                 <label class="control-label" for="inputEmail"><?php echo __('Keywords');?></label>
                                 <div class="controls">
                                     <input name="name" id="name" size="10" type="text" class="text required" value="<?php echo $name;?>">
                                     <?php if(!empty($catalog_id)) {?>
                                     <input name="catalog" id="catalog" size="10" type="hidden" value="<?php echo $catalog_id;?>">
                                     <?php }?>
                                     <input name="button" class="btn btn-info" type="submit" value="<?php echo __('Search');?>">
                                 </div>
                             </div>
                        </form>
                    </div>
                </div>
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
<div class="row-fluid">
    <div class="span3">
        <div class="box menu">
	        <h2><a href="<?php echo EHOVEL::url('resource');?>"><?php echo __('Resource All');?></a></h2>
	        <section>
	            <ul>
                            <?php
                            if(!empty($catalog)) {
                                foreach($catalog as $val) {
                            ?>
	                <li>
                                <?php echo str_repeat('<ul><li>', $val->level_depth - 1);?>
                                <?php if(!empty($catalog_id) && $catalog_id == $val->id) { echo '<b>';}?>
                                <a href="<?php echo EHOVEL::url('resource?catalog='.$val->id);?>"><?php echo $val->name;?></a>
                                <?php if(!empty($catalog_id) && $catalog_id == $val->id) { echo '</b>';}?>
                                <?php echo str_repeat('</li></ul>', $val->level_depth - 1);?>
	                </li>
                            <?php }}?>
	            </ul>
	        </section>
	    </div>
    </div>
    <div class="span9">
        <!--right table-->
        <div class="nav_container clearfix">
            <div class="nav_content">
        
                <!--table operate-->
        
                <!--standard table-->
                <div class="table_wrap">
                    <div class="standard_table">
                        <form method="post" action="<?php echo EHOVEL::admin_base_url()?>resource/processlistform" id="myForm">
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
                                            <td><input class="input_c sel" type="checkbox" name="eform[ids][]" value="<?php echo $resource['id']; ?>"/></td>
                                            <td>
                                                <a href="<?php echo EHOVEL::admin_base_url(); ?>resource/edit/<?php echo $resource['id']; ?>" class="edit_item" title="编辑">
                                                	<i class="icon-edit"></i></a>
                                                <a href="<?php echo EHOVEL::admin_base_url(); ?>resource/delete?ids=<?php echo $resource['id']; ?>" class="del_item" title="删除">
                                                	<i class="icon-trash"></i></a>
                                            </td>
                                            <td>
                                            	<span class="file_name"><?php echo $resource['title'] ? $resource['title'] : $resource['name']; ?></span>
                                            </td>
                                            <td>
                                                <span class="file_pic">
                                                	<a class="ori_img" href="<?php echo $resource['is_storage']?Helper_Resource::get_img(array($resource['attach_id'],$resource['postfix']),'o'):$resource['link']; ?>">
                                                    	<img style="max-height:120px; max-width:120px" src="<?php echo $resource['is_storage']?Helper_Resource::get_img(array($resource['attach_id'],$resource['postfix'])):$resource['link']; ?>" alt="<?php echo $resource['name']; ?>" />
                                                    </a>
                                                </span> 
                                            </td>
                                            <td class="td_center"><?php echo $resource['date_upd'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php } ?>
                            </table> 
                            <input type="hidden" name="task" value="" />
        					<input type="hidden" name="return" value="" />
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
    </div>
</div>
<script type="text/javascript" src="/statics/js/jquery.fancybox-1.3.4.js"></script>
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
			 'title':'编辑资源',
			 'titlePosition':'inside'
    		});
    	$("a.ori_img").fancybox();
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
    Ehovel.submitbutton = function(task) {
    	Ehovel.submitform(task, document.getElementById('myForm'));
    }
</script>
