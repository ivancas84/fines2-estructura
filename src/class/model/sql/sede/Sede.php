<?php

require_once("class/model/sql/sede/Main.php");

class SedeSql extends SedeSqlMain {

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
