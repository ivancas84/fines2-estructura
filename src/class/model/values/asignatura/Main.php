<?php

require_once("class/model/Values.php");

//Implementacion principal de Values para una entidad especifica
class AsignaturaValuesMain extends EntityValues {
  public $id = UNDEFINED;
  public $nombre = UNDEFINED;
  public $formacion = UNDEFINED;
  public $clasificacion = UNDEFINED;
  public $codigo = UNDEFINED;
  public $perfil = UNDEFINED;

  public function fromArray(array $row = NULL){
    if(empty($row)) return;
    if(isset($row["id"])) $this->id = (is_null($row["id"])) ? null : (string)$row["id"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row["nombre"])) $this->nombre = (is_null($row["nombre"])) ? null : (string)$row["nombre"];
    if(isset($row["formacion"])) $this->formacion = (is_null($row["formacion"])) ? null : (string)$row["formacion"];
    if(isset($row["clasificacion"])) $this->clasificacion = (is_null($row["clasificacion"])) ? null : (string)$row["clasificacion"];
    if(isset($row["codigo"])) $this->codigo = (is_null($row["codigo"])) ? null : (string)$row["codigo"];
    if(isset($row["perfil"])) $this->perfil = (is_null($row["perfil"])) ? null : (string)$row["perfil"];
  }


  public function toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id;
    if($this->nombre !== UNDEFINED) $row["nombre"] = $this->nombre;
    if($this->formacion !== UNDEFINED) $row["formacion"] = $this->formacion;
    if($this->clasificacion !== UNDEFINED) $row["clasificacion"] = $this->clasificacion;
    if($this->codigo !== UNDEFINED) $row["codigo"] = $this->codigo;
    if($this->perfil !== UNDEFINED) $row["perfil"] = $this->perfil;
    return $row;
  }

  public function id() { return $this->id; }
  public function nombre($format = null) { return $this->formatString($this->nombre, $format); }
  public function formacion($format = null) { return $this->formatString($this->formacion, $format); }
  public function clasificacion($format = null) { return $this->formatString($this->clasificacion, $format); }
  public function codigo($format = null) { return $this->formatString($this->codigo, $format); }
  public function perfil($format = null) { return $this->formatString($this->perfil, $format); }
  public function setId($p) {
    if(empty($p)) return;
    $this->id = $p;
  }

  public function setNombre($p) {
    if(empty($p)) return;
    $this->nombre = $p;
  }

  public function setFormacion($p) {
    if(empty($p)) return;
    $this->formacion = $p;
  }

  public function setClasificacion($p) {
    if(empty($p)) return;
    $this->clasificacion = $p;
  }

  public function setCodigo($p) {
    if(empty($p)) return;
    $this->codigo = $p;
  }

  public function setPerfil($p) {
    if(empty($p)) return;
    $this->perfil = $p;
  }



}
