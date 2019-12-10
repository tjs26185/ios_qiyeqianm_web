<?php

namespace ApkParser;
class ResourcesParser
{
const RES_STRING_POOL_TYPE = 0x1;
const RES_TABLE_TYPE = 0x2;
const RES_TABLE_PACKAGE_TYPE = 0x200;
const RES_TABLE_TYPE_TYPE = 0x201;
const RES_TABLE_TYPE_SPEC_TYPE = 0x202;
const TYPE_REFERENCE = 0x1;
const TYPE_STRING = 0x3;
const FLAG_COMPLEX = 0x1;
private $stream;
private $valueStringPool;
private $typeStringPool;
private $keyStringPool;
private $packageId = 0;
private $resources = array();
public function __construct(SeekableStream $stream)
{
$this->stream = $stream;
$this->decompress();
}
public function getResources($key)
{
return $this->resources[strtolower($key)];
}
private function decompress()
{
$type = $this->stream->readInt16LE();
$this->stream->readInt16LE();
$size = $this->stream->readInt32LE();
$packagesCount = $this->stream->readInt32LE();
if ($type != self::RES_TABLE_TYPE) {
throw new \Exception('No RES_TABLE_TYPE found');
}
if ($size != $this->stream->size()) {
throw new \Exception('The buffer size not matches to the resource table size');
}
$realStringsCount = 0;
$realPackagesCount = 0;
while (true) {
$pos = $this->stream->position();
$chunkType = $this->stream->readInt16LE();
$this->stream->readInt16LE();
$chunkSize = $this->stream->readInt32LE();
if ($chunkType == self::RES_STRING_POOL_TYPE) {
if ($realStringsCount == 0) {
$this->stream->seek($pos);
$this->valueStringPool = $this->processStringPool($this->stream->copyBytes($chunkSize));
}
$realStringsCount++;
}else {
if ($chunkType == self::RES_TABLE_PACKAGE_TYPE) {
$this->stream->seek($pos);
$this->processPackage($this->stream->copyBytes($chunkSize));
$realPackagesCount++;
}else {
throw new \Exception('Unsupported Type');
}
}
$this->stream->seek($pos +$chunkSize);
if ($this->stream->position() == $size) {
break;
}
}
if ($realStringsCount != 1) {
throw new \Exception('More than 1 string pool found!');
}
if ($realPackagesCount != $packagesCount) {
throw new \Exception('Real package count not equals the declared count.');
}
}
private function processPackage(SeekableStream $data)
{
$data->readInt16LE();
$headerSize = $data->readInt16LE();
$data->readInt32LE();
$this->packageId = $data->readInt32LE();
$packageName = $data->read(256);
$typeStringsStart = $data->readInt32LE();
$data->readInt32LE();
$keyStringsStart = $data->readInt32LE();
$data->readInt32LE();
if ($typeStringsStart != $headerSize) {
throw new \Exception('TypeStrings must immediately follow the package structure header.');
}
$data->seek($typeStringsStart);
$this->typeStringPool = $this->processStringPool($data->copyBytes($data->size() -$data->position()));
$data->seek($keyStringsStart);
$data->readInt16LE();
$data->readInt16LE();
$keySize = $data->readInt32LE();
$data->seek($keyStringsStart);
$this->keyStringPool = $this->processStringPool($data->copyBytes($data->size() -$data->position()));
$data->seek($keyStringsStart +$keySize);
while (true) {
$pos = $data->position();
$chunkType = $data->readInt16LE();
$data->readInt16LE();
$chunkSize = $data->readInt32LE();
if ($chunkType == self::RES_TABLE_TYPE_SPEC_TYPE) {
$data->seek($pos);
$this->processTypeSpec($data->copyBytes($chunkSize));
}else {
if ($chunkType == self::RES_TABLE_TYPE_TYPE) {
$data->seek($pos);
$this->processType($data->copyBytes($chunkSize));
}
}
$data->seek($pos +$chunkSize);
if ($data->position() == $data->size()) {
break;
}
}
}
private function processStringPool(SeekableStream $data)
{
$data->readInt16LE();
$data->readInt16LE();
$data->readInt32LE();
$stringsCount = $data->readInt32LE();
$data->readInt32LE();
$flags = $data->readInt32LE();
$stringsStart = $data->readInt32LE();
$data->readInt32LE();
$offsets = array();
for ($i = 0;$i <$stringsCount;$i++) {
$offsets[$i] = $data->readInt32LE();
}
$isUtf8 = ($flags &256) != 0;
$strings = array();
for ($i = 0;$i <$stringsCount;$i++) {
$lastPosition = $data->position();
$pos = $stringsStart +$offsets[$i];
$data->seek($pos);
$len = $data->position();
$data->seek($lastPosition);
if ($len <0) {
$data->readInt16LE();
}
$pos += 2;
$strings[$i] = '';
if ($isUtf8) {
$length = 0;
$data->seek($pos);
while ($data->readByte() != 0) {
$length++;
}
if ($length >0) {
$data->seek($pos);
$strings[$i] = $data->read($length);
}else {
$strings[$i] = '';
}
}else {
$data->seek($pos);
while (($c = $data->read()) != 0) {
$strings[$i] .= $c;
$pos += 2;
}
}
}
return $strings;
}
private function processTypeSpec(SeekableStream $data)
{
$data->readInt16LE();
$data->readInt16LE();
$data->readInt32LE();
$id = $data->readByte();
$data->readByte();
$data->readInt16LE();
$entriesCount = $data->readInt32LE();
$flags = array();
for ($i = 0;$i <$entriesCount;++$i) {
$flags[$i] = $data->readInt32LE();
}
}
private function processType(SeekableStream $data)
{
$data->readInt16LE();
$headerSize = $data->readInt16LE();
$data->readInt32LE();
$id = $data->readByte();
$data->readByte();
$data->readInt16LE();
$entriesCount = $data->readInt32LE();
$entriesStart = $data->readInt32LE();
$data->readInt32LE();
if ($headerSize +$entriesCount * 4 != $entriesStart) {
throw new \Exception('HeaderSize, entriesCount and entriesStart are not valid.');
}
$data->seek($headerSize);
$entryIndices = array();
for ($i = 0;$i <$entriesCount;++$i) {
$entryIndices[$i] = $data->readInt32LE();
}
for ($i = 0;$i <$entriesCount;++$i) {
if ($entryIndices[$i] == -1) {
continue;
}
$resourceId = $this->packageId <<24 |$id <<16 |$i;
$data->readInt16LE();
$entryFlag = $data->readInt16LE();
$entryKey = $data->readInt32LE();
$resourceIdString = '0x'.dechex($resourceId);
$entryKeyString = $this->keyStringPool[$entryKey];
if (($entryFlag &self::FLAG_COMPLEX) == 0) {
$data->readInt16LE();
$data->readByte();
$valueDataType = $data->readByte();
$valueData = $data->readInt32LE();
if ($valueDataType == self::TYPE_STRING) {
$value = $this->valueStringPool[$valueData];
$this->putResource($resourceIdString,$value);
}else {
if ($valueDataType == self::TYPE_REFERENCE) {
$referenceIdString = '0x'.dechex($valueData);
$this->putReferenceResource($resourceIdString,$referenceIdString);
}else {
$this->putResource($resourceIdString,$valueData);
}
}
}else {
$data->readInt32LE();
$entryCount = $data->readInt32LE();
for ($j = 0;$j <$entryCount;++$j) {
$data->readInt32LE();
$data->readInt16LE();
$data->readByte();
$data->readByte();
$data->readInt32LE();
}
}
}
}
private function putResource($resourceId,$value)
{
$key = strtolower($resourceId);
if (array_key_exists($key,$this->resources) === false) {
$this->resources[$key] = array();
}
$this->resources[$key][] = $value;
}
private function putReferenceResource($resourceId,$valueData)
{
$key = strtolower($resourceId);
if (array_key_exists($key,$this->resources)) {
$values = $this->resources[$key];
foreach ($values as $value) {
$this->putResource($valueData,$value);
}
}
}
}
?>