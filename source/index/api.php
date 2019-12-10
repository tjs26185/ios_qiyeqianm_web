<?php
include '../system/db.class.php';
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: text/html;charset=" . IN_CHARSET);
header("Access-Control-Allow-Origin: " . (isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : NULL));
header("Access-Control-Allow-Credentials: true");
$status = SafeRequest("status", "get");
$site = SafeRequest("site", "get");
$id = intval(SafeRequest("id", "get"));
$newname = SafeRequest("newname", "get");
$gname = SafeRequest("gname", "get");
$ssl = SafeRequest("ssl", "get");
$path = SafeRequest("path", "get");
$uid = SafeRequest("uid", "get");
if ($gname) {
    updatetable('app', array('in_name' => "{$gname}"), array('in_id' => $id));
}
if ($newname) {
    updatetable('app', array('in_name' => "{$newname}"), array('in_id' => $id));
    updatetable('sign', array('in_aname' => "{$newname}"), array('in_aid' => $id));
    file_get_contents($ssl . $site . $path . 'source/index/api.php?gname=' . $newname . '&id=' . $id);
}
getfield('secret', 'in_id', 'in_site', str_replace('www.', '', $site)) or exit('-1');
$sid = $GLOBALS['db']->getone("select in_id from " . tname('sign') . " where in_site='{$site}' and in_aid=" . $id);
$cishu = $GLOBALS['db']->getone("select in_qianci from " . tname('sign') . " where in_site='{$site}' and in_aid=" . $id);
if ($status < 2) {
    $ipa = SafeRequest("ipa", "get");
    $suo = SafeRequest("suo", "get");
    $cert = SafeRequest("cert", "get");
    $yololib = SafeRequest("yololib", "get");
    $replace = SafeRequest("replace", "get");
    $charset = SafeRequest("charset", "get");
    $name = SafeRequest("name", "get");
    $replace = $suo ? $replace . '|' . $suo : $replace;
    $setarr = array('in_aid' => $id, 'in_uid' => $uid, 'in_suo' => $suo, 'in_aname' => @convert_utf8($name, $charset), 'in_newaname' => $newname, 'in_replace' => $replace, 'in_ssl' => $ssl, 'in_site' => $site, 'in_path' => $path, 'in_ipa' => $ipa, 'in_yololib' => $yololib, 'in_status' => 1, 'in_cert' => $cert, 'in_time' => time());
    if ($sid) {
        updatetable('sign', $setarr, array('in_id' => $sid));
    } else {
        //$atime = time()+1800;
        //$GLOBALS['db']->query("update " . tname('app') . " set in_sign='{$atime}' where in_uid!=1 and in_id=" . $id);
        inserttable('sign', $setarr);
    }
    echo '1';
} else {
    if ($sid) {
        updatetable('sign', array('in_status' => 2, 'in_qianci' => $cishu + 1, 'in_time' => time()), array('in_id' => $sid));
        echo '1';
        $res = $GLOBALS['db']->getrow("select * from " . tname('app') . " where in_id=" . $id);
        $nick = $res['in_nick'];
        $nes = $GLOBALS['db']->getrow("select * from " . tname('cert') . " where in_nick='{$nick}'");
        $in_dir = $nes['in_dir'];
        copy('../../data/cert/' . $in_dir . '/' . substr(md5($in_dir), 8, 8) . '.mobileprovision', '../../data/attachment/' . str_replace('.png', '.mobileprovision', substr($res['in_icon'], -36)));
    }
}