<?php

require_once '../../system/db.class.php';
require_once 'samples/Common.php';
use OSS\OssClient;
use OSS\Core\OssException;
$bucket = Common::getBucketName();
@set_time_limit(0);
if($_GET['ac'] == 'icon'){
$id = intval($_GET['id']);
$uid = intval($_GET['uid']);
$upw = SafeSql($_GET['upw']);
$userid = $GLOBALS['db']->getone("select in_userid from ".tname('user')." where in_userid=$uid and in_userpassword='$upw'");
$row = $GLOBALS['db']->getrow("select * from ".tname('app')." where in_id=".$id);
$row or exit('-1');
$row['in_uid'] == $userid or exit('-2');
$dst = '../../../data/attachment/'.$row['in_icon'];
$object = $row['in_icon'];
$ossClient = Common::getOssClient();
$ossClient->uploadFile($bucket,$object,$dst);
@unlink($dst);
$GLOBALS['db']->query("update ".tname('app')." set in_icon='".IN_REMOTEDK.$object."' where in_id=".$id);
echo '1';
}elseif($_GET['ac'] == 'app'){
$time = file_get_contents('../../../data/tmp/'.$_GET['time'].'.log');
$uid = intval($_GET['uid']);
$upw = SafeSql($_GET['upw']);
$userid = $GLOBALS['db']->getone("select in_userid from ".tname('user')." where in_userid=$uid and in_userpassword='$upw'");
$row = $GLOBALS['db']->getrow("select * from ".tname('app')." where in_icon='$time'");
$row or exit('-1');
$row['in_uid'] == $userid or exit('-2');
$dst = '../../../data/attachment/'.$row['in_icon'];
$object = $row['in_icon'];
$ossClient = Common::getOssClient();
$ossClient->uploadFile($bucket,$object,$dst);
@unlink($dst);
$GLOBALS['db']->query("update ".tname('app')." set in_icon='".IN_REMOTEDK.$object."' where in_id=".$row['in_id']);
$dst = '../../../data/attachment/'.$row['in_app'];
$object = $row['in_app'];
$ossClient = Common::getOssClient();
$ossClient->uploadFile($bucket,$object,$dst);
@unlink($dst);
$GLOBALS['db']->query("update ".tname('app')." set in_app='".IN_REMOTEDK.$object."' where in_id=".$row['in_id']);
echo '1';
}
?>