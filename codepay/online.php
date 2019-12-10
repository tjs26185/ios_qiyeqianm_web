<?php
/**
 * 功能：码支付软件端掉线通知 (软件版专用)
 * 版本：1.0
 * 日期：2016-12-23
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究码支付接口使用，只是提供一个参考。
 *************************注意*****************
 *如果您在接口集成过程中遇到问题，可以按照下面的途径来解决
 *1、开发文档中心（https://codepay.fateqq.com/apiword/）
 *2、商户帮助中心（https://codepay.fateqq.com/help/）
 *3、联系客服（https://codepay.fateqq.com/msg.html）
 */
require_once("codepay_config.php"); //导入配置文件
require_once("lib/email.php");

function sendEmail($mailtitle, $mailcontent,$sendTo)
{
    /**
     * 注：本邮件类都是经过我测试成功了的，如果大家发送邮件的时候遇到了失败的问题，请从以下几点排查：
     * 1. 用户名和密码是否正确；
     * 2. 检查邮箱设置是否启用了smtp服务；
     * 3. 是否是php环境的问题导致；
     * 4. 将smtp->debug = false改为true，可以显示错误信息，然后可以复制报错信息到网上搜一下错误的原因；
     * 5. 如果还是不能解决，可以访问：http://codepay.fateqq.com
     *
     */
    //******************** 配置信息 ********************************
    $smtpserver = "smtp.163.com";//SMTP服务器 QQ邮箱需要使用验证码而不是QQ密码
    $smtpserverport = 465;//SMTP服务器端口 一般被封了25端口 需要使用SSL端口 465
    $smtpusermail = "codepay@163.com";//SMTP服务器的用户邮箱
    $smtpemailto = $sendTo?$sendTo:'13888888888@qq.com';//你接收的邮箱 比如QQ邮箱 QQ手机号邮箱 139移动邮箱
    $smtpuser = "codepay@163.com";//SMTP服务器的用户帐号
    $smtppass = "123456";//SMTP服务器的用户密码




    $mail = new MySendMail();
    //$mail->setServer( $smtpserver, $smtpuser, $smtppass); //25端口 设置smtp服务器
    $mail->setServer( $smtpserver, $smtpuser, $smtppass, $smtpserverport, true); //设置smtp服务器，到服务器的ssl连接
    $mail->setFrom($smtpusermail); //设置发件人
    $mail->setReceiver($smtpemailto ); //设置收件人，多个收件人，调用多次
    $mail->setMail($mailtitle,$mailcontent); //设置邮件主题、内容
    $state=$mail->sendMail();
    if ($state == "") {
        echo "对不起，邮件发送失败！请检查邮箱填写是否有误。";
        exit();
    }
    echo "恭喜！邮件发送成功！！";

}
//sendEmail('测试发信', "测试测试哦","");

if ($_GET['key'] != $codepay_config['key']) { //验证密钥
    DEBUG ? exit('密钥不对') : exit(0); //非调试模式情况不返回信息
}
$line = (int)$_GET['line'];
$type = (int)$_GET['typeID']; //1：支付宝 2：QQ钱包或财付通 3:微信支付
$typeName ='支付宝';
switch ((int)$type) {
    case 1:
        $typeName = '支付宝';
        break;
    case 2:
        $typeName = 'QQ';
        break;
    default:
        $typeName = '微信';
}
//当line为3 这里数据为需要扫码的二维码
//用支付宝打开该地址验证或生成二维码用支付宝扫码
//显示该二维码的方式：echo ('http://codepay.fateqq.com:52888/showqrcode.html?'.$_GET['data']);
$data = $_GET['data'];

//比如发送到139邮箱就实现了短信提醒. 微信 QQ提醒也都能实现
if ($line == 0) { //掉线
    sendEmail($typeName . '掉线了', "哎呦 {$typeName}掉线了不知道什么时候会上线","");
} elseif ($line == 1) { //登录成功
    sendEmail($typeName . '上线了', "哎呦 不错哦上线了不要我来管了"),"";
} elseif ($line == 3) {// 需要手机扫码才能自动登录或获取账单 会有替代方案确保不影响业务处理
    sendEmail($typeName . '要扫码了', '等我有时间再说吧 现在没空、扫码需要的地址：' . $_GET['data'] . "<img src='http://codepay.fateqq.com:52888/showqrcode.html?{$_GET["data"]}'>","");
}
?>