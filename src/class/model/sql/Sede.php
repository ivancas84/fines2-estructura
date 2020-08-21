<?php

require_once("class/model/sql/_Sede.php");

class SedeSql extends _SedeSql {

  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();
    if($f = parent::_mappingField($field)) return $f;
    switch ($field) {
      case $p.'numero_trim': return "TRIM(LEADING 0 FROM {$t}.numero)";
      default: return null;
    }
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();
    $f = $this->_mappingField($field);
    switch ($field) {
      case $p.'numero_trim': return $this->format->conditionText($f, $value, $option);
      default: return parent::_conditionFieldStruct($field, $option, $value);
    }
  }

}
