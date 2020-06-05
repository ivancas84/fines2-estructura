<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class _DistribucionHorariaSqlo extends EntitySqlo {

  public function __construct(){
    /**
     * Se definen todos los recursos de forma independiente, sin parametros en el constructor, para facilitar el polimorfismo de las subclases
     */
    $this->db = Dba::dbInstance();
    $this->entity = Entity::getInstanceRequire('distribucion_horaria');
    $this->sql = EntitySql::getInstanceRequire('distribucion_horaria');
  }

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
    $row_ = $this->sql->_json($row);
    if(!is_null($row['asi_id'])){
      $json = EntitySql::getInstanceRequire('asignatura', 'asi')->_json($row);
      $row_["asignatura_"] = $json;
    }
    if(!is_null($row['pla_id'])){
      $json = EntitySql::getInstanceRequire('planificacion', 'pla')->_json($row);
      $row_["planificacion_"] = $json;
    }
    if(!is_null($row['pla_pla_id'])){
      $json = EntitySql::getInstanceRequire('plan', 'pla_pla')->_json($row);
      $row_["planificacion_"]["plan_"] = $json;
    }
    return $row_;
  }

  public function values(array $row){
    $row_ = [];

    $row_["distribucion_horaria"] = EntityValues::getInstanceRequire("distribucion_horaria", $row);
    $row_["asignatura"] = EntityValues::getInstanceRequire('asignatura', $row, 'asi_');
    $row_["planificacion"] = EntityValues::getInstanceRequire('planificacion', $row, 'pla_');
    $row_["plan"] = EntityValues::getInstanceRequire('plan', $row, 'pla_pla_');
    return $row_;
  }



}
