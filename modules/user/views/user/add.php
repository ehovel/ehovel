<?php defined('SYSPATH') OR die('No direct script access.'); ?>
<script type="text/javascript" src="<?php echo STATICS_BASE_URL;?>js/jquery.validate.js"></script>
<script type="text/javascript">
    $(function() {
        $('#myForm').validate({
            rules:{
                email : {
                    remote: '<?php echo BES::url('user/check');?>?key=email'
                },
                password1: {
                    equalTo: "#password"
                }
            },
            messages:{
                email : {
                    remote: '<?php echo __('The email exists already, please rewrite!');?>'
                },
                password1: {
                    equalTo: "<?php echo __('Please make sure both your password entries match.');?>"
                }
            }
        });
    });

    function uploadImage(image) {
        $('#image').show();
        $('#image').find('img').attr('src', image['url']);
        $('#image').find('input').val(image['uri']);
    }
</script>
<div class="container_12 clearfix">
    <?php Remind::render_current();?>
    <article>
        <h1><?php echo __('Add New User');?></h1>

        <form class="uniform" id="myForm" action="<?php echo url::current(true);?>" method="post">
            <fieldset>
                <dl class="inline">
                    <dt><label for="email"><?php echo __('Email');?><span class="require"> *</span></label></dt>
                    <dd><input type="text" name="email" id="email" class="email required" maxlength="50" value=""/></dd>
                    <dt><label for="password"><?php echo __('Password');?><span class="require"> *</span></label></dt>
                    <dd>
                        <input type="password" name="password" id="password" class="required" minlength="6" maxlength="20" value=""/>
                        <small><?php echo __('Password length greater than 6 less than 20.');?></small>
                    </dd>
                    <dt><label for="password1"><?php echo __('Password Confirm');?><span class="require"> *</span></label></dt>
                    <dd><input type="password" name="password1" id="password1" class="required" minlength="6" maxlength="20" value=""/></dd>
                    <dt><label><?php echo __('Firstname');?><span class="require"> *</span></label></dt>
                    <dd><input type="text" name="firstname" id="name" class="required" maxlength="50" value=""/></dd>
                    <dt><label><?php echo __('Lastname');?><span class="require"> *</span></label></dt>
                    <dd><input type="text" name="lastname" id="name" class="required" maxlength="50" value=""/></dd>
                    <dt><label><?php echo __('Sex');?><span class="require"> *</span></label></dt>
                    <dd>
                        <select name="sex" class="required">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </dd>
                    <dt><label><?php echo __('Member Grade');?></label></dt>
                    <dd><select id="group" name="group">
                        <?php foreach ($groups as $group): ?>
                        <option value="<?php echo $group->id;?>"><?php echo $group->name;?></option>
                        <?php endforeach;?>
                    </select>
                    </dd>
                    <dt><label><?php echo __('Company Name');?></label></dt>
                    <dd><input type="text" name="company_name"  class="" maxlength="100" value=""/></dd>
                    <dt><label><?php echo __('Company Address');?></label></dt>
                    <dd><input type="text" name="company_address"  class="" maxlength="255" value=""/></dd>
                    <dt><label><?php echo __('Company Phone');?></label></dt>
                    <dd><input type="text" name="company_phone"  class="" maxlength="50" value=""/></dd>
                    <dt><label><?php echo __('Contace Person');?></label></dt>
                    <dd><input type="text" name="contact_person"  class="" maxlength="100" value=""/></dd>
                    <dt><label><?php echo __('Certificate Image');?></label></dt>
                    <dd>
                    <div id="image"style="display:none">
                        <img src=""/>
                        <input type="hidden" name="certificate_image" value=""/>
                    </div>
                    <button id="upload_image" type="button" class="button tiny"><?php echo __('Upload'); ?></button>
                    <small><?php echo __('Extension available:gif, png, jpg, jpeg');?></small></dd>
                    
                    <dt><label><?php echo __('Activate or not');?></label></dt>
                    <dd>
                        <label><input type="radio" value="active" name="status" checked="checked"/><?php echo __('Active');?></label>
                        <label><input type="radio" value="inactive" name="status"/><?php echo __('Inactive');?></label>
                    </dd>
                    <dt><label><?php echo __('Available or not');?></label></dt>
                    <dd>
                        <label><input type="radio" value="Y" name="active" checked="checked"/><?php echo __('Yes');?>
                        </label>
                        <label><input type="radio" value="N" name="active"/><?php echo __('No');?></label>
                    </dd>
                </dl>
                <div class="buttons">
                    <button type="submit" class="button big"><?php echo __('Save');?></button>
                    <?php echo html::cancel_anchor(BES::url('user/index')); ?>
                </div>
            </fieldset>
        </form>
    </article>
</div>
<?php
    echo BES::upload(array(
        'id'           => 'image',
        'type'         => 'certificate',
        'postfixs'     => 'jpg|jpeg|gif|png',
        //'url_size'     => '180x180',
        'multi'        => FALSE,
        'bind'         => '#upload_image',
        'save_handler' => 'uploadImage',
    ));
?>