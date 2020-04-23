<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _Comision extends EntityValues {
  protected $id = UNDEFINED;
  protected $turno = UNDEFINED;
  protected $division = UNDEFINED;
  protected $anio = UNDEFINED;
  protected $semestre = UNDEFINED;
  protected $comentario = UNDEFINED;
  protected $autorizada = UNDEFINED;
  protected $apertura = UNDEFINED;
  protected $publicada = UNDEFINED;
  protected $fechaAnio = UNDEFINED;
  protected $fechaSemestre = UNDEFINED;
  protected $observaciones = UNDEFINED;
  protected $alta = UNDEFINED;
  protected $sede = UNDEFINED;
  protected $plan = UNDEFINED;
  protected $modalidad = UNDEFINED;
  protected $comisionSiguiente = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setTurno(DEFAULT_VALUE);
    $this->setDivision(DEFAULT_VALUE);
    $this->setAnio(DEFAULT_VALUE);
    $this->setSemestre(DEFAULT_VALUE);
    $this->setComentario(DEFAULT_VALUE);
    $this->setAutorizada(DEFAULT_VALUE);
    $this->setApertura(DEFAULT_VALUE);
    $this->setPublicada(DEFAULT_VALUE);
    $this->setFechaAnio(DEFAULT_VALUE);
    $this->setFechaSemestre(DEFAULT_VALUE);
    $this->setObservaciones(DEFAULT_VALUE);
    $this->setAlta(DEFAULT_VALUE);
    $this->setSede(DEFAULT_VALUE);
    $this->setPlan(DEFAULT_VALUE);
    $this->setModalidad(DEFAULT_VALUE);
    $this->setComisionSiguiente(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."turno"])) $this->setTurno($row[$p."turno"]);
    if(isset($row[$p."division"])) $this->setDivision($row[$p."division"]);
    if(isset($row[$p."anio"])) $this->setAnio($row[$p."anio"]);
    if(isset($row[$p."semestre"])) $this->setSemestre($row[$p."semestre"]);
    if(isset($row[$p."comentario"])) $this->setComentario($row[$p."comentario"]);
    if(isset($row[$p."autorizada"])) $this->setAutorizada($row[$p."autorizada"]);
    if(isset($row[$p."apertura"])) $this->setApertura($row[$p."apertura"]);
    if(isset($row[$p."publicada"])) $this->setPublicada($row[$p."publicada"]);
    if(isset($row[$p."fecha_anio"])) $this->setFechaAnio($row[$p."fecha_anio"]);
    if(isset($row[$p."fecha_semestre"])) $this->setFechaSemestre($row[$p."fecha_semestre"]);
    if(isset($row[$p."observaciones"])) $this->setObservaciones($row[$p."observaciones"]);
    if(isset($row[$p."alta"])) $this->setAlta($row[$p."alta"]);
    if(isset($row[$p."sede"])) $this->setSede($row[$p."sede"]);
    if(isset($row[$p."plan"])) $this->setPlan($row[$p."plan"]);
    if(isset($row[$p."modalidad"])) $this->setModalidad($row[$p."modalidad"]);
    if(isset($row[$p."comision_siguiente"])) $this->setComisionSiguiente($row[$p."comision_siguiente"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id();
    if($this->turno !== UNDEFINED) $row["turno"] = $this->turno();
    if($this->division !== UNDEFINED) $row["division"] = $this->division();
    if($this->anio !== UNDEFINED) $row["anio"] = $this->anio();
    if($this->semestre !== UNDEFINED) $row["semestre"] = $this->semestre();
    if($this->comentario !== UNDEFINED) $row["comentario"] = $this->comentario();
    if($this->autorizada !== UNDEFINED) $row["autorizada"] = $this->autorizada();
    if($this->apertura !== UNDEFINED) $row["apertura"] = $this->apertura();
    if($this->publicada !== UNDEFINED) $row["publicada"] = $this->publicada();
    if($this->fechaAnio !== UNDEFINED) $row["fecha_anio"] = $this->fechaAnio("Y");
    if($this->fechaSemestre !== UNDEFINED) $row["fecha_semestre"] = $this->fechaSemestre();
    if($this->observaciones !== UNDEFINED) $row["observaciones"] = $this->observaciones();
    if($this->alta !== UNDEFINED) $row["alta"] = $this->alta("Y-m-d H:i:s");
    if($this->sede !== UNDEFINED) $row["sede"] = $this->sede();
    if($this->plan !== UNDEFINED) $row["plan"] = $this->plan();
    if($this->modalidad !== UNDEFINED) $row["modalidad"] = $this->modalidad();
    if($this->comisionSiguiente !== UNDEFINED) $row["comision_siguiente"] = $this->comisionSiguiente();
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->turno)) return false;
    if(!Validation::is_empty($this->division)) return false;
    if(!Validation::is_empty($this->anio)) return false;
    if(!Validation::is_empty($this->semestre)) return false;
    if(!Validation::is_empty($this->comentario)) return false;
    if(!Validation::is_empty($this->autorizada)) return false;
    if(!Validation::is_empty($this->apertura)) return false;
    if(!Validation::is_empty($this->publicada)) return false;
    if(!Validation::is_empty($this->fechaAnio)) return false;
    if(!Validation::is_empty($this->fechaSemestre)) return false;
    if(!Validation::is_empty($this->observaciones)) return false;
    if(!Validation::is_empty($this->alta)) return false;
    if(!Validation::is_empty($this->sede)) return false;
    if(!Validation::is_empty($this->plan)) return false;
    if(!Validation::is_empty($this->modalidad)) return false;
    if(!Validation::is_empty($this->comisionSiguiente)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function turno($format = null) { return Format::convertCase($this->turno, $format); }
  public function division($format = null) { return Format::convertCase($this->division, $format); }
  public function anio($format = null) { return Format::convertCase($this->anio, $format); }
  public function semestre($format = null) { return Format::convertCase($this->semestre, $format); }
  public function comentario($format = null) { return Format::convertCase($this->comentario, $format); }
  public function autorizada($format = null) { return Format::boolean($this->autorizada, $format); }
  public function apertura($format = null) { return Format::boolean($this->apertura, $format); }
  public function publicada($format = null) { return Format::boolean($this->publicada, $format); }
  public function fechaAnio($format = null) { return Format::date($this->fechaAnio, $format); }
  public function fechaSemestre() { return $this->fechaSemestre; }
  public function observaciones($format = null) { return Format::convertCase($this->observaciones, $format); }
  public function alta($format = null) { return Format::date($this->alta, $format); }
  public function sede($format = null) { return Format::convertCase($this->sede, $format); }
  public function plan($format = null) { return Format::convertCase($this->plan, $format); }
  public function modalidad($format = null) { return Format::convertCase($this->modalidad, $format); }
  public function comisionSiguiente($format = null) { return Format::convertCase($this->comisionSiguiente, $format); }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkId($p); 
    if($check) $this->id = $p;
    return $check;
  }

  public function setTurno($p) {
    $p = ($p == DEFAULT_VALUE) ? 'NULL' : trim($p);
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

  public function setAnio($p) {
    $p = ($p == DEFAULT_VALUE) ? 'NULL' : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkAnio($p); 
    if($check) $this->anio = $p;
    return $check;
  }

  public function setSemestre($p) {
    $p = ($p == DEFAULT_VALUE) ? 'NULL' : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkSemestre($p); 
    if($check) $this->semestre = $p;
    return $check;
  }

  public function setComentario($p) {
    $p = ($p == DEFAULT_VALUE) ? 'NULL' : trim($p);
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

  public function _setFechaAnio(DateTime $p = null) {
      $check = $this->checkFechaAnio($p); 
      if($check) $this->fechaAnio = $p;  
      return $check;
  }

  public function setFechaAnio($p, $format = "Y") {
    $p = ($p == DEFAULT_VALUE) ? 'NULL' : trim($p);
    if(!is_null($p)) $p = SpanishDateTime::createFromFormat($format, $p);    
    $check = $this->checkFechaAnio($p); 
    if($check) $this->fechaAnio = $p;  
    return $check;
  }

  public function setFechaSemestre($p) {
    if ($p == DEFAULT_VALUE) $p = NULL;
    $p = (is_null($p)) ? null : intval(trim($p));
    $check = $this->checkFechaSemestre($p); 
    if($check) $this->fechaSemestre = $p;
    return $check;
  }

  public function setObservaciones($p) {
    $p = ($p == DEFAULT_VALUE) ? 'NULL' : trim($p);
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
    $p = ($p == DEFAULT_VALUE) ? 'current_timestamp()' : trim($p);
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

  public function setPlan($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkPlan($p); 
    if($check) $this->plan = $p;
    return $check;
  }

  public function setModalidad($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkModalidad($p); 
    if($check) $this->modalidad = $p;
    return $check;
  }

  public function setComisionSiguiente($p) {
    $p = ($p == DEFAULT_VALUE) ? 'NULL' : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    $check = $this->checkComisionSiguiente($p); 
    if($check) $this->comisionSiguiente = $p;
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

  public function checkAnio($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("anio", $v);
  }

  public function checkSemestre($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("semestre", $v);
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

  public function checkFechaAnio($value) { 
    $v = Validation::getInstanceValue($value)->date();
    return $this->_setLogsValidation("fecha_anio", $v);
  }

  public function checkFechaSemestre($value) { 
    $v = Validation::getInstanceValue($value)->integer();
    return $this->_setLogsValidation("fecha_semestre", $v);
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

  public function checkPlan($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("plan", $v);
  }

  public function checkModalidad($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("modalidad", $v);
  }

  public function checkComisionSiguiente($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("comision_siguiente", $v);
  }



}
