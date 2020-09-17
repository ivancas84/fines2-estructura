<?php
require_once("class/model/entityOptions/Value.php");

class _PlanificacionValue extends ValueEntityOptions{

  protected $id = UNDEFINED;
  protected $anio = UNDEFINED;
  protected $semestre = UNDEFINED;
  protected $plan = UNDEFINED;

  public function setDefaultId() { if($this->id === UNDEFINED) $this->setId(uniqid()); }
  public function setDefaultAnio() { if($this->anio === UNDEFINED) $this->setAnio(null); }
  public function setDefaultSemestre() { if($this->semestre === UNDEFINED) $this->setSemestre(null); }
  public function setDefaultPlan() { if($this->plan === UNDEFINED) $this->setPlan(null); }

  public function isEmptyId() { if(!Validation::is_empty($this->id)) return false; }
  public function isEmptyAnio() { if(!Validation::is_empty($this->anio)) return false; }
  public function isEmptySemestre() { if(!Validation::is_empty($this->semestre)) return false; }
  public function isEmptyPlan() { if(!Validation::is_empty($this->plan)) return false; }

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

  public function checkId() { 
      if(Validation::is_undefined($this->id)) return null;
      return true; 
  }

  public function checkAnio() { 
      $this->_logs->resetLogs("anio");
      if(Validation::is_undefined($this->anio)) return null;
      $v = Validation::getInstanceValue($this->anio)->required()->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("anio", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkSemestre() { 
      $this->_logs->resetLogs("semestre");
      if(Validation::is_undefined($this->semestre)) return null;
      $v = Validation::getInstanceValue($this->semestre)->required()->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("semestre", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkPlan() { 
      $this->_logs->resetLogs("plan");
      if(Validation::is_undefined($this->plan)) return null;
      $v = Validation::getInstanceValue($this->plan)->required()->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("plan", "error", $error); }
      return $v->isSuccess();
    }
  
    public function sqlId() { return $this->sql->string($this->id); }
  public function sqlAnio() { return $this->sql->string($this->anio); }
  public function sqlSemestre() { return $this->sql->string($this->semestre); }
  public function sqlPlan() { return $this->sql->string($this->plan); }

  public function jsonId() { return $this->id; }
  public function jsonAnio() { return $this->anio; }
  public function jsonSemestre() { return $this->semestre; }
  public function jsonPlan() { return $this->plan; }



}
