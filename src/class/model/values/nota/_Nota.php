<?php

require_once("class/Format.php");
require_once("class/model/Values.php");

class _Nota extends EntityValues {
  protected $id = UNDEFINED;
  protected $nota = UNDEFINED;
  protected $alta = UNDEFINED;
  protected $profesor = UNDEFINED;
  protected $curso = UNDEFINED;
  protected $alumno = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setNota(DEFAULT_VALUE);
    $this->setAlta(DEFAULT_VALUE);
    $this->setProfesor(DEFAULT_VALUE);
    $this->setCurso(DEFAULT_VALUE);
    $this->setAlumno(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."nota"])) $this->setNota($row[$p."nota"]);
    if(isset($row[$p."alta"])) $this->setAlta($row[$p."alta"]);
    if(isset($row[$p."profesor"])) $this->setProfesor($row[$p."profesor"]);
    if(isset($row[$p."curso"])) $this->setCurso($row[$p."curso"]);
    if(isset($row[$p."alumno"])) $this->setAlumno($row[$p."alumno"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id("");
    if($this->nota !== UNDEFINED) $row["nota"] = $this->nota("");
    if($this->alta !== UNDEFINED) $row["alta"] = $this->alta("Y-m-d h:i:s");
    if($this->profesor !== UNDEFINED) $row["profesor"] = $this->profesor("");
    if($this->curso !== UNDEFINED) $row["curso"] = $this->curso("");
    if($this->alumno !== UNDEFINED) $row["alumno"] = $this->alumno("");
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->nota)) return false;
    if(!Validation::is_empty($this->alta)) return false;
    if(!Validation::is_empty($this->profesor)) return false;
    if(!Validation::is_empty($this->curso)) return false;
    if(!Validation::is_empty($this->alumno)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function nota() { return $this->nota; }
  public function alta($format = null) { return Format::date($this->alta, $format); }
  public function profesor() { return $this->profesor; }
  public function curso() { return $this->curso; }
  public function alumno() { return $this->alumno; }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkId($p)) $this->id = $p;
  }

  public function setNota($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    (is_null($p)) ? null : intval(trim($p));
    if($this->checkNota($p)) $this->nota = $p;
  }

  public function _setAlta(DateTime $p = null) {
      if($this->checkAlta($p)) $this->alta = $p;  
  }

  public function setAlta($p, $format = "Y-m-d H:i:s") {
    $p = ($p == DEFAULT_VALUE) ? date('Y-m-d H:i:s') : trim($p);
    if(is_null($p)) $p = null;
    else $p = SpanishDateTime::createFromFormat($format, $p);
    if($this->checkAlta($p)) $this->alta = $p;
  }

  public function setProfesor($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkProfesor($p)) $this->profesor = $p;
  }

  public function setCurso($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkCurso($p)) $this->curso = $p;
  }

  public function setAlumno($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkAlumno($p)) $this->alumno = $p;
  }

  public function checkId($value) { 
      return true; 
  }

  public function checkNota($value) { 
    $v = Validation::getInstanceValue($value)->integer()->required();
    return $this->_setLogsValidation("nota", $v);
  }

  public function checkAlta($value) { 
    $v = Validation::getInstanceValue($value)->date()->required();
    return $this->_setLogsValidation("alta", $v);
  }

  public function checkProfesor($value) { 
    $v = Validation::getInstanceValue($value)->integer()->required();
    return $this->_setLogsValidation("profesor", $v);
  }

  public function checkCurso($value) { 
    $v = Validation::getInstanceValue($value)->integer()->required();
    return $this->_setLogsValidation("curso", $v);
  }

  public function checkAlumno($value) { 
    $v = Validation::getInstanceValue($value)->integer()->required();
    return $this->_setLogsValidation("alumno", $v);
  }



}
