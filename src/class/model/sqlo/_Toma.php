<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class _TomaSqlo extends EntitySqlo {

  public $entityName = "toma";

  public function insert(array $row){ //@override
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

  public function _update(array $row){ //@override
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
    $row_ = $this->container->getValue($this->entity->getName())->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['cur_id'])) $row_["curso_"] = $this->container->getValue('curso', 'cur')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['cur_com_id'])) $row_["curso_"]["comision_"] = $this->container->getValue('comision', 'cur_com')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['cur_com_sed_id'])) $row_["curso_"]["comision_"]["sede_"] = $this->container->getValue('sede', 'cur_com_sed')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['cur_com_sed_dom_id'])) $row_["curso_"]["comision_"]["sede_"]["domicilio_"] = $this->container->getValue('domicilio', 'cur_com_sed_dom')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['cur_com_sed_ts_id'])) $row_["curso_"]["comision_"]["sede_"]["tipo_sede_"] = $this->container->getValue('tipo_sede', 'cur_com_sed_ts')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['cur_com_sed_ce_id'])) $row_["curso_"]["comision_"]["sede_"]["centro_educativo_"] = $this->container->getValue('centro_educativo', 'cur_com_sed_ce')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['cur_com_sed_ce_dom_id'])) $row_["curso_"]["comision_"]["sede_"]["centro_educativo_"]["domicilio_"] = $this->container->getValue('domicilio', 'cur_com_sed_ce_dom')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['cur_com_moa_id'])) $row_["curso_"]["comision_"]["modalidad_"] = $this->container->getValue('modalidad', 'cur_com_moa')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['cur_com_pla_id'])) $row_["curso_"]["comision_"]["planificacion_"] = $this->container->getValue('planificacion', 'cur_com_pla')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['cur_com_pla_plb_id'])) $row_["curso_"]["comision_"]["planificacion_"]["plan_"] = $this->container->getValue('plan', 'cur_com_pla_plb')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['cur_com_cal_id'])) $row_["curso_"]["comision_"]["calendario_"] = $this->container->getValue('calendario', 'cur_com_cal')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['cur_asi_id'])) $row_["curso_"]["asignatura_"] = $this->container->getValue('asignatura', 'cur_asi')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['doc_id'])) $row_["docente_"] = $this->container->getValue('persona', 'doc')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['doc_dom_id'])) $row_["docente_"]["domicilio_"] = $this->container->getValue('domicilio', 'doc_dom')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['ree_id'])) $row_["reemplazo_"] = $this->container->getValue('persona', 'ree')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['ree_dom_id'])) $row_["reemplazo_"]["domicilio_"] = $this->container->getValue('domicilio', 'ree_dom')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['pd_id'])) $row_["planilla_docente_"] = $this->container->getValue('planilla_docente', 'pd')->_fromArray($row, "set")->_toArray("json");
    return $row_;
  }

  public function values(array $row){
    $row_ = [];
    $row_["toma"] = $this->container->getValue("toma")->_fromArray($row, "set");
    $row_["curso"] = $this->container->getValue('curso', 'cur')->_fromArray($row, "set");
    $row_["comision"] = $this->container->getValue('comision', 'cur_com')->_fromArray($row, "set");
    $row_["sede"] = $this->container->getValue('sede', 'cur_com_sed')->_fromArray($row, "set");
    $row_["domicilio"] = $this->container->getValue('domicilio', 'cur_com_sed_dom')->_fromArray($row, "set");
    $row_["tipo_sede"] = $this->container->getValue('tipo_sede', 'cur_com_sed_ts')->_fromArray($row, "set");
    $row_["centro_educativo"] = $this->container->getValue('centro_educativo', 'cur_com_sed_ce')->_fromArray($row, "set");
    $row_["domicilio1"] = $this->container->getValue('domicilio', 'cur_com_sed_ce_dom')->_fromArray($row, "set");
    $row_["modalidad"] = $this->container->getValue('modalidad', 'cur_com_moa')->_fromArray($row, "set");
    $row_["planificacion"] = $this->container->getValue('planificacion', 'cur_com_pla')->_fromArray($row, "set");
    $row_["plan"] = $this->container->getValue('plan', 'cur_com_pla_plb')->_fromArray($row, "set");
    $row_["calendario"] = $this->container->getValue('calendario', 'cur_com_cal')->_fromArray($row, "set");
    $row_["asignatura"] = $this->container->getValue('asignatura', 'cur_asi')->_fromArray($row, "set");
    $row_["docente"] = $this->container->getValue('persona', 'doc')->_fromArray($row, "set");
    $row_["domicilio2"] = $this->container->getValue('domicilio', 'doc_dom')->_fromArray($row, "set");
    $row_["reemplazo"] = $this->container->getValue('persona', 'ree')->_fromArray($row, "set");
    $row_["domicilio3"] = $this->container->getValue('domicilio', 'ree_dom')->_fromArray($row, "set");
    $row_["planilla_docente"] = $this->container->getValue('planilla_docente', 'pd')->_fromArray($row, "set");
    return $row_;
  }



}
