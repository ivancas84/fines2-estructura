<?php

require_once("class/model/Values.php");

//Implementacion principal de Values para una entidad especifica
class NotaValuesMain extends EntityValues {
  public $id = UNDEFINED;
  public $nota = UNDEFINED;
  public $alta = UNDEFINED;
  public $profesor = UNDEFINED;
  public $curso = UNDEFINED;
  public $alumno = UNDEFINED;

  public function setDefault(){
    $this->id = null;
    $this->nota = null;
    $this->alta = new DateTime();
    $this->profesor = null;
    $this->curso = null;
    $this->alumno = null;
  }

  public function fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."nota"])) $this->setNota($row[$p."nota"]);
    if(isset($row[$p."alta"])) $this->setAltaStr($row[$p."alta"]);
    if(isset($row[$p."profesor"])) $this->setProfesor($row[$p."profesor"]);
    if(isset($row[$p."curso"])) $this->setCurso($row[$p."curso"]);
    if(isset($row[$p."alumno"])) $this->setAlumno($row[$p."alumno"]);
  }

  public function toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id;
    if($this->nota !== UNDEFINED) $row["nota"] = $this->nota;
    if($this->alta !== UNDEFINED) {
        if(empty($this->alta)) $row["alta"] = $this->alta;
        else $row["alta"] = $this->alta->format('Y-m-d H:i:s');
      }
    if($this->profesor !== UNDEFINED) $row["profesor"] = $this->profesor;
    if($this->curso !== UNDEFINED) $row["curso"] = $this->curso;
    if($this->alumno !== UNDEFINED) $row["alumno"] = $this->alumno;
    return $row;
  }

  public function id() { return $this->id; }
  public function nota() { return $this->nota; }
  public function alta($format = 'd/m/Y H:i:s') { return $this->formatDate($this->alta, $format); }
  public function profesor() { return $this->profesor; }
  public function curso() { return $this->curso; }
  public function alumno() { return $this->alumno; }
  public function setId($p) {
    $p = trim($p);
    $this->id = (empty($p)) ? null : (string)$p;
  }

  public function setNota($p) {
    $p = trim($p);
    $this->nota = (is_null($p) && $p !== 0) ? null : intval($p);
  }
  public function setAlta(DateTime $p = null) {
    $this->alta = $p;
  }

  public function setAltaStr($p, $format = "Y-m-d H:i:s") {
    $p = SpanishDateTime::createFromFormat($format, trim($p));
    $this->alta = (empty($p)) ? null : $p;
  }

  public function setProfesor($p) {
    $p = trim($p);
    $this->profesor = (empty($p)) ? null : (string)$p;
  }

  public function setCurso($p) {
    $p = trim($p);
    $this->curso = (empty($p)) ? null : (string)$p;
  }

  public function setAlumno($p) {
    $p = trim($p);
    $this->alumno = (empty($p)) ? null : (string)$p;
  }



}
