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

  public function _subSql(Render $render) {
    $t = $this->prt();
    return "(
      
SELECT * FROM (
        
SELECT DISTINCT {$this->_fieldsDb()}, coordinador.persona AS coordinador
{$this->_from($render)}
    LEFT OUTER JOIN (
        SELECT MIN(designacion.persona) AS persona, designacion.sede
        FROM designacion
        INNER JOIN cargo ON (designacion.cargo = cargo.id)
        WHERE hasta IS NULL
        AND lower(cargo.descripcion) = 'coordinador'
        GROUP BY designacion.sede
    ) AS coordinador ON (coordinador.sede = {$t}.id)
) AS {$t}
" . concat($this->_condition($render), 'WHERE ') . "

)";
  }
}
