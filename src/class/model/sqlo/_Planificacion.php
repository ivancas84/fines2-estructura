<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class _PlanificacionSqlo extends EntitySqlo {

  public function __construct(){
    /**
     * Se definen todos los recursos de forma independiente, sin parametros en el constructor, para facilitar el polimorfismo de las subclases
     */
    $this->db = Dba::dbInstance();
    $this->entity = Entity::getInstanceRequire('planificacion');
    $this->sql = EntitySql::getInstanceRequire('planificacion');
  }

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
    $row_ = $this->sql->_json($row);
    if(!is_null($row['plb_id'])){
      $json = EntitySql::getInstanceRequire('plan', 'plb')->_json($row);
      $row_["plan_"] = $json;
    }
    return $row_;
  }

  public function values(array $row){
    $row_ = [];

    $row_["planificacion"] = EntityValues::getInstanceRequire("planificacion", $row);
    $row_["plan"] = EntityValues::getInstanceRequire('plan', $row, 'plb_');
    return $row_;
  }



}
