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
    $this->setId(DEFAULT_VALUE);
    $this->setDesde(DEFAULT_VALUE);
    $this->setHasta(DEFAULT_VALUE);
    $this->setAlta(DEFAULT_VALUE);
    $this->setCargo(DEFAULT_VALUE);
    $this->setSede(DEFAULT_VALUE);
    $this->setPersona(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."desde"])) $this->setDesde($row[$p."desde"]);
    if(isset($row[$p."hasta"])) $this->setHasta($row[$p."hasta"]);
    if(isset($row[$p."alta"])) $this->setAlta($row[$p."alta"]);
    if(isset($row[$p."cargo"])) $this->setCargo($row[$p."cargo"]);
    if(isset($row[$p."sede"])) $this->setSede($row[$p."sede"]);
    if(isset($row[$p."persona"])) $this->setPersona($row[$p."persona"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id();
    if($this->desde !== UNDEFINED) $row["desde"] = $this->desde("Y-m-d");
    if($this->hasta !== UNDEFINED) $row["hasta"] = $this->hasta("Y-m-d");
    if($this->alta !== UNDEFINED) $row["alta"] = $this->alta("Y-m-d H:i:s");
    if($this->cargo !== UNDEFINED) $row["cargo"] = $this->cargo();
    if($this->sede !== UNDEFINED) $row["sede"] = $this->sede();
    if($this->persona !== UNDEFINED) $row["persona"] = $this->persona();
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
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkId($p); 
    if($check) $this->id = $p;
    return $check;
  }

  public function _setDesde(DateTime $p = null) {
      $check = $this->checkDesde($p); 
      if($check) $this->desde = $p;  
      return $check;      
  }

  public function setDesde($p, $format = UNDEFINED) {
    $p = ($p == DEFAULT_VALUE) ? 'NULL' : trim($p);
    if(!is_null($p)) $p = ($format == UNDEFINED) ? SpanishDateTime::createFromDate($p) : SpanishDateTime::createFromFormat($format, $p);    
    $check = $this->checkDesde($p); 
    if($check) $this->desde = $p;  
    return $check;
  }

  public function _setHasta(DateTime $p = null) {
      $check = $this->checkHasta($p); 
      if($check) $this->hasta = $p;  
      return $check;      
  }

  public function setHasta($p, $format = UNDEFINED) {
    $p = ($p == DEFAULT_VALUE) ? 'NULL' : trim($p);
    if(!is_null($p)) $p = ($format == UNDEFINED) ? SpanishDateTime::createFromDate($p) : SpanishDateTime::createFromFormat($format, $p);    
    $check = $this->checkHasta($p); 
    if($check) $this->hasta = $p;  
    return $check;
  }

  public function _setAlta(DateTime $p = null) {
      $check = $this->checkAlta($p); 
      if($check) $this->alta = $p;  
      return $check;
  }

  public function setAlta($p, $format = "Y-m-d H:i:s") {
    $p = ($p == DEFAULT_VALUE) ? 'current_timestamp()' : trim($p);
    if(!is_null($p)) $p = SpanishDateTime::createFromFormat($format, $p);    
    $check = $this->checkAlta($p); 
    if($check) $this->alta = $p;  
    return $check;
  }

  public function setCargo($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkCargo($p); 
    if($check) $this->cargo = $p;
    return $check;
  }

  public function setSede($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkSede($p); 
    if($check) $this->sede = $p;
    return $check;
  }

  public function setPersona($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkPersona($p); 
    if($check) $this->persona = $p;
    return $check;
  }

  public function checkId($value) { 
      return true; 
  }

  public function checkDesde($value) { 
    $v = Validation::getInstanceValue($value)->date();
    return $this->_setLogsValidation("desde", $v);
  }

  public function checkHasta($value) { 
    $v = Validation::getInstanceValue($value)->date();
    return $this->_setLogsValidation("hasta", $v);
  }

  public function checkAlta($value) { 
    $v = Validation::getInstanceValue($value)->date()->required();
    return $this->_setLogsValidation("alta", $v);
  }

  public function checkCargo($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("cargo", $v);
  }

  public function checkSede($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("sede", $v);
  }

  public function checkPersona($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("persona", $v);
  }



}
