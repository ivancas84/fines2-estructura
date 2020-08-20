<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class _PlanSqlo extends EntitySqlo {

  public $entityName = "plan";

  protected function _insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "orientacion, " ;
    $sql .= "resolucion, " ;
    $sql .= "distribucion_horaria, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['orientacion'] . ", " ;
    $sql .= $row['resolucion'] . ", " ;
    $sql .= $row['distribucion_horaria'] . ", " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ");
";

    return $sql;
  }

  protected function _update(array $row){ //@override
    $sql = "
UPDATE " . $this->entity->sn_() . " SET
";
    if (isset($row['orientacion'] )) $sql .= "orientacion = " . $row['orientacion'] . " ," ;
    if (isset($row['resolucion'] )) $sql .= "resolucion = " . $row['resolucion'] . " ," ;
    if (isset($row['distribucion_horaria'] )) $sql .= "distribucion_horaria = " . $row['distribucion_horaria'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }



}
