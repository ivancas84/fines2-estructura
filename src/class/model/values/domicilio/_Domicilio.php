<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _Domicilio extends EntityValues {
  protected $id = UNDEFINED;
  protected $calle = UNDEFINED;
  protected $entre = UNDEFINED;
  protected $numero = UNDEFINED;
  protected $piso = UNDEFINED;
  protected $departamento = UNDEFINED;
  protected $barrio = UNDEFINED;
  protected $localidad = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setCalle(DEFAULT_VALUE);
    $this->setEntre(DEFAULT_VALUE);
    $this->setNumero(DEFAULT_VALUE);
    $this->setPiso(DEFAULT_VALUE);
    $this->setDepartamento(DEFAULT_VALUE);
    $this->setBarrio(DEFAULT_VALUE);
    $this->setLocalidad(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."calle"])) $this->setCalle($row[$p."calle"]);
    if(isset($row[$p."entre"])) $this->setEntre($row[$p."entre"]);
    if(isset($row[$p."numero"])) $this->setNumero($row[$p."numero"]);
    if(isset($row[$p."piso"])) $this->setPiso($row[$p."piso"]);
    if(isset($row[$p."departamento"])) $this->setDepartamento($row[$p."departamento"]);
    if(isset($row[$p."barrio"])) $this->setBarrio($row[$p."barrio"]);
    if(isset($row[$p."localidad"])) $this->setLocalidad($row[$p."localidad"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id("");
    if($this->calle !== UNDEFINED) $row["calle"] = $this->calle("");
    if($this->entre !== UNDEFINED) $row["entre"] = $this->entre("");
    if($this->numero !== UNDEFINED) $row["numero"] = $this->numero("");
    if($this->piso !== UNDEFINED) $row["piso"] = $this->piso("");
    if($this->departamento !== UNDEFINED) $row["departamento"] = $this->departamento("");
    if($this->barrio !== UNDEFINED) $row["barrio"] = $this->barrio("");
    if($this->localidad !== UNDEFINED) $row["localidad"] = $this->localidad("");
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->calle)) return false;
    if(!Validation::is_empty($this->entre)) return false;
    if(!Validation::is_empty($this->numero)) return false;
    if(!Validation::is_empty($this->piso)) return false;
    if(!Validation::is_empty($this->departamento)) return false;
    if(!Validation::is_empty($this->barrio)) return false;
    if(!Validation::is_empty($this->localidad)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function calle($format = null) { return Format::convertCase($this->calle, $format); }
  public function entre($format = null) { return Format::convertCase($this->entre, $format); }
  public function numero($format = null) { return Format::convertCase($this->numero, $format); }
  public function piso($format = null) { return Format::convertCase($this->piso, $format); }
  public function departamento($format = null) { return Format::convertCase($this->departamento, $format); }
  public function barrio($format = null) { return Format::convertCase($this->barrio, $format); }
  public function localidad($format = null) { return Format::convertCase($this->localidad, $format); }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkId($p)) $this->id = $p;
  }

  public function setCalle($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkCalle($p)) $this->calle = $p;
  }

  public function setEntre($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkEntre($p)) $this->entre = $p;
  }

  public function setNumero($p) {
    $p = ($p == DEFAULT_VALUE) ? 'S/N' : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkNumero($p)) $this->numero = $p;
  }

  public function setPiso($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkPiso($p)) $this->piso = $p;
  }

  public function setDepartamento($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkDepartamento($p)) $this->departamento = $p;
  }

  public function setBarrio($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkBarrio($p)) $this->barrio = $p;
  }

  public function setLocalidad($p) {
    $p = ($p == DEFAULT_VALUE) ? 'La Plata' : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkLocalidad($p)) $this->localidad = $p;
  }

  public function checkId($value) { 
      return true; 
  }

  public function checkCalle($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("calle", $v);
  }

  public function checkEntre($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("entre", $v);
  }

  public function checkNumero($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("numero", $v);
  }

  public function checkPiso($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("piso", $v);
  }

  public function checkDepartamento($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("departamento", $v);
  }

  public function checkBarrio($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("barrio", $v);
  }

  public function checkLocalidad($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("localidad", $v);
  }



}
