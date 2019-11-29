<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _Division extends EntityValues {
  protected $id = UNDEFINED;
  protected $numero = UNDEFINED;
  protected $serie = UNDEFINED;
  protected $turno = UNDEFINED;
  protected $numero = UNDEFINED;
  protected $plan = UNDEFINED;
  protected $sede = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setNumero(DEFAULT_VALUE);
    $this->setSerie(DEFAULT_VALUE);
    $this->setTurno(DEFAULT_VALUE);
    $this->setNumero(DEFAULT_VALUE);
    $this->setPlan(DEFAULT_VALUE);
    $this->setSede(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."numero"])) $this->setNumero($row[$p."numero"]);
    if(isset($row[$p."serie"])) $this->setSerie($row[$p."serie"]);
    if(isset($row[$p."turno"])) $this->setTurno($row[$p."turno"]);
    if(isset($row[$p."numero"])) $this->setNumero($row[$p."numero"]);
    if(isset($row[$p."plan"])) $this->setPlan($row[$p."plan"]);
    if(isset($row[$p."sede"])) $this->setSede($row[$p."sede"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id("");
    if($this->numero !== UNDEFINED) $row["numero"] = $this->numero("");
    if($this->serie !== UNDEFINED) $row["serie"] = $this->serie("");
    if($this->turno !== UNDEFINED) $row["turno"] = $this->turno("");
    if($this->numero !== UNDEFINED) $row["numero"] = $this->numero("");
    if($this->plan !== UNDEFINED) $row["plan"] = $this->plan("");
    if($this->sede !== UNDEFINED) $row["sede"] = $this->sede("");
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->numero)) return false;
    if(!Validation::is_empty($this->serie)) return false;
    if(!Validation::is_empty($this->turno)) return false;
    if(!Validation::is_empty($this->numero)) return false;
    if(!Validation::is_empty($this->plan)) return false;
    if(!Validation::is_empty($this->sede)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function numero($format = null) { return Format::convertCase($this->numero, $format); }
  public function serie($format = null) { return Format::convertCase($this->serie, $format); }
  public function turno($format = null) { return Format::convertCase($this->turno, $format); }
  public function numero($format = null) { return Format::convertCase($this->numero, $format); }
  public function plan() { return $this->plan; }
  public function sede() { return $this->sede; }
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

  public function setSerie($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkSerie($p)) $this->serie = $p;
  }

  public function setTurno($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkTurno($p)) $this->turno = $p;
  }

  public function setNumero($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkNumero($p)) $this->numero = $p;
  }

  public function setPlan($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $p = (is_null($p)) ? null : intval(trim($p));
    if($this->checkPlan($p)) $this->plan = $p;
  }

  public function setSede($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $p = (is_null($p)) ? null : intval(trim($p));
    if($this->checkSede($p)) $this->sede = $p;
  }

  public function checkId($value) { 
      return true; 
  }

  public function checkNumero($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("numero", $v);
  }

  public function checkSerie($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("serie", $v);
  }

  public function checkTurno($value) { 
    $v = Validation::getInstanceValue($value)->string();
    return $this->_setLogsValidation("turno", $v);
  }

  public function checkNumero($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("numero", $v);
  }

  public function checkPlan($value) { 
    $v = Validation::getInstanceValue($value)->integer()->required();
    return $this->_setLogsValidation("plan", $v);
  }

  public function checkSede($value) { 
    $v = Validation::getInstanceValue($value)->integer()->required();
    return $this->_setLogsValidation("sede", $v);
  }



}
