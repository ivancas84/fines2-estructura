<?php

require_once("class/model/Values.php");

//Implementacion principal de Values para una entidad especifica
class HorarioValuesMain extends EntityValues {
  public $id = UNDEFINED;
  public $horaInicio = UNDEFINED;
  public $horaFin = UNDEFINED;
  public $horasCatedra = UNDEFINED;
  public $dia = UNDEFINED;
  public $curso = UNDEFINED;

  public function setDefault(){
    $this->id = null;
    $this->horaInicio = null;
    $this->horaFin = null;
    $this->horasCatedra = null;
    $this->dia = null;
    $this->curso = null;
  }

  public function fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."hora_inicio"])) $this->setHoraInicioStr($row[$p."hora_inicio"]);
    if(isset($row[$p."hora_fin"])) $this->setHoraFinStr($row[$p."hora_fin"]);
    if(isset($row[$p."horas_catedra"])) $this->setHorasCatedra($row[$p."horas_catedra"]);
    if(isset($row[$p."dia"])) $this->setDia($row[$p."dia"]);
    if(isset($row[$p."curso"])) $this->setCurso($row[$p."curso"]);
  }

  public function toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id;
    if($this->horaInicio !== UNDEFINED) {
        if(empty($this->horaInicio)) $row["hora_inicio"] = $this->horaInicio;
        else $row["hora_inicio"] = $this->horaInicio->format('H:i');
      }
    if($this->horaFin !== UNDEFINED) {
        if(empty($this->horaFin)) $row["hora_fin"] = $this->horaFin;
        else $row["hora_fin"] = $this->horaFin->format('H:i');
      }
    if($this->horasCatedra !== UNDEFINED) $row["horas_catedra"] = $this->horasCatedra;
    if($this->dia !== UNDEFINED) $row["dia"] = $this->dia;
    if($this->curso !== UNDEFINED) $row["curso"] = $this->curso;
    return $row;
  }

  public function id() { return $this->id; }
  public function horaInicio($format = 'H:i') { return $this->formatDate($this->horaInicio, $format); }
  public function horaFin($format = 'H:i') { return $this->formatDate($this->horaFin, $format); }
  public function horasCatedra() { return $this->horasCatedra; }
  public function dia() { return $this->dia; }
  public function curso() { return $this->curso; }
  public function setId($p) {
    $p = trim($p);
    $this->id = (empty($p)) ? null : (string)$p;
  }

  public function setHoraInicio(DateTime $p = null) {
    $this->horaInicio = $p;
  }

  public function setHoraInicioStr($p, $format = "H:i:s") {
    $p = SpanishDateTime::createFromFormat($format, trim($p));
    $this->horaInicio = (empty($p)) ? null : $p;
  }

  public function setHoraFin(DateTime $p = null) {
    $this->horaFin = $p;
  }

  public function setHoraFinStr($p, $format = "H:i:s") {
    $p = SpanishDateTime::createFromFormat($format, trim($p));
    $this->horaFin = (empty($p)) ? null : $p;
  }

  public function setHorasCatedra($p) {
    $p = trim($p);
    $this->horasCatedra = (is_null($p) && $p !== 0) ? null : intval($p);
  }
  public function setDia($p) {
    $p = trim($p);
    $this->dia = (empty($p)) ? null : (string)$p;
  }

  public function setCurso($p) {
    $p = trim($p);
    $this->curso = (empty($p)) ? null : (string)$p;
  }



}
