<?php

require_once("class/Format.php");
require_once("class/model/Values.php");

class _Toma extends EntityValues {
  protected $id = UNDEFINED;
  protected $fechaToma = UNDEFINED;
  protected $fechaInicio = UNDEFINED;
  protected $fechaFin = UNDEFINED;
  protected $fechaEntradaContralor = UNDEFINED;
  protected $estado = UNDEFINED;
  protected $observaciones = UNDEFINED;
  protected $comentarioContralor = UNDEFINED;
  protected $alta = UNDEFINED;
  protected $tipoMovimiento = UNDEFINED;
  protected $estadoContralor = UNDEFINED;
  protected $fechaDesde = UNDEFINED;
  protected $sumaHorasCatedra = UNDEFINED;
  protected $curso = UNDEFINED;
  protected $profesor = UNDEFINED;
  protected $reemplaza = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setFechaToma(DEFAULT_VALUE);
    $this->setFechaInicio(DEFAULT_VALUE);
    $this->setFechaFin(DEFAULT_VALUE);
    $this->setFechaEntradaContralor(DEFAULT_VALUE);
    $this->setEstado(DEFAULT_VALUE);
    $this->setObservaciones(DEFAULT_VALUE);
    $this->setComentarioContralor(DEFAULT_VALUE);
    $this->setAlta(DEFAULT_VALUE);
    $this->setTipoMovimiento(DEFAULT_VALUE);
    $this->setEstadoContralor(DEFAULT_VALUE);
    $this->setFechaDesde(DEFAULT_VALUE);
    $this->setSumaHorasCatedra(DEFAULT_VALUE);
    $this->setCurso(DEFAULT_VALUE);
    $this->setProfesor(DEFAULT_VALUE);
    $this->setReemplaza(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."fecha_toma"])) $this->setFechaToma($row[$p."fecha_toma"]);
    if(isset($row[$p."fecha_inicio"])) $this->setFechaInicio($row[$p."fecha_inicio"]);
    if(isset($row[$p."fecha_fin"])) $this->setFechaFin($row[$p."fecha_fin"]);
    if(isset($row[$p."fecha_entrada_contralor"])) $this->setFechaEntradaContralor($row[$p."fecha_entrada_contralor"]);
    if(isset($row[$p."estado"])) $this->setEstado($row[$p."estado"]);
    if(isset($row[$p."observaciones"])) $this->setObservaciones($row[$p."observaciones"]);
    if(isset($row[$p."comentario_contralor"])) $this->setComentarioContralor($row[$p."comentario_contralor"]);
    if(isset($row[$p."alta"])) $this->setAlta($row[$p."alta"]);
    if(isset($row[$p."tipo_movimiento"])) $this->setTipoMovimiento($row[$p."tipo_movimiento"]);
    if(isset($row[$p."estado_contralor"])) $this->setEstadoContralor($row[$p."estado_contralor"]);
    if(isset($row[$p."fecha_desde"])) $this->setFechaDesde($row[$p."fecha_desde"]);
    if(isset($row[$p."suma_horas_catedra"])) $this->setSumaHorasCatedra($row[$p."suma_horas_catedra"]);
    if(isset($row[$p."curso"])) $this->setCurso($row[$p."curso"]);
    if(isset($row[$p."profesor"])) $this->setProfesor($row[$p."profesor"]);
    if(isset($row[$p."reemplaza"])) $this->setReemplaza($row[$p."reemplaza"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id("");
    if($this->fechaToma !== UNDEFINED) $row["fecha_toma"] = $this->fechaToma("Y-m-d");
    if($this->fechaInicio !== UNDEFINED) $row["fecha_inicio"] = $this->fechaInicio("Y-m-d");
    if($this->fechaFin !== UNDEFINED) $row["fecha_fin"] = $this->fechaFin("Y-m-d");
    if($this->fechaEntradaContralor !== UNDEFINED) $row["fecha_entrada_contralor"] = $this->fechaEntradaContralor("Y-m-d");
    if($this->estado !== UNDEFINED) $row["estado"] = $this->estado("");
    if($this->observaciones !== UNDEFINED) $row["observaciones"] = $this->observaciones("");
    if($this->comentarioContralor !== UNDEFINED) $row["comentario_contralor"] = $this->comentarioContralor("");
    if($this->alta !== UNDEFINED) $row["alta"] = $this->alta("Y-m-d h:i:s");
    if($this->tipoMovimiento !== UNDEFINED) $row["tipo_movimiento"] = $this->tipoMovimiento("");
    if($this->estadoContralor !== UNDEFINED) $row["estado_contralor"] = $this->estadoContralor("");
    if($this->fechaDesde !== UNDEFINED) $row["fecha_desde"] = $this->fechaDesde("Y-m-d");
    if($this->sumaHorasCatedra !== UNDEFINED) $row["suma_horas_catedra"] = $this->sumaHorasCatedra("");
    if($this->curso !== UNDEFINED) $row["curso"] = $this->curso("");
    if($this->profesor !== UNDEFINED) $row["profesor"] = $this->profesor("");
    if($this->reemplaza !== UNDEFINED) $row["reemplaza"] = $this->reemplaza("");
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->fechaToma)) return false;
    if(!Validation::is_empty($this->fechaInicio)) return false;
    if(!Validation::is_empty($this->fechaFin)) return false;
    if(!Validation::is_empty($this->fechaEntradaContralor)) return false;
    if(!Validation::is_empty($this->estado)) return false;
    if(!Validation::is_empty($this->observaciones)) return false;
    if(!Validation::is_empty($this->comentarioContralor)) return false;
    if(!Validation::is_empty($this->alta)) return false;
    if(!Validation::is_empty($this->tipoMovimiento)) return false;
    if(!Validation::is_empty($this->estadoContralor)) return false;
    if(!Validation::is_empty($this->fechaDesde)) return false;
    if(!Validation::is_empty($this->sumaHorasCatedra)) return false;
    if(!Validation::is_empty($this->curso)) return false;
    if(!Validation::is_empty($this->profesor)) return false;
    if(!Validation::is_empty($this->reemplaza)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function fechaToma($format = null) { return Format::date($this->fechaToma, $format); }
  public function fechaInicio($format = null) { return Format::date($this->fechaInicio, $format); }
  public function fechaFin($format = null) { return Format::date($this->fechaFin, $format); }
  public function fechaEntradaContralor($format = null) { return Format::date($this->fechaEntradaContralor, $format); }
  public function estado($format = null) { return Format::convertCase($this->estado, $format); }
  public function observaciones($format = null) { return Format::convertCase($this->observaciones, $format); }
  public function comentarioContralor($format = null) { return Format::convertCase($this->comentarioContralor, $format); }
  public function alta($format = null) { return Format::date($this->alta, $format); }
  public function tipoMovimiento($format = null) { return Format::convertCase($this->tipoMovimiento, $format); }
  public function estadoContralor($format = null) { return Format::convertCase($this->estadoContralor, $format); }
  public function fechaDesde($format = null) { return Format::date($this->fechaDesde, $format); }
  public function sumaHorasCatedra() { return $this->sumaHorasCatedra; }
  public function curso() { return $this->curso; }
  public function profesor() { return $this->profesor; }
  public function reemplaza() { return $this->reemplaza; }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkId($p)) $this->id = $p;
  }

  public function _setFechaToma(DateTime $p = null) {
      if($this->checkFechaToma($p)) $this->fechaToma = $p;  
  }

  public function setFechaToma($p, $format = UNDEFINED) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    if(is_null($p)) $p = null;
    else {
      $p = ($format == UNDEFINED) ? SpanishDateTime::createFromDate($p) : SpanishDateTime::createFromFormat($format, $p);
    }
    if($this->checkFechaToma($p)) $this->fechaToma = $p;
  }

  public function _setFechaInicio(DateTime $p = null) {
      if($this->checkFechaInicio($p)) $this->fechaInicio = $p;  
  }

  public function setFechaInicio($p, $format = UNDEFINED) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    if(is_null($p)) $p = null;
    else {
      $p = ($format == UNDEFINED) ? SpanishDateTime::createFromDate($p) : SpanishDateTime::createFromFormat($format, $p);
    }
    if($this->checkFechaInicio($p)) $this->fechaInicio = $p;
  }

  public function _setFechaFin(DateTime $p = null) {
      if($this->checkFechaFin($p)) $this->fechaFin = $p;  
  }

  public function setFechaFin($p, $format = UNDEFINED) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    if(is_null($p)) $p = null;
    else {
      $p = ($format == UNDEFINED) ? SpanishDateTime::createFromDate($p) : SpanishDateTime::createFromFormat($format, $p);
    }
    if($this->checkFechaFin($p)) $this->fechaFin = $p;
  }

  public function _setFechaEntradaContralor(DateTime $p = null) {
      if($this->checkFechaEntradaContralor($p)) $this->fechaEntradaContralor = $p;  
  }

  public function setFechaEntradaContralor($p, $format = UNDEFINED) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    if(is_null($p)) $p = null;
    else {
      $p = ($format == UNDEFINED) ? SpanishDateTime::createFromDate($p) : SpanishDateTime::createFromFormat($format, $p);
    }
    if($this->checkFechaEntradaContralor($p)) $this->fechaEntradaContralor = $p;
  }

  public function setEstado($p) {
    $p = ($p == DEFAULT_VALUE) ? 'Pendiente' : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkEstado($p)) $this->estado = $p;
  }

  public function setObservaciones($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkObservaciones($p)) $this->observaciones = $p;
  }

  public function setComentarioContralor($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkComentarioContralor($p)) $this->comentarioContralor = $p;
  }

  public function _setAlta(DateTime $p = null) {
      if($this->checkAlta($p)) $this->alta = $p;  
  }

  public function setAlta($p, $format = "Y-m-d H:i:s") {
    $p = ($p == DEFAULT_VALUE) ? date('Y-m-d H:i:s') : trim($p);
    if(is_null($p)) $p = null;
    else $p = SpanishDateTime::createFromFormat($format, $p);
    if($this->checkAlta($p)) $this->alta = $p;
  }

  public function setTipoMovimiento($p) {
    $p = ($p == DEFAULT_VALUE) ? 'AI' : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkTipoMovimiento($p)) $this->tipoMovimiento = $p;
  }

  public function setEstadoContralor($p) {
    $p = ($p == DEFAULT_VALUE) ? 'Pasar' : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkEstadoContralor($p)) $this->estadoContralor = $p;
  }

  public function _setFechaDesde(DateTime $p = null) {
      if($this->checkFechaDesde($p)) $this->fechaDesde = $p;  
  }

  public function setFechaDesde($p, $format = UNDEFINED) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    if(is_null($p)) $p = null;
    else {
      $p = ($format == UNDEFINED) ? SpanishDateTime::createFromDate($p) : SpanishDateTime::createFromFormat($format, $p);
    }
    if($this->checkFechaDesde($p)) $this->fechaDesde = $p;
  }

  public function setSumaHorasCatedra($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    (is_null($p)) ? null : intval(trim($p));
    if($this->checkSumaHorasCatedra($p)) $this->sumaHorasCatedra = $p;
  }

  public function setCurso($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkCurso($p)) $this->curso = $p;
  }

  public function setProfesor($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkProfesor($p)) $this->profesor = $p;
  }

  public function setReemplaza($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkReemplaza($p)) $this->reemplaza = $p;
  }

  public function checkId($value) { 
      return true; 
  }

  public function checkFechaToma($value) { 
    $v = Validation::getInstanceValue($value)->date();
    return $this->_setLogsValidation("fecha_toma", $v);
  }

  public function checkFechaInicio($value) { 
    $v = Validation::getInstanceValue($value)->date();
    return $this->_setLogsValidation("fecha_inicio", $v);
  }

  public function checkFechaFin($value) { 
    $v = Validation::getInstanceValue($value)->date();
    return $this->_setLogsValidation("fecha_fin", $v);
  }

  public function checkFechaEntradaContralor($value) { 
    $v = Validation::getInstanceValue($value)->date();
    return $this->_setLogsValidation("fecha_entrada_contralor", $v);
  }

  public function checkEstado($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("estado", $v);
  }

  public function checkObservaciones($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("observaciones", $v);
  }

  public function checkComentarioContralor($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("comentario_contralor", $v);
  }

  public function checkAlta($value) { 
    $v = Validation::getInstanceValue($value)->date()->required();
    return $this->_setLogsValidation("alta", $v);
  }

  public function checkTipoMovimiento($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("tipo_movimiento", $v);
  }

  public function checkEstadoContralor($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("estado_contralor", $v);
  }

  public function checkFechaDesde($value) { 
    $v = Validation::getInstanceValue($value)->date();
    return $this->_setLogsValidation("fecha_desde", $v);
  }

  public function checkSumaHorasCatedra($value) { 
    $v = Validation::getInstanceValue($value)->integer();
    return $this->_setLogsValidation("suma_horas_catedra", $v);
  }

  public function checkCurso($value) { 
    $v = Validation::getInstanceValue($value)->integer()->required();
    return $this->_setLogsValidation("curso", $v);
  }

  public function checkProfesor($value) { 
    $v = Validation::getInstanceValue($value)->integer();
    return $this->_setLogsValidation("profesor", $v);
  }

  public function checkReemplaza($value) { 
    $v = Validation::getInstanceValue($value)->integer();
    return $this->_setLogsValidation("reemplaza", $v);
  }



}
