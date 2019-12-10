<?php
include '../../system/db.class.php';
$title = SafeRequest("out_trade_no", "post");
if ($row = $GLOBALS['db']->getrow("select * from " . tname('paylog') . " where in_title='{$title}'")) {
    if ($row['in_lock'] > 0) {
        $GLOBALS['db']->query("update " . tname('paylog') . " set in_lock=0 where in_title='{$title}'");
        $GLOBALS['db']->query("update " . tname('user') . " set in_points=in_points+" . $row['in_points'] . " where in_userid=" . $row['in_uid']);
    }
}
?>