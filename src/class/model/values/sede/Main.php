<?php

require_once("class/model/Values.php");

//Implementacion principal de Values para una entidad especifica
class SedeValuesMain extends EntityValues {
  public $id = UNDEFINED;
  public $numero = UNDEFINED;
  public $nombre = UNDEFINED;
  public $organizacion = UNDEFINED;
  public $observaciones = UNDEFINED;
  public $tipo = UNDEFINED;
  public $baja = UNDEFINED;
  public $dependencia = UNDEFINED;
  public $tipoSede = UNDEFINED;
  public $domicilio = UNDEFINED;
  public $coordinador = UNDEFINED;
  public $referente = UNDEFINED;

  public function setDefault(){
    $this->id = null;
    $this->numero = null;
    $this->nombre = null;
    $this->organizacion = null;
    $this->observaciones = null;
    $this->tipo = null;
    $this->baja = null;
    $this->dependencia = null;
    $this->tipoSede = null;
    $this->domicilio = null;
    $this->coordinador = null;
    $this->referente = null;
  }

  public function fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."numero"])) $this->setNumero($row[$p."numero"]);
    if(isset($row[$p."nombre"])) $this->setNombre($row[$p."nombre"]);
    if(isset($row[$p."organizacion"])) $this->setOrganizacion($row[$p."organizacion"]);
    if(isset($row[$p."observaciones"])) $this->setObservaciones($row[$p."observaciones"]);
    if(isset($row[$p."tipo"])) $this->setTipo($row[$p."tipo"]);
    if(isset($row[$p."baja"])) $this->setBajaStr($row[$p."baja"]);
    if(isset($row[$p."dependencia"])) $this->setDependencia($row[$p."dependencia"]);
    if(isset($row[$p."tipo_sede"])) $this->setTipoSede($row[$p."tipo_sede"]);
    if(isset($row[$p."domicilio"])) $this->setDomicilio($row[$p."domicilio"]);
    if(isset($row[$p."coordinador"])) $this->setCoordinador($row[$p."coordinador"]);
    if(isset($row[$p."referente"])) $this->setReferente($row[$p."referente"]);
  }

  public function toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id;
    if($this->numero !== UNDEFINED) $row["numero"] = $this->numero;
    if($this->nombre !== UNDEFINED) $row["nombre"] = $this->nombre;
    if($this->organizacion !== UNDEFINED) $row["organizacion"] = $this->organizacion;
    if($this->observaciones !== UNDEFINED) $row["observaciones"] = $this->observaciones;
    if($this->tipo !== UNDEFINED) $row["tipo"] = $this->tipo;
    if($this->baja !== UNDEFINED) {
        if(empty($this->baja)) $row["baja"] = $this->baja;
        else $row["baja"] = $this->baja->format('Y-m-d H:i:s');
      }
    if($this->dependencia !== UNDEFINED) $row["dependencia"] = $this->dependencia;
    if($this->tipoSede !== UNDEFINED) $row["tipo_sede"] = $this->tipoSede;
    if($this->domicilio !== UNDEFINED) $row["domicilio"] = $this->domicilio;
    if($this->coordinador !== UNDEFINED) $row["coordinador"] = $this->coordinador;
    if($this->referente !== UNDEFINED) $row["referente"] = $this->referente;
    return $row;
  }

  public function id() { return $this->id; }
  public function numero($format = null) { return $this->formatString($this->numero, $format); }
  public function nombre($format = null) { return $this->formatString($this->nombre, $format); }
  public function organizacion($format = null) { return $this->formatString($this->organizacion, $format); }
  public function observaciones($format = null) { return $this->formatString($this->observaciones, $format); }
  public function tipo($format = null) { return $this->formatString($this->tipo, $format); }
  public function baja($format = 'd/m/Y H:i:s') { return $this->formatDate($this->baja, $format); }
  public function dependencia() { return $this->dependencia; }
  public function tipoSede() { return $this->tipoSede; }
  public function domicilio() { return $this->domicilio; }
  public function coordinador() { return $this->coordinador; }
  public function referente() { return $this->referente; }
  public function setId($p) {
    $p = trim($p);
    $this->id = (empty($p)) ? null : (string)$p;
  }

  public function setNumero($p) {
    $p = trim($p);
    $this->numero = (empty($p)) ? null : (string)$p;
  }

  public function setNombre($p) {
    $p = trim($p);
    $this->nombre = (empty($p)) ? null : (string)$p;
  }

  public function setOrganizacion($p) {
    $p = trim($p);
    $this->organizacion = (empty($p)) ? null : (string)$p;
  }

  public function setObservaciones($p) {
    $p = trim($p);
    $this->observaciones = (empty($p)) ? null : (string)$p;
  }

  public function setTipo($p) {
    $p = trim($p);
    $this->tipo = (empty($p)) ? null : (string)$p;
  }

  public function setBaja(DateTime $p = null) {
    $this->baja = $p;
  }

  public function setBajaStr($p, $format = "Y-m-d H:i:s") {
    $p = SpanishDateTime::createFromFormat($format, trim($p));
    $this->baja = (empty($p)) ? null : $p;
  }

  public function setDependencia($p) {
    $p = trim($p);
    $this->dependencia = (empty($p)) ? null : (string)$p;
  }

  public function setTipoSede($p) {
    $p = trim($p);
    $this->tipoSede = (empty($p)) ? null : (string)$p;
  }

  public function setDomicilio($p) {
    $p = trim($p);
    $this->domicilio = (empty($p)) ? null : (string)$p;
  }

  public function setCoordinador($p) {
    $p = trim($p);
    $this->coordinador = (empty($p)) ? null : (string)$p;
  }

  public function setReferente($p) {
    $p = trim($p);
    $this->referente = (empty($p)) ? null : (string)$p;
  }



}
