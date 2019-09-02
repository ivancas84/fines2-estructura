<?php

require_once("class/model/Values.php");

//Implementacion principal de Values para una entidad especifica
class CargaHorariaValuesMain extends EntityValues {
  public $id = UNDEFINED;
  public $anio = UNDEFINED;
  public $semestre = UNDEFINED;
  public $horasCatedra = UNDEFINED;
  public $tramo = UNDEFINED;
  public $asignatura = UNDEFINED;
  public $plan = UNDEFINED;

  public function setDefault(){
    $this->id = null;
    $this->anio = null;
    $this->semestre = null;
    $this->horasCatedra = null;
    $this->tramo = null;
    $this->asignatura = null;
    $this->plan = null;
  }

  public function fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."anio"])) $this->setAnio($row[$p."anio"]);
    if(isset($row[$p."semestre"])) $this->setSemestre($row[$p."semestre"]);
    if(isset($row[$p."horas_catedra"])) $this->setHorasCatedra($row[$p."horas_catedra"]);
    if(isset($row[$p."tramo"])) $this->setTramo($row[$p."tramo"]);
    if(isset($row[$p."asignatura"])) $this->setAsignatura($row[$p."asignatura"]);
    if(isset($row[$p."plan"])) $this->setPlan($row[$p."plan"]);
  }

  public function toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id;
    if($this->anio !== UNDEFINED) $row["anio"] = $this->anio;
    if($this->semestre !== UNDEFINED) $row["semestre"] = $this->semestre;
    if($this->horasCatedra !== UNDEFINED) $row["horas_catedra"] = $this->horasCatedra;
    if($this->tramo !== UNDEFINED) $row["tramo"] = $this->tramo;
    if($this->asignatura !== UNDEFINED) $row["asignatura"] = $this->asignatura;
    if($this->plan !== UNDEFINED) $row["plan"] = $this->plan;
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
    $p = trim($p);
    $this->id = (empty($p)) ? null : (string)$p;
  }

  public function setAnio($p) {
    $p = trim($p);
    $this->anio = (is_null($p) && $p !== 0) ? null : intval($p);
  }
  public function setSemestre($p) {
    $p = trim($p);
    $this->semestre = (is_null($p) && $p !== 0) ? null : intval($p);
  }
  public function setHorasCatedra($p) {
    $p = trim($p);
    $this->horasCatedra = (is_null($p) && $p !== 0) ? null : intval($p);
  }
  public function setTramo($p) {
    $p = trim($p);
    $this->tramo = (empty($p)) ? null : (string)$p;
  }

  public function setAsignatura($p) {
    $p = trim($p);
    $this->asignatura = (empty($p)) ? null : (string)$p;
  }

  public function setPlan($p) {
    $p = trim($p);
    $this->plan = (empty($p)) ? null : (string)$p;
  }



}
