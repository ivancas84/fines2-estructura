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

  public function setDefault(){
    $this->id = null;
    $this->nombre = null;
    $this->formacion = null;
    $this->clasificacion = null;
    $this->codigo = null;
    $this->perfil = null;
  }

  public function fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->id = (is_null($row[$p."id"])) ? null : (string)$row[$p."id"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row[$p."nombre"])) $this->nombre = (is_null($row[$p."nombre"])) ? null : (string)$row[$p."nombre"];
    if(isset($row[$p."formacion"])) $this->formacion = (is_null($row[$p."formacion"])) ? null : (string)$row[$p."formacion"];
    if(isset($row[$p."clasificacion"])) $this->clasificacion = (is_null($row[$p."clasificacion"])) ? null : (string)$row[$p."clasificacion"];
    if(isset($row[$p."codigo"])) $this->codigo = (is_null($row[$p."codigo"])) ? null : (string)$row[$p."codigo"];
    if(isset($row[$p."perfil"])) $this->perfil = (is_null($row[$p."perfil"])) ? null : (string)$row[$p."perfil"];
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
    $this->id = trim($p);
  }

  public function setNombre($p) {
    if(empty($p)) return;
    $this->nombre = trim($p);
  }

  public function setFormacion($p) {
    if(empty($p)) return;
    $this->formacion = trim($p);
  }

  public function setClasificacion($p) {
    if(empty($p)) return;
    $this->clasificacion = trim($p);
  }

  public function setCodigo($p) {
    if(empty($p)) return;
    $this->codigo = trim($p);
  }

  public function setPerfil($p) {
    if(empty($p)) return;
    $this->perfil = trim($p);
  }



}
