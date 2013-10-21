<?php defined('SYSPATH') or die('No direct script access.'); ?>
<script type="text/javascript" src="<?php echo STATICS_BASE_URL;?>js/jqgrid/ui.multiselect.js"></script>
<script type="text/javascript" src="<?php echo STATICS_BASE_URL;?>js/jqgrid/i18n/grid.locale-cn.js"></script>
<script type="text/javascript" src="<?php echo STATICS_BASE_URL;?>js/jqgrid/jquery.jqGrid.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo STATICS_BASE_URL;?>js/jqgrid/css/ui.jqgrid.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo STATICS_BASE_URL;?>js/jqgrid/css/ui.multiselect.css"/>
<script type="text/javascript">
    jQuery('.remove').live('click', function() {
        var href = jQuery(this).attr('href');
        jQuery.kMsg.warning('<?php echo __('Sure to delete the member?'); ?>', function() {
            location.href = href;
        });
        return false;
    });
    jQuery(function($) {
        jQuery("#whitelist").jqGrid({
            sortable: true,
            url:'<?php echo url::current(true);?>',
            editurl: '<?php echo BES::url('user/batch_delete'); ?>',
            datatype: "json",
            colNames:['<?php echo __('Action');?>','<?php echo __('Email');?>','<?php echo __('Member Grade');?>','<?php echo __('Member Score');?>','<?php echo __('Registration Time');?>','<?php echo __('Last Login Time');?>','<?php echo __('Last Login Ip');?>','<?php echo __('Available or not');?>'],
            colModel:[
                {name:'operate',width:50,align:"center",sortable:false,search:false,
                    formatter:function(cellvalue, options, rowObject, action) {
                        var h = '';
                        h += '<a href="<?php echo BES::url('user/edit');?>?id=' + rowObject.id + '"><img title="<?php echo __('edit'); ?>" alt="<?php echo __('edit'); ?>" src="<?php echo STATICS_BASE_URL;?>images/icons/edit.png"></a>';
                        h += '&nbsp;&nbsp;';
                        h += '<a href="<?php echo BES::url('user/delete');?>?id=' + rowObject.id + '" class="remove"><img title="<?php echo __('delete'); ?>" alt="<?php echo __('delete'); ?>" src="<?php echo STATICS_BASE_URL;?>images/icons/cross.png"></a>';
                        return h;
                    }
                },
                {name:'email',index:'email',align:"center",width:250,sortable:false,searchoptions:{sopt: ['eq','ne','bw','bn','ew','en','cn','nc']}},
                {name:'group',index:'group_name',align:"center",
                    sortable:false,
                    autowidth:true,
                    formatter:function(cellValue, options, rowObject) {
                        return cellValue['name'];
                    },
                    stype:'select',
                    searchoptions:{
                        dataUrl:'<?php echo BES::url('user/group_search_data');?>',
                        buildSelect: function(httpRequest) {
                            try {
                                eval('var rethat = ' + httpRequest.responseText + ';');
                                if (rethat['status'] == 1) {
                                    var html = '<option value=""></option>';
                                    for (var i = 0; i < rethat['content'].length; i ++) {
                                        var row = rethat['content'][i];
                                        html += '<option value="' + row['key'] + '">' + row['name'] + '</option>';
                                    }
                                    return '<select>' + html + '</select>';
                                } else {
                                    jQuery.kMsg.error(rethat['msg']);
                                }
                            } catch (e) {
                                alert(e.getMessage())
                            }
                            ;
                        }

                    }},
                {name:'score',index:'score',align:"center",width:150,sortable:false,searchoptions:{sopt: ['lt','le','gt','ge']}},
                {name:'date_add',index:'date_add',align:"center",width:150,sortable:true,searchoptions:{dataInit:datePick,sopt: ['lt','le','gt','ge']}},
                {name:'lastlogin',index:'lastlogin',align:"center",width:150,sortable:true,searchoptions:{dataInit:datePick,sopt: ['lt','le','gt','ge']}},
                {name:'lastlogin_ip',index:'lastlogin_ip',align:"center",width:100,sortable:true,searchoptions:{sopt: ['lt','le','gt','ge']}},
                {name:'active',index:'active',align:"center",width:100,sortable:false,formatter:function(cellValue, options, rowObject) {
                    var user_status_object = <?php echo json_encode(BES::config('user.active_status')); ?>;
                    var key_i = rowObject.active;
                    return user_status_object[key_i];

                },stype:'select',
                    searchoptions:{
                        dataUrl:'<?php echo BES::url('user/get_search_data',array('type' => 'user_active'));?>',
                        buildSelect: function(httpRequest) {
                            try {
                                eval('var rethat = ' + httpRequest.responseText + ';');
                                if (rethat['status'] == 1) {
                                    var html = '<option value=""></option>';
                                    for (var i = 0; i < rethat['content'].length; i ++) {
                                        var row = rethat['content'][i];
                                        html += '<option value="' + row['key'] + '">' + row['name'] + '</option>';
                                    }
                                    return '<select>' + html + '</select>';
                                } else {
                                    jQuery.kMsg.error(rethat['msg']);
                                }
                            } catch (e) {
                                alert(e.getMessage())
                            }
                            ;
                        }

                    }
                }
            ],
            sortname: 'id',
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
        $.extend($.jgrid.search, {sopt: ['eq','ne','bw','bn','ew','en','cn','nc','lt','le','gt','ge']})
        jQuery("#whitelist").jqGrid('navGrid', '#pager', {refresh:true,add:false,edit:false,del:true,search:true}, {}, {}, {}, {multipleSearch:true});
        jQuery("#whitelist").jqGrid('filterToolbar');

        /* 会员导出功能 */
        $("#do_export").click(function() {
            var order_export_obj = $('#whitelist').jqGrid('getGridParam', 'selarrrow');
            if (order_export_obj == '') {
                alert("<?php echo __('Please select the records you want to export.'); ?>");
                return false;
            }
            var url = '<?php echo BES::url('user/do_export');?>';
            url += "?user_ids=" + order_export_obj;
            location.href = url;
            return false;
        });
    });
</script>
<section class="container_12 clearfix">
    <section id="main">
        <?php Remind::render_current();?>
        <article>
            <h2><?php echo __('Member List');?></h2>

            <div class="tabcontent">
                <div id="tabs-1">
                    <div class="tableheader clearfix">
                        <div class="actions">
                            <ul class="tabletoolbar">
                                <li>
                                    <?php echo HTML::add_anchor(BES::url('user/add'));?>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="export" id="do_export"><?php echo __('Export');?></a>
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
