<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class DivisionSqloMain extends EntitySqlo {

  public function __construct(){
    /**
     * Se definen todos los recursos de forma independiente, sin parametros en el constructor, para facilitar el polimorfismo de las subclases
     */
    $this->db = Dba::dbInstance();
    $this->entity = Entity::getInstanceRequire('division');
    $this->sql = EntitySql::getInstanceRequire('division');
  }

  protected function _insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "serie, " ;
    $sql .= "turno, " ;
    $sql .= "plan, " ;
    $sql .= "sede, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['serie'] . ", " ;
    $sql .= $row['turno'] . ", " ;
    $sql .= $row['plan'] . ", " ;
    $sql .= $row['sede'] . ", " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ");
";

    return $sql;
  }

  protected function _update(array $row){ //@override
    $sql = "
UPDATE " . $this->entity->sn_() . " SET
";
    if (isset($row['serie'] )) $sql .= "serie = " . $row['serie'] . " ," ;
    if (isset($row['turno'] )) $sql .= "turno = " . $row['turno'] . " ," ;
    if (isset($row['plan'] )) $sql .= "plan = " . $row['plan'] . " ," ;
    if (isset($row['sede'] )) $sql .= "sede = " . $row['sede'] . " ," ;
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
    if(!is_null($row['sed_id'])){
      $json = EntitySql::getInstanceRequire('sede', 'sed')->_json($row);
      $row_["sede_"] = $json;
    }
    if(!is_null($row['sed_ts_id'])){
      $json = EntitySql::getInstanceRequire('tipo_sede', 'sed_ts')->_json($row);
      $row_["sede_"]["tipo_sede_"] = $json;
    }
    if(!is_null($row['sed_dom_id'])){
      $json = EntitySql::getInstanceRequire('domicilio', 'sed_dom')->_json($row);
      $row_["sede_"]["domicilio_"] = $json;
    }
    if(!is_null($row['sed_coo_id'])){
      $json = EntitySql::getInstanceRequire('id_persona', 'sed_coo')->_json($row);
      $row_["sede_"]["coordinador_"] = $json;
    }
    if(!is_null($row['sed_ref_id'])){
      $json = EntitySql::getInstanceRequire('id_persona', 'sed_ref')->_json($row);
      $row_["sede_"]["referente_"] = $json;
    }
    return $row_;
  }

  public function values(array $row){
    $row_ = [];

    $json = ($row && !is_null($row['id'])) ? $this->sql->_json($row) : null;
    $row_["division"] = EntityValues::getInstanceRequire("division", $json);

    $json = ($row && !is_null($row['pla_id'])) ? EntitySql::getInstanceRequire('plan', 'pla')->_json($row) : null;
    $row_["plan"] = EntityValues::getInstanceRequire('plan', $json);

    $json = ($row && !is_null($row['sed_id'])) ? EntitySql::getInstanceRequire('sede', 'sed')->_json($row) : null;
    $row_["sede"] = EntityValues::getInstanceRequire('sede', $json);

    $json = ($row && !is_null($row['sed_ts_id'])) ? EntitySql::getInstanceRequire('tipo_sede', 'sed_ts')->_json($row) : null;
    $row_["tipo_sede"] = EntityValues::getInstanceRequire('tipo_sede', $json);

    $json = ($row && !is_null($row['sed_dom_id'])) ? EntitySql::getInstanceRequire('domicilio', 'sed_dom')->_json($row) : null;
    $row_["domicilio"] = EntityValues::getInstanceRequire('domicilio', $json);

    $json = ($row && !is_null($row['sed_coo_id'])) ? EntitySql::getInstanceRequire('id_persona', 'sed_coo')->_json($row) : null;
    $row_["coordinador"] = EntityValues::getInstanceRequire('id_persona', $json);

    $json = ($row && !is_null($row['sed_ref_id'])) ? EntitySql::getInstanceRequire('id_persona', 'sed_ref')->_json($row) : null;
    $row_["referente"] = EntityValues::getInstanceRequire('id_persona', $json);

    return $row_;
  }



}
