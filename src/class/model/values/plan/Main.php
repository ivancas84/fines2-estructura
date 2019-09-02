<?php

require_once("class/model/Values.php");

//Implementacion principal de Values para una entidad especifica
class PlanValuesMain extends EntityValues {
  public $id = UNDEFINED;
  public $orientacion = UNDEFINED;
  public $resolucion = UNDEFINED;

  public function setDefault(){
    $this->id = null;
    $this->orientacion = null;
    $this->resolucion = null;
  }

  public function fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."orientacion"])) $this->setOrientacion($row[$p."orientacion"]);
    if(isset($row[$p."resolucion"])) $this->setResolucion($row[$p."resolucion"]);
  }

  public function toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id;
    if($this->orientacion !== UNDEFINED) $row["orientacion"] = $this->orientacion;
    if($this->resolucion !== UNDEFINED) $row["resolucion"] = $this->resolucion;
    return $row;
  }

  public function id() { return $this->id; }
  public function orientacion($format = null) { return $this->formatString($this->orientacion, $format); }
  public function resolucion($format = null) { return $this->formatString($this->resolucion, $format); }
  public function setId($p) {
    $p = trim($p);
    $this->id = (empty($p)) ? null : (string)$p;
  }

  public function setOrientacion($p) {
    $p = trim($p);
    $this->orientacion = (empty($p)) ? null : (string)$p;
  }

  public function setResolucion($p) {
    $p = trim($p);
    $this->resolucion = (empty($p)) ? null : (string)$p;
  }



}
