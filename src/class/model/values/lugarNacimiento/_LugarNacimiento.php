<?php

require_once("class/Format.php");
require_once("class/model/Values.php");

class _LugarNacimiento extends EntityValues {
  protected $id = UNDEFINED;
  protected $ciudad = UNDEFINED;
  protected $provincia = UNDEFINED;
  protected $pais = UNDEFINED;
  protected $alta = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setCiudad(DEFAULT_VALUE);
    $this->setProvincia(DEFAULT_VALUE);
    $this->setPais(DEFAULT_VALUE);
    $this->setAlta(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."ciudad"])) $this->setCiudad($row[$p."ciudad"]);
    if(isset($row[$p."provincia"])) $this->setProvincia($row[$p."provincia"]);
    if(isset($row[$p."pais"])) $this->setPais($row[$p."pais"]);
    if(isset($row[$p."alta"])) $this->setAlta($row[$p."alta"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id("");
    if($this->ciudad !== UNDEFINED) $row["ciudad"] = $this->ciudad("");
    if($this->provincia !== UNDEFINED) $row["provincia"] = $this->provincia("");
    if($this->pais !== UNDEFINED) $row["pais"] = $this->pais("");
    if($this->alta !== UNDEFINED) $row["alta"] = $this->alta("Y-m-d h:i:s");
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->ciudad)) return false;
    if(!Validation::is_empty($this->provincia)) return false;
    if(!Validation::is_empty($this->pais)) return false;
    if(!Validation::is_empty($this->alta)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function ciudad($format = null) { return Format::convertCase($this->ciudad, $format); }
  public function provincia($format = null) { return Format::convertCase($this->provincia, $format); }
  public function pais($format = null) { return Format::convertCase($this->pais, $format); }
  public function alta($format = null) { return Format::date($this->alta, $format); }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkId($p)) $this->id = $p;
  }

  public function setCiudad($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkCiudad($p)) $this->ciudad = $p;
  }

  public function setProvincia($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkProvincia($p)) $this->provincia = $p;
  }

  public function setPais($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkPais($p)) $this->pais = $p;
  }

  public function _setAlta(DateTime $p = null) {
      if($this->checkAlta($p)) $this->alta = $p;  
  }

  public function setAlta($p, $format = "Y-m-d H:i:s") {
    $p = ($p == DEFAULT_VALUE) ? date('Y-m-d H:i:s') : trim($p);
    if(is_null($p)) $p = null;
    else $p = SpanishDateTime::createFromFormat($format, $p);
    if($this->checkAlta($p)) $this->alta = $p;
  }

  public function checkId($value) { 
      return true; 
  }

  public function checkCiudad($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("ciudad", $v);
  }

  public function checkProvincia($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("provincia", $v);
  }

  public function checkPais($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("pais", $v);
  }

  public function checkAlta($value) { 
    $v = Validation::getInstanceValue($value)->date()->required();
    return $this->_setLogsValidation("alta", $v);
  }



}
