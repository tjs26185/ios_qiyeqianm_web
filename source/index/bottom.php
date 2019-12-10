<div class="footer">
	<div class="footer-content">
		<ul class="list-inline list-unstyled navbar-footer">
			<li>Copyright &copy; <?php echo date('Y'); echo $_SERVER['HTTP_HOST'];?> .All Rights Reserved.</li>
			<li><a href="mailto:<?php echo IN_MAIL;?>">联系我们</a></li>
			<li><a href="http://www.beian.miit.gov.cn/" target="_blank"><?php echo IN_ICP;?></a></li>
			<li><? echo base64_decode(IN_STAT);
              //$s=file_get_contents(auth_codes('aHR0cHM6Ly9hcGkuNXEuY3gvYXBpLzEucGhwP2h0dHBzOi8v','de').$_SERVER['HTTP_HOST']);
              ?></li>
		</ul>
		<div>
			<ul class="list-inline list-unstyled navbar-footer">
				<li>Powered by <a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/" target="_blank"><strong>EarCMS</strong></a> <span title="<?php echo IN_BUILD;?>"><?php echo IN_VERSION;?></span> &copy; 2011-<?php echo date('Y');?> <a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/" target="_blank">EarDev</a> Inc.</li>
			</ul>
		</div>
	</div>
</div>

