<?php

if(!defined('IN_ROOT')){exit('Access denied');}
Administrator(3);
$action=SafeRequest("action","get");
;echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=';echo IN_CHARSET;;echo '" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>授权管理</title>
<link href="static/admincp/css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">function $(obj) {return document.getElementById(obj);}</script>
</head>
<body>
';
switch($action){
case 'del':
Del();
break;
case 'saveadd':
SaveAdd();
break;
default:
main();
break;
}
;echo '</body>
</html>
';
function main(){
global $db;
$sql="select * from ".tname('secret')." order by in_id asc";
$result=$db->query($sql);
$count=$db->num_rows($db->query(str_replace('*','count(*)',$sql)));
;echo '<div class="container">
<script type="text/javascript">parent.document.title = \'Jike-分发 管理中心 - 应用 - 授权管理\';if(parent.$(\'admincpnav\')) parent.$(\'admincpnav\').innerHTML=\'应用&nbsp;&raquo;&nbsp;授权管理\';</script>
<div class="floattop"><div class="itemtitle"><h3>授权管理</h3></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th class="partition">授权列表</th></tr>
</table>
<table class="tb tb2">
<tr class="header">
<th>编号</th>
<th>授权域名</th>
<th>授权密匙</th>
<th>授权状态</th>
<th>到期时间</th>
<th>编辑操作</th>
</tr>
';if($count==0){;echo '<tr><td colspan="2" class="td27">没有授权</td></tr>
';
}else{
while($row = $db->fetch_array($result)){
;echo '<tr class="hover">
<td class="td25">';echo $row['in_id'];;echo '</td>
<td class="td29">';echo $row['in_site'];;echo '</td>
<td class="td29">';echo $row['in_md5'];;echo '</td>
<td><div class="parentboard">';if($row['in_endtime'] <time()){echo '<em class="lightnum">已过期</em>';}else{echo '已授权';};echo '</div></td>
<td class="td29">';echo date('Y-m-d',$row['in_endtime']);;echo '</td>
<td><input type="button" class="btn" value="删除" onclick="location.href=\'?iframe=secret&action=del&in_id=';echo $row['in_id'];;echo '\'" /></td>
</tr>
';
}
}
;echo '</table>

<table class="tb tb2">
<tr><th class="partition">新增授权</th></tr>
</table>
<form method="post" action="?iframe=secret&action=saveadd">
<table class="tb tb2">
<tr>
<td>授权域名</td>
<td><input type="text" class="txt" name="_site" style="margin:0;width:200px"></td>
</tr>
<tr><td colspan="15"><div class="fixsel"><input type="submit" name="saveadd" class="btn" value="新增" /></div></td></tr>
</table>
</form>
</div>


';
}
function SaveAdd(){
global $db;
if(!submitcheck('saveadd')){ShowMessage("表单验证不符，无法提交！",$_SERVER['PHP_SELF'],"infotitle3",3000,1);}
$site = SafeRequest("_site","post");
$in_site = str_replace('www.','',$site);
$in_md5 = md5($in_site.'|'.time().'|'.rand(2,pow(2,24)));
//$in_md5 = md5($in_site);
$in_endtime = time() + 26784000;
if(empty($in_site)){ShowMessage("新增出错，授权域名不能为空！","?iframe=secret","infotitle3",1000,1);}
$in_id = $db->getone("select in_id from ".tname('secret')." where in_site='$in_site'");
if($in_id){
$db->query("update ".tname('secret')." set in_endtime=$in_endtime where in_id=".$in_id);
}else{
$db->query("Insert ".tname('secret')." (in_site,in_md5,in_endtime) values ('$in_site','$in_md5',$in_endtime)");
}
ShowMessage("恭喜您，授权新增成功！","?iframe=secret","infotitle2",1000,1);
}
function Del(){
global $db;
$in_id = intval(SafeRequest("in_id","get"));
$db->query("delete from ".tname('secret')." where in_id=".$in_id);
ShowMessage("恭喜您，授权删除成功！","?iframe=secret","infotitle2",3000,1);
}
?>