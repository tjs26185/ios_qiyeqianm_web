<?php
include '../../system/db.class.php';
if(empty($_COOKIE['in_adminid']) ||empty($_COOKIE['in_adminname']) ||empty($_COOKIE['in_adminpassword']) ||empty($_COOKIE['in_permission']) ||empty($_COOKIE['in_adminexpire']) ||!getfield('admin','in_adminid','in_adminid',intval($_COOKIE['in_adminid'])) ||md5(getfield('admin','in_adminpassword','in_adminid',intval($_COOKIE['in_adminid'])))!==$_COOKIE['in_adminpassword']){
exit(iframe_message("请先登录管理中心！"));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<title>上传证书</title>
<link href="<?php echo IN_PATH; ?>static/pack/upload/uploadify.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/upload/uploadify.js"></script>
<script type="text/javascript">
var in_php = '<?php echo IN_PATH; ?>source/pack/upload/cert-uplog.php';
var in_post = '{"_time":"<?php echo time(); ?>","_aid":"<?php echo $_COOKIE['in_adminid']; ?>","_apw":"<?php echo $_COOKIE['in_adminpassword']; ?>"}';
var in_size = 1;
function return_response(response){
        if (response == -1) {
                $(".uploadifySuccess").hide();
                $(".uploadifyError").show().text("文件不规范，请重新选择！");
        } else if (response == -2) {
                $("#fileQueue").html('<div class="uploadifyQueueItem">Access denied</div>');
        } else {
                var data = eval('(' + response + ')');
                parent.$("#in_iden").val(data.iden);
                parent.$("#in_nick").val(data.nick);
                parent.$("#in_name").val(data.name);
                parent.$("#in_dir").val(data.dir);
                parent.$("#in_endt").val(data.endt);
                parent.$("#btnadd").click();
        }
}
</script>
</head>
<body>
<div id="fileQueue">
	<div class="uploadifyQueueItem uploadifySuccess" style="display:none">
		<div class="cancel">
			<a href="javascript:cancle()"><img src="<?php echo IN_PATH; ?>static/pack/upload/cancel.png" border="0"></a>
		</div>
		<span class="fileName"></span><span class="percentage"></span>
		<div class="uploadifyProgress">
			<div class="uploadifyProgressBar"></div>
		</div>
	</div>
	<div class="uploadifyQueueItem uploadifyError" style="display:none"></div>
</div>
<input type="file" id="uploadify" onchange="uploadify()" style="display:none">
<img src="<?php echo IN_PATH; ?>static/pack/upload/up.png" style="cursor:pointer" onclick="$('#uploadify').click()">
</body>
</html>