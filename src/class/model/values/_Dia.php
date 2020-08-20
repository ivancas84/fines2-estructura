<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _Dia extends EntityValues {
  protected $id = UNDEFINED;
  protected $numero = UNDEFINED;
  protected $dia = UNDEFINED;

  public function _setDefault(){
    if($this->id == UNDEFINED) $this->setId(null);
    if($this->numero == UNDEFINED) $this->setNumero(null);
    if($this->dia == UNDEFINED) $this->setDia(null);
    return $this;
  }

  public function _fromArray(array $row = NULL, string $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."numero"])) $this->setNumero($row[$p."numero"]);
    if(isset($row[$p."dia"])) $this->setDia($row[$p."dia"]);
    return $this;
  }

  public function _toArray(string $p = ""){
    $row = [];
    if($this->id !== UNDEFINED) $row[$p."id"] = $this->id();
    if($this->numero !== UNDEFINED) $row[$p."numero"] = $this->numero();
    if($this->dia !== UNDEFINED) $row[$p."dia"] = $this->dia();
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->numero)) return false;
    if(!Validation::is_empty($this->dia)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function numero() { return $this->numero; }
  public function dia($format = null) { return Format::convertCase($this->dia, $format); }

  public function setId($p) { $this->id = (is_null($p)) ? null : (string)$p; }
  public function setNumero($p) { $this->numero = (is_null($p)) ? null : intval($p); }
  public function setDia($p) { $this->dia = (is_null($p)) ? null : (string)$p; }

  public function resetDia() { if(!Validation::is_empty($this->dia)) $this->dia = preg_replace('/\s\s+/', ' ', trim($this->dia)); }

  public function checkId($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkNumero($value) { 
    $this->_logs->resetLogs("numero");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("numero", "error", $error); }
    return $v->isSuccess();
  }

  public function checkDia($value) { 
    $this->_logs->resetLogs("dia");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("dia", "error", $error); }
    return $v->isSuccess();
  }

  public function _check(){
    $this->checkId($this->id);
    $this->checkNumero($this->numero);
    $this->checkDia($this->dia);
    return !$this->_getLogs()->isError();
  }

  public function _reset(){
    $this->resetDia();
    return $this;
  }



}
