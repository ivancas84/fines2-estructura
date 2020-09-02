<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _Horario extends EntityValues {
  protected $id = UNDEFINED;
  protected $horaInicio = UNDEFINED;
  protected $horaFin = UNDEFINED;
  protected $curso = UNDEFINED;
  protected $dia = UNDEFINED;

  public function _setDefault(){
    if($this->id == UNDEFINED) $this->setId(uniqid());
    if($this->horaInicio == UNDEFINED) $this->setHoraInicio(null);
    if($this->horaFin == UNDEFINED) $this->setHoraFin(null);
    if($this->curso == UNDEFINED) $this->setCurso(null);
    if($this->dia == UNDEFINED) $this->setDia(null);
    return $this;
  }

  public function _fromArray(array $row = NULL, string $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."hora_inicio"])) $this->setHoraInicio($row[$p."hora_inicio"]);
    if(isset($row[$p."hora_fin"])) $this->setHoraFin($row[$p."hora_fin"]);
    if(isset($row[$p."curso"])) $this->setCurso($row[$p."curso"]);
    if(isset($row[$p."dia"])) $this->setDia($row[$p."dia"]);
    return $this;
  }

  public function _toArray(string $p = ""){
    $row = [];
    if($this->id !== UNDEFINED) $row[$p."id"] = $this->id();
    if($this->horaInicio !== UNDEFINED) $row[$p."hora_inicio"] = $this->horaInicio("c");
    if($this->horaFin !== UNDEFINED) $row[$p."hora_fin"] = $this->horaFin("c");
    if($this->curso !== UNDEFINED) $row[$p."curso"] = $this->curso();
    if($this->dia !== UNDEFINED) $row[$p."dia"] = $this->dia();
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->horaInicio)) return false;
    if(!Validation::is_empty($this->horaFin)) return false;
    if(!Validation::is_empty($this->curso)) return false;
    if(!Validation::is_empty($this->dia)) return false;
    return true;
  }

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



  public function checkId($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkHoraInicio($value) { 
    $this->_logs->resetLogs("hora_inicio");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required()->isA('DateTime');
    foreach($v->getErrors() as $error){ $this->_logs->addLog("hora_inicio", "error", $error); }
    return $v->isSuccess();
  }

  public function checkHoraFin($value) { 
    $this->_logs->resetLogs("hora_fin");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required()->isA('DateTime');
    foreach($v->getErrors() as $error){ $this->_logs->addLog("hora_fin", "error", $error); }
    return $v->isSuccess();
  }

  public function checkCurso($value) { 
    $this->_logs->resetLogs("curso");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required()->max(45);
    foreach($v->getErrors() as $error){ $this->_logs->addLog("curso", "error", $error); }
    return $v->isSuccess();
  }

  public function checkDia($value) { 
    $this->_logs->resetLogs("dia");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required()->max(45);
    foreach($v->getErrors() as $error){ $this->_logs->addLog("dia", "error", $error); }
    return $v->isSuccess();
  }

  public function _check(){
    $this->checkId($this->id);
    $this->checkHoraInicio($this->horaInicio);
    $this->checkHoraFin($this->horaFin);
    $this->checkCurso($this->curso);
    $this->checkDia($this->dia);
    return !$this->_getLogs()->isError();
  }

  public function _reset(){
    return $this;
  }



}
