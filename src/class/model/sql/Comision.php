<?php

require_once("class/model/sql/_Comision.php");

class ComisionSql extends _ComisionSql {

  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    switch ($field) {
      case $p.'tramo': return "CONCAT(COALESCE({$p}pla.anio,''), COALESCE({$p}pla.semestre,''))";
      case $p.'_label': return "CONCAT(
  {$p}sed.numero, {$t}.division,
  IF({$p}pla.id, CONCAT({$p}pla.anio,{$p}pla.semestre), ''),
  IF({$p}cal.id, CONCAT(' ',{$p}cal.anio,'-',{$p}cal.semestre), ''),
  IF({$p}cal.inicio,CONCAT(' ', {$p}cal.inicio),''),
  IF({$p}cal.fin,CONCAT(' ', {$p}cal.fin),'')
)";
      default: return parent::_mappingField($field);
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
  ) AS horario_ ON (horario_.comision = {$p}.id)
  
  
) AS {$p}
  " . concat($this->_condition($render), 'WHERE ') . "
  ";
    }*/
}
