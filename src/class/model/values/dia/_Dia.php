<?php

require_once("class/model/Values.php");

class _Dia extends EntityValues {
  public $id = UNDEFINED;
  public $numero = UNDEFINED;
  public $dia = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setNumero(DEFAULT_VALUE);
    $this->setDia(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."numero"])) $this->setNumero($row[$p."numero"]);
    if(isset($row[$p."dia"])) $this->setDia($row[$p."dia"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id();
    if($this->numero !== UNDEFINED) $row["numero"] = $this->numero();
    if($this->dia !== UNDEFINED) $row["dia"] = $this->dia();
    return $row;
  }

  public function id() { return $this->id; }
  public function numero() { return $this->numero; }
  public function dia($format = null) { return $this->formatString($this->dia, $format); }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->id = (empty($p)) ? null : (string)$p;
  }

  public function setNumero($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $this->numero = (is_null($p)) ? null : intval(trim($p));
  }

  public function setDia($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->dia = (empty($p)) ? null : (string)$p;
  }



}
