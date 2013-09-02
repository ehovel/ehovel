<?php defined('SYSPATH') or die('No direct script access.'); ?>
<?php echo EHOVEL::js('jqgrid/ui.multiselect'); ?>
<?php echo EHOVEL::js('jqgrid/i18n/grid.locale-cn'); ?>
<?php echo EHOVEL::js('jqgrid/jquery.jqGrid.min'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo STATICS_BASE_URL;?>js/jqgrid/css/ui.jqgrid.css" />
<link rel="stylesheet" type="text/css" href="<?php echo STATICS_BASE_URL;?>js/jqgrid/css/ui.multiselect.css" />
<script type="text/javascript">
    jQuery(function($) {
    jQuery('.remove').live('click', function(){
        var href = jQuery(this).attr('href');
        if(confirm('<?php echo __('Sure to delete?'); ?>')){
            location.href = href;
        }
        return false;
    });
        jQuery("#whitelist").jqGrid({
            url:'<?php echo url::current(true);?>',
            editurl: '<?php echo EHOVEL::url('site_emailsignup/batch_delete');?>',
            datatype: "json",
            colNames:['<?php echo __('ID'); ?>','<?php echo __('Action'); ?>','<?php echo __('Email'); ?>','<?php echo __('Ip'); ?>','<?php echo __('Date Add'); ?>'],
            colModel:[
            {name:'id',index:'id', width :40,align:"center",stype:false,search:false,sortable:false},
            {name:'operate',width:75,align:"center",sortable:false,stype:false,search:false,formatter:function(cellvalue, options, rowObject, action){
                var h = '';
                h += '<a href="<?php echo EHOVEL::url('site_emailsignup/delete');?>?id='+ rowObject.id+'" class="remove"><img alt="<?php echo __('delete'); ?>" title="<?php echo __('delete'); ?>" src="<?php echo STATICS_BASE_URL;?>images/icons/cross.png" /></a>';
                return h;
            }},
            {name:'email',index:'email',width:180,sortable:true,search:false,sortable:false},
            {name:'ip',index:'ip',width:180,sortable:true,search:false,sortable:false},
            {name:'date_add',index:'date_add',width:180,sortable:false,search:false},
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
        jQuery("#whitelist").jqGrid('navGrid','#pager',{refresh:true,add:false,edit:false,del:true,search:false},{},{},{afterSubmit:function(httpRequest){
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
        /* END */
    });

</script>
<section class="container_12 clearfix">
    <section id="main">
        <?php remind::render_current();?>
        <article>
            <h2><?php echo __('Email Sign Up List');?></h2>

            <div class="tabcontent">
                <div id="tabs-1">
                    <div class="tableheader clearfix">
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
