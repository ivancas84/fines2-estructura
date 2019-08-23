<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");

//Implementacion principal de Sqlo para una entidad especifica
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

    $json = ($row && !is_null($row['id'])) ? $this->sql->_json($row) : null;
    $row_["inasistencia"] = EntityValues::getInstanceRequires("inasistencia", $json);

    $json = ($row && !is_null($row['tom_id'])) ? EntitySql::getInstanceRequire('toma', 'tom')->_json($row) : null;
    $row_["toma"] = EntityValues::getInstanceRequire('toma', $json);

    $json = ($row && !is_null($row['tom_cur_id'])) ? EntitySql::getInstanceRequire('curso', 'tom_cur')->_json($row) : null;
    $row_["curso"] = EntityValues::getInstanceRequire('curso', $json);

    $json = ($row && !is_null($row['tom_cur_com_id'])) ? EntitySql::getInstanceRequire('comision', 'tom_cur_com')->_json($row) : null;
    $row_["comision"] = EntityValues::getInstanceRequire('comision', $json);

    $json = ($row && !is_null($row['tom_cur_com_dvi_id'])) ? EntitySql::getInstanceRequire('division', 'tom_cur_com_dvi')->_json($row) : null;
    $row_["division"] = EntityValues::getInstanceRequire('division', $json);

    $json = ($row && !is_null($row['tom_cur_com_dvi_pla_id'])) ? EntitySql::getInstanceRequire('plan', 'tom_cur_com_dvi_pla')->_json($row) : null;
    $row_["plan"] = EntityValues::getInstanceRequire('plan', $json);

    $json = ($row && !is_null($row['tom_cur_com_dvi_sed_id'])) ? EntitySql::getInstanceRequire('sede', 'tom_cur_com_dvi_sed')->_json($row) : null;
    $row_["sede"] = EntityValues::getInstanceRequire('sede', $json);

    $json = ($row && !is_null($row['tom_cur_com_dvi_sed_ts_id'])) ? EntitySql::getInstanceRequire('tipo_sede', 'tom_cur_com_dvi_sed_ts')->_json($row) : null;
    $row_["tipo_sede"] = EntityValues::getInstanceRequire('tipo_sede', $json);

    $json = ($row && !is_null($row['tom_cur_com_dvi_sed_dom_id'])) ? EntitySql::getInstanceRequire('domicilio', 'tom_cur_com_dvi_sed_dom')->_json($row) : null;
    $row_["domicilio"] = EntityValues::getInstanceRequire('domicilio', $json);

    $json = ($row && !is_null($row['tom_cur_com_dvi_sed_coo_id'])) ? EntitySql::getInstanceRequire('id_persona', 'tom_cur_com_dvi_sed_coo')->_json($row) : null;
    $row_["coordinador"] = EntityValues::getInstanceRequire('id_persona', $json);

    $json = ($row && !is_null($row['tom_cur_com_dvi_sed_ref_id'])) ? EntitySql::getInstanceRequire('id_persona', 'tom_cur_com_dvi_sed_ref')->_json($row) : null;
    $row_["referente"] = EntityValues::getInstanceRequire('id_persona', $json);

    $json = ($row && !is_null($row['tom_cur_ch_id'])) ? EntitySql::getInstanceRequire('carga_horaria', 'tom_cur_ch')->_json($row) : null;
    $row_["carga_horaria"] = EntityValues::getInstanceRequire('carga_horaria', $json);

    $json = ($row && !is_null($row['tom_cur_ch_asi_id'])) ? EntitySql::getInstanceRequire('asignatura', 'tom_cur_ch_asi')->_json($row) : null;
    $row_["asignatura"] = EntityValues::getInstanceRequire('asignatura', $json);

    $json = ($row && !is_null($row['tom_cur_ch_pla_id'])) ? EntitySql::getInstanceRequire('plan', 'tom_cur_ch_pla')->_json($row) : null;
    $row_["plan1"] = EntityValues::getInstanceRequire('plan', $json);

    $json = ($row && !is_null($row['tom_pro_id'])) ? EntitySql::getInstanceRequire('id_persona', 'tom_pro')->_json($row) : null;
    $row_["profesor"] = EntityValues::getInstanceRequire('id_persona', $json);

    $json = ($row && !is_null($row['tom_ree_id'])) ? EntitySql::getInstanceRequire('id_persona', 'tom_ree')->_json($row) : null;
    $row_["reemplaza"] = EntityValues::getInstanceRequire('id_persona', $json);

    return $row_;
  }



}
