<?php

require_once("class/Format.php");
require_once("class/model/Values.php");

class _IdPersona extends EntityValues {
  protected $id = UNDEFINED;
  protected $nombres = UNDEFINED;
  protected $apellidos = UNDEFINED;
  protected $sobrenombre = UNDEFINED;
  protected $fechaNacimiento = UNDEFINED;
  protected $tipoDocumento = UNDEFINED;
  protected $numeroDocumento = UNDEFINED;
  protected $email = UNDEFINED;
  protected $genero = UNDEFINED;
  protected $cuil = UNDEFINED;
  protected $alta = UNDEFINED;
  protected $telefonos = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setNombres(DEFAULT_VALUE);
    $this->setApellidos(DEFAULT_VALUE);
    $this->setSobrenombre(DEFAULT_VALUE);
    $this->setFechaNacimiento(DEFAULT_VALUE);
    $this->setTipoDocumento(DEFAULT_VALUE);
    $this->setNumeroDocumento(DEFAULT_VALUE);
    $this->setEmail(DEFAULT_VALUE);
    $this->setGenero(DEFAULT_VALUE);
    $this->setCuil(DEFAULT_VALUE);
    $this->setAlta(DEFAULT_VALUE);
    $this->setTelefonos(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."nombres"])) $this->setNombres($row[$p."nombres"]);
    if(isset($row[$p."apellidos"])) $this->setApellidos($row[$p."apellidos"]);
    if(isset($row[$p."sobrenombre"])) $this->setSobrenombre($row[$p."sobrenombre"]);
    if(isset($row[$p."fecha_nacimiento"])) $this->setFechaNacimiento($row[$p."fecha_nacimiento"]);
    if(isset($row[$p."tipo_documento"])) $this->setTipoDocumento($row[$p."tipo_documento"]);
    if(isset($row[$p."numero_documento"])) $this->setNumeroDocumento($row[$p."numero_documento"]);
    if(isset($row[$p."email"])) $this->setEmail($row[$p."email"]);
    if(isset($row[$p."genero"])) $this->setGenero($row[$p."genero"]);
    if(isset($row[$p."cuil"])) $this->setCuil($row[$p."cuil"]);
    if(isset($row[$p."alta"])) $this->setAlta($row[$p."alta"]);
    if(isset($row[$p."telefonos"])) $this->setTelefonos($row[$p."telefonos"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id("");
    if($this->nombres !== UNDEFINED) $row["nombres"] = $this->nombres("");
    if($this->apellidos !== UNDEFINED) $row["apellidos"] = $this->apellidos("");
    if($this->sobrenombre !== UNDEFINED) $row["sobrenombre"] = $this->sobrenombre("");
    if($this->fechaNacimiento !== UNDEFINED) $row["fecha_nacimiento"] = $this->fechaNacimiento("Y-m-d");
    if($this->tipoDocumento !== UNDEFINED) $row["tipo_documento"] = $this->tipoDocumento("");
    if($this->numeroDocumento !== UNDEFINED) $row["numero_documento"] = $this->numeroDocumento("");
    if($this->email !== UNDEFINED) $row["email"] = $this->email("");
    if($this->genero !== UNDEFINED) $row["genero"] = $this->genero("");
    if($this->cuil !== UNDEFINED) $row["cuil"] = $this->cuil("");
    if($this->alta !== UNDEFINED) $row["alta"] = $this->alta("Y-m-d h:i:s");
    if($this->telefonos !== UNDEFINED) $row["telefonos"] = $this->telefonos("");
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->nombres)) return false;
    if(!Validation::is_empty($this->apellidos)) return false;
    if(!Validation::is_empty($this->sobrenombre)) return false;
    if(!Validation::is_empty($this->fechaNacimiento)) return false;
    if(!Validation::is_empty($this->tipoDocumento)) return false;
    if(!Validation::is_empty($this->numeroDocumento)) return false;
    if(!Validation::is_empty($this->email)) return false;
    if(!Validation::is_empty($this->genero)) return false;
    if(!Validation::is_empty($this->cuil)) return false;
    if(!Validation::is_empty($this->alta)) return false;
    if(!Validation::is_empty($this->telefonos)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function nombres($format = null) { return Format::convertCase($this->nombres, $format); }
  public function apellidos($format = null) { return Format::convertCase($this->apellidos, $format); }
  public function sobrenombre($format = null) { return Format::convertCase($this->sobrenombre, $format); }
  public function fechaNacimiento($format = null) { return Format::date($this->fechaNacimiento, $format); }
  public function tipoDocumento($format = null) { return Format::convertCase($this->tipoDocumento, $format); }
  public function numeroDocumento($format = null) { return Format::convertCase($this->numeroDocumento, $format); }
  public function email($format = null) { return Format::convertCase($this->email, $format); }
  public function genero($format = null) { return Format::convertCase($this->genero, $format); }
  public function cuil($format = null) { return Format::convertCase($this->cuil, $format); }
  public function alta($format = null) { return Format::date($this->alta, $format); }
  public function telefonos($format = null) { return Format::convertCase($this->telefonos, $format); }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkId($p)) $this->id = $p;
  }

  public function setNombres($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkNombres($p)) $this->nombres = $p;
  }

  public function setApellidos($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkApellidos($p)) $this->apellidos = $p;
  }

  public function setSobrenombre($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkSobrenombre($p)) $this->sobrenombre = $p;
  }

  public function _setFechaNacimiento(DateTime $p = null) {
      if($this->checkFechaNacimiento($p)) $this->fechaNacimiento = $p;  
  }

  public function setFechaNacimiento($p, $format = UNDEFINED) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    if(is_null($p)) $p = null;
    else {
      $p = ($format == UNDEFINED) ? SpanishDateTime::createFromDate($p) : SpanishDateTime::createFromFormat($format, $p);
    }
    if($this->checkFechaNacimiento($p)) $this->fechaNacimiento = $p;
  }

  public function setTipoDocumento($p) {
    $p = ($p == DEFAULT_VALUE) ? 'DNI' : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkTipoDocumento($p)) $this->tipoDocumento = $p;
  }

  public function setNumeroDocumento($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkNumeroDocumento($p)) $this->numeroDocumento = $p;
  }

  public function setEmail($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkEmail($p)) $this->email = $p;
  }

  public function setGenero($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkGenero($p)) $this->genero = $p;
  }

  public function setCuil($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkCuil($p)) $this->cuil = $p;
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

  public function setTelefonos($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkTelefonos($p)) $this->telefonos = $p;
  }

  public function checkId($value) { 
      return true; 
  }

  public function checkNombres($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("nombres", $v);
  }

  public function checkApellidos($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("apellidos", $v);
  }

  public function checkSobrenombre($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("sobrenombre", $v);
  }

  public function checkFechaNacimiento($value) { 
    $v = Validation::getInstanceValue($value)->date();
    return $this->_setLogsValidation("fecha_nacimiento", $v);
  }

  public function checkTipoDocumento($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("tipo_documento", $v);
  }

  public function checkNumeroDocumento($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("numero_documento", $v);
  }

  public function checkEmail($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("email", $v);
  }

  public function checkGenero($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("genero", $v);
  }

  public function checkCuil($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("cuil", $v);
  }

  public function checkAlta($value) { 
    $v = Validation::getInstanceValue($value)->date()->required();
    return $this->_setLogsValidation("alta", $v);
  }

  public function checkTelefonos($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("telefonos", $v);
  }



}
