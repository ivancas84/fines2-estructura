<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _Plan extends EntityValues {
  protected $id = UNDEFINED;
  protected $orientacion = UNDEFINED;
  protected $resolucion = UNDEFINED;
  protected $distribucionHoraria = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setOrientacion(DEFAULT_VALUE);
    $this->setResolucion(DEFAULT_VALUE);
    $this->setDistribucionHoraria(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."orientacion"])) $this->setOrientacion($row[$p."orientacion"]);
    if(isset($row[$p."resolucion"])) $this->setResolucion($row[$p."resolucion"]);
    if(isset($row[$p."distribucion_horaria"])) $this->setDistribucionHoraria($row[$p."distribucion_horaria"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id();
    if($this->orientacion !== UNDEFINED) $row["orientacion"] = $this->orientacion();
    if($this->resolucion !== UNDEFINED) $row["resolucion"] = $this->resolucion();
    if($this->distribucionHoraria !== UNDEFINED) $row["distribucion_horaria"] = $this->distribucionHoraria();
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->orientacion)) return false;
    if(!Validation::is_empty($this->resolucion)) return false;
    if(!Validation::is_empty($this->distribucionHoraria)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function orientacion($format = null) { return Format::convertCase($this->orientacion, $format); }
  public function resolucion($format = null) { return Format::convertCase($this->resolucion, $format); }
  public function distribucionHoraria($format = null) { return Format::convertCase($this->distribucionHoraria, $format); }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkId($p); 
    if($check) $this->id = $p;
    return $check;
  }

  public function setOrientacion($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkOrientacion($p); 
    if($check) $this->orientacion = $p;
    return $check;
  }

  public function setResolucion($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkResolucion($p); 
    if($check) $this->resolucion = $p;
    return $check;
  }

  public function setDistribucionHoraria($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkDistribucionHoraria($p); 
    if($check) $this->distribucionHoraria = $p;
    return $check;
  }

  public function checkId($value) { 
      return true; 
  }

  public function checkOrientacion($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("orientacion", $v);
  }

  public function checkResolucion($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("resolucion", $v);
  }

  public function checkDistribucionHoraria($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("distribucion_horaria", $v);
  }



}
