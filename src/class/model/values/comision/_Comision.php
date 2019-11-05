<?php

require_once("class/model/Values.php");

class _Comision extends EntityValues {
  public $id = UNDEFINED;
  public $anio = UNDEFINED;
  public $semestre = UNDEFINED;
  public $observaciones = UNDEFINED;
  public $fecha = UNDEFINED;
  public $alta = UNDEFINED;
  public $baja = UNDEFINED;
  public $comentario = UNDEFINED;
  public $autorizada = UNDEFINED;
  public $apertura = UNDEFINED;
  public $publicar = UNDEFINED;
  public $fechaAnio = UNDEFINED;
  public $fechaSemestre = UNDEFINED;
  public $tramo = UNDEFINED;
  public $horario = UNDEFINED;
  public $periodo = UNDEFINED;
  public $comisionSiguiente = UNDEFINED;
  public $division = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setAnio(DEFAULT_VALUE);
    $this->setSemestre(DEFAULT_VALUE);
    $this->setObservaciones(DEFAULT_VALUE);
    $this->setFecha(DEFAULT_VALUE);
    $this->setAlta(DEFAULT_VALUE);
    $this->setBaja(DEFAULT_VALUE);
    $this->setComentario(DEFAULT_VALUE);
    $this->setAutorizada(DEFAULT_VALUE);
    $this->setApertura(DEFAULT_VALUE);
    $this->setPublicar(DEFAULT_VALUE);
    $this->setFechaAnio(DEFAULT_VALUE);
    $this->setFechaSemestre(DEFAULT_VALUE);
    $this->setTramo(DEFAULT_VALUE);
    $this->setHorario(DEFAULT_VALUE);
    $this->setPeriodo(DEFAULT_VALUE);
    $this->setComisionSiguiente(DEFAULT_VALUE);
    $this->setDivision(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."anio"])) $this->setAnio($row[$p."anio"]);
    if(isset($row[$p."semestre"])) $this->setSemestre($row[$p."semestre"]);
    if(isset($row[$p."observaciones"])) $this->setObservaciones($row[$p."observaciones"]);
    if(isset($row[$p."fecha"])) $this->setFecha($row[$p."fecha"]);
    if(isset($row[$p."alta"])) $this->setAlta($row[$p."alta"]);
    if(isset($row[$p."baja"])) $this->setBaja($row[$p."baja"]);
    if(isset($row[$p."comentario"])) $this->setComentario($row[$p."comentario"]);
    if(isset($row[$p."autorizada"])) $this->setAutorizada($row[$p."autorizada"]);
    if(isset($row[$p."apertura"])) $this->setApertura($row[$p."apertura"]);
    if(isset($row[$p."publicar"])) $this->setPublicar($row[$p."publicar"]);
    if(isset($row[$p."fecha_anio"])) $this->setFechaAnio($row[$p."fecha_anio"]);
    if(isset($row[$p."fecha_semestre"])) $this->setFechaSemestre($row[$p."fecha_semestre"]);
    if(isset($row[$p."tramo"])) $this->setTramo($row[$p."tramo"]);
    if(isset($row[$p."horario"])) $this->setHorario($row[$p."horario"]);
    if(isset($row[$p."periodo"])) $this->setPeriodo($row[$p."periodo"]);
    if(isset($row[$p."comision_siguiente"])) $this->setComisionSiguiente($row[$p."comision_siguiente"]);
    if(isset($row[$p."division"])) $this->setDivision($row[$p."division"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id();
    if($this->anio !== UNDEFINED) $row["anio"] = $this->anio();
    if($this->semestre !== UNDEFINED) $row["semestre"] = $this->semestre();
    if($this->observaciones !== UNDEFINED) $row["observaciones"] = $this->observaciones();
    if($this->fecha !== UNDEFINED) $row["fecha"] = $this->fecha();
    if($this->alta !== UNDEFINED) $row["alta"] = $this->alta();
    if($this->baja !== UNDEFINED) $row["baja"] = $this->baja();
    if($this->comentario !== UNDEFINED) $row["comentario"] = $this->comentario();
    if($this->autorizada !== UNDEFINED) $row["autorizada"] = $this->autorizada();
    if($this->apertura !== UNDEFINED) $row["apertura"] = $this->apertura();
    if($this->publicar !== UNDEFINED) $row["publicar"] = $this->publicar();
    if($this->fechaAnio !== UNDEFINED) $row["fecha_anio"] = $this->fechaAnio();
    if($this->fechaSemestre !== UNDEFINED) $row["fecha_semestre"] = $this->fechaSemestre();
    if($this->tramo !== UNDEFINED) $row["tramo"] = $this->tramo();
    if($this->horario !== UNDEFINED) $row["horario"] = $this->horario();
    if($this->periodo !== UNDEFINED) $row["periodo"] = $this->periodo();
    if($this->comisionSiguiente !== UNDEFINED) $row["comision_siguiente"] = $this->comisionSiguiente();
    if($this->division !== UNDEFINED) $row["division"] = $this->division();
    return $row;
  }

  public function id() { return $this->id; }
  public function anio() { return $this->anio; }
  public function semestre() { return $this->semestre; }
  public function observaciones($format = null) { return $this->_formatString($this->observaciones, $format); }
  public function fecha($format = 'Y-m-d') { return $this->_formatDate($this->fecha, $format); }
  public function alta($format = 'Y-m-d H:i:s') { return $this->_formatDate($this->alta, $format); }
  public function baja($format = 'Y-m-d H:i:s') { return $this->_formatDate($this->baja, $format); }
  public function comentario($format = null) { return $this->_formatString($this->comentario, $format); }
  public function autorizada($format = null) { return $this->_formatBoolean($this->autorizada, $format); }
  public function apertura($format = null) { return $this->_formatBoolean($this->apertura, $format); }
  public function publicar($format = null) { return $this->_formatBoolean($this->publicar, $format); }
  public function fechaAnio($format = 'Y') { return $this->_formatDate($this->fechaAnio, $format); }
  public function fechaSemestre() { return $this->fechaSemestre; }
  public function tramo($format = null) { return $this->_formatString($this->tramo, $format); }
  public function horario($format = null) { return $this->_formatString($this->horario, $format); }
  public function periodo($format = null) { return $this->_formatString($this->periodo, $format); }
  public function comisionSiguiente() { return $this->comisionSiguiente; }
  public function division() { return $this->division; }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->id = (empty($p)) ? null : (string)$p;
  }

  public function setAnio($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $this->anio = (is_null($p)) ? null : intval(trim($p));
  }

  public function setSemestre($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $this->semestre = (is_null($p)) ? null : intval(trim($p));
  }

  public function setObservaciones($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->observaciones = (empty($p)) ? null : (string)$p;
  }

  public function _setFecha(DateTime $p = null) {
    $this->fecha = $p;
  }

  public function setFecha($p, $format = "Y-m-d") {
    $p = ($p == DEFAULT_VALUE) ? '' : trim($p);
    $p = SpanishDateTime::createFromFormat($format, $p);
    $this->fecha = (empty($p)) ? null : $p;
  }

  public function _setAlta(DateTime $p = null) {
    $this->alta = $p;
  }

  public function setAlta($p, $format = "Y-m-d H:i:s") {
    $p = ($p == DEFAULT_VALUE) ? date('Y-m-d H:i:s') : trim($p);
    $p = SpanishDateTime::createFromFormat($format, $p);
    $this->alta = (empty($p)) ? null : $p;
  }

  public function _setBaja(DateTime $p = null) {
    $this->baja = $p;
  }

  public function setBaja($p, $format = "Y-m-d H:i:s") {
    $p = ($p == DEFAULT_VALUE) ? '' : trim($p);
    $p = SpanishDateTime::createFromFormat($format, $p);
    $this->baja = (empty($p)) ? null : $p;
  }

  public function setComentario($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->comentario = (empty($p)) ? null : (string)$p;
  }

  public function setAutorizada($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $this->autorizada = (is_null($p)) ? null : settypebool(trim($p));
  }

  public function setApertura($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $this->apertura = (is_null($p)) ? null : settypebool(trim($p));
  }

  public function setPublicar($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $this->publicar = (is_null($p)) ? null : settypebool(trim($p));
  }

  public function _setFechaAnio(DateTime $p = null) {
    $this->fechaAnio = $p;
  }

  public function setFechaAnio($p, $format = "Y") {
    $p = ($p == DEFAULT_VALUE) ? '' : trim($p);
    $p = SpanishDateTime::createFromFormat($format, $p);
    $this->fechaAnio = (empty($p)) ? null : $p;
  }

  public function setFechaSemestre($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $this->fechaSemestre = (is_null($p)) ? null : intval(trim($p));
  }

  public function setTramo($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->tramo = (empty($p)) ? null : (string)$p;
  }

  public function setHorario($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->horario = (empty($p)) ? null : (string)$p;
  }

  public function setPeriodo($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->periodo = (empty($p)) ? null : (string)$p;
  }

  public function setComisionSiguiente($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->comisionSiguiente = (empty($p)) ? null : (string)$p;
  }

  public function setDivision($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->division = (empty($p)) ? null : (string)$p;
  }



}
