<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class _TomaSqlo extends EntitySqlo {

  public $entityName = "toma";

  protected function _insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "fecha_toma, " ;
    $sql .= "estado, " ;
    $sql .= "observaciones, " ;
    $sql .= "comentario, " ;
    $sql .= "tipo_movimiento, " ;
    $sql .= "estado_contralor, " ;
    $sql .= "alta, " ;
    $sql .= "curso, " ;
    $sql .= "docente, " ;
    $sql .= "reemplazo, " ;
    $sql .= "planilla_docente, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['fecha_toma'] . ", " ;
    $sql .= $row['estado'] . ", " ;
    $sql .= $row['observaciones'] . ", " ;
    $sql .= $row['comentario'] . ", " ;
    $sql .= $row['tipo_movimiento'] . ", " ;
    $sql .= $row['estado_contralor'] . ", " ;
    $sql .= $row['alta'] . ", " ;
    $sql .= $row['curso'] . ", " ;
    $sql .= $row['docente'] . ", " ;
    $sql .= $row['reemplazo'] . ", " ;
    $sql .= $row['planilla_docente'] . ", " ;
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
    if (isset($row['estado'] )) $sql .= "estado = " . $row['estado'] . " ," ;
    if (isset($row['observaciones'] )) $sql .= "observaciones = " . $row['observaciones'] . " ," ;
    if (isset($row['comentario'] )) $sql .= "comentario = " . $row['comentario'] . " ," ;
    if (isset($row['tipo_movimiento'] )) $sql .= "tipo_movimiento = " . $row['tipo_movimiento'] . " ," ;
    if (isset($row['estado_contralor'] )) $sql .= "estado_contralor = " . $row['estado_contralor'] . " ," ;
    if (isset($row['alta'] )) $sql .= "alta = " . $row['alta'] . " ," ;
    if (isset($row['curso'] )) $sql .= "curso = " . $row['curso'] . " ," ;
    if (isset($row['docente'] )) $sql .= "docente = " . $row['docente'] . " ," ;
    if (isset($row['reemplazo'] )) $sql .= "reemplazo = " . $row['reemplazo'] . " ," ;
    if (isset($row['planilla_docente'] )) $sql .= "planilla_docente = " . $row['planilla_docente'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }

  public function json(array $row = null){
    if(empty($row)) return null;
    $row_ = EntityValues::getInstanceRequire($this->entity->getName())->_fromArray($row)->_toArray();
    if(!is_null($row['cur_id'])) $row_["curso_"] = EntityValues::getInstanceRequire('curso')->_fromArray($row, 'cur_')->_toArray();
    if(!is_null($row['cur_com_id'])) $row_["curso_"]["comision_"] = EntityValues::getInstanceRequire('comision')->_fromArray($row, 'cur_com_')->_toArray();
    if(!is_null($row['cur_com_sed_id'])) $row_["curso_"]["comision_"]["sede_"] = EntityValues::getInstanceRequire('sede')->_fromArray($row, 'cur_com_sed_')->_toArray();
    if(!is_null($row['cur_com_sed_dom_id'])) $row_["curso_"]["comision_"]["sede_"]["domicilio_"] = EntityValues::getInstanceRequire('domicilio')->_fromArray($row, 'cur_com_sed_dom_')->_toArray();
    if(!is_null($row['cur_com_sed_ts_id'])) $row_["curso_"]["comision_"]["sede_"]["tipo_sede_"] = EntityValues::getInstanceRequire('tipo_sede')->_fromArray($row, 'cur_com_sed_ts_')->_toArray();
    if(!is_null($row['cur_com_sed_ce_id'])) $row_["curso_"]["comision_"]["sede_"]["centro_educativo_"] = EntityValues::getInstanceRequire('centro_educativo')->_fromArray($row, 'cur_com_sed_ce_')->_toArray();
    if(!is_null($row['cur_com_sed_ce_dom_id'])) $row_["curso_"]["comision_"]["sede_"]["centro_educativo_"]["domicilio_"] = EntityValues::getInstanceRequire('domicilio')->_fromArray($row, 'cur_com_sed_ce_dom_')->_toArray();
    if(!is_null($row['cur_com_sed_coo_id'])) $row_["curso_"]["comision_"]["sede_"]["coordinador_"] = EntityValues::getInstanceRequire('persona')->_fromArray($row, 'cur_com_sed_coo_')->_toArray();
    if(!is_null($row['cur_com_sed_coo_dom_id'])) $row_["curso_"]["comision_"]["sede_"]["coordinador_"]["domicilio_"] = EntityValues::getInstanceRequire('domicilio')->_fromArray($row, 'cur_com_sed_coo_dom_')->_toArray();
    if(!is_null($row['cur_com_moa_id'])) $row_["curso_"]["comision_"]["modalidad_"] = EntityValues::getInstanceRequire('modalidad')->_fromArray($row, 'cur_com_moa_')->_toArray();
    if(!is_null($row['cur_com_pla_id'])) $row_["curso_"]["comision_"]["planificacion_"] = EntityValues::getInstanceRequire('planificacion')->_fromArray($row, 'cur_com_pla_')->_toArray();
    if(!is_null($row['cur_com_pla_plb_id'])) $row_["curso_"]["comision_"]["planificacion_"]["plan_"] = EntityValues::getInstanceRequire('plan')->_fromArray($row, 'cur_com_pla_plb_')->_toArray();
    if(!is_null($row['cur_com_cal_id'])) $row_["curso_"]["comision_"]["calendario_"] = EntityValues::getInstanceRequire('calendario')->_fromArray($row, 'cur_com_cal_')->_toArray();
    if(!is_null($row['cur_asi_id'])) $row_["curso_"]["asignatura_"] = EntityValues::getInstanceRequire('asignatura')->_fromArray($row, 'cur_asi_')->_toArray();
    if(!is_null($row['doc_id'])) $row_["docente_"] = EntityValues::getInstanceRequire('persona')->_fromArray($row, 'doc_')->_toArray();
    if(!is_null($row['doc_dom_id'])) $row_["docente_"]["domicilio_"] = EntityValues::getInstanceRequire('domicilio')->_fromArray($row, 'doc_dom_')->_toArray();
    if(!is_null($row['ree_id'])) $row_["reemplazo_"] = EntityValues::getInstanceRequire('persona')->_fromArray($row, 'ree_')->_toArray();
    if(!is_null($row['ree_dom_id'])) $row_["reemplazo_"]["domicilio_"] = EntityValues::getInstanceRequire('domicilio')->_fromArray($row, 'ree_dom_')->_toArray();
    if(!is_null($row['pd_id'])) $row_["planilla_docente_"] = EntityValues::getInstanceRequire('planilla_docente')->_fromArray($row, 'pd_')->_toArray();
    return $row_;
  }

  public function values(array $row){
    $row_ = [];
    $row_["toma"] = EntityValues::getInstanceRequire("toma")->_fromArray($row);
    $row_["curso"] = EntityValues::getInstanceRequire('curso')->_fromArray($row, 'cur_');
    $row_["comision"] = EntityValues::getInstanceRequire('comision')->_fromArray($row, 'cur_com_');
    $row_["sede"] = EntityValues::getInstanceRequire('sede')->_fromArray($row, 'cur_com_sed_');
    $row_["domicilio"] = EntityValues::getInstanceRequire('domicilio')->_fromArray($row, 'cur_com_sed_dom_');
    $row_["tipo_sede"] = EntityValues::getInstanceRequire('tipo_sede')->_fromArray($row, 'cur_com_sed_ts_');
    $row_["centro_educativo"] = EntityValues::getInstanceRequire('centro_educativo')->_fromArray($row, 'cur_com_sed_ce_');
    $row_["domicilio1"] = EntityValues::getInstanceRequire('domicilio')->_fromArray($row, 'cur_com_sed_ce_dom_');
    $row_["coordinador"] = EntityValues::getInstanceRequire('persona')->_fromArray($row, 'cur_com_sed_coo_');
    $row_["domicilio2"] = EntityValues::getInstanceRequire('domicilio')->_fromArray($row, 'cur_com_sed_coo_dom_');
    $row_["modalidad"] = EntityValues::getInstanceRequire('modalidad')->_fromArray($row, 'cur_com_moa_');
    $row_["planificacion"] = EntityValues::getInstanceRequire('planificacion')->_fromArray($row, 'cur_com_pla_');
    $row_["plan"] = EntityValues::getInstanceRequire('plan')->_fromArray($row, 'cur_com_pla_plb_');
    $row_["calendario"] = EntityValues::getInstanceRequire('calendario')->_fromArray($row, 'cur_com_cal_');
    $row_["asignatura"] = EntityValues::getInstanceRequire('asignatura')->_fromArray($row, 'cur_asi_');
    $row_["docente"] = EntityValues::getInstanceRequire('persona')->_fromArray($row, 'doc_');
    $row_["domicilio3"] = EntityValues::getInstanceRequire('domicilio')->_fromArray($row, 'doc_dom_');
    $row_["reemplazo"] = EntityValues::getInstanceRequire('persona')->_fromArray($row, 'ree_');
    $row_["domicilio4"] = EntityValues::getInstanceRequire('domicilio')->_fromArray($row, 'ree_dom_');
    $row_["planilla_docente"] = EntityValues::getInstanceRequire('planilla_docente')->_fromArray($row, 'pd_');
    return $row_;
  }



}
