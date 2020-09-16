<?php
require_once("class/model/entityOptions/Value.php");

class _ComisionValue extends ValueEntityOptions{

  protected $id = UNDEFINED;
  protected $turno = UNDEFINED;
  protected $division = UNDEFINED;
  protected $comentario = UNDEFINED;
  protected $autorizada = UNDEFINED;
  protected $apertura = UNDEFINED;
  protected $publicada = UNDEFINED;
  protected $observaciones = UNDEFINED;
  protected $alta = UNDEFINED;
  protected $sede = UNDEFINED;
  protected $modalidad = UNDEFINED;
  protected $planificacion = UNDEFINED;
  protected $comisionSiguiente = UNDEFINED;
  protected $calendario = UNDEFINED;

  public function setDefaultId() { if($this->id === UNDEFINED) $this->setId(uniqid()); }
  public function setDefaultTurno() { if($this->turno === UNDEFINED) $this->setTurno(null); }
  public function setDefaultDivision() { if($this->division === UNDEFINED) $this->setDivision(null); }
  public function setDefaultComentario() { if($this->comentario === UNDEFINED) $this->setComentario(null); }
  public function setDefaultAutorizada() { if($this->autorizada === UNDEFINED) $this->setAutorizada(null); }
  public function setDefaultApertura() { if($this->apertura === UNDEFINED) $this->setApertura(null); }
  public function setDefaultPublicada() { if($this->publicada === UNDEFINED) $this->setPublicada(null); }
  public function setDefaultObservaciones() { if($this->observaciones === UNDEFINED) $this->setObservaciones(null); }
  public function setDefaultAlta() { if($this->alta === UNDEFINED) $this->setAlta(date('c')); }
  public function setDefaultSede() { if($this->sede === UNDEFINED) $this->setSede(null); }
  public function setDefaultModalidad() { if($this->modalidad === UNDEFINED) $this->setModalidad(null); }
  public function setDefaultPlanificacion() { if($this->planificacion === UNDEFINED) $this->setPlanificacion(null); }
  public function setDefaultComisionSiguiente() { if($this->comisionSiguiente === UNDEFINED) $this->setComisionSiguiente(null); }
  public function setDefaultCalendario() { if($this->calendario === UNDEFINED) $this->setCalendario(null); }

  public function isEmptyId() { if(!Validation::is_empty($this->id)) return false; }
  public function isEmptyTurno() { if(!Validation::is_empty($this->turno)) return false; }
  public function isEmptyDivision() { if(!Validation::is_empty($this->division)) return false; }
  public function isEmptyComentario() { if(!Validation::is_empty($this->comentario)) return false; }
  public function isEmptyAutorizada() { if(!Validation::is_empty($this->autorizada)) return false; }
  public function isEmptyApertura() { if(!Validation::is_empty($this->apertura)) return false; }
  public function isEmptyPublicada() { if(!Validation::is_empty($this->publicada)) return false; }
  public function isEmptyObservaciones() { if(!Validation::is_empty($this->observaciones)) return false; }
  public function isEmptyAlta() { if(!Validation::is_empty($this->alta)) return false; }
  public function isEmptySede() { if(!Validation::is_empty($this->sede)) return false; }
  public function isEmptyModalidad() { if(!Validation::is_empty($this->modalidad)) return false; }
  public function isEmptyPlanificacion() { if(!Validation::is_empty($this->planificacion)) return false; }
  public function isEmptyComisionSiguiente() { if(!Validation::is_empty($this->comisionSiguiente)) return false; }
  public function isEmptyCalendario() { if(!Validation::is_empty($this->calendario)) return false; }

  public function id() { return $this->id; }
  public function turno($format = null) { return Format::convertCase($this->turno, $format); }
  public function division($format = null) { return Format::convertCase($this->division, $format); }
  public function comentario($format = null) { return Format::convertCase($this->comentario, $format); }
  public function autorizada($format = null) { return Format::boolean($this->autorizada, $format); }
  public function apertura($format = null) { return Format::boolean($this->apertura, $format); }
  public function publicada($format = null) { return Format::boolean($this->publicada, $format); }
  public function observaciones($format = null) { return Format::convertCase($this->observaciones, $format); }
  public function alta($format = null) { return Format::date($this->alta, $format); }
  public function sede($format = null) { return Format::convertCase($this->sede, $format); }
  public function modalidad($format = null) { return Format::convertCase($this->modalidad, $format); }
  public function planificacion($format = null) { return Format::convertCase($this->planificacion, $format); }
  public function comisionSiguiente($format = null) { return Format::convertCase($this->comisionSiguiente, $format); }
  public function calendario($format = null) { return Format::convertCase($this->calendario, $format); }

  public function _setId(string $p = null) { return $this->id = $p; }  
  public function setId($p) { return $this->id = (is_null($p)) ? null : (string)$p; }

  public function _setTurno(string $p = null) { return $this->turno = $p; }  
  public function setTurno($p) { return $this->turno = (is_null($p)) ? null : (string)$p; }

  public function _setDivision(string $p = null) { return $this->division = $p; }  
  public function setDivision($p) { return $this->division = (is_null($p)) ? null : (string)$p; }

  public function _setComentario(string $p = null) { return $this->comentario = $p; }  
  public function setComentario($p) { return $this->comentario = (is_null($p)) ? null : (string)$p; }

  public function _setAutorizada(boolean $p = null) { return $this->autorizada = $p; }  
  public function setAutorizada($p) { return $this->autorizada = settypebool($p); }

  public function _setApertura(boolean $p = null) { return $this->apertura = $p; }  
  public function setApertura($p) { return $this->apertura = settypebool($p); }

  public function _setPublicada(boolean $p = null) { return $this->publicada = $p; }  
  public function setPublicada($p) { return $this->publicada = settypebool($p); }

  public function _setObservaciones(string $p = null) { return $this->observaciones = $p; }  
  public function setObservaciones($p) { return $this->observaciones = (is_null($p)) ? null : (string)$p; }

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

  public function _setSede(string $p = null) { return $this->sede = $p; }  
  public function setSede($p) { return $this->sede = (is_null($p)) ? null : (string)$p; }

  public function _setModalidad(string $p = null) { return $this->modalidad = $p; }  
  public function setModalidad($p) { return $this->modalidad = (is_null($p)) ? null : (string)$p; }

  public function _setPlanificacion(string $p = null) { return $this->planificacion = $p; }  
  public function setPlanificacion($p) { return $this->planificacion = (is_null($p)) ? null : (string)$p; }

  public function _setComisionSiguiente(string $p = null) { return $this->comisionSiguiente = $p; }  
  public function setComisionSiguiente($p) { return $this->comisionSiguiente = (is_null($p)) ? null : (string)$p; }

  public function _setCalendario(string $p = null) { return $this->calendario = $p; }  
  public function setCalendario($p) { return $this->calendario = (is_null($p)) ? null : (string)$p; }

  public function resetTurno() { if(!Validation::is_empty($this->turno)) $this->turno = preg_replace('/\s\s+/', ' ', trim($this->turno)); }
  public function resetDivision() { if(!Validation::is_empty($this->division)) $this->division = preg_replace('/\s\s+/', ' ', trim($this->division)); }
  public function resetComentario() { if(!Validation::is_empty($this->comentario)) $this->comentario = preg_replace('/\s\s+/', ' ', trim($this->comentario)); }
  public function resetObservaciones() { if(!Validation::is_empty($this->observaciones)) $this->observaciones = preg_replace('/\s\s+/', ' ', trim($this->observaciones)); }

  public function checkId() { 
      if(Validation::is_undefined($this->id)) return null;
      return true; 
  }

  public function checkTurno() { 
    $this->_logs->resetLogs("turno");
    if(Validation::is_undefined($this->turno)) return null;
    $v = Validation::getInstanceValue($this->turno)->max(45);
    foreach($v->getErrors() as $error){ $this->_logs->addLog("turno", "error", $error); }
    return $v->isSuccess();
  }

  public function checkDivision() { 
    $this->_logs->resetLogs("division");
    if(Validation::is_undefined($this->division)) return null;
    $v = Validation::getInstanceValue($this->division)->required()->max(45);
    foreach($v->getErrors() as $error){ $this->_logs->addLog("division", "error", $error); }
    return $v->isSuccess();
  }

  public function checkComentario() { 
    $this->_logs->resetLogs("comentario");
    if(Validation::is_undefined($this->comentario)) return null;
    $v = Validation::getInstanceValue($this->comentario)->max(65535);
    foreach($v->getErrors() as $error){ $this->_logs->addLog("comentario", "error", $error); }
    return $v->isSuccess();
  }

  public function checkAutorizada() { 
    $this->_logs->resetLogs("autorizada");
    if(Validation::is_undefined($this->autorizada)) return null;
    $v = Validation::getInstanceValue($this->autorizada)->required()->max(1);
    foreach($v->getErrors() as $error){ $this->_logs->addLog("autorizada", "error", $error); }
    return $v->isSuccess();
  }

  public function checkApertura() { 
    $this->_logs->resetLogs("apertura");
    if(Validation::is_undefined($this->apertura)) return null;
    $v = Validation::getInstanceValue($this->apertura)->required()->max(1);
    foreach($v->getErrors() as $error){ $this->_logs->addLog("apertura", "error", $error); }
    return $v->isSuccess();
  }

  public function checkPublicada() { 
    $this->_logs->resetLogs("publicada");
    if(Validation::is_undefined($this->publicada)) return null;
    $v = Validation::getInstanceValue($this->publicada)->required()->max(1);
    foreach($v->getErrors() as $error){ $this->_logs->addLog("publicada", "error", $error); }
    return $v->isSuccess();
  }

  public function checkObservaciones() { 
    $this->_logs->resetLogs("observaciones");
    if(Validation::is_undefined($this->observaciones)) return null;
    $v = Validation::getInstanceValue($this->observaciones)->max(65535);
    foreach($v->getErrors() as $error){ $this->_logs->addLog("observaciones", "error", $error); }
    return $v->isSuccess();
  }

  public function checkAlta() { 
    $this->_logs->resetLogs("alta");
    if(Validation::is_undefined($this->alta)) return null;
    $v = Validation::getInstanceValue($this->alta)->required()->isA('DateTime');
    foreach($v->getErrors() as $error){ $this->_logs->addLog("alta", "error", $error); }
    return $v->isSuccess();
  }

  public function checkSede() { 
    $this->_logs->resetLogs("sede");
    if(Validation::is_undefined($this->sede)) return null;
    $v = Validation::getInstanceValue($this->sede)->required()->max(45);
    foreach($v->getErrors() as $error){ $this->_logs->addLog("sede", "error", $error); }
    return $v->isSuccess();
  }

  public function checkModalidad() { 
    $this->_logs->resetLogs("modalidad");
    if(Validation::is_undefined($this->modalidad)) return null;
    $v = Validation::getInstanceValue($this->modalidad)->required()->max(45);
    foreach($v->getErrors() as $error){ $this->_logs->addLog("modalidad", "error", $error); }
    return $v->isSuccess();
  }

  public function checkPlanificacion() { 
    $this->_logs->resetLogs("planificacion");
    if(Validation::is_undefined($this->planificacion)) return null;
    $v = Validation::getInstanceValue($this->planificacion)->max(45);
    foreach($v->getErrors() as $error){ $this->_logs->addLog("planificacion", "error", $error); }
    return $v->isSuccess();
  }

  public function checkComisionSiguiente() { 
    $this->_logs->resetLogs("comision_siguiente");
    if(Validation::is_undefined($this->comisionSiguiente)) return null;
    $v = Validation::getInstanceValue($this->comisionSiguiente)->max(45);
    foreach($v->getErrors() as $error){ $this->_logs->addLog("comision_siguiente", "error", $error); }
    return $v->isSuccess();
  }

  public function checkCalendario() { 
    $this->_logs->resetLogs("calendario");
    if(Validation::is_undefined($this->calendario)) return null;
    $v = Validation::getInstanceValue($this->calendario)->required()->max(45);
    foreach($v->getErrors() as $error){ $this->_logs->addLog("calendario", "error", $error); }
    return $v->isSuccess();
  }

  public function sqlId() { return $this->_sqlString($this->id); }
  public function sqlTurno() { return $this->_sqlString($this->turno); }
  public function sqlDivision() { return $this->_sqlString($this->division); }
  public function sqlComentario() { return $this->_sqlString($this->comentario); }
  public function sqlAutorizada() { return $this->_sqlBoolean($this->autorizada); }
  public function sqlApertura() { return $this->_sqlBoolean($this->apertura); }
  public function sqlPublicada() { return $this->_sqlBoolean($this->publicada); }
  public function sqlObservaciones() { return $this->_sqlString($this->observaciones); }
  public function sqlAlta() { return $this->_sqlDateTime($this->alta, "Y-m-d H:i:s"); }
  public function sqlAltaDate() { return $this->_sqlDateTime($this->alta, "Y-m-d"); }
  public function sqlAltaYm() { return $this->_sqlDateTime($this->alta, "Y-m"); }
  public function sqlAltaY() { return $this->_sqlDateTime($this->alta, "Y"); }
  public function sqlSede() { return $this->_sqlString($this->sede); }
  public function sqlModalidad() { return $this->_sqlString($this->modalidad); }
  public function sqlPlanificacion() { return $this->_sqlString($this->planificacion); }
  public function sqlComisionSiguiente() { return $this->_sqlString($this->comisionSiguiente); }
  public function sqlCalendario() { return $this->_sqlString($this->calendario); }

  public function jsonId() { return $this->id; }
  public function jsonTurno() { return $this->turno; }
  public function jsonDivision() { return $this->division; }
  public function jsonComentario() { return $this->comentario; }
  public function jsonAutorizada() { return $this->autorizada; }
  public function jsonApertura() { return $this->apertura; }
  public function jsonPublicada() { return $this->publicada; }
  public function jsonObservaciones() { return $this->observaciones; }
  public function jsonAlta() { return $this->alta('c'); }
  public function jsonSede() { return $this->sede; }
  public function jsonModalidad() { return $this->modalidad; }
  public function jsonPlanificacion() { return $this->planificacion; }
  public function jsonComisionSiguiente() { return $this->comisionSiguiente; }
  public function jsonCalendario() { return $this->calendario; }



}
