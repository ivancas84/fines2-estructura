<?php
require_once("class/model/Rel.php");

class _CursoRel extends EntityRel{

  public function join(Render $render){
    return $this->container->getSql('comision', 'com')->_join('comision', 'curs', $render) . '
' . $this->container->getSql('sede', 'com_sed')->_join('sede', 'com', $render) . '
' . $this->container->getSql('domicilio', 'com_sed_dom')->_join('domicilio', 'com_sed', $render) . '
' . $this->container->getSql('tipo_sede', 'com_sed_ts')->_join('tipo_sede', 'com_sed', $render) . '
' . $this->container->getSql('centro_educativo', 'com_sed_ce')->_join('centro_educativo', 'com_sed', $render) . '
' . $this->container->getSql('domicilio', 'com_sed_ce_dom')->_join('domicilio', 'com_sed_ce', $render) . '
' . $this->container->getSql('modalidad', 'com_moa')->_join('modalidad', 'com', $render) . '
' . $this->container->getSql('planificacion', 'com_pla')->_join('planificacion', 'com', $render) . '
' . $this->container->getSql('plan', 'com_pla_plb')->_join('plan', 'com_pla', $render) . '
' . $this->container->getSql('calendario', 'com_cal')->_join('calendario', 'com', $render) . '
' . $this->container->getSql('asignatura', 'asi')->_join('asignatura', 'curs', $render) . '
' ;
  }

  public function json(array $row = null){
    if(empty($row)) return null;
    $row_ = $this->container->getValue($this->entityName)->_fromArray($row, "set")->_toArray("json");
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

  public function value(array $row){
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
