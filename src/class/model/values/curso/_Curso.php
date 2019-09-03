<?php

require_once("class/model/Values.php");

class _Curso extends EntityValues {
  public $id = UNDEFINED;
  public $estado = UNDEFINED;
  public $alta = UNDEFINED;
  public $baja = UNDEFINED;
  public $horario = UNDEFINED;
  public $comision = UNDEFINED;
  public $cargaHoraria = UNDEFINED;
  public $tomaActiva = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setEstado(DEFAULT_VALUE);
    $this->setAlta(DEFAULT_VALUE);
    $this->setBaja(DEFAULT_VALUE);
    $this->setHorario(DEFAULT_VALUE);
    $this->setComision(DEFAULT_VALUE);
    $this->setCargaHoraria(DEFAULT_VALUE);
    $this->setTomaActiva(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."estado"])) $this->setEstado($row[$p."estado"]);
    if(isset($row[$p."alta"])) $this->setAlta($row[$p."alta"]);
    if(isset($row[$p."baja"])) $this->setBaja($row[$p."baja"]);
    if(isset($row[$p."horario"])) $this->setHorario($row[$p."horario"]);
    if(isset($row[$p."comision"])) $this->setComision($row[$p."comision"]);
    if(isset($row[$p."carga_horaria"])) $this->setCargaHoraria($row[$p."carga_horaria"]);
    if(isset($row[$p."toma_activa"])) $this->setTomaActiva($row[$p."toma_activa"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id();
    if($this->estado !== UNDEFINED) $row["estado"] = $this->estado();
    if($this->alta !== UNDEFINED) $row["alta"] = $this->alta();
    if($this->baja !== UNDEFINED) $row["baja"] = $this->baja();
    if($this->horario !== UNDEFINED) $row["horario"] = $this->horario();
    if($this->comision !== UNDEFINED) $row["comision"] = $this->comision();
    if($this->cargaHoraria !== UNDEFINED) $row["carga_horaria"] = $this->cargaHoraria();
    if($this->tomaActiva !== UNDEFINED) $row["toma_activa"] = $this->tomaActiva();
    return $row;
  }

  public function id() { return $this->id; }
  public function estado($format = null) { return $this->formatString($this->estado, $format); }
  public function alta($format = 'Y-m-d H:i:s') { return $this->formatDate($this->alta, $format); }
  public function baja($format = 'Y-m-d H:i:s') { return $this->formatDate($this->baja, $format); }
  public function horario($format = null) { return $this->formatString($this->horario, $format); }
  public function comision() { return $this->comision; }
  public function cargaHoraria() { return $this->cargaHoraria; }
  public function tomaActiva() { return $this->tomaActiva; }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->id = (empty($p)) ? null : (string)$p;
  }

  public function setEstado($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->estado = (empty($p)) ? null : (string)$p;
  }

  public function _setAlta(DateTime $p = null) {
    $this->alta = $p;
  }

  public function setAlta($p, $format = "Y-m-d H:i:s") {
    $p = ($p == DEFAULT_VALUE) ? date('Y-m-d H:i:s') : trim($p);
    $p = SpanishDateTime::createFromFormat($format, $p);
    $this->alta = (empty($p)) ? null : $p;
  }

  public function _setBaja(DateTime $p = null) {
    $this->baja = $p;
  }

  public function setBaja($p, $format = "Y-m-d H:i:s") {
    $p = ($p == DEFAULT_VALUE) ? '' : trim($p);
    $p = SpanishDateTime::createFromFormat($format, $p);
    $this->baja = (empty($p)) ? null : $p;
  }

  public function setHorario($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->horario = (empty($p)) ? null : (string)$p;
  }

  public function setComision($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->comision = (empty($p)) ? null : (string)$p;
  }

  public function setCargaHoraria($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->cargaHoraria = (empty($p)) ? null : (string)$p;
  }

  public function setTomaActiva($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->tomaActiva = (empty($p)) ? null : (string)$p;
  }



}
