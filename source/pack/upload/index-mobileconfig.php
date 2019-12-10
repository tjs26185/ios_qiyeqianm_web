<?php
include '../../system/db.class.php';
include '../../system/user.php';
$GLOBALS['userlogined'] or exit('-1');
$id = intval($_GET['id']);
$time = $_GET['time'];
preg_match('/^(\\d+\\-\\d+)$/', $time) or exit('-2');
$tmp = '../../../data/tmp/' . $time . '.mobileconfig';
is_file($tmp) or exit('-2');
$xml_size = intval(filesize($tmp));
$explode = explode('-', $time);
$icontime = md5($explode[0] . '-' . $explode[1] . '-' . rand(2, pow(2, 24))) . '.png';
$apptime = md5($explode[1] . '-' . $explode[0] . '-' . rand(2, pow(2, 24))) . '.mobileconfig';
is_file('../../../data/attachment/' . $apptime) and exit('-2');
IN_VERIFY > 0 and $GLOBALS['erduo_in_verify'] != 1 and exit('-3');
$xml_size + $GLOBALS['erduo_in_spaceuse'] > $GLOBALS['erduo_in_spacetotal'] and exit('-4');
$mc = file_get_contents($tmp);
rename($tmp, '../../../data/attachment/' . $apptime);
$xml_bid = preg_match_all('/<key>PayloadIdentifier<\\/key>([\\s\\S]+?)<string>([\\s\\S]+?)<\\/string>/', $mc, $c) ? SafeSql(isset($c[2][1]) ? $c[2][1] : $c[2][0]) : '*';
$xml_name = preg_match('/<key>Label<\\/key>([\\s\\S]+?)<string>([\\s\\S]+?)<\\/string>/', $mc, $c) ? SafeSql(detect_encoding($c[2])) : NULL;
if (!$xml_name) {
    $xml_name = preg_match('/<key>PayloadDisplayName<\\/key>([\\s\\S]+?)<string>([\\s\\S]+?)<\\/string>/', $mc, $c) ? SafeSql(detect_encoding($c[2])) : '*';
}
$xml_icon = preg_match('/<key>Icon<\\/key>([\\s\\S]+?)<data>([\\s\\S]+?)<\\/data>/', $mc, $c) ? $c[2] : NULL;
if ($id) {
    getfield('app', 'in_uid', 'in_id', $id) == $GLOBALS['erduo_in_userid'] or exit('-5');
    getfield('app', 'in_bid', 'in_id', $id) == $xml_bid and getfield('app', 'in_name', 'in_id', $id) == $xml_name or exit('-6');
} else {
    $id = $GLOBALS['db']->getone("select in_id from " . tname('app') . " where in_bid='{$xml_bid}' and in_name='{$xml_name}' and in_form='mobileconfig' and in_uid=" . $GLOBALS['erduo_in_userid']);
}
IN_REMOTE > 0 and fwrite(fopen('../../../data/tmp/' . $time . '.log', 'wb+'), $icontime);
file_put_contents('../../../data/attachment/' . $icontime, base64_decode($xml_icon));
if ($id) {
    $old = $GLOBALS['db']->getrow("select * from " . tname('app') . " where in_id=" . $id);
    @unlink('../../../data/attachment/' . str_replace('.png', '.mobileprovision', substr($old['in_icon'], -36)));
    @unlink('../../../data/attachment/' . $old['in_icon']);
    @unlink('../../../data/attachment/' . $old['in_app']);
    $GLOBALS['db']->query("update " . tname('user') . " set in_spaceuse=in_spaceuse+{$xml_size}-" . $old['in_size'] . " where in_userid=" . $GLOBALS['erduo_in_userid']);
    $GLOBALS['db']->query("update " . tname('app') . " set in_name='{$xml_name}',in_type=1,in_size={$xml_size},in_form='iOS',in_mnvs='8.0',in_bid='{$xml_bid}',in_bsvs='1.0.0',in_bvs='1',in_nick='*',in_team='*',in_icon='{$icontime}',in_app='{$apptime}',in_addtime='" . date('Y-m-d H:i:s') . "' where in_id=" . $id);
} else {
    $GLOBALS['db']->query("update " . tname('user') . " set in_spaceuse=in_spaceuse+{$xml_size} where in_userid=" . $GLOBALS['erduo_in_userid']);
    $GLOBALS['db']->query("Insert " . tname('app') . " (in_name,in_uid,in_uname,in_type,in_size,in_form,in_mnvs,in_bid,in_bsvs,in_bvs,in_nick,in_team,in_icon,in_app,in_hits,in_kid,in_sign,in_resign,in_removead,in_highspeed,in_addtime) values ('{$xml_name}'," . $GLOBALS['erduo_in_userid'] . ",'" . $GLOBALS['erduo_in_username'] . "',1,{$xml_size},'mobileconfig','8.0','{$xml_bid}','1.0.0','1','*','*','{$icontime}','{$apptime}',0,0,0,0,0,0,'" . date('Y-m-d H:i:s') . "')");
}
echo '1';
?>
