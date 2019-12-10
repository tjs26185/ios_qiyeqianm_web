
<!doctype html>
<html lang="zh">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0" />
<meta name="keywords" content="Jike-分发平台，苹果签名，app封装，ios签名，ios分发，分发平台，app分发平台，应用分发，内测分发，ipa分发，苹果企业签名，fir，fir.im，熊猫分发，乐分发，倾城云分发，DAFUAI分发，蒲公英分发" />
<meta name="description" content="Jike-分发平台（ff.98dyy.cn）专业从事ios签名、苹果企业签名、app签名、ipa签名、网站封装、企业 开发者账号、app分发、苹果内测分发、苹果签名、网站打包生成app安卓apk和苹果ipa应用客户端服务，还提供安卓APP、苹果apple store、苹果IOS上架及APP深入开发一站式服务，包含即时通讯、系统分享、实时推送、广告嵌入、自定义导航等，网站封装打包一次性收费、终身免费使用。" />
<title>工具箱 - Jike-分发 - 免费应用内测托管平台|iOS应用Beta测试分发|Android应用内测分发</title>
<link rel="stylesheet" href="//pic.l1o.cn/tool/css/font.css" />
<link rel="stylesheet" type="text/css" href="//pic.l1o.cn/tool/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="//pic.l1o.cn/tool/css/base.css" />
<link rel="stylesheet" type="text/css" href="//pic.l1o.cn/tool/css/main.css" />
<link rel="stylesheet" type="text/css" href="//pic.l1o.cn/tool/css/h5.css" />
<script type="text/javascript" src="//pic.l1o.cn/tool/js/jquery.min.js"></script>
<script type="text/javascript" src="//pic.l1o.cn/tool/js/bootstrap.min.js"></script>
<script type="text/javascript" src="//pic.l1o.cn/tool/js/vue.js"></script>
<script type="text/javascript" src="//pic.l1o.cn/tool/js/js.js"></script>
<script>        
	isHideFooter = false;
</script>
</head>
<body>
<header>
    <div class="container">
        <div class="header clearfix">
            <a class="header-left block fl" href="/">
                <img src="/static/default/img/logo-top.png" class="img-responsive hidden-xs">
                <img src="/static/default/img/phone-logo.png" class="img-responsive visible-xs">
            </a>
            <div class="phone-nav-wrap">
                <a class="header-left block fl" href="/">
                    <img src="/static/default/img/phone-logo.png" class="img-responsive visible-xs">
                </a>
                <ul class="ms-nav fl clearfix">
						<li class=" "> <a href="/">首页</a> </li>
												
						<li class=""> <a href="/index.php/price">价格</a> </li> 
						<li class=""> <a href="/source/template/pc/moban3/index.php">超级签名</a> </li> 
						<li class=""> <a href="/index.php/about">关于我们</a> </li>
						<li class="active"> <a href="/index.php/utils">工具箱</a> </li>
						<li class=""> <a href="/index.php/docs">文档</a> </li>
				
								 <?php if($GLOBALS['userlogined']){ ?>
								 <li class=""> <a href="/index.php/apps">用户中心</a> </li>
								 </ul>
								 <?php }else{ ?>   
								 </ul>
            <ul class="login clearfix fr">
						<li><a href="/index.php/login" class="ms-btn ms-btn-default">登录</a></li> 
						<li><a href="/index.php/reg" class="ms-btn ms-btn-primary ml10">注册</a></li>
                    </ul>
			<?php } ?>
								
			</div>
            <span class="icon-menu iconfont phone-menu visible-xs"></span>
            <div class="phone-shadow"></div>
        </div>
    </div>
</header></header><div class="tool-banner">
<div class="container">
<div class="con">
<p class="p1">工具箱</p>
<p class="p2">为移动APP提供相关的附属服务</p>
</div>
</div>
</div>
<div class="container">
    <div class="tool-classs">
        <div class="con">
            <ul class="clearfix">
                <li>
                    <div class="t-con">
                        <div class="img-wrap"><img src="//pic.l1o.cn/tool/img/tool-1.png"></div>
                        <div class="tit">证书检测</div>
                        <p>
                           想检查证书到期时间？用户反馈无法下载安装？为您在线检测证书是否正常 
                        </p>
                        <a href="/index.php/certificate" class="ms-btn ms-btn-secondary">检测</a>
                    </div>
                </li>
                <li>
                    <div class="t-con">
                        <div class="img-wrap"><img src="//pic.l1o.cn/tool/img/tool-4.png"></div>
                        <div class="tit">Plist文件在线制作</div>
                        <p>
                            将IPA的下载链接，图标的链接，以及APP的名字和BundleID放到Plist文件中，通过苹果的itms-services可以实现APP在线下载的功能。
                        </p>
                        <a href="/index.php/plist" class="ms-btn ms-btn-secondary">制作</a>
                    </div>
                </li>
                <li>
                    <div class="t-con">
                        <div class="img-wrap"><img src="//pic.l1o.cn/tool/img/tool-5.png"></div>
                        <div class="tit">APP图标在线制作</div>
                        <p>
                            可以提供在线图标制作，多种图案和
                            风格可选，自由拼接，支持多种尺寸
                            和格式
                        </p>
                        <a href="/index.php/icon-make" class="ms-btn ms-btn-secondary">制作</a>
                    </div>
                </li>              
                <li>
                    <div class="t-con">
                        <div class="img-wrap"><img src="//www.pgyer.com/static-20191009/images/tools/android_certificate.png"></div>
                        <div class="tit">Android 证书制作</div>
                        <p>
                            Android 证书在线制作
                            证书可以提高应用安全性并能在应用升级时提供便利
                        </p>
                        <a href="/index.php/createAndroidCert" class="ms-btn ms-btn-secondary">制作</a>
                    </div>
                </li>
                <li>
                    <div class="t-con">
                        <div class="img-wrap"><img src="//pic.l1o.cn/tool/img/tool-7.png"></div>
                        <div class="tit">Win系统签名工具</div>
                        <p>
                            基于windows系统的签名工具,不必再用MAC签名了！
                        </p>
                        <a href="https://ff.98dyy.cn/Jkqm.rar" class="ms-btn ms-btn-secondary">下载</a>
                    </div>
                </li>
                <li>
                    <div class="t-con">
                        <div class="img-wrap"><img src="//pic.l1o.cn/tool/img/tool-7.png"></div>
                        <div class="tit">待添加</div>
                        <p>
                            程序员小哥哥正在努力开发中
                        </p>
                      	<a class="ms-btn ms-btn-secondary">暂无</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>    
</script>
<br>
<br>
<br>
  <!--底部-->
<footer>
<div class="container">
	<div class="footer hidden-xs">
		<div class="clearfix">
			<div class="fl left clearfix">
				<dl class="fl">
					<dt>产品服务</dt>
					<dd class="line"></dd>
					<dd><a href="/index.php/publish" target="_blank">托管分发</a></dd>
					<dd><a href="/index.php/price" target="_blank">价格服务</a></dd>
					<dd><a href="/index.php/feedback" target="_blank">建议和反馈</a></dd>
				</dl>
				<dl class="fl">
					<dt>关于我们</dt>
					<dd class="line"></dd>
					<dd><a href="/index.php/about" target="_blank">公司简介</a></dd>
					<dd><a href="/index.php/about/privacy" target="_blank">隐私政策</a></dd>
					<dd><a href="/index.php/about/log" target="_blank">更新日志</a></dd>
				</dl>
				<dl class="fl">
					<dt>联系我们</dt>
					<dd class="line"></dd>
					<dd>
					<a href="javascript:;" target="_blank" class="chatQQ">联系扣扣：925890424</a>
					</dd>
					<dd>联系邮箱：lugar@vip.qq.com</dd>
					<dd>合作邮箱：lugar@vip.qq.com</dd>
				</dl>
                <dl class="fl">
					<dt>友情链接</dt>
					<dd class="line"></dd>
					<dd><a href="http://aust.98dyy.cn" target="_blank">Jike授权</a></dd>
                </dl>
			</div>

			<div class="right fr clearfix">
				<a href="/">
                <img src="https://www.l1o.cn/static/default/img/logo-top.png" class="img-responsive hidden-xs">
				<img src="/static/default/img/phone-logo.png" class="img-responsive visible-xs">
				</a>
				<div class="clearfix">
				</div>
				<div class="wechat clearfix fr hidden-xs">
					<img src="/static/default/img/weixin.png" alt="" class="fr">
				</div>
				<div class="clearfix">
				</div>
				<p class="hidden-xs">
			    微信扫描二维码  
				</p>
				<div style="text-align: left; color: #fff; line-height: 28px;" class="visible-xs">
					<a href="/index.php/about" target="_blank" class="color-white">公司简介</a>
					<div>
						地址：</span>
					</div>
				</div>
			</div>
		</div>

		<div class="record">
			<div class="inline-block">
				<span class="fl">Copyright &copy; 2018-2020 Jike版权所有 <a style="color:#ffffff" href="http://www.miitbeian.gov.cn/" target="_blank">沪ICP备18030474号</a></span>
				<a target="_blank" href="http://www.beian.gov.cn/" style="text-decoration:none; height:20px; line-height:20px; float: left; margin-left: 10px;">
				<img src="/static/default/img/jh.png" style="float:left;" />
				<p style="float:left; height:20px; line-height:20px; margin: 0px 0px 0px 5px; color:#fff;">鄂公网安备 21080302000893号</p>
				</a>
			</div>
<div class="down_ico" style="
    margin-top: 10px;
    margin-right: 10px;
">

        <a href="https://ss.knet.cn/" target="_blank"><img src="/static/default/images/cnnic.png" height="30" alt="可信网站" title="可信网站" style="
    margin-right: 10px;
"></a>
        <a href="https://credit.szfw.org/" target="_blank"><img src="/static/default/images/cxlogos.jpg" height="30" alt="诚信网站" title="诚信网站" style="
    margin-right: 10px;
"></a>
        <a href="http://si.trustutn.org/" target="_blank"><img border="0" height="30" src="/static/default/images/bottom_large_img.png" style="
    margin-right: 10px;
"></a><a href="http://www.anquan.org/" target="_blank"><img border="0" height="30" src="/static/default/images/aqlmlogo.png" style="
    margin-right: 10px;
"></a><a href="http://wangzhan.360.cn/" target="_blank"><img border="0" height="30" src="/static/default/images/360logo.gif" style="
    margin-right: 10px;
"></a><a href="http://www.internic.net/" target="_blank"><img src="/static/default/images/reglogo.gif" height="30" title="ICANN授权注册服务机构" style="
    margin-right: 10px;
"></a>
          <a href="http://www.cnnic.cn/" target="_blank"><img src="/static/default/images/cnnic.gif" height="30" title="中国互联网络信息中心合作" style="
    margin-right: 10px;
"></a>
</div>
		</p>
	</div>
</div>
<div class="footer visible-xs">
	<div class="con">
		<a href="/index.php/about" target="_blank">公司简介</a><span>|</span><a href="/index.php/about/agreement" target="_blank">服务协议</a><span>|</span><a href="/index.php/about/log" target="_blank">更新日志</a><span>|</span><a href="/index.php/about/privacy" target="_blank">隐私政策</a>
	</div>
	<p class="p1">
		Copyright © 2018-2020 Jike-分发平台 <a style="color:#ffffff" href="http://www.miitbeian.gov.cn/" target="_blank">沪ICP备18030474号</a>
	</p>
	<p class="p2">
		<a target="_blank" href="http://www.beian.gov.cn/" style="text-decoration:none; height:20px; line-height:20px; margin-left: 10px;"><img src="/static/default/img/jh.png"><span style="height:20px; line-height:20px; margin: 0px 0px 0px 5px; color:#fff;">鄂公网安备 21080302000893号</p></span></a>
	</p>
</div>
</div>
</footer>
  <!--底部-->
<ul class="fixed-right right-float-window" style>
<li>
<a href="javascript:;" target="_blank" class="chatQQ">
<span class="iconfont icon-qq"></span>
</a>
</li>
<li>
<a href="javascript:;">
<span class="iconfont icon-weixin1"></span>
<div class="wechat">
<img src="/static/default/img/weixingongzhonghao.png" alt="">
</div>
</a>
</li>
<li class="go-top" style="display: none;">
<a href="javascript:;"><span class="iconfont icon-go-top"></span></a>
</li>
</ul>
<script src="/static/default/js/clipboard.js"></script>
<script>
    if (!isHideFooter) {
        $('.right-float-window').show();
    }
	
    $(function () {
        $("body").on('click', '.fail-pay', function () {
            $(".pay-money a:last").removeClass("disabled");
            $(".pay-money a:last").addClass("toPay");
        });
        $("body").on('click', '.complete-pay', function () {
            $(".toPay").removeClass('disabled');
            order_sn = $('#myModalPay').find('input[name="order_sn"]').val();
            if (!order_sn) {
                $('#myModalPay').modal('hide');
                return;
            }

            $.post('/index.php/check-pay', {order_sn: order_sn}, function (result) {
                if (result.code != 200) {
                    $('#myModalPay').modal('hide');
                } else {
                    if (result.data.service_type == 1 || result.data.service_type == 2) {
                        window.location.href = '/index.php/publish';
                    } else if (result.data.service_type == 2) {
                        window.location.href = '/sign/upload?step=4&sign_id=' + result.data.goods_id;
                    }
                }
            })

        });	
		
		var windowWidth = $(window).width();
		$("body").on('click', '.chatQQ', function () {
			console.info(windowWidth);
			if (windowWidth <= 750) {
				/*1234567对应的就是需要聊天的客服*/
				window.location.href = "mqqwpa://im/chat?chat_type=wpa&uin=925890424&version=1&src_type=web&web_src=oicqzone.com";
			} else {
				window.location.href = "http://wpa.qq.com/msgrd?v=3&uin=925890424&site=qq&menu=yes";
			}
		});
        var source_login = 0;
        if (windowWidth <= 750 && source_login) {
            Modal.templateModal({
                imgName: "modal-bg-3.jpg",
                title1: '提示',
                title2: '',
                p: '建议您：<br>尽快<span class="color-danger">电脑</span>登Jike分发网站，即可享受<br><span class="iconfont icon-xingxing" style="color: #fec323; font-size: 12px; margin-right: 5px;"></span>免费试用应用分发APP<br><span class="iconfont icon-xingxing" style="color: #fec323; font-size: 12px; margin-right: 5px;"></span>每天免费赠送<span class="color-danger">10</span>次分发下载次数',
                align: 'left', // 居左 left, 居中 center, 居右 right
                btnText: '知道了',
                btnClass: "modal-btn2"
            });
        }		
    });
	
    function alert(msg, callback, cancelCallback, align, successBtn, cancelBtn) {
        if (!align) align = 'center';
        if (!successBtn) successBtn = '确定';
        Modal.generalModal({
            backdrop: true, // 点击阴影是否关闭弹窗， // true 开启； false 关闭
            iconClass: "",  // success: icon-modal-success1,  error: icon-modal-error2
            title: '',  // 弹窗标题
            p: msg, // 弹窗内容
            align: align, // 弹窗内容排列顺序 left center right
            cancelBtnText: cancelBtn,    // 取消按钮文字
            successBtnText: successBtn,  // 确定按钮文字
            successBtnModal: true, // 点击确定按钮是否关闭弹窗 true 关闭 false 不关闭
            cancelBtnModal: true, // 点击取消按钮是否关闭弹窗 true 关闭 false 不关闭
            successCallback: callback,
            cancelCallback: cancelCallback
        });
    }	
</script></body>
</html>