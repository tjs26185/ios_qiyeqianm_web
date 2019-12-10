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
<link rel="stylesheet" href="//at.alicdn.com/t/font_780494_fdjuk9baed7.css" />
<script src="https://js.fundebug.cn/fundebug.1.7.3.min.js" apikey="<?php echo IN_FUNDEBUG; ?>"></script>
<link rel="stylesheet" href="/static/default/css/swiper.min.css" /> 
<link rel="stylesheet" href="/static/default/bootstrap-3.3.7-dist/css/bootstrap.min.css" /> 
<link rel="stylesheet" href="/static/default/css/base.css" /> 
<link rel="stylesheet" href="/static/default/css/main.css" /> 
<link rel="stylesheet" href="/static/default/css/h5.css" />
<script src="/static/default/js/jquery.min.js"></script>
<script src="/static/default/js/bootstrap.min.js"></script>
<script src="/static/default/js/vue.js"></script>
<script src="/static/default/js/js.js"></script>
<script src="/static/default/js/swiper.min.js"></script>
<script src="/static/default/js/vue-countup.min.js"></script>
<link rel="shortcut icon" href="//<?php echo $_SERVER['HTTP_HOST']; ?>/favicon.ico" type="image/x-icon" />
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
                        <a href="<?php echo IN_PATH.'index.php/home'; ?>" class="hidden-xs" style="background: url(/static/default/img/index-banner-3.jpg) no-repeat center;">
                            <div class="container">
                                <div class="banner-con con1 hidden-xs">
                                    <div class="h1">内测发布上传</div>
                                    <div class="h2">
                                        一键上传APP至<?php echo IN_NAME; ?>平台，生成下载链接和二维码，支持安卓苹果应用合并二维码<br>
                                        每天赠送<i>10</i>次下载<span><i>CDN</i>高速下载</span><span>最大支持<i>1.5G</i>的APP</span>
                                    </div>
                                    <button href="#" class="ms-btn">立即发布</button>
                                </div>
                            </div>
                        </a>
                        <a href="<?php echo IN_PATH.'index.php/home'; ?>" class="visible-xs" style="background: url(/static/default/img/index-banner-3.jpg) no-repeat center;">
                            <div class="container">
                                <div class="banner-con con1 visible-xs">
                                    <div class="h1">内测发布上传</div>
                                    <div class="h2">
                                        每天赠送<i>10</i>次下载<span style="margin-left: 10px !important;"><i>CDN</i>高速下载</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="<?php echo IN_PATH.'index.php/sign'; ?>" class="hidden-xs" style="background: url(/static/default/img/index-banner-2.jpg) no-repeat center;">
                            <div class="container">
                                <div class="banner-con con2">
                                    <div class="h1">iOS企业证书签名</div>
                                    <div class="h2">
                                        <?php echo IN_NAME; ?>为您提供iOS企业证书签名服务，让您的APP免上架、免越狱<br>
                                        即可直接安装；7*24小时在线自助签名，更新免费
                                    </div>
                                    <button href="#" class="ms-btn">立即签名</button>
                                </div>
                            </div>
                        </a>
                        <a href="<?php echo IN_PATH.'index.php/sign'; ?>" class="visible-xs" style="background: url(/static/default/img/index-banner-2-1.jpg) no-repeat center;">
                            <div class="container">
                                <div class="banner-con con2 visible-xs">
                                    <div class="h1">iOS企业证书签名</div>
                                    <div class="h2">
                                        7*24小时在线自助签名，无限制安装
                                    </div>
                                </div>
                            </div>
                        </a>
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
						 <a href="<?php echo IN_PATH.'index.php/home'; ?>">
							<div class="img-wrap fl"><img src="/static/default/img/index-1.png?2019031723" class="img-responsive"></div>
							<div class="p-right">
								<div class="tit">超大应用内测分发</div>
								<div class="blue-line"></div>
								<p>支持超大APP上传，生成下载链接和二维码</p>
							</div>
						 </a>
                    </li>
                    <li class="clearfix">
                        <a href="<?php echo IN_PATH.'index.php/sign'; ?>">
                            <div class="img-wrap fl"><img src="/static/default/img/index-2.png?2019031723" class="img-responsive"></div>
                            <div class="p-right">
                                <div class="tit">企业签名</div>
                                <div class="blue-line"></div>
                                <p>免越狱无限制安装，无需上架苹果商店，长久稳定</p>
                            </div>
                        </a>
                    </li>
                    <li class="clearfix">
                        <a href="<?php echo IN_PATH.'index.php/home'; ?>">
                            <div class="img-wrap fl"><img src="/static/default/img/index-3.png?2019031723" class="img-responsive"></div>
                            <div class="p-right">
                                <div class="tit">内测分发</div>
                                <div class="blue-line"></div>
                                <p>一键上传安装包，生成下载链接和二维码，每日免费赠送10次</p>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
  <!--publicity-->
  <!--证书签名-->
  <div class="container"> 
   <div class="certificate-signing index-common"> 
    <h1>iOS企业证书签名</h1> 
    <h4>无需上架，免越狱安装，不限制iOS设备，无限制安装</h4> 
    <div class="row"> 
     <div class="col-sm-4"> 
      <div class="con"> 
       <img src="/static/default/img/icon-1.png" class="img-responsive" alt="" /> 
       <h4>24小时全自动签名</h4> 
       <div class="blue-line"></div> 
       <p> 根据自身需要，购买套餐，<br /> 上传所需签名的APP包，10分钟左右即可测试&amp;取包 </p> 
      </div> 
     </div> 
     <div class="col-sm-4"> 
      <div class="con"> 
       <img src="/static/default/img/icon-2.png" class="img-responsive" alt="" /> 
       <h4>官方企业证书</h4> 
       <div class="blue-line"></div> 
       <p> 专业技术开发团队，拥有国内外<br /> 官方企业签证书，分类签名，保证<br /> APP的长久稳定 </p> 
      </div> 
     </div> 
     <div class="col-sm-4"> 
      <div class="con"> 
       <img src="/static/default/img/icon-3.png" class="img-responsive" alt="" /> 
       <h4>有效期内免费重签</h4> 
       <div class="blue-line"></div> 
       <p> 只要在有效期内，<br /> APP企业签名更新，均为免费 </p> 
      </div> 
     </div> 
    </div> 
   </div>
  </div>
  <!--/证书签名-->
  <!--内测分发-->
  <div class="container"> 
   <div class="index-common closed-beta-distribution"> 
    <h1>内测分发</h1> 
    <h4>上传APP包后，提供短链接和下载二维码，方便用户推广下载 </h4> 
    <div class="row"> 
     <div class="col-sm-3"> 
      <div class="con"> 
       <div class="top"></div> 
       <div class="con-c"> 
        <img src="/static/default/img/index-13.png" class="img-responsive" alt="" /> 
        <h4>实名认证</h4> 
        <p> 实名认证后<br>每天免费赠送100次 </p> 
       </div> 
      </div> 
     </div> 
     <div class="col-sm-3"> 
      <div class="con"> 
       <div class="top"></div> 
       <div class="con-c"> 
        <img src="/static/default/img/index-14.png" class="img-responsive" alt="" /> 
        <h4>支持大应用</h4> 
        <p> 支持1.5G以内大包<br>，快速稳定 </p> 
       </div> 
      </div> 
     </div> 
     <div class="col-sm-3"> 
      <div class="con"> 
       <div class="top"></div> 
       <div class="con-c"> 
        <img src="/static/default/img/index-15.png" class="img-responsive" alt="" /> 
        <h4>二维码安装</h4> 
        <p> 一码二用<br>自动识别不同机型 </p> 
       </div> 
      </div> 
     </div> 
     <div class="col-sm-3"> 
      <div class="con"> 
       <div class="top"></div> 
       <div class="con-c"> 
        <img src="/static/default/img/index-16.png" class="img-responsive" alt="" /> 
        <h4>极速下载</h4> 
        <p> 提供精美的下载模板<br /> 提高用户下载转化率 </p> 
       </div> 
      </div> 
     </div> 
    </div> 
   </div>
  </div>
  <!--/内测分发-->
<div class="ie_dialog" id="incompatible_tip">
	<div>
		<br>
		<table class="ie_notice" style="border:0">
		<tr>
			<td style="text-align: center;">
				<img class="logo_osc" src="/static/default/img/logo-top.png" alt="<?php echo IN_NAME; ?>"/>
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