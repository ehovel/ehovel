<?php defined('SYSPATH') or die('No direct script access.'); ?>
<?php echo EHOVEL::js('jquery.validate'); ?>
<script type="text/javascript">
window.onload=function()
{
   change();
}
    jQuery(function($) {
        $('#myForm').validate({
            onkeyup: false,
            errorPlacement: function(error, element) {  
                error.appendTo(element.parent());
            },
            rules: {
                name: {
                    required: true,
                    maxlength: 255,
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
    });

    function change()
    {
        var t1 = document.getElementById('t1');
        var t2 = document.getElementById('t2');
        var t3 = document.getElementById('t3');
        var t4 = document.getElementById('t4');
		var space_witdh = document.getElementById('space_witdh');
		var space_height = document.getElementById('space_height');
		var padd_left = document.getElementById('padd_left');
		var padd_top = document.getElementById('padd_top');
        var space_type = document.getElementById('space_type');
        var isAlign = document.getElementById('isAlign');
        var isScroll = document.getElementById('isScroll');
        if((space_type.value=="code") || (space_type.value=="text"))
        {
                t1.style.display = "none";
                t2.style.display = "none";
                t3.style.display = "none";
                t4.style.display = "none";
				space_witdh.className = "";
				space_height.className = "";
				padd_left.className = "";
				padd_top.className = "";
				isAlign.className = "";
				isScroll.className = "";
        }
        else if((space_type.value=="banner") || (space_type.value=="imagechange") || (space_type.value=="imagelist"))
        {
                t1.style.display = "";
                t2.style.display = "none";
                t3.style.display = "none";
                t4.style.display = "none";
				space_witdh.className = "medium required";
				space_height.className = "medium required";
				padd_left.className = "";
				padd_top.className = "";
				isAlign.className = "";
				isScroll.className = "";
        }
        else if((space_type.value=="fixure") || (space_type.value=="float") || (space_type.value=="couplet"))
        {
        	if(space_type.value=="fixure")
            {
            	t3.style.display = "";
            	t4.style.display = "none";
            }
        	else if(space_type.value=="couplet")
            {
            	t3.style.display = "none";
            	t4.style.display = "";
            }
        	else if(space_type.value=="float")
        	{
        		t3.style.display = "none";
                t4.style.display = "none";
        	}
                t1.style.display = "";
                t2.style.display = "";
				space_witdh.className = "medium required";
				space_height.className = "medium required";
				padd_left.className = "medium required";
				padd_top.className = "medium required";
				isAlign.className = "";
				isScroll.className = "";
        }
    }
</script>

<section class="container_12 clearfix">
    <?php Remind::render_current();?>
    <article>
        <h1><?php echo __('Add Space');?></h1>
        <form class="uniform" id="myForm" action="<?php echo url::current(true);?>" method="post" enctype="multipart/form-data">
            <dl class="inline">
                <dt><label for="space_name"><?php echo __('Spacename');?><span class="require">*</span></label></dt>
                <dd><input type="text" name="space_name" id="space_name" class="medium required" maxlength="20" /></dd>

                <dt><label for="space_type"><?php echo __('Spacetype');?><span class="require">*</span></label></dt>
                <dd>
                    <select name="space_type" id="space_type" onChange="change()">
                        <?php foreach ($ads_info as $key=>$ad_info) { ?>
                        <option value="<?php echo $key;?>"><?php echo $ad_info['name'];?></option>
                        <?php }?>
                    </select>
                    <div id="t3" style="display:none;">
                    	<input type="checkbox" name="isAlign" value="1">&nbsp;<?php echo __('isCenter'); ?>&nbsp;&nbsp;&nbsp;&nbsp;
                	</div>
                	<div id="t4" style="display:none;">
                		<input type="checkbox" name="isScroll" value="1" >&nbsp;<?php echo __('isRollin'); ?>&nbsp;&nbsp;&nbsp;&nbsp;
                	</div>
                </dd>
                
                <div id="t1" style="display:none;">
                    <dt>
                        <label for='space_size'><?php echo __('Spacesize');?><span class='require'>*</span></label>
                    </dt>
                    <dd>
                        <div>
                        <?php echo __('Width');echo '： ';?><input type='text' style='width:50px' name='space_witdh' id='space_witdh' class='medium required' maxlength='10' min="0"/>&nbsp;px&nbsp;&nbsp;&nbsp;
                        </div>
                        <div>
                        <?php echo __('Height');echo '： ';?><input type='text' style='width:50px' name='space_height' id='space_height' class='medium required' maxlength='10' min="0"/>&nbsp;px
                        </div>
                    </dd>
                </div>
                
                <div id="t2" style="display:none;">
                    <dt>
                        <label for='space_position'><?php echo __('Spaceposition');?><span class='require'>*</span></label>
                    </dt>
                    <dd>
                        <?php echo __('Paddleft');echo '： ';?><input type='text' style='width:40px' name='padd_left' id='padd_left' class='medium required' maxlength='10' min="0"/>&nbsp;px&nbsp;&nbsp;&nbsp;
                        <?php echo __('Paddtop');echo '： ';?><input type='text' style='width:40px' name='padd_top' id='padd_top' class='medium required' maxlength='10' min="0"/>&nbsp;px
                    </dd>
                </div>
                
                <dt><label for="space_description"><?php echo __('Space Description');?></label></dt>
                <dd><textarea id="space_description" name="space_description" class="big" type="textarea" ></textarea></dd>
            </dl>
            <div class="buttons">
                <button type="submit" class="button big"><?php echo __('Save');?></button>
                <?php echo html::cancel_anchor(EHOVEL::url('site_space')); ?>
            </div>
        </form>
    </article>
</section>
