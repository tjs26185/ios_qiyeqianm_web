<?php
/**
 * 这是测试充值后显示用户当前金额.
 * 用于显示用户充值是否成功。
 * Date: 2017/2/14
 * Time: 21:11
 *
 */

require_once("codepay_config.php"); //导入配置文件
require_once("includes/MysqliDb.class.php");//导入mysqli连接
require_once("includes/M.class.php");//导入mysqli操作类
if (!defined('DEBUG') || !DEBUG || !defined('DB_PREFIX') || !defined('DB_USERTABLE')) {
    exit('该页面已经关闭 如需打开请修改配置文件');
}

/**
 * 注意：下面是为了直观演示充值后金额的变化。 在调试模式下没验证权限显示了用户金额。
 * 正确做法：上线运行后应关闭调试模式或验证登录状态 或直接删除查询金额相关代码。不要应用到实际业务中。
 *
 */
echo('<script>alert("该页面仅为直观演示充值后金额 您必须修改或删除该页面")</script>');

$m = new M();
$pay_id = 'admin'; //如果session中没有默认显示的是测试数据中的第一个用户金额。
$rs = $m->runSql("select * from " . DB_USERTABLE . " where user='{$pay_id}'"); //执行SQL
if (!$rs || $rs->num_rows < 1) {
    echo(sprintf("数据库中没找到ID为：%u 的为用户.", $pay_id));
} else {
    $userData = $rs->fetch_assoc();
    echo sprintf("以下为测试数据 如果金额增加则表示充值业务成功执行</br>  <h3>用户名：{$userData["user"]} 当前金额：{$userData["money"]} vip字段：{$userData["vip"]}</h3>");
}
?>

