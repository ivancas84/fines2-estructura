<?php
require_once("class/model/entityOptions/Value.php");

class _DiaValue extends ValueEntityOptions{

  protected $id = UNDEFINED;
  protected $numero = UNDEFINED;
  protected $dia = UNDEFINED;

  public function setDefaultId() { if($this->id === UNDEFINED) $this->setId(uniqid()); }
  public function setDefaultNumero() { if($this->numero === UNDEFINED) $this->setNumero(null); }
  public function setDefaultDia() { if($this->dia === UNDEFINED) $this->setDia(null); }

  public function isEmptyId() { if(!Validation::is_empty($this->id)) return false; }
  public function isEmptyNumero() { if(!Validation::is_empty($this->numero)) return false; }
  public function isEmptyDia() { if(!Validation::is_empty($this->dia)) return false; }

  public function id() { return $this->id; }
  public function numero() { return $this->numero; }
  public function dia($format = null) { return Format::convertCase($this->dia, $format); }

  public function _setId(string $p = null) { return $this->id = $p; }  
  public function setId($p) { return $this->id = (is_null($p)) ? null : (string)$p; }

  public function _setNumero(integer $p = null) { return $this->numero = $p; }    
  public function setNumero($p) { return $this->numero = (is_null($p)) ? null : intval($p); }

  public function _setDia(string $p = null) { return $this->dia = $p; }  
  public function setDia($p) { return $this->dia = (is_null($p)) ? null : (string)$p; }

  public function resetDia() { if(!Validation::is_empty($this->dia)) $this->dia = preg_replace('/\s\s+/', ' ', trim($this->dia)); }

  public function checkId() { 
      if(Validation::is_undefined($this->id)) return null;
      return true; 
  }

  public function checkNumero() { 
    $this->_logs->resetLogs("numero");
    if(Validation::is_undefined($this->numero)) return null;
    $v = Validation::getInstanceValue($this->numero)->required()->max(1);
    foreach($v->getErrors() as $error){ $this->_logs->addLog("numero", "error", $error); }
    return $v->isSuccess();
  }

  public function checkDia() { 
    $this->_logs->resetLogs("dia");
    if(Validation::is_undefined($this->dia)) return null;
    $v = Validation::getInstanceValue($this->dia)->required()->max(9);
    foreach($v->getErrors() as $error){ $this->_logs->addLog("dia", "error", $error); }
    return $v->isSuccess();
  }

  public function sqlId() { return $this->_sqlString($this->id); }
  public function sqlNumero() { return $this->_sqlNumber($this->numero); }
  public function sqlDia() { return $this->_sqlString($this->dia); }

  public function jsonId() { return $this->id; }
  public function jsonNumero() { return $this->numero; }
  public function jsonDia() { return $this->dia; }



}
