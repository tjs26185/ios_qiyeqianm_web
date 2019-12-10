<?php

namespace Qiniu;
use Qiniu\Zone;
final class Config
{
const SDK_VER = '7.1.3';
const BLOCK_SIZE = 1073741824;
const RS_HOST  = 'http://rs.qbox.me';
const RSF_HOST = 'http://rsf.qbox.me';
const API_HOST = 'http://api.qiniu.com';
const UC_HOST  = 'http://uc.qbox.me';
public $zone;
public function __construct(Zone $z = null)         
{
$this->zone = new Zone();
}
}
?>