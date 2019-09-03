<?php

require_once("class/model/Values.php");

class _Permiso extends EntityValues {
  public $id = UNDEFINED;
  public $alta = UNDEFINED;
  public $baja = UNDEFINED;
  public $rol = UNDEFINED;
  public $persona = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setAlta(DEFAULT_VALUE);
    $this->setBaja(DEFAULT_VALUE);
    $this->setRol(DEFAULT_VALUE);
    $this->setPersona(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."alta"])) $this->setAlta($row[$p."alta"]);
    if(isset($row[$p."baja"])) $this->setBaja($row[$p."baja"]);
    if(isset($row[$p."rol"])) $this->setRol($row[$p."rol"]);
    if(isset($row[$p."persona"])) $this->setPersona($row[$p."persona"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id();
    if($this->alta !== UNDEFINED) $row["alta"] = $this->alta();
    if($this->baja !== UNDEFINED) $row["baja"] = $this->baja();
    if($this->rol !== UNDEFINED) $row["rol"] = $this->rol();
    if($this->persona !== UNDEFINED) $row["persona"] = $this->persona();
    return $row;
  }

  public function id() { return $this->id; }
  public function alta($format = 'Y-m-d H:i:s') { return $this->formatDate($this->alta, $format); }
  public function baja($format = 'Y-m-d H:i:s') { return $this->formatDate($this->baja, $format); }
  public function rol() { return $this->rol; }
  public function persona() { return $this->persona; }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->id = (empty($p)) ? null : (string)$p;
  }

  public function _setAlta(DateTime $p = null) {
    $this->alta = $p;
  }

  public function setAlta($p, $format = "Y-m-d H:i:s") {
    $p = ($p == DEFAULT_VALUE) ? date('Y-m-d H:i:s') : trim($p);
    $p = SpanishDateTime::createFromFormat($format, $p);
    $this->alta = (empty($p)) ? null : $p;
  }

  public function _setBaja(DateTime $p = null) {
    $this->baja = $p;
  }

  public function setBaja($p, $format = "Y-m-d H:i:s") {
    $p = ($p == DEFAULT_VALUE) ? '' : trim($p);
    $p = SpanishDateTime::createFromFormat($format, $p);
    $this->baja = (empty($p)) ? null : $p;
  }

  public function setRol($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->rol = (empty($p)) ? null : (string)$p;
  }

  public function setPersona($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->persona = (empty($p)) ? null : (string)$p;
  }



}
