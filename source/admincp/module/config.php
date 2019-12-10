<?php
if(!defined('IN_ROOT')){
  exit('Access denied');
}
Administrator(2);
$action=SafeRequest("action","get");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>">
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>全局配置</title>
<link href="static/admincp/css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function $(obj) {return document.getElementById(obj);}
function change(type){
        if(type==1){
            $('mailopen').style.display='';
        }else if(type==2){
            $('mailopen').style.display='none';
        }else if(type==3){
            $('codeopen').style.display='';
        }else if(type==4){
            $('codeopen').style.display='none';
        }else if(type==5){
            $('in_open').style.display='none';
        }else if(type==6){
            $('in_open').style.display='';
        }
}
</script>
</head>
<body>
<?php
switch($action){
case 'save':
save();
break;
default:
main();
break;
}
 ?></body>
</html>
<?php
function main(){ ?><script type="text/javascript">parent.document.title = 'Jike-分发 管理中心 - 全局 - 全局配置';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='全局&nbsp;&raquo;&nbsp;全局配置';</script>
<form method="post" action="?iframe=config&action=save">
<input type="hidden" name="hash" value="<?php echo $_COOKIE['in_adminpassword']; ?>" />
<div class="container">
<div class="floattop"><div class="itemtitle"><h3>全局配置</h3><ul class="tab1">
<li class="current"><a href="?iframe=config"><span>全局配置</span></a></li>
<li><a href="?iframe=config_pay"><span>支付配置</span></a></li>
<li><a href="?iframe=config_credit"><span>业务配置</span></a></li>
<li><a href="?iframe=config_upload"><span>上传配置</span></a></li>
<li><a href="?iframe=config_extend"><span>扩展配置</span></a></li>
</ul></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th colspan="15" class="partition">基本设置</th></tr>
<tr><td colspan="2" class="td27">站点名称:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_NAME; ?>" name="IN_NAME"></td><td class="vtop tips2">显示在浏览器窗口标题等位置</td></tr>
<tr><td colspan="2" class="td27">关键字词:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_KEYWORDS; ?>" name="IN_KEYWORDS"></td><td class="vtop tips2">合理的词汇有利于搜索引擎优化</td></tr>
<tr><td colspan="2" class="td27">站点描述:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_DESCRIPTION; ?>" name="IN_DESCRIPTION"></td><td class="vtop tips2">合理的描述有利于搜索引擎优化</td></tr>
<tr><td colspan="2" class="td27">备案信息:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_ICP; ?>" name="IN_ICP"></td><td class="vtop tips2">显示在页面底部等位置</td></tr>
<tr><td colspan="2" class="td27">客服 E-mail:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_MAIL; ?>" name="IN_MAIL"></td><td class="vtop tips2">发邮件时的发件人地址</td></tr>
<tr><td colspan="2" class="td27">邮件服务开关:</td></tr>
<tr><td class="vtop rowform">
<ul>
<?php if(IN_MAILOPEN==1){ ?> <li class="checked"> <?php }else{ ?> <li> <?php } ?><input class="radio" type="radio" name="IN_MAILOPEN" value="1" onclick="change(1);"<?php if(IN_MAILOPEN==1){echo " checked";} ?>>&nbsp;开启</li>
<?php if(IN_MAILOPEN==0){ ?> <li class="checked"> <?php }else{ ?> <li> <?php } ?><input class="radio" type="radio" name="IN_MAILOPEN" value="0" onclick="change(2);"<?php if(IN_MAILOPEN==0){echo " checked";} ?>>&nbsp;关闭</li>
</ul>
</td><td class="vtop lightnum">主要用于前台找回密码等功能，建议开启</td></tr>
<tbody class="sub" id="mailopen"<?php if(IN_MAILOPEN<>1){echo ' style="display:none;"';} ?>>
<tr><td colspan="2" class="td27">SMTP 服务器:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_MAILSMTP; ?>" name="IN_MAILSMTP"></td><td class="vtop tips2">发邮件时所指定的服务器</td></tr>
<tr><td colspan="2" class="td27">E-mail 密码:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_MAILPW; ?>" name="IN_MAILPW"></td><td class="vtop tips2">发邮件时需要验证的密码</td></tr>
</tbody>
<tr><td colspan="2" class="td27">后台提问开关:</td></tr>
<tr><td class="vtop rowform">
<ul>
<?php if(IN_CODEOPEN==1){ ?> <li class="checked"> <?php }else{ ?> <li> <?php } ?><input class="radio" type="radio" name="IN_CODEOPEN" value="1" onclick="change(3);"<?php if(IN_CODEOPEN==1){echo " checked";} ?>>&nbsp;开启</li>
<?php if(IN_CODEOPEN==0){ ?> <li class="checked"> <?php }else{ ?> <li> <?php } ?><input class="radio" type="radio" name="IN_CODEOPEN" value="0" onclick="change(4);"<?php if(IN_CODEOPEN==0){echo " checked";} ?>>&nbsp;关闭</li>
</ul>
</td><td class="vtop tips2">为了站点安全起见，建议开启</td></tr>
<tbody class="sub" id="codeopen"<?php if(IN_CODEOPEN<>1){echo ' style="display:none;"';} ?>>
<tr><td colspan="2" class="td27">认证码:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_CODE; ?>" name="IN_CODE"></td><td class="vtop tips2">管理员登录后台时的安全提问答案</td></tr>
</tbody>
<tr><td colspan="2" class="td27">统计代码:</td></tr>
<tr><td class="vtop rowform"><textarea rows="6" name="IN_STAT" cols="50" class="tarea"><?php echo base64_decode(IN_STAT); ?></textarea></td><td class="vtop tips2">页面底部显示的第三方统计</td></tr>
</table>
<table class="tb tb2">
<tr><th colspan="15" class="partition">关闭站点</th></tr>
<tr><td colspan="2" class="td27">站点维护开关:</td></tr>
<tr><td class="vtop rowform">
<ul>
<?php if(IN_OPEN==1){ ?> <li class="checked"> <?php }else{ ?> <li> <?php } ?><input class="radio" type="radio" name="IN_OPEN" value="1" onclick="change(5);"<?php if(IN_OPEN==1){echo " checked";} ?>>&nbsp;开放</li>
<?php if(IN_OPEN==0){ ?> <li class="checked"> <?php }else{ ?> <li> <?php } ?><input class="radio" type="radio" name="IN_OPEN" value="0" onclick="change(6);"<?php if(IN_OPEN==0){echo " checked";} ?>>&nbsp;维护</li>
</ul>
</td><td class="vtop tips2">暂时将前台关闭访问</td></tr>
<tbody class="sub" id="in_open"<?php if(IN_OPEN<>0){echo 'style="display:none;"';} ?>>
<tr><td colspan="2" class="td27">维护说明:</td></tr>
<tr><td class="vtop rowform"><textarea rows="6" name="IN_OPENS" cols="50" class="tarea"><?php echo IN_OPENS; ?></textarea></td><td class="vtop tips2">前台显示的维护信息</td></tr>
</tbody>
<tr><td colspan="15"><div class="fixsel"><input type="submit" class="btn" value="提交" /></div></td></tr>
</table>
</div>
</form>
<?php }function save(){
if(!submitcheck('hash',1)){ShowMessage("表单来路不明，无法提交！",$_SERVER['PHP_SELF'],"infotitle3",3000,1);}
$str=file_get_contents('source/system/config.inc.php');
$str=preg_replace("/'IN_NAME', '(.*?)'/","'IN_NAME', '".SafeRequest("IN_NAME","post")."'",$str);
$str=preg_replace("/'IN_KEYWORDS', '(.*?)'/","'IN_KEYWORDS', '".SafeRequest("IN_KEYWORDS","post")."'",$str);
$str=preg_replace("/'IN_DESCRIPTION', '(.*?)'/","'IN_DESCRIPTION', '".SafeRequest("IN_DESCRIPTION","post")."'",$str);
$str=preg_replace("/'IN_ICP', '(.*?)'/","'IN_ICP', '".SafeRequest("IN_ICP","post")."'",$str);
$str=preg_replace("/'IN_MAIL', '(.*?)'/","'IN_MAIL', '".SafeRequest("IN_MAIL","post")."'",$str);
$str=preg_replace("/'IN_MAILOPEN', '(.*?)'/","'IN_MAILOPEN', '".SafeRequest("IN_MAILOPEN","post")."'",$str);
$str=preg_replace("/'IN_MAILSMTP', '(.*?)'/","'IN_MAILSMTP', '".SafeRequest("IN_MAILSMTP","post")."'",$str);
$str=preg_replace("/'IN_MAILPW', '(.*?)'/","'IN_MAILPW', '".SafeRequest("IN_MAILPW","post")."'",$str);
$str=preg_replace("/'IN_CODEOPEN', '(.*?)'/","'IN_CODEOPEN', '".SafeRequest("IN_CODEOPEN","post")."'",$str);
$str=preg_replace("/'IN_CODE', '(.*?)'/","'IN_CODE', '".SafeRequest("IN_CODE","post")."'",$str);
$str=preg_replace("/'IN_STAT', '(.*?)'/","'IN_STAT', '".base64_encode(stripslashes(SafeRequest("IN_STAT","post",1)))."'",$str);
$str=preg_replace("/'IN_OPEN', '(.*?)'/","'IN_OPEN', '".SafeRequest("IN_OPEN","post")."'",$str);
$str=preg_replace("/'IN_OPENS', '(.*?)'/","'IN_OPENS', '".SafeRequest("IN_OPENS","post")."'",$str);
if(!$fp = fopen('source/system/config.inc.php','w')){ShowMessage("保存失败，文件{source/system/config.inc.php}没有写入权限！",$_SERVER['HTTP_REFERER'],"infotitle3",3000,1);}
$ifile=new iFile('source/system/config.inc.php','w');
$ifile->WriteFile($str,3);
ShowMessage("恭喜您，设置保存成功！",$_SERVER['HTTP_REFERER'],"infotitle2",1000,1);
}
?>