<?php
require_once("class/model/Rel.php");

class _SedeRel extends EntityRel{

  public function mappingField($field){
    if($f = $this->container->getMapping($this->entity->getName())->_eval($field)) return $f;
    if($f = $this->container->getMapping('domicilio', 'dom')->_eval($field)) return $f;
    if($f = $this->container->getMapping('tipo_sede', 'ts')->_eval($field)) return $f;
    if($f = $this->container->getMapping('centro_educativo', 'ce')->_eval($field)) return $f;
    if($f = $this->container->getMapping('domicilio', 'ce_dom')->_eval($field)) return $f;
    throw new Exception("Campo no reconocido para {$this->entity->getName()}: {$field}");
  }

  public function fields(){
    return implode(",", $this->container->getFieldAlias($this->entity->getName())->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('domicilio', 'dom')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('tipo_sede', 'ts')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('centro_educativo', 'ce')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('domicilio', 'ce_dom')->_toArray()) . ' 
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

  public function json(array $row = null){
    if(empty($row)) return null;
    $row_ = $this->container->getValue($this->entity->getName())->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['dom_id'])) $row_["domicilio_"] = $this->container->getValue('domicilio', 'dom')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['ts_id'])) $row_["tipo_sede_"] = $this->container->getValue('tipo_sede', 'ts')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['ce_id'])) $row_["centro_educativo_"] = $this->container->getValue('centro_educativo', 'ce')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['ce_dom_id'])) $row_["centro_educativo_"]["domicilio_"] = $this->container->getValue('domicilio', 'ce_dom')->_fromArray($row, "set")->_toArray("json");
    return $row_;
  }

  public function values(array $row){
    $row_ = [];
    $row_["sede"] = $this->container->getValue("sede")->_fromArray($row, "set");
    $row_["domicilio"] = $this->container->getValue('domicilio', 'dom')->_fromArray($row, "set");
    $row_["tipo_sede"] = $this->container->getValue('tipo_sede', 'ts')->_fromArray($row, "set");
    $row_["centro_educativo"] = $this->container->getValue('centro_educativo', 'ce')->_fromArray($row, "set");
    $row_["domicilio1"] = $this->container->getValue('domicilio', 'ce_dom')->_fromArray($row, "set");
    return $row_;
  }



}
