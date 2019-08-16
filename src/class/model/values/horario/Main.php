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

  public function fromArray(array $row = NULL){
    if(empty($row)) return;
    if(isset($row["id"])) $this->id = (is_null($row["id"])) ? null : (string)$row["id"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row["hora_inicio"])) $this->horaInicio = (is_null($row["hora_inicio"])) ? null : DateTime::createFromFormat('H:i:s', $row["hora_inicio"]);
    if(isset($row["hora_fin"])) $this->horaFin = (is_null($row["hora_fin"])) ? null : DateTime::createFromFormat('H:i:s', $row["hora_fin"]);
    if(isset($row["horas_catedra"])) $this->horasCatedra = (is_null($row["horas_catedra"])) ? null : intval($row["horas_catedra"]);
    if(isset($row["dia"])) $this->dia = (is_null($row["dia"])) ? null : (string)$row["dia"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row["curso"])) $this->curso = (is_null($row["curso"])) ? null : (string)$row["curso"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
  }

  public function toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id;
    if($this->horaInicio !== UNDEFINED) {
      if(empty($this->horaInicio)) $row["hora_inicio"] = $this->horaInicio;
      else $row["hora_inicio"] = $this->horaInicio->format('H:i:s');
    }
    if($this->horaFin !== UNDEFINED) {
      if(empty($this->horaFin)) $row["hora_fin"] = $this->horaFin;
      else $row["hora_fin"] = $this->horaFin->format('H:i:s');
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
    if(empty($p)) return;
    $this->id = trim($p);
  }

  public function setHoraInicio($p) {
    if(empty($p)) return;
    $this->horaInicio = trim($p);
  }

  public function setHoraFin($p) {
    if(empty($p)) return;
    $this->horaFin = trim($p);
  }

  public function setHorasCatedra($p) {
    if(empty($p) && $p !== 0) return;
    $this->horasCatedra = intval(trim($p));
  }

  public function setDia($p) {
    if(empty($p) && $p !== 0) return;
    $this->dia = intval(trim($p));
  }

  public function setCurso($p) {
    if(empty($p) && $p !== 0) return;
    $this->curso = intval(trim($p));
  }



}
