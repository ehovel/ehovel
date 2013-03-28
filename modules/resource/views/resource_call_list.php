    <!--table operate-->
    <div class="standard_operate clearfix">
        <div class="mange_wrap">
            <a href="#" class="icon_link mod_link">
                <span class="icon_item">
                    <label><input class="input_c" type="checkbox" id="check_all"/>全选</label>
                </span>
            </a>
            <div class="dropdown mod_link">
                <div class="dropdown_link">
                    <span class="icon_item">
                        <span class="icon_wrap"><i class="icon_09"></i></span>
                        <span class="link_wrap">排序方式</span>
                        <span class="decor_wrap"><i class="decor_01"></i></span>
                    </span>
                </div>
                <ul class="sort_list dropdown_content">
                    <li class="item"><a href="">文件名称正序</a></li>
                    <li class="item"><a href="">文件大小正序</a></li>
                    <li class="item"><a href="">文件类型正序</a></li>
                </ul>
            </div>
        </div>
        <!--search wrap-->
        <div class="search_wrap">
            <div class="search_mod search_box">
                <input class="input_text search_text" type="text" name="search_value"/>
                <button class="btn_common button black_button" type="button" id="search">搜索</button>
            </div>
        </div>
    </div>
    <?php if (empty($resource_list)) { ?>
    <div class="message message_info">
        <i class="icon_message"></i><p class="info"><strong>提示:</strong>当前资源库为空.</p>
    </div>
    <?php } else { ?>
    <div class="resource_pic_list">
        <ul class="list clearfix">
            <?php foreach ($resource_list as $resource): ?>
                <?php
                if (empty($resource['attach_id'])) {
                    $resource['attach_id'] = $resource['link'];
                }
                ?>
                <li class="item">
                    <label>
                        <input class="input_cr sel" type="checkbox" name="resource" value="<?php echo $resource['id']; ?>"/>
                        <div class="pic">
                            <span class="img100">
                                <img vid="<?php echo $resource['id']; ?>" src="<?php echo resource::get_img($resource['attach_id']); ?>" alt="<?php echo $resource['name']; ?>" style="max-width:100px;max-height:100px;"/>
                            </span>
                        </div>
                    </label>
                    <div class="info">
                        <a href="<?php echo resource::get_link($resource['attach_id']); ?>" name="show_detail" target="_blank">
                            <span class="name"><?php echo $resource['name']; ?></span>
                        </a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php } ?>
    <!--pagination div-->
    <div class="pagination_wrap">
        <div class="tablefooter clearfix">
            <div class="actions">
            </div>
            <div class="b_r_pager" id="page">
                <?php echo $this->pagination->render('bizark_ajax'); ?>
            </div>
        </div>
    </div>

<script type="text/javascript">
    $(document).ready(function(){
        var url_base = '<?php echo url::base(); ?>';
        var url = url_base + 'resource/ajax_load_index';

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

        /*单独针对此弹出窗口的页面跳转*/
        $('#page a.ajax_request').click(function(){
        	var page_to = $("#page_to").val();
			if(page_to>total_pages){
				page_to = total_pages;
				}
			<?php if (url::current(true)!=url::current()){
				$url_current_no_page = preg_replace('/page=[a-zA-Z0-9]*/', '', url::current(true),-1,$count);
				if ($url_current_no_page == url::current(true)){?>
					link='/<?php echo $url_current_no_page;?>&page='+page_to;
					<?php }else{?>
					link='/<?php echo $url_current_no_page;?>page='+page_to;
					<?php }?>
			<?php }else{?>
					link='/<?php echo url::current();?>?page='+page_to;
			<?php }?>
			$('#page a.ajax_request').attr("href",link);
            return false;
        });
        
        $('#page a').click(function(){
            var link = $(this).attr('href');
            $("div.#resource_list").load(link);
            return false;
        });
        

        $('#search').click(function(){
            v = $('input[name="search_value"]').val();
            $("div.#resource_list").load(url + create_query_string('search_value',v) + '<?php echo isset($_GET['file_type']) ? '&file_type='.$_GET['file_type'] : '' ?>');
            return false;
        });

        $('#orderby').change(function(){
            v = $(this).attr('value');
            $("div.#resource_list").load(url + create_query_string('orderby',v) + '<?php echo isset($_GET['file_type']) ? '&file_type='.$_GET['file_type'] : '' ?>');
            return false;
        });
    });
</script>
<script type="text/javascript">
    function create_query_string(change_key,value){
        var query_arr = <?php echo json_encode($params); ?>;
        var query_string = '';
        if(query_arr.length == 0){
            query_string += '?'+change_key+'='+value;
        }else{
            var flag = 0;
            for(var key in query_arr){
                if(key == change_key){
                    query_string += '&'+key+'='+value;
                    flag = 1;
                }else{
                    query_string += '&'+key+'='+query_arr[key];
                }
            }
            if(!flag){
                query_string += '&'+change_key+'='+value;
            }
            query_string = query_string.replace(/^&/g,'?');
        }
        return query_string;
    }
</script>