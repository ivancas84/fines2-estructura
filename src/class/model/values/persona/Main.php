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
    if(isset($row[$p."id"])) $this->id = (is_null($row[$p."id"])) ? null : (string)$row[$p."id"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row[$p."alta"])) $this->alta = (is_null($row[$p."alta"])) ? null : DateTime::createFromFormat('Y-m-d H:i:s', $row[$p."alta"]);
    if(isset($row[$p."baja"])) $this->baja = (is_null($row[$p."baja"])) ? null : DateTime::createFromFormat('Y-m-d H:i:s', $row[$p."baja"]);
    if(isset($row[$p."lugar_nacimiento"])) $this->lugarNacimiento = (is_null($row[$p."lugar_nacimiento"])) ? null : (string)$row[$p."lugar_nacimiento"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row[$p."id_persona"])) $this->idPersona = (is_null($row[$p."id_persona"])) ? null : (string)$row[$p."id_persona"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row[$p."domicilio"])) $this->domicilio = (is_null($row[$p."domicilio"])) ? null : (string)$row[$p."domicilio"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
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
  public function alta($format = 'd/m/Y H:i') { return $this->formatDate($this->alta, $format); }
  public function baja($format = 'd/m/Y H:i') { return $this->formatDate($this->baja, $format); }
  public function lugarNacimiento() { return $this->lugarNacimiento; }
  public function idPersona() { return $this->idPersona; }
  public function domicilio() { return $this->domicilio; }
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

  public function setLugarNacimiento($p) {
    if(empty($p) && $p !== 0) return;
    $this->lugarNacimiento = intval(trim($p));
  }

  public function setIdPersona($p) {
    if(empty($p) && $p !== 0) return;
    $this->idPersona = intval(trim($p));
  }

  public function setDomicilio($p) {
    if(empty($p) && $p !== 0) return;
    $this->domicilio = intval(trim($p));
  }



}
