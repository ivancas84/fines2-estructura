<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class CursoSqloMain extends EntitySqlo {

  public function __construct(){
    /**
     * Se definen todos los recursos de forma independiente, sin parametros en el constructor, para facilitar el polimorfismo de las subclases
     */
    $this->db = Dba::dbInstance();
    $this->entity = Entity::getInstanceRequire('curso');
    $this->sql = EntitySql::getInstanceRequire('curso');
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
      $json = EntitySql::getInstanceRequire('comision', 'com')->_json($row);
      $row_["comision_"] = $json;
    }
    if(!is_null($row['com_dvi_id'])){
      $json = EntitySql::getInstanceRequire('division', 'com_dvi')->_json($row);
      $row_["comision_"]["division_"] = $json;
    }
    if(!is_null($row['com_dvi_pla_id'])){
      $json = EntitySql::getInstanceRequire('plan', 'com_dvi_pla')->_json($row);
      $row_["comision_"]["division_"]["plan_"] = $json;
    }
    if(!is_null($row['com_dvi_sed_id'])){
      $json = EntitySql::getInstanceRequire('sede', 'com_dvi_sed')->_json($row);
      $row_["comision_"]["division_"]["sede_"] = $json;
    }
    if(!is_null($row['com_dvi_sed_ts_id'])){
      $json = EntitySql::getInstanceRequire('tipo_sede', 'com_dvi_sed_ts')->_json($row);
      $row_["comision_"]["division_"]["sede_"]["tipo_sede_"] = $json;
    }
    if(!is_null($row['com_dvi_sed_dom_id'])){
      $json = EntitySql::getInstanceRequire('domicilio', 'com_dvi_sed_dom')->_json($row);
      $row_["comision_"]["division_"]["sede_"]["domicilio_"] = $json;
    }
    if(!is_null($row['com_dvi_sed_coo_id'])){
      $json = EntitySql::getInstanceRequire('id_persona', 'com_dvi_sed_coo')->_json($row);
      $row_["comision_"]["division_"]["sede_"]["coordinador_"] = $json;
    }
    if(!is_null($row['com_dvi_sed_ref_id'])){
      $json = EntitySql::getInstanceRequire('id_persona', 'com_dvi_sed_ref')->_json($row);
      $row_["comision_"]["division_"]["sede_"]["referente_"] = $json;
    }
    if(!is_null($row['ch_id'])){
      $json = EntitySql::getInstanceRequire('carga_horaria', 'ch')->_json($row);
      $row_["carga_horaria_"] = $json;
    }
    if(!is_null($row['ch_asi_id'])){
      $json = EntitySql::getInstanceRequire('asignatura', 'ch_asi')->_json($row);
      $row_["carga_horaria_"]["asignatura_"] = $json;
    }
    if(!is_null($row['ch_pla_id'])){
      $json = EntitySql::getInstanceRequire('plan', 'ch_pla')->_json($row);
      $row_["carga_horaria_"]["plan_"] = $json;
    }
    if(!is_null($row['ta_id'])){
      $json = EntitySql::getInstanceRequire('toma', 'ta')->_json($row);
      $row_["toma_activa_"] = $json;
    }
    if(!is_null($row['ta_pro_id'])){
      $json = EntitySql::getInstanceRequire('id_persona', 'ta_pro')->_json($row);
      $row_["toma_activa_"]["profesor_"] = $json;
    }
    if(!is_null($row['ta_ree_id'])){
      $json = EntitySql::getInstanceRequire('id_persona', 'ta_ree')->_json($row);
      $row_["toma_activa_"]["reemplaza_"] = $json;
    }
    return $row_;
  }

  public function values(array $row){
    $row_ = [];

    $row_["curso"] = EntityValues::getInstanceRequire("curso", $row);
    $row_["comision"] = EntityValues::getInstanceRequire('comision', $row, 'com_');
    $row_["division"] = EntityValues::getInstanceRequire('division', $row, 'com_dvi_');
    $row_["plan"] = EntityValues::getInstanceRequire('plan', $row, 'com_dvi_pla_');
    $row_["sede"] = EntityValues::getInstanceRequire('sede', $row, 'com_dvi_sed_');
    $row_["tipo_sede"] = EntityValues::getInstanceRequire('tipo_sede', $row, 'com_dvi_sed_ts_');
    $row_["domicilio"] = EntityValues::getInstanceRequire('domicilio', $row, 'com_dvi_sed_dom_');
    $row_["coordinador"] = EntityValues::getInstanceRequire('id_persona', $row, 'com_dvi_sed_coo_');
    $row_["referente"] = EntityValues::getInstanceRequire('id_persona', $row, 'com_dvi_sed_ref_');
    $row_["carga_horaria"] = EntityValues::getInstanceRequire('carga_horaria', $row, 'ch_');
    $row_["asignatura"] = EntityValues::getInstanceRequire('asignatura', $row, 'ch_asi_');
    $row_["plan1"] = EntityValues::getInstanceRequire('plan', $row, 'ch_pla_');
    $row_["toma_activa"] = EntityValues::getInstanceRequire('toma', $row, 'ta_');
    $row_["profesor"] = EntityValues::getInstanceRequire('id_persona', $row, 'ta_pro_');
    $row_["reemplaza"] = EntityValues::getInstanceRequire('id_persona', $row, 'ta_ree_');
    return $row_;
  }



}
