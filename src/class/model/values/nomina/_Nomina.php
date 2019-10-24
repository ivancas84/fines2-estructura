<?php

require_once("class/Format.php");
require_once("class/model/Values.php");

class _Nomina extends EntityValues {
  protected $id = UNDEFINED;
  protected $alta = UNDEFINED;
  protected $activo = UNDEFINED;
  protected $division = UNDEFINED;
  protected $persona = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setAlta(DEFAULT_VALUE);
    $this->setActivo(DEFAULT_VALUE);
    $this->setDivision(DEFAULT_VALUE);
    $this->setPersona(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."alta"])) $this->setAlta($row[$p."alta"]);
    if(isset($row[$p."activo"])) $this->setActivo($row[$p."activo"]);
    if(isset($row[$p."division"])) $this->setDivision($row[$p."division"]);
    if(isset($row[$p."persona"])) $this->setPersona($row[$p."persona"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id("");
    if($this->alta !== UNDEFINED) $row["alta"] = $this->alta("Y-m-d h:i:s");
    if($this->activo !== UNDEFINED) $row["activo"] = $this->activo("");
    if($this->division !== UNDEFINED) $row["division"] = $this->division("");
    if($this->persona !== UNDEFINED) $row["persona"] = $this->persona("");
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->alta)) return false;
    if(!Validation::is_empty($this->activo)) return false;
    if(!Validation::is_empty($this->division)) return false;
    if(!Validation::is_empty($this->persona)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function alta($format = null) { return Format::date($this->alta, $format); }
  public function activo($format = null) { return Format::boolean($this->activo, $format); }
  public function division() { return $this->division; }
  public function persona() { return $this->persona; }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkId($p)) $this->id = $p;
  }

  public function _setAlta(DateTime $p = null) {
      if($this->checkAlta($p)) $this->alta = $p;  
  }

  public function setAlta($p, $format = "Y-m-d H:i:s") {
    $p = ($p == DEFAULT_VALUE) ? date('Y-m-d H:i:s') : trim($p);
    $p = (is_null($p)) ? null : SpanishDateTime::createFromFormat($format, $p);
    if($this->checkAlta($p)) $this->alta = $p;
  }

  public function setActivo($p) {
    if ($p == DEFAULT_VALUE) $p = 1;
    $p = (is_null($p)) ? null : settypebool(trim($p));
    if($this->checkActivo($p)) $this->activo = $p;
  }

  public function setDivision($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkDivision($p)) $this->division = $p;
  }

  public function setPersona($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkPersona($p)) $this->persona = $p;
  }

  public function checkId($value) { 
      return true; 
  }

  public function checkAlta($value) { 
    $v = Validation::getInstanceValue($value)->date()->required();
    return $this->_setLogsValidation("alta", $v);
  }

  public function checkActivo($value) { 
    $v = Validation::getInstanceValue($value)->boolean()->required();
    return $this->_setLogsValidation("activo", $v);
  }

  public function checkDivision($value) { 
    $v = Validation::getInstanceValue($value)->integer()->required();
    return $this->_setLogsValidation("division", $v);
  }

  public function checkPersona($value) { 
    $v = Validation::getInstanceValue($value)->integer()->required();
    return $this->_setLogsValidation("persona", $v);
  }



}
