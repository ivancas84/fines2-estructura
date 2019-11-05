<?php

require_once("class/Format.php");
require_once("class/model/Values.php");

class _Nomina2 extends EntityValues {
  protected $id = UNDEFINED;
  protected $fotocopiaDocumento = UNDEFINED;
  protected $partidaNacimiento = UNDEFINED;
  protected $alta = UNDEFINED;
  protected $constanciaCuil = UNDEFINED;
  protected $certificadoEstudios = UNDEFINED;
  protected $anioIngreso = UNDEFINED;
  protected $activo = UNDEFINED;
  protected $programa = UNDEFINED;
  protected $observaciones = UNDEFINED;
  protected $persona = UNDEFINED;
  protected $comision = UNDEFINED;

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
    if($this->id !== UNDEFINED) $row["id"] = $this->id("");
    if($this->fotocopiaDocumento !== UNDEFINED) $row["fotocopia_documento"] = $this->fotocopiaDocumento("");
    if($this->partidaNacimiento !== UNDEFINED) $row["partida_nacimiento"] = $this->partidaNacimiento("");
    if($this->alta !== UNDEFINED) $row["alta"] = $this->alta("Y-m-d h:i:s");
    if($this->constanciaCuil !== UNDEFINED) $row["constancia_cuil"] = $this->constanciaCuil("");
    if($this->certificadoEstudios !== UNDEFINED) $row["certificado_estudios"] = $this->certificadoEstudios("");
    if($this->anioIngreso !== UNDEFINED) $row["anio_ingreso"] = $this->anioIngreso("");
    if($this->activo !== UNDEFINED) $row["activo"] = $this->activo("");
    if($this->programa !== UNDEFINED) $row["programa"] = $this->programa("");
    if($this->observaciones !== UNDEFINED) $row["observaciones"] = $this->observaciones("");
    if($this->persona !== UNDEFINED) $row["persona"] = $this->persona("");
    if($this->comision !== UNDEFINED) $row["comision"] = $this->comision("");
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->fotocopiaDocumento)) return false;
    if(!Validation::is_empty($this->partidaNacimiento)) return false;
    if(!Validation::is_empty($this->alta)) return false;
    if(!Validation::is_empty($this->constanciaCuil)) return false;
    if(!Validation::is_empty($this->certificadoEstudios)) return false;
    if(!Validation::is_empty($this->anioIngreso)) return false;
    if(!Validation::is_empty($this->activo)) return false;
    if(!Validation::is_empty($this->programa)) return false;
    if(!Validation::is_empty($this->observaciones)) return false;
    if(!Validation::is_empty($this->persona)) return false;
    if(!Validation::is_empty($this->comision)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function fotocopiaDocumento($format = null) { return Format::boolean($this->fotocopiaDocumento, $format); }
  public function partidaNacimiento($format = null) { return Format::boolean($this->partidaNacimiento, $format); }
  public function alta($format = null) { return Format::date($this->alta, $format); }
  public function constanciaCuil($format = null) { return Format::boolean($this->constanciaCuil, $format); }
  public function certificadoEstudios($format = null) { return Format::boolean($this->certificadoEstudios, $format); }
  public function anioIngreso() { return $this->anioIngreso; }
  public function activo($format = null) { return Format::boolean($this->activo, $format); }
  public function programa($format = null) { return Format::convertCase($this->programa, $format); }
  public function observaciones($format = null) { return Format::convertCase($this->observaciones, $format); }
  public function persona() { return $this->persona; }
  public function comision() { return $this->comision; }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkId($p)) $this->id = $p;
  }

  public function setFotocopiaDocumento($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $p = (is_null($p)) ? null : settypebool(trim($p));
    if($this->checkFotocopiaDocumento($p)) $this->fotocopiaDocumento = $p;
  }

  public function setPartidaNacimiento($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $p = (is_null($p)) ? null : settypebool(trim($p));
    if($this->checkPartidaNacimiento($p)) $this->partidaNacimiento = $p;
  }

  public function _setAlta(DateTime $p = null) {
      if($this->checkAlta($p)) $this->alta = $p;  
  }

  public function setAlta($p, $format = "Y-m-d H:i:s") {
    $p = ($p == DEFAULT_VALUE) ? date('Y-m-d H:i:s') : trim($p);
    if(is_null($p)) $p = null;
    else $p = SpanishDateTime::createFromFormat($format, $p);
    if($this->checkAlta($p)) $this->alta = $p;
  }

  public function setConstanciaCuil($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $p = (is_null($p)) ? null : settypebool(trim($p));
    if($this->checkConstanciaCuil($p)) $this->constanciaCuil = $p;
  }

  public function setCertificadoEstudios($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $p = (is_null($p)) ? null : settypebool(trim($p));
    if($this->checkCertificadoEstudios($p)) $this->certificadoEstudios = $p;
  }

  public function setAnioIngreso($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    (is_null($p)) ? null : intval(trim($p));
    if($this->checkAnioIngreso($p)) $this->anioIngreso = $p;
  }

  public function setActivo($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $p = (is_null($p)) ? null : settypebool(trim($p));
    if($this->checkActivo($p)) $this->activo = $p;
  }

  public function setPrograma($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkPrograma($p)) $this->programa = $p;
  }

  public function setObservaciones($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkObservaciones($p)) $this->observaciones = $p;
  }

  public function setPersona($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkPersona($p)) $this->persona = $p;
  }

  public function setComision($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkComision($p)) $this->comision = $p;
  }

  public function checkId($value) { 
      return true; 
  }

  public function checkFotocopiaDocumento($value) { 
    $v = Validation::getInstanceValue($value)->boolean()->required();
    return $this->_setLogsValidation("fotocopia_documento", $v);
  }

  public function checkPartidaNacimiento($value) { 
    $v = Validation::getInstanceValue($value)->boolean()->required();
    return $this->_setLogsValidation("partida_nacimiento", $v);
  }

  public function checkAlta($value) { 
    $v = Validation::getInstanceValue($value)->date()->required();
    return $this->_setLogsValidation("alta", $v);
  }

  public function checkConstanciaCuil($value) { 
    $v = Validation::getInstanceValue($value)->boolean()->required();
    return $this->_setLogsValidation("constancia_cuil", $v);
  }

  public function checkCertificadoEstudios($value) { 
    $v = Validation::getInstanceValue($value)->boolean()->required();
    return $this->_setLogsValidation("certificado_estudios", $v);
  }

  public function checkAnioIngreso($value) { 
    $v = Validation::getInstanceValue($value)->integer();
    return $this->_setLogsValidation("anio_ingreso", $v);
  }

  public function checkActivo($value) { 
    $v = Validation::getInstanceValue($value)->boolean()->required();
    return $this->_setLogsValidation("activo", $v);
  }

  public function checkPrograma($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("programa", $v);
  }

  public function checkObservaciones($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("observaciones", $v);
  }

  public function checkPersona($value) { 
    $v = Validation::getInstanceValue($value)->integer()->required();
    return $this->_setLogsValidation("persona", $v);
  }

  public function checkComision($value) { 
    $v = Validation::getInstanceValue($value)->integer()->required();
    return $this->_setLogsValidation("comision", $v);
  }



}
