<?php

require_once("class/model/Values.php");

//Implementacion principal de Values para una entidad especifica
class NominaValuesMain extends EntityValues {
  public $id = UNDEFINED;
  public $alta = UNDEFINED;
  public $activo = UNDEFINED;
  public $division = UNDEFINED;
  public $persona = UNDEFINED;

  public function fromArray(array $row = NULL){
    if(empty($row)) return;
    if(isset($row["id"])) $this->id = (is_null($row["id"])) ? null : (string)$row["id"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row["alta"])) $this->alta = (is_null($row["alta"])) ? null : DateTime::createFromFormat('Y-m-d H:i:s', $row["alta"]);
    if(isset($row["activo"])) $this->activo = (is_null($row["activo"])) ? null : settypebool($row["activo"]);
    if(isset($row["division"])) $this->division = (is_null($row["division"])) ? null : (string)$row["division"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row["persona"])) $this->persona = (is_null($row["persona"])) ? null : (string)$row["persona"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
  }


  public function toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id;
    if($this->alta !== UNDEFINED) {
      if(empty($this->alta)) $row["alta"] = $this->alta;
      else $row["alta"] = $this->alta->format('Y-m-d H:i:s');
    }
    if($this->activo !== UNDEFINED) $row["activo"] = ($this->activo) ? "true" : "false";        
    if($this->division !== UNDEFINED) $row["division"] = $this->division;
    if($this->persona !== UNDEFINED) $row["persona"] = $this->persona;
    return $row;
  }

  public function id() { return $this->id; }
  public function alta($format = 'd/m/Y H:i') { return $this->formatDate($this->alta, $format); }
  public function activo() { return ($this->activo) ? 'Sí' : 'No'; }
  public function division() { return $this->division; }
  public function persona() { return $this->persona; }
  public function setId($p) {
    if(empty($p)) return;
    $this->id = $p;
  }

  public function setAlta($p) {
    if(empty($p)) return;
    $this->alta = $p;
  }

  public function setActivo($p) {
    $this->activo = settypebool($p);
  }

  public function setDivision($p) {
    if(empty($p) && $p !== 0) return;
    $this->division = intval($p);
  }

  public function setPersona($p) {
    if(empty($p) && $p !== 0) return;
    $this->persona = intval($p);
  }



}
