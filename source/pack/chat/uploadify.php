<?php
include '../../system/db.class.php';
if (!empty($_FILES)) {
    $dir = '../../../data/tmp/';
    creatdir($dir);
    $file = $dir . intval($_GET['uid']) . '.' . date('YmdHis') . rand(2, pow(2, 24)) . '.' . fileext($_FILES['Filedata']['name']);
    $part = pathinfo($_FILES['Filedata']['name']);
    if (in_array(strtolower($part['extension']), array('jpg', 'gif', 'png', 'rar', 'zip'))) {
        @move_uploaded_file($_FILES['Filedata']['tmp_name'], $file);
        if (in_array(strtolower($part['extension']), array('rar', 'zip'))) {
            echo '[attach:' . str_replace($dir, '', $file) . ':' . $_FILES['Filedata']['name'] . ':' . formatsize($_FILES['Filedata']['size']) . ']';
        } else {
            echo '[img]' . str_replace('../../../', 'http://' . $_SERVER['HTTP_HOST'] . IN_PATH, $file) . '[/img]';
        }
    } else {
        echo '0';
    }
}
?>