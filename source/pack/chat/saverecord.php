<?php
include '../../system/db.class.php';
$data = empty($GLOBALS['HTTP_RAW_POST_DATA']) ? file_get_contents('php://input') : $GLOBALS['HTTP_RAW_POST_DATA'];
if ($data) {
    $dir = '../../../data/tmp/';
    creatdir($dir);
    $path = $dir . date('YmdHis') . rand(2, pow(2, 24)) . '.mp3';
    $file = @fopen($path, 'w');
    @fwrite($file, $data);
    @fclose($file);
    echo str_replace('../../../', '', $path);
} else {
    echo 'error';
}
?>