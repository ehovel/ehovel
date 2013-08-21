<?php defined('SYSPATH') OR die('No direct access allowed.');?>
<!--standard table-->
<div class="nav_container clearfix">
    <!--tree content-->
    <div class="nav_content">

        <!--table operate-->

        <!--standard table-->
        <div class="table_wrap">
            <div class="standard_table">
                <form method="post" action="<?php echo EHOVEL::admin_base_url()?>resource/processlistform" id="myForm">
                    <table class="table">
                        <tr>
                            <th width="50px" class="no_leftbor"><input class="input_c" type="checkbox" id="check_all"/></th>
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
        <div class="container">
		    <div class="form-horizontal">
                <div class="control-group">
              	    <div class="controls">
                  		<button type="submit" class="btn btn-primary" id="btnSubmit2">插入选中</button>
           				<button type="button" class="btn" id="btnCancel2">取消</button>
                  	</div>
        	    </div>
            </div>
    	</div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
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
            $('#resource_data .pagination_wrap').find('a').click(function(){
                var url = $(this).attr('href');
                if(url != 'javascript:;') {
                    $.get(url,function(data) {
                        $('#resource_data').html(data);
                    })
                }
                return false;
            });
        });
    </script>
</div>

