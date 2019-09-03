<?php

require_once("class/model/Values.php");

class _Nomina2 extends EntityValues {
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

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setFotocopiaDocumento(DEFAULT_VALUE);
    $this->setPartidaNacimiento(DEFAULT_VALUE);
    $this->setAlta(DEFAULT_VALUE);
    $this->setConstanciaCuil(DEFAULT_VALUE);
    $this->setCertificadoEstudios(DEFAULT_VALUE);
    $this->setAnioIngreso(DEFAULT_VALUE);
    $this->setActivo(DEFAULT_VALUE);
    $this->setPrograma(DEFAULT_VALUE);
    $this->setObservaciones(DEFAULT_VALUE);
    $this->setPersona(DEFAULT_VALUE);
    $this->setComision(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."fotocopia_documento"])) $this->setFotocopiaDocumento($row[$p."fotocopia_documento"]);
    if(isset($row[$p."partida_nacimiento"])) $this->setPartidaNacimiento($row[$p."partida_nacimiento"]);
    if(isset($row[$p."alta"])) $this->setAlta($row[$p."alta"]);
    if(isset($row[$p."constancia_cuil"])) $this->setConstanciaCuil($row[$p."constancia_cuil"]);
    if(isset($row[$p."certificado_estudios"])) $this->setCertificadoEstudios($row[$p."certificado_estudios"]);
    if(isset($row[$p."anio_ingreso"])) $this->setAnioIngreso($row[$p."anio_ingreso"]);
    if(isset($row[$p."activo"])) $this->setActivo($row[$p."activo"]);
    if(isset($row[$p."programa"])) $this->setPrograma($row[$p."programa"]);
    if(isset($row[$p."observaciones"])) $this->setObservaciones($row[$p."observaciones"]);
    if(isset($row[$p."persona"])) $this->setPersona($row[$p."persona"]);
    if(isset($row[$p."comision"])) $this->setComision($row[$p."comision"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id();
    if($this->fotocopiaDocumento !== UNDEFINED) $row["fotocopia_documento"] = $this->fotocopiaDocumento();
    if($this->partidaNacimiento !== UNDEFINED) $row["partida_nacimiento"] = $this->partidaNacimiento();
    if($this->alta !== UNDEFINED) $row["alta"] = $this->alta();
    if($this->constanciaCuil !== UNDEFINED) $row["constancia_cuil"] = $this->constanciaCuil();
    if($this->certificadoEstudios !== UNDEFINED) $row["certificado_estudios"] = $this->certificadoEstudios();
    if($this->anioIngreso !== UNDEFINED) $row["anio_ingreso"] = $this->anioIngreso();
    if($this->activo !== UNDEFINED) $row["activo"] = $this->activo();
    if($this->programa !== UNDEFINED) $row["programa"] = $this->programa();
    if($this->observaciones !== UNDEFINED) $row["observaciones"] = $this->observaciones();
    if($this->persona !== UNDEFINED) $row["persona"] = $this->persona();
    if($this->comision !== UNDEFINED) $row["comision"] = $this->comision();
    return $row;
  }

  public function id() { return $this->id; }
  public function fotocopiaDocumento($format = null) { return $this->formatBoolean($this->fotocopiaDocumento, $format); }
  public function partidaNacimiento($format = null) { return $this->formatBoolean($this->partidaNacimiento, $format); }
  public function alta($format = 'Y-m-d H:i:s') { return $this->formatDate($this->alta, $format); }
  public function constanciaCuil($format = null) { return $this->formatBoolean($this->constanciaCuil, $format); }
  public function certificadoEstudios($format = null) { return $this->formatBoolean($this->certificadoEstudios, $format); }
  public function anioIngreso() { return $this->anioIngreso; }
  public function activo($format = null) { return $this->formatBoolean($this->activo, $format); }
  public function programa($format = null) { return $this->formatString($this->programa, $format); }
  public function observaciones($format = null) { return $this->formatString($this->observaciones, $format); }
  public function persona() { return $this->persona; }
  public function comision() { return $this->comision; }
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

  public function _setAlta(DateTime $p = null) {
    $this->alta = $p;
  }

  public function setAlta($p, $format = "Y-m-d H:i:s") {
    $p = ($p == DEFAULT_VALUE) ? date('Y-m-d H:i:s') : trim($p);
    $p = SpanishDateTime::createFromFormat($format, $p);
    $this->alta = (empty($p)) ? null : $p;
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

  public function setActivo($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $this->activo = (is_null($p)) ? null : settypebool(trim($p));
  }

  public function setPrograma($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->programa = (empty($p)) ? null : (string)$p;
  }

  public function setObservaciones($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->observaciones = (empty($p)) ? null : (string)$p;
  }

  public function setPersona($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->persona = (empty($p)) ? null : (string)$p;
  }

  public function setComision($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->comision = (empty($p)) ? null : (string)$p;
  }



}
