<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _Comision extends EntityValues {
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

  public function _setDefault(){
    if($this->id == UNDEFINED) $this->setId(null);
    if($this->turno == UNDEFINED) $this->setTurno(null);
    if($this->division == UNDEFINED) $this->setDivision(null);
    if($this->comentario == UNDEFINED) $this->setComentario(null);
    if($this->autorizada == UNDEFINED) $this->setAutorizada(null);
    if($this->apertura == UNDEFINED) $this->setApertura(null);
    if($this->publicada == UNDEFINED) $this->setPublicada(null);
    if($this->observaciones == UNDEFINED) $this->setObservaciones(null);
    if($this->alta == UNDEFINED) $this->setAlta(date('c'));
    if($this->sede == UNDEFINED) $this->setSede(null);
    if($this->modalidad == UNDEFINED) $this->setModalidad(null);
    if($this->planificacion == UNDEFINED) $this->setPlanificacion(null);
    if($this->comisionSiguiente == UNDEFINED) $this->setComisionSiguiente(null);
    if($this->calendario == UNDEFINED) $this->setCalendario(null);
    return $this;
  }

  public function _fromArray(array $row = NULL, string $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."turno"])) $this->setTurno($row[$p."turno"]);
    if(isset($row[$p."division"])) $this->setDivision($row[$p."division"]);
    if(isset($row[$p."comentario"])) $this->setComentario($row[$p."comentario"]);
    if(isset($row[$p."autorizada"])) $this->setAutorizada($row[$p."autorizada"]);
    if(isset($row[$p."apertura"])) $this->setApertura($row[$p."apertura"]);
    if(isset($row[$p."publicada"])) $this->setPublicada($row[$p."publicada"]);
    if(isset($row[$p."observaciones"])) $this->setObservaciones($row[$p."observaciones"]);
    if(isset($row[$p."alta"])) $this->setAlta($row[$p."alta"]);
    if(isset($row[$p."sede"])) $this->setSede($row[$p."sede"]);
    if(isset($row[$p."modalidad"])) $this->setModalidad($row[$p."modalidad"]);
    if(isset($row[$p."planificacion"])) $this->setPlanificacion($row[$p."planificacion"]);
    if(isset($row[$p."comision_siguiente"])) $this->setComisionSiguiente($row[$p."comision_siguiente"]);
    if(isset($row[$p."calendario"])) $this->setCalendario($row[$p."calendario"]);
    return $this;
  }

  public function _toArray(string $p = ""){
    $row = [];
    if($this->id !== UNDEFINED) $row[$p."id"] = $this->id();
    if($this->turno !== UNDEFINED) $row[$p."turno"] = $this->turno();
    if($this->division !== UNDEFINED) $row[$p."division"] = $this->division();
    if($this->comentario !== UNDEFINED) $row[$p."comentario"] = $this->comentario();
    if($this->autorizada !== UNDEFINED) $row[$p."autorizada"] = $this->autorizada();
    if($this->apertura !== UNDEFINED) $row[$p."apertura"] = $this->apertura();
    if($this->publicada !== UNDEFINED) $row[$p."publicada"] = $this->publicada();
    if($this->observaciones !== UNDEFINED) $row[$p."observaciones"] = $this->observaciones();
    if($this->alta !== UNDEFINED) $row[$p."alta"] = $this->alta("c");
    if($this->sede !== UNDEFINED) $row[$p."sede"] = $this->sede();
    if($this->modalidad !== UNDEFINED) $row[$p."modalidad"] = $this->modalidad();
    if($this->planificacion !== UNDEFINED) $row[$p."planificacion"] = $this->planificacion();
    if($this->comisionSiguiente !== UNDEFINED) $row[$p."comision_siguiente"] = $this->comisionSiguiente();
    if($this->calendario !== UNDEFINED) $row[$p."calendario"] = $this->calendario();
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->turno)) return false;
    if(!Validation::is_empty($this->division)) return false;
    if(!Validation::is_empty($this->comentario)) return false;
    if(!Validation::is_empty($this->autorizada)) return false;
    if(!Validation::is_empty($this->apertura)) return false;
    if(!Validation::is_empty($this->publicada)) return false;
    if(!Validation::is_empty($this->observaciones)) return false;
    if(!Validation::is_empty($this->alta)) return false;
    if(!Validation::is_empty($this->sede)) return false;
    if(!Validation::is_empty($this->modalidad)) return false;
    if(!Validation::is_empty($this->planificacion)) return false;
    if(!Validation::is_empty($this->comisionSiguiente)) return false;
    if(!Validation::is_empty($this->calendario)) return false;
    return true;
  }

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

  public function setId($p) { $this->id = (is_null($p)) ? null : (string)$p; }
  public function setTurno($p) { $this->turno = (is_null($p)) ? null : (string)$p; }
  public function setDivision($p) { $this->division = (is_null($p)) ? null : (string)$p; }
  public function setComentario($p) { $this->comentario = (is_null($p)) ? null : (string)$p; }
  public function setAutorizada($p) { $this->autorizada = settypebool($p); }
  public function setApertura($p) { $this->apertura = settypebool($p); }
  public function setPublicada($p) { $this->publicada = settypebool($p); }
  public function setObservaciones($p) { $this->observaciones = (is_null($p)) ? null : (string)$p; }
  public function _setAlta(DateTime $p = null) { $this->alta = $p; }

  public function setAlta($p) {
    if(!is_null($p)) {
      $p = new SpanishDateTime($p);    
      if($p) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    }
    $this->alta = $p;  
  }

  public function setSede($p) { $this->sede = (is_null($p)) ? null : (string)$p; }
  public function setModalidad($p) { $this->modalidad = (is_null($p)) ? null : (string)$p; }
  public function setPlanificacion($p) { $this->planificacion = (is_null($p)) ? null : (string)$p; }
  public function setComisionSiguiente($p) { $this->comisionSiguiente = (is_null($p)) ? null : (string)$p; }
  public function setCalendario($p) { $this->calendario = (is_null($p)) ? null : (string)$p; }

  public function resetTurno() { if(!Validation::is_empty($this->turno)) $this->turno = preg_replace('/\s\s+/', ' ', trim($this->turno)); }
  public function resetDivision() { if(!Validation::is_empty($this->division)) $this->division = preg_replace('/\s\s+/', ' ', trim($this->division)); }
  public function resetComentario() { if(!Validation::is_empty($this->comentario)) $this->comentario = preg_replace('/\s\s+/', ' ', trim($this->comentario)); }
  public function resetObservaciones() { if(!Validation::is_empty($this->observaciones)) $this->observaciones = preg_replace('/\s\s+/', ' ', trim($this->observaciones)); }

  public function checkId($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkTurno($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkDivision($value) { 
    $this->_logs->resetLogs("division");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("division", "error", $error); }
    return $v->isSuccess();
  }

  public function checkComentario($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkAutorizada($value) { 
    $this->_logs->resetLogs("autorizada");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("autorizada", "error", $error); }
    return $v->isSuccess();
  }

  public function checkApertura($value) { 
    $this->_logs->resetLogs("apertura");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("apertura", "error", $error); }
    return $v->isSuccess();
  }

  public function checkPublicada($value) { 
    $this->_logs->resetLogs("publicada");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("publicada", "error", $error); }
    return $v->isSuccess();
  }

  public function checkObservaciones($value) { 
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

  public function checkSede($value) { 
    $this->_logs->resetLogs("sede");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("sede", "error", $error); }
    return $v->isSuccess();
  }

  public function checkModalidad($value) { 
    $this->_logs->resetLogs("modalidad");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("modalidad", "error", $error); }
    return $v->isSuccess();
  }

  public function checkPlanificacion($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkComisionSiguiente($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkCalendario($value) { 
    $this->_logs->resetLogs("calendario");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("calendario", "error", $error); }
    return $v->isSuccess();
  }

  public function _check(){
    $this->checkId($this->id);
    $this->checkTurno($this->turno);
    $this->checkDivision($this->division);
    $this->checkComentario($this->comentario);
    $this->checkAutorizada($this->autorizada);
    $this->checkApertura($this->apertura);
    $this->checkPublicada($this->publicada);
    $this->checkObservaciones($this->observaciones);
    $this->checkAlta($this->alta);
    $this->checkSede($this->sede);
    $this->checkModalidad($this->modalidad);
    $this->checkPlanificacion($this->planificacion);
    $this->checkComisionSiguiente($this->comisionSiguiente);
    $this->checkCalendario($this->calendario);
    return !$this->_getLogs()->isError();
  }

  public function _reset(){
    $this->resetTurno();
    $this->resetDivision();
    $this->resetComentario();
    $this->resetObservaciones();
    return $this;
  }



}
