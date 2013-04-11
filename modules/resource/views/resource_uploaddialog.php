<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <link rel="stylesheet" href="/statics/css/bootstrap.css" type="text/css"></link>
    <link rel="stylesheet" href="/statics/js/uploadify/uploadify.css" type="text/css"></link>
    <script type="text/javascript" src="/statics/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="/statics/js/bootstrap.js"></script>
    <script type="text/javascript" src="/statics/js/uploadify/jquery.uploadify.js"></script>
</head>
<body>
    <div class="container">
    	<ul class="nav nav-tabs" id="myTab">
			<li class="active"><a data-toggle="tab" href="#resource_local">本地上传</a></li>
			<li><a data-toggle="tab" href="#resource_data">资源库选择</a></li>
			<li><a data-toggle="tab" href="#resource_remote">网络资源</a></li>
		</ul>
		<fieldset class="adminform">
		<div class="tab-content" id="myTabContent">
			<div class="tab-pane fade in active" id="resource_local">
				<div class="form-horizontal">
		    		<div class="control-group">
		              	<label for="catalog_list" class="control-label">选择资源分类</label>
		              	<div class="controls">
			    			<select class="input_text medium" id="catalog_list" name="catalog_id">
				                <option value="43">资源库</option>
				                <option value="77">--品牌图片</option>
				                <option value="58">--客户上传资源</option>
				                <option value="60">----b</option>
				            </select>
			            </div>
			        </div>
			        <div class="control-group">
		              	<label for="inputEmail" class="control-label">选择上传文件</label>
		              	<div class="controls">
		              		<input type="file" name="uploadify" id="file_upload" class="btn" />
		              	</div>
		            </div>
		            <div class="control-group">
		            	<div class="controls" id="uploadfileQueue"></div>
		            </div>
		            <div class="control-group">
		              	<div class="controls">
		              		<button type="submit" class="btn btn-primary" onclick="doupload()">开始上传</button>
			   				<button type="button" class="btn" onclick="">取消</button>
		              	</div>
			    	</div>
		    	</div>
			</div>
			<div class="tab-pane fade" id="resource_data">
				资源库资源
			</div>
			<div class="tab-pane fade" id="resource_remote">
				网络资源
			</div>
		</div>
		</fieldset>
	<?php $timestamp = time();?>
    <script type="text/javascript">
	    function doupload() {
	    	$('#file_upload').uploadify('upload','*');
	    }
	    $(document).ready(function() {
	        $("#file_upload").uploadify({
	        	'formData'     : {
					'timestamp' : '<?php echo $timestamp;?>',
					'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
				},
	            //开启调试
	            'debug' : true,
	            //是否自动上传
	            'auto':true,
	            //超时时间
	            'successTimeout':99999,
	            //flash
	            'swf': "/statics/js/uploadify/uploadify.swf",
	            //不执行默认的onSelect事件
	            'overrideEvents' : ['onDialogClose'],
	            //文件选择后的容器ID
	            'queueID':'uploadfileQueue',
	            //服务器端脚本使用的文件对象的名称 $_FILES个['upload']
	            'fileObjName':'upload',
	            //上传处理程序
	            'uploader':'/admin/resource/uploaddialog',
	            'buttonClass':'btn',
	            'buttonText':'选择文件',
	            //浏览按钮的背景图片路径
	            //'buttonImage':'/statics/js/uploadify/upbutton.gif',
	            //浏览按钮的宽度
	            'width':'80',
	            //浏览按钮的高度
	            'height':'20',
	            //在浏览窗口底部的文件类型下拉菜单中显示的文本
	            'fileTypeDesc':'支持的格式:',
	            //允许上传的文件后缀
	            'fileTypeExts':'*.jpg;*.jpge;*.gif;*.png',
	            //上传文件的大小限制
	            'fileSizeLimit':'1MB',
	            //上传数量
	            'queueSizeLimit' : 5,
	            //每次更新上载的文件的进展
	            'itemTemplate':'<div id="${fileID}" class="uploadify-queue-item">\
					<div class="cancel">\
					<a href="javascript:$(\'#${instanceID}\').uploadify(\'cancel\', \'${fileID}\')">X</a>\
				</div><input type="text" value="${fullName}" id="name_${fileID}"/>\
				<span class="fileName">(${fileSize})</span><span class="data"></span>\
				<div class="uploadify-progress progress progress-info progress-striped">\
					<div class="uploadify-progress-bar bar"><!--Progress Bar--></div>\
				</div>\
			</div>',
	            'onUploadProgress' : function(file, bytesUploaded, bytesTotal, totalBytesUploaded, totalBytesTotal) {
	                 //有时候上传进度什么想自己个性化控制，可以利用这个方法
	                 //使用方法见官方说明
	            },
	            //选择上传文件后调用
	            'onSelect' : function(file) {
	                 
	            },
	            //返回一个错误，选择文件的时候触发
	            'onSelectError':function(file, errorCode, errorMsg){
	                switch(errorCode) {
	                    case -100:
	                        alert("上传的文件数量已经超出系统限制的"+$('#file_upload').uploadify('settings','queueSizeLimit')+"个文件！");
	                        break;
	                    case -110:
	                        alert("文件 ["+file.name+"] 大小超出系统限制的"+$('#file_upload').uploadify('settings','fileSizeLimit')+"大小！");
	                        break;
	                    case -120:
	                        alert("文件 ["+file.name+"] 大小异常！");
	                        break;
	                    case -130:
	                        alert("文件 ["+file.name+"] 类型不正确！");
	                        break;
	                }
	            },
	            'onUploadStart' : function(file) {
		            //传入所属分类id以及图片的重新命名
		            var fileId = 'name_'+file.id;
		            var catalogId = $("#catalog_list").val();
		            var customFileName = $("#"+fileId).val();
		            var params = {'catalogId':catalogId,'customFileName':customFileName}
		            $('#file_upload').uploadify('settings','formData',params);
	            },
	            //检测FLASH失败调用
	            'onFallback':function(){
	                alert("您未安装FLASH控件，无法上传图片！请安装FLASH控件后再试。");
	            },
	            //上传到服务器，服务器返回相应信息到data里
	            'onUploadSuccess':function(file, data, response){
	                alert(data);
	            }
	        });
	    });
    </script>
</body>
</html>