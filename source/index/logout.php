<?php
if (!defined('IN_ROOT')) {
    exit('Access denied');
}
setcookie('in_userid', '', time() - 1, IN_PATH);
setcookie('in_username', '', time() - 1, IN_PATH);
setcookie('in_userpassword', '', time() - 1, IN_PATH);
header('location:' . IN_PATH . 'index.php/login');
?>