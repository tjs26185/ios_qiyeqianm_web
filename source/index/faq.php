<?php
?>
<div class="section packages-faq">
	<div class="packages-faq-wrap text-left">
		<div class="packages-faq-header">FAQ</div>
		<div class="packages-faq-content">
			<ol class="packages-faq-list">
				<li>
				<div class="faq-title">如何扩充应用容量？</div>
				<ol class="faq-list-items">
					<li>1、应用管理 -> 已用容量 -> 扩充容量</li>
					<li>2、注册初始赠送 <?php echo IN_REGSPACE;?> MB容量</li>
				</ol>
				</li>
				<?php if(IN_SPEEDPOINTS){?>
                <li>
				<div class="faq-title">如何升级应用的下载通道？</div>
				<ol class="faq-list-items">
					<li>1、应用管理 -> 管理 -> 基本信息 -> 下载通道</li>
					<li>2、每个应用需单独升级并扣除 <?php echo IN_SPEEDPOINTS;?>下载点数</li>
				</ol>
				</li>
              <?php }				
              if(IN_ADPOINTS){ ?>
              <li>
				<div class="faq-title">如何去除应用安装页的底部广告？</div>
				<ol class="faq-list-items">
					<li>1、应用管理 -> 管理 -> 基本信息 -> 去除广告</li>
					<li>2、每个应用需单独去除并扣除 <?php echo IN_ADPOINTS;?> 下载点数</li>
				</ol>
				</li><?php }?>
          </ol>
		</div>
	</div>
</div>