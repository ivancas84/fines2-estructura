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
    $this->setId(DEFAULT_VALUE);
    $this->setNombre(DEFAULT_VALUE);
    $this->setFormacion(DEFAULT_VALUE);
    $this->setClasificacion(DEFAULT_VALUE);
    $this->setCodigo(DEFAULT_VALUE);
    $this->setPerfil(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."nombre"])) $this->setNombre($row[$p."nombre"]);
    if(isset($row[$p."formacion"])) $this->setFormacion($row[$p."formacion"]);
    if(isset($row[$p."clasificacion"])) $this->setClasificacion($row[$p."clasificacion"]);
    if(isset($row[$p."codigo"])) $this->setCodigo($row[$p."codigo"]);
    if(isset($row[$p."perfil"])) $this->setPerfil($row[$p."perfil"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id("");
    if($this->nombre !== UNDEFINED) $row["nombre"] = $this->nombre("");
    if($this->formacion !== UNDEFINED) $row["formacion"] = $this->formacion("");
    if($this->clasificacion !== UNDEFINED) $row["clasificacion"] = $this->clasificacion("");
    if($this->codigo !== UNDEFINED) $row["codigo"] = $this->codigo("");
    if($this->perfil !== UNDEFINED) $row["perfil"] = $this->perfil("");
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
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkId($p)) $this->id = $p;
  }

  public function setNombre($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkNombre($p)) $this->nombre = $p;
  }

  public function setFormacion($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkFormacion($p)) $this->formacion = $p;
  }

  public function setClasificacion($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkClasificacion($p)) $this->clasificacion = $p;
  }

  public function setCodigo($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkCodigo($p)) $this->codigo = $p;
  }

  public function setPerfil($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkPerfil($p)) $this->perfil = $p;
  }

  public function checkId($value) { 
      return true; 
  }

  public function checkNombre($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("nombre", $v);
  }

  public function checkFormacion($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("formacion", $v);
  }

  public function checkClasificacion($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("clasificacion", $v);
  }

  public function checkCodigo($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("codigo", $v);
  }

  public function checkPerfil($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("perfil", $v);
  }



}
