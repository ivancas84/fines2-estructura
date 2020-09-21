<?php
require_once("class/model/entityOptions/Value.php");

class _SedeValue extends ValueEntityOptions{

  protected $id = UNDEFINED;
  protected $numero = UNDEFINED;
  protected $nombre = UNDEFINED;
  protected $observaciones = UNDEFINED;
  protected $alta = UNDEFINED;
  protected $baja = UNDEFINED;
  protected $domicilio = UNDEFINED;
  protected $tipoSede = UNDEFINED;
  protected $centroEducativo = UNDEFINED;

  public function setDefaultId() { if($this->id === UNDEFINED) $this->setId(uniqid()); }
  public function setDefaultNumero() { if($this->numero === UNDEFINED) $this->setNumero(null); }
  public function setDefaultNombre() { if($this->nombre === UNDEFINED) $this->setNombre(null); }
  public function setDefaultObservaciones() { if($this->observaciones === UNDEFINED) $this->setObservaciones(null); }
  public function setDefaultAlta() { if($this->alta === UNDEFINED) $this->setAlta(date('c')); }
  public function setDefaultBaja() { if($this->baja === UNDEFINED) $this->setBaja(null); }
  public function setDefaultDomicilio() { if($this->domicilio === UNDEFINED) $this->setDomicilio(null); }
  public function setDefaultTipoSede() { if($this->tipoSede === UNDEFINED) $this->setTipoSede(null); }
  public function setDefaultCentroEducativo() { if($this->centroEducativo === UNDEFINED) $this->setCentroEducativo(null); }

  public function isEmptyId() { if(!Validation::is_empty($this->id)) return false; }
  public function isEmptyNumero() { if(!Validation::is_empty($this->numero)) return false; }
  public function isEmptyNombre() { if(!Validation::is_empty($this->nombre)) return false; }
  public function isEmptyObservaciones() { if(!Validation::is_empty($this->observaciones)) return false; }
  public function isEmptyAlta() { if(!Validation::is_empty($this->alta)) return false; }
  public function isEmptyBaja() { if(!Validation::is_empty($this->baja)) return false; }
  public function isEmptyDomicilio() { if(!Validation::is_empty($this->domicilio)) return false; }
  public function isEmptyTipoSede() { if(!Validation::is_empty($this->tipoSede)) return false; }
  public function isEmptyCentroEducativo() { if(!Validation::is_empty($this->centroEducativo)) return false; }

  public function id() { return $this->id; }
  public function numero($format = null) { return Format::convertCase($this->numero, $format); }
  public function nombre($format = null) { return Format::convertCase($this->nombre, $format); }
  public function observaciones($format = null) { return Format::convertCase($this->observaciones, $format); }
  public function alta($format = null) { return Format::date($this->alta, $format); }
  public function baja($format = null) { return Format::date($this->baja, $format); }
  public function domicilio($format = null) { return Format::convertCase($this->domicilio, $format); }
  public function tipoSede($format = null) { return Format::convertCase($this->tipoSede, $format); }
  public function centroEducativo($format = null) { return Format::convertCase($this->centroEducativo, $format); }

  public function _setId(string $p = null) { return $this->id = $p; }  
  public function setId($p) { return $this->id = (is_null($p)) ? null : (string)$p; }

  public function _setNumero(string $p = null) { return $this->numero = $p; }  
  public function setNumero($p) { return $this->numero = (is_null($p)) ? null : (string)$p; }

  public function _setNombre(string $p = null) { return $this->nombre = $p; }  
  public function setNombre($p) { return $this->nombre = (is_null($p)) ? null : (string)$p; }

  public function _setObservaciones(string $p = null) { return $this->observaciones = $p; }  
  public function setObservaciones($p) { return $this->observaciones = (is_null($p)) ? null : (string)$p; }

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

  public function _setBaja(DateTime $p = null) { return $this->baja = $p; }  

  public function setBaja($p) {
    if(!is_null($p) && !($p instanceof DateTime)) $p = new SpanishDateTime($p);
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->baja = $p;
  }

  public function setBajaY($p) {
    if(!is_null($p) && !($p instanceof DateTime)) {
      $p = (strlen($p) == 4) ? SpanishDateTime::createFromFormat('Y', $p) : new SpanishDateTime($p);
    }
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->baja = $p;
  }

  public function _setDomicilio(string $p = null) { return $this->domicilio = $p; }  
  public function setDomicilio($p) { return $this->domicilio = (is_null($p)) ? null : (string)$p; }

  public function _setTipoSede(string $p = null) { return $this->tipoSede = $p; }  
  public function setTipoSede($p) { return $this->tipoSede = (is_null($p)) ? null : (string)$p; }

  public function _setCentroEducativo(string $p = null) { return $this->centroEducativo = $p; }  
  public function setCentroEducativo($p) { return $this->centroEducativo = (is_null($p)) ? null : (string)$p; }

  public function resetId() { if(!Validation::is_empty($this->id)) $this->id = preg_replace('/\s\s+/', ' ', trim($this->id)); }
  public function resetNumero() { if(!Validation::is_empty($this->numero)) $this->numero = preg_replace('/\s\s+/', ' ', trim($this->numero)); }
  public function resetNombre() { if(!Validation::is_empty($this->nombre)) $this->nombre = preg_replace('/\s\s+/', ' ', trim($this->nombre)); }
  public function resetObservaciones() { if(!Validation::is_empty($this->observaciones)) $this->observaciones = preg_replace('/\s\s+/', ' ', trim($this->observaciones)); }
  public function resetDomicilio() { if(!Validation::is_empty($this->domicilio)) $this->domicilio = preg_replace('/\s\s+/', ' ', trim($this->domicilio)); }
  public function resetTipoSede() { if(!Validation::is_empty($this->tipoSede)) $this->tipoSede = preg_replace('/\s\s+/', ' ', trim($this->tipoSede)); }
  public function resetCentroEducativo() { if(!Validation::is_empty($this->centroEducativo)) $this->centroEducativo = preg_replace('/\s\s+/', ' ', trim($this->centroEducativo)); }

  public function checkId() { 
      if(Validation::is_undefined($this->id)) return null;
      return true; 
  }

  public function checkNumero() { 
      $this->_logs->resetLogs("numero");
      if(Validation::is_undefined($this->numero)) return null;
      $v = Validation::getInstanceValue($this->numero)->required()->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("numero", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkNombre() { 
      $this->_logs->resetLogs("nombre");
      if(Validation::is_undefined($this->nombre)) return null;
      $v = Validation::getInstanceValue($this->nombre)->required()->max(255);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("nombre", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkObservaciones() { 
      $this->_logs->resetLogs("observaciones");
      if(Validation::is_undefined($this->observaciones)) return null;
      $v = Validation::getInstanceValue($this->observaciones)->max(65535);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("observaciones", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkAlta() { 
      $this->_logs->resetLogs("alta");
      if(Validation::is_undefined($this->alta)) return null;
      $v = Validation::getInstanceValue($this->alta)->required()->isA('DateTime');
      foreach($v->getErrors() as $error){ $this->_logs->addLog("alta", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkBaja() { 
      $this->_logs->resetLogs("baja");
      if(Validation::is_undefined($this->baja)) return null;
      $v = Validation::getInstanceValue($this->baja)->isA('DateTime');
      foreach($v->getErrors() as $error){ $this->_logs->addLog("baja", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkDomicilio() { 
      $this->_logs->resetLogs("domicilio");
      if(Validation::is_undefined($this->domicilio)) return null;
      $v = Validation::getInstanceValue($this->domicilio)->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("domicilio", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkTipoSede() { 
      $this->_logs->resetLogs("tipo_sede");
      if(Validation::is_undefined($this->tipoSede)) return null;
      $v = Validation::getInstanceValue($this->tipoSede)->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("tipo_sede", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkCentroEducativo() { 
      $this->_logs->resetLogs("centro_educativo");
      if(Validation::is_undefined($this->centroEducativo)) return null;
      $v = Validation::getInstanceValue($this->centroEducativo)->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("centro_educativo", "error", $error); }
      return $v->isSuccess();
    }
  
    public function sqlId() { return $this->sql->string($this->id); }
  public function sqlNumero() { return $this->sql->string($this->numero); }
  public function sqlNombre() { return $this->sql->string($this->nombre); }
  public function sqlObservaciones() { return $this->sql->string($this->observaciones); }
  public function sqlAlta() { return $this->sql->dateTime($this->alta, "Y-m-d H:i:s"); }
  public function sqlAltaDate() { return $this->sql->dateTime($this->alta, "Y-m-d"); }
  public function sqlAltaYm() { return $this->sql->dateTime($this->alta, "Y-m"); }
  public function sqlAltaY() { return $this->sql->dateTime($this->alta, "Y"); }
  public function sqlBaja() { return $this->sql->dateTime($this->baja, "Y-m-d H:i:s"); }
  public function sqlBajaDate() { return $this->sql->dateTime($this->baja, "Y-m-d"); }
  public function sqlBajaYm() { return $this->sql->dateTime($this->baja, "Y-m"); }
  public function sqlBajaY() { return $this->sql->dateTime($this->baja, "Y"); }
  public function sqlDomicilio() { return $this->sql->string($this->domicilio); }
  public function sqlTipoSede() { return $this->sql->string($this->tipoSede); }
  public function sqlCentroEducativo() { return $this->sql->string($this->centroEducativo); }

  public function jsonId() { return $this->id; }
  public function jsonNumero() { return $this->numero; }
  public function jsonNombre() { return $this->nombre; }
  public function jsonObservaciones() { return $this->observaciones; }
  public function jsonAlta() { return $this->alta('c'); }
  public function jsonBaja() { return $this->baja('c'); }
  public function jsonDomicilio() { return $this->domicilio; }
  public function jsonTipoSede() { return $this->tipoSede; }
  public function jsonCentroEducativo() { return $this->centroEducativo; }



}
