<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class _PlanificacionSqlo extends EntitySqlo {

  public $entityName = "planificacion";

  protected function _insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "anio, " ;
    $sql .= "semestre, " ;
    $sql .= "plan, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['anio'] . ", " ;
    $sql .= $row['semestre'] . ", " ;
    $sql .= $row['plan'] . ", " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ");
";

    return $sql;
  }

  protected function _update(array $row){ //@override
    $sql = "
UPDATE " . $this->entity->sn_() . " SET
";
    if (isset($row['anio'] )) $sql .= "anio = " . $row['anio'] . " ," ;
    if (isset($row['semestre'] )) $sql .= "semestre = " . $row['semestre'] . " ," ;
    if (isset($row['plan'] )) $sql .= "plan = " . $row['plan'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }

  public function json(array $row = null){
    if(empty($row)) return null;
    $row_ = $this->container->getValues($this->entity->getName())->_fromArray($row)->_toArray();
    if(!is_null($row['plb_id'])) $row_["plan_"] = $this->container->getValues('plan')->_fromArray($row, 'plb_')->_toArray();
    return $row_;
  }

  public function values(array $row){
    $row_ = [];
    $row_["planificacion"] = $this->container->getValues("planificacion")->_fromArray($row);
    $row_["plan"] = $this->container->getValues('plan')->_fromArray($row, 'plb_');
    return $row_;
  }



}
