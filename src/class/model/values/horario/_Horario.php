<?php

require_once("class/model/Values.php");

class _Horario extends EntityValues {
  public $id = UNDEFINED;
  public $horaInicio = UNDEFINED;
  public $horaFin = UNDEFINED;
  public $horasCatedra = UNDEFINED;
  public $dia = UNDEFINED;
  public $curso = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setHoraInicio(DEFAULT_VALUE);
    $this->setHoraFin(DEFAULT_VALUE);
    $this->setHorasCatedra(DEFAULT_VALUE);
    $this->setDia(DEFAULT_VALUE);
    $this->setCurso(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."hora_inicio"])) $this->setHoraInicio($row[$p."hora_inicio"]);
    if(isset($row[$p."hora_fin"])) $this->setHoraFin($row[$p."hora_fin"]);
    if(isset($row[$p."horas_catedra"])) $this->setHorasCatedra($row[$p."horas_catedra"]);
    if(isset($row[$p."dia"])) $this->setDia($row[$p."dia"]);
    if(isset($row[$p."curso"])) $this->setCurso($row[$p."curso"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id();
    if($this->horaInicio !== UNDEFINED) $row["hora_inicio"] = $this->horaInicio();
    if($this->horaFin !== UNDEFINED) $row["hora_fin"] = $this->horaFin();
    if($this->horasCatedra !== UNDEFINED) $row["horas_catedra"] = $this->horasCatedra();
    if($this->dia !== UNDEFINED) $row["dia"] = $this->dia();
    if($this->curso !== UNDEFINED) $row["curso"] = $this->curso();
    return $row;
  }

  public function id() { return $this->id; }
  public function horaInicio($format = 'H:i') { return $this->_formatDate($this->horaInicio, $format); }
  public function horaFin($format = 'H:i') { return $this->_formatDate($this->horaFin, $format); }
  public function horasCatedra() { return $this->horasCatedra; }
  public function dia() { return $this->dia; }
  public function curso() { return $this->curso; }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->id = (empty($p)) ? null : (string)$p;
  }

  public function _setHoraInicio(DateTime $p = null) {
    $this->horaInicio = $p;
  }

  public function setHoraInicio($p, $format = "H:i:s") {
    $p = ($p == DEFAULT_VALUE) ? '' : trim($p);
    $p = SpanishDateTime::createFromFormat($format, $p);
    $this->horaInicio = (empty($p)) ? null : $p;
  }

  public function _setHoraFin(DateTime $p = null) {
    $this->horaFin = $p;
  }

  public function setHoraFin($p, $format = "H:i:s") {
    $p = ($p == DEFAULT_VALUE) ? '' : trim($p);
    $p = SpanishDateTime::createFromFormat($format, $p);
    $this->horaFin = (empty($p)) ? null : $p;
  }

  public function setHorasCatedra($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $this->horasCatedra = (is_null($p)) ? null : intval(trim($p));
  }

  public function setDia($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->dia = (empty($p)) ? null : (string)$p;
  }

  public function setCurso($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->curso = (empty($p)) ? null : (string)$p;
  }



}
