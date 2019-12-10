<?php
header("Content-type: text/html; charset=utf-8");
if (!defined('IN_ROOT')) {
    exit('Access denied');
}
Administrator(4);
$action = SafeRequest("action", "get");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET;?>" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>用户管理</title>
<link href="static/admincp/css/main.css" rel="stylesheet" type="text/css" />
<link href="static/pack/asynctips/asynctips.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="static/pack/asynctips/jquery.min.js"></script>
<script type="text/javascript" src="static/pack/asynctips/asyncbox.v1.4.5.js"></script>
</head>
<body>
<?php
switch ($action) {
    case 'edit':
        Edit();
        break;
    case 'saveedit':
        SaveEdit();
        break;
    case 'allsave':
        AllSave();
        break;
    case 'keyword':
        $key = SafeRequest("key", "get");
        main("select * from " . tname('user') . " where in_username like '%" . $key . "%' order by in_regdate desc", 20);
        break;
    case 'lock':
        main("select * from " . tname('user') . " where in_islock=1 order by in_regdate desc", 20);
        break;
    case 'verify':
        main("select * from " . tname('user') . " where in_verify=2 order by in_regdate desc", 20);
        break;
    default:
        main("select * from " . tname('user') . " order by in_regdate desc", 20);
        break;
}
?>
<link href="static/pack/fancybox/jquery.fancybox-1.3.4.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="static/pack/fancybox/jquery.fancybox.min.js"></script>
<script type="text/javascript" src="static/pack/fancybox/jquery.fancybox.pack.js"></script>
</body>
</html>
<?php
function EditBoard($Arr, $url)
{
    global $db;
    $app = $db->num_rows($db->query("select count(*) from " . tname('app') . " where in_uid=" . $Arr[0]));
    $in_username = $Arr[1];
    $in_nick = $Arr[2];
    $in_card = $Arr[3];
    $in_mobile = $Arr[4];
    $in_qq = $Arr[5];
    $in_firm = $Arr[6];
    $in_job = $Arr[7];
    $in_verify = $Arr[8];
    $in_islock = $Arr[9];
    $in_points = $Arr[10];
?>
<script type="text/javascript">$(document).ready(function(){$("#thumb_prev").fancybox({'overlayColor':'#000','overlayOpacity':0.1,'overlayShow':true,'transitionIn':'elastic','transitionOut':'elastic'});$("#thumb_after").fancybox({'overlayColor':'#000','overlayOpacity':0.1,'overlayShow':true,'transitionIn':'elastic','transitionOut':'elastic'});$("#thumb_hand").fancybox({'overlayColor':'#000','overlayOpacity':0.1,'overlayShow':true,'transitionIn':'elastic','transitionOut':'elastic'});});</script>
<div class="container">
<script type="text/javascript">parent.document.title = 'Jike-分发 管理中心 - 用户 - 编辑用户';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='用户&nbsp;&raquo;&nbsp;编辑用户';</script>
<div class="floattop"><div class="itemtitle"><h3>编辑用户</h3><ul class="tab1">
<li><a href="?iframe=user"><span>所有用户</span></a></li>
<li><a href="?iframe=user&action=lock"><span>锁定状态</span></a></li>
<li><a href="?iframe=user&action=verify"><span>待审认证</span></a></li>
</ul></div></div><div class="floattopempty"></div>
<form action="<?php echo $url;?>" method="post" name="form2">
<table class="tb tb2">
<tr><td colspan="2" class="td27">用户名:</td></tr>
<tr><td class="vtop rowform"><?php echo $in_username;?></td></tr>
<tr><td colspan="2" class="td27">头像:</td></tr>
<tr class="noborder"><td class="vtop rowform"><img width="120" height="120" src="<?php echo getavatar($Arr[0]);?>" /><br /><br /><input name="editavatar" class="checkbox" type="checkbox" value="1"';if(!is_file('data/attachment/avatar/'.$Arr[0].'.jpg')){;echo ' disabled="disabled"';};echo ' /> 删除头像</td></tr>
<tr><td colspan="2" class="td27">统计信息:</td></tr>
<tr class="noborder"><td class="vtop rowform">
<a href="?iframe=app&action=keyword&key=<?php echo $in_username;?>" class="act">应用数(<?php echo $app;?>)</a>
</td></tr>
<tr><td colspan="2" class="td27">证件照片:</td></tr>
<tr class="noborder">
<?php if(getverify($Arr[0],'prev')){?>
<td class="vtop rowform"><a href="<?php echo getverify($Arr[0],'prev',1);?>" id="thumb_prev"><img width="240" height="120" src="<?php echo getverify($Arr[0],'prev',1);?>" /></a></td>
<?php }
  if(getverify($Arr[0],'after')){
?>
<td class="vtop rowform"><a href="<?php echo getverify($Arr[0],'after',1);?>" id="thumb_after"><img width="240" height="120" src="<?php echo getverify($Arr[0],'after',1);?>" /></a></td>
<?php 
  }
  if(getverify($Arr[0],'hand')){?>
<td class="vtop"><a href="<?php echo getverify($Arr[0],'hand',1);?>" id="thumb_hand"><img width="240" height="120" src="<?php echo getverify($Arr[0],'hand',1);?>" /></a></td>
<?php
  }
?>
</tr>
<tr><td colspan="2" class="td27">真实姓名:</td></tr>
<tr class="noborder"><td class="vtop rowform"><input id="in_nick" name="in_nick" value="<?php echo $in_nick;?>" type="text" class="txt" /></td></tr>
<tr><td colspan="2" class="td27">身份证号:</td></tr>
<tr class="noborder"><td class="vtop rowform"><input id="in_card" name="in_card" value="<?php echo $in_card;?>" type="text" class="txt" /></td></tr>
<tr><td colspan="2" class="td27">新密码:</td></tr>
<tr class="noborder"><td class="vtop rowform"><input id="in_userpassword" name="in_userpassword" type="text" class="txt" /></td><td class="vtop tips2">如果不更改密码此处请留空</td></tr>
<tr><td colspan="2" class="td27">手机:</td></tr>
<tr class="noborder"><td class="vtop rowform"><input id="in_mobile" name="in_mobile" value="<?php echo $in_mobile;?>" type="text" class="txt" /></td></tr>
<tr><td colspan="2" class="td27">QQ:</td></tr>
<tr class="noborder"><td class="vtop rowform"><input id="in_qq" name="in_qq" value="<?php echo $in_qq;?>" type="text" class="txt" /></td></tr>
<tr><td colspan="2" class="td27">公司:</td></tr>
<tr class="noborder"><td class="vtop rowform"><input id="in_firm" name="in_firm" value="<?php echo $in_firm;?>" type="text" class="txt" /></td></tr>
<tr><td colspan="2" class="td27">职位:</td></tr>
<tr class="noborder"><td class="vtop rowform"><input id="in_job" name="in_job" value="<?php echo $in_job;?>" type="text" class="txt" /></td></tr>
<tr><td colspan="2" class="td27">下载点数:</td></tr>
<tr class="noborder"><td class="vtop rowform"><input type="text" id="in_points" name="in_points" class="px" value="<?php echo $in_points;?>" onkeyup="this.value=this.value.replace(/[^\\d]/g,\'\')" onbeforepaste="clipboardData.setData(\'text\',clipboardData.getData(\'text\').replace(/[^\\d]/g,\'\'))" /></td></tr>
<tr><td colspan="2" class="td27">锁定状态:</td></tr>
<tr class="noborder"><td class="vtop rowform"><select id="in_islock" name="in_islock" class="ps">
<option value="0">否</option>
<option value="1"<?php if($in_islock==1){echo " selected";}?>>是</option>
</select></td></tr>
<tr><td colspan="2" class="td27">实名认证:</td></tr>
<tr class="noborder"><td class="vtop rowform"><select id="in_verify" name="in_verify" class="ps">
<option value="0">否</option>
<option value="1"<?php if($in_verify==1){echo " selected";}?>>是</option>
</select></td></tr>
<tr><td colspan="15"><div class="fixsel"><input type="submit" class="btn" name="edit" value="提交" /></div></td></tr>
</table>
</form>
</div>

<?php
}
function main($sql,$size){
global $db,$action;
$Arr=getpagerow($sql,$size);
$result=$Arr[1];
$count=$Arr[2];
?>
<script type="text/javascript" src="static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="static/pack/layer/lib.js"></script>
<script type="text/javascript">
function CheckAll(form) {
	for (var i = 0; i < form.elements.length; i++) {
		var e = form.elements[i];
		if (e.name != 'chkall') {
			e.checked = form.chkall.checked;
		}
	}
        all_save(form);
}
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
function all_save(form){
        var opt=document.getElementById("in_allsave").value;
        if(form.chkall.checked && opt=="0"){
		layer.tips('删除用户不可逆，请谨慎操作！', '#chkall', {
			tips: 3
		});
        }
}
</script>
<div class="container">
<?php if(empty($action)){?>
<script type="text/javascript">
  parent.document.title = 'Jike-分发 管理中心 - 用户 - 所有用户 ';
  if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='用户&nbsp;&raquo;&nbsp;所有用户';
</script>
<?php 
  }
  if($action=="lock"){?>
<script type="text/javascript">
  parent.document.title = 'Jike-分发 管理中心 - 用户 - 锁定状态';
  if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='用户&nbsp;&raquo;&nbsp;锁定状态';
</script>
<?php 
  } 
  if($action=="verify"){ 
?> 
<script type="text/javascript">
  parent.document.title = 'Jike-分发 管理中心 - 用户 - 待审认证 '; 
  if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='用户&nbsp;&raquo;&nbsp;待审认证';
</script>
<?php
  } 
  if($action=="keyword"){ ?>
<script type="text/javascript">
  parent.document.title = 'Jike-分发 管理中心 - 用户 - 搜索用户';
  if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='用户&nbsp;&raquo;&nbsp;搜索用户';
</script>
<?php
  }?>
<div class="floattop"><div class="itemtitle"><h3>
<?php 
  if(empty($action)){
    echo "所有用户";
  } else if($action=="lock"){
    echo "锁定状态";
  }else if($action=="verify"){
    echo "待审认证";
  }else if($action=="keyword"){
    echo "搜索用户";}?>
</h3><ul class="tab1">
<?php 
  if(empty($action)){
?>
<li class="current">
<?php
  }else{
?>
<li>
<?php
  }
?>
<a href="?iframe=user"><span>所有用户</span></a></li>
<?php
  if($action=="lock"){
?>
<li class="current">
<?php
  }else{
?>
<li><?php
  }
?>
<a href="?iframe=user&action=lock"><span>锁定状态</span></a></li>
<?php
  if($action=="verify"){
?>
<li class="current">
<?php 
  }else{
?>
<li>
<?php
  }
?>
<a href="?iframe=user&action=verify"><span>待审认证</span></a></li>
</ul></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th class="partition">技巧提示</th></tr>
<tr><td class="tipsblock"><ul>
<li>可以输入用户名等关键词进行搜索</li>
</ul></td></tr>
</table>
<table class="tb tb2">
<form name="btnsearch" method="get" action="<?php echo $_SERVER['PHP_SELF'];?>">
<tr><td>
<input type="hidden" name="iframe" value="user">
<input type="hidden" name="action" value="keyword">
关键词：<input class="txt" x-webkit-speech type="text" name="key" id="search" value="" />
<input type="button" value="搜索" class="btn" onclick="s()" />
</td></tr>
</form>
</table>
<form name="form" method="post" action="?iframe=user&action=allsave">
<table class="tb tb2">
<tr class="header">
<th>编号</th>
<th>头像</th>
<th>用户名</th>
<th>QQ昵称</th>
<th>下载点数</th>
<th>应用容量</th>
<th>状态</th>
<th>实名认证</th>
<th>登录时间</th>
<th>编辑操作</th>
</tr>
<?php
if($count==0){
?>
<tr><td colspan="2" class="td27">没有用户</td></tr>
<?php
}
if($result){
while($row = $db->fetch_array($result)){
  $nichen = $row['in_nick'];
?>
<script type="text/javascript">
  $(document).ready(function(){
  $("#thumb<?php echo $row['in_userid'];?>").fancybox({'overlayColor':'#000','overlayOpacity':0.1,'overlayShow':true,'transitionIn':'elastic','transitionOut':'elastic'});});
</script>
<tr class="hover">
<td class="td25"><input class="checkbox" type="checkbox" name="in_userid[]" id="in_userid" value="<?php echo $row['in_userid'];?>"><?php echo $row['in_userid'];?></td>
<td><a href="<?php echo getavatar($row['in_userid']); ?>" id="thumb<?php echo $row['in_userid']; ?>"><img src="<?php echo getavatar($row['in_userid']); ?>" width="25" height="25" /></a></td>
<td><?php echo str_replace(SafeRequest("key","get"),'<em class="lightnum">'.SafeRequest("key","get").'</em>',$row['in_username']); ?></td>
<td><?php echo $nichen; ?></td>
<td><?php echo $row['in_points']; ?></td>
<td><?php echo formatsize($row['in_spacetotal']); ?></td>
<td><?php if($row['in_islock']==1){echo "<em class=\"lightnum\">锁定</em>";}else{echo "正常";} ?></td>
<td><?php echo $row['in_verify'] >0 ?$row['in_verify'] >1 ?'<em class="lightnum">待审核</em>': '已认证': '未认证'; ?></td>
<td><?php if(date('Y-m-d',strtotime($row['in_logintime'])) == date('Y-m-d')){echo '<em class="lightnum">'.$row['in_logintime'].'</em>';}else{echo $row['in_logintime'];} ?></td>
<td><a href="?iframe=user&action=edit&in_userid=<?php echo $row['in_userid']; ?>" class="act">编辑</a></td>
</tr>
<?php 
//  $GLOBALS['db']->query("update " . tname('user') . " set in_nick='{$nichen}' where in_userid=" . $row['in_userid']);
}
}
?>
</table>
<table class="tb tb2">
<tr><td><input type="checkbox" id="chkall" class="checkbox" onclick="CheckAll(this.form);" /><label for="chkall">全选</label> &nbsp;&nbsp; <select id="in_allsave" name="in_allsave" onchange="all_save(this.form);">
<option value="0">删除用户</option>
<option value="1">激活状态</option>
<option value="2">锁定状态</option>
<option value="3">审核认证</option>
<option value="4">取消认证</option>
</select> &nbsp;&nbsp; <input type="submit" name="allsave" class="btn" value="批量操作" /></td></tr>
<?php echo $Arr[0]; } ?></table>
</form>
</div>
<?php
function AllSave()
{
    global $db;
    if (!submitcheck('allsave')) {
        ShowMessage("表单验证不符，无法提交！", $_SERVER['PHP_SELF'], "infotitle3", 3000, 1);
    }
    $in_userid = RequestBox("in_userid");
    $in_allsave = SafeRequest("in_allsave", "post");
    if ($in_userid == 0) {
        ShowMessage("批量操作失败，请先勾选要操作的用户！", $_SERVER['HTTP_REFERER'], "infotitle3", 3000, 1);
    } else {
        if ($in_allsave == 0) {
            $query = $db->query("select in_userid from " . tname('user') . " where in_userid in ({$in_userid})");
            while ($row = $db->fetch_array($query)) {
                @unlink('data/attachment/avatar/' . $row['in_userid'] . '.jpg');
                @unlink('data/attachment/avatar/' . $row['in_userid'] . '-prev.jpg');
                @unlink('data/attachment/avatar/' . $row['in_userid'] . '-after.jpg');
                @unlink('data/attachment/avatar/' . $row['in_userid'] . '-hand.jpg');
            }
            $sql = "delete from " . tname('user') . " where in_userid in ({$in_userid})";
            if ($db->query($sql)) {
                $db->query("delete from " . tname('buylog') . " where in_lock=1 and in_uid in ({$in_userid})");
                $db->query("delete from " . tname('paylog') . " where in_lock=1 and in_uid in ({$in_userid})");
                $db->query("delete from " . tname('mail') . " where in_uid in ({$in_userid})");
                ShowMessage("恭喜您，用户批量删除成功！", $_SERVER['HTTP_REFERER'], "infotitle2", 3000, 1);
            }
        } elseif ($in_allsave == 1) {
            $db->query("update " . tname('user') . " set in_islock=0 where in_userid in ({$in_userid})");
            ShowMessage("恭喜您，用户批量激活成功！", $_SERVER['HTTP_REFERER'], "infotitle2", 1000, 1);
        } elseif ($in_allsave == 2) {
            $db->query("update " . tname('user') . " set in_islock=1 where in_userid in ({$in_userid})");
            ShowMessage("恭喜您，用户批量锁定成功！", $_SERVER['HTTP_REFERER'], "infotitle2", 1000, 1);
        } elseif ($in_allsave == 3) {
            $db->query("update " . tname('user') . " set in_verify=1 where in_userid in ({$in_userid})");
            ShowMessage("恭喜您，用户批量审核认证成功！", $_SERVER['HTTP_REFERER'], "infotitle2", 1000, 1);
        } elseif ($in_allsave == 4) {
            $db->query("update " . tname('user') . " set in_verify=0 where in_userid in ({$in_userid})");
            ShowMessage("恭喜您，用户批量取消认证成功！", $_SERVER['HTTP_REFERER'], "infotitle2", 1000, 1);
        }
    }
}
function Edit()
{
    global $db;
    $in_userid = intval(SafeRequest("in_userid", "get"));
    $sql = "select * from " . tname('user') . " where in_userid=" . $in_userid;
    if ($row = $db->getrow($sql)) {
        $Arr = array($row['in_userid'], $row['in_username'], $row['in_nick'], $row['in_card'], $row['in_mobile'], $row['in_qq'], $row['in_firm'], $row['in_job'], $row['in_verify'], $row['in_islock'], $row['in_points']);
    }
    EditBoard($Arr, "?iframe=user&action=saveedit&in_userid=" . $in_userid);
}
function SaveEdit()
{
    global $db;
    if (!submitcheck('edit')) {
        ShowMessage("表单验证不符，无法提交！", $_SERVER['PHP_SELF'], "infotitle3", 3000, 1);
    }
    $in_userid = intval(SafeRequest("in_userid", "get"));
    $editavatar = SafeRequest("editavatar", "post");
    $in_userpassword = SafeRequest("in_userpassword", "post");
    $in_nick = SafeRequest("in_nick", "post");
    $in_card = SafeRequest("in_card", "post");
    $in_mobile = SafeRequest("in_mobile", "post");
    $in_qq = SafeRequest("in_qq", "post");
    $in_firm = SafeRequest("in_firm", "post");
    $in_job = SafeRequest("in_job", "post");
    $in_points = !is_numeric(SafeRequest("in_points", "post")) ? 0 : SafeRequest("in_points", "post");
    $in_islock = SafeRequest("in_islock", "post");
    $in_verify = SafeRequest("in_verify", "post");
    if ($editavatar == 1) {
        @unlink('data/attachment/avatar/' . $in_userid . '.jpg');
    }
    $userpassword = NULL;
    if (!empty($in_userpassword)) {
        $userpassword = "in_userpassword='" . substr(md5($in_userpassword), 8, 16) . "',";
    }
    $db->query("update " . tname('user') . " set " . $userpassword . "in_nick='{$in_nick}',in_card='{$in_card}',in_mobile='{$in_mobile}',in_qq='{$in_qq}',in_firm='{$in_firm}',in_job='{$in_job}',in_points={$in_points},in_islock={$in_islock},in_verify={$in_verify} where in_userid=" . $in_userid);
    ShowMessage("恭喜您，用户编辑成功！", $_SERVER['HTTP_REFERER'], "infotitle2", 1000, 1);
}
?>