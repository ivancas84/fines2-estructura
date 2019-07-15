<?php

require_once("class/model/sql/comision/Main.php");

class ComisionSql extends ComisionSqlMain {


  public function _mappingField($field) {
      $p = $this->prf();
      $t = $this->prt();

      switch ($field) {
        //case $p.'tramo': return "";

        case 'cantidad': return "COUNT(*)";


        default: return parent::_mappingField($field);
      }
    }

    public function _subSql(Render $render){ //subconsulta sql (en construccion)
      $t = $this->prt();
      return "SELECT * /*envoltura {$t}*/
  FROM (

SELECT DISTINCT
{$this->_fieldsDb()}, horario_.horario, CONCAT({$t}.anio,{$t}.semestre) AS tramo
{$this->_from($render)}
LEFT JOIN (
  SELECT comision.id AS comision, CONCAT_WS(\" \", dias.dia, 
    TIME_FORMAT(horas.hora_inicio, '%H:%i'), 
    TIME_FORMAT(horas.hora_fin, '%H:%i')
  ) AS horario
  FROM comision
  INNER JOIN (
  SELECT DISTINCT dias_.comision AS comision, GROUP_CONCAT(dias_.dia ORDER BY dias_.numero) AS dia
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
    INNER JOIN dia ON (dia.id = horario.dia)
    INNER JOIN curso ON (curso.id = horario.curso)
    INNER JOIN comision ON (comision.id = curso.comision)
    GROUP BY comision
  ) AS horas ON (horas.comision = comision.id)

) AS horario_ ON (horario_.comision = {$t}.id)

) AS {$t}
" . concat($this->_condition($render), 'WHERE ') . "
";
  }


 

  



  public function _advancedComisionesAutorizadasPublicadas($fecha, $prefix = ''){
    $p = (empty($prefix)) ?  ''  : $prefix . '_';

    return [
      [$p.'fecha', '=', $fecha],
      [$p.'autorizada', '=', true],
      [$p.'publicar', '=', true],
      [$p.'dvi_plan', '!=', '3'],
    ];
  }

  public function _advancedComisionesAutorizadas($fecha, $prefix = ''){
    $p = (empty($prefix)) ?  ''  : $prefix . '_';

    return [
      [$p.'fecha', '=', $fecha],
      [$p.'autorizada', '=', true],
      [$p.'dvi_plan', '!=', '3'],
    ];
  }

  public function _advancedComisionesPublicadas($fecha, $prefix = ''){
    $p = (empty($prefix)) ?  ''  : $prefix . '_';

    return [
      [$p.'fecha', '=', $fecha],
      [$p.'publicar', '=', true],
      [$p.'dvi_plan', '!=', '3'],
    ];
  }


}
