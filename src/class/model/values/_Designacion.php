<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _Designacion extends EntityValues {
  protected $id = UNDEFINED;
  protected $desde = UNDEFINED;
  protected $hasta = UNDEFINED;
  protected $alta = UNDEFINED;
  protected $cargo = UNDEFINED;
  protected $sede = UNDEFINED;
  protected $persona = UNDEFINED;

  public function _setDefault(){
    if($this->id == UNDEFINED) $this->setId(null);
    if($this->desde == UNDEFINED) $this->setDesde(null);
    if($this->hasta == UNDEFINED) $this->setHasta(null);
    if($this->alta == UNDEFINED) $this->setAlta(date('c'));
    if($this->cargo == UNDEFINED) $this->setCargo(null);
    if($this->sede == UNDEFINED) $this->setSede(null);
    if($this->persona == UNDEFINED) $this->setPersona(null);
    return $this;
  }

  public function _fromArray(array $row = NULL, string $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."desde"])) $this->setDesde($row[$p."desde"]);
    if(isset($row[$p."hasta"])) $this->setHasta($row[$p."hasta"]);
    if(isset($row[$p."alta"])) $this->setAlta($row[$p."alta"]);
    if(isset($row[$p."cargo"])) $this->setCargo($row[$p."cargo"]);
    if(isset($row[$p."sede"])) $this->setSede($row[$p."sede"]);
    if(isset($row[$p."persona"])) $this->setPersona($row[$p."persona"]);
    return $this;
  }

  public function _toArray(string $p = ""){
    $row = [];
    if($this->id !== UNDEFINED) $row[$p."id"] = $this->id();
    if($this->desde !== UNDEFINED) $row[$p."desde"] = $this->desde("c");
    if($this->hasta !== UNDEFINED) $row[$p."hasta"] = $this->hasta("c");
    if($this->alta !== UNDEFINED) $row[$p."alta"] = $this->alta("c");
    if($this->cargo !== UNDEFINED) $row[$p."cargo"] = $this->cargo();
    if($this->sede !== UNDEFINED) $row[$p."sede"] = $this->sede();
    if($this->persona !== UNDEFINED) $row[$p."persona"] = $this->persona();
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->desde)) return false;
    if(!Validation::is_empty($this->hasta)) return false;
    if(!Validation::is_empty($this->alta)) return false;
    if(!Validation::is_empty($this->cargo)) return false;
    if(!Validation::is_empty($this->sede)) return false;
    if(!Validation::is_empty($this->persona)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function desde($format = null) { return Format::date($this->desde, $format); }
  public function hasta($format = null) { return Format::date($this->hasta, $format); }
  public function alta($format = null) { return Format::date($this->alta, $format); }
  public function cargo($format = null) { return Format::convertCase($this->cargo, $format); }
  public function sede($format = null) { return Format::convertCase($this->sede, $format); }
  public function persona($format = null) { return Format::convertCase($this->persona, $format); }

  public function setId($p) { $this->id = (is_null($p)) ? null : (string)$p; }
  public function _setDesde(DateTime $p = null) { $this->desde = $p; }

  public function setDesde($p) {
    if(!is_null($p)) {
      $p = new SpanishDateTime($p);
      if($p) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
      $p->setTime(0,0,0);
    }
    $this->desde = $p;
  }

  public function _setHasta(DateTime $p = null) { $this->hasta = $p; }

  public function setHasta($p) {
    if(!is_null($p)) {
      $p = new SpanishDateTime($p);
      if($p) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
      $p->setTime(0,0,0);
    }
    $this->hasta = $p;
  }

  public function _setAlta(DateTime $p = null) { $this->alta = $p; }

  public function setAlta($p) {
    if(!is_null($p)) {
      $p = new SpanishDateTime($p);    
      if($p) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    }
    $this->alta = $p;  
  }

  public function setCargo($p) { $this->cargo = (is_null($p)) ? null : (string)$p; }
  public function setSede($p) { $this->sede = (is_null($p)) ? null : (string)$p; }
  public function setPersona($p) { $this->persona = (is_null($p)) ? null : (string)$p; }


  public function checkId($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkDesde($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkHasta($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkAlta($value) { 
    $this->_logs->resetLogs("alta");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("alta", "error", $error); }
    return $v->isSuccess();
  }

  public function checkCargo($value) { 
    $this->_logs->resetLogs("cargo");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("cargo", "error", $error); }
    return $v->isSuccess();
  }

  public function checkSede($value) { 
    $this->_logs->resetLogs("sede");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("sede", "error", $error); }
    return $v->isSuccess();
  }

  public function checkPersona($value) { 
    $this->_logs->resetLogs("persona");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("persona", "error", $error); }
    return $v->isSuccess();
  }

  public function _check(){
    $this->checkId($this->id);
    $this->checkDesde($this->desde);
    $this->checkHasta($this->hasta);
    $this->checkAlta($this->alta);
    $this->checkCargo($this->cargo);
    $this->checkSede($this->sede);
    $this->checkPersona($this->persona);
    return !$this->_getLogs()->isError();
  }

  public function _reset(){
    return $this;
  }



}
