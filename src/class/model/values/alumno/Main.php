<?php

require_once("class/model/Values.php");

//Implementacion principal de Values para una entidad especifica
class AlumnoValuesMain extends EntityValues {
  public $id = UNDEFINED;
  public $fotocopiaDocumento = UNDEFINED;
  public $partidaNacimiento = UNDEFINED;
  public $constanciaCuil = UNDEFINED;
  public $certificadoEstudios = UNDEFINED;
  public $anioIngreso = UNDEFINED;
  public $observaciones = UNDEFINED;
  public $persona = UNDEFINED;

  public function setDefault(){
    $this->id = null;
    $this->fotocopiaDocumento = null;
    $this->partidaNacimiento = null;
    $this->constanciaCuil = null;
    $this->certificadoEstudios = null;
    $this->anioIngreso = null;
    $this->observaciones = null;
    $this->persona = null;
  }

  public function fromArray(array $row = NULL){
    if(empty($row)) return;
    if(isset($row["id"])) $this->id = (is_null($row["id"])) ? null : (string)$row["id"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row["fotocopia_documento"])) $this->fotocopiaDocumento = (is_null($row["fotocopia_documento"])) ? null : settypebool($row["fotocopia_documento"]);
    if(isset($row["partida_nacimiento"])) $this->partidaNacimiento = (is_null($row["partida_nacimiento"])) ? null : settypebool($row["partida_nacimiento"]);
    if(isset($row["constancia_cuil"])) $this->constanciaCuil = (is_null($row["constancia_cuil"])) ? null : settypebool($row["constancia_cuil"]);
    if(isset($row["certificado_estudios"])) $this->certificadoEstudios = (is_null($row["certificado_estudios"])) ? null : settypebool($row["certificado_estudios"]);
    if(isset($row["anio_ingreso"])) $this->anioIngreso = (is_null($row["anio_ingreso"])) ? null : intval($row["anio_ingreso"]);
    if(isset($row["observaciones"])) $this->observaciones = (is_null($row["observaciones"])) ? null : (string)$row["observaciones"];
    if(isset($row["persona"])) $this->persona = (is_null($row["persona"])) ? null : (string)$row["persona"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
  }

  public function toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id;
    if($this->fotocopiaDocumento !== UNDEFINED) $row["fotocopia_documento"] = ($this->fotocopiaDocumento) ? "true" : "false";        
    if($this->partidaNacimiento !== UNDEFINED) $row["partida_nacimiento"] = ($this->partidaNacimiento) ? "true" : "false";        
    if($this->constanciaCuil !== UNDEFINED) $row["constancia_cuil"] = ($this->constanciaCuil) ? "true" : "false";        
    if($this->certificadoEstudios !== UNDEFINED) $row["certificado_estudios"] = ($this->certificadoEstudios) ? "true" : "false";        
    if($this->anioIngreso !== UNDEFINED) $row["anio_ingreso"] = $this->anioIngreso;
    if($this->observaciones !== UNDEFINED) $row["observaciones"] = $this->observaciones;
    if($this->persona !== UNDEFINED) $row["persona"] = $this->persona;
    return $row;
  }

  public function id() { return $this->id; }
  public function fotocopiaDocumento() { return ($this->fotocopiaDocumento) ? 'Sí' : 'No'; }
  public function partidaNacimiento() { return ($this->partidaNacimiento) ? 'Sí' : 'No'; }
  public function constanciaCuil() { return ($this->constanciaCuil) ? 'Sí' : 'No'; }
  public function certificadoEstudios() { return ($this->certificadoEstudios) ? 'Sí' : 'No'; }
  public function anioIngreso() { return $this->anioIngreso; }
  public function observaciones($format = null) { return $this->formatString($this->observaciones, $format); }
  public function persona() { return $this->persona; }
  public function setId($p) {
    if(empty($p)) return;
    $this->id = trim($p);
  }

  public function setFotocopiaDocumento($p) {
    $this->fotocopiaDocumento = settypebool(trim($p));
  }

  public function setPartidaNacimiento($p) {
    $this->partidaNacimiento = settypebool(trim($p));
  }

  public function setConstanciaCuil($p) {
    $this->constanciaCuil = settypebool(trim($p));
  }

  public function setCertificadoEstudios($p) {
    $this->certificadoEstudios = settypebool(trim($p));
  }

  public function setAnioIngreso($p) {
    if(empty($p) && $p !== 0) return;
    $this->anioIngreso = intval(trim($p));
  }

  public function setObservaciones($p) {
    if(empty($p)) return;
    $this->observaciones = trim($p);
  }

  public function setPersona($p) {
    if(empty($p) && $p !== 0) return;
    $this->persona = intval(trim($p));
  }



}
