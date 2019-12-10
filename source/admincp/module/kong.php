<?php

if(!defined('IN_ROOT')){exit('Access denied');}
Administrator(3);
$action=SafeRequest("action","get");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>签名控制</title>
<link href="static/admincp/css/main.css" rel="stylesheet" type="text/css" />
<link href="static/pack/asynctips/asynctips.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="static/pack/asynctips/jquery.min.js"></script>
<script type="text/javascript" src="static/pack/asynctips/asyncbox.v1.4.5.js"></script>
<script type="text/javascript" src="static/index/jquery-1.7.2.min.js"></script> 
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
switch($action){
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
$sql="select * from app order by expdate asc";
$result=$db->query($sql);
$count=$db->num_rows($db->query(str_replace('*','count(*)',$sql)));
?>
<div class="container">
<script type="text/javascript">parent.document.title = 'Jike-分发 管理中心 - 应用 - 证书管理';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='应用&nbsp;&raquo;&nbsp;证书管理';</script>
<div class="floattop"><div class="itemtitle"><h3>签名控制</h3></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th class="partition">签名控制</th></tr>
</table>
<form name="form" method="post" action="?iframe=kong&action=editsave">
<table class="tb tb2">
<tr class="header">
<th>编号</th>
<th>APP名称/ID</th>
<th>所属用户</th>
<th>到期提示</th>
<th>到期时间（注意时间格式）</th>
<th>证书ID</th>
<th>签名证书</th>
<th>安装量</th>
</tr>
<?php if($count==0){ ?>
<tr><td colspan="2" class="td27">没有证书</td></tr>
<?php
}else{
while($row = $db->fetch_array($result)){
  $expdate = $row['expdate']; 
  $expdates = strtotime($expdate) < time() ? '已过期' : $expdate;
  $i++;
?>
<tr class="hover">
<td class="td25"><input class="checkbox" type="checkbox" name="in_id[]" value="<?php echo $row['id']; ?>"readonly><?php echo $row['id']; ?></td>
<td class="td26"><a href="<?php echo http().$_SERVER['HTTP_HOST'].'/app.php/'.auth_codes($row['aid']);?>" target="_blank" class="act" style="margin:0;width:80%;"><?php echo $row['name'];?> [<?php echo $row['aid'];?>]</a></td>
<td class="td25"><input type="text" name="user<?php echo $row['id']; ?>" value="<?php echo $row['mark']; ?>"></td>
<td class="td29"><input type="text" name="msg<?php echo $row['id']; ?>" value="<?php echo $row['msg']; ?>" style="margin:0;width:100%;"  /></td>
<td><input type="text" name="expdate<?php echo $row['id']; ?>" value="<?php echo $expdates; ?>" class="txt" style="margin:0;width:70%;"  /></td>
<td class="td29"><?php echo $row['team']; ?></td>
<td class="td29"><?php echo $row['tname']; ?></td>
<td class="td29"><?php echo $row['d_num']; ?></td>
</tr>
<?php
}
}
 ?></table>
<table class="tb tb2">
<tr><td class="td25"><input type="checkbox" id="chkall" class="checkbox" onclick="CheckAll(this.form)" /><label for="chkall">全选</label></td><td colspan="15"><div class="fixsel"><input type="submit" class="btn" name="editsave" value="批量修改" /></div></td></tr>
</table>
</form>
</div>

<?php
}
function EditSave()
{
    global $db;
    if (!submitcheck('editsave')) {
        ShowMessage("表单验证不符，无法提交！", $_SERVER['PHP_SELF'], "infotitle3", 3000, 1);
    }
    $in_id = RequestBox("in_id");//exit($in_id);
    if ($in_id == 0) {
        ShowMessage("修改失败，请先勾选要修改的APP！", "?iframe=kong", "infotitle3", 3000, 1);
    } else {
        $ID = explode(',', $in_id);
        for ($i = 0; $i < count($ID); $i++) {
            $roa = $GLOBALS['db']->getrow("select * from app where id=" . $ID[$i]);
            $msg = SafeRequest("msg" . $ID[$i], "post");
            $user = SafeRequest("user" . $ID[$i], "post");
	        $expdate = SafeRequest("expdate" . $ID[$i],"post");
            $dndate = strtotime($expdate);
            $isuse  = $dndate > time() ? 1 : 0;
            $db->query("update " . tname('app') . " set in_sign='{$dndate}' where in_id=" . $roa['aid']);
            $db->query("update app set mark='{$user}',isuse='{$isuse}',msg='{$msg}',expdate='{$expdate}' where id=" . $ID[$i]);
        }
        ShowMessage("恭喜您，APP批量修改成功！", "?iframe=kong", "infotitle2", 3000, 1);
    }
}