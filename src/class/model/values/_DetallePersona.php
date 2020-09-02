<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _DetallePersona extends EntityValues {
  protected $id = UNDEFINED;
  protected $descripcion = UNDEFINED;
  protected $creado = UNDEFINED;
  protected $archivo = UNDEFINED;
  protected $persona = UNDEFINED;

  public function _setDefault(){
    if($this->id == UNDEFINED) $this->setId(uniqid());
    if($this->descripcion == UNDEFINED) $this->setDescripcion(null);
    if($this->creado == UNDEFINED) $this->setCreado(date('c'));
    if($this->archivo == UNDEFINED) $this->setArchivo(null);
    if($this->persona == UNDEFINED) $this->setPersona(null);
    return $this;
  }

  public function _fromArray(array $row = NULL, string $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."descripcion"])) $this->setDescripcion($row[$p."descripcion"]);
    if(isset($row[$p."creado"])) $this->setCreado($row[$p."creado"]);
    if(isset($row[$p."archivo"])) $this->setArchivo($row[$p."archivo"]);
    if(isset($row[$p."persona"])) $this->setPersona($row[$p."persona"]);
    return $this;
  }

  public function _toArray(string $p = ""){
    $row = [];
    if($this->id !== UNDEFINED) $row[$p."id"] = $this->id();
    if($this->descripcion !== UNDEFINED) $row[$p."descripcion"] = $this->descripcion();
    if($this->creado !== UNDEFINED) $row[$p."creado"] = $this->creado("c");
    if($this->archivo !== UNDEFINED) $row[$p."archivo"] = $this->archivo();
    if($this->persona !== UNDEFINED) $row[$p."persona"] = $this->persona();
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->descripcion)) return false;
    if(!Validation::is_empty($this->creado)) return false;
    if(!Validation::is_empty($this->archivo)) return false;
    if(!Validation::is_empty($this->persona)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function descripcion($format = null) { return Format::convertCase($this->descripcion, $format); }
  public function creado($format = null) { return Format::date($this->creado, $format); }
  public function archivo($format = null) { return Format::convertCase($this->archivo, $format); }
  public function persona($format = null) { return Format::convertCase($this->persona, $format); }

  public function _setId(string $p = null) { return $this->id = $p; }  
  public function setId($p) { return $this->id = (is_null($p)) ? null : (string)$p; }

  public function _setDescripcion(string $p = null) { return $this->descripcion = $p; }  
  public function setDescripcion($p) { return $this->descripcion = (is_null($p)) ? null : (string)$p; }

  public function _setCreado(DateTime $p = null) { return $this->creado = $p; }  
  public function setCreado($p) {
    if(!is_null($p) && !($p instanceof DateTime)) $p = new SpanishDateTime($p);
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->creado = $p;
  }

  public function _setArchivo(string $p = null) { return $this->archivo = $p; }  
  public function setArchivo($p) { return $this->archivo = (is_null($p)) ? null : (string)$p; }

  public function _setPersona(string $p = null) { return $this->persona = $p; }  
  public function setPersona($p) { return $this->persona = (is_null($p)) ? null : (string)$p; }


  public function resetDescripcion() { if(!Validation::is_empty($this->descripcion)) $this->descripcion = preg_replace('/\s\s+/', ' ', trim($this->descripcion)); }

  public function checkId($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkDescripcion($value) { 
    $this->_logs->resetLogs("descripcion");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required()->max(255);
    foreach($v->getErrors() as $error){ $this->_logs->addLog("descripcion", "error", $error); }
    return $v->isSuccess();
  }

  public function checkCreado($value) { 
    $this->_logs->resetLogs("creado");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required()->isA('DateTime');
    foreach($v->getErrors() as $error){ $this->_logs->addLog("creado", "error", $error); }
    return $v->isSuccess();
  }

  public function checkArchivo($value) { 
    $this->_logs->resetLogs("archivo");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->max(45);
    foreach($v->getErrors() as $error){ $this->_logs->addLog("archivo", "error", $error); }
    return $v->isSuccess();
  }

  public function checkPersona($value) { 
    $this->_logs->resetLogs("persona");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required()->max(45);
    foreach($v->getErrors() as $error){ $this->_logs->addLog("persona", "error", $error); }
    return $v->isSuccess();
  }

  public function _check(){
    $this->checkId($this->id);
    $this->checkDescripcion($this->descripcion);
    $this->checkCreado($this->creado);
    $this->checkArchivo($this->archivo);
    $this->checkPersona($this->persona);
    return !$this->_getLogs()->isError();
  }

  public function _reset(){
    $this->resetDescripcion();
    return $this;
  }



}
