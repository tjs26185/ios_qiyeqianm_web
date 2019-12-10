<?php

include '../system/db.class.php';
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: text/html;charset=".IN_CHARSET);
header("Access-Control-Allow-Origin: ".$_SERVER['HTTP_ORIGIN']);
header("Access-Control-Allow-Credentials: true");
$secret = SafeRequest("secret","get");
$secret and $secret == IN_SECRET or exit('Access denied');
$ssl = is_ssl() ?'https://': 'http://';
$api = $ssl.$_SERVER['HTTP_HOST'].IN_PATH;
$query = $GLOBALS['db']->query("select * from ".tname('sign')." where in_status=1 and in_time>0 order by in_time desc");
while($row = $GLOBALS['db']->fetch_array($query)){
updatetable('sign',array('in_time'=>0),array('in_id'=>$row['in_id']));
$pw = getfield('secret','in_md5','in_site',str_replace('www.','',$row['in_site']));
$src = 'download.php?id='.$row['in_aid'].'&uid='.$row['in_uid'].'&suo='.$row['in_suo'].'&name='.$row['in_aname'].'&newname='.$row['in_newaname'].'&ssl='.$row['in_ssl'].'&zhuru='.$row['in_qianci'].'&site='.$row['in_site'].'&path='.$row['in_path'].'&ipa='.pack('H*',$row['in_ipa']).'&yololib='.$row['in_yololib'].'&cert='.$row['in_cert'].'&replace='.$row['in_replace'].'&pw='.$pw.'&api='.$api;
echo '<tr><td><iframe width="100%" height="50" allowtransparency="true" scrolling="no" border="0" frameborder="0" src="'.$src.'"></iframe></td></tr>';
}
?>