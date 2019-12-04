<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class CargaHorariaSqloMain extends EntitySqlo {

  public function __construct(){
    /**
     * Se definen todos los recursos de forma independiente, sin parametros en el constructor, para facilitar el polimorfismo de las subclases
     */
    $this->db = Dba::dbInstance();
    $this->entity = Entity::getInstanceRequire('carga_horaria');
    $this->sql = EntitySql::getInstanceRequire('carga_horaria');
  }

  protected function _insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "anio, " ;
    $sql .= "semestre, " ;
    $sql .= "horas_catedra, " ;
    $sql .= "plan, " ;
    $sql .= "asignatura, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['anio'] . ", " ;
    $sql .= $row['semestre'] . ", " ;
    $sql .= $row['horas_catedra'] . ", " ;
    $sql .= $row['plan'] . ", " ;
    $sql .= $row['asignatura'] . ", " ;
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
    if (isset($row['horas_catedra'] )) $sql .= "horas_catedra = " . $row['horas_catedra'] . " ," ;
    if (isset($row['plan'] )) $sql .= "plan = " . $row['plan'] . " ," ;
    if (isset($row['asignatura'] )) $sql .= "asignatura = " . $row['asignatura'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }

  public function json(array $row){
    if(empty($row)) return null;
    $row_ = $this->sql->_json($row);
    if(!is_null($row['pla_id'])){
      $json = EntitySql::getInstanceRequire('plan', 'pla')->_json($row);
      $row_["plan_"] = $json;
    }
    if(!is_null($row['asi_id'])){
      $json = EntitySql::getInstanceRequire('asignatura', 'asi')->_json($row);
      $row_["asignatura_"] = $json;
    }
    return $row_;
  }

  public function values(array $row){
    $row_ = [];

    $row_["carga_horaria"] = EntityValues::getInstanceRequire("carga_horaria", $row);
    $row_["plan"] = EntityValues::getInstanceRequire('plan', $row, 'pla_');
    $row_["asignatura"] = EntityValues::getInstanceRequire('asignatura', $row, 'asi_');
    return $row_;
  }



}
