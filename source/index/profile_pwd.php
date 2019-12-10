<?php
 if(!defined('IN_ROOT')){exit('Access denied');};echo '';if(!$GLOBALS['userlogined']){exit(header('location:'.IN_PATH.'index.php/login'));}
 $ron = $GLOBALS['db']->getrow("select * from " . tname('user') . " where in_userid=".$GLOBALS['erduo_in_userid']);
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="<?php echo IN_CHARSET; ?>">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
<title>修改密码 - <?php echo IN_NAME; ?></title>
<link href="<?php echo IN_PATH; ?>static/index/application.css" rel="stylesheet">
<link href="<?php echo IN_PATH; ?>static/index/user_info.css" rel="stylesheet">
<link href="<?php echo IN_PATH; ?>static/index/user_pwd.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/confirm-lib.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/upload/avatar.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/index/profile.js"></script>
<script type="text/javascript">
var in_path = '<?php echo IN_PATH; ?>';
var in_upw = '<?php echo $GLOBALS['erduo_in_userpassword']; ?>';
var in_uid = <?php echo $GLOBALS['erduo_in_userid']; ?>;
</script>
</head>
<body>
<header>
<div class="brand">
	<a href="<?php echo IN_PATH; ?>"><i class="icon-" style="font-size:<?php echo checkmobile() ?25 : 35; ?>px;font-weight:bold"><?php echo IN_NAME;//$_SERVER['HTTP_HOST'];?></i></a>
</div>
<nav>
	<ul><li><a id="signoutLink" href="<?php echo IN_PATH.'index.php/apps'; ?>">我的应用</a></li></ul>
</nav>
</header>
<div class="user-info form-container">
	<form class="avatar">
		<label class="img-container">
			<input type="file" id="a_vatar" onchange="upload_a_vatar()" style="display:none">
			<img src="<?php echo getavatar($GLOBALS['erduo_in_userid']); ?>" width="120" height="120">
			<i class="icon-upload-cloud" onclick="$('#a_vatar').click()"></i>
		</label>
	</form>
	<form class="auto-save-form">
		<div class="form-group floated">
			<span class="name"><?php echo $ron['in_nick'];//substr($GLOBALS['erduo_in_username'],0,strpos($GLOBALS['erduo_in_username'],'@')); ?></span>
		</div>
	</form>
	<div class="user_pro_tabs">
		<div class="container">
			<div class="row">
				<div class="col-4">
					<a href="<?php echo IN_PATH.'index.php/profile_info'; ?>"><span><i class="icon icon-user"></i></span>个人资料</a>
				</div>
				<div class="col-4">
					<a href="<?php echo IN_PATH.'index.php/profile_pwd'; ?>" class="active"><span><i class="icon icon-lock"></i></span>修改密码</a>
				</div>
				<div class="col-4">
					<a href="<?php echo IN_PATH.'index.php/profile_verify'; ?>"><span><i class="icon icon-badge"></i></span>实名认证</a>
				</div>
			</div>
		</div>
	</div>
	<div class="form-inner">
		<form class="edit_user">
			<div class="alert-warning"><ul style="text-align:left;display:none" id="user_tips"></ul></div>
			<div class="form-group">
				<input placeholder="当前密码" type="password" id="old_pwd">
			</div>
			<div class="form-group">
				<input placeholder="新密码" type="password" id="new_pwd">
			</div>
			<div class="form-group">
				<input placeholder="确认密码" type="password" id="rnew_pwd">
			</div>
			<div class="form-group action">
				<input type="button" onclick="profile_pwd()" value="更新密码" class="btn btn-primary">
			</div>
		</form>
	</div>
</div>
</body>
</html>