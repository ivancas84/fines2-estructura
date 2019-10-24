<?php

require_once("class/Format.php");
require_once("class/model/Values.php");

class _Rol extends EntityValues {
  protected $id = UNDEFINED;
  protected $descripcion = UNDEFINED;
  protected $detalle = UNDEFINED;

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
    if($this->id !== UNDEFINED) $row["id"] = $this->id("");
    if($this->descripcion !== UNDEFINED) $row["descripcion"] = $this->descripcion("");
    if($this->detalle !== UNDEFINED) $row["detalle"] = $this->detalle("");
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->descripcion)) return false;
    if(!Validation::is_empty($this->detalle)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function descripcion($format = null) { return Format::convertCase($this->descripcion, $format); }
  public function detalle($format = null) { return Format::convertCase($this->detalle, $format); }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkId($p)) $this->id = $p;
  }

  public function setDescripcion($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkDescripcion($p)) $this->descripcion = $p;
  }

  public function setDetalle($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkDetalle($p)) $this->detalle = $p;
  }

  public function checkId($value) { 
      return true; 
  }

  public function checkDescripcion($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("descripcion", $v);
  }

  public function checkDetalle($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("detalle", $v);
  }



}
