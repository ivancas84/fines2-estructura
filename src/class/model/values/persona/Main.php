<?php

require_once("class/model/Values.php");

//Implementacion principal de Values para una entidad especifica
class PersonaValuesMain extends EntityValues {
  public $id = UNDEFINED;
  public $alta = UNDEFINED;
  public $baja = UNDEFINED;
  public $lugarNacimiento = UNDEFINED;
  public $idPersona = UNDEFINED;
  public $domicilio = UNDEFINED;

  public function setDefault(){
    $this->id = null;
    $this->alta = new DateTime();
    $this->baja = null;
    $this->lugarNacimiento = null;
    $this->idPersona = null;
    $this->domicilio = null;
  }

  public function fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."alta"])) $this->setAltaStr($row[$p."alta"]);
    if(isset($row[$p."baja"])) $this->setBajaStr($row[$p."baja"]);
    if(isset($row[$p."lugar_nacimiento"])) $this->setLugarNacimiento($row[$p."lugar_nacimiento"]);
    if(isset($row[$p."id_persona"])) $this->setIdPersona($row[$p."id_persona"]);
    if(isset($row[$p."domicilio"])) $this->setDomicilio($row[$p."domicilio"]);
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
    if($this->lugarNacimiento !== UNDEFINED) $row["lugar_nacimiento"] = $this->lugarNacimiento;
    if($this->idPersona !== UNDEFINED) $row["id_persona"] = $this->idPersona;
    if($this->domicilio !== UNDEFINED) $row["domicilio"] = $this->domicilio;
    return $row;
  }

  public function id() { return $this->id; }
  public function alta($format = 'd/m/Y H:i:s') { return $this->formatDate($this->alta, $format); }
  public function baja($format = 'd/m/Y H:i:s') { return $this->formatDate($this->baja, $format); }
  public function lugarNacimiento() { return $this->lugarNacimiento; }
  public function idPersona() { return $this->idPersona; }
  public function domicilio() { return $this->domicilio; }
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

  public function setLugarNacimiento($p) {
    $p = trim($p);
    $this->lugarNacimiento = (empty($p)) ? null : (string)$p;
  }

  public function setIdPersona($p) {
    $p = trim($p);
    $this->idPersona = (empty($p)) ? null : (string)$p;
  }

  public function setDomicilio($p) {
    $p = trim($p);
    $this->domicilio = (empty($p)) ? null : (string)$p;
  }



}
