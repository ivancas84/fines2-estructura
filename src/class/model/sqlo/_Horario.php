<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class _HorarioSqlo extends EntitySqlo {

  public $entityName = "horario";

  public function insert(array $row){ //@override
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

  public function _update(array $row){ //@override
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
    if(!is_null($row['dia_id'])) $row_["dia_"] = $this->container->getValue('dia', 'dia')->_fromArray($row, "set")->_toArray("json");
    return $row_;
  }

  public function values(array $row){
    $row_ = [];
    $row_["horario"] = $this->container->getValue("horario")->_fromArray($row, "set");
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
    $row_["dia"] = $this->container->getValue('dia', 'dia')->_fromArray($row, "set");
    return $row_;
  }



}
