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

  public function fromArray(array $row = NULL){
    if(empty($row)) return;
    if(isset($row["id"])) $this->id = (is_null($row["id"])) ? null : (string)$row["id"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row["nota"])) $this->nota = (is_null($row["nota"])) ? null : intval($row["nota"]);
    if(isset($row["alta"])) $this->alta = (is_null($row["alta"])) ? null : DateTime::createFromFormat('Y-m-d H:i:s', $row["alta"]);
    if(isset($row["profesor"])) $this->profesor = (is_null($row["profesor"])) ? null : (string)$row["profesor"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row["curso"])) $this->curso = (is_null($row["curso"])) ? null : (string)$row["curso"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row["alumno"])) $this->alumno = (is_null($row["alumno"])) ? null : (string)$row["alumno"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
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
    $this->id = $p;
  }

  public function setNota($p) {
    if(empty($p) && $p !== 0) return;
    $this->nota = intval($p);
  }

  public function setAlta($p) {
    if(empty($p)) return;
    $this->alta = $p;
  }

  public function setProfesor($p) {
    if(empty($p) && $p !== 0) return;
    $this->profesor = intval($p);
  }

  public function setCurso($p) {
    if(empty($p) && $p !== 0) return;
    $this->curso = intval($p);
  }

  public function setAlumno($p) {
    if(empty($p) && $p !== 0) return;
    $this->alumno = intval($p);
  }



}
