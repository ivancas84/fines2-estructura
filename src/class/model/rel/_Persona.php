<?php
require_once("class/model/Rel.php");

class _PersonaRel extends EntityRel{

  public function mapping($field){
    if($f = $this->container->getMapping($this->entityName)->_eval($field)) return $f;
    if($f = $this->container->getMapping('domicilio', 'dom')->_eval($field)) return $f;
    throw new Exception("Campo no reconocido para {$this->entityName}: {$field}");
  }

  public function fields(){
    return implode(",", $this->container->getFieldAlias($this->entityName)->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('domicilio', 'dom')->_toArray()) . ' 
';
  }

  public function join(Render $render){
    return $this->container->getSql('domicilio', 'dom')->_join('domicilio', 'pers', $render) . '
' ;
  }

  public function condition($field, $option, $value) {
    if($c = $this->container->getCondition($this->entityName)->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('domicilio','dom')->_eval($field, [$option, $value])) return $c;
  }

  public function conditionAux($field, $option, $value) {
    if($c = $this->container->getConditionAux($this->entityName)->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('domicilio','dom')->_eval($field, [$option, $value])) return $c;
  }

  public function json(array $row = null){
    if(empty($row)) return null;
    $row_ = $this->container->getValue($this->entityName)->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['dom_id'])) $row_["domicilio_"] = $this->container->getValue('domicilio', 'dom')->_fromArray($row, "set")->_toArray("json");
    return $row_;
  }

  public function value(array $row){
    $row_ = [];
    $row_["persona"] = $this->container->getValue("persona")->_fromArray($row, "set");
    $row_["domicilio"] = $this->container->getValue('domicilio', 'dom')->_fromArray($row, "set");
    return $row_;
  }



}
