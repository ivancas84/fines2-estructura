<?php

require_once("class/model/sql/horario/Main.php");

class HorarioSql extends HorarioSqlMain {

    public function _subSql(Render $render){ //subconsulta sql (en construccion)
        $t = $this->prt();

        return "SELECT * FROM (

SELECT DISTINCT {$this->_fieldsDb()}, ROUND(TIME_TO_SEC(TIMEDIFF({$t}.hora_fin, {$t}.hora_inicio)) / 60 / 40, 0) AS horas_catedra
{$this->_from($render)}

) AS {$t}
" . concat($this->_condition($render), 'WHERE ') . "
";
      }


}
