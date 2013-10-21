<?php defined('SYSPATH') OR die('No direct script access.'); ?>
<script type="text/javascript" src="<?php echo STATICS_BASE_URL;?>js/jquery.validate.js"></script>
<script type="text/javascript">
    $(function() {
        $('#myForm').validate({
            rules: {
                email : {
                    remote: '<?php echo BES::url('user/check');?>?key=email&old_email=' + $('#old_email').val()
                },
                password1: {
                    equalTo: "#password"
                }
            },
            messages: {
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
<section class="line">
    <?php remind::render_current();?>
    <section class="unit size2of5">
        <article>
            <h1><?php echo __('Edit Member');?></h1>

            <form class="uniform" id="myForm" action="<?php echo url::current(true);?>" method="post">
                <dl>
                    <dt><label for="email"><?php echo __('Email');?><span class="require"> *</span></label></dt>
                    <dd><input type="text" name="email" id="email" class="email required" maxlength="50"
                               value="<?php echo $user->email;?>"/><input type="hidden" id="old_email"
                                                                          value="<?php echo $user->email;?>"/></dd>
                    <dt><label for="password"><?php echo __('Password');?></label></dt>
                    <dd><input type="password" name="password" id="password" minlength="6" maxlength="20" value=""/><span class="ml10"><?php echo __('Leave blank without modify');?></span></dd>
                    <dt><label><?php echo __('Firstname');?><span class="require"> *</span></label></dt>
                    <dd><input type="text" name="firstname" id="firstname" class="required" maxlength="50" value="<?php echo $user->firstname;?>"/></dd>
                    <dt><label><?php echo __('Lastname');?><span class="require"> *</span></label></dt>
                    <dd><input type="text" name="lastname" id="lastname" class="required" maxlength="50" value="<?php echo $user->lastname;?>"/></dd>
                    <dt><label><?php echo __('Sex');?><span class="require"> *</span></label></dt>
                    <dd>
                        <select name="sex" class="required">
                            <option value="male"<?php echo $user->sex == 'male'?' selected':'';?>>Male</option>
                            <option value="female"<?php echo $user->sex == 'female'?' selected':'';?>>Female</option>
                        </select>
                    </dd>
                    <dt><label><?php echo __('Member Grade');?></label></dt>
                    <dd><select id="group" name="group">
                        <?php foreach ($groups as $group): ?>
                        <option value="<?php echo $group->id;?>"<?php echo $user->group_id == $group->id ? ' selected' : '';?>><?php echo $group->name;?></option>
                        <?php endforeach;?>
                    </select>
                    </dd>
                    <dt><label><?php echo __('Member Score');?><span class="require"> *</span></label></dt>
                    <dd><?php echo $user->score;?></dd>
                     <dt><label><?php echo __('Company Name');?></label></dt>
                    <dd><input type="text" name="company_name"  class="" maxlength="100" value="<?php echo $user->company_name;?>"/></dd>
                    <dt><label><?php echo __('Company Address');?></label></dt>
                    <dd><input type="text" name="company_address"  class="" maxlength="255" value="<?php echo $user->company_address;?>"/></dd>
                    <dt><label><?php echo __('Company Phone');?></label></dt>
                    <dd><input type="text" name="company_phone"  class="" maxlength="50" value="<?php echo $user->company_phone;?>"/></dd>
                    <dt><label><?php echo __('Contace Person');?></label></dt>
                    <dd><input type="text" name="contact_person"  class="" maxlength="100" value="<?php echo $user->contact_person;?>"/></dd>
                    <dt><label><?php echo __('Certificate Image');?></label></dt>
                    <dd>
                    <div id="image" <?php if (empty($user->certificate_image)) { ?> style="display:none"<?php } ?>>
                        <img src="<?php echo BES::upload_url($user->certificate_image); ?>"/>
                        <input type="hidden" name="certificate_image" value="<?php echo htmlspecialchars($user->certificate_image); ?>"/>
                    </div>
                    <button id="upload_image" type="button" class="button tiny"><?php echo __('Upload'); ?></button>
                    <small><?php echo __('Extension available:gif, png, jpg, jpeg');?></small></dd>
                    
                    
                    
                    <dt><label><?php echo __('Active or Inactive');?></label></dt>
                    <dd>
                        <label><input type="radio" value="active" name="status"<?php echo $user->status == 'active' ? ' checked="checked"' : '';?> /><?php echo __('Active');?></label>
                        <label><input type="radio" value="inactive" name="status"<?php echo $user->status == 'inactive' ? ' checked="checked"' : '';?> /><?php echo __('Inactive');?></label>
                    </dd>
                    <dt><label><?php echo __('Available or not');?></label></dt>
                    <dd>
                        <label><input type="radio" value="Y" name="active"<?php echo $user->active == 'Y' ? ' checked="checked"' : '';?> /><?php echo __('Yes');?></label>
                        <label><input type="radio" value="N" name="active"<?php echo $user->active == 'N' ? ' checked="checked"' : '';?> /><?php echo __('No');?></label>
                    </dd>
                </dl>
                <p>
                    <button type="submit" class="button big"><?php echo __('Save');?></button>
                    <?php echo html::cancel_anchor(BES::url('user/index')); ?>
                </p>
            </form>
        </article>
    </section>
    <section class="lastUnit">
        <article>
            <h1><?php echo __('Members Address List');?></h1>

            <div class="tableheader clearfix">
                <div class="actions tabeltoolbar">
                    <a href="javascript:void(0);" id="add_address"><img
                            src="<?php echo STATICS_BASE_URL . 'images/icons/splashyIcons/group_blue_add.png';?>"
                            alt="<?php echo __('Add New Address');?>"><span><?php echo __('Add New Address');?></span></a>
                </div>
            </div>
            <table class="gtable sortable" id="table1">
                <thead>
                <tr>
                    <th><?php echo __('Shipping Address');?></th>
                    <th><?php echo __('Default or not');?></th>
                    <th><?php echo __('Action');?></th>
                </tr>
                </thead>
                <tbody class="ui-sortable">
                <?php foreach ($addresses as $address): ?>
                <tr>
                    <td><?php echo $address->s_address;?></td>
                    <td><?php echo $address->is_default;?></td>
                    <td>
                        <a title="<?php echo __('Edit'); ?>"
                           href="<?php echo BES::url('user_address/edit') . '?id=' . $address->id;?>"
                           class="edit_address"><?php echo __('Edit');?></a> |
                        <a title="<?php echo __('Delete'); ?>"
                           href="<?php echo BES::url('user_address/delete') . '?id=' . $address->id;?>"
                           class="delete_address" onclick="return confirm('<?php echo __('Confirm Delete?');?>');"><?php echo __('Delete');?></a>
                    </td>
                </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </article>
    </section>
</section>
<div id="dialog" style="display:none;"></div>
<script>
    $(function($) {
        $("#dialog").dialog({
            autoOpen:false,
            height:450,
            width:900,
            modal:true,
            close:function() {
                $("#dialog").empty();
            }
        });
        $("#add_address").click(function() {
            $("#dialog").dialog('option', 'title', '<?php echo __('Add New Address');?>');
            $("#dialog").load("<?php echo BES::url('user_address/add');?>?user_id=<?php echo $user->id;?>&rtype=L");
            $("#dialog").dialog("open");
            return false;
        });
        $(".edit_address").click(function() {
            var _this = $(this);
            $("#dialog").dialog('option', 'title', '<?php echo __('Edit Address');?>');
            $("#dialog").load(_this.attr('href'));
            $("#dialog").dialog("open");
            return false;
        });
    });
</script>
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