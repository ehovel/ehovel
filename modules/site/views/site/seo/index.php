<?php defined('SYSPATH') or die('No direct script access.'); ?>
<script type="text/javascript" src="<?php echo STATICS_BASE_URL;?>js/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="<?php echo STATICS_BASE_URL;?>js/jquery.validate.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo STATICS_BASE_URL;?>css/jquery.wysiwyg.css">
<script type="text/javascript">
    $(document).ready(function(){
        $(".tabs li").each(function(){
            $(this).removeClass('selected');
        });
        $('#default').css('display', 'none');
        $('#home').css('display', 'none');
        $('#products').css('display', 'none');
        $('#categories').css('display', 'none');
        <?php $sign = isset($sign) ? $sign : 'default';?>;
        $('.<?php echo $sign;?>').addClass('selected');
        $('#<?php echo $sign;?>').css('display', '');
    });
</script> 
<section class="container_12 clearfix">
    <?php remind::render_current();?>
    <article>
        <h1><?php echo __('SEO Information Configuration');?></h1>
        <ul class="tabs">
            <li class="default"><a href="#default"><?php echo __('SEO Default Configuration'); ?></a></li>
            <li class="home"><a href="#home"><?php echo __('SEO Configuration for Home'); ?></a></li>
            <li class="products"><a href="#products"><?php echo __('SEO Configuration for Products'); ?></a></li>
            <li class="categories"><a href="#categories"><?php echo __('SEO Configuration for Categories'); ?></a></li>
        </ul>
        <div class="tabcontent">
            <div id="default">
                <form class="uniform" id="baseform" action="<?php echo url::current(true);?>" method="post">
                    <dl class="inline">
                        <dt><label for="title"><?php echo __('Default Title');?></label></dt>
                        <dd><input type="text" id="title" name="title" class="big required" maxlength="255" value="<?php isset($title) && print($title);?>"/></dd>
                        <dt><label for="keywords"><?php echo __('Default Keywords');?></label></dt>
                        <dd><textarea id="keywords" name="keywords" class="big required" type="textarea"><?php isset($keywords) && print($keywords);?></textarea></dd>
        
                        <dt><label for="description"><?php echo __('Default Description');?></label></dt>
                        <dd><textarea id="description" name="description" class="big required" type="textarea"><?php isset($description) && print($description);?></textarea></dd>
                    </dl>
                    <div class="buttons">
                        <button type="submit" class="button big"><?php echo __('Save');?></button>
                    </div>
                </form>
            </div>
            <div id="home" style="display: none;">
                <form class="uniform" id="seoform" action="<?php echo EHOVEL::url('site_seo/home');?>" method="post">
                    <dl class="inline">
                        <dt><label for="index_title"><?php echo __('Homepage Title');?></label></dt>
                        <dd><input type="text" id="index_title" name="index_title" class="big required" maxlength="255" value="<?php isset($index_title) && print($index_title);?>"/></dd>
        
                        <dt><label for="index_keywords"><?php echo __('Homepage Keywords');?></label></dt>
                        <dd><textarea id="index_keywords" name="index_keywords" class="big required" type="textarea" ><?php isset($index_keywords) && print($index_keywords);?></textarea></dd>
        
                        <dt><label for="index_description"><?php echo __('Homepage Description');?></label></dt>
                        <dd><textarea id="index_description" name="index_description" class="big required" type="textarea" ><?php isset($index_description) && print($index_description);?></textarea></dd>
                    </dl>
                    <div class="buttons">
                        <button type="submit" class="button big"><?php echo __('Save');?></button>
                    </div>
                </form>
            </div>
            <div id="products" style="display: none;">
                <form class="uniform" id="add_form" action="<?php echo EHOVEL::url('site_seo/product');?>" method="post">
                    <dl class="inline">
                        <dt><label for="name"><?php echo __('Category');?></label></dt>
                        <dd>
                        <select name="category_id" id="category_id" class="">
                                <option value=""><?php echo __('All Categories');?></option>
                                <?php foreach ($categories as $category) {?>
                                    <option value="<?php echo $category->pk(); ?>"<?php if ($category->pk() == $product->category_id) { ?> selected="selected"<?php } ?>>
                                        <?php echo ($category->level > 1 ? str_repeat('-', ($category->level - 1) * 4) . ' ' : ''); ?><?php echo htmlspecialchars($category->name); ?>
                                    </option>
                                <?php } ?>
                        </select>
                        <span class="is_children_tr"><input id="is_children" type="checkbox" name="is_children" value="1"><label for="name"><?php echo __('Contain subclassification or not?');?></label></span><span id="category_change_tips" class="valierror"></span>
                        </dd>
        
                        <dt><label for="meta_title"><?php echo __('Meta Title');?><span class="require">*</span></label></dt>
                        <dd><input type="text" id="meta_title" name="meta_title" class="big required" maxlength="255" value="<?php echo $seo_data->meta_title;?>"/></dd>
        
                        <dt><label for="meta_keywords"><?php echo __('Meta Keywords');?><span class="require">*</span></label></dt>
                        <dd><textarea id="meta_keywords" name="meta_keywords" class="big required" type="textarea" ><?php echo $seo_data->meta_keywords;?></textarea></dd>
        
                        <dt><label for="meta_description"><?php echo __('Meta Description');?><span class="require">*</span></label></dt>
                        <dd><textarea id="meta_description" name="meta_description" class="big required" type="textarea" ><?php echo $seo_data->meta_description;?></textarea></dd>
        
                        <dt><label for="name"><?php echo __('Alternative Variable');?></label></dt>
                        <dd>{product_name}:<?php echo __('Product Name');?></br>
                        {category_name}:<?php echo __('Category Name');?></br>
                        {price}:<?php echo __('Product Price');?></br>
                        </dd>
                    </dl>
                    <div class="buttons">
                        <button type="submit" class="button big"><?php echo __('Save');?></button>
                    </div>
                </form>
            </div>
            
            <div id="categories" style="display: none;">
                <form class="uniform" id="add_category_form" action="<?php echo EHOVEL::url('site_seo/category');?>" method="post">
                    <dl class="inline">
                        <dt><label for="c_is_children"><?php echo __('Category');?><span class="require">*</span></label></dt>
                        <dd>
                        <select name="category_id" id="c_category_id" class="required">
                                <option value=""><?php echo __('Select Category');?></option>
                                <?php foreach ($categories as $category) {?>
                                    <option value="<?php echo $category->pk(); ?>"<?php if ($category->pk() == $product->category_id) { ?> selected="selected"<?php } ?>>
                                        <?php echo ($category->level > 1 ? str_repeat('-', ($category->level - 1) * 4) . ' ' : ''); ?><?php echo htmlspecialchars($category->name); ?>
                                    </option>
                                <?php } ?>
                        </select>
                    	<input id="is_children" type="checkbox" name="is_children" value="1"><?php echo __('Update all the subclassifications of this classification');?><span id="category_change_tips" class="valierror"></span>
                        </dd>
        
                        <dt><label for="c_meta_title"><?php echo __('Meta Title');?><span class="require">*</span></label></dt>
                        <dd><input type="text" id="c_meta_title" name="meta_title" class="big required" maxlength="255" value="<?php isset($seo_category_data->meta_title) && print($seo_category_data->meta_title) ?>"/></dd>
        
                        <dt><label for="c_meta_keywords"><?php echo __('Meta Keywords');?><span class="require">*</span></label></dt>
                        <dd><textarea id="c_meta_keywords" name="meta_keywords" class="big required" type="textarea" ><?php isset($seo_category_data->meta_keywords) && print($seo_category_data->meta_keywords) ?></textarea></dd>
        
                        <dt><label for="c_meta_description"><?php echo __('Meta Description');?><span class="require">*</span></label></dt>
                        <dd>
                            <textarea id="c_meta_description" name="meta_description" class="big required" type="textarea" ><?php isset($seo_category_data->meta_description) && print($seo_category_data->meta_description) ?></textarea>
                        </dd>
        
                        <dt><label for="name"><?php echo __('Alternative Variable');?></label></dt>
                        <dd>
                        {category_name}:<?php echo __('Name');?><br>
                        {parent_category_name}:<?php echo __('Upper Category Name');?>
                        </dd>
                    </dl>
                    <div class="buttons">
                        <button type="submit" class="button big"><?php echo __('Save');?></button>
                    </div>
                </form>
            </div>
        </div>
    </article>
</section>

<script type="text/javascript">
$(document).ready(function(){
    var url_base = '<?php echo url::base();?>';
    $("#add_form").validate({
        onkeyup:false
    });
    var select = function(item, checked) {
        item.attr('checked', checked);

        var p = item.parent();
        if (p[0].tagName.toUpperCase() == 'SPAN') {
            if (checked) {
                p.addClass('checked');
            } else {
                p.removeClass('checked');
            }
        }
    }

    var url_base = '<?php echo url::base();?>';
    var select = function(item, checked) {
        item.attr('checked', checked);

        var p = item.parent();
        if (p[0].tagName.toUpperCase() == 'SPAN') {
            if (checked) {
                p.addClass('checked');
            } else {
                p.removeClass('checked');
            }
        }
    }
    $('#category_id').bind('change keyup', function(){
        cur_disstat = $(this).attr('disabled');
        if(!cur_disstat){
            var category_id = $(this).val();
            if(category_id == 0){
                $('.is_children_tr').css('display', 'none');
            }else{
                $('.is_children_tr').css('display', '');
            }
            $('#category_change_tips').html('loading...');
            $(this).attr('disabled',true);
            $.ajax({
            	url: '<?php echo EHOVEL::url('site_seo/product_child'); ?>?category_id=' + category_id + '&time=<?php echo mt_rand(1, 100000000)?>',
                type:'GET',
                dataType: 'json',
                success: function (retdat, status) {
                    if(retdat['is_contain_child'] == 1){
                        $('.is_children_tr').css('display', '');
                    }else{
                        $('.is_children_tr').css('display', 'none');
                        $("#is_children").attr('checked', '');
                    }
                    if (retdat['status'] == 1 && retdat['code'] == 200) {
                        $('#category_change_tips').empty();
                        $('#category_id').removeAttr('disabled');
                        $("#meta_description").val(retdat['content']['meta_description']);
                        $("#meta_keywords").val(retdat['content']['meta_keywords']);
                        $("#meta_title").val(retdat['content']['meta_title']);
                        if(retdat['content']['is_children'] == 1){
                            select($("#is_children"), true);
                        }else{
                            $("#is_children").attr('checked', '');
                        }
                    } else {
                        $('#category_id').removeAttr('disabled');
                        $('#category_change_tips').css('display', 'none');
                        $("#meta_description").val('');
                        $("#meta_keywords").val('');
                        $("#meta_title").val('');
                        $("#is_children").attr('checked', '');
                    }
                },
                error:function(){
                    /* reset layout */
                    $('#category_id').removeAttr('disabled');
                    $("#category_change_tips").html("<?php echo __('Classification load failed, please try again later!');?>");
                    window.setTimeout(function(){
                        /* clear tips */
                        $("#category_change_tips").empty();
                    },2000);
                }
            });
        }
    });
});
</script>

<script type="text/javascript">
$(document).ready(function(){
	var url_base = '<?php echo url::base();?>';
	var select = function(item, checked) {
        item.attr('checked', checked);
        var p = item.parent();
    }
	$("#add_category_form").validate({
        onkeyup:false
	});
    $('#c_category_id').bind('change keyup', function(){
        cur_disstat = $(this).attr('disabled');
        if(!cur_disstat){
            var category_id = $(this).val();
            $('#c_category_change_tips').html('loading...');
            $(this).attr('disabled',true);
            $.ajax({
            	url: '<?php echo EHOVEL::url('site_seo/category_child'); ?>?category_id=' + category_id + '&time=<?php echo mt_rand(1, 100000000)?>',
                type:'GET',
                dataType: 'json',
                success: function (retdat, status) {
                    if (retdat['status'] == 1 && retdat['code'] == 200) {
                        $('#c_category_change_tips').empty();
                        $('#c_category_id').removeAttr('disabled');
                        $("#c_meta_description").val(retdat['content']['meta_description']);
                        $("#c_meta_keywords").val(retdat['content']['meta_keywords']);
                        $("#c_meta_title").val(retdat['content']['meta_title']);
                        if(retdat['content']['is_children'] == 1){
                            select($("#c_is_children"), true);
                        }else{
                            $("#c_is_children").attr('checked', '');
                        }
                    } else {
                        $('#c_category_id').removeAttr('disabled');
                        $('#c_category_change_tips').css('display', 'none');
                        $("#c_meta_description").val('');
                        $("#c_meta_keywords").val('');
                        $("#c_meta_title").val('');
                        $("#c_is_children").attr('checked', '');
                    }
                },
                error:function(){
                    /* reset layout */
                    $('#c_category_id').removeAttr('disabled');
                    $("#c_category_change_tips").html("<?php echo __('Classification load failed, please try again later!');?>");
                    window.setTimeout(function(){
                        /* clear tips */
                        $("#c_category_change_tips").empty();
                    },2000);
                }
            });
        }
    });
});
</script>