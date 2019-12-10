<?php
include '../../system/db.class.php';
$json = json_decode(stripslashes($_POST['post']), true);
$id = intval($json['_id']);
$aid = intval($json['_aid']);
$apw = $json['_apw'];
$icon = getfield('app', 'in_icon', 'in_id', $id);
if (!getfield('admin', 'in_adminid', 'in_adminid', $aid) || md5(getfield('admin', 'in_adminpassword', 'in_adminid', $aid)) !== $apw) {
    exit('Access denied');
}
if (!empty($_FILES)) {
    $in_icon = stristr($icon, '/') ? substr(strrchr($icon, '/'), 1) : $icon;
    $filepart = pathinfo($_FILES['file']['name']);
    if (in_array(strtolower($filepart['extension']), array('jpg', 'jpeg', 'gif', 'png'))) {
        $file = '../../../data/attachment/' . $in_icon;
        @move_uploaded_file($_FILES['file']['tmp_name'], $file);
        echo $in_icon;
    } else {
        echo '-1';
    }
}
?>