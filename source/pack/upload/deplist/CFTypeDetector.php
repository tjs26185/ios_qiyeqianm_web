<?php

namespace CFPropertyList;
use \DateTime,\Iterator;
class CFTypeDetector {
protected $autoDictionary = false;
protected $suppressExceptions = false;
protected $objectToArrayMethod = null;
protected $castNumericStrings = true;
public function __construct(array $options=array()) {
foreach ($options as $key =>$value) {
if (property_exists($this,$key)) {
$this->$key = $value;
}
}
}
protected function isAssociativeArray($value) {
$numericKeys = true;
$i = 0;
foreach($value as $key =>$v) {
if($i !== $key) {
$numericKeys = false;
break;
}
$i++;
}
return !$numericKeys;
}
protected function defaultValue() {
return new CFString();
}
public function toCFType($value) {
switch(true) {
case $value instanceof CFType:
return $value;
break;
case is_object($value):
if(class_exists( 'DateTime') &&$value instanceof DateTime){
return new CFDate($value->getTimestamp());
}
if($this->objectToArrayMethod &&is_callable(array($value,$this->objectToArrayMethod))){
$value = call_user_func( array( $value,$this->objectToArrayMethod ) );
}
if(!is_array($value)){
if($this->suppressExceptions)
return $this->defaultValue();
throw new PListException('Could not determine CFType for object of type '.get_class($value));
}
case $value instanceof Iterator:
case is_array($value):
if(!$this->autoDictionary) {
if(!$this->isAssociativeArray($value)) {
$t = new CFArray();
foreach($value as $v) $t->add($this->toCFType($v));
return $t;
}
}
$t = new CFDictionary();
foreach($value as $k =>$v) $t->add($k,$this->toCFType($v));
return $t;
break;
case is_bool($value):
return new CFBoolean($value);
break;
case is_null($value):
return new CFString();
break;
case is_resource($value):
if ($this->suppressExceptions) {
return $this->defaultValue();
}
throw new PListException('Could not determine CFType for resource of type '.get_resource_type($value));
break;
case is_numeric($value):
if (!$this->castNumericStrings &&is_string($value)) {
return new CFString($value);
}
return new CFNumber($value);
break;
case is_string($value):
if(strpos($value,"\x00") !== false) {
return new CFData($value);
}
return new CFString($value);
break;
default:
if ($this->suppressExceptions) {
return $this->defaultValue();
}
throw new PListException('Could not determine CFType for '.gettype($value));
break;
}
}
}
?>