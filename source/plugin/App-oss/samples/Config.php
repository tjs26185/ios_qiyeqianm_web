<?php

define('IN_OSS_ENDPOINT',str_replace('http://'.IN_REMOTEBK.'.','http://',IN_REMOTEDK));final class Config
{
const OSS_ACCESS_ID = IN_REMOTEAK;
const OSS_ACCESS_KEY = IN_REMOTESK;
const OSS_ENDPOINT = IN_OSS_ENDPOINT;
const OSS_TEST_BUCKET = IN_REMOTEBK;
}
?>