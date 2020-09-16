<?php
require_once("class/model/Sql.php");

class _SedeSql extends EntitySql{

  public function mappingField($field){
    if($f = $this->container->getMapping($this->entity->getName())->_eval($field)) return $f;
    if($f = $this->container->getMapping('domicilio', 'dom')->_eval($field)) return $f;
    if($f = $this->container->getMapping('tipo_sede', 'ts')->_eval($field)) return $f;
    if($f = $this->container->getMapping('centro_educativo', 'ce')->_eval($field)) return $f;
    if($f = $this->container->getMapping('domicilio', 'ce_dom')->_eval($field)) return $f;
    throw new Exception("Campo no reconocido para {$this->entity->getName()}: {$field}");
  }

  public function fields(){
    return $this->container->getFieldAlias($this->entity->getName())->_callConcat() . ',
' . $this->container->getFieldAlias('domicilio', 'dom')->_callConcat() . ',
' . $this->container->getFieldAlias('tipo_sede', 'ts')->_callConcat() . ',
' . $this->container->getFieldAlias('centro_educativo', 'ce')->_callConcat() . ',
' . $this->container->getFieldAlias('domicilio', 'ce_dom')->_callConcat() . ' 
';
  }

  public function join(Render $render){
    return $this->container->getSql('domicilio', 'dom')->_join('domicilio', 'sede', $render) . '
' . $this->container->getSql('tipo_sede', 'ts')->_join('tipo_sede', 'sede', $render) . '
' . $this->container->getSql('centro_educativo', 'ce')->_join('centro_educativo', 'sede', $render) . '
' . $this->container->getSql('domicilio', 'ce_dom')->_join('domicilio', 'ce', $render) . '
' ;
  }

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->container->getCondition($this->entity->getName())->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('domicilio','dom')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('tipo_sede','ts')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('centro_educativo','ce')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('domicilio','ce_dom')->_eval($field, [$option, $value])) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->container->getConditionAux($this->entity->getName())->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('domicilio','dom')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('tipo_sede','ts')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('centro_educativo','ce')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('domicilio','ce_dom')->_eval($field, [$option, $value])) return $c;
  }



}
