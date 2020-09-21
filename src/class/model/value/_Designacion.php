<?php
require_once("class/model/entityOptions/Value.php");

class _DesignacionValue extends ValueEntityOptions{

  protected $id = UNDEFINED;
  protected $desde = UNDEFINED;
  protected $hasta = UNDEFINED;
  protected $alta = UNDEFINED;
  protected $cargo = UNDEFINED;
  protected $sede = UNDEFINED;
  protected $persona = UNDEFINED;

  public function setDefaultId() { if($this->id === UNDEFINED) $this->setId(uniqid()); }
  public function setDefaultDesde() { if($this->desde === UNDEFINED) $this->setDesde(null); }
  public function setDefaultHasta() { if($this->hasta === UNDEFINED) $this->setHasta(null); }
  public function setDefaultAlta() { if($this->alta === UNDEFINED) $this->setAlta(date('c')); }
  public function setDefaultCargo() { if($this->cargo === UNDEFINED) $this->setCargo(null); }
  public function setDefaultSede() { if($this->sede === UNDEFINED) $this->setSede(null); }
  public function setDefaultPersona() { if($this->persona === UNDEFINED) $this->setPersona(null); }

  public function isEmptyId() { if(!Validation::is_empty($this->id)) return false; }
  public function isEmptyDesde() { if(!Validation::is_empty($this->desde)) return false; }
  public function isEmptyHasta() { if(!Validation::is_empty($this->hasta)) return false; }
  public function isEmptyAlta() { if(!Validation::is_empty($this->alta)) return false; }
  public function isEmptyCargo() { if(!Validation::is_empty($this->cargo)) return false; }
  public function isEmptySede() { if(!Validation::is_empty($this->sede)) return false; }
  public function isEmptyPersona() { if(!Validation::is_empty($this->persona)) return false; }

  public function id() { return $this->id; }
  public function desde($format = null) { return Format::date($this->desde, $format); }
  public function hasta($format = null) { return Format::date($this->hasta, $format); }
  public function alta($format = null) { return Format::date($this->alta, $format); }
  public function cargo($format = null) { return Format::convertCase($this->cargo, $format); }
  public function sede($format = null) { return Format::convertCase($this->sede, $format); }
  public function persona($format = null) { return Format::convertCase($this->persona, $format); }

  public function _setId(string $p = null) { return $this->id = $p; }  
  public function setId($p) { return $this->id = (is_null($p)) ? null : (string)$p; }

  public function _setDesde(DateTime $p = null) { return $this->desde = $p; }  

  public function setDesde($p) {
    if(!is_null($p) && !($p instanceof DateTime)) $p = new SpanishDateTime($p);
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->desde = $p;
  }

  public function setDesdeY($p) {
    if(!is_null($p) && !($p instanceof DateTime)) {
      $p = (strlen($p) == 4) ? SpanishDateTime::createFromFormat('Y', $p) : new SpanishDateTime($p);
    }
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->desde = $p;
  }

  public function _setHasta(DateTime $p = null) { return $this->hasta = $p; }  

  public function setHasta($p) {
    if(!is_null($p) && !($p instanceof DateTime)) $p = new SpanishDateTime($p);
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->hasta = $p;
  }

  public function setHastaY($p) {
    if(!is_null($p) && !($p instanceof DateTime)) {
      $p = (strlen($p) == 4) ? SpanishDateTime::createFromFormat('Y', $p) : new SpanishDateTime($p);
    }
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->hasta = $p;
  }

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

  public function _setCargo(string $p = null) { return $this->cargo = $p; }  
  public function setCargo($p) { return $this->cargo = (is_null($p)) ? null : (string)$p; }

  public function _setSede(string $p = null) { return $this->sede = $p; }  
  public function setSede($p) { return $this->sede = (is_null($p)) ? null : (string)$p; }

  public function _setPersona(string $p = null) { return $this->persona = $p; }  
  public function setPersona($p) { return $this->persona = (is_null($p)) ? null : (string)$p; }

  public function resetId() { if(!Validation::is_empty($this->id)) $this->id = preg_replace('/\s\s+/', ' ', trim($this->id)); }
  public function resetCargo() { if(!Validation::is_empty($this->cargo)) $this->cargo = preg_replace('/\s\s+/', ' ', trim($this->cargo)); }
  public function resetSede() { if(!Validation::is_empty($this->sede)) $this->sede = preg_replace('/\s\s+/', ' ', trim($this->sede)); }
  public function resetPersona() { if(!Validation::is_empty($this->persona)) $this->persona = preg_replace('/\s\s+/', ' ', trim($this->persona)); }

  public function checkId() { 
      if(Validation::is_undefined($this->id)) return null;
      return true; 
  }

  public function checkDesde() { 
      $this->_logs->resetLogs("desde");
      if(Validation::is_undefined($this->desde)) return null;
      $v = Validation::getInstanceValue($this->desde)->isA('DateTime');
      foreach($v->getErrors() as $error){ $this->_logs->addLog("desde", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkHasta() { 
      $this->_logs->resetLogs("hasta");
      if(Validation::is_undefined($this->hasta)) return null;
      $v = Validation::getInstanceValue($this->hasta)->isA('DateTime');
      foreach($v->getErrors() as $error){ $this->_logs->addLog("hasta", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkAlta() { 
      $this->_logs->resetLogs("alta");
      if(Validation::is_undefined($this->alta)) return null;
      $v = Validation::getInstanceValue($this->alta)->required()->isA('DateTime');
      foreach($v->getErrors() as $error){ $this->_logs->addLog("alta", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkCargo() { 
      $this->_logs->resetLogs("cargo");
      if(Validation::is_undefined($this->cargo)) return null;
      $v = Validation::getInstanceValue($this->cargo)->required()->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("cargo", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkSede() { 
      $this->_logs->resetLogs("sede");
      if(Validation::is_undefined($this->sede)) return null;
      $v = Validation::getInstanceValue($this->sede)->required()->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("sede", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkPersona() { 
      $this->_logs->resetLogs("persona");
      if(Validation::is_undefined($this->persona)) return null;
      $v = Validation::getInstanceValue($this->persona)->required()->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("persona", "error", $error); }
      return $v->isSuccess();
    }
  
    public function sqlId() { return $this->sql->string($this->id); }
  public function sqlDesde() { return $this->sql->dateTime($this->desde, "Y-m-d"); }
  public function sqlDesdeYm() { return $this->sql->dateTime($this->desde, "Y-m"); }
  public function sqlDesdeY() { return $this->sql->dateTime($this->desde, "Y"); }
  public function sqlHasta() { return $this->sql->dateTime($this->hasta, "Y-m-d"); }
  public function sqlHastaYm() { return $this->sql->dateTime($this->hasta, "Y-m"); }
  public function sqlHastaY() { return $this->sql->dateTime($this->hasta, "Y"); }
  public function sqlAlta() { return $this->sql->dateTime($this->alta, "Y-m-d H:i:s"); }
  public function sqlAltaDate() { return $this->sql->dateTime($this->alta, "Y-m-d"); }
  public function sqlAltaYm() { return $this->sql->dateTime($this->alta, "Y-m"); }
  public function sqlAltaY() { return $this->sql->dateTime($this->alta, "Y"); }
  public function sqlCargo() { return $this->sql->string($this->cargo); }
  public function sqlSede() { return $this->sql->string($this->sede); }
  public function sqlPersona() { return $this->sql->string($this->persona); }

  public function jsonId() { return $this->id; }
  public function jsonDesde() { return $this->desde('c'); }
  public function jsonHasta() { return $this->hasta('c'); }
  public function jsonAlta() { return $this->alta('c'); }
  public function jsonCargo() { return $this->cargo; }
  public function jsonSede() { return $this->sede; }
  public function jsonPersona() { return $this->persona; }



}
