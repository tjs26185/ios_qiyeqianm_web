<?php

namespace ApkParser;
class Stream
{
private $stream;
public function __construct($stream)
{
if (!is_resource($stream)) {
throw new \Exception("Invalid stream");
}
$this->stream = $stream;
}
public function read($length = 1)
{
return fread($this->stream,$length);
}
public function feof()
{
return feof($this->stream);
}
public function seek($offset)
{
fseek($this->stream,$offset);
}
public function close()
{
fclose($this->stream);
}
public function readByte()
{
return ord($this->read());
}
public function getByteArray($count = null)
{
$bytes = array();
while (!$this->feof() &&($count === null ||count($bytes) <$count)) {
$bytes[] = $this->readByte();
}
return $bytes;
}
function write($str)
{
fwrite($this->stream,$str);
}
function writeByte($byte)
{
$this->write(chr($byte));
}
public function save($destination)
{
$destination = new Stream(is_resource($destination) ?$destination : fopen($destination,'w+'));
while (!$this->feof()) {
$destination->write($this->read());
}
if (!is_resource($destination)) {
$destination->close();
}
}
}
?>