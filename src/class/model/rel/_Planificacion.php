<?php
require_once("class/model/Rel.php");

class _PlanificacionRel extends EntityRel{

  public function mapping($field){
    if($f = $this->container->getMapping($this->entityName)->_eval($field)) return $f;
    if($f = $this->container->getMapping('plan', 'plb')->_eval($field)) return $f;
    throw new Exception("Campo no reconocido para {$this->entityName}: {$field}");
  }

  public function fields(){
    return implode(",", $this->container->getFieldAlias($this->entityName)->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('plan', 'plb')->_toArray()) . ' 
';
  }

  public function join(Render $render){
    return $this->container->getSql('plan', 'plb')->_join('plan', 'pla', $render) . '
' ;
  }

  public function condition($field, $option, $value) {
    if($c = $this->container->getCondition($this->entityName)->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('plan','plb')->_eval($field, [$option, $value])) return $c;
  }

  public function conditionAux($field, $option, $value) {
    if($c = $this->container->getConditionAux($this->entityName)->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('plan','plb')->_eval($field, [$option, $value])) return $c;
  }

  public function json(array $row = null){
    if(empty($row)) return null;
    $row_ = $this->container->getValue($this->entityName)->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['plb_id'])) $row_["plan_"] = $this->container->getValue('plan', 'plb')->_fromArray($row, "set")->_toArray("json");
    return $row_;
  }

  public function value(array $row){
    $row_ = [];
    $row_["planificacion"] = $this->container->getValue("planificacion")->_fromArray($row, "set");
    $row_["plan"] = $this->container->getValue('plan', 'plb')->_fromArray($row, "set");
    return $row_;
  }



}
