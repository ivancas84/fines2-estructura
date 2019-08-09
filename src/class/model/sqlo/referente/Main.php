<?php

require_once("class/model/Sqlo.php");

//Implementacion principal de Sqlo para una entidad especifica
class ReferenteSqloMain extends EntitySqlo {

  public function __construct(){
    /**
     * Se definen todos los recursos de forma independiente, sin parametros en el constructor, para facilitar el polimorfismo de las subclases
     */
    $this->db = Dba::dbInstance();
    $this->entity = Entity::getInstanceFromString('referente');
    $this->sql = EntitySql::getInstanceFromString('referente');
  }

  protected function _insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "persona, " ;
    $sql .= "sede, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['persona'] . ", " ;
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
    if (isset($row['persona'] )) $sql .= "persona = " . $row['persona'] . " ," ;
    if (isset($row['sede'] )) $sql .= "sede = " . $row['sede'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }

  public function json(array $row){
    if(empty($row)) return null;
    $row_ = $this->sql->_json($row);
    if(!is_null($row['per_id'])){
      $json = EntitySql::getInstanceFromString('id_persona', 'per')->_json($row);
      $row_["persona_"] = $json;
    }
    if(!is_null($row['sed_id'])){
      $json = EntitySql::getInstanceFromString('sede', 'sed')->_json($row);
      $row_["sede_"] = $json;
    }
    if(!is_null($row['sed_ts_id'])){
      $json = EntitySql::getInstanceFromString('tipo_sede', 'sed_ts')->_json($row);
      $row_["sede_"]["tipo_sede_"] = $json;
    }
    if(!is_null($row['sed_dom_id'])){
      $json = EntitySql::getInstanceFromString('domicilio', 'sed_dom')->_json($row);
      $row_["sede_"]["domicilio_"] = $json;
    }
    if(!is_null($row['sed_coo_id'])){
      $json = EntitySql::getInstanceFromString('id_persona', 'sed_coo')->_json($row);
      $row_["sede_"]["coordinador_"] = $json;
    }
    if(!is_null($row['sed_ref_id'])){
      $json = EntitySql::getInstanceFromString('id_persona', 'sed_ref')->_json($row);
      $row_["sede_"]["referente_"] = $json;
    }
    return $row_;
  }

  public function values(array $row){
    $row_ = [];

    $json = ($row && !is_null($row['id'])) ? $this->sql->_json($row) : null;
    $row_["referente"] = EntityValues::getInstanceFromString("referente", $json);

    $json = ($row && !is_null($row['per_id'])) ? EntitySql::getInstanceFromString('id_persona', 'per')->_json($row) : null;
    $row_["persona"] = EntityValues::getInstanceFromString('id_persona', $json);

    $json = ($row && !is_null($row['sed_id'])) ? EntitySql::getInstanceFromString('sede', 'sed')->_json($row) : null;
    $row_["sede"] = EntityValues::getInstanceFromString('sede', $json);

    $json = ($row && !is_null($row['sed_ts_id'])) ? EntitySql::getInstanceFromString('tipo_sede', 'sed_ts')->_json($row) : null;
    $row_["tipo_sede"] = EntityValues::getInstanceFromString('tipo_sede', $json);

    $json = ($row && !is_null($row['sed_dom_id'])) ? EntitySql::getInstanceFromString('domicilio', 'sed_dom')->_json($row) : null;
    $row_["domicilio"] = EntityValues::getInstanceFromString('domicilio', $json);

    $json = ($row && !is_null($row['sed_coo_id'])) ? EntitySql::getInstanceFromString('id_persona', 'sed_coo')->_json($row) : null;
    $row_["coordinador"] = EntityValues::getInstanceFromString('id_persona', $json);

    $json = ($row && !is_null($row['sed_ref_id'])) ? EntitySql::getInstanceFromString('id_persona', 'sed_ref')->_json($row) : null;
    $row_["referente1"] = EntityValues::getInstanceFromString('id_persona', $json);

    return $row_;
  }



}
