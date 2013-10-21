<?php defined('SYSPATH') OR die('No direct script access.'); ?>
<script type="text/javascript">
$(function($) {
    $.validator.addMethod("s_phone_option",function(obj,element) {
        var return_data = false;
        $('.s_phone_option').each(function(){
            return_data = return_data || $(this).val().length > 0;
        });
        return return_data;
    },"<?php echo __('Phone and Mobilephone must input one of them.'); ?>");
    $('#edit_address').validate();
    $('#cancel_address_button').click(function() {
        $('#dialog').dialog('close');
    });
});
</script>
<div class="container_12 clearfix">
    <form class="uniform" id="edit_address" action="<?php echo url::current(true);?>" method="post">
        <fieldset>
            <legend><?php echo __('Shipping Address');?></legend>
            <dl class="inline grid_6">
                <dt><label for="s_company"><?php echo __('Company');?></label>
                </dt>
                <dd><input type="text" name="s_company" id="s_company" maxlength="128"
                           value="<?php echo $address->s_company;?>"/>
                </dd>
                <dt><label for="s_firstname"><?php echo __('First Name');?><span class="require"> *</span></label></dt>
                <dd><input type="text" name="s_firstname" id="s_firstname" class="required" maxlength="50"
                           value="<?php echo $address->s_firstname;?>"/></dd>
                <dt><label for="s_country"><?php echo __('Country');?><span class="require"> *</span></label></dt>
                <dd>
                    <select name="s_area_id" class="required">
                        <?php foreach($areas as $area):?>
                        <option value="<?php echo $area->id;?>" <?php echo $address->s_area_id == $area->id?'selected':''?>><?php echo $area->prefix_string().$area->name;?></option>
                        <?php endforeach;?>
                    </select>
                </dd>
                <dt><label for="s_city"><?php echo __('City');?><span class="require"> *</span></label></dt>
                <dd><input type="text" name="s_city" id="s_city" class="required" maxlength="50"
                           value="<?php echo $address->s_city;?>"/></dd>
                <dt><label for="s_address"><?php echo __('Address');?><span class="require"> *</span></label></dt>
                <dd><input type="text" name="s_address" id="s_address" class="required" maxlength="255"
                           value="<?php echo $address->s_address;?>"/></dd>
                <dt><label for="s_phone1"><?php echo __('Mobilephone');?></label></dt>
                <dd><input type="text" class="digits s_phone_option" name="s_phone1" id="s_phone1" minlength="7" maxlength="50" value="<?php echo $address->s_phone1;?>"/></dd>
            </dl>
            <dl class="inline grid_6">
                <dt><label for="s_lastname"><?php echo __('Last Name');?><span class="require"> *</span></label></dt>
                <dd><input type="text" name="s_lastname" id="s_lastname" class="required" maxlength="50"
                           value="<?php echo $address->s_lastname;?>"/></dd>
                <dt><label for="s_state"><?php echo __('State');?><span class="require"> *</span></label></dt>
                <dd><input type="text" name="s_state" id="s_state" class="required" maxlength="50"
                           value="<?php echo $address->s_state;?>"/></dd>
                <dt><label for="s_zip"><?php echo __('Post Code');?><span class="require"> *</span></label></dt>
                <dd><input type="text" name="s_zip" id="s_zip" class="required digits" minlength="5" maxlength="50"
                           value="<?php echo $address->s_zip;?>"/></dd>
                <dt><label for="s_phone"><?php echo __('Telephone');?><span class="require"> *</span></label></dt>
                <dd><input type="text" name="s_phone" id="s_phone" class="s_phone_option" minlength="7" maxlength="50" value="<?php echo $address->s_phone;?>"/></dd>
                <dt><label for="s_fax"><?php echo __('Fax');?></label>
                </dt>
                <dd><input type="text" name="s_fax" id="s_fax" maxlength="32"
                           value="<?php echo $address->s_fax;?>"/>
                </dd>
                <dt><label><?php echo __('Default or not');?></label></dt>
                <dd>
                    <label><input type="radio" value="Y" name="is_default"<?php echo $address->is_default == 'Y'
                            ? ' checked="checked"' : '';?> /><?php echo __('Yes');?></label>
                    <label><input type="radio" value="N" name="is_default"<?php echo $address->is_default == 'N'
                            ? ' checked="checked"' : '';?> /><?php echo __('No');?></label>
                </dd>
            </dl>
        </fieldset>
        <div class="buttons">
            <button type="submit" class="button big"><?php echo __('Save');?></button>
            <?php echo html::cancel_anchor('', '', array('id' => 'cancel_address_button')); ?>
        </div>
    </form>
</div>
