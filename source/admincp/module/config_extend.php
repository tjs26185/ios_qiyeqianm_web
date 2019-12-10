<?php
if (!defined('IN_ROOT')) {
    exit('Access denied');
}
Administrator(2);
$action = SafeRequest("action", "get");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>">
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>扩展配置</title>
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
<?php function main(){ ?><script type="text/javascript">parent.document.title = 'Jike-分发 管理中心 - 全局 - 扩展配置';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='全局&nbsp;&raquo;&nbsp;扩展配置';</script>
<form method="post" action="?iframe=config_extend&action=save">
<input type="hidden" name="hash" value="<?php echo $_COOKIE['in_adminpassword']; ?>" />
<div class="container">
<div class="floattop"><div class="itemtitle"><h3>扩展配置</h3><ul class="tab1">
<li><a href="?iframe=config"><span>全局配置</span></a></li>
<li><a href="?iframe=config_pay"><span>支付配置</span></a></li>
<li><a href="?iframe=config_credit"><span>业务配置</span></a></li>
<li><a href="?iframe=config_upload"><span>上传配置</span></a></li>
<li class="current"><a href="?iframe=config_extend"><span>扩展配置</span></a></li>
</ul></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th colspan="15" class="partition">文件防盗</th></tr>
<tr><td colspan="2" class="td27">防盗链:</td></tr>
<tr><td class="vtop rowform">
<select name="IN_DENIED">
<option value="0">关闭</option>
<option value="1"<?php if(IN_DENIED==1){echo " selected";} ?>>开启</option>
</select>
</td><td class="vtop tips2">开启后安装远程文件应用时，速率与本地服务器负载会受影响。如果站点已构建 CDN，请选择“关闭”</td></tr>
</table>
<table class="tb tb2">
<tr><th colspan="15" class="partition">短链地址</th></tr>
<tr><td colspan="2" class="td27">伪静态:</td></tr>
<tr><td class="vtop rowform">
<select name="IN_REWRITE">
<option value="0">禁用</option>
<option value="1"<?php if(IN_REWRITE==1){echo " selected";} ?>>启用</option>
</select>
</td><td class="vtop tips2">如果服务器不支持 Rewrite，请选择“禁用”</td></tr>
</table>
<table class="tb tb2">
<tr><th colspan="15" class="partition">立即信任</th></tr>
<tr><td colspan="2" class="td27">呈现方式:</td></tr>
<tr><td class="vtop rowform">
<select name="IN_MOBILEPROVISION">
<option value="0">默认方式</option>
<option value="1"<?php if(IN_MOBILEPROVISION==1){echo " selected";} ?>>引导方式</option>
</select>
</td><td class="vtop tips2">安装iOS应用时，立即信任的呈现方式</td></tr>
</table>
<table class="tb tb2">
<tr><th colspan="15" class="partition">实名认证</th></tr>
<tr><td colspan="2" class="td27">强制认证:</td></tr>
<tr><td class="vtop rowform">
<select name="IN_VERIFY">
<option value="0">关闭</option>
<option value="1"<?php if(IN_VERIFY==1){echo " selected";} ?>>开启</option>
</select>
</td><td class="vtop tips2">开启后需要通过实名认证才能上传应用</td></tr>
</table>
<table class="tb tb2">
<tr><th colspan="15" class="partition">一键切图</th></tr>
<tr><td colspan="2" class="td27">打包格式:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_EXT; ?>" name="IN_EXT"></td><td class="vtop tips2">备用格式：40*40|60*60|58*58|87*87|80*80|120*120|120*120|180*180</td></tr>
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
$str = preg_replace("/'IN_DENIED', '(.*?)'/", "'IN_DENIED', '" . SafeRequest("IN_DENIED", "post") . "'", $str);
$str = preg_replace("/'IN_REWRITE', '(.*?)'/", "'IN_REWRITE', '" . SafeRequest("IN_REWRITE", "post") . "'", $str);
$str = preg_replace("/'IN_MOBILEPROVISION', '(.*?)'/", "'IN_MOBILEPROVISION', '" . SafeRequest("IN_MOBILEPROVISION", "post") . "'", $str);
$str = preg_replace("/'IN_VERIFY', '(.*?)'/", "'IN_VERIFY', '" . SafeRequest("IN_VERIFY", "post") . "'", $str);
$str = preg_replace("/'IN_EXT', '(.*?)'/", "'IN_EXT', '" . SafeRequest("IN_EXT", "post") . "'", $str);
if (!($fp = fopen('source/system/config.inc.php', 'w'))) {
    ShowMessage("保存失败，文件{source/system/config.inc.php}没有写入权限！", $_SERVER['HTTP_REFERER'], "infotitle3", 3000, 1);
}
$ifile = new iFile('source/system/config.inc.php', 'w');
$ifile->WriteFile($str, 3);
ShowMessage("恭喜您，设置保存成功！", $_SERVER['HTTP_REFERER'], "infotitle2", 1000, 1);
}
?>