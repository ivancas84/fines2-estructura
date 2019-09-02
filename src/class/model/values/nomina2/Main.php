<?php

require_once("class/model/Values.php");

//Implementacion principal de Values para una entidad especifica
class Nomina2ValuesMain extends EntityValues {
  public $id = UNDEFINED;
  public $fotocopiaDocumento = UNDEFINED;
  public $partidaNacimiento = UNDEFINED;
  public $alta = UNDEFINED;
  public $constanciaCuil = UNDEFINED;
  public $certificadoEstudios = UNDEFINED;
  public $anioIngreso = UNDEFINED;
  public $activo = UNDEFINED;
  public $programa = UNDEFINED;
  public $observaciones = UNDEFINED;
  public $persona = UNDEFINED;
  public $comision = UNDEFINED;

  public function setDefault(){
    $this->id = null;
    $this->fotocopiaDocumento = null;
    $this->partidaNacimiento = null;
    $this->alta = new DateTime();
    $this->constanciaCuil = null;
    $this->certificadoEstudios = null;
    $this->anioIngreso = null;
    $this->activo = null;
    $this->programa = null;
    $this->observaciones = null;
    $this->persona = null;
    $this->comision = null;
  }

  public function fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."fotocopia_documento"])) $this->setFotocopiaDocumento($row[$p."fotocopia_documento"]);
    if(isset($row[$p."partida_nacimiento"])) $this->setPartidaNacimiento($row[$p."partida_nacimiento"]);
    if(isset($row[$p."alta"])) $this->setAltaStr($row[$p."alta"]);
    if(isset($row[$p."constancia_cuil"])) $this->setConstanciaCuil($row[$p."constancia_cuil"]);
    if(isset($row[$p."certificado_estudios"])) $this->setCertificadoEstudios($row[$p."certificado_estudios"]);
    if(isset($row[$p."anio_ingreso"])) $this->setAnioIngreso($row[$p."anio_ingreso"]);
    if(isset($row[$p."activo"])) $this->setActivo($row[$p."activo"]);
    if(isset($row[$p."programa"])) $this->setPrograma($row[$p."programa"]);
    if(isset($row[$p."observaciones"])) $this->setObservaciones($row[$p."observaciones"]);
    if(isset($row[$p."persona"])) $this->setPersona($row[$p."persona"]);
    if(isset($row[$p."comision"])) $this->setComision($row[$p."comision"]);
  }

  public function toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id;
    if($this->fotocopiaDocumento !== UNDEFINED) $row["fotocopia_documento"] = ($this->fotocopiaDocumento) ? true : false;        
    if($this->partidaNacimiento !== UNDEFINED) $row["partida_nacimiento"] = ($this->partidaNacimiento) ? true : false;        
    if($this->alta !== UNDEFINED) {
        if(empty($this->alta)) $row["alta"] = $this->alta;
        else $row["alta"] = $this->alta->format('Y-m-d H:i:s');
      }
    if($this->constanciaCuil !== UNDEFINED) $row["constancia_cuil"] = ($this->constanciaCuil) ? true : false;        
    if($this->certificadoEstudios !== UNDEFINED) $row["certificado_estudios"] = ($this->certificadoEstudios) ? true : false;        
    if($this->anioIngreso !== UNDEFINED) $row["anio_ingreso"] = $this->anioIngreso;
    if($this->activo !== UNDEFINED) $row["activo"] = ($this->activo) ? true : false;        
    if($this->programa !== UNDEFINED) $row["programa"] = $this->programa;
    if($this->observaciones !== UNDEFINED) $row["observaciones"] = $this->observaciones;
    if($this->persona !== UNDEFINED) $row["persona"] = $this->persona;
    if($this->comision !== UNDEFINED) $row["comision"] = $this->comision;
    return $row;
  }

  public function id() { return $this->id; }
  public function fotocopiaDocumento() { return ($this->fotocopiaDocumento) ? 'Sí' : 'No'; }
  public function partidaNacimiento() { return ($this->partidaNacimiento) ? 'Sí' : 'No'; }
  public function alta($format = 'd/m/Y H:i:s') { return $this->formatDate($this->alta, $format); }
  public function constanciaCuil() { return ($this->constanciaCuil) ? 'Sí' : 'No'; }
  public function certificadoEstudios() { return ($this->certificadoEstudios) ? 'Sí' : 'No'; }
  public function anioIngreso() { return $this->anioIngreso; }
  public function activo() { return ($this->activo) ? 'Sí' : 'No'; }
  public function programa($format = null) { return $this->formatString($this->programa, $format); }
  public function observaciones($format = null) { return $this->formatString($this->observaciones, $format); }
  public function persona() { return $this->persona; }
  public function comision() { return $this->comision; }
  public function setId($p) {
    $p = trim($p);
    $this->id = (empty($p)) ? null : (string)$p;
  }

  public function setFotocopiaDocumento($p) {
    $p = trim($p);
    $this->fotocopiaDocumento = (is_null($p)) ? null : settypebool($p);
  }
  public function setPartidaNacimiento($p) {
    $p = trim($p);
    $this->partidaNacimiento = (is_null($p)) ? null : settypebool($p);
  }
  public function setAlta(DateTime $p = null) {
    $this->alta = $p;
  }

  public function setAltaStr($p, $format = "Y-m-d H:i:s") {
    $p = SpanishDateTime::createFromFormat($format, trim($p));
    $this->alta = (empty($p)) ? null : $p;
  }

  public function setConstanciaCuil($p) {
    $p = trim($p);
    $this->constanciaCuil = (is_null($p)) ? null : settypebool($p);
  }
  public function setCertificadoEstudios($p) {
    $p = trim($p);
    $this->certificadoEstudios = (is_null($p)) ? null : settypebool($p);
  }
  public function setAnioIngreso($p) {
    $p = trim($p);
    $this->anioIngreso = (is_null($p) && $p !== 0) ? null : intval($p);
  }
  public function setActivo($p) {
    $p = trim($p);
    $this->activo = (is_null($p)) ? null : settypebool($p);
  }
  public function setPrograma($p) {
    $p = trim($p);
    $this->programa = (empty($p)) ? null : (string)$p;
  }

  public function setObservaciones($p) {
    $p = trim($p);
    $this->observaciones = (empty($p)) ? null : (string)$p;
  }

  public function setPersona($p) {
    $p = trim($p);
    $this->persona = (empty($p)) ? null : (string)$p;
  }

  public function setComision($p) {
    $p = trim($p);
    $this->comision = (empty($p)) ? null : (string)$p;
  }



}
