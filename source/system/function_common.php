<?php
function getlink($id)
{
    $path = 'http://' . $_SERVER['HTTP_HOST'] . IN_PATH;
    $link = getfield('app', 'in_link', 'in_id', $id);
    $url = IN_REWRITE && $link ? $path . $link : $path . 'app.php/' . $id;
	return is_ssl() ? str_replace('http://', 'https://', $url) : $url;
}
function geticon($file)
{
    if (!stristr($file, '/')) {
        $file = 'http://' . $_SERVER['HTTP_HOST'] . IN_PATH . 'data/attachment/' . $file;
    }
    return is_ssl() ? str_replace('http://', 'https://', $file . '?v=' . time()) : $file . '?v=' . time();
}
function getapp($file, $type = 0)
{
    if ($type) {
        if (!stristr($file, '/')) {
            $file = 'http://' . $_SERVER['HTTP_HOST'] . IN_PATH . 'data/attachment/' . $file;
        }
        return is_ssl() ? str_replace('http://', 'https://', $file) : $file;
    } else {
        return stristr($file, '/') ? true : false;
    }
}
function getverify($uid, $card, $type = 0)
{
    if ($type) {
        $verify = 'http://' . $_SERVER['HTTP_HOST'] . IN_PATH . 'data/attachment/avatar/' . $uid . '-' . $card . '.jpg?v=' . time();
        return is_ssl() ? str_replace('http://', 'https://', $verify) : $verify;
    } else {
        return is_file(IN_ROOT . './data/attachment/avatar/' . $uid . '-' . $card . '.jpg') ? true : false;
    }
}
function getavatars($uid)
{
    if (is_file(IN_ROOT . './data/attachment/avatar/' . $uid . '.jpg')) {
        $avatar = 'http://' . $_SERVER['HTTP_HOST'] . IN_PATH . 'data/attachment/avatar/' . $uid . '.jpg?v=' . time();
    } else {
        $avatar = 'http://' . $_SERVER['HTTP_HOST'] . IN_PATH . 'static/app/avatar.jpg';
    }
    return is_ssl() ? str_replace('http://', 'https://', $avatar) : $avatar;
}
function getavatar($id)
{
  $mail = $GLOBALS['db']->getone("select in_username from " . tname('user') . " where in_userid=" . $id);
  $ar = explode('@', $mail);
  $QQ = $ar[0];
  $QQ = str_replace('admin','785863853',$QQ);
  return 'http://q2.qlogo.cn/headimg_dl?dst_uin='.$QQ.'&spec=100'; 
}

/*function formatsize($b)
{   
    if ($b < 1024){return $b.' B';}
    $k = $b/1024;
    if ($k < 1024){return $k.' KB';}
    $m = $k/1024;
    if ($m < 1024){return $m.' MB';}
    $g = $m/1024;
    if ($g < 1024){return $g.' GB';}
    $t = $g/1024;
    if ($t < 1024){return $t.' TB';}
}*/
function formatsize($size)
{
    $prec = 3;
    $size = round(abs($size));
    $units = array(0 => " B", 1 => " KB", 2 => " MB", 3 => " GB", 4 => " TB");
    if ($size == 0) {
        return str_repeat(" ", $prec) . "0" . $units[0];
    }
    $unit = min(4, floor(log($size) / log(2) / 10));
    $size = $size * pow(2, -10 * $unit);
    $digi = $prec - 1 - floor(log($size) / log(10));
    $size = round($size * pow(10, $digi)) * pow(10, -$digi);
    return $size . $units[$unit];
}
function fortosize($size)
{
  $arry = explode(' ', trim($size));
  $dw = trim($arry[1]);
  $sc = trim($arry[0]);
  if($dw == 'B'){return $sc;}
  if($dw == 'KB'){return $sc * 1024;}
  if($dw == 'MB'){return $sc * 1024 * 1024;}
  if($dw == 'GB'){return $sc * 1024 * 1024 * 1024;}
  if($dw == 'TB'){return $sc * 1024 * 1024 * 1024 * 1024;}
  return $size;
}
function fileext($file)
{
    return strtolower(trim(substr(strrchr($file, '.'), 1)));
}
function tname($name)
{
    return IN_DBTABLE . $name;
}
function convert_charset($str, $type = 0)
{
    if ($type == 1) {
        return IN_CHARSET == 'gbk' ? iconv('UTF-8', 'GBK//IGNORE', $str) : $str;
    } else {
        return IN_CHARSET == 'gbk' ? iconv('GBK', 'UTF-8//IGNORE', $str) : $str;
    }
}
function set_chars()
{
    return IN_CHARSET == 'gbk' ? 'GB2312' : 'UTF-8';
}
function SafeSql($value)
{
    return htmlspecialchars(str_replace('\\', '', $value), ENT_QUOTES, set_chars(), false);
}
function detect_encoding($str)
{
    $chars = NULL;
    $list = array('GBK', 'UTF-8');
    foreach ($list as $item) {
        $tmp = mb_convert_encoding($str, $item, $item);
        if (md5($tmp) == md5($str)) {
            $chars = $item;
        }
    }
    return strtolower($chars) !== IN_CHARSET ? iconv($chars, strtoupper(IN_CHARSET) . '//IGNORE', $str) : $str;
}
function is_utf8($string)
{
    if (IN_CHARSET == 'utf-8') {
        return detect_encoding($string);
    } else {
        if (preg_match('%^(?:[\\x09\\x0A\\x0D\\x20-\\x7E] | [\\xC2-\\xDF][\\x80-\\xBF] | \\xE0[\\xA0-\\xBF][\\x80-\\xBF] | [\\xE1-\\xEC\\xEE\\xEF][\\x80-\\xBF]{2} | \\xED[\\x80-\\x9F][\\x80-\\xBF] | \\xF0[\\x90-\\xBF][\\x80-\\xBF]{2} | [\\xF1-\\xF3][\\x80-\\xBF]{3} | \\xF4[\\x80-\\x8F][\\x80-\\xBF]{2})*$%xs', $string)) {
            return iconv('UTF-8', 'GBK//IGNORE', $string);
        } else {
            return $string;
        }
    }
}
function unescape($str)
{
    $code = PHP_OS == 'Linux' ? 'UCS-2BE' : 'UCS-2';
    $str = rawurldecode($str);
    preg_match_all("/%u.{4}|&#x.{4};|&#d+;|.+/U", $str, $r);
    $ar = $r[0];
    foreach ($ar as $k => $v) {
        if (substr($v, 0, 2) == '%u') {
            $ar[$k] = iconv($code, strtoupper(IN_CHARSET) . '//IGNORE', pack('H4', substr($v, -4)));
        } elseif (substr($v, 0, 3) == '&#x') {
            $ar[$k] = iconv($code, strtoupper(IN_CHARSET) . '//IGNORE', pack('H4', substr($v, 3, -1)));
        } elseif (substr($v, 0, 2) == '&#') {
            $ar[$k] = iconv($code, strtoupper(IN_CHARSET) . '//IGNORE', pack('H4', substr($v, 2, -1)));
        }
    }
    return SafeSql(join('', $ar));
}
function SafeRequests($key, $mode, $type = 0)
{
    $magic = get_magic_quotes_gpc();
    switch ($mode) {
        case 'post':
            $value = isset($_POST[$key]) ? $magic ? trim($_POST[$key]) : addslashes(trim($_POST[$key])) : NULL;
            break;
        case 'get':
            $value = isset($_GET[$key]) ? $magic ? trim($_GET[$key]) : addslashes(trim($_GET[$key])) : NULL;
            break;
    }
    return $type ? $value : htmlspecialchars(str_replace('\\' . '\\', '', $value), ENT_QUOTES, set_chars(), false);
}
function SafeRequest($key, $mode){
	if($mode == 'post'){
			return $_POST[$key];
    }else{
			return $_GET[$key];
	}
}
function RequestBox($key)
{
    $array = isset($_POST[$key]) ? $_POST[$key] : NULL;
    if (empty($array)) {
        $value = 0;
    } else {
        for ($i = 0; $i < count($array); $i++) {
            $arr[] = intval($array[$i]);
        }
        $value = implode(',', $arr);
    }
    return $value;
}
function creatdir($dir)
{
    if (!is_dir($dir)) {
        @mkdir($dir, 0777, true);
    }
}
function destroyDir($dir)
{
    $ds = DIRECTORY_SEPARATOR;
    $dir = substr($dir, -1) == $ds ? substr($dir, 0, -1) : $dir;
    if (is_dir($dir) && ($handle = opendir($dir))) {
        while ($file = readdir($handle)) {
            if ($file == '.' || $file == '..') {
                continue;
            } elseif (is_dir($dir . $ds . $file)) {
                destroyDir($dir . $ds . $file);
            } else {
                unlink($dir . $ds . $file);
            }
        }
        closedir($handle);
        rmdir($dir);
    }
}
function getpagerow($sqlstr, $pagesok)
{
    global $db;
    $url = $_SERVER['QUERY_STRING'];
    if (stristr($url, '&pages')) {
        $url = preg_replace('/&pages=([\\S]+?)$/', '', $url);
    }
    $page = intval(SafeRequest("pages", "get"));
    $pages = $page <= 0 ? 1 : $page;
    $nums = $db->num_rows($db->query(preg_replace('/^select \\* from/i', 'select count(*) from', $sqlstr, 1)));
    $num = $nums == 0 ? 1 : $nums;
    $pagejs = ceil($num / $pagesok);
    if ($pages > $pagejs) {
        $pages = $pagejs;
    }
    $result = $db->query($sqlstr . " LIMIT " . $pagesok * ($pages - 1) . "," . $pagesok);
    $str = "<tr><td colspan=\"15\"><div class=\"cuspages right\"><div class=\"pg\"><em>&nbsp;" . $nums . "&nbsp;</em>";
    $str .= "<a href=\"?" . $url . "&pages=1\" class=\"prev\">首页</a>";
    if ($pages > 1) {
        $str .= "<a href=\"?" . $url . "&pages=" . ($pages - 1) . "\" class=\"prev\">&lsaquo;&lsaquo;</a>";
    }
    if ($pagejs <= 10) {
        for ($i = 1; $i <= $pagejs; $i++) {
            if ($i == $pages) {
                $str .= "<strong>" . $i . "</strong>";
            } else {
                $str .= "<a href=\"?" . $url . "&pages=" . $i . "\">" . $i . "</a>";
            }
        }
    } else {
        if ($pages >= 12) {
            for ($i = $pages - 5; $i <= $pages + 6; $i++) {
                if ($i <= $pagejs) {
                    if ($i == $pages) {
                        $str .= "<strong>" . $i . "</strong>";
                    } else {
                        $str .= "<a href=\"?" . $url . "&pages=" . $i . "\">" . $i . "</a>";
                    }
                }
            }
            if ($i <= $pagejs) {
                $str .= "...";
                $str .= "<a href=\"?" . $url . "&pages=" . $pagejs . "\">" . $pagejs . "</a>";
            }
        } else {
            for ($i = 1; $i <= 12; $i++) {
                if ($i == $pages) {
                    $str .= "<strong>" . $i . "</strong>";
                } else {
                    $str .= "<a href=\"?" . $url . "&pages=" . $i . "\">" . $i . "</a>";
                }
            }
            if ($i <= $pagejs) {
                $str .= "...";
                $str .= "<a href=\"?" . $url . "&pages=" . $pagejs . "\">" . $pagejs . "</a>";
            }
        }
    }
    if ($pages < $pagejs) {
        $str .= "<a href=\"?" . $url . "&pages=" . ($pages + 1) . "\" class=\"nxt\">&rsaquo;&rsaquo;</a>";
    }
    $str .= "<a href=\"?" . $url . "&pages=" . $pagejs . "\" class=\"nxt\">尾页</a>";
    $str .= "<em>&nbsp;" . $pages . "/" . $pagejs . "&nbsp;</em></div></div></td></tr>";
    $arr = array($str, $result, $nums);
    return $arr;
}
class iFile
{
    protected $Fp;
    protected $File;
    protected $OpenMode;
    function __construct($File, $Mode)
    {
        $this->File = $File;
        $this->OpenMode = $Mode;
        $this->OpenFile();
    }
    private function OpenFile()
    {
        $this->Fp = fopen($this->File, $this->OpenMode);
    }
    private function CloseFile()
    {
        fclose($this->Fp);
    }
    public function WriteFile($Data4Write, $Mode)
    {
        flock($this->Fp, $Mode);
        fwrite($this->Fp, $Data4Write);
        $this->CloseFile();
    }
}
function image_crop($width, $height, $src, $path)
{
    list($s_width, $s_height, $s_type) = getimagesize($src);
    switch ($s_type) {
        case IMAGETYPE_GIF:
            $simage = imagecreatefromgif($src);
            break;
        case IMAGETYPE_JPEG:
            $simage = imagecreatefromjpeg($src);
            break;
        default:
            $simage = imagecreatefrompng($src);
            break;
    }
    $pimage = imagecreatetruecolor($width, $height);
    $bg = imagecolorallocatealpha($pimage, 255, 255, 255, 0);
    imagefill($pimage, 0, 0, $bg);
    imagecolortransparent($pimage, $bg);
    $ratio_w = 1.0 * $width / $s_width;
    $ratio_h = 1.0 * $height / $s_height;
    $ratio = $ratio_w < $ratio_h ? $ratio_h : $ratio_w;
    $tmp_w = (int) ($width / $ratio);
    $tmp_h = (int) ($height / $ratio);
    $tmp_img = imagecreatetruecolor($tmp_w, $tmp_h);
    $color = imagecolorallocate($tmp_img, 255, 255, 255);
    imagecolortransparent($tmp_img, $color);
    imagefill($tmp_img, 0, 0, $color);
    $s_x = (int) (($s_width - $tmp_w) / 2);
    $s_y = (int) (($s_height - $tmp_h) / 2);
    imagecopy($tmp_img, $simage, 0, 0, $s_x, $s_y, $tmp_w, $tmp_h);
    imagecopyresampled($pimage, $tmp_img, 0, 0, 0, 0, $width, $height, $tmp_w, $tmp_h);
    imagedestroy($tmp_img);
    imagesavealpha($pimage, true);
    imagepng($pimage, $path);
    imagedestroy($simage);
    imagedestroy($pimage);
}
function checkmobile()
{
    $touchbrowser = array('iphone', 'ipad', 'ipod', 'android', 'phone', 'mobile', 'wap', 'netfront', 'java', 'opera mobi', 'opera mini', 'ucweb', 'windows ce', 'symbian', 'series', 'webos', 'sony', 'blackberry', 'dopod', 'nokia', 'samsung', 'palmsource', 'xda', 'pieplus', 'meizu', 'midp', 'cldc', 'motorola', 'foma', 'docomo', 'up.browser', 'up.link', 'blazer', 'helio', 'hosin', 'huawei', 'novarra', 'coolpad', 'webos', 'techfaith', 'palmsource', 'alcatel', 'amoi', 'ktouch', 'nexian', 'ericsson', 'philips', 'sagem', 'wellcom', 'bunjalloo', 'maui', 'smartphone', 'iemobile', 'spice', 'bird', 'zte-', 'longcos', 'pantech', 'gionee', 'portalmmm', 'jig browser', 'hiptop', 'benq', 'haier', '^lct', '320x320', '240x320', '176x220', 'windows phone');
    $wmlbrowser = array('cect', 'compal', 'ctl', 'lg', 'nec', 'tcl', 'alcatel', 'ericsson', 'bird', 'daxian', 'dbtel', 'eastcom', 'pantech', 'dopod', 'philips', 'haier', 'konka', 'kejian', 'lenovo', 'benq', 'mot', 'soutec', 'nokia', 'sagem', 'sgh', 'sed', 'capitel', 'panasonic', 'sonyericsson', 'sharp', 'amoi', 'panda', 'zte');
    $client = array('micromessenger','QQ');
    if (dstrpos($_SERVER['HTTP_USER_AGENT'], $touchbrowser)) {
        return true;
    } elseif (dstrpos($_SERVER['HTTP_USER_AGENT'], $wmlbrowser)) {
        return true;
    } elseif (dstrpos($_SERVER['HTTP_USER_AGENT'], $client)) {
        return true;
    } else {
        return false;
    }
}
function dstrpos($string, $arr)
{
    if (!empty($string)) {
        foreach ((array) $arr as $v) {
            if (strpos(strtolower($string), $v) !== false) {
                return true;
            }
        }
    }
    return false;
}
function html_message($title, $msg, $code = '')
{
    return "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=" . IN_CHARSET . "\" /><title>站点提示</title></head><body bgcolor=\"#FFFFFF\"><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"850\" align=\"center\" height=\"85%\"><tr align=\"center\" valign=\"middle\"><td><table cellpadding=\"20\" cellspacing=\"0\" border=\"0\" width=\"80%\" align=\"center\" style=\"font-family: Verdana, Tahoma; color: #666666; font-size: 12px\"><tr><td valign=\"middle\" align=\"center\" bgcolor=\"#EBEBEB\"><b style=\"font-size: 16px\">" . $title . "</b><br /><br /><p style=\"text-align:left;\">" . $msg . "</p><br /><br /></td></tr></table></td></tr></table>" . $code . "</body></html>";
}
function iframe_message($msg)
{
    return "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=" . IN_CHARSET . "\" /><table style=\"border:1px solid #09C\" align=\"center\"><tr><td><div style=\"text-align:center;color:#09C\">" . $msg . "</div></td></tr></table>";
}
function close_browse($msg = 'Access denied')
{
    if (empty($_SERVER['HTTP_REFERER'])) {
        exit($msg);
    } elseif (!preg_match("/^(https?:\\/\\/" . $_SERVER['HTTP_HOST'] . ")/i", $_SERVER['HTTP_REFERER'])) {
        exit($msg);
    }
}
function core_entry($read)
{
    if (is_file($read)) {
        include_once $read;
    } else {
        header('location:' . IN_PATH);
    }
}
function ergodic_array($str, $key)
{
    if (!empty($str)) {
        $array = explode(',', $str);
        for ($i = 0; $i < count($array); $i++) {
            if ($array[$i] == $key) {
                return true;
            }
        }
    }
    return false;
}
function is_ssl()
{
    if ($_SERVER['SERVER_PORT'] == 443) {
        return true;
    } else {
        return false;
    }
}
function http(){
	if($_SERVER['SERVER_PORT'] == 443){
		return 'https://';
	}else{
		return 'http://';
	}
}
function submitcheck($var, $token = 0)
{
    if ($token < 0) {
        return empty($_GET[$var]) || $_GET[$var] !== $_COOKIE['in_adminpassword'] ? false : true;
    } elseif (!empty($_POST[$var]) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($_SERVER['HTTP_REFERER']) || preg_replace("/https?:\\/\\/([^\\:\\/]+).*/i", "\\1", $_SERVER['HTTP_REFERER']) == preg_replace("/([^\\:]+).*/", "\\1", $_SERVER['HTTP_HOST'])) {
            return $token ? $_POST[$var] !== $_COOKIE['in_adminpassword'] ? false : true : true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
function getonlineip()
{
    if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
        $ip = $_SERVER['REMOTE_ADDR'];
    } elseif (getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
        $ip = getenv('HTTP_CLIENT_IP');
    } elseif (getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
        $ip = getenv('HTTP_X_FORWARDED_FOR');
    } elseif (getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
        $ip = getenv('REMOTE_ADDR');
    }
    preg_match("/[\\d\\.]{7,15}/", isset($ip) ? $ip : NULL, $match);
    return isset($match[0]) ? $match[0] : 'unknown';
}
function auth_codes($str, $mode = 'en', $key = '')
{
    if (empty($key)) {
        return $mode == 'de' ? base64_decode($str) : base64_encode($str);
    } else {
        return $mode == 'de' ? base64_decode(str_replace(md5($key), '', $str)) : md5($key) . base64_encode($str);
    }
}
function convert_utf8($str, $charset)
{
    if ($charset !== IN_CHARSET) {
        return IN_CHARSET == 'gbk' ? iconv('UTF-8', 'GBK//IGNORE', auth_codes(preg_replace('/\\s/', '+', $str), 'de')) : iconv('GBK', 'UTF-8//IGNORE', auth_codes($str, 'de'));
    } else {
        return $charset == 'gbk' ? auth_codes($str, 'de') : auth_codes(preg_replace('/\\s/', '+', $str), 'de');
    }
}
function getfield($table, $target, $object, $search, $null = 0)
{
    global $db;
    $sql = "select " . $target . " from " . tname($table) . " where " . $object . "='" . $search . "'";
    if ($one = $db->getone($sql)) {
        $field = $one;
    } else {
        $field = $null;
    }
    return $field;
}
function inserttable($tablename, $insertsqlarr, $returnid = 0, $replace = false, $silent = 0)
{
    global $db;
    $insertkeysql = $insertvaluesql = $comma = '';
    foreach ($insertsqlarr as $insert_key => $insert_value) {
        $insertkeysql .= $comma . '`' . $insert_key . '`';
        $insertvaluesql .= $comma . '\'' . $insert_value . '\'';
        $comma = ', ';
    }
    $method = $replace ? 'REPLACE' : 'INSERT';
    $db->query($method . ' INTO ' . tname($tablename) . ' (' . $insertkeysql . ') VALUES (' . $insertvaluesql . ')', $silent ? 'SILENT' : '');
    if ($returnid && !$replace) {
        return $db->insert_id();
    }
}
function updatetable($tablename, $setsqlarr, $wheresqlarr, $silent = 0)
{
    global $db;
    $setsql = $comma = '';
    foreach ($setsqlarr as $set_key => $set_value) {
        $setsql .= $comma . '`' . $set_key . '`' . '=\'' . $set_value . '\'';
        $comma = ', ';
    }
    $where = $comma = '';
    if (empty($wheresqlarr)) {
        $where = '1';
    } elseif (is_array($wheresqlarr)) {
        foreach ($wheresqlarr as $key => $value) {
            $where .= $comma . '`' . $key . '`' . '=\'' . $value . '\'';
            $comma = ' AND ';
        }
    } else {
        $where = $wheresqlarr;
    }
    $db->query('UPDATE ' . tname($tablename) . ' SET ' . $setsql . ' WHERE ' . $where, $silent ? 'SILENT' : '');
}
function deldirs($dir){
   $dh = opendir($dir);
   while ($file = readdir($dh)){
      if ($file != "." && $file != ".."){
         $fullpath = $dir . "/" . $file;
         if (!is_dir($fullpath)){
            unlink($fullpath);
         } else {
            deldirs($fullpath);
         }
      }
   }
   closedir($dh);
   if (rmdir($dir)){
      return true;
   } else {
      return false;
   }
}