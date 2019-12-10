<?php

if(!defined('IN_ROOT')){exit('Access denied');}
Administrator(6);
$action=SafeRequest("action","get");
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>购钥记录</title>
<link href="static/admincp/css/main.css" rel="stylesheet" type="text/css" />
<link href="static/pack/asynctips/asynctips.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="static/pack/asynctips/jquery.min.js"></script>
<script type="text/javascript" src="static/pack/asynctips/asyncbox.v1.4.5.js"></script>
<script type="text/javascript">
function s(){
        var k=document.getElementById("search").value;
        if(k==""){
                asyncbox.tips("请输入要查询的关键词！", "wait", 1000);
                document.getElementById("search").focus();
                return false;
        }else{
                document.btnsearch.submit();
        }
}
</script>
</head>
<body>
<?php
switch($action){
case 'keyword':
$key=SafeRequest("key","get");
$sql="select * from ".tname('order')." where pay_no like '%".$key."%' and param='aid' or pay_id like '%".$key."%' order by up_time desc";
main($sql,20);
break;
default:
$lock=SafeRequest("lock","get");
if(!is_numeric($lock)){
$sql="select * from ".tname('order')." where param='aid' order by up_time desc";
}else{
$sql="select * from ".tname('order')." where status=".$lock." order by up_time desc";
}
main($sql,20);
break;
}
 ?>
</body>
</html>
<?php
function main($sql,$size){
global $db;
$Arr=getpagerow($sql,$size);
$result=$Arr[1];
$count=$Arr[2];
 ?><div class="container">
<script type="text/javascript">parent.document.title = 'Jike-分发 管理中心 - 系统 - 购钥记录';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='系统&nbsp;&raquo;&nbsp;购钥记录';</script>
<div class="floattop"><div class="itemtitle"><h3>购钥记录</h3></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th class="partition">技巧提示</th></tr>
<tr><td class="tipsblock"><ul>
<li>可以输入订单号、支付会员等关键词进行搜索</li>
</ul></td></tr>
</table>
<table class="tb tb2">
<form name="btnsearch" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<tr><td>
<input type="hidden" name="iframe" value="buylog">
<input type="hidden" name="action" value="keyword">
关键词：<input class="txt" x-webkit-speech type="text" name="key" id="search" value="" />
<select onchange="location.href=this.options[this.selectedIndex].value;">
<option value="?iframe=buylog">不限状态</option>
<option value="?iframe=buylog&lock=0"<?php if(isset($_GET['lock']) &&$_GET['lock']==0){echo " selected";} ?>>支付成功</option>
<option value="?iframe=buylog&lock=1"<?php if(isset($_GET['lock']) &&$_GET['lock']==1){echo " selected";} ?>>支付失败</option>
</select>
<input type="button" value="搜索" class="btn" onclick="s()" />
</td></tr>
</form>
</table>
<table class="tb tb2">
<tr class="header">
<th>订单号</th>
<th>购买类型</th>
<th>支付金额</th>
<th>支付状态</th>
<th>开通应用ID</th>
<th>支付时间</th>
</tr>
<?php
if($count==0){
?>
<tr><td colspan="2" class="td27">没有购钥记录</td></tr>
<?php
}
if($result){
while($row = $db->fetch_array($result)){
?>
<tr class="hover">
<td><?php echo str_replace(SafeRequest("key","get"),'<em class="lightnum">'.SafeRequest("key","get").'</em>',$row['pay_no']); ?></td>
<td><?php if( $row['money']==1000){echo '【年】签名套餐';}else if( $row['money']==400){echo '【季】签名套餐';}else if( $row['money']==150){echo '【月】签名套餐';} ?></td>
<td><?php echo $row['money']; ?></td>
<td><?php if($row['status']==2){echo '成功';}else{echo '<em class="lightnum">失败</em>';} ?></td>
<td><a href="#" class="act"><?php echo str_replace(SafeRequest("key","get"),'<em class="lightnum">'.SafeRequest("key","get").'</em>',$row['pay_id']); ?></a></td>
<td><?php if(date('Y-m-d',strtotime($row['up_time'])) == date('Y-m-d')){echo '<em class="lightnum">'.$row['up_time'].'</em>';}else{echo $row['up_time'];} ?></td>
</tr>
<?php
}
}
 ?></table>
<table class="tb tb2">
<?php echo $Arr[0]; ?></table>
</div>
<?php }?>