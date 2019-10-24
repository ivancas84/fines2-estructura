<?php

require_once("class/Format.php");
require_once("class/model/Values.php");

class _Inasistencia extends EntityValues {
  protected $id = UNDEFINED;
  protected $fechaDesde = UNDEFINED;
  protected $fechaHasta = UNDEFINED;
  protected $modulosSemanales = UNDEFINED;
  protected $modulosMensuales = UNDEFINED;
  protected $articulo = UNDEFINED;
  protected $inciso = UNDEFINED;
  protected $observaciones = UNDEFINED;
  protected $toma = UNDEFINED;

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
    if($this->id !== UNDEFINED) $row["id"] = $this->id("");
    if($this->fechaDesde !== UNDEFINED) $row["fecha_desde"] = $this->fechaDesde("Y-m-d");
    if($this->fechaHasta !== UNDEFINED) $row["fecha_hasta"] = $this->fechaHasta("Y-m-d");
    if($this->modulosSemanales !== UNDEFINED) $row["modulos_semanales"] = $this->modulosSemanales("");
    if($this->modulosMensuales !== UNDEFINED) $row["modulos_mensuales"] = $this->modulosMensuales("");
    if($this->articulo !== UNDEFINED) $row["articulo"] = $this->articulo("");
    if($this->inciso !== UNDEFINED) $row["inciso"] = $this->inciso("");
    if($this->observaciones !== UNDEFINED) $row["observaciones"] = $this->observaciones("");
    if($this->toma !== UNDEFINED) $row["toma"] = $this->toma("");
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->fechaDesde)) return false;
    if(!Validation::is_empty($this->fechaHasta)) return false;
    if(!Validation::is_empty($this->modulosSemanales)) return false;
    if(!Validation::is_empty($this->modulosMensuales)) return false;
    if(!Validation::is_empty($this->articulo)) return false;
    if(!Validation::is_empty($this->inciso)) return false;
    if(!Validation::is_empty($this->observaciones)) return false;
    if(!Validation::is_empty($this->toma)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function fechaDesde($format = null) { return Format::date($this->fechaDesde, $format); }
  public function fechaHasta($format = null) { return Format::date($this->fechaHasta, $format); }
  public function modulosSemanales() { return $this->modulosSemanales; }
  public function modulosMensuales() { return $this->modulosMensuales; }
  public function articulo($format = null) { return Format::convertCase($this->articulo, $format); }
  public function inciso($format = null) { return Format::convertCase($this->inciso, $format); }
  public function observaciones($format = null) { return Format::convertCase($this->observaciones, $format); }
  public function toma() { return $this->toma; }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkId($p)) $this->id = $p;
  }

  public function _setFechaDesde(DateTime $p = null) {
      if($this->checkFechaDesde($p)) $this->fechaDesde = $p;  
  }

  public function setFechaDesde($p, $format = "Y-m-d") {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : SpanishDateTime::createFromFormat($format, $p);
    if($this->checkFechaDesde($p)) $this->fechaDesde = $p;
  }

  public function _setFechaHasta(DateTime $p = null) {
      if($this->checkFechaHasta($p)) $this->fechaHasta = $p;  
  }

  public function setFechaHasta($p, $format = "Y-m-d") {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : SpanishDateTime::createFromFormat($format, $p);
    if($this->checkFechaHasta($p)) $this->fechaHasta = $p;
  }

  public function setModulosSemanales($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    (is_null($p)) ? null : intval(trim($p));
    if($this->checkModulosSemanales($p)) $this->modulosSemanales = $p;
  }

  public function setModulosMensuales($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    (is_null($p)) ? null : intval(trim($p));
    if($this->checkModulosMensuales($p)) $this->modulosMensuales = $p;
  }

  public function setArticulo($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkArticulo($p)) $this->articulo = $p;
  }

  public function setInciso($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkInciso($p)) $this->inciso = $p;
  }

  public function setObservaciones($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkObservaciones($p)) $this->observaciones = $p;
  }

  public function setToma($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkToma($p)) $this->toma = $p;
  }

  public function checkId($value) { 
      return true; 
  }

  public function checkFechaDesde($value) { 
    $v = Validation::getInstanceValue($value)->date()->required();
    return $this->_setLogsValidation("fecha_desde", $v);
  }

  public function checkFechaHasta($value) { 
    $v = Validation::getInstanceValue($value)->date()->required();
    return $this->_setLogsValidation("fecha_hasta", $v);
  }

  public function checkModulosSemanales($value) { 
    $v = Validation::getInstanceValue($value)->integer();
    return $this->_setLogsValidation("modulos_semanales", $v);
  }

  public function checkModulosMensuales($value) { 
    $v = Validation::getInstanceValue($value)->integer();
    return $this->_setLogsValidation("modulos_mensuales", $v);
  }

  public function checkArticulo($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("articulo", $v);
  }

  public function checkInciso($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("inciso", $v);
  }

  public function checkObservaciones($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("observaciones", $v);
  }

  public function checkToma($value) { 
    $v = Validation::getInstanceValue($value)->integer()->required();
    return $this->_setLogsValidation("toma", $v);
  }



}
