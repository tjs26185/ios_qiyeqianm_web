<?php

namespace ApkParser;
class Archive extends \ZipArchive
{
private $filePath;
private $fileName;
public function __construct($file = false)
{
if ($file &&is_file($file)) {
$this->open($file);
$this->fileName = basename($this->filePath = $file);
}else {
throw new \Exception($file ." not a regular file");
}
}
public function getFromName($name,$length = NULL,$flags = NULL)
{
if (strtolower(substr($name,-4)) == '.xml') {
$xmlParser = new XmlParser(new Stream($this->getStream($name)));
return $xmlParser->getXmlString();
}else {
return parent::getFromName($name,$length,$flags);
}
}
public function getManifestStream()
{
return new Stream($this->getStream('AndroidManifest.xml'));
}
public function getResourcesStream()
{
return new SeekableStream($this->getStream('resources.arsc'));
}
public function getClassesDexStream()
{
return new Stream($this->getStream('classes.dex'));
}
public function getApkPath()
{
return $this->filePath;
}
public function getApkName()
{
return $this->fileName;
}
public function extractTo($destination,$entries = NULL)
{
if ($extResult = parent::extractTo($destination,$entries)) {
$xmlFiles = Utils::globRecursive($destination .'/*.xml');
foreach ($xmlFiles as $xmlFile) {
if ($xmlFile == $destination ."/AndroidManifest.xml") {
XmlParser::decompressFile($xmlFile);
}
}
}
return $extResult;
}
}
?>