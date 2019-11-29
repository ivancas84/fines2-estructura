<?php

require_once("class/tools/Format.php");
require_once("class/model/Values.php");

class _ClasificacionPlan extends EntityValues {
  protected $id = UNDEFINED;
  protected $clasificacion = UNDEFINED;
  protected $plan = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setClasificacion(DEFAULT_VALUE);
    $this->setPlan(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."clasificacion"])) $this->setClasificacion($row[$p."clasificacion"]);
    if(isset($row[$p."plan"])) $this->setPlan($row[$p."plan"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id("");
    if($this->clasificacion !== UNDEFINED) $row["clasificacion"] = $this->clasificacion("");
    if($this->plan !== UNDEFINED) $row["plan"] = $this->plan("");
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->clasificacion)) return false;
    if(!Validation::is_empty($this->plan)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function clasificacion() { return $this->clasificacion; }
  public function plan() { return $this->plan; }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkId($p)) $this->id = $p;
  }

  public function setClasificacion($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $p = (is_null($p)) ? null : intval(trim($p));
    if($this->checkClasificacion($p)) $this->clasificacion = $p;
  }

  public function setPlan($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    $p = (is_null($p)) ? null : intval(trim($p));
    if($this->checkPlan($p)) $this->plan = $p;
  }

  public function checkId($value) { 
      return true; 
  }

  public function checkClasificacion($value) { 
    $v = Validation::getInstanceValue($value)->integer()->required();
    return $this->_setLogsValidation("clasificacion", $v);
  }

  public function checkPlan($value) { 
    $v = Validation::getInstanceValue($value)->integer()->required();
    return $this->_setLogsValidation("plan", $v);
  }



}
