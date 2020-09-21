<?php
require_once("class/model/entityOptions/Value.php");

class _TelefonoValue extends ValueEntityOptions{

  protected $id = UNDEFINED;
  protected $tipo = UNDEFINED;
  protected $prefijo = UNDEFINED;
  protected $numero = UNDEFINED;
  protected $insertado = UNDEFINED;
  protected $eliminado = UNDEFINED;
  protected $persona = UNDEFINED;

  public function setDefaultId() { if($this->id === UNDEFINED) $this->setId(uniqid()); }
  public function setDefaultTipo() { if($this->tipo === UNDEFINED) $this->setTipo(null); }
  public function setDefaultPrefijo() { if($this->prefijo === UNDEFINED) $this->setPrefijo(null); }
  public function setDefaultNumero() { if($this->numero === UNDEFINED) $this->setNumero(null); }
  public function setDefaultInsertado() { if($this->insertado === UNDEFINED) $this->setInsertado(date('c')); }
  public function setDefaultEliminado() { if($this->eliminado === UNDEFINED) $this->setEliminado(null); }
  public function setDefaultPersona() { if($this->persona === UNDEFINED) $this->setPersona(null); }

  public function isEmptyId() { if(!Validation::is_empty($this->id)) return false; }
  public function isEmptyTipo() { if(!Validation::is_empty($this->tipo)) return false; }
  public function isEmptyPrefijo() { if(!Validation::is_empty($this->prefijo)) return false; }
  public function isEmptyNumero() { if(!Validation::is_empty($this->numero)) return false; }
  public function isEmptyInsertado() { if(!Validation::is_empty($this->insertado)) return false; }
  public function isEmptyEliminado() { if(!Validation::is_empty($this->eliminado)) return false; }
  public function isEmptyPersona() { if(!Validation::is_empty($this->persona)) return false; }

  public function id() { return $this->id; }
  public function tipo($format = null) { return Format::convertCase($this->tipo, $format); }
  public function prefijo($format = null) { return Format::convertCase($this->prefijo, $format); }
  public function numero($format = null) { return Format::convertCase($this->numero, $format); }
  public function insertado($format = null) { return Format::date($this->insertado, $format); }
  public function eliminado($format = null) { return Format::date($this->eliminado, $format); }
  public function persona($format = null) { return Format::convertCase($this->persona, $format); }

  public function _setId(string $p = null) { return $this->id = $p; }  
  public function setId($p) { return $this->id = (is_null($p)) ? null : (string)$p; }

  public function _setTipo(string $p = null) { return $this->tipo = $p; }  
  public function setTipo($p) { return $this->tipo = (is_null($p)) ? null : (string)$p; }

  public function _setPrefijo(string $p = null) { return $this->prefijo = $p; }  
  public function setPrefijo($p) { return $this->prefijo = (is_null($p)) ? null : (string)$p; }

  public function _setNumero(string $p = null) { return $this->numero = $p; }  
  public function setNumero($p) { return $this->numero = (is_null($p)) ? null : (string)$p; }

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
  public function resetTipo() { if(!Validation::is_empty($this->tipo)) $this->tipo = preg_replace('/\s\s+/', ' ', trim($this->tipo)); }
  public function resetPrefijo() { if(!Validation::is_empty($this->prefijo)) $this->prefijo = preg_replace('/\s\s+/', ' ', trim($this->prefijo)); }
  public function resetNumero() { if(!Validation::is_empty($this->numero)) $this->numero = preg_replace('/\s\s+/', ' ', trim($this->numero)); }
  public function resetPersona() { if(!Validation::is_empty($this->persona)) $this->persona = preg_replace('/\s\s+/', ' ', trim($this->persona)); }

  public function checkId() { 
      if(Validation::is_undefined($this->id)) return null;
      return true; 
  }

  public function checkTipo() { 
      $this->_logs->resetLogs("tipo");
      if(Validation::is_undefined($this->tipo)) return null;
      $v = Validation::getInstanceValue($this->tipo)->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("tipo", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkPrefijo() { 
      $this->_logs->resetLogs("prefijo");
      if(Validation::is_undefined($this->prefijo)) return null;
      $v = Validation::getInstanceValue($this->prefijo)->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("prefijo", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkNumero() { 
      $this->_logs->resetLogs("numero");
      if(Validation::is_undefined($this->numero)) return null;
      $v = Validation::getInstanceValue($this->numero)->required()->max(255);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("numero", "error", $error); }
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
  public function sqlTipo() { return $this->sql->string($this->tipo); }
  public function sqlPrefijo() { return $this->sql->string($this->prefijo); }
  public function sqlNumero() { return $this->sql->string($this->numero); }
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
  public function jsonTipo() { return $this->tipo; }
  public function jsonPrefijo() { return $this->prefijo; }
  public function jsonNumero() { return $this->numero; }
  public function jsonInsertado() { return $this->insertado('c'); }
  public function jsonEliminado() { return $this->eliminado('c'); }
  public function jsonPersona() { return $this->persona; }



}
