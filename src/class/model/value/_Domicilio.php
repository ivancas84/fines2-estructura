<?php
require_once("class/model/entityOptions/Value.php");

class _DomicilioValue extends ValueEntityOptions{

  protected $id = UNDEFINED;
  protected $calle = UNDEFINED;
  protected $entre = UNDEFINED;
  protected $numero = UNDEFINED;
  protected $piso = UNDEFINED;
  protected $departamento = UNDEFINED;
  protected $barrio = UNDEFINED;
  protected $localidad = UNDEFINED;

  public function setDefaultId() { if($this->id === UNDEFINED) $this->setId(uniqid()); }
  public function setDefaultCalle() { if($this->calle === UNDEFINED) $this->setCalle(null); }
  public function setDefaultEntre() { if($this->entre === UNDEFINED) $this->setEntre(null); }
  public function setDefaultNumero() { if($this->numero === UNDEFINED) $this->setNumero(null); }
  public function setDefaultPiso() { if($this->piso === UNDEFINED) $this->setPiso(null); }
  public function setDefaultDepartamento() { if($this->departamento === UNDEFINED) $this->setDepartamento(null); }
  public function setDefaultBarrio() { if($this->barrio === UNDEFINED) $this->setBarrio(null); }
  public function setDefaultLocalidad() { if($this->localidad === UNDEFINED) $this->setLocalidad(null); }

  public function isEmptyId() { if(!Validation::is_empty($this->id)) return false; }
  public function isEmptyCalle() { if(!Validation::is_empty($this->calle)) return false; }
  public function isEmptyEntre() { if(!Validation::is_empty($this->entre)) return false; }
  public function isEmptyNumero() { if(!Validation::is_empty($this->numero)) return false; }
  public function isEmptyPiso() { if(!Validation::is_empty($this->piso)) return false; }
  public function isEmptyDepartamento() { if(!Validation::is_empty($this->departamento)) return false; }
  public function isEmptyBarrio() { if(!Validation::is_empty($this->barrio)) return false; }
  public function isEmptyLocalidad() { if(!Validation::is_empty($this->localidad)) return false; }

  public function id() { return $this->id; }
  public function calle($format = null) { return Format::convertCase($this->calle, $format); }
  public function entre($format = null) { return Format::convertCase($this->entre, $format); }
  public function numero($format = null) { return Format::convertCase($this->numero, $format); }
  public function piso($format = null) { return Format::convertCase($this->piso, $format); }
  public function departamento($format = null) { return Format::convertCase($this->departamento, $format); }
  public function barrio($format = null) { return Format::convertCase($this->barrio, $format); }
  public function localidad($format = null) { return Format::convertCase($this->localidad, $format); }

  public function _setId(string $p = null) { return $this->id = $p; }  
  public function setId($p) { return $this->id = (is_null($p)) ? null : (string)$p; }

  public function _setCalle(string $p = null) { return $this->calle = $p; }  
  public function setCalle($p) { return $this->calle = (is_null($p)) ? null : (string)$p; }

  public function _setEntre(string $p = null) { return $this->entre = $p; }  
  public function setEntre($p) { return $this->entre = (is_null($p)) ? null : (string)$p; }

  public function _setNumero(string $p = null) { return $this->numero = $p; }  
  public function setNumero($p) { return $this->numero = (is_null($p)) ? null : (string)$p; }

  public function _setPiso(string $p = null) { return $this->piso = $p; }  
  public function setPiso($p) { return $this->piso = (is_null($p)) ? null : (string)$p; }

  public function _setDepartamento(string $p = null) { return $this->departamento = $p; }  
  public function setDepartamento($p) { return $this->departamento = (is_null($p)) ? null : (string)$p; }

  public function _setBarrio(string $p = null) { return $this->barrio = $p; }  
  public function setBarrio($p) { return $this->barrio = (is_null($p)) ? null : (string)$p; }

  public function _setLocalidad(string $p = null) { return $this->localidad = $p; }  
  public function setLocalidad($p) { return $this->localidad = (is_null($p)) ? null : (string)$p; }

  public function resetCalle() { if(!Validation::is_empty($this->calle)) $this->calle = preg_replace('/\s\s+/', ' ', trim($this->calle)); }
  public function resetEntre() { if(!Validation::is_empty($this->entre)) $this->entre = preg_replace('/\s\s+/', ' ', trim($this->entre)); }
  public function resetNumero() { if(!Validation::is_empty($this->numero)) $this->numero = preg_replace('/\s\s+/', ' ', trim($this->numero)); }
  public function resetPiso() { if(!Validation::is_empty($this->piso)) $this->piso = preg_replace('/\s\s+/', ' ', trim($this->piso)); }
  public function resetDepartamento() { if(!Validation::is_empty($this->departamento)) $this->departamento = preg_replace('/\s\s+/', ' ', trim($this->departamento)); }
  public function resetBarrio() { if(!Validation::is_empty($this->barrio)) $this->barrio = preg_replace('/\s\s+/', ' ', trim($this->barrio)); }
  public function resetLocalidad() { if(!Validation::is_empty($this->localidad)) $this->localidad = preg_replace('/\s\s+/', ' ', trim($this->localidad)); }

  public function checkId() { 
      if(Validation::is_undefined($this->id)) return null;
      return true; 
  }

  public function checkCalle() { 
      $this->_logs->resetLogs("calle");
      if(Validation::is_undefined($this->calle)) return null;
      $v = Validation::getInstanceValue($this->calle)->required()->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("calle", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkEntre() { 
      $this->_logs->resetLogs("entre");
      if(Validation::is_undefined($this->entre)) return null;
      $v = Validation::getInstanceValue($this->entre)->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("entre", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkNumero() { 
      $this->_logs->resetLogs("numero");
      if(Validation::is_undefined($this->numero)) return null;
      $v = Validation::getInstanceValue($this->numero)->required()->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("numero", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkPiso() { 
      $this->_logs->resetLogs("piso");
      if(Validation::is_undefined($this->piso)) return null;
      $v = Validation::getInstanceValue($this->piso)->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("piso", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkDepartamento() { 
      $this->_logs->resetLogs("departamento");
      if(Validation::is_undefined($this->departamento)) return null;
      $v = Validation::getInstanceValue($this->departamento)->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("departamento", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkBarrio() { 
      $this->_logs->resetLogs("barrio");
      if(Validation::is_undefined($this->barrio)) return null;
      $v = Validation::getInstanceValue($this->barrio)->max(255);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("barrio", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkLocalidad() { 
      $this->_logs->resetLogs("localidad");
      if(Validation::is_undefined($this->localidad)) return null;
      $v = Validation::getInstanceValue($this->localidad)->required()->max(255);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("localidad", "error", $error); }
      return $v->isSuccess();
    }
  
    public function sqlId() { return $this->sql->string($this->id); }
  public function sqlCalle() { return $this->sql->string($this->calle); }
  public function sqlEntre() { return $this->sql->string($this->entre); }
  public function sqlNumero() { return $this->sql->string($this->numero); }
  public function sqlPiso() { return $this->sql->string($this->piso); }
  public function sqlDepartamento() { return $this->sql->string($this->departamento); }
  public function sqlBarrio() { return $this->sql->string($this->barrio); }
  public function sqlLocalidad() { return $this->sql->string($this->localidad); }

  public function jsonId() { return $this->id; }
  public function jsonCalle() { return $this->calle; }
  public function jsonEntre() { return $this->entre; }
  public function jsonNumero() { return $this->numero; }
  public function jsonPiso() { return $this->piso; }
  public function jsonDepartamento() { return $this->departamento; }
  public function jsonBarrio() { return $this->barrio; }
  public function jsonLocalidad() { return $this->localidad; }



}
