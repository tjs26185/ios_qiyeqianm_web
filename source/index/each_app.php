<?php
if (!defined('IN_ROOT')) {
    exit('Access denied');
}
if (!$GLOBALS['userlogined']) {
    exit(header('location:' . IN_PATH . 'index.php/login'));
}
$app = explode('/', $_SERVER['PATH_INFO']);
$id = intval(isset($app[2]) ? $app[2] : NULL);
$row = $GLOBALS['db']->getrow("select * from " . tname('app') . " where in_uid=" . $GLOBALS['erduo_in_userid'] . " and in_id=" . $id);
$row or exit(header('location:' . IN_PATH));
$form = $row['in_form'] == 'Android' ? 'iOS' : 'Android';
$query = $GLOBALS['db']->query("select * from " . tname('app') . " where in_form='" . $form . "' and in_kid=0 and in_uid=" . $GLOBALS['erduo_in_userid'] . " order by in_addtime desc");
$ron = $GLOBALS['db']->getrow("select * from " . tname('user') . " where in_userid=".$GLOBALS['erduo_in_userid']);
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="x-ua-compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<meta charset="<?php echo IN_CHARSET;?>">
<title><?php echo $row['in_name'];?> - 应用合并 - <?php echo IN_NAME;?></title>
<link href="<?php echo IN_PATH;?>static/index/icons.css" rel="stylesheet">
<link href="<?php echo IN_PATH;?>static/index/bootstrap.css" rel="stylesheet">
<link href="<?php echo IN_PATH;?>static/index/manage.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo IN_PATH;?>static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH;?>static/pack/layer/confirm-lib.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH;?>static/index/uploadify.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH;?>static/index/profile.js"></script>
<script type="text/javascript">
var in_path = '<?php echo IN_PATH;?>';
var in_time = '<?php echo $GLOBALS['erduo_in_userid'].'-'.time();?>';
var in_upw = '<?php echo $GLOBALS['erduo_in_userpassword'];?>';
var in_uid = <?php echo $GLOBALS['erduo_in_userid'];?>;
var in_id = <?php echo $id;?>;
var in_size = <?php echo intval(ini_get('upload_max_filesize'));?>;
var remote = {'open':'<?php echo IN_REMOTE;?>','dir':'<?php echo IN_REMOTEPK;?>','version':'<?php echo version_compare(PHP_VERSION,'5.5.0');?>'};
</script>
</head>
<body>
<div class="navbar-wrapper ng-scope">
	<div class="ng-scope">
		<div class="navbar-header-wrap">
			<div class="middle-wrapper">
				<sidebar class="avatar-dropdown">
				<img class="img-circle" src="<?php echo getavatar($GLOBALS['erduo_in_userid']);?>">
				<div class="name"><span class="ng-binding"><?php echo $ron['in_nick'];//substr($GLOBALS['erduo_in_username'],0,strpos($GLOBALS['erduo_in_username'],'@'));?></span></div>
				<div class="email" style="width:200%"><span class="ng-binding"><?php echo $GLOBALS['erduo_in_username'];?></span></div>
				<div class="dropdown-menus">
					<ul>
						<li><a href="<?php echo IN_PATH.'index.php/profile_info';?>" class="ng-binding">个人资料</a></li>
						<li><a href="<?php echo IN_PATH.'index.php/profile_pwd';?>">修改密码</a></li>
						<li><a href="<?php echo IN_PATH.'index.php/profile_verify';?>">实名认证</a></li>
						<li><a href="<?php echo IN_PATH.'index.php/logout';?>" class="ng-binding">退出</a></li>
					</ul>
				</div>
				</sidebar>
				<nav>
				<h1 class="navbar-title logo"><span onclick="location.href='<?php echo IN_PATH;?>'"><?php echo IN_NAME;//$_SERVER['HTTP_HOST'];?></span></h1>
				<i class="icon-angle-right"></i>
				<div class="navbar-title primary-title"><a href="<?php echo IN_PATH.'index.php/home';?>" class="ng-binding">我的应用</a></div>
				<i class="icon-angle-right"></i>
				<div class="navbar-title secondary-title"><?php echo $row['in_name'];?></div>
				</nav>
			</div>
		</div>
	</div>
</div>
<div class="ng-scope" id="dialog-uploadify" style="display:none">
	<div class="upload-modal-mask ng-scope"></div>
	<div class="upload-modal-container ng-scope">
		<div class="flip-container flip">
			<div class="modal-backend plane-ready upload-modal">
				<div class="btn-close" onclick="location.reload()"><i class="icon-cross"></i></div>
				<div class="plane-wrapper">
					<img class="plane" src="<?php echo IN_PATH;?>static/index/plane.svg">
					<div class="rotate-container">
						<img class="propeller" src="<?php echo IN_PATH;?>static/index/propeller.svg">
					</div>
				</div>
				<div class="progress-container">
					<p class="speed ng-binding" id="speed-uploadify"></p>
					<p class="turbo-upload"></p>
					<div class="progress">
						<div class="growing" style="width:0%"></div>
					</div>
				</div>
				<div class="redirect-tips ng-binding" style="display:none">正在解析应用，请稍等...</div>
			</div>
		</div>
	</div>
</div>
<section class="ng-scope">
<div class="page-app app-security">
	<div class="banner">
		<div class="middle-wrapper clearfix">
			<div class="pull-left appicon">
				<img class="ng-isolate-scope" src="<?php echo geticon($row['in_icon']);?>" onerror="this.src='<?php echo IN_PATH;?>static/app/<?php echo $row['in_form'];?>.png'" width="100" height="100">
			</div>
			<div class="badges">
				<span class="short"><?php echo $GLOBALS['shorturl']->GetShortUrl(getlink($row['in_id']));?></span>
				<span><i class="icon-cloud-download"></i><b class="ng-binding"><?php echo $row['in_hits'];?></b></span>
				<span class="bundleid ng-binding">BundleID<b class="ng-binding">&nbsp;&nbsp;<?php echo $row['in_bid'];?></b></span>
				<span class="version ng-scope">兼容&nbsp;<?php echo $row['in_form']; ?>&nbsp;<?php echo $row['in_mnvs']; ?>&nbsp;或更高版本</span>
				<span class="version ng-scope" style="border:1px solid red;"><a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo QQHAO;?>&site=qq&menu=yes" target="view_window"><font color="red">联系站长</font></a></span>
			</div>
			<div class="actions">
				<input type="file" id="upload_app" onchange="upload_app()" style="display:none">
				<div class="upload in" onclick="$('#upload_app').click()"><i class="icon-upload-cloud2"></i> 上传新版本</div>
				<a class="download ng-binding" href="<?php echo $GLOBALS['shorturl']->GetShortUrl(getlink($row['in_id']));?>" target="_blank"><i class="icon-eye"></i> 预览</a>
			</div>
			<div class="tabs-container">
				<ul class="list-inline">
					<li><a class="ng-binding" href="<?php echo IN_PATH;?>index.php/profile_app/<?php echo $row['in_id'];?>"><i class="icon-file"></i>基本信息</a></li>
					<?php if(IN_SIGN &&$row['in_form'] != 'mobileconfig'){ ?>		
					<li><a class="ng-binding active" style="border-left:1px solid"><i class="icon-combo"></i>应用合并</a></li>
					<?php } if(IN_SIGN &&$row['in_form'] == 'iOS'){?>					
                    <li><a class="ng-binding" style="border-left:1px solid" href="<?php echo IN_PATH;?>index.php/sign_app/<?php echo $row['in_id'];?>"><i class="icon-device"></i>企业签名</a></li>
					<?php }?>
                  	<li><a href="<?php echo IN_PATH.'index.php/certificate';?>" class="ng-binding" style="border-left:1px solid"><i class="icon-file"></i>证书检测</a></li>
              </ul>
			</div>
		</div>
	</div>
	<?php if($GLOBALS['erduo_in_qq'] == '136245992'){ echo '我操你妈'; }?>
    <div class="ng-scope">
		<div class="apps-app-combo page-tabcontent ng-scope">
			<div class="middle-wrapper">
				<?php if($row['in_kid']){?>
                  <div class="request-wrapper">
					<p class="lead text-center ng-scope">已经与 <b><?php echo getfield('app','in_name','in_id',$row['in_kid']);?></b> 合并</p>
					<table>
					<tr>
						<td><span class="type"><?php echo getfield('app','in_form','in_id',$row['in_kid']);?></span></td>
						<td></td>
						<td><span class="type"><?php echo $row['in_form'];?></span></td>
					</tr>
					<tr>
						<td><div class="icon"><img class="ng-isolate-scope" src="<?php echo geticon(getfield('app','in_icon','in_id',$row['in_kid']));?>" onerror="this.src='<?php echo IN_PATH;?>static/app/<?php echo getfield('app','in_form','in_id',$row['in_kid']);?>.png'"></div></td>
						<td><i class="icon-combo"></i></td>
						<td><div class="icon"><img class="ng-isolate-scope" src="<?php echo geticon($row['in_icon']);?>" onerror="this.src='<?php echo IN_PATH;?>static/app/<?php echo $row['in_form'];?>.png'"></div></td>
					</tr>
					<tr>
						<td colspan="3" class="actions"><a class="btn btn-link ng-scope" style="background:#3DAFEB;color:#fff" onclick="each_confirm()"><b>解除合并</b></a></td>
					</tr>
					</table>
				</div>
				<?php }else{ ?>
                <div class="icon-container text-center">
					<img width="128" class="ng-isolate-scope" src="<?php echo geticon($row['in_icon']);?>" onerror="this.src='<?php echo IN_PATH;?>static/app/<?php echo $row['in_form'];?>.png'">
				</div>
				<div class="apps-list">
					<div class="known-apps" style="text-align:center">
						<p class="lead ng-binding"><b>选择已有的应用进行合并</b></p>
						<div class="apps">
                        <?php while($rows = $GLOBALS['db']->fetch_array($query)){ ?>
                        <div class="app ng-scope" onclick="each_add(<?php echo $rows['in_id'];?>)"><div class="icon">
                        <img class="ng-isolate-scope" src="<?php echo geticon($rows['in_icon']);?>" onerror="this.src='<?php echo IN_PATH.'static/app/'.$rows['in_form'];?>.png'">
                        </div><p class="ng-binding"><?php echo $rows['in_name'].' [ '.$rows['in_id'].' ]';?></p></div>
                        <?php }?>	
                      </div>
					</div>
				</div>
			   <?php }?>
            </div>
		</div>
	</div>
</div>
</section>
<?php include 'source/index/bottom.php';?></body>
</html>