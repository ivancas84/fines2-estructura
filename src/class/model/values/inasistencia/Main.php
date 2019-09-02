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

  public function fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."fecha_desde"])) $this->setFechaDesdeStr($row[$p."fecha_desde"]);
    if(isset($row[$p."fecha_hasta"])) $this->setFechaHastaStr($row[$p."fecha_hasta"]);
    if(isset($row[$p."modulos_semanales"])) $this->setModulosSemanales($row[$p."modulos_semanales"]);
    if(isset($row[$p."modulos_mensuales"])) $this->setModulosMensuales($row[$p."modulos_mensuales"]);
    if(isset($row[$p."articulo"])) $this->setArticulo($row[$p."articulo"]);
    if(isset($row[$p."inciso"])) $this->setInciso($row[$p."inciso"]);
    if(isset($row[$p."observaciones"])) $this->setObservaciones($row[$p."observaciones"]);
    if(isset($row[$p."toma"])) $this->setToma($row[$p."toma"]);
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
    $p = trim($p);
    $this->id = (empty($p)) ? null : (string)$p;
  }

  public function setFechaDesde(DateTime $p = null) {
    $this->fechaDesde = $p;
  }

  public function setFechaDesdeStr($p, $format = "Y-m-d") {
    $p = SpanishDateTime::createFromFormat($format, trim($p));
    $this->fechaDesde = (empty($p)) ? null : $p;
  }

  public function setFechaHasta(DateTime $p = null) {
    $this->fechaHasta = $p;
  }

  public function setFechaHastaStr($p, $format = "Y-m-d") {
    $p = SpanishDateTime::createFromFormat($format, trim($p));
    $this->fechaHasta = (empty($p)) ? null : $p;
  }

  public function setModulosSemanales($p) {
    $p = trim($p);
    $this->modulosSemanales = (is_null($p) && $p !== 0) ? null : intval($p);
  }
  public function setModulosMensuales($p) {
    $p = trim($p);
    $this->modulosMensuales = (is_null($p) && $p !== 0) ? null : intval($p);
  }
  public function setArticulo($p) {
    $p = trim($p);
    $this->articulo = (empty($p)) ? null : (string)$p;
  }

  public function setInciso($p) {
    $p = trim($p);
    $this->inciso = (empty($p)) ? null : (string)$p;
  }

  public function setObservaciones($p) {
    $p = trim($p);
    $this->observaciones = (empty($p)) ? null : (string)$p;
  }

  public function setToma($p) {
    $p = trim($p);
    $this->toma = (empty($p)) ? null : (string)$p;
  }



}
