<?php
if (file_exists('install.lock')) {
    exit('已经安装 请删除install.lock文件 设置配置文件$codepay_config[\'id\']=\'\' 然后重试');
}
$filename = 'codepay_config.php';
$mode_file = "mode.php"; //这仅是一个配置模板 不要修改
require_once($filename); //导入配置文件
if ((int)$codepay_config['id'] > 1) { //防止修改了配置文件还能安装BUG出现
    exit("您已经配置好了 请删除该页面<br>如果重新安装请设置配置文件codepay_config.php中的\$codepay_config['id']='' ");
}
if (!is_writable($filename)) {
    exit('您没有写入权限 请将codepay_config.php文件临时改为可写入 安装后可改回');
}

if (!function_exists("mysqli_connect")) {
    exit('mysqli没有启用,请找到php.ini 去掉mysqli前面的注释并重启web服务。<br>启用方法：删除extension=php_mysqli.dll前面的 ;');
}

function getChart($s)
{
    if (empty($s)) return 'utf8';
    $s = strtolower($s);
    return $s == 'gbk' || $s == 'gb2312' ? $s : 'utf8';
}

function getErrno($errno)
{
    if ($errno == 1044) {
        return '用户无权访问';
    }
    return $errno;
}

function showError($db)
{
    if ($db->error) {
        exit("错误代码：<font color='red'>" . getErrno($db->errno) . "</font>；<br /> 错误信息：<font color='red'>{$db->error}</font>");
    }
}

if ($_POST['install']) { //安装
    if (file_exists($mode_file)) {
        $fp = fopen($mode_file, "r");
        $modeStr = fread($fp, filesize($mode_file));//读取配置模板内容
    } else {
        exit('mode.php文件不存在 该文件为系统模板请重新下载');
    }
    $codepayID = (int)$_POST['codepay_id'];
    $key = $_POST['codepay_key'];
    $act = (int)$_POST['act'];
    $databaseHost = $_POST['databaseHost'];
    $databasePort = $_POST['databasePort'];
    $database = $_POST['database'];
    $databaseUser = $_POST['databaseUser'];
    $databasePassword = $_POST['databasePassword'];
    $codepay_config['chart'] = getChart($codepay_config['chart']);
    if ($codepayID <= 1) {
        exit('码支付ID不能为空');
    }
    if (empty($key)) {
        exit('通信密钥不能为空');
    }
    $_mysqli = @new mysqli($databaseHost, $databaseUser, $databasePassword, '', $databasePort);
    if (mysqli_connect_errno()) {
        exit('数据库连接错误！错误代码：' . mysqli_connect_error());
    }
    $_mysqli->autocommit(true); //不使用事物
    $_mysqli->query("CREATE DATABASE IF NOT EXISTS `{$database}`;");
    showError($_mysqli);
    $_mysqli->query("use `{$database}`");
    showError($_mysqli);
    $_mysqli->set_charset($codepay_config['chart']);
    if (!DB_PREFIX) define('DB_PREFIX', 'codepay');  //设置表表前缀
    $rs = $_mysqli->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "_order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pay_id` varchar(50) NOT NULL COMMENT '用户ID或订单ID',
  `money` decimal(6,2) unsigned NOT NULL COMMENT '实际金额',
  `price` decimal(6,2) unsigned NOT NULL COMMENT '原价',
  `type` int(1) NOT NULL DEFAULT '1' COMMENT '支付方式',
  `pay_no` varchar(100) NOT NULL COMMENT '流水号',
  `param` varchar(200) DEFAULT NULL COMMENT '自定义参数',
  `pay_time` bigint(11) NOT NULL DEFAULT '0' COMMENT '付款时间',
  `pay_tag` varchar(100) NOT NULL DEFAULT '0' COMMENT '金额的备注',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '订单状态',
  `creat_time` bigint(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `up_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `main` (`pay_id`,`pay_time`,`money`,`type`,`pay_tag`),
  UNIQUE KEY `pay_no` (`pay_no`,`type`)
) ENGINE=INNODB DEFAULT CHARSET={$codepay_config['chart']} COMMENT='用于区分是否已经处理' AUTO_INCREMENT=1 ;");
    showError($_mysqli);
    $rs = $_mysqli->query("CREATE TABLE IF NOT EXISTS `codepay_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `user` varchar(100) CHARACTER SET {$codepay_config['chart']} NOT NULL DEFAULT '' COMMENT '用户名',
  `money` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT '金额',
  `vip` int(1) NOT NULL DEFAULT '0' COMMENT '会员开通',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '会员状态',
  PRIMARY KEY (`id`)
) ENGINE=INNODB  DEFAULT CHARSET={$codepay_config['chart']} AUTO_INCREMENT=2 ;");
    showError($_mysqli);
    $rs = $_mysqli->query("INSERT INTO `" . DB_PREFIX . "_user` (`id`, `user`, `money`, `vip`, `status`) VALUES
(1, 'admin', '0.00', 0, 0);");

    $data = array("码支付ID" => $codepayID, "通信密钥" => $key, "版本" => $act, "数据库IP地址" => $databaseHost, "MYSQL端口" => $databasePort, "MYSQL数据库" => $database, "MYSQL用户名" => $databaseUser, "MYSQL密码" => $databasePassword);
    function get_value($key)
    {
        global $data;
        return "'" . $data[$key] . "'";
    }



	function mat($matches){return get_value($matches[1]);}

     if(function_exists('preg_replace_callback')){
     	 $configString = preg_replace_callback(
                '/\"([^\"]*)\"/', mat
                , $modeStr);
     	}else{
     		 $configString = preg_replace(
        '/\"([^\"]*)\"/es',
        "get_value('\\1')",
        $modeStr
    ); //配置模板替换
     		    $configString = preg_replace('/\(模板请勿修改\)/', '', $configString);
     	}







    if ($configString == '') {
        exit("安装失败 您可以手动修改codepay_config.php中的中文参数值");
    }
    $myfile = fopen($filename, "w") or die("数据导入成功但配置文件写入失败 您可以删除数据库数据重装");
    fwrite($myfile, $configString);
    fclose($myfile);

    $myfile = fopen('install.lock', "w") or die("<script>alert('恭喜：已经安装成功但无权写入文件锁请删除该文件');gotoOK()</script>恭喜：已经安装成功但无法写入文件锁请删除该文件。<a href='javascript:gotoOK()'>跳到下一步</a>");
    fwrite($myfile, '删除该文件 才可重新安装');
    fclose($myfile);
    exit('ok');
}
?>
<html lang="zh-cn" ng-app="codepay" class="ng-scope">
<head>
    <style type="text/css">
        [ng\:cloak], [ng-cloak], [data-ng-cloak], [x-ng-cloak]:not(.ng-hide-animate) {
            display: none !important;
        }

        ng\:form {
            display: block;
        }
    </style>
    <title>码支付接口安装</title>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="css/vendor.css">
    <link rel="stylesheet" href="css/main.css">
    <script src="js/jquery-1.10.2.min.js"></script>
</head>
<!-- uiView:  -->
<body ui-view="" class="ng-scope">
<div class="install ng-scope">
    <img class="brand" src="https://codepay.fateqq.com/themes/dorawhite/images/logo.png"
         srcset="https://codepay.fateqq.com/themes/dorawhite/images/logo.png 2x">
    <div
        ng-class="{ 'lg': page === 'license', 'md': page === 'database' || page === 'siteInfo', 'sm': page === 'installing' || page === 'installed' }"
        class="content md">
        <div ng-show="page === 'database'" id="databaseShow" class="panel panel-default install-panel">
            <div class="panel-body">
                <form method="post" onsubmit="ajaxsubmit(this)"
                      class="form-horizontal ng-valid-pattern ng-valid-min ng-valid-max ng-dirty ng-valid-parse ng-valid ng-valid-required ng-submitted"
                      id="databaseForm" name="databaseForm" novalidate="">
                    <div class="page-header">
                        <div class="heading">码支付接口安装</div>
                    </div>
                    <hr>
                    <div
                        ng-class="{ 'has-error': databaseForm.databaseHost.$touched &amp;&amp; databaseForm.databaseHost.$invalid }"
                        class="form-group">
                        <label for="databaseHost" class="col-sm-3 control-label">* 码支付ID：</label>
                        <div class="col-sm-9">
                            <input ng-model="databasePort" ng-disabled="transmitting"
                                   class="form-control ng-pristine ng-valid ng-valid-min ng-valid-max ng-valid-required ng-touched"
                                   id="databasePort" type="number" min="0" max="65535" name="codepay_id"
                                   placeholder="请输入码支付ID" required="">

                            <span id="databaseHosteHelpBlock" class="help-block"><a
                                    href="https://codepay.fateqq.com/reg.html" target="_blank">注册码支付</a>后 进入【<a
                                    href="https://codepay.fateqq.com/admin/#/dataSet.html" target="_blank">系统设置</a>】获得ID</span>
                        </div>
                    </div>
                    <div
                        ng-class="{ 'has-error': databaseForm.databasePort.$touched &amp;&amp; databaseForm.databasePort.$invalid }"
                        class="form-group">
                        <label for="databasePort" class="col-sm-3 control-label">* 通信密钥：</label>
                        <div class="col-sm-9">
                            <input ng-model="databaseHost" ng-disabled="transmitting"
                                   ng-pattern="/^(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$|^localhost$/"
                                   class="form-control ng-pristine ng-valid ng-valid-required ng-valid-pattern ng-touched"
                                   id="codepay_key" type="text" name="codepay_key"
                                   aria-describedby="databaseHostHelpBlock" placeholder="请输入通信密钥" required="">

                            <span id="databasePortHelpBlock" class="help-block"><a
                                    href="https://codepay.fateqq.com/admin/#/dataSet.html" target="_blank">登录码支付</a>后 进入【<a
                                    href="https://codepay.fateqq.com/admin/#/dataSet.html" target="_blank">系统设置</a>】 获取密钥</span>
                        </div>
                    </div>
                    <div
                        ng-class="{ 'has-error': databaseForm.databasePort.$touched &amp;&amp; databaseForm.databasePort.$invalid }"
                        class="form-group">
                        <label for="databasePort" class="col-sm-3 control-label">* 安装版本：</label>


                        <div class="controls col-sm-9">

                            <!-- Inline Radios -->

                            <input type="radio" value="0" checked="checked" name="act">
                            即时到账版



                            <span id="databasePortHelpBlock" class="help-block">支付宝 QQ支付需<a
                                    href="//codepay.fateqq.com/down.html" target="_blank">下载软件</a> 微信无需软件</span>

                        </div>

                    </div>
                    <div
                        ng-class="{ 'has-error': databaseForm.databaseHost.$touched &amp;&amp; databaseForm.databaseHost.$invalid }"
                        class="form-group">
                        <label for="databaseHost" class="col-sm-3 control-label">* 数据库主机：</label>
                        <div class="col-sm-9">
                            <input ng-model="databaseHost" ng-disabled="transmitting"
                                   ng-pattern="/^(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$|^localhost$/"
                                   class="form-control ng-pristine ng-valid ng-valid-required ng-valid-pattern ng-touched"
                                   id="databaseHost" type="text" name="databaseHost"
                                   aria-describedby="databaseHostHelpBlock" placeholder="请输入数据库主机" required=""
                                   value="localhost">
                            <span id="databaseHosteHelpBlock" class="help-block">如果数据库与网站是同一台服务器，默认 localhost 即可</span>
                        </div>
                    </div>
                    <div
                        ng-class="{ 'has-error': databaseForm.databasePort.$touched &amp;&amp; databaseForm.databasePort.$invalid }"
                        class="form-group">
                        <label for="databasePort" class="col-sm-3 control-label">* 数据库端口：</label>
                        <div class="col-sm-9">
                            <input ng-model="databasePort" ng-disabled="transmitting"
                                   class="form-control ng-pristine ng-valid ng-valid-min ng-valid-max ng-valid-required ng-touched"
                                   id="databasePort" type="number" min="0" max="65535" name="databasePort"
                                   placeholder="请输入数据库端口" required="" value="3306">
                            <span id="databasePortHelpBlock" class="help-block">如果没有修改过数据库端口，默认 3306 即可</span>
                        </div>
                    </div>
                    <div
                        ng-class="{ 'has-error': databaseForm.database.$touched &amp;&amp; databaseForm.database.$invalid }"
                        class="form-group">
                        <label for="database" class="col-sm-3 control-label">* 数据库名：</label>
                        <div class="col-sm-9">
                            <input ng-model="database" ng-disabled="transmitting"
                                   class="form-control ng-pristine ng-valid ng-valid-required ng-touched" id="database"
                                   type="text" name="database" placeholder="请输入数据库名" required="" value="codepay">
                            <span id="databasePortHelpBlock" class="help-block">建议安装到您当前现有网站 方便使用我们的程序实现自动充值</span>

                        </div>
                    </div>
                    <div
                        ng-class="{ 'has-error': databaseForm.databaseUser.$touched &amp;&amp; databaseForm.databaseUser.$invalid }"
                        class="form-group">
                        <label for="databaseUser" class="col-sm-3 control-label">* 数据库用户名：</label>
                        <div class="col-sm-9">
                            <input ng-model="databaseUser" ng-disabled="transmitting"
                                   class="form-control ng-touched ng-dirty ng-valid-parse ng-valid ng-valid-required"
                                   id="databaseUser" type="text" name="databaseUser" placeholder="请输入数据库用户名"
                                   required="">
                        </div>
                    </div>
                    <div
                        ng-class="{ 'has-error': databaseForm.databasePassword.$touched &amp;&amp; databaseForm.databasePassword.$invalid }"
                        class="form-group">
                        <label for="databasePassword" class="col-sm-3 control-label">* 数据库密码：</label>
                        <div class="col-sm-9">
                            <input ng-model="databasePassword" ng-disabled="transmitting"
                                   class="form-control ng-touched ng-dirty ng-valid-parse ng-valid ng-valid-required"
                                   id="databasePassword" type="password" name="databasePassword"
                                   placeholder="请输入数据库用户密码" required="">
                        </div>
                    </div>
                    <div id="Error" style="display: none">
                        <div ng-show="databaseError" class="alert alert-danger" role="alert">
                            <i class="fa fa-exclamation-triangle"></i>
                        </div>
                    </div>
                    <hr>
                    <div class="pull-right">
                        <button ng-disabled="transmitting || databaseForm.$invalid" type="submit" form="databaseForm"
                                class="btn btn-primary">立即安装
                        </button>
                    </div>
                    <input type="hidden" name="install" value="1">
                </form>
            </div>
        </div>
        <div ng-show="page === 'installed'" id="installed" class="panel panel-default install-panel">
            <div class="panel-body">
                <div class="page-header">
                    <div class="heading">安装完成</div>
                </div>
                <hr>
                <h3 class="text-center text-welcome">欢迎使用 码支付 :)</h3>
                <button type="button" class="btn btn-success" onclick="window.open('index.php')">进入测试页面
                </button>
                <button type="button" class="btn btn-success"
                        onclick="window.open('https://codepay.fateqq.com/admin/#/upQrcode.html')">
                    上传收款码
                </button>
                <button type="button" class="btn btn-success"
                        onclick="window.open('https://codepay.fateqq.com/dowm.html?herf='+encodeURIComponent(window.location))">
                    下载免费版软件
                </button>
                <br>
            </div>
        </div>
    </div>
    <footer>Powered by <a href="http://codepay.fateqq.com" title="码支付" target="_blank">codepay</a></footer>
</div>
<script>
    trim = function (str) { //删除左右两端的空格
        if (!str)return ""
        return str.replace(/(^\s*)|(\s*$)/g, "");
    }
    function ajaxsubmit(obj, Btn) {
        var form = $(obj);
        Btn = Btn || $('button');
        Btn.attr('disabled', "true");
        $.ajax({
            url: form.attr('action'),
            type: "POST",
            data: form.serialize(),
            success: function (data) {
                Btn.attr('disabled', "false");
                Btn.removeAttr('disabled', "true");
                if (data && trim(data).toLowerCase() == 'ok') {
                    gotoOK();
                } else {
                    $("#Error").show();
                    if(data.indexOf('INNODB')>1){
                    	  $(".alert-danger").html('您使用的一键安装MYSQL 需要找到MYSQL安装路径 下的my.ini 注释skip-innodb 前面加# 或innodb相关的全部注释 重启MYSQL');
                    	}else{
                    		$(".alert-danger").html(data)
                    	}

                }

            },
            error: function (jqXhr, textStatus, errorThrown) {
                Btn.removeAttr('disabled', "true");
                $("#Error").show();
               if(jqXhr.responseText.indexOf('INNODB')>1){
                    $(".alert-danger").html('您使用的一键安装MYSQL 需要找到MYSQL安装路径 下的my.ini 注释skip-innodb 前面加# 或innodb相关的全部注释 重启MYSQL');
                }else{
                    $(".alert-danger").html('安装出错 可联系我们 ' + jqXhr.responseText + " " + textStatus + " " + errorThrown)
                }

            }
        });
        try {
            event.preventDefault();
        } catch (e) {

        }

        return false;
    }
    function gotoOK() {
        $("#Error").hide();
        $("#installed").show();
        $("#databaseShow").hide();
    }
    $(function () {
        $("#installed").hide();
    })

</script>
</body>
</html>
