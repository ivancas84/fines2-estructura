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
    $this->setId(DEFAULT_VALUE);
    $this->setHorasCatedra(DEFAULT_VALUE);
    $this->setDia(DEFAULT_VALUE);
    $this->setAsignatura(DEFAULT_VALUE);
    $this->setPlanificacion(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."horas_catedra"])) $this->setHorasCatedra($row[$p."horas_catedra"]);
    if(isset($row[$p."dia"])) $this->setDia($row[$p."dia"]);
    if(isset($row[$p."asignatura"])) $this->setAsignatura($row[$p."asignatura"]);
    if(isset($row[$p."planificacion"])) $this->setPlanificacion($row[$p."planificacion"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id();
    if($this->horasCatedra !== UNDEFINED) $row["horas_catedra"] = $this->horasCatedra();
    if($this->dia !== UNDEFINED) $row["dia"] = $this->dia();
    if($this->asignatura !== UNDEFINED) $row["asignatura"] = $this->asignatura();
    if($this->planificacion !== UNDEFINED) $row["planificacion"] = $this->planificacion();
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
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkId($p); 
    if($check) $this->id = $p;
    return $check;
  }

  public function setHorasCatedra($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $p = (is_null($p)) ? null : intval(trim($p));
    $check = $this->checkHorasCatedra($p); 
    if($check) $this->horasCatedra = $p;
    return $check;
  }

  public function setDia($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $p = (is_null($p)) ? null : intval(trim($p));
    $check = $this->checkDia($p); 
    if($check) $this->dia = $p;
    return $check;
  }

  public function setAsignatura($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkAsignatura($p); 
    if($check) $this->asignatura = $p;
    return $check;
  }

  public function setPlanificacion($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkPlanificacion($p); 
    if($check) $this->planificacion = $p;
    return $check;
  }

  public function checkId($value) { 
      return true; 
  }

  public function checkHorasCatedra($value) { 
    $v = Validation::getInstanceValue($value)->integer()->required();
    return $this->_setLogsValidation("horas_catedra", $v);
  }

  public function checkDia($value) { 
    $v = Validation::getInstanceValue($value)->integer()->required();
    return $this->_setLogsValidation("dia", $v);
  }

  public function checkAsignatura($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("asignatura", $v);
  }

  public function checkPlanificacion($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("planificacion", $v);
  }



}
