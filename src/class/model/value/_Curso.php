<?php
require_once("class/model/entityOptions/Value.php");

class _CursoValue extends ValueEntityOptions{

  protected $id = UNDEFINED;
  protected $horasCatedra = UNDEFINED;
  protected $alta = UNDEFINED;
  protected $comision = UNDEFINED;
  protected $asignatura = UNDEFINED;

  public function setDefaultId() { if($this->id === UNDEFINED) $this->setId(uniqid()); }
  public function setDefaultHorasCatedra() { if($this->horasCatedra === UNDEFINED) $this->setHorasCatedra(null); }
  public function setDefaultAlta() { if($this->alta === UNDEFINED) $this->setAlta(date('c')); }
  public function setDefaultComision() { if($this->comision === UNDEFINED) $this->setComision(null); }
  public function setDefaultAsignatura() { if($this->asignatura === UNDEFINED) $this->setAsignatura(null); }

  public function isEmptyId() { if(!Validation::is_empty($this->id)) return false; }
  public function isEmptyHorasCatedra() { if(!Validation::is_empty($this->horasCatedra)) return false; }
  public function isEmptyAlta() { if(!Validation::is_empty($this->alta)) return false; }
  public function isEmptyComision() { if(!Validation::is_empty($this->comision)) return false; }
  public function isEmptyAsignatura() { if(!Validation::is_empty($this->asignatura)) return false; }

  public function id() { return $this->id; }
  public function horasCatedra() { return $this->horasCatedra; }
  public function alta($format = null) { return Format::date($this->alta, $format); }
  public function comision($format = null) { return Format::convertCase($this->comision, $format); }
  public function asignatura($format = null) { return Format::convertCase($this->asignatura, $format); }

  public function _setId(string $p = null) { return $this->id = $p; }  
  public function setId($p) { return $this->id = (is_null($p)) ? null : (string)$p; }

  public function _setHorasCatedra(integer $p = null) { return $this->horasCatedra = $p; }    
  public function setHorasCatedra($p) { return $this->horasCatedra = (is_null($p)) ? null : intval($p); }

  public function _setAlta(DateTime $p = null) { return $this->alta = $p; }  

  public function setAlta($p) {
    if(!is_null($p) && !($p instanceof DateTime)) $p = new SpanishDateTime($p);
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->alta = $p;
  }

  public function setAltaY($p) {
    if(!is_null($p) && !($p instanceof DateTime)) {
      $p = (strlen($p) == 4) ? SpanishDateTime::createFromFormat('Y', $p) : new SpanishDateTime($p);
    }
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->alta = $p;
  }

  public function _setComision(string $p = null) { return $this->comision = $p; }  
  public function setComision($p) { return $this->comision = (is_null($p)) ? null : (string)$p; }

  public function _setAsignatura(string $p = null) { return $this->asignatura = $p; }  
  public function setAsignatura($p) { return $this->asignatura = (is_null($p)) ? null : (string)$p; }

  public function resetId() { if(!Validation::is_empty($this->id)) $this->id = preg_replace('/\s\s+/', ' ', trim($this->id)); }
  public function resetComision() { if(!Validation::is_empty($this->comision)) $this->comision = preg_replace('/\s\s+/', ' ', trim($this->comision)); }
  public function resetAsignatura() { if(!Validation::is_empty($this->asignatura)) $this->asignatura = preg_replace('/\s\s+/', ' ', trim($this->asignatura)); }

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
  
    public function checkAlta() { 
      $this->_logs->resetLogs("alta");
      if(Validation::is_undefined($this->alta)) return null;
      $v = Validation::getInstanceValue($this->alta)->required()->isA('DateTime');
      foreach($v->getErrors() as $error){ $this->_logs->addLog("alta", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkComision() { 
      $this->_logs->resetLogs("comision");
      if(Validation::is_undefined($this->comision)) return null;
      $v = Validation::getInstanceValue($this->comision)->required()->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("comision", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkAsignatura() { 
      $this->_logs->resetLogs("asignatura");
      if(Validation::is_undefined($this->asignatura)) return null;
      $v = Validation::getInstanceValue($this->asignatura)->required()->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("asignatura", "error", $error); }
      return $v->isSuccess();
    }
  
    public function sqlId() { return $this->sql->string($this->id); }
  public function sqlHorasCatedra() { return $this->sql->Number($this->horasCatedra); }
  public function sqlAlta() { return $this->sql->dateTime($this->alta, "Y-m-d H:i:s"); }
  public function sqlAltaDate() { return $this->sql->dateTime($this->alta, "Y-m-d"); }
  public function sqlAltaYm() { return $this->sql->dateTime($this->alta, "Y-m"); }
  public function sqlAltaY() { return $this->sql->dateTime($this->alta, "Y"); }
  public function sqlComision() { return $this->sql->string($this->comision); }
  public function sqlAsignatura() { return $this->sql->string($this->asignatura); }

  public function jsonId() { return $this->id; }
  public function jsonHorasCatedra() { return $this->horasCatedra; }
  public function jsonAlta() { return $this->alta('c'); }
  public function jsonComision() { return $this->comision; }
  public function jsonAsignatura() { return $this->asignatura; }



}
