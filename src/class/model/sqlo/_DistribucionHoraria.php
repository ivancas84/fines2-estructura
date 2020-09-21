<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class _DistribucionHorariaSqlo extends EntitySqlo {

  public $entityName = "distribucion_horaria";

  public function insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "horas_catedra, " ;
    $sql .= "dia, " ;
    $sql .= "asignatura, " ;
    $sql .= "planificacion, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['horas_catedra'] . ", " ;
    $sql .= $row['dia'] . ", " ;
    $sql .= $row['asignatura'] . ", " ;
    $sql .= $row['planificacion'] . ", " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ");
";

    return $sql;
  }

  public function _update(array $row){ //@override
    $sql = "
UPDATE " . $this->entity->sn_() . " SET
";
    if (isset($row['horas_catedra'] )) $sql .= "horas_catedra = " . $row['horas_catedra'] . " ," ;
    if (isset($row['dia'] )) $sql .= "dia = " . $row['dia'] . " ," ;
    if (isset($row['asignatura'] )) $sql .= "asignatura = " . $row['asignatura'] . " ," ;
    if (isset($row['planificacion'] )) $sql .= "planificacion = " . $row['planificacion'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }

  public function json(array $row = null){
    if(empty($row)) return null;
    $row_ = $this->container->getValue($this->entity->getName())->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['asi_id'])) $row_["asignatura_"] = $this->container->getValue('asignatura', 'asi')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['pla_id'])) $row_["planificacion_"] = $this->container->getValue('planificacion', 'pla')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['pla_plb_id'])) $row_["planificacion_"]["plan_"] = $this->container->getValue('plan', 'pla_plb')->_fromArray($row, "set")->_toArray("json");
    return $row_;
  }

  public function values(array $row){
    $row_ = [];
    $row_["distribucion_horaria"] = $this->container->getValue("distribucion_horaria")->_fromArray($row, "set");
    $row_["asignatura"] = $this->container->getValue('asignatura', 'asi')->_fromArray($row, "set");
    $row_["planificacion"] = $this->container->getValue('planificacion', 'pla')->_fromArray($row, "set");
    $row_["plan"] = $this->container->getValue('plan', 'pla_plb')->_fromArray($row, "set");
    return $row_;
  }



}
