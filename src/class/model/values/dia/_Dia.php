<?php

require_once("class/Format.php");
require_once("class/model/Values.php");

class _Dia extends EntityValues {
  protected $id = UNDEFINED;
  protected $numero = UNDEFINED;
  protected $dia = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setNumero(DEFAULT_VALUE);
    $this->setDia(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."numero"])) $this->setNumero($row[$p."numero"]);
    if(isset($row[$p."dia"])) $this->setDia($row[$p."dia"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id("");
    if($this->numero !== UNDEFINED) $row["numero"] = $this->numero("");
    if($this->dia !== UNDEFINED) $row["dia"] = $this->dia("");
    return $row;
  }

  public function _isEmpty(){
    if(!Validation::is_empty($this->id)) return false;
    if(!Validation::is_empty($this->numero)) return false;
    if(!Validation::is_empty($this->dia)) return false;
    return true;
  }

  public function id() { return $this->id; }
  public function numero() { return $this->numero; }
  public function dia($format = null) { return Format::convertCase($this->dia, $format); }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkId($p)) $this->id = $p;
  }

  public function setNumero($p) {
    if ($p == DEFAULT_VALUE) $p = null;
    (is_null($p)) ? null : intval(trim($p));
    if($this->checkNumero($p)) $this->numero = $p;
  }

  public function setDia($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $p = (is_null($p)) ? null : (string)$p;
    if($this->checkDia($p)) $this->dia = $p;
  }

  public function checkId($value) { 
      return true; 
  }

  public function checkNumero($value) { 
    $v = Validation::getInstanceValue($value)->integer()->required();
    return $this->_setLogsValidation("numero", $v);
  }

  public function checkDia($value) { 
    $v = Validation::getInstanceValue($value)->string()->required();
    return $this->_setLogsValidation("dia", $v);
  }



}
