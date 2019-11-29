<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _Comision extends EntityValues {
  protected $id = UNDEFINED;
  protected $anio = UNDEFINED;
  protected $semestre = UNDEFINED;
  protected $observaciones = UNDEFINED;
  protected $fecha = UNDEFINED;
  protected $alta = UNDEFINED;
  protected $baja = UNDEFINED;
  protected $comentario = UNDEFINED;
  protected $autorizada = UNDEFINED;
  protected $apertura = UNDEFINED;
  protected $publicar = UNDEFINED;
  protected $fechaAnio = UNDEFINED;
  protected $fechaSemestre = UNDEFINED;
  protected $tramo = UNDEFINED;
  protected $horario = UNDEFINED;
  protected $periodo = UNDEFINED;
  protected $comisionSiguiente = UNDEFINED;
  protected $division = UNDEFINED;

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
    if($this->id !== UNDEFINED) $row["id"] = $this->id("");
    if($this->anio !== UNDEFINED) $row["anio"] = $this->anio("");
    if($this->semestre !== UNDEFINED) $row["semestre"] = $this->semestre("");
    if($this->observaciones !== UNDEFINED) $row["observaciones"] = $this->observaciones("");
    if($this->fecha !== UNDEFINED) $row["fecha"] = $this->fecha("Y-m-d");
    if($this->alta !== UNDEFINED) $row["alta"] = $this->alta("Y-m-d h:i:s");
    if($this->baja !== UNDEFINED) $row["baja"] = $this->baja("Y-m-d h:i:s");
    if($this->comentario !== UNDEFINED) $row["comentario"] = $this->comentario("");
    if($this->autorizada !== UNDEFINED) $row["autorizada"] = $this->autorizada("");
    if($this->apertura !== UNDEFINED) $row["apertura"] = $this->apertura("");
    if($this->publicar !== UNDEFINED) $row["publicar"] = $this->publicar("");
    if($this->fechaAnio !== UNDEFINED) $row["fecha_anio"] = $this->fechaAnio("Y");
    if($this->fechaSemestre !== UNDEFINED) $row["fecha_semestre"] = $this->fechaSemestre("");
    if($this->tramo !== UNDEFINED) $row["tramo"] = $this->tramo("");
    if($this->horario !== UNDEFINED) $row["horario"] = $this->horario("");
    if($this->periodo !== UNDEFINED) $row["periodo"] = $this->periodo("");
    if($this->comisionSiguiente !== UNDEFINED) $row["comision_siguiente"] = $this->comisionSiguiente("");
    if($this->division !== UNDEFINED) $row["division"] = $this->division("");
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->anio)) return false;
    if(!Validation::is_empty($this->semestre)) return false;
    if(!Validation::is_empty($this->observaciones)) return false;
    if(!Validation::is_empty($this->fecha)) return false;
    if(!Validation::is_empty($this->alta)) return false;
    if(!Validation::is_empty($this->baja)) return false;
    if(!Validation::is_empty($this->comentario)) return false;
    if(!Validation::is_empty($this->autorizada)) return false;
    if(!Validation::is_empty($this->apertura)) return false;
    if(!Validation::is_empty($this->publicar)) return false;
    if(!Validation::is_empty($this->fechaAnio)) return false;
    if(!Validation::is_empty($this->fechaSemestre)) return false;
    if(!Validation::is_empty($this->tramo)) return false;
    if(!Validation::is_empty($this->horario)) return false;
    if(!Validation::is_empty($this->periodo)) return false;
    if(!Validation::is_empty($this->comisionSiguiente)) return false;
    if(!Validation::is_empty($this->division)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function anio() { return $this->anio; }
  public function semestre() { return $this->semestre; }
  public function observaciones($format = null) { return Format::convertCase($this->observaciones, $format); }
  public function fecha($format = null) { return Format::date($this->fecha, $format); }
  public function alta($format = null) { return Format::date($this->alta, $format); }
  public function baja($format = null) { return Format::date($this->baja, $format); }
  public function comentario($format = null) { return Format::convertCase($this->comentario, $format); }
  public function autorizada($format = null) { return Format::boolean($this->autorizada, $format); }
  public function apertura($format = null) { return Format::boolean($this->apertura, $format); }
  public function publicar($format = null) { return Format::boolean($this->publicar, $format); }
  public function fechaAnio($format = null) { return Format::date($this->fechaAnio, $format); }
  public function fechaSemestre() { return $this->fechaSemestre; }
  public function tramo($format = null) { return Format::convertCase($this->tramo, $format); }
  public function horario($format = null) { return Format::convertCase($this->horario, $format); }
  public function periodo($format = null) { return Format::convertCase($this->periodo, $format); }
  public function comisionSiguiente() { return $this->comisionSiguiente; }
  public function division() { return $this->division; }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkId($p)) $this->id = $p;
  }

  public function setAnio($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $p = (is_null($p)) ? null : intval(trim($p));
    if($this->checkAnio($p)) $this->anio = $p;
  }

  public function setSemestre($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $p = (is_null($p)) ? null : intval(trim($p));
    if($this->checkSemestre($p)) $this->semestre = $p;
  }

  public function setObservaciones($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkObservaciones($p)) $this->observaciones = $p;
  }

  public function _setFecha(DateTime $p = null) {
      if($this->checkFecha($p)) $this->fecha = $p;  
  }

  public function setFecha($p, $format = UNDEFINED) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    if(!is_null($p)) {
      $p = ($format == UNDEFINED) ? SpanishDateTime::createFromDate($p) : SpanishDateTime::createFromFormat($format, $p);
    }
    if($this->checkFecha($p)) $this->fecha = $p;
  }

  public function _setAlta(DateTime $p = null) {
      if($this->checkAlta($p)) $this->alta = $p;  
  }

  public function setAlta($p, $format = "Y-m-d H:i:s") {
    $p = ($p == DEFAULT_VALUE) ? date('Y-m-d H:i:s') : trim($p);
    if(!is_null($p)) {
      $p = SpanishDateTime::createFromFormat($format, $p);
    }
    if($this->checkAlta($p)) $this->alta = $p;
  }

  public function _setBaja(DateTime $p = null) {
      if($this->checkBaja($p)) $this->baja = $p;  
  }

  public function setBaja($p, $format = "Y-m-d H:i:s") {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    if(!is_null($p)) {
      $p = SpanishDateTime::createFromFormat($format, $p);
    }
    if($this->checkBaja($p)) $this->baja = $p;
  }

  public function setComentario($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkComentario($p)) $this->comentario = $p;
  }

  public function setAutorizada($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $p = (is_null($p)) ? null : settypebool(trim($p));
    if($this->checkAutorizada($p)) $this->autorizada = $p;
  }

  public function setApertura($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $p = (is_null($p)) ? null : settypebool(trim($p));
    if($this->checkApertura($p)) $this->apertura = $p;
  }

  public function setPublicar($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $p = (is_null($p)) ? null : settypebool(trim($p));
    if($this->checkPublicar($p)) $this->publicar = $p;
  }

  public function _setFechaAnio(DateTime $p = null) {
      if($this->checkFechaAnio($p)) $this->fechaAnio = $p;  
  }

  public function setFechaAnio($p, $format = "Y") {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    if(!is_null($p)) {
      $p = SpanishDateTime::createFromFormat($format, $p);
    }
    if($this->checkFechaAnio($p)) $this->fechaAnio = $p;
  }

  public function setFechaSemestre($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $p = (is_null($p)) ? null : intval(trim($p));
    if($this->checkFechaSemestre($p)) $this->fechaSemestre = $p;
  }

  public function setTramo($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkTramo($p)) $this->tramo = $p;
  }

  public function setHorario($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkHorario($p)) $this->horario = $p;
  }

  public function setPeriodo($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkPeriodo($p)) $this->periodo = $p;
  }

  public function setComisionSiguiente($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $p = (is_null($p)) ? null : intval(trim($p));
    if($this->checkComisionSiguiente($p)) $this->comisionSiguiente = $p;
  }

  public function setDivision($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $p = (is_null($p)) ? null : intval(trim($p));
    if($this->checkDivision($p)) $this->division = $p;
  }

  public function checkId($value) { 
      return true; 
  }

  public function checkAnio($value) { 
    $v = Validation::getInstanceValue($value)->integer()->required();
    return $this->_setLogsValidation("anio", $v);
  }

  public function checkSemestre($value) { 
    $v = Validation::getInstanceValue($value)->integer()->required();
    return $this->_setLogsValidation("semestre", $v);
  }

  public function checkObservaciones($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("observaciones", $v);
  }

  public function checkFecha($value) { 
    $v = Validation::getInstanceValue($value)->date();
    return $this->_setLogsValidation("fecha", $v);
  }

  public function checkAlta($value) { 
    $v = Validation::getInstanceValue($value)->date()->required();
    return $this->_setLogsValidation("alta", $v);
  }

  public function checkBaja($value) { 
    $v = Validation::getInstanceValue($value)->date();
    return $this->_setLogsValidation("baja", $v);
  }

  public function checkComentario($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("comentario", $v);
  }

  public function checkAutorizada($value) { 
    $v = Validation::getInstanceValue($value)->boolean()->required();
    return $this->_setLogsValidation("autorizada", $v);
  }

  public function checkApertura($value) { 
    $v = Validation::getInstanceValue($value)->boolean()->required();
    return $this->_setLogsValidation("apertura", $v);
  }

  public function checkPublicar($value) { 
    $v = Validation::getInstanceValue($value)->boolean()->required();
    return $this->_setLogsValidation("publicar", $v);
  }

  public function checkFechaAnio($value) { 
    $v = Validation::getInstanceValue($value)->date()->required();
    return $this->_setLogsValidation("fecha_anio", $v);
  }

  public function checkFechaSemestre($value) { 
    $v = Validation::getInstanceValue($value)->integer()->required();
    return $this->_setLogsValidation("fecha_semestre", $v);
  }

  public function checkTramo($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("tramo", $v);
  }

  public function checkHorario($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("horario", $v);
  }

  public function checkPeriodo($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("periodo", $v);
  }

  public function checkComisionSiguiente($value) { 
    $v = Validation::getInstanceValue($value)->integer();
    return $this->_setLogsValidation("comision_siguiente", $v);
  }

  public function checkDivision($value) { 
    $v = Validation::getInstanceValue($value)->integer()->required();
    return $this->_setLogsValidation("division", $v);
  }



}
