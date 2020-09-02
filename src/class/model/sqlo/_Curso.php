<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class _CursoSqlo extends EntitySqlo {

  public $entityName = "curso";

  protected function _insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "horas_catedra, " ;
    $sql .= "alta, " ;
    $sql .= "comision, " ;
    $sql .= "asignatura, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['horas_catedra'] . ", " ;
    $sql .= $row['alta'] . ", " ;
    $sql .= $row['comision'] . ", " ;
    $sql .= $row['asignatura'] . ", " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ");
";

    return $sql;
  }

  protected function _update(array $row){ //@override
    $sql = "
UPDATE " . $this->entity->sn_() . " SET
";
    if (isset($row['horas_catedra'] )) $sql .= "horas_catedra = " . $row['horas_catedra'] . " ," ;
    if (isset($row['alta'] )) $sql .= "alta = " . $row['alta'] . " ," ;
    if (isset($row['comision'] )) $sql .= "comision = " . $row['comision'] . " ," ;
    if (isset($row['asignatura'] )) $sql .= "asignatura = " . $row['asignatura'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }

  public function json(array $row = null){
    if(empty($row)) return null;
    $row_ = $this->container->getValues($this->entity->getName())->_fromArray($row)->_toArray();
    if(!is_null($row['com_id'])) $row_["comision_"] = $this->container->getValues('comision')->_fromArray($row, 'com_')->_toArray();
    if(!is_null($row['com_sed_id'])) $row_["comision_"]["sede_"] = $this->container->getValues('sede')->_fromArray($row, 'com_sed_')->_toArray();
    if(!is_null($row['com_sed_dom_id'])) $row_["comision_"]["sede_"]["domicilio_"] = $this->container->getValues('domicilio')->_fromArray($row, 'com_sed_dom_')->_toArray();
    if(!is_null($row['com_sed_ts_id'])) $row_["comision_"]["sede_"]["tipo_sede_"] = $this->container->getValues('tipo_sede')->_fromArray($row, 'com_sed_ts_')->_toArray();
    if(!is_null($row['com_sed_ce_id'])) $row_["comision_"]["sede_"]["centro_educativo_"] = $this->container->getValues('centro_educativo')->_fromArray($row, 'com_sed_ce_')->_toArray();
    if(!is_null($row['com_sed_ce_dom_id'])) $row_["comision_"]["sede_"]["centro_educativo_"]["domicilio_"] = $this->container->getValues('domicilio')->_fromArray($row, 'com_sed_ce_dom_')->_toArray();
    if(!is_null($row['com_moa_id'])) $row_["comision_"]["modalidad_"] = $this->container->getValues('modalidad')->_fromArray($row, 'com_moa_')->_toArray();
    if(!is_null($row['com_pla_id'])) $row_["comision_"]["planificacion_"] = $this->container->getValues('planificacion')->_fromArray($row, 'com_pla_')->_toArray();
    if(!is_null($row['com_pla_plb_id'])) $row_["comision_"]["planificacion_"]["plan_"] = $this->container->getValues('plan')->_fromArray($row, 'com_pla_plb_')->_toArray();
    if(!is_null($row['com_cal_id'])) $row_["comision_"]["calendario_"] = $this->container->getValues('calendario')->_fromArray($row, 'com_cal_')->_toArray();
    if(!is_null($row['asi_id'])) $row_["asignatura_"] = $this->container->getValues('asignatura')->_fromArray($row, 'asi_')->_toArray();
    return $row_;
  }

  public function values(array $row){
    $row_ = [];
    $row_["curso"] = $this->container->getValues("curso")->_fromArray($row);
    $row_["comision"] = $this->container->getValues('comision')->_fromArray($row, 'com_');
    $row_["sede"] = $this->container->getValues('sede')->_fromArray($row, 'com_sed_');
    $row_["domicilio"] = $this->container->getValues('domicilio')->_fromArray($row, 'com_sed_dom_');
    $row_["tipo_sede"] = $this->container->getValues('tipo_sede')->_fromArray($row, 'com_sed_ts_');
    $row_["centro_educativo"] = $this->container->getValues('centro_educativo')->_fromArray($row, 'com_sed_ce_');
    $row_["domicilio1"] = $this->container->getValues('domicilio')->_fromArray($row, 'com_sed_ce_dom_');
    $row_["modalidad"] = $this->container->getValues('modalidad')->_fromArray($row, 'com_moa_');
    $row_["planificacion"] = $this->container->getValues('planificacion')->_fromArray($row, 'com_pla_');
    $row_["plan"] = $this->container->getValues('plan')->_fromArray($row, 'com_pla_plb_');
    $row_["calendario"] = $this->container->getValues('calendario')->_fromArray($row, 'com_cal_');
    $row_["asignatura"] = $this->container->getValues('asignatura')->_fromArray($row, 'asi_');
    return $row_;
  }



}
