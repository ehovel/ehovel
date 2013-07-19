<?php defined('SYSPATH') or die('No direct script access.'); ?>
<?php echo EHOVEL::js('jquery.validate')?>
<script type="text/javascript">
    jQuery(function($) {
        $('#myForm').validate();
        $('#nodes_list').dialog({
            title: '<?php echo __('Select Node')?>',
            autoOpen: false,
            modal: true,
            width:400,
            height:500,
            buttons:{
                '<?php echo __('Sure')?>':function(){
                    $('#uri').val($('input[type="radio"]:checked').val());
                    $(this).dialog('close');
                },
                '<?php echo __('Cancel')?>':function(){$(this).dialog('close');}
            
            }
        });
        $('#select_node').click(function(){
            $('#nodes_list').dialog('open');
        });
    });
</script>

<section class="container_12 clearfix">
    <article>
        <h1><?php echo !empty($current_menu) ? __('Edit System Menu') : __('Add System Menu');?></h1>
        <form class="uniform form-horizontal" id="myForm" action="<?php echo Url::current(true);?>" method="post">
            <div class="control-group">
                <label class="control-label" for="name"><?php echo __('Name');?><span class="require">*</span></label>
                <div class="controls">
                    <input type="text" name="name" id="name" class="medium required" maxlength="64"
                           value="<?php echo !empty($current_menu) ? $current_menu->name : '';?>"/>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="title"><?php echo __('Title');?><span class="require">*</span></label>
                <div class="controls">
                    <input type="text" name="title" id="title" class="medium required" maxlength="64"
                           value="<?php echo !empty($current_menu) ? $current_menu->title : '';?>"/>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="pid"><?php echo __('Parent item');?></label>
                <div class="controls">
                    <?php $name_field = 'zh';?>
                    <select name="pid" id='pid' class="medium">
                        <option value="0"><?php echo __('Root Menu');?></option>
                        <?php echo empty($current_menu) ? Helper_Menu::generate_menu_option($menus, $name_field) : Helper_Menu::generate_menu_option($menus, $name_field,$current_menu);?>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="uri"><?php echo __('Uri');?></label>
                <div class="controls">
                    <input type="text" name="name" id="name" class="medium required" maxlength="64"
                           value="<?php echo !empty($current_menu) ? $current_menu->name : '';?>"/>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="uri"><?php echo __('Position');?><span class="require">*</span></label>
                <div class="controls">
                    <input type="text" name="position" id="position" class="tiny digits" maxlength="10" value="<?php echo !empty($current_menu) ? $current_menu->position : 0;?>"/>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="is_show"><?php echo __('Is Show');?></label>
                <div class="controls">
                    <select name="is_show" id="is_show">
                        <option value="Y" <?php if(!empty($current_menu) && $current_menu->is_show=='Y'){ ?>selected="selected"<?php }?>><?php echo __('Yes');?></option>
                        <option value="N" <?php if(!empty($current_menu) && ($current_menu->is_show=='N' || $current_menu->is_show=='')){ ?>selected="selected"<?php }?>><?php echo __('No');?></option>
                    </select>
                </div>
            </div>
            <p>
                <button type="submit" class="btn btn-info big"><?php echo __('Save');?></button>
                <?php echo HTML::cancel_anchor(EHOVEL::url('menu'));?>
            </p>
        </form>
<div style="display:none;" id="nodes_list">
    <label class="radio">
      <input type="radio" name="node" id="optionsRadios1" value="option1">
      <?php echo __('Empty uri');?>
    </label>
    <?php echo get_auth_list($nodes);?>
</div>
<?php 
function get_auth_list($nodes, $level=1)
{
    $return_str = '';
    if(is_array($nodes)){
        $return_str .= '<ul>';
        foreach($nodes as $node){
            $return_str .= '<li>'.str_pad('',$level, '-');
            if($node->get_type()==Model_Auth_Node::DATA_NODE){
               $return_str .= '<input rev="'.$level.'" class="level'.$level.'" name="node" type="radio" value="'.$node->get_mark().'">';
            }
            $return_str .= $node->get_name();
            $children = $node->get_child();
            if(count($children)>0 && is_array($children)){
                $return_str .= get_auth_list($children, $level+1);
            }
            $return_str .= '</li>';
        }
        $return_str .= '</ul>';
    }
    return $return_str;
}
?>
    </article>
</section>
