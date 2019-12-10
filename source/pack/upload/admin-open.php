<?php

include '../../system/db.class.php';
if(empty($_COOKIE['in_adminid']) ||empty($_COOKIE['in_adminname']) ||empty($_COOKIE['in_adminpassword']) ||empty($_COOKIE['in_permission']) ||empty($_COOKIE['in_adminexpire']) ||!getfield('admin','in_adminid','in_adminid',intval($_COOKIE['in_adminid'])) ||md5(getfield('admin','in_adminpassword','in_adminid',intval($_COOKIE['in_adminid'])))!==$_COOKIE['in_adminpassword']){
exit(iframe_message("请先登录管理中心！"));
}
;echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=';echo IN_CHARSET;;echo '" />
<title>上传应用</title>
<link href="';echo IN_PATH;;echo 'static/pack/upload/uploadify.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="';echo IN_PATH;;echo 'static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="';echo IN_PATH;;echo 'static/pack/upload/uploadify.js"></script>
<script type="text/javascript">
var in_php = \'';echo IN_PATH;;echo 'source/pack/upload/admin-uplog.php\';
var in_post = \'';echo $_COOKIE['in_adminid'].'_'.time();;echo '\';
var in_size = ';echo intval(ini_get('upload_max_filesize'));;echo ';
function return_response(response){
        if (response == -1) {
                $(".uploadifySuccess").hide();
                $(".uploadifyError").show().text("文件不规范，请重新选择！");
        } else {
                ReturnValue(eval(\'(\' + response + \')\'));
        }
}
function ReturnValue(response){
        $("#fileQueue").html(\'<div class="uploadifyQueueItem">正在解析应用，请稍等...</div>\');
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
                processAJAX();
        };
        xhr.open("GET", "';echo IN_PATH;;echo 'source/pack/upload/admin-" + response.extension + ".php?time=" + response.time + "&size=" + response.size, true);
        xhr.send(null);
        function processAJAX() {
                if (xhr.readyState == 4) {
                        if (xhr.status == 200) {
                                if (xhr.responseText == -1) {
                                        $("#fileQueue").html(\'<div class="uploadifyQueueItem">Access denied</div>\');
                                        return false;
                                }
                                var data = eval(\'(\' + xhr.responseText + \')\');
                                parent.$("#in_name").val(data.name);
                                parent.$("#in_mnvs").val(data.mnvs);
                                parent.$("#in_bid").val(data.bid);
                                parent.$("#in_bsvs").val(data.bsvs);
                                parent.$("#in_bvs").val(data.bvs);
                                parent.$("#in_form").val(data.form);
                                parent.$("#in_nick").val(data.nick);
                                parent.$("#in_type").val(data.type);
                                parent.$("#in_team").val(data.team);
                                parent.$("#in_icon").val(data.icon);
                                parent.$("#in_app").val(data.app);
                                parent.$("#in_size").val(data.size);
                                parent.$("#btnsave").click();
                        }
                }
        }
}
</script>
</head>
<body>
<div id="fileQueue">
	<div class="uploadifyQueueItem uploadifySuccess" style="display:none">
		<div class="cancel">
			<a href="javascript:cancle()"><img src="';echo IN_PATH;;echo 'static/pack/upload/cancel.png" border="0"></a>
		</div>
		<span class="fileName"></span><span class="percentage"></span>
		<div class="uploadifyProgress">
			<div class="uploadifyProgressBar"></div>
		</div>
	</div>
	<div class="uploadifyQueueItem uploadifyError" style="display:none"></div>
</div>
<input type="file" id="uploadify" onchange="uploadify()" style="display:none">
<img src="';echo IN_PATH;;echo 'static/pack/upload/up.png" style="cursor:pointer" onclick="$(\'#uploadify\').click()">
</body>
</html>';?>