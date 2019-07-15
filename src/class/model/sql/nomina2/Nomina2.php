<?php

require_once("class/model/sql/nomina2/Main.php");

class Nomina2Sql extends Nomina2SqlMain {

  //@override
  public function _conditionField($field, $option, $value, $prefix = ''){
    $p = (empty($prefix)) ? '' : $prefix . '_';
    $t = (empty($prefix)) ? 'noa' : $prefix;

    $condition = parent::_conditionField($field, $option, $value, $prefix);
    if(!empty($condition)) return $condition;

    switch ($field){
      //$option = IN | NOT IN
      //$value = fecha 'YYYY-MM-DD'
      case "{$p}alumnos_activos_duplicados":
        $alumnos_activos_duplicados = EntitySqlo::getInstanceFromString('nomina2')->alumnosActivosDuplicados($value);
        return "(
  {$t}.persona {$option}(
    SELECT persona FROM (
      {$alumnos_activos_duplicados}
    ) AS duplicados
  ) AND ({$p}com.fecha = '$value')
)
";
        break;

        case "{$p}alumnos_no_activos_duplicados":
          $alumnos_activos_duplicados = EntitySqlo::getInstanceFromString('nomina2')->alumnosNoActivosDuplicados($value);
          return "(
    {$t}.persona {$option}(
      SELECT persona FROM (
        {$alumnos_activos_duplicados}
      ) AS duplicados
    ) AND ({$p}com.fecha = '$value')
  )
  ";
          break;


        case "{$p}alumnos_activos":
          $alumnos_activos = EntitySqlo::getInstanceFromString('nomina2')->activos($value);
          return "(
    {$t}.persona {$option}(
      SELECT persona FROM (
        {$alumnos_activos}
      ) AS duplicados
    ) AND ({$p}com.fecha = '$value')
  )
  ";
          break;
    }
  }


}
