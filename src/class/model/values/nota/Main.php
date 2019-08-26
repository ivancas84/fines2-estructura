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
    if(isset($row[$p."id"])) $this->id = (is_null($row[$p."id"])) ? null : (string)$row[$p."id"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row[$p."nota"])) $this->nota = (is_null($row[$p."nota"])) ? null : intval($row[$p."nota"]);
    if(isset($row[$p."alta"])) $this->alta = (is_null($row[$p."alta"])) ? null : DateTime::createFromFormat('Y-m-d H:i:s', $row[$p."alta"]);
    if(isset($row[$p."profesor"])) $this->profesor = (is_null($row[$p."profesor"])) ? null : (string)$row[$p."profesor"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row[$p."curso"])) $this->curso = (is_null($row[$p."curso"])) ? null : (string)$row[$p."curso"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row[$p."alumno"])) $this->alumno = (is_null($row[$p."alumno"])) ? null : (string)$row[$p."alumno"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
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
  public function alta($format = 'd/m/Y H:i') { return $this->formatDate($this->alta, $format); }
  public function profesor() { return $this->profesor; }
  public function curso() { return $this->curso; }
  public function alumno() { return $this->alumno; }
  public function setId($p) {
    if(empty($p)) return;
    $this->id = trim($p);
  }

  public function setNota($p) {
    if(empty($p) && $p !== 0) return;
    $this->nota = intval(trim($p));
  }

  public function setAlta(DateTime $p) {
    if(empty($p)) return;
    $this->alta = $p;
  }

  public function setAltaStr($p, $format = "Y-m-d H:i:s") {
    $p = SpanishDateTime::createFromFormat($format, trim($p));
    if(empty($p)) return;
    $this->alta = $p;
  }

  public function setProfesor($p) {
    if(empty($p) && $p !== 0) return;
    $this->profesor = intval(trim($p));
  }

  public function setCurso($p) {
    if(empty($p) && $p !== 0) return;
    $this->curso = intval(trim($p));
  }

  public function setAlumno($p) {
    if(empty($p) && $p !== 0) return;
    $this->alumno = intval(trim($p));
  }



}
