<?php
require_once("class/model/entityOptions/Value.php");

class _AsignaturaValue extends ValueEntityOptions{

  protected $id = UNDEFINED;
  protected $nombre = UNDEFINED;
  protected $formacion = UNDEFINED;
  protected $clasificacion = UNDEFINED;
  protected $codigo = UNDEFINED;
  protected $perfil = UNDEFINED;

  public function setDefaultId() { if($this->id === UNDEFINED) $this->setId(uniqid()); }
  public function setDefaultNombre() { if($this->nombre === UNDEFINED) $this->setNombre(null); }
  public function setDefaultFormacion() { if($this->formacion === UNDEFINED) $this->setFormacion(null); }
  public function setDefaultClasificacion() { if($this->clasificacion === UNDEFINED) $this->setClasificacion(null); }
  public function setDefaultCodigo() { if($this->codigo === UNDEFINED) $this->setCodigo(null); }
  public function setDefaultPerfil() { if($this->perfil === UNDEFINED) $this->setPerfil(null); }

  public function isEmptyId() { if(!Validation::is_empty($this->id)) return false; }
  public function isEmptyNombre() { if(!Validation::is_empty($this->nombre)) return false; }
  public function isEmptyFormacion() { if(!Validation::is_empty($this->formacion)) return false; }
  public function isEmptyClasificacion() { if(!Validation::is_empty($this->clasificacion)) return false; }
  public function isEmptyCodigo() { if(!Validation::is_empty($this->codigo)) return false; }
  public function isEmptyPerfil() { if(!Validation::is_empty($this->perfil)) return false; }

  public function id() { return $this->id; }
  public function nombre($format = null) { return Format::convertCase($this->nombre, $format); }
  public function formacion($format = null) { return Format::convertCase($this->formacion, $format); }
  public function clasificacion($format = null) { return Format::convertCase($this->clasificacion, $format); }
  public function codigo($format = null) { return Format::convertCase($this->codigo, $format); }
  public function perfil($format = null) { return Format::convertCase($this->perfil, $format); }

  public function _setId(string $p = null) { return $this->id = $p; }  
  public function setId($p) { return $this->id = (is_null($p)) ? null : (string)$p; }

  public function _setNombre(string $p = null) { return $this->nombre = $p; }  
  public function setNombre($p) { return $this->nombre = (is_null($p)) ? null : (string)$p; }

  public function _setFormacion(string $p = null) { return $this->formacion = $p; }  
  public function setFormacion($p) { return $this->formacion = (is_null($p)) ? null : (string)$p; }

  public function _setClasificacion(string $p = null) { return $this->clasificacion = $p; }  
  public function setClasificacion($p) { return $this->clasificacion = (is_null($p)) ? null : (string)$p; }

  public function _setCodigo(string $p = null) { return $this->codigo = $p; }  
  public function setCodigo($p) { return $this->codigo = (is_null($p)) ? null : (string)$p; }

  public function _setPerfil(string $p = null) { return $this->perfil = $p; }  
  public function setPerfil($p) { return $this->perfil = (is_null($p)) ? null : (string)$p; }

  public function resetNombre() { if(!Validation::is_empty($this->nombre)) $this->nombre = preg_replace('/\s\s+/', ' ', trim($this->nombre)); }
  public function resetFormacion() { if(!Validation::is_empty($this->formacion)) $this->formacion = preg_replace('/\s\s+/', ' ', trim($this->formacion)); }
  public function resetClasificacion() { if(!Validation::is_empty($this->clasificacion)) $this->clasificacion = preg_replace('/\s\s+/', ' ', trim($this->clasificacion)); }
  public function resetCodigo() { if(!Validation::is_empty($this->codigo)) $this->codigo = preg_replace('/\s\s+/', ' ', trim($this->codigo)); }
  public function resetPerfil() { if(!Validation::is_empty($this->perfil)) $this->perfil = preg_replace('/\s\s+/', ' ', trim($this->perfil)); }

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
  
    public function checkFormacion() { 
      $this->_logs->resetLogs("formacion");
      if(Validation::is_undefined($this->formacion)) return null;
      $v = Validation::getInstanceValue($this->formacion)->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("formacion", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkClasificacion() { 
      $this->_logs->resetLogs("clasificacion");
      if(Validation::is_undefined($this->clasificacion)) return null;
      $v = Validation::getInstanceValue($this->clasificacion)->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("clasificacion", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkCodigo() { 
      $this->_logs->resetLogs("codigo");
      if(Validation::is_undefined($this->codigo)) return null;
      $v = Validation::getInstanceValue($this->codigo)->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("codigo", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkPerfil() { 
      $this->_logs->resetLogs("perfil");
      if(Validation::is_undefined($this->perfil)) return null;
      $v = Validation::getInstanceValue($this->perfil)->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("perfil", "error", $error); }
      return $v->isSuccess();
    }
  
    public function sqlId() { return $this->_sqlString($this->id); }
  public function sqlNombre() { return $this->_sqlString($this->nombre); }
  public function sqlFormacion() { return $this->_sqlString($this->formacion); }
  public function sqlClasificacion() { return $this->_sqlString($this->clasificacion); }
  public function sqlCodigo() { return $this->_sqlString($this->codigo); }
  public function sqlPerfil() { return $this->_sqlString($this->perfil); }

  public function jsonId() { return $this->id; }
  public function jsonNombre() { return $this->nombre; }
  public function jsonFormacion() { return $this->formacion; }
  public function jsonClasificacion() { return $this->clasificacion; }
  public function jsonCodigo() { return $this->codigo; }
  public function jsonPerfil() { return $this->perfil; }



}
