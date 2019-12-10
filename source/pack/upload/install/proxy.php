<?php
include '../../../system/db.class.php';
$GLOBALS['db']->query("delete from " . tname('salt') . " where in_time<" . strtotime('-5 minute'));
$proxy = explode('/', isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : NULL);
$base = isset($proxy[1]) ? $proxy[1] : NULL;
$salt = SafeSql(str_replace(array('.ipa', '.apk', '.mobileconfig'), '', $base));
$id = getfield('salt', 'in_aid', 'in_salt', $salt);
//$id or exit('Access denied');
//exit($au);
$intime = getfield('salt', 'in_time', 'in_salt', $salt);
$ctime = time() - $intime;
$ua = $_SERVER["HTTP_USER_AGENT"];
if ($ua == 'com.apple.appstored/1.0 iOS/12.1.2 model/iPhone10,2 hwp/t8015 build/16C101 (6; dt:158)'){
    //exit('<center><br><br><br><br><br><br><br><strong><font size="15px" color="red">链接已过期，请重新下载！</font></strong></center>');
}
if (!$id) {
    exit('<center><br><br><br><br><br><br><br><strong><font size="15px" color="red">链接已过期，请重新下载！</font></strong></center>');
}
$au = getfield('salt', 'ua', 'in_salt', $salt);
if ($ua != $au) {
    exit('<center><br><br><br><br><br><br><br><strong><font size="15px" color="red">链接无效，请勿抓包！</font></strong></center>');
}
$GLOBALS['db']->query("update app set d_num=d_num+1 where aid=" . $id);
$uid = getfield('app', 'in_uid', 'in_id', $id);
$points = getfield('user', 'in_points', 'in_userid', $uid);
$points > 0 or exit(header('location:' . getlink($id)));
$GLOBALS['db']->query("update " . tname('user') . " set in_points=in_points-1 where in_userid=" . $uid);
$GLOBALS['db']->query("update " . tname('app') . " set in_hits=in_hits+1,in_antime='" . date('Y-m-d H:i:s', time()) . "' where in_id=" . $id);
$size = getfield('app', 'in_size', 'in_id', $id);
$app = getfield('app', 'in_app', 'in_id', $id);
$cername = explode('.', $app);
$cername = $cername[1];
if (!dstrpos($ua, array('iphone', 'ipad', 'ipod'))) {
    $base = IN_NAME . '[' . $id . ']' . getfield('app', 'in_name', 'in_id', $id) . '[' . getfield('app', 'in_bid', 'in_id', $id) . '].' . $cername;
}


if (strstr($app, "http")) {
    header('location:' . $app);
    exit;
}
if (IN_DENIED == 0) {
    header('location:https://' . $_SERVER['HTTP_HOST'] . IN_PATH . 'data/attachment/' . $app);
    exit;
}
$GLOBALS['db']->query("delete from " . tname('salt') . " where in_salt='{$salt}'");
$size = filesize('../../../../data/attachment/' . $app);
header("Cache-Control: private");
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=" . $base);
header('Content-Transfer-Encoding:binary');
header("Accept-Ranges: bytes");
header('Expires:0');
header('Cache-Control:must-revalidate');
header('Pragma:public');
header("Content-Length: " . $size);
if (getapp($app)) {
    readfile(getapp($app, 1));
} else {
    $highspeed = getfield('app', 'in_highspeed', 'in_id', $id);
    $speed = IN_SPEEDPOINTS ? $highspeed ? IN_HIGHSPEED : IN_LOWSPEED : IN_HIGHSPEED;
    flush();
    $file = fopen(IN_ROOT . './data/attachment/' . $app, 'r');
    while (!feof($file)) {
        echo fread($file, round($speed * 10240));
        flush();
        ob_flush();
        sleep(1);
    }
    fclose($file);
}