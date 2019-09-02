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

  public function fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."alta"])) $this->setAltaStr($row[$p."alta"]);
    if(isset($row[$p."baja"])) $this->setBajaStr($row[$p."baja"]);
    if(isset($row[$p."sede"])) $this->setSede($row[$p."sede"]);
    if(isset($row[$p."persona"])) $this->setPersona($row[$p."persona"]);
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
  public function alta($format = 'd/m/Y H:i:s') { return $this->formatDate($this->alta, $format); }
  public function baja($format = 'd/m/Y H:i:s') { return $this->formatDate($this->baja, $format); }
  public function sede() { return $this->sede; }
  public function persona() { return $this->persona; }
  public function setId($p) {
    $p = trim($p);
    $this->id = (empty($p)) ? null : (string)$p;
  }

  public function setAlta(DateTime $p = null) {
    $this->alta = $p;
  }

  public function setAltaStr($p, $format = "Y-m-d H:i:s") {
    $p = SpanishDateTime::createFromFormat($format, trim($p));
    $this->alta = (empty($p)) ? null : $p;
  }

  public function setBaja(DateTime $p = null) {
    $this->baja = $p;
  }

  public function setBajaStr($p, $format = "Y-m-d H:i:s") {
    $p = SpanishDateTime::createFromFormat($format, trim($p));
    $this->baja = (empty($p)) ? null : $p;
  }

  public function setSede($p) {
    $p = trim($p);
    $this->sede = (empty($p)) ? null : (string)$p;
  }

  public function setPersona($p) {
    $p = trim($p);
    $this->persona = (empty($p)) ? null : (string)$p;
  }



}
