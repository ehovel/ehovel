<?php defined('SYSPATH') or die('No direct script access.'); ?>
<script type="text/javascript" src="<?php echo STATICS_BASE_URL;?>js/jquery.validate.js"></script>
<?php echo EHOVEL::js('jquery.validate'); ?>
<script type="text/javascript">
    jQuery(function($) {
        $('#myForm').validate({
            onkeyup: false,
            rules: {
                name: {
                    required: true,
                    maxlength: 255,
                    remote: '<?php echo EHOVEL::url('currency/name_exist'); ?>'
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
   <?php if($default_currency->cur_code){?>
        $('#cur_code').bind('change', function(){
            var url = '<?php echo EHOVEL::url('site_currency/get_rate')?>?code=' + $(this).val();
        	$.ajax({
                url: url,
                type: 'GET',
                //dataType: 'json',
                cache: false,
                success: function(rethat) {
                	$('#rate_recommend').html(rethat);
                },
                error: function() {}
            });
        });
        $('#cur_code').change();
	<?php }?>
        
    });
        function uploadImage(image) {
            $('#image').show();
            $('#image').find('img').attr('src', image['url_180x180']);
            $('#image').find('input').val(image['uri']);
        }
  
</script>

<section class="container_12 clearfix">
    <?php remind::render_current();?>
    <article>
        <h1><?php echo __('Add Currency');?></h1>

        <form class="uniform" id="myForm" action="<?php echo url::current(true);?>" method="post"
              enctype="multipart/form-data">
            <dl class="inline">
                <dt><label for="cur_name"><?php echo __('Name');?><span class="require">*</span></label></dt>
                <dd><input type="text" name="cur_name" id="cur_name" class="medium required" maxlength="20"/></dd>

                <dt><label for="cur_code"><?php echo __('Code');?><span class="require">*</span></label></dt>
                <dd>
                    <select name="cur_code" id="cur_code">
                        <?php foreach ($cur_codes as $key => $code) { ?>
                        <option value="<?php echo $code;?>"><?php echo $code;?></option>
                        <?php }?>
                    </select>
                </dd>

                <dt><label for="image"><?php echo __('Icon');?></label></dt>
                <dd>
                    <div id="image"<?php if (empty($currency->image)) { ?> style="display:none"<?php } ?>>
                        <img src="<?php echo EHOVEL::upload_url($currency->image, '180x180'); ?>"/>
                        <input type="hidden" name="image" value="<?php echo htmlspecialchars($currency->image); ?>"/>
                    </div>
                    <button id="upload_image" type="button" class="button tiny"><?php echo __('Upload'); ?></button>
                    <small><?php echo __('Extension available:gif, png, jpg, jpeg');?></small>
                </dd>

                <dt><label for="cur_sign"><?php echo __('Sign');?><span class="require">*</span></label></dt>
                <dd><input type="text" name="cur_sign" id="cur_sign" class="small required" maxlength="5"/></dd>

                <dt><label for="cur_rate"><?php echo __('Rate');?><span class="require">*</span></label></dt>
                <dd>
                    <input type="text" name="cur_rate" id="cur_rate" class="small required number" maxlength="9"/>
                    <span id="rate_recommend" style="display:block;"></span>
                    <small><?php echo __('1 Current Currency = ? Default Currency,Default currency exchange rates can only be 1');?></small>
                </dd>

                <dt><label for="is_default"><?php echo __('Default currency');?></label></dt>
                <dd>
                    <select name="is_default" id="is_default">
                        <option value="Y"><?php echo __('Yes');?></option>
                        <option value="N" selected="selected"><?php echo __('No');?></option>
                    </select>
                    <small><?php echo __('Can retain a default currency, default currency as the fundamental basis of all transactions, change the default currency systems do not automatically convert the original data, please be sure!');?></small>
                </dd>
            </dl>
            <div class="buttons">
                <button type="submit" class="button big"><?php echo __('Save');?></button>
                <?php echo html::cancel_anchor(EHOVEL::url('site_currency')); ?>
            </div>
        </form>
    </article>
</section>

<?php
    echo EHOVEL::upload(array(
        'id'           => 'image',
        'type'         => 'currency',
        'postfixs'     => 'jpg|jpeg|gif|png',
        'url_size'     => '180x180',
        'multi'        => FALSE,
        'bind'         => '#upload_image',
        'save_handler' => 'uploadImage',
    ));
?>