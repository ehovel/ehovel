<?php defined('SYSPATH') or die('No direct script access.'); ?>
<?php echo EHOVEL::js('jquery.validate');?>
<script type="text/javascript">
    jQuery(function($) {
        $('#myForm').validate({
            rules: {
                password_again: {
                    equalTo: "#password"
                },
                email:{
                    remote:'<?php echo EHOVEL::url('auth_admin/available', array('cb_key' => 'email', 'id'=>!empty($auth_admin)?$auth_admin->id : 0)); ?>'
                },
                username:{
                    remote:'<?php echo EHOVEL::url('auth_admin/available', array('cb_key' => 'username', 'id'=>!empty($auth_admin)?$auth_admin->id : 0)); ?>'
                }
            },
            messages: {
                email:{
                    remote:'<?php echo __('Email cannot be repeated');?>'
                },
                username:{
                    remote:'<?php echo __('Username cannot be repeated');?>'
                }
            }
        });
        $("#pid").change(function() {
            $("#roles").load("<?php echo EHOVEL::url('auth_admin/get_roles');?>?id="+$(this).val());
            $("#sites").load("<?php echo EHOVEL::url('auth_admin/get_sites');?>?id="+$(this).val());
            $("#columns").load("<?php echo EHOVEL::url('auth_admin/get_columns');?>?id="+$(this).val());
            return false;
        });
    });
</script>
<section class="line">
    <form class="uniform" id="myForm" action="<?php echo url::current(true);?>" method="post">
        <?php remind::render_current();?>
        <section id="main" class="unit size4of5">
            <article>
                <h1><?php echo !empty($auth_admin) ? __('Edit Account') : __('Add Account');?></h1>
                <dl>
                    <?php if(!empty($parent)):?>
                    <dt><label for="pid"><?php echo __('Parent administrator');?></label></dt>
                    <dd>
                        <select name="pid" id="pid" class="required">
                            <?php foreach ($childs as $data) { ?>
                                <?php if (empty($auth_admin) OR ($data->pk() != $auth_admin->pk() AND !$data->is_descendant($auth_admin))) { ?>
                                <option value="<?php echo $data->pk(); ?>"<?php if (!empty($auth_admin) AND $data->pk() == $auth_admin->pid) { ?> selected="selected" <?php } ?>>
                                    <?php echo str_repeat('&nbsp;',$data->lvl*4).htmlspecialchars($data->username); ?>
                                </option>
                            <?php } ?>
                            <?php } ?>
                        </select>
                    </dd>
                    <?php endif;?>
                    <dt><label for="name"><?php echo __('Username');?><span class="require">*</span></label></dt>
                    <dd><input type="text" name="username" id="name" class="medium required" maxlength="32" value="<?php echo !empty($auth_admin) ? $auth_admin->username : '';?>"/></dd>

                    <dt><label for="email"><?php echo __('Email');?><span class="require">*</span></label></dt>
                    <dd><input type="text" name="email" id="email" class="medium required email" maxlength="40" value="<?php echo !empty($auth_admin) ? $auth_admin->email : '';?>"/>
                    </dd>

                    <dt><label for="password"><?php echo __('Password');?>
                        <?php if(empty($auth_admin)):?><span class="require">*</span><?php endif;?>
                    </label></dt>
                    <dd>
                        <input type="password" name="password" id="password" class="medium <?php if(empty($auth_admin)):?>required<?php endif;?>" minlength="6" maxlength="30"/>
                        <small><?php echo __('That does not modify the password blank').__('.').__('Password length greater than 6 less than 30.');?></small>
                    </dd>

                    <dt><label for="password_again"><?php echo __('Confirm Password');?>
                        <?php if(empty($auth_admin)):?><span class="require">*</span><?php endif;?>
                    </label></dt>
                        <dd><input type="password" name="password_again" id="password_again" minlength="6" class="medium <?php if(empty($auth_admin)):?>required<?php endif;?>" maxlength="30"/></dd>
                </dl>
                <p>
                    <button type="submit" class="button big"><?php echo __('Save');?></button>
                    <button onclick="location.href='<?php echo EHOVEL::url('auth_admin/index')?>'" class="button white big" type="button"><?php echo __('Cancel');?></button>
                </p>
            </article>
        </section>
        <aside id="sidebar" class="unit lastUnit">
            <div class="box menu" id="roles">
                <h2><?php echo __('Role');?></h2>
                <section>
                    <ul>
                    <li><input type="radio" value="0" name="role" <?php if(empty($auth_admin->role_id))echo 'checked="true"';?>/><?php echo __('Select role later.');?></li>
                <?php if(!empty($roles)):?>
                <?php foreach ($roles as $key => $item) { ?>
                    <li><input type="radio" <?php echo (!empty($auth_admin) && $item->id==$auth_admin->role_id)?'checked="true"':'';?> value="<?php echo $item->id;?>" name="role"/> <?php echo $item->name;?></li>
                <?php }?>
                <?php endif;?>
                    </ul>
                </section>
            </div>
            <div class="box menu" id="sites">
                <h2><?php echo __('Site');?></h2>
                <section>
                    <ul>
                    <li><?php echo __('No select means all.');?></li>
                    <?php if(!empty($parent_sites)):?>
                    <?php foreach ($parent_sites as $site) { ?>
                    <li><input type="checkbox" <?php echo (!empty($site_ids) && in_array($site->id, $site_ids))?'checked="true"':'';?> value="<?php echo $site->id;?>" name="site_ids[]"/> <?php echo $site->name;?></li>
                    <?php }?>
                    <?php endif;?>
                    </ul>
                </section>
            </div>
            <div class="box menu" id="columns">
                <h2><?php echo __('Column');?></h2>
                <section>
                    <ul>
                    <li><input type="radio" value="0" name="column_id" <?php if(empty($auth_admin->column_id))echo 'checked="true"';?>/><?php echo __('No select column.');?></li>
                    <?php if(!empty($columns)):?>
                    <?php foreach ($columns as $column) { ?>
                    <li><input type="radio" <?php echo (!empty($auth_admin) && $column->id == $auth_admin->column_id)?'checked="true"':'';?> value="<?php echo $column->id;?>" name="column_id"/> <?php echo $column->name;?></li>
                    <?php }?>
                    <?php endif;?>
                    </ul>
                </section>
            </div>
        </aside>
    </form>
</section>
