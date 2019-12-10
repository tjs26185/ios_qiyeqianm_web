<?php

require_once '../../system/db.class.php';
require_once 'autoload.php';
use Qiniu\Auth;
use Qiniu\Storage\BucketManager;
use Qiniu\Storage\UploadManager;
$auth = new Auth(IN_REMOTEAK,IN_REMOTESK);
$token = $auth->uploadToken(IN_REMOTEBK);
$bucketMgr = new BucketManager($auth);
$uploadMgr = new UploadManager();
;echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=';echo IN_CHARSET;;echo '">
<title>七牛云存储</title>
<script type="text/javascript" src="';echo IN_PATH;;echo 'static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="';echo IN_PATH;;echo 'static/index/remote.js"></script>
<script type="text/javascript">set_start();</script>
</head>
<body>
';
ob_start();
@set_time_limit(0);
function callback($resource){
$info = curl_getinfo($resource);
echo '<script type="text/javascript">set_progress('.$info['size_upload'].', '.$info['upload_content_length'].');</script>';
ob_flush();
flush();
}
if($_GET['ac'] == 'icon'){
$id = intval($_GET['id']);
$uid = intval($_GET['uid']);
$upw = SafeSql($_GET['upw']);
$userid = $GLOBALS['db']->getone("select in_userid from ".tname('user')." where in_userid=$uid and in_userpassword='$upw'");
$row = $GLOBALS['db']->getrow("select * from ".tname('app')." where in_id=".$id);
$row or exit('<script type="text/javascript">set_error("应用不存在或已被删除！");</script>');
$row['in_uid'] == $userid or exit('<script type="text/javascript">set_error("您不能更新别人的应用！");</script>');
$dst = '../../../data/attachment/'.$row['in_icon'];
$object = $row['in_icon'];
$bucketMgr->delete(IN_REMOTEBK,$object);
$uploadMgr->putFile($token,$object,$dst);
@unlink($dst);
$GLOBALS['db']->query("update ".tname('app')." set in_icon='".IN_REMOTEDK.$object."' where in_id=".$id);
echo '<script type="text/javascript">set_reload();</script>';
}elseif($_GET['ac'] == 'app'){
$time = file_get_contents('../../../data/tmp/'.$_GET['time'].'.log');
$uid = intval($_GET['uid']);
$upw = SafeSql($_GET['upw']);
$userid = $GLOBALS['db']->getone("select in_userid from ".tname('user')." where in_userid=$uid and in_userpassword='$upw'");
$row = $GLOBALS['db']->getrow("select * from ".tname('app')." where in_icon='$time'");
$row or exit('<script type="text/javascript">set_error("应用不存在或已被删除！");</script>');
$row['in_uid'] == $userid or exit('<script type="text/javascript">set_error("您不能更新别人的应用！");</script>');
$dst = '../../../data/attachment/'.$row['in_icon'];
$object = $row['in_icon'];
$uploadMgr->putFile($token,$object,$dst);
@unlink($dst);
$GLOBALS['db']->query("update ".tname('app')." set in_icon='".IN_REMOTEDK.$object."' where in_id=".$row['in_id']);
$dst = '../../../data/attachment/'.$row['in_app'];
$object = $row['in_app'];
$uploadMgr->putFile($token,$object,$dst);
@unlink($dst);
$GLOBALS['db']->query("update ".tname('app')." set in_app='".IN_REMOTEDK.$object."' where in_id=".$row['in_id']);
echo '<script type="text/javascript">set_reload();</script>';
}
;echo '</body>
</html>';?>