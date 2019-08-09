<?php

require_once("class/model/Values.php");

//Implementacion principal de Values para una entidad especifica
class DistribucionHorariaValuesMain extends EntityValues {
  public $id = UNDEFINED;
  public $dia = UNDEFINED;
  public $horasCatedra = UNDEFINED;
  public $cargaHoraria = UNDEFINED;

  public function fromArray(array $row = NULL){
    if(empty($row)) return;
    if(isset($row["id"])) $this->id = (is_null($row["id"])) ? null : (string)$row["id"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row["dia"])) $this->dia = (is_null($row["dia"])) ? null : intval($row["dia"]);
    if(isset($row["horas_catedra"])) $this->horasCatedra = (is_null($row["horas_catedra"])) ? null : intval($row["horas_catedra"]);
    if(isset($row["carga_horaria"])) $this->cargaHoraria = (is_null($row["carga_horaria"])) ? null : (string)$row["carga_horaria"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
  }


  public function toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id;
    if($this->dia !== UNDEFINED) $row["dia"] = $this->dia;
    if($this->horasCatedra !== UNDEFINED) $row["horas_catedra"] = $this->horasCatedra;
    if($this->cargaHoraria !== UNDEFINED) $row["carga_horaria"] = $this->cargaHoraria;
    return $row;
  }

  public function id() { return $this->id; }
  public function dia() { return $this->dia; }
  public function horasCatedra() { return $this->horasCatedra; }
  public function cargaHoraria() { return $this->cargaHoraria; }
  public function setId($p) {
    if(empty($p)) return;
    $this->id = $p;
  }

  public function setDia($p) {
    if(empty($p) && $p !== 0) return;
    $this->dia = intval($p);
  }

  public function setHorasCatedra($p) {
    if(empty($p) && $p !== 0) return;
    $this->horasCatedra = intval($p);
  }

  public function setCargaHoraria($p) {
    if(empty($p) && $p !== 0) return;
    $this->cargaHoraria = intval($p);
  }



}
