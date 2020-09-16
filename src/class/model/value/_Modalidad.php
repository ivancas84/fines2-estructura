<?php
require_once("class/model/entityOptions/Value.php");

class _ModalidadValue extends ValueEntityOptions{

  protected $id = UNDEFINED;
  protected $nombre = UNDEFINED;

  public function setDefaultId() { if($this->id === UNDEFINED) $this->setId(uniqid()); }
  public function setDefaultNombre() { if($this->nombre === UNDEFINED) $this->setNombre(null); }

  public function isEmptyId() { if(!Validation::is_empty($this->id)) return false; }
  public function isEmptyNombre() { if(!Validation::is_empty($this->nombre)) return false; }

  public function id() { return $this->id; }
  public function nombre($format = null) { return Format::convertCase($this->nombre, $format); }

  public function _setId(string $p = null) { return $this->id = $p; }  
  public function setId($p) { return $this->id = (is_null($p)) ? null : (string)$p; }

  public function _setNombre(string $p = null) { return $this->nombre = $p; }  
  public function setNombre($p) { return $this->nombre = (is_null($p)) ? null : (string)$p; }

  public function resetNombre() { if(!Validation::is_empty($this->nombre)) $this->nombre = preg_replace('/\s\s+/', ' ', trim($this->nombre)); }

  public function checkId() { 
      if(Validation::is_undefined($this->id)) return null;
      return true; 
  }

  public function checkNombre() { 
      $this->_logs->resetLogs("nombre");
      if(Validation::is_undefined($this->nombre)) return null;
      $v = Validation::getInstanceValue($this->nombre)->required()->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("nombre", "error", $error); }
      return $v->isSuccess();
    }
  
    public function sqlId() { return $this->_sqlString($this->id); }
  public function sqlNombre() { return $this->_sqlString($this->nombre); }

  public function jsonId() { return $this->id; }
  public function jsonNombre() { return $this->nombre; }



}
