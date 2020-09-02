<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _Planificacion extends EntityValues {
  protected $id = UNDEFINED;
  protected $anio = UNDEFINED;
  protected $semestre = UNDEFINED;
  protected $plan = UNDEFINED;

  public function _setDefault(){
    if($this->id == UNDEFINED) $this->setId(uniqid());
    if($this->anio == UNDEFINED) $this->setAnio(null);
    if($this->semestre == UNDEFINED) $this->setSemestre(null);
    if($this->plan == UNDEFINED) $this->setPlan(null);
    return $this;
  }

  public function _fromArray(array $row = NULL, string $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."anio"])) $this->setAnio($row[$p."anio"]);
    if(isset($row[$p."semestre"])) $this->setSemestre($row[$p."semestre"]);
    if(isset($row[$p."plan"])) $this->setPlan($row[$p."plan"]);
    return $this;
  }

  public function _toArray(string $p = ""){
    $row = [];
    if($this->id !== UNDEFINED) $row[$p."id"] = $this->id();
    if($this->anio !== UNDEFINED) $row[$p."anio"] = $this->anio();
    if($this->semestre !== UNDEFINED) $row[$p."semestre"] = $this->semestre();
    if($this->plan !== UNDEFINED) $row[$p."plan"] = $this->plan();
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->anio)) return false;
    if(!Validation::is_empty($this->semestre)) return false;
    if(!Validation::is_empty($this->plan)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function anio($format = null) { return Format::convertCase($this->anio, $format); }
  public function semestre($format = null) { return Format::convertCase($this->semestre, $format); }
  public function plan($format = null) { return Format::convertCase($this->plan, $format); }

  public function _setId(string $p = null) { return $this->id = $p; }  
  public function setId($p) { return $this->id = (is_null($p)) ? null : (string)$p; }

  public function _setAnio(string $p = null) { return $this->anio = $p; }  
  public function setAnio($p) { return $this->anio = (is_null($p)) ? null : (string)$p; }

  public function _setSemestre(string $p = null) { return $this->semestre = $p; }  
  public function setSemestre($p) { return $this->semestre = (is_null($p)) ? null : (string)$p; }

  public function _setPlan(string $p = null) { return $this->plan = $p; }  
  public function setPlan($p) { return $this->plan = (is_null($p)) ? null : (string)$p; }


  public function resetAnio() { if(!Validation::is_empty($this->anio)) $this->anio = preg_replace('/\s\s+/', ' ', trim($this->anio)); }
  public function resetSemestre() { if(!Validation::is_empty($this->semestre)) $this->semestre = preg_replace('/\s\s+/', ' ', trim($this->semestre)); }

  public function checkId($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkAnio($value) { 
    $this->_logs->resetLogs("anio");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required()->max(45);
    foreach($v->getErrors() as $error){ $this->_logs->addLog("anio", "error", $error); }
    return $v->isSuccess();
  }

  public function checkSemestre($value) { 
    $this->_logs->resetLogs("semestre");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required()->max(45);
    foreach($v->getErrors() as $error){ $this->_logs->addLog("semestre", "error", $error); }
    return $v->isSuccess();
  }

  public function checkPlan($value) { 
    $this->_logs->resetLogs("plan");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required()->max(45);
    foreach($v->getErrors() as $error){ $this->_logs->addLog("plan", "error", $error); }
    return $v->isSuccess();
  }

  public function _check(){
    $this->checkId($this->id);
    $this->checkAnio($this->anio);
    $this->checkSemestre($this->semestre);
    $this->checkPlan($this->plan);
    return !$this->_getLogs()->isError();
  }

  public function _reset(){
    $this->resetAnio();
    $this->resetSemestre();
    return $this;
  }



}
