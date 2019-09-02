<?php

require_once("class/model/Values.php");

//Implementacion principal de Values para una entidad especifica
class NominaValuesMain extends EntityValues {
  public $id = UNDEFINED;
  public $alta = UNDEFINED;
  public $activo = UNDEFINED;
  public $division = UNDEFINED;
  public $persona = UNDEFINED;

  public function setDefault(){
    $this->id = null;
    $this->alta = new DateTime();
    $this->activo = 1;
    $this->division = null;
    $this->persona = null;
  }

  public function fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."alta"])) $this->setAltaStr($row[$p."alta"]);
    if(isset($row[$p."activo"])) $this->setActivo($row[$p."activo"]);
    if(isset($row[$p."division"])) $this->setDivision($row[$p."division"]);
    if(isset($row[$p."persona"])) $this->setPersona($row[$p."persona"]);
  }

  public function toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id;
    if($this->alta !== UNDEFINED) {
        if(empty($this->alta)) $row["alta"] = $this->alta;
        else $row["alta"] = $this->alta->format('Y-m-d H:i:s');
      }
    if($this->activo !== UNDEFINED) $row["activo"] = ($this->activo) ? true : false;        
    if($this->division !== UNDEFINED) $row["division"] = $this->division;
    if($this->persona !== UNDEFINED) $row["persona"] = $this->persona;
    return $row;
  }

  public function id() { return $this->id; }
  public function alta($format = 'd/m/Y H:i:s') { return $this->formatDate($this->alta, $format); }
  public function activo() { return ($this->activo) ? 'Sí' : 'No'; }
  public function division() { return $this->division; }
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

  public function setActivo($p) {
    $p = trim($p);
    $this->activo = (is_null($p)) ? null : settypebool($p);
  }
  public function setDivision($p) {
    $p = trim($p);
    $this->division = (empty($p)) ? null : (string)$p;
  }

  public function setPersona($p) {
    $p = trim($p);
    $this->persona = (empty($p)) ? null : (string)$p;
  }



}
