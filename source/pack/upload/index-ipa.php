<?php
namespace PngFile;
require_once 'depng/pngCompote.php';
namespace CFPropertyList;

require_once 'deplist/CFPropertyList.php';
include '../../system/db.class.php';
include '../../system/user.php';
error_reporting(0);
//$GLOBALS['userlogined'] or exit('-1');
if(!$GLOBALS['userlogined']){ 
  @unlink('../../../data/tmp/' . $time . '.ipa');
  @deldirs('../../../data/tmp/' . $time);
  exit('-1');
}
$id = intval($_GET['id']);
$time = $_GET['time'];
preg_match('/^(\\d+\\-\\d+)$/', $time) or exit('-2');
$tmp = '../../../data/tmp/' . $time . '.ipa';
//is_file($tmp) or exit('-2');
if(!is_file($tmp)){ 
  @unlink($tmp);
  @deldirs('../../../data/tmp/' . $time);
  exit('-2');
}
//$xml_size = intval(filesize($tmp));
$xml_size = filesize($tmp);
$explode = explode('-', $time);
$icontime = md5($explode[0] . '-' . $explode[1] . '-' . rand(2, pow(2, 24))) . '.png';
$apptime = md5($explode[1] . '-' . $explode[0] . '-' . rand(2, pow(2, 24))) . '.ipa';
is_file('../../../data/attachment/' . $apptime) and exit('-2');
if(IN_VERIFY > 0 and $GLOBALS['erduo_in_verify'] != 1){ 
  @unlink($tmp);
  @deldirs('../../../data/tmp/' . $time);
  exit('-3');
}
$dir = '../../../data/tmp/' . $time . '/Payload';
if (is_dir($dir)) {
    $d = NULL;
    $h = opendir($dir);
    while ($f = readdir($h)) {
        if ($f != '.' && $f != '..' && is_dir($dir . '/' . $f)) {
            $d = $dir . '/' . $f;
        }
    }
    closedir($h);
    $info = file_get_contents($d . '/Info.plist');
    $plist = new CFPropertyList();
    $plist->parse($info);
    $plist = $plist->toArray();
    $xml_size + $GLOBALS['erduo_in_spaceuse'] > $GLOBALS['erduo_in_spacetotal'] and exit('-4');
    $xml_name = SafeSql(detect_encoding(isset($plist['CFBundleDisplayName']) ? $plist['CFBundleDisplayName'] : $plist['CFBundleName']));
    $xml_mnvs = SafeSql($plist['MinimumOSVersion']);
    $xml_bid = SafeSql($plist['CFBundleIdentifier']);
    $xml_bsvs = SafeSql($plist['CFBundleShortVersionString']);
    $yololib = SafeSql($plist['CFBundleExecutable']);
    $xml_bvs = SafeSql($plist['CFBundleVersion']);
    if ($id) {
        getfield('app', 'in_uid', 'in_id', $id) == $GLOBALS['erduo_in_userid'] or exit('-5');
        getfield('app', 'in_bid', 'in_id', $id) == $xml_bid and getfield('app', 'in_name', 'in_id', $id) == $xml_name or exit('-6');
    } else {
        $id = $GLOBALS['db']->getone("select in_id from " . tname('app') . " where in_bid='{$xml_bid}' and  in_form='iOS' and in_uid=" . $GLOBALS['erduo_in_userid']);//in_name='{$xml_name}' and
    }
    IN_REMOTE > 0 and fwrite(fopen('../../../data/tmp/' . $time . '.log', 'wb+'), $icontime);
    rename($tmp, '../../../data/attachment/' . $apptime);
    $newfile = '../../../data/attachment/' . $icontime;
    $icon = $plist['CFBundleIcons']['CFBundlePrimaryIcon']['CFBundleIconFiles'];
    if (!$icon) {
        $icon = $plist['CFBundleIconFiles'];
        if (!$icon) {
            $icon = $plist['CFBundleIconFiles~ipad'];
        }
    }
    if (preg_match('/\\./', $icon[0])) {
        $cvt = is_file($d . '/' . $icon[0]) ? 'trim' : 'strtolower';
        for ($i = 0; $i < count($icon); $i++) {
            if (is_file($d . '/' . $cvt($icon[$i]))) {
                $big[] = filesize($d . '/' . $cvt($icon[$i]));
                $small[] = filesize($d . '/' . $cvt($icon[$i]));
            }
        }
        rsort($big);
        sort($small);
        for ($p = 0; $p < count($icon); $p++) {
            if ($big[0] == filesize($d . '/' . $cvt($icon[$p]))) {
                $bigfile = $d . '/' . $cvt($icon[$p]);
            }
            if ($small[0] == filesize($d . '/' . $cvt($icon[$p]))) {
                $smallfile = $d . '/' . $cvt($icon[$p]);
            }
        }
    } else {
        $ext = is_file($d . '/' . $icon[0] . '.png') ? '.png' : '@2x.png';
        for ($i = 0; $i < count($icon); $i++) {
            if (is_file($d . '/' . $icon[$i] . $ext)) {
                $big[] = filesize($d . '/' . $icon[$i] . $ext);
                $small[] = filesize($d . '/' . $icon[$i] . $ext);
            }
        }
        rsort($big);
        sort($small);
        for ($p = 0; $p < count($icon); $p++) {
            if ($big[0] == filesize($d . '/' . $icon[$p] . $ext)) {
                $bigfile = is_file($d . '/' . $icon[$p] . '@3x.png') ? $d . '/' . $icon[$p] . '@3x.png' : $d . '/' . $icon[$p] . $ext;
            }
            if ($small[0] == filesize($d . '/' . $icon[$p] . $ext)) {
                $smallfile = preg_match('/AppIcon20x20/', $icon[$p]) ? $d . '/' . $icon[$p] . '@3x.png' : $d . '/' . $icon[$p] . $ext;
            }
        }
    }
    $png = new \PngFile\PngFile($smallfile);
    if (!$png->revertIphone($newfile)) {
        if (!rename($bigfile, $newfile)) {
            if ($plist['CFBundleIconFile']) {
                if (preg_match('/\\./', $plist['CFBundleIconFile'])) {
                    rename($d . '/' . $plist['CFBundleIconFile'], $newfile);
                } else {
                    rename($d . '/' . $plist['CFBundleIconFile'] . '.png', $newfile);
                }
            } else {
                copy('../../../static/app/iOS.png', $newfile);
            }
        }
    }
    $em = file_get_contents($d . '/embedded.mobileprovision');
    rename($d . '/embedded.mobileprovision', str_replace('.png', '.mobileprovision', $newfile));
    $xml_nick = preg_match('/<key>Name<\\/key>
([\\s\\S]+?)<string>([\\s\\S]+?)<\\/string>/', $em, $m) ? SafeSql(mb_convert_encoding($m[2], set_chars(), 'HTML-ENTITIES')) : '*';
    $xml_type = preg_match('/^iOS Team Provisioning Profile:/', $xml_nick) ? 0 : 1;
    $xml_team = preg_match('/<key>TeamName<\\/key>
([\\s\\S]+?)<string>([\\s\\S]+?)<\\/string>/', $em, $m) ? SafeSql(mb_convert_encoding($m[2], set_chars(), 'HTML-ENTITIES')) : '*';
  
    if($GLOBALS['erduo_in_userid'] == '1' || $GLOBALS['erduo_in_userid'] == '2'){
       //$in_sign = '2299999999';  $in_resign = '999999';
       //$yololib = '';
    }/*else{
       $in_sign = '1999999999';$in_resign = 1;//time()+ 60 * 60;  
       $in_resign = '3';
       if($xml_size > fortosize('200 MB')){
          $in_resign = 0;
       }
    }*/
    if($xml_name == 'unc0ver' ||	$xml_name == 'Chimera' || $xml_name == 'Electra'){
       $in_sign = '2299999999';  $in_resign = '999999';
       $yololib = '';
    }
    if ($id) {
        $old = $GLOBALS['db']->getrow("select * from " . tname('app') . " where in_id=" . $id);
        @unlink('../../../data/attachment/' . str_replace('.png', '.mobileprovision', substr($old['in_icon'], -36)));
        @unlink('../../../data/attachment/' . $old['in_icon']);
        @unlink('../../../data/attachment/' . $old['in_app']);
        updatetable('sign', array('in_qianci' => '0'), array('in_aid' => $id));
        $GLOBALS['db']->query("update " . tname('user') . " set in_spaceuse=in_spaceuse+{$xml_size}-" . $old['in_size'] . " where in_userid=" . $GLOBALS['erduo_in_userid']);
        $GLOBALS['db']->query("update " . tname('app') . " set in_name='{$xml_name}',in_type={$xml_type},in_size={$xml_size},in_form='iOS',in_mnvs='{$xml_mnvs}',in_bid='{$xml_bid}',in_bsvs='{$xml_bsvs}',in_bvs='{$xml_bvs}',in_nick='{$xml_nick}',in_team='{$xml_team}',in_icon='{$icontime}',in_app='{$apptime}',in_yololib='{$yololib}',shan=0,in_addtime='" . date('Y-m-d H:i:s') . "' where in_id=" . $id);
    } else {
        $GLOBALS['db']->query("update " . tname('user') . " set in_spaceuse=in_spaceuse+{$xml_size} where in_userid=" . $GLOBALS['erduo_in_userid']);
        $GLOBALS['db']->query("Insert " . tname('app') . " (in_name,in_uid,in_uname,in_type,in_size,in_form,in_mnvs,in_bid,in_bsvs,in_bvs,in_nick,in_team,in_icon,in_app,in_yololib,in_hits,in_kid,in_sign,in_resign,in_removead,in_highspeed,in_addtime) values ('{$xml_name}'," . $GLOBALS['erduo_in_userid'] . ",'" . $GLOBALS['erduo_in_username'] . "',{$xml_type},{$xml_size},'iOS','{$xml_mnvs}','{$xml_bid}','{$xml_bsvs}','{$xml_bvs}','{$xml_nick}','{$xml_team}','{$icontime}','{$apptime}','{$yololib}',0,0,'{$in_sign}','{$in_resign}',0,0,'" . date('Y-m-d H:i:s') . "')");
    }
    echo '1';
}
@deldirs('../../../data/tmp');
@creatdir('../../../data/tmp');
?>