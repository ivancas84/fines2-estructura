<?php
require_once("class/model/Sql.php");

class _TelefonoSql extends EntitySql{

  public function mappingField($field){
    if($f = $this->container->getMapping($this->entity->getName())->_eval($field)) return $f;
    if($f = $this->container->getMapping('persona', 'per')->_eval($field)) return $f;
    if($f = $this->container->getMapping('domicilio', 'per_dom')->_eval($field)) return $f;
    throw new Exception("Campo no reconocido para {$this->entity->getName()}: {$field}");
  }

  public function fields(){
    return $this->container->getFieldAlias($this->entity->getName())->_callConcat() . ',
' . $this->container->getFieldAlias('persona', 'per')->_callConcat() . ',
' . $this->container->getFieldAlias('domicilio', 'per_dom')->_callConcat() . ' 
';
  }

  public function join(Render $render){
    return $this->container->getSql('persona', 'per')->_join('persona', 'tele', $render) . '
' . $this->container->getSql('domicilio', 'per_dom')->_join('domicilio', 'per', $render) . '
' ;
  }

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->container->getCondition($this->entity->getName())->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('persona','per')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('domicilio','per_dom')->_eval($field, [$option, $value])) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->container->getConditionAux($this->entity->getName())->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('persona','per')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('domicilio','per_dom')->_eval($field, [$option, $value])) return $c;
  }



}
