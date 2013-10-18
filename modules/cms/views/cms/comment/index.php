<?php defined('SYSPATH') or die('No direct script access.'); ?>
<?php echo EHOVEL::js('jqgrid/ui.multiselect#jqgrid/i18n/grid.locale-cn#jqgrid/jquery.jqGrid.min'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo STATICS_BASE_URL; ?>js/jqgrid/css/ui.jqgrid.css" />
<link rel="stylesheet" type="text/css" href="<?php echo STATICS_BASE_URL; ?>js/jqgrid/css/ui.multiselect.css" />

<script type="text/javascript">
	function iconChecked_comment(comment_id, active) {
	    if (active === true || active === 'CHECKED') {
	        return '<img rel="id='+comment_id+'&status=CHECKED"  src="<?php echo STATICS_BASE_URL; ?>images/icons/tick.png" alt="Active" class="active_img on_sale"/>';
	    } else {
	        return '<img rel="id='+comment_id+'&status=UNCHECKED"  src="<?php echo STATICS_BASE_URL; ?>images/icons/cross.png" alt="Invalid" class="active_img on_sale"/>';
	    }
	}
    jQuery(function() {
        jQuery("#whitelist").jqGrid({
            url: '<?php echo url::current(true); ?>',
            colNames:['<?php echo __('Operate'); ?>','<?php echo __('ID') ?>','<?php echo __('Title') ?>','<?php echo __('Add Date'); ?>','<?php echo __('isChecked'); ?>'],
            colModel:[
                {name:'operate',width:50,align:"center",sortable:false,stype:false,search:false,formatter:function(cellValue, options, rowObject, action){
                    return btnDelete('<?php echo EHOVEL::url('cms_model/model_comment_delete'); ?>?id=' + rowObject.id) + '&nbsp;&nbsp;<a target="_blank" href="<?php echo EHOVEL::url('cms_model/model_comment_view'); ?>?id=' + rowObject.id + '" title="<?php echo __('View')?>"><img src="<?php echo STATICS_BASE_URL; ?>images/icons/ico_list.png"/></a>';
                }},
                {name:'id',index:'id', width :30,align:"center",stype:false,search:false},
                {name:'title',index:'title', autowidth:true,sortable:false,search:false},
                {name:'date_add',index:'date_add', width:100,stype:false,search:false},
                {name:'status',index:'status',width:60,stype:false,search:false,formatter:function(cellValue, options, rowObject){
                    return iconChecked_comment(rowObject.id, cellValue);
                }}
            ],
            caption: '',
            sortable: true,
            datatype: 'json',
            rowNum: 20,
            rowList: [10,20,50,100],
            pager: '#pager',
            height: '100%',
            autowidth: true,
            viewrecords: true,
            multiselect: true,
            sortname: 'id',
            sortorder: 'desc',
            jsonReader: {
                root: 'rows',
                total: 'total',
                page: 'page',
                records: 'records',
                repeatitems: false,
                cell: 'cell',
                id: 'id'
            },
            editurl: '<?php echo EHOVEL::url('cms_model/model_comment_delete'); ?>'
        });

        jQuery("#whitelist").jqGrid('navGrid','#pager',{refresh:true,add:false,edit:false,del:true,search:false},{},{},{afterSubmit:jqGridAfterSubmit},{multipleSearch:true});
        jQuery("#whitelist").jqGrid('filterToolbar');

        /* 批量审核功能 */
        $("#do_checked").click(function() {
            var check_obj = $('#whitelist').jqGrid('getGridParam', 'selarrrow');
            if (check_obj == '') {
                alert("<?php echo __('Please select the records you want to check.'); ?>");
                return false;
            }
            var url = '<?php echo EHOVEL::url('cms_model/model_comment_process');?>';
            url += "?id=" + check_obj +"&status=CHECKED";
            location.href = url;
            return false;
        });
        /* 批量取消审核功能 */
        $("#do_unchecked").click(function() {
            var uncheck_obj = $('#whitelist').jqGrid('getGridParam', 'selarrrow');
            if (uncheck_obj == '') {
                alert("<?php echo __('Please select the records you want to uncheck.'); ?>");
                return false;
            }
            var url = '<?php echo EHOVEL::url('cms_model/model_comment_process');?>';
            url += "?id=" + uncheck_obj +"&status=UNCHECKED";
            location.href = url;
            return false;
        });
    });
</script>
<section class="container_12 clearfix">
    <section id="main">
        <?php remind::render_current(); ?>
        <article>
            <h2><?php echo __('Comment List');?></h2>

            <div class="tabcontent">
                <div id="tabs-1">
                 <div class="tableheader clearfix">
                        <div class="actions">
                            <ul class="tabletoolbar">
                            	<li>
                                   <a href="javascript:void(0)" class="invite" id="do_checked"><?php echo __('Check');?></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="delete" id="do_unchecked"><?php echo __('Uncheck');?></a>
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
        </article>
    </section>
</section>
