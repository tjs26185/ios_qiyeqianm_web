<?php

include '../../system/db.class.php';
$ac = isset($_GET['ac']) ?$_GET['ac'] : NULL;
if($ac == 'webview'){
include '../../system/user.php';
include_once '../zip/zip.php';
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: text/html;charset=".IN_CHARSET);
$GLOBALS['userlogined'] or exit('return_0');
$GLOBALS['erduo_in_points'] <IN_WEBVIEWPOINTS and exit('return_1');
$GLOBALS['db']->query("update ".tname('user')." set in_points=in_points-".IN_WEBVIEWPOINTS." where in_userid=".$GLOBALS['erduo_in_userid']);
$ssl = is_ssl() ?'https://': 'http://';
$title = unescape(SafeRequest("title","get"));
$url = SafeRequest("url","get");
$bcolor = '#'.SafeRequest("bcolor","get");
$tcolor = '#'.SafeRequest("tcolor","get");
$aicon = str_replace($ssl.$_SERVER['HTTP_HOST'].IN_PATH.'data','../../../data',SafeRequest("aicon","get"));
$limage = str_replace($ssl.$_SERVER['HTTP_HOST'].IN_PATH.'data','../../../data',SafeRequest("limage","get"));
$dir = '../../../data/tmp';
$time = $GLOBALS['erduo_in_userid'].'-'.time();
creatdir($dir.'/'.$time);
$unzip = new PclZip('../../../static/pack/webview/ipa.zip');
$unzip->extract(PCLZIP_OPT_PATH,$dir.'/'.$time,PCLZIP_OPT_REPLACE_NEWER);
$ax = array('40','60','58','87','80','120','120','180');
$ay = array('AppIcon20x20@2x','AppIcon20x20@3x','AppIcon29x29@2x','AppIcon29x29@3x','AppIcon40x40@2x','AppIcon40x40@3x','AppIcon60x60@2x','AppIcon60x60@3x');
for($i = 0;$i <8;$i++){
image_crop($ax[$i],$ax[$i],$aicon,$dir.'/'.$time.'/Payload/ear.app/'.$ay[$i].'.png');
}
$lx = array('640*960','640*1136','750*1334','1242*2208','1125*2436');
$ly = array('LaunchImage-700@2x','LaunchImage-700-568h@2x','LaunchImage-800-667h@2x','LaunchImage-800-Portrait-736h@3x','LaunchImage-1100-Portrait-2436h@3x');
for($i = 0;$i <5;$i++){
$size = explode('*',$lx[$i]);
image_crop($size[0],$size[1],$limage,$dir.'/'.$time.'/Payload/ear.app/'.$ly[$i].'.png');
}
$str = file_get_contents($dir.'/'.$time.'/Payload/ear.app/Info.plist');
$str = str_replace(array('[title]','[bid]'),array(convert_charset($title),'cx.5q.'.substr(md5($time),8,8)),$str);
fwrite(fopen($dir.'/'.$time.'/Payload/ear.app/Info.plist','w'),$str);
$strs = file_get_contents($dir.'/'.$time.'/Payload/ear.app/config.json');
$strs = str_replace(array('[title]','[url]','[bcolor]','[tcolor]'),array(convert_charset($title),$url,$bcolor,$tcolor),$strs);
fwrite(fopen($dir.'/'.$time.'/Payload/ear.app/config.json','w'),$strs);
$inzip = new PclZip($dir.'/'.$time.'.zip');
$inzip->create($dir.'/'.$time,PCLZIP_OPT_REMOVE_PATH,$dir.'/'.$time);
rename($dir.'/'.$time.'.zip',$dir.'/'.$time.'.ipa');
echo $time;
}else{
if(!empty($_FILES)){
$filepart = pathinfo($_FILES['webview']['name']);
$fileext = strtolower($filepart['extension']);
if(in_array($fileext,array('jpg','jpeg','gif','png'))){
$time = date('YmdHis').rand(2,pow(2,24)).'.'.$fileext;
$dir = '../../../data/tmp';
creatdir($dir);
@move_uploaded_file($_FILES['webview']['tmp_name'],$dir.'/'.$time);
echo $time;
}else{
echo 'return_0';
}
}
}
?>