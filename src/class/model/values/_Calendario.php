<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _Calendario extends EntityValues {
  protected $id = UNDEFINED;
  protected $inicio = UNDEFINED;
  protected $fin = UNDEFINED;
  protected $anio = UNDEFINED;
  protected $semestre = UNDEFINED;
  protected $insertado = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setInicio(DEFAULT_VALUE);
    $this->setFin(DEFAULT_VALUE);
    $this->setAnio(DEFAULT_VALUE);
    $this->setSemestre(DEFAULT_VALUE);
    $this->setInsertado(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."inicio"])) $this->setInicio($row[$p."inicio"]);
    if(isset($row[$p."fin"])) $this->setFin($row[$p."fin"]);
    if(isset($row[$p."anio"])) $this->setAnio($row[$p."anio"]);
    if(isset($row[$p."semestre"])) $this->setSemestre($row[$p."semestre"]);
    if(isset($row[$p."insertado"])) $this->setInsertado($row[$p."insertado"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id();
    if($this->inicio !== UNDEFINED) $row["inicio"] = $this->inicio("Y-m-d");
    if($this->fin !== UNDEFINED) $row["fin"] = $this->fin("Y-m-d");
    if($this->anio !== UNDEFINED) $row["anio"] = $this->anio("Y");
    if($this->semestre !== UNDEFINED) $row["semestre"] = $this->semestre();
    if($this->insertado !== UNDEFINED) $row["insertado"] = $this->insertado("Y-m-d H:i:s");
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->inicio)) return false;
    if(!Validation::is_empty($this->fin)) return false;
    if(!Validation::is_empty($this->anio)) return false;
    if(!Validation::is_empty($this->semestre)) return false;
    if(!Validation::is_empty($this->insertado)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function inicio($format = null) { return Format::date($this->inicio, $format); }
  public function fin($format = null) { return Format::date($this->fin, $format); }
  public function anio($format = null) { return Format::date($this->anio, $format); }
  public function semestre() { return $this->semestre; }
  public function insertado($format = null) { return Format::date($this->insertado, $format); }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkId($p); 
    if($check) $this->id = $p;
    return $check;
  }

  public function _setInicio(DateTime $p = null) {
      $check = $this->checkInicio($p); 
      if($check) $this->inicio = $p;  
      return $check;      
  }

  public function setInicio($p, $format = UNDEFINED) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    if(!is_null($p)) $p = ($format == UNDEFINED) ? SpanishDateTime::createFromDate($p) : SpanishDateTime::createFromFormat($format, $p);    
    $check = $this->checkInicio($p); 
    if($check) $this->inicio = $p;  
    return $check;
  }

  public function _setFin(DateTime $p = null) {
      $check = $this->checkFin($p); 
      if($check) $this->fin = $p;  
      return $check;      
  }

  public function setFin($p, $format = UNDEFINED) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    if(!is_null($p)) $p = ($format == UNDEFINED) ? SpanishDateTime::createFromDate($p) : SpanishDateTime::createFromFormat($format, $p);    
    $check = $this->checkFin($p); 
    if($check) $this->fin = $p;  
    return $check;
  }

  public function _setAnio(DateTime $p = null) {
      $check = $this->checkAnio($p); 
      if($check) $this->anio = $p;  
      return $check;
  }

  public function setAnio($p, $format = "Y") {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    if(!is_null($p)) $p = SpanishDateTime::createFromFormat($format, $p);    
    $check = $this->checkAnio($p); 
    if($check) $this->anio = $p;  
    return $check;
  }

  public function setSemestre($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $p = (is_null($p)) ? null : intval(trim($p));
    $check = $this->checkSemestre($p); 
    if($check) $this->semestre = $p;
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

  public function checkInicio($value) { 
    $v = Validation::getInstanceValue($value)->date();
    return $this->_setLogsValidation("inicio", $v);
  }

  public function checkFin($value) { 
    $v = Validation::getInstanceValue($value)->date();
    return $this->_setLogsValidation("fin", $v);
  }

  public function checkAnio($value) { 
    $v = Validation::getInstanceValue($value)->date()->required();
    return $this->_setLogsValidation("anio", $v);
  }

  public function checkSemestre($value) { 
    $v = Validation::getInstanceValue($value)->integer()->required();
    return $this->_setLogsValidation("semestre", $v);
  }

  public function checkInsertado($value) { 
    $v = Validation::getInstanceValue($value)->date()->required();
    return $this->_setLogsValidation("insertado", $v);
  }



}
