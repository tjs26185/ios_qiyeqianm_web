<?php

include 'source/system/db.class.php';
$plugin = explode('/',isset($_SERVER['PATH_INFO']) ?$_SERVER['PATH_INFO'] : NULL);
$dir = isset($plugin[1]) ?$plugin[1] : NULL;
$file = isset($plugin[2]) ?$plugin[2] : NULL;
core_entry('source/plugin/'.$dir.'/'.$file.'.php');
?>