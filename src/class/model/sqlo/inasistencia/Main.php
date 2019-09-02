<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class InasistenciaSqloMain extends EntitySqlo {

  public function __construct(){
    /**
     * Se definen todos los recursos de forma independiente, sin parametros en el constructor, para facilitar el polimorfismo de las subclases
     */
    $this->db = Dba::dbInstance();
    $this->entity = Entity::getInstanceRequire('inasistencia');
    $this->sql = EntitySql::getInstanceRequire('inasistencia');
  }

  protected function _insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "fecha_desde, " ;
    $sql .= "fecha_hasta, " ;
    $sql .= "modulos_semanales, " ;
    $sql .= "modulos_mensuales, " ;
    $sql .= "articulo, " ;
    $sql .= "inciso, " ;
    $sql .= "observaciones, " ;
    $sql .= "toma, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['fecha_desde'] . ", " ;
    $sql .= $row['fecha_hasta'] . ", " ;
    $sql .= $row['modulos_semanales'] . ", " ;
    $sql .= $row['modulos_mensuales'] . ", " ;
    $sql .= $row['articulo'] . ", " ;
    $sql .= $row['inciso'] . ", " ;
    $sql .= $row['observaciones'] . ", " ;
    $sql .= $row['toma'] . ", " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ");
";

    return $sql;
  }

  protected function _update(array $row){ //@override
    $sql = "
UPDATE " . $this->entity->sn_() . " SET
";
    if (isset($row['fecha_desde'] )) $sql .= "fecha_desde = " . $row['fecha_desde'] . " ," ;
    if (isset($row['fecha_hasta'] )) $sql .= "fecha_hasta = " . $row['fecha_hasta'] . " ," ;
    if (isset($row['modulos_semanales'] )) $sql .= "modulos_semanales = " . $row['modulos_semanales'] . " ," ;
    if (isset($row['modulos_mensuales'] )) $sql .= "modulos_mensuales = " . $row['modulos_mensuales'] . " ," ;
    if (isset($row['articulo'] )) $sql .= "articulo = " . $row['articulo'] . " ," ;
    if (isset($row['inciso'] )) $sql .= "inciso = " . $row['inciso'] . " ," ;
    if (isset($row['observaciones'] )) $sql .= "observaciones = " . $row['observaciones'] . " ," ;
    if (isset($row['toma'] )) $sql .= "toma = " . $row['toma'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }

  public function json(array $row){
    if(empty($row)) return null;
    $row_ = $this->sql->_json($row);
    if(!is_null($row['tom_id'])){
      $json = EntitySql::getInstanceRequire('toma', 'tom')->_json($row);
      $row_["toma_"] = $json;
    }
    if(!is_null($row['tom_cur_id'])){
      $json = EntitySql::getInstanceRequire('curso', 'tom_cur')->_json($row);
      $row_["toma_"]["curso_"] = $json;
    }
    if(!is_null($row['tom_cur_com_id'])){
      $json = EntitySql::getInstanceRequire('comision', 'tom_cur_com')->_json($row);
      $row_["toma_"]["curso_"]["comision_"] = $json;
    }
    if(!is_null($row['tom_cur_com_dvi_id'])){
      $json = EntitySql::getInstanceRequire('division', 'tom_cur_com_dvi')->_json($row);
      $row_["toma_"]["curso_"]["comision_"]["division_"] = $json;
    }
    if(!is_null($row['tom_cur_com_dvi_pla_id'])){
      $json = EntitySql::getInstanceRequire('plan', 'tom_cur_com_dvi_pla')->_json($row);
      $row_["toma_"]["curso_"]["comision_"]["division_"]["plan_"] = $json;
    }
    if(!is_null($row['tom_cur_com_dvi_sed_id'])){
      $json = EntitySql::getInstanceRequire('sede', 'tom_cur_com_dvi_sed')->_json($row);
      $row_["toma_"]["curso_"]["comision_"]["division_"]["sede_"] = $json;
    }
    if(!is_null($row['tom_cur_com_dvi_sed_ts_id'])){
      $json = EntitySql::getInstanceRequire('tipo_sede', 'tom_cur_com_dvi_sed_ts')->_json($row);
      $row_["toma_"]["curso_"]["comision_"]["division_"]["sede_"]["tipo_sede_"] = $json;
    }
    if(!is_null($row['tom_cur_com_dvi_sed_dom_id'])){
      $json = EntitySql::getInstanceRequire('domicilio', 'tom_cur_com_dvi_sed_dom')->_json($row);
      $row_["toma_"]["curso_"]["comision_"]["division_"]["sede_"]["domicilio_"] = $json;
    }
    if(!is_null($row['tom_cur_com_dvi_sed_coo_id'])){
      $json = EntitySql::getInstanceRequire('id_persona', 'tom_cur_com_dvi_sed_coo')->_json($row);
      $row_["toma_"]["curso_"]["comision_"]["division_"]["sede_"]["coordinador_"] = $json;
    }
    if(!is_null($row['tom_cur_com_dvi_sed_ref_id'])){
      $json = EntitySql::getInstanceRequire('id_persona', 'tom_cur_com_dvi_sed_ref')->_json($row);
      $row_["toma_"]["curso_"]["comision_"]["division_"]["sede_"]["referente_"] = $json;
    }
    if(!is_null($row['tom_cur_ch_id'])){
      $json = EntitySql::getInstanceRequire('carga_horaria', 'tom_cur_ch')->_json($row);
      $row_["toma_"]["curso_"]["carga_horaria_"] = $json;
    }
    if(!is_null($row['tom_cur_ch_asi_id'])){
      $json = EntitySql::getInstanceRequire('asignatura', 'tom_cur_ch_asi')->_json($row);
      $row_["toma_"]["curso_"]["carga_horaria_"]["asignatura_"] = $json;
    }
    if(!is_null($row['tom_cur_ch_pla_id'])){
      $json = EntitySql::getInstanceRequire('plan', 'tom_cur_ch_pla')->_json($row);
      $row_["toma_"]["curso_"]["carga_horaria_"]["plan_"] = $json;
    }
    if(!is_null($row['tom_pro_id'])){
      $json = EntitySql::getInstanceRequire('id_persona', 'tom_pro')->_json($row);
      $row_["toma_"]["profesor_"] = $json;
    }
    if(!is_null($row['tom_ree_id'])){
      $json = EntitySql::getInstanceRequire('id_persona', 'tom_ree')->_json($row);
      $row_["toma_"]["reemplaza_"] = $json;
    }
    return $row_;
  }

  public function values(array $row){
    $row_ = [];

    $row_["inasistencia"] = EntityValues::getInstanceRequire("inasistencia", $row);
    $row_["toma"] = EntityValues::getInstanceRequire('toma', $row, 'tom_');
    $row_["curso"] = EntityValues::getInstanceRequire('curso', $row, 'tom_cur_');
    $row_["comision"] = EntityValues::getInstanceRequire('comision', $row, 'tom_cur_com_');
    $row_["division"] = EntityValues::getInstanceRequire('division', $row, 'tom_cur_com_dvi_');
    $row_["plan"] = EntityValues::getInstanceRequire('plan', $row, 'tom_cur_com_dvi_pla_');
    $row_["sede"] = EntityValues::getInstanceRequire('sede', $row, 'tom_cur_com_dvi_sed_');
    $row_["tipo_sede"] = EntityValues::getInstanceRequire('tipo_sede', $row, 'tom_cur_com_dvi_sed_ts_');
    $row_["domicilio"] = EntityValues::getInstanceRequire('domicilio', $row, 'tom_cur_com_dvi_sed_dom_');
    $row_["coordinador"] = EntityValues::getInstanceRequire('id_persona', $row, 'tom_cur_com_dvi_sed_coo_');
    $row_["referente"] = EntityValues::getInstanceRequire('id_persona', $row, 'tom_cur_com_dvi_sed_ref_');
    $row_["carga_horaria"] = EntityValues::getInstanceRequire('carga_horaria', $row, 'tom_cur_ch_');
    $row_["asignatura"] = EntityValues::getInstanceRequire('asignatura', $row, 'tom_cur_ch_asi_');
    $row_["plan1"] = EntityValues::getInstanceRequire('plan', $row, 'tom_cur_ch_pla_');
    $row_["profesor"] = EntityValues::getInstanceRequire('id_persona', $row, 'tom_pro_');
    $row_["reemplaza"] = EntityValues::getInstanceRequire('id_persona', $row, 'tom_ree_');
    return $row_;
  }



}
