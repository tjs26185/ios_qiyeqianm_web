<?php

if(!defined('IN_ROOT')){exit('Access denied');}
Administrator(2);
$action=SafeRequest("action","get");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>">
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>业务配置</title>
<link href="static/admincp/css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">function $(obj) {return document.getElementById(obj);}</script>
</head>
<body>
<?php
switch ($action) {
    case 'save':
        save();
        break;
    default:
        main();
        break;
}
?>
  </body>
</html>
<?php function main(){ ?>
<script type="text/javascript">parent.document.title = 'Jike-分发 管理中心 - 全局 - 业务配置';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='全局&nbsp;&raquo;&nbsp;业务配置';</script>
<form method="post" action="?iframe=config_credit&action=save">
<input type="hidden" name="hash" value="<?php echo $_COOKIE['in_adminpassword']; ?>" />
<div class="container">
<div class="floattop"><div class="itemtitle"><h3>业务配置</h3><ul class="tab1">
<li><a href="?iframe=config"><span>全局配置</span></a></li>
<li><a href="?iframe=config_pay"><span>支付配置</span></a></li>
<li class="current"><a href="?iframe=config_credit"><span>业务配置</span></a></li>
<li><a href="?iframe=config_upload"><span>上传配置</span></a></li>
<li><a href="?iframe=config_extend"><span>扩展配置</span></a></li>
</ul></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th colspan="15" class="partition">应用分发</th></tr>
<tr><td colspan="2" class="td27">充值汇率:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_RMBPOINTS; ?>" name="IN_RMBPOINTS" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">下载点数/每元</td></tr>
<tr><td colspan="2" class="td27">每日登录:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_LOGINPOINTS; ?>" name="IN_LOGINPOINTS" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">下载点数/赠送，只针对当天首次登录</td></tr>
</table>
<table class="tb tb2">
<tr><th colspan="15" class="partition">应用容量</th></tr>
<tr><td colspan="2" class="td27">扩充汇率:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_SPACEPOINTS; ?>" name="IN_SPACEPOINTS" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">下载点数/每MB</td></tr>
<tr><td colspan="2" class="td27">注册初始:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_REGSPACE; ?>" name="IN_REGSPACE" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">单位：MB</td></tr>
</table>
<table class="tb tb2">
<tr><th colspan="15" class="partition">应用限速</th></tr>
<tr><td colspan="2" class="td27">全速通道:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_HIGHSPEED; ?>" name="IN_HIGHSPEED" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">KB/S，实际最高下载速率以服务器带宽为准</td></tr>
<tr><td colspan="2" class="td27">限速通道:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_LOWSPEED; ?>" name="IN_LOWSPEED" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">KB/S，升级前默认使用的下载通道</td></tr>
<tr><td colspan="2" class="td27">通道升级:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_SPEEDPOINTS; ?>" name="IN_SPEEDPOINTS" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">下载点数/扣除，只针对单个本地文件应用且已开通防盗链。设置为0可关闭限速功能即使用全速通道</td></tr>
</table>
<table class="tb tb2">
<tr><th colspan="15" class="partition">应用广告</th></tr>
<tr><td colspan="2" class="td27">去除广告:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_ADPOINTS; ?>" name="IN_ADPOINTS" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">下载点数/扣除，只针对单个应用。设置为0可关闭广告功能</td></tr>
<tr><td colspan="2" class="td27">广告地址:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_ADLINK; ?>" name="IN_ADLINK"></td><td class="vtop tips2">以“<em class="lightnum">http://</em>”或“<em class="lightnum">https://</em>”开头</td></tr>
<tr><td colspan="2" class="td27">广告图片:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_ADIMG; ?>" name="IN_ADIMG"></td><td class="vtop tips2">尺寸：750x130，以“<em class="lightnum">http://</em>”或“<em class="lightnum">https://</em>”开头</td></tr>
</table>
<table class="tb tb2">
<tr><th colspan="15" class="partition">应用封装</th></tr>
<tr><td colspan="2" class="td27">单次扣除:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_WEBVIEWPOINTS; ?>" name="IN_WEBVIEWPOINTS" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">下载点数</td></tr>
</table>
<table class="tb tb2">
<tr><th colspan="15" class="partition">应用签名</th></tr>
<tr><td colspan="2" class="td27">每月价格:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_SIGN; ?>" name="IN_SIGN" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">单位：元，设置为0可关闭签名功能</td></tr>
<tr><td colspan="2" class="td27">每月补签:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_RESIGN; ?>" name="IN_RESIGN" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">次</td></tr>
<tr><td colspan="2" class="td27">监控频率:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_LISTEN; ?>" name="IN_LISTEN" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">单位：毫秒，网络状况不太良好的站点建议把值调高</td></tr>
<tr><td colspan="2" class="td27">接口地址:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_API; ?>" name="IN_API"></td><td class="vtop tips2">签名时要请求的接口地址，以“<em class="lightnum">http://</em>”或“<em class="lightnum">https://</em>”开头、“<em class="lightnum">/</em>”结尾</td></tr>
<tr><td colspan="2" class="td27">接口密匙:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_SECRET; ?>" name="IN_SECRET"></td><td class="vtop tips2">签名时要验证的接口密匙</td></tr>
<tr><td colspan="15"><div class="fixsel"><input type="submit" class="btn" value="提交" /></div></td></tr>
</table>
</div>
</form>
<?php
}function save(){
if (!submitcheck('hash', 1)) {
    ShowMessage("表单来路不明，无法提交！", $_SERVER['PHP_SELF'], "infotitle3", 3000, 1);
}
$str = file_get_contents('source/system/config.inc.php');
$str = preg_replace("/'IN_RMBPOINTS', '(.*?)'/", "'IN_RMBPOINTS', '" . SafeRequest("IN_RMBPOINTS", "post") . "'", $str);
$str = preg_replace("/'IN_LOGINPOINTS', '(.*?)'/", "'IN_LOGINPOINTS', '" . SafeRequest("IN_LOGINPOINTS", "post") . "'", $str);
$str = preg_replace("/'IN_SPACEPOINTS', '(.*?)'/", "'IN_SPACEPOINTS', '" . SafeRequest("IN_SPACEPOINTS", "post") . "'", $str);
$str = preg_replace("/'IN_REGSPACE', '(.*?)'/", "'IN_REGSPACE', '" . SafeRequest("IN_REGSPACE", "post") . "'", $str);
$str = preg_replace("/'IN_HIGHSPEED', '(.*?)'/", "'IN_HIGHSPEED', '" . SafeRequest("IN_HIGHSPEED", "post") . "'", $str);
$str = preg_replace("/'IN_LOWSPEED', '(.*?)'/", "'IN_LOWSPEED', '" . SafeRequest("IN_LOWSPEED", "post") . "'", $str);
$str = preg_replace("/'IN_SPEEDPOINTS', '(.*?)'/", "'IN_SPEEDPOINTS', '" . SafeRequest("IN_SPEEDPOINTS", "post") . "'", $str);
$str = preg_replace("/'IN_ADPOINTS', '(.*?)'/", "'IN_ADPOINTS', '" . SafeRequest("IN_ADPOINTS", "post") . "'", $str);
$str = preg_replace("/'IN_ADLINK', '(.*?)'/", "'IN_ADLINK', '" . SafeRequest("IN_ADLINK", "post") . "'", $str);
$str = preg_replace("/'IN_ADIMG', '(.*?)'/", "'IN_ADIMG', '" . SafeRequest("IN_ADIMG", "post") . "'", $str);
$str = preg_replace("/'IN_WEBVIEWPOINTS', '(.*?)'/", "'IN_WEBVIEWPOINTS', '" . SafeRequest("IN_WEBVIEWPOINTS", "post") . "'", $str);
$str = preg_replace("/'IN_SIGN', '(.*?)'/", "'IN_SIGN', '" . SafeRequest("IN_SIGN", "post") . "'", $str);
$str = preg_replace("/'IN_RESIGN', '(.*?)'/", "'IN_RESIGN', '" . SafeRequest("IN_RESIGN", "post") . "'", $str);
$str = preg_replace("/'IN_LISTEN', '(.*?)'/", "'IN_LISTEN', '" . SafeRequest("IN_LISTEN", "post") . "'", $str);
$str = preg_replace("/'IN_API', '(.*?)'/", "'IN_API', '" . SafeRequest("IN_API", "post") . "'", $str);
$str = preg_replace("/'IN_SECRET', '(.*?)'/", "'IN_SECRET', '" . SafeRequest("IN_SECRET", "post") . "'", $str);
if (!($fp = fopen('source/system/config.inc.php', 'w'))) {
    ShowMessage("保存失败，文件{source/system/config.inc.php}没有写入权限！", $_SERVER['HTTP_REFERER'], "infotitle3", 3000, 1);
}
$ifile = new iFile('source/system/config.inc.php', 'w');
$ifile->WriteFile($str, 3);
ShowMessage("恭喜您，设置保存成功！", $_SERVER['HTTP_REFERER'], "infotitle2", 1000, 1);
}
?>