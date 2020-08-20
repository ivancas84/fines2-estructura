<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _Toma extends EntityValues {
  protected $id = UNDEFINED;
  protected $fechaToma = UNDEFINED;
  protected $estado = UNDEFINED;
  protected $observaciones = UNDEFINED;
  protected $comentario = UNDEFINED;
  protected $tipoMovimiento = UNDEFINED;
  protected $estadoContralor = UNDEFINED;
  protected $alta = UNDEFINED;
  protected $curso = UNDEFINED;
  protected $docente = UNDEFINED;
  protected $reemplazo = UNDEFINED;
  protected $planillaDocente = UNDEFINED;

  public function _setDefault(){
    if($this->id == UNDEFINED) $this->setId(null);
    if($this->fechaToma == UNDEFINED) $this->setFechaToma(null);
    if($this->estado == UNDEFINED) $this->setEstado(null);
    if($this->observaciones == UNDEFINED) $this->setObservaciones(null);
    if($this->comentario == UNDEFINED) $this->setComentario(null);
    if($this->tipoMovimiento == UNDEFINED) $this->setTipoMovimiento(null);
    if($this->estadoContralor == UNDEFINED) $this->setEstadoContralor(null);
    if($this->alta == UNDEFINED) $this->setAlta(date('c'));
    if($this->curso == UNDEFINED) $this->setCurso(null);
    if($this->docente == UNDEFINED) $this->setDocente(null);
    if($this->reemplazo == UNDEFINED) $this->setReemplazo(null);
    if($this->planillaDocente == UNDEFINED) $this->setPlanillaDocente(null);
    return $this;
  }

  public function _fromArray(array $row = NULL, string $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."fecha_toma"])) $this->setFechaToma($row[$p."fecha_toma"]);
    if(isset($row[$p."estado"])) $this->setEstado($row[$p."estado"]);
    if(isset($row[$p."observaciones"])) $this->setObservaciones($row[$p."observaciones"]);
    if(isset($row[$p."comentario"])) $this->setComentario($row[$p."comentario"]);
    if(isset($row[$p."tipo_movimiento"])) $this->setTipoMovimiento($row[$p."tipo_movimiento"]);
    if(isset($row[$p."estado_contralor"])) $this->setEstadoContralor($row[$p."estado_contralor"]);
    if(isset($row[$p."alta"])) $this->setAlta($row[$p."alta"]);
    if(isset($row[$p."curso"])) $this->setCurso($row[$p."curso"]);
    if(isset($row[$p."docente"])) $this->setDocente($row[$p."docente"]);
    if(isset($row[$p."reemplazo"])) $this->setReemplazo($row[$p."reemplazo"]);
    if(isset($row[$p."planilla_docente"])) $this->setPlanillaDocente($row[$p."planilla_docente"]);
    return $this;
  }

  public function _toArray(string $p = ""){
    $row = [];
    if($this->id !== UNDEFINED) $row[$p."id"] = $this->id();
    if($this->fechaToma !== UNDEFINED) $row[$p."fecha_toma"] = $this->fechaToma("c");
    if($this->estado !== UNDEFINED) $row[$p."estado"] = $this->estado();
    if($this->observaciones !== UNDEFINED) $row[$p."observaciones"] = $this->observaciones();
    if($this->comentario !== UNDEFINED) $row[$p."comentario"] = $this->comentario();
    if($this->tipoMovimiento !== UNDEFINED) $row[$p."tipo_movimiento"] = $this->tipoMovimiento();
    if($this->estadoContralor !== UNDEFINED) $row[$p."estado_contralor"] = $this->estadoContralor();
    if($this->alta !== UNDEFINED) $row[$p."alta"] = $this->alta("c");
    if($this->curso !== UNDEFINED) $row[$p."curso"] = $this->curso();
    if($this->docente !== UNDEFINED) $row[$p."docente"] = $this->docente();
    if($this->reemplazo !== UNDEFINED) $row[$p."reemplazo"] = $this->reemplazo();
    if($this->planillaDocente !== UNDEFINED) $row[$p."planilla_docente"] = $this->planillaDocente();
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->fechaToma)) return false;
    if(!Validation::is_empty($this->estado)) return false;
    if(!Validation::is_empty($this->observaciones)) return false;
    if(!Validation::is_empty($this->comentario)) return false;
    if(!Validation::is_empty($this->tipoMovimiento)) return false;
    if(!Validation::is_empty($this->estadoContralor)) return false;
    if(!Validation::is_empty($this->alta)) return false;
    if(!Validation::is_empty($this->curso)) return false;
    if(!Validation::is_empty($this->docente)) return false;
    if(!Validation::is_empty($this->reemplazo)) return false;
    if(!Validation::is_empty($this->planillaDocente)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function fechaToma($format = null) { return Format::date($this->fechaToma, $format); }
  public function estado($format = null) { return Format::convertCase($this->estado, $format); }
  public function observaciones($format = null) { return Format::convertCase($this->observaciones, $format); }
  public function comentario($format = null) { return Format::convertCase($this->comentario, $format); }
  public function tipoMovimiento($format = null) { return Format::convertCase($this->tipoMovimiento, $format); }
  public function estadoContralor($format = null) { return Format::convertCase($this->estadoContralor, $format); }
  public function alta($format = null) { return Format::date($this->alta, $format); }
  public function curso($format = null) { return Format::convertCase($this->curso, $format); }
  public function docente($format = null) { return Format::convertCase($this->docente, $format); }
  public function reemplazo($format = null) { return Format::convertCase($this->reemplazo, $format); }
  public function planillaDocente($format = null) { return Format::convertCase($this->planillaDocente, $format); }

  public function setId($p) { $this->id = (is_null($p)) ? null : (string)$p; }
  public function _setFechaToma(DateTime $p = null) { $this->fechaToma = $p; }

  public function setFechaToma($p) {
    if(!is_null($p)) {
      $p = new SpanishDateTime($p);
      if($p) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
      $p->setTime(0,0,0);
    }
    $this->fechaToma = $p;
  }

  public function setEstado($p) { $this->estado = (is_null($p)) ? null : (string)$p; }
  public function setObservaciones($p) { $this->observaciones = (is_null($p)) ? null : (string)$p; }
  public function setComentario($p) { $this->comentario = (is_null($p)) ? null : (string)$p; }
  public function setTipoMovimiento($p) { $this->tipoMovimiento = (is_null($p)) ? null : (string)$p; }
  public function setEstadoContralor($p) { $this->estadoContralor = (is_null($p)) ? null : (string)$p; }
  public function _setAlta(DateTime $p = null) { $this->alta = $p; }

  public function setAlta($p) {
    if(!is_null($p)) {
      $p = new SpanishDateTime($p);    
      if($p) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    }
    $this->alta = $p;  
  }

  public function setCurso($p) { $this->curso = (is_null($p)) ? null : (string)$p; }
  public function setDocente($p) { $this->docente = (is_null($p)) ? null : (string)$p; }
  public function setReemplazo($p) { $this->reemplazo = (is_null($p)) ? null : (string)$p; }
  public function setPlanillaDocente($p) { $this->planillaDocente = (is_null($p)) ? null : (string)$p; }

  public function resetEstado() { if(!Validation::is_empty($this->estado)) $this->estado = preg_replace('/\s\s+/', ' ', trim($this->estado)); }
  public function resetObservaciones() { if(!Validation::is_empty($this->observaciones)) $this->observaciones = preg_replace('/\s\s+/', ' ', trim($this->observaciones)); }
  public function resetComentario() { if(!Validation::is_empty($this->comentario)) $this->comentario = preg_replace('/\s\s+/', ' ', trim($this->comentario)); }
  public function resetTipoMovimiento() { if(!Validation::is_empty($this->tipoMovimiento)) $this->tipoMovimiento = preg_replace('/\s\s+/', ' ', trim($this->tipoMovimiento)); }
  public function resetEstadoContralor() { if(!Validation::is_empty($this->estadoContralor)) $this->estadoContralor = preg_replace('/\s\s+/', ' ', trim($this->estadoContralor)); }

  public function checkId($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkFechaToma($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkEstado($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkObservaciones($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkComentario($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkTipoMovimiento($value) { 
    $this->_logs->resetLogs("tipo_movimiento");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("tipo_movimiento", "error", $error); }
    return $v->isSuccess();
  }

  public function checkEstadoContralor($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkAlta($value) { 
    $this->_logs->resetLogs("alta");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("alta", "error", $error); }
    return $v->isSuccess();
  }

  public function checkCurso($value) { 
    $this->_logs->resetLogs("curso");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("curso", "error", $error); }
    return $v->isSuccess();
  }

  public function checkDocente($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkReemplazo($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkPlanillaDocente($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function _check(){
    $this->checkId($this->id);
    $this->checkFechaToma($this->fechaToma);
    $this->checkEstado($this->estado);
    $this->checkObservaciones($this->observaciones);
    $this->checkComentario($this->comentario);
    $this->checkTipoMovimiento($this->tipoMovimiento);
    $this->checkEstadoContralor($this->estadoContralor);
    $this->checkAlta($this->alta);
    $this->checkCurso($this->curso);
    $this->checkDocente($this->docente);
    $this->checkReemplazo($this->reemplazo);
    $this->checkPlanillaDocente($this->planillaDocente);
    return !$this->_getLogs()->isError();
  }

  public function _reset(){
    $this->resetEstado();
    $this->resetObservaciones();
    $this->resetComentario();
    $this->resetTipoMovimiento();
    $this->resetEstadoContralor();
    return $this;
  }



}
