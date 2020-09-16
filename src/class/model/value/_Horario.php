<?php
require_once("class/model/entityOptions/Value.php");

class _HorarioValue extends ValueEntityOptions{

  protected $id = UNDEFINED;
  protected $horaInicio = UNDEFINED;
  protected $horaFin = UNDEFINED;
  protected $curso = UNDEFINED;
  protected $dia = UNDEFINED;

  public function setDefaultId() { if($this->id === UNDEFINED) $this->setId(uniqid()); }
  public function setDefaultHoraInicio() { if($this->horaInicio === UNDEFINED) $this->setHoraInicio(null); }
  public function setDefaultHoraFin() { if($this->horaFin === UNDEFINED) $this->setHoraFin(null); }
  public function setDefaultCurso() { if($this->curso === UNDEFINED) $this->setCurso(null); }
  public function setDefaultDia() { if($this->dia === UNDEFINED) $this->setDia(null); }

  public function isEmptyId() { if(!Validation::is_empty($this->id)) return false; }
  public function isEmptyHoraInicio() { if(!Validation::is_empty($this->horaInicio)) return false; }
  public function isEmptyHoraFin() { if(!Validation::is_empty($this->horaFin)) return false; }
  public function isEmptyCurso() { if(!Validation::is_empty($this->curso)) return false; }
  public function isEmptyDia() { if(!Validation::is_empty($this->dia)) return false; }

  public function id() { return $this->id; }
  public function horaInicio($format = null) { return Format::date($this->horaInicio, $format); }
  public function horaFin($format = null) { return Format::date($this->horaFin, $format); }
  public function curso($format = null) { return Format::convertCase($this->curso, $format); }
  public function dia($format = null) { return Format::convertCase($this->dia, $format); }

  public function _setId(string $p = null) { return $this->id = $p; }  
  public function setId($p) { return $this->id = (is_null($p)) ? null : (string)$p; }

  public function _setHoraInicio(DateTime $p = null) { return $this->horaInicio = $p; }  

  public function setHoraInicio($p) {
    if(!is_null($p) && !($p instanceof DateTime)) $p = new SpanishDateTime($p);
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->horaInicio = $p;
  }

  public function _setHoraFin(DateTime $p = null) { return $this->horaFin = $p; }  

  public function setHoraFin($p) {
    if(!is_null($p) && !($p instanceof DateTime)) $p = new SpanishDateTime($p);
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->horaFin = $p;
  }

  public function _setCurso(string $p = null) { return $this->curso = $p; }  
  public function setCurso($p) { return $this->curso = (is_null($p)) ? null : (string)$p; }

  public function _setDia(string $p = null) { return $this->dia = $p; }  
  public function setDia($p) { return $this->dia = (is_null($p)) ? null : (string)$p; }


  public function checkId() { 
      if(Validation::is_undefined($this->id)) return null;
      return true; 
  }

  public function checkHoraInicio() { 
      $this->_logs->resetLogs("hora_inicio");
      if(Validation::is_undefined($this->horaInicio)) return null;
      $v = Validation::getInstanceValue($this->horaInicio)->required()->isA('DateTime');
      foreach($v->getErrors() as $error){ $this->_logs->addLog("hora_inicio", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkHoraFin() { 
      $this->_logs->resetLogs("hora_fin");
      if(Validation::is_undefined($this->horaFin)) return null;
      $v = Validation::getInstanceValue($this->horaFin)->required()->isA('DateTime');
      foreach($v->getErrors() as $error){ $this->_logs->addLog("hora_fin", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkCurso() { 
      $this->_logs->resetLogs("curso");
      if(Validation::is_undefined($this->curso)) return null;
      $v = Validation::getInstanceValue($this->curso)->required()->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("curso", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkDia() { 
      $this->_logs->resetLogs("dia");
      if(Validation::is_undefined($this->dia)) return null;
      $v = Validation::getInstanceValue($this->dia)->required()->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("dia", "error", $error); }
      return $v->isSuccess();
    }
  
    public function sqlId() { return $this->_sqlString($this->id); }
  public function sqlHoraInicio() { return $this->_sqlDateTime($this->horaInicio, "H:i:s"); }
  public function sqlHoraInicioHm() { return $this->_sqlDateTime($this->horaInicio, "H:i"); }
  public function sqlHoraFin() { return $this->_sqlDateTime($this->horaFin, "H:i:s"); }
  public function sqlHoraFinHm() { return $this->_sqlDateTime($this->horaFin, "H:i"); }
  public function sqlCurso() { return $this->_sqlString($this->curso); }
  public function sqlDia() { return $this->_sqlString($this->dia); }

  public function jsonId() { return $this->id; }
  public function jsonHoraInicio() { return $this->horaInicio('c'); }
  public function jsonHoraFin() { return $this->horaFin('c'); }
  public function jsonCurso() { return $this->curso; }
  public function jsonDia() { return $this->dia; }



}
