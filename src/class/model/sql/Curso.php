<?php

require_once("class/model/sql/_CursoSql.php");

class CursoSql extends _CursoSql {
  public function _subSql(Render $render){ //subconsulta sql (en construccion)
    $t = $this->prt();

    return "(

SELECT *
FROM (
SELECT DISTINCT {$this->_fieldsDb()}, toma_activa.toma_activa
{$this->_from($render)}
LEFT OUTER JOIN (
  SELECT id AS toma_activa, curso
  FROM toma
  WHERE (toma.estado = 'Aprobada' OR toma.estado = 'Pendiente') AND (toma.estado_contralor != 'Modificar')
) AS toma_activa ON (toma_activa.curso = {$t}.id)
) AS {$t}
" . concat($this->_condition($render), 'WHERE ') . "

)
";
  }

}
