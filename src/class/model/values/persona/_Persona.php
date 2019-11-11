<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _Persona extends EntityValues {
  protected $id = UNDEFINED;
  protected $alta = UNDEFINED;
  protected $baja = UNDEFINED;
  protected $lugarNacimiento = UNDEFINED;
  protected $idPersona = UNDEFINED;
  protected $domicilio = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setAlta(DEFAULT_VALUE);
    $this->setBaja(DEFAULT_VALUE);
    $this->setLugarNacimiento(DEFAULT_VALUE);
    $this->setIdPersona(DEFAULT_VALUE);
    $this->setDomicilio(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."alta"])) $this->setAlta($row[$p."alta"]);
    if(isset($row[$p."baja"])) $this->setBaja($row[$p."baja"]);
    if(isset($row[$p."lugar_nacimiento"])) $this->setLugarNacimiento($row[$p."lugar_nacimiento"]);
    if(isset($row[$p."id_persona"])) $this->setIdPersona($row[$p."id_persona"]);
    if(isset($row[$p."domicilio"])) $this->setDomicilio($row[$p."domicilio"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id("");
    if($this->alta !== UNDEFINED) $row["alta"] = $this->alta("Y-m-d h:i:s");
    if($this->baja !== UNDEFINED) $row["baja"] = $this->baja("Y-m-d h:i:s");
    if($this->lugarNacimiento !== UNDEFINED) $row["lugar_nacimiento"] = $this->lugarNacimiento("");
    if($this->idPersona !== UNDEFINED) $row["id_persona"] = $this->idPersona("");
    if($this->domicilio !== UNDEFINED) $row["domicilio"] = $this->domicilio("");
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->alta)) return false;
    if(!Validation::is_empty($this->baja)) return false;
    if(!Validation::is_empty($this->lugarNacimiento)) return false;
    if(!Validation::is_empty($this->idPersona)) return false;
    if(!Validation::is_empty($this->domicilio)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function alta($format = null) { return Format::date($this->alta, $format); }
  public function baja($format = null) { return Format::date($this->baja, $format); }
  public function lugarNacimiento() { return $this->lugarNacimiento; }
  public function idPersona() { return $this->idPersona; }
  public function domicilio() { return $this->domicilio; }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkId($p)) $this->id = $p;
  }

  public function _setAlta(DateTime $p = null) {
      if($this->checkAlta($p)) $this->alta = $p;  
  }

  public function setAlta($p, $format = "Y-m-d H:i:s") {
    $p = ($p == DEFAULT_VALUE) ? date('Y-m-d H:i:s') : trim($p);
    if(is_null($p)) $p = null;
    else $p = SpanishDateTime::createFromFormat($format, $p);
    if($this->checkAlta($p)) $this->alta = $p;
  }

  public function _setBaja(DateTime $p = null) {
      if($this->checkBaja($p)) $this->baja = $p;  
  }

  public function setBaja($p, $format = "Y-m-d H:i:s") {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    if(is_null($p)) $p = null;
    else $p = SpanishDateTime::createFromFormat($format, $p);
    if($this->checkBaja($p)) $this->baja = $p;
  }

  public function setLugarNacimiento($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkLugarNacimiento($p)) $this->lugarNacimiento = $p;
  }

  public function setIdPersona($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkIdPersona($p)) $this->idPersona = $p;
  }

  public function setDomicilio($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkDomicilio($p)) $this->domicilio = $p;
  }

  public function checkId($value) { 
      return true; 
  }

  public function checkAlta($value) { 
    $v = Validation::getInstanceValue($value)->date()->required();
    return $this->_setLogsValidation("alta", $v);
  }

  public function checkBaja($value) { 
    $v = Validation::getInstanceValue($value)->date();
    return $this->_setLogsValidation("baja", $v);
  }

  public function checkLugarNacimiento($value) { 
    $v = Validation::getInstanceValue($value)->integer();
    return $this->_setLogsValidation("lugar_nacimiento", $v);
  }

  public function checkIdPersona($value) { 
    $v = Validation::getInstanceValue($value)->integer()->required();
    return $this->_setLogsValidation("id_persona", $v);
  }

  public function checkDomicilio($value) { 
    $v = Validation::getInstanceValue($value)->integer();
    return $this->_setLogsValidation("domicilio", $v);
  }



}
