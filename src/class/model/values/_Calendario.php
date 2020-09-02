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
    if($this->id == UNDEFINED) $this->setId(uniqid());
    if($this->inicio == UNDEFINED) $this->setInicio(null);
    if($this->fin == UNDEFINED) $this->setFin(null);
    if($this->anio == UNDEFINED) $this->setAnio(null);
    if($this->semestre == UNDEFINED) $this->setSemestre(null);
    if($this->insertado == UNDEFINED) $this->setInsertado(date('c'));
    return $this;
  }

  public function _fromArray(array $row = NULL, string $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."inicio"])) $this->setInicio($row[$p."inicio"]);
    if(isset($row[$p."fin"])) $this->setFin($row[$p."fin"]);
    if(isset($row[$p."anio"])) $this->setAnio($row[$p."anio"]);
    if(isset($row[$p."semestre"])) $this->setSemestre($row[$p."semestre"]);
    if(isset($row[$p."insertado"])) $this->setInsertado($row[$p."insertado"]);
    return $this;
  }

  public function _toArray(string $p = ""){
    $row = [];
    if($this->id !== UNDEFINED) $row[$p."id"] = $this->id();
    if($this->inicio !== UNDEFINED) $row[$p."inicio"] = $this->inicio("c");
    if($this->fin !== UNDEFINED) $row[$p."fin"] = $this->fin("c");
    if($this->anio !== UNDEFINED) $row[$p."anio"] = $this->anio("c");
    if($this->semestre !== UNDEFINED) $row[$p."semestre"] = $this->semestre();
    if($this->insertado !== UNDEFINED) $row[$p."insertado"] = $this->insertado("c");
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

  public function _setId(string $p = null) { return $this->id = $p; }  
  public function setId($p) { return $this->id = (is_null($p)) ? null : (string)$p; }

  public function _setInicio(DateTime $p = null) { return $this->inicio = $p; }
  public function setInicio($p) {
    if(!is_null($p) && !($p instanceof DateTime)) $p = new SpanishDateTime($p);
    if($p instanceof DateTime) {
      $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
      $p->setTime(0,0,0);
    }
    return $this->inicio = $p;
  }

  public function _setFin(DateTime $p = null) { return $this->fin = $p; }
  public function setFin($p) {
    if(!is_null($p) && !($p instanceof DateTime)) $p = new SpanishDateTime($p);
    if($p instanceof DateTime) {
      $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
      $p->setTime(0,0,0);
    }
    return $this->fin = $p;
  }

  public function _setAnio(DateTime $p = null) { return $this->anio = $p; }  
  public function setAnio($p) {
    if(!is_null($p) && !($p instanceof DateTime)) $p = new SpanishDateTime($p);
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->anio = $p;
  }

  public function _setSemestre(integer $p = null) { return $this->semestre = $p; }    
  public function setSemestre($p) { return $this->semestre = (is_null($p)) ? null : intval($p); }

  public function _setInsertado(DateTime $p = null) { return $this->insertado = $p; }  
  public function setInsertado($p) {
    if(!is_null($p) && !($p instanceof DateTime)) $p = new SpanishDateTime($p);
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->insertado = $p;
  }



  public function checkId($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkInicio($value) { 
    $this->_logs->resetLogs("inicio");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->isA('DateTime');
    foreach($v->getErrors() as $error){ $this->_logs->addLog("inicio", "error", $error); }
    return $v->isSuccess();
  }

  public function checkFin($value) { 
    $this->_logs->resetLogs("fin");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->isA('DateTime');
    foreach($v->getErrors() as $error){ $this->_logs->addLog("fin", "error", $error); }
    return $v->isSuccess();
  }

  public function checkAnio($value) { 
    $this->_logs->resetLogs("anio");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required()->isA('DateTime')->min(2000);
    foreach($v->getErrors() as $error){ $this->_logs->addLog("anio", "error", $error); }
    return $v->isSuccess();
  }

  public function checkSemestre($value) { 
    $this->_logs->resetLogs("semestre");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required()->max(5);
    foreach($v->getErrors() as $error){ $this->_logs->addLog("semestre", "error", $error); }
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
    $this->checkInicio($this->inicio);
    $this->checkFin($this->fin);
    $this->checkAnio($this->anio);
    $this->checkSemestre($this->semestre);
    $this->checkInsertado($this->insertado);
    return !$this->_getLogs()->isError();
  }

  public function _reset(){
    return $this;
  }



}
