<?php

require_once("class/model/Values.php");

class _ClasificacionPlan extends EntityValues {
  public $id = UNDEFINED;
  public $clasificacion = UNDEFINED;
  public $plan = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setClasificacion(DEFAULT_VALUE);
    $this->setPlan(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."clasificacion"])) $this->setClasificacion($row[$p."clasificacion"]);
    if(isset($row[$p."plan"])) $this->setPlan($row[$p."plan"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id();
    if($this->clasificacion !== UNDEFINED) $row["clasificacion"] = $this->clasificacion();
    if($this->plan !== UNDEFINED) $row["plan"] = $this->plan();
    return $row;
  }

  public function id() { return $this->id; }
  public function clasificacion() { return $this->clasificacion; }
  public function plan() { return $this->plan; }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->id = (empty($p)) ? null : (string)$p;
  }

  public function setClasificacion($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->clasificacion = (empty($p)) ? null : (string)$p;
  }

  public function setPlan($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->plan = (empty($p)) ? null : (string)$p;
  }



}
