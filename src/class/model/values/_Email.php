<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _Email extends EntityValues {
  protected $id = UNDEFINED;
  protected $email = UNDEFINED;
  protected $verificado = UNDEFINED;
  protected $insertado = UNDEFINED;
  protected $eliminado = UNDEFINED;
  protected $persona = UNDEFINED;

  public function _setDefault(){
    if($this->id == UNDEFINED) $this->setId(null);
    if($this->email == UNDEFINED) $this->setEmail(null);
    if($this->verificado == UNDEFINED) $this->setVerificado(false);
    if($this->insertado == UNDEFINED) $this->setInsertado(date('c'));
    if($this->eliminado == UNDEFINED) $this->setEliminado(null);
    if($this->persona == UNDEFINED) $this->setPersona(null);
    return $this;
  }

  public function _fromArray(array $row = NULL, string $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."email"])) $this->setEmail($row[$p."email"]);
    if(isset($row[$p."verificado"])) $this->setVerificado($row[$p."verificado"]);
    if(isset($row[$p."insertado"])) $this->setInsertado($row[$p."insertado"]);
    if(isset($row[$p."eliminado"])) $this->setEliminado($row[$p."eliminado"]);
    if(isset($row[$p."persona"])) $this->setPersona($row[$p."persona"]);
    return $this;
  }

  public function _toArray(string $p = ""){
    $row = [];
    if($this->id !== UNDEFINED) $row[$p."id"] = $this->id();
    if($this->email !== UNDEFINED) $row[$p."email"] = $this->email();
    if($this->verificado !== UNDEFINED) $row[$p."verificado"] = $this->verificado();
    if($this->insertado !== UNDEFINED) $row[$p."insertado"] = $this->insertado("c");
    if($this->eliminado !== UNDEFINED) $row[$p."eliminado"] = $this->eliminado("c");
    if($this->persona !== UNDEFINED) $row[$p."persona"] = $this->persona();
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->email)) return false;
    if(!Validation::is_empty($this->verificado)) return false;
    if(!Validation::is_empty($this->insertado)) return false;
    if(!Validation::is_empty($this->eliminado)) return false;
    if(!Validation::is_empty($this->persona)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function email($format = null) { return Format::convertCase($this->email, $format); }
  public function verificado($format = null) { return Format::boolean($this->verificado, $format); }
  public function insertado($format = null) { return Format::date($this->insertado, $format); }
  public function eliminado($format = null) { return Format::date($this->eliminado, $format); }
  public function persona($format = null) { return Format::convertCase($this->persona, $format); }

  public function setId($p) { $this->id = (is_null($p)) ? null : (string)$p; }
  public function setEmail($p) { $this->email = (is_null($p)) ? null : (string)$p; }
  public function setVerificado($p) { $this->verificado = settypebool($p); }
  public function _setInsertado(DateTime $p = null) { $this->insertado = $p; }

  public function setInsertado($p) {
    if(!is_null($p)) {
      $p = new SpanishDateTime($p);    
      if($p) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    }
    $this->insertado = $p;  
  }

  public function _setEliminado(DateTime $p = null) { $this->eliminado = $p; }

  public function setEliminado($p) {
    if(!is_null($p)) {
      $p = new SpanishDateTime($p);    
      if($p) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    }
    $this->eliminado = $p;  
  }

  public function setPersona($p) { $this->persona = (is_null($p)) ? null : (string)$p; }

  public function resetEmail() { if(!Validation::is_empty($this->email)) $this->email = preg_replace('/\s\s+/', ' ', trim($this->email)); }

  public function checkId($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkEmail($value) { 
    $this->_logs->resetLogs("email");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("email", "error", $error); }
    return $v->isSuccess();
  }

  public function checkVerificado($value) { 
    $this->_logs->resetLogs("verificado");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("verificado", "error", $error); }
    return $v->isSuccess();
  }

  public function checkInsertado($value) { 
    $this->_logs->resetLogs("insertado");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("insertado", "error", $error); }
    return $v->isSuccess();
  }

  public function checkEliminado($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkPersona($value) { 
    $this->_logs->resetLogs("persona");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("persona", "error", $error); }
    return $v->isSuccess();
  }

  public function _check(){
    $this->checkId($this->id);
    $this->checkEmail($this->email);
    $this->checkVerificado($this->verificado);
    $this->checkInsertado($this->insertado);
    $this->checkEliminado($this->eliminado);
    $this->checkPersona($this->persona);
    return !$this->_getLogs()->isError();
  }

  public function _reset(){
    $this->resetEmail();
    return $this;
  }



}
