<?php
if (!defined('IN_ROOT')) {
    exit('Access denied');
}
Administrator(6);
$action = SafeRequest("action", "get"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>系统用户</title>
<link href="static/admincp/css/main.css" rel="stylesheet" type="text/css" />
<link href="static/pack/asynctips/asynctips.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="static/pack/asynctips/jquery.min.js"></script>
<script type="text/javascript" src="static/pack/asynctips/asyncbox.v1.4.5.js"></script>
<script type="text/javascript" src="static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="static/pack/layer/confirm-lib.js"></script>
<script type="text/javascript">
function CheckForm(){
	if(document.form.in_adminname.value==""){
		asyncbox.tips("登录帐号不能为空，请填写！", "wait", 1000);
		document.form.in_adminname.focus();
		return false;
        }
        else {
		return true;
        }
}
function del_msg(href) {
	$.layer({
		shade: [0],
		area: ['auto', 'auto'],
		dialog: {
			msg: '删除操作不可逆，确认继续？',
			btns: 2,
			type: 4,
			btn: ['确认', '取消'],
			yes: function() {
				location.href = href;
			},
			no: function() {
				layer.msg('已取消删除', 1, 0);
			}
		}
	});
}
</script>
</head>
<body>
<?php
  switch ($action) {
    case 'add':
        Add();
        break;
    case 'saveadd':
        SaveAdd();
        break;
    case 'edit':
        Edit();
        break;
    case 'saveedit':
        SaveEdit();
        break;
    case 'islock':
        IsLock();
        break;
    case 'del':
        Del();
        break;
    default:
        main();
        break;
}
?></body>
</html>
<?php
function main()
{
    global $db;
    $sql = "select * from " . tname('admin');
    $result = $db->query($sql);
    $count = $db->num_rows($db->query(str_replace('*', 'count(*)', $sql)));
    ?><div class="container">
<script type="text/javascript">parent.document.title = 'Jike分发管理中心 - 系统 - 系统用户';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='系统&nbsp;&raquo;&nbsp;系统用户';</script>
<div class="floattop"><div class="itemtitle"><h3>系统用户</h3><ul class="tab1">
<li class="current"><a href="?iframe=admin"><span>系统用户</span></a></li>
<li><a href="?iframe=admin&action=add"><span>新增用户</span></a></li>
</ul></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th class="partition">用户列表</th></tr>
</table>
<table class="tb tb2">
<tr class="header">
<th>编号</th>
<th>帐号</th>
<th>登录时间</th>
<th>登录次数</th>
<th>状态</th>
<th>编辑操作</th>
</tr>
<?php if ($count == 0) {  ?><tr><td colspan="2" class="td27">没有系统用户</td></tr>
<?php }if ($result) {
        while ($row = $db->fetch_array($result)) { ?><tr class="hover">
<td class="td25"><?php echo $row['in_adminid']; ?></td>
<td><a href="?iframe=admin&action=edit&in_adminid=<?php echo $row['in_adminid']; ?>" class="act"><?php echo $row['in_adminname']; ?></a></td>
<td class="lightnum"><?php echo $row['in_logintime']; ?></td>
<td><?php echo $row['in_loginnum']; ?></td>
<td><?php if ($row['in_islock'] == 1) { ?><a href="?iframe=admin&action=islock&in_adminid=<?php echo $row['in_adminid']; ?>&in_islock=0&hash=<?php echo $_COOKIE['in_adminpassword']; ?>"><img src="static/admincp/css/show_no.gif" /></a><?php } else { ?><a href="?iframe=admin&action=islock&in_adminid=<?php echo $row['in_adminid']; ?>&in_islock=1&hash=<?php echo $_COOKIE['in_adminpassword']; ?>"><img src="static/admincp/css/show_yes.gif" /></a><?php } ?></td>
<td><a href="?iframe=admin&action=edit&in_adminid=<?php echo $row['in_adminid']; ?>" class="act">编辑</a><a class="act" style="cursor:pointer" onclick="del_msg('?iframe=admin&action=del&in_adminid=<?php echo $row['in_adminid']; ?>&hash=<?php echo $_COOKIE['in_adminpassword']; ?>');">删除</a></td>
</tr>
<?php
    }
    }
?>
</table>
</div>


<?php
}
function EditBoard($Arr, $url, $arrname)
{
    $in_adminname = $Arr[0];
    $in_islock = $Arr[1];
    $in_permission = $Arr[2]; 
?>
<div class="container">
<script type="text/javascript">parent.document.title = 'EarCMS Board 管理中心 - 系统 - <?php echo $arrname; ?>用户';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='系统&nbsp;&raquo;&nbsp;<?php echo $arrname; ?>用户';</script>
<div class="floattop"><div class="itemtitle"><h3><?php echo $arrname; ?>用户</h3><ul class="tab1">
<li><a href="?iframe=admin"><span>系统用户</span></a></li>
<?php if ($_GET['action'] == "add") {  ?> <li class="current"><?php } else {  ?><li><?php }?><a href="?iframe=admin&action=add"><span>新增用户</span></a></li>
</ul></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<form action="<?php echo $url; ?>" method="post" name="form">
<input type="hidden" name="hash" value="<?php echo $_COOKIE['in_adminpassword']; ?>"/>
<tr><th colspan="15" class="partition"><?php echo $arrname; ?>用户</th></tr>
<tr><td colspan="2" class="td27">登录帐号:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo $in_adminname; ?>" name="in_adminname" id="in_adminname"></td></tr>
<tr><td colspan="2" class="td27">登录密码:</td></tr>
<tr><td class="vtop rowform"><input type="password" class="txt" name="in_adminpassword" id="in_adminpassword"></td><td class="vtop tips2"><?php if ($_GET['action'] == "edit") {  "不修改请留空"; } ?></td></tr>
<tr><td colspan="2" class="td27">确认密码:</td></tr>
<tr><td class="vtop rowform"><input type="password" class="txt" name="in_adminpassword1" id="in_adminpassword1"></td></tr>
<tr><td colspan="2" class="td27">权限设置:</td></tr>
<tr>
<td class="vtop"><ul>
<?php if (ergodic_array($in_permission, 1)) {  ?><li class="checked"><?php } else {  ?><li><?php }?><input class="checkbox" type="checkbox" name="in_permission[]" id="value1" value="1"<?php if (ergodic_array($in_permission, 1)) { echo " checked"; } ?>><label for="value1">首页</label></li>
<?php if (ergodic_array($in_permission, 2)) {  ?><li class="checked"><?php } else {  ?><li><?php }?><input class="checkbox" type="checkbox" name="in_permission[]" id="value2" value="2"<?php if (ergodic_array($in_permission, 2)) { echo " checked"; } ?>><label for="value2">全局</label></li>
<?php if (ergodic_array($in_permission, 3)) {  ?><li class="checked"><?php } else {  ?><li><?php }?><input class="checkbox" type="checkbox" name="in_permission[]" id="value3" value="3"<?php if (ergodic_array($in_permission, 3)) { echo " checked"; } ?>><label for="value3">应用</label></li>
<?php if (ergodic_array($in_permission, 4)) {  ?><li class="checked"><?php } else {  ?><li><?php }?><input class="checkbox" type="checkbox" name="in_permission[]" id="value4" value="4"<?php if (ergodic_array($in_permission, 4)) { echo " checked"; } ?>><label for="value4">用户</label></li>
<?php if (ergodic_array($in_permission, 5)) {  ?><li class="checked"><?php } else {  ?><li><?php }?><input class="checkbox" type="checkbox" name="in_permission[]" id="value5" value="5"<?php if (ergodic_array($in_permission, 5)) { echo " checked"; } ?>><label for="value5">工具</label></li>
<?php if (ergodic_array($in_permission, 6)) {  ?><li class="checked"><?php } else {  ?><li><?php }?><input class="checkbox" type="checkbox" name="in_permission[]" id="value6" value="6"<?php if (ergodic_array($in_permission, 6)) { echo " checked"; } ?>><label for="value6">系统</label></li>
<?php if (ergodic_array($in_permission, 7)) {  ?><li class="checked"><?php } else {  ?><li><?php }?><input class="checkbox" type="checkbox" name="in_permission[]" id="value7" value="7"<?php if (ergodic_array($in_permission, 7)) { echo " checked"; } ?>><label for="value7">云平台</label></li>
</ul></td>
<td class="vtop"><select name="in_islock" class="ps">
<option value="0"<?php if ($in_islock == 0) { echo " selected"; } ?>>激活状态</option>
<option value="1"<?php if ($in_islock == 1) { echo " selected"; } ?>>锁定状态</option>
</select></td>
</tr>
<tr><td colspan="15"><div class="fixsel"><input type="submit" class="btn" onclick="return CheckForm();" value="提交" /></div></td></tr>
</form>
</table>
</div>



<?php
}
function SaveEdit()
{
    global $db;
    if (!submitcheck('hash', 1)) {
        ShowMessage("表单来路不明，无法提交！", $_SERVER['PHP_SELF'], "infotitle3", 3000, 1);
    }
    $in_adminid = intval(SafeRequest("in_adminid", "get"));
    $in_adminname = SafeRequest("in_adminname", "post");
    $in_adminpassword = SafeRequest("in_adminpassword", "post");
    $in_adminpassword1 = SafeRequest("in_adminpassword1", "post");
    $in_islock = SafeRequest("in_islock", "post");
    $in_permission = RequestBox("in_permission");
    if ($in_adminpassword !== $in_adminpassword1) {
        ShowMessage("编辑失败，两次密码填写不一致！", "history.back(1);", "infotitle3", 3000, 2);
    }
    if ($db->getone("select in_adminid from " . tname('admin') . " where in_adminid<>" . $in_adminid . " and in_adminname='" . $in_adminname . "'")) {
        ShowMessage("编辑出错，该帐号已经存在！", "history.back(1);", "infotitle3", 3000, 2);
    }
    if (empty($in_adminpassword1)) {
        $sql = "update " . tname('admin') . " set in_adminname='" . $in_adminname . "',in_permission='" . $in_permission . "',in_islock=" . $in_islock . " where in_adminid=" . $in_adminid;
    } else {
        $sql = "update " . tname('admin') . " set in_adminpassword='" . md5($in_adminpassword) . "',in_adminname='" . $in_adminname . "',in_permission='" . $in_permission . "',in_islock=" . $in_islock . " where in_adminid=" . $in_adminid;
    }
    $db->query($sql);
    ShowMessage("恭喜您，系统用户编辑成功！重新登录后生效！", $_SERVER['HTTP_REFERER'], "infotitle2", 1000, 1);
}
function Edit()
{
    global $db;
    $in_adminid = intval(SafeRequest("in_adminid", "get"));
    $sql = "select * from " . tname('admin') . " where in_adminid=" . $in_adminid;
    if ($row = $db->getrow($sql)) {
        $Arr = array($row['in_adminname'], $row['in_islock'], $row['in_permission']);
    }
    EditBoard($Arr, "?iframe=admin&action=saveedit&in_adminid=" . $in_adminid, "编辑");
}
function Del()
{
    global $db;
    if (!submitcheck('hash', -1)) {
        ShowMessage("链接来路不明，无法提交！", $_SERVER['PHP_SELF'], "infotitle3", 3000, 1);
    }
    $in_adminid = intval(SafeRequest("in_adminid", "get"));
    if ($in_adminid == 1) {
        ShowMessage("抱歉，默认帐号不允许删除！", "?iframe=admin", "infotitle3", 3000, 1);
    }
    $sql = "delete from " . tname('admin') . " where in_adminid=" . $in_adminid;
    if ($db->query($sql)) {
        ShowMessage("恭喜您，系统用户删除成功！", "?iframe=admin", "infotitle2", 3000, 1);
    }
}
function SaveAdd()
{
    global $db;
    if (!submitcheck('hash', 1)) {
        ShowMessage("表单来路不明，无法提交！", $_SERVER['PHP_SELF'], "infotitle3", 3000, 1);
    }
    $in_adminname = SafeRequest("in_adminname", "post");
    $in_adminpassword = SafeRequest("in_adminpassword", "post");
    $in_adminpassword1 = SafeRequest("in_adminpassword1", "post");
    $in_islock = SafeRequest("in_islock", "post");
    $in_permission = RequestBox("in_permission");
    if (empty($in_adminpassword) || $in_adminpassword !== $in_adminpassword1) {
        ShowMessage("新增失败，密码为空或两次密码填写不一致！", "history.back(1);", "infotitle3", 3000, 2);
    }
    if ($db->getone("select in_adminid from " . tname('admin') . " where in_adminname='" . $in_adminname . "'")) {
        ShowMessage("新增出错，该帐号已经存在！", "history.back(1);", "infotitle3", 3000, 2);
    } else {
        $sql = "Insert " . tname('admin') . " (in_adminname,in_adminpassword,in_loginnum,in_islock,in_permission) values ('" . $in_adminname . "','" . md5($in_adminpassword1) . "',0," . $in_islock . ",'" . $in_permission . "')";
        if ($db->query($sql)) {
            ShowMessage("恭喜您，系统用户新增成功！", "?iframe=admin", "infotitle2", 1000, 1);
        } else {
            ShowMessage("新增出错，系统用户新增失败！", "?iframe=admin", "infotitle3", 3000, 1);
        }
    }
}
function Add()
{
    $Arr = array("", "", "");
    EditBoard($Arr, "?iframe=admin&action=saveadd", "新增");
}
function IsLock()
{
    global $db;
    if (!submitcheck('hash', -1)) {
        ShowMessage("链接来路不明，无法提交！", $_SERVER['PHP_SELF'], "infotitle3", 3000, 1);
    }
    $in_adminid = intval(SafeRequest("in_adminid", "get"));
    $in_islock = intval(SafeRequest("in_islock", "get"));
    $sql = "update " . tname('admin') . " set in_islock=" . $in_islock . " where in_adminid=" . $in_adminid;
    if ($db->query($sql)) {
        ShowMessage("恭喜您，状态切换成功！", "?iframe=admin", "infotitle2", 1000, 1);
    }
}