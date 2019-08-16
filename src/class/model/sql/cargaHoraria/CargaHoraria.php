<?php

require_once("class/model/sql/cargaHoraria/Main.php");

class CargaHorariaSql extends CargaHorariaSqlMain {


    public function _subSql(Render $render){ //subconsulta sql (en construccion)
        $t = $this->prt();
        return "
SELECT * FROM (
    SELECT DISTINCT {$this->_fieldsDb()}, CONCAT({$t}.anio,{$t}.semestre) AS tramo
    {$this->_from($render)}
) AS {$t}
" . concat($this->_condition($render), 'WHERE ') . "
";
      }

}
