<?php

require_once("class/model/sql/toma/Main.php");

class TomaSql extends TomaSqlMain {

  public function _subSql(Render $render){ //subconsulta sql (en construccion)
    $t = $this->prt();

    return "SELECT * FROM (

SELECT DISTINCT {$this->_fieldsDb()}, IF(fecha_inicio > fecha_toma, fecha_inicio, fecha_toma) AS fecha_desde
{$this->_from($render)}

) AS {$t}
" . concat($this->_condition($render), 'WHERE ') . "
";
  }

  public function _mappingField($field) {
    $p = $this->prf();
  
    switch ($field) {
      case "suma_horas_catedra": return "SUM(cur_ch.horas_catedra)";
      default: return parent::_mappingField($field);
    }
  }

}
