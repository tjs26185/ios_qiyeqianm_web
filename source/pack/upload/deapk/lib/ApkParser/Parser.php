<?php

namespace ApkParser;
class Parser
{
private $apk;
private $manifest;
private $resources;
private $config;
public function __construct($apkFile,array $config = array())
{
$this->config = new Config($config);
$this->apk = new Archive($apkFile);
$this->manifest = new Manifest(new XmlParser($this->apk->getManifestStream()));
if (!$this->config->manifest_only) {
$this->resources = new ResourcesParser($this->apk->getResourcesStream());
}else {
$this->resources = NULL;
}
}
public function getManifest()
{
return $this->manifest;
}
public function getApkArchive()
{
return $this->apk;
}
public function getResources($key)
{
return is_null($this->resources) ?FALSE : $this->resources->getResources($key);
}
public function getStream($name)
{
return $this->apk->getStream($name);
}
public function extractTo($destination,$entries = NULL)
{
return $this->apk->extractTo($destination,$entries);
}
public function getClasses()
{
$dexStream = $this->apk->getClassesDexStream();
$apkName = $this->apk->getApkName();
$cache_folder = $this->config->tmp_path .'/'.str_replace('.','_',$apkName) .'/';
if (!is_dir($cache_folder)) {
mkdir($cache_folder,0755,true);
}
$dex_file = $cache_folder .'/classes.dex';
$dexStream->save($dex_file);
$command = "java -jar {$this->config->jar_path} -d {$cache_folder} {$dex_file}";
$returns = shell_exec($command);
if (!$returns) {
throw new \Exception("Couldn't decompile .dex file");
}
$file_list = Utils::globRecursive($cache_folder .'*.ddx');
foreach ($file_list as &$file) {
$file = str_replace($cache_folder,'',$file);
$file = str_replace('/','.',$file);
$file = str_replace('.ddx','',$file);
$file = trim($file,'.');
}
return $file_list;
}
}
?>