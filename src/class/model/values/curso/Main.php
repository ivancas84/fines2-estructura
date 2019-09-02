<?php

require_once("class/model/Values.php");

//Implementacion principal de Values para una entidad especifica
class CursoValuesMain extends EntityValues {
  public $id = UNDEFINED;
  public $estado = UNDEFINED;
  public $alta = UNDEFINED;
  public $baja = UNDEFINED;
  public $horario = UNDEFINED;
  public $comision = UNDEFINED;
  public $cargaHoraria = UNDEFINED;
  public $tomaActiva = UNDEFINED;

  public function setDefault(){
    $this->id = null;
    $this->estado = null;
    $this->alta = new DateTime();
    $this->baja = null;
    $this->horario = null;
    $this->comision = null;
    $this->cargaHoraria = null;
    $this->tomaActiva = null;
  }

  public function fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."estado"])) $this->setEstado($row[$p."estado"]);
    if(isset($row[$p."alta"])) $this->setAltaStr($row[$p."alta"]);
    if(isset($row[$p."baja"])) $this->setBajaStr($row[$p."baja"]);
    if(isset($row[$p."horario"])) $this->setHorario($row[$p."horario"]);
    if(isset($row[$p."comision"])) $this->setComision($row[$p."comision"]);
    if(isset($row[$p."carga_horaria"])) $this->setCargaHoraria($row[$p."carga_horaria"]);
    if(isset($row[$p."toma_activa"])) $this->setTomaActiva($row[$p."toma_activa"]);
  }

  public function toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id;
    if($this->estado !== UNDEFINED) $row["estado"] = $this->estado;
    if($this->alta !== UNDEFINED) {
        if(empty($this->alta)) $row["alta"] = $this->alta;
        else $row["alta"] = $this->alta->format('Y-m-d H:i:s');
      }
    if($this->baja !== UNDEFINED) {
        if(empty($this->baja)) $row["baja"] = $this->baja;
        else $row["baja"] = $this->baja->format('Y-m-d H:i:s');
      }
    if($this->horario !== UNDEFINED) $row["horario"] = $this->horario;
    if($this->comision !== UNDEFINED) $row["comision"] = $this->comision;
    if($this->cargaHoraria !== UNDEFINED) $row["carga_horaria"] = $this->cargaHoraria;
    if($this->tomaActiva !== UNDEFINED) $row["toma_activa"] = $this->tomaActiva;
    return $row;
  }

  public function id() { return $this->id; }
  public function estado($format = null) { return $this->formatString($this->estado, $format); }
  public function alta($format = 'd/m/Y H:i:s') { return $this->formatDate($this->alta, $format); }
  public function baja($format = 'd/m/Y H:i:s') { return $this->formatDate($this->baja, $format); }
  public function horario($format = null) { return $this->formatString($this->horario, $format); }
  public function comision() { return $this->comision; }
  public function cargaHoraria() { return $this->cargaHoraria; }
  public function tomaActiva() { return $this->tomaActiva; }
  public function setId($p) {
    $p = trim($p);
    $this->id = (empty($p)) ? null : (string)$p;
  }

  public function setEstado($p) {
    $p = trim($p);
    $this->estado = (empty($p)) ? null : (string)$p;
  }

  public function setAlta(DateTime $p = null) {
    $this->alta = $p;
  }

  public function setAltaStr($p, $format = "Y-m-d H:i:s") {
    $p = SpanishDateTime::createFromFormat($format, trim($p));
    $this->alta = (empty($p)) ? null : $p;
  }

  public function setBaja(DateTime $p = null) {
    $this->baja = $p;
  }

  public function setBajaStr($p, $format = "Y-m-d H:i:s") {
    $p = SpanishDateTime::createFromFormat($format, trim($p));
    $this->baja = (empty($p)) ? null : $p;
  }

  public function setHorario($p) {
    $p = trim($p);
    $this->horario = (empty($p)) ? null : (string)$p;
  }

  public function setComision($p) {
    $p = trim($p);
    $this->comision = (empty($p)) ? null : (string)$p;
  }

  public function setCargaHoraria($p) {
    $p = trim($p);
    $this->cargaHoraria = (empty($p)) ? null : (string)$p;
  }

  public function setTomaActiva($p) {
    $p = trim($p);
    $this->tomaActiva = (empty($p)) ? null : (string)$p;
  }



}
