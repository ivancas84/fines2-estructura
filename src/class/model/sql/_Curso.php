<?php
require_once("class/model/Sql.php");

class _CursoSql extends EntitySql{

  public function mappingField($field){
    if($f = $this->container->getMapping($this->entity->getName())->_eval($field)) return $f;
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
    throw new Exception("Campo no reconocido para {$this->entity->getName()}: {$field}");
  }

  public function fields(){
    return $this->container->getFieldAlias($this->entity->getName())->_callConcat() . ',
' . $this->container->getFieldAlias('comision', 'com')->_callConcat() . ',
' . $this->container->getFieldAlias('sede', 'com_sed')->_callConcat() . ',
' . $this->container->getFieldAlias('domicilio', 'com_sed_dom')->_callConcat() . ',
' . $this->container->getFieldAlias('tipo_sede', 'com_sed_ts')->_callConcat() . ',
' . $this->container->getFieldAlias('centro_educativo', 'com_sed_ce')->_callConcat() . ',
' . $this->container->getFieldAlias('domicilio', 'com_sed_ce_dom')->_callConcat() . ',
' . $this->container->getFieldAlias('modalidad', 'com_moa')->_callConcat() . ',
' . $this->container->getFieldAlias('planificacion', 'com_pla')->_callConcat() . ',
' . $this->container->getFieldAlias('plan', 'com_pla_plb')->_callConcat() . ',
' . $this->container->getFieldAlias('calendario', 'com_cal')->_callConcat() . ',
' . $this->container->getFieldAlias('asignatura', 'asi')->_callConcat() . ' 
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

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->container->getCondition($this->entity->getName())->_eval($field, [$option, $value])) return $c;
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

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->container->getConditionAux($this->entity->getName())->_eval($field, [$option, $value])) return $c;
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



}
