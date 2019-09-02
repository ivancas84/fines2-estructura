<?php

require_once("class/model/Values.php");

//Implementacion principal de Values para una entidad especifica
class RolValuesMain extends EntityValues {
  public $id = UNDEFINED;
  public $descripcion = UNDEFINED;
  public $detalle = UNDEFINED;

  public function setDefault(){
    $this->id = null;
    $this->descripcion = null;
    $this->detalle = null;
  }

  public function fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."descripcion"])) $this->setDescripcion($row[$p."descripcion"]);
    if(isset($row[$p."detalle"])) $this->setDetalle($row[$p."detalle"]);
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
    $p = trim($p);
    $this->id = (empty($p)) ? null : (string)$p;
  }

  public function setDescripcion($p) {
    $p = trim($p);
    $this->descripcion = (empty($p)) ? null : (string)$p;
  }

  public function setDetalle($p) {
    $p = trim($p);
    $this->detalle = (empty($p)) ? null : (string)$p;
  }



}
