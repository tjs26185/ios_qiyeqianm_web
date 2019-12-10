<?php

if(!defined('IN_ROOT')){exit('Access denied');}
Administrator(5);
$setup=SafeRequest("setup","get");
;echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=';echo IN_CHARSET;;echo '">
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>程序升级</title>
<link href="static/admincp/css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function $(obj) {return document.getElementById(obj);}
var filesize=0;
function setsize(fsize){
        filesize=fsize;
}
function setdown(dlen){
        if(filesize>0){
                var percent=Math.round(dlen*100/filesize);
                document.getElementById("progressbar").style.width=(percent+"%");
                if(percent>0){
                        document.getElementById("progressbar").innerHTML=percent+"%";
                        document.getElementById("progressText").innerHTML="";
                }else{
                        document.getElementById("progressText").innerHTML=percent+"%";
                }
                if(percent>99){
                        document.getElementById("progressbar").innerHTML="请稍等...";
                        setTimeout("location.href=\'?iframe=update&setup=replacefile\';", 3e3);
                }
        }
}
</script>
</head>
<body>
<div class="container">
<script type="text/javascript">parent.document.title = \'Jike-分发 管理中心 - 程序升级\';if(parent.$(\'admincpnav\')) parent.$(\'admincpnav\').innerHTML=\'程序升级\';</script>
<div class="itemtitle"><h3>程序升级</h3><ul class="tab1" style="margin-right:10px"></ul><ul class="stepstat">
';if($setup=="downfile"){echo "<li class=\"current\">";}else{echo "<li>";};echo '1.下载文件</li>
';if($setup=="replacefile"){echo "<li class=\"current\">";}else{echo "<li>";};echo '2.更新文件</li>
';if($setup=="changedata"){echo "<li class=\"current\">";}else{echo "<li>";};echo '3.更新数据</li>
</ul><ul class="tab1"></ul></div>
<table class="tb tb2">
<tr><th class="partition">技巧提示</th></tr>
<tr><td class="tipsblock"><ul>
<li>升级前请先关闭站点并备份数据。如遇升级失败，请检查相关函数是否开启及文件目录是否具有写入权限；</li>
<li>更新包较大时可能会出现下载缓慢。如遇无法升级，请前往官网下载补丁并手动覆盖更新！</li>
</ul></td></tr>
</table>
<h3>EarCMS 提示</h3>
';
switch($setup){
case 'checkup':
global $update_api;
check_up($update_api.'?auth=version&charset='.IN_DBCHARSET.'&site='.$_SERVER['HTTP_HOST']);
break;
case 'downfile':
down_file();
break;
case 'replacefile':
replace_file();
break;
case 'changedata':
change_data();
break;
default:
start_up();
break;
}
;echo '</div>
</body>
</html>
';
function start_up(){
echo "<div class=\"infobox\"><br /><p class=\"margintop\"><input type=\"button\" class=\"btn\" value=\"检测更新\" onclick=\"location.href='?iframe=update&setup=checkup';\"></p><br /></div>";
}
function check_up($file){
$hander_array=get_headers($file);
if($hander_array[0] == 'HTTP/1.1 200 OK'){
creatdir('data/tmp');
fwrite(fopen('data/tmp/update.xml','w+'),@file_get_contents($file));
$xml=simplexml_load_file('data/tmp/update.xml');
$grade=trim($xml->item['grade']);
$version=trim($xml->item['version']);
$build=intval(trim($xml->item['build']));
$log=detect_encoding(rawurldecode(trim($xml->log)));
if($grade){
if($build >IN_BUILD){
echo "<div class=\"infobox\"><br /><h4 class=\"marginbot normal\" style=\"color:#C00\">发现可用更新 [".$version."] [".$build."]<br /><br /><br /><div style=\"color:#C00\"><strong>最近一次更新日志</strong><br /><br /><br />".$log."<br /><br /><big>注意：后台更新不包括云平台应用</big></div></h4><br /><p class=\"margintop\"><input type=\"button\" class=\"btn\" value=\"开始下载更新\" onclick=\"location.href='?iframe=update&setup=downfile';\"> &nbsp; <input type=\"button\" class=\"btn\" value=\"取消\" onclick=\"history.go(-1);\"></p><br /></div>";
}else{
echo "<div class=\"infobox\"><br /><h4 class=\"infotitle2\">已经是最新版本了</h4><br /></div>";
}
}else{
echo "<div class=\"infobox\"><br /><h4 class=\"infotitle3\">".detect_encoding(auth_codes('zt63qM2ouf3K2sio0enWpA==','de'))."</h4><br /></div>";
}
}else{
echo "<div class=\"infobox\"><br /><p class=\"margintop\"><img src=\"static/admincp/css/loading.gif\" /></p><br /></div>";
}
}
function down_file(){
echo "<div class=\"infobox\"><br />";
echo "<table class=\"tb tb2\" style=\"border:1px solid #09C\">";
echo "<tr><td><div id=\"progressbar\" style=\"float:left;width:1px;text-align:center;color:#FFFFFF;background-color:#09C\"></div><div id=\"progressText\" style=\"float:left\">0%</div></td></tr>";
echo "</table>";
echo "<br /></div>";
ob_start();
@set_time_limit(0);
$xml=simplexml_load_file('data/tmp/update.xml');
$patch=pack('H*',trim($xml->patch['zip']));
$file=fopen($patch,'rb');
if($file){
$headers=get_headers($patch,1);
if(array_key_exists('Content-Length',$headers)){
$filesize=$headers['Content-Length'];
}else{
$filesize=strlen(@file_get_contents($patch));
}
echo "<script type=\"text/javascript\">setsize(".$filesize.");</script>";
$newf=fopen('data/tmp/patch.zip','wb');
$downlen=0;
if($newf){
while(!feof($file)){
$data=fread($file,1024*8);
$downlen+=strlen($data);
fwrite($newf,$data,1024*8);
echo "<script type=\"text/javascript\">setdown(".$downlen.");</script>";
ob_flush();
flush();
}
}
if($file){fclose($file);}
if($newf){fclose($newf);}
}
}
function replace_file(){
include_once 'source/pack/zip/zip.php';
$unzip="data/tmp/patch.zip";
if(is_file($unzip)){
$zip=new PclZip($unzip);
if(($list=$zip->listContent())==0){
exit("<div class=\"infobox\"><br /><h4 class=\"marginbot normal\" style=\"color:#C00\">".$zip->errorInfo(true)."</h4><br /><p class=\"margintop\"><input type=\"button\" class=\"btn\" value=\"重新升级\" onclick=\"history.back(1);\"></p><br /></div></div></body></html>");
}
$zip->extract(PCLZIP_OPT_PATH,IN_ROOT,PCLZIP_OPT_REPLACE_NEWER);
echo "<div class=\"infobox\"><h4 class=\"infotitle1\">即将开始更新数据，请稍候......</h4><img src=\"static/admincp/css/loader.gif\" class=\"marginbot\" /></div>";
echo "<script type=\"text/javascript\">setTimeout(\"location.href='?iframe=update&setup=changedata';\", 1e3);</script>";
}
}
function change_data(){
@unlink("data/tmp/patch.zip");
$xml=simplexml_load_file('data/tmp/update.xml');
$version=trim($xml->item['version']);
$build=intval(trim($xml->item['build']));
$config=file_get_contents("source/system/config.inc.php");
$config=preg_replace("/'IN_VERSION', '(.*?)'/","'IN_VERSION', '".$version."'",$config);
$config=preg_replace("/'IN_BUILD', '(.*?)'/","'IN_BUILD', '".$build."'",$config);
$ifile=new iFile('source/system/config.inc.php','w');
$ifile->WriteFile($config,3);
echo "<div class=\"infobox\"><br /><h4 class=\"infotitle2\">恭喜！EarCMS 顺利升级完成！</h4><br /><p class=\"margintop\"><input type=\"button\" class=\"btn\" value=\"完成\" onclick=\"parent.location.href='?iframe=index';\"></p><br /></div>";
}
?>