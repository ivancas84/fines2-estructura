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

  public function fromArray(array $row = NULL){
    if(empty($row)) return;
    if(isset($row["id"])) $this->id = (is_null($row["id"])) ? null : (string)$row["id"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row["numero"])) $this->numero = (is_null($row["numero"])) ? null : intval($row["numero"]);
    if(isset($row["dia"])) $this->dia = (is_null($row["dia"])) ? null : (string)$row["dia"];
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
    if(empty($p)) return;
    $this->id = trim($p);
  }

  public function setNumero($p) {
    if(empty($p) && $p !== 0) return;
    $this->numero = intval(trim($p));
  }

  public function setDia($p) {
    if(empty($p)) return;
    $this->dia = trim($p);
  }



}
