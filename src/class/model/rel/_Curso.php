<?php
require_once("class/model/Rel.php");

class _CursoRel extends EntityRel{

  public function mapping($field){
    if($f = $this->container->getMapping($this->entityName)->_eval($field)) return $f;
    if($f = $this->container->getMapping('comision', 'com')->_eval($field)) return $f;
    if($f = $this->container->getMapping('sede', 'com_sed')->_eval($field)) return $f;
    if($f = $this->container->getMapping('domicilio', 'com_sed_dom')->_eval($field)) return $f;
    if($f = $this->container->getMapping('tipo_sede', 'com_sed_ts')->_eval($field)) return $f;
    if($f = $this->container->getMapping('centro_educativo', 'com_sed_ce')->_eval($field)) return $f;
    if($f = $this->container->getMapping('domicilio', 'com_sed_ce_dom')->_eval($field)) return $f;
    if($f = $this->container->getMapping('modalidad', 'com_moa')->_eval($field)) return $f;
    if($f = $this->container->getMapping('planificacion', 'com_pla')->_eval($field)) return $f;
    if($f = $this->container->getMapping('plan', 'com_pla_plb')->_eval($field)) return $f;
    if($f = $this->container->getMapping('calendario', 'com_cal')->_eval($field)) return $f;
    if($f = $this->container->getMapping('asignatura', 'asi')->_eval($field)) return $f;
    throw new Exception("Campo no reconocido para {$this->entityName}: {$field}");
  }

  public function fields(){
    return implode(",", $this->container->getFieldAlias($this->entityName)->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('comision', 'com')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('sede', 'com_sed')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('domicilio', 'com_sed_dom')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('tipo_sede', 'com_sed_ts')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('centro_educativo', 'com_sed_ce')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('domicilio', 'com_sed_ce_dom')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('modalidad', 'com_moa')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('planificacion', 'com_pla')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('plan', 'com_pla_plb')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('calendario', 'com_cal')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('asignatura', 'asi')->_toArray()) . ' 
';
  }

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

  public function condition($field, $option, $value) {
    if($c = $this->container->getCondition($this->entityName)->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('comision','com')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('sede','com_sed')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('domicilio','com_sed_dom')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('tipo_sede','com_sed_ts')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('centro_educativo','com_sed_ce')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('domicilio','com_sed_ce_dom')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('modalidad','com_moa')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('planificacion','com_pla')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('plan','com_pla_plb')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('calendario','com_cal')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('asignatura','asi')->_eval($field, [$option, $value])) return $c;
  }

  public function conditionAux($field, $option, $value) {
    if($c = $this->container->getConditionAux($this->entityName)->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('comision','com')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('sede','com_sed')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('domicilio','com_sed_dom')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('tipo_sede','com_sed_ts')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('centro_educativo','com_sed_ce')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('domicilio','com_sed_ce_dom')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('modalidad','com_moa')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('planificacion','com_pla')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('plan','com_pla_plb')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('calendario','com_cal')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('asignatura','asi')->_eval($field, [$option, $value])) return $c;
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
