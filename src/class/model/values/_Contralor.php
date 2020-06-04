<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _Contralor extends EntityValues {
  protected $id = UNDEFINED;
  protected $fechaContralor = UNDEFINED;
  protected $fechaConsejo = UNDEFINED;
  protected $insertado = UNDEFINED;
  protected $planillaDocente = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setFechaContralor(DEFAULT_VALUE);
    $this->setFechaConsejo(DEFAULT_VALUE);
    $this->setInsertado(DEFAULT_VALUE);
    $this->setPlanillaDocente(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."fecha_contralor"])) $this->setFechaContralor($row[$p."fecha_contralor"]);
    if(isset($row[$p."fecha_consejo"])) $this->setFechaConsejo($row[$p."fecha_consejo"]);
    if(isset($row[$p."insertado"])) $this->setInsertado($row[$p."insertado"]);
    if(isset($row[$p."planilla_docente"])) $this->setPlanillaDocente($row[$p."planilla_docente"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id();
    if($this->fechaContralor !== UNDEFINED) $row["fecha_contralor"] = $this->fechaContralor("Y-m-d");
    if($this->fechaConsejo !== UNDEFINED) $row["fecha_consejo"] = $this->fechaConsejo("Y-m-d");
    if($this->insertado !== UNDEFINED) $row["insertado"] = $this->insertado("Y-m-d H:i:s");
    if($this->planillaDocente !== UNDEFINED) $row["planilla_docente"] = $this->planillaDocente();
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->fechaContralor)) return false;
    if(!Validation::is_empty($this->fechaConsejo)) return false;
    if(!Validation::is_empty($this->insertado)) return false;
    if(!Validation::is_empty($this->planillaDocente)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function fechaContralor($format = null) { return Format::date($this->fechaContralor, $format); }
  public function fechaConsejo($format = null) { return Format::date($this->fechaConsejo, $format); }
  public function insertado($format = null) { return Format::date($this->insertado, $format); }
  public function planillaDocente($format = null) { return Format::convertCase($this->planillaDocente, $format); }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkId($p); 
    if($check) $this->id = $p;
    return $check;
  }

  public function _setFechaContralor(DateTime $p = null) {
      $check = $this->checkFechaContralor($p); 
      if($check) $this->fechaContralor = $p;  
      return $check;      
  }

  public function setFechaContralor($p, $format = UNDEFINED) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    if(!is_null($p)) $p = ($format == UNDEFINED) ? SpanishDateTime::createFromDate($p) : SpanishDateTime::createFromFormat($format, $p);    
    $check = $this->checkFechaContralor($p); 
    if($check) $this->fechaContralor = $p;  
    return $check;
  }

  public function _setFechaConsejo(DateTime $p = null) {
      $check = $this->checkFechaConsejo($p); 
      if($check) $this->fechaConsejo = $p;  
      return $check;      
  }

  public function setFechaConsejo($p, $format = UNDEFINED) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    if(!is_null($p)) $p = ($format == UNDEFINED) ? SpanishDateTime::createFromDate($p) : SpanishDateTime::createFromFormat($format, $p);    
    $check = $this->checkFechaConsejo($p); 
    if($check) $this->fechaConsejo = $p;  
    return $check;
  }

  public function _setInsertado(DateTime $p = null) {
      $check = $this->checkInsertado($p); 
      if($check) $this->insertado = $p;  
      return $check;
  }

  public function setInsertado($p, $format = "Y-m-d H:i:s") {
    $p = ($p == DEFAULT_VALUE) ? date('Y-m-d H:i:s') : trim($p);
    if(!is_null($p)) $p = SpanishDateTime::createFromFormat($format, $p);    
    $check = $this->checkInsertado($p); 
    if($check) $this->insertado = $p;  
    return $check;
  }

  public function setPlanillaDocente($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkPlanillaDocente($p); 
    if($check) $this->planillaDocente = $p;
    return $check;
  }

  public function checkId($value) { 
      return true; 
  }

  public function checkFechaContralor($value) { 
    $v = Validation::getInstanceValue($value)->date();
    return $this->_setLogsValidation("fecha_contralor", $v);
  }

  public function checkFechaConsejo($value) { 
    $v = Validation::getInstanceValue($value)->date();
    return $this->_setLogsValidation("fecha_consejo", $v);
  }

  public function checkInsertado($value) { 
    $v = Validation::getInstanceValue($value)->date()->required();
    return $this->_setLogsValidation("insertado", $v);
  }

  public function checkPlanillaDocente($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("planilla_docente", $v);
  }



}
