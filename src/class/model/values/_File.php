<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _File extends EntityValues {
  protected $id = UNDEFINED;
  protected $name = UNDEFINED;
  protected $type = UNDEFINED;
  protected $content = UNDEFINED;
  protected $size = UNDEFINED;
  protected $created = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setName(DEFAULT_VALUE);
    $this->setType(DEFAULT_VALUE);
    $this->setContent(DEFAULT_VALUE);
    $this->setSize(DEFAULT_VALUE);
    $this->setCreated(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."name"])) $this->setName($row[$p."name"]);
    if(isset($row[$p."type"])) $this->setType($row[$p."type"]);
    if(isset($row[$p."content"])) $this->setContent($row[$p."content"]);
    if(isset($row[$p."size"])) $this->setSize($row[$p."size"]);
    if(isset($row[$p."created"])) $this->setCreated($row[$p."created"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id();
    if($this->name !== UNDEFINED) $row["name"] = $this->name();
    if($this->type !== UNDEFINED) $row["type"] = $this->type();
    if($this->content !== UNDEFINED) $row["content"] = $this->content();
    if($this->size !== UNDEFINED) $row["size"] = $this->size();
    if($this->created !== UNDEFINED) $row["created"] = $this->created("Y-m-d H:i:s");
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->name)) return false;
    if(!Validation::is_empty($this->type)) return false;
    if(!Validation::is_empty($this->content)) return false;
    if(!Validation::is_empty($this->size)) return false;
    if(!Validation::is_empty($this->created)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function name($format = null) { return Format::convertCase($this->name, $format); }
  public function type($format = null) { return Format::convertCase($this->type, $format); }
  public function content($format = null) { return Format::convertCase($this->content, $format); }
  public function size() { return $this->size; }
  public function created($format = null) { return Format::date($this->created, $format); }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkId($p); 
    if($check) $this->id = $p;
    return $check;
  }

  public function setName($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkName($p); 
    if($check) $this->name = $p;
    return $check;
  }

  public function setType($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkType($p); 
    if($check) $this->type = $p;
    return $check;
  }

  public function setContent($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkContent($p); 
    if($check) $this->content = $p;
    return $check;
  }

  public function setSize($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $p = (is_null($p)) ? null : intval(trim($p));
    $check = $this->checkSize($p); 
    if($check) $this->size = $p;
    return $check;
  }

  public function _setCreated(DateTime $p = null) {
      $check = $this->checkCreated($p); 
      if($check) $this->created = $p;  
      return $check;
  }

  public function setCreated($p, $format = "Y-m-d H:i:s") {
    $p = ($p == DEFAULT_VALUE) ? date('Y-m-d H:i:s') : trim($p);
    if(!is_null($p)) $p = SpanishDateTime::createFromFormat($format, $p);    
    $check = $this->checkCreated($p); 
    if($check) $this->created = $p;  
    return $check;
  }

  public function checkId($value) { 
      return true; 
  }

  public function checkName($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("name", $v);
  }

  public function checkType($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("type", $v);
  }

  public function checkContent($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("content", $v);
  }

  public function checkSize($value) { 
    $v = Validation::getInstanceValue($value)->integer()->required();
    return $this->_setLogsValidation("size", $v);
  }

  public function checkCreated($value) { 
    $v = Validation::getInstanceValue($value)->date()->required();
    return $this->_setLogsValidation("created", $v);
  }



}
