<?php

namespace ApkParser;
class IntentFilter
{
public $actions = array();
public $categories = array();
public function __construct(ManifestXmlElement $filterXml)
{
$filterArray = get_object_vars($filterXml);
if (isset($filterArray['action'])) {
if (!is_array($filterArray['action'])) {
$filterArray['action'] = array($filterArray['action']);
}
foreach ($filterArray['action'] as $act) {
$actionElement = get_object_vars($act);
$actionNameSections = explode('.',$actionElement['@attributes']['name']);
$this->actions[] = end($actionNameSections);
}
}
if (isset($filterArray['category'])) {
if (!is_array($filterArray['category'])) {
$filterArray['category'] = array($filterArray['category']);
}
foreach ($filterArray['category'] as $cat) {
$categoryElement = get_object_vars($cat);
$categoryNameSections = explode('.',$categoryElement['@attributes']['name']);
$this->categories[] = end($categoryNameSections);
}
}
}
public function getActions()
{
return $this->actions;
}
public function setActions($actions)
{
$this->actions = $actions;
}
public function getCategories()
{
return $this->categories;
}
public function setCategories($categories)
{
$this->categories = $categories;
}
}
?>