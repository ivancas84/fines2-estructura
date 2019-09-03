<?php

require_once("class/model/Values.php");

class _Persona extends EntityValues {
  public $id = UNDEFINED;
  public $alta = UNDEFINED;
  public $baja = UNDEFINED;
  public $lugarNacimiento = UNDEFINED;
  public $idPersona = UNDEFINED;
  public $domicilio = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setAlta(DEFAULT_VALUE);
    $this->setBaja(DEFAULT_VALUE);
    $this->setLugarNacimiento(DEFAULT_VALUE);
    $this->setIdPersona(DEFAULT_VALUE);
    $this->setDomicilio(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."alta"])) $this->setAlta($row[$p."alta"]);
    if(isset($row[$p."baja"])) $this->setBaja($row[$p."baja"]);
    if(isset($row[$p."lugar_nacimiento"])) $this->setLugarNacimiento($row[$p."lugar_nacimiento"]);
    if(isset($row[$p."id_persona"])) $this->setIdPersona($row[$p."id_persona"]);
    if(isset($row[$p."domicilio"])) $this->setDomicilio($row[$p."domicilio"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id();
    if($this->alta !== UNDEFINED) $row["alta"] = $this->alta();
    if($this->baja !== UNDEFINED) $row["baja"] = $this->baja();
    if($this->lugarNacimiento !== UNDEFINED) $row["lugar_nacimiento"] = $this->lugarNacimiento();
    if($this->idPersona !== UNDEFINED) $row["id_persona"] = $this->idPersona();
    if($this->domicilio !== UNDEFINED) $row["domicilio"] = $this->domicilio();
    return $row;
  }

  public function id() { return $this->id; }
  public function alta($format = 'Y-m-d H:i:s') { return $this->_formatDate($this->alta, $format); }
  public function baja($format = 'Y-m-d H:i:s') { return $this->_formatDate($this->baja, $format); }
  public function lugarNacimiento() { return $this->lugarNacimiento; }
  public function idPersona() { return $this->idPersona; }
  public function domicilio() { return $this->domicilio; }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->id = (empty($p)) ? null : (string)$p;
  }

  public function _setAlta(DateTime $p = null) {
    $this->alta = $p;
  }

  public function setAlta($p, $format = "Y-m-d H:i:s") {
    $p = ($p == DEFAULT_VALUE) ? date('Y-m-d H:i:s') : trim($p);
    $p = SpanishDateTime::createFromFormat($format, $p);
    $this->alta = (empty($p)) ? null : $p;
  }

  public function _setBaja(DateTime $p = null) {
    $this->baja = $p;
  }

  public function setBaja($p, $format = "Y-m-d H:i:s") {
    $p = ($p == DEFAULT_VALUE) ? '' : trim($p);
    $p = SpanishDateTime::createFromFormat($format, $p);
    $this->baja = (empty($p)) ? null : $p;
  }

  public function setLugarNacimiento($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->lugarNacimiento = (empty($p)) ? null : (string)$p;
  }

  public function setIdPersona($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->idPersona = (empty($p)) ? null : (string)$p;
  }

  public function setDomicilio($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->domicilio = (empty($p)) ? null : (string)$p;
  }



}
