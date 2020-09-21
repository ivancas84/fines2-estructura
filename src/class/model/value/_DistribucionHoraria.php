<?php
require_once("class/model/entityOptions/Value.php");

class _DistribucionHorariaValue extends ValueEntityOptions{

  protected $id = UNDEFINED;
  protected $horasCatedra = UNDEFINED;
  protected $dia = UNDEFINED;
  protected $asignatura = UNDEFINED;
  protected $planificacion = UNDEFINED;

  public function setDefaultId() { if($this->id === UNDEFINED) $this->setId(uniqid()); }
  public function setDefaultHorasCatedra() { if($this->horasCatedra === UNDEFINED) $this->setHorasCatedra(null); }
  public function setDefaultDia() { if($this->dia === UNDEFINED) $this->setDia(null); }
  public function setDefaultAsignatura() { if($this->asignatura === UNDEFINED) $this->setAsignatura(null); }
  public function setDefaultPlanificacion() { if($this->planificacion === UNDEFINED) $this->setPlanificacion(null); }

  public function isEmptyId() { if(!Validation::is_empty($this->id)) return false; }
  public function isEmptyHorasCatedra() { if(!Validation::is_empty($this->horasCatedra)) return false; }
  public function isEmptyDia() { if(!Validation::is_empty($this->dia)) return false; }
  public function isEmptyAsignatura() { if(!Validation::is_empty($this->asignatura)) return false; }
  public function isEmptyPlanificacion() { if(!Validation::is_empty($this->planificacion)) return false; }

  public function id() { return $this->id; }
  public function horasCatedra() { return $this->horasCatedra; }
  public function dia() { return $this->dia; }
  public function asignatura($format = null) { return Format::convertCase($this->asignatura, $format); }
  public function planificacion($format = null) { return Format::convertCase($this->planificacion, $format); }

  public function _setId(string $p = null) { return $this->id = $p; }  
  public function setId($p) { return $this->id = (is_null($p)) ? null : (string)$p; }

  public function _setHorasCatedra(integer $p = null) { return $this->horasCatedra = $p; }    
  public function setHorasCatedra($p) { return $this->horasCatedra = (is_null($p)) ? null : intval($p); }

  public function _setDia(integer $p = null) { return $this->dia = $p; }    
  public function setDia($p) { return $this->dia = (is_null($p)) ? null : intval($p); }

  public function _setAsignatura(string $p = null) { return $this->asignatura = $p; }  
  public function setAsignatura($p) { return $this->asignatura = (is_null($p)) ? null : (string)$p; }

  public function _setPlanificacion(string $p = null) { return $this->planificacion = $p; }  
  public function setPlanificacion($p) { return $this->planificacion = (is_null($p)) ? null : (string)$p; }

  public function resetId() { if(!Validation::is_empty($this->id)) $this->id = preg_replace('/\s\s+/', ' ', trim($this->id)); }
  public function resetAsignatura() { if(!Validation::is_empty($this->asignatura)) $this->asignatura = preg_replace('/\s\s+/', ' ', trim($this->asignatura)); }
  public function resetPlanificacion() { if(!Validation::is_empty($this->planificacion)) $this->planificacion = preg_replace('/\s\s+/', ' ', trim($this->planificacion)); }

  public function checkId() { 
      if(Validation::is_undefined($this->id)) return null;
      return true; 
  }

  public function checkHorasCatedra() { 
      $this->_logs->resetLogs("horas_catedra");
      if(Validation::is_undefined($this->horasCatedra)) return null;
      $v = Validation::getInstanceValue($this->horasCatedra)->required()->max(10);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("horas_catedra", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkDia() { 
      $this->_logs->resetLogs("dia");
      if(Validation::is_undefined($this->dia)) return null;
      $v = Validation::getInstanceValue($this->dia)->required()->max(10);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("dia", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkAsignatura() { 
      $this->_logs->resetLogs("asignatura");
      if(Validation::is_undefined($this->asignatura)) return null;
      $v = Validation::getInstanceValue($this->asignatura)->required()->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("asignatura", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkPlanificacion() { 
      $this->_logs->resetLogs("planificacion");
      if(Validation::is_undefined($this->planificacion)) return null;
      $v = Validation::getInstanceValue($this->planificacion)->required()->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("planificacion", "error", $error); }
      return $v->isSuccess();
    }
  
    public function sqlId() { return $this->sql->string($this->id); }
  public function sqlHorasCatedra() { return $this->sql->Number($this->horasCatedra); }
  public function sqlDia() { return $this->sql->Number($this->dia); }
  public function sqlAsignatura() { return $this->sql->string($this->asignatura); }
  public function sqlPlanificacion() { return $this->sql->string($this->planificacion); }

  public function jsonId() { return $this->id; }
  public function jsonHorasCatedra() { return $this->horasCatedra; }
  public function jsonDia() { return $this->dia; }
  public function jsonAsignatura() { return $this->asignatura; }
  public function jsonPlanificacion() { return $this->planificacion; }



}
