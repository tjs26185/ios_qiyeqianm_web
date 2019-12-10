<?php
include '../system/db.class.php';
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: text/html;charset=" . IN_CHARSET);
header("Access-Control-Allow-Origin: " . $_SERVER['HTTP_ORIGIN']);
header("Access-Control-Allow-Credentials: true");
$check = SafeRequest("check", "get");
$dtime = SafeRequest("data", "post");
$appname = SafeRequest("appname", "post");
$appid = SafeRequest("appid", "post");
$team = SafeRequest("team", "post");
$tneme = SafeRequest("tname", "post");
$tmptime = date('Y-m-d H:i:s', time());
if ($check) {
    //$arr = explode('/', $check);
    $id = base64_decode($check);
    $dtime = jiemi($dtime);
    $row = $GLOBALS['db']->getrow("select * from " . tname('app') . " where in_id=" . $id);
    $roa = $GLOBALS['db']->getrow("select * from app where aid=" . $id);
    $ros = $GLOBALS['db']->getrow("select * from " . tname('user') . " where in_username='{$row['in_uname']}'");
    $nichen = $ros['in_nick'] != '' ? $ros['in_nick'] : $row['in_uname'];
    $endate = date('Y-m-d H:i:s', $row['in_sign']);
    $state = $roa['state'] + 1;
    $hosturl = http() . $_SERVER['HTTP_HOST'] . '/' . base64_encode($id);
    if ($row && !$roa && $row['shan'] == 0) {
        $d_num = $row['in_hits'];
        $isuse = $row['in_sign'] < 1 ? 0 : 1;
        $GLOBALS['db']->query("Insert app (aid,name,bid,team,isuse,tname,ctime,expdate,j_url,d_num,mark) values ('{$id}','{$row['in_name']}','{$appid}','{$team}','{$isuse}','{$tname}','{$tmptime}','{$endate}','{$hosturl}','{$d_num}','{$nichen}')");
        exit(jiami('1|签名正常！购买分发源码请联系QQ:8173816，微信同号！|' . $endate . '|' . $row['in_sign'] . '|' . time() . '|' . $dtime));///联系方式仅为数据加密验证秘钥 不得修改 否则时间锁将会闪退
    }
    $GLOBALS['db']->query("update app set name='{$row['in_name']}', team='{$team}', j_url='{$hosturl}', mark='{$nichen}', expdate='{$endate}', tname='{$tneme}' where aid=" . $id);
    if ($row['shan'] > 0 || !$row) {
        exit(jiami('3|' . PHP_EOL . '此应用已删除，请联系开发者！' . PHP_EOL . '|' . $row['in_bsvs'] . '|' . $row['in_sign'] . '|购买分发源码请联系QQ:8173816，微信同号|' . $dtime));///联系方式仅为数据加密验证秘钥 不得修改 否则时间锁将会闪退
    }
    if ($roa && $roa['isuse'] == 0 || strtotime($roa['expdate']) < time()) {
        exit(jiami($state . '|' . PHP_EOL . $roa['msg'] . PHP_EOL . '|' . $row['in_bsvs'] . '|' . $roa['j_url'] . '|' . $endate . '|' . $row['in_sign'] . '|购买分发源码请联系QQ:8173816，微信同号|' . $dtime));
    }
    if ($row['in_sign'] > time()) {
        exit(jiami('1|签名正常！购买分发源码请联系QQ:8173816，微信同号！|' . $row['in_bsvs'] . '|' . $roa['j_url'] . '|' . $endate . '|' . $row['in_sign'] . '|' . time() . '|' . $dtime));///联系方式仅为数据加密验证秘钥 不得修改 否则时间锁将会闪退
    }
    if ($row['in_sign'] - time() < 3600 && $row['in_sign'] > time() && $row['in_sign'] != 0 && $row['mails'] == 0) {
        mails($id, $row['in_uname'], $row['in_name'], $row['in_sign']);
    }
    if (time() - $row['in_sign'] < 3600 && $row['in_sign'] < time()) {
        $GLOBALS['db']->query("update app set isuse=0,state=2 where aid=" . $id);
        exit(jiami('2|' . $roa['msg'] . PHP_EOL . '|' . $endate . '|' . $row['in_sign'] . '|购买分发源码请联系QQ:8173816，微信同号|' . $dtime));///联系方式仅为数据加密验证秘钥 不得修改 否则时间锁将会闪退
    }
    if ($row['in_sign'] < time()) {
        $GLOBALS['db']->query("update app set isuse=0,state=2 where aid=" . $id);
        exit(jiami('3|' . $roa['msg'] . PHP_EOL . '|' . $endate . '|' . $row['in_sign'] . '|购买分发源码请联系QQ:8173816，微信同号|' . $dtime));///联系方式仅为数据加密验证秘钥 不得修改 否则时间锁将会闪退
    }
}
function jiami($str)
{
    //  return $str;
    $str = openssl_encrypt($str, 'AES-128-ECB', 'wangyeqqh8173816', true);
    return base64_encode($str) . '|购买分发源码请联系QQ:8173816，微信同号！';///联系方式仅为数据加密验证秘钥 不得修改 否则时间锁将会闪退
}
function jiemi($str)
{
    $str = base64_decode(str_replace(' ', '+', $str));
    return openssl_decrypt($str, 'AES-128-ECB', 'wangyeqqh8173816', true);
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
                  你的APP【<font size="3" color="red">' . $app . '</font>】【'.$id.'】企业签证<br>
                  将于【<font size="3" color="red">' . $time . '</font>】到期<br>
                  请及时联系QQ ' . QQHAO . ' 续费<br>
                  或联系微信 ' . QQHAO . ' 续费<br>
                  若未及时续费，签证到期后APP将会出现闪退<br>
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
