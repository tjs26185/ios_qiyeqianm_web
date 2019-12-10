<?php
if (!defined('IN_ROOT')) {
    exit('Access denied');
}
if (!$GLOBALS['userlogined']) {
    header('location:' . IN_PATH . 'index.php/login');
}
$url = http() . $_SERVER['HTTP_HOST'] . '/source/index/cerapi.php';
$ron = $GLOBALS['db']->getrow("select * from " . tname('user') . " where in_userid=".$GLOBALS['erduo_in_userid']);
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="<?php echo IN_CHARSET; ?>">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
<title>上传证书 - <?php echo IN_NAME; ?></title>
<link href="<?php echo IN_PATH; ?>static/index/application.css" rel="stylesheet">
<link href="<?php echo IN_PATH; ?>static/index/user_info.css" rel="stylesheet">
<link href="<?php echo IN_PATH; ?>static/index/manage.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/js/jquery.min.js"></script> 
<script type="text/javascript">var in_path = '<?php echo IN_PATH; ?>';</script>
  </head>
<body>
<header>
<div class="brand">
	<a href="<?php echo IN_PATH; ?>"><i class="icon-" style="font-size:<?php echo checkmobile() || strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') ? 25 : 35; ?>px;font-weight:bold"><?php echo IN_NAME; ?></i></a>
</div>
<nav>
	<ul><li><a id="signoutLink" href="<?php echo IN_PATH.'index.php/home'; ?>">我的应用</a></li></ul>
</nav>
</header>
<div class="user-info">
	<form class="avatar">
		<label><img src="<?php echo getavatar($GLOBALS['erduo_in_userid']); ?>" width="120" height="120"></label>
	</form>
	<form class="auto-save-form">
		<div class="form-group floated">
			<span class="name"><?php echo $ron['in_nick'];//substr($GLOBALS['erduo_in_username'], 0, strpos($GLOBALS['erduo_in_username'], '@')); ?></span>
		</div>
	</form>
	<div class="user_pro_tabs">
		<div class="container">
			<div class="row">
				<div class="col-3">
					<a href="<?php echo IN_PATH.'index.php/user_cer'; ?>" class="active">&emsp;<span><i class="icon icon-badge"></i></span>你仅能使用自己上传的证书 &emsp;以及可用管理员上传的证书 &emsp;<span><i class="icon icon-badge"></i></span></a>
				</div>
			</div>
		</div><br><font size="4" color="red">请勿提交已过期证书，请确定证书可正常信任，请勿上传个人证书或公司证书</font>
	</div>
	<div class="form-container">
		<div class="profile-form-wrap form-wrap">
		  <div class="partials-user-profile">
            <iframe  name="post_frame" style="display:none;"> </iframe>
				<form id="upload" method="post" target="post_frame"  enctype="multipart/form-data">
					<div class="control-group">
						<div class="control-label">  
							<div class="input-group edit">
                              <label class="input-label" style="font-weight:bold;">证书描述文件</label>
                              <input type="file" style="width:280px;height:30px;border:1.5px solid #378888" accept=".mobileprovision" name="fileProvision" value=""/> 
							</div>
                        </div>
						</div>
					<div class="control-group">
						<div class="control-label">
							<div class="input-group edit">
                              <label class="input-label" style="width:280px;height:20px;font-weight:bold;">证书P12文件</label>
                              <input type="file" style="width:282px;height:30px;border:1.5px solid #378888" accept=".p12" name="fileCert" placeholder=""  width="200" /> 
						</div>
                      </div>
					</div>
					<div class="control-group">
						<div class="control-label">
							<div class="input-group edit">
								<label class="input-label" style="width:28px;height:20px;font-weight:bold;">P12证书密码</label>
									<input type="textt" style="height:30px;border:1.5px solid #378888" placeholder="密码为空可不填写！" name="password"/>
                              </div>
							</div>
					</div>
					<div class="form-group action">
                      
						<input type="text" id="certificateKey"  style="border:1.5px; solid:#378888; display:none" value="" name="certificateKey"/>
                      
						<input type="text"  style="border:1.5px; solid:#378888; display:none" value="72a9a9cb3d0c364595a653df5dfc2b74" name="_api_key"/>
						<input type="text"  style="border:1.5px; solid:#378888; display:none" value="<?php echo $GLOBALS['erduo_in_userid']; ?>" name="uid"/>
						<input type="text"  style="border:1.5px; solid:#378888; display:none" value="<?php echo $GLOBALS['erduo_in_username']; ?>" name="user"/>
                        <input type="button" onclick="checkemail()" value="确定上传" class="btn btn-primary;" style="width:200px;border:4px;background:#3DAFEB;color:#FFF;font-weight:bold;">
					</div>
				</form>
			</div>
	</div><text name='msg'id="msg"/>
		</div>
	<div class="user_pro_tabs">
		<div class="container">
			<div class="row">
				<div class="col-3">
					<a class="active"></a>
				</div>
			</div>
		</div>
	</div>
  </div>
<script language="javascript">
function checkemail(){
  var form = document.getElementById('upload'), 
    formData = new FormData(form); 
  
  	  $.ajax({  
                url: 'https://www.pgyer.com/apiv2/certificate/add',  
                type: 'POST',  
                data: formData,  
                async: false,  
                cache: false,    
                contentType: false,  
                processData: false,  
                success: function (e) {  
                  $('#certificateKey').val(e.data.certificateKey);
                  var api={"_api_key":"72a9a9cb3d0c364595a653df5dfc2b74"};
                  $.ajax({  
                        url: 'https://www.pgyer.com/apiv2/certificate/index',  
                        type: 'POST',  
                        data:  api,
                        async: false,  
                        dataType: "json",
                        success: function (e) {  
                          var key=$('#certificateKey').val();
                          var cer_list=e.data.list;
                          for(var i=0;i<cer_list.length;i++){
                              if(cer_list[i].certificateKey==key){
                                if(cer_list[i].certificateStatus=="REVOKED"){
                                  alert('当前证书状态：已掉签');
                                  $("#msg").html('当前证书状态：<font size="4" color="red">已掉签，上传失败！</font>'); 
                                   }else if(cer_list[i].certificateStatus=="GOOD"){
                                     
                                    var form = document.getElementById('upload'), 
                                      formData = new FormData(form); 
                                      $.ajax({  
                                          url: '<?php echo $url;?>',  
                                          type: 'POST',  
                                          data: formData,  
                                          async: false,  
                                          cache: false,    
                                          contentType: false,  
                                          processData: false,  
                                          success: function (data) {  
                                               $('#check').html("请稍候...");
                                               $("#msg").html(data); 

                                          },  
                                          error: function (data) { 
                                               $('#check').html("请稍候..."); 
                                               $("#msg").html(data);
                                          }  
                                     });  
                                   //alert('当前证书状态：正常');
                                     
                                }

                                }
                          }

                        },  
                        error: function (data) { 
                             $('#check').html("请稍候..."); 
                             $("#msg").html(data);
                        }  
                   }); 
                },  
                error: function (data) { 
                     $('#check').html("请稍候..."); 
                     $("#msg").html(data);
                }  
           });  
  
     
  	
  
    
  
  
  
  
} 
</script>
</body>
</html>