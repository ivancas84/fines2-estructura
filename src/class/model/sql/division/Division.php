<?php
require_once("function/array_unique_key.php");

require_once("class/model/sql/division/Main.php");

class DivisionSql extends DivisionSqlMain {

  public function _subSql(Render $render){
    $t = $this->prt();

    return "SELECT *
FROM (


SELECT DISTINCT {$this->_fieldsDb()}, CONCAT(sede.numero, serie) AS numero
{$this->_from($render)}
INNER JOIN sede ON (sede.id = {$t}.sede)


) AS {$t}
" . concat($this->_condition($render), 'WHERE ') . "
";
  }

  public function _conditionFieldAux($field, $option, $value){
    $p = $this->prf();

    switch($field){
      case "{$p}_clasificacion":
        $planesIds = array_unique_key(Dba::all("clasificacion_plan", ["clasificacion",$option,$value]), "plan");
        return $this->conditionField("{$p}plan",$option,$planesIds);

      case "{$p}_clasificacion_nombre":
        $planesIds = array_unique_key(Dba::all("clasificacion_plan", ["cla_nombre",$option,$value]), "plan");
        return $this->conditionField("{$p}plan",$option,$planesIds);

      default: return parent::_conditionFieldAux($field, $option, $value);
    }

  }
}
