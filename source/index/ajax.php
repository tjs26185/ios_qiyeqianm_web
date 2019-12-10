<?php
include '../system/db.class.php';
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: text/html;charset=" . IN_CHARSET);
session_start();
$ac = SafeRequest("ac", "get");
if ($ac == 'login') {
    $mail = SafeRequest("mail", "get");
    $pwd = substr(md5(SafeRequest("pwd", "get")), 8, 16);
    $row = $GLOBALS['db']->getrow("select * from " . tname('user') . " where in_username='" . $mail . "' and in_userpassword='" . $pwd . "'");
    $nichen = nichen($mail);//echo $nichen;
    if ($row) {
        if ($row['in_islock'] == 1) {
            echo '{"code":99,"msg":"账号已被锁定，请联系客服"}';
        } else {
            if ($GLOBALS['db']->getone("select in_userid from " . tname('user') . " where in_userid=" . $row['in_userid'] . " and DATEDIFF(DATE(in_logintime),'" . date('Y-m-d') . "')=0")) {
                $GLOBALS['db']->query("update " . tname('user') . " set in_nick='".$nichen."', in_loginip='" . getonlineip() . "',in_logintime='" . date('Y-m-d H:i:s') . "' where in_userid=" . $row['in_userid']);
            } else {
                $GLOBALS['db']->query("update " . tname('user') . " set in_nick='".$nichen."', in_points=in_points+" . IN_LOGINPOINTS . ",in_loginip='" . getonlineip() . "',in_logintime='" . date('Y-m-d H:i:s') . "' where in_userid=" . $row['in_userid']);
            }
            setcookie('in_userid', $row['in_userid'], time() + 86400, IN_PATH);
            setcookie('in_username', $mail, time() + 86400, IN_PATH);
            setcookie('in_userpassword', $pwd, time() + 86400, IN_PATH);
            echo '{"code":200}';
        }
    } else {
        echo '{"code":99,"msg":"登录失败，请检查账户密码后重试！"}';
    }
} elseif ($ac == 'reg') {
    $mail = SafeRequest("mail", "get");
    $pwd = substr(md5(SafeRequest("pwd", "get")), 8, 16);
    $seccode = SafeRequest("seccode", "get");
	$mcode = SafeRequest("mcode","get");
    $nichen = @nichen($mail);
    preg_match('/^([a-zA-Z0-9_\\.\\-])+\\@(([a-zA-Z0-9\\-])+\\.)+([a-zA-Z0-9]{2,4})+$/', $mail) or exit('{"code":99,"msg":"请输入正确得邮箱地址"}');
    if (empty($seccode) || $seccode != $_SESSION['code']) {
        echo 'return_1';
    } elseif ($GLOBALS['db']->getone("select in_userid from " . tname('user') . " where in_username='" . $mail . "'")) {
        echo '{"code":99,"msg":"当前用户名已被注册！"}';
    } 
    /*elseif (!$GLOBALS['db']->getone("select in_id from ".tname('mail')." where in_ucode='".$mail.'reg'.$mcode."'")){
        exit('return_4');
    }*/
    else {
        $setarr = array('in_username' => $mail, 'in_nick' => $nichen, 'in_userpassword' => $pwd, 'in_regdate' => date('Y-m-d H:i:s'), 'in_loginip' => getonlineip(), 'in_logintime' => date('Y-m-d H:i:s'), 'in_verify' => 0, 'in_islock' => 0, 'in_points' => IN_LOGINPOINTS, 'in_spaceuse' => 0, 'in_spacetotal' => IN_REGSPACE * 1048576);
        $in_userid = inserttable('user', $setarr, 1);
        setcookie('in_userid', $in_userid, time() + 86400, IN_PATH);
        setcookie('in_username', $mail, time() + 86400, IN_PATH);
        setcookie('in_userpassword', $pwd, time() + 86400, IN_PATH);
        echo '{"code":200}';
    }
} elseif($ac == 'sends'){
        IN_MAILOPEN == 0 and exit('return_0');
	$mail = SafeRequest("mail","get");
	$uid = $GLOBALS['db']->getone("select in_userid from ".tname('user')." where in_username='".$mail."'");
    if($uid){exit('return_1');}
	$mcode = md5(time().rand(2,pow(2,24)));
	$cookie = 'in_send_mail';
	empty($_COOKIE[$cookie]) or exit('return_2');
	setcookie($cookie, 'have', time() + 30, IN_PATH);
	$ssl = is_ssl() ? 'https://' : 'http://';
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
	$email->Subject = convert_charset('['.$mail.']新用户注册验证邮件');
	$email->AddAddress($mail, $mail);
	$html = '新用户注册的邮件码为【<font size="3" color="red">'.$mcode.'</font>】。该邮件码为新用户注册所用，请尽快使用！<br />如非本人操作，请忽略此邮件！<br /><br />'.IN_NAME.'<br>'.$ssl.$_SERVER['HTTP_HOST'].IN_PATH;
	$email->MsgHTML(convert_charset($html));
	$email->IsHTML(true);
	if(!$email->Send()){
		echo 'return_3';
	}else{
		$setarr = array(
			'in_uid' => $uid,
			'in_ucode' => $mail.'reg'.$mcode,
			'in_addtime' => date('Y-m-d H:i:s')
		);
		inserttable('mail', $setarr, 1);
		echo 'return_4';
    }
}elseif ($ac == 'send') {
    IN_MAILOPEN or exit('return_0');
    $mail = SafeRequest("mail", "get");
    $uid = $GLOBALS['db']->getone("select in_userid from " . tname('user') . " where in_username='" . $mail . "'");
    $uid or exit('return_1');
    $mcode = md5(time() . rand(2, pow(2, 24)));
    $cookie = 'in_send_mail';
    empty($_COOKIE[$cookie]) or exit('return_2');
    setcookie($cookie, 'have', time() + 30, IN_PATH);
    $ssl = is_ssl() ? 'https://' : 'http://';
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
    $email->Subject = convert_charset('[' . $mail . ']找回密码邮件');
    $email->AddAddress($mail, $mail);
    $html = '找回密码的邮件码为【' . $mcode . '】。该邮件码为重置密码所用，请尽快使用！<br />如非本人操作，请忽略此邮件！<br /><br />' . $ssl . $_SERVER['HTTP_HOST'] . IN_PATH;
    $email->MsgHTML(convert_charset($html));
    $email->IsHTML(true);
    if (!$email->Send()) {
        echo 'return_3';
    } else {
        $setarr = array('in_uid' => $uid, 'in_ucode' => $mail . $mcode, 'in_addtime' => date('Y-m-d H:i:s'));
        inserttable('mail', $setarr, 1);
        echo 'return_4';
    }
} elseif ($ac == 'lost') {
    $mail = SafeRequest("mail", "get");
    $pwd = substr(md5(SafeRequest("pwd", "get")), 8, 16);
    $mcode = SafeRequest("mcode", "get");
    $uid = $GLOBALS['db']->getone("select in_userid from " . tname('user') . " where in_username='" . $mail . "'");
    $uid or exit('return_1');
    $mid = $GLOBALS['db']->getone("select in_id from " . tname('mail') . " where in_uid=" . $uid . " and in_ucode='" . $mail . $mcode . "'");
    $mid or exit('return_2');
    $GLOBALS['db']->query("delete from " . tname('mail') . " where in_id=" . $mid);
    updatetable('user', array('in_userpassword' => $pwd), array('in_userid' => $uid));
    echo 'return_3';
}

  
  
  
  
  
  
  
  
?>