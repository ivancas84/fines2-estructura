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
    if(isset($row[$p."id"])) $this->id = (is_null($row[$p."id"])) ? null : (string)$row[$p."id"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row[$p."numero"])) $this->numero = (is_null($row[$p."numero"])) ? null : (string)$row[$p."numero"];
    if(isset($row[$p."nombre"])) $this->nombre = (is_null($row[$p."nombre"])) ? null : (string)$row[$p."nombre"];
    if(isset($row[$p."organizacion"])) $this->organizacion = (is_null($row[$p."organizacion"])) ? null : (string)$row[$p."organizacion"];
    if(isset($row[$p."observaciones"])) $this->observaciones = (is_null($row[$p."observaciones"])) ? null : (string)$row[$p."observaciones"];
    if(isset($row[$p."tipo"])) $this->tipo = (is_null($row[$p."tipo"])) ? null : (string)$row[$p."tipo"];
    if(isset($row[$p."baja"])) $this->baja = (is_null($row[$p."baja"])) ? null : DateTime::createFromFormat('Y-m-d H:i:s', $row[$p."baja"]);
    if(isset($row[$p."dependencia"])) $this->dependencia = (is_null($row[$p."dependencia"])) ? null : (string)$row[$p."dependencia"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row[$p."tipo_sede"])) $this->tipoSede = (is_null($row[$p."tipo_sede"])) ? null : (string)$row[$p."tipo_sede"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row[$p."domicilio"])) $this->domicilio = (is_null($row[$p."domicilio"])) ? null : (string)$row[$p."domicilio"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row[$p."coordinador"])) $this->coordinador = (is_null($row[$p."coordinador"])) ? null : (string)$row[$p."coordinador"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row[$p."referente"])) $this->referente = (is_null($row[$p."referente"])) ? null : (string)$row[$p."referente"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
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
  public function baja($format = 'd/m/Y H:i') { return $this->formatDate($this->baja, $format); }
  public function dependencia() { return $this->dependencia; }
  public function tipoSede() { return $this->tipoSede; }
  public function domicilio() { return $this->domicilio; }
  public function coordinador() { return $this->coordinador; }
  public function referente() { return $this->referente; }
  public function setId($p) {
    if(empty($p)) return;
    $this->id = trim($p);
  }

  public function setNumero($p) {
    if(empty($p)) return;
    $this->numero = trim($p);
  }

  public function setNombre($p) {
    if(empty($p)) return;
    $this->nombre = trim($p);
  }

  public function setOrganizacion($p) {
    if(empty($p)) return;
    $this->organizacion = trim($p);
  }

  public function setObservaciones($p) {
    if(empty($p)) return;
    $this->observaciones = trim($p);
  }

  public function setTipo($p) {
    if(empty($p)) return;
    $this->tipo = trim($p);
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

  public function setDependencia($p) {
    if(empty($p) && $p !== 0) return;
    $this->dependencia = intval(trim($p));
  }

  public function setTipoSede($p) {
    if(empty($p) && $p !== 0) return;
    $this->tipoSede = intval(trim($p));
  }

  public function setDomicilio($p) {
    if(empty($p) && $p !== 0) return;
    $this->domicilio = intval(trim($p));
  }

  public function setCoordinador($p) {
    if(empty($p) && $p !== 0) return;
    $this->coordinador = intval(trim($p));
  }

  public function setReferente($p) {
    if(empty($p) && $p !== 0) return;
    $this->referente = intval(trim($p));
  }



}
