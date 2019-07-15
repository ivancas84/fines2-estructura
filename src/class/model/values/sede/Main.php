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

  public function fromArray(array $row = NULL){
    if(empty($row)) return;
    if(isset($row["id"])) $this->id = (is_null($row["id"])) ? null : (string)$row["id"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row["numero"])) $this->numero = (is_null($row["numero"])) ? null : (string)$row["numero"];
    if(isset($row["nombre"])) $this->nombre = (is_null($row["nombre"])) ? null : (string)$row["nombre"];
    if(isset($row["organizacion"])) $this->organizacion = (is_null($row["organizacion"])) ? null : (string)$row["organizacion"];
    if(isset($row["observaciones"])) $this->observaciones = (is_null($row["observaciones"])) ? null : (string)$row["observaciones"];
    if(isset($row["tipo"])) $this->tipo = (is_null($row["tipo"])) ? null : (string)$row["tipo"];
    if(isset($row["baja"])) $this->baja = (is_null($row["baja"])) ? null : DateTime::createFromFormat('Y-m-d H:i:s', $row["baja"]);
    if(isset($row["dependencia"])) $this->dependencia = (is_null($row["dependencia"])) ? null : (string)$row["dependencia"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row["tipo_sede"])) $this->tipoSede = (is_null($row["tipo_sede"])) ? null : (string)$row["tipo_sede"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row["domicilio"])) $this->domicilio = (is_null($row["domicilio"])) ? null : (string)$row["domicilio"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row["coordinador"])) $this->coordinador = (is_null($row["coordinador"])) ? null : (string)$row["coordinador"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row["referente"])) $this->referente = (is_null($row["referente"])) ? null : (string)$row["referente"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
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
    $this->id = $p;
  }

  public function setNumero($p) {
    if(empty($p)) return;
    $this->numero = $p;
  }

  public function setNombre($p) {
    if(empty($p)) return;
    $this->nombre = $p;
  }

  public function setOrganizacion($p) {
    if(empty($p)) return;
    $this->organizacion = $p;
  }

  public function setObservaciones($p) {
    if(empty($p)) return;
    $this->observaciones = $p;
  }

  public function setTipo($p) {
    if(empty($p)) return;
    $this->tipo = $p;
  }

  public function setBaja($p) {
    if(empty($p)) return;
    $this->baja = $p;
  }

  public function setDependencia($p) {
    if(empty($p) && $p !== 0) return;
    $this->dependencia = intval($p);
  }

  public function setTipoSede($p) {
    if(empty($p) && $p !== 0) return;
    $this->tipoSede = intval($p);
  }

  public function setDomicilio($p) {
    if(empty($p) && $p !== 0) return;
    $this->domicilio = intval($p);
  }

  public function setCoordinador($p) {
    if(empty($p) && $p !== 0) return;
    $this->coordinador = intval($p);
  }

  public function setReferente($p) {
    if(empty($p) && $p !== 0) return;
    $this->referente = intval($p);
  }



}
