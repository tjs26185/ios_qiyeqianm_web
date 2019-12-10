<?php

namespace Qiniu\Storage;
use Qiniu\Http\Client;
use Qiniu\Http\Error;
final class FormUploader
{
public static function put(
$upToken,
$key,
$data,
$config,
$params,
$mime,
$checkCrc
) {
$fields = array('token'=>$upToken);
if ($key === null) {
$fname = 'filename';
}else {
$fname = $key;
$fields['key'] = $key;
}
if ($checkCrc) {
$fields['crc32'] = \Qiniu\crc32_data($data);
}
if ($params) {
foreach ($params as $k =>$v) {
$fields[$k] = $v;
}
}
list($upHost,$err) = $config->zone->getUpHostByToken($upToken);
if ($err != null) {
return array(null,$err);
}
$response = Client::multipartPost($upHost,$fields,'file',$fname,$data,$mime);
if (!$response->ok()) {
return array(null,new Error($upHost,$response));
}
return array($response->json(),null);
}
public static function putFile(
$upToken,
$key,
$filePath,
$config,
$params,
$mime,
$checkCrc
) {
$fields = array('token'=>$upToken,'file'=>self::createFile($filePath,$mime));
if ($key !== null) {
$fields['key'] = $key;
}
if ($checkCrc) {
$fields['crc32'] = \Qiniu\crc32_file($filePath);
}
if ($params) {
foreach ($params as $k =>$v) {
$fields[$k] = $v;
}
}
$fields['key'] = $key;
$headers =array('Content-Type'=>'multipart/form-data');
list($upHost,$err) = $config->zone->getUpHostByToken($upToken);
if ($err != null) {
return array(null,$err);
}
$response = client::post($upHost,$fields,$headers);
if (!$response->ok()) {
return array(null,new Error($upHost,$response));
}
return array($response->json(),null);
}
private static function createFile($filename,$mime)
{
if (function_exists('curl_file_create')) {
return curl_file_create($filename,$mime);
}
$value = "@{$filename}";
if (!empty($mime)) {
$value .= ';type='.$mime;
}
return $value;
}
}
?>