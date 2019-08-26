<?php

require_once("class/model/Values.php");

//Implementacion principal de Values para una entidad especifica
class TipoSedeValuesMain extends EntityValues {
  public $id = UNDEFINED;
  public $descripcion = UNDEFINED;

  public function setDefault(){
    $this->id = null;
    $this->descripcion = null;
  }

  public function fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->id = (is_null($row[$p."id"])) ? null : (string)$row[$p."id"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row[$p."descripcion"])) $this->descripcion = (is_null($row[$p."descripcion"])) ? null : (string)$row[$p."descripcion"];
  }

  public function toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id;
    if($this->descripcion !== UNDEFINED) $row["descripcion"] = $this->descripcion;
    return $row;
  }

  public function id() { return $this->id; }
  public function descripcion($format = null) { return $this->formatString($this->descripcion, $format); }
  public function setId($p) {
    if(empty($p)) return;
    $this->id = trim($p);
  }

  public function setDescripcion($p) {
    if(empty($p)) return;
    $this->descripcion = trim($p);
  }



}
