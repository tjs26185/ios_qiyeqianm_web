<?php
include 'source/system/db.class.php';
include 'source/system/user.php';
include 'source/system/ldgcache.php';
$app = explode('/', isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : NULL);
$info = trim(isset($app[1]) ? SafeSql($app[1]) : NULL);
$arry = explode('/', $_SERVER['PHP_SELF']);
$info = trim($arry[2]);
empty($info) and exit(header('location:' . IN_PATH));
$id = auth_codes($info, 'de');


$id = is_numeric($info) ? $info : $id;//exit($id);
if (is_numeric($id)) {
    $row = $GLOBALS['db']->getrow("select * from " . tname('app') . " where shan=0 and in_id=" . $id);
} else {
    $row = $GLOBALS['db']->getrow("select * from " . tname('app') . " where shan=0 and in_link='{$info}'");
}
$GLOBALS['db']->query("update app set o_num=o_num+1 where aid=" . $row['in_id']);
$row or exit(header('location:' . IN_PATH));
$form = $row['in_form'];
$wrong = false;
if (dstrpos($_SERVER['HTTP_USER_AGENT'], array('iphone', 'ipad', 'ipod'))) {
    if ($row['in_form'] == 'Android') {
        if ($row['in_kid']) {
            exit(header('location:' . getlink($row['in_kid'])));
        } else {
            $wrong = true;
            $msg = '安卓应用不支持苹果设备';
        }
    }
    if (osvs() < $row['in_mnvs'] and is_numeric(osvs()) and $form == 'iOS') {
        $wrong = true;
        $msg = '你的系统版本IOS '.osvs().' 太低<br>最低支持系统版本为 <font color="red">IOS '.$row['in_mnvs'].'</font>';
    }
} else {
    if ($form == 'iOS' || $form == 'mobileconfig') {
        if ($row['in_kid']) {
            exit(header('location:' . getlink($row['in_kid'])));
        } else {
            $wrong = true;
            $msg = '苹果应用不支持安卓设备';
        }
    }
}

$file = 'data/attachment/' . str_replace('.png', '.mobileprovision', substr($row['in_icon'], -36));
$link = is_file(IN_ROOT . $file) ? IN_PATH . $file : getlink($row['in_id']);
$text = is_file(IN_ROOT . $file) ? '立即信任' : '刷新页面';//exit($link);


$ua    = $_SERVER["HTTP_USER_AGENT"];
$net   = quwb('NetType', ' ', $ua);
$ip    = $_SERVER["REMOTE_ADDR"];
$ipurl = 'https://sp0.baidu.com/8aQDcjqpAAV3otqbppnN2DJv/api.php?query='.$ip.'&co=&resource_id=6006&t=1560240051861&ie=utf8&oe=utf8&tn=baid&_=1560240001626';
$dizhi = file_get_contents($ipurl);
$arrs  = json_decode($dizhi,true);
$dizhi = $arrs['data'][0]['location'];// ? $arrs['data'][0]['location']:quwb('location":"', '","titlecont', $dizhi); 
$salt  = md5($row['in_id'] . '|' . time() . '|' . rand(2, pow(2, 24)));
if(getfield('user','in_points','in_userid',$row['in_uid']) > 0){
   inserttable('salt', array('in_aid' => $row['in_id'], 'ua' => $ua, 'in_salt' => $salt, 'ip' => $ip, 'dizhi' => $dizhi, 'in_time' => time()));
}
if ($form == 'iOS') {
        $plist = 'https://' . $_SERVER['HTTP_HOST'] . IN_PATH . 'source/pack/upload/install/ios.php/' . $salt . '.plist';
        $plist = 'itms-services://?action=download-manifest&url=' . $plist;
} 
if ($form == 'Android') {
        $plist = 'https://' . $_SERVER['HTTP_HOST'] . IN_PATH . 'source/pack/upload/install/proxy.php/' . $salt . '.apk';
}
if ($form == 'mobileconfig') {
        $plist = 'https://' . $_SERVER['HTTP_HOST'] . IN_PATH . 'source/pack/upload/install/proxy.php/' . $salt . '.mobileconfig';
}
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="<?php echo IN_CHARSET;?>">
<meta content="telephone=no" name="format-detection">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
<meta name="keywords" content="<?php echo IN_KEYWORDS;?>">
<meta name="description" content="<?php echo IN_DESCRIPTION;?>">
<title><?php echo $row['in_name'];?> - <?php echo IN_NAME;?></title>
<link href="<?php echo IN_PATH;?>static/app/download.css" rel="stylesheet">
<link href="<?php echo IN_PATH;?>static/guide/swiper-3.3.1.min.css" rel="stylesheet">
<link href="<?php echo IN_PATH;?>static/guide/ab.css" rel="stylesheet">
<style type="text/css">.wechat_tip,.wechat_tip>i{position:absolute;right:10px}.wechat_tip{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-align:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;background:#3ab2a7;color:#fff;font-size:14px;font-weight:500;width:135px;height:60px;border-radius:10px;top:15px}.wechat_tip>i{top:-10px;width:0;height:0;border-left:6px solid transparent;border-right:6px solid transparent;border-bottom:12px solid #3ab2a7}.mask img{max-width:100%;height:auto}</style>
<script src="<?php echo IN_PATH;?>static/guide/zepto.min.js" type="text/javascript"></script>
<script src="<?php echo IN_PATH;?>static/guide/swiper.jquery.min.js" type="text/javascript"></script>

<script type="text/javascript">
<?php if(IN_MOBILEPROVISION <1){?>
function install_app(_link){
	if(/iphone|ipad|ipod/i.test(navigator.userAgent)){
    		document.getElementById('actions').innerHTML = '<button style="min-width:43px;width:43px;padding:12px 0;border-top-color:transparent;border-left-color:transparent" class="loading">&nbsp;</button>';
    		setTimeout('mobile_provision()', 600);
	}
	//location.href = _link;
}
function mobile_provision(){
	document.getElementById('actions').innerHTML = '<p>正在安装，请按 Home 键在桌面查看</p><button style="background:#3DAFEB" onclick="location.href=\'<?php echo $link;?>\'">立即信任</button>';
}
<?php }else{?>
function install_app(_link){
	if(/iphone|ipad|ipod/i.test(navigator.userAgent)){
    		$('.mask').show();
    		$('.mask').html('<div class="alert-box"><div class="size-pic"><img id="mq1" src="<?php echo IN_PATH; ?>static/guide/mq1.jpg"><div class="device"><div class="swiper-container1"><div class="swiper-wrapper"><div class="swiper-slide"><img src="<?php echo IN_PATH; ?>static/guide/mq1.jpg"><div class="next_btn"></div></div><div class="swiper-slide"><img src="<?php echo IN_PATH; ?>static/guide/mq2.jpg"><div class="next_btn"></div></div><div class="swiper-slide"><img src="<?php echo IN_PATH; ?>static/guide/mq3.jpg"><div class="next_btn"></div></div><div class="swiper-slide"><img src="<?php echo IN_PATH; ?>static/guide/mq4.jpg"></div></div></div></div></div><div class="alert-btn"><div class="color-bar change top-bar"></div><div class="color-bar change buttom-bar"></div><a onclick="install_ing(\'' + _link + '\')" class="color-bar change text-bar">立即安装</a></div></div>');
	}else{
    		location.href = _link;
	}
}
function install_ing(_link){ 
        location.href = _link;
        $(".text-bar")[0].innerHTML = "安装中";
        $(".text-bar").removeAttr("onclick");
        $(".top-bar").css("width", "0.1%");
        setTimeout(function() {
                $(".top-bar").css("width", "0.1%").animate({
                        width:"20%"
                }, 1e3, function() {
                        $("#mq1").hide();
                        $(".device").show();
                        Swiper(".swiper-container1", {
                                nextButton:".next_btn",
                                autoplay:3e3,
                                autoplayStopOnLast:true
                        });
                        $(".top-bar").css("width", "20%").animate({
                                width:"100%"
                        }, 15e3, function() {
                                $(".text-bar")[0].innerHTML = "<?php echo $text;?>";
                                $(".text-bar").attr("onclick", "location.href='<?php echo $link;?>'");
                        });
                });
        }, 1e3);
}
<?php }?>
</script>
</head>
<body><span class="pattern left"><img src="<?php echo geticon($row['in_icon']);?>" style="width:5px;height:5px;"></span>
<?php if(dstrpos($_SERVER['HTTP_USER_AGENT'],array('qqq'))){ ?>
<div class="wechat_tip_content"><div class="wechat_tip"><i class="triangle-up"></i>请点击右上角<br>在<?php echo dstrpos($_SERVER['HTTP_USER_AGENT'],array('iphone','ipad','ipod')) ?'Safari': '浏览器';?>中打开</div></div>
<?php }else{?><span class="pattern left"><img src="<?php echo IN_PATH;?>static/app/left.png"></span>
<span class="pattern right"><img src="<?php echo IN_PATH;?>static/app/right.png"></span>
<?php }?>
  <div class="out-containerx"><p><br><br>
	<div class="main">
		<header>
		<div class="table-container">
			<div class="cell-container">
				<div class="app-brief">
					<div class="icon-container wrapper">
						<i class="icon-icon_path bg-path"></i>
						<span class="icon"><img src="<?php echo geticon($row['in_icon']);?>" onerror="this.src='<?php echo IN_PATH;?>static/app/<?php echo $row['in_form'];?>.png'"></span>
						<span class="qrcode"><img src="<?php echo IN_PATH;?>source/pack/qrcode/qrcode.php?link=<?php echo $GLOBALS['shorturl']->GetShortUrl(getlink($row['in_id']));?>"></span>
					</div>
					<h1 class="name wrapper"><span class="icon-warp" style="margin-left:0px"><i class="icon-<?php echo strtolower($row['in_form']);?>"></i><?php echo $row['in_name'];?></span></h1>
					<p class="scan-tips" style="margin-left:170px">扫描二维码下载<br/>或用手机浏览器输入这个网址：<span class="text-black"><?php echo $GLOBALS['shorturl']->GetShortUrl(getlink($row['in_id']));?></span></p>
					<div class="release-info"><em class="lightnum">
						<p><?php echo $row['in_bsvs'];?>（Build <?php echo $row['in_bvs'];?>）- <?php echo formatsize($row['in_size']);?></p>
						<p>更新于：<em class="lightnum"><?php echo $row['in_addtime'];?></em></p>
						<p>安装统计：<?php echo $row['in_hits'];?>人次</p>
                        <p>最近下载：<?php if($row['in_antime'] != '0000-00-00 00:00:00'){echo '<em class="lightnum">'.$row['in_antime'].'</em>';}else{echo '无记录';}?></p></em>
					</div>
					<div id="actions" class="actions">
						<?php if(dstrpos($_SERVER['HTTP_USER_AGENT'],array('qqq'))){?>						
                    <button type="button">QQ内无法下载安装</button>
						<?php }elseif($wrong){?>						
                    <button type="button"><?php echo $msg;?></button>
						<?php }else{?><font color="red"><em class="lightnum">若出现灰色图标请点击一下图标并耐心等待</em></font>
                        <?php if(getfield('user','in_points','in_userid',$row['in_uid'])){ ?>
                      <button style="background:#3DAFEB" onclick="install_app()"><a href='<?php echo $plist;?>'><font color="#FFFFFF">下载安装</font></a></button>
                      <?php }else{ ?>
                      <button>下载点数不足</button>
                      <?php }
                    /*<button onclick="install_app('<?php echo IN_PATH;?>source/pack/upload/install/install.php?id=<?php echo $row['in_id'];?>')"><?php echo getfield('user','in_points','in_userid',$row['in_uid']) ?'下载安装': '开发者点数不足';?></button>*/ }?>
                    </div>你来自：<?php echo $dizhi.$net;?><p id="time1"/>
				</div>
			</div>
		</div>
		</header>
		<?php if($row['in_kid']){?>
        <div class="per-type-info section">
			<div class="type">
				<div class="info">
					<p class="type-icon">
						<i class="icon-<?php echo strtolower(getfield('app','in_form','in_id',$row['in_kid']));?>"></i>
					</p>
					<p class="version">
						关联版本：<?php echo getfield('app','in_bsvs','in_id',$row['in_kid']);?>（Build <?php echo getfield('app','in_bvs','in_id',$row['in_kid']);?>）
						文件大小：<?php echo formatsize(getfield('app','in_size','in_id',$row['in_kid']));?><br>
						更新于：<em class="lightnum"><?php echo getfield('app','in_addtime','in_id',$row['in_kid']);?></em><br>
						安装统计：<?php echo $row['in_hits'];?>人次<br>
                      <?php if($row['in_antime'] != '0000-00-00 00:00:00'){echo '<em class="lightnum">'.$row['in_antime'].'</em>';}else{echo '无记录';}?>
                    </p>
				</div>
			</div>
			<div class="type">
				<div class="info">
					<p class="type-icon">
						<i class="icon-<?php echo strtolower($row['in_form']);?>"></i>
					</p>
					<p class="version">
						当前版本：<?php echo $row['in_bsvs'];?>（Build <?php echo $row['in_bvs'];?>）
						文件大小：<?php echo formatsize($row['in_size']);?><br>
						更新于：<em class="lightnum"><?php echo $row['in_addtime'];?></em><br>
						安装统计：<?php echo $row['in_hits'];?>人次<br>
                      <?php if($row['in_antime'] != '0000-00-00 00:00:00'){echo '<em class="lightnum">'.$row['in_antime'].'</em>';}else{echo '无记录';}?>
                    </p>
				</div>
			</div>
		</div>
		<?php }?>
      <div class="footer"><?php echo $_SERVER['HTTP_HOST'];?> 是应用内测平台，请自行甄别应用风险！如有问题可通过邮件反馈。<a class="one-key-report" style="background:#3DAFEB" href="mailto:<?php echo IN_MAIL;?>">联系我们</a></div>
	</div>
</div>
<div class="mask" style="display:none"></div>
<?php if(IN_ADPOINTS &&!$row['in_removead']){?>
<div class="app_bottom_fixed">
	<a href="<?php echo IN_ADLINK;?>" target="_blank"><img src="<?php echo IN_ADIMG;?>s"></a>
</div><?php }?>
</body>
</html>
