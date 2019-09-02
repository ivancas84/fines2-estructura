<?php

require_once("class/model/Values.php");

//Implementacion principal de Values para una entidad especifica
class TomaValuesMain extends EntityValues {
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

  public function setDefault(){
    $this->id = null;
    $this->fechaToma = null;
    $this->fechaInicio = null;
    $this->fechaFin = null;
    $this->fechaEntradaContralor = null;
    $this->estado = "Pendiente";
    $this->observaciones = null;
    $this->comentarioContralor = null;
    $this->alta = new DateTime();
    $this->tipoMovimiento = "AI";
    $this->estadoContralor = "Pasar";
    $this->fechaDesde = null;
    $this->sumaHorasCatedra = null;
    $this->curso = null;
    $this->profesor = null;
    $this->reemplaza = null;
  }

  public function fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."fecha_toma"])) $this->setFechaTomaStr($row[$p."fecha_toma"]);
    if(isset($row[$p."fecha_inicio"])) $this->setFechaInicioStr($row[$p."fecha_inicio"]);
    if(isset($row[$p."fecha_fin"])) $this->setFechaFinStr($row[$p."fecha_fin"]);
    if(isset($row[$p."fecha_entrada_contralor"])) $this->setFechaEntradaContralorStr($row[$p."fecha_entrada_contralor"]);
    if(isset($row[$p."estado"])) $this->setEstado($row[$p."estado"]);
    if(isset($row[$p."observaciones"])) $this->setObservaciones($row[$p."observaciones"]);
    if(isset($row[$p."comentario_contralor"])) $this->setComentarioContralor($row[$p."comentario_contralor"]);
    if(isset($row[$p."alta"])) $this->setAltaStr($row[$p."alta"]);
    if(isset($row[$p."tipo_movimiento"])) $this->setTipoMovimiento($row[$p."tipo_movimiento"]);
    if(isset($row[$p."estado_contralor"])) $this->setEstadoContralor($row[$p."estado_contralor"]);
    if(isset($row[$p."fecha_desde"])) $this->setFechaDesdeStr($row[$p."fecha_desde"]);
    if(isset($row[$p."suma_horas_catedra"])) $this->setSumaHorasCatedra($row[$p."suma_horas_catedra"]);
    if(isset($row[$p."curso"])) $this->setCurso($row[$p."curso"]);
    if(isset($row[$p."profesor"])) $this->setProfesor($row[$p."profesor"]);
    if(isset($row[$p."reemplaza"])) $this->setReemplaza($row[$p."reemplaza"]);
  }

  public function toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id;
    if($this->fechaToma !== UNDEFINED) {
        if(empty($this->fechaToma)) $row["fecha_toma"] = $this->fechaToma;
        else $row["fecha_toma"] = $this->fechaToma->format('Y-m-d');
      }
    if($this->fechaInicio !== UNDEFINED) {
        if(empty($this->fechaInicio)) $row["fecha_inicio"] = $this->fechaInicio;
        else $row["fecha_inicio"] = $this->fechaInicio->format('Y-m-d');
      }
    if($this->fechaFin !== UNDEFINED) {
        if(empty($this->fechaFin)) $row["fecha_fin"] = $this->fechaFin;
        else $row["fecha_fin"] = $this->fechaFin->format('Y-m-d');
      }
    if($this->fechaEntradaContralor !== UNDEFINED) {
        if(empty($this->fechaEntradaContralor)) $row["fecha_entrada_contralor"] = $this->fechaEntradaContralor;
        else $row["fecha_entrada_contralor"] = $this->fechaEntradaContralor->format('Y-m-d');
      }
    if($this->estado !== UNDEFINED) $row["estado"] = $this->estado;
    if($this->observaciones !== UNDEFINED) $row["observaciones"] = $this->observaciones;
    if($this->comentarioContralor !== UNDEFINED) $row["comentario_contralor"] = $this->comentarioContralor;
    if($this->alta !== UNDEFINED) {
        if(empty($this->alta)) $row["alta"] = $this->alta;
        else $row["alta"] = $this->alta->format('Y-m-d H:i:s');
      }
    if($this->tipoMovimiento !== UNDEFINED) $row["tipo_movimiento"] = $this->tipoMovimiento;
    if($this->estadoContralor !== UNDEFINED) $row["estado_contralor"] = $this->estadoContralor;
    if($this->fechaDesde !== UNDEFINED) {
        if(empty($this->fechaDesde)) $row["fecha_desde"] = $this->fechaDesde;
        else $row["fecha_desde"] = $this->fechaDesde->format('Y-m-d');
      }
    if($this->sumaHorasCatedra !== UNDEFINED) $row["suma_horas_catedra"] = $this->sumaHorasCatedra;
    if($this->curso !== UNDEFINED) $row["curso"] = $this->curso;
    if($this->profesor !== UNDEFINED) $row["profesor"] = $this->profesor;
    if($this->reemplaza !== UNDEFINED) $row["reemplaza"] = $this->reemplaza;
    return $row;
  }

  public function id() { return $this->id; }
  public function fechaToma($format = 'd/m/Y') { return $this->formatDate($this->fechaToma, $format); }
  public function fechaInicio($format = 'd/m/Y') { return $this->formatDate($this->fechaInicio, $format); }
  public function fechaFin($format = 'd/m/Y') { return $this->formatDate($this->fechaFin, $format); }
  public function fechaEntradaContralor($format = 'd/m/Y') { return $this->formatDate($this->fechaEntradaContralor, $format); }
  public function estado($format = null) { return $this->formatString($this->estado, $format); }
  public function observaciones($format = null) { return $this->formatString($this->observaciones, $format); }
  public function comentarioContralor($format = null) { return $this->formatString($this->comentarioContralor, $format); }
  public function alta($format = 'd/m/Y H:i:s') { return $this->formatDate($this->alta, $format); }
  public function tipoMovimiento($format = null) { return $this->formatString($this->tipoMovimiento, $format); }
  public function estadoContralor($format = null) { return $this->formatString($this->estadoContralor, $format); }
  public function fechaDesde($format = 'd/m/Y') { return $this->formatDate($this->fechaDesde, $format); }
  public function sumaHorasCatedra() { return $this->sumaHorasCatedra; }
  public function curso() { return $this->curso; }
  public function profesor() { return $this->profesor; }
  public function reemplaza() { return $this->reemplaza; }
  public function setId($p) {
    $p = trim($p);
    $this->id = (empty($p)) ? null : (string)$p;
  }

  public function setFechaToma(DateTime $p = null) {
    $this->fechaToma = $p;
  }

  public function setFechaTomaStr($p, $format = "Y-m-d") {
    $p = SpanishDateTime::createFromFormat($format, trim($p));
    $this->fechaToma = (empty($p)) ? null : $p;
  }

  public function setFechaInicio(DateTime $p = null) {
    $this->fechaInicio = $p;
  }

  public function setFechaInicioStr($p, $format = "Y-m-d") {
    $p = SpanishDateTime::createFromFormat($format, trim($p));
    $this->fechaInicio = (empty($p)) ? null : $p;
  }

  public function setFechaFin(DateTime $p = null) {
    $this->fechaFin = $p;
  }

  public function setFechaFinStr($p, $format = "Y-m-d") {
    $p = SpanishDateTime::createFromFormat($format, trim($p));
    $this->fechaFin = (empty($p)) ? null : $p;
  }

  public function setFechaEntradaContralor(DateTime $p = null) {
    $this->fechaEntradaContralor = $p;
  }

  public function setFechaEntradaContralorStr($p, $format = "Y-m-d") {
    $p = SpanishDateTime::createFromFormat($format, trim($p));
    $this->fechaEntradaContralor = (empty($p)) ? null : $p;
  }

  public function setEstado($p) {
    $p = trim($p);
    $this->estado = (empty($p)) ? null : (string)$p;
  }

  public function setObservaciones($p) {
    $p = trim($p);
    $this->observaciones = (empty($p)) ? null : (string)$p;
  }

  public function setComentarioContralor($p) {
    $p = trim($p);
    $this->comentarioContralor = (empty($p)) ? null : (string)$p;
  }

  public function setAlta(DateTime $p = null) {
    $this->alta = $p;
  }

  public function setAltaStr($p, $format = "Y-m-d H:i:s") {
    $p = SpanishDateTime::createFromFormat($format, trim($p));
    $this->alta = (empty($p)) ? null : $p;
  }

  public function setTipoMovimiento($p) {
    $p = trim($p);
    $this->tipoMovimiento = (empty($p)) ? null : (string)$p;
  }

  public function setEstadoContralor($p) {
    $p = trim($p);
    $this->estadoContralor = (empty($p)) ? null : (string)$p;
  }

  public function setFechaDesde(DateTime $p = null) {
    $this->fechaDesde = $p;
  }

  public function setFechaDesdeStr($p, $format = "Y-m-d") {
    $p = SpanishDateTime::createFromFormat($format, trim($p));
    $this->fechaDesde = (empty($p)) ? null : $p;
  }

  public function setSumaHorasCatedra($p) {
    $p = trim($p);
    $this->sumaHorasCatedra = (is_null($p) && $p !== 0) ? null : intval($p);
  }
  public function setCurso($p) {
    $p = trim($p);
    $this->curso = (empty($p)) ? null : (string)$p;
  }

  public function setProfesor($p) {
    $p = trim($p);
    $this->profesor = (empty($p)) ? null : (string)$p;
  }

  public function setReemplaza($p) {
    $p = trim($p);
    $this->reemplaza = (empty($p)) ? null : (string)$p;
  }



}
