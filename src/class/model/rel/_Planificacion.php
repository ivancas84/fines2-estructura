<?php
require_once("class/model/Rel.php");

class _PlanificacionRel extends EntityRel{

  public function mappingField($field){
    if($f = $this->container->getMapping($this->entity->getName())->_eval($field)) return $f;
    if($f = $this->container->getMapping('plan', 'plb')->_eval($field)) return $f;
    throw new Exception("Campo no reconocido para {$this->entity->getName()}: {$field}");
  }

  public function fields(){
    return implode(",", $this->container->getFieldAlias($this->entity->getName())->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('plan', 'plb')->_toArray()) . ' 
';
  }

  public function join(Render $render){
    return $this->container->getSql('plan', 'plb')->_join('plan', 'pla', $render) . '
' ;
  }

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->container->getCondition($this->entity->getName())->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('plan','plb')->_eval($field, [$option, $value])) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->container->getConditionAux($this->entity->getName())->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('plan','plb')->_eval($field, [$option, $value])) return $c;
  }

  public function json(array $row = null){
    if(empty($row)) return null;
    $row_ = $this->container->getValue($this->entity->getName())->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['plb_id'])) $row_["plan_"] = $this->container->getValue('plan', 'plb')->_fromArray($row, "set")->_toArray("json");
    return $row_;
  }

  public function values(array $row){
    $row_ = [];
    $row_["planificacion"] = $this->container->getValue("planificacion")->_fromArray($row, "set");
    $row_["plan"] = $this->container->getValue('plan', 'plb')->_fromArray($row, "set");
    return $row_;
  }



}
