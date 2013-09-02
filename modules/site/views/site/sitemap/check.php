<?php defined('SYSPATH') or die('No direct script access.'); ?>
<section class="container_12 clearfix">
    <?php remind::render_current();?>
    <article>
        <form class="uniform" id="myForm" action="<?php echo url::current(true);?>" method="post">
            <h1><?php echo __('Sitemap Manage');?></h1>
            <fieldset>
            <legend><?php echo __('Sitemap');?></legend>
            <dl class="inline">
                <dt><label for="priority"><?php echo __('Priority');?></label></dt>
                <dd>
                <ul>
                <li>
                <select name="index" >
					<?php foreach($priority as $val):?>
						<option value="<?php echo $val;?>" <?php echo (isset($site_map_log->index) && $site_map_log->index==$val)?'selected':'';?>><?php echo $val;?></option>
					<?php endforeach;?>
				</select>   <?php echo __('Homepage');?>
                </li><li>
                <select name="category" >
					<?php foreach($priority as $val):?>
						<option value="<?php echo $val;?>" <?php echo (isset($site_map_log->category) && $site_map_log->category==$val)?'selected':'';?>><?php echo $val;?></option>
					<?php endforeach;?>
				</select>   <?php echo __('Category Page');?> 
				</li>
				<li>
                <select name="product" >
					<?php foreach($priority as $val):?>
						<option value="<?php echo $val;?>" <?php echo (isset($site_map_log->product) && $site_map_log->product==$val)?'selected':'';?>><?php echo $val;?></option>
					<?php endforeach;?>
				</select>   <?php echo __('Product Page');?> 
				</li>
				<li>
                <select name="doc" >
					<?php foreach($priority as $val):?>
						<option value="<?php echo $val;?>" <?php echo (isset($site_map_log->doc) && $site_map_log->doc==$val)?'selected':'';?>><?php echo $val;?></option>
					<?php endforeach;?>
				</select>   <?php echo __('Document');?> 
				</li>
				</ul>
				<dt><label for="priority"><?php echo __('Inclusive Project');?></label></dt>
				<dd>
				<select name="on_sale" >
					<option value="N" <?php echo (isset($site_map_log->on_sale) && $site_map_log->on_sale == 'N')?'selected':'';?>><?php echo __('All Products');?></option>
					<option value="Y" <?php echo (isset($site_map_log->on_sale) && $site_map_log->on_sale == 'Y')?'selected':'';?>><?php echo __('Sale Products');?></option>
                </select>   
                <small><?php echo '('.__('Choosing products need to generate sitemap').')';?></small>
				</dd>
                <dl class="inline">
				<dt><label for="priority"><?php echo __('Exclusive Category');?></label></dt>
				<dd>
				    <select  multiple name="exclude_category[]">
                        <?php foreach($categories as $category) {?>
                            <option value="<?php echo $category->pk(); ?>"
                                <?php if (in_array($category->pk(), $exclude_category)) { ?>selected="selected"<?php } ?>>
                                <?php echo htmlspecialchars($category->name); ?>
                            </option>
                        <?php }?>
                    </select> 
				<small><?php echo '('.__('Press Ctrl + Left Click to select exclusive category page').')';?></small>
				</dd>
                <dt><label for="priority"><?php echo __('Exclusive Product');?></label></dt>
                <dd>
                <textarea id="robots" name="exclude_product" cols="180" rows="10" class="medium" type="textarea" ><?php isset($site_map_log->exclude_product) && print($site_map_log->exclude_product)?></textarea>
				   <small><?php echo '('.__('Exclusive products page: SKU List, Using comma to separate, with no comma at the end').')';?></small>
				</dd>
            </dl>
            </fieldset>
            <div class="buttons">
                <button type="submit" class="button big"><?php echo __('Save');?></button>
            </div>
        </form>
    </article>
</section>
