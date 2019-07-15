<?php

require_once("class/model/Sqlo.php");

//Implementacion principal de Sqlo para una entidad especifica
class NominaSqloMain extends EntitySqlo {

  public function __construct(){
    /**
     * Se definen todos los recursos de forma independiente, sin parametros en el constructor, para facilitar el polimorfismo de las subclases
     */
    $this->db = Dba::dbInstance();
    $this->entity = Entity::getInstanceFromString('nomina');
    $this->sql = EntitySql::getInstanceFromString('nomina');
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
      $json = EntitySql::getInstanceFromString('division', 'dia')->_json($row);
      $row_["division_"] = $json;
    }
    if(!is_null($row['dia_pla_id'])){
      $json = EntitySql::getInstanceFromString('plan', 'dia_pla')->_json($row);
      $row_["division_"]["plan_"] = $json;
    }
    if(!is_null($row['dia_sed_id'])){
      $json = EntitySql::getInstanceFromString('sede', 'dia_sed')->_json($row);
      $row_["division_"]["sede_"] = $json;
    }
    if(!is_null($row['dia_sed_ts_id'])){
      $json = EntitySql::getInstanceFromString('tipo_sede', 'dia_sed_ts')->_json($row);
      $row_["division_"]["sede_"]["tipo_sede_"] = $json;
    }
    if(!is_null($row['dia_sed_dom_id'])){
      $json = EntitySql::getInstanceFromString('domicilio', 'dia_sed_dom')->_json($row);
      $row_["division_"]["sede_"]["domicilio_"] = $json;
    }
    if(!is_null($row['dia_sed_coo_id'])){
      $json = EntitySql::getInstanceFromString('id_persona', 'dia_sed_coo')->_json($row);
      $row_["division_"]["sede_"]["coordinador_"] = $json;
    }
    if(!is_null($row['dia_sed_ref_id'])){
      $json = EntitySql::getInstanceFromString('id_persona', 'dia_sed_ref')->_json($row);
      $row_["division_"]["sede_"]["referente_"] = $json;
    }
    if(!is_null($row['per_id'])){
      $json = EntitySql::getInstanceFromString('id_persona', 'per')->_json($row);
      $row_["persona_"] = $json;
    }
    return $row_;
  }

  public function values(array $row){
    $row_ = [];

    $json = ($row && !is_null($row['id'])) ? $this->sql->_json($row) : null;
    $row_["nomina"] = EntityValues::getInstanceFromString("nomina", $json);

    $json = ($row && !is_null($row['dia_id'])) ? EntitySql::getInstanceFromString('division', 'dia')->_json($row) : null;
    $row_["division"] = EntityValues::getInstanceFromString('division', $json);

    $json = ($row && !is_null($row['dia_pla_id'])) ? EntitySql::getInstanceFromString('plan', 'dia_pla')->_json($row) : null;
    $row_["plan"] = EntityValues::getInstanceFromString('plan', $json);

    $json = ($row && !is_null($row['dia_sed_id'])) ? EntitySql::getInstanceFromString('sede', 'dia_sed')->_json($row) : null;
    $row_["sede"] = EntityValues::getInstanceFromString('sede', $json);

    $json = ($row && !is_null($row['dia_sed_ts_id'])) ? EntitySql::getInstanceFromString('tipo_sede', 'dia_sed_ts')->_json($row) : null;
    $row_["tipo_sede"] = EntityValues::getInstanceFromString('tipo_sede', $json);

    $json = ($row && !is_null($row['dia_sed_dom_id'])) ? EntitySql::getInstanceFromString('domicilio', 'dia_sed_dom')->_json($row) : null;
    $row_["domicilio"] = EntityValues::getInstanceFromString('domicilio', $json);

    $json = ($row && !is_null($row['dia_sed_coo_id'])) ? EntitySql::getInstanceFromString('id_persona', 'dia_sed_coo')->_json($row) : null;
    $row_["coordinador"] = EntityValues::getInstanceFromString('id_persona', $json);

    $json = ($row && !is_null($row['dia_sed_ref_id'])) ? EntitySql::getInstanceFromString('id_persona', 'dia_sed_ref')->_json($row) : null;
    $row_["referente"] = EntityValues::getInstanceFromString('id_persona', $json);

    $json = ($row && !is_null($row['per_id'])) ? EntitySql::getInstanceFromString('id_persona', 'per')->_json($row) : null;
    $row_["persona"] = EntityValues::getInstanceFromString('id_persona', $json);

    return $row_;
  }



}
