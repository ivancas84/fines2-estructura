<?php

require_once("class/model/Values.php");

//Implementacion principal de Values para una entidad especifica
class TelefonoValuesMain extends EntityValues {
  public $id = UNDEFINED;
  public $prefijo = UNDEFINED;
  public $numero = UNDEFINED;
  public $tipo = UNDEFINED;
  public $alta = UNDEFINED;
  public $baja = UNDEFINED;
  public $persona = UNDEFINED;

  public function setDefault(){
    $this->id = null;
    $this->prefijo = null;
    $this->numero = null;
    $this->tipo = null;
    $this->alta = new DateTime();
    $this->baja = null;
    $this->persona = null;
  }

  public function fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."prefijo"])) $this->setPrefijo($row[$p."prefijo"]);
    if(isset($row[$p."numero"])) $this->setNumero($row[$p."numero"]);
    if(isset($row[$p."tipo"])) $this->setTipo($row[$p."tipo"]);
    if(isset($row[$p."alta"])) $this->setAltaStr($row[$p."alta"]);
    if(isset($row[$p."baja"])) $this->setBajaStr($row[$p."baja"]);
    if(isset($row[$p."persona"])) $this->setPersona($row[$p."persona"]);
  }

  public function toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id;
    if($this->prefijo !== UNDEFINED) $row["prefijo"] = $this->prefijo;
    if($this->numero !== UNDEFINED) $row["numero"] = $this->numero;
    if($this->tipo !== UNDEFINED) $row["tipo"] = $this->tipo;
    if($this->alta !== UNDEFINED) {
        if(empty($this->alta)) $row["alta"] = $this->alta;
        else $row["alta"] = $this->alta->format('Y-m-d H:i:s');
      }
    if($this->baja !== UNDEFINED) {
        if(empty($this->baja)) $row["baja"] = $this->baja;
        else $row["baja"] = $this->baja->format('Y-m-d H:i:s');
      }
    if($this->persona !== UNDEFINED) $row["persona"] = $this->persona;
    return $row;
  }

  public function id() { return $this->id; }
  public function prefijo() { return $this->prefijo; }
  public function numero() { return $this->numero; }
  public function tipo($format = null) { return $this->formatString($this->tipo, $format); }
  public function alta($format = 'd/m/Y H:i:s') { return $this->formatDate($this->alta, $format); }
  public function baja($format = 'd/m/Y H:i:s') { return $this->formatDate($this->baja, $format); }
  public function persona() { return $this->persona; }
  public function setId($p) {
    $p = trim($p);
    $this->id = (empty($p)) ? null : (string)$p;
  }

  public function setPrefijo($p) {
    $p = trim($p);
    $this->prefijo = (is_null($p) && $p !== 0) ? null : intval($p);
  }
  public function setNumero($p) {
    $p = trim($p);
    $this->numero = (is_null($p) && $p !== 0) ? null : intval($p);
  }
  public function setTipo($p) {
    $p = trim($p);
    $this->tipo = (empty($p)) ? null : (string)$p;
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

  public function setPersona($p) {
    $p = trim($p);
    $this->persona = (empty($p)) ? null : (string)$p;
  }



}
