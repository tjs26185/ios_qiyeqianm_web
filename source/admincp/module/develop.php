<?php

if(!defined('IN_ROOT')){exit('Access denied');}
Administrator(7);
;echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=';echo IN_CHARSET;;echo '" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>安装应用</title>
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
                        setTimeout("location.href=\'';echo "?".str_replace("&step","&unzip",$_SERVER['QUERY_STRING']);;echo '\';", 3e3);
                }
        }
}
</script>
</head>
<body>
<div class="container">
<script type="text/javascript">parent.document.title = \'EarCMS Board 管理中心 - 安装应用\';if(parent.$(\'admincpnav\')) parent.$(\'admincpnav\').innerHTML=\'安装应用\';</script>
<div class="floattop"><div class="itemtitle"><h3>安装应用</h3></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th class="partition">技巧提示</th></tr>
<tr><td class="tipsblock"><ul>
<li>安装应用时请勿离开当前页面，务必等待浏览器自动跳转完成</li>
</ul></td></tr>
</table>
<h3>EarCMS 提示</h3>
';
switch(SafeRequest("step","get")){
case 's':
down_zip(auth_codes($_GET['zip'],'de',$_SERVER['HTTP_HOST']));
break;
case 'p':
down_zip(auth_codes($_GET['zip'],'de',$_SERVER['HTTP_HOST']));
break;
}
switch(SafeRequest("unzip","get")){
case 's':
un_zip('source/plugin');
break;
case 'p':
un_zip('source/plugin');
break;
}
switch(SafeRequest("install","get")){
case 's':
install_ation(1);
break;
case 'p':
install_ation(1);
break;
}
;echo '</div>
</body>
</html>
';
function down_zip($zip){
echo "<div class=\"infobox\"><br />";
echo "<table class=\"tb tb2\" style=\"border:1px solid #09C\">";
echo "<tr><td><div id=\"progressbar\" style=\"float:left;width:1px;text-align:center;color:#FFFFFF;background-color:#09C\"></div><div id=\"progressText\" style=\"float:left\">0%</div></td></tr>";
echo "</table>";
echo "<br /></div>";
ob_start();
@set_time_limit(0);
$file=fopen($zip,'rb');
if($file){
$headers=get_headers($zip,1);
if(array_key_exists('Content-Length',$headers)){
$filesize=$headers['Content-Length'];
}else{
$filesize=strlen(@file_get_contents($zip));
}
echo "<script type=\"text/javascript\">setsize(".$filesize.");</script>";
creatdir('data/tmp');
$newf=fopen('data/tmp/app.zip','wb');
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
function un_zip($dir){
include_once 'source/pack/zip/zip.php';
$unzip="data/tmp/app.zip";
if(is_file($unzip)){
$zip=new PclZip($unzip);
if(($list=$zip->listContent())==0){
exit("<div class=\"infobox\"><br /><h4 class=\"marginbot normal\" style=\"color:#C00\">".$zip->errorInfo(true)."</h4><br /><p class=\"margintop\"><input type=\"button\" class=\"btn\" value=\"重新安装\" onclick=\"history.back(1);\"></p><br /></div></div></body></html>");
}
$zip->extract(PCLZIP_OPT_PATH,$dir,PCLZIP_OPT_REPLACE_NEWER);
echo "<div class=\"infobox\"><h4 class=\"infotitle1\">应用 ".$_GET['dir']." 安装中，请稍候......</h4><img src=\"static/admincp/css/loader.gif\" class=\"marginbot\" /></div>";
echo "<script type=\"text/javascript\">setTimeout(\"location.href='?".str_replace("&unzip","&install",$_SERVER['QUERY_STRING'])."';\", 1e3);</script>";
}
}
function install_ation($type){
if($type){
$install='source/plugin/'.$_GET['dir'].'/install.xml';
if(!is_file($install)){
exit("<div class=\"infobox\"><br /><h4 class=\"infotitle3\">安装出错，找不到该应用的安装文件！</h4><br /></div></div></body></html>");
}
$xml=simplexml_load_file($install);
$lang=trim($xml->lang['type']);
$version=trim($xml->version);
if(!ergodic_array($version,IN_VERSION) ||$lang !== IN_CHARSET){
exit("<div class=\"infobox\"><br /><h4 class=\"infotitle3\">安装出错，该应用适用的版本或编码与您的网站不匹配！</h4><br /></div></div></body></html>");
}
$name=convert_charset(trim($xml->item['name']),1);
$dir=trim($xml->item['dir']);
$file=trim($xml->item['file']);
$type=intval(trim($xml->item['type']));
$author=convert_charset(trim($xml->item['author']),1);
$address=trim($xml->item['address']);
if($one=$GLOBALS['db']->getone("select in_id from ".tname('plugin')." where in_dir='$dir'")){
$GLOBALS['db']->query("update ".tname('plugin')." set in_name='$name',in_file='$file',in_type=$type,in_author='$author',in_address='$address',in_addtime='".date('Y-m-d H:i:s')."' where in_id=".$one);
}else{
$GLOBALS['db']->query("Insert ".tname('plugin')." (in_name,in_dir,in_file,in_type,in_author,in_address,in_addtime) values ('$name','$dir','$file',$type,'$author','$address','".date('Y-m-d H:i:s')."')");
}
if(@include_once('source/plugin/'.$dir.'/function.php')){
plugin_install();
}
echo "<script type=\"text/javascript\">parent.$('menu_app').innerHTML='".Menu_App()."';location.href='?iframe=module';</script>";
}
}
?>