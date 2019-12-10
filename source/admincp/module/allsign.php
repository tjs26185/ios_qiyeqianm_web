<?php

//$in_id = RequestBox("in_id");exit($in_id);
if(!defined('IN_ROOT')){exit('Access denied');}
Administrator(3);
$action=SafeRequest("action","get");//exit($action);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>批量重签名</title>
<link href="static/admincp/css/main.css" rel="stylesheet" type="text/css" />
<link href="static/pack/asynctips/asynctips.css" rel="stylesheet" type="text/css" />
<style>
.shortselect{
	background:#fafdfe;
	height:28px;
	width:40%;
	line-height:28px;
	border:1px solid #9bc0dd;
	-moz-border-radius:2px;
	-webkit-border-radius:2px;
	border-radius:2px;
</style>
<script type="text/javascript" src="static/pack/asynctips/jquery.min.js"></script>
<script type="text/javascript" src="static/pack/asynctips/asyncbox.v1.4.5.js"></script>
<script type="text/javascript" src="static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="static/pack/layer/lib.js"></script>
<script type="text/javascript">
var pop = {
	up: function(scrolling, text, url, width, height, top) {
		layer.open({
			type: 2,
			maxmin: true,
			title: text,
			content: [url, scrolling],
			area: [width, height],
			offset: top,
			shade: false
		});
	}
}
function CheckAll(form) {
	for (var i = 0; i < form.elements.length; i++) {
		var e = form.elements[i];
		if (e.name != 'chkall') {
			e.checked = form.chkall.checked;
		}
	}
}
</script>
</head>
<body>
<?php
switch($action){//exit($action):
case 'editsave':
EditSave();
break;
default:
main();
break;
}
?>
</body>
</html>
<?php
function main(){
global $db;
$sql="select * from ".tname('sign')." order by in_time desc";
$result=$db->query($sql);
$count=$db->num_rows($db->query(str_replace('*','count(*)',$sql)));
?>
<div class="container">
<script type="text/javascript">parent.document.title = 'Jike-分发 管理中心 - 应用 - 证书管理';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='应用&nbsp;&raquo;&nbsp;批量签名';</script>
<div class="floattop"><div class="itemtitle"><h3>批量重签名</h3></div></div><div class="floattopempty"></div>
<form name="form" method="post" action="?iframe=allsign&action=editsave">
<table class="tb tb2">
<tr class="header">
<th>编号</th>
<th>应用名称 / ID</th>
<th>来源站点</th>
<th>签名状态</th>
<th>特殊签名文件</th>
<th>签名时间</th>
<th>签名到期时间</th>
<th>证书名称</th>
</tr>
<?php if($count==0){ ?>
<tr><td colspan="2" class="td27">没有已签名APP</td></tr>
<?php
}else{
while($row = $db->fetch_array($result)){
  $endtime = $GLOBALS['db']->getone("select in_sign from ".tname('app')." where in_sign>0 and in_resign>0 and shan=0 and in_id=".$row['in_aid']);
 // if($endtime > time()){
  $in_cert = $GLOBALS['db']->getone("select in_name from ".tname('cert')." where in_dir='".$row['in_cert']."'");
  $cername = explode(': ',$in_cert); 
  $cername = $cername[1] ? $cername[1]:'<em class="lightnum">证书已被吊销或已过期</em>';
?>
<tr class="hover">
<td class="td25"><input class="checkbox" type="checkbox" name="in_id[]" value="<?php echo $row['in_id']; ?>"><?php echo $row['in_id']; ?></td>
<td><a href="<?php echo $row['in_ssl'].$row['in_site'].$row['in_path'].'app.php/'.auth_codes($row['in_aid']);?>" target="_blank" class="act"><?php echo $row['in_aname'];;?>[<?php echo $row['in_aid'];?>]</a></td>
<td class="td29"><?php echo $row['in_site']; ?></td>
<td class="td25"><?php echo $row['in_status'] >1 ? ($in_cert ? '<font color="#3DAFEB">签名完成</font>' : '待签名') : '<em class="lightnum">正在签名</em>';?></td>
<td class="td29"><?php if($row['in_replace'] == '*.*|*'){echo '签全部';}else{echo $row['in_replace'];}?></td>
<td class="td29"><?php echo date('Y-m-d H:i:s',$row['in_time']); ?></td>
<td class="td29"><?php echo date('Y-m-d H:i:s',$endtime); ?></td>
<td><?php echo $cername; ?></td>
</tr>
<?php
//}
}
}
?>
</table>
<table class="tb tb2">
<tr><td><p/>
<li>证书选择后将自动重签所有原证书非所选证书的APP，请慎重选择所要使用的证书，请先删除过期证书</li><br/>
证书：<select name="in_dir" class="shortselect">
<option value="">  请选择一个可用证书</option>
<?php
  $query = $GLOBALS['db']->query("select * from ".tname('cert'));
while($row = $GLOBALS['db']->fetch_array($query)){
  $cername = explode(': ',$row['in_name']); 
  $cername = $cername[1];
  $cert .= '<option value="'.$row['in_dir'].'" id="in_cert">'.$cername.'</option>';
} echo $cert;
?>
</select> 
</td></tr>
</table>
<table class="tb tb2">
<tr><td class="td25"><input type="checkbox" id="chkall" class="checkbox" onclick="CheckAll(this.form)" /><label for="chkall">全选</label></td><td colspan="15"><div class="fixsel"><input type="submit" class="btn" name="editsave" value="批量提交重签名" /></div></td></tr>
</table>
</form>
</div>
<br><br><br><br><br>
<?php
}
function EditSave()
{
    global $db;
    if (!submitcheck('editsave')) {
        ShowMessage("表单验证不符，无法提交！", $_SERVER['PHP_SELF'], "infotitle3", 3000, 1);
    }
    $in_dir = SafeRequest("in_dir","post");
    $in_id = RequestBox("in_id");
  
    if ($in_dir == '') {
        ShowMessage("提交失败，请先选择一个可用证书！", "?iframe=allsign", "infotitle3", 3000, 1);
    }
    if ($in_id == 0) {
        ShowMessage("提交失败，请先勾选要签名的APP！", "?iframe=allsign", "infotitle3", 3000, 1);
    } else {
        $ID = explode(',', $in_id);   
        for ($i = 0; $i < count($ID); $i++) {   
           $row = $GLOBALS['db']->getrow("select * from " . tname('sign') . " where in_id=" . $ID[$i]);
           $iden = $row['in_cert'];
           $in_cert = $GLOBALS['db']->getone("select in_name from ".tname('cert')." where in_dir='{$iden}'");
           //if (!$in_cert){
              $GLOBALS['db']->query("update " . tname('app') . " set in_resign=in_resign-1 where in_id='{$row['in_aid']}'");
              $dbd = $GLOBALS['db']->query("update " . tname('sign') . " set in_status=1,in_cert='{$in_dir}',in_time=".time()." where in_cert!='{$in_dir}' and in_status=2 and in_id='{$ID[$i]}'");
           //}
        }if ($dbd){
            ShowMessage("恭喜您，APP批量签名提交成功！", "?iframe=allsign", "infotitle2", 3000, 1);
        } else {
            ShowMessage("所提交的APP无须重签名！", "?iframe=allsign", "infotitle3", 3000, 1);
        }
    }
}
?>


