<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class NominaSqloMain extends EntitySqlo {

  public function __construct(){
    /**
     * Se definen todos los recursos de forma independiente, sin parametros en el constructor, para facilitar el polimorfismo de las subclases
     */
    $this->db = Dba::dbInstance();
    $this->entity = Entity::getInstanceRequire('nomina');
    $this->sql = EntitySql::getInstanceRequire('nomina');
  }

  protected function _insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "alta, " ;
    $sql .= "activo, " ;
    $sql .= "division, " ;
    $sql .= "persona, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['alta'] . ", " ;
    $sql .= $row['activo'] . ", " ;
    $sql .= $row['division'] . ", " ;
    $sql .= $row['persona'] . ", " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ");
";

    return $sql;
  }

  protected function _update(array $row){ //@override
    $sql = "
UPDATE " . $this->entity->sn_() . " SET
";
    if (isset($row['alta'] )) $sql .= "alta = " . $row['alta'] . " ," ;
    if (isset($row['activo'] )) $sql .= "activo = " . $row['activo'] . " ," ;
    if (isset($row['division'] )) $sql .= "division = " . $row['division'] . " ," ;
    if (isset($row['persona'] )) $sql .= "persona = " . $row['persona'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }

  public function json(array $row){
    if(empty($row)) return null;
    $row_ = $this->sql->_json($row);
    if(!is_null($row['dia_id'])){
      $json = EntitySql::getInstanceRequire('division', 'dia')->_json($row);
      $row_["division_"] = $json;
    }
    if(!is_null($row['dia_pla_id'])){
      $json = EntitySql::getInstanceRequire('plan', 'dia_pla')->_json($row);
      $row_["division_"]["plan_"] = $json;
    }
    if(!is_null($row['dia_sed_id'])){
      $json = EntitySql::getInstanceRequire('sede', 'dia_sed')->_json($row);
      $row_["division_"]["sede_"] = $json;
    }
    if(!is_null($row['dia_sed_ts_id'])){
      $json = EntitySql::getInstanceRequire('tipo_sede', 'dia_sed_ts')->_json($row);
      $row_["division_"]["sede_"]["tipo_sede_"] = $json;
    }
    if(!is_null($row['dia_sed_dom_id'])){
      $json = EntitySql::getInstanceRequire('domicilio', 'dia_sed_dom')->_json($row);
      $row_["division_"]["sede_"]["domicilio_"] = $json;
    }
    if(!is_null($row['dia_sed_coo_id'])){
      $json = EntitySql::getInstanceRequire('id_persona', 'dia_sed_coo')->_json($row);
      $row_["division_"]["sede_"]["coordinador_"] = $json;
    }
    if(!is_null($row['dia_sed_ref_id'])){
      $json = EntitySql::getInstanceRequire('id_persona', 'dia_sed_ref')->_json($row);
      $row_["division_"]["sede_"]["referente_"] = $json;
    }
    if(!is_null($row['per_id'])){
      $json = EntitySql::getInstanceRequire('id_persona', 'per')->_json($row);
      $row_["persona_"] = $json;
    }
    return $row_;
  }

  public function values(array $row){
    $row_ = [];

    $json = ($row && !is_null($row['id'])) ? $this->sql->_json($row) : null;
    $row_["nomina"] = EntityValues::getInstanceRequire("nomina", $json);

    $json = ($row && !is_null($row['dia_id'])) ? EntitySql::getInstanceRequire('division', 'dia')->_json($row) : null;
    $row_["division"] = EntityValues::getInstanceRequire('division', $json);

    $json = ($row && !is_null($row['dia_pla_id'])) ? EntitySql::getInstanceRequire('plan', 'dia_pla')->_json($row) : null;
    $row_["plan"] = EntityValues::getInstanceRequire('plan', $json);

    $json = ($row && !is_null($row['dia_sed_id'])) ? EntitySql::getInstanceRequire('sede', 'dia_sed')->_json($row) : null;
    $row_["sede"] = EntityValues::getInstanceRequire('sede', $json);

    $json = ($row && !is_null($row['dia_sed_ts_id'])) ? EntitySql::getInstanceRequire('tipo_sede', 'dia_sed_ts')->_json($row) : null;
    $row_["tipo_sede"] = EntityValues::getInstanceRequire('tipo_sede', $json);

    $json = ($row && !is_null($row['dia_sed_dom_id'])) ? EntitySql::getInstanceRequire('domicilio', 'dia_sed_dom')->_json($row) : null;
    $row_["domicilio"] = EntityValues::getInstanceRequire('domicilio', $json);

    $json = ($row && !is_null($row['dia_sed_coo_id'])) ? EntitySql::getInstanceRequire('id_persona', 'dia_sed_coo')->_json($row) : null;
    $row_["coordinador"] = EntityValues::getInstanceRequire('id_persona', $json);

    $json = ($row && !is_null($row['dia_sed_ref_id'])) ? EntitySql::getInstanceRequire('id_persona', 'dia_sed_ref')->_json($row) : null;
    $row_["referente"] = EntityValues::getInstanceRequire('id_persona', $json);

    $json = ($row && !is_null($row['per_id'])) ? EntitySql::getInstanceRequire('id_persona', 'per')->_json($row) : null;
    $row_["persona"] = EntityValues::getInstanceRequire('id_persona', $json);

    return $row_;
  }



}
