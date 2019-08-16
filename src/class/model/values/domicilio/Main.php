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

  public function fromArray(array $row = NULL){
    if(empty($row)) return;
    if(isset($row["id"])) $this->id = (is_null($row["id"])) ? null : (string)$row["id"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row["calle"])) $this->calle = (is_null($row["calle"])) ? null : (string)$row["calle"];
    if(isset($row["entre"])) $this->entre = (is_null($row["entre"])) ? null : (string)$row["entre"];
    if(isset($row["numero"])) $this->numero = (is_null($row["numero"])) ? null : (string)$row["numero"];
    if(isset($row["piso"])) $this->piso = (is_null($row["piso"])) ? null : (string)$row["piso"];
    if(isset($row["departamento"])) $this->departamento = (is_null($row["departamento"])) ? null : (string)$row["departamento"];
    if(isset($row["barrio"])) $this->barrio = (is_null($row["barrio"])) ? null : (string)$row["barrio"];
    if(isset($row["localidad"])) $this->localidad = (is_null($row["localidad"])) ? null : (string)$row["localidad"];
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
    if(empty($p)) return;
    $this->id = trim($p);
  }

  public function setCalle($p) {
    if(empty($p)) return;
    $this->calle = trim($p);
  }

  public function setEntre($p) {
    if(empty($p)) return;
    $this->entre = trim($p);
  }

  public function setNumero($p) {
    if(empty($p)) return;
    $this->numero = trim($p);
  }

  public function setPiso($p) {
    if(empty($p)) return;
    $this->piso = trim($p);
  }

  public function setDepartamento($p) {
    if(empty($p)) return;
    $this->departamento = trim($p);
  }

  public function setBarrio($p) {
    if(empty($p)) return;
    $this->barrio = trim($p);
  }

  public function setLocalidad($p) {
    if(empty($p)) return;
    $this->localidad = trim($p);
  }



}
