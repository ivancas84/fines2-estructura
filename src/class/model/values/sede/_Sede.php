<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _Sede extends EntityValues {
  protected $id = UNDEFINED;
  protected $numero = UNDEFINED;
  protected $nombre = UNDEFINED;
  protected $organizacion = UNDEFINED;
  protected $observaciones = UNDEFINED;
  protected $tipo = UNDEFINED;
  protected $baja = UNDEFINED;
  protected $dependencia = UNDEFINED;
  protected $tipoSede = UNDEFINED;
  protected $domicilio = UNDEFINED;
  protected $coordinador = UNDEFINED;
  protected $referente = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setNumero(DEFAULT_VALUE);
    $this->setNombre(DEFAULT_VALUE);
    $this->setOrganizacion(DEFAULT_VALUE);
    $this->setObservaciones(DEFAULT_VALUE);
    $this->setTipo(DEFAULT_VALUE);
    $this->setBaja(DEFAULT_VALUE);
    $this->setDependencia(DEFAULT_VALUE);
    $this->setTipoSede(DEFAULT_VALUE);
    $this->setDomicilio(DEFAULT_VALUE);
    $this->setCoordinador(DEFAULT_VALUE);
    $this->setReferente(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."numero"])) $this->setNumero($row[$p."numero"]);
    if(isset($row[$p."nombre"])) $this->setNombre($row[$p."nombre"]);
    if(isset($row[$p."organizacion"])) $this->setOrganizacion($row[$p."organizacion"]);
    if(isset($row[$p."observaciones"])) $this->setObservaciones($row[$p."observaciones"]);
    if(isset($row[$p."tipo"])) $this->setTipo($row[$p."tipo"]);
    if(isset($row[$p."baja"])) $this->setBaja($row[$p."baja"]);
    if(isset($row[$p."dependencia"])) $this->setDependencia($row[$p."dependencia"]);
    if(isset($row[$p."tipo_sede"])) $this->setTipoSede($row[$p."tipo_sede"]);
    if(isset($row[$p."domicilio"])) $this->setDomicilio($row[$p."domicilio"]);
    if(isset($row[$p."coordinador"])) $this->setCoordinador($row[$p."coordinador"]);
    if(isset($row[$p."referente"])) $this->setReferente($row[$p."referente"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id("");
    if($this->numero !== UNDEFINED) $row["numero"] = $this->numero("");
    if($this->nombre !== UNDEFINED) $row["nombre"] = $this->nombre("");
    if($this->organizacion !== UNDEFINED) $row["organizacion"] = $this->organizacion("");
    if($this->observaciones !== UNDEFINED) $row["observaciones"] = $this->observaciones("");
    if($this->tipo !== UNDEFINED) $row["tipo"] = $this->tipo("");
    if($this->baja !== UNDEFINED) $row["baja"] = $this->baja("Y-m-d h:i:s");
    if($this->dependencia !== UNDEFINED) $row["dependencia"] = $this->dependencia("");
    if($this->tipoSede !== UNDEFINED) $row["tipo_sede"] = $this->tipoSede("");
    if($this->domicilio !== UNDEFINED) $row["domicilio"] = $this->domicilio("");
    if($this->coordinador !== UNDEFINED) $row["coordinador"] = $this->coordinador("");
    if($this->referente !== UNDEFINED) $row["referente"] = $this->referente("");
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->numero)) return false;
    if(!Validation::is_empty($this->nombre)) return false;
    if(!Validation::is_empty($this->organizacion)) return false;
    if(!Validation::is_empty($this->observaciones)) return false;
    if(!Validation::is_empty($this->tipo)) return false;
    if(!Validation::is_empty($this->baja)) return false;
    if(!Validation::is_empty($this->dependencia)) return false;
    if(!Validation::is_empty($this->tipoSede)) return false;
    if(!Validation::is_empty($this->domicilio)) return false;
    if(!Validation::is_empty($this->coordinador)) return false;
    if(!Validation::is_empty($this->referente)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function numero($format = null) { return Format::convertCase($this->numero, $format); }
  public function nombre($format = null) { return Format::convertCase($this->nombre, $format); }
  public function organizacion($format = null) { return Format::convertCase($this->organizacion, $format); }
  public function observaciones($format = null) { return Format::convertCase($this->observaciones, $format); }
  public function tipo($format = null) { return Format::convertCase($this->tipo, $format); }
  public function baja($format = null) { return Format::date($this->baja, $format); }
  public function dependencia() { return $this->dependencia; }
  public function tipoSede() { return $this->tipoSede; }
  public function domicilio() { return $this->domicilio; }
  public function coordinador() { return $this->coordinador; }
  public function referente() { return $this->referente; }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkId($p)) $this->id = $p;
  }

  public function setNumero($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkNumero($p)) $this->numero = $p;
  }

  public function setNombre($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkNombre($p)) $this->nombre = $p;
  }

  public function setOrganizacion($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkOrganizacion($p)) $this->organizacion = $p;
  }

  public function setObservaciones($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkObservaciones($p)) $this->observaciones = $p;
  }

  public function setTipo($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkTipo($p)) $this->tipo = $p;
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

  public function setDependencia($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $p = (is_null($p)) ? null : intval(trim($p));
    if($this->checkDependencia($p)) $this->dependencia = $p;
  }

  public function setTipoSede($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $p = (is_null($p)) ? null : intval(trim($p));
    if($this->checkTipoSede($p)) $this->tipoSede = $p;
  }

  public function setDomicilio($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $p = (is_null($p)) ? null : intval(trim($p));
    if($this->checkDomicilio($p)) $this->domicilio = $p;
  }

  public function setCoordinador($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $p = (is_null($p)) ? null : intval(trim($p));
    if($this->checkCoordinador($p)) $this->coordinador = $p;
  }

  public function setReferente($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $p = (is_null($p)) ? null : intval(trim($p));
    if($this->checkReferente($p)) $this->referente = $p;
  }

  public function checkId($value) { 
      return true; 
  }

  public function checkNumero($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("numero", $v);
  }

  public function checkNombre($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("nombre", $v);
  }

  public function checkOrganizacion($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("organizacion", $v);
  }

  public function checkObservaciones($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("observaciones", $v);
  }

  public function checkTipo($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("tipo", $v);
  }

  public function checkBaja($value) { 
    $v = Validation::getInstanceValue($value)->date();
    return $this->_setLogsValidation("baja", $v);
  }

  public function checkDependencia($value) { 
    $v = Validation::getInstanceValue($value)->integer();
    return $this->_setLogsValidation("dependencia", $v);
  }

  public function checkTipoSede($value) { 
    $v = Validation::getInstanceValue($value)->integer();
    return $this->_setLogsValidation("tipo_sede", $v);
  }

  public function checkDomicilio($value) { 
    $v = Validation::getInstanceValue($value)->integer();
    return $this->_setLogsValidation("domicilio", $v);
  }

  public function checkCoordinador($value) { 
    $v = Validation::getInstanceValue($value)->integer();
    return $this->_setLogsValidation("coordinador", $v);
  }

  public function checkReferente($value) { 
    $v = Validation::getInstanceValue($value)->integer();
    return $this->_setLogsValidation("referente", $v);
  }



}
