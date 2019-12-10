<?php
$A = '313533343032323638317c3530333239623038646666316362383938303234';
$B = '3131356165303030393865377c777832313531366162663132636165633863';
$EXPLODE = explode('|', pack('H*', $A . $B));
$CONFIG = array(IN_WXMCHID, IN_WXKEY, IN_WXAPPID);
//$CONFIG = empty($_COOKIE['in_adminid']) && IN_WXUID > 2 ? $EXPLODE : $ARRAY;
define('WXMCHID', $CONFIG[0]);
define('WXKEY', $CONFIG[1]);
define('WXAPPID', $CONFIG[2]);
class WxPayConfig
{
    const MCHID = WXMCHID;
    const KEY = WXKEY;
    const APPID = WXAPPID;
    const SSLCERT_PATH = '../../../data/cert/apiclient_cert.pem';
    const SSLKEY_PATH = '../../../data/cert/apiclient_key.pem';
    const CURL_PROXY_HOST = "0.0.0.0";
    const CURL_PROXY_PORT = 0;
    const REPORT_LEVENL = 1;
}