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
    if(isset($row[$p."id"])) $this->id = (is_null($row[$p."id"])) ? null : (string)$row[$p."id"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row[$p."prefijo"])) $this->prefijo = (is_null($row[$p."prefijo"])) ? null : intval($row[$p."prefijo"]);
    if(isset($row[$p."numero"])) $this->numero = (is_null($row[$p."numero"])) ? null : intval($row[$p."numero"]);
    if(isset($row[$p."tipo"])) $this->tipo = (is_null($row[$p."tipo"])) ? null : (string)$row[$p."tipo"];
    if(isset($row[$p."alta"])) $this->alta = (is_null($row[$p."alta"])) ? null : DateTime::createFromFormat('Y-m-d H:i:s', $row[$p."alta"]);
    if(isset($row[$p."baja"])) $this->baja = (is_null($row[$p."baja"])) ? null : DateTime::createFromFormat('Y-m-d H:i:s', $row[$p."baja"]);
    if(isset($row[$p."persona"])) $this->persona = (is_null($row[$p."persona"])) ? null : (string)$row[$p."persona"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
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
  public function alta($format = 'd/m/Y H:i') { return $this->formatDate($this->alta, $format); }
  public function baja($format = 'd/m/Y H:i') { return $this->formatDate($this->baja, $format); }
  public function persona() { return $this->persona; }
  public function setId($p) {
    if(empty($p)) return;
    $this->id = trim($p);
  }

  public function setPrefijo($p) {
    if(empty($p) && $p !== 0) return;
    $this->prefijo = intval(trim($p));
  }

  public function setNumero($p) {
    if(empty($p) && $p !== 0) return;
    $this->numero = intval(trim($p));
  }

  public function setTipo($p) {
    if(empty($p)) return;
    $this->tipo = trim($p);
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

  public function setPersona($p) {
    if(empty($p) && $p !== 0) return;
    $this->persona = intval(trim($p));
  }



}
