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

  public function fromArray(array $row = NULL){
    if(empty($row)) return;
    if(isset($row["id"])) $this->id = (is_null($row["id"])) ? null : (string)$row["id"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row["prefijo"])) $this->prefijo = (is_null($row["prefijo"])) ? null : intval($row["prefijo"]);
    if(isset($row["numero"])) $this->numero = (is_null($row["numero"])) ? null : intval($row["numero"]);
    if(isset($row["tipo"])) $this->tipo = (is_null($row["tipo"])) ? null : (string)$row["tipo"];
    if(isset($row["alta"])) $this->alta = (is_null($row["alta"])) ? null : DateTime::createFromFormat('Y-m-d H:i:s', $row["alta"]);
    if(isset($row["baja"])) $this->baja = (is_null($row["baja"])) ? null : DateTime::createFromFormat('Y-m-d H:i:s', $row["baja"]);
    if(isset($row["persona"])) $this->persona = (is_null($row["persona"])) ? null : (string)$row["persona"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
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

  public function setAlta($p) {
    if(empty($p)) return;
    $this->alta = trim($p);
  }

  public function setBaja($p) {
    if(empty($p)) return;
    $this->baja = trim($p);
  }

  public function setPersona($p) {
    if(empty($p) && $p !== 0) return;
    $this->persona = intval(trim($p));
  }



}
