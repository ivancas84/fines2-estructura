<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _Domicilio extends EntityValues {
  protected $id = UNDEFINED;
  protected $calle = UNDEFINED;
  protected $entre = UNDEFINED;
  protected $numero = UNDEFINED;
  protected $piso = UNDEFINED;
  protected $departamento = UNDEFINED;
  protected $barrio = UNDEFINED;
  protected $localidad = UNDEFINED;

  public function _setDefault(){
    if($this->id == UNDEFINED) $this->setId(uniqid());
    if($this->calle == UNDEFINED) $this->setCalle(null);
    if($this->entre == UNDEFINED) $this->setEntre(null);
    if($this->numero == UNDEFINED) $this->setNumero(null);
    if($this->piso == UNDEFINED) $this->setPiso(null);
    if($this->departamento == UNDEFINED) $this->setDepartamento(null);
    if($this->barrio == UNDEFINED) $this->setBarrio(null);
    if($this->localidad == UNDEFINED) $this->setLocalidad(null);
    return $this;
  }

  public function _fromArray(array $row = NULL, string $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."calle"])) $this->setCalle($row[$p."calle"]);
    if(isset($row[$p."entre"])) $this->setEntre($row[$p."entre"]);
    if(isset($row[$p."numero"])) $this->setNumero($row[$p."numero"]);
    if(isset($row[$p."piso"])) $this->setPiso($row[$p."piso"]);
    if(isset($row[$p."departamento"])) $this->setDepartamento($row[$p."departamento"]);
    if(isset($row[$p."barrio"])) $this->setBarrio($row[$p."barrio"]);
    if(isset($row[$p."localidad"])) $this->setLocalidad($row[$p."localidad"]);
    return $this;
  }

  public function _toArray(string $p = ""){
    $row = [];
    if($this->id !== UNDEFINED) $row[$p."id"] = $this->id();
    if($this->calle !== UNDEFINED) $row[$p."calle"] = $this->calle();
    if($this->entre !== UNDEFINED) $row[$p."entre"] = $this->entre();
    if($this->numero !== UNDEFINED) $row[$p."numero"] = $this->numero();
    if($this->piso !== UNDEFINED) $row[$p."piso"] = $this->piso();
    if($this->departamento !== UNDEFINED) $row[$p."departamento"] = $this->departamento();
    if($this->barrio !== UNDEFINED) $row[$p."barrio"] = $this->barrio();
    if($this->localidad !== UNDEFINED) $row[$p."localidad"] = $this->localidad();
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->calle)) return false;
    if(!Validation::is_empty($this->entre)) return false;
    if(!Validation::is_empty($this->numero)) return false;
    if(!Validation::is_empty($this->piso)) return false;
    if(!Validation::is_empty($this->departamento)) return false;
    if(!Validation::is_empty($this->barrio)) return false;
    if(!Validation::is_empty($this->localidad)) return false;
    return true;
  }

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

  public function checkId($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkCalle($value) { 
    $this->_logs->resetLogs("calle");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required()->max(45);
    foreach($v->getErrors() as $error){ $this->_logs->addLog("calle", "error", $error); }
    return $v->isSuccess();
  }

  public function checkEntre($value) { 
    $this->_logs->resetLogs("entre");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->max(45);
    foreach($v->getErrors() as $error){ $this->_logs->addLog("entre", "error", $error); }
    return $v->isSuccess();
  }

  public function checkNumero($value) { 
    $this->_logs->resetLogs("numero");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required()->max(45);
    foreach($v->getErrors() as $error){ $this->_logs->addLog("numero", "error", $error); }
    return $v->isSuccess();
  }

  public function checkPiso($value) { 
    $this->_logs->resetLogs("piso");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->max(45);
    foreach($v->getErrors() as $error){ $this->_logs->addLog("piso", "error", $error); }
    return $v->isSuccess();
  }

  public function checkDepartamento($value) { 
    $this->_logs->resetLogs("departamento");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->max(45);
    foreach($v->getErrors() as $error){ $this->_logs->addLog("departamento", "error", $error); }
    return $v->isSuccess();
  }

  public function checkBarrio($value) { 
    $this->_logs->resetLogs("barrio");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->max(255);
    foreach($v->getErrors() as $error){ $this->_logs->addLog("barrio", "error", $error); }
    return $v->isSuccess();
  }

  public function checkLocalidad($value) { 
    $this->_logs->resetLogs("localidad");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required()->max(255);
    foreach($v->getErrors() as $error){ $this->_logs->addLog("localidad", "error", $error); }
    return $v->isSuccess();
  }

  public function _check(){
    $this->checkId($this->id);
    $this->checkCalle($this->calle);
    $this->checkEntre($this->entre);
    $this->checkNumero($this->numero);
    $this->checkPiso($this->piso);
    $this->checkDepartamento($this->departamento);
    $this->checkBarrio($this->barrio);
    $this->checkLocalidad($this->localidad);
    return !$this->_getLogs()->isError();
  }

  public function _reset(){
    $this->resetCalle();
    $this->resetEntre();
    $this->resetNumero();
    $this->resetPiso();
    $this->resetDepartamento();
    $this->resetBarrio();
    $this->resetLocalidad();
    return $this;
  }



}
