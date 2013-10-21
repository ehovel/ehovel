<?php defined('SYSPATH') OR die('No direct script access allowed.'); ?>
<?php I18n::package('user'); ?>
<div id="dialog_user_group_selector<?php echo $uniqid?>" title="<?php echo __('Select User Group'); ?>" style="display:none;">
    <table id="user_group_relation<?php echo $uniqid?>" class="gtable">
        <thead>
        <tr>
            <th> </th>
            <th width="200px"><?php echo __('User Group Name'); ?></th>
        </tr>
        </thead>
        <tbody>
        
        <?php 
        $user_group_for_js = array();
        foreach($user_groups_all as $user_group):?>
        <tr>
            <td><input type="checkbox" name="sel_relation<?php echo $uniqid?>[]" value="<?php echo $user_group->id?>"/></td>
            <td><?php echo $user_group->name?></td>
        </tr>
        <?php 
        $user_group_for_js[$user_group->id] = $user_group->as_array();
        endforeach;?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    var user_groups_all = <?php echo json_encode($user_group_for_js)?>;
    jQuery(function() {
        var checkedHandler = eval('<?php echo $checked_handler; ?>');
        var changedHandler = eval('<?php echo $changed_handler; ?>');
        jQuery('input[name="sel_relation<?php echo $uniqid?>[]"]').live('click',function(){
            if($(this).attr('checked')){
                selected[$(this).val()] = $(this);
            }else{
                delete selected[$(this).val()];
            }
        });
        $('#dialog_user_group_selector<?php echo $uniqid?>').dialog({
            modal: true,
            autoOpen: false,
            width: 300,
            buttons: {
                '<?php echo __('Ok'); ?>': function() {
                    changedHandler(user_groups_all, selected);
                    $(this).dialog('close');
                },
                '<?php echo __('Cancel'); ?>': function() {
                    $(this).dialog('close');
                }
            },
            open: function() {
                frush_selected();
                jQuery('input[name="sel_relation<?php echo $uniqid?>[]"]').attr('checked', false);
                jQuery('input[name="sel_relation<?php echo $uniqid?>[]"]').parent().removeClass('checked');
                for(var i in selected){
                    jQuery('input[name="sel_relation<?php echo $uniqid?>[]"][value="'+i+'"]').attr('checked',true);
                    jQuery('input[name="sel_relation<?php echo $uniqid?>[]"][value="'+i+'"]').parent().addClass('checked');
                }
            }
        });
      $('#sel_relation<?php echo $uniqid?>').bind('click', function(){
          $('#dialog_user_group_selector<?php echo $uniqid?>').dialog('open');
      });
    });
    var frush_selected = function(){
       jQuery('input[name="sel_relation<?php echo $uniqid?>[]"]').each(function(){
            if(relationChecked<?php echo $uniqid?>($(this).val()) && typeof selected[$(this).val()] == 'undefined'){
                selected[$(this).val()] = $(this);
            }
       });
    }
</script>
<?php I18n::package(); ?>
