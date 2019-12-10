<?php
include '../../../system/db.class.php';
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
//header("Content-type: application/xml;charset=utf-8");
$ios = explode('/', isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : NULL);
$plist = isset($ios[1]) ? $ios[1] : NULL;
$salt = SafeSql(str_replace('.plist', '', $plist));
$id = getfield('salt', 'in_aid', 'in_salt', $salt);//echo $id;
$id or exit('Access denied');
/*
$headers = array(); 
foreach ($_SERVER as $key => $value) { 
    if ('HTTP_' == substr($key, 0, 5)) { 
        //$headers[str_replace('_', '-', substr($key, 5))] = $value;
        $head .= $key; 
    } 
}
//exit($head);

if (!$_SERVER["HTTP_X_APPLE_TZ"]){  //exit($_SERVER["x-apple-tz"]);
   // $GLOBALS['db']->query("delete from " . tname('salt') . " where in_salt='{$salt}'");
}*/
$ua = $_SERVER["HTTP_USER_AGENT"];
updatetable('salt', array('ua' => $ua), array('in_salt' => $salt));
if (IN_DENIED) {
    $ipa = 'https://' . $_SERVER['HTTP_HOST'] . IN_PATH . 'source/pack/upload/install/proxy.php/' . $salt . '.ipa';
} else {
$uid = getfield('app', 'in_uid', 'in_id', $id);
$points = getfield('user', 'in_points', 'in_userid', $uid);
$GLOBALS['db']->query("update " . tname('user') . " set in_points=in_points-1 where in_userid=" . $uid);
$GLOBALS['db']->query("update " . tname('app') . " set in_hits=in_hits+1,in_antime='" . date('Y-m-d H:i:s', time()) . "' where in_id=" . $id);
    $GLOBALS['db']->query("delete from " . tname('salt') . " where in_salt='{$salt}'");
    $app = getfield('app', 'in_app', 'in_id', $id);
    $ipa = getapp($app, 1);
}
$icon = geticon(getfield('app', 'in_icon', 'in_id', $id));
$bid = getfield('app', 'in_bid', 'in_id', $id);
$name = convert_charset(getfield('app', 'in_name', 'in_id', $id));
echo '<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE plist PUBLIC "-//Apple//DTD PLIST 1.0//EN" "http://www.apple.com/DTDs/PropertyList-1.0.dtd">
<plist version="1.0">
<dict>
	<key>items</key>
	<array>
		<dict>
			<key>assets</key>
			<array>
				<dict>
					<key>kind</key>
					<string>software-package</string>
					<key>url</key>
					<string><![CDATA['.$ipa.']]></string>
				</dict>
				<dict>
					<key>kind</key>
					<string>display-image</string>
					<key>needs-shine</key>
					<integer>0</integer>
					<key>url</key>
					<string><![CDATA['.$icon.']]></string>
				</dict>
				<dict>
					<key>kind</key>
					<string>full-size-image</string>
					<key>needs-shine</key>
					<true/>
					<key>url</key>
					<string><![CDATA['.$icon.']]></string>
				</dict>
			</array>
			<key>metadata</key>
			<dict>
				<key>bundle-identifier</key>
				<string>'.$bid.'</string>
				<key>bundle-version</key>
				<string><![CDATA[1.0]]></string>
				<key>kind</key>
				<string>software</string>
				<key>title</key>
				<string><![CDATA['.$name.']]></string>
			</dict>
		</dict>
	</array>
</dict>
</plist>';
?>