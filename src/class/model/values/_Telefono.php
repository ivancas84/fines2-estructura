<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _Telefono extends EntityValues {
  protected $id = UNDEFINED;
  protected $tipo = UNDEFINED;
  protected $prefijo = UNDEFINED;
  protected $numero = UNDEFINED;
  protected $insertado = UNDEFINED;
  protected $eliminado = UNDEFINED;
  protected $persona = UNDEFINED;

  public function _setDefault(){
    if($this->id == UNDEFINED) $this->setId(null);
    if($this->tipo == UNDEFINED) $this->setTipo(null);
    if($this->prefijo == UNDEFINED) $this->setPrefijo(null);
    if($this->numero == UNDEFINED) $this->setNumero(null);
    if($this->insertado == UNDEFINED) $this->setInsertado(date('c'));
    if($this->eliminado == UNDEFINED) $this->setEliminado(null);
    if($this->persona == UNDEFINED) $this->setPersona(null);
    return $this;
  }

  public function _fromArray(array $row = NULL, string $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."tipo"])) $this->setTipo($row[$p."tipo"]);
    if(isset($row[$p."prefijo"])) $this->setPrefijo($row[$p."prefijo"]);
    if(isset($row[$p."numero"])) $this->setNumero($row[$p."numero"]);
    if(isset($row[$p."insertado"])) $this->setInsertado($row[$p."insertado"]);
    if(isset($row[$p."eliminado"])) $this->setEliminado($row[$p."eliminado"]);
    if(isset($row[$p."persona"])) $this->setPersona($row[$p."persona"]);
    return $this;
  }

  public function _toArray(string $p = ""){
    $row = [];
    if($this->id !== UNDEFINED) $row[$p."id"] = $this->id();
    if($this->tipo !== UNDEFINED) $row[$p."tipo"] = $this->tipo();
    if($this->prefijo !== UNDEFINED) $row[$p."prefijo"] = $this->prefijo();
    if($this->numero !== UNDEFINED) $row[$p."numero"] = $this->numero();
    if($this->insertado !== UNDEFINED) $row[$p."insertado"] = $this->insertado("c");
    if($this->eliminado !== UNDEFINED) $row[$p."eliminado"] = $this->eliminado("c");
    if($this->persona !== UNDEFINED) $row[$p."persona"] = $this->persona();
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->tipo)) return false;
    if(!Validation::is_empty($this->prefijo)) return false;
    if(!Validation::is_empty($this->numero)) return false;
    if(!Validation::is_empty($this->insertado)) return false;
    if(!Validation::is_empty($this->eliminado)) return false;
    if(!Validation::is_empty($this->persona)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function tipo($format = null) { return Format::convertCase($this->tipo, $format); }
  public function prefijo($format = null) { return Format::convertCase($this->prefijo, $format); }
  public function numero($format = null) { return Format::convertCase($this->numero, $format); }
  public function insertado($format = null) { return Format::date($this->insertado, $format); }
  public function eliminado($format = null) { return Format::date($this->eliminado, $format); }
  public function persona($format = null) { return Format::convertCase($this->persona, $format); }

  public function setId($p) { $this->id = (is_null($p)) ? null : (string)$p; }
  public function setTipo($p) { $this->tipo = (is_null($p)) ? null : (string)$p; }
  public function setPrefijo($p) { $this->prefijo = (is_null($p)) ? null : (string)$p; }
  public function setNumero($p) { $this->numero = (is_null($p)) ? null : (string)$p; }
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

  public function resetTipo() { if(!Validation::is_empty($this->tipo)) $this->tipo = preg_replace('/\s\s+/', ' ', trim($this->tipo)); }
  public function resetPrefijo() { if(!Validation::is_empty($this->prefijo)) $this->prefijo = preg_replace('/\s\s+/', ' ', trim($this->prefijo)); }
  public function resetNumero() { if(!Validation::is_empty($this->numero)) $this->numero = preg_replace('/\s\s+/', ' ', trim($this->numero)); }

  public function checkId($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkTipo($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkPrefijo($value) { 
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
    $this->checkTipo($this->tipo);
    $this->checkPrefijo($this->prefijo);
    $this->checkNumero($this->numero);
    $this->checkInsertado($this->insertado);
    $this->checkEliminado($this->eliminado);
    $this->checkPersona($this->persona);
    return !$this->_getLogs()->isError();
  }

  public function _reset(){
    $this->resetTipo();
    $this->resetPrefijo();
    $this->resetNumero();
    return $this;
  }



}
