<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _CargaHoraria extends EntityValues {
  protected $id = UNDEFINED;
  protected $anio = UNDEFINED;
  protected $semestre = UNDEFINED;
  protected $horasCatedra = UNDEFINED;
  protected $plan = UNDEFINED;
  protected $asignatura = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setAnio(DEFAULT_VALUE);
    $this->setSemestre(DEFAULT_VALUE);
    $this->setHorasCatedra(DEFAULT_VALUE);
    $this->setPlan(DEFAULT_VALUE);
    $this->setAsignatura(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."anio"])) $this->setAnio($row[$p."anio"]);
    if(isset($row[$p."semestre"])) $this->setSemestre($row[$p."semestre"]);
    if(isset($row[$p."horas_catedra"])) $this->setHorasCatedra($row[$p."horas_catedra"]);
    if(isset($row[$p."plan"])) $this->setPlan($row[$p."plan"]);
    if(isset($row[$p."asignatura"])) $this->setAsignatura($row[$p."asignatura"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id("");
    if($this->anio !== UNDEFINED) $row["anio"] = $this->anio("");
    if($this->semestre !== UNDEFINED) $row["semestre"] = $this->semestre("");
    if($this->horasCatedra !== UNDEFINED) $row["horas_catedra"] = $this->horasCatedra("");
    if($this->plan !== UNDEFINED) $row["plan"] = $this->plan("");
    if($this->asignatura !== UNDEFINED) $row["asignatura"] = $this->asignatura("");
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->anio)) return false;
    if(!Validation::is_empty($this->semestre)) return false;
    if(!Validation::is_empty($this->horasCatedra)) return false;
    if(!Validation::is_empty($this->plan)) return false;
    if(!Validation::is_empty($this->asignatura)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function anio($format = null) { return Format::convertCase($this->anio, $format); }
  public function semestre($format = null) { return Format::convertCase($this->semestre, $format); }
  public function horasCatedra($format = null) { return Format::convertCase($this->horasCatedra, $format); }
  public function plan($format = null) { return Format::convertCase($this->plan, $format); }
  public function asignatura($format = null) { return Format::convertCase($this->asignatura, $format); }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkId($p); 
    if($check) $this->id = $p;
    return $check;
  }

  public function setAnio($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkAnio($p); 
    if($check) $this->anio = $p;
    return $check;
  }

  public function setSemestre($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkSemestre($p); 
    if($check) $this->semestre = $p;
    return $check;
  }

  public function setHorasCatedra($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkHorasCatedra($p); 
    if($check) $this->horasCatedra = $p;
    return $check;
  }

  public function setPlan($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkPlan($p); 
    if($check) $this->plan = $p;
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

  public function checkAnio($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("anio", $v);
  }

  public function checkSemestre($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("semestre", $v);
  }

  public function checkHorasCatedra($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("horas_catedra", $v);
  }

  public function checkPlan($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("plan", $v);
  }

  public function checkAsignatura($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("asignatura", $v);
  }



}
