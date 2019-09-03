<?php

require_once("class/model/Values.php");

class _Division extends EntityValues {
  public $id = UNDEFINED;
  public $serie = UNDEFINED;
  public $turno = UNDEFINED;
  public $numero = UNDEFINED;
  public $plan = UNDEFINED;
  public $sede = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setSerie(DEFAULT_VALUE);
    $this->setTurno(DEFAULT_VALUE);
    $this->setNumero(DEFAULT_VALUE);
    $this->setPlan(DEFAULT_VALUE);
    $this->setSede(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."serie"])) $this->setSerie($row[$p."serie"]);
    if(isset($row[$p."turno"])) $this->setTurno($row[$p."turno"]);
    if(isset($row[$p."numero"])) $this->setNumero($row[$p."numero"]);
    if(isset($row[$p."plan"])) $this->setPlan($row[$p."plan"]);
    if(isset($row[$p."sede"])) $this->setSede($row[$p."sede"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id();
    if($this->serie !== UNDEFINED) $row["serie"] = $this->serie();
    if($this->turno !== UNDEFINED) $row["turno"] = $this->turno();
    if($this->numero !== UNDEFINED) $row["numero"] = $this->numero();
    if($this->plan !== UNDEFINED) $row["plan"] = $this->plan();
    if($this->sede !== UNDEFINED) $row["sede"] = $this->sede();
    return $row;
  }

  public function id() { return $this->id; }
  public function serie($format = null) { return $this->formatString($this->serie, $format); }
  public function turno($format = null) { return $this->formatString($this->turno, $format); }
  public function numero($format = null) { return $this->formatString($this->numero, $format); }
  public function plan() { return $this->plan; }
  public function sede() { return $this->sede; }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->id = (empty($p)) ? null : (string)$p;
  }

  public function setSerie($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->serie = (empty($p)) ? null : (string)$p;
  }

  public function setTurno($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->turno = (empty($p)) ? null : (string)$p;
  }

  public function setNumero($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->numero = (empty($p)) ? null : (string)$p;
  }

  public function setPlan($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->plan = (empty($p)) ? null : (string)$p;
  }

  public function setSede($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->sede = (empty($p)) ? null : (string)$p;
  }



}
