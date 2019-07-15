<?php

require_once("class/model/Sqlo.php");

//Implementacion principal de Sqlo para una entidad especifica
class CursoSqloMain extends EntitySqlo {

  public function __construct(){
    /**
     * Se definen todos los recursos de forma independiente, sin parametros en el constructor, para facilitar el polimorfismo de las subclases
     */
    $this->db = Dba::dbInstance();
    $this->entity = Entity::getInstanceFromString('curso');
    $this->sql = EntitySql::getInstanceFromString('curso');
  }

  protected function _insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "estado, " ;
    $sql .= "alta, " ;
    $sql .= "baja, " ;
    $sql .= "comision, " ;
    $sql .= "carga_horaria, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['estado'] . ", " ;
    $sql .= $row['alta'] . ", " ;
    $sql .= $row['baja'] . ", " ;
    $sql .= $row['comision'] . ", " ;
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
    if (isset($row['estado'] )) $sql .= "estado = " . $row['estado'] . " ," ;
    if (isset($row['alta'] )) $sql .= "alta = " . $row['alta'] . " ," ;
    if (isset($row['baja'] )) $sql .= "baja = " . $row['baja'] . " ," ;
    if (isset($row['comision'] )) $sql .= "comision = " . $row['comision'] . " ," ;
    if (isset($row['carga_horaria'] )) $sql .= "carga_horaria = " . $row['carga_horaria'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }

  public function json(array $row){
    if(empty($row)) return null;
    $row_ = $this->sql->_json($row);
    if(!is_null($row['com_id'])){
      $json = EntitySql::getInstanceFromString('comision', 'com')->_json($row);
      $row_["comision_"] = $json;
    }
    if(!is_null($row['com_dvi_id'])){
      $json = EntitySql::getInstanceFromString('division', 'com_dvi')->_json($row);
      $row_["comision_"]["division_"] = $json;
    }
    if(!is_null($row['com_dvi_pla_id'])){
      $json = EntitySql::getInstanceFromString('plan', 'com_dvi_pla')->_json($row);
      $row_["comision_"]["division_"]["plan_"] = $json;
    }
    if(!is_null($row['com_dvi_sed_id'])){
      $json = EntitySql::getInstanceFromString('sede', 'com_dvi_sed')->_json($row);
      $row_["comision_"]["division_"]["sede_"] = $json;
    }
    if(!is_null($row['com_dvi_sed_ts_id'])){
      $json = EntitySql::getInstanceFromString('tipo_sede', 'com_dvi_sed_ts')->_json($row);
      $row_["comision_"]["division_"]["sede_"]["tipo_sede_"] = $json;
    }
    if(!is_null($row['com_dvi_sed_dom_id'])){
      $json = EntitySql::getInstanceFromString('domicilio', 'com_dvi_sed_dom')->_json($row);
      $row_["comision_"]["division_"]["sede_"]["domicilio_"] = $json;
    }
    if(!is_null($row['com_dvi_sed_coo_id'])){
      $json = EntitySql::getInstanceFromString('id_persona', 'com_dvi_sed_coo')->_json($row);
      $row_["comision_"]["division_"]["sede_"]["coordinador_"] = $json;
    }
    if(!is_null($row['com_dvi_sed_ref_id'])){
      $json = EntitySql::getInstanceFromString('id_persona', 'com_dvi_sed_ref')->_json($row);
      $row_["comision_"]["division_"]["sede_"]["referente_"] = $json;
    }
    if(!is_null($row['ch_id'])){
      $json = EntitySql::getInstanceFromString('carga_horaria', 'ch')->_json($row);
      $row_["carga_horaria_"] = $json;
    }
    if(!is_null($row['ch_asi_id'])){
      $json = EntitySql::getInstanceFromString('asignatura', 'ch_asi')->_json($row);
      $row_["carga_horaria_"]["asignatura_"] = $json;
    }
    if(!is_null($row['ch_pla_id'])){
      $json = EntitySql::getInstanceFromString('plan', 'ch_pla')->_json($row);
      $row_["carga_horaria_"]["plan_"] = $json;
    }
    if(!is_null($row['ta_id'])){
      $json = EntitySql::getInstanceFromString('toma', 'ta')->_json($row);
      $row_["toma_activa_"] = $json;
    }
    if(!is_null($row['ta_pro_id'])){
      $json = EntitySql::getInstanceFromString('id_persona', 'ta_pro')->_json($row);
      $row_["toma_activa_"]["profesor_"] = $json;
    }
    if(!is_null($row['ta_ree_id'])){
      $json = EntitySql::getInstanceFromString('id_persona', 'ta_ree')->_json($row);
      $row_["toma_activa_"]["reemplaza_"] = $json;
    }
    return $row_;
  }

  public function values(array $row){
    $row_ = [];

    $json = ($row && !is_null($row['id'])) ? $this->sql->_json($row) : null;
    $row_["curso"] = EntityValues::getInstanceFromString("curso", $json);

    $json = ($row && !is_null($row['com_id'])) ? EntitySql::getInstanceFromString('comision', 'com')->_json($row) : null;
    $row_["comision"] = EntityValues::getInstanceFromString('comision', $json);

    $json = ($row && !is_null($row['com_dvi_id'])) ? EntitySql::getInstanceFromString('division', 'com_dvi')->_json($row) : null;
    $row_["division"] = EntityValues::getInstanceFromString('division', $json);

    $json = ($row && !is_null($row['com_dvi_pla_id'])) ? EntitySql::getInstanceFromString('plan', 'com_dvi_pla')->_json($row) : null;
    $row_["plan"] = EntityValues::getInstanceFromString('plan', $json);

    $json = ($row && !is_null($row['com_dvi_sed_id'])) ? EntitySql::getInstanceFromString('sede', 'com_dvi_sed')->_json($row) : null;
    $row_["sede"] = EntityValues::getInstanceFromString('sede', $json);

    $json = ($row && !is_null($row['com_dvi_sed_ts_id'])) ? EntitySql::getInstanceFromString('tipo_sede', 'com_dvi_sed_ts')->_json($row) : null;
    $row_["tipo_sede"] = EntityValues::getInstanceFromString('tipo_sede', $json);

    $json = ($row && !is_null($row['com_dvi_sed_dom_id'])) ? EntitySql::getInstanceFromString('domicilio', 'com_dvi_sed_dom')->_json($row) : null;
    $row_["domicilio"] = EntityValues::getInstanceFromString('domicilio', $json);

    $json = ($row && !is_null($row['com_dvi_sed_coo_id'])) ? EntitySql::getInstanceFromString('id_persona', 'com_dvi_sed_coo')->_json($row) : null;
    $row_["coordinador"] = EntityValues::getInstanceFromString('id_persona', $json);

    $json = ($row && !is_null($row['com_dvi_sed_ref_id'])) ? EntitySql::getInstanceFromString('id_persona', 'com_dvi_sed_ref')->_json($row) : null;
    $row_["referente"] = EntityValues::getInstanceFromString('id_persona', $json);

    $json = ($row && !is_null($row['ch_id'])) ? EntitySql::getInstanceFromString('carga_horaria', 'ch')->_json($row) : null;
    $row_["carga_horaria"] = EntityValues::getInstanceFromString('carga_horaria', $json);

    $json = ($row && !is_null($row['ch_asi_id'])) ? EntitySql::getInstanceFromString('asignatura', 'ch_asi')->_json($row) : null;
    $row_["asignatura"] = EntityValues::getInstanceFromString('asignatura', $json);

    $json = ($row && !is_null($row['ch_pla_id'])) ? EntitySql::getInstanceFromString('plan', 'ch_pla')->_json($row) : null;
    $row_["plan1"] = EntityValues::getInstanceFromString('plan', $json);

    $json = ($row && !is_null($row['ta_id'])) ? EntitySql::getInstanceFromString('toma', 'ta')->_json($row) : null;
    $row_["toma_activa"] = EntityValues::getInstanceFromString('toma', $json);

    $json = ($row && !is_null($row['ta_pro_id'])) ? EntitySql::getInstanceFromString('id_persona', 'ta_pro')->_json($row) : null;
    $row_["profesor"] = EntityValues::getInstanceFromString('id_persona', $json);

    $json = ($row && !is_null($row['ta_ree_id'])) ? EntitySql::getInstanceFromString('id_persona', 'ta_ree')->_json($row) : null;
    $row_["reemplaza"] = EntityValues::getInstanceFromString('id_persona', $json);

    return $row_;
  }



}
