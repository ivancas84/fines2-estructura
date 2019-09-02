<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class ClasificacionPlanSqloMain extends EntitySqlo {

  public function __construct(){
    /**
     * Se definen todos los recursos de forma independiente, sin parametros en el constructor, para facilitar el polimorfismo de las subclases
     */
    $this->db = Dba::dbInstance();
    $this->entity = Entity::getInstanceRequire('clasificacion_plan');
    $this->sql = EntitySql::getInstanceRequire('clasificacion_plan');
  }

  protected function _insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "clasificacion, " ;
    $sql .= "plan, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['clasificacion'] . ", " ;
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
    if (isset($row['clasificacion'] )) $sql .= "clasificacion = " . $row['clasificacion'] . " ," ;
    if (isset($row['plan'] )) $sql .= "plan = " . $row['plan'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }

  public function json(array $row){
    if(empty($row)) return null;
    $row_ = $this->sql->_json($row);
    if(!is_null($row['cla_id'])){
      $json = EntitySql::getInstanceRequire('clasificacion', 'cla')->_json($row);
      $row_["clasificacion_"] = $json;
    }
    if(!is_null($row['pla_id'])){
      $json = EntitySql::getInstanceRequire('plan', 'pla')->_json($row);
      $row_["plan_"] = $json;
    }
    return $row_;
  }

  public function values(array $row){
    $row_ = [];

    $json = ($row && !is_null($row['id'])) ? $this->sql->_json($row) : null;
    $row_["clasificacion_plan"] = EntityValues::getInstanceRequire("clasificacion_plan", $json);

    $json = ($row && !is_null($row['cla_id'])) ? EntitySql::getInstanceRequire('clasificacion', 'cla')->_json($row) : null;
    $row_["clasificacion"] = EntityValues::getInstanceRequire('clasificacion', $json);

    $json = ($row && !is_null($row['pla_id'])) ? EntitySql::getInstanceRequire('plan', 'pla')->_json($row) : null;
    $row_["plan"] = EntityValues::getInstanceRequire('plan', $json);

    return $row_;
  }



}
