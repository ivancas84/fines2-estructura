<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _Asignatura extends EntityValues {
  protected $id = UNDEFINED;
  protected $nombre = UNDEFINED;
  protected $formacion = UNDEFINED;
  protected $clasificacion = UNDEFINED;
  protected $codigo = UNDEFINED;
  protected $perfil = UNDEFINED;

  public function _setDefault(){
    if($this->id == UNDEFINED) $this->setId(null);
    if($this->nombre == UNDEFINED) $this->setNombre(null);
    if($this->formacion == UNDEFINED) $this->setFormacion(null);
    if($this->clasificacion == UNDEFINED) $this->setClasificacion(null);
    if($this->codigo == UNDEFINED) $this->setCodigo(null);
    if($this->perfil == UNDEFINED) $this->setPerfil(null);
    return $this;
  }

  public function _fromArray(array $row = NULL, string $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."nombre"])) $this->setNombre($row[$p."nombre"]);
    if(isset($row[$p."formacion"])) $this->setFormacion($row[$p."formacion"]);
    if(isset($row[$p."clasificacion"])) $this->setClasificacion($row[$p."clasificacion"]);
    if(isset($row[$p."codigo"])) $this->setCodigo($row[$p."codigo"]);
    if(isset($row[$p."perfil"])) $this->setPerfil($row[$p."perfil"]);
    return $this;
  }

  public function _toArray(string $p = ""){
    $row = [];
    if($this->id !== UNDEFINED) $row[$p."id"] = $this->id();
    if($this->nombre !== UNDEFINED) $row[$p."nombre"] = $this->nombre();
    if($this->formacion !== UNDEFINED) $row[$p."formacion"] = $this->formacion();
    if($this->clasificacion !== UNDEFINED) $row[$p."clasificacion"] = $this->clasificacion();
    if($this->codigo !== UNDEFINED) $row[$p."codigo"] = $this->codigo();
    if($this->perfil !== UNDEFINED) $row[$p."perfil"] = $this->perfil();
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->nombre)) return false;
    if(!Validation::is_empty($this->formacion)) return false;
    if(!Validation::is_empty($this->clasificacion)) return false;
    if(!Validation::is_empty($this->codigo)) return false;
    if(!Validation::is_empty($this->perfil)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function nombre($format = null) { return Format::convertCase($this->nombre, $format); }
  public function formacion($format = null) { return Format::convertCase($this->formacion, $format); }
  public function clasificacion($format = null) { return Format::convertCase($this->clasificacion, $format); }
  public function codigo($format = null) { return Format::convertCase($this->codigo, $format); }
  public function perfil($format = null) { return Format::convertCase($this->perfil, $format); }

  public function setId($p) { $this->id = (is_null($p)) ? null : (string)$p; }
  public function setNombre($p) { $this->nombre = (is_null($p)) ? null : (string)$p; }
  public function setFormacion($p) { $this->formacion = (is_null($p)) ? null : (string)$p; }
  public function setClasificacion($p) { $this->clasificacion = (is_null($p)) ? null : (string)$p; }
  public function setCodigo($p) { $this->codigo = (is_null($p)) ? null : (string)$p; }
  public function setPerfil($p) { $this->perfil = (is_null($p)) ? null : (string)$p; }

  public function resetNombre() { if(!Validation::is_empty($this->nombre)) $this->nombre = preg_replace('/\s\s+/', ' ', trim($this->nombre)); }
  public function resetFormacion() { if(!Validation::is_empty($this->formacion)) $this->formacion = preg_replace('/\s\s+/', ' ', trim($this->formacion)); }
  public function resetClasificacion() { if(!Validation::is_empty($this->clasificacion)) $this->clasificacion = preg_replace('/\s\s+/', ' ', trim($this->clasificacion)); }
  public function resetCodigo() { if(!Validation::is_empty($this->codigo)) $this->codigo = preg_replace('/\s\s+/', ' ', trim($this->codigo)); }
  public function resetPerfil() { if(!Validation::is_empty($this->perfil)) $this->perfil = preg_replace('/\s\s+/', ' ', trim($this->perfil)); }

  public function checkId($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkNombre($value) { 
    $this->_logs->resetLogs("nombre");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("nombre", "error", $error); }
    return $v->isSuccess();
  }

  public function checkFormacion($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkClasificacion($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkCodigo($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkPerfil($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function _check(){
    $this->checkId($this->id);
    $this->checkNombre($this->nombre);
    $this->checkFormacion($this->formacion);
    $this->checkClasificacion($this->clasificacion);
    $this->checkCodigo($this->codigo);
    $this->checkPerfil($this->perfil);
    return !$this->_getLogs()->isError();
  }

  public function _reset(){
    $this->resetNombre();
    $this->resetFormacion();
    $this->resetClasificacion();
    $this->resetCodigo();
    $this->resetPerfil();
    return $this;
  }



}
