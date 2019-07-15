<?php

require_once("class/model/Values.php");

//Implementacion principal de Values para una entidad especifica
class PlanValuesMain extends EntityValues {
  public $id = UNDEFINED;
  public $orientacion = UNDEFINED;
  public $resolucion = UNDEFINED;

  public function fromArray(array $row = NULL){
    if(empty($row)) return;
    if(isset($row["id"])) $this->id = (is_null($row["id"])) ? null : (string)$row["id"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row["orientacion"])) $this->orientacion = (is_null($row["orientacion"])) ? null : (string)$row["orientacion"];
    if(isset($row["resolucion"])) $this->resolucion = (is_null($row["resolucion"])) ? null : (string)$row["resolucion"];
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
    if(empty($p)) return;
    $this->id = $p;
  }

  public function setOrientacion($p) {
    if(empty($p)) return;
    $this->orientacion = $p;
  }

  public function setResolucion($p) {
    if(empty($p)) return;
    $this->resolucion = $p;
  }



}
