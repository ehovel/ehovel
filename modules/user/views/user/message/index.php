<?php defined('SYSPATH') or die('No direct script access.'); ?>
<script type="text/javascript" src="<?php echo STATICS_BASE_URL;?>js/jqgrid/ui.multiselect.js"></script>
<script type="text/javascript" src="<?php echo STATICS_BASE_URL;?>js/jqgrid/i18n/grid.locale-cn.js"></script>
<script type="text/javascript" src="<?php echo STATICS_BASE_URL;?>js/jqgrid/jquery.jqGrid.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo STATICS_BASE_URL;?>js/jqgrid/css/ui.jqgrid.css" />
<link rel="stylesheet" type="text/css" href="<?php echo STATICS_BASE_URL;?>js/jqgrid/css/ui.multiselect.css" />
<script type="text/javascript">
    jQuery('.remove').live('click', function(){
        var href = jQuery(this).attr('href');
        jQuery.kMsg.warning('<?php echo __('Continue ?'); ?>', function() {
            location.href = href;
        });
        return false;
    });
    jQuery(function($) {
        jQuery("#whitelist").jqGrid({
            sortable: true,
            url:'<?php echo url::current(true);?>',
            editurl: '<?php echo BES::url('user_message/batch_delete');?>',
            datatype: "json",
            colNames:['<?php echo __('Operate');?>','<?php echo __('Content');?>','<?php echo __('Email');?>','<?php echo __('Add date');?>','<?php echo __('IP');?>','<?php echo __('Reply or not');?>'],
            colModel:[
                {name:'operate',width:100,align:"center",sortable:false,search:false,formatter:function(cellvalue, options, rowObject, action){
                    var h = '';
                    h += '<a href="<?php echo BES::url('user_message/edit');?>?id=' + rowObject.id + '"><img alt="Edit" src="<?php echo STATICS_BASE_URL;?>images/icons/edit.png"></a>';
                    h += '&nbsp;&nbsp;';
                    h += '<a href="<?php echo BES::url('user_message/delete');?>?id=' + rowObject.id + '" class="remove"><img alt="Delete" src="<?php echo STATICS_BASE_URL;?>images/icons/cross.png"></a>';
                    return h;
                }},
                {name:'content',index:'content',align:"center",width:200,sortable:false,searchoptions:{sopt: ['eq','ne','bw','bn','ew','en','cn','nc']}},
                {name:'email',index:'email',align:"center",width:150,sortable:false,formatter:function(cellvalue, options, rowObject, action){
                    if(cellvalue == null)
                    {
                        return '<?php echo __('unknow');?>';
                    } else {
                        return cellvalue;
                    }
                }},
                {name:'date_add',index:'date_add',align:"center",width:100,sortable:false,searchoptions:{dataInit:datePick,sopt: ['lt','le','gt','ge']}},
                {name:'ip',index:'ip',align:"center",width:100,sortable:false,searchoptions:{sopt: ['eq','ne','bw','bn','ew','en','cn','nc']}},
                //{name:'active',index:'active',align:"center",width:200,sortable:false,stype:false,searchoptions:{sopt: ['eq','ne']}},
                {name:'is_reply',index:'is_reply',align:"center",width:40,sortable:false,stype:false,searchoptions:{sopt: ['eq','ne']}}
            ],
            sortname: 'date_add',
            sortorder: 'desc',
            rowNum:20,
            rowList:[10,20,50,100],
            pager: '#pager',
            height: '100%',
            autowidth : true,
            viewrecords: true,
            multiselect: true,
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
        jQuery("#whitelist").jqGrid('navGrid', '#pager', {refresh:true,add:false,edit:false,del:true,search:true}, {}, {}, {}, {multipleSearch:true});
        jQuery("#whitelist").jqGrid('filterToolbar');
    });
    datePick = function(el){      
        jQuery(el).datepicker({dateFormat:"yy-mm-dd"});   
    }
</script>
<section class="container_12 clearfix">
    <section id="main">
       	<?php Remind::render_current();?>
        <article>
            <h2><?php echo __('User Message List');?></h2>

            <div class="tabcontent">
                <div id="tabs-1">
                    <form action="" method="post" name="myForm">
                        <table id="whitelist"></table>
                        <div id="pager"></div>
                    </form>
                </div>
            </div>
        </article>
    </section>
</section>
