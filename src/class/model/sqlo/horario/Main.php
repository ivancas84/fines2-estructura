<?php

require_once("class/model/Sqlo.php");

//Implementacion principal de Sqlo para una entidad especifica
class HorarioSqloMain extends EntitySqlo {

  public function __construct(){
    /**
     * Se definen todos los recursos de forma independiente, sin parametros en el constructor, para facilitar el polimorfismo de las subclases
     */
    $this->db = Dba::dbInstance();
    $this->entity = Entity::getInstanceFromString('horario');
    $this->sql = EntitySql::getInstanceFromString('horario');
  }

  protected function _insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "hora_inicio, " ;
    $sql .= "hora_fin, " ;
    $sql .= "dia, " ;
    $sql .= "curso, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['hora_inicio'] . ", " ;
    $sql .= $row['hora_fin'] . ", " ;
    $sql .= $row['dia'] . ", " ;
    $sql .= $row['curso'] . ", " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ");
";

    return $sql;
  }

  protected function _update(array $row){ //@override
    $sql = "
UPDATE " . $this->entity->sn_() . " SET
";
    if (isset($row['hora_inicio'] )) $sql .= "hora_inicio = " . $row['hora_inicio'] . " ," ;
    if (isset($row['hora_fin'] )) $sql .= "hora_fin = " . $row['hora_fin'] . " ," ;
    if (isset($row['dia'] )) $sql .= "dia = " . $row['dia'] . " ," ;
    if (isset($row['curso'] )) $sql .= "curso = " . $row['curso'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }

  public function json(array $row){
    if(empty($row)) return null;
    $row_ = $this->sql->_json($row);
    if(!is_null($row['dia_id'])){
      $json = EntitySql::getInstanceFromString('dia', 'dia')->_json($row);
      $row_["dia_"] = $json;
    }
    if(!is_null($row['cur_id'])){
      $json = EntitySql::getInstanceFromString('curso', 'cur')->_json($row);
      $row_["curso_"] = $json;
    }
    if(!is_null($row['cur_com_id'])){
      $json = EntitySql::getInstanceFromString('comision', 'cur_com')->_json($row);
      $row_["curso_"]["comision_"] = $json;
    }
    if(!is_null($row['cur_com_dvi_id'])){
      $json = EntitySql::getInstanceFromString('division', 'cur_com_dvi')->_json($row);
      $row_["curso_"]["comision_"]["division_"] = $json;
    }
    if(!is_null($row['cur_com_dvi_pla_id'])){
      $json = EntitySql::getInstanceFromString('plan', 'cur_com_dvi_pla')->_json($row);
      $row_["curso_"]["comision_"]["division_"]["plan_"] = $json;
    }
    if(!is_null($row['cur_com_dvi_sed_id'])){
      $json = EntitySql::getInstanceFromString('sede', 'cur_com_dvi_sed')->_json($row);
      $row_["curso_"]["comision_"]["division_"]["sede_"] = $json;
    }
    if(!is_null($row['cur_com_dvi_sed_ts_id'])){
      $json = EntitySql::getInstanceFromString('tipo_sede', 'cur_com_dvi_sed_ts')->_json($row);
      $row_["curso_"]["comision_"]["division_"]["sede_"]["tipo_sede_"] = $json;
    }
    if(!is_null($row['cur_com_dvi_sed_dom_id'])){
      $json = EntitySql::getInstanceFromString('domicilio', 'cur_com_dvi_sed_dom')->_json($row);
      $row_["curso_"]["comision_"]["division_"]["sede_"]["domicilio_"] = $json;
    }
    if(!is_null($row['cur_com_dvi_sed_coo_id'])){
      $json = EntitySql::getInstanceFromString('id_persona', 'cur_com_dvi_sed_coo')->_json($row);
      $row_["curso_"]["comision_"]["division_"]["sede_"]["coordinador_"] = $json;
    }
    if(!is_null($row['cur_com_dvi_sed_ref_id'])){
      $json = EntitySql::getInstanceFromString('id_persona', 'cur_com_dvi_sed_ref')->_json($row);
      $row_["curso_"]["comision_"]["division_"]["sede_"]["referente_"] = $json;
    }
    if(!is_null($row['cur_ch_id'])){
      $json = EntitySql::getInstanceFromString('carga_horaria', 'cur_ch')->_json($row);
      $row_["curso_"]["carga_horaria_"] = $json;
    }
    if(!is_null($row['cur_ch_asi_id'])){
      $json = EntitySql::getInstanceFromString('asignatura', 'cur_ch_asi')->_json($row);
      $row_["curso_"]["carga_horaria_"]["asignatura_"] = $json;
    }
    if(!is_null($row['cur_ch_pla_id'])){
      $json = EntitySql::getInstanceFromString('plan', 'cur_ch_pla')->_json($row);
      $row_["curso_"]["carga_horaria_"]["plan_"] = $json;
    }
    if(!is_null($row['cur_ta_id'])){
      $json = EntitySql::getInstanceFromString('toma', 'cur_ta')->_json($row);
      $row_["curso_"]["toma_activa_"] = $json;
    }
    if(!is_null($row['cur_ta_pro_id'])){
      $json = EntitySql::getInstanceFromString('id_persona', 'cur_ta_pro')->_json($row);
      $row_["curso_"]["toma_activa_"]["profesor_"] = $json;
    }
    if(!is_null($row['cur_ta_ree_id'])){
      $json = EntitySql::getInstanceFromString('id_persona', 'cur_ta_ree')->_json($row);
      $row_["curso_"]["toma_activa_"]["reemplaza_"] = $json;
    }
    return $row_;
  }

  public function values(array $row){
    $row_ = [];

    $json = ($row && !is_null($row['id'])) ? $this->sql->_json($row) : null;
    $row_["horario"] = EntityValues::getInstanceFromString("horario", $json);

    $json = ($row && !is_null($row['dia_id'])) ? EntitySql::getInstanceFromString('dia', 'dia')->_json($row) : null;
    $row_["dia"] = EntityValues::getInstanceFromString('dia', $json);

    $json = ($row && !is_null($row['cur_id'])) ? EntitySql::getInstanceFromString('curso', 'cur')->_json($row) : null;
    $row_["curso"] = EntityValues::getInstanceFromString('curso', $json);

    $json = ($row && !is_null($row['cur_com_id'])) ? EntitySql::getInstanceFromString('comision', 'cur_com')->_json($row) : null;
    $row_["comision"] = EntityValues::getInstanceFromString('comision', $json);

    $json = ($row && !is_null($row['cur_com_dvi_id'])) ? EntitySql::getInstanceFromString('division', 'cur_com_dvi')->_json($row) : null;
    $row_["division"] = EntityValues::getInstanceFromString('division', $json);

    $json = ($row && !is_null($row['cur_com_dvi_pla_id'])) ? EntitySql::getInstanceFromString('plan', 'cur_com_dvi_pla')->_json($row) : null;
    $row_["plan"] = EntityValues::getInstanceFromString('plan', $json);

    $json = ($row && !is_null($row['cur_com_dvi_sed_id'])) ? EntitySql::getInstanceFromString('sede', 'cur_com_dvi_sed')->_json($row) : null;
    $row_["sede"] = EntityValues::getInstanceFromString('sede', $json);

    $json = ($row && !is_null($row['cur_com_dvi_sed_ts_id'])) ? EntitySql::getInstanceFromString('tipo_sede', 'cur_com_dvi_sed_ts')->_json($row) : null;
    $row_["tipo_sede"] = EntityValues::getInstanceFromString('tipo_sede', $json);

    $json = ($row && !is_null($row['cur_com_dvi_sed_dom_id'])) ? EntitySql::getInstanceFromString('domicilio', 'cur_com_dvi_sed_dom')->_json($row) : null;
    $row_["domicilio"] = EntityValues::getInstanceFromString('domicilio', $json);

    $json = ($row && !is_null($row['cur_com_dvi_sed_coo_id'])) ? EntitySql::getInstanceFromString('id_persona', 'cur_com_dvi_sed_coo')->_json($row) : null;
    $row_["coordinador"] = EntityValues::getInstanceFromString('id_persona', $json);

    $json = ($row && !is_null($row['cur_com_dvi_sed_ref_id'])) ? EntitySql::getInstanceFromString('id_persona', 'cur_com_dvi_sed_ref')->_json($row) : null;
    $row_["referente"] = EntityValues::getInstanceFromString('id_persona', $json);

    $json = ($row && !is_null($row['cur_ch_id'])) ? EntitySql::getInstanceFromString('carga_horaria', 'cur_ch')->_json($row) : null;
    $row_["carga_horaria"] = EntityValues::getInstanceFromString('carga_horaria', $json);

    $json = ($row && !is_null($row['cur_ch_asi_id'])) ? EntitySql::getInstanceFromString('asignatura', 'cur_ch_asi')->_json($row) : null;
    $row_["asignatura"] = EntityValues::getInstanceFromString('asignatura', $json);

    $json = ($row && !is_null($row['cur_ch_pla_id'])) ? EntitySql::getInstanceFromString('plan', 'cur_ch_pla')->_json($row) : null;
    $row_["plan1"] = EntityValues::getInstanceFromString('plan', $json);

    $json = ($row && !is_null($row['cur_ta_id'])) ? EntitySql::getInstanceFromString('toma', 'cur_ta')->_json($row) : null;
    $row_["toma_activa"] = EntityValues::getInstanceFromString('toma', $json);

    $json = ($row && !is_null($row['cur_ta_pro_id'])) ? EntitySql::getInstanceFromString('id_persona', 'cur_ta_pro')->_json($row) : null;
    $row_["profesor"] = EntityValues::getInstanceFromString('id_persona', $json);

    $json = ($row && !is_null($row['cur_ta_ree_id'])) ? EntitySql::getInstanceFromString('id_persona', 'cur_ta_ree')->_json($row) : null;
    $row_["reemplaza"] = EntityValues::getInstanceFromString('id_persona', $json);

    return $row_;
  }



}
