<?php
if (!defined('IN_ROOT')) {
    exit('Access denied');
}
if (!$GLOBALS['userlogined']) {
    exit(header('location:' . IN_PATH . 'index.php/login'));
}
$ios = $GLOBALS['db']->num_rows($GLOBALS['db']->query("select count(*) from " . tname('app') . " where in_form='iOS' and shan=0 and in_uid=" . $GLOBALS['erduo_in_userid']));
$android = $GLOBALS['db']->num_rows($GLOBALS['db']->query("select count(*) from " . tname('app') . " where in_form='Android' and shan=0 and in_uid=" . $GLOBALS['erduo_in_userid']));
$home = explode('/', $_SERVER['PATH_INFO']);
$string = isset($home[2]) ? $home[2] : NULL;
if (empty($string)) {
    $query = $GLOBALS['db']->query("select * from " . tname('app') . " where in_uid=" . $GLOBALS['erduo_in_userid'] . " and shan=0 order by in_addtime desc");
} elseif (is_numeric($string)) {
    $form = $string == 1 ? 'iOS' : 'Android';
    $query = $GLOBALS['db']->query("select * from " . tname('app') . " where in_form='" . $form . "' and in_uid=" . $GLOBALS['erduo_in_userid'] . " and shan=0 order by in_addtime desc");
} else {
    $key = SafeSql(trim(is_utf8($string)));
    $query = $GLOBALS['db']->query("select * from " . tname('app') . " where in_name like '%" . $key . "%' and in_uid=" . $GLOBALS['erduo_in_userid'] . " and shan=0 order by in_addtime desc");
}
$ron = $GLOBALS['db']->getrow("select * from " . tname('user') . " where in_userid=".$GLOBALS['erduo_in_userid']);
?>
<!doctype html>
<html lang="zh">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0"/>
<meta name="keywords" content="apk,android,ipa,ios,iphone,ipad,app封装,应用分发,企业签名" />
<meta name="description" content="领客云分发为各行业提供ios企业签名、app封装、应用分发托管服务！" />
<title>云币购买 - Jike-分发 - 免费应用内测托管平台|iOS应用Beta测试分发|Android应用内测分发</title>
<link rel="stylesheet" href="//at.alicdn.com/t/font_780494_fdjuk9baed7.css" />
<script src="https://js.fundebug.cn/fundebug.1.7.3.min.js" apikey="40d76c21823febc129903fb37d2d74dca3993a349cbee5d610acf3b3e0fce5e4"></script>
<link rel="stylesheet" href="/static/default/bootstrap-3.3.7-dist/css/bootstrap.min.css"/>
<link rel="stylesheet" href="/static/default/css/base.css"/>
<link rel="stylesheet" href="/static/default/css/main.css"/>
<link rel="stylesheet" href="/static/default/css/h5.css"/>
<script src="/static/default/js/jquery.min.js"></script>
<script src="/static/default/js/bootstrap.min.js"></script>
<script src="/static/default/js/vue.js"></script>
<script src="/static/default/js/js.js"></script>
<link rel="shortcut icon" href="//ff.98dyy.cn/favicon.ico" type="image/x-icon" />
<script>        
	isHideFooter = false;
</script><body>
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
												
						<li class="active"> <a href="/index.php/price">价格</a> </li> 
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
</header><div class="price-pay-wrap">
	<div class="container">
		<div class="price-pay">
			<div class="crumbs">
				<a href="###">价格</a><span>/</span>应用分发套餐购买
			</div>
			<div class="con">
				<div class="common">
					<div class="tit">选择套餐内容</div>
					<ul class="clearfix list1">
						<li class="clearfix active">
						<div class="fl left">
							<div class="text1">内测分发下载</div>
							<div class="text2">1,000云币</div>
						</div>
						<div class="fr right">25<span>元</span></div>
						<span class="radio-checked icon icon-checkbox"></span>                        
						<input type="hidden" name="service_id" value="1">						
						</li>
						<li class="clearfix ">
						<div class="fl left">
							<div class="text1">内测分发下载</div>
							<div class="text2">4,000云币</div>
						</div>
						<div class="fr right">99<span>元</span></div>
						<span class="radio-checked icon icon-checkbox"></span>                          
						<input type="hidden" name="service_id" value="2">						
						</li>
						<li class="clearfix ">
						<div class="fl left">
							<div class="text1">内测分发下载</div>
							<div class="text2">8,000云币</div>
						</div>
						<div class="fr right">199<span>元</span></div>
						<span class="radio-checked icon icon-checkbox"></span>                        
						<input type="hidden" name="service_id" value="3">						
						</li>
					</ul>
				</div>
				<div class="common">
					<div class="tit">数量</div>
					<ul class="clearfix list2">
						<li class="clearfix active">
						<span class="icon icon-radio fl"></span>
						<span>1个</span>
						<input type="hidden" name="price" value="25.00">
						<input type="hidden" name="discount_id" value="1">
						<input type="hidden" name="user" id="user" placeholder="用户名" value="<?php echo $GLOBALS['erduo_in_username'];?>">
						</li>
					</ul>
				</div>
				<div class="common">
					<div class="tit">选择支付方式</div>
					<ul class="clearfix list3">
						<li class="clearfix active" data="1">
						<img src="/static/default/img/pay-1.jpg" alt="">
						<span class="radio-checked icon icon-checkbox"></span>
						</li>
						<li class="clearfix" data="3">
						<img src="/static/default/img/pay-2.jpg" alt="">
						<span class="radio-checked icon icon-checkbox"></span>
						</li>
					</ul>
				</div>
				<div class="pay-money">
					<div class="money">应支付<span>￥25</span></div>
					<a href="javascript:;" class="ms-btn-primary ms-btn toPay">去支付</a>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
    var user_money = parseFloat("0.00");
    $(function () {

        $(".list1").on('click', "li", function () {
            service_id = $(this).find("input[name='service_id']").val();
            console.log($(".money"));
            if(service_id=='1'){
                	$(".money span").text('￥' + 25);
                	$(".list2 li.active input[name='price']").val(25);
                }else if(service_id=='2'){
                	$(".money span").text('￥' + 99);
                	$(".list2 li.active input[name='price']").val(99);
                }else if(service_id=='3'){
                	$(".money span").text('￥' + 199);
                	$(".list2 li.active input[name='price']").val(199);
                }
            /*
            $.getJSON('/source/index/ajax_profile.php?ac=discount', {id: service_id}, function (result) {
                $(".list2").html(result.data.html);
                if (result.data.money > user_money) {
                    $(".price-pay li[data='balance']").addClass('disabled');
                    if ($(".price-pay li[data='balance']").hasClass('active')) {
                        $(".price-pay li[data='balance']").removeClass('active');
                        $(".price-pay li[data='alipay']").addClass('active');
                    }
                } else {
                    $(".price-pay li[data='balance']").removeClass('disabled');
                }
                */
                
            //})
        });

        $(".common").on('click', 'li', function () {
            price = $(".list2 li.active input[name='price']").val();
            quantity = $(".list2 li.active input[name='quantity']").val();
            discount = $(".list2 li.active input[name='discount']").val();
            amount = parseFloat(price);
            if (amount > user_money) {
                $(".price-pay li[data='balance']").addClass('disabled');
                if ($(".price-pay li[data='balance']").hasClass('active')) {
                    $(".price-pay li[data='balance']").removeClass('active');
                    $(".price-pay li[data='alipay']").addClass('active');
                }
            } else {
                $(".price-pay li[data='balance']").removeClass('disabled');
            }
            $(".money span").text('￥' + amount);
        });

        $(document).on('click', '.toPay', function () {
            // 获取套餐
            id = $(".list1 li.active input[name='service_id']").val();
            price = $(".list2 li.active input[name='price']").val();
            user = $(".list2 li.active input[name='user']").val();
            // 获取购买数量
            quantity = $(".list2 li.active input[name='quantity']").val();
            // 获取折扣
            discount_id = $(".list2 li.active input[name='discount_id']").val();
            // 获取支付渠道
            channel = $(".list3 li.active").attr('data');
            if (!discount_id) {
                alert('请选择需要购买的套餐');
                return;
            }

            if (!channel || channel == 'undefined') {
                alert('请选择支付渠道');
                return;
            }

            $(".pay-money a:last").addClass("disabled");
            $(".pay-money a:last").removeClass("toPay");
            /*
			$.ajax({
				async: false,
				type: "POST",
				url: '/codepay/codepay.php',
				data: 'price=' + price + '&user=' + user,
				dataType: 'json',
				success: function (result) {
					$(".pay-money a:last").removeClass("disabled");
					$(".pay-money a:last").addClass("toPay");
					if (result.code != 200) {
						if (result.code == -10001) {
							alert(result.msg, function () {
								window.location.href = '/index.php/login';
							});
						} else {
							alert(result.msg);
						}
						return;
					}
					*/
					form = $("<form target='_blank'></form>");
					form.attr('action', '/codepay/codepay.php');
					form.attr('method', 'get');
					form.append($("<input type='hidden' name='type' value='" + channel + "'/>"));
					form.append($("<input type='hidden' name='price' value='" + price + "' />"));
					form.append($("<input type='hidden' name='user' value='" + user + "' />"));
					form.appendTo("body");
					form.submit();
					setTimeout(function(){
						$('#myModalPay').modal('show');
						$('#myModalPay').find('input[name="order_sn"]').val(result.data.trade_id);
					},10*1000);
			/*		
				}
			});
			*/
        })		
    })
</script>
<div class="modal fade ms-modal" id="myModalPay" tabindex="-1" role="dialog">
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title">购买</h4>
		</div>
		<div class="modal-body">
			<div class="font18 color-333">
				是否完成了购买？
			</div>
			<p class="mt15">
				请在新打开的页面中完成购买，购买完成后，请根据购买结果点击下面的按钮
			</p>
		</div>
		<div class="modal-footer">
            <input type="hidden" name="order_sn" value="">
			<button type="button" class="ms-btn ms-btn-primary complete-pay">支付成功</button>
			<button type="button" class="ms-btn ms-btn-default fail-pay" data-dismiss="modal">支付遇到问题</button>
		</div>
	</div>
</div>
</div>
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
					<a href="javascript:;" target="_blank" class="chatQQ">联系扣扣：1416219317</a>
					</dd>
					<dd>联系邮箱：linke@aeiuui.cn</dd>
					<dd>合作邮箱：hezuo@aeiuui.cn</dd>
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
						地址：天津市领客大厦连接体 6-8座连接体806-7室</span>
					</div>
				</div>
			</div>
		</div>

		<div class="record">
			<div class="inline-block">
				<span class="fl">Copyright &copy; 2018-2021 天津市领客网络科技有限公司 版权所有 <a style="color:#ffffff" href="http://www.miitbeian.gov.cn/" target="_blank">鄂ICP备19018445号-1</a></span>
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
		Copyright © 2018-2021 领客云 <a style="color:#ffffff" href="http://www.miitbeian.gov.cn/" target="_blank">鄂ICP备19018445号-1</a>
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
				window.location.href = "mqqwpa://im/chat?chat_type=wpa&uin=1416219317&version=1&src_type=web&web_src=oicqzone.com";
			} else {
				window.location.href = "http://wpa.qq.com/msgrd?v=3&uin=1416219317&site=qq&menu=yes";
			}
		});
        var source_login = 0;
        if (windowWidth <= 750 && source_login) {
            Modal.templateModal({
                imgName: "modal-bg-3.jpg",
                title1: '提示',
                title2: '',
                p: '建议您：<br>尽快<span class="color-danger">电脑</span>登录领客云网站，即可享受<br><span class="iconfont icon-xingxing" style="color: #fec323; font-size: 12px; margin-right: 5px;"></span>免费试用应用分发APP<br><span class="iconfont icon-xingxing" style="color: #fec323; font-size: 12px; margin-right: 5px;"></span>每天免费赠送<span class="color-danger">10</span>次分发下载次数',
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