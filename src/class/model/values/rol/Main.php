<?php

require_once("class/model/Values.php");

//Implementacion principal de Values para una entidad especifica
class RolValuesMain extends EntityValues {
  public $id = UNDEFINED;
  public $descripcion = UNDEFINED;
  public $detalle = UNDEFINED;

  public function fromArray(array $row = NULL){
    if(empty($row)) return;
    if(isset($row["id"])) $this->id = (is_null($row["id"])) ? null : (string)$row["id"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row["descripcion"])) $this->descripcion = (is_null($row["descripcion"])) ? null : (string)$row["descripcion"];
    if(isset($row["detalle"])) $this->detalle = (is_null($row["detalle"])) ? null : (string)$row["detalle"];
  }


  public function toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id;
    if($this->descripcion !== UNDEFINED) $row["descripcion"] = $this->descripcion;
    if($this->detalle !== UNDEFINED) $row["detalle"] = $this->detalle;
    return $row;
  }

  public function id() { return $this->id; }
  public function descripcion($format = null) { return $this->formatString($this->descripcion, $format); }
  public function detalle($format = null) { return $this->formatString($this->detalle, $format); }
  public function setId($p) {
    if(empty($p)) return;
    $this->id = $p;
  }

  public function setDescripcion($p) {
    if(empty($p)) return;
    $this->descripcion = $p;
  }

  public function setDetalle($p) {
    if(empty($p)) return;
    $this->detalle = $p;
  }



}
