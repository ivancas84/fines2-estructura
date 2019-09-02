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

  public function fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."ciudad"])) $this->setCiudad($row[$p."ciudad"]);
    if(isset($row[$p."provincia"])) $this->setProvincia($row[$p."provincia"]);
    if(isset($row[$p."pais"])) $this->setPais($row[$p."pais"]);
    if(isset($row[$p."alta"])) $this->setAltaStr($row[$p."alta"]);
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
  public function alta($format = 'd/m/Y H:i:s') { return $this->formatDate($this->alta, $format); }
  public function setId($p) {
    $p = trim($p);
    $this->id = (empty($p)) ? null : (string)$p;
  }

  public function setCiudad($p) {
    $p = trim($p);
    $this->ciudad = (empty($p)) ? null : (string)$p;
  }

  public function setProvincia($p) {
    $p = trim($p);
    $this->provincia = (empty($p)) ? null : (string)$p;
  }

  public function setPais($p) {
    $p = trim($p);
    $this->pais = (empty($p)) ? null : (string)$p;
  }

  public function setAlta(DateTime $p = null) {
    $this->alta = $p;
  }

  public function setAltaStr($p, $format = "Y-m-d H:i:s") {
    $p = SpanishDateTime::createFromFormat($format, trim($p));
    $this->alta = (empty($p)) ? null : $p;
  }



}
