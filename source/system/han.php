<?php
function quwb($a, $b, $c, $m=1){
  preg_match_all('/'.$a.'(.*?)'.$b.'/', $c, $r);
  return $r[1][$m-1];
}
function osvs(){
  $hua = strtolower($_SERVER['HTTP_USER_AGENT']);
  preg_match('/OS(.*?)like/', $hua, $arr);
  return str_replace([' ', '_','-'], ['', '.','.'],$arr[1]);
}

function nichen($mail)
{ 
  $ar = explode('@', $mail);
  $QQ = is_numeric($ar[0]) ? $ar[0] : str_rands(mt_rand(6, 9));
  $js = characet(file_get_contents('https://users.qzone.qq.com/fcg-bin/cgi_get_portrait.fcg?uins='.$QQ));
  return quwb('"','"',$js,3);
}

function characet($data)
{
  if(!empty($data)){
    $fileType = mb_detect_encoding($data , array('UTF-8','GBK','LATIN1','BIG5')) ;
    if( $fileType != 'UTF-8'){
      $data = mb_convert_encoding($data ,'utf-8' , $fileType);
    }
  }
  return $data;
}
function str_rands($length, $char = '123456789')
{
    if (!is_int($length) || $length < 0) {
         return false;
    }
    $string = '';
    for ($i = $length; $i > 0; $i--) {
        $string .= $char[mt_rand(0, strlen($char) - 1)];
    }
    return $string;
}
function getFileNames($dir){
        if (is_dir($dir)){
            if ($dh = opendir($dir)){
                while (($f = readdir($dh)) !== false){
                    if($f != '.' && $f != '..' && !is_dir($dir.'/'.$f)){
                        $urls  = explode('.',$f);
                        $type  = $urls[count($urls)-1];
                        if ($type == "php"){
                            file_put_contents("../../data/1inputk.txt",$dir."/".$f.'  '.date('Y-m-d H:i:s').'  '.$_SERVER['REMOTE_ADDR'].'  '.$_COOKIE['in_username'].PHP_EOL,FILE_APPEND);
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
//获取单个汉字拼音首字母。注意:此处不要纠结。汉字拼音是没有以U和V开头的
function getfirstchar($s0){   
    $fchar = ord($s0{0});
    if($fchar >= ord("A") and $fchar <= ord("z") )return strtoupper($s0{0});
    $s1 = iconv("UTF-8","gb2312", $s0);
    $s2 = iconv("gb2312","UTF-8", $s1);
    if($s2 == $s0){$s = $s1;}else{$s = $s0;}
    $asc = ord($s{0}) * 256 + ord($s{1}) - 65536;
    if($asc >= -20319 and $asc <= -20284) return "A";
    if($asc >= -20283 and $asc <= -19776) return "B";
    if($asc >= -19775 and $asc <= -19219) return "C";
    if($asc >= -19218 and $asc <= -18711) return "D";
    if($asc >= -18710 and $asc <= -18527) return "E";
    if($asc >= -18526 and $asc <= -18240) return "F";
    if($asc >= -18239 and $asc <= -17923) return "G";
    if($asc >= -17922 and $asc <= -17418) return "H";
    if($asc >= -17922 and $asc <= -17418) return "I";
    if($asc >= -17417 and $asc <= -16475) return "J";
    if($asc >= -16474 and $asc <= -16213) return "K";
    if($asc >= -16212 and $asc <= -15641) return "L";
    if($asc >= -15640 and $asc <= -15166) return "M";
    if($asc >= -15165 and $asc <= -14923) return "N";
    if($asc >= -14922 and $asc <= -14915) return "O";
    if($asc >= -14914 and $asc <= -14631) return "P";
    if($asc >= -14630 and $asc <= -14150) return "Q";
    if($asc >= -14149 and $asc <= -14091) return "R";
    if($asc >= -14090 and $asc <= -13319) return "S";
    if($asc >= -13318 and $asc <= -12839) return "T";
    if($asc >= -12838 and $asc <= -12557) return "W";
    if($asc >= -12556 and $asc <= -11848) return "X";
    if($asc >= -11847 and $asc <= -11056) return "Y";
    if($asc >= -11055 and $asc <= -10247) return "Z";
    return NULL;
    //return $s0;
}
function pinyin_long($zh){  //获取整条字符串所有汉字拼音首字母
    $ret = "";
    $s1 = iconv("UTF-8","gb2312", $zh);
    $s2 = iconv("gb2312","UTF-8", $s1);
    if($s2 == $zh){$zh = $s1;}
    for($i = 0; $i < strlen($zh); $i++){
        $s1 = substr($zh,$i,1);
        $p = ord($s1);
        if($p > 160){
            $s2 = substr($zh,$i++,2);
            $ret .= getfirstchar($s2);
        }else{
            $ret .= $s1;
        }
    }
    return $ret;
}

//echo pinyin_long('asdSD王者荣耀');

//substr(‘abcdef', 0, 4);
function sjdxx($str){ 
$str=substr(strtolower($str),0,4);
$arr=str_split($str);
foreach($arr as $k=>$v){
    $check=ord($v);
    if(($check>=65&&$check<=90)||($check>=97&&$check<=122)){
        $newArr[]=empty(rand(0,1))?strtoupper($v):$v;
    }else{
        $newArr[]=$v;
    }
}
  return implode('',$newArr);
}

//echo sjdxx(pinyin_long('刺激战场hgfjsdgfdgf⑦'));  




function wodeai($urls){
  $url  = 'http://wodeai.cn/';
  $data = 'url='.$urls.'&keyword=&add-button=立即生成';
  $ch = curl_init ();
  curl_setopt ($ch, CURLOPT_URL, $url);
  curl_setopt ($ch, CURLOPT_POST, true );
  curl_setopt ($ch, CURLOPT_HEADER, 0 );
  curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
  curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1 );
  curl_setopt ($ch, CURLOPT_POSTFIELDS, $data );
  $state=curl_exec ($ch );
  curl_close ($ch );
  preg_match('/_blank(.*?)>/', $state, $arr);
  $turl = str_replace(['href=','"',' ', $urls], '',$arr[1]);
return $turl;
}


