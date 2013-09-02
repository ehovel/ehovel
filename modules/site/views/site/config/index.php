<?php defined('SYSPATH') or die('No direct script access.'); ?>

<script type="text/javascript" src="<?php echo STATICS_BASE_URL;?>js/jquery.wysiwyg.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo STATICS_BASE_URL;?>css/jquery.wysiwyg.css">
<script type="text/javascript" src="<?php echo STATICS_BASE_URL;?>js/jquery.validate.js"></script>  
<script type="text/javascript" src="<?php echo STATICS_BASE_URL;?>js/jquery.validate.js"></script>
<?php echo EHOVEL::js('jquery.validate'); ?>

<script type="text/javascript">
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
            }
        });
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
        <h1><?php echo __('Site Config');?></h1>

        <form class="uniform" id="myForm" action="<?php echo url::current(true);?>" method="post" enctype="multipart/form-data">
            <dl class="inline">
                <dt><label for="name"><?php echo __('Name');?><span class="require">*</span></label></dt>
                <dd><input type="text" id="name" name="name" class="medium required" maxlength="255" value="<?php isset($name) && print($name);?>"/></dd>
                <dt><label for="domain"><?php echo __('Domain');?><span class="require">*</span></label></dt>
                <dd><input type="text" id="domain" name="domain" class="medium required url" maxlength="255" value="<?php isset($domain) && print($domain);?>"/></dd>
                <dt><label for="logo"><?php echo __('Logo');?></label></dt>
                <dd>
                    <div id="image"<?php if (empty($image)) { ?> style="display:none"<?php } ?>>
                        <img src="<?php if(isset($image)){echo EHOVEL::upload_url($image, '180x180');} ?>"/>
                        <input type="hidden" name="image" value="<?php if(isset($image)){echo htmlspecialchars($image);} ?>"/>
                    </div>
                <button id="upload_image" type="button" class="button tiny"><?php echo __('Upload'); ?></button>
                </dd>
                <dt><label for="seowords"><?php echo __('Site Description');?><span class="require">*</span></label></dt>
                <dd><textarea id="seowords" name="seowords" class="big required" type="textarea" ><?php isset($seowords) && print($seowords);?></textarea></dd>
                <dt><label for="product_review_type"><?php echo __('Product Review Type');?><span class="require">*</span></label></dt>
                <dd>
                    <input type="radio" name="product_review_type" value="0"<?php if (!isset($product_review_type) OR $product_review_type == 0) { ?> checked="checked"<?php } ?>>&nbsp;<?php echo __('Bought'); ?>&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="product_review_type" value="1"<?php if (isset($product_review_type) AND $product_review_type == 1) { ?> checked="checked"<?php } ?>>&nbsp;<?php echo __('Logined'); ?>
                </dd>
                
                <dt><label for="facebook_share_title"><?php echo __('Facebook Share Title');?><span class="require">*</span></label></dt>
                <dd><input type="text" id="facebook_share_title" name="facebook_share_title" class="medium required" maxlength="255" value="<?php isset($facebook_share_title) && print($facebook_share_title);?>"/></dd>
                
                <dt><label for="twitter_share_title"><?php echo __('Twitter Share Title');?><span class="require">*</span></label></dt>
                <dd><input type="text" id="facebook_share_title" name="twitter_share_title" class="medium required" maxlength="255" value="<?php isset($twitter_share_title) && print($twitter_share_title);?>"/></dd>
                
                <dt><label for="facebook_account"><?php echo __('Facebook Account');?><span class="require">*</span></label></dt>
                <dd><input type="text" id="facebook_account" name="facebook_account" class="medium required" maxlength="255" value="<?php isset($facebook_account) && print($facebook_account);?>"/></dd>
                
                <dt><label for="twitter_account"><?php echo __('Twitter Account');?><span class="require">*</span></label></dt>
                <dd><input type="text" id="twitter_account" name="twitter_account" class="medium required" maxlength="255" value="<?php isset($twitter_account) && print($twitter_account);?>"/></dd>
                
                <dt><label for="msn_account"><?php echo __('MSN Account');?><span class="require">*</span></label></dt>
                <dd><input type="text" id="msn_account" name="msn_account" class="medium required" maxlength="255" value="<?php isset($msn_account) && print($msn_account);?>"/></dd>
                
                <dt><label for="skype_account"><?php echo __('Skype Account');?><span class="require">*</span></label></dt>
                <dd><input type="text" id="skype_account" name="skype_account" class="medium required" maxlength="255" value="<?php isset($skype_account) && print($skype_account);?>"/></dd>
                
                <dt><label for="telphone"><?php echo __('Telphone');?><span class="require">*</span></label></dt>
                <dd><input type="text" id="telphone" name="telphone" class="medium required" maxlength="255" value="<?php isset($telphone) && print($telphone);?>"/></dd>

                <dt><label for="telphone"><?php echo __('Fax');?><span class="require">*</span></label></dt>
                <dd><input type="text" id="fax" name="fax" class="medium required" maxlength="255" value="<?php isset($fax) && print($fax);?>"/></dd>
                
                <dt><label for="telphone"><?php echo __('Address');?><span class="require">*</span></label></dt>
                <dd><input type="text" id="address" name="address" class="medium required" maxlength="255" value="<?php isset($address) && print($address);?>"/></dd>
                
                <dt><label for="email"><?php echo __('Email');?><span class="require">*</span></label></dt>
                <dd><input type="text" id="email" name="email" class="medium required email" maxlength="255" value="<?php isset($email) && print($email);?>"/></dd>
                <dt><label for="smtp_server"><?php echo __('SMTP Server');?><span class="require">*</span></label></dt>
                <dd><input type="text" id="smtp_server" name="smtp_server" class="medium required" maxlength="255" value="<?php isset($smtp_server) && print($smtp_server);?>"/></dd>
                
                <dt><label for="smtp_port"><?php echo __('SMTP Port');?><span class="require">*</span></label></dt>
                <dd><input type="smtp_port" id="smtp_port" name="smtp_port" class="tiny required" maxlength="255" value="<?php isset($smtp_port) ? print($smtp_port) : print(25);?>"/></dd>
                
                <dt><label for="smtp_account"><?php echo __('SMTP Account');?><span class="require">*</span></label></dt>
                <dd><input type="text" id="smtp_account" name="smtp_account" class="medium required" maxlength="255" value="<?php isset($smtp_account) && print($smtp_account);?>"/></dd>
                
                <dt><label for="smtp_password"><?php echo __('SMTP Password');?><span class="require">*</span></label></dt>
                <dd><input type="password" id="smtp_password" name="smtp_password" class="medium required" maxlength="255" value="<?php isset($smtp_password) && print($smtp_password);?>"/></dd>
                <dt><label for="score_rate_by_order_total"><?php echo __('Score rate by order total');?><span class="require">*</span></label></dt>
                <dd>
                    <?php echo __('Score');?> = 
                    <input type="text" id="score_rate_by_order_total" name="score_rate_by_order_total" class="tiny required" maxlength="255" value="<?php isset($score_rate_by_order_total) && print($score_rate_by_order_total);?>" min="0"/> x <?php echo __('Order total')?>
                </dd>
                <dt><label for="installment"><?php echo __('Installment');?><span class="require">*</span></label></dt>
                <dd>
                    <?php echo __('Installment Start');?>  
                    <input type="text" id="installmentstart" name="installment_start" class="required" maxlength="255" value="<?php isset($installment_start) && print($installment_start);?>" min="0"/>
                	<br />
                    <?php echo __('Installment First');?>  
                    <input type="text" id="installmentfirst" name="installment_first" class="required" maxlength="255" value="<?php isset($installment_first) && print($installment_first);?>" min="0"/>  <?php echo __('if < 1,As a Percentage')?>
                </dd>
            </dl>
            <div class="buttons">
                <button type="submit" class="button big"><?php echo __('Save');?></button>
            </div>
        </form>
    </article>
</section>

<?php
    echo EHOVEL::upload(array(
        'id'           => 'image',
        'type'         => 'site_config',
        'postfixs'     => 'jpg|jpeg|gif|png',
        'url_size'     => '180x180',
        'multi'        => FALSE,
        'bind'         => '#upload_image',
        'save_handler' => 'uploadImage',
    ));
?>
