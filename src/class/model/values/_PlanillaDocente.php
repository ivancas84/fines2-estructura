<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _PlanillaDocente extends EntityValues {
  protected $id = UNDEFINED;
  protected $numero = UNDEFINED;
  protected $insertado = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setNumero(DEFAULT_VALUE);
    $this->setInsertado(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."numero"])) $this->setNumero($row[$p."numero"]);
    if(isset($row[$p."insertado"])) $this->setInsertado($row[$p."insertado"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id();
    if($this->numero !== UNDEFINED) $row["numero"] = $this->numero();
    if($this->insertado !== UNDEFINED) $row["insertado"] = $this->insertado("Y-m-d H:i:s");
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
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkId($p); 
    if($check) $this->id = $p;
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

  public function checkId($value) { 
      return true; 
  }

  public function checkNumero($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("numero", $v);
  }

  public function checkInsertado($value) { 
    $v = Validation::getInstanceValue($value)->date()->required();
    return $this->_setLogsValidation("insertado", $v);
  }



}
