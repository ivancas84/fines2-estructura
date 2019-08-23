<?php

require_once("class/model/Values.php");

//Implementacion principal de Values para una entidad especifica
class CoordinadorValuesMain extends EntityValues {
  public $id = UNDEFINED;
  public $alta = UNDEFINED;
  public $baja = UNDEFINED;
  public $sede = UNDEFINED;
  public $persona = UNDEFINED;

  public function setDefault(){
    $this->id = null;
    $this->alta = new DateTime();
    $this->baja = null;
    $this->sede = null;
    $this->persona = null;
  }

  public function fromArray(array $row = NULL){
    if(empty($row)) return;
    if(isset($row["id"])) $this->id = (is_null($row["id"])) ? null : (string)$row["id"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row["alta"])) $this->alta = (is_null($row["alta"])) ? null : DateTime::createFromFormat('Y-m-d H:i:s', $row["alta"]);
    if(isset($row["baja"])) $this->baja = (is_null($row["baja"])) ? null : DateTime::createFromFormat('Y-m-d H:i:s', $row["baja"]);
    if(isset($row["sede"])) $this->sede = (is_null($row["sede"])) ? null : (string)$row["sede"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row["persona"])) $this->persona = (is_null($row["persona"])) ? null : (string)$row["persona"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
  }

  public function toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id;
    if($this->alta !== UNDEFINED) {
      if(empty($this->alta)) $row["alta"] = $this->alta;
      else $row["alta"] = $this->alta->format('Y-m-d H:i:s');
    }
    if($this->baja !== UNDEFINED) {
      if(empty($this->baja)) $row["baja"] = $this->baja;
      else $row["baja"] = $this->baja->format('Y-m-d H:i:s');
    }
    if($this->sede !== UNDEFINED) $row["sede"] = $this->sede;
    if($this->persona !== UNDEFINED) $row["persona"] = $this->persona;
    return $row;
  }

  public function id() { return $this->id; }
  public function alta($format = 'd/m/Y H:i') { return $this->formatDate($this->alta, $format); }
  public function baja($format = 'd/m/Y H:i') { return $this->formatDate($this->baja, $format); }
  public function sede() { return $this->sede; }
  public function persona() { return $this->persona; }
  public function setId($p) {
    if(empty($p)) return;
    $this->id = trim($p);
  }

  public function setAlta(DateTime $p) {
    if(empty($p)) return;
    $this->alta = $p;
  }

  public function setAltaStr($p, $format = "Y-m-d H:i:s") {
    $p = SpanishDateTime::createFromFormat($format, trim($p));
    if(empty($p)) return;
    $this->alta = $p;
  }

  public function setBaja(DateTime $p) {
    if(empty($p)) return;
    $this->baja = $p;
  }

  public function setBajaStr($p, $format = "Y-m-d H:i:s") {
    $p = SpanishDateTime::createFromFormat($format, trim($p));
    if(empty($p)) return;
    $this->baja = $p;
  }

  public function setSede($p) {
    if(empty($p) && $p !== 0) return;
    $this->sede = intval(trim($p));
  }

  public function setPersona($p) {
    if(empty($p) && $p !== 0) return;
    $this->persona = intval(trim($p));
  }



}
