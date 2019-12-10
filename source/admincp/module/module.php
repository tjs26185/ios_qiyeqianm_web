<?php

if(!defined('IN_ROOT')){exit('Access denied');}
Administrator(7);
;echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=';echo IN_CHARSET;;echo '" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>所有应用</title>
<link href="static/admincp/css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="static/pack/layer/confirm-lib.js"></script>
<script type="text/javascript">
function del_msg(href) {
	$.layer({
		shade: [0],
		area: [\'auto\', \'auto\'],
		dialog: {
			msg: \'卸载操作不可逆，确认继续？\',
			btns: 2,
			type: 4,
			btn: [\'确认\', \'取消\'],
			yes: function() {
				location.href = href;
			},
			no: function() {
				layer.msg(\'已取消卸载\', 1, 0);
			}
		}
	});
}
</script>
</head>
<body>
';
$action=SafeRequest("ac","get");
if($action=="uninst"){del_plugin($_GET['id'],$_GET['dir']);}
;echo '<div class="container">
<script type="text/javascript">parent.document.title = \'EarCMS Board 管理中心 - 云平台\';if(parent.$(\'admincpnav\')) parent.$(\'admincpnav\').innerHTML=\'云平台\';</script>
<div class="floattop"><div class="itemtitle"><h3>所有应用</h3></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th class="partition">插件列表</th></tr>
</table>
<table class="tb tb2">
';
global $db,$develop_auth;
$sql = "select * from ".tname('plugin')." where in_type>0 order by in_addtime desc";
$query = $db->query($sql);
$count = $db->num_rows($db->query(str_replace('*','count(*)',$sql)));
if($count==0){
echo "<tr><td colspan=\"2\" class=\"td27\">暂无插件</td></tr>";
}else{
while($row = $db->fetch_array($query)){
echo "<tr class=\"hover hover\">";
echo "<td valign=\"top\" style=\"width:45px\"><img src=\"source/plugin/".$row['in_dir']."/preview.jpg\" onerror=\"this.src='static/admincp/css/preview.png'\" style=\"cursor:pointer\" onclick=\"location.href='plugin.php/".$row['in_dir']."/".$row['in_file']."/';\" width=\"40\" height=\"40\" align=\"left\" /></td>";
echo "<td class=\"light\" valign=\"top\" style=\"width:200px\">".$row['in_name']."<br /><span class=\"sml\">".$row['in_dir']."</span><br /></td>";
echo "<td valign=\"bottom\"><span class=\"light\">作者: ".$row['in_author']."</span><div class=\"psetting\"><a href=\"".$row['in_address']."\" target=\"_blank\">查看</a></div></td>";
echo "<td align=\"right\" valign=\"bottom\" style=\"width:160px\">".$row['in_addtime']."<br /><br /><a style=\"cursor:pointer\" onclick=\"del_msg('?iframe=module&ac=uninst&id=".$row['in_id']."&dir=".$row['in_dir']."');\">卸载</a>&nbsp;&nbsp;</td>";
echo "</tr>";
}
}
;echo '</table>
<table class="tb tb2">
<tr><th class="partition">扩展列表</th></tr>
</table>
<table class="tb tb2">
';
$sql = "select * from ".tname('plugin')." where in_type<1 order by in_addtime desc";
$query = $db->query($sql);
$count = $db->num_rows($db->query(str_replace('*','count(*)',$sql)));
if($count==0){
echo "<tr><td colspan=\"2\" class=\"td27\">暂无扩展</td></tr>";
}else{
while($row = $db->fetch_array($query)){
echo "<tr class=\"hover hover\">";
echo "<td valign=\"top\" style=\"width:45px\"><img src=\"source/plugin/".$row['in_dir']."/preview.jpg\" onerror=\"this.src='static/admincp/css/preview.png'\" width=\"40\" height=\"40\" align=\"left\" /></td>";
echo "<td class=\"light\" valign=\"top\" style=\"width:200px\">".$row['in_name']."<br /><span class=\"sml\">".$row['in_dir']."</span><br /></td>";
echo "<td valign=\"bottom\"><span class=\"light\">作者: ".$row['in_author']."</span><div class=\"psetting\"><a href=\"".$row['in_address']."\" target=\"_blank\">查看</a></div></td>";
echo "<td align=\"right\" valign=\"bottom\" style=\"width:160px\">".$row['in_addtime']."<br /><br /><a style=\"cursor:pointer\" onclick=\"del_msg('?iframe=module&ac=uninst&id=".$row['in_id']."&dir=".$row['in_dir']."');\">卸载</a>&nbsp;&nbsp;</td>";
echo "</tr>";
}
}
;echo '</table>
<table class="tb tb2">
<tr><td colspan="15"><div class="fixsel"><a href="';echo is_ssl() ?str_replace('http://','https://',$develop_auth) : $develop_auth;;echo '">获取更多应用</a></div></td></tr>
</table>
</div>
</body>
</html>
';
function del_plugin($id,$dir){
global $db;
if(@include_once('source/plugin/'.$dir.'/function.php')){
plugin_uninstall();
}
$sql="delete from ".tname('plugin')." where in_id=".intval($id);
if($db->query($sql)){
echo "<script type=\"text/javascript\">parent.$('menu_app').innerHTML='".Menu_App()."';</script>";
destroyDir('source/plugin/'.$dir.'/');
ShowMessage("恭喜您，应用卸载成功！","?iframe=module","infotitle2",3000,1);
}
}
?>