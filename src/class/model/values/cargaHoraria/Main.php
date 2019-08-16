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

  public function fromArray(array $row = NULL){
    if(empty($row)) return;
    if(isset($row["id"])) $this->id = (is_null($row["id"])) ? null : (string)$row["id"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row["anio"])) $this->anio = (is_null($row["anio"])) ? null : intval($row["anio"]);
    if(isset($row["semestre"])) $this->semestre = (is_null($row["semestre"])) ? null : intval($row["semestre"]);
    if(isset($row["horas_catedra"])) $this->horasCatedra = (is_null($row["horas_catedra"])) ? null : intval($row["horas_catedra"]);
    if(isset($row["tramo"])) $this->tramo = (is_null($row["tramo"])) ? null : (string)$row["tramo"];
    if(isset($row["asignatura"])) $this->asignatura = (is_null($row["asignatura"])) ? null : (string)$row["asignatura"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row["plan"])) $this->plan = (is_null($row["plan"])) ? null : (string)$row["plan"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
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
