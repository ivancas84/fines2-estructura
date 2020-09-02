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
    $row_ = $this->container->getValues($this->entity->getName())->_fromArray($row)->_toArray();
    if(!is_null($row['cur_id'])) $row_["curso_"] = $this->container->getValues('curso')->_fromArray($row, 'cur_')->_toArray();
    if(!is_null($row['cur_com_id'])) $row_["curso_"]["comision_"] = $this->container->getValues('comision')->_fromArray($row, 'cur_com_')->_toArray();
    if(!is_null($row['cur_com_sed_id'])) $row_["curso_"]["comision_"]["sede_"] = $this->container->getValues('sede')->_fromArray($row, 'cur_com_sed_')->_toArray();
    if(!is_null($row['cur_com_sed_dom_id'])) $row_["curso_"]["comision_"]["sede_"]["domicilio_"] = $this->container->getValues('domicilio')->_fromArray($row, 'cur_com_sed_dom_')->_toArray();
    if(!is_null($row['cur_com_sed_ts_id'])) $row_["curso_"]["comision_"]["sede_"]["tipo_sede_"] = $this->container->getValues('tipo_sede')->_fromArray($row, 'cur_com_sed_ts_')->_toArray();
    if(!is_null($row['cur_com_sed_ce_id'])) $row_["curso_"]["comision_"]["sede_"]["centro_educativo_"] = $this->container->getValues('centro_educativo')->_fromArray($row, 'cur_com_sed_ce_')->_toArray();
    if(!is_null($row['cur_com_sed_ce_dom_id'])) $row_["curso_"]["comision_"]["sede_"]["centro_educativo_"]["domicilio_"] = $this->container->getValues('domicilio')->_fromArray($row, 'cur_com_sed_ce_dom_')->_toArray();
    if(!is_null($row['cur_com_moa_id'])) $row_["curso_"]["comision_"]["modalidad_"] = $this->container->getValues('modalidad')->_fromArray($row, 'cur_com_moa_')->_toArray();
    if(!is_null($row['cur_com_pla_id'])) $row_["curso_"]["comision_"]["planificacion_"] = $this->container->getValues('planificacion')->_fromArray($row, 'cur_com_pla_')->_toArray();
    if(!is_null($row['cur_com_pla_plb_id'])) $row_["curso_"]["comision_"]["planificacion_"]["plan_"] = $this->container->getValues('plan')->_fromArray($row, 'cur_com_pla_plb_')->_toArray();
    if(!is_null($row['cur_com_cal_id'])) $row_["curso_"]["comision_"]["calendario_"] = $this->container->getValues('calendario')->_fromArray($row, 'cur_com_cal_')->_toArray();
    if(!is_null($row['cur_asi_id'])) $row_["curso_"]["asignatura_"] = $this->container->getValues('asignatura')->_fromArray($row, 'cur_asi_')->_toArray();
    if(!is_null($row['doc_id'])) $row_["docente_"] = $this->container->getValues('persona')->_fromArray($row, 'doc_')->_toArray();
    if(!is_null($row['doc_dom_id'])) $row_["docente_"]["domicilio_"] = $this->container->getValues('domicilio')->_fromArray($row, 'doc_dom_')->_toArray();
    if(!is_null($row['ree_id'])) $row_["reemplazo_"] = $this->container->getValues('persona')->_fromArray($row, 'ree_')->_toArray();
    if(!is_null($row['ree_dom_id'])) $row_["reemplazo_"]["domicilio_"] = $this->container->getValues('domicilio')->_fromArray($row, 'ree_dom_')->_toArray();
    if(!is_null($row['pd_id'])) $row_["planilla_docente_"] = $this->container->getValues('planilla_docente')->_fromArray($row, 'pd_')->_toArray();
    return $row_;
  }

  public function values(array $row){
    $row_ = [];
    $row_["toma"] = $this->container->getValues("toma")->_fromArray($row);
    $row_["curso"] = $this->container->getValues('curso')->_fromArray($row, 'cur_');
    $row_["comision"] = $this->container->getValues('comision')->_fromArray($row, 'cur_com_');
    $row_["sede"] = $this->container->getValues('sede')->_fromArray($row, 'cur_com_sed_');
    $row_["domicilio"] = $this->container->getValues('domicilio')->_fromArray($row, 'cur_com_sed_dom_');
    $row_["tipo_sede"] = $this->container->getValues('tipo_sede')->_fromArray($row, 'cur_com_sed_ts_');
    $row_["centro_educativo"] = $this->container->getValues('centro_educativo')->_fromArray($row, 'cur_com_sed_ce_');
    $row_["domicilio1"] = $this->container->getValues('domicilio')->_fromArray($row, 'cur_com_sed_ce_dom_');
    $row_["modalidad"] = $this->container->getValues('modalidad')->_fromArray($row, 'cur_com_moa_');
    $row_["planificacion"] = $this->container->getValues('planificacion')->_fromArray($row, 'cur_com_pla_');
    $row_["plan"] = $this->container->getValues('plan')->_fromArray($row, 'cur_com_pla_plb_');
    $row_["calendario"] = $this->container->getValues('calendario')->_fromArray($row, 'cur_com_cal_');
    $row_["asignatura"] = $this->container->getValues('asignatura')->_fromArray($row, 'cur_asi_');
    $row_["docente"] = $this->container->getValues('persona')->_fromArray($row, 'doc_');
    $row_["domicilio2"] = $this->container->getValues('domicilio')->_fromArray($row, 'doc_dom_');
    $row_["reemplazo"] = $this->container->getValues('persona')->_fromArray($row, 'ree_');
    $row_["domicilio3"] = $this->container->getValues('domicilio')->_fromArray($row, 'ree_dom_');
    $row_["planilla_docente"] = $this->container->getValues('planilla_docente')->_fromArray($row, 'pd_');
    return $row_;
  }



}
