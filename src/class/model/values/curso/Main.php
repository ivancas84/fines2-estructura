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
    if(isset($row[$p."id"])) $this->id = (is_null($row[$p."id"])) ? null : (string)$row[$p."id"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row[$p."estado"])) $this->estado = (is_null($row[$p."estado"])) ? null : (string)$row[$p."estado"];
    if(isset($row[$p."alta"])) $this->alta = (is_null($row[$p."alta"])) ? null : DateTime::createFromFormat('Y-m-d H:i:s', $row[$p."alta"]);
    if(isset($row[$p."baja"])) $this->baja = (is_null($row[$p."baja"])) ? null : DateTime::createFromFormat('Y-m-d H:i:s', $row[$p."baja"]);
    if(isset($row[$p."horario"])) $this->horario = (is_null($row[$p."horario"])) ? null : (string)$row[$p."horario"];
    if(isset($row[$p."comision"])) $this->comision = (is_null($row[$p."comision"])) ? null : (string)$row[$p."comision"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row[$p."carga_horaria"])) $this->cargaHoraria = (is_null($row[$p."carga_horaria"])) ? null : (string)$row[$p."carga_horaria"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row[$p."toma_activa"])) $this->tomaActiva = (is_null($row[$p."toma_activa"])) ? null : (string)$row[$p."toma_activa"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
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
  public function alta($format = 'd/m/Y H:i') { return $this->formatDate($this->alta, $format); }
  public function baja($format = 'd/m/Y H:i') { return $this->formatDate($this->baja, $format); }
  public function horario($format = null) { return $this->formatString($this->horario, $format); }
  public function comision() { return $this->comision; }
  public function cargaHoraria() { return $this->cargaHoraria; }
  public function tomaActiva() { return $this->tomaActiva; }
  public function setId($p) {
    if(empty($p)) return;
    $this->id = trim($p);
  }

  public function setEstado($p) {
    if(empty($p)) return;
    $this->estado = trim($p);
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

  public function setBaja(DateTime $p) {
    if(empty($p)) return;
    $this->baja = $p;
  }

  public function setBajaStr($p, $format = "Y-m-d H:i:s") {
    $p = SpanishDateTime::createFromFormat($format, trim($p));
    if(empty($p)) return;
    $this->baja = $p;
  }

  public function setHorario($p) {
    if(empty($p)) return;
    $this->horario = trim($p);
  }

  public function setComision($p) {
    if(empty($p) && $p !== 0) return;
    $this->comision = intval(trim($p));
  }

  public function setCargaHoraria($p) {
    if(empty($p) && $p !== 0) return;
    $this->cargaHoraria = intval(trim($p));
  }

  public function setTomaActiva($p) {
    if(empty($p) && $p !== 0) return;
    $this->tomaActiva = intval(trim($p));
  }



}
