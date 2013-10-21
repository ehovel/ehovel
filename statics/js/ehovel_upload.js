(function($){
    $.extend($.fn, {
        Upload: function(option){
            if (!option) 
                var option = {};
            var title = option.title;
            option.base_url = option.base_url ? option.base_url : 'http://admin.b2b.opococ.com/';
            //网络资源显示图片
            option.network_img = option.network_img ? option.network_img : '/images/file_icon/network_120x120.jpg';
            //var upload = $('<div><p class="upload"></p></div>');
            var upload = $('#upload');
            upload.dialog({
                title: '',
                modal: true,
                autoOpen: false,
                height: 600,
                width: 1000
            });
            $(this).live('click', function(){
                try {
                    if (typeof(option.before_upload) === "function") {
                        if (!option.before_upload()) {
                            return false;
                        }
                    }
                } 
                catch (ex) {
                }
                var _this = $(this);
                if($('p#uploaddialog').children().length > 0) {
                	
                } else {
                	upload.find('p#uploaddialog').load('/admin/resource/uploaddialog', {}, function(rethat){
	                    if (rethat.length < 1000){
	                        $('#upload').dialog('close');
	                        alert('资源库引入失败,请联系管理员处理!');
	                        return false;
	                    }
	                    if (rethat == 'false') {
	                        $('#upload').dialog('close');
	                        location.reload();
	                        return false;
	                    }
	                    $('#btnSubmit1').click(function(){alert('a');
	                        var resource_data = [];
	                        $('input[name^="resource_ids"]').each(function(){
	                            resource_data.push({
	                                name: 'resource[]',
	                                value: $(this).val()
	                            });
	                        });
	                        $.ajax({
	                            url: '/admin/resource/ajax_upload_list_submit',
	                            type: 'POST',
	                            data: $.param(resource_data),
	                            dataType: 'json',
	                            success: function(retdat, status){
	                                if (retdat['status'] == 1 && retdat['code'] == 200) {
	                                    server_data = retdat['content'];
	                                    option.upload_success(server_data, _this);
	                                    upload.dialog('close');
	                                } else {
	                                    upload.dialog('close');
	                                    alert('操作失败!' + retdat['msg']);
	                                }
	                            },
	                            error: function(){
	                                upload.dialog('close');
	                                alert('请求错误，请稍后重新尝试!');
	                            }
	                        });
	                    });
	                    $('#btnSubmit2').click(function(){
	                        var data = [];
	                        $('input[name="resource"]').each(function(i){
	                            if ($(this).attr('checked')) {
	                                data.push({
	                                    name: 'resource[]',
	                                    value: $(this).val()
	                                });
	                            }
	                        });
	                        $.ajax({
	                            url: '/admin/resource/ajax_upload_list_submit',
	                            type: 'POST',
	                            dataType: 'json',
	                            data: $.param(data),
	                            success: function(retdat, status){
	                                if (retdat['status'] == 1 && retdat['code'] == 200) {
	                                    server_data = retdat['content'];
	                                    option.upload_success(server_data, _this);
	                                    upload.dialog('close');
	                                } else {
	                                    upload.dialog('close');
	                                    alert('操作失败!' + retdat['msg']);
	                                }
	                            },
	                            error: function(){
	                                upload.dialog('close');
	                                alert('请求错误，请稍后重新尝试!');
	                            }
	                        });
	                    });
	                    $('#btnSubmit3').click(function(){
	                        var server_data = [];
	                        var btn3_i = 0;
	                        $('input[name^="resource_id_"]').each(function(idx, item){
	                            server_data[btn3_i] = new Array();
	                            var o = $(item);
	                            var id = o.val();
	                            server_data[btn3_i]['name'] = $('input[name^="resource_' + id + '_name"]').val();
	                            server_data[btn3_i]['link'] = $('input[name^="resource_' + id + '_link"]').val();
	                            server_data[btn3_i]['title'] = server_data[btn3_i]['name'];
	                            //server_data[btn3_i]['img'] = option.network_img;
	                            server_data[btn3_i]['img'] = server_data[btn3_i]['link'];
	                            server_data[btn3_i]['attach_id'] = $('input[name^="resource_' + id + '_link"]').val();
	                            server_data[btn3_i]['type'] = 'network';
	                            btn3_i++;
	                        });
	                        option.upload_success(server_data, _this);
	                        upload.dialog('close');
	                    });
	                    $('#btnCancel1').click(function(){
	                        upload.dialog('close');
	                    });
	                    $('#btnCancel2').click(function(){
	                        upload.dialog('close');
	                    });
	                    $('#btnCancel3').click(function(){
	                        upload.dialog('close');
	                    });
	                });
                }
                upload.dialog('option', 'title', title);
                upload.dialog('open');
            });
        }
    })
})(jQuery);
