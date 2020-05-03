<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _Toma extends EntityValues {
  protected $id = UNDEFINED;
  protected $fechaToma = UNDEFINED;
  protected $fechaInicio = UNDEFINED;
  protected $fechaFin = UNDEFINED;
  protected $fechaContralor = UNDEFINED;
  protected $fechaConsejo = UNDEFINED;
  protected $estado = UNDEFINED;
  protected $observaciones = UNDEFINED;
  protected $comentario = UNDEFINED;
  protected $tipoMovimiento = UNDEFINED;
  protected $estadoContralor = UNDEFINED;
  protected $alta = UNDEFINED;
  protected $curso = UNDEFINED;
  protected $docente = UNDEFINED;
  protected $reemplazo = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setFechaToma(DEFAULT_VALUE);
    $this->setFechaInicio(DEFAULT_VALUE);
    $this->setFechaFin(DEFAULT_VALUE);
    $this->setFechaContralor(DEFAULT_VALUE);
    $this->setFechaConsejo(DEFAULT_VALUE);
    $this->setEstado(DEFAULT_VALUE);
    $this->setObservaciones(DEFAULT_VALUE);
    $this->setComentario(DEFAULT_VALUE);
    $this->setTipoMovimiento(DEFAULT_VALUE);
    $this->setEstadoContralor(DEFAULT_VALUE);
    $this->setAlta(DEFAULT_VALUE);
    $this->setCurso(DEFAULT_VALUE);
    $this->setDocente(DEFAULT_VALUE);
    $this->setReemplazo(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."fecha_toma"])) $this->setFechaToma($row[$p."fecha_toma"]);
    if(isset($row[$p."fecha_inicio"])) $this->setFechaInicio($row[$p."fecha_inicio"]);
    if(isset($row[$p."fecha_fin"])) $this->setFechaFin($row[$p."fecha_fin"]);
    if(isset($row[$p."fecha_contralor"])) $this->setFechaContralor($row[$p."fecha_contralor"]);
    if(isset($row[$p."fecha_consejo"])) $this->setFechaConsejo($row[$p."fecha_consejo"]);
    if(isset($row[$p."estado"])) $this->setEstado($row[$p."estado"]);
    if(isset($row[$p."observaciones"])) $this->setObservaciones($row[$p."observaciones"]);
    if(isset($row[$p."comentario"])) $this->setComentario($row[$p."comentario"]);
    if(isset($row[$p."tipo_movimiento"])) $this->setTipoMovimiento($row[$p."tipo_movimiento"]);
    if(isset($row[$p."estado_contralor"])) $this->setEstadoContralor($row[$p."estado_contralor"]);
    if(isset($row[$p."alta"])) $this->setAlta($row[$p."alta"]);
    if(isset($row[$p."curso"])) $this->setCurso($row[$p."curso"]);
    if(isset($row[$p."docente"])) $this->setDocente($row[$p."docente"]);
    if(isset($row[$p."reemplazo"])) $this->setReemplazo($row[$p."reemplazo"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id();
    if($this->fechaToma !== UNDEFINED) $row["fecha_toma"] = $this->fechaToma("Y-m-d");
    if($this->fechaInicio !== UNDEFINED) $row["fecha_inicio"] = $this->fechaInicio("Y-m-d");
    if($this->fechaFin !== UNDEFINED) $row["fecha_fin"] = $this->fechaFin("Y-m-d");
    if($this->fechaContralor !== UNDEFINED) $row["fecha_contralor"] = $this->fechaContralor("Y-m-d");
    if($this->fechaConsejo !== UNDEFINED) $row["fecha_consejo"] = $this->fechaConsejo("Y-m-d");
    if($this->estado !== UNDEFINED) $row["estado"] = $this->estado();
    if($this->observaciones !== UNDEFINED) $row["observaciones"] = $this->observaciones();
    if($this->comentario !== UNDEFINED) $row["comentario"] = $this->comentario();
    if($this->tipoMovimiento !== UNDEFINED) $row["tipo_movimiento"] = $this->tipoMovimiento();
    if($this->estadoContralor !== UNDEFINED) $row["estado_contralor"] = $this->estadoContralor();
    if($this->alta !== UNDEFINED) $row["alta"] = $this->alta("Y-m-d H:i:s");
    if($this->curso !== UNDEFINED) $row["curso"] = $this->curso();
    if($this->docente !== UNDEFINED) $row["docente"] = $this->docente();
    if($this->reemplazo !== UNDEFINED) $row["reemplazo"] = $this->reemplazo();
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->fechaToma)) return false;
    if(!Validation::is_empty($this->fechaInicio)) return false;
    if(!Validation::is_empty($this->fechaFin)) return false;
    if(!Validation::is_empty($this->fechaContralor)) return false;
    if(!Validation::is_empty($this->fechaConsejo)) return false;
    if(!Validation::is_empty($this->estado)) return false;
    if(!Validation::is_empty($this->observaciones)) return false;
    if(!Validation::is_empty($this->comentario)) return false;
    if(!Validation::is_empty($this->tipoMovimiento)) return false;
    if(!Validation::is_empty($this->estadoContralor)) return false;
    if(!Validation::is_empty($this->alta)) return false;
    if(!Validation::is_empty($this->curso)) return false;
    if(!Validation::is_empty($this->docente)) return false;
    if(!Validation::is_empty($this->reemplazo)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function fechaToma($format = null) { return Format::date($this->fechaToma, $format); }
  public function fechaInicio($format = null) { return Format::date($this->fechaInicio, $format); }
  public function fechaFin($format = null) { return Format::date($this->fechaFin, $format); }
  public function fechaContralor($format = null) { return Format::date($this->fechaContralor, $format); }
  public function fechaConsejo($format = null) { return Format::date($this->fechaConsejo, $format); }
  public function estado($format = null) { return Format::convertCase($this->estado, $format); }
  public function observaciones($format = null) { return Format::convertCase($this->observaciones, $format); }
  public function comentario($format = null) { return Format::convertCase($this->comentario, $format); }
  public function tipoMovimiento($format = null) { return Format::convertCase($this->tipoMovimiento, $format); }
  public function estadoContralor($format = null) { return Format::convertCase($this->estadoContralor, $format); }
  public function alta($format = null) { return Format::date($this->alta, $format); }
  public function curso($format = null) { return Format::convertCase($this->curso, $format); }
  public function docente($format = null) { return Format::convertCase($this->docente, $format); }
  public function reemplazo($format = null) { return Format::convertCase($this->reemplazo, $format); }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkId($p); 
    if($check) $this->id = $p;
    return $check;
  }

  public function _setFechaToma(DateTime $p = null) {
      $check = $this->checkFechaToma($p); 
      if($check) $this->fechaToma = $p;  
      return $check;      
  }

  public function setFechaToma($p, $format = UNDEFINED) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    if(!is_null($p)) $p = ($format == UNDEFINED) ? SpanishDateTime::createFromDate($p) : SpanishDateTime::createFromFormat($format, $p);    
    $check = $this->checkFechaToma($p); 
    if($check) $this->fechaToma = $p;  
    return $check;
  }

  public function _setFechaInicio(DateTime $p = null) {
      $check = $this->checkFechaInicio($p); 
      if($check) $this->fechaInicio = $p;  
      return $check;      
  }

  public function setFechaInicio($p, $format = UNDEFINED) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    if(!is_null($p)) $p = ($format == UNDEFINED) ? SpanishDateTime::createFromDate($p) : SpanishDateTime::createFromFormat($format, $p);    
    $check = $this->checkFechaInicio($p); 
    if($check) $this->fechaInicio = $p;  
    return $check;
  }

  public function _setFechaFin(DateTime $p = null) {
      $check = $this->checkFechaFin($p); 
      if($check) $this->fechaFin = $p;  
      return $check;      
  }

  public function setFechaFin($p, $format = UNDEFINED) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    if(!is_null($p)) $p = ($format == UNDEFINED) ? SpanishDateTime::createFromDate($p) : SpanishDateTime::createFromFormat($format, $p);    
    $check = $this->checkFechaFin($p); 
    if($check) $this->fechaFin = $p;  
    return $check;
  }

  public function _setFechaContralor(DateTime $p = null) {
      $check = $this->checkFechaContralor($p); 
      if($check) $this->fechaContralor = $p;  
      return $check;      
  }

  public function setFechaContralor($p, $format = UNDEFINED) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    if(!is_null($p)) $p = ($format == UNDEFINED) ? SpanishDateTime::createFromDate($p) : SpanishDateTime::createFromFormat($format, $p);    
    $check = $this->checkFechaContralor($p); 
    if($check) $this->fechaContralor = $p;  
    return $check;
  }

  public function _setFechaConsejo(DateTime $p = null) {
      $check = $this->checkFechaConsejo($p); 
      if($check) $this->fechaConsejo = $p;  
      return $check;      
  }

  public function setFechaConsejo($p, $format = UNDEFINED) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    if(!is_null($p)) $p = ($format == UNDEFINED) ? SpanishDateTime::createFromDate($p) : SpanishDateTime::createFromFormat($format, $p);    
    $check = $this->checkFechaConsejo($p); 
    if($check) $this->fechaConsejo = $p;  
    return $check;
  }

  public function setEstado($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkEstado($p); 
    if($check) $this->estado = $p;
    return $check;
  }

  public function setObservaciones($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkObservaciones($p); 
    if($check) $this->observaciones = $p;
    return $check;
  }

  public function setComentario($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkComentario($p); 
    if($check) $this->comentario = $p;
    return $check;
  }

  public function setTipoMovimiento($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkTipoMovimiento($p); 
    if($check) $this->tipoMovimiento = $p;
    return $check;
  }

  public function setEstadoContralor($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkEstadoContralor($p); 
    if($check) $this->estadoContralor = $p;
    return $check;
  }

  public function _setAlta(DateTime $p = null) {
      $check = $this->checkAlta($p); 
      if($check) $this->alta = $p;  
      return $check;
  }

  public function setAlta($p, $format = "Y-m-d H:i:s") {
    $p = ($p == DEFAULT_VALUE) ? date('Y-m-d H:i:s') : trim($p);
    if(!is_null($p)) $p = SpanishDateTime::createFromFormat($format, $p);    
    $check = $this->checkAlta($p); 
    if($check) $this->alta = $p;  
    return $check;
  }

  public function setCurso($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkCurso($p); 
    if($check) $this->curso = $p;
    return $check;
  }

  public function setDocente($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkDocente($p); 
    if($check) $this->docente = $p;
    return $check;
  }

  public function setReemplazo($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkReemplazo($p); 
    if($check) $this->reemplazo = $p;
    return $check;
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

  public function checkFechaContralor($value) { 
    $v = Validation::getInstanceValue($value)->date();
    return $this->_setLogsValidation("fecha_contralor", $v);
  }

  public function checkFechaConsejo($value) { 
    $v = Validation::getInstanceValue($value)->date();
    return $this->_setLogsValidation("fecha_consejo", $v);
  }

  public function checkEstado($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("estado", $v);
  }

  public function checkObservaciones($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("observaciones", $v);
  }

  public function checkComentario($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("comentario", $v);
  }

  public function checkTipoMovimiento($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("tipo_movimiento", $v);
  }

  public function checkEstadoContralor($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("estado_contralor", $v);
  }

  public function checkAlta($value) { 
    $v = Validation::getInstanceValue($value)->date()->required();
    return $this->_setLogsValidation("alta", $v);
  }

  public function checkCurso($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("curso", $v);
  }

  public function checkDocente($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("docente", $v);
  }

  public function checkReemplazo($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("reemplazo", $v);
  }



}
