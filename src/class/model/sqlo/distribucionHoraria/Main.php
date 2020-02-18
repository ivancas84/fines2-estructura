<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class DistribucionHorariaSqloMain extends EntitySqlo {

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
    $sql .= "carga_horaria, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['horas_catedra'] . ", " ;
    $sql .= $row['dia'] . ", " ;
    $sql .= $row['carga_horaria'] . ", " ;
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
    if (isset($row['carga_horaria'] )) $sql .= "carga_horaria = " . $row['carga_horaria'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }

  public function json(array $row){
    if(empty($row)) return null;
    $row_ = $this->sql->_json($row);
    if(!is_null($row['ch_id'])){
      $json = EntitySql::getInstanceRequire('carga_horaria', 'ch')->_json($row);
      $row_["carga_horaria_"] = $json;
    }
    if(!is_null($row['ch_pla_id'])){
      $json = EntitySql::getInstanceRequire('plan', 'ch_pla')->_json($row);
      $row_["carga_horaria_"]["plan_"] = $json;
    }
    if(!is_null($row['ch_asi_id'])){
      $json = EntitySql::getInstanceRequire('asignatura', 'ch_asi')->_json($row);
      $row_["carga_horaria_"]["asignatura_"] = $json;
    }
    return $row_;
  }

  public function values(array $row){
    $row_ = [];

    $row_["distribucion_horaria"] = EntityValues::getInstanceRequire("distribucion_horaria", $row);
    $row_["carga_horaria"] = EntityValues::getInstanceRequire('carga_horaria', $row, 'ch_');
    $row_["plan"] = EntityValues::getInstanceRequire('plan', $row, 'ch_pla_');
    $row_["asignatura"] = EntityValues::getInstanceRequire('asignatura', $row, 'ch_asi_');
    return $row_;
  }



}
