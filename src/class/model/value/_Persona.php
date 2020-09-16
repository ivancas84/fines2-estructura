<?php
require_once("class/model/entityOptions/Value.php");

class _PersonaValue extends ValueEntityOptions{

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

  public function setDefaultId() { if($this->id === UNDEFINED) $this->setId(uniqid()); }
  public function setDefaultNombres() { if($this->nombres === UNDEFINED) $this->setNombres(null); }
  public function setDefaultApellidos() { if($this->apellidos === UNDEFINED) $this->setApellidos(null); }
  public function setDefaultFechaNacimiento() { if($this->fechaNacimiento === UNDEFINED) $this->setFechaNacimiento(null); }
  public function setDefaultNumeroDocumento() { if($this->numeroDocumento === UNDEFINED) $this->setNumeroDocumento(null); }
  public function setDefaultCuil() { if($this->cuil === UNDEFINED) $this->setCuil(null); }
  public function setDefaultGenero() { if($this->genero === UNDEFINED) $this->setGenero(null); }
  public function setDefaultApodo() { if($this->apodo === UNDEFINED) $this->setApodo(null); }
  public function setDefaultTelefono() { if($this->telefono === UNDEFINED) $this->setTelefono(null); }
  public function setDefaultEmail() { if($this->email === UNDEFINED) $this->setEmail(null); }
  public function setDefaultAlta() { if($this->alta === UNDEFINED) $this->setAlta(date('c')); }
  public function setDefaultDomicilio() { if($this->domicilio === UNDEFINED) $this->setDomicilio(null); }

  public function isEmptyId() { if(!Validation::is_empty($this->id)) return false; }
  public function isEmptyNombres() { if(!Validation::is_empty($this->nombres)) return false; }
  public function isEmptyApellidos() { if(!Validation::is_empty($this->apellidos)) return false; }
  public function isEmptyFechaNacimiento() { if(!Validation::is_empty($this->fechaNacimiento)) return false; }
  public function isEmptyNumeroDocumento() { if(!Validation::is_empty($this->numeroDocumento)) return false; }
  public function isEmptyCuil() { if(!Validation::is_empty($this->cuil)) return false; }
  public function isEmptyGenero() { if(!Validation::is_empty($this->genero)) return false; }
  public function isEmptyApodo() { if(!Validation::is_empty($this->apodo)) return false; }
  public function isEmptyTelefono() { if(!Validation::is_empty($this->telefono)) return false; }
  public function isEmptyEmail() { if(!Validation::is_empty($this->email)) return false; }
  public function isEmptyAlta() { if(!Validation::is_empty($this->alta)) return false; }
  public function isEmptyDomicilio() { if(!Validation::is_empty($this->domicilio)) return false; }

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

  public function _setId(string $p = null) { return $this->id = $p; }  
  public function setId($p) { return $this->id = (is_null($p)) ? null : (string)$p; }

  public function _setNombres(string $p = null) { return $this->nombres = $p; }  
  public function setNombres($p) { return $this->nombres = (is_null($p)) ? null : (string)$p; }

  public function _setApellidos(string $p = null) { return $this->apellidos = $p; }  
  public function setApellidos($p) { return $this->apellidos = (is_null($p)) ? null : (string)$p; }

  public function _setFechaNacimiento(DateTime $p = null) { return $this->fechaNacimiento = $p; }  

  public function setFechaNacimiento($p) {
    if(!is_null($p) && !($p instanceof DateTime)) $p = new SpanishDateTime($p);
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->fechaNacimiento = $p;
  }

  public function setFechaNacimientoY($p) {
    if(!is_null($p) && !($p instanceof DateTime)) {
      $p = (strlen($p) == 4) ? SpanishDateTime::createFromFormat('Y', $p) : new SpanishDateTime($p);
    }
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->fechaNacimiento = $p;
  }

  public function _setNumeroDocumento(string $p = null) { return $this->numeroDocumento = $p; }  
  public function setNumeroDocumento($p) { return $this->numeroDocumento = (is_null($p)) ? null : (string)$p; }

  public function _setCuil(string $p = null) { return $this->cuil = $p; }  
  public function setCuil($p) { return $this->cuil = (is_null($p)) ? null : (string)$p; }

  public function _setGenero(string $p = null) { return $this->genero = $p; }  
  public function setGenero($p) { return $this->genero = (is_null($p)) ? null : (string)$p; }

  public function _setApodo(string $p = null) { return $this->apodo = $p; }  
  public function setApodo($p) { return $this->apodo = (is_null($p)) ? null : (string)$p; }

  public function _setTelefono(string $p = null) { return $this->telefono = $p; }  
  public function setTelefono($p) { return $this->telefono = (is_null($p)) ? null : (string)$p; }

  public function _setEmail(string $p = null) { return $this->email = $p; }  
  public function setEmail($p) { return $this->email = (is_null($p)) ? null : (string)$p; }

  public function _setAlta(DateTime $p = null) { return $this->alta = $p; }  

  public function setAlta($p) {
    if(!is_null($p) && !($p instanceof DateTime)) $p = new SpanishDateTime($p);
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->alta = $p;
  }

  public function setAltaY($p) {
    if(!is_null($p) && !($p instanceof DateTime)) {
      $p = (strlen($p) == 4) ? SpanishDateTime::createFromFormat('Y', $p) : new SpanishDateTime($p);
    }
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->alta = $p;
  }

  public function _setDomicilio(string $p = null) { return $this->domicilio = $p; }  
  public function setDomicilio($p) { return $this->domicilio = (is_null($p)) ? null : (string)$p; }

  public function resetNombres() { if(!Validation::is_empty($this->nombres)) $this->nombres = preg_replace('/\s\s+/', ' ', trim($this->nombres)); }
  public function resetApellidos() { if(!Validation::is_empty($this->apellidos)) $this->apellidos = preg_replace('/\s\s+/', ' ', trim($this->apellidos)); }
  public function resetNumeroDocumento() { if(!Validation::is_empty($this->numeroDocumento)) $this->numeroDocumento = preg_replace('/\s\s+/', ' ', trim($this->numeroDocumento)); }
  public function resetCuil() { if(!Validation::is_empty($this->cuil)) $this->cuil = preg_replace('/\s\s+/', ' ', trim($this->cuil)); }
  public function resetGenero() { if(!Validation::is_empty($this->genero)) $this->genero = preg_replace('/\s\s+/', ' ', trim($this->genero)); }
  public function resetApodo() { if(!Validation::is_empty($this->apodo)) $this->apodo = preg_replace('/\s\s+/', ' ', trim($this->apodo)); }
  public function resetTelefono() { if(!Validation::is_empty($this->telefono)) $this->telefono = preg_replace('/\s\s+/', ' ', trim($this->telefono)); }
  public function resetEmail() { if(!Validation::is_empty($this->email)) $this->email = preg_replace('/\s\s+/', ' ', trim($this->email)); }

  public function checkId() { 
      if(Validation::is_undefined($this->id)) return null;
      return true; 
  }

  public function checkNombres() { 
      $this->_logs->resetLogs("nombres");
      if(Validation::is_undefined($this->nombres)) return null;
      $v = Validation::getInstanceValue($this->nombres)->required()->max(255);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("nombres", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkApellidos() { 
      $this->_logs->resetLogs("apellidos");
      if(Validation::is_undefined($this->apellidos)) return null;
      $v = Validation::getInstanceValue($this->apellidos)->max(255);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("apellidos", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkFechaNacimiento() { 
      $this->_logs->resetLogs("fecha_nacimiento");
      if(Validation::is_undefined($this->fechaNacimiento)) return null;
      $v = Validation::getInstanceValue($this->fechaNacimiento)->isA('DateTime');
      foreach($v->getErrors() as $error){ $this->_logs->addLog("fecha_nacimiento", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkNumeroDocumento() { 
      $this->_logs->resetLogs("numero_documento");
      if(Validation::is_undefined($this->numeroDocumento)) return null;
      $v = Validation::getInstanceValue($this->numeroDocumento)->required()->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("numero_documento", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkCuil() { 
      $this->_logs->resetLogs("cuil");
      if(Validation::is_undefined($this->cuil)) return null;
      $v = Validation::getInstanceValue($this->cuil)->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("cuil", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkGenero() { 
      $this->_logs->resetLogs("genero");
      if(Validation::is_undefined($this->genero)) return null;
      $v = Validation::getInstanceValue($this->genero)->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("genero", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkApodo() { 
      $this->_logs->resetLogs("apodo");
      if(Validation::is_undefined($this->apodo)) return null;
      $v = Validation::getInstanceValue($this->apodo)->max(255);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("apodo", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkTelefono() { 
      $this->_logs->resetLogs("telefono");
      if(Validation::is_undefined($this->telefono)) return null;
      $v = Validation::getInstanceValue($this->telefono)->max(255);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("telefono", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkEmail() { 
      $this->_logs->resetLogs("email");
      if(Validation::is_undefined($this->email)) return null;
      $v = Validation::getInstanceValue($this->email)->max(255);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("email", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkAlta() { 
      $this->_logs->resetLogs("alta");
      if(Validation::is_undefined($this->alta)) return null;
      $v = Validation::getInstanceValue($this->alta)->required()->isA('DateTime');
      foreach($v->getErrors() as $error){ $this->_logs->addLog("alta", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkDomicilio() { 
      $this->_logs->resetLogs("domicilio");
      if(Validation::is_undefined($this->domicilio)) return null;
      $v = Validation::getInstanceValue($this->domicilio)->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("domicilio", "error", $error); }
      return $v->isSuccess();
    }
  
    public function sqlId() { return $this->_sqlString($this->id); }
  public function sqlNombres() { return $this->_sqlString($this->nombres); }
  public function sqlApellidos() { return $this->_sqlString($this->apellidos); }
  public function sqlFechaNacimiento() { return $this->_sqlDateTime($this->fechaNacimiento, "Y-m-d"); }
  public function sqlFechaNacimientoYm() { return $this->_sqlDateTime($this->fechaNacimiento, "Y-m"); }
  public function sqlFechaNacimientoY() { return $this->_sqlDateTime($this->fechaNacimiento, "Y"); }
  public function sqlNumeroDocumento() { return $this->_sqlString($this->numeroDocumento); }
  public function sqlCuil() { return $this->_sqlString($this->cuil); }
  public function sqlGenero() { return $this->_sqlString($this->genero); }
  public function sqlApodo() { return $this->_sqlString($this->apodo); }
  public function sqlTelefono() { return $this->_sqlString($this->telefono); }
  public function sqlEmail() { return $this->_sqlString($this->email); }
  public function sqlAlta() { return $this->_sqlDateTime($this->alta, "Y-m-d H:i:s"); }
  public function sqlAltaDate() { return $this->_sqlDateTime($this->alta, "Y-m-d"); }
  public function sqlAltaYm() { return $this->_sqlDateTime($this->alta, "Y-m"); }
  public function sqlAltaY() { return $this->_sqlDateTime($this->alta, "Y"); }
  public function sqlDomicilio() { return $this->_sqlString($this->domicilio); }

  public function jsonId() { return $this->id; }
  public function jsonNombres() { return $this->nombres; }
  public function jsonApellidos() { return $this->apellidos; }
  public function jsonFechaNacimiento() { return $this->fechaNacimiento('c'); }
  public function jsonNumeroDocumento() { return $this->numeroDocumento; }
  public function jsonCuil() { return $this->cuil; }
  public function jsonGenero() { return $this->genero; }
  public function jsonApodo() { return $this->apodo; }
  public function jsonTelefono() { return $this->telefono; }
  public function jsonEmail() { return $this->email; }
  public function jsonAlta() { return $this->alta('c'); }
  public function jsonDomicilio() { return $this->domicilio; }



}
