<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _Plan extends EntityValues {
  protected $id = UNDEFINED;
  protected $orientacion = UNDEFINED;
  protected $resolucion = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setOrientacion(DEFAULT_VALUE);
    $this->setResolucion(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."orientacion"])) $this->setOrientacion($row[$p."orientacion"]);
    if(isset($row[$p."resolucion"])) $this->setResolucion($row[$p."resolucion"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id("");
    if($this->orientacion !== UNDEFINED) $row["orientacion"] = $this->orientacion("");
    if($this->resolucion !== UNDEFINED) $row["resolucion"] = $this->resolucion("");
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->orientacion)) return false;
    if(!Validation::is_empty($this->resolucion)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function orientacion($format = null) { return Format::convertCase($this->orientacion, $format); }
  public function resolucion($format = null) { return Format::convertCase($this->resolucion, $format); }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkId($p)) $this->id = $p;
  }

  public function setOrientacion($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkOrientacion($p)) $this->orientacion = $p;
  }

  public function setResolucion($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkResolucion($p)) $this->resolucion = $p;
  }

  public function checkId($value) { 
      return true; 
  }

  public function checkOrientacion($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("orientacion", $v);
  }

  public function checkResolucion($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("resolucion", $v);
  }



}
