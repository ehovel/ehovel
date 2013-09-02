<?php defined('SYSPATH') or die('No direct script access.'); ?>
<?php echo EHOVEL::js('jquery.validate'); ?>
<script type="text/javascript">
    jQuery(function($) {
        $('#myForm').validate({
            onkeyup: false,
            rules: {
                name: {
                    required: true,
                    maxlength: 255,
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
            var space_type = document.getElementById('space_type');
            if((space_type.value=="code") || (space_type.value=="text"))
            {

                    t1.style.display = "none";
                    t2.style.display = "none";
            }
            else if((space_type.value=="banner") || (space_type.value=="imagechange") || (space_type.value=="imagelist"))
            {

                    t1.style.display = "";
                    t2.style.display = "none";
            }
            else if((space_type.value=="fixure") || (space_type.value=="float") || (space_type.value=="couplet"))
            {

                    t1.style.display = "";
                    t2.style.display = "";
            }
        }

</script>
<section class="container_12 clearfix">
    <?php Remind::render_current();?>
    <article>
        <h1><?php echo __('Ads Space Info');?></h1>
        <form class="uniform" id="myForm" action="<?php echo url::current(true);?>" method="post" enctype="multipart/form-data">
        		<!-- 模板文件名 -->
                <dt><label for="space_name"><?php echo __('Space File Name');?><span class="require">*</span></label></dt>
                <dd><input type="text" name="space_name" id="space_name" class="medium required" maxlength="20"
                           value="<?php echo $key;?>"/></dd>
				
				<!-- 中文名 -->
                <dt><label for="Spacetype"><?php echo __('CN Name');?><span class="require">*</span></label></dt>
                <dd><input type="text" name="space_name" id="space_name" class="medium required" maxlength="20"
                           value="<?php echo $set_detail['name'];?>"/></dd>
                
                <!-- 是否出现以下属性 -->
                <dt><label for="align"><?php echo __('Whether the following attributes appear');?><span class="require">*</span></label></dt>
                <dd>
                    <input type="radio" name="align" value="0"<?php if (isset($set_detail['align']) AND $set_detail['align'] == 'align') { ?> checked="checked"<?php } ?>>&nbsp;<?php echo __('isCenter'); ?>&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="align" value="1"<?php if (isset($set_detail['align']) AND $set_detail['align'] == 'scroll') { ?> checked="checked"<?php } ?>>&nbsp;<?php echo __('isRollin'); ?>
                </dd>
                
                <!-- 上述属性是否被选中 -->
                <dt><label for="select"><?php echo __('Whether the following attributes appear');?><span class="require">*</span></label></dt>
                <dd>
                    <input type="radio" name="select" value="0"<?php if (isset($set_detail['select']) AND $set_detail['select'] == 1) { ?> checked="checked"<?php } ?>>&nbsp;<?php echo __('YES'); ?>&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="select" value="1"<?php if (isset($set_detail['select']) AND $set_detail['select'] == 0) { ?> checked="checked"<?php } ?>>&nbsp;<?php echo __('NO'); ?>
                </dd>
                
                <!-- 是否设置版位位置 -->
                <dt><label for="padding"><?php echo __('Set edition whether a position');?><span class="require">*</span></label></dt>
                <dd>												
                    <input type="radio" name="padding" value="0"<?php if (isset($set_detail['padding']) AND $set_detail['padding'] == 1) { ?> checked="checked"<?php } ?>>&nbsp;<?php echo __('YES'); ?>&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="padding" value="1"<?php if (isset($set_detail['padding']) AND $set_detail['padding'] == 0) { ?> checked="checked"<?php } ?>>&nbsp;<?php echo __('NO'); ?>
                </dd>
                
                <!-- 是否设置版位尺寸 -->
                <dt><label for="size"><?php echo __('Set edition is a size');?><span class="require">*</span></label></dt>
                <dd>
                    <input type="radio" name="size" value="0"<?php if (isset($set_detail['size']) AND $set_detail['size'] == 1) { ?> checked="checked"<?php } ?>>&nbsp;<?php echo __('YES'); ?>&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="size" value="1"<?php if (isset($set_detail['size']) AND $set_detail['size'] == 0) { ?> checked="checked"<?php } ?>>&nbsp;<?php echo __('NO'); ?>
                </dd>
                
                <!-- 版位下的广告 -->
                <dt><label for="option"><?php echo __('Version of the ads');?><span class="require">*</span></label></dt>
                <dd>
                    <input type="radio" name="option" value="0"<?php if (isset($set_detail['option']) AND $set_detail['option'] == 1) { ?> checked="checked"<?php } ?>>&nbsp;<?php echo __('ALL'); ?>&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="option" value="1"<?php if (isset($set_detail['option']) AND $set_detail['option'] == 0) { ?> checked="checked"<?php } ?>>&nbsp;<?php echo __('SORT'); ?>
                </dd>
                
                <!-- 可用广告类型 -->
                <dt><label for="type"><?php echo __('Available advertising types');?><span class="require">*</span></label></dt>
                <dd>
                    <input type="checkbox" name="type" value="0"<?php if (isset($set_detail['type']['images'])) { ?> checked="checked"<?php } ?>>&nbsp;<?php echo __('Images'); ?>&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="type" value="0"<?php if (isset($set_detail['type']['flash'])) { ?> checked="checked"<?php } ?>>&nbsp;<?php echo __('Flash'); ?>&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="type" value="0"<?php if (isset($set_detail['type']['text'])) { ?> checked="checked"<?php } ?>>&nbsp;<?php echo __('Text'); ?>
                </dd>
                
                <!-- 一次最多添加的图片等元素数量 -->
                <dt><label for="num"><?php echo __('A most of the element such as number add pictures');?><span class="require">*</span></label></dt>
                <dd><input type="text" name="num" id="num" class="medium required" maxlength="20"
                           value="<?php echo $set_detail['num'];?>"/></dd>
        </form>
    </article>
</section>