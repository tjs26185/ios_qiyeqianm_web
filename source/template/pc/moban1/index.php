
<!DOCTYPE html>
<html lang="zh">
<head>
  <meta charset="utf-8" >
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo IN_NAME; ?> - 苹果ios企业超级签名-移动应用内测-免费App应用分发托管-网页封包</title>
  <link rel="icon" href="imgs/fav_icon.png">
  <meta name="description" content="免费 iOS 和 Android 应用分发托管；iOS 自动企业证书签名，免费重签，免费版本更新；HTML5 封装打包；帮助个人或企业开发者在应用内测过程中解放双手提高生产效率。">
  <meta name="keywords" content="<?php echo IN_NAME; ?>,应用分发,Android应用分发,iOS应用托管,苹果企业证书签名,ios签名,ipa签名,ios证书签名,ipa证书签名,ios企业签名,ipa企业签名,ios企业证书重签名,ipa企业证书重签名,app分发,免费托管,内测分发,,iOS,Android,iPad,iPhone,App下载,beta测试,ipa,apk,安卓,苹果应用,二维码下载,网站打包,iOS内测,Android内测,beta test,app store,上架,应用合并">
  <meta property="og:site_name" content="<?php echo IN_NAME; ?> - 移动应用内测|免费App应用分发托管|iOS证书签名|网页封包">
  <meta property="og:description" content="<?php echo IN_NAME; ?>,应用分发,Android应用分发,iOS应用托管,苹果企业证书签名,ios签名,ipa签名,ios证书签名,ipa证书签名,ios企业签名,ipa企业签名,ios企业证书重签名,ipa企业证书重签名,app分发,免费托管,内测分发,,iOS,Android,iPad,iPhone,App下载,beta测试,ipa,apk,安卓,苹果应用,二维码下载,网站打包,iOS内测,Android内测,beta test,app store,上架,应用合并">
  <meta property="og:title" content="<?php echo IN_NAME; ?> - 移动应用内测|免费App应用分发托管|iOS证书签名|网页封包">

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="/source/template/pc/moban1/css/swiper.min.css">
  <link rel="stylesheet" type="text/css" href="/source/template/pc/moban1/css/common.css">
  <link rel="stylesheet" type="text/css" href="/source/template/pc/moban1/css/index.css">
  <script src="/source/template/pc/moban1/js/jquery-3.4.1.min.js"></script>
  <script src="/source/template/pc/moban1/js/swiper.min.js"></script>
</head>
<body class="index-page">
  <header id="header" class="header">
    <div class="module header-module">
      <div class="header-inner module-inner">
        <h1>
          <?php echo IN_NAME; ?>
          <img src="/static/default/img/logo-top.png" alt="">
        </h1>
        <ul  class="menu">
          <li class="active"><a href="#" >首页</a></li>
          <?php if($GLOBALS['userlogined']){ ?>
          <li><a href="/index.php/apps" >我的应用</a></li>
          <?php } ?>	 
          <li><a href="/index.php/price" >价格服务</a></li>
          <li><a href="/index.php/utils" >工具箱</a></li>
          <?php if($GLOBALS['userlogined']){ ?>
		  <li><a href="<?php echo IN_PATH.'index.php/profile'; ?>">用户中心</a> </li>
          <?php }else{ ?>  
          <li><a href="/index.php/login" >登录</a></li>
          <li><a href="/index.php/reg" >注册</a></li>
          <?php } ?>	 
        </ul>
      </div>
    </div>
    <section class="swiper-module">
      <div class="swiper-container" id="bannerSwiper">
        <div class="swiper-wrapper">
          <div class="swiper-slide index-slide" style="z-index: 5;">
            <div class="slide-inner">
              <div class="content">
                <p class="name">应用内测 一站搞定</p>
                <span class="line"></span>
                <div class="desc">
                  <p><?php echo IN_NAME; ?>为数万用户提供一站式应用内测解决方案</p>
                  <p>App 发布 / iOS 签名 / 网页封装</p>
                </div>
                <a class="btn big-btn yellow-btn" href="#">立即使用</a>
              </div>

              <div class="top-banner-bg">
                <img src="/source/template/pc/moban1/img/index-hd-bg.svg">
              </div>

            </div>
          </div>

          <div class="swiper-slide dispatch-slide" style="z-index: 2;">
            <div class="slide-inner">
              <div class="content">
                <p class="name">App 分发托管</p>
                <span class="line"></span>
                <div class="desc">
                  <p>一键上传 iOS 或 Android 应用到<?php echo IN_NAME; ?>  </p>
                  <p>扫描二维码下载安装 </p>
                  <p>实名用户每天送 100,000 下载点</p>
                </div>
                <a class="btn big-btn yellow-btn" href="#">立即使用</a>
              </div>

              <div class="top-banner-bg">
                <img src="/source/template/pc/moban1/img/dispatch-hd-bg.svg">
              </div>

            </div>
          </div>
          
          <div class="swiper-slide sign-slide" style="z-index: 3;">
            <div class="slide-inner">
              <div class="content">
                <p class="name">iOS 企业签名</p>
                <span class="line"></span>
                <div class="desc">
                  <p>使用企业证书签名的 iOS 应用</p>
                  <p>无需提交 App Store </p>
                  <p>就可以实现应用的下载安装</p>
                </div>
                <a class="btn big-btn yellow-btn" href="#">立即使用</a>
              </div>

              <div class="top-banner-bg">
                <img src="/source/template/pc/moban1/img/sign-hd-bg.svg">
              </div>

            </div>
          </div>

          <div class="swiper-slide supersign-slide" style="z-index: 1;">
            <div class="slide-inner">
              <div class="content">
                <p class="name">iOS 超级签名</p>
                <span class="line"></span>
                <div class="desc">
                  <p>告别掉签烦恼 </p>
                  <p>每台设备下载多个应用，只扣费一次 </p>
                </div>
                <a class="btn big-btn yellow-btn" href="#">立即使用</a>
              </div>

              <div class="top-banner-bg">
                <img src="/source/template/pc/moban1/img/supersign-hd-bg.svg">
              </div>

            </div>
          </div>

          <div class="swiper-slide pack-slide" style="z-index: 4;">
            <div class="slide-inner">
              <div class="content">
                <p class="name">封装打包</p>
                <span class="line"></span>
                <div class="desc">
                  <p>只需提供一个网页链接</p>
                  <p>即可将网页制作成 App</p>
                </div>
                <a class="btn big-btn yellow-btn" href="#">立即使用</a>
              </div>

              <div class="top-banner-bg">
                <img src="/source/template/pc/moban1/img/pack-hd-bg.svg">
              </div>

            </div>
          </div>

        </div>
        <div class="page-box">
          <div class="swiper-pagination" id="bannerPage"></div>
        </div>

      </div>
    </section>
  </header>
  <div class="content-list module">
    <div class="module-inner">
      <div class="action-item disapp-item">
        <div class="content">
          <h2>App 分发托管</h2>
          <span class="line"></span>
          <div class="desc">
            <p>一键上传 iOS 或 Android 应用到公孙测</p>
            <p>扫描二维码下载安装</p>
            <p>实名用户每天送 100,000 下载点</p>
          </div>
          <a class="btn big-btn blue-btn" href="#">了解更多</a>
        </div>
        <div class="img-box">
          <img src="/source/template/pc/moban1/img/dispatch-bg.png" alt="">
        </div>
      </div>
    </div>
    <div class="module-inner">
      <div class="action-item sign-item">
        <div class="content">
          <h2>iOS 企业签名</h2>
          <span class="line"></span>
          <div class="desc">
            <p>使用企业证书签名的 iOS 应用</p>
            <p>无需提交 App Store </p>
            <p>就可以实现应用的下载安装</p>
          </div>
          <a class="btn big-btn blue-btn" href="#">了解更多</a>
        </div>
        <div class="img-box">
          <img src="/source/template/pc/moban1/img/sign-bg.png" alt="">
        </div>
      </div>
    </div>
    <div class="module-inner">
      <div class="action-item super-sign-item">
        <div class="content">
          <h2>iOS 超级签名</h2>
          <span class="line"></span>
          <div class="desc">
            <p>告别掉签烦恼</p>
            <p>每台设备下载多个应用，只扣费一次</p>
          </div>
          <a class="btn big-btn blue-btn" href="#">了解更多</a>
        </div>
        <div class="img-box">
          <img src="/source/template/pc/moban1/img/super-sign-bg.png" alt="">
        </div>
      </div>
    </div>
    <div class="module-inner">
      <div class="action-item pack-item">
        <div class="content">
          <h2>网页封装</h2>
          <span class="line"></span>
          <div class="desc">
            <p>只需提供一个网页链接</p>
            <p>即可将网页制作成 App</p>
          </div>
          <a class="btn big-btn blue-btn" href="#">了解更多</a>
        </div>
        <div class="img-box">
          <img src="/source/template/pc/moban1/img/pack-bg.png" alt="">
        </div>
      </div>
    </div>
  </div>
  <div class="app-wall module">
    <div class="module-inner">
      <h3><span>应用墙</span><span>Application wall</span></h3>
      <ul class="wall">
        <li>
          <div>
            <a href="#">
              <img src="/source/template/pc/moban1/img/嘟嘟代练.png" alt="">
            </a>
          </div>
          <p>嘟嘟代练</p>
        </li>
        <li>
          <div>
            <a href="#">
              <img src="/source/template/pc/moban1/img/海宁皮革商城.png" alt="">
            </a>
          </div>
          <p>海宁皮革商城</p>
        </li>
        <li>
          <div>
            <a href="#">
              <img src="/source/template/pc/moban1/img/苍南草根.png" alt="">
            </a>
          </div>
          <p>苍南草根</p>
        </li>
        <li>
          <div>
            <a href="#">
              <img src="/source/template/pc/moban1/img/创业圈.png" alt="">
            </a>
          </div>
          <p>创业圈</p>
        </li>
        <li>
          <div>
            <a href="#">
              <img src="/source/template/pc/moban1/img/江湖派单.png" alt="">
            </a>
          </div>
          <p>江湖派单</p>
        </li>
        <li>
          <div>
            <a href="#">
              <img src="/source/template/pc/moban1/img/屏幕先锋.png" alt="">
            </a>
          </div>
          <p>屏幕先锋</p>
        </li>
      </ul>
    </div>
  </div>
  <div class="cmpy-info module">
    <div class="module-inner gift-inner">
      <p>注册领取多款免费福利</p>
      <div>
        <a class="btn small-btn empty-yellow-btn" href="/index.php/login">免费试用</a>
        <a class="btn small-btn yellow-btn" href="/index.php/reg">立即注册</a>
      </div>
    </div>
    <div class="module-inner cmpy-inner">
      <div class="logo">
        <img src="/static/default/img/logo-top.png" alt="">
      </div>
      <div class="info">
        <div>
          <p>产品概览</p>
          <ul>
            <li><a href="/index.php/publish" title="">分发托管</a></li>
            <li><a href="/index.php/publish" title="">企业签名</a></li>
            <li><a href="/index.php/price" title="">价格服务</a></li>
          </ul>
        </div>
        <div>
          <p>关于我们</p>
          <ul>
            <li><a href="/index.php/about" title="">公司介绍</a></li>
            <li><a href="/index.php/about/agreement" title="">服务协议</a></li>
            <li><a href="/index.php/about/specification" title="">审核规则</a></li>
          </ul>
        </div>
        <div class="about">
          <p>联系我们</p>
          <ul>
            <li><a title="">联系扣扣：<?php echo IN_CONTACT; ?></a></li>
            <li><a title="">客服邮箱：<?php echo IN_MAIL; ?></a></li>
            <li><a title="">公司地址：<?php echo IN_ADDRESS; ?></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="footer module">
    <div class="module-inner">
      <p>© <?php echo IN_COMPANY; ?> <?php echo IN_BUSINESS; ?> <?php echo IN_ICP; ?></p>
      <div class="cert-wrap">
        <a target="cyxyv" target="cyxyv" href="https://v.yunaq.com/certificate?domain=www.hiapp.net"><img style="height: 34px;" src="https://aqyzmedia.yunaq.com/labels/label_sm_90030.png"></a>
        &nbsp;
          <a target="cyxyv" target="cyxyv" href="https://v.yunaq.com/certificate?domain=www.51gsc.com"><img style="height: 34px;" src="https://aqyzmedia.yunaq.com/labels/label_sm_90020.png"></a>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function () {
      var mySwiper = new Swiper('#bannerSwiper', {
        autoplay: true,
        speed: 400,
        pagination: {
          el: '#bannerPage',
          clickable: true,
        },
        spaceBetween: 100,
        duration: 3000
      })
    })
  </script>
  <script>
  </script>
</body>
</html>
