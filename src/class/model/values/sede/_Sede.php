<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _Sede extends EntityValues {
  protected $id = UNDEFINED;
  protected $numero = UNDEFINED;
  protected $nombre = UNDEFINED;
  protected $observaciones = UNDEFINED;
  protected $baja = UNDEFINED;
  protected $domicilio = UNDEFINED;
  protected $tipoSede = UNDEFINED;
  protected $centroEducativo = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setNumero(DEFAULT_VALUE);
    $this->setNombre(DEFAULT_VALUE);
    $this->setObservaciones(DEFAULT_VALUE);
    $this->setBaja(DEFAULT_VALUE);
    $this->setDomicilio(DEFAULT_VALUE);
    $this->setTipoSede(DEFAULT_VALUE);
    $this->setCentroEducativo(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."numero"])) $this->setNumero($row[$p."numero"]);
    if(isset($row[$p."nombre"])) $this->setNombre($row[$p."nombre"]);
    if(isset($row[$p."observaciones"])) $this->setObservaciones($row[$p."observaciones"]);
    if(isset($row[$p."baja"])) $this->setBaja($row[$p."baja"]);
    if(isset($row[$p."domicilio"])) $this->setDomicilio($row[$p."domicilio"]);
    if(isset($row[$p."tipo_sede"])) $this->setTipoSede($row[$p."tipo_sede"]);
    if(isset($row[$p."centro_educativo"])) $this->setCentroEducativo($row[$p."centro_educativo"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id("");
    if($this->numero !== UNDEFINED) $row["numero"] = $this->numero("");
    if($this->nombre !== UNDEFINED) $row["nombre"] = $this->nombre("");
    if($this->observaciones !== UNDEFINED) $row["observaciones"] = $this->observaciones("");
    if($this->baja !== UNDEFINED) $row["baja"] = $this->baja("Y-m-d h:i:s");
    if($this->domicilio !== UNDEFINED) $row["domicilio"] = $this->domicilio("");
    if($this->tipoSede !== UNDEFINED) $row["tipo_sede"] = $this->tipoSede("");
    if($this->centroEducativo !== UNDEFINED) $row["centro_educativo"] = $this->centroEducativo("");
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->numero)) return false;
    if(!Validation::is_empty($this->nombre)) return false;
    if(!Validation::is_empty($this->observaciones)) return false;
    if(!Validation::is_empty($this->baja)) return false;
    if(!Validation::is_empty($this->domicilio)) return false;
    if(!Validation::is_empty($this->tipoSede)) return false;
    if(!Validation::is_empty($this->centroEducativo)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function numero($format = null) { return Format::convertCase($this->numero, $format); }
  public function nombre($format = null) { return Format::convertCase($this->nombre, $format); }
  public function observaciones($format = null) { return Format::convertCase($this->observaciones, $format); }
  public function baja($format = null) { return Format::date($this->baja, $format); }
  public function domicilio($format = null) { return Format::convertCase($this->domicilio, $format); }
  public function tipoSede($format = null) { return Format::convertCase($this->tipoSede, $format); }
  public function centroEducativo($format = null) { return Format::convertCase($this->centroEducativo, $format); }
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

  public function setObservaciones($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkObservaciones($p)) $this->observaciones = $p;
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

  public function setDomicilio($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkDomicilio($p)) $this->domicilio = $p;
  }

  public function setTipoSede($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkTipoSede($p)) $this->tipoSede = $p;
  }

  public function setCentroEducativo($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkCentroEducativo($p)) $this->centroEducativo = $p;
  }

  public function checkId($value) { 
      return true; 
  }

  public function checkNumero($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("numero", $v);
  }

  public function checkNombre($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("nombre", $v);
  }

  public function checkObservaciones($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("observaciones", $v);
  }

  public function checkBaja($value) { 
    $v = Validation::getInstanceValue($value)->date();
    return $this->_setLogsValidation("baja", $v);
  }

  public function checkDomicilio($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("domicilio", $v);
  }

  public function checkTipoSede($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("tipo_sede", $v);
  }

  public function checkCentroEducativo($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("centro_educativo", $v);
  }



}
