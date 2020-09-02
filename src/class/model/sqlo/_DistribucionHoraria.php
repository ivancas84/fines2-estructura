<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class _DistribucionHorariaSqlo extends EntitySqlo {

  public $entityName = "distribucion_horaria";

  protected function _insert(array $row){ //@override
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

  protected function _update(array $row){ //@override
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
    $row_ = $this->container->getValues($this->entity->getName())->_fromArray($row)->_toArray();
    if(!is_null($row['asi_id'])) $row_["asignatura_"] = $this->container->getValues('asignatura')->_fromArray($row, 'asi_')->_toArray();
    if(!is_null($row['pla_id'])) $row_["planificacion_"] = $this->container->getValues('planificacion')->_fromArray($row, 'pla_')->_toArray();
    if(!is_null($row['pla_plb_id'])) $row_["planificacion_"]["plan_"] = $this->container->getValues('plan')->_fromArray($row, 'pla_plb_')->_toArray();
    return $row_;
  }

  public function values(array $row){
    $row_ = [];
    $row_["distribucion_horaria"] = $this->container->getValues("distribucion_horaria")->_fromArray($row);
    $row_["asignatura"] = $this->container->getValues('asignatura')->_fromArray($row, 'asi_');
    $row_["planificacion"] = $this->container->getValues('planificacion')->_fromArray($row, 'pla_');
    $row_["plan"] = $this->container->getValues('plan')->_fromArray($row, 'pla_plb_');
    return $row_;
  }



}
