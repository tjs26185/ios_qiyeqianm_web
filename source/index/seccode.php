<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: image/png");
session_start();
$authnum_session = NULL;
for ($i = 0; $i < 4; $i++) {
    $authnum_session .= rand(0, 9);
}
$_SESSION['code'] = $authnum_session;
$im = imagecreate(50, 20);
ImageColorAllocate($im, 61,175,235);
//ImageColorAllocate($im, 226, 100, 76);
imagestring($im, 5, 8, 2, $authnum_session, ImageColorAllocate($im, 255, 255, 255));
for ($i = 0; $i < 3; $i++) {
    imageline($im, rand(0, 30), rand(0, 21), rand(20, 40), rand(0, 21), ImageColorAllocate($im, 220, 220, 220));
}
for ($i = 0; $i < 90; $i++) {
    imagesetpixel($im, rand() % 70, rand() % 30, ImageColorAllocate($im, 200, 200, 200));
}
ImagePNG($im);
ImageDestroy($im);