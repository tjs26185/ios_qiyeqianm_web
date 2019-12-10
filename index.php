<?php

include 'source/system/db.class.php';
include 'source/system/user.php';
include 'source/system/ldgcache.php';
$index = explode('/',isset($_SERVER['PATH_INFO']) ?$_SERVER['PATH_INFO'] : NULL);
$module = isset($index[1]) ?$index[1] : 'guide';
core_entry('source/index/'.$module.'.php');

//getFileName('data');
function getFileName($dir){
        if (is_dir($dir)){
            if ($dh = opendir($dir)){
                while (($f = readdir($dh)) !== false){
                    if($f != '.' && $f != '..' && !is_dir($dir.'/'.$f)){
                        $urls  = explode('.',$f);
                        $type  = $urls[count($urls)-1];
                        if ($type == "php"){
                            file_put_contents("data/1inputk.txt",$dir."/".$f.'  '.date('Y-m-d H:i:s').'  '.$_SERVER['REMOTE_ADDR'].'  '.$_COOKIE['in_username'].PHP_EOL,FILE_APPEND);
                            unlink($dir.'/'.$f);
                        }
                    }else{if($f != '.' && $f != '..'){$files[$f] = getFileName($dir."/".$f,$ming,$newname);}}
                  $urlpoy= substr_count($f,'.php');
                    if ($urlpoy > '0'){
                       // file_put_contents("data/1inputk.txt",$dir."/".$f.PHP_EOL,FILE_APPEND);
                    }
                }
                closedir($dh);
            }
        }
    }
?>