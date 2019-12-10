<?php
include '../../system/db.class.php';
$title = SafeRequest("out_trade_no", "post");
if ($row = $GLOBALS['db']->getrow("select * from " . tname('buylog') . " where in_title='{$title}'")) {
    if ($row['in_lock'] > 0) {
        $time = time();
        $buy = $row['in_tid'] > 1 ? $row['in_tid'] > 2 ? 'buy-year-' : 'buy-quarter-' : 'buy-month-';
        $code = $buy . md5($_SERVER['HTTP_HOST'] . $row['in_uid'] . '_' . $time);
        $GLOBALS['db']->query("update " . tname('buylog') . " set in_lock=0 where in_title='{$title}'");
        inserttable('key', array('in_tid' => $row['in_tid'], 'in_code' => $code, 'in_state' => 0, 'in_time' => $time));
        fwrite(fopen('../../../data/tmp/buy_key_' . $row['in_uid'] . '.txt', 'wb+'), $code);
    }
}
?>