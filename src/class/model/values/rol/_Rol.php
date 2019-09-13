<?php

require_once("class/model/Values.php");

class _Rol extends EntityValues {
  public $id = UNDEFINED;
  public $descripcion = UNDEFINED;
  public $detalle = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setDescripcion(DEFAULT_VALUE);
    $this->setDetalle(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."descripcion"])) $this->setDescripcion($row[$p."descripcion"]);
    if(isset($row[$p."detalle"])) $this->setDetalle($row[$p."detalle"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id();
    if($this->descripcion !== UNDEFINED) $row["descripcion"] = $this->descripcion();
    if($this->detalle !== UNDEFINED) $row["detalle"] = $this->detalle();
    return $row;
  }

  public function id() { return $this->id; }
  public function descripcion($format = null) { return $this->_formatString($this->descripcion, $format); }
  public function detalle($format = null) { return $this->_formatString($this->detalle, $format); }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->id = (empty($p)) ? null : (string)$p;
  }

  public function setDescripcion($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->descripcion = (empty($p)) ? null : (string)$p;
  }

  public function setDetalle($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->detalle = (empty($p)) ? null : (string)$p;
  }



}
