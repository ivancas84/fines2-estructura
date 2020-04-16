<?php

require_once("class/model/sql/comision/Main.php");

class ComisionSql extends ComisionSqlMain {

  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    if($f = parent::_mappingField($field)) return $f;
    switch ($field) {
      case $p.'tramo': return concat($t.".anio", $t.".semestre");
      default: return null;
    }
  }

  /*
    public function _subSql(Render $render){
        $t = $this->prt();
        return "SELECT *
    FROM (
  SELECT DISTINCT
  {$this->_fieldsDb()}, horario_.dias, horario_.hora_inicio, horario_.hora_fin
  {$this->_from($render)}
  LEFT JOIN (


    SELECT comision.id AS comision, dias.dias, horas.hora_inicio, horas.hora_fin    
    FROM comision
    INNER JOIN (
        SELECT DISTINCT dias_.comision AS comision, GROUP_CONCAT(dias_.dia ORDER BY dias_.numero) AS dias
        FROM (
            SELECT DISTINCT comision.id AS comision, dia.dia, dia.numero
            FROM horario
            INNER JOIN dia ON (dia.id = horario.dia)
            INNER JOIN curso ON (curso.id = horario.curso)
            INNER JOIN comision ON (comision.id = curso.comision)
            ORDER BY dia.numero
        ) AS dias_
        GROUP BY comision
    ) AS dias ON (dias.comision = comision.id)
    INNER JOIN (
        SELECT DISTINCT comision.id AS comision, MIN(horario.hora_inicio) AS hora_inicio, MAX(horario.hora_fin) AS hora_fin
        FROM horario
        INNER JOIN curso ON (curso.id = horario.curso)
        INNER JOIN comision ON (comision.id = curso.comision)
        GROUP BY comision
    ) AS horas ON (horas.comision = comision.id)
  ) AS horario_ ON (horario_.comision = {$t}.id)
  
  
) AS {$t}
  " . concat($this->_condition($render), 'WHERE ') . "
  ";
    }*/
}
