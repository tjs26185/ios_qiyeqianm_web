<?php
 if(!defined('IN_ROOT')){exit('Access denied');}
?>
<!DOCTYPE html>
<html lang="zh">
<head> 
<title>账号登录 - Jike-免费应用内测托管平台|iOS应用Beta测试分发|Android应用内测分发</title> 
<meta charset="utf-8" /> 
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" /> 
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> 
<meta name="renderer" content="webkit" /> 
<meta name="keywords" content="apk,android,ipa,ios,iphone,ipad,app封装,应用分发,企业签名" /> 
<meta property="og:url" content="https://test.98dyy.cn/" /> 
<meta property="og:title" content="<?php echo IN_CHARSET;?>" /> 
<meta name="description" content="<?php echo IN_CHARSET;?>分发为各行业提供ios企业签名、app封装、应用分发托管服务！" /> 
<link rel="stylesheet" href="//at.alicdn.com/t/font_780494_fdjuk9baed7.css" />
<script src="https://js.fundebug.cn/fundebug.1.7.3.min.js" apikey="214541213214545121"></script>
<link rel="stylesheet" href="/static/default/bootstrap-3.3.7-dist/css/bootstrap.min.css"/>
<link rel="stylesheet" href="/static/default/css/base.css"/>
<link rel="stylesheet" href="/static/default/css/main.css"/>
<link rel="stylesheet" href="/static/default/css/h5.css"/>
<script src="/static/default/js/jquery.min.js"></script>
<script src="/static/default/js/bootstrap.min.js"></script>
<script src="/static/default/js/vue.js"></script>
<script src="/static/default/js/js.js"></script>
<link rel="shortcut icon" href="//test.98dyy.cn/favicon.ico" type="image/x-icon" />
<script>        
	isHideFooter = false;
</script></head>
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
						<li class=" active"> <a href="/">首页</a> </li>
												
						<li class=""> <a href="/index.php/price">价格</a> </li> 
						<li class=""> <a href="/source/template/pc/moban3/index.php">超级签名</a> </li> 
						<li class=""> <a href="/index.php/about">关于我们</a> </li>
						<li class=""> <a href="/index.php/utils">工具箱</a> </li>
						<li class=""> <a href="/index.php/docs">文档</a> </li>
				
								 <?php if($GLOBALS['userlogined']){ ?>
								 <li class=""> <a href="/index.php/home">用户中心</a> </li>
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
</header><script type="text/javascript" src="/static/default/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="/static/default/js/jquery.cookie.js"></script>
<div class="login-common">
	<div class="tit">账号登录</div> 
	<form role="form" id="loginValid" novalidate="novalidate">
		<input type="password" style="position: absolute;top: -999px"/>
		<div class="form-group">
			<label class="iconfont icon-user" for="user"></label>
			<input type="text" class="form-control input-lg" id="user" aria-describedby="helpBlock2" placeholder="请输入用户名/邮箱/手机">
			<span class="help-block">请输入正确的邮箱</span>
		</div>
		<div class="form-group">
			<label class="iconfont icon-pwd" for="password"></label>
			<input class="form-control input-lg" id="password" placeholder="请输入密码" type="password">
			<span class="help-block">请输入正确的密码</span>
		</div>
		<div class="checkbox"><input type="checkbox" id="remember-me" checked><span>记住我</span></div>
		<button type="button" class="ms-btn ms-btn-primary input-lg mt20" id="submitButton">登录</button>
		<div class="clearfix mt15">
			<a href="/index.php/reg" class="fl">免费注册</a>
			<a href="/index.php/lost" class="fr">忘记密码</a>
		</div>
	</form>
</div>
<script>
    $(function () {
        if ($.cookie('bit') === 'true') {
            $('#remember-me').attr('checked', 'checked');
            $('#user').val($.cookie('user'));
            $('#password').val($.cookie('password'));
        }
		

        $("#submitButton").click(function () {
            var user = $("#user").val();
            var password = $("#password").val();
            $.get("/source/index/ajax.php?ac=login", {mail: user, pwd: password},
                function (data) {
                    if (data.code != 200) {
                        alert(data.msg);
                    } else {
                        if ($('#remember-me').is(':checked')) {
                            $.cookie('user', user, {
                                expires: 365
                            });
                            $.cookie('password', password, {
                                expires: 365
                            });
                            $.cookie('bit', 'true', {
                                expires: 365
                            });
                        } else {
                            $.removeCookie('username');
                            $.removeCookie('password');
                            $.removeCookie('bit');
                        }
							if (data.verify != 0) {
								window.location.href = '/index.php/apps';
							} else {
								window.location.href = '/index.php/apps';
							}						
                    }
                }, 'json');
        });


        document.onkeydown = function (event) {
            var e = event || window.event;
            if (e && e.keyCode == 13) {
                $("#submitButton").click();
            }
        };

        $("#loginValid").validate({
            errorPlacement: function (error, element) {
                error.appendTo(element.parent().parent());
            },
            rules: {
                "mobile": {
                    required: true,
                    mobile: true
                },
                "password": {
                    required: true,
                    minlength: 5
                }
            },
            messages: {
                mobile: {
                    required: "手机号不能为空",
                    mobile: "请输入正确的手机号"
                },
                password: {
                    required: "密码不能为空",
                    minlength: "密码长度最少5位"
                }
            },
            highlight: function (element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function (element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            errorElement: 'label',
            errorPlacement: function (error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            }
        });


        if ($.cookie("password") != '') {
            $("#password").val($.cookie("password"));
        }
        if ($.cookie("user") != '') {
            $("#name").val($.cookie("user"));
        }
    });
</script>    
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
			</div>

			<div class="right fr clearfix">
				<a href="/">
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
				<span class="fl">Copyright &copy; 2018-2020  Jike版权所有 <a style="color:#ffffff" href="http://www.miitbeian.gov.cn/" target="_blank"></a></span>
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
		Copyright © 2018-2020 <?php echo IN_CHARSET;?> <a style="color:#ffffff" href="http://www.miitbeian.gov.cn/" target="_blank"></a>
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
                p: '建议您：<br>尽快<span class="color-danger">电脑</span>登录<?php echo IN_CHARSET;?>网站，即可享受<br><span class="iconfont icon-xingxing" style="color: #fec323; font-size: 12px; margin-right: 5px;"></span>免费试用应用分发APP<br><span class="iconfont icon-xingxing" style="color: #fec323; font-size: 12px; margin-right: 5px;"></span>每天免费赠送<span class="color-danger">10</span>次分发下载次数',
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