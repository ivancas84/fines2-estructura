<?php

require_once("class/model/Values.php");

//Implementacion principal de Values para una entidad especifica
class DistribucionHorariaValuesMain extends EntityValues {
  public $id = UNDEFINED;
  public $dia = UNDEFINED;
  public $horasCatedra = UNDEFINED;
  public $cargaHoraria = UNDEFINED;

  public function setDefault(){
    $this->id = null;
    $this->dia = null;
    $this->horasCatedra = null;
    $this->cargaHoraria = null;
  }

  public function fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."dia"])) $this->setDia($row[$p."dia"]);
    if(isset($row[$p."horas_catedra"])) $this->setHorasCatedra($row[$p."horas_catedra"]);
    if(isset($row[$p."carga_horaria"])) $this->setCargaHoraria($row[$p."carga_horaria"]);
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
    $p = trim($p);
    $this->id = (empty($p)) ? null : (string)$p;
  }

  public function setDia($p) {
    $p = trim($p);
    $this->dia = (is_null($p) && $p !== 0) ? null : intval($p);
  }
  public function setHorasCatedra($p) {
    $p = trim($p);
    $this->horasCatedra = (is_null($p) && $p !== 0) ? null : intval($p);
  }
  public function setCargaHoraria($p) {
    $p = trim($p);
    $this->cargaHoraria = (empty($p)) ? null : (string)$p;
  }



}
