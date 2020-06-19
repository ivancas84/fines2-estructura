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
    $this->setId(DEFAULT_VALUE);
    $this->setTurno(DEFAULT_VALUE);
    $this->setDivision(DEFAULT_VALUE);
    $this->setComentario(DEFAULT_VALUE);
    $this->setAutorizada(DEFAULT_VALUE);
    $this->setApertura(DEFAULT_VALUE);
    $this->setPublicada(DEFAULT_VALUE);
    $this->setObservaciones(DEFAULT_VALUE);
    $this->setAlta(DEFAULT_VALUE);
    $this->setSede(DEFAULT_VALUE);
    $this->setModalidad(DEFAULT_VALUE);
    $this->setPlanificacion(DEFAULT_VALUE);
    $this->setComisionSiguiente(DEFAULT_VALUE);
    $this->setCalendario(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
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
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id();
    if($this->turno !== UNDEFINED) $row["turno"] = $this->turno();
    if($this->division !== UNDEFINED) $row["division"] = $this->division();
    if($this->comentario !== UNDEFINED) $row["comentario"] = $this->comentario();
    if($this->autorizada !== UNDEFINED) $row["autorizada"] = $this->autorizada();
    if($this->apertura !== UNDEFINED) $row["apertura"] = $this->apertura();
    if($this->publicada !== UNDEFINED) $row["publicada"] = $this->publicada();
    if($this->observaciones !== UNDEFINED) $row["observaciones"] = $this->observaciones();
    if($this->alta !== UNDEFINED) $row["alta"] = $this->alta("Y-m-d H:i:s");
    if($this->sede !== UNDEFINED) $row["sede"] = $this->sede();
    if($this->modalidad !== UNDEFINED) $row["modalidad"] = $this->modalidad();
    if($this->planificacion !== UNDEFINED) $row["planificacion"] = $this->planificacion();
    if($this->comisionSiguiente !== UNDEFINED) $row["comision_siguiente"] = $this->comisionSiguiente();
    if($this->calendario !== UNDEFINED) $row["calendario"] = $this->calendario();
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
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkId($p); 
    if($check) $this->id = $p;
    return $check;
  }

  public function setTurno($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkTurno($p); 
    if($check) $this->turno = $p;
    return $check;
  }

  public function setDivision($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkDivision($p); 
    if($check) $this->division = $p;
    return $check;
  }

  public function setComentario($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkComentario($p); 
    if($check) $this->comentario = $p;
    return $check;
  }

  public function setAutorizada($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $p = (is_null($p)) ? null : settypebool(trim($p));
    $check = $this->checkAutorizada($p); 
    if($check) $this->autorizada = $p;
    return $check;
  }

  public function setApertura($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $p = (is_null($p)) ? null : settypebool(trim($p));
    $check = $this->checkApertura($p); 
    if($check) $this->apertura = $p;
    return $check;
  }

  public function setPublicada($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $p = (is_null($p)) ? null : settypebool(trim($p));
    $check = $this->checkPublicada($p); 
    if($check) $this->publicada = $p;
    return $check;
  }

  public function setObservaciones($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkObservaciones($p); 
    if($check) $this->observaciones = $p;
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

  public function setSede($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkSede($p); 
    if($check) $this->sede = $p;
    return $check;
  }

  public function setModalidad($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkModalidad($p); 
    if($check) $this->modalidad = $p;
    return $check;
  }

  public function setPlanificacion($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkPlanificacion($p); 
    if($check) $this->planificacion = $p;
    return $check;
  }

  public function setComisionSiguiente($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkComisionSiguiente($p); 
    if($check) $this->comisionSiguiente = $p;
    return $check;
  }

  public function setCalendario($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkCalendario($p); 
    if($check) $this->calendario = $p;
    return $check;
  }

  public function checkId($value) { 
      return true; 
  }

  public function checkTurno($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("turno", $v);
  }

  public function checkDivision($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("division", $v);
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

  public function checkPublicada($value) { 
    $v = Validation::getInstanceValue($value)->boolean()->required();
    return $this->_setLogsValidation("publicada", $v);
  }

  public function checkObservaciones($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("observaciones", $v);
  }

  public function checkAlta($value) { 
    $v = Validation::getInstanceValue($value)->date()->required();
    return $this->_setLogsValidation("alta", $v);
  }

  public function checkSede($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("sede", $v);
  }

  public function checkModalidad($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("modalidad", $v);
  }

  public function checkPlanificacion($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("planificacion", $v);
  }

  public function checkComisionSiguiente($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("comision_siguiente", $v);
  }

  public function checkCalendario($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("calendario", $v);
  }



}
