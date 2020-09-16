<?php
require_once("class/model/Sql.php");

class _DistribucionHorariaSql extends EntitySql{

  public function mappingField($field){
    if($f = $this->container->getMapping($this->entity->getName())->_eval($field)) return $f;
    if($f = $this->container->getMapping('asignatura', 'asi')->_eval($field)) return $f;
    if($f = $this->container->getMapping('planificacion', 'pla')->_eval($field)) return $f;
    if($f = $this->container->getMapping('plan', 'pla_plb')->_eval($field)) return $f;
    throw new Exception("Campo no reconocido para {$this->entity->getName()}: {$field}");
  }

  public function fields(){
    return $this->container->getFieldAlias($this->entity->getName())->_callConcat() . ',
' . $this->container->getFieldAlias('asignatura', 'asi')->_callConcat() . ',
' . $this->container->getFieldAlias('planificacion', 'pla')->_callConcat() . ',
' . $this->container->getFieldAlias('plan', 'pla_plb')->_callConcat() . ' 
';
  }

  public function join(Render $render){
    return $this->container->getSql('asignatura', 'asi')->_join('asignatura', 'dh', $render) . '
' . $this->container->getSql('planificacion', 'pla')->_join('planificacion', 'dh', $render) . '
' . $this->container->getSql('plan', 'pla_plb')->_join('plan', 'pla', $render) . '
' ;
  }

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->container->getCondition($this->entity->getName())->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('asignatura','asi')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('planificacion','pla')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('plan','pla_plb')->_eval($field, [$option, $value])) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->container->getConditionAux($this->entity->getName())->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('asignatura','asi')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('planificacion','pla')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('plan','pla_plb')->_eval($field, [$option, $value])) return $c;
  }



}
