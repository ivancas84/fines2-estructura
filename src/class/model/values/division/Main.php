<?php

require_once("class/model/Values.php");

//Implementacion principal de Values para una entidad especifica
class DivisionValuesMain extends EntityValues {
  public $id = UNDEFINED;
  public $serie = UNDEFINED;
  public $turno = UNDEFINED;
  public $numero = UNDEFINED;
  public $plan = UNDEFINED;
  public $sede = UNDEFINED;

  public function fromArray(array $row = NULL){
    if(empty($row)) return;
    if(isset($row["id"])) $this->id = (is_null($row["id"])) ? null : (string)$row["id"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row["serie"])) $this->serie = (is_null($row["serie"])) ? null : (string)$row["serie"];
    if(isset($row["turno"])) $this->turno = (is_null($row["turno"])) ? null : (string)$row["turno"];
    if(isset($row["numero"])) $this->numero = (is_null($row["numero"])) ? null : (string)$row["numero"];
    if(isset($row["plan"])) $this->plan = (is_null($row["plan"])) ? null : (string)$row["plan"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row["sede"])) $this->sede = (is_null($row["sede"])) ? null : (string)$row["sede"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
  }


  public function toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id;
    if($this->serie !== UNDEFINED) $row["serie"] = $this->serie;
    if($this->turno !== UNDEFINED) $row["turno"] = $this->turno;
    if($this->numero !== UNDEFINED) $row["numero"] = $this->numero;
    if($this->plan !== UNDEFINED) $row["plan"] = $this->plan;
    if($this->sede !== UNDEFINED) $row["sede"] = $this->sede;
    return $row;
  }

  public function id() { return $this->id; }
  public function serie($format = null) { return $this->formatString($this->serie, $format); }
  public function turno($format = null) { return $this->formatString($this->turno, $format); }
  public function numero($format = null) { return $this->formatString($this->numero, $format); }
  public function plan() { return $this->plan; }
  public function sede() { return $this->sede; }
  public function setId($p) {
    if(empty($p)) return;
    $this->id = $p;
  }

  public function setSerie($p) {
    if(empty($p)) return;
    $this->serie = $p;
  }

  public function setTurno($p) {
    if(empty($p)) return;
    $this->turno = $p;
  }

  public function setNumero($p) {
    if(empty($p)) return;
    $this->numero = $p;
  }

  public function setPlan($p) {
    if(empty($p) && $p !== 0) return;
    $this->plan = intval($p);
  }

  public function setSede($p) {
    if(empty($p) && $p !== 0) return;
    $this->sede = intval($p);
  }



}
