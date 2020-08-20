<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _DistribucionHoraria extends EntityValues {
  protected $id = UNDEFINED;
  protected $horasCatedra = UNDEFINED;
  protected $dia = UNDEFINED;
  protected $asignatura = UNDEFINED;
  protected $planificacion = UNDEFINED;

  public function _setDefault(){
    if($this->id == UNDEFINED) $this->setId(null);
    if($this->horasCatedra == UNDEFINED) $this->setHorasCatedra(null);
    if($this->dia == UNDEFINED) $this->setDia(null);
    if($this->asignatura == UNDEFINED) $this->setAsignatura(null);
    if($this->planificacion == UNDEFINED) $this->setPlanificacion(null);
    return $this;
  }

  public function _fromArray(array $row = NULL, string $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."horas_catedra"])) $this->setHorasCatedra($row[$p."horas_catedra"]);
    if(isset($row[$p."dia"])) $this->setDia($row[$p."dia"]);
    if(isset($row[$p."asignatura"])) $this->setAsignatura($row[$p."asignatura"]);
    if(isset($row[$p."planificacion"])) $this->setPlanificacion($row[$p."planificacion"]);
    return $this;
  }

  public function _toArray(string $p = ""){
    $row = [];
    if($this->id !== UNDEFINED) $row[$p."id"] = $this->id();
    if($this->horasCatedra !== UNDEFINED) $row[$p."horas_catedra"] = $this->horasCatedra();
    if($this->dia !== UNDEFINED) $row[$p."dia"] = $this->dia();
    if($this->asignatura !== UNDEFINED) $row[$p."asignatura"] = $this->asignatura();
    if($this->planificacion !== UNDEFINED) $row[$p."planificacion"] = $this->planificacion();
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->horasCatedra)) return false;
    if(!Validation::is_empty($this->dia)) return false;
    if(!Validation::is_empty($this->asignatura)) return false;
    if(!Validation::is_empty($this->planificacion)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function horasCatedra() { return $this->horasCatedra; }
  public function dia() { return $this->dia; }
  public function asignatura($format = null) { return Format::convertCase($this->asignatura, $format); }
  public function planificacion($format = null) { return Format::convertCase($this->planificacion, $format); }

  public function setId($p) { $this->id = (is_null($p)) ? null : (string)$p; }
  public function setHorasCatedra($p) { $this->horasCatedra = (is_null($p)) ? null : intval($p); }
  public function setDia($p) { $this->dia = (is_null($p)) ? null : intval($p); }
  public function setAsignatura($p) { $this->asignatura = (is_null($p)) ? null : (string)$p; }
  public function setPlanificacion($p) { $this->planificacion = (is_null($p)) ? null : (string)$p; }


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

  public function checkDia($value) { 
    $this->_logs->resetLogs("dia");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("dia", "error", $error); }
    return $v->isSuccess();
  }

  public function checkAsignatura($value) { 
    $this->_logs->resetLogs("asignatura");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("asignatura", "error", $error); }
    return $v->isSuccess();
  }

  public function checkPlanificacion($value) { 
    $this->_logs->resetLogs("planificacion");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("planificacion", "error", $error); }
    return $v->isSuccess();
  }

  public function _check(){
    $this->checkId($this->id);
    $this->checkHorasCatedra($this->horasCatedra);
    $this->checkDia($this->dia);
    $this->checkAsignatura($this->asignatura);
    $this->checkPlanificacion($this->planificacion);
    return !$this->_getLogs()->isError();
  }

  public function _reset(){
    return $this;
  }



}
