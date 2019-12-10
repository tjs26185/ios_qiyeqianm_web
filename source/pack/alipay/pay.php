<?php
include '../../system/db.class.php';
include '../../system/user.php';
require_once 'alipay.class.php';
header("Content-type: text/html;charset=" . IN_CHARSET);
global $db, $userlogined, $erduo_in_userid, $erduo_in_username;
$userlogined or exit(header('location:' . IN_PATH . 'index.php/login'));
$rmb = intval(SafeRequest("rmb", "get"));
if (in_array($rmb, array(10, 90, 800))) {
    $points = $rmb > 10 ? $rmb > 90 ? IN_RMBPOINTS * 1000 : IN_RMBPOINTS * 100 : IN_RMBPOINTS * 10;
} else {
    $points = 0;
}
$db->query("delete from " . tname('paylog') . " where in_lock=1 and in_uid=" . $erduo_in_userid);
$setarr = array('in_uid' => $erduo_in_userid, 'in_uname' => $erduo_in_username, 'in_title' => $erduo_in_userid . '-' . time(), 'in_points' => $points, 'in_money' => $rmb, 'in_lock' => 1, 'in_addtime' => date('Y-m-d H:i:s'));
inserttable('paylog', $setarr);
$ssl = is_ssl() ? 'https://' : 'http://';
$returnUrl = $ssl . $_SERVER['HTTP_HOST'] . IN_PATH . 'source/pack/alipay/pay_return.php';
$notifyUrl = $ssl . $_SERVER['HTTP_HOST'] . IN_PATH . 'source/pack/alipay/pay_notify.php';
$outTradeNo = $setarr['in_title'];
$payAmount = $setarr['in_money'];
$orderName = $erduo_in_username . ' / ' . $setarr['in_points'];
$signType = 'MD5';
$pid = IN_ALIPAYID;
$privateKey = IN_ALIPAYKEY;
$aliPay = new AlipayService($pid, $returnUrl, $notifyUrl, $signType, $privateKey);
$sHtml = $aliPay->doPay($payAmount, $outTradeNo, $orderName, $returnUrl, $notifyUrl);
echo $sHtml;
?>