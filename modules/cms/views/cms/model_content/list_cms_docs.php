<?php defined('SYSPATH') or die('No direct script access.'); ?>
<?php echo EHOVEL::js('jqgrid/ui.multiselect'); ?>
<?php echo EHOVEL::js('jqgrid/i18n/grid.locale-cn'); ?>
<?php echo EHOVEL::js('jqgrid/jquery.jqGrid.min'); ?>
<?php echo EHOVEL::js('map'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo STATICS_BASE_URL;?>js/jqgrid/css/ui.jqgrid.css" />
<link rel="stylesheet" type="text/css" href="<?php echo STATICS_BASE_URL;?>js/jqgrid/css/ui.multiselect.css" />
<script type="text/javascript">
	var cat_map = new Map();
	cat_map.put("1","Root");
	<?php foreach ($categories as $cate_key=>$cate): ?>
	cat_map.put("<?php echo $cate_key; ?>","<?php echo $cate->name; ?>");
	<?php endforeach; ?>
	
    jQuery('.remove').live('click', function(){
        var href = jQuery(this).attr('href');
        if(confirm('<?php echo __('Want to delete the event?'); ?>')){
            location.href = href;
        }
        return false;
    });

    jQuery(function($) {
        jQuery("#whitelist").jqGrid({
            url:'<?php echo url::current(true);?>',
            editurl: '<?php echo EHOVEL::url('cms_model/model_content_batch_delete');?>',
            datatype: "json",
            colNames:[
                      	'<?php echo __('ID'); ?>'
                      	,'<?php echo __('Action'); ?>'
                      	,'<?php echo __('Title'); ?>'
                      	,'<?php echo __('Category'); ?>'
                      	,'<?php echo __('Adding Time'); ?>'
                      	,'<?php echo __('Position'); ?>'
            ],
            colModel:[
                {name:'id',index:'id',width:60,align:"center",stype:false,search:false}
                ,{name:'operate',width:75,align:"center",sortable:false,stype:false,search:false,formatter:function(cellvalue, options, rowObject, action){
                    var h = '';
                    h += '<a href="<?php echo EHOVEL::url('cms_model/model_content_edit')?>?id=' + rowObject.id + '"><img alt="<?php echo __('Edit'); ?>" title="<?php echo __('Edit'); ?>" src="/statics/images/icons/splashyIcons/view_list.png" /></a>'
                    	+'&nbsp;&nbsp;<a href="<?php echo EHOVEL::url('cms_model/model_content_delete')?>?id=' + rowObject.id+'" class="remove"><img alt="<?php echo __('Delete'); ?>" title="<?php echo __('Delete'); ?>" src="/statics/images/icons/cross.png" /></a>&nbsp;&nbsp;<a href="<?php echo EHOVEL::url('cms_model/model_comment_list')?>?id=' + rowObject.id+'" title="<?php echo __('Preview'); ?>" target="_blank"><img src="<?php echo STATICS_BASE_URL; ?>images/icons/ico_list.png"/></a>';
                    return h;
                }}
	            ,{name:'title',index:'title',width:120,autowidth:true,sortable:true,searchoptions:{sopt:['eq','ne','bw','bn','ew','en','cn','nc']}}
	            ,{name:'category',width:120,sortable:false,stype:false,search:false,formatter:function(cellvalue, options, rowObject, action){
	            	return cat_map.get(rowObject.category_id);
	            }}
	            ,{name:'date_add',index:'date_add',width:120,align:"center",searchoptions:{dataInit:datePick,sopt: ['lt','le','gt','ge']}}
	            ,{name:"position",index:"position",width:60,align:"center",sortable:true,stype:false,search:false}
	        ],
            rowNum:20,
            rowList:[10,20,50,100],
            pager: '#pager',
            height: '100%',
            autowidth : true,
            viewrecords: true,
            multiselect: true,
            sortable: true,
            sortname:'id',
            sortorder:'desc',
            jsonReader: {
                root: 'rows',
                total: 'total',
                page: 'page',
                records: 'records',
                repeatitems: false,
                cell: 'cell',
                id: 'id'
            }
        });
        
        $.extend($.jgrid.search,{sopt: ['eq','ne','bw','bn','ew','en','cn','nc','lt','le','gt','ge']})
        
        jQuery("#whitelist").jqGrid('navGrid','#pager',{refresh:true,add:false,edit:false,del:true,search:true},{},{},{afterSubmit:function(httpRequest){
            try {
                eval ('var rethat = ' +  httpRequest.responseText + ';');
                if (rethat['status'] == 1) {
                    if (rethat['msg'] != '') {
                        setRemind(REMIND_TYPE_SUCCESS, rethat['msg']);
                    }
                } else {
                    setRemind(REMIND_TYPE_ERROR, rethat['msg']);
                }
                return [true,''];
            } catch (e) {}
        }},{multipleSearch:true});
        
        jQuery("#whitelist").jqGrid('filterToolbar');

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
        <?php remind::render_current();?>
        <article>
            <h2><?php echo str_ireplace("{1}", __($model->name), __('Page List'));?></h2>

            <div class="tabcontent">
                <div id="tabs-1">
                    <div class="tableheader clearfix">
                        <div class="actions">
                            <ul class="tabletoolbar">
                            	<li>
                                    <?php echo HTML::add_anchor(EHOVEL::url('cms_model/model_content_add'));?>
                                </li>
                                <li>
                                    <?php echo HTML::toolbar_anchor(EHOVEL::url('cms_category'), __($model->name).__('Page Category Management'));?>
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

                    <form action="" method="post" name="myForm">
                        <table id="whitelist"></table>
                        <div id="pager"></div>
                    </form>
                </div>
            </div>
</div>

        </article>
    </section>
</section>
