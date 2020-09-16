<?php
require_once("class/model/entityOptions/Value.php");

class _DetallePersonaValue extends ValueEntityOptions{

  protected $id = UNDEFINED;
  protected $descripcion = UNDEFINED;
  protected $creado = UNDEFINED;
  protected $archivo = UNDEFINED;
  protected $persona = UNDEFINED;

  public function setDefaultId() { if($this->id === UNDEFINED) $this->setId(uniqid()); }
  public function setDefaultDescripcion() { if($this->descripcion === UNDEFINED) $this->setDescripcion(null); }
  public function setDefaultCreado() { if($this->creado === UNDEFINED) $this->setCreado(date('c')); }
  public function setDefaultArchivo() { if($this->archivo === UNDEFINED) $this->setArchivo(null); }
  public function setDefaultPersona() { if($this->persona === UNDEFINED) $this->setPersona(null); }

  public function isEmptyId() { if(!Validation::is_empty($this->id)) return false; }
  public function isEmptyDescripcion() { if(!Validation::is_empty($this->descripcion)) return false; }
  public function isEmptyCreado() { if(!Validation::is_empty($this->creado)) return false; }
  public function isEmptyArchivo() { if(!Validation::is_empty($this->archivo)) return false; }
  public function isEmptyPersona() { if(!Validation::is_empty($this->persona)) return false; }

  public function id() { return $this->id; }
  public function descripcion($format = null) { return Format::convertCase($this->descripcion, $format); }
  public function creado($format = null) { return Format::date($this->creado, $format); }
  public function archivo($format = null) { return Format::convertCase($this->archivo, $format); }
  public function persona($format = null) { return Format::convertCase($this->persona, $format); }

  public function _setId(string $p = null) { return $this->id = $p; }  
  public function setId($p) { return $this->id = (is_null($p)) ? null : (string)$p; }

  public function _setDescripcion(string $p = null) { return $this->descripcion = $p; }  
  public function setDescripcion($p) { return $this->descripcion = (is_null($p)) ? null : (string)$p; }

  public function _setCreado(DateTime $p = null) { return $this->creado = $p; }  

  public function setCreado($p) {
    if(!is_null($p) && !($p instanceof DateTime)) $p = new SpanishDateTime($p);
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->creado = $p;
  }

  public function setCreadoY($p) {
    if(!is_null($p) && !($p instanceof DateTime)) {
      $p = (strlen($p) == 4) ? SpanishDateTime::createFromFormat('Y', $p) : new SpanishDateTime($p);
    }
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->creado = $p;
  }

  public function _setArchivo(string $p = null) { return $this->archivo = $p; }  
  public function setArchivo($p) { return $this->archivo = (is_null($p)) ? null : (string)$p; }

  public function _setPersona(string $p = null) { return $this->persona = $p; }  
  public function setPersona($p) { return $this->persona = (is_null($p)) ? null : (string)$p; }

  public function resetDescripcion() { if(!Validation::is_empty($this->descripcion)) $this->descripcion = preg_replace('/\s\s+/', ' ', trim($this->descripcion)); }

  public function checkId() { 
      if(Validation::is_undefined($this->id)) return null;
      return true; 
  }

  public function checkDescripcion() { 
      $this->_logs->resetLogs("descripcion");
      if(Validation::is_undefined($this->descripcion)) return null;
      $v = Validation::getInstanceValue($this->descripcion)->required()->max(255);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("descripcion", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkCreado() { 
      $this->_logs->resetLogs("creado");
      if(Validation::is_undefined($this->creado)) return null;
      $v = Validation::getInstanceValue($this->creado)->required()->isA('DateTime');
      foreach($v->getErrors() as $error){ $this->_logs->addLog("creado", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkArchivo() { 
      $this->_logs->resetLogs("archivo");
      if(Validation::is_undefined($this->archivo)) return null;
      $v = Validation::getInstanceValue($this->archivo)->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("archivo", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkPersona() { 
      $this->_logs->resetLogs("persona");
      if(Validation::is_undefined($this->persona)) return null;
      $v = Validation::getInstanceValue($this->persona)->required()->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("persona", "error", $error); }
      return $v->isSuccess();
    }
  
    public function sqlId() { return $this->_sqlString($this->id); }
  public function sqlDescripcion() { return $this->_sqlString($this->descripcion); }
  public function sqlCreado() { return $this->_sqlDateTime($this->creado, "Y-m-d H:i:s"); }
  public function sqlCreadoDate() { return $this->_sqlDateTime($this->creado, "Y-m-d"); }
  public function sqlCreadoYm() { return $this->_sqlDateTime($this->creado, "Y-m"); }
  public function sqlCreadoY() { return $this->_sqlDateTime($this->creado, "Y"); }
  public function sqlArchivo() { return $this->_sqlString($this->archivo); }
  public function sqlPersona() { return $this->_sqlString($this->persona); }

  public function jsonId() { return $this->id; }
  public function jsonDescripcion() { return $this->descripcion; }
  public function jsonCreado() { return $this->creado('c'); }
  public function jsonArchivo() { return $this->archivo; }
  public function jsonPersona() { return $this->persona; }



}
