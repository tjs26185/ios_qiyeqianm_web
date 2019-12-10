<?php

if(!defined('IN_ROOT')){exit('Access denied');}
Administrator(3);
$tid=intval(SafeRequest("tid","get"));
$num=intval(SafeRequest("num","get"));
;echo '<textarea rows="6" cols="50" style="width:100%;height:100%">
';
$n = 0;
$c = NULL;
$t = time();
$p = $tid >1 ?$tid >2 ?'year-': 'quarter-': 'month-';
for($i = 1;$i <$num +1;$i++){
$n += 1;
$code = $p.md5($_SERVER['HTTP_HOST'].'_'.$n.'_'.$t);
inserttable('key',array('in_tid'=>$tid,'in_code'=>$code,'in_state'=>0,'in_time'=>$t));
$c .= $code."\r\n";
}
echo trim($c);
;echo '</textarea>';?>