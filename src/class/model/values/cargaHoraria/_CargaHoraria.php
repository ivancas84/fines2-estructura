<?php

require_once("class/Format.php");
require_once("class/model/Values.php");

class _CargaHoraria extends EntityValues {
  protected $id = UNDEFINED;
  protected $anio = UNDEFINED;
  protected $semestre = UNDEFINED;
  protected $horasCatedra = UNDEFINED;
  protected $tramo = UNDEFINED;
  protected $asignatura = UNDEFINED;
  protected $plan = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setAnio(DEFAULT_VALUE);
    $this->setSemestre(DEFAULT_VALUE);
    $this->setHorasCatedra(DEFAULT_VALUE);
    $this->setTramo(DEFAULT_VALUE);
    $this->setAsignatura(DEFAULT_VALUE);
    $this->setPlan(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."anio"])) $this->setAnio($row[$p."anio"]);
    if(isset($row[$p."semestre"])) $this->setSemestre($row[$p."semestre"]);
    if(isset($row[$p."horas_catedra"])) $this->setHorasCatedra($row[$p."horas_catedra"]);
    if(isset($row[$p."tramo"])) $this->setTramo($row[$p."tramo"]);
    if(isset($row[$p."asignatura"])) $this->setAsignatura($row[$p."asignatura"]);
    if(isset($row[$p."plan"])) $this->setPlan($row[$p."plan"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id("");
    if($this->anio !== UNDEFINED) $row["anio"] = $this->anio("");
    if($this->semestre !== UNDEFINED) $row["semestre"] = $this->semestre("");
    if($this->horasCatedra !== UNDEFINED) $row["horas_catedra"] = $this->horasCatedra("");
    if($this->tramo !== UNDEFINED) $row["tramo"] = $this->tramo("");
    if($this->asignatura !== UNDEFINED) $row["asignatura"] = $this->asignatura("");
    if($this->plan !== UNDEFINED) $row["plan"] = $this->plan("");
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->anio)) return false;
    if(!Validation::is_empty($this->semestre)) return false;
    if(!Validation::is_empty($this->horasCatedra)) return false;
    if(!Validation::is_empty($this->tramo)) return false;
    if(!Validation::is_empty($this->asignatura)) return false;
    if(!Validation::is_empty($this->plan)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function anio() { return $this->anio; }
  public function semestre() { return $this->semestre; }
  public function horasCatedra() { return $this->horasCatedra; }
  public function tramo($format = null) { return Format::convertCase($this->tramo, $format); }
  public function asignatura() { return $this->asignatura; }
  public function plan() { return $this->plan; }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkId($p)) $this->id = $p;
  }

  public function setAnio($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    (is_null($p)) ? null : intval(trim($p));
    if($this->checkAnio($p)) $this->anio = $p;
  }

  public function setSemestre($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    (is_null($p)) ? null : intval(trim($p));
    if($this->checkSemestre($p)) $this->semestre = $p;
  }

  public function setHorasCatedra($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    (is_null($p)) ? null : intval(trim($p));
    if($this->checkHorasCatedra($p)) $this->horasCatedra = $p;
  }

  public function setTramo($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkTramo($p)) $this->tramo = $p;
  }

  public function setAsignatura($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkAsignatura($p)) $this->asignatura = $p;
  }

  public function setPlan($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkPlan($p)) $this->plan = $p;
  }

  public function checkId($value) { 
      return true; 
  }

  public function checkAnio($value) { 
    $v = Validation::getInstanceValue($value)->integer()->required();
    return $this->_setLogsValidation("anio", $v);
  }

  public function checkSemestre($value) { 
    $v = Validation::getInstanceValue($value)->integer()->required();
    return $this->_setLogsValidation("semestre", $v);
  }

  public function checkHorasCatedra($value) { 
    $v = Validation::getInstanceValue($value)->integer()->required();
    return $this->_setLogsValidation("horas_catedra", $v);
  }

  public function checkTramo($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("tramo", $v);
  }

  public function checkAsignatura($value) { 
    $v = Validation::getInstanceValue($value)->integer()->required();
    return $this->_setLogsValidation("asignatura", $v);
  }

  public function checkPlan($value) { 
    $v = Validation::getInstanceValue($value)->integer()->required();
    return $this->_setLogsValidation("plan", $v);
  }



}
