<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class _CursoSqlo extends EntitySqlo {

  public $entityName = "curso";

  public function insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "horas_catedra, " ;
    $sql .= "ige, " ;
    $sql .= "numero_documento_designado, " ;
    $sql .= "alta, " ;
    $sql .= "comision, " ;
    $sql .= "asignatura, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['horas_catedra'] . ", " ;
    $sql .= $row['ige'] . ", " ;
    $sql .= $row['numero_documento_designado'] . ", " ;
    $sql .= $row['alta'] . ", " ;
    $sql .= $row['comision'] . ", " ;
    $sql .= $row['asignatura'] . ", " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ");
";

    return $sql;
  }

  public function _update(array $row){ //@override
    $sql = "
UPDATE " . $this->entity->sn_() . " SET
";
    if (isset($row['horas_catedra'] )) $sql .= "horas_catedra = " . $row['horas_catedra'] . " ," ;
    if (isset($row['ige'] )) $sql .= "ige = " . $row['ige'] . " ," ;
    if (isset($row['numero_documento_designado'] )) $sql .= "numero_documento_designado = " . $row['numero_documento_designado'] . " ," ;
    if (isset($row['alta'] )) $sql .= "alta = " . $row['alta'] . " ," ;
    if (isset($row['comision'] )) $sql .= "comision = " . $row['comision'] . " ," ;
    if (isset($row['asignatura'] )) $sql .= "asignatura = " . $row['asignatura'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }

  public function json(array $row = null){
    if(empty($row)) return null;
    $row_ = $this->container->getValue($this->entity->getName())->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['com_id'])) $row_["comision_"] = $this->container->getValue('comision', 'com')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['com_sed_id'])) $row_["comision_"]["sede_"] = $this->container->getValue('sede', 'com_sed')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['com_sed_dom_id'])) $row_["comision_"]["sede_"]["domicilio_"] = $this->container->getValue('domicilio', 'com_sed_dom')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['com_sed_ts_id'])) $row_["comision_"]["sede_"]["tipo_sede_"] = $this->container->getValue('tipo_sede', 'com_sed_ts')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['com_sed_ce_id'])) $row_["comision_"]["sede_"]["centro_educativo_"] = $this->container->getValue('centro_educativo', 'com_sed_ce')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['com_sed_ce_dom_id'])) $row_["comision_"]["sede_"]["centro_educativo_"]["domicilio_"] = $this->container->getValue('domicilio', 'com_sed_ce_dom')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['com_moa_id'])) $row_["comision_"]["modalidad_"] = $this->container->getValue('modalidad', 'com_moa')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['com_pla_id'])) $row_["comision_"]["planificacion_"] = $this->container->getValue('planificacion', 'com_pla')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['com_pla_plb_id'])) $row_["comision_"]["planificacion_"]["plan_"] = $this->container->getValue('plan', 'com_pla_plb')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['com_cal_id'])) $row_["comision_"]["calendario_"] = $this->container->getValue('calendario', 'com_cal')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['asi_id'])) $row_["asignatura_"] = $this->container->getValue('asignatura', 'asi')->_fromArray($row, "set")->_toArray("json");
    return $row_;
  }

  public function values(array $row){
    $row_ = [];
    $row_["curso"] = $this->container->getValue("curso")->_fromArray($row, "set");
    $row_["comision"] = $this->container->getValue('comision', 'com')->_fromArray($row, "set");
    $row_["sede"] = $this->container->getValue('sede', 'com_sed')->_fromArray($row, "set");
    $row_["domicilio"] = $this->container->getValue('domicilio', 'com_sed_dom')->_fromArray($row, "set");
    $row_["tipo_sede"] = $this->container->getValue('tipo_sede', 'com_sed_ts')->_fromArray($row, "set");
    $row_["centro_educativo"] = $this->container->getValue('centro_educativo', 'com_sed_ce')->_fromArray($row, "set");
    $row_["domicilio1"] = $this->container->getValue('domicilio', 'com_sed_ce_dom')->_fromArray($row, "set");
    $row_["modalidad"] = $this->container->getValue('modalidad', 'com_moa')->_fromArray($row, "set");
    $row_["planificacion"] = $this->container->getValue('planificacion', 'com_pla')->_fromArray($row, "set");
    $row_["plan"] = $this->container->getValue('plan', 'com_pla_plb')->_fromArray($row, "set");
    $row_["calendario"] = $this->container->getValue('calendario', 'com_cal')->_fromArray($row, "set");
    $row_["asignatura"] = $this->container->getValue('asignatura', 'asi')->_fromArray($row, "set");
    return $row_;
  }



}
