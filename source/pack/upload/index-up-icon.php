<?php
include '../../system/db.class.php';
$aid = intval($_POST['aid']);
$uid = intval($_POST['uid']);
$upw = SafeSql($_POST['upw']);
$userid = $GLOBALS['db']->getone("select in_userid from " . tname('user') . " where in_userid={$uid} and in_userpassword='{$upw}'");
$row = $GLOBALS['db']->getrow("select * from " . tname('app') . " where in_id=" . $aid);
$row or exit('-1');
$row['in_uid'] == $userid or exit('-2');
if (!empty($_FILES)) {
    $in_icon = stristr($row['in_icon'], '/') ? substr(strrchr($row['in_icon'], '/'), 1) : $row['in_icon'];
    $filepart = pathinfo($_FILES['icon']['name']);
    if (in_array(strtolower($filepart['extension']), array('jpg', 'jpeg', 'gif', 'png'))) {
        $file = '../../../data/attachment/' . $in_icon;
        @move_uploaded_file($_FILES['icon']['tmp_name'], $file);
        $GLOBALS['db']->query("update " . tname('app') . " set in_icon='{$in_icon}' where in_id=" . $aid);
        echo '1';
    } else {
        echo '-3';
    }
}
?>