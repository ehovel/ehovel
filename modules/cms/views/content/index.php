<?php defined('SYSPATH') or die('No direct script access.'); ?>
<script type="text/javascript" src="/statics/js/jqGrid/i18n/grid.locale-cn.js"></script>
<script type="text/javascript" src="/statics/js/jqGrid/jquery.jqGrid.min.js"></script>
<link rel="stylesheet" type="text/css" href="/statics/js/jqGrid/css/ui.jqgrid.css" />
<?php echo Ehovel::js('ehovel_template');?>

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
        function iconEdit(id) {
            return '<a href="<?php echo EHOVEL::url('cms_content/edit');?>/' + id + '" title="edit"><i style="color:#51A351;" class="icon-edit"></i></a>'
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
            colNames:['<?php echo __('Action') ?>','<?php echo __('Title') ?>','<?php echo __('Category') ?>','<?php echo __('User') ?>','<?php echo __('Language') ?>','<?php echo __('Modified Time'); ?>','<?php echo __('Status'); ?>','<?php echo __('ID'); ?>'],
            colModel:[ 
                       {name:'id',index:'id', width:50,align:"right",formatter:function(cellValue, options, rowObject){
                                    return iconEdit(rowObject.id, cellValue);
                                }
                        },
                       {name:'title',index:'title', width:500}, 
                       {name:'cat_name',index:'cat_name', width:300}, 
                       {name:'modified_by',index:'modified_by', width:100, align:"center"}, 
                       {name:'language',index:'language', width:60, align:"right"}, 
                       {name:'modified',index:'modified', width:150, align:"right"}, 
                       {name:'state',index:'state', align:"center",width:100,
                      		formatter:function(cellValue, options, rowObject){
      				                return iconState_content(rowObject.id, cellValue);
      				        	},
      				        stype:'select',
      				        searchoptions:{
      				                dataUrl: '<?php echo Ehovel::url('cms_content/searchoptions', array('key' => 'state')); ?>',
      				                buildSelect: jqGridBuildSelect
      				            }
      			        },
                        {name:'id',index:'id', width:100,align:"left"}
                        ],
            sortable: true,
            datatype: 'json',
            sortname: 'id',
            pager: '#pager',
            pgbuttons: true,
            height: '100%',
            width:1485,
            autowidth: true,
            viewrecords: true,
            multiselect: true,
            rowNum: 15,
            rowList: [15,25,50,100],
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
<section class="container-fluid clearfix">
    <div class="tabcontent">
        <div id="tabs-1">
		
			<fieldset id="productSearch">
				<legend><?php echo __('Product List');?></legend>
			</fieldset>
                <form action="<?php echo URL::current(true); ?>" method="post" id="adminForm">
                    <input type="hidden" name="task" value="" />
                    <input type="hidden" name="return" value="" />
                    <table id="whitelist"></table>
                    <div id="pager"></div>
                </form>
        </div>
    </div>
</section>
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
