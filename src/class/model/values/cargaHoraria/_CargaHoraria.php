<?php

require_once("class/model/Values.php");

class _CargaHoraria extends EntityValues {
  public $id = UNDEFINED;
  public $anio = UNDEFINED;
  public $semestre = UNDEFINED;
  public $horasCatedra = UNDEFINED;
  public $tramo = UNDEFINED;
  public $asignatura = UNDEFINED;
  public $plan = UNDEFINED;

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
    if($this->id !== UNDEFINED) $row["id"] = $this->id();
    if($this->anio !== UNDEFINED) $row["anio"] = $this->anio();
    if($this->semestre !== UNDEFINED) $row["semestre"] = $this->semestre();
    if($this->horasCatedra !== UNDEFINED) $row["horas_catedra"] = $this->horasCatedra();
    if($this->tramo !== UNDEFINED) $row["tramo"] = $this->tramo();
    if($this->asignatura !== UNDEFINED) $row["asignatura"] = $this->asignatura();
    if($this->plan !== UNDEFINED) $row["plan"] = $this->plan();
    return $row;
  }

  public function id() { return $this->id; }
  public function anio() { return $this->anio; }
  public function semestre() { return $this->semestre; }
  public function horasCatedra() { return $this->horasCatedra; }
  public function tramo($format = null) { return $this->formatString($this->tramo, $format); }
  public function asignatura() { return $this->asignatura; }
  public function plan() { return $this->plan; }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->id = (empty($p)) ? null : (string)$p;
  }

  public function setAnio($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $this->anio = (is_null($p)) ? null : intval(trim($p));
  }

  public function setSemestre($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $this->semestre = (is_null($p)) ? null : intval(trim($p));
  }

  public function setHorasCatedra($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $this->horasCatedra = (is_null($p)) ? null : intval(trim($p));
  }

  public function setTramo($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->tramo = (empty($p)) ? null : (string)$p;
  }

  public function setAsignatura($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->asignatura = (empty($p)) ? null : (string)$p;
  }

  public function setPlan($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->plan = (empty($p)) ? null : (string)$p;
  }



}
