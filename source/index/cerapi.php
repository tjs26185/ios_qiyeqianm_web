<?php
header('Access-Control-Allow-Origin:http://98dyy.cn');
header('Access-Control-Allow-Methods:POST,GET,OPTIONS,DELETE'); // 允许请求的类型
header('Access-Control-Allow-Credentials: true'); // 设置是否允许发送 cookies
header('Access-Control-Allow-Headers: Content-Type,Content-Length,Accept-Encoding,X-Requested-with, Origin'); // 设置允许自定义请求头的字段
include '../system/db.class.php';
$filem = $_FILES['fileProvision'];
$filep = $_FILES['fileCert'];
$mima = $_POST['password'];
$user = $_POST['user'];
$uid = $_POST['uid'];
if (!$filem['name']) {
    exit('请选择描述文件，格式为 <font size="5" color="red">.mobileprovision</font>');
} else {
    $extension = strtolower(pathinfo($filem['name'])['extension']);
    if (in_array($extension, array('mobileprovision'))) {
        $xname = str_replace('.mobileprovision', '', $filem['name']);
        $xname = str_replace([',', '.', '-', '	', ' ', '(', ')', '（', '）'], '', pinyin_long($xname));
        $uploadPath = '../../data/cert/' . $xname;
        creatdir($uploadPath);
        $name = $xname . '.' . $extension;
        move_uploaded_file($filem['tmp_name'], $uploadPath . '/' . $name);
    } else {
        exit('<font size="4" color="red">' . $filem['name'] . '</font> 不是描述文件类型！文件后缀应该是 <font size="5" color="red">.mobileprovision</font> ！请重新选择！');
    }
}
if (!$filep['name']) {
    exit('请选择选择P12文件，格式为 <font size="5" color="red">.p12</font>');
} else {
    $extension = strtolower(pathinfo($filep['name'])['extension']);
    if (in_array($extension, array('p12'))) {
        $name = $xname . '.' . $extension;
        move_uploaded_file($filep['tmp_name'], $uploadPath . '/' . $name);
    } else {
        exit('<font size="4" color="red">' . $filep['name'] . '</font> 不是p12证书文件类型！文件后缀应该是 <font size="5" color="red">.p12</font> ！请重新选择！');
    }
}
if ($filep['name'] && $filem['name']) {
    $certpath = '../../data/cert/' . $xname . $xname;
    $mp = @file_get_contents($uploadPath . '/' . $xname . '.mobileprovision');
    $iden = preg_match('/<key>application-identifier<\\/key>([\\s\\S]+?)<string>([\\s\\S]+?)<\\/string>/', $mp, $m) ? $m[2] : NULL;
    $endt = preg_match('/<key>ExpirationDate<\\/key>([\\s\\S]+?)<date>([\\s\\S]+?)<\\/date>/', $mp, $m) ? $m[2] : NULL;
    $xml_nick = preg_match('/<key>Name<\\/key>([\\s\\S]+?)<string>([\\s\\S]+?)<\\/string>/', $mp, $m) ? mb_convert_encoding($m[2], set_chars(), 'HTML-ENTITIES') : '*';
    $name = preg_match('/<key>TeamName<\\/key>([\\s\\S]+?)<string>([\\s\\S]+?)<\\/string>/', $mp, $m) ? mb_convert_encoding($m[2], set_chars(), 'HTML-ENTITIES') : NULL;
    $idens = substr($iden, 0, 10);$namex = str_replace(array('&apos;'),array("'"),htmlspecialchars_decode(urldecode($name)));
    if (strpos($mp, 'ProvisionedDevices')) {
        $lei = 'Developer';
    } else {
        $lei = 'Distribution';
    }
    $pl = @file_get_contents('../../static/app/cert.plist');
    $pl = str_replace(array('[iden]', "\r"), array($iden, ''), $pl);
    $pl = str_replace(array('[idens]', "\r"), array($idens, ''), $pl);
    @fwrite(fopen($uploadPath . '/' . $xname . '.plist', 'w'), $pl);
    $sh = @file_get_contents('../../static/app/cer.sh');
    $sh = str_replace(array('[lei]', '[name]', '[cert]', '[mulu]', '[mima]', "\r"), array($lei, $namex, $xname . $xname, $xname . $xname, $mima, ''), $sh);
    @fwrite(fopen($uploadPath . '/' . $xname . '.sh', 'w'), $sh);
    $names = 'iPhone ' . $lei . ': ' . $name;
    $in_id = $db->getone("select in_id from " . tname('cert') . " where in_name='{$names}' and in_iden='{$iden}' and in_uid='{$uid}'");
    if (!$in_id) {
        creatdir($certpath);
        copy($uploadPath . '/' . $xname . '.sh', $certpath . '/' . substr(md5($xname . $xname), 8, 8) . '.sh');
        copy($uploadPath . '/' . $xname . '.p12', $certpath . '/' . substr(md5($xname . $xname), 8, 8) . '.p12');
        copy($uploadPath . '/' . $xname . '.plist', $certpath . '/' . substr(md5($xname . $xname), 8, 8) . '.plist');
        copy($uploadPath . '/' . $xname . '.mobileprovision', $certpath . '/' . substr(md5($xname . $xname), 8, 8) . '.mobileprovision');
        $in_sign = 3600 * 24 * 7;
        // $db->query("update " . tname('app') . " set in_sign=in_sign+{$in_sign},in_resign=in_resign+3 where in_uid=" . $uid);
        $db->query("Insert " . tname('cert') . " (in_uid,in_iden,in_name,in_nick,in_dir,mima,user,endt) values ('{$uid}','{$iden}','{$names}','{$xml_nick}','{$xname}{$xname}','{$mima}','{$user}','{$endt}')");
        echo '上传成功' . PHP_EOL . '当前证书状态：<font size="4" color="red">正常</font> ' . PHP_EOL . '证书名称： <font size="4" color="red">' . $name . '</font> ';
    } else {
        echo '证书<font size="4" color="red"> ' . $name . ' </font>已存在！请重新上传其他证书！';
    }
    @deldirs($uploadPath);
}
?>