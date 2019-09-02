<?php

require_once("class/model/Values.php");

//Implementacion principal de Values para una entidad especifica
class DiaValuesMain extends EntityValues {
  public $id = UNDEFINED;
  public $numero = UNDEFINED;
  public $dia = UNDEFINED;

  public function setDefault(){
    $this->id = null;
    $this->numero = null;
    $this->dia = null;
  }

  public function fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."numero"])) $this->setNumero($row[$p."numero"]);
    if(isset($row[$p."dia"])) $this->setDia($row[$p."dia"]);
  }

  public function toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id;
    if($this->numero !== UNDEFINED) $row["numero"] = $this->numero;
    if($this->dia !== UNDEFINED) $row["dia"] = $this->dia;
    return $row;
  }

  public function id() { return $this->id; }
  public function numero() { return $this->numero; }
  public function dia($format = null) { return $this->formatString($this->dia, $format); }
  public function setId($p) {
    $p = trim($p);
    $this->id = (empty($p)) ? null : (string)$p;
  }

  public function setNumero($p) {
    $p = trim($p);
    $this->numero = (is_null($p) && $p !== 0) ? null : intval($p);
  }
  public function setDia($p) {
    $p = trim($p);
    $this->dia = (empty($p)) ? null : (string)$p;
  }



}
