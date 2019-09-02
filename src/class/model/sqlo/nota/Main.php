<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class NotaSqloMain extends EntitySqlo {

  public function __construct(){
    /**
     * Se definen todos los recursos de forma independiente, sin parametros en el constructor, para facilitar el polimorfismo de las subclases
     */
    $this->db = Dba::dbInstance();
    $this->entity = Entity::getInstanceRequire('nota');
    $this->sql = EntitySql::getInstanceRequire('nota');
  }

  protected function _insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "nota, " ;
    $sql .= "alta, " ;
    $sql .= "profesor, " ;
    $sql .= "curso, " ;
    $sql .= "alumno, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['nota'] . ", " ;
    $sql .= $row['alta'] . ", " ;
    $sql .= $row['profesor'] . ", " ;
    $sql .= $row['curso'] . ", " ;
    $sql .= $row['alumno'] . ", " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ");
";

    return $sql;
  }

  protected function _update(array $row){ //@override
    $sql = "
UPDATE " . $this->entity->sn_() . " SET
";
    if (isset($row['nota'] )) $sql .= "nota = " . $row['nota'] . " ," ;
    if (isset($row['alta'] )) $sql .= "alta = " . $row['alta'] . " ," ;
    if (isset($row['profesor'] )) $sql .= "profesor = " . $row['profesor'] . " ," ;
    if (isset($row['curso'] )) $sql .= "curso = " . $row['curso'] . " ," ;
    if (isset($row['alumno'] )) $sql .= "alumno = " . $row['alumno'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }

  public function json(array $row){
    if(empty($row)) return null;
    $row_ = $this->sql->_json($row);
    if(!is_null($row['pro_id'])){
      $json = EntitySql::getInstanceRequire('id_persona', 'pro')->_json($row);
      $row_["profesor_"] = $json;
    }
    if(!is_null($row['cur_id'])){
      $json = EntitySql::getInstanceRequire('curso', 'cur')->_json($row);
      $row_["curso_"] = $json;
    }
    if(!is_null($row['cur_com_id'])){
      $json = EntitySql::getInstanceRequire('comision', 'cur_com')->_json($row);
      $row_["curso_"]["comision_"] = $json;
    }
    if(!is_null($row['cur_com_dvi_id'])){
      $json = EntitySql::getInstanceRequire('division', 'cur_com_dvi')->_json($row);
      $row_["curso_"]["comision_"]["division_"] = $json;
    }
    if(!is_null($row['cur_com_dvi_pla_id'])){
      $json = EntitySql::getInstanceRequire('plan', 'cur_com_dvi_pla')->_json($row);
      $row_["curso_"]["comision_"]["division_"]["plan_"] = $json;
    }
    if(!is_null($row['cur_com_dvi_sed_id'])){
      $json = EntitySql::getInstanceRequire('sede', 'cur_com_dvi_sed')->_json($row);
      $row_["curso_"]["comision_"]["division_"]["sede_"] = $json;
    }
    if(!is_null($row['cur_com_dvi_sed_ts_id'])){
      $json = EntitySql::getInstanceRequire('tipo_sede', 'cur_com_dvi_sed_ts')->_json($row);
      $row_["curso_"]["comision_"]["division_"]["sede_"]["tipo_sede_"] = $json;
    }
    if(!is_null($row['cur_com_dvi_sed_dom_id'])){
      $json = EntitySql::getInstanceRequire('domicilio', 'cur_com_dvi_sed_dom')->_json($row);
      $row_["curso_"]["comision_"]["division_"]["sede_"]["domicilio_"] = $json;
    }
    if(!is_null($row['cur_com_dvi_sed_coo_id'])){
      $json = EntitySql::getInstanceRequire('id_persona', 'cur_com_dvi_sed_coo')->_json($row);
      $row_["curso_"]["comision_"]["division_"]["sede_"]["coordinador_"] = $json;
    }
    if(!is_null($row['cur_com_dvi_sed_ref_id'])){
      $json = EntitySql::getInstanceRequire('id_persona', 'cur_com_dvi_sed_ref')->_json($row);
      $row_["curso_"]["comision_"]["division_"]["sede_"]["referente_"] = $json;
    }
    if(!is_null($row['cur_ch_id'])){
      $json = EntitySql::getInstanceRequire('carga_horaria', 'cur_ch')->_json($row);
      $row_["curso_"]["carga_horaria_"] = $json;
    }
    if(!is_null($row['cur_ch_asi_id'])){
      $json = EntitySql::getInstanceRequire('asignatura', 'cur_ch_asi')->_json($row);
      $row_["curso_"]["carga_horaria_"]["asignatura_"] = $json;
    }
    if(!is_null($row['cur_ch_pla_id'])){
      $json = EntitySql::getInstanceRequire('plan', 'cur_ch_pla')->_json($row);
      $row_["curso_"]["carga_horaria_"]["plan_"] = $json;
    }
    if(!is_null($row['cur_ta_id'])){
      $json = EntitySql::getInstanceRequire('toma', 'cur_ta')->_json($row);
      $row_["curso_"]["toma_activa_"] = $json;
    }
    if(!is_null($row['cur_ta_pro_id'])){
      $json = EntitySql::getInstanceRequire('id_persona', 'cur_ta_pro')->_json($row);
      $row_["curso_"]["toma_activa_"]["profesor_"] = $json;
    }
    if(!is_null($row['cur_ta_ree_id'])){
      $json = EntitySql::getInstanceRequire('id_persona', 'cur_ta_ree')->_json($row);
      $row_["curso_"]["toma_activa_"]["reemplaza_"] = $json;
    }
    if(!is_null($row['alu_id'])){
      $json = EntitySql::getInstanceRequire('id_persona', 'alu')->_json($row);
      $row_["alumno_"] = $json;
    }
    return $row_;
  }

  public function values(array $row){
    $row_ = [];

    $row_["nota"] = EntityValues::getInstanceRequire("nota", $row);
    $row_["profesor"] = EntityValues::getInstanceRequire('id_persona', $row, 'pro_');
    $row_["curso"] = EntityValues::getInstanceRequire('curso', $row, 'cur_');
    $row_["comision"] = EntityValues::getInstanceRequire('comision', $row, 'cur_com_');
    $row_["division"] = EntityValues::getInstanceRequire('division', $row, 'cur_com_dvi_');
    $row_["plan"] = EntityValues::getInstanceRequire('plan', $row, 'cur_com_dvi_pla_');
    $row_["sede"] = EntityValues::getInstanceRequire('sede', $row, 'cur_com_dvi_sed_');
    $row_["tipo_sede"] = EntityValues::getInstanceRequire('tipo_sede', $row, 'cur_com_dvi_sed_ts_');
    $row_["domicilio"] = EntityValues::getInstanceRequire('domicilio', $row, 'cur_com_dvi_sed_dom_');
    $row_["coordinador"] = EntityValues::getInstanceRequire('id_persona', $row, 'cur_com_dvi_sed_coo_');
    $row_["referente"] = EntityValues::getInstanceRequire('id_persona', $row, 'cur_com_dvi_sed_ref_');
    $row_["carga_horaria"] = EntityValues::getInstanceRequire('carga_horaria', $row, 'cur_ch_');
    $row_["asignatura"] = EntityValues::getInstanceRequire('asignatura', $row, 'cur_ch_asi_');
    $row_["plan1"] = EntityValues::getInstanceRequire('plan', $row, 'cur_ch_pla_');
    $row_["toma_activa"] = EntityValues::getInstanceRequire('toma', $row, 'cur_ta_');
    $row_["profesor1"] = EntityValues::getInstanceRequire('id_persona', $row, 'cur_ta_pro_');
    $row_["reemplaza"] = EntityValues::getInstanceRequire('id_persona', $row, 'cur_ta_ree_');
    $row_["alumno"] = EntityValues::getInstanceRequire('id_persona', $row, 'alu_');
    return $row_;
  }



}
