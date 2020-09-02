<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _PlanillaDocente extends EntityValues {
  protected $id = UNDEFINED;
  protected $numero = UNDEFINED;
  protected $insertado = UNDEFINED;

  public function _setDefault(){
    if($this->id == UNDEFINED) $this->setId(uniqid());
    if($this->numero == UNDEFINED) $this->setNumero(null);
    if($this->insertado == UNDEFINED) $this->setInsertado(date('c'));
    return $this;
  }

  public function _fromArray(array $row = NULL, string $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."numero"])) $this->setNumero($row[$p."numero"]);
    if(isset($row[$p."insertado"])) $this->setInsertado($row[$p."insertado"]);
    return $this;
  }

  public function _toArray(string $p = ""){
    $row = [];
    if($this->id !== UNDEFINED) $row[$p."id"] = $this->id();
    if($this->numero !== UNDEFINED) $row[$p."numero"] = $this->numero();
    if($this->insertado !== UNDEFINED) $row[$p."insertado"] = $this->insertado("c");
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->numero)) return false;
    if(!Validation::is_empty($this->insertado)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function numero($format = null) { return Format::convertCase($this->numero, $format); }
  public function insertado($format = null) { return Format::date($this->insertado, $format); }

  public function _setId(string $p = null) { return $this->id = $p; }  
  public function setId($p) { return $this->id = (is_null($p)) ? null : (string)$p; }

  public function _setNumero(string $p = null) { return $this->numero = $p; }  
  public function setNumero($p) { return $this->numero = (is_null($p)) ? null : (string)$p; }

  public function _setInsertado(DateTime $p = null) { return $this->insertado = $p; }  
  public function setInsertado($p) {
    if(!is_null($p) && !($p instanceof DateTime)) $p = new SpanishDateTime($p);
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->insertado = $p;
  }


  public function resetNumero() { if(!Validation::is_empty($this->numero)) $this->numero = preg_replace('/\s\s+/', ' ', trim($this->numero)); }

  public function checkId($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkNumero($value) { 
    $this->_logs->resetLogs("numero");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required()->max(255);
    foreach($v->getErrors() as $error){ $this->_logs->addLog("numero", "error", $error); }
    return $v->isSuccess();
  }

  public function checkInsertado($value) { 
    $this->_logs->resetLogs("insertado");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required()->isA('DateTime');
    foreach($v->getErrors() as $error){ $this->_logs->addLog("insertado", "error", $error); }
    return $v->isSuccess();
  }

  public function _check(){
    $this->checkId($this->id);
    $this->checkNumero($this->numero);
    $this->checkInsertado($this->insertado);
    return !$this->_getLogs()->isError();
  }

  public function _reset(){
    $this->resetNumero();
    return $this;
  }



}
