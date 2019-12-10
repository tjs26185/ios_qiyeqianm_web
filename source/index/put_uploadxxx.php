<?php
include '../system/db.class.php';
header("Content-type: text/html;charset=" . IN_CHARSET);
if (!empty($_FILES)) {
    $id = intval($_POST['id']);
    $pw = $_POST['pw'];
    $mm = $_POST['mm'];
    $pw and $pw == IN_SECRET or exit('Access denied');
    $file = '../../data/attachment/' . getfield('app', 'in_app', 'in_id', $id);
    $name = $GLOBALS['db']->getone("select in_name from " . tname('app') . " where in_id=" . $id);
    $uid  = $GLOBALS['db']->getone("select in_uid from " . tname('app') . " where in_id=" . $id);
    $cert = $GLOBALS['db']->getone("select in_cert from " . tname('sign') . " where in_aid=" . $id);
    $row  = $GLOBALS['db']->getrow("select * from " . tname('cert') . " where in_dir='{$cert}'");
    $sign = $GLOBALS['db']->getone("select in_sign from " . tname('app') . " where in_id=" . $id);
    $cert = $row['in_nick'];
    $cern = explode(':',$row['in_name']); 
    $cern = trim($cern[1]);
    $filepart = pathinfo($_FILES['ipa']['name']);
    $extension = strtolower($filepart['extension']);
    if (in_array($extension, array('ipa', 'apk')) && $mm == '8173816') {
        if (move_uploaded_file($_FILES['ipa']['tmp_name'], $file)) {
            $xml_size = filesize($file);
            if($sign == '1999999999'){
              // updatetable('app', array('in_sign' => time()+1800), array('in_id' => $id));
            }
            updatetable('sign', array('in_status' => 2, 'in_uid' => $uid ,'in_time' => time()-30), array('in_aid' => $id));
            updatetable('signlog', array('in_status' => 2, 'in_cert' => $cern, 'in_nick' => $cert, 'in_addtime' => date('Y-m-d H:i:s')), array('in_aid' => $id));
            updatetable('app', array('in_type' => 1, 'in_team' => $cern, 'in_nick' => $cert, 'in_size' => $xml_size, 'in_addtime' => date('Y-m-d H:i:s')), array('in_id' => $id));
            echo '[' . $name . ']•[' . $id . ']•[' . $_SERVER['HTTP_HOST'] . ']';
            $res = $GLOBALS['db']->getrow("select * from " . tname('app') . " where in_id=" . $id);
            @mails($id, $res['in_uname'], $res['in_name'], $res['in_resign'], $res['in_team']);
        }
    }
}
function mails($id, $mail, $app, $resign, $cer)
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
    $email->Subject = convert_charset('您的APP【' . $app . '】签名已完成！请查看！！！');
    $email->AddAddress($mail, $mail);
    $ssl = is_ssl() ? 'https://' : 'http://';
    $Name = IN_NAME;
    $html = '<center>' . IN_NAME . '提醒您<br> 
                  你的APP【<font size="3" color="red">' . $app . '</font>】【'.$id.'】<br>
                  企业签证补签操作完成<br>
                  使用的证书<br>
                  <font size="3" color="red">' . $cer . '</font><br><br>
                  <a href="' . $ssl . $_SERVER['HTTP_HOST'] . '/' . base64_encode($id) . '"><font size="3" color="red">点此下载</font>【<font size="3" color="red">' . $app . '</font>】</a><br><br>
                  剩余补签次数【<font size="3" color="red">' . $resign . '</font>】次<br>
                  请注意关注补签余量<br>
                  联系QQ ' . QQHAO . ' 可充值<br>
                  或联系微信 ' . QQHAO . ' 充值<br><br>
                  <a href="' . $ssl . $_SERVER['HTTP_HOST'] . '">' . IN_NAME . '托管平台<br>' . $ssl . $_SERVER['HTTP_HOST'] . '</a></center>';
    $email->MsgHTML(convert_charset($html));
    $email->IsHTML(true);
    if (!$email->Send()) {
        //echo '1';
    } else {
        //echo '1';
    }
}