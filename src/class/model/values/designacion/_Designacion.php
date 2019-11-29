<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _Designacion extends EntityValues {
  protected $id = UNDEFINED;
  protected $persona = UNDEFINED;
  protected $alta = UNDEFINED;
  protected $baja = UNDEFINED;
  protected $cargo = UNDEFINED;
  protected $sede = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setPersona(DEFAULT_VALUE);
    $this->setAlta(DEFAULT_VALUE);
    $this->setBaja(DEFAULT_VALUE);
    $this->setCargo(DEFAULT_VALUE);
    $this->setSede(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."persona"])) $this->setPersona($row[$p."persona"]);
    if(isset($row[$p."alta"])) $this->setAlta($row[$p."alta"]);
    if(isset($row[$p."baja"])) $this->setBaja($row[$p."baja"]);
    if(isset($row[$p."cargo"])) $this->setCargo($row[$p."cargo"]);
    if(isset($row[$p."sede"])) $this->setSede($row[$p."sede"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id("");
    if($this->persona !== UNDEFINED) $row["persona"] = $this->persona("");
    if($this->alta !== UNDEFINED) $row["alta"] = $this->alta("Y-m-d h:i:s");
    if($this->baja !== UNDEFINED) $row["baja"] = $this->baja("Y-m-d h:i:s");
    if($this->cargo !== UNDEFINED) $row["cargo"] = $this->cargo("");
    if($this->sede !== UNDEFINED) $row["sede"] = $this->sede("");
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->persona)) return false;
    if(!Validation::is_empty($this->alta)) return false;
    if(!Validation::is_empty($this->baja)) return false;
    if(!Validation::is_empty($this->cargo)) return false;
    if(!Validation::is_empty($this->sede)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function persona($format = null) { return Format::convertCase($this->persona, $format); }
  public function alta($format = null) { return Format::date($this->alta, $format); }
  public function baja($format = null) { return Format::date($this->baja, $format); }
  public function cargo($format = null) { return Format::convertCase($this->cargo, $format); }
  public function sede($format = null) { return Format::convertCase($this->sede, $format); }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkId($p)) $this->id = $p;
  }

  public function setPersona($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkPersona($p)) $this->persona = $p;
  }

  public function _setAlta(DateTime $p = null) {
      if($this->checkAlta($p)) $this->alta = $p;  
  }

  public function setAlta($p, $format = "Y-m-d H:i:s") {
    $p = ($p == DEFAULT_VALUE) ? date('Y-m-d H:i:s') : trim($p);
    if(!is_null($p)) {
      $p = SpanishDateTime::createFromFormat($format, $p);
    }
    if($this->checkAlta($p)) $this->alta = $p;
  }

  public function _setBaja(DateTime $p = null) {
      if($this->checkBaja($p)) $this->baja = $p;  
  }

  public function setBaja($p, $format = "Y-m-d H:i:s") {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    if(!is_null($p)) {
      $p = SpanishDateTime::createFromFormat($format, $p);
    }
    if($this->checkBaja($p)) $this->baja = $p;
  }

  public function setCargo($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkCargo($p)) $this->cargo = $p;
  }

  public function setSede($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkSede($p)) $this->sede = $p;
  }

  public function checkId($value) { 
      return true; 
  }

  public function checkPersona($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("persona", $v);
  }

  public function checkAlta($value) { 
    $v = Validation::getInstanceValue($value)->date()->required();
    return $this->_setLogsValidation("alta", $v);
  }

  public function checkBaja($value) { 
    $v = Validation::getInstanceValue($value)->date();
    return $this->_setLogsValidation("baja", $v);
  }

  public function checkCargo($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("cargo", $v);
  }

  public function checkSede($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("sede", $v);
  }



}