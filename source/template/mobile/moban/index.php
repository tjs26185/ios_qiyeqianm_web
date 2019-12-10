
<!DOCTYPE html>
<html lang="zh_CN"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
  <title><?php echo IN_NAME; ?>  -  免费应用分发托管平台|IOS应用内测分发|Android应用内测分发|苹果企业签名|网页一键封装|免费分发平台</title>
  <meta name="keywords" content="<?php echo IN_NAME; ?>,免费分发,免费分发平台,IOS企业签名,苹果企业签名,Android应用分发,IOS应用分发,苹果签名,网页一键封装,网址打包,网址封装,网页封装,苹果打包">
  <meta name="description" content="<?php echo IN_NAME; ?>提供制作苹果IOS、安卓Android手机APP、内测分发托管、ios企业签名、版本自动更新等功能,是一家高效的移动应用解决方案的服务平台。">



  <link href="/source/template/pc/moban/css/font-awesome.min.css" rel="stylesheet">
  <link href="/source/template/pc/moban/css/themify-icons.css" rel="stylesheet">



  <link href="/source/template/pc/moban/css/bootstrap.min.css" rel="stylesheet">
  <link href="/source/template/pc/moban/css/owl.carousel.min.css" rel="stylesheet">



  <link href="/source/template/pc/moban/css/styles.css" rel="stylesheet">
  <link href="/source/template/pc/moban/css/default.css" rel="stylesheet" id="color_theme">



  <link rel="icon" type="image/x-icon" href="favicon.ico">

</head>


<body data-spy="scroll" data-target="#navbar" data-offset="98" data-gr-c-s-loaded="true">


  <div id="loading" style="display: none;">
    <div class="load-circle"><span class="one"></span></div>
  </div>



  <header>
    <nav class="navbar header-nav fixed-top navbar-expand-lg">
      <div class="container">

        <a class="navbar-brand" href=""><?php echo IN_NAME; ?></a>



        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span></span>
            <span></span>
            <span></span>
        </button>



        <div class="collapse navbar-collapse justify-content-end" id="navbar">
          <ul class="navbar-nav">
            <li><a class="nav-link active" href="#homea">主页</a></li>
            <?php if($GLOBALS['userlogined']){ ?>
			<li><a class="nav-link" href="<?php echo IN_PATH.'index.php/apps'; ?>">我的应用</a> </li>
			<?php } ?>						
            <li><a class="nav-link" href="/index.php/price">价格</a></li> 
            <li><a class="nav-link" href="/index.php/feedback">建议反馈</a></li> 
            <li><a class="nav-link" href="/index.php/about">关于我们</a></li> 
            <li><a class="nav-link" href="/index.php/utils">工具箱</a></li> 
            <?php if($GLOBALS['userlogined']){ ?>
			<li><a class="nav-link" href="<?php echo IN_PATH.'index.php/profile'; ?>">用户中心</a> </li>
			<?php }else{ ?>             
            <li><a class="nav-link" href="/index.php/login">立即登陆</a></li>
            <li><a class="nav-link" href="/index.php/reg">免费注册</a></li>
			<?php } ?>	
          </ul>
        </div>


      </div>
    </nav> 
  </header>

  <main>


    <section id="homea" class="home-banner-02 theme-g-bg">
      <div class="bg-effect">
        <img src="/source/template/pc/moban/img/bg-effect-1.svg" title="" alt="">
      </div>
      <div class="container">
        <div class="row full-screen align-items-center">
          <div class="col col-md-10 col-lg-7 col-xl-6 p-80px-tb md-p-30px-b">
            <div class="home-text-center theme-after m-50px-t md-m-20px-t">
              <h1 class="font-alt">应用内测</h1>
              <p>
				<?php echo IN_NAME; ?>提供专业的手机应用内测服务，您只需将需要内测的应用上传至<?php echo IN_NAME; ?>，生成二维码，内测用户通过在手机上扫描二维码，即可将内测应用安装至手机等设备中进行测试。
				</p>
              <div class="app-btn-set">
                <a href="/index.php/apps" class="m-btn m-btn-white" data-text="Apply Now">立即上传</a>
              </div>
            </div> 
          </div> 
          <div class="col-md-12 col-lg-5 col-xl-6 home-right">           
              <img src="/source/template/pc/moban/img/host1.png" title="" alt="">
          </div>
        </div>

      </div>
      
    </section>



    <section id="about" class="section gray-bg">
      <div class="container">
        <div class="row">

          <div class="col-lg-5 col-md-4 m-30px-b">
            <div class="about-list">
              <ul>
                <li><i class="ti-check"></i>兼容性测试</li>
                <li><i class="ti-check"></i>安全性测试</li>
                <li><i class="ti-check"></i>iOS 企业证书签名</li>
                <li><i class="ti-check"></i>iOS 加速审核</li>
                <li><i class="ti-check"></i>iOS 上线预审</li>
                <li><i class="ti-check"></i>App Store 视频制作</li>
              </ul>
            </div>
          </div>

          <div class="col-md-8 col-lg-7">
            <div class="about-feature">
              <h2 class="font-alt">我们的优势</h2>
              <div class="row">
                <div class="col-12 col-md-6 m-30px-t">
                  <div class="feature-box-06">
                    <i class="icon ti-check-box"></i>
                    <div class="feature-content">
                      <h5>应用分发</h5>
                      <p>将应用安装包一键上传到<?php echo IN_NAME; ?>，内测用户即可通过短链接或扫描二维码一键安装；让内测应用分发变得便捷、高效。</p>
                    </div>
                  </div> 
                </div> 

                <div class="col-12 col-md-6 m-30px-t">
                  <div class="feature-box-06">
                    <i class="icon ti-rocket"></i>
                    <div class="feature-content">
                      <h5>内测托管</h5>
                      <p>拥有版本更新提示、数据分析统计、应用内提交用户反馈等功能，不漏掉应用内测中出现的问题，让应用开发更轻松。</p>
                    </div>
                  </div> 
                </div> 

                <div class="col-12 col-md-6 m-30px-t">
                  <div class="feature-box-06">
                    <i class="icon ti-headphone"></i>
                    <div class="feature-content">
                      <h5>Web Hooks</h5>
                      <p>应用更新时团队成员会收到更新邮件，添加Web Hooks的第三方平台也会有更新消息提醒。（已支持 Slack、简聊、BearyChat、纷云、瀑布 IM等）</p>
                    </div>
                  </div> 
                </div>

                <div class="col-12 col-md-6 m-30px-t">
                  <div class="feature-box-06">
                    <i class="icon ti-flag-alt"></i>
                    <div class="feature-content">
                      <h5>自动更新</h5>
                      <p>内测版本发布频率太高，担心内测用户没有及时更新？不用怕，<?php echo IN_NAME; ?>会在内测版本更新时提醒用户，告别版本混乱。</p>
                    </div>
                  </div> 
                </div> 
              </div> 
            </div>
          </div> 

 
          

        </div>
      </div>
    </section>


    <section id="apple" class="section">
      <div class="container">
          <div class="row align-items-center justify-content-center">
            <div class="col-md-5 order-md-2 sm-m-30px-b">
              <div class="feature-box-04">
                
                <h4 class="font-alt">iOS 企业证书签名</h4>
                <p><?php echo IN_NAME; ?>为您提供 iOS 企业证书签名服务，让您的 iOS App 无需提交 App Store 或设置 UDID 即可在iPhone、iPad 等设备上直接安装，帮助您快速完成应用内测过程，降低测试成本，缩短上线时间。</p>
				  
				  <p><sup>iOS App 使用企业证书签名后，即可免提交苹果 App Store 审核，让用户安装至iOS系统的手机、平板，没有安装数量限制；无需越狱。</sup></p>
                <ul class="fb4-list-type m-30px-b m-20px-t p-0px">
                  <li>
                    <i class="ti-control-forward"></i> 苹果官方企业证书
                  </li>
                  <li>
                    <i class="ti-control-forward"></i> 一对一客户服务
                  </li>
                  <li>
                    <i class="ti-control-forward"></i> 独家技术服务稳定
                  </li> 
                </ul>
                <a href="/index.php/publish" class="m-btn m-btn-theme">立即签名</a>
              </div>
            </div>

            <div class="col-md-6 text-center">
              <img src="/source/template/pc/moban/img/feature-01.png" title="" alt="">
            </div>
          </div> 
      </div>
    </section>
   
 

    


    <section id="contatus" class="section gray-bg">
      <div class="container">
        <div class="row justify-content-center m-45px-b sm-m-25px-b">
          <div class="col-12 col-md-10 col-lg-7">
            <div class="section-title text-center">
              <h2 class="font-alt">技术支持与联系</h2>
              <div class="title-border"><span class="lg"></span><span class="md"></span><span class="sm"></span></div>
              <p>遇到任何问题或疑问？别担心，请与我们联系</p>
            </div>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-md-6 col-lg-4">
            <div class="contact-info theme-g-bg">
              <div class="ci-row">
                <label>联系邮箱</label>
                <span><?php echo IN_MAIL; ?></span>
              </div>
              <div class="ci-row">
                <label>合作邮箱</label>
                <span><?php echo IN_COOPERATION; ?></span>
              </div>
              <div class="ci-row">
                <label>联系扣扣</label>
                <span><?php echo IN_CONTACT; ?></span>
              </div>
              
            </div>
          </div>
          <div class="col-md-6 col-lg-6">
            <div class="contact-form">
                    <h2>上传应用</h2>
                    如果您还没有<?php echo IN_NAME; ?>账号，请使用自助免费注册系统
              ，一键上传APP安装包，提供短链接和下载二维码，方便用户下载测试
              ，iOS企业证书签名无需上架，免越狱安装，不限制iOS设备，无限制安装
              ，只要一个ipa文件，5分钟快速在线签名APP应用
				<p></p>
				<a href="/index.php/reg" class="m-btn-theme m-btn">前往自助免费注册系统</a>
                          </div>
			  
                          </div>
                        </div>
                </div>
    </section>

    
  </main>



  <footer class="footer theme-bg">
    <section class="footer-section">
      <div class="container">
        <div class="row">
          <div class="col-md-3 col-lg-5 sm-m-15px-tb">
            <h4 class="font-alt">关于<?php echo IN_NAME; ?></h4>
            <p class="footer-text"><?php echo IN_NAME; ?>提供制作苹果IOS、安卓Android手机APP、内测分发托管、ios企业签名、版本自动更新等功能,是一家高效的移动应用解决方案的服务平台。</p>
            
          </div> 

          <div class="col-6 col-md-3 col-lg-2 sm-m-15px-tb">
            <h4 class="font-alt">快速链接</h4>
            
            <ul class="fot-link">
              <li><a href="/index.php/publish">上传应用</a></li>
              <li><a href="/index.php/price">价格栏目</a></li>
				<li><a href="#top">返回顶部</a></li>
              
            </ul>
          </div>

          <div class="col-6 col-md-3 col-lg-2 sm-m-15px-tb">
            <h4 class="font-alt">关于我们</h4>
            <ul class="fot-link">
            <li><a href="/index.php/about">公司简介</a></li>
            <li><a href="/index.php/about/privacy">隐私政策</a></li>
            <li><a href="/index.php/about/log">更新日志</a></li>        
              </ul>
          </div>

         <div class="col-md-3 col-lg-3 sm-m-15px-tb">
            <h4 class="font-alt">联系我们</h4>
            <p>客服扣扣：<?php echo IN_CONTACT; ?><br>
           合作邮箱：<?php echo IN_COOPERATION; ?><br>
           联系邮箱：<?php echo IN_MAIL; ?><br>
          </div>

        </div>
        
        <div class="footer-copy">
          <div class="row">
            <div class="col-12">
              <p>&copy; Copyright <?php echo IN_BUSINESS; ?> <?php echo IN_COMPANY; ?>. 版权所有 <?php echo IN_ICP; ?> </p>
            </div>
          </div> 
        </div>

      </div>
        
    </section>
  </footer>


  <script src="/source/template/pc/moban/js/jquery.min.js"></script>
  <script src="/source/template/pc/moban/js/jquery-migrate.min.js"></script>


  <script src="/source/template/pc/moban/js/popper.min.js"></script>
  <script src="/source/template/pc/moban/js/bootstrap.js"></script>
  <script src="/source/template/pc/moban/js/owl.carousel.min.js"></script>
  <script src="/source/template/pc/moban/js/jquery.magnific-popup.min.js"></script>


  <script src="/source/template/pc/moban/js/custom.js"></script>
  
  <script language="javascript" src="http://count32.51yes.com/click.aspx?id=327785726&logo=12" charset="gb2312"></script>


</body></html>