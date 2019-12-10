<?php

namespace ApkParser;
class Config
{
private $config;
public function __construct(array $config = array())
{
$this->config = array_merge(array('tmp_path'=>sys_get_temp_dir(),'jar_path'=>__DIR__ .'/Dex/dedexer.jar','manifest_only'=>false),$config);
}
public function get($key)
{
return $this->config[$key];
}
public function __get($key)
{
return $this->config[$key];
}
public function __set($name,$value)
{
return $this->config[$name] = $value;
}
}
?>