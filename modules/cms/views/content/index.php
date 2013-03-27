<?php defined('SYSPATH') or die('No direct script access.'); ?>
<script type="text/javascript" src="/statics/js/jqGrid/i18n/grid.locale-cn.js"></script>
<script type="text/javascript" src="/statics/js/jqGrid/jquery.jqGrid.min.js"></script>
<link rel="stylesheet" type="text/css" href="/statics/css/font-awesome.css" />
<link rel="stylesheet" type="text/css" href="/statics/js/jqGrid/css/ui.jqgrid.css" />

<script type="text/javascript">
        function iconState_content(product_id, active) {
            if (active === true || active == 1) {
                return '<a href="javascript:void(0);" rel="id='+product_id+'&on_sale=N" title="published"><i style="color:#51A351;" class="icon-ok"></i></a>';
            } else if(active==0) {
                return '<a href="javascript:void(0);" rel="id='+product_id+'&on_sale=Y" title="unpublished"><i style="color:#bd362f;" class="icon-remove"></i></a>';
            } else if(active==-1){
                return '<a href="javascript:void(0);" rel="id='+product_id+'&on_sale=Y" title="deleted"><i class="icon-trash"></i></a>';
            }
        }
    $('.on_sale').live('click', function(){
        var obj = $(this);
        var obj_p = $(this).parent();
        var url = '<?php //echo Route::url('cms_content')?>?' + obj.attr('rel');
        $.ajax({
            url: url,
            type: 'POST',
            data: {},
            dataType: 'json',
            error: function() {
                window.location.href = $("#url").val();
            },
            success: function(retdat, status) {
                if (retdat['code'] == 200 && retdat['status'] == 1) {
                    obj_p.empty().append(iconActive_product(retdat['content']['id'],retdat['content']['on_sale']));
                } else {
                }
            }
        });
    });
    jQuery(document).ready(function(){
        jQuery("#whitelist").jqGrid({
            url: '<?php echo Request::factory()->current()->url(); ?>',
            colNames:['<?php echo __('ID'); ?>','<?php echo __('Title') ?>','<?php echo __('Category') ?>','<?php echo __('User') ?>','<?php echo __('Language') ?>','<?php echo __('Modified Time'); ?>','<?php echo __('Status'); ?>'],
            colModel:[ {name:'id',index:'id', width:20,align:"right"},
                       {name:'title',index:'title'}, 
                       {name:'cat_name',index:'cat_name'}, 
                       {name:'modified_by',index:'modified_by', width:50}, 
                       {name:'language',index:'language', width:30, align:"right"}, 
                       {name:'modified',index:'modified', width:60, align:"right"}, 
                       {name:'state',index:'state', width:25,
                      		formatter:function(cellValue, options, rowObject){
      				                return iconState_content(rowObject.id, cellValue);
      				        	},
      				        stype:'select',
      				        searchoptions:{
      				                dataUrl: '<?php echo Ehovel::url('cms_content/searchoptions', array('key' => 'state')); ?>',
      				                buildSelect: jqGridBuildSelect
      				            }
      			        }
                        ],
            sortable: true,
            datatype: 'json',
            sortname: 'id',
            pager: '#pager',
            pgbuttons: true,
            height: '100%',
            autowidth: true,
            viewrecords: true,
            multiselect: true,
            rowNum: 20,
            rowList: [10,20,50,100],
            sortorder: 'asc',
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
        jQuery("#whitelist").jqGrid('navGrid',"#pager",{edit:false,add:false,del:false});
        jQuery("#whitelist").jqGrid('filterToolbar');
    });
</script>
                        
<section class="container_12 clearfix">
    <section id="main">
        <?php Message::render(); ?>
            <div class="tabcontent">
                <div id="tabs-1">
				
					<fieldset id="productSearch">
						<legend><?php echo __('Product List');?></legend>
					</fieldset>
                    <div class="tableheader clearfix">
                        <div class="actions">
                            <ul class="tabletoolbar">
                                <li><a id="add" class="add btn btn-success" href="<?php //echo Route::url('product/add'); ?>"><i class="icon-plus"></i><?php echo __('Add New');?></a></li>
                                <!--<li><a href="javascript:void(0)" class="export" id="do_export"><?php echo __('Export');?></a></li>-->
                            </ul>
                        </div>
                    </div>
                    <form>
                        <table id="whitelist"></table>
                        <div id="pager"></div>
                    </form>
                </div>
            </div>
    </section>
</section>
<div id="dialog_attributeset_selector" title="<?php echo __('Select Category And Type'); ?>" style="display:none;">
    <form class="uniform" action="<?php //echo Route::url('product/add'); ?>" method="get">
        <dl>
            <dt><label for="type"><?php echo __('Type');?></label></dt>
            <dd>
                <select name="type" id="product_type" class="required">
                    <option value="SIMPLE"></option>
                    <option value="CONFIGURABLE"></option>
                </select>
            </dd>
            <dt><label for="category_id"><?php echo __('Category');?></label></dt>
            <dd>
                <select name="category_id" id="category_id" class="required">
                <?php foreach($categories as $category): ?>
                <option value="<?php echo $category->id?>"><?php echo str_repeat('--',$category->level-1).$category->name;?></option>
                <?php endforeach;?>
                </select>
            </dd>
        </dl>
    </form>
</div>

<script type="text/javascript">
        var default_order = '0';
        $('input[name=position]').live('focus',function(){
            $('.new_float').hide();
            default_order = $(this).val();
            $(this).next().show();
            $(this).next().children('input[name=order]').focus().bind('keyup',function(){
                var keep = 7;
                if($(this).val().length>keep) {
                    $(this).val($(this).val().substring(0, keep));
                }
            });
        });
        $('input[name=cancel_order_form]').live('click',function(){
            $(this).parent().hide();
        });
        $('input[name=submit_order_form]').live('click',function(){
            var url = '<?php //echo Route::url('product/set_order');?>';
            var obj = $(this).parent();
            var id = $(this).next().val();
            var order = $(this).prev().val();
            $(this).parent().hide();
            if(order == default_order){
                return false;
            }
            obj.prev().attr('disabled','disabled');
            $.ajax({
                type:'GET',
                dataType:'json',
                url:url,
                data:'id='+id+'&order='+order,
                error:function(){},
                success:
                    function(retdat,status){
                    obj.prev().removeAttr('disabled');
                    if(retdat['status'] == 1 && retdat['code'] == 200)
                    {
                        obj.prev().attr('value',(retdat['content']['order']));
                    }else{
                        alert(retdat['msg']);
                    }
                }
            });
        });
</script>
