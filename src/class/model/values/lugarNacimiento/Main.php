<?php

require_once("class/model/Values.php");

//Implementacion principal de Values para una entidad especifica
class LugarNacimientoValuesMain extends EntityValues {
  public $id = UNDEFINED;
  public $ciudad = UNDEFINED;
  public $provincia = UNDEFINED;
  public $pais = UNDEFINED;
  public $alta = UNDEFINED;

  public function setDefault(){
    $this->id = null;
    $this->ciudad = null;
    $this->provincia = null;
    $this->pais = null;
    $this->alta = new DateTime();
  }

  public function fromArray(array $row = NULL){
    if(empty($row)) return;
    if(isset($row["id"])) $this->id = (is_null($row["id"])) ? null : (string)$row["id"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row["ciudad"])) $this->ciudad = (is_null($row["ciudad"])) ? null : (string)$row["ciudad"];
    if(isset($row["provincia"])) $this->provincia = (is_null($row["provincia"])) ? null : (string)$row["provincia"];
    if(isset($row["pais"])) $this->pais = (is_null($row["pais"])) ? null : (string)$row["pais"];
    if(isset($row["alta"])) $this->alta = (is_null($row["alta"])) ? null : DateTime::createFromFormat('Y-m-d H:i:s', $row["alta"]);
  }

  public function toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id;
    if($this->ciudad !== UNDEFINED) $row["ciudad"] = $this->ciudad;
    if($this->provincia !== UNDEFINED) $row["provincia"] = $this->provincia;
    if($this->pais !== UNDEFINED) $row["pais"] = $this->pais;
    if($this->alta !== UNDEFINED) {
      if(empty($this->alta)) $row["alta"] = $this->alta;
      else $row["alta"] = $this->alta->format('Y-m-d H:i:s');
    }
    return $row;
  }

  public function id() { return $this->id; }
  public function ciudad($format = null) { return $this->formatString($this->ciudad, $format); }
  public function provincia($format = null) { return $this->formatString($this->provincia, $format); }
  public function pais($format = null) { return $this->formatString($this->pais, $format); }
  public function alta($format = 'd/m/Y H:i') { return $this->formatDate($this->alta, $format); }
  public function setId($p) {
    if(empty($p)) return;
    $this->id = trim($p);
  }

  public function setCiudad($p) {
    if(empty($p)) return;
    $this->ciudad = trim($p);
  }

  public function setProvincia($p) {
    if(empty($p)) return;
    $this->provincia = trim($p);
  }

  public function setPais($p) {
    if(empty($p)) return;
    $this->pais = trim($p);
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



}
