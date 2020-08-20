<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _Sede extends EntityValues {
  protected $id = UNDEFINED;
  protected $numero = UNDEFINED;
  protected $nombre = UNDEFINED;
  protected $observaciones = UNDEFINED;
  protected $alta = UNDEFINED;
  protected $baja = UNDEFINED;
  protected $domicilio = UNDEFINED;
  protected $tipoSede = UNDEFINED;
  protected $centroEducativo = UNDEFINED;
  protected $coordinador = UNDEFINED;

  public function _setDefault(){
    if($this->id == UNDEFINED) $this->setId(null);
    if($this->numero == UNDEFINED) $this->setNumero(null);
    if($this->nombre == UNDEFINED) $this->setNombre(null);
    if($this->observaciones == UNDEFINED) $this->setObservaciones(null);
    if($this->alta == UNDEFINED) $this->setAlta(date('c'));
    if($this->baja == UNDEFINED) $this->setBaja(null);
    if($this->domicilio == UNDEFINED) $this->setDomicilio(null);
    if($this->tipoSede == UNDEFINED) $this->setTipoSede(null);
    if($this->centroEducativo == UNDEFINED) $this->setCentroEducativo(null);
    if($this->coordinador == UNDEFINED) $this->setCoordinador(null);
    return $this;
  }

  public function _fromArray(array $row = NULL, string $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."numero"])) $this->setNumero($row[$p."numero"]);
    if(isset($row[$p."nombre"])) $this->setNombre($row[$p."nombre"]);
    if(isset($row[$p."observaciones"])) $this->setObservaciones($row[$p."observaciones"]);
    if(isset($row[$p."alta"])) $this->setAlta($row[$p."alta"]);
    if(isset($row[$p."baja"])) $this->setBaja($row[$p."baja"]);
    if(isset($row[$p."domicilio"])) $this->setDomicilio($row[$p."domicilio"]);
    if(isset($row[$p."tipo_sede"])) $this->setTipoSede($row[$p."tipo_sede"]);
    if(isset($row[$p."centro_educativo"])) $this->setCentroEducativo($row[$p."centro_educativo"]);
    if(isset($row[$p."coordinador"])) $this->setCoordinador($row[$p."coordinador"]);
    return $this;
  }

  public function _toArray(string $p = ""){
    $row = [];
    if($this->id !== UNDEFINED) $row[$p."id"] = $this->id();
    if($this->numero !== UNDEFINED) $row[$p."numero"] = $this->numero();
    if($this->nombre !== UNDEFINED) $row[$p."nombre"] = $this->nombre();
    if($this->observaciones !== UNDEFINED) $row[$p."observaciones"] = $this->observaciones();
    if($this->alta !== UNDEFINED) $row[$p."alta"] = $this->alta("c");
    if($this->baja !== UNDEFINED) $row[$p."baja"] = $this->baja("c");
    if($this->domicilio !== UNDEFINED) $row[$p."domicilio"] = $this->domicilio();
    if($this->tipoSede !== UNDEFINED) $row[$p."tipo_sede"] = $this->tipoSede();
    if($this->centroEducativo !== UNDEFINED) $row[$p."centro_educativo"] = $this->centroEducativo();
    if($this->coordinador !== UNDEFINED) $row[$p."coordinador"] = $this->coordinador();
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->numero)) return false;
    if(!Validation::is_empty($this->nombre)) return false;
    if(!Validation::is_empty($this->observaciones)) return false;
    if(!Validation::is_empty($this->alta)) return false;
    if(!Validation::is_empty($this->baja)) return false;
    if(!Validation::is_empty($this->domicilio)) return false;
    if(!Validation::is_empty($this->tipoSede)) return false;
    if(!Validation::is_empty($this->centroEducativo)) return false;
    if(!Validation::is_empty($this->coordinador)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function numero($format = null) { return Format::convertCase($this->numero, $format); }
  public function nombre($format = null) { return Format::convertCase($this->nombre, $format); }
  public function observaciones($format = null) { return Format::convertCase($this->observaciones, $format); }
  public function alta($format = null) { return Format::date($this->alta, $format); }
  public function baja($format = null) { return Format::date($this->baja, $format); }
  public function domicilio($format = null) { return Format::convertCase($this->domicilio, $format); }
  public function tipoSede($format = null) { return Format::convertCase($this->tipoSede, $format); }
  public function centroEducativo($format = null) { return Format::convertCase($this->centroEducativo, $format); }
  public function coordinador() { return $this->coordinador; }

  public function setId($p) { $this->id = (is_null($p)) ? null : (string)$p; }
  public function setNumero($p) { $this->numero = (is_null($p)) ? null : (string)$p; }
  public function setNombre($p) { $this->nombre = (is_null($p)) ? null : (string)$p; }
  public function setObservaciones($p) { $this->observaciones = (is_null($p)) ? null : (string)$p; }
  public function _setAlta(DateTime $p = null) { $this->alta = $p; }

  public function setAlta($p) {
    if(!is_null($p)) {
      $p = new SpanishDateTime($p);    
      if($p) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    }
    $this->alta = $p;  
  }

  public function _setBaja(DateTime $p = null) { $this->baja = $p; }

  public function setBaja($p) {
    if(!is_null($p)) {
      $p = new SpanishDateTime($p);    
      if($p) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    }
    $this->baja = $p;  
  }

  public function setDomicilio($p) { $this->domicilio = (is_null($p)) ? null : (string)$p; }
  public function setTipoSede($p) { $this->tipoSede = (is_null($p)) ? null : (string)$p; }
  public function setCentroEducativo($p) { $this->centroEducativo = (is_null($p)) ? null : (string)$p; }
  public function setCoordinador($p) { $this->coordinador = (is_null($p)) ? null : (string)$p; }

  public function resetNumero() { if(!Validation::is_empty($this->numero)) $this->numero = preg_replace('/\s\s+/', ' ', trim($this->numero)); }
  public function resetNombre() { if(!Validation::is_empty($this->nombre)) $this->nombre = preg_replace('/\s\s+/', ' ', trim($this->nombre)); }
  public function resetObservaciones() { if(!Validation::is_empty($this->observaciones)) $this->observaciones = preg_replace('/\s\s+/', ' ', trim($this->observaciones)); }

  public function checkId($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkNumero($value) { 
    $this->_logs->resetLogs("numero");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("numero", "error", $error); }
    return $v->isSuccess();
  }

  public function checkNombre($value) { 
    $this->_logs->resetLogs("nombre");
    if(Validation::is_undefined($value)) return null;
    $v = Validation::getInstanceValue($value)->required();
    foreach($v->getErrors() as $error){ $this->_logs->addLog("nombre", "error", $error); }
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

  public function checkBaja($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkDomicilio($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkTipoSede($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkCentroEducativo($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function checkCoordinador($value) { 
      if(Validation::is_undefined($value)) return null;
      return true; 
  }

  public function _check(){
    $this->checkId($this->id);
    $this->checkNumero($this->numero);
    $this->checkNombre($this->nombre);
    $this->checkObservaciones($this->observaciones);
    $this->checkAlta($this->alta);
    $this->checkBaja($this->baja);
    $this->checkDomicilio($this->domicilio);
    $this->checkTipoSede($this->tipoSede);
    $this->checkCentroEducativo($this->centroEducativo);
    $this->checkCoordinador($this->coordinador);
    return !$this->_getLogs()->isError();
  }

  public function _reset(){
    $this->resetNumero();
    $this->resetNombre();
    $this->resetObservaciones();
    return $this;
  }



}
