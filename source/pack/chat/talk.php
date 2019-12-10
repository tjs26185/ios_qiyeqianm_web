<?php
if (!defined('IN_ROOT')) {
    exit('Access denied');
}
Administrator(1);
global $develop_auth;
$ssl = is_ssl() ? 'https' : 'http';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<title>耳朵站群</title>
<link href="static/pack/chat/css/chat.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="static/pack/layer/confirm-lib.js"></script>
<script type="text/javascript">
var in_path = "<?php echo IN_PATH; ?>";
var in_uid = <?php echo $_COOKIE['in_adminid']; ?>;
var in_ssl = "<?php echo $ssl; ?>";
var in_info = "<?php echo str_replace(auth_codes('aHR0cDovL3d3dy5lYXJjbXMubmV0Lz9oPQ==','de'),'?h=',$develop_auth); ?>";
var in_server = "11www.earcms.net";
var in_avatar = in_ssl + "://" + in_server + "/source/pack/upload/avatar.php?";
layer.use('confirm-ext.js');
</script>
<script type="text/javascript" src="static/pack/upload/swfobject.js"></script>
<script type="text/javascript" src="static/pack/chat/js/uploadify.js"></script>
<script type="text/javascript" src="static/pack/chat/js/chat.js"></script>
</head>
<body>
<div id="menu_list" style="display:none">
	<ul>
		<li id="space"><img src="static/pack/chat/icon/space.png"> 访问网站</li>
		<li id="lock"><img src="static/pack/chat/icon/lock.png"> 锁定站长</li>
	</ul>
</div>
<div class="chatBox" style="width:836px;height:559px" id="content">
	<div class="chatLeft" style="width:668px">
		<div class="chat01">
			<div class="chat01_title">
				<ul class="talkTo" num="0" verify="">
					<li><a uid=""></a></li>
				</ul>
				<a class="close_btn" title="清屏"></a>
			</div>
			<div class="chat01_content" style="height:363px">
				<div class="message_box">
				</div>
			</div>
		</div>
		<div class="chat02">
			<div class="chat02_title">
				<a class="chat02_title_btn ctb00" id="_emoji"></a>
				<a class="chat02_title_btn ctb07" id="_record"></a>
				<a class="chat02_title_btn ctb02"></a>
				<a class="chat02_title_btn ctb03"></a>
				<a class="chat02_title_btn ctb04" id="_shake" title="窗口抖动"></a>
				<a class="chat02_title_btn ctb09" id="_upload" title="分享文件"><input type="file" id="uploadify"></a>
				<a class="chat02_title_btn ctb06" title="更新头像"></a>
				<a class="chat02_title_btn ctb11" title="斗地主"></a>
				<label class="chat02_title_l" title="公共频道"></label>
				<div class="wl_faces_box">
					<div class="wl_faces_content">
						<div class="title">
							<ul>
								<li class="title_name">选择表情</li>
								<li class="wl_faces_close"><span>&nbsp;</span></li>
							</ul>
						</div>
						<div class="wl_faces_main">
							<ul>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_01.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_02.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_03.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_04.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_05.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_06.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_07.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_08.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_09.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_10.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_11.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_12.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_13.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_14.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_15.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_16.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_17.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_18.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_19.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_20.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_21.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_22.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_23.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_24.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_25.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_26.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_27.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_28.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_29.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_30.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_31.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_32.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_33.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_34.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_35.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_36.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_37.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_38.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_39.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_40.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_41.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_42.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_43.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_44.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_45.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_46.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_47.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_48.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_49.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_50.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_51.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_52.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_53.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_54.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_55.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_56.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_57.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_58.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_59.gif"></a></li>
								<li><a href="javascript:;"><img src="static/pack/chat/emoji/emo_60.gif"></a></li>
							</ul>
						</div>
					</div>
					<div class="wlf_icon">
					</div>
				</div>
				<div class="wl_faces_box8">
					<div class="wl_faces_content8">
						<div class="title">
							<ul>
								<li class="title_name">发送语音</li>
								<li class="wl_faces_close8"><span>&nbsp;</span></li>
							</ul>
						</div>
						<object id="as_js" type="application/x-shockwave-flash" width="100%" height="100%"><param name="movie" value="static/pack/chat/player/recording.swf" /><param name="wmode" value="transparent"/></object>
					</div>
					<div class="wlf_icon">
					</div>
				</div>
				<div class="wl_faces_box2">
					<div class="wl_faces_content2">
						<div class="title">
							<ul>
								<li class="title_name">网络图片</li>
								<li class="wl_faces_close2"><span>&nbsp;</span></li>
							</ul>
						</div>
						<textarea id="_img" onkeydown="lib.press('value', this.id, 'wl_faces_box2');" onfocus="javascript:if('按 Esc 键返回'==this.value)this.value=''" onblur="javascript:if(''==this.value)this.value='按 Esc 键返回'">按 Esc 键返回</textarea>
					</div>
					<div class="wlf_icon">
					</div>
				</div>
				<div class="wl_faces_box3">
					<div class="wl_faces_content3">
						<div class="title">
							<ul>
								<li class="title_name">网络视频</li>
								<li class="wl_faces_close3"><span>&nbsp;</span></li>
							</ul>
						</div>
						<textarea id="_flash" onkeydown="lib.press('value', this.id, 'wl_faces_box3');" onfocus="javascript:if('按 Esc 键返回'==this.value)this.value=''" onblur="javascript:if(''==this.value)this.value='按 Esc 键返回'">按 Esc 键返回</textarea>
					</div>
					<div class="wlf_icon">
					</div>
				</div>
			</div>
			<div class="chat02_content">
				<textarea style="width:658px" id="textarea" onkeydown="lib.press('send', 0, 0);"></textarea>
			</div>
			<div class="chat02_bar">
				<ul>
					<li id="set_disturb" title="开启免打扰" onclick="lib.disturb(0);" style="width:30px;height:30px;cursor:pointer;background:url('static/pack/chat/icon/disturb.png') no-repeat 10px 8px"></li>
					<li id="send_tips" style="right:100px;top:10px">按 Enter 键快捷发送</li>
					<li style="right:5px;top:5px"><a onclick="listenMsg.send();" style="cursor:pointer"><img src="static/pack/chat/icon/send_btn.jpg"></a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="chatRight">
		<div class="chat03">
			<div class="chat03_title">
				<span class="chat03_title_t">站长列表</span>
				<label class="chat02_title_t" title="刷新列表" id="list_reload"></label>
			</div>
			<div class="chat03_content" style="height:513px">
				<script type="text/javascript">listenMsg.login();</script>
			</div>
		</div>
	</div>
	<div style="clear: both;">
	</div>
</div>
</body>
</html>