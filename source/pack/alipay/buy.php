<?php
include '../../system/db.class.php';
include '../../system/user.php';
require_once 'alipay.class.php';
header("Content-type: text/html;charset=" . IN_CHARSET);
global $db, $userlogined, $erduo_in_userid, $erduo_in_username;
$userlogined or exit(header('location:' . IN_PATH . 'index.php/login'));
$tid = intval(SafeRequest("tid", "get"));
$text = $tid > 1 ? $tid > 2 ? '包年密钥' : '包季密钥' : '包月密钥';
$money = $tid > 1 ? $tid > 2 ? IN_SIGN * 12 : IN_SIGN * 3 : IN_SIGN;
$db->query("delete from " . tname('buylog') . " where in_lock=1 and in_uid=" . $erduo_in_userid);
$setarr = array('in_uid' => $erduo_in_userid, 'in_uname' => $erduo_in_username, 'in_title' => $erduo_in_userid . '-' . time(), 'in_tid' => $tid, 'in_money' => $money, 'in_lock' => 1, 'in_addtime' => date('Y-m-d H:i:s'));
inserttable('buylog', $setarr);
$ssl = is_ssl() ? 'https://' : 'http://';
$returnUrl = $ssl . $_SERVER['HTTP_HOST'] . IN_PATH . 'source/pack/alipay/buy_return.php';
$notifyUrl = $ssl . $_SERVER['HTTP_HOST'] . IN_PATH . 'source/pack/alipay/buy_notify.php';
$outTradeNo = $setarr['in_title'];
$payAmount = $setarr['in_money'];
$orderName = $erduo_in_username . ' / ' . convert_charset($text);
$signType = 'MD5';
$pid = IN_ALIPAYID;
$privateKey = IN_ALIPAYKEY;
$aliPay = new AlipayService($pid, $returnUrl, $notifyUrl, $signType, $privateKey);
$sHtml = $aliPay->doPay($payAmount, $outTradeNo, $orderName, $returnUrl, $notifyUrl);
echo $sHtml;
?>