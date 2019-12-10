<?php if(!defined('IN_ROOT')){exit('Access denied');} ?>
<?php IN_SIGN or exit(header('location:'.IN_PATH)); 
$in_pay = empty($_COOKIE['in_adminid']) && $GLOBALS['userlogined'] && $GLOBALS['erduo_in_userid'] >2 ?1 : IN_PAY;
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="<?php echo IN_CHARSET;?>">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
<meta name="keywords" content="<?php echo IN_KEYWORDS;?>">
<meta name="description" content="<?php echo IN_DESCRIPTION;?>">
<title>签名价格 - <?php echo IN_NAME;?></title>
<link href="<?php echo IN_PATH;?>static/index/icons.css" rel="stylesheet">
<link href="<?php echo IN_PATH;?>static/index/bootstrap.css" rel="stylesheet">
<link href="<?php echo IN_PATH;?>static/index/main.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo IN_PATH;?>static/index/main.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH;?>static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH;?>static/pack/layer/lib.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH;?>static/index/lib.js"></script>
<script type="text/javascript">
var in_path = '<?php echo IN_PATH;?>';
var in_pay = <?php echo $in_pay;?>;
</script>
</head>
<body class="page-Pricing">
<nav class="navbar navbar-transparent" role="navigation">
<div class="navbar-header">
	<a class="navbar-brand" href="<?php echo IN_PATH;?>"><i class="icon-" style="font-size:<?php echo checkmobile() ?30 : 40;?>px;font-weight:bold"><?php echo IN_NAME;//$_SERVER['HTTP_HOST'];?></i></a>
</div>
<div class="collapse navbar-collapse navbar-ex1-collapse" ng-controller="NavbarController">
	<div class="dropdown">
		<div>
			<i class="icon-brace-left"></i>
			<ul class="navbar-bracket">
				<li><a href="<?php echo IN_PATH;?>">首页</a><i class="icon-comma"></i></li>
				<li><a href="<?php echo IN_PATH.'index.php/install';?>">分发价格</a><i class="icon-comma"></i></li>
				<?php if(IN_SIGN){ ?>
                <!--li><a href="<?php echo IN_PATH.'index.php/sign';?>">签名价格</a><i class="icon-comma"></i></li-->
                <?php } ?>
                <li><a href="<?php echo IN_PATH.'index.php/webview';?>">封装价格</a><i class="icon-comma"></i></li>
				<?php if($GLOBALS['userlogined']){ ?>				
                <li><a href="<?php echo IN_PATH.'index.php/home';?>">应用管理</a><i class="icon-comma"></i></li>
				<li class="signup"><a href="<?php echo IN_PATH.'index.php/logout';?>">退出</a></li>
				<?php }else{ ?>				
                <li><a href="<?php echo IN_PATH.'index.php/login';?>">立即登录</a><i class="icon-comma"></i></li>
				<li class="signup"><a href="<?php echo IN_PATH.'index.php/reg';?>">免费注册</a></li>
				<?php } ?>
            </ul>
			<i class="icon-brace-right"></i>
		</div>
	</div>
</div>
</nav>
<div class="menu-toggle">
	<i class="icon-menu"></i>
</div>
<menu>
<ul>
	<li><a href="<?php echo IN_PATH;?>">首页</a></li>
	<li><a href="<?php echo IN_PATH.'index.php/install';?>">分发价格</a></li>
	<?php if(IN_SIGN){ ?>
    <li><a href="<?php echo IN_PATH.'index.php/sign';?>">签名价格</a></li>
     <?php }?>
    <li><a href="<?php echo IN_PATH.'index.php/webview';?>">封装价格</a></li>
	<?php if($GLOBALS['userlogined']){ ?>	
    <li><a href="<?php echo IN_PATH.'index.php/home';?>">应用管理</a></li>
	<li><a href="<?php echo IN_PATH.'index.php/logout';?>">退出</a></li>
	<?php }else{ ?>
    <li><a href="<?php echo IN_PATH.'index.php/reg';?>">免费注册</a></li>
	<li><a href="<?php echo IN_PATH.'index.php/login';?>">立即登录</a></li>
	<?php }?>
</ul>
</menu>
<div id="root-packages">
	<div class="banner banner-packages">
		<h1>
		<div class="brackets">
			<i class="icon-brace-left"></i><span>企业签名</span><i class="icon-brace-right"></i>
		</div>
		<small>自动签名</small>
		</h1>
		<div class="pattern-bg"></div>
	</div>
	<div class="section packages-content">
		<h3>
		<div>选择密钥种类</div>
		<h3>
		<div>选择密钥种类</div>
		<small style="color:#1aa79a"><?php if(!$GLOBALS['userlogined']){echo '您登录后购买的密钥将显示在此处';}elseif(is_file(IN_ROOT.'./data/tmp/buy_key_'.$GLOBALS['erduo_in_userid'].'.txt')){echo '您最近购买的密钥为【<b style="color:#ec4242">'.file_get_contents(IN_ROOT.'./data/tmp/buy_key_'.$GLOBALS['erduo_in_userid'].'.txt').'</b>】，请及时保存或使用';}else{echo '您最近购买的密钥将显示在此处';}?>
        </small>
		</h3>
		</h3>
		<div class="package-cards-wrap">
			<div class="package-cards" id="package_content">
				<div class="package-card">
					<div class="package-header">
						<h2>包月</h2>
						<small>签名密钥</small>
					</div>
					<div class="package-content">
						<div>￥<?php echo IN_SIGN;?></div>
					</div>
					<div class="package-action">
						<button class="btn" onclick="buy(1)">购买</button>
					</div>
				</div>
				<div class="package-card active">
					<div class="package-header">
						<h2>包季</h2>
						<small>签名密钥</small>
					</div>
					<div class="package-content">
						<div class="package-badge">
							<div class="badge-wrap"><span>推荐</span><span class="arraw"></span></div>
						</div>
						<div>￥<?php echo IN_SIGN * 3;?></div>
					</div>
					<div class="package-action">
						<button class="btn" onclick="buy(2)">购买</button>
					</div>
				</div>
				<div class="package-card">
					<div class="package-header">
						<h2>包年</h2>
						<small>签名密钥</small>
					</div>
					<div class="package-content">
						<div>￥<?php echo IN_SIGN * 12;?></div>
					</div>
					<div class="package-action">
						<button class="btn" onclick="buy(3)">购买</button>
					</div>
				</div>
			</div>
		</div>
		<small>需线下付款购买，请联系&nbsp;<a href="mailto:<?php echo IN_MAIL;?>"><?php echo IN_MAIL;?></a></small>
	</div>
	<div class="section packages-cert">
		<div class="cert-header">
			<i class="icon icon-users"></i>
		</div>
		<div class="cret-row-wrap">
			<div class="cert-row">
				<div class="half text-right">
					<div class="cert-item">补签政策</div>
					<ul class="list-unstyled cert-list">
						<li><?php echo IN_RESIGN;?> 次/每月</li>
						<li>密钥叠加使用</li>
					</ul>
				</div>
				<div class="half text-left">
					<div class="cert-item">密钥价格</div>
					<ul class="list-unstyled cert-list">
						<li><?php echo IN_SIGN;?> 元/每月</li>
						<li>签约<?php echo $in_pay >1 ?'支付宝': '微信';?>支付</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<?php include 'source/index/faq.php';?></div>
<div class="dialog-mask" style="display:none"></div>
<div id="buy-confirm-wx" class="dialog buy-confirm" style="display:none">
	<header class="text-center">微信扫码支付</header>
    <div class="content"><center><img src="<?php echo IN_PATH;?>static/index/qq/wxsk.png"/><imgs id="qrcode"/></center></div>
	<header class="text-center">支付成功请联系QQ或微信<br>1920822424充值</header>
	<div class="actions text-center"><button class="btn btn-yellow" style="margin-bottom:10px" onclick="location.reload()">好的</button>
		<!--button class="btn btn-default" style="margin-bottom:10px" onclick="$('.dialog-mask').hide(),$('#buy-confirm-wx').hide()">放弃购买</button><button class="btn btn-yellow" style="margin-bottom:10px" onclick="location.reload()">购买成功，立即查看</button-->
	</div>
  </div>
<div id="buy-confirm-zfb" class="dialog buy-confirm" style="display:none">
	<header class="text-center">跳转到支付宝支付</header>
	<div class="actions text-center">
		<button class="btn btn-default" style="margin-bottom:10px" onclick="$('.dialog-mask').hide(),$('#buy-confirm-zfb').hide()">放弃购买</button><button class="btn btn-yellow" style="margin-bottom:10px">立即购买</button>
	</div>
</div>
<?php include 'source/index/bottom.php';?></body>
</html>

