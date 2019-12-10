<?php
include '../system/db.class.php';
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: text/html;charset=" . IN_CHARSET);
header("Access-Control-Allow-Origin: " . (isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : NULL));
header("Access-Control-Allow-Credentials: true");
$cert = NULL;
$uid = $_GET['uid'];
$uid = $uid ? $uid : $_COOKIE['in_userid'];
$user = $GLOBALS['db']->getone("select in_username from " . tname('user') . " where in_userid=" . $uid);
$user = $user ? $user : $_COOKIE['in_username'];
$query = $GLOBALS['db']->query("select * from " . tname('cert'));
while ($row = $GLOBALS['db']->fetch_array($query)) {
    $cername = explode(': ', $row['in_name']);
    $cername = $cername[1];
    if (time() >= strtotime($row['endt'])) {
        $GLOBALS['db']->query("delete from " . tname('cert') . " where in_id='{$row['in_id']}'");
    }
    if ($uid && ($uid == $row['in_uid'] || $row['in_uid'] == '0')) {
        $name .= $cername;
        if (substr_count($name, $cername) < 2) {
            $cert .= '<option value="' . $row['in_dir'] . '" id="cert_' . $row['in_dir'] . '" data-mingcheng="' .$cername. '">签名通道' . $row['in_id']  . '</option>';
        }
    }
}
echo $cert ? $cert : '<option value="">当前没有证书可以使用，请自助上传证书或联系管理员</option>';
?>