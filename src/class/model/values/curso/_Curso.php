<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _Curso extends EntityValues {
  protected $id = UNDEFINED;
  protected $alta = UNDEFINED;
  protected $horario = UNDEFINED;
  protected $comision = UNDEFINED;
  protected $cargaHoraria = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setAlta(DEFAULT_VALUE);
    $this->setHorario(DEFAULT_VALUE);
    $this->setComision(DEFAULT_VALUE);
    $this->setCargaHoraria(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."alta"])) $this->setAlta($row[$p."alta"]);
    if(isset($row[$p."horario"])) $this->setHorario($row[$p."horario"]);
    if(isset($row[$p."comision"])) $this->setComision($row[$p."comision"]);
    if(isset($row[$p."carga_horaria"])) $this->setCargaHoraria($row[$p."carga_horaria"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id("");
    if($this->alta !== UNDEFINED) $row["alta"] = $this->alta("Y-m-d h:i:s");
    if($this->horario !== UNDEFINED) $row["horario"] = $this->horario("");
    if($this->comision !== UNDEFINED) $row["comision"] = $this->comision("");
    if($this->cargaHoraria !== UNDEFINED) $row["carga_horaria"] = $this->cargaHoraria("");
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->alta)) return false;
    if(!Validation::is_empty($this->horario)) return false;
    if(!Validation::is_empty($this->comision)) return false;
    if(!Validation::is_empty($this->cargaHoraria)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function alta($format = null) { return Format::date($this->alta, $format); }
  public function horario($format = null) { return Format::convertCase($this->horario, $format); }
  public function comision($format = null) { return Format::convertCase($this->comision, $format); }
  public function cargaHoraria($format = null) { return Format::convertCase($this->cargaHoraria, $format); }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkId($p)) $this->id = $p;
  }

  public function _setAlta(DateTime $p = null) {
      if($this->checkAlta($p)) $this->alta = $p;  
  }

  public function setAlta($p, $format = "Y-m-d H:i:s") {
    $p = ($p == DEFAULT_VALUE) ? date('Y-m-d H:i:s') : trim($p);
    if(!is_null($p)) {
      $p = SpanishDateTime::createFromFormat($format, $p);
    }
    if($this->checkAlta($p)) $this->alta = $p;
  }

  public function setHorario($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkHorario($p)) $this->horario = $p;
  }

  public function setComision($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkComision($p)) $this->comision = $p;
  }

  public function setCargaHoraria($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkCargaHoraria($p)) $this->cargaHoraria = $p;
  }

  public function checkId($value) { 
      return true; 
  }

  public function checkAlta($value) { 
    $v = Validation::getInstanceValue($value)->date()->required();
    return $this->_setLogsValidation("alta", $v);
  }

  public function checkHorario($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("horario", $v);
  }

  public function checkComision($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("comision", $v);
  }

  public function checkCargaHoraria($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("carga_horaria", $v);
  }



}
