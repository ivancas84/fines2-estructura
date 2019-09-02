<?php

require_once("class/model/Values.php");

//Implementacion principal de Values para una entidad especifica
class DomicilioValuesMain extends EntityValues {
  public $id = UNDEFINED;
  public $calle = UNDEFINED;
  public $entre = UNDEFINED;
  public $numero = UNDEFINED;
  public $piso = UNDEFINED;
  public $departamento = UNDEFINED;
  public $barrio = UNDEFINED;
  public $localidad = UNDEFINED;

  public function setDefault(){
    $this->id = null;
    $this->calle = null;
    $this->entre = null;
    $this->numero = "S/N";
    $this->piso = null;
    $this->departamento = null;
    $this->barrio = null;
    $this->localidad = "La Plata";
  }

  public function fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."calle"])) $this->setCalle($row[$p."calle"]);
    if(isset($row[$p."entre"])) $this->setEntre($row[$p."entre"]);
    if(isset($row[$p."numero"])) $this->setNumero($row[$p."numero"]);
    if(isset($row[$p."piso"])) $this->setPiso($row[$p."piso"]);
    if(isset($row[$p."departamento"])) $this->setDepartamento($row[$p."departamento"]);
    if(isset($row[$p."barrio"])) $this->setBarrio($row[$p."barrio"]);
    if(isset($row[$p."localidad"])) $this->setLocalidad($row[$p."localidad"]);
  }

  public function toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id;
    if($this->calle !== UNDEFINED) $row["calle"] = $this->calle;
    if($this->entre !== UNDEFINED) $row["entre"] = $this->entre;
    if($this->numero !== UNDEFINED) $row["numero"] = $this->numero;
    if($this->piso !== UNDEFINED) $row["piso"] = $this->piso;
    if($this->departamento !== UNDEFINED) $row["departamento"] = $this->departamento;
    if($this->barrio !== UNDEFINED) $row["barrio"] = $this->barrio;
    if($this->localidad !== UNDEFINED) $row["localidad"] = $this->localidad;
    return $row;
  }

  public function id() { return $this->id; }
  public function calle($format = null) { return $this->formatString($this->calle, $format); }
  public function entre($format = null) { return $this->formatString($this->entre, $format); }
  public function numero($format = null) { return $this->formatString($this->numero, $format); }
  public function piso($format = null) { return $this->formatString($this->piso, $format); }
  public function departamento($format = null) { return $this->formatString($this->departamento, $format); }
  public function barrio($format = null) { return $this->formatString($this->barrio, $format); }
  public function localidad($format = null) { return $this->formatString($this->localidad, $format); }
  public function setId($p) {
    $p = trim($p);
    $this->id = (empty($p)) ? null : (string)$p;
  }

  public function setCalle($p) {
    $p = trim($p);
    $this->calle = (empty($p)) ? null : (string)$p;
  }

  public function setEntre($p) {
    $p = trim($p);
    $this->entre = (empty($p)) ? null : (string)$p;
  }

  public function setNumero($p) {
    $p = trim($p);
    $this->numero = (empty($p)) ? null : (string)$p;
  }

  public function setPiso($p) {
    $p = trim($p);
    $this->piso = (empty($p)) ? null : (string)$p;
  }

  public function setDepartamento($p) {
    $p = trim($p);
    $this->departamento = (empty($p)) ? null : (string)$p;
  }

  public function setBarrio($p) {
    $p = trim($p);
    $this->barrio = (empty($p)) ? null : (string)$p;
  }

  public function setLocalidad($p) {
    $p = trim($p);
    $this->localidad = (empty($p)) ? null : (string)$p;
  }



}
