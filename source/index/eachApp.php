<?php
if (!defined('IN_ROOT')) {
    exit('Access denied');
}
if (!$GLOBALS['userlogined']) {
    exit(header('location:' . IN_PATH . 'index.php/login'));
}
$app = explode('/', $_SERVER['PATH_INFO']);
$id = intval(isset($app[2]) ? $app[2] : NULL);
$row = $GLOBALS['db']->getrow("select * from " . tname('app') . " where in_uid=" . $GLOBALS['erduo_in_userid'] . " and in_id=" . $id);
$row or exit(header('location:' . IN_PATH));
$form = $row['in_form'] == 'Android' ? 'iOS' : 'Android';
$query = $GLOBALS['db']->query("select * from " . tname('app') . " where in_form='" . $form . "' and in_kid=0 and in_uid=" . $GLOBALS['erduo_in_userid'] . "  and shan=0  order by in_addtime desc");
$ron = $GLOBALS['db']->getrow("select * from " . tname('user') . " where in_userid=".$GLOBALS['erduo_in_userid']);
?>
<script type="text/javascript">
var in_path = '<?php echo IN_PATH;?>';
var in_time = '<?php echo $GLOBALS['erduo_in_userid'].'-'.time();?>';
var in_upw = '<?php echo $GLOBALS['erduo_in_userpassword'];?>';
var in_uid = <?php echo $GLOBALS['erduo_in_userid'];?>;
var in_id = <?php echo $id;?>;
var in_size = <?php echo intval(ini_get('upload_max_filesize'));?>;
var remote = {'open':'<?php echo IN_REMOTE;?>','dir':'<?php echo IN_REMOTEPK;?>','version':'<?php echo version_compare(PHP_VERSION,'5.5.0');?>'};
</script>

<section class="ng-scope">
<div class="page-app app-security">
	
	<?php if($GLOBALS['erduo_in_qq'] == '136245992'){ echo '我操你妈'; }?>
    <div class="ng-scope">
		<div class="apps-app-combo page-tabcontent ng-scope">
			<div class="middle-wrapper">
				<?php if($row['in_kid']){?>
                  <div class="request-wrapper">
					<p class="lead text-center ng-scope">已经与 <b><?php echo getfield('app','in_name','in_id',$row['in_kid']);?></b> 合并</p>
					
					
					
					
					<div id="cancel_container">
						
					<div class="col-md-5 text-center">
						<div class="funny-boxes-img">
							<a href="<?php echo IN_API . 'app.php/' . $row['in_id'];?>" target="_blank">
							<img src="<?php echo geticon(getfield('app','in_icon','in_id',$row['in_id']));?>" class="appicon" onerror="javascript:this.src='<?php echo IN_PATH;?>static/app/<?php echo getfield('app','in_form','in_id',$row['in_id']);?>.png'" style="margin-top:0px;margin-bottom:14px;">
							</a>
							<p class="text-center app-name">
								<a href="<?php echo IN_API . 'app.php/' . $row['in_id'];?>" target="_blank"><?php echo $row['in_name'];?></a>
							</p>
							<p class="text-center app-name">
								<span class="ios"><?php echo getfield('app','in_form','in_id',$row['in_id']);?></span>
							</p>
						</div>
					</div>
	
					
					<div class="col-md-2 text-center">
						<span aria-hidden="true" class="icon-link" style="line-height:118px;font-size:30px;"></span>
					</div>
					
					
					<div class="col-md-5 text-center">
						<div class="funny-boxes-img">
							<a href="<?php echo IN_API . 'app.php/' . $row['in_kid'];?>" target="_blank">
							<img src="<?php echo geticon(getfield('app','in_icon','in_id',$row['in_kid']));?>" class="appicon" onerror="javascript:this.src='<?php echo IN_PATH;?>static/app/<?php echo getfield('app','in_form','in_id',$row['in_id']);?>.png'" style="margin-top:0px;margin-bottom:14px;">
							</a>
							<p class="text-center app-name">
								<a href="<?php echo IN_API . 'app.php/' . $row['in_kid'];?>" target="_blank"><?php echo getfield('app','in_name','in_id',$row['in_kid']);?></a>
							</p>
							<p class="text-center app-name">
								<span class="ios"><?php echo getfield('app','in_form','in_id',$row['in_kid']);?></span>
							</p>
						</div>
					</div>
	
	
	
	<div class="row" style="padding:20px 50px 50px 50px;">
		<div class="col-md-10 col-md-offset-1">
			<p>温馨提示：</p>
			<p>合并后的两个应用，进入任一个应用的单页，扫描二维码，会根据你的手机系统自动帮你下载相应的版本。</p>
		</div>
	</div>
</div>
					
					
					
					
					
					
					
				</div>
				<?php }else{ ?>
				<div class="apps-list">
					<div class="known-apps" style="text-align:center">
						<p class="lead ng-binding"><b>选择已有的应用进行合并</b></p>
						<div class="apps">
                        <?php while($rows = $GLOBALS['db']->fetch_array($query)){ ?>
                        
                        <div class="col-lg-3 col-sm-4">
										<div class="ibox">
											<div class="caption">
												<span class="fa-stack fa-lg">
												<i class="fa fa-check fa-lg" style="font-size:50px;line-height:100px;"></i>
												</span>
												<input value="<?php echo $rows['in_id'];?>" type="hidden">
											</div>
											<div class="ibox-content">
												<div class="text-center">
													<img src="<?php echo geticon($rows['in_icon']);?>" class="appicon" onerror="javascript:this.src='<?php echo IN_PATH.'static/app/'.$rows['in_form'];?>'" style="margin-top:0px;margin-bottom:14px;">
												</div>
												<p style="word-break:keep-all; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;" class="text-center"><?php echo $rows['in_name'];?></p>
												<p style="word-break:keep-all; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;" class="text-center"><?php echo $rows['in_bid'];?></p>
											</div>
										</div>
					  </div>
					  
                        <?php }?>	
                      </div>
					</div>
				</div>
			   <?php }?>
            </div>
		</div>
	</div>
</div>
</section>