<?php

namespace ApkParser;
class Activity
{
public $label;
public $name;
public $filters = array();
public $isLauncher = false;
public function __construct(ManifestXmlElement $actXml)
{
$actArray = get_object_vars($actXml);
$attrs = $actArray['@attributes'];
$this->setName(isset($attrs['name']) ?$attrs['name'] : null);
$this->setLabel(isset($attrs['label']) ?$attrs['label'] : null);
if (isset($actArray['intent-filter'])) {
if (!is_array($actArray['intent-filter'])) {
$actArray['intent-filter'] = array($actArray['intent-filter']);
}
foreach ($actArray['intent-filter'] as $filterXml) {
$this->filters[] = new IntentFilter($filterXml);
}
}
foreach ($this->filters as $filter) {
if ($filter->actions != null &&in_array('MAIN',$filter->actions) &&($filter->categories != null &&in_array('LAUNCHER',$filter->categories))) {
$this->isLauncher = true;
}
}
}
public function setLabel($label)
{
$this->label = $label;
}
public function getLabel()
{
return $this->label;
}
public function setName($name)
{
$this->name = $name;
}
public function getName()
{
return $this->name;
}
public function setFilters(array $filters)
{
$this->filters = $filters;
}
public function getFilters()
{
return $this->filters;
}
public function isLauncher()
{
return $this->isLauncher;
}
public function setIsLauncher($isLauncher)
{
$this->isLauncher = $isLauncher;
}
public function isIsLauncher()
{
return $this->isLauncher;
}
}
?>