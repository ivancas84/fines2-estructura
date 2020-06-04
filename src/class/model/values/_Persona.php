<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _Persona extends EntityValues {
  protected $id = UNDEFINED;
  protected $nombres = UNDEFINED;
  protected $apellidos = UNDEFINED;
  protected $fechaNacimiento = UNDEFINED;
  protected $numeroDocumento = UNDEFINED;
  protected $cuil = UNDEFINED;
  protected $genero = UNDEFINED;
  protected $apodo = UNDEFINED;
  protected $alta = UNDEFINED;
  protected $domicilio = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setNombres(DEFAULT_VALUE);
    $this->setApellidos(DEFAULT_VALUE);
    $this->setFechaNacimiento(DEFAULT_VALUE);
    $this->setNumeroDocumento(DEFAULT_VALUE);
    $this->setCuil(DEFAULT_VALUE);
    $this->setGenero(DEFAULT_VALUE);
    $this->setApodo(DEFAULT_VALUE);
    $this->setAlta(DEFAULT_VALUE);
    $this->setDomicilio(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."nombres"])) $this->setNombres($row[$p."nombres"]);
    if(isset($row[$p."apellidos"])) $this->setApellidos($row[$p."apellidos"]);
    if(isset($row[$p."fecha_nacimiento"])) $this->setFechaNacimiento($row[$p."fecha_nacimiento"]);
    if(isset($row[$p."numero_documento"])) $this->setNumeroDocumento($row[$p."numero_documento"]);
    if(isset($row[$p."cuil"])) $this->setCuil($row[$p."cuil"]);
    if(isset($row[$p."genero"])) $this->setGenero($row[$p."genero"]);
    if(isset($row[$p."apodo"])) $this->setApodo($row[$p."apodo"]);
    if(isset($row[$p."alta"])) $this->setAlta($row[$p."alta"]);
    if(isset($row[$p."domicilio"])) $this->setDomicilio($row[$p."domicilio"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id();
    if($this->nombres !== UNDEFINED) $row["nombres"] = $this->nombres();
    if($this->apellidos !== UNDEFINED) $row["apellidos"] = $this->apellidos();
    if($this->fechaNacimiento !== UNDEFINED) $row["fecha_nacimiento"] = $this->fechaNacimiento("Y-m-d");
    if($this->numeroDocumento !== UNDEFINED) $row["numero_documento"] = $this->numeroDocumento();
    if($this->cuil !== UNDEFINED) $row["cuil"] = $this->cuil();
    if($this->genero !== UNDEFINED) $row["genero"] = $this->genero();
    if($this->apodo !== UNDEFINED) $row["apodo"] = $this->apodo();
    if($this->alta !== UNDEFINED) $row["alta"] = $this->alta("Y-m-d H:i:s");
    if($this->domicilio !== UNDEFINED) $row["domicilio"] = $this->domicilio();
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->nombres)) return false;
    if(!Validation::is_empty($this->apellidos)) return false;
    if(!Validation::is_empty($this->fechaNacimiento)) return false;
    if(!Validation::is_empty($this->numeroDocumento)) return false;
    if(!Validation::is_empty($this->cuil)) return false;
    if(!Validation::is_empty($this->genero)) return false;
    if(!Validation::is_empty($this->apodo)) return false;
    if(!Validation::is_empty($this->alta)) return false;
    if(!Validation::is_empty($this->domicilio)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function nombres($format = null) { return Format::convertCase($this->nombres, $format); }
  public function apellidos($format = null) { return Format::convertCase($this->apellidos, $format); }
  public function fechaNacimiento($format = null) { return Format::date($this->fechaNacimiento, $format); }
  public function numeroDocumento($format = null) { return Format::convertCase($this->numeroDocumento, $format); }
  public function cuil($format = null) { return Format::convertCase($this->cuil, $format); }
  public function genero($format = null) { return Format::convertCase($this->genero, $format); }
  public function apodo($format = null) { return Format::convertCase($this->apodo, $format); }
  public function alta($format = null) { return Format::date($this->alta, $format); }
  public function domicilio($format = null) { return Format::convertCase($this->domicilio, $format); }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkId($p); 
    if($check) $this->id = $p;
    return $check;
  }

  public function setNombres($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkNombres($p); 
    if($check) $this->nombres = $p;
    return $check;
  }

  public function setApellidos($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkApellidos($p); 
    if($check) $this->apellidos = $p;
    return $check;
  }

  public function _setFechaNacimiento(DateTime $p = null) {
      $check = $this->checkFechaNacimiento($p); 
      if($check) $this->fechaNacimiento = $p;  
      return $check;      
  }

  public function setFechaNacimiento($p, $format = UNDEFINED) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    if(!is_null($p)) $p = ($format == UNDEFINED) ? SpanishDateTime::createFromDate($p) : SpanishDateTime::createFromFormat($format, $p);    
    $check = $this->checkFechaNacimiento($p); 
    if($check) $this->fechaNacimiento = $p;  
    return $check;
  }

  public function setNumeroDocumento($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkNumeroDocumento($p); 
    if($check) $this->numeroDocumento = $p;
    return $check;
  }

  public function setCuil($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkCuil($p); 
    if($check) $this->cuil = $p;
    return $check;
  }

  public function setGenero($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkGenero($p); 
    if($check) $this->genero = $p;
    return $check;
  }

  public function setApodo($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkApodo($p); 
    if($check) $this->apodo = $p;
    return $check;
  }

  public function _setAlta(DateTime $p = null) {
      $check = $this->checkAlta($p); 
      if($check) $this->alta = $p;  
      return $check;
  }

  public function setAlta($p, $format = "Y-m-d H:i:s") {
    $p = ($p == DEFAULT_VALUE) ? date('Y-m-d H:i:s') : trim($p);
    if(!is_null($p)) $p = SpanishDateTime::createFromFormat($format, $p);    
    $check = $this->checkAlta($p); 
    if($check) $this->alta = $p;  
    return $check;
  }

  public function setDomicilio($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkDomicilio($p); 
    if($check) $this->domicilio = $p;
    return $check;
  }

  public function checkId($value) { 
      return true; 
  }

  public function checkNombres($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("nombres", $v);
  }

  public function checkApellidos($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("apellidos", $v);
  }

  public function checkFechaNacimiento($value) { 
    $v = Validation::getInstanceValue($value)->date();
    return $this->_setLogsValidation("fecha_nacimiento", $v);
  }

  public function checkNumeroDocumento($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("numero_documento", $v);
  }

  public function checkCuil($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("cuil", $v);
  }

  public function checkGenero($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("genero", $v);
  }

  public function checkApodo($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("apodo", $v);
  }

  public function checkAlta($value) { 
    $v = Validation::getInstanceValue($value)->date()->required();
    return $this->_setLogsValidation("alta", $v);
  }

  public function checkDomicilio($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("domicilio", $v);
  }



}