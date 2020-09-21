<?php
require_once("class/model/entityOptions/Value.php");

class _TomaValue extends ValueEntityOptions{

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

  public function setDefaultId() { if($this->id === UNDEFINED) $this->setId(uniqid()); }
  public function setDefaultFechaToma() { if($this->fechaToma === UNDEFINED) $this->setFechaToma(null); }
  public function setDefaultEstado() { if($this->estado === UNDEFINED) $this->setEstado(null); }
  public function setDefaultObservaciones() { if($this->observaciones === UNDEFINED) $this->setObservaciones(null); }
  public function setDefaultComentario() { if($this->comentario === UNDEFINED) $this->setComentario(null); }
  public function setDefaultTipoMovimiento() { if($this->tipoMovimiento === UNDEFINED) $this->setTipoMovimiento(null); }
  public function setDefaultEstadoContralor() { if($this->estadoContralor === UNDEFINED) $this->setEstadoContralor(null); }
  public function setDefaultAlta() { if($this->alta === UNDEFINED) $this->setAlta(date('c')); }
  public function setDefaultCurso() { if($this->curso === UNDEFINED) $this->setCurso(null); }
  public function setDefaultDocente() { if($this->docente === UNDEFINED) $this->setDocente(null); }
  public function setDefaultReemplazo() { if($this->reemplazo === UNDEFINED) $this->setReemplazo(null); }
  public function setDefaultPlanillaDocente() { if($this->planillaDocente === UNDEFINED) $this->setPlanillaDocente(null); }

  public function isEmptyId() { if(!Validation::is_empty($this->id)) return false; }
  public function isEmptyFechaToma() { if(!Validation::is_empty($this->fechaToma)) return false; }
  public function isEmptyEstado() { if(!Validation::is_empty($this->estado)) return false; }
  public function isEmptyObservaciones() { if(!Validation::is_empty($this->observaciones)) return false; }
  public function isEmptyComentario() { if(!Validation::is_empty($this->comentario)) return false; }
  public function isEmptyTipoMovimiento() { if(!Validation::is_empty($this->tipoMovimiento)) return false; }
  public function isEmptyEstadoContralor() { if(!Validation::is_empty($this->estadoContralor)) return false; }
  public function isEmptyAlta() { if(!Validation::is_empty($this->alta)) return false; }
  public function isEmptyCurso() { if(!Validation::is_empty($this->curso)) return false; }
  public function isEmptyDocente() { if(!Validation::is_empty($this->docente)) return false; }
  public function isEmptyReemplazo() { if(!Validation::is_empty($this->reemplazo)) return false; }
  public function isEmptyPlanillaDocente() { if(!Validation::is_empty($this->planillaDocente)) return false; }

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

  public function _setId(string $p = null) { return $this->id = $p; }  
  public function setId($p) { return $this->id = (is_null($p)) ? null : (string)$p; }

  public function _setFechaToma(DateTime $p = null) { return $this->fechaToma = $p; }  

  public function setFechaToma($p) {
    if(!is_null($p) && !($p instanceof DateTime)) $p = new SpanishDateTime($p);
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->fechaToma = $p;
  }

  public function setFechaTomaY($p) {
    if(!is_null($p) && !($p instanceof DateTime)) {
      $p = (strlen($p) == 4) ? SpanishDateTime::createFromFormat('Y', $p) : new SpanishDateTime($p);
    }
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->fechaToma = $p;
  }

  public function _setEstado(string $p = null) { return $this->estado = $p; }  
  public function setEstado($p) { return $this->estado = (is_null($p)) ? null : (string)$p; }

  public function _setObservaciones(string $p = null) { return $this->observaciones = $p; }  
  public function setObservaciones($p) { return $this->observaciones = (is_null($p)) ? null : (string)$p; }

  public function _setComentario(string $p = null) { return $this->comentario = $p; }  
  public function setComentario($p) { return $this->comentario = (is_null($p)) ? null : (string)$p; }

  public function _setTipoMovimiento(string $p = null) { return $this->tipoMovimiento = $p; }  
  public function setTipoMovimiento($p) { return $this->tipoMovimiento = (is_null($p)) ? null : (string)$p; }

  public function _setEstadoContralor(string $p = null) { return $this->estadoContralor = $p; }  
  public function setEstadoContralor($p) { return $this->estadoContralor = (is_null($p)) ? null : (string)$p; }

  public function _setAlta(DateTime $p = null) { return $this->alta = $p; }  

  public function setAlta($p) {
    if(!is_null($p) && !($p instanceof DateTime)) $p = new SpanishDateTime($p);
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->alta = $p;
  }

  public function setAltaY($p) {
    if(!is_null($p) && !($p instanceof DateTime)) {
      $p = (strlen($p) == 4) ? SpanishDateTime::createFromFormat('Y', $p) : new SpanishDateTime($p);
    }
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->alta = $p;
  }

  public function _setCurso(string $p = null) { return $this->curso = $p; }  
  public function setCurso($p) { return $this->curso = (is_null($p)) ? null : (string)$p; }

  public function _setDocente(string $p = null) { return $this->docente = $p; }  
  public function setDocente($p) { return $this->docente = (is_null($p)) ? null : (string)$p; }

  public function _setReemplazo(string $p = null) { return $this->reemplazo = $p; }  
  public function setReemplazo($p) { return $this->reemplazo = (is_null($p)) ? null : (string)$p; }

  public function _setPlanillaDocente(string $p = null) { return $this->planillaDocente = $p; }  
  public function setPlanillaDocente($p) { return $this->planillaDocente = (is_null($p)) ? null : (string)$p; }

  public function resetId() { if(!Validation::is_empty($this->id)) $this->id = preg_replace('/\s\s+/', ' ', trim($this->id)); }
  public function resetEstado() { if(!Validation::is_empty($this->estado)) $this->estado = preg_replace('/\s\s+/', ' ', trim($this->estado)); }
  public function resetObservaciones() { if(!Validation::is_empty($this->observaciones)) $this->observaciones = preg_replace('/\s\s+/', ' ', trim($this->observaciones)); }
  public function resetComentario() { if(!Validation::is_empty($this->comentario)) $this->comentario = preg_replace('/\s\s+/', ' ', trim($this->comentario)); }
  public function resetTipoMovimiento() { if(!Validation::is_empty($this->tipoMovimiento)) $this->tipoMovimiento = preg_replace('/\s\s+/', ' ', trim($this->tipoMovimiento)); }
  public function resetEstadoContralor() { if(!Validation::is_empty($this->estadoContralor)) $this->estadoContralor = preg_replace('/\s\s+/', ' ', trim($this->estadoContralor)); }
  public function resetCurso() { if(!Validation::is_empty($this->curso)) $this->curso = preg_replace('/\s\s+/', ' ', trim($this->curso)); }
  public function resetDocente() { if(!Validation::is_empty($this->docente)) $this->docente = preg_replace('/\s\s+/', ' ', trim($this->docente)); }
  public function resetReemplazo() { if(!Validation::is_empty($this->reemplazo)) $this->reemplazo = preg_replace('/\s\s+/', ' ', trim($this->reemplazo)); }
  public function resetPlanillaDocente() { if(!Validation::is_empty($this->planillaDocente)) $this->planillaDocente = preg_replace('/\s\s+/', ' ', trim($this->planillaDocente)); }

  public function checkId() { 
      if(Validation::is_undefined($this->id)) return null;
      return true; 
  }

  public function checkFechaToma() { 
      $this->_logs->resetLogs("fecha_toma");
      if(Validation::is_undefined($this->fechaToma)) return null;
      $v = Validation::getInstanceValue($this->fechaToma)->isA('DateTime');
      foreach($v->getErrors() as $error){ $this->_logs->addLog("fecha_toma", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkEstado() { 
      $this->_logs->resetLogs("estado");
      if(Validation::is_undefined($this->estado)) return null;
      $v = Validation::getInstanceValue($this->estado)->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("estado", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkObservaciones() { 
      $this->_logs->resetLogs("observaciones");
      if(Validation::is_undefined($this->observaciones)) return null;
      $v = Validation::getInstanceValue($this->observaciones)->max(65535);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("observaciones", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkComentario() { 
      $this->_logs->resetLogs("comentario");
      if(Validation::is_undefined($this->comentario)) return null;
      $v = Validation::getInstanceValue($this->comentario)->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("comentario", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkTipoMovimiento() { 
      $this->_logs->resetLogs("tipo_movimiento");
      if(Validation::is_undefined($this->tipoMovimiento)) return null;
      $v = Validation::getInstanceValue($this->tipoMovimiento)->required()->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("tipo_movimiento", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkEstadoContralor() { 
      $this->_logs->resetLogs("estado_contralor");
      if(Validation::is_undefined($this->estadoContralor)) return null;
      $v = Validation::getInstanceValue($this->estadoContralor)->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("estado_contralor", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkAlta() { 
      $this->_logs->resetLogs("alta");
      if(Validation::is_undefined($this->alta)) return null;
      $v = Validation::getInstanceValue($this->alta)->required()->isA('DateTime');
      foreach($v->getErrors() as $error){ $this->_logs->addLog("alta", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkCurso() { 
      $this->_logs->resetLogs("curso");
      if(Validation::is_undefined($this->curso)) return null;
      $v = Validation::getInstanceValue($this->curso)->required()->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("curso", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkDocente() { 
      $this->_logs->resetLogs("docente");
      if(Validation::is_undefined($this->docente)) return null;
      $v = Validation::getInstanceValue($this->docente)->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("docente", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkReemplazo() { 
      $this->_logs->resetLogs("reemplazo");
      if(Validation::is_undefined($this->reemplazo)) return null;
      $v = Validation::getInstanceValue($this->reemplazo)->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("reemplazo", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkPlanillaDocente() { 
      $this->_logs->resetLogs("planilla_docente");
      if(Validation::is_undefined($this->planillaDocente)) return null;
      $v = Validation::getInstanceValue($this->planillaDocente)->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("planilla_docente", "error", $error); }
      return $v->isSuccess();
    }
  
    public function sqlId() { return $this->sql->string($this->id); }
  public function sqlFechaToma() { return $this->sql->dateTime($this->fechaToma, "Y-m-d"); }
  public function sqlFechaTomaYm() { return $this->sql->dateTime($this->fechaToma, "Y-m"); }
  public function sqlFechaTomaY() { return $this->sql->dateTime($this->fechaToma, "Y"); }
  public function sqlEstado() { return $this->sql->string($this->estado); }
  public function sqlObservaciones() { return $this->sql->string($this->observaciones); }
  public function sqlComentario() { return $this->sql->string($this->comentario); }
  public function sqlTipoMovimiento() { return $this->sql->string($this->tipoMovimiento); }
  public function sqlEstadoContralor() { return $this->sql->string($this->estadoContralor); }
  public function sqlAlta() { return $this->sql->dateTime($this->alta, "Y-m-d H:i:s"); }
  public function sqlAltaDate() { return $this->sql->dateTime($this->alta, "Y-m-d"); }
  public function sqlAltaYm() { return $this->sql->dateTime($this->alta, "Y-m"); }
  public function sqlAltaY() { return $this->sql->dateTime($this->alta, "Y"); }
  public function sqlCurso() { return $this->sql->string($this->curso); }
  public function sqlDocente() { return $this->sql->string($this->docente); }
  public function sqlReemplazo() { return $this->sql->string($this->reemplazo); }
  public function sqlPlanillaDocente() { return $this->sql->string($this->planillaDocente); }

  public function jsonId() { return $this->id; }
  public function jsonFechaToma() { return $this->fechaToma('c'); }
  public function jsonEstado() { return $this->estado; }
  public function jsonObservaciones() { return $this->observaciones; }
  public function jsonComentario() { return $this->comentario; }
  public function jsonTipoMovimiento() { return $this->tipoMovimiento; }
  public function jsonEstadoContralor() { return $this->estadoContralor; }
  public function jsonAlta() { return $this->alta('c'); }
  public function jsonCurso() { return $this->curso; }
  public function jsonDocente() { return $this->docente; }
  public function jsonReemplazo() { return $this->reemplazo; }
  public function jsonPlanillaDocente() { return $this->planillaDocente; }



}
