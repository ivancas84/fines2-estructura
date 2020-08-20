<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _Curso extends EntityValues {
  protected $id = UNDEFINED;
  protected $horasCatedra = UNDEFINED;
  protected $alta = UNDEFINED;
  protected $comision = UNDEFINED;
  protected $asignatura = UNDEFINED;

  public function _setDefault(){
    if($this->id == UNDEFINED) $this->setId(null);
    if($this->horasCatedra == UNDEFINED) $this->setHorasCatedra(null);
    if($this->alta == UNDEFINED) $this->setAlta(date('c'));
    if($this->comision == UNDEFINED) $this->setComision(null);
    if($this->asignatura == UNDEFINED) $this->setAsignatura(null);
    return $this;
  }

  public function _fromArray(array $row = NULL, string $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."horas_catedra"])) $this->setHorasCatedra($row[$p."horas_catedra"]);
    if(isset($row[$p."alta"])) $this->setAlta($row[$p."alta"]);
    if(isset($row[$p."comision"])) $this->setComision($row[$p."comision"]);
    if(isset($row[$p."asignatura"])) $this->setAsignatura($row[$p."asignatura"]);
    return $this;
  }

  public function _toArray(string $p = ""){
    $row = [];
    if($this->id !== UNDEFINED) $row[$p."id"] = $this->id();
    if($this->horasCatedra !== UNDEFINED) $row[$p."horas_catedra"] = $this->horasCatedra();
    if($this->alta !== UNDEFINED) $row[$p."alta"] = $this->alta("c");
    if($this->comision !== UNDEFINED) $row[$p."comision"] = $this->comision();
    if($this->asignatura !== UNDEFINED) $row[$p."asignatura"] = $this->asignatura();
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->horasCatedra)) return false;
    if(!Validation::is_empty($this->alta)) return false;
    if(!Validation::is_empty($this->comision)) return false;
    if(!Validation::is_empty($this->asignatura)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function horasCatedra() { return $this->horasCatedra; }
  public function alta($format = null) { return Format::date($this->alta, $format); }
  public function comision($format = null) { return Format::convertCase($this->comision, $format); }
  public function asignatura($format = null) { return Format::convertCase($this->asignatura, $format); }

  public function setId($p) { $this->id = (is_null($p)) ? null : (string)$p; }
  public function setHorasCatedra($p) { $this->horasCatedra = (is_null($p)) ? null : intval($p); }
  public function _setAlta(DateTime $p = null) { $this->alta = $p; }

  public function setAlta($p) {
    if(!is_null($p)) {
      $p = new SpanishDateTime($p);    
      if($p) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    }
    $this->alta = $p;  
  }

  public function setComision($p) { $this->comision = (is_null($p)) ? null : (string)$p; }
  public function setAsignatura($p) { $this->asignatura = (is_null($p)) ? null : (string)$p; }


  public function checkId($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkHorasCatedra($value) { 
    $this->_logs->resetLogs("horas_catedra");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("horas_catedra", "error", $error); }
    return $v->isSuccess();
  }

  public function checkAlta($value) { 
    $this->_logs->resetLogs("alta");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("alta", "error", $error); }
    return $v->isSuccess();
  }

  public function checkComision($value) { 
    $this->_logs->resetLogs("comision");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("comision", "error", $error); }
    return $v->isSuccess();
  }

  public function checkAsignatura($value) { 
    $this->_logs->resetLogs("asignatura");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("asignatura", "error", $error); }
    return $v->isSuccess();
  }

  public function _check(){
    $this->checkId($this->id);
    $this->checkHorasCatedra($this->horasCatedra);
    $this->checkAlta($this->alta);
    $this->checkComision($this->comision);
    $this->checkAsignatura($this->asignatura);
    return !$this->_getLogs()->isError();
  }

  public function _reset(){
    return $this;
  }



}
