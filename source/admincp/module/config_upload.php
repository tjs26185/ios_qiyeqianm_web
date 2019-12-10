<?php

if(!defined('IN_ROOT')){exit('Access denied');}
Administrator(2);
$action=SafeRequest("action","get");
;echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=';echo IN_CHARSET;;echo '">
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>上传配置</title>
<link href="static/admincp/css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function $(obj) {return document.getElementById(obj);}
function change(type){
        if(type==1){
            $(\'remote\').style.display=\'\';
        }else if(type==2){
            $(\'remote\').style.display=\'none\';
        }
}
</script>
</head>
<body>
';
switch($action){
case 'save':
save();
break;
default:
main();
break;
}
;echo '</body>
</html>
';function main(){;echo '<script type="text/javascript">parent.document.title = \'EarCMS Board 管理中心 - 全局 - 上传配置\';if(parent.$(\'admincpnav\')) parent.$(\'admincpnav\').innerHTML=\'全局&nbsp;&raquo;&nbsp;上传配置\';</script>
<form method="post" action="?iframe=config_upload&action=save">
<input type="hidden" name="hash" value="';echo $_COOKIE['in_adminpassword'];;echo '" />
<div class="container">
<div class="floattop"><div class="itemtitle"><h3>上传配置</h3><ul class="tab1">
<li><a href="?iframe=config"><span>全局配置</span></a></li>
<li><a href="?iframe=config_pay"><span>支付配置</span></a></li>
<li><a href="?iframe=config_credit"><span>业务配置</span></a></li>
<li class="current"><a href="?iframe=config_upload"><span>上传配置</span></a></li>
<li><a href="?iframe=config_extend"><span>扩展配置</span></a></li>
</ul></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th colspan="15" class="partition">远程上传</th></tr>
<tr><td colspan="2" class="td27">云存储:</td></tr>
<tr><td class="vtop rowform">
<ul>
';if(IN_REMOTE==1){echo "<li class=\"checked\">";}else{echo "<li>";};echo '<input class="radio" type="radio" name="IN_REMOTE" value="1" onclick="change(1);"';if(IN_REMOTE==1){echo " checked";};echo '>&nbsp;开启</li>
';if(IN_REMOTE==0){echo "<li class=\"checked\">";}else{echo "<li>";};echo '<input class="radio" type="radio" name="IN_REMOTE" value="0" onclick="change(2);"';if(IN_REMOTE==0){echo " checked";};echo '>&nbsp;关闭</li>
</ul>
</td><td class="vtop tips2">后台不支持云存储上传，PHP5.5以下版本不支持远程上传的进度条</td></tr>
<tbody class="sub" id="remote"';if(IN_REMOTE<>1){echo " style=\"display:none;\"";};echo '>
<tr><td colspan="2" class="td27">上传标识:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="';echo IN_REMOTEPK;;echo '" name="IN_REMOTEPK"></td><td class="vtop tips2">云存储的扩展目录</td></tr>
<tr><td colspan="2" class="td27">外网域名:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="';echo IN_REMOTEDK;;echo '" name="IN_REMOTEDK"></td><td class="vtop tips2">以“<em class="lightnum">http://</em>”开头、“<em class="lightnum">/</em>”结尾</td></tr>
<tr><td colspan="2" class="td27">Bucket:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="';echo IN_REMOTEBK;;echo '" name="IN_REMOTEBK"></td><td class="vtop tips2">云存储的空间名称</td></tr>
<tr><td colspan="2" class="td27">AccessKey:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="';echo IN_REMOTEAK;;echo '" name="IN_REMOTEAK"></td><td class="vtop tips2">云存储的通信密钥</td></tr>
<tr><td colspan="2" class="td27">SecretKey:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="';echo IN_REMOTESK;;echo '" name="IN_REMOTESK"></td><td class="vtop tips2">云存储的通信密钥</td></tr>
</tbody>
<tr><td colspan="15"><div class="fixsel"><input type="submit" class="btn" value="提交" /></div></td></tr>
</table>
</div>
</form>
';}function save(){
if(!submitcheck('hash',1)){ShowMessage("表单来路不明，无法提交！",$_SERVER['PHP_SELF'],"infotitle3",3000,1);}
$str=file_get_contents('source/system/config.inc.php');
$str=preg_replace("/'IN_REMOTE', '(.*?)'/","'IN_REMOTE', '".SafeRequest("IN_REMOTE","post")."'",$str);
$str=preg_replace("/'IN_REMOTEPK', '(.*?)'/","'IN_REMOTEPK', '".SafeRequest("IN_REMOTEPK","post")."'",$str);
$str=preg_replace("/'IN_REMOTEDK', '(.*?)'/","'IN_REMOTEDK', '".SafeRequest("IN_REMOTEDK","post")."'",$str);
$str=preg_replace("/'IN_REMOTEBK', '(.*?)'/","'IN_REMOTEBK', '".SafeRequest("IN_REMOTEBK","post")."'",$str);
$str=preg_replace("/'IN_REMOTEAK', '(.*?)'/","'IN_REMOTEAK', '".SafeRequest("IN_REMOTEAK","post")."'",$str);
$str=preg_replace("/'IN_REMOTESK', '(.*?)'/","'IN_REMOTESK', '".SafeRequest("IN_REMOTESK","post")."'",$str);
if(!$fp = fopen('source/system/config.inc.php','w')){ShowMessage("保存失败，文件{source/system/config.inc.php}没有写入权限！",$_SERVER['HTTP_REFERER'],"infotitle3",3000,1);}
$ifile=new iFile('source/system/config.inc.php','w');
$ifile->WriteFile($str,3);
ShowMessage("恭喜您，设置保存成功！",$_SERVER['HTTP_REFERER'],"infotitle2",1000,1);
}
?>