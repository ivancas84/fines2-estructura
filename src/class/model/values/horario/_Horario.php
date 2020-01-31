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
    $this->setId(DEFAULT_VALUE);
    $this->setHoraInicio(DEFAULT_VALUE);
    $this->setHoraFin(DEFAULT_VALUE);
    $this->setCurso(DEFAULT_VALUE);
    $this->setDia(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."hora_inicio"])) $this->setHoraInicio($row[$p."hora_inicio"]);
    if(isset($row[$p."hora_fin"])) $this->setHoraFin($row[$p."hora_fin"]);
    if(isset($row[$p."curso"])) $this->setCurso($row[$p."curso"]);
    if(isset($row[$p."dia"])) $this->setDia($row[$p."dia"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id("");
    if($this->horaInicio !== UNDEFINED) $row["hora_inicio"] = $this->horaInicio("h:i:s");
    if($this->horaFin !== UNDEFINED) $row["hora_fin"] = $this->horaFin("h:i:s");
    if($this->curso !== UNDEFINED) $row["curso"] = $this->curso("");
    if($this->dia !== UNDEFINED) $row["dia"] = $this->dia("");
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
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkId($p)) $this->id = $p;
  }

  public function _setHoraInicio(DateTime $p = null) {
      if($this->checkHoraInicio($p)) $this->horaInicio = $p;  
  }

  public function setHoraInicio($p, $format = "H:i:s") {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    if(!is_null($p)) {
      $p = SpanishDateTime::createFromFormat($format, $p);
    }
    if($this->checkHoraInicio($p)) $this->horaInicio = $p;
  }

  public function _setHoraFin(DateTime $p = null) {
      if($this->checkHoraFin($p)) $this->horaFin = $p;  
  }

  public function setHoraFin($p, $format = "H:i:s") {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    if(!is_null($p)) {
      $p = SpanishDateTime::createFromFormat($format, $p);
    }
    if($this->checkHoraFin($p)) $this->horaFin = $p;
  }

  public function setCurso($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkCurso($p)) $this->curso = $p;
  }

  public function setDia($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkDia($p)) $this->dia = $p;
  }

  public function checkId($value) { 
      return true; 
  }

  public function checkHoraInicio($value) { 
    $v = Validation::getInstanceValue($value)->date()->required();
    return $this->_setLogsValidation("hora_inicio", $v);
  }

  public function checkHoraFin($value) { 
    $v = Validation::getInstanceValue($value)->date()->required();
    return $this->_setLogsValidation("hora_fin", $v);
  }

  public function checkCurso($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("curso", $v);
  }

  public function checkDia($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("dia", $v);
  }



}
