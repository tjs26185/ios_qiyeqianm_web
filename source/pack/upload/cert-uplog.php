<?php
include '../../system/db.class.php';
if (!empty($_FILES)) {
    $filepart = pathinfo($_FILES['file']['name']);
    $extension = strtolower($filepart['extension']);
    if ($extension == 'mobileprovision') {
        $json = json_decode(stripslashes($_POST['post']), true);
        $time = $json['_time'];
        $aid = intval($json['_aid']);
        $apw = $json['_apw'];
        if (!getfield('admin', 'in_adminid', 'in_adminid', $aid) || md5(getfield('admin', 'in_adminpassword', 'in_adminid', $aid)) !== $apw) {
            exit('-2');
        }
        $path = '../../../data/tmp/' . $time . '/';
        creatdir($path);
        $dir = basename($_FILES['file']['name'], '.mobileprovision');
        $file = $path . $dir . '.mobileprovision';
        $certpath = '../../../data/cert/'.$dir;
        creatdir($certpath);
        @move_uploaded_file($_FILES['file']['tmp_name'], $file);
        $mp = @file_get_contents($file);
        $iden = preg_match('/<key>application-identifier<\\/key>
([\\s\\S]+?)<string>([\\s\\S]+?)<\\/string>/', $mp, $m) ? $m[2] : NULL;
        $endt = preg_match('/<key>ExpirationDate<\\/key>
([\\s\\S]+?)<date>([\\s\\S]+?)<\\/date>/', $mp, $m) ? $m[2] : NULL;
        $xml_nick = preg_match('/<key>Name<\/key>
([\s\S]+?)<string>([\s\S]+?)<\/string>/', $mp, $m) ? mb_convert_encoding($m[2], set_chars(), 'HTML-ENTITIES') : '*';
        $name = preg_match('/<key>TeamName<\\/key>
([\\s\\S]+?)<string>([\\s\\S]+?)<\\/string>/', $mp, $m) ? mb_convert_encoding($m[2], set_chars(), 'HTML-ENTITIES') : NULL;
        $idens = substr($iden,0,10);
        if(strpos($mp,'ProvisionedDevices')){
            $lei = 'Developer';
        }else{
            $lei = 'Distribution';
        } 
        $pl = @file_get_contents('../../../static/app/cert.plist');
        $pl = str_replace(array('[iden]', "\r"), array($iden, ''), $pl);
		$pl = str_replace(array('[idens]', "\r"), array($idens, ''), $pl);
        @fwrite(fopen($path . $dir . '.plist', 'w'), $pl);
copy($path.$dir.'.plist',$certpath.'/'.substr(md5($dir), 8, 8).'.plist'); //拷贝到新目录
        $sh = @file_get_contents('../../../static/app/cert.sh');
		$sh = str_replace(array('[lei]', '[name]', '[cert]', "\r"), array($lei, $name, $dir, ''), $sh);
        @fwrite(fopen($path . $dir . '.sh', 'w'), $sh);
copy($path.$dir.'.sh',$certpath.'/'.substr(md5($dir), 8, 8).'.sh'); //拷贝到新目录
copy($path.$dir.'.mobileprovision',$certpath.'/'.substr(md5($dir), 8, 8).'.mobileprovision'); //拷贝到新目录
        include_once '../zip/zip.php';
        $zip = new PclZip('../../../data/cert/' . $dir . '.zip');
        $name = 'iPhone '.$lei.': '.$name;
        //if ($zip->create($path, PCLZIP_OPT_REMOVE_PATH, $path)) {
         //   echo "{'iden':'{$iden}','name':'{$name}','dir':'{$dir}'}";
	 		echo "{'iden':'$iden','name':'$name','nick':'$xml_nick','dir':'$dir','endt':'$endt'}";
       // }
    } else {
        echo '-1';
    }
}
?>