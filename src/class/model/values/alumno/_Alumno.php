<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _Alumno extends EntityValues {
  protected $id = UNDEFINED;
  protected $fotocopiaDocumento = UNDEFINED;
  protected $partidaNacimiento = UNDEFINED;
  protected $constanciaCuil = UNDEFINED;
  protected $certificadoEstudios = UNDEFINED;
  protected $anioIngreso = UNDEFINED;
  protected $observaciones = UNDEFINED;
  protected $persona = UNDEFINED;

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
    if($this->id !== UNDEFINED) $row["id"] = $this->id("");
    if($this->fotocopiaDocumento !== UNDEFINED) $row["fotocopia_documento"] = $this->fotocopiaDocumento("");
    if($this->partidaNacimiento !== UNDEFINED) $row["partida_nacimiento"] = $this->partidaNacimiento("");
    if($this->constanciaCuil !== UNDEFINED) $row["constancia_cuil"] = $this->constanciaCuil("");
    if($this->certificadoEstudios !== UNDEFINED) $row["certificado_estudios"] = $this->certificadoEstudios("");
    if($this->anioIngreso !== UNDEFINED) $row["anio_ingreso"] = $this->anioIngreso("");
    if($this->observaciones !== UNDEFINED) $row["observaciones"] = $this->observaciones("");
    if($this->persona !== UNDEFINED) $row["persona"] = $this->persona("");
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->fotocopiaDocumento)) return false;
    if(!Validation::is_empty($this->partidaNacimiento)) return false;
    if(!Validation::is_empty($this->constanciaCuil)) return false;
    if(!Validation::is_empty($this->certificadoEstudios)) return false;
    if(!Validation::is_empty($this->anioIngreso)) return false;
    if(!Validation::is_empty($this->observaciones)) return false;
    if(!Validation::is_empty($this->persona)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function fotocopiaDocumento($format = null) { return Format::boolean($this->fotocopiaDocumento, $format); }
  public function partidaNacimiento($format = null) { return Format::boolean($this->partidaNacimiento, $format); }
  public function constanciaCuil($format = null) { return Format::boolean($this->constanciaCuil, $format); }
  public function certificadoEstudios($format = null) { return Format::boolean($this->certificadoEstudios, $format); }
  public function anioIngreso() { return $this->anioIngreso; }
  public function observaciones($format = null) { return Format::convertCase($this->observaciones, $format); }
  public function persona() { return $this->persona; }
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

  public function checkObservaciones($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("observaciones", $v);
  }

  public function checkPersona($value) { 
    $v = Validation::getInstanceValue($value)->integer()->required();
    return $this->_setLogsValidation("persona", $v);
  }



}
