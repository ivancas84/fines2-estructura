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
  protected $telefono = UNDEFINED;
  protected $email = UNDEFINED;
  protected $alta = UNDEFINED;
  protected $domicilio = UNDEFINED;

  public function _setDefault(){
    if($this->id == UNDEFINED) $this->setId(null);
    if($this->nombres == UNDEFINED) $this->setNombres(null);
    if($this->apellidos == UNDEFINED) $this->setApellidos(null);
    if($this->fechaNacimiento == UNDEFINED) $this->setFechaNacimiento(null);
    if($this->numeroDocumento == UNDEFINED) $this->setNumeroDocumento(null);
    if($this->cuil == UNDEFINED) $this->setCuil(null);
    if($this->genero == UNDEFINED) $this->setGenero(null);
    if($this->apodo == UNDEFINED) $this->setApodo(null);
    if($this->telefono == UNDEFINED) $this->setTelefono(null);
    if($this->email == UNDEFINED) $this->setEmail(null);
    if($this->alta == UNDEFINED) $this->setAlta(date('c'));
    if($this->domicilio == UNDEFINED) $this->setDomicilio(null);
    return $this;
  }

  public function _fromArray(array $row = NULL, string $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."nombres"])) $this->setNombres($row[$p."nombres"]);
    if(isset($row[$p."apellidos"])) $this->setApellidos($row[$p."apellidos"]);
    if(isset($row[$p."fecha_nacimiento"])) $this->setFechaNacimiento($row[$p."fecha_nacimiento"]);
    if(isset($row[$p."numero_documento"])) $this->setNumeroDocumento($row[$p."numero_documento"]);
    if(isset($row[$p."cuil"])) $this->setCuil($row[$p."cuil"]);
    if(isset($row[$p."genero"])) $this->setGenero($row[$p."genero"]);
    if(isset($row[$p."apodo"])) $this->setApodo($row[$p."apodo"]);
    if(isset($row[$p."telefono"])) $this->setTelefono($row[$p."telefono"]);
    if(isset($row[$p."email"])) $this->setEmail($row[$p."email"]);
    if(isset($row[$p."alta"])) $this->setAlta($row[$p."alta"]);
    if(isset($row[$p."domicilio"])) $this->setDomicilio($row[$p."domicilio"]);
    return $this;
  }

  public function _toArray(string $p = ""){
    $row = [];
    if($this->id !== UNDEFINED) $row[$p."id"] = $this->id();
    if($this->nombres !== UNDEFINED) $row[$p."nombres"] = $this->nombres();
    if($this->apellidos !== UNDEFINED) $row[$p."apellidos"] = $this->apellidos();
    if($this->fechaNacimiento !== UNDEFINED) $row[$p."fecha_nacimiento"] = $this->fechaNacimiento("c");
    if($this->numeroDocumento !== UNDEFINED) $row[$p."numero_documento"] = $this->numeroDocumento();
    if($this->cuil !== UNDEFINED) $row[$p."cuil"] = $this->cuil();
    if($this->genero !== UNDEFINED) $row[$p."genero"] = $this->genero();
    if($this->apodo !== UNDEFINED) $row[$p."apodo"] = $this->apodo();
    if($this->telefono !== UNDEFINED) $row[$p."telefono"] = $this->telefono();
    if($this->email !== UNDEFINED) $row[$p."email"] = $this->email();
    if($this->alta !== UNDEFINED) $row[$p."alta"] = $this->alta("c");
    if($this->domicilio !== UNDEFINED) $row[$p."domicilio"] = $this->domicilio();
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
    if(!Validation::is_empty($this->telefono)) return false;
    if(!Validation::is_empty($this->email)) return false;
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
  public function telefono($format = null) { return Format::convertCase($this->telefono, $format); }
  public function email($format = null) { return Format::convertCase($this->email, $format); }
  public function alta($format = null) { return Format::date($this->alta, $format); }
  public function domicilio($format = null) { return Format::convertCase($this->domicilio, $format); }

  public function setId($p) { $this->id = (is_null($p)) ? null : (string)$p; }
  public function setNombres($p) { $this->nombres = (is_null($p)) ? null : (string)$p; }
  public function setApellidos($p) { $this->apellidos = (is_null($p)) ? null : (string)$p; }
  public function _setFechaNacimiento(DateTime $p = null) { $this->fechaNacimiento = $p; }

  public function setFechaNacimiento($p) {
    if(!is_null($p)) {
      $p = new SpanishDateTime($p);
      if($p) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
      $p->setTime(0,0,0);
    }
    $this->fechaNacimiento = $p;
  }

  public function setNumeroDocumento($p) { $this->numeroDocumento = (is_null($p)) ? null : (string)$p; }
  public function setCuil($p) { $this->cuil = (is_null($p)) ? null : (string)$p; }
  public function setGenero($p) { $this->genero = (is_null($p)) ? null : (string)$p; }
  public function setApodo($p) { $this->apodo = (is_null($p)) ? null : (string)$p; }
  public function setTelefono($p) { $this->telefono = (is_null($p)) ? null : (string)$p; }
  public function setEmail($p) { $this->email = (is_null($p)) ? null : (string)$p; }
  public function _setAlta(DateTime $p = null) { $this->alta = $p; }

  public function setAlta($p) {
    if(!is_null($p)) {
      $p = new SpanishDateTime($p);    
      if($p) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    }
    $this->alta = $p;  
  }

  public function setDomicilio($p) { $this->domicilio = (is_null($p)) ? null : (string)$p; }

  public function resetNombres() { if(!Validation::is_empty($this->nombres)) $this->nombres = preg_replace('/\s\s+/', ' ', trim($this->nombres)); }
  public function resetApellidos() { if(!Validation::is_empty($this->apellidos)) $this->apellidos = preg_replace('/\s\s+/', ' ', trim($this->apellidos)); }
  public function resetNumeroDocumento() { if(!Validation::is_empty($this->numeroDocumento)) $this->numeroDocumento = preg_replace('/\s\s+/', ' ', trim($this->numeroDocumento)); }
  public function resetCuil() { if(!Validation::is_empty($this->cuil)) $this->cuil = preg_replace('/\s\s+/', ' ', trim($this->cuil)); }
  public function resetGenero() { if(!Validation::is_empty($this->genero)) $this->genero = preg_replace('/\s\s+/', ' ', trim($this->genero)); }
  public function resetApodo() { if(!Validation::is_empty($this->apodo)) $this->apodo = preg_replace('/\s\s+/', ' ', trim($this->apodo)); }
  public function resetTelefono() { if(!Validation::is_empty($this->telefono)) $this->telefono = preg_replace('/\s\s+/', ' ', trim($this->telefono)); }
  public function resetEmail() { if(!Validation::is_empty($this->email)) $this->email = preg_replace('/\s\s+/', ' ', trim($this->email)); }

  public function checkId($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkNombres($value) { 
    $this->_logs->resetLogs("nombres");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("nombres", "error", $error); }
    return $v->isSuccess();
  }

  public function checkApellidos($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkFechaNacimiento($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkNumeroDocumento($value) { 
    $this->_logs->resetLogs("numero_documento");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("numero_documento", "error", $error); }
    return $v->isSuccess();
  }

  public function checkCuil($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkGenero($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkApodo($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkTelefono($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkEmail($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkAlta($value) { 
    $this->_logs->resetLogs("alta");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("alta", "error", $error); }
    return $v->isSuccess();
  }

  public function checkDomicilio($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function _check(){
    $this->checkId($this->id);
    $this->checkNombres($this->nombres);
    $this->checkApellidos($this->apellidos);
    $this->checkFechaNacimiento($this->fechaNacimiento);
    $this->checkNumeroDocumento($this->numeroDocumento);
    $this->checkCuil($this->cuil);
    $this->checkGenero($this->genero);
    $this->checkApodo($this->apodo);
    $this->checkTelefono($this->telefono);
    $this->checkEmail($this->email);
    $this->checkAlta($this->alta);
    $this->checkDomicilio($this->domicilio);
    return !$this->_getLogs()->isError();
  }

  public function _reset(){
    $this->resetNombres();
    $this->resetApellidos();
    $this->resetNumeroDocumento();
    $this->resetCuil();
    $this->resetGenero();
    $this->resetApodo();
    $this->resetTelefono();
    $this->resetEmail();
    return $this;
  }



}
