<?php

require_once("class/model/Values.php");

class _LugarNacimiento extends EntityValues {
  public $id = UNDEFINED;
  public $ciudad = UNDEFINED;
  public $provincia = UNDEFINED;
  public $pais = UNDEFINED;
  public $alta = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setCiudad(DEFAULT_VALUE);
    $this->setProvincia(DEFAULT_VALUE);
    $this->setPais(DEFAULT_VALUE);
    $this->setAlta(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."ciudad"])) $this->setCiudad($row[$p."ciudad"]);
    if(isset($row[$p."provincia"])) $this->setProvincia($row[$p."provincia"]);
    if(isset($row[$p."pais"])) $this->setPais($row[$p."pais"]);
    if(isset($row[$p."alta"])) $this->setAlta($row[$p."alta"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id();
    if($this->ciudad !== UNDEFINED) $row["ciudad"] = $this->ciudad();
    if($this->provincia !== UNDEFINED) $row["provincia"] = $this->provincia();
    if($this->pais !== UNDEFINED) $row["pais"] = $this->pais();
    if($this->alta !== UNDEFINED) $row["alta"] = $this->alta();
    return $row;
  }

  public function id() { return $this->id; }
  public function ciudad($format = null) { return $this->formatString($this->ciudad, $format); }
  public function provincia($format = null) { return $this->formatString($this->provincia, $format); }
  public function pais($format = null) { return $this->formatString($this->pais, $format); }
  public function alta($format = 'Y-m-d H:i:s') { return $this->formatDate($this->alta, $format); }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->id = (empty($p)) ? null : (string)$p;
  }

  public function setCiudad($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->ciudad = (empty($p)) ? null : (string)$p;
  }

  public function setProvincia($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->provincia = (empty($p)) ? null : (string)$p;
  }

  public function setPais($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->pais = (empty($p)) ? null : (string)$p;
  }

  public function _setAlta(DateTime $p = null) {
    $this->alta = $p;
  }

  public function setAlta($p, $format = "Y-m-d H:i:s") {
    $p = ($p == DEFAULT_VALUE) ? date('Y-m-d H:i:s') : trim($p);
    $p = SpanishDateTime::createFromFormat($format, $p);
    $this->alta = (empty($p)) ? null : $p;
  }



}
