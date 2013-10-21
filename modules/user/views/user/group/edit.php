<?php defined('SYSPATH') OR die('No direct script access.'); ?>
<script type="text/javascript" src="<?php echo STATICS_BASE_URL; ?>js/jquery.validate.js"></script>
<script type="text/javascript">
    $(function($) {
        $('#myForm').validate({
            rules:{
                name : {
                    remote: '<?php echo BES::url('user_group/check');?>?key=name&old_name=<?php echo urlencode($group->name); ?>'
                }
            },
            messages:{
                name : {
                    remote: '<?php echo __('The name already exists, please rewrite!'); ?>'
                }
            }
        });
        $('input[name="is_special"]').click(function(){
            if($(this).val() == 'Y')
            {
                $('#score').hide();
                $('#score_input').attr('disabled',true);
            } else {
                $('#score').show();
                $('#score_input').attr('disabled',false);
            }
        });
        /* 针对是否默认等级以及是否可用radio进行处理 */
        $(":radio[name='is_default']").bind(
        'change',_make_default_perfect
    );
        /* END OF 针对是否默认等级以及是否可用radio进行处理 */
        _make_default_perfect();
        function _make_default_perfect(){
            var is_default = $(":radio[name='is_default']:checked").val();
            if('Y' === is_default){
                $(":radio[name='active'][value='Y']").attr('checked','checked');
                /* 还需要修改相应的页面样式 */
                $(":radio[name='active'][value='Y']").parent().addClass('checked');
                $(":radio[name='active'][value='N']").parent().removeClass('checked');
                /* END OF 修改相应页面样式 */
                $(":radio[name='active']").attr('disabled',true);
                $(":radio[name='active']").parent().parent().addClass("disabled");
            }else if('N' === is_default){
                $(":radio[name='active']").attr("disabled",false);
                $(":radio[name='active']").parent().parent().removeClass("disabled");
                
            }
        }
    });
</script>
<div class="container_12 clearfix">
    <?php remind::render_current(); ?>
    <article>
        <h1><?php echo __('Edit Member Grade'); ?></h1>

        <form class="uniform" id="myForm" action="<?php echo url::current(true); ?>" method="post">
            <dl class="inline">
                <dt><label for="name"><?php echo __('Name'); ?><span class="require"> *</span></label></dt>
                <dd>
                    <input type="text" name="name" id="name" class="required" maxlength="50" value="<?php echo $group->name; ?>"/>
                </dd>
            </dl>
            <dl class="inline" id="score"<?php echo $group->is_special == 'Y' ? ' style="display:none;"' : ''; ?>>
                <dt><label for="score"><?php echo __('Required Score'); ?><span class="require"> *</span></label></dt>
                <dd><input type="text" name="score" id="score_input" class="required digits" maxlength="50" value="<?php echo $group->score; ?>" size="10" /> <?php echo __('score'); ?></dd>
            </dl>
            <dl class="inline" id="discount">
                <dt><label for="score"><?php echo __('Discount Rate'); ?><span class="require"> *</span></label></dt>
                <dd><input type="text" name="discount" id="score_input" class="required number" maxlength="50" value="<?php echo $group->discount; ?>" size="10" /></dd>
            </dl>
            <dl class="inline">
                <dt><label for="type"><?php echo __('Default or not'); ?></label></dt>
                <dd>
                    <label><input type="radio" value="Y" name="is_default"<?php echo $group->is_default == 'Y' ? ' checked="checked"' : ''; ?> /><?php echo __('Yes'); ?></label>
                    <label><input type="radio" value="N" name="is_default"<?php echo $group->is_default == 'N' ? ' checked="checked"' : ''; ?> /><?php echo __('No'); ?></label>
                </dd>
                <dt><label for="type"><?php echo __('Special or not'); ?></label></dt>
                <dd>
                    <label><input type="radio" value="Y" name="is_special"<?php echo $group->is_special == 'Y' ? ' checked="checked"' : ''; ?> /><?php echo __('Yes'); ?></label>
                    <label><input type="radio" value="N" name="is_special"<?php echo $group->is_special == 'N' ? ' checked="checked"' : ''; ?> /><?php echo __('No'); ?></label>
                </dd>
                <dt><label for="type"><?php echo __('Available or not'); ?></label></dt>
                <dd>
                    <label><input type="radio" test="abcdef" value="Y" name="active"<?php echo $group->active == 'Y' ? ' checked="checked"' : ''; ?> /><?php echo __('Yes'); ?></label>
                    <label><input type="radio" value="N" name="active"<?php echo $group->active == 'N' ? ' checked="checked"' : ''; ?> /><?php echo __('No'); ?></label>
                </dd>
            </dl>
            <dl class="inline">
                <dt></dt>
                <dd>
                    <button type="submit" class="button big"><?php echo __('Save'); ?></button>
                    <?php echo html::cancel_anchor(BES::url('user_group/index')); ?>
                </dd>
            </dl>
            <p></p>
        </form>
    </article>
</div>
