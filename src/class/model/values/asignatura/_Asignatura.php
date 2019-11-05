<?php

require_once("class/model/Values.php");

class _Asignatura extends EntityValues {
  public $id = UNDEFINED;
  public $nombre = UNDEFINED;
  public $formacion = UNDEFINED;
  public $clasificacion = UNDEFINED;
  public $codigo = UNDEFINED;
  public $perfil = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setNombre(DEFAULT_VALUE);
    $this->setFormacion(DEFAULT_VALUE);
    $this->setClasificacion(DEFAULT_VALUE);
    $this->setCodigo(DEFAULT_VALUE);
    $this->setPerfil(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."nombre"])) $this->setNombre($row[$p."nombre"]);
    if(isset($row[$p."formacion"])) $this->setFormacion($row[$p."formacion"]);
    if(isset($row[$p."clasificacion"])) $this->setClasificacion($row[$p."clasificacion"]);
    if(isset($row[$p."codigo"])) $this->setCodigo($row[$p."codigo"]);
    if(isset($row[$p."perfil"])) $this->setPerfil($row[$p."perfil"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id();
    if($this->nombre !== UNDEFINED) $row["nombre"] = $this->nombre();
    if($this->formacion !== UNDEFINED) $row["formacion"] = $this->formacion();
    if($this->clasificacion !== UNDEFINED) $row["clasificacion"] = $this->clasificacion();
    if($this->codigo !== UNDEFINED) $row["codigo"] = $this->codigo();
    if($this->perfil !== UNDEFINED) $row["perfil"] = $this->perfil();
    return $row;
  }

  public function id() { return $this->id; }
  public function nombre($format = null) { return $this->_formatString($this->nombre, $format); }
  public function formacion($format = null) { return $this->_formatString($this->formacion, $format); }
  public function clasificacion($format = null) { return $this->_formatString($this->clasificacion, $format); }
  public function codigo($format = null) { return $this->_formatString($this->codigo, $format); }
  public function perfil($format = null) { return $this->_formatString($this->perfil, $format); }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->id = (empty($p)) ? null : (string)$p;
  }

  public function setNombre($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->nombre = (empty($p)) ? null : (string)$p;
  }

  public function setFormacion($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->formacion = (empty($p)) ? null : (string)$p;
  }

  public function setClasificacion($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->clasificacion = (empty($p)) ? null : (string)$p;
  }

  public function setCodigo($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->codigo = (empty($p)) ? null : (string)$p;
  }

  public function setPerfil($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->perfil = (empty($p)) ? null : (string)$p;
  }



}
