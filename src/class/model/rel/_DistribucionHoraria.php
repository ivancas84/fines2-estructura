<?php
require_once("class/model/Rel.php");

class _DistribucionHorariaRel extends EntityRel{

  public function mappingField($field){
    if($f = $this->container->getMapping($this->entity->getName())->_eval($field)) return $f;
    if($f = $this->container->getMapping('asignatura', 'asi')->_eval($field)) return $f;
    if($f = $this->container->getMapping('planificacion', 'pla')->_eval($field)) return $f;
    if($f = $this->container->getMapping('plan', 'pla_plb')->_eval($field)) return $f;
    throw new Exception("Campo no reconocido para {$this->entity->getName()}: {$field}");
  }

  public function fields(){
    return implode(",", $this->container->getFieldAlias($this->entity->getName())->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('asignatura', 'asi')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('planificacion', 'pla')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('plan', 'pla_plb')->_toArray()) . ' 
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

  public function json(array $row = null){
    if(empty($row)) return null;
    $row_ = $this->container->getValue($this->entity->getName())->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['asi_id'])) $row_["asignatura_"] = $this->container->getValue('asignatura', 'asi')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['pla_id'])) $row_["planificacion_"] = $this->container->getValue('planificacion', 'pla')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['pla_plb_id'])) $row_["planificacion_"]["plan_"] = $this->container->getValue('plan', 'pla_plb')->_fromArray($row, "set")->_toArray("json");
    return $row_;
  }

  public function values(array $row){
    $row_ = [];
    $row_["distribucion_horaria"] = $this->container->getValue("distribucion_horaria")->_fromArray($row, "set");
    $row_["asignatura"] = $this->container->getValue('asignatura', 'asi')->_fromArray($row, "set");
    $row_["planificacion"] = $this->container->getValue('planificacion', 'pla')->_fromArray($row, "set");
    $row_["plan"] = $this->container->getValue('plan', 'pla_plb')->_fromArray($row, "set");
    return $row_;
  }



}
