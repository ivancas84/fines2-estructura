<?php

require_once("class/model/Values.php");

//Implementacion principal de Values para una entidad especifica
class InasistenciaValuesMain extends EntityValues {
  public $id = UNDEFINED;
  public $fechaDesde = UNDEFINED;
  public $fechaHasta = UNDEFINED;
  public $modulosSemanales = UNDEFINED;
  public $modulosMensuales = UNDEFINED;
  public $articulo = UNDEFINED;
  public $inciso = UNDEFINED;
  public $observaciones = UNDEFINED;
  public $toma = UNDEFINED;

  public function setDefault(){
    $this->id = null;
    $this->fechaDesde = null;
    $this->fechaHasta = null;
    $this->modulosSemanales = null;
    $this->modulosMensuales = null;
    $this->articulo = null;
    $this->inciso = null;
    $this->observaciones = null;
    $this->toma = null;
  }

  public function fromArray(array $row = NULL){
    if(empty($row)) return;
    if(isset($row["id"])) $this->id = (is_null($row["id"])) ? null : (string)$row["id"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row["fecha_desde"])) $this->fechaDesde = (is_null($row["fecha_desde"])) ? null : DateTime::createFromFormat('Y-m-d', $row["fecha_desde"]);
    if(isset($row["fecha_hasta"])) $this->fechaHasta = (is_null($row["fecha_hasta"])) ? null : DateTime::createFromFormat('Y-m-d', $row["fecha_hasta"]);
    if(isset($row["modulos_semanales"])) $this->modulosSemanales = (is_null($row["modulos_semanales"])) ? null : intval($row["modulos_semanales"]);
    if(isset($row["modulos_mensuales"])) $this->modulosMensuales = (is_null($row["modulos_mensuales"])) ? null : intval($row["modulos_mensuales"]);
    if(isset($row["articulo"])) $this->articulo = (is_null($row["articulo"])) ? null : (string)$row["articulo"];
    if(isset($row["inciso"])) $this->inciso = (is_null($row["inciso"])) ? null : (string)$row["inciso"];
    if(isset($row["observaciones"])) $this->observaciones = (is_null($row["observaciones"])) ? null : (string)$row["observaciones"];
    if(isset($row["toma"])) $this->toma = (is_null($row["toma"])) ? null : (string)$row["toma"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
  }

  public function toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id;
    if($this->fechaDesde !== UNDEFINED) {
      if(empty($this->fechaDesde)) $row["fecha_desde"] = $this->fechaDesde;
      else $row["fecha_desde"] = $this->fechaDesde->format('Y-m-d');
    }
    if($this->fechaHasta !== UNDEFINED) {
      if(empty($this->fechaHasta)) $row["fecha_hasta"] = $this->fechaHasta;
      else $row["fecha_hasta"] = $this->fechaHasta->format('Y-m-d');
    }
    if($this->modulosSemanales !== UNDEFINED) $row["modulos_semanales"] = $this->modulosSemanales;
    if($this->modulosMensuales !== UNDEFINED) $row["modulos_mensuales"] = $this->modulosMensuales;
    if($this->articulo !== UNDEFINED) $row["articulo"] = $this->articulo;
    if($this->inciso !== UNDEFINED) $row["inciso"] = $this->inciso;
    if($this->observaciones !== UNDEFINED) $row["observaciones"] = $this->observaciones;
    if($this->toma !== UNDEFINED) $row["toma"] = $this->toma;
    return $row;
  }

  public function id() { return $this->id; }
  public function fechaDesde($format = 'd/m/Y') { return $this->formatDate($this->fechaDesde, $format); }
  public function fechaHasta($format = 'd/m/Y') { return $this->formatDate($this->fechaHasta, $format); }
  public function modulosSemanales() { return $this->modulosSemanales; }
  public function modulosMensuales() { return $this->modulosMensuales; }
  public function articulo($format = null) { return $this->formatString($this->articulo, $format); }
  public function inciso($format = null) { return $this->formatString($this->inciso, $format); }
  public function observaciones($format = null) { return $this->formatString($this->observaciones, $format); }
  public function toma() { return $this->toma; }
  public function setId($p) {
    if(empty($p)) return;
    $this->id = trim($p);
  }

  public function setFechaDesde($p) {
    if(empty($p)) return;
    $this->fechaDesde = trim($p);
  }

  public function setFechaHasta($p) {
    if(empty($p)) return;
    $this->fechaHasta = trim($p);
  }

  public function setModulosSemanales($p) {
    if(empty($p) && $p !== 0) return;
    $this->modulosSemanales = intval(trim($p));
  }

  public function setModulosMensuales($p) {
    if(empty($p) && $p !== 0) return;
    $this->modulosMensuales = intval(trim($p));
  }

  public function setArticulo($p) {
    if(empty($p)) return;
    $this->articulo = trim($p);
  }

  public function setInciso($p) {
    if(empty($p)) return;
    $this->inciso = trim($p);
  }

  public function setObservaciones($p) {
    if(empty($p)) return;
    $this->observaciones = trim($p);
  }

  public function setToma($p) {
    if(empty($p) && $p !== 0) return;
    $this->toma = intval(trim($p));
  }



}
