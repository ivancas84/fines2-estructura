<?php
require_once("class/model/Sql.php");

class _DesignacionSql extends EntitySql{

  public function mappingField($field){
    if($f = $this->container->getMapping($this->entity->getName())->_eval($field)) return $f;
    if($f = $this->container->getMapping('cargo', 'car')->_eval($field)) return $f;
    if($f = $this->container->getMapping('sede', 'sed')->_eval($field)) return $f;
    if($f = $this->container->getMapping('domicilio', 'sed_dom')->_eval($field)) return $f;
    if($f = $this->container->getMapping('tipo_sede', 'sed_ts')->_eval($field)) return $f;
    if($f = $this->container->getMapping('centro_educativo', 'sed_ce')->_eval($field)) return $f;
    if($f = $this->container->getMapping('domicilio', 'sed_ce_dom')->_eval($field)) return $f;
    if($f = $this->container->getMapping('persona', 'per')->_eval($field)) return $f;
    if($f = $this->container->getMapping('domicilio', 'per_dom')->_eval($field)) return $f;
    throw new Exception("Campo no reconocido para {$this->entity->getName()}: {$field}");
  }

  public function fields(){
    return implode(",", $this->container->getFieldAlias($this->entity->getName())->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('cargo', 'car')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('sede', 'sed')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('domicilio', 'sed_dom')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('tipo_sede', 'sed_ts')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('centro_educativo', 'sed_ce')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('domicilio', 'sed_ce_dom')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('persona', 'per')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('domicilio', 'per_dom')->_toArray()) . ' 
';
  }

  public function join(Render $render){
    return $this->container->getSql('cargo', 'car')->_join('cargo', 'desi', $render) . '
' . $this->container->getSql('sede', 'sed')->_join('sede', 'desi', $render) . '
' . $this->container->getSql('domicilio', 'sed_dom')->_join('domicilio', 'sed', $render) . '
' . $this->container->getSql('tipo_sede', 'sed_ts')->_join('tipo_sede', 'sed', $render) . '
' . $this->container->getSql('centro_educativo', 'sed_ce')->_join('centro_educativo', 'sed', $render) . '
' . $this->container->getSql('domicilio', 'sed_ce_dom')->_join('domicilio', 'sed_ce', $render) . '
' . $this->container->getSql('persona', 'per')->_join('persona', 'desi', $render) . '
' . $this->container->getSql('domicilio', 'per_dom')->_join('domicilio', 'per', $render) . '
' ;
  }

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->container->getCondition($this->entity->getName())->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('cargo','car')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('sede','sed')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('domicilio','sed_dom')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('tipo_sede','sed_ts')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('centro_educativo','sed_ce')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('domicilio','sed_ce_dom')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('persona','per')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('domicilio','per_dom')->_eval($field, [$option, $value])) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->container->getConditionAux($this->entity->getName())->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('cargo','car')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('sede','sed')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('domicilio','sed_dom')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('tipo_sede','sed_ts')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('centro_educativo','sed_ce')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('domicilio','sed_ce_dom')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('persona','per')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('domicilio','per_dom')->_eval($field, [$option, $value])) return $c;
  }



}
