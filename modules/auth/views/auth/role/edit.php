<?php defined('SYSPATH') or die('No direct script access.'); ?>
<?php echo EHOVEL::js('jquery.validate');?>
<script type="text/javascript">
    jQuery(function($) {
        $('#myForm').validate({onkeyup:false});
        $('#sidebar input[type="checkbox"]').click(function(){
            var par = $(this).parent().parent().parent();
            var checked = $(this).attr('checked');
            var options = par.find('input[type="checkbox"]');
            options.each(function() {
                var item = $(this);
                item.attr('checked', checked);
                if (checked) {
                    item.parent().addClass('checked');
                } else {
                    item.parent().removeClass('checked');
                }
            });
            //同等级查找

            //$('.level1').attr('checked', true);
            var siblings = $(this).parent().parent().parent().parent().find('.level'+$(this).attr('rev'));

            var parent_is_checked = true;
            siblings.each(function(){
                parent_is_checked = parent_is_checked && $(this).attr('checked');
            });
            var parent_node = $(this).parent().parent().parent().parent().parent().find('.level'+($(this).attr('rev')-1));
            parent_node.each(function(){$(this).attr('checked', parent_is_checked)});
            //alert(parent_node.length);
            //$('.level1').attr('checked', true);
        });
        $('#node_type').change(function() {
            var val = $(this).val();
            if (val == 'all') {
                $('.maunal_nodes').css('display', 'none');
            } else {
                $('.maunal_nodes').css('display', '');
            }
        });
    });
</script>
<section class="line">
    <form class="uniform" id="myForm" action="<?php echo url::current(true);?>" method="post">
        <?php remind::render_current();?>
        <aside id="sidebar" class="unit size1of5">
            <div class="box menu">
                <h2><?php echo __('Permission Resource');?></h2>
                <section>
                    <?php echo empty($role) ? Helper_Auth::get_auth_list($nodes) : Helper_Auth::get_auth_list($nodes, $role->nodes_json); ?>
                </section>
            </div>
        </aside>
        <section id="main" class="unit lastUnit">
            <article>
                <h1><?php echo !empty($role) ? __('Edit Role') : __('Add Role');?></h1>

                <dl>
                    <dt><label for="name"><?php echo __('Name');?><span class="require">*</span></label></dt>
                    <dd><input type="text" name="name" id="name" class="medium required" maxlength="32"
                               value="<?php !empty($role) && print($role->name);?>"/></dd>

                    <dt><label for="description"><?php echo __('Remark');?></label></dt>
                    <dd><textarea type="text" name="description" id="description" class="big"
                                  maxlength="256"><?php echo !empty($role->description) && print($role->description);?></textarea>
                    </dd>
                </dl>
                <p>
                    <button type="submit" class="button big"><?php echo __('Save');?></button>
                    <button onclick="location.href='<?php echo EHOVEL::url('auth_role/index')?>'" class="button white big" type="button"><?php echo __('Cancel');?></button>
                </p>

            </article>
        </section>

    </form>
</section>
