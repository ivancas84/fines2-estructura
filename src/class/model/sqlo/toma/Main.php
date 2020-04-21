<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class TomaSqloMain extends EntitySqlo {

  public function __construct(){
    /**
     * Se definen todos los recursos de forma independiente, sin parametros en el constructor, para facilitar el polimorfismo de las subclases
     */
    $this->db = Dba::dbInstance();
    $this->entity = Entity::getInstanceRequire('toma');
    $this->sql = EntitySql::getInstanceRequire('toma');
  }

  protected function _insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "fecha_toma, " ;
    $sql .= "fecha_inicio, " ;
    $sql .= "fecha_fin, " ;
    $sql .= "fecha_contralor, " ;
    $sql .= "fecha_consejo, " ;
    $sql .= "estado, " ;
    $sql .= "observaciones, " ;
    $sql .= "comentario, " ;
    $sql .= "tipo_movimiento, " ;
    $sql .= "estado_contralor, " ;
    $sql .= "alta, " ;
    $sql .= "curso, " ;
    $sql .= "docente, " ;
    $sql .= "reemplazo, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['fecha_toma'] . ", " ;
    $sql .= $row['fecha_inicio'] . ", " ;
    $sql .= $row['fecha_fin'] . ", " ;
    $sql .= $row['fecha_contralor'] . ", " ;
    $sql .= $row['fecha_consejo'] . ", " ;
    $sql .= $row['estado'] . ", " ;
    $sql .= $row['observaciones'] . ", " ;
    $sql .= $row['comentario'] . ", " ;
    $sql .= $row['tipo_movimiento'] . ", " ;
    $sql .= $row['estado_contralor'] . ", " ;
    $sql .= $row['alta'] . ", " ;
    $sql .= $row['curso'] . ", " ;
    $sql .= $row['docente'] . ", " ;
    $sql .= $row['reemplazo'] . ", " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ");
";

    return $sql;
  }

  protected function _update(array $row){ //@override
    $sql = "
UPDATE " . $this->entity->sn_() . " SET
";
    if (isset($row['fecha_toma'] )) $sql .= "fecha_toma = " . $row['fecha_toma'] . " ," ;
    if (isset($row['fecha_inicio'] )) $sql .= "fecha_inicio = " . $row['fecha_inicio'] . " ," ;
    if (isset($row['fecha_fin'] )) $sql .= "fecha_fin = " . $row['fecha_fin'] . " ," ;
    if (isset($row['fecha_contralor'] )) $sql .= "fecha_contralor = " . $row['fecha_contralor'] . " ," ;
    if (isset($row['fecha_consejo'] )) $sql .= "fecha_consejo = " . $row['fecha_consejo'] . " ," ;
    if (isset($row['estado'] )) $sql .= "estado = " . $row['estado'] . " ," ;
    if (isset($row['observaciones'] )) $sql .= "observaciones = " . $row['observaciones'] . " ," ;
    if (isset($row['comentario'] )) $sql .= "comentario = " . $row['comentario'] . " ," ;
    if (isset($row['tipo_movimiento'] )) $sql .= "tipo_movimiento = " . $row['tipo_movimiento'] . " ," ;
    if (isset($row['estado_contralor'] )) $sql .= "estado_contralor = " . $row['estado_contralor'] . " ," ;
    if (isset($row['alta'] )) $sql .= "alta = " . $row['alta'] . " ," ;
    if (isset($row['curso'] )) $sql .= "curso = " . $row['curso'] . " ," ;
    if (isset($row['docente'] )) $sql .= "docente = " . $row['docente'] . " ," ;
    if (isset($row['reemplazo'] )) $sql .= "reemplazo = " . $row['reemplazo'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }

  public function json(array $row){
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
    if(!is_null($row['cur_com_pla_id'])){
      $json = EntitySql::getInstanceRequire('plan', 'cur_com_pla')->_json($row);
      $row_["curso_"]["comision_"]["plan_"] = $json;
    }
    if(!is_null($row['cur_com_moa_id'])){
      $json = EntitySql::getInstanceRequire('modalidad', 'cur_com_moa')->_json($row);
      $row_["curso_"]["comision_"]["modalidad_"] = $json;
    }
    if(!is_null($row['cur_asi_id'])){
      $json = EntitySql::getInstanceRequire('asignatura', 'cur_asi')->_json($row);
      $row_["curso_"]["asignatura_"] = $json;
    }
    if(!is_null($row['doc_id'])){
      $json = EntitySql::getInstanceRequire('persona', 'doc')->_json($row);
      $row_["docente_"] = $json;
    }
    if(!is_null($row['doc_dom_id'])){
      $json = EntitySql::getInstanceRequire('domicilio', 'doc_dom')->_json($row);
      $row_["docente_"]["domicilio_"] = $json;
    }
    if(!is_null($row['ree_id'])){
      $json = EntitySql::getInstanceRequire('persona', 'ree')->_json($row);
      $row_["reemplazo_"] = $json;
    }
    if(!is_null($row['ree_dom_id'])){
      $json = EntitySql::getInstanceRequire('domicilio', 'ree_dom')->_json($row);
      $row_["reemplazo_"]["domicilio_"] = $json;
    }
    return $row_;
  }

  public function values(array $row){
    $row_ = [];

    $row_["toma"] = EntityValues::getInstanceRequire("toma", $row);
    $row_["curso"] = EntityValues::getInstanceRequire('curso', $row, 'cur_');
    $row_["comision"] = EntityValues::getInstanceRequire('comision', $row, 'cur_com_');
    $row_["sede"] = EntityValues::getInstanceRequire('sede', $row, 'cur_com_sed_');
    $row_["domicilio"] = EntityValues::getInstanceRequire('domicilio', $row, 'cur_com_sed_dom_');
    $row_["tipo_sede"] = EntityValues::getInstanceRequire('tipo_sede', $row, 'cur_com_sed_ts_');
    $row_["centro_educativo"] = EntityValues::getInstanceRequire('centro_educativo', $row, 'cur_com_sed_ce_');
    $row_["domicilio1"] = EntityValues::getInstanceRequire('domicilio', $row, 'cur_com_sed_ce_dom_');
    $row_["coordinador"] = EntityValues::getInstanceRequire('persona', $row, 'cur_com_sed_coo_');
    $row_["domicilio2"] = EntityValues::getInstanceRequire('domicilio', $row, 'cur_com_sed_coo_dom_');
    $row_["plan"] = EntityValues::getInstanceRequire('plan', $row, 'cur_com_pla_');
    $row_["modalidad"] = EntityValues::getInstanceRequire('modalidad', $row, 'cur_com_moa_');
    $row_["asignatura"] = EntityValues::getInstanceRequire('asignatura', $row, 'cur_asi_');
    $row_["docente"] = EntityValues::getInstanceRequire('persona', $row, 'doc_');
    $row_["domicilio3"] = EntityValues::getInstanceRequire('domicilio', $row, 'doc_dom_');
    $row_["reemplazo"] = EntityValues::getInstanceRequire('persona', $row, 'ree_');
    $row_["domicilio4"] = EntityValues::getInstanceRequire('domicilio', $row, 'ree_dom_');
    return $row_;
  }



}
