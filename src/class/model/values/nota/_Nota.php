<?php

require_once("class/model/Values.php");

class _Nota extends EntityValues {
  public $id = UNDEFINED;
  public $nota = UNDEFINED;
  public $alta = UNDEFINED;
  public $profesor = UNDEFINED;
  public $curso = UNDEFINED;
  public $alumno = UNDEFINED;

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
    if($this->id !== UNDEFINED) $row["id"] = $this->id();
    if($this->nota !== UNDEFINED) $row["nota"] = $this->nota();
    if($this->alta !== UNDEFINED) $row["alta"] = $this->alta();
    if($this->profesor !== UNDEFINED) $row["profesor"] = $this->profesor();
    if($this->curso !== UNDEFINED) $row["curso"] = $this->curso();
    if($this->alumno !== UNDEFINED) $row["alumno"] = $this->alumno();
    return $row;
  }

  public function id() { return $this->id; }
  public function nota() { return $this->nota; }
  public function alta($format = 'Y-m-d H:i:s') { return $this->formatDate($this->alta, $format); }
  public function profesor() { return $this->profesor; }
  public function curso() { return $this->curso; }
  public function alumno() { return $this->alumno; }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->id = (empty($p)) ? null : (string)$p;
  }

  public function setNota($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $this->nota = (is_null($p)) ? null : intval(trim($p));
  }

  public function _setAlta(DateTime $p = null) {
    $this->alta = $p;
  }

  public function setAlta($p, $format = "Y-m-d H:i:s") {
    $p = ($p == DEFAULT_VALUE) ? date('Y-m-d H:i:s') : trim($p);
    $p = SpanishDateTime::createFromFormat($format, $p);
    $this->alta = (empty($p)) ? null : $p;
  }

  public function setProfesor($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->profesor = (empty($p)) ? null : (string)$p;
  }

  public function setCurso($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->curso = (empty($p)) ? null : (string)$p;
  }

  public function setAlumno($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->alumno = (empty($p)) ? null : (string)$p;
  }



}
