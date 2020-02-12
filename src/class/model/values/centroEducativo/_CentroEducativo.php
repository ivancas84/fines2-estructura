<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _CentroEducativo extends EntityValues {
  protected $id = UNDEFINED;
  protected $nombre = UNDEFINED;
  protected $cue = UNDEFINED;
  protected $domicilio = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setNombre(DEFAULT_VALUE);
    $this->setCue(DEFAULT_VALUE);
    $this->setDomicilio(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."nombre"])) $this->setNombre($row[$p."nombre"]);
    if(isset($row[$p."cue"])) $this->setCue($row[$p."cue"]);
    if(isset($row[$p."domicilio"])) $this->setDomicilio($row[$p."domicilio"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id("");
    if($this->nombre !== UNDEFINED) $row["nombre"] = $this->nombre("");
    if($this->cue !== UNDEFINED) $row["cue"] = $this->cue("");
    if($this->domicilio !== UNDEFINED) $row["domicilio"] = $this->domicilio("");
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->nombre)) return false;
    if(!Validation::is_empty($this->cue)) return false;
    if(!Validation::is_empty($this->domicilio)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function nombre($format = null) { return Format::convertCase($this->nombre, $format); }
  public function cue($format = null) { return Format::convertCase($this->cue, $format); }
  public function domicilio($format = null) { return Format::convertCase($this->domicilio, $format); }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkId($p); 
    if($check) $this->id = $p;
    return $check;
  }

  public function setNombre($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkNombre($p); 
    if($check) $this->nombre = $p;
    return $check;
  }

  public function setCue($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkCue($p); 
    if($check) $this->cue = $p;
    return $check;
  }

  public function setDomicilio($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkDomicilio($p); 
    if($check) $this->domicilio = $p;
    return $check;
  }

  public function checkId($value) { 
      return true; 
  }

  public function checkNombre($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("nombre", $v);
  }

  public function checkCue($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("cue", $v);
  }

  public function checkDomicilio($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("domicilio", $v);
  }



}
