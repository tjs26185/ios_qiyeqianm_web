<?php
if(!defined('IN_ROOT'))
{
	exit('Access denied');
}
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0" />
<meta name="keywords" content="<?php echo IN_KEYWORDS; ?>" />
<meta name="description" content="<?php echo IN_DESCRIPTION; ?>" />
<title><?php echo IN_NAME; ?> - 免费应用内测托管平台|iOS应用Beta测试分发|Android应用内测分发</title>
<link rel="stylesheet" href="//<?php echo IN_RIGOROUS; ?>/index/css/font.css" />
<link rel="stylesheet" href="//<?php echo IN_RIGOROUS; ?>/index/css/swiper.min.css" /> 
<link rel="stylesheet" href="//<?php echo IN_RIGOROUS; ?>/index/css/bootstrap.min.css" /> 
<link rel="stylesheet" href="//<?php echo IN_RIGOROUS; ?>/index/css/base.css" /> 
<link rel="stylesheet" href="//<?php echo IN_RIGOROUS; ?>/index/css/main.css" /> 
<link rel="stylesheet" href="//<?php echo IN_RIGOROUS; ?>/index/css/h5.css" />
<link rel="stylesheet" href="//<?php echo IN_RIGOROUS; ?>/index/css/main.css" /> 
<script src="//<?php echo IN_RIGOROUS; ?>/index/js/jquery.min.js"></script>
<script src="//<?php echo IN_RIGOROUS; ?>/index/js/bootstrap.min.js"></script>
<script src="//<?php echo IN_RIGOROUS; ?>/index/js/vue.js"></script>
<script src="//<?php echo IN_RIGOROUS; ?>/index/js/js.js"></script>
<script src="//<?php echo IN_RIGOROUS; ?>/index/js/swiper.min.js"></script>
<script src="//<?php echo IN_RIGOROUS; ?>/index/js/vue-countup.min.js"></script>
<script>        
	isHideFooter = false;
</script>
</head>
<body>
<?php include 'source/index/header.php'; ?>
<script>
    isHideFooter = false;
</script>
<style>
    .ie_dialog {
        position: fixed;
        z-index: 10000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: #FAFAFA !important;
        display: none;
    }
    .ie_dialog table{
        margin: 100px auto;
    }
    .ie_notice .logo_osc {
        display: block;
        margin: 0 auto;
        padding-bottom: 24px;
    }

    .ie_notice h2, .ie_notice h4 {
        margin: 0;
        text-align: center;
    }

    .ie_notice .title {
        font-size: 28px;
        color: #4A4A4A;
    }

    .ie_notice .subtitle {
        font-size: 20px;
        color: #9B9B9B;
        font-weight: normal;
    }

    .ie_notice .ie_box {
        width: 560px;
        margin: 24px auto;
        background: #FFFFFF;
        border: 1px solid #E6E6E6;
        box-shadow: 0 2px 0 0 rgba(0, 0, 0, 0.10);
        border-radius: 4px;
        display: table !important;
    }

    .ie_notice .ie_box .desc {
        font-size: 14px;
        color: #6D6D6D;
        line-height: 22px;
        padding: 20px;
    }

    .ie_notice .ie_box a {
        display: inline-block;
        width: 30%;
        text-align: center;
    }

    .ie_notice .ie_box .go {
        width: 100%;
        background: #F6F6F6;
        font-size: 16px;
        color: #9B9B9B;
        padding: 16px 0;
        text-align: center;
        border: none;
        margin-top: 20px;
        text-decoration: none;
    }

    .ie_notice .ie_box a img {
        border: none;
    }
</style>
        <!--banner-->
        <div class="index-banner">
<div class="swiper-container">
<div class="swiper-wrapper">
<div class="swiper-slide">
<a href="/index.php/publish" class="hidden-xs" style="background: url(//<?php echo IN_RIGOROUS; ?>/index/img/index-banner-1.jpg) no-repeat center;">
<div class="container">
<div class="banner-con con1 hidden-xs">
<div class="h1">内测发布上传</div>
<div class="h2">
一键上传APP至<?php echo IN_NAME; ?>平台，生成下载链接和二维码，支持安卓苹果应用合并二维码<br>
每天赠送<i><?php echo IN_LOGINPOINTS; ?></i>云币<span><i>CDN</i>高速下载</span><span>最大支持<i>1.5G</i>的APP</span>
</div>
<button href="#" class="ms-btn">立即发布</button>
</div>
</div>
</a>
</div>
<div class="swiper-slide">
<a href="#" class="hidden-xs" style="background: url(//<?php echo IN_RIGOROUS; ?>/index/img/index-banner-3.jpg) no-repeat center;" class="clearfix">
<div class="container">
<div class="banner-con con3">
<div class="h1">在线封装APP</div>
<div class="h2">
只需一个网站链接，即可在线封装生成APP；根据功能需求，任意插件配置，2分钟封装完成<br>
<?php echo IN_NAME; ?>提供免费试用，封装好APP可以随时重新编辑，让您的APP尽快与用户见面
</div>
<button href="#" class="ms-btn">立即封装</button>
</div>
</div>
</a>
</div>
<div class="swiper-slide" id="sign-div">
<a href="#" class="hidden-xs" style="background: url(//<?php echo IN_RIGOROUS; ?>/index/img/index-banner-2.jpg) no-repeat center;">
<div class="container">
<div class="banner-con con2">
<div class="h1">企业证书 APP签名</div>
<div class="h2">
使用企业签名后，APP可以免于提交商店审核，直接安装到手机和平板上<br>
24小时自助在线签名，无限制安装<br>
1天免费试用
</div>
<button href="#" class="ms-btn">立即签名</button>
</div>
</div>
</a>
</div>
<div class="swiper-slide" id="pack-div">
<a href="#" class="hidden-xs" style="background: url(//<?php echo IN_RIGOROUS; ?>/index/img/index-banner-4.jpg) no-repeat center;" class="clearfix">
<div class="container">
<div class="banner-con con4 hidden-xs">
<div class="h1">永不闪退版苹果APP在线封装</div>
<div class="h2">
<?php echo IN_NAME; ?>全球首创技术，永久解决苹果APP签名闪退的问题<br>
在线打包苹果APP，不用企业签名，无需上架，直接安装<br>
100%完美适配移动端
</div>
<button href="#"class="ms-btn">查看详情</button>
</div>
</div>
</a>
</div>
</div>

<div class="swiper-pagination"></div>


</div>
</div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
                <!-- Add Arrows -->
                <!--
                        <div class="swiper-button-next"><span class="iconfont icon-arrow-right"></span></div>
                        <div class="swiper-button-prev"><span class="iconfont icon-arrow-left"></span></div>
                -->
            </div>
        </div>
        <!--/banner-->
  <!--publicity-->
        <div class="publicity-wrap">
            <div class="container">
                <ul class="publicity clearfix">
                    <li class="clearfix">
						 <a href="#">
							<div class="img-wrap fl"><img src="/static/default/img/index-1.png" class="img-responsive"></div>
							<div class="p-right">
								<div class="tit">超大应用内测分发</div>
								<div class="blue-line"></div>
								<p>支持超大APP上传，生成下载链接和二维码</p>
							</div>
						 </a>
                    </li>
                    <li class="clearfix">
                        <a href="#">
                            <div class="img-wrap fl"><img src="/static/default/img/index-2.png" class="img-responsive"></div>
                            <div class="p-right">
                                <div class="tit">企业签名</div>
                                <div class="blue-line"></div>
                                <p>免越狱无限制安装，无需上架苹果商店，长久稳定</p>
                            </div>
                        </a>
                    </li>
                    <li class="clearfix">
                        <a href="#">
                            <div class="img-wrap fl"><img src="/static/default/img/index-3.png" class="img-responsive"></div>
                            <div class="p-right">
                                <div class="tit">内测分发</div>
                                <div class="blue-line"></div>
                                <p>上传安装包，生成下载链接，每日免费赠送<?php echo IN_LOGINPOINTS; ?>云币</p>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
  <!--在线签名-->
<div class="container">
<div class="index-encapsulation index-common">
<h1>在线签名APP</h1>
<h4>只要一个ipa文件，5分钟极速签名APP</h4>
<ul class="clearfix e-list">
<li>
<div class="ms-thumbnail">
<img src="/static/default/img/index-4.png" class="img-responsive">
<div class="ms-caption">
<div class="tit">快速</div>
<p>七牛云CND极速上传<br>国外G口极速下载</p>
</div>
</div>
</li>
<li>
<div class="ms-thumbnail">
<img src="/static/default/img/index-5.png" class="img-responsive">
<div class="ms-caption">
<div class="tit">免费试用</div>
<p>任何一款APP都可测试签名<br>方便用户测试</p>
</div>
</div>
</li>
<li>
<div class="ms-thumbnail">
<img src="/static/default/img/index-6.png" class="img-responsive">
<div class="ms-caption">
<div class="tit">自助式</div>
<p>在线自助操作点点鼠标<br>即可在线签名APP</p>
</div>
</div>
</li>
<li>
<div class="ms-thumbnail">
<img src="/static/default/img/index-7.png" class="img-responsive">
<div class="ms-caption">
<div class="tit">证书多</div>
<p>提供3个独立证书签名<br>备用5个证书替换</p>
</div>
</div>
</li>
<li>
<div class="ms-thumbnail">
<img src="/static/default/img/index-8.png?201901" class="img-responsive">
<div class="ms-caption">
<div class="tit">主动适配</div>
<p>适配安卓和苹果的主流机型<br>均可在线内测分发</p>
</div>
</div>
</li>
</ul>
<a class="ms-btn ms-btn-secondary ms-btn-lg" href="/index.php/apps">立即签名</a>
</div>
</div>
 
<!--证书签名-->
<div class="index-signature-wrap">
<div class="container">
<div class="index-signature index-common">
<h1>iOS企业证书签名</h1>
<h4>无需上架，免越狱安装，不限制iOS设备，无限制安装</h4>
<div class="row">
<div class="col-sm-6">
<div class="con clearfix">
<div class="img-wrap fl"><img src="/static/default/img/index-9.png" class="img-responsive"></div>
<dl>
<dt>24小时全自动签名</dt>
<dd>7*24小时全自动企业证书签名，随时随地上传APP，即可签名</dd>
</dl>
</div>
</div>
<div class="col-sm-6">
<div class="con clearfix">
<div class="img-wrap fl"><img src="/static/default/img/index-10.png" class="img-responsive"></div>
<dl>
<dt>有效期内免费重签</dt>
<dd>只要在有效期内，APP企业签名更新，均为免费</dd>
</dl>
</div>
</div>
<div class="col-sm-6">
<div class="con clearfix">
<div class="img-wrap fl"><img src="/static/default/img/index-11.png" class="img-responsive"></div>
<dl>
<dt>消息推送</dt>
<dd>给已安装APP的用户推送消息或通知，提高APP的活跃</dd>
</dl>
</div>
</div>
<div class="col-sm-6">
<div class="con clearfix">
<div class="img-wrap fl"><img src="/static/default/img/index-12.png" class="img-responsive"></div>
<dl>
<dt>官方证书，安全稳定</dt>
<dd>拥有国内外官方企业签名证书，专业的开发团队，分类签名，将保证APP企业签名的安全稳定</dd>
</dl>
</div>
</div>
</div>
<a class="ms-btn ms-btn-lg more" href="/index.php/apps">了解更多</a>
</div>
</div>
</div>

<!--内测发布-->
<div class="container">
<div class="index-releas index-common">
<h1>内测发布上传</h1>
<h4>一键上传APP安装包，提供短链接和下载二维码，方便用户下载测试</h4>
<div class="row">
<div class="col-sm-3 col-xs-6">
<div class="ms-thumbnail">
<img src="/static/default/img/index-13.png" class="img-responsive">
<div class="ms-caption">
<div class="tit">注册账号后<br>每天免费赠送<?php echo IN_LOGINPOINTS; ?>云币</div>
</div>
</div>
</div>
<div class="col-sm-3 col-xs-6">
<div class="ms-thumbnail">
<img src="/static/default/img/index-14.png" class="img-responsive">
<div class="ms-caption">
<div class="tit">1.5G以内大包<br>且支持一包多传</div>
</div>
</div>
</div>
<div class="col-sm-3 col-xs-6">
<div class="ms-thumbnail">
<img src="/static/default/img/index-15.png" class="img-responsive">
<div class="ms-caption">
<div class="tit">一码二用<br>自动识别不同机型</div>
</div>
</div>
</div>
<div class="col-sm-3 col-xs-6">
<div class="ms-thumbnail">
<img src="/static/default/img/index-16.png" class="img-responsive">
<div class="ms-caption">
<div class="tit">提供多套下载模板<br>以及APP官网模板</div>
</div>
</div>
</div>
</div>
<a class="ms-btn ms-btn-secondary ms-btn-lg" href="/index.php/publish">立即发布</a>
</div>
</div>
  <!--技术成就-->
  <div class="cumulative-wrap">
            <div class="container">
                <div class="index-cumulative index-common">
                    <h1>
                        3年产品技术积累，成就非凡品质
                    </h1>
                    <div class="row">
                        <div class="col-sm-4 col-xs-4">
                            <div class="num num_br">
                                <span>
                             <?php echo IN_AUTOGRAPH; ?>
                                </span>
                            </div>
                            <div class="text text0">
                                累计在线签名
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-4">
                            <div class="num num_br">
                                <span>
                                    <?php echo IN_DISTRIBUTE; ?>
                                </span>
                            </div>
                            <div class="text text1">
                                累计内测分发APP
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-4">
                            <div class="num">
                                <span>
                                    <?php echo IN_DOWNLOAD; ?>
                                </span>
                            </div>
                            <div class="text text2">
                                累计内测下载APP
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  
    <!--合作伙伴-->
  <div class="container">
<div class="index-common index-partners">
<h1>合作伙伴</h1>
<ul class="p-list clearfix">
<li>
<div class="con">
<img class="img-responsive" src="/static/default/img/index-17.png">
<p>巨人网络是一家集研发、运营发行于一体的综合性娱乐互动企业。</p>
</div>
</li>
<li>
<div class="con">
<img class="img-responsive" src="/static/default/img/index-18.png">
<p>比格云提供新一代高性能云主机的服务商。</p>
</div>
</li>
<li>
<div class="con">
<img class="img-responsive" src="/static/default/img/index-19.png">
<p>游久网为用户提供完整庞大和专业游戏资讯的社区网络服务。</p>
</div>
</li>
<li>
<div class="con">
<img class="img-responsive" src="/static/default/img/index-20.png">
<p>中青宝是一家具有自主研发、运营和代理能力专业化网络游戏公司。</p>
</div>
</li>
<li>
<div class="con">
<img class="img-responsive" src="/static/default/img/index-21.png">
<p>盛大游戏是中国领先的互动娱乐内容运营平台。</p>
</div>
</li>
<li>
<div class="con">
<img class="img-responsive" src="/static/default/img/index-22.png">
<p>触控科技专注于苹果iOS产品和手游开发运营。</p>
</div>
</li>
<li>
<div class="con">
<img class="img-responsive" src="/static/default/img/index-23.png">
<p>4399是中国最早和领先的在线休闲小游戏平台。</p>
</div>
</li>
<li>
<div class="con">
<img class="img-responsive" src="/static/default/img/index-24.png">
<p>昆仑游戏是手游、页游、端游的研发与发行平台。</p>
</div>
</li>
<li>
<div class="con">
<img class="img-responsive" src="/static/default/img/index-25.png">
<p>七牛云-企业级云服务商，专注于以视觉智能和数据智能为核心的云计算业务。</p>
</div>
</li>
<li>
<div class="con">
<img class="img-responsive" src="/static/default/img/index-26.png">
<p>游族网络是中国互动娱乐供应商，提供游戏研发与发行、大数据与智能化服务。</p>
</div>
</li>
</ul>
</div>
</div>
  <!--/内测分发-->
<div class="ie_dialog" id="incompatible_tip">
	<div>
		<br>
		<table class="ie_notice" style="border:0">
		<tr>
			<td style="text-align: center;">
				<img class="logo_osc" src="/static/default/img/logo-top.png" alt="领客云"/>
			</td>
		</tr>
		<tr>
			<td>
				<h2 class="title">我们不支持 IE 10 及以下版本浏览器</h2>
			</td>
		</tr>
		<tr>
			<td>
				<h4 class="subtitle">It appears you’re using an unsupported browser</h4>
			</td>
		</tr>
		<tr>
			<td>
				<div class="ie_box">
					<div class="desc">
						为了获得更好的浏览体验，我们强烈建议您使用较新版本的 Chrome、 Firefox、 Safari、360 等，或者升级到最新版本的IE浏览器。 如果您使用的是
						IE 11 或以上版本，请关闭“兼容性视图”。
					</div>
					<div class="logos">
						<a href="http://www.google.cn/chrome/browser/desktop/index.html" target="_blank" title="下载Chrome浏览器">
						<img src="/static/default/images/logo_chrome.png" width="200px"/>
						</a>
						<a href="http://www.firefox.com.cn" target="_blank" title="下载Firefox浏览器">
						<img src="/static/default/images/logo_firefox.png" width="100px"/>
						</a>
						<a href="http://browser.360.cn/" target="_blank" title="下载360浏览器">
						<img src="/static/default/images/logo_360.png" width="100px"/>
						</a>
					</div>
					<div>
						<a href="javascript:void(0);" onclick="document.getElementById('incompatible_tip').style.cssText = 'display:none;';" class="go">继续访问</a>
					</div>
				</div>
			</td>
		</tr>
		</table>
	</div>
</div>
<div class="modal fade ms-modal" id="showModalNotice" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><?php echo IN_NAME; ?>网站公告</h4>
			</div>
			<div class="modal-body">
				<p class="mt15">
					<?php echo IN_ANNOUNCEMENT; ?>
				</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="ms-btn ms-btn-primary contactQQ">联系客服</button>
				<button type="button" class="ms-btn ms-btn-default" data-dismiss="modal">关闭</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="/static/default/js/jquery.cookie.js?20190516"></script>
<script>
    var isIE = (function () {
        var browser = {};
        return function (ver, c) {
            var key = ver ? ( c ? "is" + c + "IE" + ver : "isIE" + ver ) : "isIE";
            var v = browser[key];
            if (typeof(v) != "undefined") {
                return v;
            }
            if (!ver) {
                v = (navigator.userAgent.indexOf('MSIE') !== -1 || navigator.appVersion.indexOf('Trident/') > 0);
            } else {
                var match = navigator.userAgent.match(/(?:MSIE |Trident\/.*; rv:|Edge\/)(\d+)/);
                if (match) {
                    var v1 = parseInt(match[1]);
                    v = c ? ( c == 'lt' ? v1 < ver : ( c == 'gt' ? v1 > ver : undefined ) ) : v1 == ver;
                } else if (ver <= 9) {
                    var b = document.createElement('b')
                    var s = '<!--[if ' + (c ? c : '') + ' IE ' + ver + ']><i></i><![endif]-->';
                    b.innerHTML = s;
                    v = b.getElementsByTagName('i').length === 1;
                } else {
                    v = undefined;
                }
            }
            browser[key] = v;
            return v;
        };
    }());

    if (isIE()) {
        document.getElementById('incompatible_tip').style.cssText = 'display:block;';
    }

</script>
<script>
    $(function () {
        if (!$.cookie('contactQQ')) {
            $("#showModalNotice").modal("show");
            $.cookie('contactQQ', '1', {expires: 1});
        }
        $(".contactQQ").on('click', function () {
            $.cookie('contactQQ', '1', {expires: 1});
            $(".chatQQ").trigger('click');
            $("#showModalNotice").modal("hide");
        });

        var mySwiper = new Swiper('.index-banner .swiper-container', {
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true
            },
            loop: true,
            speed: 800,
            autoplay: {
                delay: 4000,
                stopOnLastSlide: false,
                disableOnInteraction: true
            }
        });
    })

</script>
<?php include 'source/index/footer.php'; ?>
</body>
</html>