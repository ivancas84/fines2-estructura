<?php

require_once("class/model/Values.php");

//Implementacion principal de Values para una entidad especifica
class ClasificacionPlanValuesMain extends EntityValues {
  public $id = UNDEFINED;
  public $clasificacion = UNDEFINED;
  public $plan = UNDEFINED;

  public function setDefault(){
    $this->id = null;
    $this->clasificacion = null;
    $this->plan = null;
  }

  public function fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."clasificacion"])) $this->setClasificacion($row[$p."clasificacion"]);
    if(isset($row[$p."plan"])) $this->setPlan($row[$p."plan"]);
  }

  public function toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id;
    if($this->clasificacion !== UNDEFINED) $row["clasificacion"] = $this->clasificacion;
    if($this->plan !== UNDEFINED) $row["plan"] = $this->plan;
    return $row;
  }

  public function id() { return $this->id; }
  public function clasificacion() { return $this->clasificacion; }
  public function plan() { return $this->plan; }
  public function setId($p) {
    $p = trim($p);
    $this->id = (empty($p)) ? null : (string)$p;
  }

  public function setClasificacion($p) {
    $p = trim($p);
    $this->clasificacion = (empty($p)) ? null : (string)$p;
  }

  public function setPlan($p) {
    $p = trim($p);
    $this->plan = (empty($p)) ? null : (string)$p;
  }



}
