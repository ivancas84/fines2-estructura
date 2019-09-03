<?php

require_once("class/model/Values.php");

class _Clasificacion extends EntityValues {
  public $id = UNDEFINED;
  public $nombre = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setNombre(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."nombre"])) $this->setNombre($row[$p."nombre"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id();
    if($this->nombre !== UNDEFINED) $row["nombre"] = $this->nombre();
    return $row;
  }

  public function id() { return $this->id; }
  public function nombre($format = null) { return $this->_formatString($this->nombre, $format); }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->id = (empty($p)) ? null : (string)$p;
  }

  public function setNombre($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->nombre = (empty($p)) ? null : (string)$p;
  }



}
