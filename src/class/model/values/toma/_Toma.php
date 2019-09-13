<?php

require_once("class/model/Values.php");

class _Toma extends EntityValues {
  public $id = UNDEFINED;
  public $fechaToma = UNDEFINED;
  public $fechaInicio = UNDEFINED;
  public $fechaFin = UNDEFINED;
  public $fechaEntradaContralor = UNDEFINED;
  public $estado = UNDEFINED;
  public $observaciones = UNDEFINED;
  public $comentarioContralor = UNDEFINED;
  public $alta = UNDEFINED;
  public $tipoMovimiento = UNDEFINED;
  public $estadoContralor = UNDEFINED;
  public $fechaDesde = UNDEFINED;
  public $sumaHorasCatedra = UNDEFINED;
  public $curso = UNDEFINED;
  public $profesor = UNDEFINED;
  public $reemplaza = UNDEFINED;

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
    if($this->id !== UNDEFINED) $row["id"] = $this->id();
    if($this->fechaToma !== UNDEFINED) $row["fecha_toma"] = $this->fechaToma();
    if($this->fechaInicio !== UNDEFINED) $row["fecha_inicio"] = $this->fechaInicio();
    if($this->fechaFin !== UNDEFINED) $row["fecha_fin"] = $this->fechaFin();
    if($this->fechaEntradaContralor !== UNDEFINED) $row["fecha_entrada_contralor"] = $this->fechaEntradaContralor();
    if($this->estado !== UNDEFINED) $row["estado"] = $this->estado();
    if($this->observaciones !== UNDEFINED) $row["observaciones"] = $this->observaciones();
    if($this->comentarioContralor !== UNDEFINED) $row["comentario_contralor"] = $this->comentarioContralor();
    if($this->alta !== UNDEFINED) $row["alta"] = $this->alta();
    if($this->tipoMovimiento !== UNDEFINED) $row["tipo_movimiento"] = $this->tipoMovimiento();
    if($this->estadoContralor !== UNDEFINED) $row["estado_contralor"] = $this->estadoContralor();
    if($this->fechaDesde !== UNDEFINED) $row["fecha_desde"] = $this->fechaDesde();
    if($this->sumaHorasCatedra !== UNDEFINED) $row["suma_horas_catedra"] = $this->sumaHorasCatedra();
    if($this->curso !== UNDEFINED) $row["curso"] = $this->curso();
    if($this->profesor !== UNDEFINED) $row["profesor"] = $this->profesor();
    if($this->reemplaza !== UNDEFINED) $row["reemplaza"] = $this->reemplaza();
    return $row;
  }

  public function id() { return $this->id; }
  public function fechaToma($format = 'Y-m-d') { return $this->_formatDate($this->fechaToma, $format); }
  public function fechaInicio($format = 'Y-m-d') { return $this->_formatDate($this->fechaInicio, $format); }
  public function fechaFin($format = 'Y-m-d') { return $this->_formatDate($this->fechaFin, $format); }
  public function fechaEntradaContralor($format = 'Y-m-d') { return $this->_formatDate($this->fechaEntradaContralor, $format); }
  public function estado($format = null) { return $this->_formatString($this->estado, $format); }
  public function observaciones($format = null) { return $this->_formatString($this->observaciones, $format); }
  public function comentarioContralor($format = null) { return $this->_formatString($this->comentarioContralor, $format); }
  public function alta($format = 'Y-m-d H:i:s') { return $this->_formatDate($this->alta, $format); }
  public function tipoMovimiento($format = null) { return $this->_formatString($this->tipoMovimiento, $format); }
  public function estadoContralor($format = null) { return $this->_formatString($this->estadoContralor, $format); }
  public function fechaDesde($format = 'Y-m-d') { return $this->_formatDate($this->fechaDesde, $format); }
  public function sumaHorasCatedra() { return $this->sumaHorasCatedra; }
  public function curso() { return $this->curso; }
  public function profesor() { return $this->profesor; }
  public function reemplaza() { return $this->reemplaza; }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->id = (empty($p)) ? null : (string)$p;
  }

  public function _setFechaToma(DateTime $p = null) {
    $this->fechaToma = $p;
  }

  public function setFechaToma($p, $format = "Y-m-d") {
    $p = ($p == DEFAULT_VALUE) ? '' : trim($p);
    $p = SpanishDateTime::createFromFormat($format, $p);
    $this->fechaToma = (empty($p)) ? null : $p;
  }

  public function _setFechaInicio(DateTime $p = null) {
    $this->fechaInicio = $p;
  }

  public function setFechaInicio($p, $format = "Y-m-d") {
    $p = ($p == DEFAULT_VALUE) ? '' : trim($p);
    $p = SpanishDateTime::createFromFormat($format, $p);
    $this->fechaInicio = (empty($p)) ? null : $p;
  }

  public function _setFechaFin(DateTime $p = null) {
    $this->fechaFin = $p;
  }

  public function setFechaFin($p, $format = "Y-m-d") {
    $p = ($p == DEFAULT_VALUE) ? '' : trim($p);
    $p = SpanishDateTime::createFromFormat($format, $p);
    $this->fechaFin = (empty($p)) ? null : $p;
  }

  public function _setFechaEntradaContralor(DateTime $p = null) {
    $this->fechaEntradaContralor = $p;
  }

  public function setFechaEntradaContralor($p, $format = "Y-m-d") {
    $p = ($p == DEFAULT_VALUE) ? '' : trim($p);
    $p = SpanishDateTime::createFromFormat($format, $p);
    $this->fechaEntradaContralor = (empty($p)) ? null : $p;
  }

  public function setEstado($p) {
    $p = ($p == DEFAULT_VALUE) ? 'Pendiente' : trim($p);
    $this->estado = (empty($p)) ? null : (string)$p;
  }

  public function setObservaciones($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->observaciones = (empty($p)) ? null : (string)$p;
  }

  public function setComentarioContralor($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->comentarioContralor = (empty($p)) ? null : (string)$p;
  }

  public function _setAlta(DateTime $p = null) {
    $this->alta = $p;
  }

  public function setAlta($p, $format = "Y-m-d H:i:s") {
    $p = ($p == DEFAULT_VALUE) ? date('Y-m-d H:i:s') : trim($p);
    $p = SpanishDateTime::createFromFormat($format, $p);
    $this->alta = (empty($p)) ? null : $p;
  }

  public function setTipoMovimiento($p) {
    $p = ($p == DEFAULT_VALUE) ? 'AI' : trim($p);
    $this->tipoMovimiento = (empty($p)) ? null : (string)$p;
  }

  public function setEstadoContralor($p) {
    $p = ($p == DEFAULT_VALUE) ? 'Pasar' : trim($p);
    $this->estadoContralor = (empty($p)) ? null : (string)$p;
  }

  public function _setFechaDesde(DateTime $p = null) {
    $this->fechaDesde = $p;
  }

  public function setFechaDesde($p, $format = "Y-m-d") {
    $p = ($p == DEFAULT_VALUE) ? '' : trim($p);
    $p = SpanishDateTime::createFromFormat($format, $p);
    $this->fechaDesde = (empty($p)) ? null : $p;
  }

  public function setSumaHorasCatedra($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $this->sumaHorasCatedra = (is_null($p)) ? null : intval(trim($p));
  }

  public function setCurso($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->curso = (empty($p)) ? null : (string)$p;
  }

  public function setProfesor($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->profesor = (empty($p)) ? null : (string)$p;
  }

  public function setReemplaza($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->reemplaza = (empty($p)) ? null : (string)$p;
  }



}
