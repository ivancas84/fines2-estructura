<?php
require_once("class/model/Rel.php");

class _ComisionRel extends EntityRel{

  public function mapping($field){
    if($f = $this->container->getMapping($this->entityName)->_eval($field)) return $f;
    if($f = $this->container->getMapping('sede', 'sed')->_eval($field)) return $f;
    if($f = $this->container->getMapping('domicilio', 'sed_dom')->_eval($field)) return $f;
    if($f = $this->container->getMapping('tipo_sede', 'sed_ts')->_eval($field)) return $f;
    if($f = $this->container->getMapping('centro_educativo', 'sed_ce')->_eval($field)) return $f;
    if($f = $this->container->getMapping('domicilio', 'sed_ce_dom')->_eval($field)) return $f;
    if($f = $this->container->getMapping('modalidad', 'moa')->_eval($field)) return $f;
    if($f = $this->container->getMapping('planificacion', 'pla')->_eval($field)) return $f;
    if($f = $this->container->getMapping('plan', 'pla_plb')->_eval($field)) return $f;
    if($f = $this->container->getMapping('calendario', 'cal')->_eval($field)) return $f;
    throw new Exception("Campo no reconocido para {$this->entityName}: {$field}");
  }

  public function fields(){
    return implode(",", $this->container->getFieldAlias($this->entityName)->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('sede', 'sed')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('domicilio', 'sed_dom')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('tipo_sede', 'sed_ts')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('centro_educativo', 'sed_ce')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('domicilio', 'sed_ce_dom')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('modalidad', 'moa')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('planificacion', 'pla')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('plan', 'pla_plb')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('calendario', 'cal')->_toArray()) . ' 
';
  }

  public function join(Render $render){
    return $this->container->getSql('sede', 'sed')->_join('sede', 'comi', $render) . '
' . $this->container->getSql('domicilio', 'sed_dom')->_join('domicilio', 'sed', $render) . '
' . $this->container->getSql('tipo_sede', 'sed_ts')->_join('tipo_sede', 'sed', $render) . '
' . $this->container->getSql('centro_educativo', 'sed_ce')->_join('centro_educativo', 'sed', $render) . '
' . $this->container->getSql('domicilio', 'sed_ce_dom')->_join('domicilio', 'sed_ce', $render) . '
' . $this->container->getSql('modalidad', 'moa')->_join('modalidad', 'comi', $render) . '
' . $this->container->getSql('planificacion', 'pla')->_join('planificacion', 'comi', $render) . '
' . $this->container->getSql('plan', 'pla_plb')->_join('plan', 'pla', $render) . '
' . $this->container->getSql('calendario', 'cal')->_join('calendario', 'comi', $render) . '
' ;
  }

  public function condition($field, $option, $value) {
    if($c = $this->container->getCondition($this->entityName)->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('sede','sed')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('domicilio','sed_dom')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('tipo_sede','sed_ts')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('centro_educativo','sed_ce')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('domicilio','sed_ce_dom')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('modalidad','moa')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('planificacion','pla')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('plan','pla_plb')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('calendario','cal')->_eval($field, [$option, $value])) return $c;
  }

  public function conditionAux($field, $option, $value) {
    if($c = $this->container->getConditionAux($this->entityName)->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('sede','sed')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('domicilio','sed_dom')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('tipo_sede','sed_ts')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('centro_educativo','sed_ce')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('domicilio','sed_ce_dom')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('modalidad','moa')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('planificacion','pla')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('plan','pla_plb')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('calendario','cal')->_eval($field, [$option, $value])) return $c;
  }

  public function json(array $row = null){
    if(empty($row)) return null;
    $row_ = $this->container->getValue($this->entityName)->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['sed_id'])) $row_["sede_"] = $this->container->getValue('sede', 'sed')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['sed_dom_id'])) $row_["sede_"]["domicilio_"] = $this->container->getValue('domicilio', 'sed_dom')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['sed_ts_id'])) $row_["sede_"]["tipo_sede_"] = $this->container->getValue('tipo_sede', 'sed_ts')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['sed_ce_id'])) $row_["sede_"]["centro_educativo_"] = $this->container->getValue('centro_educativo', 'sed_ce')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['sed_ce_dom_id'])) $row_["sede_"]["centro_educativo_"]["domicilio_"] = $this->container->getValue('domicilio', 'sed_ce_dom')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['moa_id'])) $row_["modalidad_"] = $this->container->getValue('modalidad', 'moa')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['pla_id'])) $row_["planificacion_"] = $this->container->getValue('planificacion', 'pla')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['pla_plb_id'])) $row_["planificacion_"]["plan_"] = $this->container->getValue('plan', 'pla_plb')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['cal_id'])) $row_["calendario_"] = $this->container->getValue('calendario', 'cal')->_fromArray($row, "set")->_toArray("json");
    return $row_;
  }

  public function value(array $row){
    $row_ = [];
    $row_["comision"] = $this->container->getValue("comision")->_fromArray($row, "set");
    $row_["sede"] = $this->container->getValue('sede', 'sed')->_fromArray($row, "set");
    $row_["domicilio"] = $this->container->getValue('domicilio', 'sed_dom')->_fromArray($row, "set");
    $row_["tipo_sede"] = $this->container->getValue('tipo_sede', 'sed_ts')->_fromArray($row, "set");
    $row_["centro_educativo"] = $this->container->getValue('centro_educativo', 'sed_ce')->_fromArray($row, "set");
    $row_["domicilio1"] = $this->container->getValue('domicilio', 'sed_ce_dom')->_fromArray($row, "set");
    $row_["modalidad"] = $this->container->getValue('modalidad', 'moa')->_fromArray($row, "set");
    $row_["planificacion"] = $this->container->getValue('planificacion', 'pla')->_fromArray($row, "set");
    $row_["plan"] = $this->container->getValue('plan', 'pla_plb')->_fromArray($row, "set");
    $row_["calendario"] = $this->container->getValue('calendario', 'cal')->_fromArray($row, "set");
    return $row_;
  }



}
