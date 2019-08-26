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

  public function setDefault(){
    $this->id = null;
    $this->serie = null;
    $this->turno = null;
    $this->numero = null;
    $this->plan = null;
    $this->sede = null;
  }

  public function fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->id = (is_null($row[$p."id"])) ? null : (string)$row[$p."id"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row[$p."serie"])) $this->serie = (is_null($row[$p."serie"])) ? null : (string)$row[$p."serie"];
    if(isset($row[$p."turno"])) $this->turno = (is_null($row[$p."turno"])) ? null : (string)$row[$p."turno"];
    if(isset($row[$p."numero"])) $this->numero = (is_null($row[$p."numero"])) ? null : (string)$row[$p."numero"];
    if(isset($row[$p."plan"])) $this->plan = (is_null($row[$p."plan"])) ? null : (string)$row[$p."plan"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row[$p."sede"])) $this->sede = (is_null($row[$p."sede"])) ? null : (string)$row[$p."sede"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
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
    $this->id = trim($p);
  }

  public function setSerie($p) {
    if(empty($p)) return;
    $this->serie = trim($p);
  }

  public function setTurno($p) {
    if(empty($p)) return;
    $this->turno = trim($p);
  }

  public function setNumero($p) {
    if(empty($p)) return;
    $this->numero = trim($p);
  }

  public function setPlan($p) {
    if(empty($p) && $p !== 0) return;
    $this->plan = intval(trim($p));
  }

  public function setSede($p) {
    if(empty($p) && $p !== 0) return;
    $this->sede = intval(trim($p));
  }



}
