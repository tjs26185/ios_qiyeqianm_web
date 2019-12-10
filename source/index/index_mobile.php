<?php
 if(!defined('IN_ROOT')){exit('Access denied');}
?>
<link href="<?php echo IN_PATH;?>static/index/responsive.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo IN_PATH;?>static/index/resp_home.js"></script>
<header>
<div class="pdding-box">
	<h1 class="brand"><a href="<?php echo IN_PATH;?>"><i class="icon-" style="font-size:30px;font-weight:bold"><?php echo IN_NAME;//$_SERVER['HTTP_HOST'];?></i></a></h1>
	<nav><i class="icon-menu"></i></nav>
</div>
</header>
<menu>
<ul>
	<li><a href="<?php echo IN_PATH;?>">首页</a></li>
	<li><a href="<?php echo IN_PATH.'index.php/install';?>">分发价格</a></li>
	<?php if(IN_SIGN){?>
    <li><a href="<?php echo IN_PATH.'index.php/sign';?>">签名价格</a></li>
    <?php }?>
    <li><a href="<?php echo IN_PATH.'index.php/webview';?>">封装价格</a></li>
	<?php if($GLOBALS['userlogined']){ ?>
    <li><a href="<?php echo IN_PATH.'index.php/home';?>">应用管理</a></li>
	<li><a href="<?php echo IN_PATH.'index.php/logout';?>">退出</a></li>
	<?php }else{?>
    <li><a href="<?php echo IN_PATH.'index.php/reg';?>">免费注册</a></li>
	<li><a href="<?php echo IN_PATH.'index.php/login';?>">立即登录</a></li>
	<?php }?>
  </ul>
</menu>
<div id="touchContainer" class="super-container">
	<section id="section-1" class="section-1 ready animate-in" data-swipe-direction="u" style="height:736px">
	<div class="content-container" style="height:736px">
		<div class="plane-wrapper">
			<img class="plane" src="<?php echo IN_PATH;?>static/index/plane.svg">
			<div class="rotate-container">
				<img class="propeller" src="<?php echo IN_PATH;?>static/index/propeller.svg">
			</div>
		</div>
		<div class="beta-app-host">
			<pre class="typed-finish">
				BetaAppHost
				<br>
				{
				<br>
				     return "<?php echo $_SERVER['HTTP_HOST'];?>"
				<br>
				}
			</pre>
			<b></b>
		</div>
	</div>
	</section>
	<section id="section-2" class="section-2 ready" data-swipe-direction="lrud" data-items-container="content-container" active-item="1" style="height:736px">
	<div class="content-container front" style="height:736px">
		<div class="item features-item current" style="height:736px">
			<table>
			<tbody>
			<tr>
				<td>
					<div class="icon">
						<i class="icon-launch"></i>
					</div>
					<div class="feature-name">
						内测托管
					</div>
					<div class="feature-desc">
						一键上传应用，扫描二维码下载
					</div>
				</td>
			</tr>
			</tbody>
			</table>
		</div>
		<div class="item features-item next" style="height:736px">
			<table>
			<tbody>
			<tr>
				<td>
					<div class="icon">
						<i class="icon-combo"></i>
					</div>
					<div class="feature-name">
						应用合并
					</div>
					<div class="feature-desc">
						扫描同一个二维码，根据设备类型自动下载对应的 iOS 
						<br>
						或 Android 应用。
					</div>
				</td>
			</tr>
			</tbody>
			</table>
		</div>
		<div class="item features-item" style="height:736px">
			<table>
			<tbody>
			<tr>
				<td>
					<div class="icon">
						<i class="icon-console"></i>
					</div>
					<div class="feature-name">
						命令行工具
					</div>
					<div class="feature-desc">
						2sx-cli 可以通过命令行查看、上传、编译、打包应用
					</div>
				</td>
			</tr>
			</tbody>
			</table>
		</div>
		<div class="item features-item" style="height:736px">
			<table>
			<tbody>
			<tr>
				<td>
					<div class="icon">
						<i class="icon-user-access"></i>
					</div>
					<div class="feature-name">
						权限控制
					</div>
					<div class="feature-desc">
						灵活的访问权限控制，可添加团队成员
						<br>
						共同上传、管理应用
					</div>
				</td>
			</tr>
			</tbody>
			</table>
		</div>
		<div class="item features-item" style="height:736px">
			<table>
			<tbody>
			<tr>
				<td>
					<div class="icon">
						<i class="icon-plugin"></i>
					</div>
					<div class="feature-name">
						开放 API
					</div>
					<div class="feature-desc">
						使用 <?php echo $_SERVER['HTTP_HOST'];?> 的 API 接口可以方便搭建
						<br>
						Jenkins 等自动集成的系统
					</div>
				</td>
			</tr>
			</tbody>
			</table>
		</div>
		<div class="item features-item prev" style="height:736px">
			<table>
			<tbody>
			<tr>
				<td>
					<div class="icon">
						<i class="icon-webhooks"></i>
					</div>
					<div class="feature-name">
						Web Hooks
					</div>
					<div class="feature-desc">
						应用更新时团队成员会收到更新邮件，添加Web Hooks的第三方平台也会有更新消息提醒。（已支持 Slack、简聊、BearyChat、纷云、瀑布 IM等）
					</div>
				</td>
			</tr>
			</tbody>
			</table>
		</div>
	</div>
	<div class="content-container back" style="height:736px">
	</div>
	</section>
	<section id="section-3" class="section-3" data-swipe-direction="lrud" data-items-container="content-container" style="height:736px">
	<div class="content-container" style="height:736px">
		<div class="item utils-item current">
			<div class="box-container">
				<table>
				<tbody>
				<tr>
					<td>
						<div class="tool-desc">
							让测试用户快速获取 UDID 并发送给开发者
						</div>
						<div class="brace">
							<i class="icon-brace-box"></i>
						</div>
						<div class="box">
							<div class="side left">
							</div>
							<div class="side top">
								<div class="lid-left">
								</div>
								<div class="lid-right">
								</div>
							</div>
							<div class="side front">
								<i class="icon-udid"></i>
							</div>
							<div class="side right">
								GET
								<br>
								UDID
							</div>
							<div class="side back">
							</div>
						</div>
					</td>
				</tr>
				</tbody>
				</table>
			</div>
		</div>
		<div class="item utils-item next">
			<div class="box-container">
				<table>
				<tbody>
				<tr>
					<td>
						<div class="tool-desc">
							读取手机日志，快速定位无法安装的原因
						</div>
						<div class="brace">
							<i class="icon-brace-box"></i>
						</div>
						<div class="box">
							<div class="side left">
							</div>
							<div class="side top">
								<div class="lid-left">
								</div>
								<div class="lid-right">
								</div>
							</div>
							<div class="side front">
								<i class="icon-udid"></i>
							</div>
							<div class="side right">
								GET
								<br>
								UDID
							</div>
							<div class="side back">
							</div>
						</div>
					</td>
				</tr>
				</tbody>
				</table>
			</div>
		</div>
		<div class="item utils-item">
			<div class="box-container">
				<table>
				<tbody>
				<tr>
					<td>
						<div class="tool-desc">
							添加 SDK，灵活实现应用的检测更新功能
						</div>
						<div class="brace">
							<i class="icon-brace-box"></i>
						</div>
						<div class="box">
							<div class="side left">
							</div>
							<div class="side top">
								<div class="lid-left">
								</div>
								<div class="lid-right">
								</div>
							</div>
							<div class="side front">
								<i class="icon-udid"></i>
							</div>
							<div class="side right">
								GET
								<br>
								UDID
							</div>
							<div class="side back">
							</div>
						</div>
					</td>
				</tr>
				</tbody>
				</table>
			</div>
		</div>
		<div class="item utils-item prev">
			<div class="box-container">
				<table>
				<tbody>
				<tr>
					<td>
						<div class="tool-desc">
							快速检测本机在 <?php echo $_SERVER['HTTP_HOST'];?> 的上传下载速度
						</div>
						<div class="brace">
							<i class="icon-brace-box"></i>
						</div>
						<div class="box">
							<div class="side left">
							</div>
							<div class="side top">
								<div class="lid-left">
								</div>
								<div class="lid-right">
								</div>
							</div>
							<div class="side front">
								<i class="icon-udid"></i>
							</div>
							<div class="side right">
								GET
								<br>
								UDID
							</div>
							<div class="side back">
							</div>
						</div>
					</td>
				</tr>
				</tbody>
				</table>
			</div>
		</div>
	</div>
	</section>
	<section id="section-4" class="section-4" data-swipe-direction="lrud" data-items-container="content-container" style="height:736px">
	<div class="content-container" style="height:736px">
		<div class="item users-item current">
			<table>
			<tbody>
			<tr>
				<td>
					<div class="logo">
						<i class="icon-logo-jumei"></i>
					</div>
					<div class="words">
						就像送自己的孩子去托儿所一样，安全、便捷，<?php echo $_SERVER['HTTP_HOST'];?> 将我们这些“父母”从发包内测中解放！期待越办越好，小美会一如既往支持 <?php echo $_SERVER['HTTP_HOST'];?>！
					</div>
				</td>
			</tr>
			</tbody>
			</table>
		</div>
		<div class="item users-item next">
			<table>
			<tbody>
			<tr>
				<td>
					<div class="logo">
						<i class="icon-logo-jiecao"></i>
					</div>
					<div class="words">
						节操精选的公司内部测试到小范围用户群灰度测试，<?php echo $_SERVER['HTTP_HOST'];?> 极大方便帮我们解决了安装包传输的问题；安全放心、操作便捷、界面简洁！
					</div>
				</td>
			</tr>
			</tbody>
			</table>
		</div>
		<div class="item users-item">
			<table>
			<tbody>
			<tr>
				<td>
					<div class="logo">
						<i class="icon-logo-jd"></i>
					</div>
					<div class="words">
						<?php echo $_SERVER['HTTP_HOST'];?> 解决了京东阅读客户端每日测试发布的难题，大大减轻了跨地域开发测试的难度，<?php echo $_SERVER['HTTP_HOST'];?> 加油！
					</div>
				</td>
			</tr>
			</tbody>
			</table>
		</div>
		<div class="item users-item">
			<table>
			<tbody>
			<tr>
				<td>
					<div class="logo">
						<i class="icon-logo-ebaoyang"></i>
					</div>
					<div class="words">
						e 保养一直在用 <?php echo $_SERVER['HTTP_HOST'];?> 进行测试托管分发，喜欢 <?php echo $_SERVER['HTTP_HOST'];?> 的 UI 和用户体验设计，硅谷范儿的产品！
					</div>
				</td>
			</tr>
			</tbody>
			</table>
		</div>
		<div class="item users-item">
			<table>
			<tbody>
			<tr>
				<td>
					<div class="logo">
						<i class="icon-logo-xiachufang"></i>
					</div>
					<div class="words">
						<?php echo $_SERVER['HTTP_HOST'];?> 与下厨房一样，都在 UI 和 UE 上下功夫，将开发者工具做到简洁极致，提高效率的同时也令人赏心悦目。
					</div>
				</td>
			</tr>
			</tbody>
			</table>
		</div>
	</div>
	</section>
	<section id="section-5" class="section-5" data-swipe-direction="d" style="height:736px">
	<div class="content-container" style="height:736px">
		<table>
		<tbody>
		<tr>
			<td>
				<div class="brand-animate">
					<span class="cursor"></span>
				</div>
				<div class="thumbsup-wrapper">
					<div class="brace-group">
						<i class="icon-brace-left"></i>
						<div class="brace-content">
							<i class="icon-thumbsup"></i><span class="face"><i class="icon-comma-eye left"></i><i class="icon-comma-eye right"></i><i class="icon-mouth"></i></span>
						</div>
						<i class="icon-brace-right"></i>
					</div>
					<p class="are-you-like">
						&nbsp;
					</p>
				</div>
			</td>
		</tr>
		</tbody>
		</table>
	</div>
	</section>
</div>