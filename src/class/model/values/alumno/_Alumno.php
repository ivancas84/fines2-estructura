<?php

require_once("class/model/Values.php");

class _Alumno extends EntityValues {
  public $id = UNDEFINED;
  public $fotocopiaDocumento = UNDEFINED;
  public $partidaNacimiento = UNDEFINED;
  public $constanciaCuil = UNDEFINED;
  public $certificadoEstudios = UNDEFINED;
  public $anioIngreso = UNDEFINED;
  public $observaciones = UNDEFINED;
  public $persona = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setFotocopiaDocumento(DEFAULT_VALUE);
    $this->setPartidaNacimiento(DEFAULT_VALUE);
    $this->setConstanciaCuil(DEFAULT_VALUE);
    $this->setCertificadoEstudios(DEFAULT_VALUE);
    $this->setAnioIngreso(DEFAULT_VALUE);
    $this->setObservaciones(DEFAULT_VALUE);
    $this->setPersona(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."fotocopia_documento"])) $this->setFotocopiaDocumento($row[$p."fotocopia_documento"]);
    if(isset($row[$p."partida_nacimiento"])) $this->setPartidaNacimiento($row[$p."partida_nacimiento"]);
    if(isset($row[$p."constancia_cuil"])) $this->setConstanciaCuil($row[$p."constancia_cuil"]);
    if(isset($row[$p."certificado_estudios"])) $this->setCertificadoEstudios($row[$p."certificado_estudios"]);
    if(isset($row[$p."anio_ingreso"])) $this->setAnioIngreso($row[$p."anio_ingreso"]);
    if(isset($row[$p."observaciones"])) $this->setObservaciones($row[$p."observaciones"]);
    if(isset($row[$p."persona"])) $this->setPersona($row[$p."persona"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id();
    if($this->fotocopiaDocumento !== UNDEFINED) $row["fotocopia_documento"] = $this->fotocopiaDocumento();
    if($this->partidaNacimiento !== UNDEFINED) $row["partida_nacimiento"] = $this->partidaNacimiento();
    if($this->constanciaCuil !== UNDEFINED) $row["constancia_cuil"] = $this->constanciaCuil();
    if($this->certificadoEstudios !== UNDEFINED) $row["certificado_estudios"] = $this->certificadoEstudios();
    if($this->anioIngreso !== UNDEFINED) $row["anio_ingreso"] = $this->anioIngreso();
    if($this->observaciones !== UNDEFINED) $row["observaciones"] = $this->observaciones();
    if($this->persona !== UNDEFINED) $row["persona"] = $this->persona();
    return $row;
  }

  public function id() { return $this->id; }
  public function fotocopiaDocumento($format = null) { return $this->_formatBoolean($this->fotocopiaDocumento, $format); }
  public function partidaNacimiento($format = null) { return $this->_formatBoolean($this->partidaNacimiento, $format); }
  public function constanciaCuil($format = null) { return $this->_formatBoolean($this->constanciaCuil, $format); }
  public function certificadoEstudios($format = null) { return $this->_formatBoolean($this->certificadoEstudios, $format); }
  public function anioIngreso() { return $this->anioIngreso; }
  public function observaciones($format = null) { return $this->_formatString($this->observaciones, $format); }
  public function persona() { return $this->persona; }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->id = (empty($p)) ? null : (string)$p;
  }

  public function setFotocopiaDocumento($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $this->fotocopiaDocumento = (is_null($p)) ? null : settypebool(trim($p));
  }

  public function setPartidaNacimiento($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $this->partidaNacimiento = (is_null($p)) ? null : settypebool(trim($p));
  }

  public function setConstanciaCuil($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $this->constanciaCuil = (is_null($p)) ? null : settypebool(trim($p));
  }

  public function setCertificadoEstudios($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $this->certificadoEstudios = (is_null($p)) ? null : settypebool(trim($p));
  }

  public function setAnioIngreso($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $this->anioIngreso = (is_null($p)) ? null : intval(trim($p));
  }

  public function setObservaciones($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->observaciones = (empty($p)) ? null : (string)$p;
  }

  public function setPersona($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->persona = (empty($p)) ? null : (string)$p;
  }



}
