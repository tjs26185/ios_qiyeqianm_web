<?php
if (!defined('IN_ROOT')) {
    exit('Access denied');
}
if (!IN_OPEN) {
    exit(html_message("维护通知", IN_OPENS));
}
//$time = file_get_contents(IN_ROOT . './data/install.lock');
//$time +86400 >time() or exit(html_message("Notice","Trial end"));
$GLOBALS['db']->query("update " . tname('app') . " set in_sign=0,in_resign=0 where in_sign>0 and in_sign<" . time());
$userid = isset($_COOKIE['in_userid']) ? intval($_COOKIE['in_userid']) : 0;
$username = isset($_COOKIE['in_username']) ? SafeSql($_COOKIE['in_username']) : NULL;
$userpassword = isset($_COOKIE['in_userpassword']) ? SafeSql($_COOKIE['in_userpassword']) : NULL;
$sql = "select * from " . tname('user') . " where in_islock=0 and in_userid={$userid} and in_username='{$username}' and in_userpassword='{$userpassword}'";
$result = $GLOBALS['db']->query($sql);
if ($row = $GLOBALS['db']->fetch_array($result)) {
    $userlogined = true;
    $Field = $GLOBALS['db']->query("SHOW FULL COLUMNS FROM " . tname('user'));
    while ($rows = $GLOBALS['db']->fetch_array($Field)) {
        $Variable = 'erduo_' . $rows['Field'];
        ${$Variable} = $row[$rows['Field']];
    }
} else {
    $userlogined = false;
}
?>