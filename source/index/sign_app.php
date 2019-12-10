<?php
if (!defined('IN_ROOT')) {
    exit('Access denied');
}
if (!$GLOBALS['userlogined']) {
    exit(header('location:' . IN_PATH . 'index.php/login'));
}
$app = explode('/', $_SERVER['PATH_INFO']);
$id = intval(isset($app[2]) ? $app[2] : NULL);
$sname = $GLOBALS['db']->getone("select in_aname from " . tname('sign') . " where in_aid=".$id);
$row = $GLOBALS['db']->getrow("select * from " . tname('app') . " where in_uid=" . $GLOBALS['erduo_in_userid'] . " and in_id=" . $id);
$row and IN_SIGN and $row['in_form'] == 'iOS' or exit(header('location:' . IN_PATH));
$row['in_sign'] or $GLOBALS['db']->query("delete from " . tname('signlog') . " where in_aid=" . $id);
$status = $GLOBALS['db']->getone("select in_status from " . tname('signlog') . " where in_aid=" . $id);
$sign = $status ? $status > 1 ? 2 : '<b id="_listen" style="color:#ec4242">正在进行签名，请稍等...</b>' : '未签名';
$ssl = is_ssl() ? 'https://' : 'http://';
$ron = $GLOBALS['db']->getrow("select * from " . tname('user') . " where in_userid=".$GLOBALS['erduo_in_userid']);
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="x-ua-compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<meta charset="<?php echo IN_CHARSET; ?>">
<title><?php echo $row['in_name']; ?> - 企业签名 - <?php echo IN_NAME; ?></title>
<link href="<?php echo IN_PATH; ?>static/index/icons.css" rel="stylesheet">
<link href="<?php echo IN_PATH; ?>static/index/bootstrap.css" rel="stylesheet">
<link href="<?php echo IN_PATH; ?>static/index/manage.css" rel="stylesheet">
  <style>
.win { display: none; }
.mask-layer { position: fixed; width: 200%; height: 200%; opacity: 0.5; filter: alpha(opacity=50); background-color: black; z-index: 99998; top: 0px; left: 0px; }
.window-panel { position: fixed; z-index: 99999; top:25%; left: 50%; background-color: white; border-radius: 4px; }
.window-panel .title-panel { position: absolute; height: 36px; width: 30%; border-radius: 4px 4px 0 0; }
.window-panel .title { position: absolute; height: 36px; width: 30%; text-align: center; border-radius: 4px 4px 0 0; line-height: 36px; vertical-align: middle; background-color: whitesmoke; /*标题背景色*/ border-bottom: 1px solid rgb(233, 233, 233); z-index: 1; }
.window-panel h3 { font-size: 16px; margin: 0; }
.window-panel .close-btn { display: block; text-align: center; vertical-align: middle; position: absolute; width: 360px; height: 360px; line-height: 36px; right: 0px; text-decoration: none; font-size: 24px; color: black; background-color: #DBDBDB; border-radius: 2px; z-index: 1; }
.window-panel .close-btn:hover { background-color: #ccc; }
.window-panel .body-panel { position: absolute; width: 30%; top: 36px; border-radius: 0 0 4px 4px; z-index: 1;background: #fff;background-image: url(../images/wenli.png); }
.window-panel .body-panel.toast-panel{ position: absolute;color:#fff;background:rgba(0,0,0,0.3); }
.window-panel .content, .window-panel .btns { text-align: center; }
.window-panel .content { padding: 10px 10px 0px 10px; font-size: 16px; min-height: 40px; line-height: 22px; }
.window-panel .content.toast-content{padding:0;min-height:0;}
.window-panel .w-btn { display: inline-block; width: 100px; height: 26px; line-height: 26px; background-color: #DE5923; color: white; cursor: pointer; text-align: center; border-radius: 2px; text-decoration: none; margin: 0 10px 0px 10px; border: none; }
.window-panel .w-btn:hover { background-color: #DA3E00; }
.window-panel .w-btn:focus { outline: 0 none; }
</style>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/confirm-lib.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/index/uploadify.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/index/profile.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/index/sign.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/index/alert.js"></script>
<script type="text/javascript">
var in_path = '<?php echo IN_PATH; ?>';
var in_time = '<?php echo $GLOBALS['erduo_in_userid'] . '-' . time(); ?>';
var in_upw = '<?php echo $GLOBALS['erduo_in_userpassword']; ?>';
var in_uid = <?php echo $GLOBALS['erduo_in_userid']; ?>;
var in_id = <?php echo $id; ?>;
var in_size = <?php echo intval(ini_get('upload_max_filesize')); ?>;
var remote = {'open':'<?php echo IN_REMOTE; ?>','dir':'<?php echo IN_REMOTEPK; ?>','version':'<?php echo version_compare(PHP_VERSION, '5.5.0'); ?>'};
var oauth = {'api':'<?php echo IN_API; ?>','uid':'<?php echo $GLOBALS['erduo_in_userid']; ?>','ssl':'<?php echo $ssl; ?>','site':'<?php echo $_SERVER['HTTP_HOST']; ?>','path':'<?php echo IN_PATH; ?>','ipa':'<?php echo bin2hex($row['in_app']); ?>','charset':'<?php echo IN_CHARSET; ?>','yololib':'<?php echo $row['in_yololib']; ?>','name':'<?php echo auth_codes($row['in_name']); ?>'};
window.onload = get_cert_list;
  <?php if($status && $status < 2){ ?>
setInterval('listen()', <?php echo IN_LISTEN; ?>);
<?php } ?>
layer.use('confirm-ext.js');
</script>
</head>
<body>
<div class="navbar-wrapper ng-scope">
	<div class="ng-scope">
		<div class="navbar-header-wrap">
			<div class="middle-wrapper">
				<sidebar class="avatar-dropdown">
				<img class="img-circle" src="<?php echo getavatar($GLOBALS['erduo_in_userid']); ?>">
				<div class="name"><span class="ng-binding"><?php echo $ron['in_nick'];//substr($GLOBALS['erduo_in_username'], 0, strpos($GLOBALS['erduo_in_username'], '@')); ?></span></div>
				<div class="email"><span class="ng-binding"><?php echo $GLOBALS['erduo_in_username']; ?></span></div>
				<div class="dropdown-menus">
					<ul>
						<li><a href="<?php echo IN_PATH . 'index.php/profile_info'; ?>" class="ng-binding">个人资料</a></li>
						<li><a href="<?php echo IN_PATH . 'index.php/profile_pwd'; ?>">修改密码</a></li>
						<li><a href="<?php echo IN_PATH . 'index.php/profile_verify'; ?>">实名认证</a></li>
						<li><a href="<?php echo IN_PATH . 'index.php/logout'; ?>" class="ng-binding">退出</a></li>
					</ul>
				</div>
				</sidebar>
				<nav>
				<h1 class="navbar-title logo"><span onclick="location.href='<?php echo IN_PATH; ?>'"><?php echo IN_NAME;//$_SERVER['HTTP_HOST'];?></span></h1>
				<i class="icon-angle-right"></i>
				<div class="navbar-title primary-title"><a href="<?php echo IN_PATH . 'index.php/home'; ?>" class="ng-binding">我的应用</a></div>
				<i class="icon-angle-right"></i>
				<div class="navbar-title secondary-title"><?php echo $row['in_name']; ?></div> 
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
					<img class="plane" src="<?php echo IN_PATH; ?>static/index/plane.svg">
					<div class="rotate-container">
						<img class="propeller" src="<?php echo IN_PATH; ?>static/index/propeller.svg">
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
<div class="page-app app-combo">
	<div class="banner">
		<div class="middle-wrapper clearfix">
			<div class="pull-left appicon">
				<img class="ng-isolate-scope" src="<?php echo geticon($row['in_icon']); ?>" onerror="this.src='<?php echo IN_PATH; ?>static/app/<?php echo $row['in_form']; ?>.png'" width="100" height="100">
			</div>
			<div class="badges">
				<span class="short"><?php echo $GLOBALS['shorturl']->GetShortUrl(getlink($row['in_id'])); ?></span>
				<span><i class="icon-cloud-download"></i><b class="ng-binding"><?php echo $row['in_hits']; ?></b></span>
				<span class="bundleid ng-binding">BundleID<b class="ng-binding">&nbsp;&nbsp;<?php echo $row['in_bid']; ?></b></span>
				<span class="version ng-scope"><?php echo $row['in_form']; ?>&nbsp;<?php echo $row['in_mnvs']; ?>&nbsp;或者高版本</span>
				<span class="version ng-scope" style="border:1px solid red;"><a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo QQHAO;?>&site=qq&menu=yes" target="view_window"><font color="red">联系站长</font></a></span>
			</div>
			<div class="actions">
				<input type="file" id="upload_app" onchange="upload_app()" style="display:none">
				<div class="upload in" onclick="$('#upload_app').click()"><i class="icon-upload-cloud2"></i> 上传新版本</div>
				<a class="download ng-binding" style="color:#00BFFF" href="<?php echo $GLOBALS['shorturl']->GetShortUrl(getlink($row['in_id'])); ?>" target="_blank"><i class="icon-eye"></i> 预览</a>
			</div>
			<div class="tabs-container">
				<ul class="list-inline">
					<li><a class="ng-binding" href="<?php echo IN_PATH; ?>index.php/profile_app/<?php echo $row['in_id']; ?>"><i class="icon-file"></i>基本信息</a></li>
					<li><a class="ng-binding" style="border-left:1px solid" href="<?php echo IN_PATH; ?>index.php/each_app/<?php echo $row['in_id']; ?>"><i class="icon-combo"></i>应用合并</a></li>
					<li><a class="ng-binding active" style="border-left:1px solid"><i class="icon-device"></i>企业签名</a></li>
                  	<li><a href="<?php echo IN_PATH.'index.php/certificate';?>" class="ng-binding" style="border-left:1px solid"><i class="icon-file"></i>证书检测</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="ng-scope">
		<div class="page-tabcontent apps-app-info">
			<div class="middle-wrapper">
				<div class="app-info-form">
					<div class="field app-id">
						<div class="left-label ng-binding">签名期限</div>
						<div class="value">
							<div class="input-group">
								<span class="input-group-addon"><?php if ($row['in_sign']) {?>
                                <b style="color:#1aa79a"><?php echo $row['in_sign'] == 1999999999 ? '已开通' : date('Y年m月d日 H:i:s', $row['in_sign']); ?></b>
                                <?php } else { if($sname){echo '<font color="red">已过期</font>';}else{echo '未开通';}}/* echo '<center><h5>签名后半小时内请付费，否则APP将闪退<br>Chimera 和 unc0ver  不受此时间限制</h5></center>';*/?>
                                </span>
							</div>
						</div>
					</div>
					<div class="field app-name">
						<div class="left-label ng-binding">补签名额</div>
						<div class="value">
							<div class="input-group">
								<span class="input-group-addon"><?php if ($row['in_resign']) {?>
                                <b style="color:#1aa79a"><?php echo $row['in_resign'] ;?></b>
                                <?php } else { echo $row['in_resign']; } ?>
                                </span>
							</div>
						</div>
					</div>
					<div class="field app-name">
						<div class="left-label ng-binding">证书指定</div>
						<div class="value">
							<div class="input-group">
								<select class="form-control" id="in_cert"><option value="">请选择企业证书</option>
                                 </select>
							</div>
						</div>
					</div>
					<div class="field app-name">
						<div class="left-label ng-binding">修改名称</div>
						<div class="value">
							<div class="input-group">
								<input type="text" class="form-control" placeholder=" 留空不修改名称，默认原名称:【<?php echo $row['in_name']; ?>】" id="in_newname">
							</div>
						</div>
					</div>
					<div class="field app-name">
						<div class="left-label ng-binding">自定去锁</div>
						<div class="value">
							<div class="input-group">
								<span class="input-group-addon">多文件以 | 隔开</span>
								<input type="text" class="form-control" placeholder="填写要去除的锁文件名,默认留空！" id="in_suo">
							</div>
						</div>
					</div>
					<div class="field app-name">
						<div class="left-label ng-binding">签名指定</div>
						<div class="value">
							<div class="input-group">
								<span class="input-group-addon">多文件以 | 隔开</span>
                                  <div id="check"/>
								<input type="text" class="form-control" placeholder="指定特殊签名文件，默认留空！" id="in_replace">
							</div>
						</div>
                        <input type="checkbox" name="in_rep"onclick="change(1)" style="width:20px;height:20px;color:#fff;"><font color="red" size="3px"> ᐊ 若不清楚需要指定签名的文件请务必勾选此项！否则可能闪退！</font>
					</div>
					<?php if (is_numeric($sign)) {?>
					<div class="field app-short">
						<div class="left-label ng-binding">下载分发</div>
						<div class="value actions">
								<?php //if ( $GLOBALS['erduo_in_userid'] == 1) {?>
							<button class="save ng-binding" style="margin-right:260px;" onclick="download()">文件下载</button> <?php // } ?>
							<button class="save ng-binding" onclick="window.open('<?php echo $GLOBALS['shorturl']->GetShortUrl(getlink($row['in_id']));?>')">分发预览</button>
						</div>
					</div>
                    <?php } else {?>
					<div class="field app-short">
						<div class="left-label ng-binding">签名文件</div>
						<div class="value">
							<div class="input-group">
								<span class="input-group-addon">
								<?php echo $sign;?>
                                </span>
							</div>
						</div>
					</div>
                    <?php } ?>
					<div class="field app-short">
						<div class="left-label ng-binding">开通签名</div>
						<div class="value">
							<div class="apps-app-security">
								<div class="btn-invite-member" style="margin-left:5px;border:1px solid #1E99FF;color:#00BFFF" onclick="layer.prompt({title:'请输入签名密钥'},function(_key){purchase(_key)})">秘钥开通</div>
								<div class="btn-invite-member" style="margin-left:5px;border:1px solid #00BFFF;color:#00BFFF" onclick="window.open('<?php echo IN_PATH . 'index.php/price?id=1&aid='.$row['in_id'] ;?>')"><i class="icon icon-cart"></i> 购买签名套餐</div>
                                <div class="btn-invite-member" style="margin-left:5px;border:1px solid #00BFFF;color:#00BFFF"><a href="<?php echo IN_PATH.'index.php/user_cer';?>"><font color="red">自助上传证书</font></a></div>
							</div>
						</div>
					</div>
					<div class="field actions">
						<div class="value">
							<div class="apps-app-security">
                                <?php if($row['in_size'] > fortosize('500 MB')){
                                echo '<div class="btn-invite-member" style="margin-left:5px;border:1px solid #000fff;color:#000fff">
                                <a href="http://wpa.qq.com/msgrd?v=3&uin=785863853&site=qq&menu=yes" target="view_window">自助签名仅支持500MB以下APP，当前APP已超限、需签超限APP请点此联系站长</a></div>';
                                }else{ ?>
                                <text id="in_certs"/>
								<button class="save ng-binding" onclick="sign_confirm();">开始签名</button>
                                <div class="btn-invite-member" style="margin-left:5px;border:1px solid #f8ba0b;color:#f8ba0b" onclick="reset_sign_confirm()"><i class="icon icon-update"></i> <font color="red"> 重置</font></div>
                                <?php }?>					
                            </div><br><font color="red">签名开始后请勿切换到其他页面或刷新页面，否则可能签名失败，请耐心等待!<br>
                                                        签名将会去除下列文件名应用锁、功能性文件请勿使用下列文件名注入、否则功能将失效!<br>
                                                        【sign.data、sign.dylib、embedded.dylib、embedded.png、XXGamePlugin】</font>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
<?php include 'source/index/bottom.php';?>
  </body>
  
<script language="javascript">
  function checkemail(){
    
                  var api={"_api_key":"72a9a9cb3d0c364595a653df5dfc2b74"};
                  $.ajax({  
                        url: 'https://www.pgyer.com/apiv2/certificate/index',  
                        type: 'POST',  
                        data:  api,
                        async: false,  
                        dataType: "json",
                        success: function (e) {  
                          var key=[];
                          var cret_num=$("#in_cert option").length;
                          for(var i=0;i<cret_num;i++){
                            key.push($("#in_cert").children('option').eq(i).attr('data-mingcheng'));
                            //console.log(key);
                          }
                          var cer_list=e.data.list;
                          for(var i=0;i<cer_list.length;i++){
                            
                            for(var j=0;j<key.length;j++){
                                //console.log("i"+i+"j"+j);
                              	//console.log((cer_list[i].certificateName===key[j]));
                                //console.log("****"+cer_list[i].certificateName+"####"+key[j]);
                              
                              
                              if(cer_list[i].certificateName.substr(0,cer_list[i].certificateName.length)===key[j].substr(0,cer_list[i].certificateName.length)){
                                console.log("@@@"+i+"j"+j);
                                var type='';
                                if(cer_list[i].certificateStatus=="GOOD"){
                                	type="<b syle='color:#f00;'>【实时监测状态：正常】到期时间："+cer_list[i].certificateExpired+" </b>";
                                }else{
                                	type="<b syle='color:#f00;'>【实时监测状态：掉签】×不可签</b>";
                                }
                                $("#in_cert").children('option').eq(i).append(type);
                                
                                /*
                                $("#in_cert").children('option').each(function(){
                                  
                                  if($(this).attr('data-mingcheng')==key[j]){
                                  	$(this).append(cer_list[i].certificateStatus);
                                  }
                                
                                });*/

                                }
                              
                            }
                            
                            
                              
                          }

                        },  
                        error: function (data) { 
                             $('#check').html("请稍候..."); 
                             $("#msg").html(data);
                        }  
                   });
	
		

  } 
  
  setTimeout(function(){
  	checkemail();
  },2000);
</script>
</html>

