<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class _HorarioSqlo extends EntitySqlo {

  public $entityName = "horario";

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
    if(!is_null($row['dia_id'])) $row_["dia_"] = EntityValues::getInstanceRequire('dia')->_fromArray($row, 'dia_')->_toArray();
    return $row_;
  }

  public function values(array $row){
    $row_ = [];
    $row_["horario"] = EntityValues::getInstanceRequire("horario")->_fromArray($row);
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
    $row_["dia"] = EntityValues::getInstanceRequire('dia')->_fromArray($row, 'dia_');
    return $row_;
  }



}
