<?php

include 'source/system/db.class.php';
include 'source/admincp/include/function.php';
$frames = array('login','index','body','config','config_pay','config_credit','config_upload','config_extend','app','kong','allsign','key','make','cert','sign','secret','user','backup','sql','clean','update','admin','paylog','buylog','signlog','talk','ajax','module','develop');
$iframe = !empty($_GET['iframe']) &&in_array($_GET['iframe'],$frames) ?$_GET['iframe'] : 'login';
include_once $iframe == 'talk'?'source/pack/chat/talk.php': 'source/admincp/module/'.$iframe.'.php';
?>