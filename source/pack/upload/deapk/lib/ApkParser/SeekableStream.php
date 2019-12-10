<?php

namespace ApkParser;
class SeekableStream
{
const LITTLE_ENDIAN_ORDER = 1;
const BIG_ENDIAN_ORDER = 2;
private static $endianess = 0;
private $stream;
private $size = 0;
public function __construct($stream = null)
{
if (is_null($stream) ||is_resource($stream) === false) {
throw new \InvalidArgumentException('Stream must be a resource');
}
$meta = stream_get_meta_data($stream);
if ($meta['seekable'] === false) {
$this->stream = self::toMemoryStream($stream);
}else {
$this->stream = $stream;
}
rewind($this->stream);
fseek($this->stream,0,SEEK_END);
$this->size = ftell($this->stream);
rewind($this->stream);
}
public function copyBytes($length)
{
return new self(self::toMemoryStream($this->stream,$length));
}
public function read($length = 1)
{
if ($length <0) {
throw new \RuntimeException('Length cannot be negative');
}
if ($length == 0) {
return '';
}
$bytes = fread($this->stream,$length);
if (FALSE === $bytes ||strlen($bytes) != $length) {
throw new \RuntimeException('Failed to read '.$length .' bytes');
}
return $bytes;
}
public function seek($offset)
{
fseek($this->stream,$offset);
}
public function eof()
{
return feof($this->stream);
}
public function position()
{
return ftell($this->stream);
}
public function size()
{
return $this->size;
}
public function readByte()
{
return ord($this->read(1));
}
public function readInt16LE()
{
if (self::isBigEndian()) {
return self::unpackInt16(strrev($this->read(2)));
}else {
return self::unpackInt16($this->read(2));
}
}
public function readInt32LE()
{
if (self::isBigEndian()) {
return self::unpackInt32(strrev($this->read(4)));
}else {
return self::unpackInt32($this->read(4));
}
}
private static function unpackInt16($value)
{
list(,$int) = unpack('s*',$value);
return $int;
}
private static function unpackInt32($value)
{
list(,$int) = unpack('l*',$value);
return $int;
}
private static function getEndianess()
{
if (self::$endianess === 0) {
self::$endianess = self::unpackInt32("\1\0\0\0") == 1 ?self::LITTLE_ENDIAN_ORDER : self::BIG_ENDIAN_ORDER;
}
return self::$endianess;
}
private static function isBigEndian()
{
return self::getEndianess() == self::BIG_ENDIAN_ORDER;
}
private static function toMemoryStream($stream,$length = 0)
{
$size = 0;
$memoryStream = fopen('php://memory','wb+');
while (!feof($stream)) {
fputs($memoryStream,fread($stream,1));
$size++;
if ($length >0 &&$size >= $length) {
break;
}
}
return $memoryStream;
}
}
?>