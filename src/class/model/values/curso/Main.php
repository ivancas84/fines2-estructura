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

  public function fromArray(array $row = NULL){
    if(empty($row)) return;
    if(isset($row["id"])) $this->id = (is_null($row["id"])) ? null : (string)$row["id"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row["estado"])) $this->estado = (is_null($row["estado"])) ? null : (string)$row["estado"];
    if(isset($row["alta"])) $this->alta = (is_null($row["alta"])) ? null : DateTime::createFromFormat('Y-m-d H:i:s', $row["alta"]);
    if(isset($row["baja"])) $this->baja = (is_null($row["baja"])) ? null : DateTime::createFromFormat('Y-m-d H:i:s', $row["baja"]);
    if(isset($row["horario"])) $this->horario = (is_null($row["horario"])) ? null : (string)$row["horario"];
    if(isset($row["comision"])) $this->comision = (is_null($row["comision"])) ? null : (string)$row["comision"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row["carga_horaria"])) $this->cargaHoraria = (is_null($row["carga_horaria"])) ? null : (string)$row["carga_horaria"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row["toma_activa"])) $this->tomaActiva = (is_null($row["toma_activa"])) ? null : (string)$row["toma_activa"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
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

  public function setAlta($p) {
    if(empty($p)) return;
    $this->alta = trim($p);
  }

  public function setBaja($p) {
    if(empty($p)) return;
    $this->baja = trim($p);
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
