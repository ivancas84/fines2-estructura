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
    $this->setId(DEFAULT_VALUE);
    $this->setTipo(DEFAULT_VALUE);
    $this->setPrefijo(DEFAULT_VALUE);
    $this->setNumero(DEFAULT_VALUE);
    $this->setInsertado(DEFAULT_VALUE);
    $this->setEliminado(DEFAULT_VALUE);
    $this->setPersona(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."tipo"])) $this->setTipo($row[$p."tipo"]);
    if(isset($row[$p."prefijo"])) $this->setPrefijo($row[$p."prefijo"]);
    if(isset($row[$p."numero"])) $this->setNumero($row[$p."numero"]);
    if(isset($row[$p."insertado"])) $this->setInsertado($row[$p."insertado"]);
    if(isset($row[$p."eliminado"])) $this->setEliminado($row[$p."eliminado"]);
    if(isset($row[$p."persona"])) $this->setPersona($row[$p."persona"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id();
    if($this->tipo !== UNDEFINED) $row["tipo"] = $this->tipo();
    if($this->prefijo !== UNDEFINED) $row["prefijo"] = $this->prefijo();
    if($this->numero !== UNDEFINED) $row["numero"] = $this->numero();
    if($this->insertado !== UNDEFINED) $row["insertado"] = $this->insertado("Y-m-d H:i:s");
    if($this->eliminado !== UNDEFINED) $row["eliminado"] = $this->eliminado("Y-m-d H:i:s");
    if($this->persona !== UNDEFINED) $row["persona"] = $this->persona();
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
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkId($p); 
    if($check) $this->id = $p;
    return $check;
  }

  public function setTipo($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkTipo($p); 
    if($check) $this->tipo = $p;
    return $check;
  }

  public function setPrefijo($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkPrefijo($p); 
    if($check) $this->prefijo = $p;
    return $check;
  }

  public function setNumero($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkNumero($p); 
    if($check) $this->numero = $p;
    return $check;
  }

  public function _setInsertado(DateTime $p = null) {
      $check = $this->checkInsertado($p); 
      if($check) $this->insertado = $p;  
      return $check;
  }

  public function setInsertado($p, $format = "Y-m-d H:i:s") {
    $p = ($p == DEFAULT_VALUE) ? date('Y-m-d H:i:s') : trim($p);
    if(!is_null($p)) $p = SpanishDateTime::createFromFormat($format, $p);    
    $check = $this->checkInsertado($p); 
    if($check) $this->insertado = $p;  
    return $check;
  }

  public function _setEliminado(DateTime $p = null) {
      $check = $this->checkEliminado($p); 
      if($check) $this->eliminado = $p;  
      return $check;
  }

  public function setEliminado($p, $format = "Y-m-d H:i:s") {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    if(!is_null($p)) $p = SpanishDateTime::createFromFormat($format, $p);    
    $check = $this->checkEliminado($p); 
    if($check) $this->eliminado = $p;  
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

  public function checkTipo($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("tipo", $v);
  }

  public function checkPrefijo($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("prefijo", $v);
  }

  public function checkNumero($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("numero", $v);
  }

  public function checkInsertado($value) { 
    $v = Validation::getInstanceValue($value)->date()->required();
    return $this->_setLogsValidation("insertado", $v);
  }

  public function checkEliminado($value) { 
    $v = Validation::getInstanceValue($value)->date();
    return $this->_setLogsValidation("eliminado", $v);
  }

  public function checkPersona($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("persona", $v);
  }



}
