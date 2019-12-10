<?php

namespace ApkParser;
class ManifestXmlElement extends \SimpleXMLElement
{
public function getPermissions()
{
$permsArray = $this->{'uses-permission'};
$perms = array();
foreach ($permsArray as $perm) {
$permAttr = get_object_vars($perm);
$objNotationArray = explode('.',$permAttr['@attributes']['name']);
$permName = trim(end($objNotationArray));
$perms[$permName] = array('description'=>isset(Manifest::$permissions[$permName]) ?Manifest::$permissions[$permName] : null,'flags'=>isset(Manifest::$permission_flags[$permName]) ?Manifest::$permission_flags[$permName] : array('cost'=>false,'warning'=>false,'danger'=>false));
}
return $perms;
}
public function getApplication()
{
return new Application($this->application);
}
public function getAttribute($attributeName)
{
$attrs = get_object_vars($this);
return isset($attrs['@attributes'][$attributeName]) ?$attrs['@attributes'][$attributeName] : null;
}
}
?>