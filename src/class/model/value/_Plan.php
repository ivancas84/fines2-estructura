<?php
require_once("class/model/entityOptions/Value.php");

class _PlanValue extends ValueEntityOptions{

  protected $id = UNDEFINED;
  protected $orientacion = UNDEFINED;
  protected $resolucion = UNDEFINED;
  protected $distribucionHoraria = UNDEFINED;

  public function setDefaultId() { if($this->id === UNDEFINED) $this->setId(uniqid()); }
  public function setDefaultOrientacion() { if($this->orientacion === UNDEFINED) $this->setOrientacion(null); }
  public function setDefaultResolucion() { if($this->resolucion === UNDEFINED) $this->setResolucion(null); }
  public function setDefaultDistribucionHoraria() { if($this->distribucionHoraria === UNDEFINED) $this->setDistribucionHoraria(null); }

  public function isEmptyId() { if(!Validation::is_empty($this->id)) return false; }
  public function isEmptyOrientacion() { if(!Validation::is_empty($this->orientacion)) return false; }
  public function isEmptyResolucion() { if(!Validation::is_empty($this->resolucion)) return false; }
  public function isEmptyDistribucionHoraria() { if(!Validation::is_empty($this->distribucionHoraria)) return false; }

  public function id() { return $this->id; }
  public function orientacion($format = null) { return Format::convertCase($this->orientacion, $format); }
  public function resolucion($format = null) { return Format::convertCase($this->resolucion, $format); }
  public function distribucionHoraria($format = null) { return Format::convertCase($this->distribucionHoraria, $format); }

  public function _setId(string $p = null) { return $this->id = $p; }  
  public function setId($p) { return $this->id = (is_null($p)) ? null : (string)$p; }

  public function _setOrientacion(string $p = null) { return $this->orientacion = $p; }  
  public function setOrientacion($p) { return $this->orientacion = (is_null($p)) ? null : (string)$p; }

  public function _setResolucion(string $p = null) { return $this->resolucion = $p; }  
  public function setResolucion($p) { return $this->resolucion = (is_null($p)) ? null : (string)$p; }

  public function _setDistribucionHoraria(string $p = null) { return $this->distribucionHoraria = $p; }  
  public function setDistribucionHoraria($p) { return $this->distribucionHoraria = (is_null($p)) ? null : (string)$p; }

  public function resetOrientacion() { if(!Validation::is_empty($this->orientacion)) $this->orientacion = preg_replace('/\s\s+/', ' ', trim($this->orientacion)); }
  public function resetResolucion() { if(!Validation::is_empty($this->resolucion)) $this->resolucion = preg_replace('/\s\s+/', ' ', trim($this->resolucion)); }
  public function resetDistribucionHoraria() { if(!Validation::is_empty($this->distribucionHoraria)) $this->distribucionHoraria = preg_replace('/\s\s+/', ' ', trim($this->distribucionHoraria)); }

  public function checkId() { 
      if(Validation::is_undefined($this->id)) return null;
      return true; 
  }

  public function checkOrientacion() { 
    $this->_logs->resetLogs("orientacion");
    if(Validation::is_undefined($this->orientacion)) return null;
    $v = Validation::getInstanceValue($this->orientacion)->required()->max(45);
    foreach($v->getErrors() as $error){ $this->_logs->addLog("orientacion", "error", $error); }
    return $v->isSuccess();
  }

  public function checkResolucion() { 
    $this->_logs->resetLogs("resolucion");
    if(Validation::is_undefined($this->resolucion)) return null;
    $v = Validation::getInstanceValue($this->resolucion)->max(45);
    foreach($v->getErrors() as $error){ $this->_logs->addLog("resolucion", "error", $error); }
    return $v->isSuccess();
  }

  public function checkDistribucionHoraria() { 
    $this->_logs->resetLogs("distribucion_horaria");
    if(Validation::is_undefined($this->distribucionHoraria)) return null;
    $v = Validation::getInstanceValue($this->distribucionHoraria)->max(45);
    foreach($v->getErrors() as $error){ $this->_logs->addLog("distribucion_horaria", "error", $error); }
    return $v->isSuccess();
  }

  public function sqlId() { return $this->_sqlString($this->id); }
  public function sqlOrientacion() { return $this->_sqlString($this->orientacion); }
  public function sqlResolucion() { return $this->_sqlString($this->resolucion); }
  public function sqlDistribucionHoraria() { return $this->_sqlString($this->distribucionHoraria); }

  public function jsonId() { return $this->id; }
  public function jsonOrientacion() { return $this->orientacion; }
  public function jsonResolucion() { return $this->resolucion; }
  public function jsonDistribucionHoraria() { return $this->distribucionHoraria; }



}
