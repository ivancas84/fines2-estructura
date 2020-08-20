<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _Plan extends EntityValues {
  protected $id = UNDEFINED;
  protected $orientacion = UNDEFINED;
  protected $resolucion = UNDEFINED;
  protected $distribucionHoraria = UNDEFINED;

  public function _setDefault(){
    if($this->id == UNDEFINED) $this->setId(null);
    if($this->orientacion == UNDEFINED) $this->setOrientacion(null);
    if($this->resolucion == UNDEFINED) $this->setResolucion(null);
    if($this->distribucionHoraria == UNDEFINED) $this->setDistribucionHoraria(null);
    return $this;
  }

  public function _fromArray(array $row = NULL, string $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."orientacion"])) $this->setOrientacion($row[$p."orientacion"]);
    if(isset($row[$p."resolucion"])) $this->setResolucion($row[$p."resolucion"]);
    if(isset($row[$p."distribucion_horaria"])) $this->setDistribucionHoraria($row[$p."distribucion_horaria"]);
    return $this;
  }

  public function _toArray(string $p = ""){
    $row = [];
    if($this->id !== UNDEFINED) $row[$p."id"] = $this->id();
    if($this->orientacion !== UNDEFINED) $row[$p."orientacion"] = $this->orientacion();
    if($this->resolucion !== UNDEFINED) $row[$p."resolucion"] = $this->resolucion();
    if($this->distribucionHoraria !== UNDEFINED) $row[$p."distribucion_horaria"] = $this->distribucionHoraria();
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

  public function setId($p) { $this->id = (is_null($p)) ? null : (string)$p; }
  public function setOrientacion($p) { $this->orientacion = (is_null($p)) ? null : (string)$p; }
  public function setResolucion($p) { $this->resolucion = (is_null($p)) ? null : (string)$p; }
  public function setDistribucionHoraria($p) { $this->distribucionHoraria = (is_null($p)) ? null : (string)$p; }

  public function resetOrientacion() { if(!Validation::is_empty($this->orientacion)) $this->orientacion = preg_replace('/\s\s+/', ' ', trim($this->orientacion)); }
  public function resetResolucion() { if(!Validation::is_empty($this->resolucion)) $this->resolucion = preg_replace('/\s\s+/', ' ', trim($this->resolucion)); }
  public function resetDistribucionHoraria() { if(!Validation::is_empty($this->distribucionHoraria)) $this->distribucionHoraria = preg_replace('/\s\s+/', ' ', trim($this->distribucionHoraria)); }

  public function checkId($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkOrientacion($value) { 
    $this->_logs->resetLogs("orientacion");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("orientacion", "error", $error); }
    return $v->isSuccess();
  }

  public function checkResolucion($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkDistribucionHoraria($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function _check(){
    $this->checkId($this->id);
    $this->checkOrientacion($this->orientacion);
    $this->checkResolucion($this->resolucion);
    $this->checkDistribucionHoraria($this->distribucionHoraria);
    return !$this->_getLogs()->isError();
  }

  public function _reset(){
    $this->resetOrientacion();
    $this->resetResolucion();
    $this->resetDistribucionHoraria();
    return $this;
  }



}
