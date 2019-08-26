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
    if(isset($row[$p."id"])) $this->id = (is_null($row[$p."id"])) ? null : (string)$row[$p."id"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row[$p."anio"])) $this->anio = (is_null($row[$p."anio"])) ? null : intval($row[$p."anio"]);
    if(isset($row[$p."semestre"])) $this->semestre = (is_null($row[$p."semestre"])) ? null : intval($row[$p."semestre"]);
    if(isset($row[$p."horas_catedra"])) $this->horasCatedra = (is_null($row[$p."horas_catedra"])) ? null : intval($row[$p."horas_catedra"]);
    if(isset($row[$p."tramo"])) $this->tramo = (is_null($row[$p."tramo"])) ? null : (string)$row[$p."tramo"];
    if(isset($row[$p."asignatura"])) $this->asignatura = (is_null($row[$p."asignatura"])) ? null : (string)$row[$p."asignatura"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row[$p."plan"])) $this->plan = (is_null($row[$p."plan"])) ? null : (string)$row[$p."plan"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
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
    if(empty($p)) return;
    $this->id = trim($p);
  }

  public function setAnio($p) {
    if(empty($p) && $p !== 0) return;
    $this->anio = intval(trim($p));
  }

  public function setSemestre($p) {
    if(empty($p) && $p !== 0) return;
    $this->semestre = intval(trim($p));
  }

  public function setHorasCatedra($p) {
    if(empty($p) && $p !== 0) return;
    $this->horasCatedra = intval(trim($p));
  }

  public function setTramo($p) {
    if(empty($p)) return;
    $this->tramo = trim($p);
  }

  public function setAsignatura($p) {
    if(empty($p) && $p !== 0) return;
    $this->asignatura = intval(trim($p));
  }

  public function setPlan($p) {
    if(empty($p) && $p !== 0) return;
    $this->plan = intval(trim($p));
  }



}
