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
    if(isset($row[$p."id"])) $this->id = (is_null($row[$p."id"])) ? null : (string)$row[$p."id"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row[$p."clasificacion"])) $this->clasificacion = (is_null($row[$p."clasificacion"])) ? null : (string)$row[$p."clasificacion"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row[$p."plan"])) $this->plan = (is_null($row[$p."plan"])) ? null : (string)$row[$p."plan"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
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
    if(empty($p)) return;
    $this->id = trim($p);
  }

  public function setClasificacion($p) {
    if(empty($p) && $p !== 0) return;
    $this->clasificacion = intval(trim($p));
  }

  public function setPlan($p) {
    if(empty($p) && $p !== 0) return;
    $this->plan = intval(trim($p));
  }



}
