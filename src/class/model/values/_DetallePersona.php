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
    $this->setId(DEFAULT_VALUE);
    $this->setDescripcion(DEFAULT_VALUE);
    $this->setCreado(DEFAULT_VALUE);
    $this->setArchivo(DEFAULT_VALUE);
    $this->setPersona(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."descripcion"])) $this->setDescripcion($row[$p."descripcion"]);
    if(isset($row[$p."creado"])) $this->setCreado($row[$p."creado"]);
    if(isset($row[$p."archivo"])) $this->setArchivo($row[$p."archivo"]);
    if(isset($row[$p."persona"])) $this->setPersona($row[$p."persona"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id();
    if($this->descripcion !== UNDEFINED) $row["descripcion"] = $this->descripcion();
    if($this->creado !== UNDEFINED) $row["creado"] = $this->creado("Y-m-d H:i:s");
    if($this->archivo !== UNDEFINED) $row["archivo"] = $this->archivo();
    if($this->persona !== UNDEFINED) $row["persona"] = $this->persona();
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
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkId($p); 
    if($check) $this->id = $p;
    return $check;
  }

  public function setDescripcion($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkDescripcion($p); 
    if($check) $this->descripcion = $p;
    return $check;
  }

  public function _setCreado(DateTime $p = null) {
      $check = $this->checkCreado($p); 
      if($check) $this->creado = $p;  
      return $check;
  }

  public function setCreado($p, $format = "Y-m-d H:i:s") {
    $p = ($p == DEFAULT_VALUE) ? date('Y-m-d H:i:s') : trim($p);
    if(!is_null($p)) $p = SpanishDateTime::createFromFormat($format, $p);    
    $check = $this->checkCreado($p); 
    if($check) $this->creado = $p;  
    return $check;
  }

  public function setArchivo($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkArchivo($p); 
    if($check) $this->archivo = $p;
    return $check;
  }

  public function setPersona($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkPersona($p); 
    if($check) $this->persona = $p;
    return $check;
  }

  public function checkId($value) { 
      return true; 
  }

  public function checkDescripcion($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("descripcion", $v);
  }

  public function checkCreado($value) { 
    $v = Validation::getInstanceValue($value)->date()->required();
    return $this->_setLogsValidation("creado", $v);
  }

  public function checkArchivo($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("archivo", $v);
  }

  public function checkPersona($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("persona", $v);
  }



}
