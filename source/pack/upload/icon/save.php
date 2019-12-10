<?php
include '../../../system/db.class.php';
if (!empty($_FILES)) {
    $dir = '../../../../data/icon/';
    if ($h = opendir($dir)) {
        while ($f = readdir($h)) {
            if ($f != '.' && $f != '..') {
                unlink($dir . $f);
            }
        }
        closedir($h);
    }
    $file = $dir . 'icon.' . fileext($_FILES['file']['name']);
    $fileext = 'jpg|jpeg|gif|png';
    $filearray = preg_split('/\\|/', $fileext);
    $filepart = pathinfo($_FILES['file']['name']);
    if (in_array(strtolower($filepart['extension']), $filearray)) {
        if (move_uploaded_file($_FILES['file']['tmp_name'], $file)) {
            $arr = explode('|', $_POST['post']);
            for ($i = 0; $i < count($arr); $i++) {
                $size = explode('*', $arr[$i]);
                image_crop($size[0], $size[1], $file, $dir . ($i + 1) . '.png');
            }
            unlink($file);
            include_once '../../zip/zip.php';
            $zip = new PclZip($dir . 'icon.zip');
            if (($list = $zip->create($dir, PCLZIP_OPT_REMOVE_PATH, $dir)) == 0) {
                echo $zip->errorInfo(true);
            } else {
                echo '1';
            }
        } else {
            echo '-2';
        }
    } else {
        echo '-1';
    }
}
?>