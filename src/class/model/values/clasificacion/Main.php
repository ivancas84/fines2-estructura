<?php

require_once("class/model/Values.php");

//Implementacion principal de Values para una entidad especifica
class ClasificacionValuesMain extends EntityValues {
  public $id = UNDEFINED;
  public $nombre = UNDEFINED;

  public function fromArray(array $row = NULL){
    if(empty($row)) return;
    if(isset($row["id"])) $this->id = (is_null($row["id"])) ? null : (string)$row["id"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row["nombre"])) $this->nombre = (is_null($row["nombre"])) ? null : (string)$row["nombre"];
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
    if(empty($p)) return;
    $this->id = $p;
  }

  public function setNombre($p) {
    if(empty($p)) return;
    $this->nombre = $p;
  }



}
