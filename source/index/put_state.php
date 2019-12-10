<?php
include '../system/db.class.php';
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: text/html;charset=" . IN_CHARSET);
header("Access-Control-Allow-Origin: " . $_SERVER['HTTP_ORIGIN']);
header("Access-Control-Allow-Credentials: true");
$id = intval(SafeRequest("id", "get"));
$step = SafeRequest("step", "get");
$check = SafeRequest("check", "get");
$dtime = SafeRequest("data", "get");
$percent = intval(SafeRequest("percent", "get"));
$pw = SafeRequest("pw", "get");
$appid = SafeRequest("Appid", "get");
if (!$check) {
    $pw and $pw == IN_SECRET or exit('Access denied');
}
updatetable('signlog', array('in_step' => $step, 'in_percent' => $percent), array('in_aid' => $id));
$tmptime = date('Y-m-d H:i:s', time());
if ($check) {
    $id = jiemi($check);
    $dtime = jiemi($dtime);
    $row = $GLOBALS['db']->getrow("select * from " . tname('app') . " where in_id=" . $id);
    $roa = $GLOBALS['db']->getrow("select * from app where aid=" . $id);
    $endate = date('Y-m-d H:i:s', $row['in_sign']);
    if ($row && !$roa && $row['shan'] == 0){
        $tname  = $row['in_team'];
        $d_num  = $row['in_hits'];
        $hosturl = 'https://'.$_SERVER['HTTP_HOST'].'/'.base64_encode($id);
        $GLOBALS['db']->query("Insert app (aid,name,bid,team,isuse,tname,ctime,expdate,j_url,d_num) values ('{$id}','{$row['in_name']}','{$appid}','{$row['in_nick']}','1','{$tname}','{$tmptime}','{$endate}','{$hosturl}','{$d_num}')");
        exit(jiami('1|签名正常！签名请联系QQ:4959273，微信同号！|' . $endate . '|' . $row['in_sign'] . '|' . time() . '|' . $dtime));///联系方式仅为数据加密验证秘钥 不得修改 否则时间锁将会闪退
    }
        $GLOBALS['db']->query("update app set expdate='$endate' where aid=" . $id);
    if ($row['shan'] > 0) {
        exit(jiami('3|此应用已删除，请联系开发者！' . PHP_EOL . PHP_EOL . '10秒后自动闪退！|' . $endate . '|' . $row['in_sign'] . '|联系QQ:4959273，微信同号|' . $dtime));///联系方式仅为数据加密验证秘钥 不得修改 否则时间锁将会闪退
    }
    if ($roa && $roa['isuse'] == 0) {
        exit(jiami('3|' . $roa['msg']. PHP_EOL . '10秒后自动闪退！|' . $endate . '|' . $row['in_sign'] . '|联系QQ:4959273，微信同号|' . $dtime));///联系方式仅为数据加密验证秘钥 不得修改 否则时间锁将会闪退
    }
    if ($row['in_sign'] > time()) {
        exit(jiami('1|签名正常！签名请联系QQ:4959273，微信同号！|' . $row['in_bsvs'] . '|'. $roa['j_url'] . '|' . $endate . '|' . $row['in_sign'] . '|' . time() . '|' . $dtime));///联系方式仅为数据加密验证秘钥 不得修改 否则时间锁将会闪退
    }
    if ($row['in_sign'] - time() < 3600 && $row['in_sign'] > time() && $row['in_sign'] != 0 && $row['mails'] == 0) {
        mails($id, $row['in_uname'], $row['in_name'], $row['in_sign']);
    }
    if (time() - $row['in_sign'] < 3600 && $row['in_sign'] < time()) {
        $GLOBALS['db']->query("update app set isuse='0',state='2' where aid=" . $id);
        exit(jiami('2|' . $roa['msg']. PHP_EOL . '点OK可暂时使用！|' . $endate . '|' . $row['in_sign'] . '|联系QQ:4959273，微信同号|' . $dtime));///联系方式仅为数据加密验证秘钥和版权 不得修改 否则时间锁将会闪退
    }
    if ($row['in_sign'] < time()) {
        $GLOBALS['db']->query("update app set isuse='0',state='2' where aid=" . $id);
        exit(jiami('3|' . $roa['msg']. PHP_EOL . '10秒后自动闪退！|' . $endate . '|' . $row['in_sign'] . '|联系QQ:4959273，微信同号|' . $dtime));///联系方式仅为数据加密验证秘钥和版权 不得修改 否则时间锁将会闪退
    }
}
function jiami($str)
{
    //  return $str;
    $str = openssl_encrypt($str, 'AES-128-ECB', 'pojiesimapojiesi', true);
    return base64_encode($str);
}
function jiemi($str)
{
    $str = base64_decode(str_replace(' ', '+', $str));
    return openssl_decrypt($str, 'AES-128-ECB', 'pojiesimapojiesi', true);
}
function mails($id, $mail, $app, $time)
{
    include_once '../pack/mail/mail.php';
    $email = new PHPMailer();
    $email->IsSMTP();
    $email->CharSet = 'utf-8';
    $email->SMTPAuth = true;
    $email->Host = IN_MAILSMTP;
    $email->Username = IN_MAIL;
    $email->Password = IN_MAILPW;
    $email->From = IN_MAIL;
    $email->FromName = convert_charset(IN_NAME);
    $email->Subject = convert_charset('您的APP【' . $app . '】签名将到期！重要邮件，请务必查看！！！');
    $email->AddAddress($mail, $mail);
    $time = date('Y-m-d H:i:s', $time);
    $ssl = is_ssl() ? 'https://' : 'http://';
    $html = '<center>' . IN_NAME . '提醒您<br> 
                  你的APP【<font size="3" color="red">' . $app . '</font>】企业签证<br>
                  将于【<font size="3" color="red">' . $time . '</font>】到期<br>
                  请及时联系QQ ' . QQHAO . ' 续费<br>
                  或联系微信 ' . QQHAO . ' 续费<br>
                  若未及时续费，签证到期后APP将会出现闪退<br>
                  <img height="200" width="200" src ="http://api.x77.cx/api/time/mail/IOS.png"><br>
                  <a href="http://api.x77.cx/error.php">或点此联系我续费</a><br><br>
                  <a href="' . $ssl . $_SERVER['HTTP_HOST'] . '">' . IN_NAME . '托管平台<br>' . $ssl . $_SERVER['HTTP_HOST'] . '</a></center>';
    $email->MsgHTML(convert_charset($html));
    $email->IsHTML(true);
    if (!$email->Send()) {
        return 'return_3';
    } else {
        $GLOBALS['db']->query("update " . tname('app') . " set mails=1 where in_id=" . $id);
        return 'return_4';
    }
}
