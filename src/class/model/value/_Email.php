<?php
require_once("class/model/entityOptions/Value.php");

class _EmailValue extends ValueEntityOptions{

  protected $id = UNDEFINED;
  protected $email = UNDEFINED;
  protected $verificado = UNDEFINED;
  protected $insertado = UNDEFINED;
  protected $eliminado = UNDEFINED;
  protected $persona = UNDEFINED;

  public function setDefaultId() { if($this->id === UNDEFINED) $this->setId(uniqid()); }
  public function setDefaultEmail() { if($this->email === UNDEFINED) $this->setEmail(null); }
  public function setDefaultVerificado() { if($this->verificado === UNDEFINED) $this->setVerificado(false); }
  public function setDefaultInsertado() { if($this->insertado === UNDEFINED) $this->setInsertado(date('c')); }
  public function setDefaultEliminado() { if($this->eliminado === UNDEFINED) $this->setEliminado(null); }
  public function setDefaultPersona() { if($this->persona === UNDEFINED) $this->setPersona(null); }

  public function isEmptyId() { if(!Validation::is_empty($this->id)) return false; }
  public function isEmptyEmail() { if(!Validation::is_empty($this->email)) return false; }
  public function isEmptyVerificado() { if(!Validation::is_empty($this->verificado)) return false; }
  public function isEmptyInsertado() { if(!Validation::is_empty($this->insertado)) return false; }
  public function isEmptyEliminado() { if(!Validation::is_empty($this->eliminado)) return false; }
  public function isEmptyPersona() { if(!Validation::is_empty($this->persona)) return false; }

  public function id() { return $this->id; }
  public function email($format = null) { return Format::convertCase($this->email, $format); }
  public function verificado($format = null) { return Format::boolean($this->verificado, $format); }
  public function insertado($format = null) { return Format::date($this->insertado, $format); }
  public function eliminado($format = null) { return Format::date($this->eliminado, $format); }
  public function persona($format = null) { return Format::convertCase($this->persona, $format); }

  public function _setId(string $p = null) { return $this->id = $p; }  
  public function setId($p) { return $this->id = (is_null($p)) ? null : (string)$p; }

  public function _setEmail(string $p = null) { return $this->email = $p; }  
  public function setEmail($p) { return $this->email = (is_null($p)) ? null : (string)$p; }

  public function _setVerificado(boolean $p = null) { return $this->verificado = $p; }  
  public function setVerificado($p) { return $this->verificado = settypebool($p); }

  public function _setInsertado(DateTime $p = null) { return $this->insertado = $p; }  

  public function setInsertado($p) {
    if(!is_null($p) && !($p instanceof DateTime)) $p = new SpanishDateTime($p);
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->insertado = $p;
  }

  public function setInsertadoY($p) {
    if(!is_null($p) && !($p instanceof DateTime)) {
      $p = (strlen($p) == 4) ? SpanishDateTime::createFromFormat('Y', $p) : new SpanishDateTime($p);
    }
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->insertado = $p;
  }

  public function _setEliminado(DateTime $p = null) { return $this->eliminado = $p; }  

  public function setEliminado($p) {
    if(!is_null($p) && !($p instanceof DateTime)) $p = new SpanishDateTime($p);
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->eliminado = $p;
  }

  public function setEliminadoY($p) {
    if(!is_null($p) && !($p instanceof DateTime)) {
      $p = (strlen($p) == 4) ? SpanishDateTime::createFromFormat('Y', $p) : new SpanishDateTime($p);
    }
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->eliminado = $p;
  }

  public function _setPersona(string $p = null) { return $this->persona = $p; }  
  public function setPersona($p) { return $this->persona = (is_null($p)) ? null : (string)$p; }

  public function resetId() { if(!Validation::is_empty($this->id)) $this->id = preg_replace('/\s\s+/', ' ', trim($this->id)); }
  public function resetEmail() { if(!Validation::is_empty($this->email)) $this->email = preg_replace('/\s\s+/', ' ', trim($this->email)); }
  public function resetPersona() { if(!Validation::is_empty($this->persona)) $this->persona = preg_replace('/\s\s+/', ' ', trim($this->persona)); }

  public function checkId() { 
      if(Validation::is_undefined($this->id)) return null;
      return true; 
  }

  public function checkEmail() { 
      $this->_logs->resetLogs("email");
      if(Validation::is_undefined($this->email)) return null;
      $v = Validation::getInstanceValue($this->email)->required()->max(255);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("email", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkVerificado() { 
      $this->_logs->resetLogs("verificado");
      if(Validation::is_undefined($this->verificado)) return null;
      $v = Validation::getInstanceValue($this->verificado)->boolean();
      foreach($v->getErrors() as $error){ $this->_logs->addLog("verificado", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkInsertado() { 
      $this->_logs->resetLogs("insertado");
      if(Validation::is_undefined($this->insertado)) return null;
      $v = Validation::getInstanceValue($this->insertado)->required()->isA('DateTime');
      foreach($v->getErrors() as $error){ $this->_logs->addLog("insertado", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkEliminado() { 
      $this->_logs->resetLogs("eliminado");
      if(Validation::is_undefined($this->eliminado)) return null;
      $v = Validation::getInstanceValue($this->eliminado)->isA('DateTime');
      foreach($v->getErrors() as $error){ $this->_logs->addLog("eliminado", "error", $error); }
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
  public function sqlEmail() { return $this->sql->string($this->email); }
  public function sqlVerificado() { return $this->sql->boolean($this->verificado); }
  public function sqlInsertado() { return $this->sql->dateTime($this->insertado, "Y-m-d H:i:s"); }
  public function sqlInsertadoDate() { return $this->sql->dateTime($this->insertado, "Y-m-d"); }
  public function sqlInsertadoYm() { return $this->sql->dateTime($this->insertado, "Y-m"); }
  public function sqlInsertadoY() { return $this->sql->dateTime($this->insertado, "Y"); }
  public function sqlEliminado() { return $this->sql->dateTime($this->eliminado, "Y-m-d H:i:s"); }
  public function sqlEliminadoDate() { return $this->sql->dateTime($this->eliminado, "Y-m-d"); }
  public function sqlEliminadoYm() { return $this->sql->dateTime($this->eliminado, "Y-m"); }
  public function sqlEliminadoY() { return $this->sql->dateTime($this->eliminado, "Y"); }
  public function sqlPersona() { return $this->sql->string($this->persona); }

  public function jsonId() { return $this->id; }
  public function jsonEmail() { return $this->email; }
  public function jsonVerificado() { return $this->verificado; }
  public function jsonInsertado() { return $this->insertado('c'); }
  public function jsonEliminado() { return $this->eliminado('c'); }
  public function jsonPersona() { return $this->persona; }



}
