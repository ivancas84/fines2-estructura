<?php
require_once("class/model/Sql.php");

class _ComisionSql extends EntitySql{

  public function mappingField($field){
    if($f = $this->container->getMapping($this->entity->getName())->_eval($field)) return $f;
    if($f = $this->container->getMapping('sede', 'sed')->_eval($field)) return $f;
    if($f = $this->container->getMapping('domicilio', 'sed_dom')->_eval($field)) return $f;
    if($f = $this->container->getMapping('tipo_sede', 'sed_ts')->_eval($field)) return $f;
    if($f = $this->container->getMapping('centro_educativo', 'sed_ce')->_eval($field)) return $f;
    if($f = $this->container->getMapping('domicilio', 'sed_ce_dom')->_eval($field)) return $f;
    if($f = $this->container->getMapping('modalidad', 'moa')->_eval($field)) return $f;
    if($f = $this->container->getMapping('planificacion', 'pla')->_eval($field)) return $f;
    if($f = $this->container->getMapping('plan', 'pla_plb')->_eval($field)) return $f;
    if($f = $this->container->getMapping('calendario', 'cal')->_eval($field)) return $f;
    throw new Exception("Campo no reconocido para {$this->entity->getName()}: {$field}");
  }

  public function fields(){
    return $this->container->getFieldAlias($this->entity->getName())->_callConcat() . ',
' . $this->container->getFieldAlias('sede', 'sed')->_callConcat() . ',
' . $this->container->getFieldAlias('domicilio', 'sed_dom')->_callConcat() . ',
' . $this->container->getFieldAlias('tipo_sede', 'sed_ts')->_callConcat() . ',
' . $this->container->getFieldAlias('centro_educativo', 'sed_ce')->_callConcat() . ',
' . $this->container->getFieldAlias('domicilio', 'sed_ce_dom')->_callConcat() . ',
' . $this->container->getFieldAlias('modalidad', 'moa')->_callConcat() . ',
' . $this->container->getFieldAlias('planificacion', 'pla')->_callConcat() . ',
' . $this->container->getFieldAlias('plan', 'pla_plb')->_callConcat() . ',
' . $this->container->getFieldAlias('calendario', 'cal')->_callConcat() . ' 
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

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->container->getCondition($this->entity->getName())->_eval($field, [$option, $value])) return $c;
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

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->container->getConditionAux($this->entity->getName())->_eval($field, [$option, $value])) return $c;
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



}
