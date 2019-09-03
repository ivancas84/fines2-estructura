<?php

require_once("class/model/Values.php");

class _Nomina extends EntityValues {
  public $id = UNDEFINED;
  public $alta = UNDEFINED;
  public $activo = UNDEFINED;
  public $division = UNDEFINED;
  public $persona = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setAlta(DEFAULT_VALUE);
    $this->setActivo(DEFAULT_VALUE);
    $this->setDivision(DEFAULT_VALUE);
    $this->setPersona(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."alta"])) $this->setAlta($row[$p."alta"]);
    if(isset($row[$p."activo"])) $this->setActivo($row[$p."activo"]);
    if(isset($row[$p."division"])) $this->setDivision($row[$p."division"]);
    if(isset($row[$p."persona"])) $this->setPersona($row[$p."persona"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id();
    if($this->alta !== UNDEFINED) $row["alta"] = $this->alta();
    if($this->activo !== UNDEFINED) $row["activo"] = $this->activo();
    if($this->division !== UNDEFINED) $row["division"] = $this->division();
    if($this->persona !== UNDEFINED) $row["persona"] = $this->persona();
    return $row;
  }

  public function id() { return $this->id; }
  public function alta($format = 'Y-m-d H:i:s') { return $this->formatDate($this->alta, $format); }
  public function activo($format = null) { return $this->formatBoolean($this->activo, $format); }
  public function division() { return $this->division; }
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

  public function setActivo($p) {
    if ($p == DEFAULT_VALUE) $p = 1;
    $this->activo = (is_null($p)) ? null : settypebool(trim($p));
  }

  public function setDivision($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->division = (empty($p)) ? null : (string)$p;
  }

  public function setPersona($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->persona = (empty($p)) ? null : (string)$p;
  }



}
