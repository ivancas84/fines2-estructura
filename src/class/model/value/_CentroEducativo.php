<?php
require_once("class/model/entityOptions/Value.php");

class _CentroEducativoValue extends ValueEntityOptions{

  protected $id = UNDEFINED;
  protected $nombre = UNDEFINED;
  protected $cue = UNDEFINED;
  protected $domicilio = UNDEFINED;

  public function setDefaultId() { if($this->id === UNDEFINED) $this->setId(uniqid()); }
  public function setDefaultNombre() { if($this->nombre === UNDEFINED) $this->setNombre(null); }
  public function setDefaultCue() { if($this->cue === UNDEFINED) $this->setCue(null); }
  public function setDefaultDomicilio() { if($this->domicilio === UNDEFINED) $this->setDomicilio(null); }

  public function isEmptyId() { if(!Validation::is_empty($this->id)) return false; }
  public function isEmptyNombre() { if(!Validation::is_empty($this->nombre)) return false; }
  public function isEmptyCue() { if(!Validation::is_empty($this->cue)) return false; }
  public function isEmptyDomicilio() { if(!Validation::is_empty($this->domicilio)) return false; }

  public function id() { return $this->id; }
  public function nombre($format = null) { return Format::convertCase($this->nombre, $format); }
  public function cue($format = null) { return Format::convertCase($this->cue, $format); }
  public function domicilio($format = null) { return Format::convertCase($this->domicilio, $format); }

  public function _setId(string $p = null) { return $this->id = $p; }  
  public function setId($p) { return $this->id = (is_null($p)) ? null : (string)$p; }

  public function _setNombre(string $p = null) { return $this->nombre = $p; }  
  public function setNombre($p) { return $this->nombre = (is_null($p)) ? null : (string)$p; }

  public function _setCue(string $p = null) { return $this->cue = $p; }  
  public function setCue($p) { return $this->cue = (is_null($p)) ? null : (string)$p; }

  public function _setDomicilio(string $p = null) { return $this->domicilio = $p; }  
  public function setDomicilio($p) { return $this->domicilio = (is_null($p)) ? null : (string)$p; }

  public function resetNombre() { if(!Validation::is_empty($this->nombre)) $this->nombre = preg_replace('/\s\s+/', ' ', trim($this->nombre)); }
  public function resetCue() { if(!Validation::is_empty($this->cue)) $this->cue = preg_replace('/\s\s+/', ' ', trim($this->cue)); }

  public function checkId() { 
      if(Validation::is_undefined($this->id)) return null;
      return true; 
  }

  public function checkNombre() { 
    $this->_logs->resetLogs("nombre");
    if(Validation::is_undefined($this->nombre)) return null;
    $v = Validation::getInstanceValue($this->nombre)->required()->max(255);
    foreach($v->getErrors() as $error){ $this->_logs->addLog("nombre", "error", $error); }
    return $v->isSuccess();
  }

  public function checkCue() { 
    $this->_logs->resetLogs("cue");
    if(Validation::is_undefined($this->cue)) return null;
    $v = Validation::getInstanceValue($this->cue)->max(45);
    foreach($v->getErrors() as $error){ $this->_logs->addLog("cue", "error", $error); }
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
  public function sqlNombre() { return $this->_sqlString($this->nombre); }
  public function sqlCue() { return $this->_sqlString($this->cue); }
  public function sqlDomicilio() { return $this->_sqlString($this->domicilio); }

  public function jsonId() { return $this->id; }
  public function jsonNombre() { return $this->nombre; }
  public function jsonCue() { return $this->cue; }
  public function jsonDomicilio() { return $this->domicilio; }



}
