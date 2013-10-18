<?php defined('SYSPATH') or die('No direct script access.'); ?>
<?php echo EHOVEL::css('demo_table_jui')?>
<?php echo EHOVEL::js('jquery.dataTables.min')?>
<script type="text/javascript">
    jQuery(function($) {
        $('#datatable').dataTable({
            'bJQueryUI': true,
            "bPaginate": false,
            "aaSorting": [],
            "aoColumnDefs": [
                { "bSortable": false, "aTargets": [ 0,1,2,3] }
            ],
            "oLanguage": {
                "sUrl": "<?php echo STATICS_BASE_URL;?>js/datatables/i18n/zh.txt"
            }
        });
        $('.delete').unbind().bind('click',function(){
            var url = $(this).attr('href');
            $.kMsg.warning('<?php echo __('Sure to delete this category?')?>', function(){
                window.location.href = url;
            });
            return false;
        });

        $("select[name=set_model_id]").change(function(){
        	//document.location.href=document.location.href+"?set_model_id="+$("select[name=set_model_id]").val();
        	
        	docHref = document.location.href;
            if (qmarkIndex = docHref.indexOf("?")) {
            	document.location.href=docHref.substring(0,qmarkIndex)+"?set_model_id="+$("select[name=set_model_id]").val();
            }
        });
    });
</script>
<section class="container_12 clearfix">
    <section id="main">
        <article>
            <h2><?php echo str_ireplace("{1}", __($model->name), __('Doc Category List'));?></h2>

            <div class="tabcontent">
                <div id="tabs-1">
                    <div class="tableheader clearfix">
                        <div class="tableheader clearfix">
                            <div class="actions">
                                <ul class="tabletoolbar">
                                    <li>
                                        <?php echo HTML::add_anchor(EHOVEL::url('cms_category/add'));?>
                                    </li>
                                    <li>
                                        <?php echo HTML::toolbar_anchor(EHOVEL::url('cms_model/model_content_list'), __($model->name).__('Pages Management'));?>
                                    </li>
                                    <li>
                                    	<span><?php echo __("Change CMS Model:"); ?></span>
							            <select name="set_model_id">
								            <?php foreach ($all_models as $model_tmp): ?>
								            <option <?php if ($model->id==$model_tmp->id) echo 'selected="true"'; ?> value="<?php echo $model_tmp->id; ?>"><?php echo __($model_tmp->name); ?></option>
								            <?php endforeach; ?>
										</select>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <table cellpadding="0" cellspacing="0" border="0" class="display" id="datatable">
                        <thead>
                        <tr>
                            <th width="50"><?php echo __('ID');?></th>
                            <th width="100"><?php echo __('Action');?></th>
                            <th><?php echo __('Name');?></th>
                            <th width="150"><?php echo __('Adding Time');?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($cms_categories)) { ?>
                            <?php foreach ($cms_categories as $key => $item) {
                            		if ($item->model_id == $model->id) { ?>
                            <tr class="odd gradeU">
                                <td><?php echo $item->id;?></td>
                                <td>
                                    <?php echo HTML::edit_anchor(EHOVEL::url('cms_category/edit') . '?id=' . $item->id);?>
                                    &nbsp;&nbsp;
                                    <?php echo HTML::delete_anchor(EHOVEL::url('cms_category/delete') . '?id=' . $item->id);?>
                                </td>
                                <td>
                                    <?php
                                        for ($i = 1; $i < $item->level; $i++)
                                        	echo '--';
                                    	echo $item->name;
                                    ?>
                                </td>
                                <td><?php echo $item->date_add;?></td>
                            </tr>
                                <?php }} ?>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </article>
    </section>
</section>
