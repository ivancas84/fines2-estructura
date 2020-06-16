<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class _HorarioSqlo extends EntitySqlo {

  public function __construct(){
    /**
     * Se definen todos los recursos de forma independiente, sin parametros en el constructor, para facilitar el polimorfismo de las subclases
     */
    $this->db = Dba::dbInstance();
    $this->entity = Entity::getInstanceRequire('horario');
    $this->sql = EntitySql::getInstanceRequire('horario');
  }

  protected function _insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "hora_inicio, " ;
    $sql .= "hora_fin, " ;
    $sql .= "curso, " ;
    $sql .= "dia, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['hora_inicio'] . ", " ;
    $sql .= $row['hora_fin'] . ", " ;
    $sql .= $row['curso'] . ", " ;
    $sql .= $row['dia'] . ", " ;
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
    if (isset($row['curso'] )) $sql .= "curso = " . $row['curso'] . " ," ;
    if (isset($row['dia'] )) $sql .= "dia = " . $row['dia'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }

  public function json(array $row = null){
    if(empty($row)) return null;
    $row_ = $this->sql->_json($row);
    if(!is_null($row['cur_id'])){
      $json = EntitySql::getInstanceRequire('curso', 'cur')->_json($row);
      $row_["curso_"] = $json;
    }
    if(!is_null($row['cur_com_id'])){
      $json = EntitySql::getInstanceRequire('comision', 'cur_com')->_json($row);
      $row_["curso_"]["comision_"] = $json;
    }
    if(!is_null($row['cur_com_sed_id'])){
      $json = EntitySql::getInstanceRequire('sede', 'cur_com_sed')->_json($row);
      $row_["curso_"]["comision_"]["sede_"] = $json;
    }
    if(!is_null($row['cur_com_sed_dom_id'])){
      $json = EntitySql::getInstanceRequire('domicilio', 'cur_com_sed_dom')->_json($row);
      $row_["curso_"]["comision_"]["sede_"]["domicilio_"] = $json;
    }
    if(!is_null($row['cur_com_sed_ts_id'])){
      $json = EntitySql::getInstanceRequire('tipo_sede', 'cur_com_sed_ts')->_json($row);
      $row_["curso_"]["comision_"]["sede_"]["tipo_sede_"] = $json;
    }
    if(!is_null($row['cur_com_sed_ce_id'])){
      $json = EntitySql::getInstanceRequire('centro_educativo', 'cur_com_sed_ce')->_json($row);
      $row_["curso_"]["comision_"]["sede_"]["centro_educativo_"] = $json;
    }
    if(!is_null($row['cur_com_sed_ce_dom_id'])){
      $json = EntitySql::getInstanceRequire('domicilio', 'cur_com_sed_ce_dom')->_json($row);
      $row_["curso_"]["comision_"]["sede_"]["centro_educativo_"]["domicilio_"] = $json;
    }
    if(!is_null($row['cur_com_sed_coo_id'])){
      $json = EntitySql::getInstanceRequire('persona', 'cur_com_sed_coo')->_json($row);
      $row_["curso_"]["comision_"]["sede_"]["coordinador_"] = $json;
    }
    if(!is_null($row['cur_com_sed_coo_dom_id'])){
      $json = EntitySql::getInstanceRequire('domicilio', 'cur_com_sed_coo_dom')->_json($row);
      $row_["curso_"]["comision_"]["sede_"]["coordinador_"]["domicilio_"] = $json;
    }
    if(!is_null($row['cur_com_moa_id'])){
      $json = EntitySql::getInstanceRequire('modalidad', 'cur_com_moa')->_json($row);
      $row_["curso_"]["comision_"]["modalidad_"] = $json;
    }
    if(!is_null($row['cur_com_pla_id'])){
      $json = EntitySql::getInstanceRequire('planificacion', 'cur_com_pla')->_json($row);
      $row_["curso_"]["comision_"]["planificacion_"] = $json;
    }
    if(!is_null($row['cur_com_pla_plb_id'])){
      $json = EntitySql::getInstanceRequire('plan', 'cur_com_pla_plb')->_json($row);
      $row_["curso_"]["comision_"]["planificacion_"]["plan_"] = $json;
    }
    if(!is_null($row['cur_com_cal_id'])){
      $json = EntitySql::getInstanceRequire('calendario', 'cur_com_cal')->_json($row);
      $row_["curso_"]["comision_"]["calendario_"] = $json;
    }
    if(!is_null($row['cur_asi_id'])){
      $json = EntitySql::getInstanceRequire('asignatura', 'cur_asi')->_json($row);
      $row_["curso_"]["asignatura_"] = $json;
    }
    if(!is_null($row['dia_id'])){
      $json = EntitySql::getInstanceRequire('dia', 'dia')->_json($row);
      $row_["dia_"] = $json;
    }
    return $row_;
  }

  public function values(array $row){
    $row_ = [];

    $row_["horario"] = EntityValues::getInstanceRequire("horario", $row);
    $row_["curso"] = EntityValues::getInstanceRequire('curso', $row, 'cur_');
    $row_["comision"] = EntityValues::getInstanceRequire('comision', $row, 'cur_com_');
    $row_["sede"] = EntityValues::getInstanceRequire('sede', $row, 'cur_com_sed_');
    $row_["domicilio"] = EntityValues::getInstanceRequire('domicilio', $row, 'cur_com_sed_dom_');
    $row_["tipo_sede"] = EntityValues::getInstanceRequire('tipo_sede', $row, 'cur_com_sed_ts_');
    $row_["centro_educativo"] = EntityValues::getInstanceRequire('centro_educativo', $row, 'cur_com_sed_ce_');
    $row_["domicilio1"] = EntityValues::getInstanceRequire('domicilio', $row, 'cur_com_sed_ce_dom_');
    $row_["coordinador"] = EntityValues::getInstanceRequire('persona', $row, 'cur_com_sed_coo_');
    $row_["domicilio2"] = EntityValues::getInstanceRequire('domicilio', $row, 'cur_com_sed_coo_dom_');
    $row_["modalidad"] = EntityValues::getInstanceRequire('modalidad', $row, 'cur_com_moa_');
    $row_["planificacion"] = EntityValues::getInstanceRequire('planificacion', $row, 'cur_com_pla_');
    $row_["plan"] = EntityValues::getInstanceRequire('plan', $row, 'cur_com_pla_plb_');
    $row_["calendario"] = EntityValues::getInstanceRequire('calendario', $row, 'cur_com_cal_');
    $row_["asignatura"] = EntityValues::getInstanceRequire('asignatura', $row, 'cur_asi_');
    $row_["dia"] = EntityValues::getInstanceRequire('dia', $row, 'dia_');
    return $row_;
  }



}
