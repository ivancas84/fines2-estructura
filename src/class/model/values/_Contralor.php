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
    if($this->id == UNDEFINED) $this->setId(null);
    if($this->fechaContralor == UNDEFINED) $this->setFechaContralor(null);
    if($this->fechaConsejo == UNDEFINED) $this->setFechaConsejo(null);
    if($this->insertado == UNDEFINED) $this->setInsertado(date('c'));
    if($this->planillaDocente == UNDEFINED) $this->setPlanillaDocente(null);
    return $this;
  }

  public function _fromArray(array $row = NULL, string $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."fecha_contralor"])) $this->setFechaContralor($row[$p."fecha_contralor"]);
    if(isset($row[$p."fecha_consejo"])) $this->setFechaConsejo($row[$p."fecha_consejo"]);
    if(isset($row[$p."insertado"])) $this->setInsertado($row[$p."insertado"]);
    if(isset($row[$p."planilla_docente"])) $this->setPlanillaDocente($row[$p."planilla_docente"]);
    return $this;
  }

  public function _toArray(string $p = ""){
    $row = [];
    if($this->id !== UNDEFINED) $row[$p."id"] = $this->id();
    if($this->fechaContralor !== UNDEFINED) $row[$p."fecha_contralor"] = $this->fechaContralor("c");
    if($this->fechaConsejo !== UNDEFINED) $row[$p."fecha_consejo"] = $this->fechaConsejo("c");
    if($this->insertado !== UNDEFINED) $row[$p."insertado"] = $this->insertado("c");
    if($this->planillaDocente !== UNDEFINED) $row[$p."planilla_docente"] = $this->planillaDocente();
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

  public function setId($p) { $this->id = (is_null($p)) ? null : (string)$p; }
  public function _setFechaContralor(DateTime $p = null) { $this->fechaContralor = $p; }

  public function setFechaContralor($p) {
    if(!is_null($p)) {
      $p = new SpanishDateTime($p);
      if($p) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
      $p->setTime(0,0,0);
    }
    $this->fechaContralor = $p;
  }

  public function _setFechaConsejo(DateTime $p = null) { $this->fechaConsejo = $p; }

  public function setFechaConsejo($p) {
    if(!is_null($p)) {
      $p = new SpanishDateTime($p);
      if($p) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
      $p->setTime(0,0,0);
    }
    $this->fechaConsejo = $p;
  }

  public function _setInsertado(DateTime $p = null) { $this->insertado = $p; }

  public function setInsertado($p) {
    if(!is_null($p)) {
      $p = new SpanishDateTime($p);    
      if($p) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    }
    $this->insertado = $p;  
  }

  public function setPlanillaDocente($p) { $this->planillaDocente = (is_null($p)) ? null : (string)$p; }


  public function checkId($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkFechaContralor($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkFechaConsejo($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkInsertado($value) { 
    $this->_logs->resetLogs("insertado");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("insertado", "error", $error); }
    return $v->isSuccess();
  }

  public function checkPlanillaDocente($value) { 
    $this->_logs->resetLogs("planilla_docente");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("planilla_docente", "error", $error); }
    return $v->isSuccess();
  }

  public function _check(){
    $this->checkId($this->id);
    $this->checkFechaContralor($this->fechaContralor);
    $this->checkFechaConsejo($this->fechaConsejo);
    $this->checkInsertado($this->insertado);
    $this->checkPlanillaDocente($this->planillaDocente);
    return !$this->_getLogs()->isError();
  }

  public function _reset(){
    return $this;
  }



}
