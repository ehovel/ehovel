<?php defined('SYSPATH') or die('No direct script access.'); ?>
<?php echo EHOVEL::js('jquery.validate'); ?>
<script type="text/javascript">
    window.onload=function()
    {
       change();
    }
    
    jQuery(function($) {
        $('#myForm').validate({
            onkeyup: false,
            rules: {
                name: {
                    required: true,
                    maxlength: 255
                },
                domain:{
                    maxlength: 255
                },
                description: {
                    maxlength: 255
                }
            },
            messages: {
                name: {
                    remote: '<?php echo __('Name can not be repeated'); ?>'
                }
            }
        });
    });

    function uploadImage(image) {
        $('#image').show();
        $('#image').find('img').attr('src', image['url_180x180']);
        $('#image').find('input').val(image['uri']);
    }
    
    function change()
    {
        var t1 = document.getElementById('t1');
        var t2 = document.getElementById('t2');
        var ads_type = document.getElementById('ads_type');
        if(ads_type.value=="images")
        {
            t1.style.display = "";
            t2.style.display = "none";
        }
        else if(ads_type.value=="flash")
        {
            t1.style.display = "none";
            t2.style.display = "";
        }
        else if(ads_type.value=="code")
        {
        	t1.style.display = "";
            t2.style.display = "";
        }
    }
</script>

<section class="container_12 clearfix">
    <article>
        <h1><?php echo __('Edit Ads');?></h1>
        <form class="uniform" id="myForm" action="<?php echo url::current(true);?>" method="post" enctype="multipart/form-data">
            <dl class="inline">
                <dt><label for="ads_title"><?php echo __('Ads Title');?><span class="require">*</span></label></dt>
                <dd><input type="text" name="ads_title" id="ads_title" class="medium required" maxlength="20" value="<?php if(!empty($ads_detail->name)){echo $ads_detail->name;}?>"/></dd>

                <dt><label for="ads_type"><?php echo __('Ads Type');?><span class="require">*</span></label></dt>
                <dd>
                    <select name="ads_type" id="ads_type" onChange="change()">
                    	 <?php foreach ($types as $key=>$value) { ?>
                        <option value="<?php echo $key;?>"><?php echo $value;?></option>
                        <?php }?>
                    </select>
                </dd>
                
                <dt><label for="ads_module"><?php echo __('Ads Module');?></label></dt>
                <dd><B><?php if(!empty($space_info->name)){echo $space_info->name;}?></B>
                    <?php 
                        if(!empty($space_info->type))
                        {
                            foreach($ads_info as $key=>$ad_info)
                            {
                                if($space_info->type == $key)
                                {
                                    echo '[ '.$ad_info['name'].' ]';
                                }
                            }
                    }?>
                </dd>
                
                <?php if($ads_detail->type != '3'):?>
                	<dt><label for="text_content"><?php echo __('Text Content');?><span class="require">*</span></label></dt>
                	<dd><textarea id="text_content" name="text_content" class="big required" ><?php if(!empty($ads_detail->title)){echo $ads_detail->title;}?></textarea></dd>
                <?php else:?>
                <div id="t1">
                    <dt><label for="alt_tip"><?php echo __('Alt Tip');?></label></dt>
                    <dd>
                    	<input type="text" name="alt_tip" id="alt_tip" class="medium" maxlength="20" value="<?php if(!empty($ads_detail->alt)){echo $ads_detail->alt;}?>"/>
                	</dd>
                	
                	<dt><label for="link_address"><?php echo __('Link Address');?></label></dt>
                    <dd>
                    	<input type="text" name="link_address" id="link_address" class="medium" maxlength="255" value="<?php if(!empty($ads_detail->linkurl)){echo $ads_detail->linkurl;}else{echo 'http://';}?>" />
            		</dd>
            		
                	<dt><label for="image"><?php echo __('Images');?></label></dt>
                    <dd>
                    	<div id="image"<?php if (empty($ads_detail->imageurl)) { ?> style="display:none"<?php } ?>>
                            <img src="<?php if(isset($ads_detail->imageurl)){echo BES::upload_url($ads_detail->imageurl, '180x180');} ?>"/>
                            <input type="hidden" name="image" value="<?php if(isset($ads_detail->imageurl)){echo htmlspecialchars($ads_detail->imageurl);} ?>"/>
                        </div>
                        <button id="upload_image" type="button" class="button tiny"><?php echo __('Upload'); ?></button>
                    </dd>
                </div>
                
                <div id="t2">
                    <dt><label for="flash_address"><?php echo __('Flash Address');?></label></dt>
                    <dd>
                    	<input type="text" name="flash_address" id="flash_address" class="medium" maxlength="255" value="<?php if(!empty($ads_detail->flashurl)){echo $ads_detail->flashurl;}?>"/>
                	</dd>
                </div>
                <?php endif;?>
            </dl>
            <div class="buttons">
                <button type="submit" class="button big"><?php echo __('Save');?></button>
                <?php echo html::cancel_anchor(EHOVEL::url('cms_ads/index')); ?>
            </div>
        </form>
    </article>
</section>


<?php
    echo EHOVEL::upload(array(
        'id'           => 'image',
        'type'         => 'poster',
        'postfixs'     => 'jpg|jpeg|gif|png',
        'url_size'     => '180x180',
        'multi'        => FALSE,
        'bind'         => '#upload_image',
        'save_handler' => 'uploadImage',
    ));
?>