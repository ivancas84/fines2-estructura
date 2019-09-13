<?php

require_once("class/model/Values.php");

class _Inasistencia extends EntityValues {
  public $id = UNDEFINED;
  public $fechaDesde = UNDEFINED;
  public $fechaHasta = UNDEFINED;
  public $modulosSemanales = UNDEFINED;
  public $modulosMensuales = UNDEFINED;
  public $articulo = UNDEFINED;
  public $inciso = UNDEFINED;
  public $observaciones = UNDEFINED;
  public $toma = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setFechaDesde(DEFAULT_VALUE);
    $this->setFechaHasta(DEFAULT_VALUE);
    $this->setModulosSemanales(DEFAULT_VALUE);
    $this->setModulosMensuales(DEFAULT_VALUE);
    $this->setArticulo(DEFAULT_VALUE);
    $this->setInciso(DEFAULT_VALUE);
    $this->setObservaciones(DEFAULT_VALUE);
    $this->setToma(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."fecha_desde"])) $this->setFechaDesde($row[$p."fecha_desde"]);
    if(isset($row[$p."fecha_hasta"])) $this->setFechaHasta($row[$p."fecha_hasta"]);
    if(isset($row[$p."modulos_semanales"])) $this->setModulosSemanales($row[$p."modulos_semanales"]);
    if(isset($row[$p."modulos_mensuales"])) $this->setModulosMensuales($row[$p."modulos_mensuales"]);
    if(isset($row[$p."articulo"])) $this->setArticulo($row[$p."articulo"]);
    if(isset($row[$p."inciso"])) $this->setInciso($row[$p."inciso"]);
    if(isset($row[$p."observaciones"])) $this->setObservaciones($row[$p."observaciones"]);
    if(isset($row[$p."toma"])) $this->setToma($row[$p."toma"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id();
    if($this->fechaDesde !== UNDEFINED) $row["fecha_desde"] = $this->fechaDesde();
    if($this->fechaHasta !== UNDEFINED) $row["fecha_hasta"] = $this->fechaHasta();
    if($this->modulosSemanales !== UNDEFINED) $row["modulos_semanales"] = $this->modulosSemanales();
    if($this->modulosMensuales !== UNDEFINED) $row["modulos_mensuales"] = $this->modulosMensuales();
    if($this->articulo !== UNDEFINED) $row["articulo"] = $this->articulo();
    if($this->inciso !== UNDEFINED) $row["inciso"] = $this->inciso();
    if($this->observaciones !== UNDEFINED) $row["observaciones"] = $this->observaciones();
    if($this->toma !== UNDEFINED) $row["toma"] = $this->toma();
    return $row;
  }

  public function id() { return $this->id; }
  public function fechaDesde($format = 'Y-m-d') { return $this->_formatDate($this->fechaDesde, $format); }
  public function fechaHasta($format = 'Y-m-d') { return $this->_formatDate($this->fechaHasta, $format); }
  public function modulosSemanales() { return $this->modulosSemanales; }
  public function modulosMensuales() { return $this->modulosMensuales; }
  public function articulo($format = null) { return $this->_formatString($this->articulo, $format); }
  public function inciso($format = null) { return $this->_formatString($this->inciso, $format); }
  public function observaciones($format = null) { return $this->_formatString($this->observaciones, $format); }
  public function toma() { return $this->toma; }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->id = (empty($p)) ? null : (string)$p;
  }

  public function _setFechaDesde(DateTime $p = null) {
    $this->fechaDesde = $p;
  }

  public function setFechaDesde($p, $format = "Y-m-d") {
    $p = ($p == DEFAULT_VALUE) ? '' : trim($p);
    $p = SpanishDateTime::createFromFormat($format, $p);
    $this->fechaDesde = (empty($p)) ? null : $p;
  }

  public function _setFechaHasta(DateTime $p = null) {
    $this->fechaHasta = $p;
  }

  public function setFechaHasta($p, $format = "Y-m-d") {
    $p = ($p == DEFAULT_VALUE) ? '' : trim($p);
    $p = SpanishDateTime::createFromFormat($format, $p);
    $this->fechaHasta = (empty($p)) ? null : $p;
  }

  public function setModulosSemanales($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $this->modulosSemanales = (is_null($p)) ? null : intval(trim($p));
  }

  public function setModulosMensuales($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $this->modulosMensuales = (is_null($p)) ? null : intval(trim($p));
  }

  public function setArticulo($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->articulo = (empty($p)) ? null : (string)$p;
  }

  public function setInciso($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->inciso = (empty($p)) ? null : (string)$p;
  }

  public function setObservaciones($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->observaciones = (empty($p)) ? null : (string)$p;
  }

  public function setToma($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->toma = (empty($p)) ? null : (string)$p;
  }



}
