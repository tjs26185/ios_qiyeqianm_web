<?php
include '../system/db.class.php';
include '../system/user.php';
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: text/html;charset=" . IN_CHARSET);
$GLOBALS['userlogined'] or exit('-1');
$ac = SafeRequest("ac", "get");
if ($ac == 'del') {
    $id = intval(SafeRequest("id", "get"));
    $row = $GLOBALS['db']->getrow("select * from " . tname('app') . " where in_id=" . $id);
    $row or exit('-2');
    $row['in_uid'] == $GLOBALS['erduo_in_userid'] or exit('-3');
	$GLOBALS['db']->query("update ".tname('app')." set in_resign=0,in_sign=0,shan=shan+1 where in_id=".$id);
   // $GLOBALS['db']->query("delete from " . tname('app') . " where in_id=" . $id);
    $GLOBALS['db']->query("delete from " . tname('salt') . " where in_aid=" . $id);
    $GLOBALS['db']->query("delete from " . tname('sign') . " where in_aid=" . $id);
    $GLOBALS['db']->query("delete from " . tname('signlog') . " where in_aid=" . $id);
    $GLOBALS['db']->query("delete from app where aid=" . $id);
    $GLOBALS['db']->query("update " . tname('user') . " set in_spaceuse=in_spaceuse-" . $row['in_size'] . " where in_userid=" . $row['in_uid']);
    @unlink(IN_ROOT . './data/attachment/' . str_replace('.png', '.mobileprovision', substr($row['in_icon'], -36)));
    @unlink(IN_ROOT . './data/attachment/' . $row['in_icon']);
   // $cername = explode('.', $row['in_app']);
   // $cername = $cername[1];
  if($row['in_form'] == 'mobileconfig'){
   // @unlink(IN_ROOT . './data/attachment/' . $row['in_app']);
  }
   // @unlink(IN_ROOT . './data/attachment/' . $row['in_app']);
    echo '1';
} elseif ($ac == 'edit') {
    $id = intval(SafeRequest("id", "get"));
    $link = SafeRequest("link", "get");
    $name = unescape(SafeRequest("name", "get"));
    $row = $GLOBALS['db']->getrow("select * from " . tname('app') . " where in_id=" . $id);
    $row or exit('-2');
    $row['in_uid'] == $GLOBALS['erduo_in_userid'] or exit('-3');
    in_array($link, array('data', 'source', 'static')) and exit('-4');
    is_numeric($link) and exit('-4') or is_numeric(auth_codes($link, 'de')) and exit('-4');
    $one = $GLOBALS['db']->getone("select in_id from " . tname('app') . " where in_link='{$link}' and in_id<>" . $id);
    $link and $one and exit('-5');
    $link and !IN_REWRITE and exit('-6');
    $GLOBALS['db']->query("update " . tname('app') . " set in_name='{$name}',in_link='{$link}' where in_id=" . $id);
    echo '1';
} elseif ($ac == 'info') {
    $mobile = SafeRequest("mobile", "get");
    $qq = SafeRequest("qq", "get");
    $firm = unescape(SafeRequest("firm", "get"));
    $job = unescape(SafeRequest("job", "get"));
    updatetable('user', array('in_mobile' => $mobile, 'in_qq' => $qq, 'in_firm' => $firm, 'in_job' => $job), array('in_userid' => $GLOBALS['erduo_in_userid']));
    echo '1';
} elseif ($ac == 'pwd') {
    $old = substr(md5(SafeRequest("old", "get")), 8, 16);
    $new = substr(md5(SafeRequest("new", "get")), 8, 16);
    $old == $GLOBALS['erduo_in_userpassword'] or exit('-2');
    updatetable('user', array('in_userpassword' => $new), array('in_userid' => $GLOBALS['erduo_in_userid']));
    echo '1';
} elseif ($ac == 'send_verify') {
    $nick = unescape(SafeRequest("nick", "get"));
    $card = SafeRequest("card", "get");
    $old = IN_ROOT . './data/tmp/' . $GLOBALS['erduo_in_userid'] . '-';
    $new = IN_ROOT . './data/attachment/avatar/' . $GLOBALS['erduo_in_userid'] . '-';
    updatetable('user', array('in_nick' => $nick, 'in_card' => $card, 'in_verify' => 2), array('in_userid' => $GLOBALS['erduo_in_userid']));
    @rename($old . 'prev.jpg', $new . 'prev.jpg');
    @rename($old . 'after.jpg', $new . 'after.jpg');
    @rename($old . 'hand.jpg', $new . 'hand.jpg');
    echo '1';
} elseif ($ac == 'add_space') {
    $mb = intval(SafeRequest("mb", "get"));
    $mb > 0 or exit('-2');
    $points = $mb * IN_SPACEPOINTS;
    $GLOBALS['erduo_in_points'] < $points and exit('-3');
    $GLOBALS['db']->query("update " . tname('user') . " set in_spacetotal=in_spacetotal+" . $mb * 1048576 . " where in_userid=" . $GLOBALS['erduo_in_userid']);
    $GLOBALS['db']->query("update " . tname('user') . " set in_points=in_points-{$points} where in_userid=" . $GLOBALS['erduo_in_userid']);
    echo '1';
} elseif ($ac == 'each_del') {
    $aid = intval(SafeRequest("aid", "get"));
    $row = $GLOBALS['db']->getrow("select * from " . tname('app') . " where in_id=" . $aid);
    $row['in_uid'] == $GLOBALS['erduo_in_userid'] or exit('-2');
    updatetable('app', array('in_kid' => 0), array('in_id' => $aid));
    updatetable('app', array('in_kid' => 0), array('in_id' => $row['in_kid']));
    echo '1';
} elseif ($ac == 'each_add') {
    $aid = intval(SafeRequest("aid", "get"));
    $kid = intval(SafeRequest("kid", "get"));
    $row = $GLOBALS['db']->getrow("select * from " . tname('app') . " where in_id=" . $aid);
    $row or exit('-2');
    $row['in_uid'] == $GLOBALS['erduo_in_userid'] or exit('-3');
    getfield('app', 'in_uid', 'in_id', $kid) == $GLOBALS['erduo_in_userid'] or exit('-3');
    getfield('app', 'in_form', 'in_id', $kid) == $row['in_form'] and exit('-4');
    updatetable('app', array('in_kid' => $kid), array('in_id' => $aid));
    updatetable('app', array('in_kid' => $aid), array('in_id' => $kid));
    echo '1';
} elseif ($ac == 'high_speed') {
    $id = intval(SafeRequest("id", "get"));
    $row = $GLOBALS['db']->getrow("select * from " . tname('app') . " where in_id=" . $id);
    $row or exit('-2');
    $row['in_uid'] == $GLOBALS['erduo_in_userid'] or exit('-3');
    IN_SPEEDPOINTS > 0 or exit('-4');
    $GLOBALS['erduo_in_points'] < IN_SPEEDPOINTS and exit('-5');
    $GLOBALS['db']->query("update " . tname('user') . " set in_points=in_points-" . IN_SPEEDPOINTS . " where in_userid=" . $GLOBALS['erduo_in_userid']);
    updatetable('app', array('in_highspeed' => 1), array('in_id' => $id));
    echo '1';
} elseif ($ac == 'remove_ad') {
    $id = intval(SafeRequest("id", "get"));
    $row = $GLOBALS['db']->getrow("select * from " . tname('app') . " where in_id=" . $id);
    $row or exit('-2');
    $row['in_uid'] == $GLOBALS['erduo_in_userid'] or exit('-3');
    IN_ADPOINTS > 0 or exit('-4');
    $GLOBALS['erduo_in_points'] < IN_ADPOINTS and exit('-5');
    $GLOBALS['db']->query("update " . tname('user') . " set in_points=in_points-" . IN_ADPOINTS . " where in_userid=" . $GLOBALS['erduo_in_userid']);
    updatetable('app', array('in_removead' => 1), array('in_id' => $id));
    echo '1';
}
?>