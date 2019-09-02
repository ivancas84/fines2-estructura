<?php

require_once("class/model/Values.php");

//Implementacion principal de Values para una entidad especifica
class ClasificacionValuesMain extends EntityValues {
  public $id = UNDEFINED;
  public $nombre = UNDEFINED;

  public function setDefault(){
    $this->id = null;
    $this->nombre = null;
  }

  public function fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."nombre"])) $this->setNombre($row[$p."nombre"]);
  }

  public function toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id;
    if($this->nombre !== UNDEFINED) $row["nombre"] = $this->nombre;
    return $row;
  }

  public function id() { return $this->id; }
  public function nombre($format = null) { return $this->formatString($this->nombre, $format); }
  public function setId($p) {
    $p = trim($p);
    $this->id = (empty($p)) ? null : (string)$p;
  }

  public function setNombre($p) {
    $p = trim($p);
    $this->nombre = (empty($p)) ? null : (string)$p;
  }



}
