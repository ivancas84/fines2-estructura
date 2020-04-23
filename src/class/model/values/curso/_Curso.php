<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _Curso extends EntityValues {
  protected $id = UNDEFINED;
  protected $horasCatedra = UNDEFINED;
  protected $alta = UNDEFINED;
  protected $comision = UNDEFINED;
  protected $asignatura = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setHorasCatedra(DEFAULT_VALUE);
    $this->setAlta(DEFAULT_VALUE);
    $this->setComision(DEFAULT_VALUE);
    $this->setAsignatura(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."horas_catedra"])) $this->setHorasCatedra($row[$p."horas_catedra"]);
    if(isset($row[$p."alta"])) $this->setAlta($row[$p."alta"]);
    if(isset($row[$p."comision"])) $this->setComision($row[$p."comision"]);
    if(isset($row[$p."asignatura"])) $this->setAsignatura($row[$p."asignatura"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id();
    if($this->horasCatedra !== UNDEFINED) $row["horas_catedra"] = $this->horasCatedra();
    if($this->alta !== UNDEFINED) $row["alta"] = $this->alta("Y-m-d H:i:s");
    if($this->comision !== UNDEFINED) $row["comision"] = $this->comision();
    if($this->asignatura !== UNDEFINED) $row["asignatura"] = $this->asignatura();
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->horasCatedra)) return false;
    if(!Validation::is_empty($this->alta)) return false;
    if(!Validation::is_empty($this->comision)) return false;
    if(!Validation::is_empty($this->asignatura)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function horasCatedra() { return $this->horasCatedra; }
  public function alta($format = null) { return Format::date($this->alta, $format); }
  public function comision($format = null) { return Format::convertCase($this->comision, $format); }
  public function asignatura($format = null) { return Format::convertCase($this->asignatura, $format); }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkId($p); 
    if($check) $this->id = $p;
    return $check;
  }

  public function setHorasCatedra($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $p = (is_null($p)) ? null : intval(trim($p));
    $check = $this->checkHorasCatedra($p); 
    if($check) $this->horasCatedra = $p;
    return $check;
  }

  public function _setAlta(DateTime $p = null) {
      $check = $this->checkAlta($p); 
      if($check) $this->alta = $p;  
      return $check;
  }

  public function setAlta($p, $format = "Y-m-d H:i:s") {
    $p = ($p == DEFAULT_VALUE) ? 'current_timestamp()' : trim($p);
    if(!is_null($p)) $p = SpanishDateTime::createFromFormat($format, $p);    
    $check = $this->checkAlta($p); 
    if($check) $this->alta = $p;  
    return $check;
  }

  public function setComision($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkComision($p); 
    if($check) $this->comision = $p;
    return $check;
  }

  public function setAsignatura($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkAsignatura($p); 
    if($check) $this->asignatura = $p;
    return $check;
  }

  public function checkId($value) { 
      return true; 
  }

  public function checkHorasCatedra($value) { 
    $v = Validation::getInstanceValue($value)->integer()->required();
    return $this->_setLogsValidation("horas_catedra", $v);
  }

  public function checkAlta($value) { 
    $v = Validation::getInstanceValue($value)->date()->required();
    return $this->_setLogsValidation("alta", $v);
  }

  public function checkComision($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("comision", $v);
  }

  public function checkAsignatura($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("asignatura", $v);
  }



}
