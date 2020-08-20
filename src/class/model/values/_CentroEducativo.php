<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _CentroEducativo extends EntityValues {
  protected $id = UNDEFINED;
  protected $nombre = UNDEFINED;
  protected $cue = UNDEFINED;
  protected $domicilio = UNDEFINED;

  public function _setDefault(){
    if($this->id == UNDEFINED) $this->setId(null);
    if($this->nombre == UNDEFINED) $this->setNombre(null);
    if($this->cue == UNDEFINED) $this->setCue(null);
    if($this->domicilio == UNDEFINED) $this->setDomicilio(null);
    return $this;
  }

  public function _fromArray(array $row = NULL, string $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."nombre"])) $this->setNombre($row[$p."nombre"]);
    if(isset($row[$p."cue"])) $this->setCue($row[$p."cue"]);
    if(isset($row[$p."domicilio"])) $this->setDomicilio($row[$p."domicilio"]);
    return $this;
  }

  public function _toArray(string $p = ""){
    $row = [];
    if($this->id !== UNDEFINED) $row[$p."id"] = $this->id();
    if($this->nombre !== UNDEFINED) $row[$p."nombre"] = $this->nombre();
    if($this->cue !== UNDEFINED) $row[$p."cue"] = $this->cue();
    if($this->domicilio !== UNDEFINED) $row[$p."domicilio"] = $this->domicilio();
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

  public function setId($p) { $this->id = (is_null($p)) ? null : (string)$p; }
  public function setNombre($p) { $this->nombre = (is_null($p)) ? null : (string)$p; }
  public function setCue($p) { $this->cue = (is_null($p)) ? null : (string)$p; }
  public function setDomicilio($p) { $this->domicilio = (is_null($p)) ? null : (string)$p; }

  public function resetNombre() { if(!Validation::is_empty($this->nombre)) $this->nombre = preg_replace('/\s\s+/', ' ', trim($this->nombre)); }
  public function resetCue() { if(!Validation::is_empty($this->cue)) $this->cue = preg_replace('/\s\s+/', ' ', trim($this->cue)); }

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

  public function checkCue($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkDomicilio($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function _check(){
    $this->checkId($this->id);
    $this->checkNombre($this->nombre);
    $this->checkCue($this->cue);
    $this->checkDomicilio($this->domicilio);
    return !$this->_getLogs()->isError();
  }

  public function _reset(){
    $this->resetNombre();
    $this->resetCue();
    return $this;
  }



}
